<?php
    require '../vendor/autoload.php';

    // $dotenv = Dotenv\Dotenv::createImmutable('./');
    $dotenv =Dotenv\Dotenv::createImmutable( __DIR__ . '/');
    $dotenv->load();


    $host = $_ENV['DB_HOST'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];
    $dbname = $_ENV['DB_NAME'];

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}

$query = "SELECT naam,email FROM gebruikers";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $csvData = [];

    while ($row = $result->fetch_assoc()) {
        $csvData[] = [$row['naam'], $row['email']];
    }


    
    $csv = League\Csv\Writer::createFromString('');
    $csv->insertOne(['naam','email']);
    $csv->insertAll($csvData);


    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="gegevensverzameling1.csv"');


    echo $csv;
} else {
    echo "Geen resultat gevonden.";
}

$conn->close();