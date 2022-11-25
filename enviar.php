<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['email']) && isset($_POST['description'])){

    $emailDestination = $_POST['email'];
    $description = $_POST['description'];
    $nombredestinatario = "Fredy Yela";

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    /** Configurar SMTP **/
    $mail->isSMTP();                                      // Indicamos que use SMTP
    $mail->Host = 'smtp.gmail.com';  // Indicamos los servidores SMTP
    $mail->SMTPAuth = true;                               // Habilitamos la autenticación SMTP
    $mail->Username = 'comfamiliarpruebas@gmail.com';                 // SMTP username
    $mail->Password = 'intptwzppbomasld';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Habilitar encriptación TLS o SSL
    $mail->Port = 587;                                    // TCP port

    /** Configurar cabeceras del mensaje **/
    $mail->From = 'comfamiliarpruebas@gmail.com';                       // Correo del remitente
    $mail->FromName = 'Fredy Yela';           // Nombre del remitente
    $mail->Subject = 'Asunto del correo';                // Asunto

    /** Incluir destinatarios. El nombre es opcional **/
    $mail->addAddress($emailDestination);
    //$mail->addAddress('destinatario2@correo.com', 'Nombre2');
    //$mail->addAddress('destinatario3@correo.com', 'Nombre3');

    /** Con RE, CC, BCC **/
    $mail->addReplyTo('info@correo.com', 'Informacion');
    $mail->addCC('cc@correo.com');
    $mail->addBCC('bcc@correo.com');

    /** Incluir archivos adjuntos. El nombre es opcional **/
    //$mail->addAttachment('/archivos/miproyecto.zip');        
    //$mail->addAttachment('/imagenes/imagen.jpg', 'nombre.jpg');

    /** Enviarlo en formato HTML **/
    $mail->isHTML(true);                                  

    /** Configurar cuerpo del mensaje **/
    $innerHtml = '<div style="max-width: 800px; margin: 0 auto;"><div>Estimado(a) '.$nombredestinatario.'</div>'
    .$description.'</div>';
    $mail->Body    = $innerHtml;
    //$mail->AltBody = 'Este es el mansaje en texto plano para clientes que no admitan HTML';

    /** Para que use el lenguaje español **/
    $mail->setLanguage('es');

    /** Enviar mensaje... **/
    if(!$mail->send()) {
        echo 'El mensaje no pudo ser enviado.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        header("Location: index.php?status=success");
        echo 'Mensaje enviado correctamente';
    }
}




?>