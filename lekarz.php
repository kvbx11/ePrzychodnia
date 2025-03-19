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
                <p>Zarejestruj konto lekarza na platformie ePrzychodnia</p>
                <br>
            <form method="post">
                            <input type="text" name="imie" placeholder="Imię"><br>
                            <input type="text" name="nazwisko" placeholder="Nazwisko"><br>
                            <input type="text" name="specjalizacja" placeholder="Specjalizacja"><br>
                            <input type="text" name="PWZ" placeholder="Nr Prawa Wykonywania Zawodu"><br>
                            <input type="tel" name="tel" placeholder="Telefon"><br>
                            <input type="email" name="email" placeholder="E-mail"><br>
                            <input type="text" name="stanowisko" placeholder="Stanowisko"><br>
                            <input type="text" name="haslo" placeholder="Hasło"><br><br>
                            <input type="submit" value="Prześlij" name="submit">
                        </form>
                        <?php
                        $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                        if (!$connect) {
                            die("Połączenie z bazą danych nie powiodło się.");
                        }
                        if(isset($_POST['submit'])){
                            $imie = $_POST['imie'];
                            $nazwisko = $_POST['nazwisko'];
                            $login = strtolower(substr($imie, 0, 3) . substr($nazwisko, 0, 3) . rand(100, 999));
                            $query5 = "INSERT INTO `pracownik` (`Imie`, `Nazwisko`, `Specjalizacja`, `PWZ`, `tel`, `email`, `stanowisko`, `login`, `haslo`) VALUES ('".$_POST['imie']."','".$_POST['nazwisko']."','".$_POST['specjalizacja']."','".$_POST['PWZ']."','".$_POST['tel']."','".$_POST['email']."','".$_POST['stanowisko']."','".$login."', '".$_POST['haslo']."')";
                            $result5=mysqli_query($connect,$query5);
                            echo "Pomyślnie dodano!";
                            echo "Login: ".$login;
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