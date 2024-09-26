<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>


<?php 

require '../vendor/autoload.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Dotenv\Dotenv;

//Load Composer's autoloader


$dotenv = Dotenv::createImmutable( __DIR__ . '/');
$dotenv->load();


$envPath = __DIR__ . '/../src/.env';

if (file_exists($envPath)) {
    echo 'Het .env-bestand is gevonden op pad: ' . $envPath;
} else {
    echo 'Het .env-bestand is NIET gevonden op pad: ' . $envPath;
}


//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $firstname = htmlspecialchars($_POST["firstname"]);
    $Email = htmlspecialchars($_POST["Email"]);
    $klacht = htmlspecialchars($_POST["klacht"]);

}
    

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $_ENV['SMTP_HOST'] ;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $_ENV['SMTP_USERNAME'];                     //SMTP username
    $mail->Password   = $_ENV['SMTP_PASSWORD'];                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = $_ENV['SMTP_PORT'];   
    $mail->SMTPAutoTLS= true;                                   //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    //Recipients
    $mail->setFrom('moh301530@gmail.com', 'Mohamad');
    $mail->addAddress($Email, $firstname);     
    $mail->addAddress($Email, $firstname);     
    $mail->addCC('moh301530@gmail.com');




   //Content
   $mail->isHTML(true);                                  //Set email format to HTML
   $mail->Subject = 'uw klacht is in behandeling, uw behandeling nummer is  ';
   $mail->Body    = 'Dit is uw klacht: ' . $klacht ;
   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

   $mail->send();
   echo 'Message has been sent';
} catch (Exception $e) {
   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>