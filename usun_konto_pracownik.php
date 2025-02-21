<?php
$connect = mysqli_connect("localhost", "root", "", "eprzychodnia");

if (!$connect) {
    die("Połączenie z bazą danych nie powiodło się.");
}


$idx=$_POST['id_konta'];
echo $idx;

$query="delete from `pracownik` where `id_lekarza`=".$idx.";";
mysqli_query($connect,$query);

//header("Location: zarzadzaj_kontami_lekarzy.php");


?>