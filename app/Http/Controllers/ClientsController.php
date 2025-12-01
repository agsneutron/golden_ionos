<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OrdersQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use UsersQuery;
use Validator;

class ClientsController extends Controller
{
    private $viewName = "clients";

    public function index(){
        return view('app.clients.main')
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function table(){
        $usuarios = \UsersQuery::create()
            ->filterByIdUserType(4)
            ->find();

        return view('app.clients.table')
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
            $Name      = strtoupper($this->eliminar_tildes($request->get('Name')));
            $Email     = $request->get('Email');
            $Phone     = $request->get('Phone');
            $Notes     = $request->get('Notes');
            $Address     = $request->get('Address');
            $Suburb     = $request->get('Suburb');
            $IdUserType = 4;
            $Password  = $request->get('Password');

            //Log::info($request->all());

            $registedEmail = \UsersQuery::create()
                ->filterById($Id,Criteria::NOT_EQUAL)
                ->findOneByEmail($Email);
            if($registedEmail != null){
                return json_encode(["success" => false, "errorMsg" => 'El correo electrónico ingresado ya se encuentra registrado']);
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
                ->setNotes($Notes)
                ->setAddress($Address)
                ->setSuburb($Suburb)
                ->setIdUserType($IdUserType)
                ->save();

            return json_encode(['success' => true, 'errorMsg' => 'Cliente guardado correctamente']);
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

            return json_encode(["success" => true, "errorMsg" => "Cliente eliminado correctamente"]);
        }else{
            return json_encode(["success" => false, "errorMsg" => "No se puede realizar la operación, el cliente tiene información ligada"]);
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

    public function unifyClients(Request $request){
        $ids = $request->get('ids');
        $mainId = array_shift($ids);
        
        $clients = UsersQuery::create()
        ->filterById($ids)
        ->find();

        foreach($clients as $client){
            $orders = OrdersQuery::create()
            ->filterByIdClientUser($client->getId())
            ->update(array('IdClientUser'=>$mainId));

            $client->delete();
        }

        return json_encode(['success' => true, 'errorMsg' => 'Clientes unificados correctamente']);
    }

    public function valdateFormUser(Request $request){
        $reglas = [
            'Id' => 'required',
            'Name' => 'required',
            'Email' => 'required|email',
            'Phone' => 'required',
            'Address' => 'required',
            'Password' => 'required_if:Id,0|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'ConfPassword' => 'required_if:Id,0|same:Password'
        ];

        $mensajes = [
            'Name.required' => 'Ingresa el nombre del cliente',
            'Email.required' => 'Ingresa el correo electrónico',
            'Email.email' => 'Ingresa un correo electrónico válido',
            'Phone.required' => 'Ingresa un número telefónico',
            'Address.required' => 'Ingresa una dirección',
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

}
