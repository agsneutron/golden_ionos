<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Propel\Runtime\ActiveQuery\Criteria;
use UsersQuery;
use Validator;

class UsersController extends Controller
{
    private $viewName = "users";

    public function privacyPolicies(){

        return view('app.privacyPolicies');

    }

    public function marketing(){

        return view('app.marketing');

    }

    public function index(){
        $userTypes = \UserTypesQuery::create()
            ->filterById(Auth::user()->id_user_type,Criteria::GREATER_THAN)
            ->find();

        $branches = \BranchOfficesQuery::create()
            ->find();

        return view('app.users.main')
            ->with('userTypes', $userTypes->toArray())
            ->with('branches', $branches->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){
        $usuarios = \UsersQuery::create()
            ->filterByIdUserType(Auth::user()->id_user_type,Criteria::GREATER_THAN)
            ->_and()
            ->filterByIdUserType(4,Criteria::NOT_EQUAL)
            ->useUserTypesQuery('user_type')
                ->withColumn('user_type.Description', 'user_type_description')
            ->endUse()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Name', 'NameBranch')
            ->endUse()
            ->find();

        return view('app.users.table')
            ->with('users', $usuarios->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $user = \UsersQuery::create()
            ->withColumn('Password','ConfPassword')
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $user->toArray()
        ));
    }

    public function save(Request $request){
        $arrayErrores = $this->valdateFormUser($request);
        if ( empty($arrayErrores) ) {
            $Id        = $request->get('Id',0);
            $Name      = $request->get('Name');
            $Email     = $request->get('Email');
            $Phone     = $request->get('Phone');
            $IdUserType = $request->get('IdUserType');
            $IdBranchOffice = $request->get('IdBranchOffice', 0);
            $Password  = $request->get('Password');

            //Log::info($request->all());

            $registedEmail = \UsersQuery::create()
                ->filterById($Id,Criteria::NOT_EQUAL)
                ->findOneByEmail($Email);
            if($registedEmail != null){
                return json_encode(["success" => false, "errorMsg" => 'El correo electrónico ingresado ya se encuentra registrado']);
            }

            if($IdBranchOffice == 0){
                $IdBranchOffice = null;
            }

            $now = Carbon::now();
            if($Id == 0){
                $user = new \Users();
                $user->setPassword(bcrypt($Password))
                    ->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $user = \UsersQuery::create()
                    ->findOneById($Id);
                $user->setUpdatedAt($now);
            }

            $user->setName($Name)
                ->setEmail($Email)
                ->setPhone($Phone)
                ->setIdUserType($IdUserType)
                ->setIdBranchOffice($IdBranchOffice)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Usuario guardado correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }


    public function delete(Request $request){
        $cve = $request->get('cve');

        $user = \UsersQuery::create()
            ->findOneById($cve);

        $order = \OrdersQuery::create()
            ->filterByIdUser($cve)
            ->_or()
            ->filterByIdClientUser($cve)
            ->findOne();


        if($order == null){

            $user->delete();

            return json_encode(["success" => true, "errorMsg" => "Usuario eliminado correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, el usuario tiene información ligada"]);
        }
    }

    public function changePassword(Request $request){
        $arrayErrores = $this->valdateFormNewPassword($request);
        if ( empty($arrayErrores) ) {

            $cve = $request->get('IdUser');
            $NewPassword = $request->get('NewPassword');

            $user = \UsersQuery::create()
                ->findOneById($cve);

            $user->setPassword(bcrypt($NewPassword))
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Nueva contraseña guardada correctamente']);
        }else{
            return json_encode(["success" => false, "errorMsg" => $arrayErrores[0]]);
        }
    }

    public function valdateFormUser(Request $request){
        $reglas = [
            'Id' => 'required',
            'Name' => 'required',
            'Email' => 'required|email',
            'Phone' => 'required',
            'IdUserType' => 'required|numeric|min:1',
            'Password' => 'required_if:Id,0|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'ConfPassword' => 'required_if:Id,0|same:Password'
        ];

        $mensajes = [
            'Name.required' => 'Ingresa el nombre del usuario',
            'Email.required' => 'Ingresa el correo electrónico',
            'Email.email' => 'Ingresa un correo electrónico válido',
            'Phone.required' => 'Ingresa un número telefónico',
            'IdUserType.required' => 'Selecciona un tipo de usuario',
            'IdUserType.numeric' => 'Selecciona un tipo de usuario',
            'IdUserType.min' => 'Selecciona un tipo de usuario',
            'Password.required_if' => 'Ingresa una contraseña',
            'Password.string' => 'Ingresa una contraseña',
            'Password.min' => 'Ingresa una contraseña de al menos 6 caracteres',
            'Password.regex' => 'Ingresa una contraseña de al menos 6 caracteres, debe contener mayusculas, minusculas, letras y simbolos',
            'ConfPassword.required_if' => 'Confirma la contraseña ingresada',
            'ConfPassword.same' => 'Las contraseñas no coinciden',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }

    public function valdateFormNewPassword(Request $request){
        $reglas = [
            'NewPassword' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'ConfNewPassword' => 'required|same:NewPassword'
        ];

        $mensajes = [
            'NewPassword.required' => 'Ingresa una contraseña',
            'NewPassword.string' => 'Ingresa una contraseña',
            'NewPassword.min' => 'Ingresa una contraseña de al menos 6 caracteres',
            'NewPassword.regex' => 'Ingresa una contraseña de al menos 6 caracteres, debe contener mayusculas, minusculas, letras y simbolos',
            'ConfNewPassword.required' => 'Confirma la contraseña ingresada',
            'ConfNewPassword.same' => 'Las contraseñas no coinciden',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }


    //API ROUTES
    public function loginApp(Request $request){
        $email = $request->get('email');
        $pass = $request->get('pass');

        $user = UsersQuery::create()
        ->findOneByEmail($email);
        
        if($user != null){
            $validCredentials = Hash::check($pass, $user->getPassword());

            if ($validCredentials) {
                return json_encode(Array(
                    "success" => true,
                    "errorMsg" => "Datos de acceso correctos",
                    "user" => $user->toArray()
                ));
            }else{
                return json_encode(Array(
                    "success" => false,
                    "errorMsg" => "Datos de acceso incorrectos"
                ));
            }

        }else{
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "Datos de acceso incorrectos"
            ));
        }
    }

    public function saveAddress(Request $request){
        $address = $request->get('address');
        $idUser = $request->get('idUser');

        $user = UsersQuery::create()
        ->findOneById($idUser);
        $user->setAddress($address)
        ->save();


        return json_encode(Array(
            "success" => true,
            "errorMsg" => "Dirección actualizada correctamente"
        ));
    }
    
    public function savePhone(Request $request){
        $phone = $request->get('phone');
        $idUser = $request->get('idUser');

        $user = UsersQuery::create()
        ->findOneById($idUser);
        $user->setPhone($phone)
        ->save();


        return json_encode(Array(
            "success" => true,
            "errorMsg" => "Teléfono actualizado correctamente"
        ));
    }


    public function saveNewPassword(Request $request){
        $password = $request->get('password');
        $newPassword = $request->get('newPassword');
        $idUser = $request->get('idUser');

        if($password == $newPassword){
            $user = UsersQuery::create()
            ->findOneById($idUser);
            $user->setPassword(bcrypt($password))
            ->save();

            return json_encode(Array(
                "success" => true,
                "errorMsg" => "Contraseña actualizada correctamente"
            ));
        }else{
            return json_encode(Array(
                "success" => false,
                "errorMsg" => "Las contraseñas no coinciden"
            ));
        }
    }
}
