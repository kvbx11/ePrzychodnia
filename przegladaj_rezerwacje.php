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

if ($row = mysqli_fetch_assoc($result1)) {
    $kto = $row['kto']; 
    
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
                mysqli_close($connect);
            ?>
        </nav>
        
        <main>
            <div class="index-content">
                <?php
                    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                    if (!$connect) {
                        die("Połączenie z bazą danych nie powiodło się.");
                    }

                    $query="select `kto`,`login` from `zalogowani`";
                    $res=mysqli_query($connect,$query);
                    $row=mysqli_fetch_assoc($res);
                    session_start();
                    if($row['kto']=="pacjent"){
                        echo "<h2>Zaplanowane wizyty</h2>";
                        $query6 = "SELECT `id_pacjenta` FROM `pacjenci` WHERE `login`='" . $row['login'] . "'";
                        $res6 = mysqli_query($connect, $query6);
                        
                        if ($row3 = mysqli_fetch_assoc($res6)) { 
                            $query1 = "SELECT `data`, `godzina`, `imie`, `nazwisko`, `specjalizacja` 
                                       FROM `rezerwacje` 
                                       INNER JOIN `pracownik` ON `pracownik`.`id_lekarza` = `rezerwacje`.`id_lekarza` 
                                       WHERE `id_pacjenta` = " . $row3['id_pacjenta'];
                                       
                            $res1 = mysqli_query($connect, $query1);
                            if (mysqli_num_rows($res1) > 0) {
                                while ($row1 = mysqli_fetch_assoc($res1)) {
                                    echo "Data: " . $row1['data'] . ", Godzina: " . $row1['godzina'] . ", Lekarz: " . $row1['imie'] . " " . $row1['nazwisko'] . ", " . $row1['specjalizacja'] . "<br>";
                                }
                            } else {
                                echo "Nie masz zaplanowanych wizyt!";
                            }
                        } else {
                            echo "Błąd: Nie znaleziono pacjenta!";
                        }
                    }

                    if($row['kto']=="lekarz"){
                        $query7="select `id_lekarza` from `pracownik` where `login`='".$row['login']."';";
                        $res7=mysqli_query($connect,$query7);
                        $row4=mysqli_fetch_assoc($res7); 

                        echo '<h1>Zaplanowane wizyty dla Ciebie!</h1>';
                        $query5="select `id_pacjenta`,`data`,`godzina` from `rezerwacje` where `id_lekarza`='".$row4['id_lekarza']."';";
                        $res5=mysqli_query($connect,$query5);
                        $row3=mysqli_fetch_assoc($res5);
                        echo "";
                        if(mysqli_num_rows($res5) > 0){
                            while($row3 = mysqli_fetch_assoc($res5)){
                                echo "<form method='POST' action='przekierowanie.php'>
                                        <input type='hidden' name='id_pacjenta' value='".$row3['id_pacjenta']."'>
                                        <button type='submit'>ID Pacjenta: ".$row3['id_pacjenta'].", Data: ".$row3['data'].", Godzina: ".$row3['godzina']."</button>
                                      </form>";
                            }
                        }
                        else{
                            echo "Brak zaplanowanych wizyt!";
                        }
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