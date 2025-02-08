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
        <div class="w-10"></div> 
        <h1 class="text-xl font-bold text-center flex-1"><a href="index.php">ePrzychodnia</a></h1>
        <div>
            <form action="zaloguj.php">
                <button class="icon-button"><i class="fa-solid fa-user"></i></button> 
            </form>
            <form action="wyloguj.php">
                <button class="icon-button"><i class="fa fa-sign-out"></i></button>
            </form>
        </div>
    </header>
    
    <div style="display: flex; flex: 1;">
        <nav>
        <?php
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                $query0="select * from `zalogowani`";
                $result0=mysqli_query($connect,$query0);

                if(mysqli_num_rows($result0)>0){
                    $query1 = "SELECT `kto` FROM `zalogowani`";
                    $result1 = mysqli_query($connect, $query1);
                    $kto;
                    if ($row = mysqli_fetch_assoc($result1)) {
                        $kto = $row['kto']; 
                    }
                    $query2="select * from `uprawnienia` where `stanowisko`='".$kto."'";
                    $result2=mysqli_query($connect,$query2);
    
                    if($row=mysqli_fetch_assoc($result2)){
                        //print_r($row);
                        $zaloz_konto=$row['zaloz_konto'];
                        $usun_konto=$row['usun_konto'];
                        $dane_pacjentow=$row['dane_pacjentow'];
                        $dodaj_wpis=$row['dodaj_wpis'];
                        $rezerwuj=$row['rezerwuj'];
                        $przegladaj_historie=$row['przegladaj_historie'];
    
                        if($zaloz_konto==1 && $usun_konto==1){
                            echo "<p><a href='zarzadzaj_kontami.php'>Zarządzaj kontami</a></p>";
                        }
                        if($dane_pacjentow==1){
                            echo "<p><a href='dane_pacjentow.php'>Sprawdź dane pacjentów</a></p>";
                        }
                        if($dodaj_wpis==1){
                            echo "<p><a href='dodaj_wpis.php'>Dodaj wizytę</a></p>";
                            
                        }
                        if($rezerwuj==1){
                            echo "<p><a href='rezerwuj.php'>Zarezerwuj wizytę</a></p>";
    
                        }
                        if($przegladaj_historie==1){
                            echo "<p><a href='historia.php'>Przeglądaj historię badań</a></p>";
                        }
                    }
                }

            
            ?>
        </nav>
        
        <main>
            <div class="index-content">
                <form method='post'>
                    <input type='text' name='login' placeholder='Twój login'><br>
                    <input type='password' name='haslo' placeholder='Twoje hasło'><br><br>
                    <input type='submit' name='przeslij' value='Zaloguj się!'>
                </form>
                <br><br>
                <?php
                    if(isset($_POST['przeslij'])){
                        $log = $_POST['login'];
                        $haslo = sha1($_POST['haslo']);

                        $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");
                        if(!$connect) {
                            die("Połączenie z bazą danych nie powiodło się.");
                        }

                        $query_1 = "SELECT `haslo`, `stanowisko` FROM `pracownik` WHERE `login` = ?";
                        $stmt_1 = mysqli_prepare($connect, $query_1);
                        mysqli_stmt_bind_param($stmt_1, 's', $log);
                        mysqli_stmt_execute($stmt_1);
                        mysqli_stmt_bind_result($stmt_1, $hashed_password, $status);
                        mysqli_stmt_fetch($stmt_1);
                        mysqli_stmt_close($stmt_1);

                        if(sha1($hashed_password) == $haslo){
                            $query_2 = "INSERT INTO `zalogowani` (`login`, `haslo`, `kto`) VALUES (?, ?, ?)";
                            $stmt_2 = mysqli_prepare($connect, $query_2);
                            mysqli_stmt_bind_param($stmt_2, 'sss', $log, $haslo, $status);
                            mysqli_stmt_execute($stmt_2);
                            mysqli_stmt_close($stmt_2);

                            echo "Zalogowano pomyślnie jako: ".$status;
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
