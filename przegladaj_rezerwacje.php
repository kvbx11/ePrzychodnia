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