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
        <h2>Wypisz receptę Online!</h2>
    <form method="post">
    <select name="id_lekarz">
        <option value="">Wybierz lekarza</option>
            <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                
                $sql = "SELECT `id_lekarza`, `imie`, `nazwisko`, `specjalizacja` FROM `pracownik` WHERE `stanowisko` = 'lekarz';";
                $qu = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($qu)) {
                    echo "<option value='" . $row['id_lekarza'] . "'>" . $row['imie'] . " " . $row['nazwisko'] . "</option>";
                }
            ?>
            </select> <br>
                <input type="text" name="nazwa_leku" placeholder="Nazwa leku"> <br>
                <input type="text" name="dawka_pacjent" placeholder="Dawkowanie przez pacjenta"> <br>
                <input type="text" name="dawka" placeholder="Dawka"> <br>
                <input type="number" name="opakowania" placeholder="Ilość opakowań"> <br>
                <button type="submit" name="next">Wyślij</button>
            </form>
            <?php
            if(isset($_POST['next'])){
                            $sql0="select `id_pacjenta` from `pacjenci` inner join `zalogowani` on `zalogowani`.`login`=`pacjenci`.`login`;";
            $qu0=mysqli_query($connect, $sql0);
            $row=mysqli_fetch_assoc($qu0);

            $sql="INSERT INTO `recepty`(`id_lekarza`, `id_pacjenta`, `nazwa leku`, `dawka`, `dawkowanie_pacjent`, `ilosc_opakowan`) 
            VALUES (".$_POST['id_lekarz'].", ".$row['id_pacjenta'].", '".$_POST['nazwa_leku']."', '".$_POST['dawka']."','".$_POST['dawka_pacjent']."',
            ".$_POST['opakowania'].");";
            $query=mysqli_query($connect,$sql);

            if($query){
                echo "Twoja recepta została zapisana i oczekuje na zatwierdzenie przez lekarza!";
            }
            }

            ?>
        </div>
        </div>
    </main>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>