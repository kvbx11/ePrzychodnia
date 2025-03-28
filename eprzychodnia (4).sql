-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 04:33 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eprzychodnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `badania`
--

CREATE TABLE `badania` (
  `id_pacjenta` int(10) UNSIGNED DEFAULT NULL,
  `id_lekarza` int(10) UNSIGNED DEFAULT NULL,
  `opis_badania` text DEFAULT NULL,
  `diagnoza` text DEFAULT NULL,
  `recepta` text DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `badania`
--

INSERT INTO `badania` (`id_pacjenta`, `id_lekarza`, `opis_badania`, `diagnoza`, `recepta`, `data`) VALUES
(3, 7, 'bol kolana pacjenta wykonanie badan ruchomosci', 'stluczenie kolana', 'ketonal', '2024-10-10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjenci`
--

CREATE TABLE `pacjenci` (
  `id_pacjenta` int(10) UNSIGNED NOT NULL,
  `imie` varchar(100) DEFAULT NULL,
  `nazwisko` varchar(100) DEFAULT NULL,
  `ulica` varchar(100) DEFAULT NULL,
  `nr_domu` varchar(10) DEFAULT NULL,
  `kp` char(6) DEFAULT NULL,
  `miasto` varchar(100) DEFAULT NULL,
  `tel` char(9) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `PESEL` char(11) DEFAULT NULL,
  `login` char(11) DEFAULT NULL,
  `haslo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pacjenci`
--

INSERT INTO `pacjenci` (`id_pacjenta`, `imie`, `nazwisko`, `ulica`, `nr_domu`, `kp`, `miasto`, `tel`, `email`, `PESEL`, `login`, `haslo`) VALUES
(1, 'Urszula', 'Krawiec', 'Pomorska', '14C/8', '51--00', 'Wałbrzych', '123456789', 'ulakraw@o2.pl', '84128463210', 'urskra63210', 'ulkakrawiec10'),
(3, 'Anna', 'Kowalska', 'Zamkowa', '13/3', '61-001', 'Poznań', '987654321', 'akowalska@vlopoznan.pl', '84128463210', 'annkow63210', 'ankowalska10'),
(4, 'Janusz', 'Kraska', 'Magazynowa', '10/2', '45-089', 'Radom', '123456789', 'kraskajanek@op.pl', '21874361985', 'jankra61985', 'janekk123');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownik`
--

CREATE TABLE `pracownik` (
  `id_lekarza` int(10) UNSIGNED NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `Specjalizacja` varchar(100) DEFAULT NULL,
  `PWZ` varchar(100) DEFAULT NULL,
  `tel` char(9) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `stanowisko` varchar(100) NOT NULL,
  `login` char(9) DEFAULT NULL,
  `haslo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pracownik`
--

INSERT INTO `pracownik` (`id_lekarza`, `Imie`, `Nazwisko`, `Specjalizacja`, `PWZ`, `tel`, `email`, `stanowisko`, `login`, `haslo`) VALUES
(2, 'Admin', 'Admin', NULL, NULL, NULL, 'administracja@eprzychodnia.pl', 'admin', 'admadm120', 'admin123'),
(7, 'Jan', 'Kowal', 'Onkolog', 'WZ213-779', '987654321', 'jankowal@gmail.com', 'lekarz', 'jankow355', 'janek10'),
(8, 'Jonasz', 'Krause', 'Pediatria', 'WZ211-7', '129034901', 'jonasz.krause@wp.pl', 'recepcjonista', 'jonkra325', 'Jonasz1010'),
(10, 'Adolf', 'Kuźniak', 'administracja', 'ZW0-W4619', '999999999', 'a.kuzniak@wp.pl', 'pielegniarz', 'adokuz781', 'adolf2137'),
(11, 'Jakub', 'Kolodziej', 'Onkolog', 'IZO94-1234', '999999999', 'jkolodziej@o2.pl', 'lekarz internista', 'jakkol253', 'Kolodziej2137');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recepty`
--

CREATE TABLE `recepty` (
  `id_lekarza` int(10) UNSIGNED DEFAULT NULL,
  `id_pacjenta` int(10) UNSIGNED DEFAULT NULL,
  `nazwa leku` varchar(100) DEFAULT NULL,
  `dawka` varchar(100) DEFAULT NULL,
  `dawkowanie_pacjent` varchar(100) DEFAULT NULL,
  `ilosc_opakowan` int(10) UNSIGNED DEFAULT NULL,
  `zaakceptowane` tinyint(1) DEFAULT 0,
  `id_recepty` int(10) UNSIGNED NOT NULL,
  `data_akceptacji` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `recepty`
--

INSERT INTO `recepty` (`id_lekarza`, `id_pacjenta`, `nazwa leku`, `dawka`, `dawkowanie_pacjent`, `ilosc_opakowan`, `zaakceptowane`, `id_recepty`, `data_akceptacji`) VALUES
(7, 3, '123', '132', '123', 123, 1, 1, '2025-03-03'),
(7, 3, '123', '132', '123', 123, 1, 2, NULL),
(7, 3, 'Acodin', '10 tabletek', '2 tabletki dziennie', 1, 1, 3, '2025-03-18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id_pacjenta` int(10) UNSIGNED DEFAULT NULL,
  `data` date DEFAULT NULL,
  `godzina` time DEFAULT NULL,
  `id_lekarza` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezerwacje`
--

INSERT INTO `rezerwacje` (`id_pacjenta`, `data`, `godzina`, `id_lekarza`) VALUES
(3, '2025-03-17', '12:00:00', 7),
(3, '2025-12-10', '12:30:00', 7),
(3, '2025-02-22', '12:30:00', 0),
(3, '2025-02-22', '12:30:00', 0),
(3, '2025-02-22', '12:30:00', 0),
(3, '2025-02-22', '12:30:00', 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `terminarz`
--

CREATE TABLE `terminarz` (
  `data` date DEFAULT NULL,
  `godzina` time DEFAULT NULL,
  `dostepnosc` tinyint(1) DEFAULT NULL,
  `specjalizacja` varchar(100) DEFAULT NULL,
  `id_lekarza` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `terminarz`
--

INSERT INTO `terminarz` (`data`, `godzina`, `dostepnosc`, `specjalizacja`, `id_lekarza`) VALUES
('2025-02-22', '12:30:00', 0, 'onkolog', 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `stanowisko` varchar(100) NOT NULL,
  `zaloz_konto` tinyint(1) DEFAULT NULL,
  `usun_konto` tinyint(1) DEFAULT NULL,
  `dane_pacjentow` tinyint(1) DEFAULT NULL,
  `dodaj_wpis` tinyint(1) DEFAULT NULL,
  `rezerwuj` tinyint(1) DEFAULT NULL,
  `przegladaj_historie` tinyint(1) DEFAULT NULL,
  `przegladaj_rezerwacje` tinyint(1) DEFAULT 0,
  `ewizyta` tinyint(1) DEFAULT 0,
  `napisz_recepte` tinyint(1) DEFAULT 0,
  `potwierdz_recepte` tinyint(1) DEFAULT 0,
  `wyswietl_historie_7dni_lekarz` tinyint(1) DEFAULT 0,
  `wyswietl_historie_7dni_pacjent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uprawnienia`
--

INSERT INTO `uprawnienia` (`stanowisko`, `zaloz_konto`, `usun_konto`, `dane_pacjentow`, `dodaj_wpis`, `rezerwuj`, `przegladaj_historie`, `przegladaj_rezerwacje`, `ewizyta`, `napisz_recepte`, `potwierdz_recepte`, `wyswietl_historie_7dni_lekarz`, `wyswietl_historie_7dni_pacjent`) VALUES
('admin', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('lekarz', 0, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 0),
('lekarz internista', 0, 0, 1, 1, 0, 1, 1, 1, 0, 1, 1, 0),
('pacjent', 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 1),
('pielegniarz', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
('recepcjonista', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zalogowani`
--

CREATE TABLE `zalogowani` (
  `login` char(11) DEFAULT NULL,
  `haslo` varchar(100) DEFAULT NULL,
  `kto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `badania`
--
ALTER TABLE `badania`
  ADD KEY `id_lekarza` (`id_lekarza`),
  ADD KEY `id_pacjenta` (`id_pacjenta`);

--
-- Indeksy dla tabeli `pacjenci`
--
ALTER TABLE `pacjenci`
  ADD PRIMARY KEY (`id_pacjenta`);

--
-- Indeksy dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  ADD PRIMARY KEY (`id_lekarza`,`stanowisko`);

--
-- Indeksy dla tabeli `recepty`
--
ALTER TABLE `recepty`
  ADD PRIMARY KEY (`id_recepty`),
  ADD KEY `id_lekarza` (`id_lekarza`),
  ADD KEY `id_pacjenta` (`id_pacjenta`);

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD KEY `id_pacjenta` (`id_pacjenta`);

--
-- Indeksy dla tabeli `terminarz`
--
ALTER TABLE `terminarz`
  ADD UNIQUE KEY `id_lekarza` (`id_lekarza`);

--
-- Indeksy dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD PRIMARY KEY (`stanowisko`),
  ADD KEY `stanowisko` (`stanowisko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pacjenci`
--
ALTER TABLE `pacjenci`
  MODIFY `id_pacjenta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `id_lekarza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `recepty`
--
ALTER TABLE `recepty`
  MODIFY `id_recepty` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badania`
--
ALTER TABLE `badania`
  ADD CONSTRAINT `badania_ibfk_1` FOREIGN KEY (`id_lekarza`) REFERENCES `pracownik` (`id_lekarza`),
  ADD CONSTRAINT `badania_ibfk_2` FOREIGN KEY (`id_pacjenta`) REFERENCES `pacjenci` (`id_pacjenta`);

--
-- Constraints for table `recepty`
--
ALTER TABLE `recepty`
  ADD CONSTRAINT `recepty_ibfk_1` FOREIGN KEY (`id_lekarza`) REFERENCES `pracownik` (`id_lekarza`),
  ADD CONSTRAINT `recepty_ibfk_2` FOREIGN KEY (`id_pacjenta`) REFERENCES `pacjenci` (`id_pacjenta`);

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`id_pacjenta`) REFERENCES `pacjenci` (`id_pacjenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
