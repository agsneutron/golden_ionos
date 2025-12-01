<?php

namespace App\Http\Controllers;

use BranchOfficeServicesQuery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OrderDetailQuery;
use ServicesQuery;
use Validator;

class ServicesController extends Controller
{
    private $viewName = "services";

    public function index()
    {
        return view('app.services.main')
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function tableCategories(){

        $categories = \ServiceCategoriesQuery::create()
            ->find();

        return view('app.services.tableCategories')
            ->with('categories', $categories->toArray());
    }

    public function tableServices(Request $request){
        $cve = $request->get('cve');

        $services = \ServicesQuery::create()
            ->filterByIdServiceCategory($cve)
            ->useServiceCategoriesQuery('Category')
                ->withColumn('Category.Description','CategoryName')
            ->endUse()
            ->find();

        return view('app.services.tableServices')
            ->with('services', $services->toArray());
    }

    public function editCategory(Request $request){
        $cve = $request->get('cve');

        $category = \ServiceCategoriesQuery::create()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $category->toArray()
        ));
    }

    public function editService(Request $request){
        $cve = $request->get('cve');

        $service = \ServicesQuery::create('Service')
            ->withColumn('Service.Id', 'IdService')
            ->withColumn('Service.IdServiceCategory', 'IdCategory')
            ->withColumn('Service.Description', 'DescriptionService')
            ->findOneById($cve);

        Log::info($service);

        return json_encode(array(
            'success' => true,
            'data' => $service->toArray()
        ));
    }

    public function saveCategory(Request $request){
        $arrayErrores = $this->valdateFormCategory($request);
        if ( empty($arrayErrores) ) {
            $Id        = $request->get('Id',0);
            $Description      = $request->get('Description');


            $now = Carbon::now();
            if($Id == 0){
                $category = new \ServiceCategories();
                $category->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $category = \ServiceCategoriesQuery::create()
                    ->findOneById($Id);
                $category->setUpdatedAt($now);
            }

            $category->setDescription($Description)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Categoria guardada correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function saveService(Request $request){
        $arrayErrores = $this->valdateFormService($request);
        if ( empty($arrayErrores) ) {
            $IdCategory        = $request->get('IdCategory',0);
            $IdService        = $request->get('IdService',0);
            $DescriptionService      = $request->get('DescriptionService');
            $NormalPrice      = $request->get('NormalPrice');
            $UrgentPrice      = $request->get('UrgentPrice');
            $ExtraUrgentPrice      = $request->get('ExtraUrgentPrice');


            $now = Carbon::now();
            if($IdService == 0){
                $service = new \Services();
                $service->setIdServiceCategory($IdCategory)
                    ->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $service = \ServicesQuery::create()
                    ->findOneById($IdService);
                $service->setUpdatedAt($now);
            }

            $service->setDescription($DescriptionService)
                ->setNormalPrice($NormalPrice)
                ->setUrgentPrice($UrgentPrice)
                ->setExtraUrgentPrice($ExtraUrgentPrice)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Categoria guardada correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function deleteCategory(Request $request){
        $cve = $request->get('cve');

        $category = \ServiceCategoriesQuery::create()
            ->findOneById($cve);

        $services = \ServicesQuery::create()
            ->findOneByIdServiceCategory($cve);

        if($services == null){

            $category->delete();

            return json_encode(["success" => true, "errorMsg" => "Categoría eliminada correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, la categoría tiene información ligada"]);
        }
    }

    public function deleteService(Request $request){
        $cve = $request->get('cve');

        $service = \ServicesQuery::create()
            ->findOneById($cve);

        $detailOrder = \OrderDetailQuery::create()
            ->findOneByIdService($cve);

        if($detailOrder == null){

            $service->delete();

            return json_encode(["success" => true, "errorMsg" => "Servicio eliminado correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, la categoría tiene información ligada"]);
        }
    }

    public function unifyServices(Request $request){
        $ids = $request->get('ids');
        $mainId = array_shift($ids);

        Log::info($ids);
        Log::info($mainId);

        $services = ServicesQuery::create()
        ->filterById($ids)
        ->find();

        foreach($services as $service){
            $branchServices = BranchOfficeServicesQuery::create()
            ->filterByIdService($service->getId())
            ->update(array('IdService' => $mainId));

            $detais = OrderDetailQuery::create()
            ->filterByIdService($service->getId())
            ->update(array('IdService' => $mainId));

            $service->delete();
        }

        return json_encode(['success' => true, 'errorMsg' => 'Servicios unificados correctamente']);

    }

    public function valdateFormCategory(Request $request){
        $reglas = [
            'Description' => 'required',
        ];

        $mensajes = [
            'Description.required' => 'Ingresa la descripción de la categoría',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function valdateFormService(Request $request){
        $reglas = [
            'DescriptionService' => 'required',
            'NormalPrice' => 'required|numeric',
            'UrgentPrice' => 'required|numeric',
            'ExtraUrgentPrice' => 'required|numeric',
        ];

        $mensajes = [
            'DescriptionService.required' => 'Ingresa la descripción del servicio',
            'NormalPrice.required' => 'Ingresa el precio normal',
            'NormalPrice.numeric' => 'Ingresa un número valido para el precio normal',
            'UrgentPrice.required' => 'Ingresa el precio urgente',
            'UrgentPrice.numeric' => 'Ingresa un número valido para el precio urgente',
            'ExtraUrgentPrice.required' => 'Ingresa el precio extra urgente',
            'ExtraUrgentPrice.numeric' => 'Ingresa un número valido para el precio extra urgente',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }
}
