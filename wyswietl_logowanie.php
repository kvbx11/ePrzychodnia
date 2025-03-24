<?php
            $connect = mysqli_connect("localhost", "root", "", "eprzychodnia"); // polaczenie z baza danych

            if (!$connect) {
                die("Połączenie z bazą danych nie powiodło się.");
            }

            $query0 = "SELECT `login` FROM `zalogowani` LIMIT 1"; // pobranie danych z bazy
            $result = mysqli_query($connect, $query0);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $log = $row['login'];
                echo "Zalogowano jako: " . htmlspecialchars($log); //wyswietlenie loginu zalogowanego uzytkownika
            } else {
                echo "Nie zalogowano.";
            }
            


            mysqli_close($connect);
        ?>