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
            <div class="index-content" style="margin-left: 30px">
                <h2>Aktualności</h2> <!--blok aktualności!-->
                <img src="przychodnia1.jpg" alt="przychodnia_wyremontowana">
                <h3>Recepcja naszej przychodni została wyremontowana!</h3>
                <p>Z radością informujemy, że zakończyliśmy remont recepcji w naszej przychodni. Nowe wnętrze jest teraz bardziej przestronne, nowoczesne i komfortowe dla pacjentów. Wprowadziliśmy lepsze oświetlenie, wygodne miejsca do siedzenia oraz intuicyjny system kolejkowy, który usprawni obsługę.

Dzięki modernizacji rejestracja będzie szybsza i bardziej efektywna. Mamy nadzieję, że zmiany pozytywnie wpłyną na Państwa wygodę i satysfakcję z naszych usług.

Zapraszamy do odwiedzin i życzymy dużo zdrowia!</p>
            </div>
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>