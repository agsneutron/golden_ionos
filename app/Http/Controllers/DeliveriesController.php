<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DeliveriesQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OrderDetailQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Validator;

class DeliveriesController extends Controller
{
    private $viewName = "deliveries";

    public function index()
    {
        $branches = \BranchOfficesQuery::create()
            ->find();

        $users = \UsersQuery::create()
            ->filterByIdUserType(5)
            ->find();

        // $users = array();

        $orders = \OrdersQuery::create()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Series', 'Series')
            ->endUse()
            ->useUsersRelatedByIdClientUserQuery('Cli')
                ->withColumn('Cli.Name', 'NameClient')
            ->endUse()
            ->filterByIdOrderStatus(array(2,3,4,5))
            ->find();

        // Log::info($branches->toArray());
        // Log::info($users->toArray());
        // Log::info($orders->toArray());

        $orders = $orders->toArray();
        // $orders = array();

        return view('app.deliveries.main')
            ->with('orders', $orders)
            ->with('users', $users->toArray())
            ->with('branches', $branches->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function searchDeliveries(Request $request){
        $cve = $request->get('cve');
        $status = $request->get('status');
        $start = $request->get('filterStartDay');
        $end = $request->get('filterEndDay');

        $criteria = Criteria::NOT_EQUAL;
        if($cve != 0){
            $criteria = Criteria::EQUAL;
        }

        $criteriaStatus = $status == 2 ? Criteria::NOT_EQUAL : Criteria::EQUAL;


        $deliveries = \DeliveriesQuery::create()
            ->filterByDayDelivery(array('min' => $start, 'max' => $end))
            ->withColumn("CONCAT(day_delivery,'T','12:00:00')",'start')
            ->withColumn("CONCAT(day_delivery,'T','13:00:00')",'end')
            ->withColumn("CONCAT('#37B7CF','')", 'color')
            ->withColumn("CONCAT('#373943','')", 'textColor')
            ->filterByStatus($status, $criteriaStatus)
            ->useOrdersQuery('Ord')
                ->filterByIdBranchOffice($cve, $criteria)
                ->filterByIdOrderStatus(5, Criteria::LESS_EQUAL)
                ->withColumn('Ord.Folio', 'Folio')
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'Series')
                ->endUse()
                ->useUsersRelatedByIdClientUserQuery('Client')
                    ->withColumn('Client.Name', 'NameClient')                    
                ->endUse()
            ->endUse()
            ->withColumn("CONCAT(Series,'-',Folio,' > ',Client.Name)", 'title');


        $deliveries = $deliveries->find()->toArray();
        for($i=0; $i < count($deliveries); $i++){
            $deliveries[$i]['allDay'] = false;
            if($deliveries[$i]['Status'] == 1){
                $deliveries[$i]['color'] = "#9DCA48";
            }
        }

        // $deliveries = array();

        return json_encode(Array(
            "success" => true,
            "errorMsg" => "",
            "events" => $deliveries
        ));
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $delivery = DeliveriesQuery::create()
        ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $delivery->toArray()
        ));

    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormDelivery($request);
        if ( empty($arrayErrores) ) {
            $IdBranchOffice = $request->get('IdBranchOffice');
            $Id = $request->get('Id');
            $IdOrder = $request->get('IdOrder');
            $IdAssignedUser = $request->get('IdAssignedUser');
            $DayDelivery = $request->get('DayDelivery');
            $Comments = $request->get('Comments');


            $delivery = DeliveriesQuery::create()
            ->filterById($Id, Criteria::NOT_EQUAL)
            ->findOneByIdOrder($IdOrder);

            if($delivery != null){
                return ["success" => false, "errorMsg" => "Ya exite una entrega programada para la orden seleccionada para el día ".$delivery->getDayDelivery()];
            }

            $now = Carbon::now();
            if($Id == 0){
                $delivery = new \Deliveries();
                $delivery->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $delivery = \DeliveriesQuery::create()
                    ->findOneById($Id);
                $delivery->setUpdatedAt($now);
            }

            $delivery->setIdOrder($IdOrder)
                ->setIdAssignedUser($IdAssignedUser)
                ->setDayDelivery($DayDelivery)
                ->setComments($Comments)
                ->save();


            return ['success' => true, 'errorMsg' => 'Entrega registrada correctamente'];
        }else{
            return ["success" => false, "errorMsg" => $arrayErrores[0]];
        }
    }

    public function loadTableDeliveries(Request $request){
        $cve = $request->get('cve');
        $status = $request->get('status');
        $dia = $request->get('dia');

        $criteria = Criteria::NOT_EQUAL;
        if($cve != 0){
            $criteria = Criteria::EQUAL;
        }

        $criteriaStatus = $status == 2 ? Criteria::NOT_EQUAL : Criteria::EQUAL;

        $deliveries = \DeliveriesQuery::create()
            ->filterByDayDelivery($dia)
            ->filterByStatus($status, $criteriaStatus)
            ->useOrdersQuery('Ord')
                ->filterByIdBranchOffice($cve, $criteria)
                ->filterByIdOrderStatus(5, Criteria::LESS_EQUAL)
                ->withColumn('Ord.Folio', 'Folio')
                ->withColumn('Ord.Total', 'Total')
                ->withColumn('Ord.AmountPaid', 'AmountPaid')
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'Series')
                    ->withColumn('Branch.Name', 'NameBranch')
                ->endUse()
                ->useOrderStatusQuery('Status')
                    ->withColumn('Status.Description', 'OrderStatus')
                ->endUse()
                ->useUsersRelatedByIdClientUserQuery('Client')
                    ->withColumn('Client.Name', 'NameClient')
                    ->withColumn('Client.Address', 'AddressClient')
                    ->withColumn('Client.Phone', 'PhoneClient')
                    ->withColumn('Client.Suburb', 'SuburbClient')
                ->endUse()
            ->endUse()
            ->find();

        return view('app.deliveries.table')
            ->with('deliveries', $deliveries->toArray());
    }

    public function valdateFormDelivery(Request $request){
        $reglas = [
            'IdOrder' => 'required|numeric|min:1',
            'IdAssignedUser' => 'required|numeric|min:1',
            'DayDelivery' => 'required',
            'Comments' => 'required',
        ];

        $mensajes = [
            'IdOrder.required' => 'Selecciona una orden para entrega',
            'IdOrder.numeric' => 'Selecciona una orden para entrega',
            'IdOrder.min' => 'Selecciona una orden para entrega',
            'IdAssignedUser.required' => 'Selecciona un repartodor',
            'IdAssignedUser.numeric' => 'Selecciona un repartidor',
            'IdAssignedUser.min' => 'Selecciona un repartidor',
            'DayDelivery.required' => 'selecciona la fecha de entrega',
            'Comments.required' => 'Ingresa los comentarios',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function cancelDelivery(Request $request){
        $cve = $request->get('cve');

        Log::info($request->all());

        $delivery = DeliveriesQuery::create()
        ->findOneById($cve);

        if($delivery != null){
            $delivery->delete();
        }

        return json_encode(['success' => true, 'errorMsg' => 'Entrega eliminada correctamente']);
    }


    public function completeDelivery(Request $request){
        $cve = $request->get('cve');

        Log::info($request->all());

        $delivery = DeliveriesQuery::create()
        ->findOneById($cve);

       $order = $delivery->getOrders();

       $delivery->setStatus(1)
       ->save();

       $order->setIdOrderStatus(6)
       ->save();

       $details = OrderDetailQuery::create()
       ->filterByIdOrder($order->getId())
       ->update(array('IdOrderDetailStatus' => '5'));

        return json_encode(['success' => true, 'errorMsg' => 'La orden '.$order->getBranchOffices()->getSeries().'-'.$order->getFolio().' ha sido registrada como entregada']);
    }


    /*
        API METHODS
    */

    public function getDeliveries(Request $request){
        $userId = $request->get('userId');
        $dateDeliveries = $request->get('dateDeliveries');

        $deliveries = \DeliveriesQuery::create()
            ->filterByIdAssignedUser($userId)
            ->filterByDayDelivery($dateDeliveries)
            ->useOrdersQuery('Ord')
                ->withColumn('Ord.Folio', 'Folio')
                ->withColumn('Ord.IdOrderStatus', 'IdStatus')
                ->withColumn('Ord.ReceptionDate', 'ReceptionDate')
                ->withColumn('Ord.ReceptionTime', 'ReceptionTime')
                ->withColumn('Ord.Total', 'Total')
                ->withColumn('Ord.AmountPaid', 'AmountPaid')
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'Serie')
                    ->withColumn('Branch.Name', 'NameBranch')
                ->endUse()
                ->useOrderStatusQuery('Status')
                    ->withColumn('Status.Description', 'DescriptionStatus')
                ->endUse()
                ->useUsersRelatedByIdClientUserQuery('Client')
                    ->withColumn('Client.Name', 'NameClient')
                    ->withColumn('Client.Address', 'AddressClient')
                    ->withColumn('Client.Phone', 'PhoneClient')
                ->endUse()
            ->endUse()
            ->find()->toArray();

            for($i = 0; $i < count($deliveries); $i++){
                $deliveries[$i]['Items'] = OrderDetailQuery::create()
                ->filterByIdOrder($deliveries[$i]['IdOrder'])
                ->useOrderDetailStatusQuery('Status')
                    ->withColumn('Status.Description', 'DetailStatus')
                    ->withColumn('Status.Color', 'ColorStatus')
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
                    ->withColumn('Service.Description', 'DescriptionService')
                    ->useServiceCategoriesQuery('Category')
                        ->withColumn('Category.Description', 'DescriptionCategory')
                    ->endUse()
                ->endUse()
                ->find()->toArray();

                $deliveries[$i]['Unsaved'] = 0;
            }

            return response()->json(['deliveries' => $deliveries], 200);
    }

    public function saveDeliveryCompleted(Request $request){
        $data = $request->get('delivery');

        $photo = is_null($data['DeliveryPhoto']) ? "" : $data['DeliveryPhoto'];
        $signature = is_null($data['DeliveryContactSignature']) ? "" : $data['DeliveryContactSignature'];

        $delivery = DeliveriesQuery::create()
        ->findOneById($data['Id']);

        $order = $delivery->getOrders();

        $delivery->setRealDeliveryDate($data['RealDeliveryDate'])
        ->setRealDeliveryTime($data['RealDeliveryTime'])
        ->setDeliveryComments($data['DeliveryComments'])
        ->setDeliveryContactName($data['DeliveryContactName'])
        ->setDeliveryContactSignature($signature)
        ->setDeliveryPhoto($photo)
        ->setStatus(1)
        ->save();

        $order->setRealDeliveryDate($data['RealDeliveryDate'])
        ->setRealDeliveryTime($data['RealDeliveryTime'])
        ->setDeliveryComments($data['DeliveryComments'])
        ->setDeliveryContactName($data['DeliveryContactName'])
        ->setDeliveryContactSignature($signature)
        ->setDeliveryPhoto($photo)
        ->setIdOrderStatus(6)
        ->save();

        return ['success' => true, 'errorMsg' => 'Entrega completa'];
    }


    public function pendingDeliveries(){

        $yesterday = date('Y-m-d', strtotime('-1 day')) ;
        $deliveries = DeliveriesQuery::create()
        ->filterByDayDelivery($yesterday)
        ->filterByStatus(0)
        ->update(array('DayDelivery' => date('Y-m-d')));
    }
}
