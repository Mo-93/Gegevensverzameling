<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="homepdf.php">
  <link rel="stylesheet" href="homecsv.php">
    <title>PHPmailer</title>
</head>
<body>



<form action="mailer.php" class="form-inline my-2 my-lg-0" method="GET">

    <a href="mailer.php" name="email" ><p><?php echo 'email : ' .$email;?></p></a>
    <a href= "" name="naam"><p> <?php echo 'naam : ' . $naam;?></p></a>



</form>

    
</body>
</html>


<?php



 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

 require '../vendor/autoload.php';

 // $dotenv = Dotenv\Dotenv::createImmutable('./');
 $dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/');
 $dotenv->load();

 session_start();


$host= $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];


// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


      $naam= $row["naam"];
      $email =  $row["email"];
      

      }


}

?>