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
            <form method="post">
                        <p>Jestem:</p>
                        <input type="submit" name="lekarz" value="Lekarzem">
                        <input type="submit" name="pacjent" value="Pacjentem">
                    </form>
                <?php
                    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");
                    if(!$connect) {
                        die("Połączenie z bazą danych nie powiodło się.");
                    }
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
    
                    if(isset($_POST['pacjent'])){
                        echo '
                        <form method="post">
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
                            <input type="submit" value="Prześlij">
                        </form>';
    
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

            ?>
            </div>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>