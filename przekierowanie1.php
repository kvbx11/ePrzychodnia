<?php
    $connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

    if (!$connect) {
        die("Połączenie z bazą danych nie powiodło się.");
    }
    $id_recepty=$_POST['id_recepty'];
    $sql="update `recepty` set `zaakceptowane`=1 where `id_recepty`=".$id_recepty.";";
    $query=mysqli_query($connect,$sql);
    header("Location: zaakceptuj_recepte.php");

?>