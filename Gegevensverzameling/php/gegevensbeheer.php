<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gegevensverzameling1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

$sql = "SELECT id, naam, email FROM gebruikers";
$result = $conn->query($sql);

// Aanpassen van gegevens
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE gebruikers SET naam=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $naam, $email, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Gegevens succesvol bijgewerkt');</script>";
    } else {
        echo "<script>alert('Fout bij het bijwerken van gegevens');</script>";
    }

    $stmt->close();
}

// Verwijderen van gegevens
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM gebruikers WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Gegevens succesvol verwijderd');</script>";
    } else {
        echo "<script>alert('Fout bij het verwijderen van gegevens');</script>";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gegevensbeheer</title>
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
        <h2>Geregistreerde Gegevens</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["naam"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<button type='submit' name='delete' class='btn btn-danger'>Verwijderen</button>";
                        echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' data-id='" . $row["id"] . "' data-naam='" . $row["naam"] . "' data-email='" . $row["email"] . "'>Update</button> ";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Geen gegevens gevonden</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <!-- Modal for Update -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Gegevens bijwerken</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <input type="hidden" name="id" id="modal-id">
                        <div class="mb-3">
                            <label for="modal-naam" class="form-label">Naam</label>
                            <input type="text" class="form-control" id="modal-naam" name="naam">
                        </div>
                        <div class="mb-3">
                            <label for="modal-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="modal-email" name="email">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                            <button type="submit" name="update" class="btn btn-primary">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Gegevensverzameling</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
    // Pass data to the modal
    var editModal = document.getElementById('editModal')
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var naam = button.getAttribute('data-naam')
        var email = button.getAttribute('data-email')

        var modalId = editModal.querySelector('#modal-id')
        var modalNaam = editModal.querySelector('#modal-naam')
        var modalEmail = editModal.querySelector('#modal-email')

        modalId.value = id
        modalNaam.value = naam
        modalEmail.value = email
    })
    </script>

    
</body>
