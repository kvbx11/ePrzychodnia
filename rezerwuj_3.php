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
                session_start();
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
                }
                
                $id_lekarz = $_SESSION['id_lekarza_rezerwacja'];

                $sql = "SELECT `id_lekarza`,`Imie`,`Nazwisko`,`Specjalizacja` FROM `pracownik` WHERE `Specjalizacja`='".$_SESSION['specjalizacja']."' AND `id_lekarza` != ".$_SESSION['id_lekarza_rezerwacja'].";";
                $query = mysqli_query($connect, $sql);

                echo "Wybierz lekarza <br>";
                echo "<form action='rezerwuj_3_1.php' method='post'>";
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<input type='radio' name='id_lekarz' value='" . $row['id_lekarza'] . "'>" . htmlspecialchars($row['Imie']) . " " . htmlspecialchars($row['Nazwisko']) . " - " . htmlspecialchars($row['Specjalizacja']) . "</input>";
                }
                ?>                
                <br>
                <input type="submit" value="Dalej">
                </form>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>
