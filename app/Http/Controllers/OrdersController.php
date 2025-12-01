<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Propel\Runtime\ActiveQuery\Criteria;
use Barryvdh\DomPDF\Facade as PDF;
use CalendarQuery;
use ColorsQuery;
use Deliveries;
use DeliveriesQuery;
use Dompdf\Dompdf;
use Dompdf\Options;
use ElectronicPurse;
use ElectronicPurseHistory;
use ElectronicPurseQuery;
use OrderDetailQuery;
use OrderHistoryQuery;
use OrdersQuery;
use Validator;
use Openpay;
use OpenpayApiAuthError;
use OpenpayApiConnectionError;
use OpenpayApiError;
use OpenpayApiRequestError;
use OpenpayApiTransactionError;
use PickupsQuery;
use ServiceCategoriesQuery;
use UsersQuery;
use Illuminate\Support\Facades\DB; 


class OrdersController extends Controller
{
    //Produccion
    protected $merchanId = "mbrtnmgtpwlgemfzmejw";
    protected $privateKey = "sk_bd207dd86c784e13b21f4b900f5512dd";

    private $viewName = "orders";

    public $docenas = array(264,266,445,447,586,588,591,594,595,607);

    public $mediasDocenas = array(263,265,444,446,585,587,590,593,596,606);

    public function index(){

        $branches = \BranchOfficesQuery::create()
            ->find();

        $status = \OrderStatusQuery::create()
            ->find();

        $clients = \UsersQuery::create()
            ->filterByIdUserType(4)
            ->find();

        $priorities = \PrioritiesQuery::create()
            ->find();

        $paymentMethods = \PaymentMethodsQuery::create()
            ->find();

        $users = \UsersQuery::create()
            ->filterByIdUserType(5)
            ->find();

        return view('app.orders.main')
            ->with('status', $status->toArray())
            ->with('branches', $branches->toArray())
            ->with('users', $users->toArray())
            ->with('clients', $clients->toArray())
            ->with('priorities', $priorities->toArray())
            ->with('paymentMethods', $paymentMethods->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function searchOrders(Request $request){
        $filterBranchOffice = $request->get('filterBranchOffice');
        $filterStatus = $request->get('filterStatus');
        $filterStartDay = $request->get('filterStartDay');
        $filterEndDay = $request->get('filterEndDay');

        $orders = \OrdersQuery::create()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Series', 'Series')
            ->endUse()
            ->useOrderStatusQuery('Status')
                ->withColumn('Status.Description', 'OrderStatus')
                ->withColumn('Status.Color', 'Color')
            ->endUse()
            ->usePrioritiesQuery('Priority')
                ->withColumn('Priority.Description', 'DescriptionPriority')
            ->endUse()
            ->useUsersRelatedByIdClientUserQuery('Client')
                ->withColumn('Client.Name', 'NameClient')
            ->endUse()
            ->useUsersRelatedByIdDeliveryUserQuery('DaliveryUser')
                ->withColumn('DaliveryUser.Name', 'NameDaliveryUser')
            ->endUse()
            ->filterByReceptionDate(array(
                'min' => $filterStartDay,
                'max' => $filterEndDay
            ))
            ->orderByReceptionDate('DESC')
            ->orderByReceptionTime('DESC');

        if($filterBranchOffice != 0){
            $orders->filterByIdBranchOffice($filterBranchOffice);
        }

        if($filterStatus != 0){
            $orders->filterByIdOrderStatus($filterStatus);
        }

        $orders = $orders->find();

        return view('app.orders.table')
            ->with('orders', $orders->toArray());
    }

    public function loadDetailOrder(Request $request){
        $cve = $request->get('cve');

        Log::info("Order-->".$cve);

        $order = OrdersQuery::create()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Series', 'Series')
            ->endUse()
            ->useOrderStatusQuery('Status')
                ->withColumn('Status.Description', 'OrderStatus')
                ->withColumn('Status.Color', 'Color')
            ->endUse()
            ->usePrioritiesQuery('Priority')
                ->withColumn('Priority.Description', 'DescriptionPriority')
            ->endUse()
            ->useUsersRelatedByIdClientUserQuery('Client')
                ->withColumn('Client.Name', 'NameClient')
            ->endUse()
            ->useUsersRelatedByIdDeliveryUserQuery('DaliveryUser')
                ->withColumn('DaliveryUser.Name', 'NameDaliveryUser')
            ->endUse()
            ->findOneById($cve);

        $havePurse = 0;
        $purse = ElectronicPurseQuery::create()
            ->findOneByIdClientUser($order->getIdClientUser());
        if($purse != null){
            $havePurse = 1;
            $purse = $purse->toArray();
        }else{
            $purse = array();
        }

        $serviceCategories = ServiceCategoriesQuery::create()
            ->find();

        $colors = ColorsQuery::create()
            ->filterById(1,Criteria::NOT_EQUAL)
            ->orderByDescription()
            ->find();

        $prints = \PrintsQuery::create()
            ->filterById(1,Criteria::NOT_EQUAL)
            ->orderByDescription()
            ->find();

        $defects = \DefectsQuery::create()
            ->filterById(1,Criteria::NOT_EQUAL)
            ->orderByDescription()
            ->find();

        $status = \OrderDetailStatusQuery::create()
            //->filterById(4, Criteria::LESS_EQUAL)
            ->find();

        $paymentMethods = \PaymentMethodsQuery::create()
            ->find();

        $deliveries = DeliveriesQuery::create()
        ->filterByIdOrder($cve)
        ->useUsersQuery('Assigned')
            ->withColumn('Assigned.Name', 'AssignedName')
        ->endUse()
        ->find();

        return view('app.orders.detailOrder')
            ->with('serviceCategories', $serviceCategories->toArray())
            ->with('colors', $colors->toArray())
            ->with('prints', $prints->toArray())
            ->with('defects', $defects->toArray())
            ->with('status', $status->toArray())
            ->with('deliveries', $deliveries->toArray())
            ->with('purse', $purse)
            ->with('havePurse', $havePurse)
            ->with('paymentMethods', $paymentMethods->toArray())
            ->with('order', $order->toArray());
    }
    
    public function view_order(Request $request, $uid){
        $cve = $uid;

        $order = \OrdersQuery::create()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Series', 'Series')
            ->endUse()
            ->useOrderStatusQuery('Status')
                ->withColumn('Status.Description', 'OrderStatus')
                ->withColumn('Status.Color', 'Color')
            ->endUse()
            ->usePrioritiesQuery('Priority')
                ->withColumn('Priority.Description', 'DescriptionPriority')
            ->endUse()
            ->useUsersRelatedByIdClientUserQuery('Client')
                ->withColumn('Client.Name', 'NameClient')
            ->endUse()
            ->useUsersRelatedByIdDeliveryUserQuery('DaliveryUser')
                ->withColumn('DaliveryUser.Name', 'NameDaliveryUser')
            ->endUse()
            ->findOneById($cve);

        $havePurse = 0;
        $purse = \ElectronicPurseQuery::create()
            ->findOneByIdClientUser($order->getIdClientUser());
        if($purse != null){
            $havePurse = 1;
            $purse = $purse->toArray();
        }else{
            $purse = array();
        }

        $serviceCategories = \ServiceCategoriesQuery::create()
            ->find();

        $colors = \ColorsQuery::create()
            ->filterById(1,Criteria::NOT_EQUAL)
            ->orderByDescription()
            ->find();

        $prints = \PrintsQuery::create()
            ->filterById(1,Criteria::NOT_EQUAL)
            ->orderByDescription()
            ->find();

        $defects = \DefectsQuery::create()
            ->filterById(1,Criteria::NOT_EQUAL)
            ->orderByDescription()
            ->find();

        $status = \OrderDetailStatusQuery::create()
            //->filterById(4, Criteria::LESS_EQUAL)
            ->find();

        $paymentMethods = \PaymentMethodsQuery::create()
            ->find();

        $deliveries = DeliveriesQuery::create()
        ->filterByIdOrder($cve)
        ->find();

        return view('app.orders.detailOrder')
            ->with('serviceCategories', $serviceCategories->toArray())
            ->with('colors', $colors->toArray())
            ->with('prints', $prints->toArray())
            ->with('defects', $defects->toArray())
            ->with('status', $status->toArray())
            ->with('deliveries', $deliveries->toArray())
            ->with('purse', $purse)
            ->with('havePurse', $havePurse)
            ->with('paymentMethods', $paymentMethods->toArray())
            ->with('order', $order->toArray());
    }

    public function loadClients(){

        $clients = \UsersQuery::create()
            ->select(array('Id','Name', 'Address'))
            ->filterByIdUserType(4)
            ->find();

        return response()->json($clients->toArray());
    }

    public function loadServices(Request $request){
        $idCategory = $request->get('idCategory');

        $services = \ServicesQuery::create()
            ->select(array('Id','Description'))
            ->filterByIdServiceCategory($idCategory)
            ->orderByDescription()
            ->find();

        return response()->json($services->toArray());
    }

    public function loadTableDetailOrder(Request $request){
        $cve = $request->get('cve');
        $order = \OrdersQuery::create()
            ->findOneById($cve);
        $orderDetail = \OrderDetailQuery::create()
            ->filterByIdOrder($cve)
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
                ->withColumn('Service.Description', 'DescriptionService')
            ->endUse()
            ->useUsersQuery('DaliveryUser')
                ->withColumn('DaliveryUser.Name', 'NameDaliveryUser')
            ->endUse()
            ->find();

        return view('app.orders.tableDetail')
            ->with('order', $order->toArray())
            ->with('details', $orderDetail->toArray());
    }

    public function loadTablePaymentsOrder(Request $request){
        $cve = $request->get('cve');

        if(Auth::user()->id_user_type < 3){
            $orderHistory = \OrderHistoryQuery::create()
                ->filterByIdOrder($cve)
                ->filterByAmountPaid(0, Criteria::GREATER_THAN)
                ->usePaymentMethodsQuery('Payment')
                    ->withColumn('Payment.Description', 'DescriptionPayment')
                ->endUse()
                ->useOrdersQuery('Ord')
                    ->withColumn('Ord.IdOrderStatus', 'OrderStatus')
                ->endUse()
                ->find();
        }else{
            $orderHistory = \OrderHistoryQuery::create()
                ->filterByIdOrder($cve)
                ->filterByDeletedPayment(0)
                ->filterByAmountPaid(0, Criteria::GREATER_THAN)
                ->usePaymentMethodsQuery('Payment')
                    ->withColumn('Payment.Description', 'DescriptionPayment')
                ->endUse()
                ->useOrdersQuery('Ord')
                    ->withColumn('Ord.IdOrderStatus', 'OrderStatus')
                ->endUse()
                ->find();
        }

        return view('app.orders.tablePayments')
            ->with('payments', $orderHistory->toArray());

    }

    public function savePaymentMethod(Request $request){
        $IdPayment = $request->get('IdPayment');
        $IdNewPaymentMethod = $request->get('IdNewPaymentMethod');

        $payment = OrderHistoryQuery::create()
        ->findOneById($IdPayment);
        
        $payment->setIdPaymentMethod($IdNewPaymentMethod)
        ->save();

        return json_encode(["success" => true, "errorMsg" => 'Método de pago actualizado']);
    }

    public function deletePayment(Request $request){
        $cve = $request->get('cve');

        $orderHistory = \OrderHistoryQuery::create()
            ->findOneById($cve);

        $order = $orderHistory->getOrders();
        $order->setAmountPaid($order->getAmountPaid() - $orderHistory->getAmountPaid())
            ->save();

        $orderHistory->setDeletedPayment(1)
            ->save();

        return json_encode(["success" => true, "errorMsg" => 'Pago eliminado correctamente']);

    }

    public function editDetail(Request $request){
        $cve = $request->get('cve');
        $IdColor = $request->get('IdColor1');
        $IdPrint = $request->get('IdPrint1');
        $IdDefect = $request->get('IdDefect1');

        $detail = \OrderDetailQuery::create('Detail')
            ->withColumn('Detail.Id', 'IdDetailOrder')
            ->withColumn('Detail.IdColor', 'IdColor1')
            ->withColumn('Detail.IdPrint', 'IdPrint1')
            ->withColumn('Detail.IdDefect', 'IdDefect1')
            ->useServicesQuery('Service')
                ->withColumn('Service.IdServiceCategory','IdServiceCategory')
            ->endUse()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $detail->toArray()
        ));
    }

    public function requestDeliveryDate(Request $request){
        $IdPriority = $request->get('IdPriority');

        switch ($IdPriority){
            case 1:
                $currentDate = date('Y-m-d');
                $DeliveryDate = strtotime ( '+2 day' , strtotime ( $currentDate ) ) ;
                $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );
                break;
            case 2:
                $currentDate = date('Y-m-d');
                $DeliveryDate = strtotime ( '+1 day' , strtotime ( $currentDate ) ) ;
                $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );
                break;
            case 3:
                if(strtotime(date('H:m')) < strtotime("12:00")){
                    $DeliveryDate = date('Y-m-d');
                }else{
                    $IdPriority = 2;
                    $currentDate = date('Y-m-d');
                    $DeliveryDate = strtotime ( '+1 day' , strtotime ( $currentDate ) ) ;
                    $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );
                }
                break;
        }

        $calendar = \CalendarQuery::create()
            ->findOneByDay($DeliveryDate);
        if($calendar->getWeekday() == 1){
            $currentDate = $calendar->getDay();
            $DeliveryDate = strtotime ( '+1 day' , strtotime ( $currentDate ) ) ;
            $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );
            $calendar = \CalendarQuery::create()
                ->findOneByDay($DeliveryDate);
        }
        $nameDay = $calendar->getName();

        return json_encode(['deliveryDate' => $DeliveryDate, 'nameDay' => $nameDay]);
    }

    public function requestPrice(Request $request){
        $IdPriorityOrder = $request->get('IdPriorityOrder');
        $IdService = $request->get('IdService');

        if(($IdPriorityOrder == 3) && strtotime(date('H:m')) >= strtotime("12:00")){
            $IdPriorityOrder = 2;
        }
        $factor = 1;
        switch ($IdPriorityOrder){
            case 1:
                $factor = 1;
                break;
            case 2:
                $factor = 1.25;
                break;
            case 3:
                $factor = 1.5;
                break;
        }

        $price = \ServicesQuery::create()
            ->findOneById($IdService);

        if($price != null){

            $itemPrice = $price->getNormalPrice() * $factor;

            return json_encode(["success" => true, "price" => number_format($itemPrice,2,'.','')]);
        }

        return json_encode(["success" => false]);
    }

    public function requestRemaining(Request $request){
        $cve = $request->get('cve');

        $order = \OrdersQuery::create()
            ->findOneById($cve);

        return json_encode([
            "total" => $order->getTotal(),
            "amountPaid" => $order->getAmountPaid(),
            "remaining" => $order->getTotal()-$order->getAmountPaid()
        ]);
    }

    public function requestIndicators(Request $request){
        $filterBranchOffice = $request->get('filterBranchOffice');
        $filterStatus = $request->get('filterStatus');

        //ORDENES RECIBIDAS HOY
        $ordersRecivedToday = \OrdersQuery::create()
            ->filterByReceptionDate(date('Y-m-d'))
            ->filterByIdOrderStatus(7, Criteria::LESS_THAN)
            ->withColumn('SUM(IF(id_priority = 1, 1, 0))', 'RecivedTodayNormal')
            ->withColumn('SUM(IF(id_priority = 2, 1, 0))', 'RecivedTodayUrgen')
            ->withColumn('SUM(IF(id_priority = 3, 1, 0))', 'RecivedTodayExtra')
            ->groupByReceptionDate();

        if($filterBranchOffice != 0){
            $ordersRecivedToday->filterByIdBranchOffice($filterBranchOffice);
        }

        if($filterStatus != 0){
            $ordersRecivedToday->filterByIdOrderStatus($filterStatus);
        }

        $ordersRecivedToday = $ordersRecivedToday->findOne();

        if($ordersRecivedToday == null){
            $ordersRecivedToday = array(
                'RecivedTodayNormal' => 0,
                'RecivedTodayUrgen' => 0,
                'RecivedTodayExtra' => 0,
            );
        }else{
            $ordersRecivedToday = $ordersRecivedToday->toArray();
        }

        //ORDENES ATRASADAS
        $backorders = \OrdersQuery::create()
            ->filterByDeliveryDate(date('Y-m-d'),Criteria::LESS_THAN)
            ->filterByIdOrderStatus(7, Criteria::LESS_THAN)
            ->withColumn('SUM(IF(id_priority = 1, 1, 0))', 'BackorderNormal')
            ->withColumn('SUM(IF(id_priority = 2, 1, 0))', 'BackorderUrgen')
            ->withColumn('SUM(IF(id_priority = 3, 1, 0))', 'BackorderExtra')
            ->groupByReceptionDate();

        if($filterBranchOffice != 0){
            $backorders->filterByIdBranchOffice($filterBranchOffice);
        }

        if($filterStatus != 0){
            $backorders->filterByIdOrderStatus($filterStatus);
        }

        $backorders = $backorders->findOne();

        if($backorders == null){
            $backorders = array(
                'BackorderNormal' => 0,
                'BackorderUrgen' => 0,
                'BackorderExtra' => 0,
            );
        }else{
            $backorders = $backorders->toArray();
        }


        //ORDENES PARA ENTREGAR HOY
        $ordersDeliveredToday = \OrdersQuery::create()
            ->filterByDeliveryDate(date('Y-m-d'))
            ->filterByIdOrderStatus(7, Criteria::LESS_THAN)
            ->withColumn('SUM(IF(id_priority = 1, 1, 0))', 'DeliveredTodayNormal')
            ->withColumn('SUM(IF(id_priority = 2, 1, 0))', 'DeliveredTodayUrgen')
            ->withColumn('SUM(IF(id_priority = 3, 1, 0))', 'DeliveredTodayExtra')
            ->groupByReceptionDate();

        if($filterBranchOffice != 0){
            $ordersDeliveredToday->filterByIdBranchOffice($filterBranchOffice);
        }

        if($filterStatus != 0){
            $ordersDeliveredToday->filterByIdOrderStatus($filterStatus);
        }

        $ordersDeliveredToday = $ordersDeliveredToday->findOne();

        if($ordersDeliveredToday == null){
            $ordersDeliveredToday = array(
                'DeliveredTodayNormal' => 0,
                'DeliveredTodayUrgen' => 0,
                'DeliveredTodayExtra' => 0,
            );
        }else{
            $ordersDeliveredToday = $ordersDeliveredToday->toArray();
        }


        //ORDENES LONG TIME
        $today = date('Y-m-d');
        $DeliveryDate = strtotime ( '-60 day' , strtotime ( $today ) ) ;
        $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );

        $ordersLongTime = \OrdersQuery::create()
            ->filterByDeliveryDate($DeliveryDate, Criteria::LESS_EQUAL)
            ->filterByIdOrderStatus(7, Criteria::LESS_THAN)
            ->withColumn('SUM(IF(id_priority = 1, 1, 0))', 'LongTimeNormal')
            ->withColumn('SUM(IF(id_priority = 2, 1, 0))', 'LongTimeUrgen')
            ->withColumn('SUM(IF(id_priority = 3, 1, 0))', 'LongTimeExtra')
            ->groupByReceptionDate();

        if($filterBranchOffice != 0){
            $ordersLongTime->filterByIdBranchOffice($filterBranchOffice);
        }

        if($filterStatus != 0){
            $ordersLongTime->filterByIdOrderStatus($filterStatus);
        }

        $ordersLongTime = $ordersLongTime->findOne();

        if($ordersLongTime == null){
            $ordersLongTime = array(
                'LongTimeNormal' => 0,
                'LongTimeUrgen' => 0,
                'LongTimeExtra' => 0,
            );
        }else{
            $ordersLongTime = $ordersLongTime->toArray();
        }


        return json_encode([
            "ordersRecivedToday" => $ordersRecivedToday,
            "backorders" => $backorders,
            "ordersDeliveredToday" => $ordersDeliveredToday,
            "ordersLongTime" => $ordersLongTime,
        ]);

    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormOrder($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id',0);
            $IdBranchOffice  = $request->get('IdBranchOffice');
            $IdClientUser  = $request->get('IdClientUser');
            $Suburb     = $request->get('Suburb');
            $IdPriority  = $request->get('IdPriority');
            $ProgramDelivery  = $request->get('ProgramDelivery');
            $DeliveryDate  = $request->get('DeliveryDate');
            $recommended_day  = $request->get('recommended_day');
            $DeliveryTime  = $request->get('DeliveryTime');

            if(strtotime($DeliveryDate) < strtotime($recommended_day)){
                return json_encode(["success" => false, "errorMsg" => 'La fecha de entrega no puede ser menor a '.$recommended_day]);
            }

            /*
            $Name  = $request->get('Name');
            $Email  = $request->get('Email');
            $Phone  = $request->get('Phone');
            $Address  = $request->get('Address');
            $Password  = $request->get('Password');
            $ConfPassword  = $request->get('ConfPassword');
            */
            /*
            switch ($IdPriority){
                case 1:
                    $currentDate = date('Y-m-d');
                    $DeliveryDate = strtotime ( '+2 day' , strtotime ( $currentDate ) ) ;
                    $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );
                    break;
                case 2:
                    $currentDate = date('Y-m-d');
                    $DeliveryDate = strtotime ( '+1 day' , strtotime ( $currentDate ) ) ;
                    $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );
                    break;
                case 3:
                    if(strtotime(date('H:m')) < strtotime("12:00")){
                        $DeliveryDate = date('Y-m-d');
                    }else{
                        $IdPriority = 2;
                        $currentDate = date('Y-m-d');
                        $DeliveryDate = strtotime ( '+1 day' , strtotime ( $currentDate ) ) ;
                        $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );
                    }
                    break;
            }
            */

            $home_delivery = strtotime ( '+1 day' , strtotime ( $DeliveryDate ) ) ;
            $home_delivery = date ( 'Y-m-j' , $home_delivery );

            $newClientRegister = 0;
            $email = "";
            $pass = "";


            if($IdClientUser == 9999){
                $response = $this->saveClient($request);
                if(!$response['success']){
                    return json_encode($response);
                }else{
                    $newClientRegister = 1;
                    $email = $response['email'];
                    $pass = $response['pass'];
                    $IdClientUser = $response['IdClient'];
                }
            }
            $nextYear = date('Y') +1;

            $lastFolio = \OrdersQuery::create()
                ->filterByIdBranchOffice($IdBranchOffice)
                //->filterByReceptionDate(array('min' => date('Y').'-01-01','max' => $nextYear.'-01-01'))
                ->orderByFolio('DESC')
                ->findOne();
            if($lastFolio != null){
                $currentFolio = $lastFolio->getFolio() + 1;
            }else{
                $currentFolio = 1;
            }


            //Log::info($request->all());

            $now = Carbon::now();
            if($Id == 0){
                $order = new \Orders();
                $order->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $order = \OrdersQuery::create()
                    ->findOneById($Id);
                $order->setUpdatedAt($now);
            }

            $order->setIdBranchOffice($IdBranchOffice)
                ->setFolio($currentFolio)
                ->setReceptionDate($now)
                ->setReceptionTime($now)
                ->setDeliveryDate($DeliveryDate)
                ->setDeliveryTime($DeliveryTime)
                ->setIdPriority($IdPriority)
                ->setIdOrderStatus(1)
                ->setIdUser(Auth::user()->id)
                ->setIdClientUser($IdClientUser)
                ->setIdPaymentMethod(1)
                ->save();

            if($Suburb != ""){
                $client = UsersQuery::create()
                ->findOneById($order->getIdClientUser());

                $client->setSuburb($Suburb)
                ->save();
            }

            if($ProgramDelivery == 1){
                $user = UsersQuery::create()
                ->filterByIdUserType(5)
                ->findOne();

                $delivery = new Deliveries();
                $delivery->setIdOrder( $order->getId() )
                ->setIdAssignedUser($user->getId())
                ->setDayDelivery($home_delivery)
                ->setComments($DeliveryTime)
                ->setStatus(0)
                ->setCreatedAt($now)
                ->setUpdatedAt($now)
                ->save();

                $order->setHomeDelivery($home_delivery)
                ->save();
            }

            return json_encode(['success' => true,
                'errorMsg' => 'Orden guardada correctamente',
                'IdOrder' => $order->getId(),
                'newClientRegister' => $newClientRegister,
                'email' => $email,
                'pass' => $pass
            ]);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function saveClient(Request $request){
        $arrayErrores = $this->valdateFormClient($request);
        if ( empty($arrayErrores) ) {
            $Name      = $this->eliminar_tildes($request->get('Name'));
            $Phone     = $request->get('Phone');
            $Address     = $request->get('Address');
            $IdUserType = 4;

            //Log::info($request->all());

            $lastClient = \UsersQuery::create()
                ->filterByIdUserType(4)
                ->orderById('DESC')
                ->findOne();

            $nextClient = 1;
            if($lastClient != null){
                $nextClient = $lastClient->getId() + 1;
            }

            $email = "cliente".$nextClient."@golden.com.mx";
            $pass = "golden";

            $registedEmail = \UsersQuery::create()
                ->findOneByEmail($email);

            if($registedEmail != null){
                return ["success" => false, "errorMsg" => 'El correo electrónico ingresado ya se encuentra registrado'];
            }

            $now = Carbon::now();

            $user = new \Users();
            $user->setName($Name)
                ->setEmail($email)
                ->setPhone($Phone)
                ->setAddress($Address)
                ->setIdUserType($IdUserType)
                ->setPassword(bcrypt($pass))
                ->setCreatedAt($now)
                ->save();

            return ['success' => true,
                'errorMsg' => 'Cliente guardado correctamente',
                'IdClient' => $user->getId(),
                'email' => $email,
                'pass' => $pass
            ];
        }else{
            return ["success" => false, "errorMsg" => $arrayErrores[0]];
        }
    }

    public function saveOrderPayment(Request $request){

        /*
         *  1 -> Efectivo
         *  2 -> Tarjeta
         *  3 -> Monedero
         *  4 -> Transferencia
         */
        //$arrayErrores = $this->valdateFormPayment($request);
        //if ( empty($arrayErrores) ) {
            $IdOrderPayment = $request->get('IdOrderPayment');
            $efectivo = $request->get('efectivo', 0);
            $tarjeta = $request->get('tarjeta', 0);
            $monedero = $request->get('monedero', 0);
            $transferencia = $request->get('transferencia', 0);

            $order = \OrdersQuery::create()
                ->findOneById($IdOrderPayment);

            $totalToPaid = $efectivo + $tarjeta + $monedero + $transferencia;

            $remaining = $order->getTotal()-$order->getAmountPaid();

            $payWithPurse = 0;

            if($remaining >= $totalToPaid){

                if($monedero > 0 && strtotime(date('Y-m-d')) == strtotime($order->getReceptionDate())){
                    //Log::info($monedero." ==  ".$order->getTotal());
                    $electronicPurse = ElectronicPurseQuery::create()
                    ->findOneByIdClientUser($order->getIdClientUser());

                    if($electronicPurse != null){
                        if($monedero <= $electronicPurse->getAmount()){
                            $order->setIdPaymentMethod(3)
                            ->setAmountPaid($order->getAmountPaid() + $monedero)
                            ->save();

                            $electronicPurse->setAmount($electronicPurse->getAmount() - $monedero)
                            ->save();
                            $this->registerMovementPurse($electronicPurse->getId(), $order->getId(),0, $monedero);
                            $this->registerOrderHistory($order,$monedero);
                            $payWithPurse = 1;
                        }else{
                            return json_encode(['success' => false, 'errorMsg' => 'El cliente no cuenta con saldo suficiente en el monedero electrónico']);
                        }
                    }else{
                        return json_encode(['success' => false, 'errorMsg' => 'El cliente no cuenta con monedero electronico']);
                    }
                }else{
                    if($monedero > 0){
                        return json_encode(['success' => false, 'errorMsg' => 'El pago mediante monedero electronico solo es aplicable a pago anticipado']);
                    }
                }

                if($efectivo > 0){
                    $order->setIdPaymentMethod(1)
                        ->setAmountPaid($order->getAmountPaid() + $efectivo)
                        ->save();
                    $this->registerOrderHistory($order,$efectivo);
                }

                if($tarjeta > 0){
                    $order->setIdPaymentMethod(2)
                        ->setAmountPaid($order->getAmountPaid() + $tarjeta)
                        ->save();
                    $this->registerOrderHistory($order,$tarjeta);
                }

                if($transferencia > 0){
                    $order->setIdPaymentMethod(4)
                        ->setAmountPaid($order->getAmountPaid() + $transferencia)
                        ->save();
                    $this->registerOrderHistory($order,$transferencia);
                }


                $messagePurse = "";
                if($totalToPaid == $order->getTotal() && strtotime(date('Y-m-d')) == strtotime($order->getReceptionDate()) && $payWithPurse == 0){
                    $purse = \ElectronicPurseQuery::create()
                        ->findOneByIdClientUser($order->getIdClientUser());
                    if($purse != null){
                        $points = $order->getTotal() * 0.05;
                        $purse->setAmount($purse->getAmount() + $points)
                            ->save();

                        $this->registerMovementPurse($purse->getId(), $order->getId(),1, $points);

                        $messagePurse ="Se abonaron ".number_format($points,2,'.',',')." al monedero electrónico";
                    }
                }

                return json_encode(['success' => true, 'errorMsg' => 'Pago registrado correctamente correctamente. '.$messagePurse]);

            }else{
                return json_encode(["success" => false, "errorMsg" => "El monto restante es ".number_format($remaining,2,'.',',')]);
            }
            /*
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
            */
    }

    public function registerMovementPurse($IdElectronicPurse, $IdOrder, $TypeMovement, $Amount){
        $now = Carbon::now();

        $history = new ElectronicPurseHistory();
        $history->setIdElectronicPurse($IdElectronicPurse)
        ->setMovementType($TypeMovement)
        ->setIdOrder($IdOrder)
        ->setDescription("")
        ->setAmount($Amount)
        ->setCreatedAt($now)
        ->setUpdatedAt($now)
        ->save();
    }

    public function saveObservations(Request $request){
        $cve = $request->get('cve');
        $obs = $request->get('obs');

        $order = OrdersQuery::create()
        ->findOneById($cve);
        $order->setObservations($obs)
        ->save();

        return json_encode(['success' => true, 'errorMsg' => 'Observaciones guardadas correctamente']);
    }

   
    
    public function saveDetail(Request $request){
        $arrayErrores = $this->valdateFormDetailOrder($request);
        if ( empty($arrayErrores) ) {

            $IdAssignedOrder = $request->get('IdAssignedOrder');
            $IdDetailOrder = $request->get('IdDetailOrder');
            $IdService = $request->get('IdService');
            $Quantity = $request->get('Quantity');
            $Observations = $request->get('Observations','');
            $Price = $request->get('Price');
            $Discount = $request->get('Discount',0);
            $IdTypeDiscount = $request->get('IdTypeDiscount');

            $order = \OrdersQuery::create()
                ->findOneById($IdAssignedOrder);


            $now = Carbon::now();
            if($IdDetailOrder == 0){
                if($IdService == 1 || $IdService == 5 || $IdService == 10 || $IdService == 628){
                    $IdColor = $request->get('IdColor1');
                    $IdPrint = $request->get('IdPrint1');
                    $IdDefect = $request->get('IdDefect1');
                    $Observations = $request->get('Observations1') == null ? '' : $request->get('Observations1', '');
                    $detail = new \OrderDetail();
                    $detail->setIdOrder($IdAssignedOrder)
                        ->setIdOrderDetailStatus(1)
                        ->setCreatedAt($now)
                        ->setUpdatedAt($now);

                    //echo round(1.95583, 2);  // 1.96

                    $descriptionHistory = 'Se registró el elemento de la orden';

                    if($order->getIdOrderStatus() == 6){
                        return json_encode(["success" => false, "errorMsg" => 'No es posible actualizar el estatus del elemento, la orden ha sido entregada al cliente']);
                    }

                    $subtotal = $Quantity * $Price;
                    $subtotal = ceil( $subtotal);
                    if($IdTypeDiscount == 1){
                        $Discount = $subtotal * ($Discount / 100);
                    }
                    $total = $subtotal - $Discount;
                    $total = ceil( $total);

                    $order->setTotal($order->getTotal() + $total)
                        ->setSubtotal($order->getSubtotal() + $subtotal)
                        ->setDiscount($order->getDiscount() + $Discount)
                        ->save();

                    $detail->setQuantity($Quantity)
                        ->setIdColor($IdColor)
                        ->setIdPrint($IdPrint)
                        ->setIdDefect($IdDefect)
                        ->setIdService($IdService)
                        ->setObservations($Observations)
                        ->setPrice($Price)
                        ->setDiscount($Discount)
                        ->setSubtotal($subtotal)
                        ->setTotal($total)                    
                        ->save();

                    $this->registerDetailHistory($detail->getId(), $detail->getIdOrderDetailStatus(), $descriptionHistory, $request);
                }else{
                    $subtotal = $Price;
                    if($IdTypeDiscount == 1){
                        $Discount = $subtotal * ($Discount / 100);
                    }
                    $total = $subtotal - $Discount;

                    for($i = 1; $i <= $Quantity; $i++){
                        $IdColor = $request->get('IdColor'.$i);
                        $IdPrint = $request->get('IdPrint'.$i);
                        $IdDefect = $request->get('IdDefect'.$i);
                        $Observations = $request->get('Observations'.$i, '') == null ? '' : $request->get('Observations'.$i, '');


                        $detail = new \OrderDetail();
                        $detail->setIdOrder($IdAssignedOrder)
                            ->setIdOrderDetailStatus(1)
                            ->setCreatedAt($now)
                            ->setUpdatedAt($now);

                        $descriptionHistory = 'Se registró el elemento de la orden';

                        if($order->getIdOrderStatus() == 6){
                            return json_encode(["success" => false, "errorMsg" => 'No es posible actualizar el estatus del elemento, la orden ha sido entregada al cliente']);
                        }


                        //Log::info("Sub->".$subtotal." |Disc->".$Discount." |Tot->".$total);

                        $order->setTotal($order->getTotal() + $total)
                            ->setSubtotal($order->getSubtotal() + $subtotal)
                            ->setDiscount($order->getDiscount() + $Discount)
                            ->save();

                        $detail->setQuantity(1)
                            ->setIdColor($IdColor)
                            ->setIdPrint($IdPrint)
                            ->setIdDefect($IdDefect)
                            ->setIdService($IdService)
                            ->setObservations($Observations)
                            ->setPrice($Price)
                            ->setDiscount($Discount)
                            ->setSubtotal($subtotal)
                            ->setTotal($total)
                            ->save();

                        $this->registerDetailHistory($detail->getId(), $detail->getIdOrderDetailStatus(), $descriptionHistory, $request);
                    }
                }

            }else{
                $IdColor = $request->get('IdColor1');
                $IdPrint = $request->get('IdPrint1');
                $IdDefect = $request->get('IdDefect1');

                $detail = \OrderDetailQuery::create()
                    ->findOneById($IdDetailOrder);
                $detail->setUpdatedAt($now);


                $descriptionHistory = 'Se editó el elemento de la orden';

                if($order->getIdOrderStatus() == 6){
                    return json_encode(["success" => false, "errorMsg" => 'No es posible actualizar el estatus del elemento, la orden ha sido entregada al cliente']);
                }

                $subtotal = $Quantity * $Price;
                if($IdTypeDiscount == 1){
                    $Discount = $subtotal * ($Discount / 100);
                }
                $total = $subtotal - $Discount;

                $newAmmount = ($order->getTotal() - $detail->getTotal()) + $total;
                $newDiscount = ($order->getDiscount() - $detail->getDiscount()) + $Discount;
                $newSubtotal = ($order->getSubtotal() - $detail->getSubtotal()) + $subtotal;

                $order->setTotal($newAmmount)
                    ->setDiscount($newDiscount)
                    ->setSubtotal($newSubtotal)
                    ->save();

                $detail->setQuantity($Quantity)
                    ->setIdColor($IdColor)
                    ->setIdPrint($IdPrint)
                    ->setIdDefect($IdDefect)
                    ->setIdService($IdService)
                    ->setObservations($Observations)
                    ->setPrice($Price)
                    ->setDiscount($Discount)
                    ->setSubtotal($subtotal)
                    ->setTotal($total)
                    ->save();

                $this->registerDetailHistory($detail->getId(), $detail->getIdOrderDetailStatus(), $descriptionHistory, $request);
            }

            return json_encode(['success' => true, 'errorMsg' => 'Pieza guardada correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }



    public function deleteDetail(Request $request){
        $cve = $request->get('cve');

        $detail = \OrderDetailQuery::create()
            ->findOneById($cve);

        $order = \OrdersQuery::create()
            ->findOneById($detail->getIdOrder());


        $detailHistory = \OrderDetailHistoryQuery::create()
            ->filterByIdOrderDetail($detail->getId())
            ->find()
            ->delete();

        $order->setTotal($order->getTotal() - $detail->getTotal())
            ->setSubtotal($order->getSubtotal() - $detail->getSubtotal())
            ->setDiscount($order->getDiscount() - $detail->getDiscount())
            ->save();

        $detail->delete();

        return json_encode(["success" => true, "errorMsg" => "Item eliminado correctamente"]);
    }

    public function saveDetailStatus(Request $request){
        $arrayErrores = $this->valdateFormDetailStatus($request);
        if ( empty($arrayErrores) ) {

            $IdDetailToUpdate = $request->get('IdDetailToUpdate');
            $IdOrderDetailStatus = $request->get('IdOrderDetailStatus');
            $DescriptionStatus = $request->get('DescriptionStatus');
            $Location = $request->get('Location',"");

            $detail = \OrderDetailQuery::create()
                ->findOneById($IdDetailToUpdate);

            $order = \OrdersQuery::create()
                ->findOneById($detail->getIdOrder());

            if($order->getIdOrderStatus() == 6){
                return json_encode(["success" => false, "errorMsg" => 'No es posible actualizar el estatus del elemento, la orden ha sido entregada al cliente']);
            }

            if($IdOrderDetailStatus == 5 && $order->getTotal() != $order->getAmountPaid()){
                return json_encode(["success" => false, "errorMsg" => 'No es posible actualizar el estatus del elemento a entregado mientras no se haya completado el pago de la orden']);
            }


            $detail->setIdOrderDetailStatus($IdOrderDetailStatus)
                ->setLocation($Location)
                ->save();

            $now = Carbon::now();
            if($IdOrderDetailStatus == 5){
                $detail->setRealDeliveryTime($now)
                ->setRealDeliveryDate($now)
                ->setIdDeliveryUser(Auth::user()->id) 
                ->save();
            }else{
                $detail->setRealDeliveryTime(null)
                ->setRealDeliveryDate(null)
                ->save();
            }

            $this->registerDetailHistory($detail->getId(), $detail->getIdOrderDetailStatus(), $DescriptionStatus, $request);



            $orderPieces = \OrderDetailQuery::create()
                ->filterByIdOrder($detail->getIdOrder())
                ->find()->count();

            $pendingPieces = \OrderDetailQuery::create()
                ->filterByIdOrder($detail->getIdOrder())
                ->filterByIdOrderDetailStatus(1)
                ->find()->count();

            $finishedPieces = \OrderDetailQuery::create()
                ->filterByIdOrder($detail->getIdOrder())
                ->filterByIdOrderDetailStatus(4)
                ->find()->count();
            
            $deliveredPieces = \OrderDetailQuery::create()
                ->filterByIdOrder($detail->getIdOrder())
                ->filterByIdOrderDetailStatus(5)
                ->find()->count();

            if($IdOrderDetailStatus > 1){
                $order->setIdOrderStatus(3)
                    ->save();
                $this->registerOrderHistory($order,0);
            }

            if($orderPieces == $finishedPieces){
                $order->setIdOrderStatus(5)
                    ->save();
                $this->registerOrderHistory($order,0);

                $pickup = PickupsQuery::create()
                ->findOneByIdOrder($order->getId());
                if(!is_null($pickup)){
                    $pickup->delete();
                }
            }

            if($orderPieces == $deliveredPieces){
                $order->setIdOrderStatus(6)
                    ->setRealDeliveryDate($now)
                    ->setRealDeliveryTime($now)
                    ->setIdDeliveryUser(Auth::user()->id) 
                    ->save();
                $this->registerOrderHistory($order,0);
            }

            if($orderPieces == $pendingPieces){
                $order->setIdOrderStatus(1)
                    ->save();
                $this->registerOrderHistory($order,0);
            }


            return json_encode(['success' => true, 'errorMsg' => 'Estatus de detalle actualizado correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function saveStatusMasive(Request $request){
        Log::info($request->all());
        $orderSelected = $request->get('orderSelected');
        $IdStatusDetails = $request->get('IdStatusDetails');
        $DescriptionStatusMasive = $request->get('DescriptionStatusMasive');
        $LocationMasive = $request->get('LocationMasive');
        $ids = $request->get('ids');

        $DescriptionStatusMasive = $DescriptionStatusMasive == null ? "" : $DescriptionStatusMasive;
        $LocationMasive = $LocationMasive == null ? "" : $LocationMasive;


        $order = \OrdersQuery::create()
                ->findOneById($orderSelected);

        if($order->getIdOrderStatus() == 6){
            return json_encode(["success" => false, "errorMsg" => 'No es posible actualizar el estatus del elemento, la orden ha sido entregada al cliente']);
        }

        if($IdStatusDetails == 5 && $order->getTotal() != $order->getAmountPaid()){
            return json_encode(["success" => false, "errorMsg" => 'No es posible actualizar el estatus del elemento a entregado mientras no se haya completado el pago de la orden']);
        }

        foreach($ids as $id){
            $detail = \OrderDetailQuery::create()
                ->findOneById($id);

            $detail->setIdOrderDetailStatus($IdStatusDetails)
            ->setLocation($LocationMasive)
            ->save();

            $now = Carbon::now();
            if($IdStatusDetails == 5){
                $detail->setRealDeliveryTime($now)
                ->setRealDeliveryDate($now)
                ->setIdDeliveryUser(Auth::user()->id) 
                ->save();
            }else{
                $detail->setRealDeliveryTime(null)
                ->setRealDeliveryDate(null)
                ->save();
            }

            $this->registerDetailHistory($detail->getId(), $detail->getIdOrderDetailStatus(), $DescriptionStatusMasive, $request);
        }

        $orderPieces = \OrderDetailQuery::create()
                ->filterByIdOrder($orderSelected)
                ->find()->count();

            $pendingPieces = \OrderDetailQuery::create()
                ->filterByIdOrder($orderSelected)
                ->filterByIdOrderDetailStatus(1)
                ->find()->count();

            $finishedPieces = \OrderDetailQuery::create()
                ->filterByIdOrder($orderSelected)
                ->filterByIdOrderDetailStatus(4)
                ->find()->count();
            
            $deliveredPieces = \OrderDetailQuery::create()
                ->filterByIdOrder($orderSelected)
                ->filterByIdOrderDetailStatus(5)
                ->find()->count();

            if($IdStatusDetails > 1){
                $order->setIdOrderStatus(3)
                    ->save();
                $this->registerOrderHistory($order,0);
            }

            if($orderPieces == $finishedPieces){
                $order->setIdOrderStatus(5)
                    ->save();
                $this->registerOrderHistory($order,0);

                $pickup = PickupsQuery::create()
                ->findOneByIdOrder($order->getId());
                if(!is_null($pickup)){
                    $pickup->delete();
                }
            }

            if($orderPieces == $deliveredPieces){
                $order->setIdOrderStatus(6)
                    ->setRealDeliveryDate($now)
                    ->setRealDeliveryTime($now)
                    ->setIdDeliveryUser(Auth::user()->id) 
                    ->save();
                $this->registerOrderHistory($order,0);
            }

            if($orderPieces == $pendingPieces){
                $order->setIdOrderStatus(1)
                    ->save();
                $this->registerOrderHistory($order,0);
            }

        return json_encode(['success' => true, 'errorMsg' => 'Actualización de estarus correcta']);
    }

    public function showDetailHistory(Request $request){
        $cve = $request->get('cve');

        $records = \OrderDetailHistoryQuery::create()
            ->filterByIdOrderDetail($cve)
            ->orderByCreatedAt('DESC')
            ->useOrderDetailStatusQuery('Status')
                ->withColumn('Status.Description', 'DescriptionStatus')
                ->withColumn('Status.Color', 'Color')
            ->endUse()
            ->useUsersQuery('User')
                ->withColumn('User.Name', 'NameUser')
            ->endUse()
            ->find();


        return view('app.orders.tableDetailHistory')
            ->with('records', $records->toArray());
    }

    public function markAsPending(Request $request){
        $cve = $request->get('cve');

        $order = \OrdersQuery::create()
            ->findOneById($cve);

        $order->setIdOrderStatus(2)
            ->save();

        $this->registerOrderHistory($order,0);

        return json_encode(['success' => true, 'errorMsg' => 'Se ha cerrado el registro de la orden']);
    }

    public function markAsDelivered(Request $request){
        $cve = $request->get('cve');

        

        $order = \OrdersQuery::create()
            ->findOneById($cve);

        $now = Carbon::now();
        if($order->getTotal() == $order->getAmountPaid()){
            $order->setIdOrderStatus(6)
                ->setRealDeliveryDate($now)
                ->setRealDeliveryTime($now)
                ->setIdDeliveryUser(Auth::user()->id)   
                ->save();
            $this->registerOrderHistory($order,0);

            $pickup = PickupsQuery::create()
            ->findOneByIdOrder($order->getId());
            if(!is_null($pickup)){
                $pickup->delete();
            }

            $details = OrderDetailQuery::create()
            ->filterByIdOrder($cve)
            ->filterByIdOrderDetailStatus(5, Criteria::LESS_THAN)
            ->find();
            foreach($details as $detail){
                $detail->setIdOrderDetailStatus(5)
                ->setRealDeliveryTime($now)
                ->setRealDeliveryDate($now)
                ->setIdDeliveryUser(Auth::user()->id)  
                ->save();

                $this->registerDetailHistory($detail->getId(), $detail->getIdOrderDetailStatus(), '', $request);
            }

            DeliveriesQuery::create()
            ->filterByIdOrder($cve)
            ->update(array('Status' => 1));

            return json_encode(['success' => true, 'errorMsg' => 'La orden ha sido entregada al cliente']);
        }else{
            return json_encode(['success' => false, 'errorMsg' => 'La orden tiene un saldo pendiente']);
        }

    }

    public function cancelOrder(Request $request){
        $cve = $request->get('cve');

        $order = \OrdersQuery::create()
            ->findOneById($cve);


        $pickup = PickupsQuery::create()
        ->findOneByIdOrder($order->getId());
        if(!is_null($pickup)){
            $pickup->delete();
        }


        if( $order->getIdOrderStatus() < 6){
            $order->setIdOrderStatus(7)
                ->save();
            $this->registerOrderHistory($order,0);

            $payments = \OrderHistoryQuery::create()
                ->filterByIdOrder($cve)
                ->filterByDeletedPayment(0)
                ->filterByAmountPaid(0, Criteria::GREATER_THAN)
                ->find();

            foreach($payments as $payment){
                $order->setAmountPaid($order->getAmountPaid() - $payment->getAmountPaid())
                    ->save();

                $payment->setDeletedPayment(1)
                    ->save();
            }

            return json_encode(['success' => true, 'errorMsg' => 'Se ha cancelado la orden']);
        }else{
            return json_encode(['success' => false, 'errorMsg' => 'Imposible cancelar la nota, ha sido entregada al cliente']);
        }
    }

    public function printOrder(Request $request, $cve){

        $order = \OrdersQuery::create()
            ->useUsersRelatedByIdClientUserQuery('Client')
                ->withColumn('Client.Name', 'ClientName')
                ->withColumn('Client.Address', 'ClientAddress')
                ->withColumn('Client.Suburb', 'ClientSuburb')
                ->withColumn('Client.Phone', 'ClientPhone')
            ->endUse()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Name', 'BranchName')
                ->withColumn('Branch.Address', 'BranchAddress')
                ->withColumn('Branch.Phone', 'BranchPhone')
                ->withColumn('Branch.Series', 'BranchSeries')
                ->withColumn('Branch.Rfc', 'BranchRfc')
            ->endUse()
            ->useUsersRelatedByIdUserQuery('Employee')
                ->withColumn('Employee.Name', 'NameEmployee')
            ->endUse()
            ->findOneById($cve);

        Log::info($order->getDeliveryDate());

        $cal = CalendarQuery::create()
            ->findOneByDay($order->getDeliveryDate());

        $cal2 = array();
        if(!is_null($order->getHomeDelivery())){        
            $cal2 = CalendarQuery::create()
            ->findOneByDay($order->getHomeDelivery())
            ->toArray();
        }

        $orderDetail = \OrderDetailQuery::create()
            ->filterByIdOrder($cve)
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
                ->withColumn('Service.Description', 'DescriptionService')
                ->useServiceCategoriesQuery('Category')
                    ->withColumn('Category.Description', 'DescriptionCategory')
                ->endUse()
            ->endUse()
            ->find();

        $textFooter = "ORIGINAL";
        if($order->getPrintedNote()==1){
            $textFooter = "REIMPRESION DE NOTA";
        }else{
            $order->setPrintedNote(1)
                ->save();
        }

        
        try {

            $order = $order->toArray();
            $details = $orderDetail->toArray();
            $calendar = $cal->toArray();
            $calendar2 = $cal2;
            $docenas = $this->docenas;
            $mediasDocenas = $this->mediasDocenas;

            ob_get_clean();
            $pdf = new Dompdf(); 
            $pdf = PDF::loadView('app/orders/printOrder',
                [
                    'order' => $order,
                    'details' => $details,
                    'calendar' => $calendar,
                    'calendar2' => $calendar2,
                    'textFooter' => $textFooter,
                    'docenas' => $docenas,
                    'mediasDocenas' => $mediasDocenas,
                ]);
                $pdf->setOptions([
                    // 'isHtml5ParserEnabled' => true,
                    // 'isRemoteEnabled' => true,
                    // "isPhpEnabled" => false,
                    // "paper" => "letter",
                    // "orientation" => "landscape",
                    'chroot'  => public_path(),
                    'tempDir' => public_path(),
                ]);
            //$pdf->loadHtml(view('app/orders/printOrder', compact('order', 'details', 'calendar', 'textFooter', 'docenas', 'mediasDocenas')));
            $pdf->setPaper("half-letter", 'landscape');
            //ini_set('max_execution_time', 120);
            $fileNamePdf = 'Nota_' . $cve .  '.pdf';
            //unlink(public_path() . "/tarjetasResguardo/{$fileNameTarjeta}");
            //$pdf->save(public_path() . "/tarjetasResguardo/{$fileNameTarjeta}");
            //$pdf->save(public_path() . "/{$fileNamePdf }");
            //$pdf->loadHtml(ob_get_clean());
            //$pdf->render();
            //$pdf->render();
            return $pdf->stream($fileNamePdf);

            return view('app/orders/printOrder')
            ->with('order', $order)
            ->with('details', $orderDetail->toArray())
            ->with('calendar', $cal->toArray())
            ->with('textFooter', $textFooter)
            ->with('docenas', $this->docenas)
            ->with('mediasDocenas', $this->mediasDocenas);
            
            
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

    public function savePurse(Request $request){
        Log::info($request->all());
        $IdOrderPurse = $request->get('IdOrderPurse');
        $CodePurse = $request->get('CodePurse');

        $order = \OrdersQuery::create()
            ->findOneById($IdOrderPurse);

        $purseRegisted = \ElectronicPurseQuery::create()
            ->filterByIdClientUser($order->getIdClientUser(), Criteria::NOT_EQUAL)
            ->findOneByCode($CodePurse);
        if($purseRegisted == null){

            $electronic = new \ElectronicPurse();
            $electronic->setCode($CodePurse)
                ->setIdClientUser($order->getIdClientUser())
                ->setAmount(0)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Monedero electrónico registrado']);
        }else{
            return json_encode(['success' => false, 'errorMsg' => 'El monedero electrónico ya se encuentra asignado a un cliente']);
        }
    }

    public function registerOrderHistory(\Orders $order, $amount){

        $now = Carbon::now();

        $idStatus = $amount > 0 ? 3 : null;

        $orderHistory = new \OrderHistory();
        $orderHistory->setIdOrder($order->getId())
            ->setIdOrderStatus($order->getIdOrderStatus())
            ->setAmountPaid($amount)
            ->setTotalPaid($order->getAmountPaid())
            ->setIdPaymentMethod($order->getIdPaymentMethod())
            ->setIdPaymentStatus($idStatus)
            ->setIdUser(Auth::user()->id)
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        if($idStatus == 6){
            $delivery = DeliveriesQuery::create()
            ->findOneByIdOrder($order->getId());

            if(!is_null($delivery)){
                $delivery->setStatus(1)
                ->save();
            }
        }
    }

    public function registerDetailHistory($IdDetail, $IdStatus, $Description, Request $request){

        $now = Carbon::now();
        $detailHistory = new \OrderDetailHistory();
        $detailHistory->setIdOrderDetail($IdDetail)
            ->setIdOrderDetailStatus($IdStatus)
            ->setDescription($Description)
            ->setIdUser(Auth::user()->id)
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        if($IdStatus == 3){
            $basePath = 'graphics/services/';
            $infputFile = 'imageStatus';
            if( $request->hasFile($infputFile) ) {
                //Log::info($request->file($infputFile)->getClientOriginalName());

                $nomDoc = $detailHistory->getId().".".$request->file($infputFile)->extension();
                $detailHistory->setImage($nomDoc)
                ->save();

                $request->file($infputFile)->move(base_path() . '/public/'.$basePath, $nomDoc);
            }
        }

    }

    public function saveRegisterDelivery(Request $request){
        Log::info('saveRegisterDelivery');
        $arrayErrores = $this->valdateFormDelivery($request);
        if ( empty($arrayErrores) ) {
            $IdOrderDelivery = $request->get('IdOrderDelivery');
            $IdAssignedUser = $request->get('IdAssignedUser');
            $DateDelivery = $request->get('DateDelivery');
            $Comments = $request->get('Comments');

            $now = Carbon::now();
            $delivery = new \Deliveries();
            $delivery->setCreatedAt($now)
                ->setUpdatedAt($now);


            $delivery->setIdOrder($IdOrderDelivery)
                ->setIdAssignedUser($IdAssignedUser)
                ->setDayDelivery($DateDelivery)
                ->setComments($Comments)
                ->save();


            return ['success' => true, 'errorMsg' => 'Entrega registrada correctamente'];
        }else{
            return ["success" => false, "errorMsg" => $arrayErrores[0]];
        }
    }
    
    public function saveReprogramDelivery(Request $request){
        $IdDelivery = $request->get('IdDelivery');
        $NewDateDelivery = $request->get('NewDateDelivery');


        if(!is_null($NewDateDelivery)){
            $delivery = DeliveriesQuery::create()
            ->findOneById($IdDelivery);

            $delivery->setDayDelivery($NewDateDelivery)
            ->save();

            return ['success' => true, 'errorMsg' => 'Entrega reprogramada para el día '.$NewDateDelivery];
        }else{
            return ["success" => false, "errorMsg" => "Seleccione una fecha valida"];
        }        
    }

    public function saveNewClient(Request $request){
        $IdOrderChangeClient = $request->get('IdOrderChangeClient');
        $IdNewClient = $request->get('IdNewClient');

        $now = Carbon::now(); 
        $order = OrdersQuery::create()
        ->findOneById($IdOrderChangeClient);

        $order->setIdClientUser($IdNewClient)
        ->setUpdatedAt($now)
        ->save();

        return json_encode(['success' => true, 'errorMsg' => 'Cliente de la orden actualizado correctamente']);
    }

    public function valdateFormOrder(Request $request){
        $reglas = [
            'IdBranchOffice' => 'required|numeric|min:1',
            'IdClientUser' => 'required|numeric|min:1',
            'IdPriority' => 'required|numeric|min:1',
            'DeliveryTime' => 'required',
        ];

        $mensajes = [
            'IdBranchOffice.required' => 'Selecciona la sucursal',
            'IdBranchOffice.numeric' => 'Selecciona la sucursal',
            'IdBranchOffice.min' => 'Selecciona la sucursal',
            'IdClientUser.required' => 'Selecciona el cliente',
            'IdClientUser.numeric' => 'Selecciona el cliente',
            'IdClientUser.min' => 'Selecciona el cleinte',
            'IdPriority.required' => 'Selecciona la prioridad',
            'IdPriority.numeric' => 'Selecciona la prioridad',
            'IdPriority.min' => 'Selecciona la prioridad',
            'DeliveryTime.required' => 'Selecciona la hora de entrega',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function valdateFormDetailOrder(Request $request){
        $reglas = [
            'IdService' => 'required|numeric|min:1',
            'IdColor1' => 'required|numeric|min:1',
            'IdPrint1' => 'required|numeric|min:1',
            'IdDefect1' => 'required|numeric|min:1',
            'Quantity' => 'required|numeric|min:0.01',
            'Price' => 'required|numeric|min:1',
        ];

        $mensajes = [
            'IdService.required' => 'Selecciona el servicio',
            'IdService.numeric' => 'Selecciona el servicio',
            'IdService.min' => 'Selecciona el servicio',
            'IdColor1.required' => 'Selecciona el color de la pieza',
            'IdColor1.numeric' => 'Selecciona el color de la pieza',
            'IdColor1.min' => 'Selecciona el color de la pieza',
            'IdPrint1.required' => 'Selecciona el estampado',
            'IdPrint1.numeric' => 'Selecciona el estampado',
            'IdPrint1.min' => 'Selecciona el estampado',
            'IdDefect1.required' => 'Selecciona el defecto',
            'IdDefect1.numeric' => 'Selecciona el defecto',
            'IdDefect1.min' => 'Selecciona el defecto',
            'Quantity.required' => 'Ingresa la cantidad',
            'Quantity.numeric' => 'Ingresa la cantidad',
            'Quantity.min' => 'Ingresa la cantidad',
            'Price.required' => 'Ingresa el precio',
            'Price.numeric' => 'Ingresa el precio',
            'Price.min' => 'Ingresa el precio',

        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function valdateFormDetailStatus(Request $request){
        $reglas = [
            'IdOrderDetailStatus' => 'required|numeric|min:1',
            'DescriptionStatus' => 'required',
            'Location' => 'required_if:IdOrderDetailStatus,4',
        ];

        $mensajes = [
            'IdOrderDetailStatus.required' => 'Selecciona el estatus del elemento',
            'IdOrderDetailStatus.numeric' => 'Selecciona el estatus del elemento',
            'IdOrderDetailStatus.min' => 'Selecciona el estatus del elemento',
            'DescriptionStatus.required' => 'Ingresa la descripción',
            'Location.required_if' => 'Ingresa la ubicación del elemento',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function valdateFormPayment(Request $request){
        $reglas = [
            'IdPaymentMethod' => 'required|numeric|min:1',
            'Amount' => 'required|numeric|min:1',
        ];

        $mensajes = [
            'IdPaymentMethod.required' => 'Selecciona el método de pago',
            'IdPaymentMethod.numeric' => 'Selecciona el método de pago',
            'IdPaymentMethod.min' => 'Selecciona el método de pago',
            'Amount.required' => 'Ingresa el monto',
            'Amount.numeric' => 'Ingresa el monto',
            'Amount.min' => 'Ingresa el monto',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function valdateFormClient(Request $request){
        $reglas = [
            'Name' => 'required',
            'Phone' => 'required',
            'Address' => 'required',
        ];

        $mensajes = [
            'Name.required' => 'Ingresa el nombre del cliente',
            'Phone.required' => 'Ingresa un número telefónico',
            'Address.required' => 'Ingresa una dirección',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function valdateFormDelivery(Request $request){
        $reglas = [
            'IdAssignedUser' => 'required|numeric|min:1',
            'DateDelivery' => 'required',
            'Comments' => 'required',
        ];

        $mensajes = [
            'IdAssignedUser.required' => 'Selecciona un repartidor',
            'IdAssignedUser.numeric' => 'Selecciona un repartidor',
            'IdAssignedUser.min' => 'Selecciona un repartidor',
            'DateDelivery.required' => 'selecciona la fecha de entrega',
            'Comments.required' => 'Ingresa los comentarios',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    function eliminar_tildes($cadena){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        //$cadena = utf8_encode($cadena);
    
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );
    
        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );
    
        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );
    
        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );
    
        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );
    
        /*
        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );
        */
    
        return $cadena;
    }


    /*
        API METHODS
    */

    public function getOrderDetail(Request $request){
        Log::info($request->all());
        $IdOrder = $request->get('idOrder');

        $order = \OrdersQuery::create()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Series', 'Serie')
            ->endUse()
            ->useOrderStatusQuery('Status')
                ->withColumn('Status.Description', 'OrderStatus')
                ->withColumn('Status.Color', 'Color')
            ->endUse()
            ->usePrioritiesQuery('Priority')
                ->withColumn('Priority.Description', 'DescriptionPriority')
            ->endUse()
            ->useUsersRelatedByIdClientUserQuery('Client')
                ->withColumn('Client.Name', 'NameClient')
            ->endUse()
            ->findOneById($IdOrder)
            ->toArray();


        $order['Items']  = \OrderDetailQuery::create()
            ->filterByIdOrder($IdOrder)
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
                ->withColumn('Service.Description', 'DescriptionService')
                ->useServiceCategoriesQuery('Category')
                    ->withColumn('Category.Description', 'DescriptionCategory')
                ->endUse()
            ->endUse()
            ->find()
            ->toArray();

        $order['Payments'] = \OrderHistoryQuery::create()
            ->filterByIdOrder($IdOrder)
            ->filterByDeletedPayment(0)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->usePaymentStatusQuery('Status')
                ->withColumn('Status.Description', 'DescriptionStatus')
            ->endUse()
            ->find()
            ->toArray();

        $order['RemainingAmount'] = $order['Total'] - $order['AmountPaid'];
            


        return response()->json([
            'success' => true,
            'order' => $order
        ], 200);

    }

    public function getOrders(Request $request){
        Log::info($request->all());
        $userId = $request->get('userId');
        $p = $request->get('page');

        $userId = 4;
        $numPages = OrdersQuery::create()
        ->filterByIdClientUser($userId)
        ->find()->count();
        $numPages = ceil($numPages / 10);

        $orders = OrdersQuery::create()
        ->filterByIdClientUser($userId)
        ->useBranchOfficesQuery('Branch')
            ->withColumn('Branch.Series', 'Serie')
        ->endUse()
        ->useOrderStatusQuery('Status')
            ->withColumn('Status.Description', 'OrderStatus')
            ->withColumn('Status.Color', 'Color')
        ->endUse()
        ->usePrioritiesQuery('Priority')
            ->withColumn('Priority.Description', 'DescriptionPriority')
        ->endUse()
        ->useUsersRelatedByIdClientUserQuery('Client')
            ->withColumn('Client.Name', 'NameClient')
        ->endUse()
        ->useUsersRelatedByIdDeliveryUserQuery('DaliveryUser')
            ->withColumn('DaliveryUser.Name', 'NameDaliveryUser')
        ->endUse()
        ->orderByReceptionDate('DESC')
        ->orderByReceptionTime('DESC')
        ->paginate($page = $p, $maxPerPage = 10);

        //Log::info($orders->toArray());

        if($orders->isEmpty() || $p > $numPages){
            return response()->json(['success' => true, 'orders' => []], 200);
        }else{
            $result = array();
            foreach($orders as $order){
                //Log::info($order->toArray());
                array_push($result, $order->toArray());
            }

            return response()->json(['success' => true, 'orders' => $result], 200);
        }
        
    }

    public function paymentOpenpaySpei(Request $request){
        $id_order = $request->get('id_order');
        $amount = $request->get('amount');
        Log::info($request->all());
        //$amount = 100;

        $now = Carbon::now();
        $expiration = Carbon::parse(Carbon::now())->addDays(3)->format('Y-m-d\TH:i:s');
        $dueDate = Carbon::parse(Carbon::now())->addDays(3)->format('Y-m-d H:i:s');

        $order = OrdersQuery::create()
        ->useBranchOfficesQuery('Branch')
            ->withColumn('Branch.Series', 'Serie')
        ->endUse()
        ->useOrderStatusQuery('Status')
            ->withColumn('Status.Description', 'OrderStatus')
            ->withColumn('Status.Color', 'Color')
        ->endUse()
        ->usePrioritiesQuery('Priority')
            ->withColumn('Priority.Description', 'DescriptionPriority')
        ->endUse()
        ->useUsersRelatedByIdClientUserQuery('Client')
            ->withColumn('Client.Name', 'NameClient')
        ->endUse()
        ->findOneById($id_order);

        $client = UsersQuery::create()
        ->findOneById($order->getIdClientUser());

        $idStatus = 1;

        $orderHistory = new \OrderHistory();
        $orderHistory->setIdOrder($order->getId())
            ->setIdOrderStatus($order->getIdOrderStatus())
            ->setAmountPaid($amount)
            ->setTotalPaid($order->getAmountPaid())
            ->setIdPaymentMethod(4)
            ->setIdPaymentStatus($idStatus)
            ->setIdUser($order->getIdClientUser())
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();
        
        $openpay = Openpay::getInstance(
            $this->merchanId,
            $this->privateKey);

        $customer = array(
            'name' => $client->getName(),
            'last_name' => '',
            'phone_number' => '',
            'email' => $client->getEmail()
        );

        $orderId = "ord-".$order->getVirtualColumn('Serie')."-".$order->getFolio()."-".str_pad($orderHistory->getId(),6,"0",STR_PAD_LEFT)."-".date('Hi');
        Log::info("OID: ".$order);

        Openpay::setProductionMode(false);

        try{
            $chargeRequest = array(
                'method' => 'bank_account',
                'amount' => $amount,
                'description' => 'Orden '.$order->getVirtualColumn('Serie')."-".$order->getFolio(),
                'order_id' => $orderId,
                'customer' => $customer
            );

            $charge = $openpay->charges->create($chargeRequest);

            $datosPago = array(
                "id"                    => $charge->id,
                "amount"                => $charge->amount,
                "bank"                  => $charge->payment_method->bank,
                "agreement"             => $charge->payment_method->agreement,
                "clabe"                 => $charge->payment_method->clabe,
                "name"                  => $charge->payment_method->name,
                "order_id"              => $charge->order_id,
                "dueDate"               => $dueDate,
                "buyDate"               => $now,
            );


            $fileName = "ord-".$order->getVirtualColumn('Serie')."-".$order->getFolio()."-".str_pad($orderHistory->getId(),6,"0",STR_PAD_LEFT)."-". Carbon::now()->format('Y-m-d_H.i.s').'.pdf';

            $pdf = PDF::loadView('app.paymentsPdfs.paymentOpenpaySpei',[
                'order' => $order->toArray(),
                'datosPago'=> $datosPago,
                'user'=> $client->toArray()
            ]);
            $pdf->save(public_path() . "/openpay/OpenpaySpei/{$fileName}");
            $orderHistory->setUid($charge->id)
            ->setVoucher($fileName)
            ->save();

            $pay = OrderHistoryQuery::create()
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->usePaymentStatusQuery('Status')
                ->withColumn('Status.Description', 'DescriptionStatus')
            ->endUse()
            ->findOneById($orderHistory->getId())
            ->toArray();

            return response()->json([
                'success' => true,
                'errorMsg' => '',
                'pay' => $pay
            ], 200);

        } catch (OpenpayApiTransactionError $e) {
            Log::info('ERROR --> OpenpayApiTransactionError');
            /*
            error_log('ERROR on the transaction: ' . $e->getMessage() .
                ' [error code: ' . $e->getErrorCode() .
                ', error category: ' . $e->getCategory() .
                ', HTTP code: '. $e->getHttpCode() .
                ', request ID: ' . $e->getRequestId() . ']', 0);
            */
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));

        } catch (OpenpayApiRequestError $e) {
            Log::info('ERROR --> OpenpayApiRequestError');
            //error_log('ERROR on the request: ' . $e->getMessage(), 0);
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));

        } catch (OpenpayApiConnectionError $e) {
            Log::info('ERROR --> OpenpayApiConnectionError');
            //error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));

        } catch (OpenpayApiAuthError $e) {
            Log::info('ERROR --> OpenpayApiAuthError');
            Log::info('ERROR on the authentication: ' . $e->getMessage());
            //error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));

        } catch (OpenpayApiError $e) {
            Log::info('ERROR --> OpenpayApiError');
            //error_log('ERROR on the API: ' . $e->getMessage(), 0);
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));
        }
    }

    public function paymentOpenpayStore(Request $request){
        $id_order = $request->get('id_order');
        $amount = $request->get('amount');
        Log::info($request->all());
        //$amount = 100;

        $now = Carbon::now();
        $expiration = Carbon::parse(Carbon::now())->addDays(3)->format('Y-m-d\TH:i:s');
        $dueDate = Carbon::parse(Carbon::now())->addDays(3)->format('Y-m-d H:i:s');

        $order = OrdersQuery::create()
        ->useBranchOfficesQuery('Branch')
            ->withColumn('Branch.Series', 'Serie')
        ->endUse()
        ->useOrderStatusQuery('Status')
            ->withColumn('Status.Description', 'OrderStatus')
            ->withColumn('Status.Color', 'Color')
        ->endUse()
        ->usePrioritiesQuery('Priority')
            ->withColumn('Priority.Description', 'DescriptionPriority')
        ->endUse()
        ->useUsersRelatedByIdClientUserQuery('Client')
            ->withColumn('Client.Name', 'NameClient')
        ->endUse()
        ->findOneById($id_order);

        $client = UsersQuery::create()
        ->findOneById($order->getIdClientUser());

        $idStatus = 1;

        $orderHistory = new \OrderHistory();
        $orderHistory->setIdOrder($order->getId())
            ->setIdOrderStatus($order->getIdOrderStatus())
            ->setAmountPaid($amount)
            ->setTotalPaid($order->getAmountPaid())
            ->setIdPaymentMethod(5)
            ->setIdPaymentStatus($idStatus)
            ->setIdUser($order->getIdClientUser())
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();
        
        $openpay = Openpay::getInstance(
            $this->merchanId,
            $this->privateKey);

        $customer = array(
            'name' => $client->getName(),
            'last_name' => '',
            'phone_number' => '',
            'email' => $client->getEmail()
        );

        $orderId = "ord-".$order->getVirtualColumn('Serie')."-".$order->getFolio()."-".str_pad($orderHistory->getId(),6,"0",STR_PAD_LEFT)."-".date('Hi');
        Log::info("OID: ".$order);

        Openpay::setProductionMode(false);

        try{

            $chargeRequest = array(
                'method' => 'store',
                'amount' => $amount,
                'description' => 'Orden '.$order->getVirtualColumn('Serie')."-".$order->getFolio(),
                'order_id' => $orderId,
                'due_date' => $expiration,
                'customer' => $customer
            );

            $charge = $openpay->charges->create($chargeRequest);

            $datosPago = array(
                "id"                    => $charge->id,
                "amount"                => $charge->amount,
                "reference"             => $charge->payment_method->reference,
                "barcode_url"           => $charge->payment_method->barcode_url,
                "order_id"              => $charge->order_id,
                "dueDate"               => $dueDate,
                "buyDate"               => $now,
            );


            $fileName = "ord-".$order->getVirtualColumn('Serie')."-".$order->getFolio()."-".str_pad($orderHistory->getId(),6,"0",STR_PAD_LEFT)."-". Carbon::now()->format('Y-m-d_H.i.s').'.pdf';

            $pdf = PDF::loadView('app.paymentsPdfs.paymentOpenpayStore',[
                'order' => $order->toArray(),
                'datosPago'=> $datosPago,
                'user'=> $client->toArray()
            ]);
            $pdf->save(public_path() . "/openpay/OpenpayStore/{$fileName}");
            $orderHistory->setUid($charge->id)
            ->setVoucher($fileName)
            ->save();

            $pay = OrderHistoryQuery::create()
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->usePaymentStatusQuery('Status')
                ->withColumn('Status.Description', 'DescriptionStatus')
            ->endUse()
            ->findOneById($orderHistory->getId())
            ->toArray();

            return response()->json([
                'success' => true,
                'pay' => $pay
            ], 200);

        } catch (OpenpayApiTransactionError $e) {
            Log::info('ERROR --> OpenpayApiTransactionError');
            /*
            error_log('ERROR on the transaction: ' . $e->getMessage() .
                ' [error code: ' . $e->getErrorCode() .
                ', error category: ' . $e->getCategory() .
                ', HTTP code: '. $e->getHttpCode() .
                ', request ID: ' . $e->getRequestId() . ']', 0);
            */
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));

        } catch (OpenpayApiRequestError $e) {
            Log::info('ERROR --> OpenpayApiRequestError');
            //error_log('ERROR on the request: ' . $e->getMessage(), 0);
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));

        } catch (OpenpayApiConnectionError $e) {
            Log::info('ERROR --> OpenpayApiConnectionError');
            //error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));

        } catch (OpenpayApiAuthError $e) {
            Log::info('ERROR --> OpenpayApiAuthError');
            Log::info('ERROR on the authentication: ' . $e->getMessage());
            //error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));

        } catch (OpenpayApiError $e) {
            Log::info('ERROR --> OpenpayApiError');
            //error_log('ERROR on the API: ' . $e->getMessage(), 0);
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "El cargo no pudo ser generado, intentelo mas tarde."
            ));
        }
    }

    public function downloadVoucher(Request $request){
        $cve = $request->get('cve');

        Log::info($cve);

        $payment = OrderHistoryQuery::create()
        ->findOneById($cve);
            
        $ruta = "";
        switch ($payment->getIdPaymentMethod()){
            case 2:
                $ruta = public_path() . "/openpay/OpenpayCard/{$payment->getVoucher()}";
                break;
            case 4:
                $ruta = public_path() . "/openpay/OpenpaySpei/{$payment->getVoucher()}";
                break;
            case 5:
                $ruta = public_path() . "/openpay/OpenpayStore/{$payment->getVoucher()}";
                break;
        }

        $headers = array(
            'Content-Type: application/pdf',
        );

        //return Response::download($file, 'filename.pdf', $headers);

        return response()->download($ruta, $payment->getVoucher(), $headers);
    }

}
