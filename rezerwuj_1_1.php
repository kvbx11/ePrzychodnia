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

                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
                }
                session_start();
                $sql="select `kto` from `zalogowani`";
                $query=mysqli_query($connect,$sql);
                $row=mysqli_fetch_assoc($query);

                $_SESSION['id_lekarza_rezerwacja']=$_POST['id_lekarz'];


                $sql = "SELECT * FROM `terminarz` WHERE `dostepnosc` = true AND `id_lekarza` = ".$_SESSION['id_lekarza_rezerwacja']." ORDER BY `data`, `godzina`;";
                $query = mysqli_query($connect, $sql); // pobranie danych o terminach

                echo "<form method='POST' action='rezerwacja.php'>";
                echo "Dostępne terminy: <br>";

                $czas = date("H:i:s");
                $data = date("Y-m-d");
                $teraz = strtotime("$data $czas");
                $maxTermin = strtotime("+5 days", $teraz); // pobranie danych

                $i = 0;
                $terminy_w_ciagu_5_dni = [];

                while ($row = mysqli_fetch_assoc($query)) {
                    $termin = strtotime($row['data'] . ' ' . $row['godzina']);

                    if ($termin > $teraz && $termin <= $maxTermin) { // wyswietlenie terminow w ciagu 5 dni
                        echo "<input type='radio' name='termin' value='" . $row['data'] . " " . $row['godzina'] . "'> ";
                        echo $row['data'] . " - " . $row['godzina'] . "<br>";
                        $terminy_w_ciagu_5_dni[] = $row;
                        $i++;
                    }
                }
                echo "</form>";

                if ($i == 0) { // formularz do wybrania alternatywnych metod rezerwacji terminow
                    echo "Brak dostępnych wizyt w ciągu najbliższych 5 dni!<br>";
                    echo '    <form action="rezerwuj_2.php" method="post">
                                <input type="submit" value="Późniejsze terminy dla wybranego lekarza">
                            </form>
                            <form action="rezerwuj_3.php" method="post">
                                <input type="submit" value="Wybierz innego lekarza tej samej specjalizacji">
                            </form>';
                }
                ?>
        </main>
    </div>
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>