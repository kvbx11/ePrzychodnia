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
                        die("Połączenie z bazą danych nie powiodło się.");
                    }

                    
                ?>
                <p>Czyimi kontami chcesz zarządzać?</p>
                <form action="zarzadzaj_kontami_pacjentow.php" method="post">
                    <input type="submit" value="Pacjentów"> <!--Wybor grupy uzytkownikow-->
                </form>
                <br>
                <form action="zarzadzaj_kontami_lekarzy.php" method="post">
                    <input type="submit" value="Lekarzy">
                </form>
                <p>Wpisz ID konta do usuniecia</p>
                <form action="usun_konto_pracownik.php" method="post">
                    <input type="number" name="id_konta" id="i0">
                    <input type="submit" value="Usuń">
                </form>
                <br>
                <br>
                <br>
                <?php
                    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

                    if (!$connect) {
                        die("Połączenie z bazą danych nie powiodło się.");
                    }

                    $query0="select * from `pracownik`";
                    $result0=mysqli_query($connect,$query0); // pobranie informacji o pracownikach przychodni

                    while($row=mysqli_fetch_assoc($result0)){ // wyswietlenie danych o pracownikach przychodni
                        echo "ID: ".$row['id_lekarza'].", Imię: ".$row['Imie'].", Nazwisko: ".$row['Nazwisko'].", Specjalizacja: ".$row['Specjalizacja'].", Pozwolenie: ".$row['PWZ'].", Telefon: ".$row['tel'].", Email: ".$row['email'].", Stanowisko: ".$row['stanowisko'].", Login: ".$row['login'].", Hasło: ".$row['haslo']."<br><br>";
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