<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OrdersQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class RankingController extends Controller
{
    private $viewName = "ranking";

    public function index(){
        $branches = \BranchOfficesQuery::create()
            ->find();

        return view('app.ranking.main')
            ->with('branches', $branches->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){
        $rank = OrdersQuery::create()
        ->withColumn('ROUND( AVG(rank),2 )', 'Prom')
        ->filterByQualified(1)
        ->useBranchOfficesQuery('Branch')
            ->withColumn('Branch.Name', 'NameBranch')
        ->endUse('')
        ->groupBy('NameBranch')
        ->find();

        return view('app.ranking.table')
            ->with('rank', $rank->toArray());
    }

    public function tableComments(Request $request){
        $cve = $request->get('cve');

        $criteriaBranch = $cve == 0 ? Criteria::NOT_EQUAL : Criteria::EQUAL;

        $orders = OrdersQuery::create()
        ->filterByQualified(1)
        ->filterByIdBranchOffice($cve, $criteriaBranch)
        ->useBranchOfficesQuery('Branch')
            ->withColumn('Branch.Name', 'NameBranch')
            ->withColumn('Branch.Series', 'Series')
        ->endUse('')
        ->orderByCreatedAt('DESC')
        ->limit(50)
        ->find();

        return view('app.ranking.tableComments')
            ->with('orders', $orders->toArray());
    }
}
