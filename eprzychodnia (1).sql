-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 07:42 PM
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
  `recepta` tinyint(1) DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(3, 'Jan', 'Nowak', 'Ortopeda', '0001WZ-2', '123456789', 'jannowak@eprzychodnia.pl', 'lekarz', 'jannow110', 'Janek10');

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
  `przegladaj_historie` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uprawnienia`
--

INSERT INTO `uprawnienia` (`stanowisko`, `zaloz_konto`, `usun_konto`, `dane_pacjentow`, `dodaj_wpis`, `rezerwuj`, `przegladaj_historie`) VALUES
('admin', 1, 1, 0, 0, 0, 0),
('lekarz', 0, 0, 1, 1, 0, 1),
('pielegniarz', 0, 0, 0, 1, 0, 0),
('recepcjonista', 1, 0, 0, 0, 1, 0),
('pacjent', 0, 0, 1, 0, 1, 1);

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
-- Dumping data for table `zalogowani`
--

INSERT INTO `zalogowani` (`login`, `haslo`, `kto`) VALUES
('admadm120', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'admin');

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
-- Indeksy dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD KEY `stanowisko` (`stanowisko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `id_lekarza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
