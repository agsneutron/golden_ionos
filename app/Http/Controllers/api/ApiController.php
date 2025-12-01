<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DeliveriesQuery;
use Illuminate\Support\Facades\Log;
use OrderHistoryQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class ApiController extends Controller
{
    public function ajust_deliveries(){
        $deliveries = DeliveriesQuery::create()
        ->useOrdersQuery('Ord')
            ->withColumn('Ord.RealDeliveryDate', 'OrdRealDeliveryDate')
            ->withColumn('Ord.DeliveryDate', 'OrdDeliveryDate')
            ->withColumn('Ord.Folio', 'OrdFolio')
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Series', 'BranchSerie')
            ->endUse()
            ->filterByIdOrderStatus(6, Criteria::GREATER_EQUAL)
        ->endUse()
        ->find();


        $n = 0;
        $orders = array();
        foreach($deliveries as $delivery){
            $real_delivery = explode('-', $delivery->getVirtualColumn('OrdRealDeliveryDate'));

            $order = array(
                'id_order' => $delivery->getIdOrder(),
                'folio_order' => $delivery->getVirtualColumn('BranchSerie')."-".$delivery->getVirtualColumn('OrdFolio'),
                'id_delivery' => $delivery->getId(),
                'current_date' => $delivery->getDayDelivery(),
                'aux' => $real_delivery
            );

            $delivery->setDayDelivery($delivery->getVirtualColumn('OrdDeliveryDate'))
                ->save();

                $order['real_date'] = $delivery->getVirtualColumn('OrdDeliveryDate');

                $n++;

            // if(isset($real_delivery[1]) && isset($real_delivery[2]) && isset($real_delivery[0]) ){
            //     if(  checkdate($real_delivery[1], $real_delivery[2], $real_delivery[0])){                        

            //         $delivery->setDayDelivery($delivery->getVirtualColumn('OrdRealDeliveryDate'))
            //         ->save();
            //         $order['real_date'] = $delivery->getVirtualColumn('OrdRealDeliveryDate');
            //         $n++;
            //     } 
            // }else{
            //     $delivery->setDayDelivery($delivery->getVirtualColumn('OrdDeliveryDate'))
            //     ->save();

            //     $order['real_date'] = $delivery->getVirtualColumn('OrdDeliveryDate');

            //     $n++;
            // }   
                
            array_push($orders, $order);
        }

        return json_encode([
            "Entregas actualizadas" => $n,    
            "V" => 4  ,
            "orders" =>$orders     
        ]);
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
