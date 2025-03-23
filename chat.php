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
    <div class="wiadomosci">
        <h2>Porozmawiaj Online!</h2>
    <?php
$connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

if (!$connect) {
    die("Połączenie z bazą danych nie powiodło się.");
}
$plik_nazwa = "chat.txt";
$sql = "SELECT `kto`, `login` FROM `zalogowani` LIMIT 1";
$qu = mysqli_query($connect, $sql);
$row0 = mysqli_fetch_assoc($qu);

if (isset($_POST['zakoncz']) && $_POST['zakoncz'] === 'true' && $row0['kto'] === 'lekarz internista') {
    file_put_contents($plik_nazwa, "");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (file_exists($plik_nazwa)) {
    $wiadomosci = file($plik_nazwa);
    foreach ($wiadomosci as $wiadomosc) {
        list($tresc, $login) = explode("|", $wiadomosc);
        echo "<div class='wiadomosc'><strong>" . htmlspecialchars($login) . ":</strong> " . htmlspecialchars($tresc) . "</div>";
    }
}
?>

<form method="post">
    <textarea name="wiadomosc" placeholder="Treść wiadomości"></textarea>
    <input type="submit" value="Wyślij wiadomość" name="wyslij">
</form>

<?php
if (isset($_POST['wyslij'])) {
    $wiadomosc = trim($_POST['wiadomosc']);
    
    if (!empty($wiadomosc) && $row0) {
        $imie = '';
        $nazwisko = '';
        
        if ($row0['kto'] == "pacjent") {
            $sql1 = "SELECT `imie`, `nazwisko` FROM `pacjenci` WHERE `login` = '{$row0['login']}'";
        }
        
        if ($row0['kto'] == "lekarz internista") {
            $sql1 = "SELECT `imie`, `nazwisko` FROM `pracownik` WHERE `login` = '{$row0['login']}'";
        }
        
        if (isset($sql1)) {
            $qu1 = mysqli_query($connect, $sql1);
            $row1 = mysqli_fetch_assoc($qu1);
            
            if ($row1) {
                $imie = $row1['imie'];
                $nazwisko = $row1['nazwisko'];
            }
        }
        
        $login = $imie . " " . $nazwisko . ", " . $row0['kto'];
        $zawartosc = $wiadomosc . "|" . $login . "\n";
        
        file_put_contents($plik_nazwa, $zawartosc, FILE_APPEND);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($row0['kto']) && $row0['kto'] === 'lekarz internista') {
    echo '<form method="post" onsubmit="return confirm(\'Czy na pewno chcesz zakończyć rozmowę i wyczyścić dane?\')">
            <input type="hidden" name="zakoncz" value="true">
            <input type="submit" value="Zakończ rozmowę i wyczyść dane">
          </form>';
}
?>

</div>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>