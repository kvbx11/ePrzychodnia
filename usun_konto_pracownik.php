<?php
$connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

if (!$connect) {
    die("Połączenie z bazą danych nie powiodło się.");
}


$idx=$_POST['id_konta'];

$query="delete from `pracownik` where `id_lekarza`=".$idx."";
$result=mysqli_query($connect,$query);

header("Location: zarzadzaj_kontami_lekarzy.php");


?>