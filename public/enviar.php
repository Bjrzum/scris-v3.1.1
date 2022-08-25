<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ingresos de Docentes</title>
    <style>
       *{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <p>
    Buenos días,<br>
    Cordial saludo.<br><br>
    Se adjunta en el presente correo CONTROL INGRESO DOCENTES - <b>' . date("M") . ' ' . date("d") . ' del ' . date("Y") . '</b>.<br><br><br><br>
    Atentamente,<br>
    <b>PORTERÍA SCALAS</b>
    </p>
</body>
</html>
';

$asunto = 'REPORTE DE INGRESOS DE DOCENTES ' . date("d") . ' DE ' . strtoupper(date("M")) . ' DEL ' . date("Y");


if (isset($_POST['enviar'])) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'porteriacolegioscalas@bjrzum.in';                     //SMTP username
        $mail->Password   = 'Damar12345.';                               //SMTP password
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('porteriacolegioscalas@bjrzum.in', 'PORTERIA SCALAS');
        $mail->addAddress('coordinacionconvivenciascalas@gmail.com', 'David Cuello');     //Add a recipient
        $mail->addAddress('aleiderb@gmail.com', 'Aleider Bobadilla');               //Name is optional
        $mail->addAddress('porteriacolegioscalas@gmail.com', 'Porteria scalas');
        $mail->addReplyTo('porteriacolegioscalas@gmail.com', 'PORTERIA SCALAS');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('enviar/funcionarios.xlsx');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $html;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo '<script>location.href="tabla.php"; </script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
