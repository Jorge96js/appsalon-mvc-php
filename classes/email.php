<?php

    namespace Classes;

    use PHPMailer\PHPMailer\PHPMailer;

    class Email {

       public $email;
       public $nombre;
       public $token;
            
        public function __construct($email,$nombre,$token)
        {

            $this->email = $email;
            $this->nombre = $nombre;
            $this->token = $token;
            
        }

        
        public function enviarConfirmacion(){

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            
        
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress($this->email);
            $mail->Subject = 'Confirma tu cuenta';

            //set html

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Solo queda confirmar tu cuenta utilizando el siguiente enlace</p>";
            $contenido .= "<p> Presiona aqui <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=". $this->token ."'>Confirmar Cuenta</a> </p>";
            $contenido .= "Si tu no solicitaste esta cuenta, puedes ignorar el mensaje";
            $contenido .= "</html>";
            $mail->Body = $contenido;

            //enviar email
            $mail->send();

        }


        public function enviarInstrucciones() {

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'a63bec54e7f194';
            $mail->Password = '66cb49ccadf51b';
            
        
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress($this->email);
            $mail->Subject = 'Confirma tu cuenta';

            //set html

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Haz Click en el siguiente enlase para poder restablecer tu contrasela</p>";
            $contenido .= "<p> Presiona aqui <a href='" . $_ENV['APP_URL'] . "/recuperar-cuenta?token=". $this->token ."'>Confirmar Cuenta</a> </p>";
            $contenido .= "Si tu no solicitaste este cambio, puedes ignorar el mensaje";
            $contenido .= "</html>";
            $mail->Body = $contenido;

            //enviar email
            $mail->send();

        }
    }