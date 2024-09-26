<?php
require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Dotenv\Dotenv;

// Gebruik het juiste pad naar de .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../src');
$dotenv->load();


$envPath = __DIR__ . '/../src/.env';

if (file_exists($envPath)) {
    echo 'Het .env-bestand is gevonden op pad: ' . $envPath;
} else {
    echo 'Het .env-bestand is NIET gevonden op pad: ' . $envPath;
}




$logger = new Logger('problemen');
$logger->pushHandler(new StreamHandler(__DIR__ . '/app.log', Logger::DEBUG));

// $logger->info('this is log! ^ ^');
// $logger->wearing('this is a log waring ^ ^');
// $logger->error('This is a log error ^ ^');

// ini_set('display errors, 0');
// error_reporting(0);

function MaakError($error)
{
    throw new Exception($error);
}
try {
    MaakError('klote');
} catch (Exception $e){
    echo "een error gevonden: <span class='error'> " . $e->getMessage() . "</span>";
    // hier willen we de fout registeren

$logger->error('fout gevonden', [$e->getMessage()]);
} finally{
    echo"<p>ik mag nog even doorgaan</p>";
    $logger->info('en mag nog doorgaan');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">


    <title>formulier</title>


</head>


<body>


<div class= "container">

<form action="klacht.php" method="POST">

<div class="firstname">

<label for= firstname>Firstname :</label>
<input id = firstname type="text" name="firstname" placeholder="firstname...">

</div>


<div> 

<label for= Email>Email :</label>
<input id = Email  type="text" name="Email" placeholder="Email...">

</div>

<div> 

<label for= klacht> omschrijving klacht :</label>

<textarea style="resize: none;" name="klacht" id="klacht" cols="40" rows="5" placeholder="omschrijving klacht" ></textarea><br>


</div>

            <button type= "submit">send</button>

</form>

</div>


</body>
</html>