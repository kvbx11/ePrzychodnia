<?php
session_start();
if(isset($_POST['id_pacjenta'])){
    $_SESSION['id_pacjenta_historia'] = $_POST['id_pacjenta'];
    header("Location: historia_lekarz_rezerw.php");
    exit();
}
?>