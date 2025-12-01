<?php

namespace App\Http\Controllers;

use BranchOfficesQuery;
use Carbon\Carbon;
use PickupsQuery;
use OrderDetailQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OrderHistory;
use Orders;
use OrdersQuery;
use Pickups;
use Propel\Runtime\ActiveQuery\Criteria;
use UsersQuery;
use Validator;

class HarvestController extends Controller
{
    private $viewName = "harvest";

    public function index()
    {
        $branches = BranchOfficesQuery::create()
            ->find();

        $users = UsersQuery::create()
            ->filterByIdUserType(5)
            ->find();

        $clients = UsersQuery::create()
            ->filterByIdUserType(4)
            ->find();

        return view('app.harvest.main')  
            ->with('branches', $branches->toArray())
            ->with('users', $users->toArray())
            ->with('clients', $clients->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function searchHarvest(Request $request){
        $cve = $request->get('cve');

        $criteria = $cve == 0 ? Criteria::NOT_EQUAL : Criteria::EQUAL;       

        $pickups = PickupsQuery::create()
            ->withColumn("CONCAT(day_pickup,'T',time_pickup)",'start')
            ->withColumn("CONCAT(day_pickup,'T',time_pickup)",'end')
            ->withColumn("CONCAT('#37B7CF','')", 'color')
            ->withColumn("CONCAT('#373943','')", 'textColor')
            ->useOrdersQuery('Ord')
                ->filterByIdBranchOffice($cve, $criteria)
                ->filterByIdOrderStatus(1)
                ->withColumn('Ord.Folio', 'Folio')
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'Series')
                ->endUse()
                ->useUsersRelatedByIdClientUserQuery('Client')
                    ->withColumn('Client.Name', 'NameClient')
                ->endUse()
            ->endUse()
            ->withColumn("CONCAT(Series,'-',Folio,' > ',Client.Name)", 'title');


        $pickups = $pickups->find()->toArray();
        for($i=0; $i < count($pickups); $i++){
            $pickups[$i]['allDay'] = false;
        }
        return json_encode(Array(
            "success" => true,
            "errorMsg" => "",
            "events" => $pickups
        ));
    }

    public function save(Request $request){
        $IdBranchOffice = $request->get('IdBranchOffice');
        $Id = $request->get('Id');
        $IdClientUser = $request->get('IdClientUser');
        $IdAssignedUser = $request->get('IdAssignedUser');
        $DayPickup = $request->get('DayPickup');
        $TimePickup = $request->get('TimePickup');
        $Comments = $request->get('Comments');

        $IdPriority = 1;

        $currentDate = $DayPickup;
        $DeliveryDate = strtotime ( '+2 day' , strtotime ( $currentDate ) ) ;
        $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );

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


        $lastFolio = OrdersQuery::create()
                ->filterByIdBranchOffice($IdBranchOffice)
                //->filterByReceptionDate(array('min' => date('Y').'-01-01','max' => $nextYear.'-01-01'))
                ->orderByFolio('DESC')
                ->findOne();
        if($lastFolio != null){
            $currentFolio = $lastFolio->getFolio() + 1;
        }else{
            $currentFolio = 1;
        }

        $now = Carbon::now();
        
        if($Id == 0){
            $order = new Orders();     
            $order->setIdBranchOffice($IdBranchOffice)
            ->setFolio($currentFolio)
            ->setReceptionDate($DayPickup)
            ->setReceptionTime($TimePickup)
            ->setDeliveryDate($DeliveryDate)
            ->setDeliveryTime('17:30:00')
            ->setIdPriority($IdPriority)
            ->setIdOrderStatus(1)
            ->setIdUser(auth()->user()->id)
            ->setIdClientUser($IdClientUser)
            ->setIdPaymentMethod(1)
            ->setCreatedAt($DayPickup." ".$TimePickup)
            ->setUpdatedAt($DayPickup." ".$TimePickup)
            ->save();

            $pick_up = new Pickups();
            $pick_up
            ->setIdOrder($order->getId())         
            ->setCreatedAt($now)
            ->setUpdatedAt($now);
        }else{
            $pick_up = PickupsQuery::create()
            ->findOneById($Id);

            $pick_up->setCreatedAt($now)
            ->setUpdatedAt($now);
        }


        $pick_up->setIdAssignedUser($IdAssignedUser)
        ->setDayPickup($DayPickup)
        ->setTimePickup($TimePickup)
        ->setStatus(0)
        ->setHarvestComments($Comments)
        ->save();

        return json_encode([
            'success' => true,
            'errorMsg' => 'Recolección guardada correctamente'
        ]);
    }

    public function saveClient(Request $request){
        $arrayErrores = $this->valdateFormClient($request);
        if ( empty($arrayErrores) ) {
            $Name      = $this->eliminar_tildes($request->get('Name'));
            $Phone     = $request->get('Phone');
            $Address     = $request->get('Address');
            $Suburb     = $request->get('Suburb');
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
                ->setSuburb($Suburb)
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

    public function load_table(Request $request){
        $filterBranchOffice = $request->get('filterBranchOffice');
        $dia = $request->get('dia');

        $criteria = $filterBranchOffice == 0 ? Criteria::NOT_EQUAL : Criteria::EQUAL;

        $pickups = PickupsQuery::create()
        ->filterByDayPickup($dia)
        ->withColumn("CONCAT(day_pickup,'T',time_pickup)",'start')
        ->withColumn("CONCAT(day_pickup,'T',day_pickup)",'end')
        ->withColumn("CONCAT('#37B7CF','')", 'color')
        ->withColumn("CONCAT('#373943','')", 'textColor')
        ->useOrdersQuery('Ord')
            ->filterByIdBranchOffice($filterBranchOffice, $criteria)
            ->filterByIdOrderStatus(1)
            ->withColumn('Ord.Folio', 'Folio')
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

        return view('app.harvest.table')  
            ->with('pickups', $pickups->toArray())            
            ->with('modules', $this->getAllowedModules());
    }

    public function reschedule(Request $request){
        $id = $request->get('id');

        $pick_up = PickupsQuery::create()
            ->findOneById($id);

        $pickup_date = $pick_up->getDayPickup();
        $pickup_date = strtotime ( '+1 day' , strtotime ( $pickup_date ) ) ;
        $pickup_date = date ( 'Y-m-j' , $pickup_date );

        $pick_up->setDayPickup($pickup_date)
        ->save();

        $order = OrdersQuery::create()
        ->findOneById($pick_up->getIdOrder());

        $DeliveryDate = $order->getDeliveryDate();
        $DeliveryDate = strtotime ( '+1 day' , strtotime ( $DeliveryDate ) ) ;
        $DeliveryDate = date ( 'Y-m-j' , $DeliveryDate );

        $order->setReceptionDate($pickup_date)
        ->setDeliveryDate($DeliveryDate)
        ->save();

        return json_encode([
            'success' => true,
            'errorMsg' => 'Recolección reprogramada para el día '.$pickup_date
        ]);
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

    /*
        API METHODS
    */
    public function getHarvests(Request $request){
        $userId = $request->get('userId');
        $dateHarvest = $request->get('dateHarvest');

        $harvests = PickupsQuery::create()
            ->filterByIdAssignedUser($userId)
            ->filterByDayPickup($dateHarvest)
            ->orderByTimePickup()
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

            for($i = 0; $i < count($harvests); $i++){
                $harvests[$i]['Items'] = OrderDetailQuery::create()
                ->filterByIdOrder($harvests[$i]['IdOrder'])
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

                $harvests[$i]['Unsaved'] = 0;
                $harvests[$i]['Payments'] = [];
                $harvests[$i]['AmountPaidHarvest'] = 0;
                $harvests[$i]['RemainingAmountHarvest'] = $harvests[$i]['Total'];
            }

            return response()->json(['harvests' => $harvests], 200);
    }

    public function saveHarvestCompleted(Request $request){
        Log::info($request->all());
        $data = $request->get('harvest');

        $photo = is_null($data['HarvestPhoto']) ? "" : $data['HarvestPhoto'];
        $signature = is_null($data['HarvestContactSignature']) ? "" : $data['HarvestContactSignature'];

        $pickup = PickupsQuery::create()
        ->findOneById($data['Id']);

        $order = $pickup->getOrders();

        $pickup->setRealPickupDate($data['RealPickupDate'])
        ->setRealPickupTime($data['RealPickupTime'])
        ->setHarvestComments($data['HarvestComments'])
        ->setHarvestContactName($data['HarvestContactName'])
        ->setHarvestContactSignature($signature)
        ->setHarvestPhoto($photo)
        ->setStatus(1)
        ->save();

        $order->setHarvestDate($data['RealPickupDate'])
        ->setHarvestTime($data['RealPickupTime'])
        ->setHarvestComments($data['HarvestComments'])
        ->setHarvestContactName($data['HarvestContactName'])
        ->setHarvestContactSignature($signature)
        ->setHarvestPhoto($photo)
        ->setIdOrderStatus(6)
        ->save();

        $payments = $data['Payments'];
        foreach($payments as $payment){
            $order->setIdPaymentMethod(1)
                ->setAmountPaid($order->getAmountPaid() + $payment['amount'])
                ->save();
            $this->registerOrderHistory($order, $payment['amount'], $data['IdAssignedUser']);
        }


        return ['success' => true, 'errorMsg' => 'Recolección completa'];
    }

    public function registerOrderHistory(\Orders $order, $amount, $IdUser){

        $now = Carbon::now();

        $orderHistory = new OrderHistory();
        $orderHistory->setIdOrder($order->getId())
            ->setIdOrderStatus($order->getIdOrderStatus())
            ->setAmountPaid($amount)
            ->setTotalPaid($order->getAmountPaid())
            ->setIdPaymentMethod($order->getIdPaymentMethod())
            ->setIdUser($IdUser)
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();
    }
}
