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
            <h2>Zaakceptuj oczekujące recepty!</h2>
            <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                $sql0="select `id_lekarza` from `pracownik` inner join `zalogowani` on `zalogowani`.`login`=`pracownik`.`login`";
                $query0=mysqli_query($connect,$sql0); // pobranie danych o lekarzu
                $row0=mysqli_fetch_assoc($query0);
                $id_lekarza=$row0['id_lekarza'];
                $sql="select * from `recepty` where `zaakceptowane`=0 and `id_lekarza`=".$id_lekarza.";";
                $query1=mysqli_query($connect,$sql); // pobranie danych o niezaakceptowanych receptach
                if(mysqli_num_rows($query1)>0){
                    while($row=mysqli_fetch_assoc($query1)){ // wyswietlenie recept z mozliwoscia ich akceptacji
                        echo "<form method='POST' action='przekierowanie1.php'> 
                        <input type='hidden' name='id_recepty' value='".$row['id_recepty']."'>
                        <button type='submit'>ID Pacjenta: ".$row['id_pacjenta'].", Lek: ".$row['nazwa leku'].", Dawka: ".$row['dawka'].", Dawkowanie przez pacjenta: ".$row['dawkowanie_pacjent'].", Ilość opakowań: ".$row['ilosc_opakowan']."</button>
                      </form>";
                    }
                }
                else{
                    echo "Brak recept do akceptacji";
                }
                mysqli_close($connect);
            
            ?>
        </div>
        </div>
        </main>

    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>