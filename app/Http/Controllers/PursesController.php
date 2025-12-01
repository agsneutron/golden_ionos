<?php

namespace App\Http\Controllers;

use Base\ElectronicPurseHistoryQuery as BaseElectronicPurseHistoryQuery;
use Carbon\Carbon;
use ElectronicPurseHistory;
use ElectronicPurseHistoryQuery;
use ElectronicPurseQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Propel\Runtime\ActiveQuery\Criteria;
use Validator;

class PursesController extends Controller
{
    private $viewName = "purses";

    public function index()
    {

        $clients = \UsersQuery::create()
            ->select(array('Id','Name', 'Address'))
            ->filterByIdUserType(4)
            ->find();

        return view('app.purses.main')
            ->with('clients', $clients->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){

        $purses = \ElectronicPurseQuery::create()
                ->useUsersQuery('Client')
                    ->withColumn('Client.Name', 'NameClient')
                    ->withColumn('Client.Address', 'AddressClient')
                ->endUse()
                ->find();

        return view('app.purses.table')
            ->with('purses', $purses->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $electronic = ElectronicPurseQuery::create()
        ->withColumn('Code','CodePurse')
        ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $electronic->toArray()
        ));

    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormPurse($request);
        Log::info($request->all());
        if ( empty($arrayErrores) ) {

            $Id = $request->get('Id');
            $IdClientUser = $request->get('IdClientUser');
            $CodePurse = $request->get('CodePurse');
            $Amount = $request->get('Amount', 0);

            $purseRegisted = \ElectronicPurseQuery::create()
                ->filterByIdClientUser($IdClientUser, Criteria::NOT_EQUAL)
                ->filterbyId($Id, Criteria::NOT_EQUAL)
                ->findOneByCode($CodePurse);
            if($purseRegisted == null){

                $clientWithPurse = \ElectronicPurseQuery::create()
                    ->filterbyId($Id, Criteria::NOT_EQUAL)
                    ->findOneByIdClientUser($IdClientUser);
                if($clientWithPurse == null){

                    if($Id == 0){
                        $electronic = new \ElectronicPurse();
                    }else{
                        $electronic = ElectronicPurseQuery::create()
                        ->findOneById($Id);
                    }

                    $electronic->setCode($CodePurse)
                        ->setIdClientUser($IdClientUser)
                        ->setAmount($Amount)
                        ->save();

                    return json_encode(['success' => true, 'errorMsg' => 'Monedero electrónico registrado']);
                }else{
                    return json_encode(['success' => false, 'errorMsg' => 'El cliente ya cuenta con un monedero registrado']);
                }
            }else{
                return json_encode(['success' => false, 'errorMsg' => 'El monedero electrónico ya se encuentra asignado a un cliente']);
            }
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function add_amount(Request $request){
        Log::info($request->all());
        $arrayErrores = $this->valdateFormAddAmountPurse($request);
        if ( empty($arrayErrores) ) {

            $IdPurse = $request->get('IdPurse');
            $Concept = $request->get('Concept');
            $AmountToAdd = $request->get('AmountToAdd');

            $now = Carbon::now();

            $electronic = ElectronicPurseQuery::create()
            ->findOneById($IdPurse);

            $electronic->setAmount($electronic->getAmount() +  $AmountToAdd)
            ->save();

            $history = new ElectronicPurseHistory();
            $history->setIdElectronicPurse($IdPurse)
            ->setAmount($AmountToAdd)
            ->setDescription($Concept)
            ->setMovementType(1)
            ->setIdOrder(null)
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Monto agregado correctamente']);

        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function showPurseHistory(Request $request){
        $cve = $request->get('cve');

        $history = BaseElectronicPurseHistoryQuery::create()
        ->filterByIdElectronicPurse($cve)
        ->orderByCreatedAt('DESC')
        ->useOrdersQuery('Ord')
            ->withColumn('Ord.Folio', 'Folio')
            ->useBranchOfficesQuery('Br')
                ->withColumn('Br.Series', 'Serie')
            ->endUse()
        ->endUse()
        ->find()
        ->toArray();

        $history2 = BaseElectronicPurseHistoryQuery::create()
        ->filterByIdElectronicPurse($cve)
        ->filterByIdOrder(null)
        ->withColumn("CONCAT('','')", 'Folio')
        ->withColumn("CONCAT('','')", 'Serie')
        ->orderByCreatedAt('DESC')        
        ->find()
        ->toArray();
       
        $result = array_merge($history, $history2);

        return view('app.purses.tablePurseHistory')
            ->with('records', $result);

    }

    public function delete(Request $request){
        $cve = $request->get('cve');

        $electronic = ElectronicPurseQuery::create()
        ->findOneById($cve);

        $history = ElectronicPurseHistoryQuery::create()
        ->filterByIdElectronicPurse($cve)
        ->find()->delete();

        $electronic->delete();

        return json_encode(['success' => true, 'errorMsg' => 'Monedero electrónico eliminado']);
    }

    public function valdateFormPurse(Request $request){
        $reglas = [
            'IdClientUser' => 'required|numeric|min:1',
            'CodePurse' => 'required',
        ];

        $mensajes = [
            'IdClientUser.required' => 'Selecciona el cliente',
            'IdClientUser.numeric' => 'Selecciona el cliente',
            'IdClientUser.min' => 'Selecciona el cliente',
            'CodePurse.required' => 'Ingresa el código del monedero',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function valdateFormAddAmountPurse(Request $request){
        $reglas = [
            'Concept' => 'required',
            'AmountToAdd' => 'required|numeric|min:1',
        ];

        $mensajes = [
            'Concept.required' => 'Ingresa el concepto',
            'AmountToAdd.required' => 'Ingresa el monto a agregar',
            'AmountToAdd.numeric' => 'Ingresa el monto a agregar',
            'AmountToAdd.min' => 'Ingresa el monto a agregar',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();

    }
}
