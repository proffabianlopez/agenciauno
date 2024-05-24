
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

$name = $_POST["name"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$message = $_POST["message"];

function Contact_mail($name,$lastname,$email,$message)
{ 

    $mail = new PHPMailer(true);

if(!empty($name) && !empty($lastname) && !empty($email) && !empty($mail))
{

    $mail->SMTPDebug = 0 ;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'agencia.uno.2024@gmail.com';                     
    $mail->Password   = 'hurjpuyxggxnoghd';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    
    $mail->setFrom('agencia.uno.2024@gmail.com', 'Agencia Uno');
    $mail->addAddress('agencia.uno.2024@gmail.com');     

    $mail->isHTML(true);
    $mail->CharSet='UTF-8';                      
    $mail->Subject = $message;
    $mail->Body = 
    '<p>
    El usuario: '.$name.''. $lastname.'
    <br>
    <br>
    Con el mail: '.$email.'
    <br>
    <br>
    Envio la siguiente consulta :<br> '.$message.'
    </p>';

    $mail->send();
    return true;
} 
}

if(Contact_mail($name,$lastname,$email,$message)==true)
{

    echo '<script>window.location.href = "../views/contact_succes.html";</script>'; // Regresar a la página anterior
    //header("Location: ../index.php");

    exit;
}


?>