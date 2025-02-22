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
                <h2>Przeglądaj historię badań pacjentów!</h2>
                <form method="post">
                    <input type="number" name="id_pacjent" placeholder="ID pacjenta">
                    <input type="submit" value="Wyświetl" name='nex'>
                </form>
                <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                if(isset($_POST['nex'])){
                    $query2="select `imie`,`nazwisko`,`opis_badania`,`diagnoza`,`recepta`,`data` from `badania` inner join `pracownik` on `pracownik`.`id_lekarza`=`badania`.`id_lekarza` where `id_pacjenta`='".$_POST['id_pacjent']."';";
                    $res2=mysqli_query($connect,$query2);
                    $row2=mysqli_fetch_assoc($res2);
                    if(mysqli_num_rows($res2)>0){
                        echo "Lekarz: ".$row2['imie']." ".$row2['nazwisko'].", Opis wykonywanego badania: ".$row2['opis_badania'].", Diagnoza: ".$row2['diagnoza'].", Recepta: ".$row2['recepta'].", Data badania: ".$row2['data']."<br><br>"; 
                    }
                    else{
                        echo "Brak dostępnej historii badań!";
                    }
                }

                

                ?>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>
