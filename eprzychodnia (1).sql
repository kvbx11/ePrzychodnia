-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 09:33 PM
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
  `login` char(9) DEFAULT NULL,
  `haslo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pacjenci`
--

INSERT INTO `pacjenci` (`id_pacjenta`, `imie`, `nazwisko`, `ulica`, `nr_domu`, `kp`, `miasto`, `tel`, `email`, `PESEL`, `login`, `haslo`) VALUES
(1, 'Urszula', 'Krawiec', 'Pomorska', '14C/8', '51--00', 'Wałbrzych', '123456789', 'ulakraw@o2.pl', '84128463210', 'urskra632', 'ulkakrawiec10'),
(3, 'Anna', 'Kowalska', 'Zamkowa', '13/3', '61-001', 'Poznań', '987654321', 'akowalska@vlopoznan.pl', '84128463210', 'annkow632', 'ankowalska10'),
(4, 'Janusz', 'Kraska', 'Magazynowa', '10/2', '45-089', 'Radom', '123456789', 'kraskajanek@op.pl', '21874361985', 'jankra619', 'janekk123');

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
(7, 'Jan', 'Kowal', 'Onkolog', 'WZ213-779', '987654321', 'jankowal@gmail.com', 'lekarz', 'jankow355', 'janek10');

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
(4, '2025-03-17', '12:00:00', 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `terminarz`
--

CREATE TABLE `terminarz` (
  `data` date DEFAULT NULL,
  `godzina` time DEFAULT NULL,
  `dostepnosc` tinyint(1) DEFAULT NULL,
  `specjalizacja` varchar(100) DEFAULT NULL,
  `id_lekarza` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `terminarz`
--

INSERT INTO `terminarz` (`data`, `godzina`, `dostepnosc`, `specjalizacja`, `id_lekarza`) VALUES
('2025-03-17', '12:00:00', 1, 'onkolog', 7);

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
  `przegladaj_rezerwacje` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uprawnienia`
--

INSERT INTO `uprawnienia` (`stanowisko`, `zaloz_konto`, `usun_konto`, `dane_pacjentow`, `dodaj_wpis`, `rezerwuj`, `przegladaj_historie`, `przegladaj_rezerwacje`) VALUES
('admin', 1, 1, 0, 0, 0, 0, 0),
('lekarz', 0, 0, 1, 1, 0, 1, 1),
('pielegniarz', 0, 0, 0, 1, 0, 0, 0),
('recepcjonista', 1, 0, 0, 0, 1, 0, 0),
('pacjent', 0, 0, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zalogowani`
--

CREATE TABLE `zalogowani` (
  `login` char(9) DEFAULT NULL,
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
-- Indeksy dla tabeli `terminarz`
--
ALTER TABLE `terminarz`
  ADD PRIMARY KEY (`id_lekarza`);

--
-- Indeksy dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
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
  MODIFY `id_lekarza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badania`
--
ALTER TABLE `badania`
  ADD CONSTRAINT `badania_ibfk_1` FOREIGN KEY (`id_lekarza`) REFERENCES `pracownik` (`id_lekarza`),
  ADD CONSTRAINT `badania_ibfk_2` FOREIGN KEY (`id_pacjenta`) REFERENCES `pacjenci` (`id_pacjenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
