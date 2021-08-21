-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 21. Aug 2021 um 16:43
-- Server-Version: 10.4.20-MariaDB
-- PHP-Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `fswd13_cr11_petadoption_markuskamitz`
--
CREATE DATABASE IF NOT EXISTS `fswd13_cr11_petadoption_markuskamitz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd13_cr11_petadoption_markuskamitz`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `size` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `hobbies` varchar(100) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`animal_id`, `name`, `picture`, `location`, `description`, `size`, `age`, `hobbies`, `breed`, `status`) VALUES
(41, 'Rattus', '61209c14f1966.jpg', 'Krems', 'nice little rat', 'small', '2', 'eats everything', 'Rat', 'available'),
(42, 'The Lazy One', '6120e15df3950.jpg', 'Wuppertal ', 'the laziest cat in town', 'big', '14', 'sleeps all day', 'Cat', 'available'),
(45, 'the cute one', '6120b5e2a226b.jpg', 'Scheibs', 'so cute', 'small', '2', 'none', 'hamster', 'available'),
(51, 'Hedgi', '6120e0caaac45.jpg', 'Krems', 'cool little thing', 'small', '2', 'sleeping', 'Hedgehawk', 'adopted'),
(52, 'Carla', '6120e1c44d8b8.jpg', 'Vienna', 'most beautiful in town', 'medium', '9', 'catching mice', 'Maincoon', 'available'),
(53, 'Lorin', '6120e210402b8.jpg', 'Paris', 'little babydog', 'small', '1', 'playing all day', 'Dog', 'available'),
(54, 'Sir Mallory', '6120e26760b07.jpg', 'Vienna', 'the noble one', 'big', '5', 'guarding the area', 'Dog', 'available'),
(55, 'Uhu', '6120e2a8b5c24.jpg', 'Waldviertel', 'cute owl', 'small', '9', 'hunting at night', 'Owl', 'available'),
(56, 'The Wild One', '6120e30a264c7.jpg', 'Baden  ', 'a wild husky dog', 'average', '3', 'running', 'Dog', 'available'),
(57, 'Pinky', '6120e3a2b895b.jpg', 'Vienna', 'playful and squishy', 'small', '2', 'eating', 'Mouse', 'available'),
(58, 'Schnurri', '6120e4638be53.jpg', 'Krems', 'very cosy', 'medium', '13', 'sleeping', 'Cat', 'adopted');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `adoption_ID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `animal_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `pet_adoption`
--

INSERT INTO `pet_adoption` (`adoption_ID`, `date`, `animal_id`, `id`) VALUES
(14, '2021-08-21 14:38:53', 58, 10),
(15, '2021-08-21 14:39:57', 51, 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `status` enum('user','adm') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `picture`, `password`, `status`) VALUES
(10, 'user', 'user', 'user@user.at', '12345677', 'Ottakringerstrasse 44', '611ff07288608.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user'),
(11, 'admin', 'admin', 'admin@admin.at', '6666666777777', 'Ottakringerstrasse 14', 'avatar.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'adm'),
(12, 'Mark', 'Millions', 'mark@user.at', '123456789', 'Ottakringerstrasse 1', '6120e74296828.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indizes für die Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adoption_ID`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `id` (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT für Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adoption_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
