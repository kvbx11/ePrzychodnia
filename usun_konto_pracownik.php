<?php
$connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

if (!$connect) {
    die("Połączenie z bazą danych nie powiodło się.");
}


$idx=$_POST['id_konta'];

$query="delete from `pracownik` where `id_lekarza`=".$idx.";"; // usuniecie z bazy danych pracownika o podanym ID
$result=mysqli_query($connect,$query);

header("Location: zarzadzaj_kontami_lekarzy.php"); // powrot na wczesniej uzywana strone

mysqli_close($connect);
?>