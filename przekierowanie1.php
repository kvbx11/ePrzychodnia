<?php
    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

    if (!$connect) {
        die("Połączenie z bazą danych nie powiodło się.");
    }
    $id_recepty=$_POST['id_recepty'];
    $sql="update `recepty` set `zaakceptowane`=1, `data_akceptacji`=date(NOW()) where `id_recepty`=".$id_recepty.";";
    $query=mysqli_query($connect,$sql); // dodanie danych do bazy danych
    header("Location: zaakceptuj_recepte.php"); // przeniesienie na strone poczatkowa
    mysqli_close($connect);
?>