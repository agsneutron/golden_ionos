<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Propel\Runtime\ActiveQuery\Criteria;
use Validator;

class PermitsController extends Controller
{
    private $viewName = "permits";

    public function index(){

        $types = \UserTypesQuery::create()
            ->filterById(Auth::user()->id_user_type, Criteria::GREATER_THAN)
            ->find();

        return view('app.permits.main')
            ->with('types', $types->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function editPermits(Request $request){
        $cve = $request->get('cve');

        $type = \UserTypesQuery::create()
            ->findOneById($cve);

        $permits = \ProfilePermissionsQuery::create()
            ->select(array('IdModule'))
            ->filterByIdUserType($cve)
            ->find();

        $groups = \GroupsQuery::create()
            ->find()->toArray();

        for($i = 0; $i < count($groups); $i++){
            $groups[$i]['modules'] = \ModulesQuery::create()
                ->filterByIdGroup($groups[$i]['Id'])
                ->find()->toArray();
        }

        return view('app.permits.permits')
            ->with('type', $type->toArray())
            ->with('groups', $groups)
            ->with('permits', $permits->toArray());
    }

    public function changePermission(Request $request){
        $permission = $request->get('permission');
        $moduleId = $request->get('moduleId');
        $profileSelected = $request->get('profileSelected');

        if($permission == 1){
            $access = new \ProfilePermissions();
            $access->setIdModule($moduleId)
                ->setIdUserType($profileSelected)
                ->save();
        }else{
            $access = \ProfilePermissionsQuery::create()
                ->filterByIdModule($moduleId)
                ->findOneByIdUserType($profileSelected);

            $access->delete();
        }
    }

    public function changeFlag(Request $request){
        $flag = $request->get('flag');
        $profileSelected = $request->get('profileSelected');

        $type = \UserTypesQuery::create()
            ->findOneById($profileSelected);
        $type->setFlagAsignedBranch($flag)
            ->save();
    }

    public function saveProfile(Request $request){
        $arrayErrores = $this->validateFormProfile($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id',0);
            $Description  = $request->get('Description');
            $FlagAsignedBranch  = $request->get('FlagAsignedBranch');

            //Log::info($request->all());

            $now = Carbon::now();
            $profile = new \UserTypes();
            $profile->setCreatedAt($now)
                ->setUpdatedAt($now)
                ->setDescription($Description)
                ->setFlagAsignedBranch($FlagAsignedBranch)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Perfil guardado correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function validateFormProfile(Request $request){
        $reglas = [
            'Description' => 'required',
        ];

        $mensajes = [
            'Description.required' => 'Ingresa el nombre del perfil',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }
}
