<?php

namespace Controllers;

use Router\Router;
use Model\UserModel as User;
use OtherClass\Mail;

class LoginController
{
    public static function login(Router $router){   
        $validate = [];
        if(method() === 'POST')
        {
            $code = 200;
            $auth = new User($_POST['login']);
            $validate = $auth->UserAuth();
            if(!empty($validate))
            {
                $code = 400;
                $message = User::getAlerts();
            }else{
                $user = User::where('users_email','=',$auth->users_email);
                if(is_null($user))
                {
                    User::setAlert('errors', 'Usuario no encontrado');
                    $code = 400;
                    $message = User::getAlerts();
                }else{
                    if($user->HashVerify($auth->users_password) === false)
                    {
                        User::setAlert('errors', 'Contraseña incorrecta');
                        $code = 400;
                        $message = User::getAlerts();
                    }else{
                        if($user->users_email_verified != "1")
                        {
                            User::setAlert('errors', 'Usuario aún no verificado');
                            $code = 400;
                            $message = User::getAlerts();
                        }else{
                            $_SESSION['user_id'] = $user->id;
                            $_SESSION['user_name'] = $user->users_lname . " " . $user->users_name;
                            $_SESSION['user_email'] = $user->users_email;
                            $_SESSION['admin'] = $user->users_admin;
                            $_SESSION['login'] = true;
                            if($user->users_admin != "1")
                            {
                                $message = [
                                    'redirect'=>'/index',
                                    'session'=>$_SESSION,
                                    'status'=>'OK'
                                ];
                            }else{
                                $message = [
                                    'redirect'=>'/admin',
                                    'session'=>$_SESSION,
                                    'status'=>'OK'
                                ];
                            }
                        }
                    }
                }
            }
            return json_response($message, $code);
        }
        $router->render('auth/index');
    }

    public static function register(Router $router){
        $validate = [];
        $user = new User();
        if(method() === 'POST')
        {
            $user->sync($_POST['register']);
            $validate = $user->NewAccountValidate();
            if(!empty($validate))
            {
                return json_response($validate, 400);
            }
            $result = $user->UserExists();
            if($result->num_rows)
            {
                return json_response(User::getAlerts(), 400);
            }else
            {
                $user->CreateToken();
                $user->Hash();
                $email = new Mail($user->users_email,
                                $user->users_lname . " " . $user->users_name,
                                $user->users_token,
                                'email/email_verified');
                $send_email = $email->ValidateEmail();
                if($send_email['status'] === 'error')
                {
                    return json_response(array('errors'=>[''=>'Error al mandar el correo']), 400);
                }
                else
                {
                    $response = $user->save();
                    if($response)
                    {
                        return json_response(array(
                            'message'=>'Usuario creado satisfactoriamente',
                            'status'=>'OK'
                        ), 200);
                    }else
                    {
                        return json_response(array('errors'=>[''=>'Error al guardar']), 400);
                    }
                }
            }
        }
        $router->render('auth/register');
    }

    public static function validateUser(Router $router){
        $token = s($_GET['token'] ?? null);
        $user = User::where('users_token','=',$token);
        if(empty($user))
        {
            return $router->render('not-found');
        }else
        {
            $user->users_email_verified = 1;
            $user->users_token = null;
            $user->save();
            User::setAlert('exito','Cuenta comprobada correctamente');
            $router->render('auth/confirmate-user',[
                'alerts'=>User::getAlerts()
            ]);
        }
    }

    public static function forgout(Router $router){
        if(method()==="POST"){
            $code = 200;
            $auth = new User($_POST['forgout']);
            $validate = $auth->ValidateEmail();
            if(!empty($validate))
            {
                $code = 400;
                $message = User::getAlerts();
            }else{
                $user = User::where('users_email','=',$auth->users_email);   
                if($user && $user->users_email_verified === "1")
                {
                    $user->CreateToken();
                    $email = new Mail($user->users_email,
                                $user->users_lname . " " . $user->users_name,
                                $user->users_token,
                                'email/password_forgout');
                    $send_email = $email->ForgoutEmail();
                    if($send_email['status'] === 'error')
                    {
                        User::setAlert('errors', 'Error al enviar el correo para recuperar la contraseña.');
                        $code = 400;
                        $message = User::getAlerts();
                    }
                    else
                    {   
                        $user->save();
                        $message = [
                            'redirect'=>'/',
                            'status'=>'OK',
                            'message' => 'Revisa tu correo y sigue las instrucciones proporcionadas',
                        ];
                    }
                }else{
                    User::setAlert('errors', 'Usuario aún no verificado o no existente');
                    $code = 400;
                    $message = User::getAlerts();
                }
            }
            return json_response($message, $code);
        }
        $router->render('auth/forgout');
    }

    public static function rescue(Router $router){
        $_PUT = PUT();
        $token = s($_GET['token'] ?? $_PUT['token'] ?? null); 
        $user = User::where('users_token','=',$token);
        if(empty($user))
        {
            return $router->render('not-found');
        }else
        {
            if(method()==='PUT'){
                $message = [];
                $code = 200;
                $password = new User($_PUT['rescue']);
                $validate = $password->PasswordConfirm($_PUT['rescue']['users_password_confirmation']);
                if(!empty($validate))
                {
                    $message = User::getAlerts();
                    $code = 400;
                }else{
                    if($user->HashVerify($_PUT['rescue']['users_password_confirmation']) === true)
                    {
                        User::setAlert('errors', 'La contraseña que ingresaste es la misma que la anterior.');
                        $code = 400;
                        $message = User::getAlerts();
                    }else
                    {
                        $user->users_token = null;
                        $user->users_password = $password->users_password;
                        $user->Hash();
                        $result = $user->save();
                        if($result)
                        {
                            $message = [
                                'redirect'=>'/',
                                'message'=>'Se ha reestablecido la contraseña de manera satisfactoria',
                                'status'=>'OK'
                            ];
                        }else
                        {
                            User::setAlert('errors', 'Ha ocurrido un error al momento de guardar la contraseña.');
                            $code = 400;
                            $message = User::getAlerts();
                        }
                    }
                }
                return json_response($message, $code);
            }
            $router->render('auth/rescue');
        }
    }
}