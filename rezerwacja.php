<?php
    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

    if (!$connect) {
        die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
    }

    session_start();
    $id_pacjenta = $_SESSION['id_pacjent_rejestracja'];
    $id_lekarza = $_SESSION['id_lekarza_dodatkowa'];
    $termin = mysqli_real_escape_string($connect, $_POST['termin']);
    $data = substr($termin, 0, 10);
    $godzina = substr($termin, 10);

    $sql = "INSERT INTO `rezerwacje` (`id_pacjenta`, `data`, `godzina`, `id_lekarza`) 
            VALUES ('$id_pacjenta', '$data', '$godzina', '$id_lekarza')";
    if (mysqli_query($connect, $sql)) {
        $sql1="update `terminarz` set `dostepnosc`=0 where `dostepnosc`=1 and `id_lekarza`='".$id_lekarza."' and `godzina`='".$_SESSION['godzina']."';";
        $query1=mysqli_query($connect,$sql1);
        echo "Pomyślnie dodano wizytę";
    } else {
        echo "Błąd: " . mysqli_error($connect);
    }




?>