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
                <form method='post'> <!--formularz do zalogowania-->
                    <input type='text' name='login' placeholder='Twój login'><br>
                    <input type='password' name='haslo' placeholder='Twoje hasło'><br><br>
                    <input type='submit' name='przeslij' value='Zaloguj się!'>
                </form>
                <br><br>
                <?php
                    if(isset($_POST['przeslij'])){
                        $log = $_POST['login'];
                        $haslo = sha1($_POST['haslo']);

                        $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // pobranie danych z bazy
                        if(!$connect) {
                            die("Połączenie z bazą danych nie powiodło się.");
                        }

                        $query_1 = "SELECT `haslo` FROM `pacjenci` WHERE `login` = '".$log."';";
                        $res1=mysqli_query($connect, $query_1);
                        $row=mysqli_fetch_assoc($res1);
                        if(sha1($row['haslo']) == $haslo){
                            $query_2 = "INSERT INTO `zalogowani` (`login`, `haslo`, `kto`) VALUES ('".$log."', '".$haslo."', 'pacjent')";
                            $res2=mysqli_query($connect,$query_2); // sprawdzenie danych z tymi, zawartymi w bazie danych
                            echo "Zalogowano pomyślnie jako: Pacjent";
                        } else {
                            echo "Błąd logowania. Spróbuj ponownie.";
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
