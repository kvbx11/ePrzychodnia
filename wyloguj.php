<?php
    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych
    if(!$connect) {
        die("Połączenie z bazą danych nie powiodło się.");
    }
    $query0="truncate `zalogowani`"; // wyczyszczenie tabeli `zalogowani`
    $result0=mysqli_query($connect,$query0);
    header("Location: index.php"); // powrot na strone glowna



?>