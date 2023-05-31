<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Route;
use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;

class PagesController
{
    public static function index(Route $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('pages/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    
    public static function nosotros(Route $router)
    {
        $router->render('pages/nosotros');
    }

    public static function blog(Route $router)
    {
        $router->render('pages/blog');
    }

    public static function entrada(Route $router)
    {
        $router->render('pages/entrada');
    }

    public static function contacto(Route $router)
    {
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            //Crear y enviar el correo
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = $_ENV['MAIL_HOST'];
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = $_ENV['MAIL_PORT'];
            $phpmailer->Username = $_ENV['MAIL_USERNAME'];
            $phpmailer->Password = $_ENV['MAIL_PASSWORD'];
            $phpmailer->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
            $phpmailer->setFrom($_ENV['MAIL_SETFROM']);

            //Recabar y procesar el formulario
            $respuesta = $_POST['contacto'];
            $contenido = '<html>';
            $contenido .= "<p>Estimado: " . $respuesta['nombre'] . "</p><br>";
            $contenido .= "<p>Hemos recibido una respuesta con el siguiente mensaje:</p>";
            $contenido .= "<p>" . $respuesta['mensaje'] . "</p><br>";
            $contenido .= "<p>También, nos ha comentado que usted desea '" . $respuesta['tipo'] . "' con nosotros, con un precio de $" . $respuesta['presupuesto'] . " MXN</p>";
            $contenido .= "<p>Así también, usted desea ser contactado por medio del " . $respuesta['contacto'];
            switch($respuesta['contacto'])
            {
                case 'email':
                    $phpmailer->addAddress($respuesta['email'], $respuesta['nombre']);
                    $phpmailer->Subject = 'Hemos recibido su respuesta';
                    $contenido .= " electrónico que nos ha proporcionado.</p>";
                    break;
                case 'telefono':
                    $phpmailer->addAddress($_ENV['MAIL_ADDEMAIL'], $_ENV['MAIL_ADDUSER']);
                    $phpmailer->Subject = 'Hemos recabado una respuesta de un usuario vía teléfono';
                    $contenido .= " al número " . $respuesta['telefono'] . ".</p>";
                    break;
            }
            if(array_key_exists('fecha',$respuesta) AND $respuesta['hora'] != '' AND $respuesta['fecha'] != '')
            {
                $contenido .= '<p>Por último, ha querido que lo contactemos aproximadamente en el día: ';
                $contenido .= $respuesta['fecha'] . " a las " . $respuesta['hora'] . " horas.</p><br>";
            }
            $contenido .= '<p>Agradecemos enormemente la valiosa respuesta proporcionada.</p><br>';
            $contenido .= '<p>Atte. Bienes Raices.com</p><br>';
            $contenido .= '<p>¡Favor de no contestar este mensaje!</p>';
            $contenido .= '</html>';

            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';
            $phpmailer->Body = $contenido;
            $phpmailer->AltBody = 'Esto es un mensaje sin HTML';

            if($phpmailer->send())
            {
                $mensaje = array(
                    'title' => '¡Enviado!',
                    'message' => "Enviado correctamenre",
                    'status' => 'success'
                );
            }else
            {
                $mensaje = array(
                    'title' => '¡No se ha enviado!',
                    'message' => "No se ha logrado enviar",
                    'status' => 'error'
            );
            }
        }
        $router->render('pages/contacto', ['mensaje' => $mensaje]);
    }

    public static function anuncios(Route $router)
    {
        $propiedades = Propiedad::all();
        $router->render('pages/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function anuncio(Route $router)
    {
        $id = IdOrRedirect('/anuncios');
        $propiedad = Propiedad::find($id);
        $router->render('pages/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
 
}