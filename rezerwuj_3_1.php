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
            <div class="index-content">


                <?php
  $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

  if (!$connect) {
      die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
  }
  session_start();
  $sql = "SELECT * FROM `terminarz` WHERE `dostepnosc` = true AND `id_lekarza` = ".$_POST['id_lekarz']." ORDER BY `data`, `godzina`;";
  $_SESSION['id_lekarza_dodatkowa']=$_POST['id_lekarz'];
  $query = mysqli_query($connect, $sql); // pobranie danych o terminach

  echo "Dostępne terminy: <br>";

  $czas = date("H:i:s");
  $data = date("Y-m-d");
  $teraz = strtotime("$data $czas");
  $maxTermin = strtotime("+30 days", $teraz);// pobranie danych

  $i = 0;
  $terminy_w_ciagu_5_dni = [];
  echo "<form method='post' action='rezerwuj_3_2.php'>";
  while ($row = mysqli_fetch_assoc($query)) {
      $termin = strtotime($row['data'] . ' ' . $row['godzina']);

      if ($termin > $teraz && $termin <= $maxTermin) { // wyswietlenie terminow w ciagu 5 dni

          echo "<input type='radio' name='termin' value='" . $row['data'] . " " . $row['godzina'] . "'> ";
          echo $row['data'] . " - " . $row['godzina'] . "<br>";

          $terminy_w_ciagu_5_dni[] = $row;
          $i++;
      }
  }
  echo "<br><input type='submit' value='Zarezerwuj termin'>";
  echo "</form>";

  if ($i == 0) {
      echo "Brak dostępnych wizyt w ciągu najbliższych 5 dni!<br>";
      echo "<br>Propozycja innych terminów: <br>";

      $query1 = "SELECT * FROM `terminarz` WHERE `dostepnosc` = true AND `id_lekarza` = ".$_POST['id_lekarz']." ORDER BY `data`, `godzina` LIMIT 5;";
      $res = mysqli_query($connect, $query1);
  
      if (mysqli_num_rows($res) > 0) { 
          echo "<form method='post' action='rezerwuj_3_2.php'>";
  
          while ($row = mysqli_fetch_assoc($res)) { // wyswietlenie godzin 
              $_SESSION['godzina']=$row['godzina'];
              echo "<input type='radio' name='termin' value='" . $row['data'] . " " . $row['godzina'] . "'> ";
              echo $row['data'] . " - " . $row['godzina'] . "<br>";
          }
        // formularz do wybrania alternatywnej metody rezerwacji terminow
          echo "<br><input type='submit' value='Zarezerwuj termin'>";
          echo "</form>";
      } else {
          echo "Brak dostępnych terminów!";
          echo '               <form action="rezerwuj_3.php" method="post">
      <input type="submit" value="Zarezerwuj wizytę u innego lekarza!">
  </form>';
      }
  }
  mysqli_close($connect);
  ?>          
        </main>
    </div>
    
    <footer>
        <p>&copy; Jakub Kłódkowski 2025</p>
    </footer>
</body>
</html>
