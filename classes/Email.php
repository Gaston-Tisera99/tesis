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
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '24f7af094d1e9b';
        $mail->Password = 'e70f391b2d43ce';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appMito.com', 'AppMito.com');
        $mail->Subject = 'Confirma tu cuenta';

        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->email . "</strong> Has creado tu cuenta en AppMito 
        solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:4000/confirmar-cuenta?token=" 
        . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio o está cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";    

        $mail->Body = $contenido;

        //enviar email
        $mail->send();
    }

    public function enviarInstrucciones(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '24f7af094d1e9b';
        $mail->Password = 'e70f391b2d43ce';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appMito.com', 'AppMito.com');
        $mail->Subject = 'Reestablece tu password';

        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:4000/recuperar?token=" 
        . $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio o está cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";    

        $mail->Body = $contenido;

        //enviar email
        $mail->send();
    }
}