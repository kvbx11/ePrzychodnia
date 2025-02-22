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
    <script>
        czas();
        function czas(){

            var data=new Date();

            var godzina=data.getHours();
            if(godzina<10){
                godzina='0'+godzina;
            }
            var minuta=data.getMinutes();
            if(minuta<10){
                minuta='0'+minuta;
            }
            var sekunda=data.getSeconds();
            if(sekunda<10){
                sekunda='0'+sekunda;
            }

            var rok = data.getFullYear();
            var miesiac=data.getMonth();
            if(miesiac<10){
                miesiac='0'+miesiac;
            }
            var dzien=data.getDate();
            if(dzien<10){
                dzien='0'+dzien;
            }

            var teraz_godzina= godzina+":"+minuta+":"+sekunda;
            var teraz_data=dzien+"."+miesiac+"."+rok;
            document.getElementById("data").innerHTML="Aktualny czas: <br>"+teraz_godzina+"<br>"+teraz_data;
        }
        setInterval(czas,1000);
    </script>
        <h1 class="text-xl font-bold text-center flex-1"><a href="index.php">ePrzychodnia</a></h1>
        <?php
            $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

            if (!$connect) {
                die("Połączenie z bazą danych nie powiodło się.");
            }

            $query0 = "SELECT `login` FROM `zalogowani` LIMIT 1";
            $result = mysqli_query($connect, $query0);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $log = $row['login'];
                echo "Zalogowano jako: " . htmlspecialchars($log);
            } else {
                echo "Nie zalogowano.";
            }
            


            mysqli_close($connect);
        ?>
        <div>
        <form action="zaloguj.php">
    <button class="icon-button"><i class="fa-solid fa-user"></i></button> 
</form>
<form action="wyloguj.php">
    <button class="icon-button"><i class="fa fa-sign-out"></i></button>
</form>
<?php
$connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

if (!$connect) {
    die("Połączenie z bazą danych nie powiodło się.");
}

$query1 = "SELECT `kto` FROM `zalogowani`";
$result1 = mysqli_query($connect, $query1);

if ($row = mysqli_fetch_assoc($result1)) { // Pobranie pierwszego wiersza
    $kto = $row['kto']; // Przypisanie wartości kolumny 'kto'
    
    if ($kto == "admin" || $kto == "recepcjonista") {
        echo '            
        <form action="ustawienia.php">
            <button type="submit" class="icon-button"><i class="fa-solid fa-cog"></i></button> 
        </form>';
    }
}

mysqli_close($connect);
?>
    </header>
    
    <div style="display: flex; flex: 1;">
        <nav>
            <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                $query0="select * from `zalogowani`";
                $result0=mysqli_query($connect,$query0);

                if(mysqli_num_rows($result0)>0){
                    $query1 = "SELECT `kto` FROM `zalogowani`";
                    $result1 = mysqli_query($connect, $query1);
                    $kto;
                    if ($row = mysqli_fetch_assoc($result1)) {
                        $kto = $row['kto']; 
                    }
                    $query2="select * from `uprawnienia` where `stanowisko`='".$kto."'";
                    $result2=mysqli_query($connect,$query2);
    
                    if($row=mysqli_fetch_assoc($result2)){
                        //print_r($row);
                        $zaloz_konto=$row['zaloz_konto'];
                        $usun_konto=$row['usun_konto'];
                        $dane_pacjentow=$row['dane_pacjentow'];
                        $dodaj_wpis=$row['dodaj_wpis'];
                        $rezerwuj=$row['rezerwuj'];
                        $przegladaj_historie=$row['przegladaj_historie'];
    
                        if($zaloz_konto==1 && $usun_konto==1){
                            echo "<p><a href='zarzadzaj_kontami.php'>Zarządzaj kontami</a></p>";
                        }
                        if($dane_pacjentow==1){
                            echo "<p><a href='dane_pacjentow.php'>Sprawdź dane pacjentów</a></p>";
                        }
                        if($dodaj_wpis==1){
                            echo "<p><a href='dodaj_wpis.php'>Dodaj wizytę</a></p>";
                            
                        }
                        if($rezerwuj==1){
                            echo "<p><a href='rezerwuj.php'>Zarezerwuj wizytę</a></p>";
    
                        }
                        if($przegladaj_historie==1){
                            echo "<p><a href='historia.php'>Przeglądaj historię badań</a></p>";
                        }
                        if($row['przegladaj_rezerwacje']==1){
                            echo "<p><a href='przegladaj_rezerwacje.php'>Przeglądaj rezerwacje</a></p>";
                        }
                        if($row['ewizyta']==1){
                            echo "<p><a href='chat.php'>Porozmawiaj Online!</a></p>";
                        }
                        if($row['napisz_recepte']==1){
                            echo "<p><a href='zamow_recepte.php'>Wypisz receptę Online</a></p>";
                        }
                        if($row['potwierdz_recepte']==1){
                            echo "<p><a href='zaakceptuj_recepte.php'>Zaakceptuj oczekujące recepty</a></p>";
                        }
                    }
                }
                mysqli_close($connect);
            ?>
        </nav>
        
        <main>
        <div class="index-content">
    <div class="wiadomosci">
    <?php
$connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

if (!$connect) {
    die("Połączenie z bazą danych nie powiodło się.");
}
$plik_nazwa = "chat.txt";
$sql = "SELECT `kto`, `login` FROM `zalogowani` LIMIT 1";
$qu = mysqli_query($connect, $sql);
$row0 = mysqli_fetch_assoc($qu);

if (isset($_POST['zakoncz']) && $_POST['zakoncz'] === 'true' && $row0['kto'] === 'lekarz') {
    file_put_contents($plik_nazwa, "");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (file_exists($plik_nazwa)) {
    $wiadomosci = file($plik_nazwa, FILE_IGNORE_NEW_LINES);
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
        
        if ($row0['kto'] == "lekarz") {
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

// Przycisk dla lekarza do zakończenia rozmowy i wyczyszczenia pliku
if (isset($row0['kto']) && $row0['kto'] === 'lekarz') {
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