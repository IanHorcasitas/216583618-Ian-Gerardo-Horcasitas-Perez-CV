<?php
    $nombre = $_REQUEST['nombre'];
    $comentario = $_REQUEST['com'];
    $subj = $_REQUEST['subject'];
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'joseespinosa185@gmail.com';                     //SMTP username
        $mail->Password   = 'lxhgikhxzwefjhhu';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('electronik@gmail.com', 'Electronik Soporte');
        $mail->addAddress('jose.espinosa4625@alumnos.udg.mx', 'ESCOLAR');     //Add a recipient

        //Content
        $mail->isHTML(true);  
        $nameMsg = $subj.' '.$nombre;                              
        $mail->Subject = $nameMsg;
        $mail->Body    = $comentario;

        $mail->send();
        header("Location: ../index.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>