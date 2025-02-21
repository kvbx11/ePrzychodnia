<?php
    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

    if (!$connect) {
        die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
    }

    session_start();

    // Pobranie i zabezpieczenie danych
    $termin = mysqli_real_escape_string($connect, $_POST['termin']);
    $data = substr($termin, 0, 10);
    $godzina = substr($termin, 10);

    $id_pacjenta = $_SESSION['id_pacjent_rejestracja'];
    $id_lekarza = $_SESSION['id_lekarza_rezerwacja'];

    // Zapytanie SQL z poprawioną składnią
    $sql = "INSERT INTO `rezerwacje` (`id_pacjenta`, `data`, `godzina`, `id_lekarza`) 
            VALUES ('$id_pacjenta', '$data', '$godzina', '$id_lekarza')";
    if (mysqli_query($connect, $sql)) {
        header("Location: rezerwuj_2.php");
    } else {
        echo "Błąd: " . mysqli_error($connect);
    }
?>
