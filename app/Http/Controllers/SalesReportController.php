<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OrdersQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class SalesReportController extends Controller
{
    private $viewName = "sales_report";

    public function index()
    {
        $branches = \BranchOfficesQuery::create()
            ->find();

        return view('app.sales_report.main')
            ->with('branches', $branches->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function loadReportCategory(Request $request){
        $IdBranchOffice = $request->get('IdBranchOffice', 0);
        $startDay = $request->get('startDay');
        $endDay = $request->get('endDay');


        $criteria = Criteria::NOT_EQUAL;
        $textReport = "Reporte de gastos general";
        if($IdBranchOffice != 0){
            $criteria = Criteria::EQUAL;
            $branch = \BranchOfficesQuery::create()
                ->findOneById($IdBranchOffice);

            $textReport = "Reporte de ventas sucursal ".$branch->getName();
        }

        $sales = \OrderDetailQuery::create('Detail')
            ->select(array('name', 'y'))
            ->useServicesQuery('Serv')
                ->groupByIdServiceCategory()
                ->useServiceCategoriesQuery('ServCat')
                    ->withColumn('ServCat.Description', 'name')
                ->endUse()
            ->endUse()
            ->withColumn('CAST(SUM(Detail.Total) AS SIGNED)', 'y')
            ->useOrdersQuery()
                ->filterByIdBranchOffice($IdBranchOffice, $criteria)
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
            ->endUse()
            ->filterByCreatedAt(array('min'=> $startDay, 'max'=>$endDay))
            ->find()->toArray();



        $chartResultados =  array();
        foreach($sales as $sale){
            array_push($chartResultados, array(
                "y"=> intval($sale['y']),
                "name" => $sale['name']
            ));
        }

        return json_encode(["success" => true , "series" => $chartResultados, "textReport" => $textReport]);
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

            $textReport = "Reporte de ventas sucursal ".$branch->getName();
        }

        $sales = \OrderDetailQuery::create('Detail')
            ->select(array('name', 'y'))
            ->groupByIdService()
            ->useServicesQuery('Serv')
                ->withColumn('Serv.Description', 'name')
            ->endUse()
            ->withColumn('CAST(SUM(Detail.Total) AS SIGNED)', 'y')
            ->useOrdersQuery()
                ->filterByIdBranchOffice($IdBranchOffice, $criteria)
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
            ->endUse()
            ->filterByCreatedAt(array('min'=> $startDay, 'max'=>$endDay))
            ->orderBy('y', 'DESC')
            ->find()->toArray();



        $chartResultados =  array();
        foreach($sales as $sale){
            array_push($chartResultados, array(
                "y"=> intval($sale['y']),
                "name" => $sale['name']
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

        $sales = \OrderDetailQuery::create('Detail')
            ->groupByIdService()
            ->useServicesQuery('Serv')
                ->withColumn('Serv.Description', 'NameService')
            ->endUse()
            ->withColumn('CAST(SUM(Detail.Total) AS SIGNED)', 'Total')
            ->withColumn('CAST(COUNT(Detail.Total) AS SIGNED)', 'Cantidad')
            ->useOrdersQuery()
                ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
                ->filterByIdBranchOffice($IdBranchOffice, $criteria)
                ->groupByIdBranchOffice()
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Name', 'NameBranch')
                ->endUse()
            ->endUse()
            ->filterByCreatedAt(array('min'=> $filterStartDay, 'max'=>$filterEndDay))
            ->orderBy('Total', 'DESC')
            ->find()->toArray();

        return view('app.sales_report.table')
            ->with('sales', $sales);
    }

    public function table_best_clients(Request $request){
        $IdBranchOffice = $request->get('filterBranchOffice');
        $filterStartDay = $request->get('filterStartDay');
        $filterEndDay = $request->get('filterEndDay');

        $criteria = Criteria::NOT_EQUAL;
        if($IdBranchOffice != 0){
            $criteria = Criteria::EQUAL;
        }

        $sales = OrdersQuery::create('Orders')
            ->filterByIdOrderStatus(7, Criteria::NOT_EQUAL)
            ->filterByIdBranchOffice($IdBranchOffice, $criteria)
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Name', 'NameBranch')
            ->endUse()
            ->useUsersRelatedByIdClientUserQuery('U')
                ->withColumn('U.Name', 'NameClient')
            ->endUse()            
            ->withColumn('SUM(Orders.Total)', 'TotalClient')                   
            ->filterByCreatedAt(array('min'=> $filterStartDay, 'max'=>$filterEndDay))
            ->groupByIdUser()
            ->orderBy('TotalClient', 'DESC')
            ->find()->toArray();

        return view('app.sales_report.table_clients')
            ->with('sales', $sales);

    }
}
