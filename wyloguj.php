<?php
    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");
    if(!$connect) {
        die("Połączenie z bazą danych nie powiodło się.");
    }
    $query0="truncate `zalogowani`";
    $result0=mysqli_query($connect,$query0);
    header("Location: index.php");



?>