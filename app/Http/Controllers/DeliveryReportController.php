<?php

namespace App\Http\Controllers;

use BranchOfficesQuery;
use DeliveriesQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OrderDetailQuery;
use OrdersQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use ServiceCategoriesQuery;

class DeliveryReportController extends Controller
{
    private $viewName = "delivery_report";
    private $view_path = "app.delivery_report.";

    public function index()
    {       
        $branches = BranchOfficesQuery::create()
            ->find();

        $serviceCategories = ServiceCategoriesQuery::create()
            ->find();

        return view($this->view_path.'main') 
            ->with('branches', $branches->toArray())          
            ->with('serviceCategories', $serviceCategories->toArray())          
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table_report_deliveries(Request $request){
        $filterBranchOffice = $request->get('filterBranchOffice');
        $filterCategory = $request->get('filterCategory');
        $filterStartDay = $request->get('filterStartDay');
        $filterEndDay = $request->get('filterEndDay');

        $criteria_branch = $filterBranchOffice == 0 ? Criteria::NOT_EQUAL : Criteria::EQUAL;
        $criteria_service = $filterCategory == 0 ? Criteria::NOT_EQUAL : Criteria::EQUAL;

        $orders = OrdersQuery::create()
        ->filterByDeliveryDate(array('min' => $filterStartDay, 'max' => $filterEndDay))
        ->filterByIdBranchOffice($filterBranchOffice, $criteria_branch)
        ->usePrioritiesQuery('Priority')
            ->withColumn('Priority.Description', 'PriorityDescription')
        ->endUse()
        ->useBranchOfficesQuery('Branch')
            ->withColumn('Branch.Series', 'Series')
            ->withColumn('Branch.Name', 'BranchName')
        ->endUse()
        ->useUsersRelatedByIdClientUserQuery('Client')
            ->withColumn('Client.Name', 'NameClient')
        ->endUse()
        ->find()
        ->toArray();

        for($i = 0;  $i < count($orders) ; $i++){
            $orders[$i]['order_details'] = OrderDetailQuery::create()
            ->filterByIdOrder($orders[$i]['Id'])
            ->useOrderDetailStatusQuery('Status')
                ->withColumn('Status.Description', 'DetailStatus')
                ->withColumn('Status.Color', 'Color')
            ->endUse()
            ->useColorsQuery('ColorPiece')
                ->withColumn('ColorPiece.Description', 'DescriptionColor')
                ->withColumn('ColorPiece.Code', 'Code')
            ->endUse()
            ->usePrintsQuery('Print')
                ->withColumn('Print.Description', 'DescriptionPrint')
            ->endUse()
            ->useDefectsQuery('Defect')
                ->withColumn('Defect.Description', 'DescriptionDefect')
            ->endUse()
            ->useServicesQuery('Service')
                ->filterByIdServiceCategory($filterCategory, $criteria_service)
                ->withColumn('Service.Description', 'DescriptionService')
                ->useServiceCategoriesQuery('Category')
                    ->withColumn('Category.Description', 'DescriptionCategory')
                ->endUse()
            ->endUse()
            ->useUsersQuery('DaliveryUser')
                ->withColumn('DaliveryUser.Name', 'NameDaliveryUser')
            ->endUse()
            ->find()
            ->toArray();
        }

        return view($this->view_path.'table')
            ->with('orders', $orders);
    }
    
    public function table_report_deliveries_old(Request $request){
        $filterBranchOffice = $request->get('filterBranchOffice');
        $filterCategory = $request->get('filterCategory');
        $filterStartDay = $request->get('filterStartDay');
        $filterEndDay = $request->get('filterEndDay');

        $criteria_branch = $filterBranchOffice == 0 ? Criteria::NOT_EQUAL : Criteria::EQUAL;
        $criteria_service = $filterCategory == 0 ? Criteria::NOT_EQUAL : Criteria::EQUAL;

        $deliveries = DeliveriesQuery::create()
            ->filterByDayDelivery(array('min' => $filterStartDay, 'max' => $filterEndDay))     
            ->useOrdersQuery('Ord')
                ->filterByIdBranchOffice($filterBranchOffice, $criteria_branch)
                ->withColumn('Ord.Folio', 'Folio') 
                ->usePrioritiesQuery('Priority')
                    ->withColumn('Priority.Description', 'PriorityDescription')
                ->endUse()
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'Series')
                    ->withColumn('Branch.Name', 'BranchName')
                ->endUse()
                ->useUsersRelatedByIdClientUserQuery('Client')
                    ->withColumn('Client.Name', 'NameClient')
                ->endUse()
            ->endUse()
            ->useUsersQuery('Assigned')
                ->withColumn('Assigned.Name', 'AssignedName')
            ->endUse()
            ->find()
            ->toArray();

        for($i = 0;  $i < count($deliveries) ; $i++){
            $deliveries[$i]['order_details'] = OrderDetailQuery::create()
            ->filterByIdOrder($deliveries[$i]['IdOrder'])
            ->useOrderDetailStatusQuery('Status')
                ->withColumn('Status.Description', 'DetailStatus')
                ->withColumn('Status.Color', 'Color')
            ->endUse()
            ->useColorsQuery('ColorPiece')
                ->withColumn('ColorPiece.Description', 'DescriptionColor')
                ->withColumn('ColorPiece.Code', 'Code')
            ->endUse()
            ->usePrintsQuery('Print')
                ->withColumn('Print.Description', 'DescriptionPrint')
            ->endUse()
            ->useDefectsQuery('Defect')
                ->withColumn('Defect.Description', 'DescriptionDefect')
            ->endUse()
            ->useServicesQuery('Service')
                ->filterByIdServiceCategory($filterCategory, $criteria_service)
                ->withColumn('Service.Description', 'DescriptionService')
                ->useServiceCategoriesQuery('Category')
                    ->withColumn('Category.Description', 'DescriptionCategory')
                ->endUse()
            ->endUse()
            ->useUsersQuery('DaliveryUser')
                ->withColumn('DaliveryUser.Name', 'NameDaliveryUser')
            ->endUse()
            ->find()
            ->toArray();
        }

        return view($this->view_path.'table')
            ->with('deliveries', $deliveries);
    }
}
