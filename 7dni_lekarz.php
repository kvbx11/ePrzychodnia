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
                <h2>Wystawione recepty w ciągu ostatnich 7 dni: </h2>
                <?php
                    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza

                    if (!$connect) {
                        die("Połączenie z bazą danych nie powiodło się.");
                    }
                    $sql0="select `id_lekarza` from `pracownik` inner join `zalogowani` on `zalogowani`.`login`=`pracownik`.`login` "; // pobranie danych z bazy o zalogowanym pracowniku
                    $query=mysqli_query($connect,$sql0);
                    $row=mysqli_fetch_assoc($query);
                    $id_lekarza=$row['id_lekarza'];

                    $sql="select * from `recepty` where `id_lekarza`=".$id_lekarza." and `data_akceptacji` is not null;"; 
                    $query1=mysqli_query($connect,$sql);
                    

                    if(mysqli_num_rows($query1)>0){ 
                        while($recepta=mysqli_fetch_assoc($query1)){ // wyświetlenie danych
                            echo "<p>ID Pacjenta: ".$recepta['id_pacjenta']." | Lek: " . $recepta['nazwa leku'] . " | Data akceptacji: " . $recepta['data_akceptacji'] . " | Dawka: ".$recepta['dawka']." | Dziennie: ".$recepta['dawkowanie_pacjent']."</p>";
                        }
                    }
                    else{
                        echo "Brak wystawionych recept w ciągu ostatnich 7 dni";
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