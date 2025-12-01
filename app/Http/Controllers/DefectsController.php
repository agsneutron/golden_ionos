<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class DefectsController extends Controller
{
    private $viewName = "defects";

    public function index(){

        return view('app.defects.main')
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){
        $defects = \DefectsQuery::create()
            ->find();

        return view('app.defects.table')
            ->with('defects', $defects->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $defect = \DefectsQuery::create()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $defect->toArray()
        ));
    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormDefects($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id',0);
            $Description  = $request->get('Description');

            //Log::info($request->all());

            $now = Carbon::now();
            if($Id == 0){
                $defect = new \Defects();
                $defect->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $defect = \DefectsQuery::create()
                    ->findOneById($Id);
                $defect->setUpdatedAt($now);
            }

            $defect->setDescription($Description)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Defecto guardado correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }


    public function delete(Request $request){
        $cve = $request->get('cve');

        $defect = \DefectsQuery::create()
            ->findOneById($cve);

        $detailOrder = \OrderDetailQuery::create()
            ->findOneByIdDefect($cve);

        if($detailOrder == null){
            $defect->delete();

            return json_encode(["success" => true, "errorMsg" => "Defecto eliminado correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, el artículo tiene información ligada"]);
        }
    }

    public function valdateFormDefects(Request $request){
        $reglas = [
            'Description' => 'required',
        ];

        $mensajes = [
            'Description.required' => 'Ingresa la descripción del defecto',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }
}
