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
        <div class="w-10"></div> 
        <h1 class="text-xl font-bold text-center flex-1"><a href="index.php">ePrzychodnia</a></h1>
        <div>
            <form action="zaloguj.php">
                <button class="icon-button"><i class="fa-solid fa-user"></i></button> 
            </form>
            <form action="wyloguj.php">
                <button class="icon-button"><i class="fa fa-sign-out"></i></button>
            </form>
        </div>
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
                <form method="post">
                    <h2>Wybierz datę wizyty:</h2>
                    <input type="text" name="imie" placeholder="Imię"><br>
                    <input type="text" name="nazwisko" placeholder="Nazwisko"> <br>
                    Data: <input type="date" name="data"> <br>
                    Godzina: <input type="time" name="godzina"><br>
                    <input type="text" name="specjalizacja" placeholder="Specjalizacja lekarza"><br><br>
                    <input type="submit" value="Zarezerwuj wizytę!" name="przeslij">
                </form>
                <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                if(isset($_POST['przeslij'])){
                    $data=$_POST['data'];
                    $godzina=$_POST['godzina'];
                    $query0="select `id_pacjenta` from `pacjenci` where `imie`='".$_POST['imie']."' and `nazwisko`='".$_POST['nazwisko']."';";
                    $res0=mysqli_query($connect,$query0);
                    $row=mysqli_fetch_assoc($res0);
                    $id=$row['id_pacjenta'];

                    $query="INSERT INTO `rezerwacje`(`id_pacjenta`, `data`, `godzina`, `specjalizacja_lekarza`) VALUES ('".$id."', '".$_POST['data']."', '".$_POST['godzina']."', '".$_POST['specjalizacja']."');";
                    $result=mysqli_query($connect,$query);

                    echo "Pomyślnie zarezerwowano wizytę!";
                }



                ?>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>
