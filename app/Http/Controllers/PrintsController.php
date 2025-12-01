<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class PrintsController extends Controller
{
    private $viewName = "prints";

    public function index(){

        return view('app.prints.main')
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){

        $prints = \PrintsQuery::create()
            ->find();

        return view('app.prints.table')
            ->with('prints', $prints->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $print = \PrintsQuery::create()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $print->toArray()
        ));
    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormPrints($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id',0);
            $Description  = $request->get('Description');

            //Log::info($request->all());

            $now = Carbon::now();
            if($Id == 0){
                $print = new \Prints();
                $print->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $print = \PrintsQuery::create()
                    ->findOneById($Id);
                $print->setUpdatedAt($now);
            }


            $print->setDescription($Description)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Estampado guardado correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }


    public function delete(Request $request){
        $cve = $request->get('cve');

        $print = \PrintsQuery::create()
            ->findOneById($cve);

        $detailOrder = \OrderDetailQuery::create()
            ->findOneByIdPrint($cve);

        if($detailOrder == null){

            $print->delete();

            return json_encode(["success" => true, "errorMsg" => "Estampado eliminado correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, el estampado tiene información ligada"]);
        }
    }

    public function valdateFormPrints(Request $request){
        $reglas = [
            'Description' => 'required',
        ];

        $mensajes = [
            'Description.required' => 'Ingresa la descripción del estampado',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }
}
