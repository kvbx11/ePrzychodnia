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
                $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

                if (!$connect) {
                    die("Połączenie z bazą danych nie powiodło się.");
                }
                $query="select `login` from `zalogowani`";
                $result=mysqli_query($connect, $query);
                $row=mysqli_fetch_assoc($result);
                $login_zal=$row['login'];

                $query3="select `id_lekarza` from `pracownik` where `login`='".$login_zal."';";
                $result3=mysqli_query($connect,$query3);
                $row=mysqli_fetch_assoc($result3);
                echo "Twoje ID: ".$row['id_lekarza']."<br>";
                ?>
                <br>
                <form method="post">
                    <input type="number" name="id_pacjenta" placeholder="ID Pacjenta"> <br>
                    <input type="number" name="id_lekarza" placeholder="ID Lekarza"> <br>
                    <textarea name="opis" placeholder="Opis Badania"></textarea> <br>
                    <textarea name="diagnoza" placeholder="Diagnoza"></textarea> <br>
                    <input type="text" name="recepta" placeholder="Recepta"> <br>
                    <input type="date" name="data"><br><br>
                    <input type="submit" value="Dodaj wizytę" name="przeslij">
                </form>
            </div>

            <?php
            if(isset($_POST['przeslij'])){
                $query4="INSERT INTO `badania`(`id_pacjenta`, `id_lekarza`, `opis_badania`, `diagnoza`, `recepta`, `data`) VALUES ('".$_POST['id_pacjenta']."','".$_POST['id_lekarza']."','".$_POST['opis']."','".$_POST['diagnoza']."','".$_POST['recepta']."','".$_POST['data']."')";
                $result4=mysqli_query($connect,$query4);
    
                echo "Dodano wizytę!";
            }
            ?>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>
