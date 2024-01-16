-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 26, 2023 at 01:54 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imbiblio`
--
DROP DATABASE IF EXISTS `imbiblio`;
CREATE DATABASE IF NOT EXISTS `imbiblio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `imbiblio`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `czytelnicy`
--

DROP TABLE IF EXISTS `czytelnicy`;
CREATE TABLE `czytelnicy` (
  `id` int(11) NOT NULL,
  `imie` varchar(65) NOT NULL,
  `nazwisko` varchar(65) NOT NULL,
  `adres` varchar(65) NOT NULL,
  `urodzony` date NOT NULL,
  `nrDowodu` varchar(65) NOT NULL,
  `nrTelefonu` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `czytelnicy`
--

INSERT INTO `czytelnicy` (`id`, `imie`, `nazwisko`, `adres`, `urodzony`, `nrDowodu`, `nrTelefonu`, `id_user`) VALUES
(1, 'Mateusz', 'Turzyniecki', 'Imperialny Pałac', '1998-07-18', 'Imperator', 696942069, 2),
(2, 'Maciej', 'Kołoszko', 'Akademik Pollub', '1998-11-26', 'abc123123', 123131213, 3),
(3, 'Paweł', 'Pawluk', ' Pfefferburg', '1998-09-02', 'cde123123', 332423423, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazki`
--

DROP TABLE IF EXISTS `ksiazki`;
CREATE TABLE `ksiazki` (
  `id` int(11) NOT NULL,
  `tytuł` varchar(65) NOT NULL,
  `autor` varchar(65) NOT NULL,
  `rokWydania` int(11) NOT NULL,
  `gatunek` varchar(65) NOT NULL,
  `ISBN` varchar(65) NOT NULL,
  `id_wypozyczenia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ksiazki`
--

INSERT INTO `ksiazki` (`id`, `tytuł`, `autor`, `rokWydania`, `gatunek`, `ISBN`, `id_wypozyczenia`) VALUES
(1, 'Demokracja: bóg, który zawiódł', 'Hans Herman Hoppe', 2001, 'Ekonomia', '978-0765808684', 74),
(2, 'Władca Pierścieni Bractwo Pierścienia', 'John Ronald Reuel Tolkien', 2003, 'Fantastyka', '83-7311-253-7', 90),
(3, 'Władca Pierścieni Dwie Wieże', 'John Ronald Reuel Tolkien', 2003, 'Fantastyka', '83-7311-370-3', NULL),
(4, 'Władca Pierścieni Powrót Króla', 'John Ronald Reuel Tolkien', 2003, 'Fantastyka', '83-7311-371-1', NULL),
(5, 'Hobbit', 'John Ronald Reuel Tolkien', 1997, 'Fantastyka', '978-83-244-0353-0', 81),
(6, 'Niedokończone Opowieści', 'John Ronald Reuel Tolkien', 2015, 'Fantastyka', '978-83-241-5619-1', NULL),
(7, 'Miłość to wojna tom 1', 'Aka Akasaka', 2020, 'Manga', '978-83-8001-589-0', NULL),
(8, 'Miłość to wojna tom 2', 'Aka Akasaka', 2020, 'Manga', '978-83-8001-619-4', NULL),
(9, 'Miłość to wojna tom 3', 'Aka Akasaka', 2020, 'Manga', '978-83-8001-656-9', NULL),
(10, 'Miłość to wojna tom 4', 'Aka Akasaka', 2020, 'Manga', '978-83-8001-696-5', NULL),
(11, 'Miłość to wojna tom 5', 'Aka Akasaka', 2020, 'Manga', '978-83-8001-724-5', 73);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `function` varchar(65) NOT NULL,
  `id_reader` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `function`, `id_reader`) VALUES
(1, 'admin', 'admin', 'pracownik', NULL),
(2, 'user1', 'user1', 'czytelnik', 1),
(3, 'user2', 'user2', 'czytelnik', 2),
(4, 'user3', 'user3', 'czytelnik', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

DROP TABLE IF EXISTS `wypozyczenia`;
CREATE TABLE `wypozyczenia` (
  `id` int(11) NOT NULL,
  `id_ksiazki` int(11) NOT NULL,
  `id_reader` int(11) NOT NULL,
  `dataWypozyczenia` date NOT NULL,
  `dataZwrotu` date NOT NULL,
  `status` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id`, `id_ksiazki`, `id_reader`, `dataWypozyczenia`, `dataZwrotu`, `status`) VALUES
(73, 11, 1, '2023-06-25', '2023-07-25', 'zamówiona'),
(74, 1, 1, '2023-06-06', '2023-07-31', 'wypożyczona'),
(81, 5, 3, '2023-06-25', '2023-07-25', 'zamówiona'),
(90, 2, 1, '2023-06-26', '2023-07-26', 'zamówiona');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `czytelnicy`
--
ALTER TABLE `czytelnicy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wypozyczenia` (`id_wypozyczenia`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reader` (`id_reader`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ksiazki` (`id_ksiazki`),
  ADD KEY `fk_wypozyczenia_czytelnicy` (`id_reader`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ksiazki`
--
ALTER TABLE `ksiazki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `czytelnicy`
--
ALTER TABLE `czytelnicy`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD CONSTRAINT `id_wypozyczenia` FOREIGN KEY (`id_wypozyczenia`) REFERENCES `wypozyczenia` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `id_reader` FOREIGN KEY (`id_reader`) REFERENCES `czytelnicy` (`id`);

--
-- Constraints for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `fk_wypozyczenia_czytelnicy` FOREIGN KEY (`id_reader`) REFERENCES `czytelnicy` (`id`),
  ADD CONSTRAINT `id_ksiazki` FOREIGN KEY (`id_ksiazki`) REFERENCES `ksiazki` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
