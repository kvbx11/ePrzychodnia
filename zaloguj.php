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

                        // Pobranie hasła z bazy danych
                        $query_1 = "SELECT `haslo`, `stanowisko` FROM `pracownik` WHERE `login` = ?";
                        $stmt_1 = mysqli_prepare($connect, $query_1);
                        mysqli_stmt_bind_param($stmt_1, 's', $log);
                        mysqli_stmt_execute($stmt_1);
                        mysqli_stmt_bind_result($stmt_1, $hashed_password, $status);
                        mysqli_stmt_fetch($stmt_1);
                        mysqli_stmt_close($stmt_1);

                        // Sprawdzanie poprawności hasła
                        if(sha1($hashed_password) == $haslo){
                            // Wstawienie logowania do tabeli
                            $query_2 = "INSERT INTO `zalogowani` (`login`, `haslo`, `kto`) VALUES (?, ?, ?)";
                            $stmt_2 = mysqli_prepare($connect, $query_2);
                            mysqli_stmt_bind_param($stmt_2, 'sss', $log, $haslo, $status);
                            mysqli_stmt_execute($stmt_2);
                            mysqli_stmt_close($stmt_2);

                            echo "Zalogowano pomyślnie\n";

                            // Generowanie formularzy na podstawie statusu
                            if ($status == "admin" || $status == "recepcjonista") {
                                echo '       
                                    <form method="post">
                                        <p>Jestem:</p>
                                        <input type="submit" name="lekarz" value="Lekarzem">
                                        <input type="submit" name="pacjent" value="Pacjentem">
                                    </form>';

                                // Formularz dla lekarza
                                if(isset($_POST['lekarz'])){
                                    echo '            
                                    <form method="post">
                                        <input type="text" name="imie" placeholder="Imię"><br>
                                        <input type="text" name="nazwisko" placeholder="Nazwisko"><br>
                                        <input type="text" name="specjalizacja" placeholder="Specjalizacja"><br>
                                        <input type="text" name="PWZ" placeholder="Nr Prawa Wykonywania Zawodu"><br>
                                        <input type="tel" name="tel" placeholder="Telefon"><br>
                                        <input type="email" name="email" placeholder="E-mail"><br>
                                        <input type="text" name="stanowisko" placeholder="Stanowisko"><br>
                                        <input type="text" name="haslo" placeholder="Hasło"><br><br>
                                        <input type="submit" value="Prześlij">
                                    </form>';

                                    // Przetwarzanie formularza lekarza
                                    if(isset($_POST['imie'])){
                                        $imie = $_POST['imie'];
                                        $nazwisko = $_POST['nazwisko'];
                                        $login = strtolower(substr($imie, 0, 3) . substr($nazwisko, 0, 3) . rand(100, 999));
                                        $query5 = "INSERT INTO `pracownik` (`Imie`, `Nazwisko`, `Specjalizacja`, `PWZ`, `tel`, `email`, `stanowisko`, `login`, `haslo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                        $stmt5 = mysqli_prepare($connect, $query5);
                                        mysqli_stmt_bind_param($stmt5, 'sssssssss', $imie, $nazwisko, $_POST['specjalizacja'], $_POST['PWZ'], $_POST['tel'], $_POST['email'], $_POST['stanowisko'], $login, sha1($_POST['haslo']));
                                        mysqli_stmt_execute($stmt5);
                                        mysqli_stmt_close($stmt5);
                                    }
                                }

                                // Formularz dla pacjenta
                                if(isset($_POST['pacjent'])){
                                    echo '
                                    <form method="post">
                                        <input type="text" name="imie" placeholder="Imię">
                                        <input type="text" name="nazwisko" placeholder="Nazwisko">
                                        <input type="text" name="ulica" placeholder="Ulica">
                                        <input type="text" name="numer" placeholder="Numer domu/mieszkania">
                                        <input type="text" name="kp" placeholder="Kod Pocztowy">
                                        <input type="text" name="miasto" placeholder="Miasto">
                                        <input type="tel" name="tel" placeholder="Telefon">
                                        <input type="email" name="email" placeholder="E-mail">
                                        <input type="text" name="pesel" placeholder="PESEL">
                                        <input type="text" name="haslo" placeholder="Hasło">
                                        <input type="submit" value="Prześlij">
                                    </form>';

                                    // Przetwarzanie formularza pacjenta
                                    if(isset($_POST['imie'])){
                                        $imie1 = $_POST['imie'];
                                        $nazw1 = $_POST['nazwisko'];
                                        $pesel = $_POST['pesel'];
                                        $login1 = strtolower(substr($imie1, 0, 3) . substr($nazw1, 0, 3) . substr($pesel, -5));
                                        $haslo1 = $_POST['haslo'];
                                        $query4 = "INSERT INTO `pacjenci` (`imie`, `nazwisko`, `ulica`, `nr_domu`, `kp`, `miasto`, `tel`, `email`, `PESEL`, `login`, `haslo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                        $stmt4 = mysqli_prepare($connect, $query4);
                                        mysqli_stmt_bind_param($stmt4, 'sssssssssss', $imie1, $nazw1, $_POST['ulica'], $_POST['numer'], $_POST['kp'], $_POST['miasto'], $_POST['tel'], $_POST['email'], $pesel, $login1, sha1($haslo1));
                                        mysqli_stmt_execute($stmt4);
                                        mysqli_stmt_close($stmt4);
                                    }
                                }
                            } else {
                                echo "Brak uprawnień do zarządzania systemem. \n";
                            }
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
