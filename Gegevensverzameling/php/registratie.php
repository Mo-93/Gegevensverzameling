<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
?>



<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gegevensverzameling1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST["naam"];
    $email = $_POST["email"];

    if (!empty($naam) && !empty($email)) {
        $sql = "INSERT INTO gebruikers (naam, email) VALUES ('$naam', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Gegevens succesvol geregistreerd";
        } else {
            echo "Fout bij registratie: " . $conn->error;
        }
    } else {
        echo "Vul alle velden in.";
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registratie</title>
    <link rel="stylesheet" href="/HtmlenCss/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/HtmlenCss/index.html">Home</a></li>
                <li><a href="/php/registratie.php">Registratie</a></li>
                <li><a href="/php/gegevensbeheer.php">Gegevensbeheer</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Registreer uw gegevens</h2>
        <form action="registratie.php" method="POST">
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <input type="submit" value="Registreren">
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Gegevensverzameling</p>
    </footer>
</body>
</html>








