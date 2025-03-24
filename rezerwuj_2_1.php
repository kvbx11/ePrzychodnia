<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ePrzychodnia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <div id="data"></div> 
    <script src="zegar.js"></script>
        <h1 class="text-xl font-bold text-center flex-1"><a href="index.php">ePrzychodnia</a></h1>
        <?php
            require 'wyswietl_logowanie.php';
        ?>
        <div>
        <form action="zaloguj.php">
    <button class="icon-button"><i class="fa-solid fa-user"></i></button> 
</form>
<form action="wyloguj.php">
    <button class="icon-button"><i class="fa fa-sign-out"></i></button>
</form>
<?php
    require 'wyswietl_navbar.php';
?>
        </nav>
        
        <main>
            <div class="index-content">
            <?php
    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

    if (!$connect) {
        die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
    }

    session_start();
    $id_pacjenta = $_SESSION['id_pacjent_rejestracja'];
    $id_lekarza = $_SESSION['id_lekarza_rezerwacja'];
    // Pobranie i zabezpieczenie danych
    $termin = mysqli_real_escape_string($connect, $_POST['termin']);
    $data = substr($termin, 0, 10);
    $godzina = substr($termin, 10);

    $id_pacjenta = $_SESSION['id_pacjent_rejestracja'];
    $id_lekarza = $_SESSION['id_lekarza_rezerwacja'];

    $sql = "INSERT INTO `rezerwacje` (`id_pacjenta`, `data`, `godzina`, `id_lekarza`) 
            VALUES ('$id_pacjenta', '$data', '$godzina', '$id_lekarza')"; 
    if (mysqli_query($connect, $sql)) {
        $sql1="update `terminarz` set `dostepnosc`=0 where `dostepnosc`=1 and `id_lekarza`='".$id_lekarza."' and `godzina`='".$_SESSION['godzina']."';";
        $query1=mysqli_query($connect,$sql1); // dodanie danych do bazy
        echo "Pomyślnie dodano wizytę";
    } else {
        echo "Błąd: " . mysqli_error($connect);
    }
?>

        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>
