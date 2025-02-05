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
                    $log=$_POST['login'];
                    $haslo=hash($_POST['haslo']);

                    $connect=mysqli_connect("localhost", "root", "", "ePrzychodnia");
                    $query_db="select `haslo` from `pracownicy` where `login`=".$login.";";
                    $result_1=mysqli_query($query_db,$connect);

                    if($haslo==$result_1){
                        // dodawanie do aktualnie zalogowanych
                        header("Location: index.php");
                    }

                    
                    //echo '<input type="submit" name="rejestracja" id="check1" value="Rejestracja"> ';
                    // if(isset($_POST['rejestracja'])){
                    //     echo '       
                    //     <form method="post">
                    //         <p>Jestem:</p>
                    //         <input type="submit" name="lekarz" value="Lekarzem">
                    //         <input type="submit" name="pacjent" value="Pacjentem">
                    //     </form>';

                    //     if(isset($_POST['lekarz'])){
                    //         echo '            
                    //         <form method="post">
                    //             <input type="text" name="imie" namespace="Imię">
                    //             <input type="text" name="nazwisko" namespace="Nazwisko">
                    //             <input type="text" name="specjalizacja" namespace="Specjalizacja">
                    //             <input type="text" name="PWZ" namespace="Nr Prawa Wykonywania Zawodu">
                    //             <input type="tel" name="tel" namespace="Telefon">
                    //             <input type="email" name="email" namespace="E-mail">
                    //             <input type="text" name="stanowisko" namespace="Stanowisko">
                    //             <input type="submit" value="Prześlij">
                    //         </form>';
                    //     }
                    //     if(isset($_POST['pacjent'])){
                    //         echo '
                    //         <form method="post">
                    //             <input type="text" name="imie" namespace="Imię">
                    //             <input type="text" name="nazwisko" namespace="Nazwisko">
                    //             <input type="text" name="ulica" namespace="Ulica">
                    //             <input type="text" name="numer" namespace="Numer domu/mieszkania">
                    //             <input type="text" name="kp" namespace="Kod Pocztowy">
                    //             <input type="text" name="miasto" namespace="Miasto">
                    //             <input type="submit" value="Prześlij">
                    //             <input type="tel" name="tel" namespace="Telefon">
                    //             <input type="email" name="email" namespace="E-mail">
                    //             <input type="text" name="pesel" namespace="PESEL">
                    //             <input type="submit" value="Prześlij">
                    //         </form>';
                    //     }
                    // tworzenie loginu
                    // }
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