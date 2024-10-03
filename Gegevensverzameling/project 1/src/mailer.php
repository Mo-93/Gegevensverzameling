<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;
use PHPMailer\PHPMailer\SMTP;


require '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');

$dotenv->safeLoad();

// Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email']) && isset($_GET['name'])) {
    $name = urldecode($_GET['name']);
    $email = urldecode($_GET['email']);

    try {

   
        // Server settings

        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->Debugoutput = 'html'; // Output the debug info in HTML format
        $mail->isSMTP();  // Send using SMTP
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = "moh301530@gmail.com" ;
        $mail->Password = "vyde fuzx oqkr pmih ";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable implicit TLS encryption
        $mail->Port = 587;
        $mail->SMTPAutoTLS= true;   

        // Recipients
        $mail->setFrom('moh301530@gmail.com','Mohamad');
        $mail->addAddress($email, $name);
        
       

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Welkom in onze bedrijf.'  . $name ;
        $mail->Body =  'Hallo, we zijn erg blij dat je er bent, ' . $name . '!'  ;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Missing required data';
}
?>