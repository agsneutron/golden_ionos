<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OrderHistoryQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use UsersQuery;

class ScriptsController extends Controller
{
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

    public function actualizarNombresClientes(){
        $users = UsersQuery::create()
            ->orderByName()
            ->find();
        
        $n = 0;
        foreach($users as $user){
            $name = $user->getName();
            $name = strtoupper($this->eliminar_tildes($name));

            $user->setName($name)
            ->save();
            $n++;
        }


        return json_encode(["success" => true, "errorMsg" => $n." Usuarios actualizados"]);
    }

    public function test_timezone(){
        $now = Carbon::now();
        Log::info($now);

        $hora = date("H:m:s");
        Log::info($hora);

        return $hora;
    }


    public function report_deliveries(){
        $orderHistory = OrderHistoryQuery::create()
            ->filterByDeletedPayment(0)
            ->filterByAmountPaid(0, Criteria::GREATER_THAN)
            ->usePaymentMethodsQuery('Payment')
                ->withColumn('Payment.Description', 'DescriptionPayment')
            ->endUse()
            ->useOrdersQuery('Ord')
                ->useBranchOfficesQuery('Branch')
                    ->withColumn('Branch.Series', 'Series')
                ->endUse()
                ->withColumn('Ord.Folio', 'Folio')
                ->withColumn('Ord.IdOrderStatus', 'OrderStatus')
                ->filterByCreatedAt(array("min" => '2024-01-01', "max" => "2024-12-31"))
                ->filterByHomeDelivery(NUll, Criteria::ISNOTNULL)
            ->endUse()
            ->find();

        return response()->json($orderHistory->toArray(), 200);
    }
}
