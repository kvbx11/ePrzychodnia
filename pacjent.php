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
            <p>Zarejestruj konto pacjenta na platformie ePrzychodnia</p>
            <br>
            <form method="post"> <!--Formularz do rejestracji pacjenta!-->
                            <input type="text" name="imie" placeholder="Imię"><br>
                            <input type="text" name="nazwisko" placeholder="Nazwisko"><br>
                            <input type="text" name="ulica" placeholder="Ulica"><br>
                            <input type="text" name="numer" placeholder="Numer domu/mieszkania"><br>
                            <input type="text" name="kp" placeholder="Kod Pocztowy"><br>
                            <input type="text" name="miasto" placeholder="Miasto"><br>
                            <input type="tel" name="tel" placeholder="Telefon"><br>
                            <input type="email" name="email" placeholder="E-mail"><br>
                            <input type="text" name="pesel" placeholder="PESEL"><br>
                            <input type="text" name="haslo" placeholder="Hasło"><br><br>
                            <input type="submit" value="Prześlij" name="submit">
                        </form>

                <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                
                if(isset($_POST['submit'])){
                    $imie1 = $_POST['imie'];
                    $nazw1 = $_POST['nazwisko'];
                    $pesel = $_POST['pesel'];
                    $login1 = strtolower(substr($imie1, 0, 3) . substr($nazw1, 0, 3) . substr($pesel, 6));
                    $haslo1 = $_POST['haslo'];
                    $query4 = "INSERT INTO `pacjenci` (`imie`, `nazwisko`, `ulica`, `nr_domu`, `kp`, `miasto`, `tel`, `email`, `PESEL`, `login`, `haslo`) VALUES ('".$_POST['imie']."','".$_POST['nazwisko']."','".$_POST['ulica']."','".$_POST['numer']."','".$_POST['kp']."','".$_POST['miasto']."','".$_POST['tel']."','".$_POST['email']."','".$_POST['pesel']."','".$login1."','".$_POST['haslo']."')";
                    $result4=mysqli_query($connect,$query4); // dodanie danych do bazy
                    echo "Pomyślnie dodano! <br>"; // wyswietlenie loginu
                    echo "Twój login: ".$login1."<br>";
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