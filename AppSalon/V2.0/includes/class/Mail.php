<?php
namespace OtherClass;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    public string $email;
    public string $name;
    public string $token;
    public string $html;

    public function __construct(string $email, string $name, string $token, string $route)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
        $this->html($route);
    }

    private function html(string $route)
    {
        //TWIG
        $url = $_ENV['APP_DEV_URL'] ?: $_ENV['APP_URL'];
        $loader = new FilesystemLoader(__DIR__ . '\..\..\views');
        $twig = new Environment($loader, array());
        $html = $twig->render($route . '.view.php', [
            'URL'=>$url,
            'RecipientEmail'=>$this->email,
            'RecipientUser'=>$this->name,
            'RecipientToken'=>$this->token
        ]);
        $this->html = $html;
    }

    private function SendEmail(string $subject)
    {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_SETFROM'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->setFrom($_ENV['MAIL_SETFROM'], $_ENV['MAIL_SETNAME']);
        $mail->addAddress($this->email, $this->name);
        $mail->addStringEmbeddedImage(file_get_contents('https://i.ibb.co/6wyhCbj/APP-black.png'),'logo','logo');
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Body = $this->html;
        if($mail->send())
        {
            return array(
                'title' => '¡Enviado!',
                'message' => "Enviado correctamente",
                'status' => 'success'
            );
        }
        else
        {
            return array(
                'title' => '¡No se ha enviado!',
                'message' => "Error al enviar el correo: " . $mail->ErrorInfo,
                'status' => 'error'
            );
        }
    }

    public function ValidateEmail()
    {
        return $this->SendEmail('Válida tu correo.');
    }

    public function ForgoutEmail()
    {
        return $this->SendEmail('Recupera tu contraseña.');
    }
}