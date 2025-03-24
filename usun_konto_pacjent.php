<?php
$connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

if (!$connect) {
    die("Połączenie z bazą danych nie powiodło się.");
}


$idx=$_POST['id_konta'];

$query="delete from `pacjenci` where `id_pacjenta`=".$idx.""; // usuniecie z bazy danych pacjenta o podanym ID
$result=mysqli_query($connect,$query);

header("Location: zarzadzaj_kontami_pacjentow.php"); // powrot na strone wczesniejsza 


?>