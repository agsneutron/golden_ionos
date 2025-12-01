<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Propel\Runtime\ActiveQuery\Criteria;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Options;

class DailyCutController extends Controller
{
    private $viewName = "daily_cut";

    public function index()
    {

        $branches = \BranchOfficesQuery::create()
            ->find();


        return view('app.daily_cut.main')
            ->with('branches', $branches->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function tableCash(Request $request){
        $day = $request->get('day');
        $filterBranchOffice = $request->get('filterBranchOffice',0);
        $criteria = Criteria::NOT_EQUAL;
        if($filterBranchOffice != 0){
            $criteria = Criteria::EQUAL;
        }


        $nextDay = strtotime ( '+1 day' , strtotime ( $day ) ) ;
        $nextDay = date ( 'Y-m-d' , $nextDay );

        $cashPayments = \OrderHistoryQuery::create()
            ->filterByIdPaymentMethod(1)
            ->filterByDeletedPayment(0)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->withColumn('Ord.Folio', 'FolioOrder')
                ->filterByIdBranchOffice($filterBranchOffice,$criteria)
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'SeriesBranch')
                ->endUse()
            ->endUse()
            ->useUsersQuery('Usr')
                ->withColumn('Usr.Name', 'NameUser')
            ->endUse()
            ->find();

        return view('app.daily_cut.tableCash')
            ->with('cashPayments', $cashPayments->toArray());
    }

    public function tableCard(Request $request){
        $day = $request->get('day');
        $filterBranchOffice = $request->get('filterBranchOffice',0);
        $criteria = Criteria::NOT_EQUAL;
        if($filterBranchOffice != 0){
            $criteria = Criteria::EQUAL;
        }

        $nextDay = strtotime ( '+1 day' , strtotime ( $day ) ) ;
        $nextDay = date ( 'Y-m-d' , $nextDay );

        $cardPayments = \OrderHistoryQuery::create()
            ->filterByIdPaymentMethod(2)
            ->filterByDeletedPayment(0)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->filterByIdBranchOffice($filterBranchOffice,$criteria)
                ->withColumn('Ord.Folio', 'FolioOrder')
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'SeriesBranch')
                ->endUse()
            ->endUse()
            ->useUsersQuery('Usr')
                ->withColumn('Usr.Name', 'NameUser')
            ->endUse()
            ->find();

        return view('app.daily_cut.tableCard')
            ->with('cardPayments', $cardPayments->toArray());
    }
    
    
    public function tableTransfer(Request $request){
        $day = $request->get('day');
        $filterBranchOffice = $request->get('filterBranchOffice',0);
        $criteria = Criteria::NOT_EQUAL;
        if($filterBranchOffice != 0){
            $criteria = Criteria::EQUAL;
        }

        $nextDay = strtotime ( '+1 day' , strtotime ( $day ) ) ;
        $nextDay = date ( 'Y-m-d' , $nextDay );

        $transferPayments = \OrderHistoryQuery::create()
            ->filterByIdPaymentMethod(4)
            ->filterByDeletedPayment(0)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->filterByIdBranchOffice($filterBranchOffice,$criteria)
                ->withColumn('Ord.Folio', 'FolioOrder')
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'SeriesBranch')
                ->endUse()
            ->endUse()
            ->useUsersQuery('Usr')
                ->withColumn('Usr.Name', 'NameUser')
            ->endUse()
            ->find();

        return view('app.daily_cut.tableTransfer')
            ->with('transferPayments', $transferPayments->toArray());
    }

    public function tableExpenses(Request $request){
        $day = $request->get('day');
        $filterBranchOffice = $request->get('filterBranchOffice',0);
        $criteria = Criteria::NOT_EQUAL;
        if($filterBranchOffice != 0){
            $criteria = Criteria::EQUAL;
        }


        $expenses = \ExpenseReportsQuery::create()
            ->filterByIdBranchOffice($filterBranchOffice,$criteria)
            ->useExpenseConceptsQuery('Concept')
                ->withColumn('Concept.Description', 'DescriptionConcept')
            ->endUse()
            ->useUsersQuery('User')
                ->withColumn('User.Name', 'NameUser')
            ->endUse()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Name', 'NameBranch')
            ->endUse()
            ->filterByDateExpense($day)
            ->orderByDateExpense('DESC')
            ->find();

        return view('app.daily_cut.tableExpenses')
            ->with('expenses', $expenses->toArray());
    }

    public function requestTotals(Request $request){
        $day = $request->get('day');
        $filterBranchOffice = $request->get('filterBranchOffice',0);
        $criteria = Criteria::NOT_EQUAL;
        if($filterBranchOffice != 0){
            $criteria = Criteria::EQUAL;
        }
        $nextDay = strtotime ( '+1 day' , strtotime ( $day ) ) ;
        $nextDay = date ( 'Y-m-d' , $nextDay );

        $cashPayments = \OrderHistoryQuery::create('Cash')
            ->select(array('TotalCash'))
            ->filterByIdPaymentMethod(1)
            ->filterByDeletedPayment(0)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->withColumn('Ord.Folio', 'FolioOrder')
                ->filterByIdBranchOffice($filterBranchOffice,$criteria)
            ->endUse()
            ->withColumn('SUM(Cash.AmountPaid)', 'TotalCash')
            ->groupByIdPaymentMethod()
            ->findOne();



        $cardPayments = \OrderHistoryQuery::create('Card')
            ->select(array('TotalCard'))
            ->filterByIdPaymentMethod(2)
            ->filterByDeletedPayment(0)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->filterByIdBranchOffice($filterBranchOffice,$criteria)
            ->withColumn('Ord.Folio', 'FolioOrder')
            ->endUse()
            ->withColumn('SUM(Card.AmountPaid)', 'TotalCard')
            ->groupByIdPaymentMethod()
            ->findOne();


        $transferPayments = \OrderHistoryQuery::create('Transfer')
            ->select(array('TotalTransfer'))
            ->filterByIdPaymentMethod(4)
            ->filterByDeletedPayment(0)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->filterByIdBranchOffice($filterBranchOffice,$criteria)
            ->withColumn('Ord.Folio', 'FolioOrder')
            ->endUse()
            ->withColumn('SUM(Transfer.AmountPaid)', 'TotalTransfer')
            ->groupByIdPaymentMethod()
            ->findOne();

        


        $expenses = \ExpenseReportsQuery::create('Exp')
            ->select(array('TotalExpense'))
            ->filterByIdBranchOffice($filterBranchOffice,$criteria)
            ->filterByDateExpense($day)
            ->withColumn('SUM(Exp.Amount)', 'TotalExpense')
            ->groupByDateExpense()
            ->findOne();

        $cash = isset($cashPayments['TotalCash']) ? $cashPayments['TotalCash'] : 0;
        $card = isset($cardPayments['TotalCard']) ? $cardPayments['TotalCard'] : 0;
        $transfer = isset($transferPayments['TotalTransfer']) ? $transferPayments['TotalTransfer'] : 0;

        $totalIncome = $cash+$card+$transfer;

        $response = array(
            "TotalCash" => number_format($cash, 2, '.', ','),
            "TotalCard" => number_format($card, 2, '.', ','),
            "TotalTransfer" => number_format($transfer, 2, '.', ','),
            "TotalIncome" => number_format($totalIncome, 2, '.', ','),
            "TotalExpense" => $expenses != null ? number_format($expenses, 2, '.', ',') : 0,
            "Total" => number_format($totalIncome-$expenses, 2, '.', ',')
        );

        // Log::info($response);

        return json_encode($response);

    }


    public function printDailyCut(Request $request, $branch, $day){
        // Log::info($day);
        // Log::info($branch);

        if($branch == 0){
            $criteria = Criteria::NOT_EQUAL;
            $branchOffice = array();
        }else{
            $criteria = Criteria::EQUAL;
            $branchOffice = \BranchOfficesQuery::create()
                ->findOneById($branch)
                ->toArray();
        }

        $nextDay = strtotime ( '+1 day' , strtotime ( $day ) ) ;
        $nextDay = date ( 'Y-m-d' , $nextDay );


        $cashPayments = \OrderHistoryQuery::create()
            ->filterByIdPaymentMethod(1)
            ->filterByDeletedPayment(0)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->withColumn('Ord.Folio', 'FolioOrder')
                ->filterByIdBranchOffice($branch,$criteria)
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'SeriesBranch')
                ->endUse()
            ->endUse()
            ->useUsersQuery('Usr')
                ->withColumn('Usr.Name', 'NameUser')
            ->endUse()
            ->find();

        $cardPayments = \OrderHistoryQuery::create()
            ->filterByIdPaymentMethod(2)
            ->filterByDeletedPayment(0)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->filterByIdBranchOffice($branch,$criteria)
                ->withColumn('Ord.Folio', 'FolioOrder')
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'SeriesBranch')
                ->endUse()
            ->endUse()
            ->useUsersQuery('Usr')
                ->withColumn('Usr.Name', 'NameUser')
            ->endUse()
            ->find();

        $expenses = \ExpenseReportsQuery::create()
            ->filterByIdBranchOffice($branch,$criteria)
            ->useExpenseConceptsQuery('Concept')
            ->withColumn('Concept.Description', 'DescriptionConcept')
            ->endUse()
            ->useUsersQuery('User')
                ->withColumn('User.Name', 'NameUser')
            ->endUse()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Name', 'NameBranch')
            ->endUse()
            ->filterByDateExpense($day)
            ->orderByDateExpense('DESC')
            ->find();


        $cashPaymentsTotal = \OrderHistoryQuery::create('Cash')
            ->select(array('TotalCash'))
            ->filterByIdPaymentMethod(1)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->withColumn('Ord.Folio', 'FolioOrder')
                ->filterByIdBranchOffice($branch,$criteria)
            ->endUse()
            ->withColumn('SUM(Cash.AmountPaid)', 'TotalCash')
            ->groupByIdPaymentMethod()
            ->findOne();



        $cardPaymentsTotal = \OrderHistoryQuery::create('Card')
            ->select(array('TotalCard'))
            ->filterByIdPaymentMethod(2)
            ->filterByCreatedAt($day, Criteria::GREATER_EQUAL)
            ->_and()
            ->filterByCreatedAt($nextDay, Criteria::LESS_THAN)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->useOrdersQuery('Ord')
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->filterByIdBranchOffice($branch,$criteria)
                ->withColumn('Ord.Folio', 'FolioOrder')
            ->endUse()
            ->withColumn('SUM(Card.AmountPaid)', 'TotalCard')
            ->groupByIdPaymentMethod()
            ->findOne();


            $expensesTotal = \ExpenseReportsQuery::create('Exp')
                ->select(array('TotalExpense'))
                ->filterByIdBranchOffice($branch,$criteria)
                ->filterByDateExpense($day)
                ->withColumn('SUM(Exp.Amount)', 'TotalExpense')
                ->groupByDateExpense()
                ->findOne();

            $totalIncome = $cashPaymentsTotal['TotalCash']+$cardPaymentsTotal['TotalCard'];

            $response = array(
                "TotalCash" => $cashPaymentsTotal['TotalCash'] != null ? $cashPaymentsTotal['TotalCash'] : 0 ,
                "TotalCard" => $cardPaymentsTotal['TotalCard'] != null ? $cardPaymentsTotal['TotalCard'] : 0,
                "TotalIncome" => $totalIncome,
                "TotalExpense" => $expensesTotal != null ? $expensesTotal : 0,
                "Total" => $totalIncome-$expensesTotal
            );
        try {

            $pdf = PDF::loadView('app/daily_cut/printDailyCut',
                [
                    'day' => $day,
                    'branch' => $branch,
                    'branchOffice' => $branchOffice,
                    'cashPayments' => $cashPayments->toArray(),
                    'cardPayments' => $cardPayments->toArray(),
                    'expenses' => $expenses->toArray(),
                    'totals' => $response
                ]);
            /*
            $pdf->setOptions([
                'isRemoteEnabled' => true,
                "isPhpEnabled" => true,
                "paper" => "letter",
                'orientation' => 'portrait'
            ]);
            */
            //$pdf->setPaper("letter", 'portrait');
            $pdf->setOptions(['isRemoteEnabled' => true]);
            //ini_set('max_execution_time', 120);
            $fileNamePdf = 'CorteDiario_' . $day .  '.pdf';
            //unlink(public_path() . "/tarjetasResguardo/{$fileNameTarjeta}");
            //$pdf->save(public_path() . "/tarjetasResguardo/{$fileNameTarjeta}");
            //return view('app/orders/printOrder')
            return $pdf->stream($fileNamePdf);
            //return $pdf->download($fileNamePdf);
            //return response()->download(public_path() . "/tarjetasResguardo/{$fileNameTarjeta}");

        }catch(\Exception $e){
            return 'message: ' . $e->getMessage() . ', file: ' . $e->getFile() . ', line: ' . $e->getLine();
            /*
            return json_encode(array(
                'success' => false,
                'errorMsg' => 'No se pudo crear la tarjeta de resguardo del bien, intentelo mas tarde.'
            ));
            */
        }
    }
}
