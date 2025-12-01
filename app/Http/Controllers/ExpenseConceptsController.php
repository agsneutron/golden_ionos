<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class ExpenseConceptsController extends Controller
{
    private $viewName = "expense_concepts";

    public function index(){

        return view('app.expense_concepts.main')
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){


        $concepts = \ExpenseConceptsQuery::create()
            ->find();

        return view('app.expense_concepts.table')
            ->with('concepts', $concepts->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $concept = \ExpenseConceptsQuery::create()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $concept->toArray()
        ));
    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormColors($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id',0);
            $Description  = $request->get('Description');

            //Log::info($request->all());

            $now = Carbon::now();
            if($Id == 0){
                $concept = new \ExpenseConcepts();
                $concept->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $concept = \ExpenseConceptsQuery::create()
                    ->findOneById($Id);
                $concept->setUpdatedAt($now);
            }

            $concept->setDescription($Description)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Concepto guardado correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function delete(Request $request){
        $cve = $request->get('cve');

        $concept = \ExpenseConceptsQuery::create()
            ->findOneById($cve);

        $expenseReport = \ExpenseReportsQuery::create()
            ->findOneByIdExpenseConcept($cve);

        if($expenseReport == null){

            $concept->delete();

            return json_encode(["success" => true, "errorMsg" => "Concepto eliminado correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, el estampado tiene información ligada"]);
        }
    }

    public function valdateFormColors(Request $request){
        $reglas = [
            'Description' => 'required',
        ];

        $mensajes = [
            'Description.required' => 'Ingresa la descripción del concepto',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }
}
