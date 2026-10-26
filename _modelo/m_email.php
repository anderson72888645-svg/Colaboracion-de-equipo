<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__) . '/vendor/autoload.php';

function enviarCodigoVerificacion($email, $codigo)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->Host       = 'mail.gruporysoft.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('CURSOS_SMTP_USER') ?: '';
        $mail->Password   = getenv('CURSOS_SMTP_PASSWORD') ?: '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('cursos@gruporysoft.com', 'RYSOFT');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Código de verificación - RYSOFT';

        $mensaje = '
        <div style="width: 100%; background-color: #E5E7E9; text-align: center; color: #000000;">
            <div style="width: 100%;">
                <div style="padding: 50px; background-color:rgb(223, 13, 13); color: white; font-weight: 500; font-size: 25px;">
                    <img src="https://cursos.gruporysoft.com/assets/foto/logo_rysoft.png" alt="Logo" style="width: 10%; padding: 10px 25px; background-color: white; border-radius: 10px;">
                    <h3>CÓDIGO DE VERIFICACIÓN</h3>
                </div>
                <div style="padding: 25px; background-color: white;">
                    <h4 style="font-weight: 400; font-size: 25px;">Tu código de verificación es:</h4>
                    <div style="background-color: #f8f9fa; padding: 20px; margin: 20px; border-radius: 5px;">
                        <h2 style="font-size: 30px; color: #5085ca;">' . $codigo . '</h2>
                    </div>
                    <p>Este código es válido por 10 minutos.</p>
                </div>
                <div style="padding: 20px;">
                    <h3>RYSOFT</h3>
                </div>
            </div>
        </div>';

        $mail->CharSet = 'UTF-8';
        $mail->Body = $mensaje;
        $mail->AltBody = 'Tu código de verificación es: ' . $codigo;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
