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
                    }
                }
            
            ?>
        </nav>
        
        <main>
            <div class="index-content">
            <p>Zarejestruj konto pacjenta na platformie ePrzychodnia</p>
            <br>
            <form method="post">
                            <input type="text" name="imie" placeholder="Imię"><br>
                            <input type="text" name="nazwisko" placeholder="Nazwisko"><br>
                            <input type="text" name="ulica" placeholder="Ulica"><br>
                            <input type="text" name="numer" placeholder="Numer domu/mieszkania"><br>
                            <input type="text" name="kp" placeholder="Kod Pocztowy"><br>
                            <input type="text" name="miasto" placeholder="Miasto"><br>
                            <input type="tel" name="tel" placeholder="Telefon"><br>
                            <input type="email" name="email" placeholder="E-mail"><br>
                            <input type="text" name="pesel" placeholder="PESEL"><br>
                            <input type="text" name="haslo" placeholder="Hasło"><br><br>
                            <input type="submit" value="Prześlij" name="submit">
                        </form>

                <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                
                if(isset($_POST['submit'])){
                    $imie1 = $_POST['imie'];
                    $nazw1 = $_POST['nazwisko'];
                    $pesel = $_POST['pesel'];
                    $login1 = strtolower(substr($imie1, 0, 3) . substr($nazw1, 0, 3) . substr($pesel, 6));
                    $haslo1 = $_POST['haslo'];
                    $query4 = "INSERT INTO `pacjenci` (`imie`, `nazwisko`, `ulica`, `nr_domu`, `kp`, `miasto`, `tel`, `email`, `PESEL`, `login`, `haslo`) VALUES ('".$_POST['imie']."','".$_POST['nazwisko']."','".$_POST['ulica']."','".$_POST['numer']."','".$_POST['kp']."','".$_POST['miasto']."','".$_POST['tel']."','".$_POST['email']."','".$_POST['pesel']."','".$login1."','".$_POST['haslo']."')";
                    $result4=mysqli_query($connect,$query4);
                    echo "Pomyślnie dodano! <br>";
                    echo "Twój login: ".$login1."<br>";
                }

                mysqli_close($connect);
                ?>

            </div>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>