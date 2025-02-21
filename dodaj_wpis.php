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
                <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                $query="select `login` from `zalogowani`";
                $result=mysqli_query($connect, $query);
                $row=mysqli_fetch_assoc($result);
                $login_zal=$row['login'];

                $query3="select `id_lekarza` from `pracownik` where `login`='".$login_zal."';";
                $result3=mysqli_query($connect,$query3);
                $row=mysqli_fetch_assoc($result3);
                echo "Twoje ID: ".$row['id_lekarza']."<br>";
                ?>
                <br>
                <form method="post">
                    <input type="number" name="id_pacjenta" placeholder="ID Pacjenta"> <br>
                    <input type="number" name="id_lekarza" placeholder="ID Lekarza"> <br>
                    <textarea name="opis" placeholder="Opis Badania"></textarea> <br>
                    <textarea name="diagnoza" placeholder="Diagnoza"></textarea> <br>
                    <input type="text" name="recepta" placeholder="Recepta"> <br>
                    <input type="date" name="data"><br><br>
                    <input type="submit" value="Dodaj wizytę" name="przeslij">
                </form>
            </div>

            <?php
            if(isset($_POST['przeslij'])){
                $query4="INSERT INTO `badania`(`id_pacjenta`, `id_lekarza`, `opis_badania`, `diagnoza`, `recepta`, `data`) VALUES ('".$_POST['id_pacjenta']."','".$_POST['id_lekarza']."','".$_POST['opis']."','".$_POST['diagnoza']."','".$_POST['recepta']."','".$_POST['data']."')";
                $result4=mysqli_query($connect,$query4);
    
                echo "Dodano wizytę!";
            }
            ?>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>
