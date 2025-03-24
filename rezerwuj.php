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
$connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

if (!$connect) {
    die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
}

session_start();

// Pobranie informacji o zalogowanym użytkowniku
$sql = "SELECT `kto`, `login` FROM `zalogowani` LIMIT 1";
$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($query);


$kto = $row['kto'];
$login = $row['login'];

if ($kto == "recepcjonista") { // wyswietlenie 
    echo '<form action="rezerwuj_1.php" method="post">
            <input type="number" name="id_pacjenta" required placeholder="ID pacjenta"><br>
            <input type="submit" value="Dalej">
          </form>';
} else if ($kto == "pacjent") {
    $sql = "SELECT `id_pacjenta` FROM `pacjenci` WHERE `login` = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); // pobranie danych z bazy
    $pacjent = mysqli_fetch_assoc($result);

    if ($pacjent) {
        $_SESSION['id_pacjent_rejestracja'] = $pacjent['id_pacjenta'];
        header("Location: rezerwuj_1.php"); // przeniesienie do innej podstrony
    } else {
        echo "Błąd: Nie znaleziono pacjenta.";
    }
}

mysqli_close($connect);
?>
        </main>

    </div>
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>
