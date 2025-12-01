<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class ColorsController extends Controller
{
    private $viewName = "colors";

    public function index(){

        return view('app.colors.main')
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){

        $colors = \ColorsQuery::create()
            ->find();

        return view('app.colors.table')
            ->with('colors', $colors->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $color = \ColorsQuery::create()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $color->toArray()
        ));
    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormColors($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id',0);
            $Description  = $request->get('Description');
            $Code  = $request->get('Code');

            //Log::info($request->all());

            $now = Carbon::now();
            if($Id == 0){
                $color = new \Colors();
                $color->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $color = \ColorsQuery::create()
                    ->findOneById($Id);
                $color->setUpdatedAt($now);
            }

            $color->setDescription($Description)
                ->setCode($Code)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Color guardado correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function delete(Request $request){
        $cve = $request->get('cve');

        $color = \ColorsQuery::create()
            ->findOneById($cve);

        $detailOrder = \OrderDetailQuery::create()
            ->findOneByIdColor($color);

        if($detailOrder == null){

            $color->delete();

            return json_encode(["success" => true, "errorMsg" => "Color eliminado correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, el estampado tiene información ligada"]);
        }
    }

    public function valdateFormColors(Request $request){
        $reglas = [
            'Description' => 'required',
            'Code' => 'required',
        ];

        $mensajes = [
            'Description.required' => 'Ingresa la descripción del color',
            'Code.required' => 'Ingresa el código del color',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }
}
