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
                <h2>Historia z ostatnich 7 dni:</h2>
                <?php
                    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza

                    if (!$connect) {
                        die("Połączenie z bazą danych nie powiodło się.");
                    }

                    $sql = "SELECT `id_pacjenta` FROM `pacjenci` INNER JOIN `zalogowani` ON `zalogowani`.`login` = `pacjenci`.`login`"; // pobranie danych o pacjencie
                    $qu = mysqli_query($connect, $sql);
                    $row = mysqli_fetch_assoc($qu);

                    if ($row) {
                        $sql1 = "SELECT * FROM `recepty` WHERE (`zaakceptowane` = 1 AND `id_pacjenta` = " . $row['id_pacjenta'] . ") AND TIMESTAMPDIFF(DAY, `data_akceptacji`, DATE(NOW())) <= 7";
                        $query = mysqli_query($connect, $sql1); // pobranie danych o receptach

                        if (mysqli_num_rows($query) > 0) {
                            echo "<h3>Wystawione recepty:</h3>"; // wyswietlenie danych o receptach
                            while ($recepta = mysqli_fetch_assoc($query)) {
                                echo "<p>Lek: " . $recepta['nazwa leku'] . " | Data akceptacji: " . $recepta['data_akceptacji'] . " | Dawka: ".$recepta['dawka']." | Dziennie: ".$recepta['dawkowanie_pacjent']."</p>";
                            }
                        } else {
                            echo "<h3>Brak wystawionych recept w ciągu ostatnich 7 dni!</h3>";
                        }


                        $sql2 = "SELECT * FROM badania WHERE id_pacjenta = " . $row['id_pacjenta'] . " AND TIMESTAMPDIFF(DAY, data, DATE(NOW())) <= 7;";
                        $query1 = mysqli_query($connect, $sql2); // pobranie danych o badaniach

                        if (mysqli_num_rows($query1) > 0) {
                            echo "<h3>Wizyty lekarskie z ostatnich 7 dni:</h3>";

                            while ($row1 = mysqli_fetch_assoc($query1)) {
                                $sqlp = "SELECT `imie`, `nazwisko` FROM `pracownik` WHERE `id_lekarza` = '" . $row1['id_lekarza'] . "';";
                                $queryp = mysqli_query($connect, $sqlp);
                                if ($lekarz = mysqli_fetch_assoc($queryp)) { // wyswietlenie danych o badaniach
                                    echo "Lekarz: " . $lekarz['imie'] . " " . $lekarz['nazwisko'] . "<br>";
                                    echo "Data wizyty: " . $row1['data'] . " Diagnoza: ".$row1['diagnoza']."<br><br>";
                                }
                            }
                        }
                        else{
                            echo "<h3>Brak wizyt lekarskich w ciągu ostatnich 7 dni!</h3>";
                        }
                    } 
                    else {
                        echo "<h3>Nie znaleziono pacjenta!</h3>";
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