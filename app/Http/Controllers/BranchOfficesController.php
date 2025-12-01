<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class BranchOfficesController extends Controller
{
    private $viewName = "branch_offices";

    public function index(){

        return view('app.branch_offices.main')
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){

        $branchs = \BranchOfficesQuery::create()
            ->orderByName()
            ->find();

        return view('app.branch_offices.table')
            ->with('branchs', $branchs->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $branchOffice = \BranchOfficesQuery::create()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $branchOffice->toArray()
        ));
    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormBranchOffice($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id',0);
            $Name  = $request->get('Name');
            $Address  = $request->get('Address');
            $PostalCode = $request->get('PostalCode');
            $Phone  = $request->get('Phone');
            $Series = $request->get('Series');
            $Rfc = $request->get('Rfc');
            $Email = $request->get('Email');
            $Legend = $request->get('Legend');

            //Log::info($request->all());

            $now = Carbon::now();
            if($Id == 0){
                $branchOffice = new \BranchOffices();
                $branchOffice->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $branchOffice = \BranchOfficesQuery::create()
                    ->findOneById($Id);
                $branchOffice->setUpdatedAt($now);
            }

            $branchOffice->setName($Name)
                ->setAddress($Address)
                ->setPostalCode($PostalCode)
                ->setPhone($Phone)
                ->setSeries($Series)
                ->setRfc($Rfc)
                ->setEmail($Email)
                ->setLegend($Legend)
                ->save();


            return json_encode(['success' => true, 'errorMsg' => 'Sucursal guardada correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function delete(Request $request){
        $cve = $request->get('cve');

        $branchOffice = \BranchOfficesQuery::create()
            ->findOneById($cve);

        $order = \OrdersQuery::create()
            ->findOneByIdBranchOffice($cve);


        if($order == null){

            $branchOffice->delete();

            return json_encode(["success" => true, "errorMsg" => "Sucursal eliminada correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, la sucursal tiene información ligada"]);
        }
    }

    public function valdateFormBranchOffice(Request $request){
        $reglas = [
            'Id' => 'required',
            'Name' => 'required',
            'Address' => 'required',
            'Phone' => 'required',
            'Series' => 'required',
            'Rfc' => 'required',
            'Email' => 'required|email',
            'Legend' => 'required',
            'PostalCode' => 'required',
        ];

        $mensajes = [
            'Name.required' => 'Ingresa el nombre de la sucursal',
            'Address.required' => 'Ingresa la dirección de la sucursal',
            'Phone.required' => 'Ingresa el teléfono de la sucursal',
            'Series.required' => 'Ingresa la serie de la sucursal',
            'Rfc.required' => 'Ingresa el RFC de la sucursal',
            'Email.required' => 'Ingresa el correo electrónico',
            'Email.email' => 'Ingresa un correo electrónico válido',
            'Legend.required' => 'Ingresa una leyenda',
            'PostalCode.required' => 'Ingresa el código postal de la sucursal',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

}
