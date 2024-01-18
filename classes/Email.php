<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //crear el objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $ENV['EMAIL_PORT'];
        $mail->Username = $ENV['EMAIL_USER'];
        $mail->Password = $ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appMito.com', 'AppMito.com');
        $mail->Subject = 'Confirma tu cuenta';

        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>El usuario de nombre <strong>" . $this->email . "</strong> ha solicitado crear una cuenta en AppMito, 
        si deseas confirmar presiona el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token="     
        . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "</html>";    

        $mail->Body = $contenido;

        //enviar email
        $mail->send();
    }

    public function enviarInstrucciones(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $ENV['EMAIL_PORT'];
        $mail->Username = $ENV['EMAIL_USER'];
        $mail->Password = $ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appMito.com', 'AppMito.com');
        $mail->Subject = 'Reestablece tu password';

        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" 
        . $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio o está cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";    

        $mail->Body = $contenido;

        //enviar email
        $mail->send();
    }
}