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
                <h2>Przeglądaj historię badań pacjentów!</h2>
                <form method="post">
                    <input type="number" name="id_pacjent" placeholder="ID pacjenta">
                    <input type="submit" value="Wyświetl" name='nex'>
                </form>
                <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                if(isset($_POST['nex'])){ // pobranie danych o badaniach wybranego pacjenta
                    $query2="select `imie`,`nazwisko`,`opis_badania`,`diagnoza`,`recepta`,`data` from `badania` inner join `pracownik` on `pracownik`.`id_lekarza`=`badania`.`id_lekarza` where `id_pacjenta`='".$_POST['id_pacjent']."';";
                    $res2=mysqli_query($connect,$query2);
                    $row2=mysqli_fetch_assoc($res2);
                    if(mysqli_num_rows($res2)>0){ // wyswietlenie danych 
                        echo "Lekarz: ".$row2['imie']." ".$row2['nazwisko'].", Opis wykonywanego badania: ".$row2['opis_badania'].", Diagnoza: ".$row2['diagnoza'].", Recepta: ".$row2['recepta'].", Data badania: ".$row2['data']."<br><br>"; 
                    }
                    else{
                        echo "Brak dostępnej historii badań!";
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
