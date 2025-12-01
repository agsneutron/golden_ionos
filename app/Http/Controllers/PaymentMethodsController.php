<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class PaymentMethodsController extends Controller
{
    private $viewName = "payment_methods";

    public function index(){

        return view('app.payment_methods.main')
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){
        $paymentMethods = \PaymentMethodsQuery::create()
            ->find();

        return view('app.payment_methods.table')
            ->with('paymentMethods', $paymentMethods->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $paymentMethod = \PaymentMethodsQuery::create()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $paymentMethod->toArray()
        ));
    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormPaymentMethod($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id',0);
            $Description  = $request->get('Description');

            //Log::info($request->all());

            $now = Carbon::now();
            if($Id == 0){
                $paymentMethod = new \PaymentMethods();
                $paymentMethod->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $paymentMethod = \PaymentMethodsQuery::create()
                    ->findOneById($Id);
                $paymentMethod->setUpdatedAt($now);
            }

            $paymentMethod->setDescription($Description)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Método de pago guardado correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }


    public function delete(Request $request){
        $cve = $request->get('cve');

        $paymentMethod = \PaymentMethodsQuery::create()
            ->findOneById($cve);

        $detailOrder = \OrdersQuery::create()
            ->findOneByIdPaymentMethod($cve);

        if($detailOrder == null){
            $paymentMethod->delete();

            return json_encode(["success" => true, "errorMsg" => "Método de pago eliminado correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, el artículo tiene información ligada"]);
        }
    }

    public function valdateFormPaymentMethod(Request $request){
        $reglas = [
            'Description' => 'required',
        ];

        $mensajes = [
            'Description.required' => 'Ingresa la descripción del método de pago',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }
}
