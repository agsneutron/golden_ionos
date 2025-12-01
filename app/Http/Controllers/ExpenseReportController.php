<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Propel\Runtime\ActiveQuery\Criteria;

class ExpenseReportController extends Controller
{
    private $viewName = "expense_report";

    public function index()
    {
        $branches = \BranchOfficesQuery::create()
            ->find();

        return view('app.expense_report.main')
            ->with('branches', $branches->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }


    public function loadReport(Request $request){
        $IdBranchOffice = $request->get('IdBranchOffice', 0);
        $startDay = $request->get('startDay');
        $endDay = $request->get('endDay');


        $criteria = Criteria::NOT_EQUAL;
        $textReport = "Reporte de gastos general";
        if($IdBranchOffice != 0){
            $criteria = Criteria::EQUAL;
            $branch = \BranchOfficesQuery::create()
                ->findOneById($IdBranchOffice);

            $textReport = "Reporte de gastos sucursal ".$branch->getName();
        }

        $expenses = \ExpenseReportsQuery::create()
            ->select(array('name', 'y'))
            ->groupByIdExpenseConcept()
            ->useExpenseConceptsQuery('Concept')
                ->withColumn('Concept.Description', 'name')
            ->endUse()
            ->withColumn('CAST(SUM(AMOUNT) AS SIGNED)', 'y')
            ->filterByIdBranchOffice($IdBranchOffice, $criteria)
            ->filterByDateExpense(array('min'=> $startDay, 'max'=>$endDay))
            ->find()->toArray();



        $chartResultados =  array();
        foreach($expenses as $expense){
            array_push($chartResultados, array(
                "y"=> intval($expense['y']),
                "name" => $expense['name']
            ));
        }

        return json_encode(["success" => true , "series" => $chartResultados, "textReport" => $textReport]);
    }

    public function table(Request $request){
        $IdBranchOffice = $request->get('filterBranchOffice');
        $filterStartDay = $request->get('filterStartDay');
        $filterEndDay = $request->get('filterEndDay');

        $criteria = Criteria::NOT_EQUAL;
        if($IdBranchOffice != 0){
            $criteria = Criteria::EQUAL;
        }

        $expenses = \ExpenseReportsQuery::create()
            ->useExpenseConceptsQuery('Concept')
            ->withColumn('Concept.Description', 'DescriptionConcept')
            ->endUse()
            ->useUsersQuery('User')
            ->withColumn('User.Name', 'NameUser')
            ->endUse()
            ->useBranchOfficesQuery('Branch')
            ->withColumn('Branch.Name', 'NameBranch')
            ->endUse()
            ->filterByIdBranchOffice($IdBranchOffice, $criteria)
            ->filterByDateExpense(array(
                'min' => $filterStartDay,
                'max' => $filterEndDay
            ))
            ->orderByDateExpense('DESC')->find();

        return view('app.expense_report.table')
            ->with('expenses', $expenses->toArray());
    }
}
