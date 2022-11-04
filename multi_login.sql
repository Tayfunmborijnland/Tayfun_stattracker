-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 nov 2022 om 18:07
-- Serverversie: 10.4.25-MariaDB
-- PHP-versie: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_login`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userdata`
--

CREATE TABLE `userdata` (
  `Teams` varchar(100) NOT NULL,
  `Doelpunten` int(11) NOT NULL,
  `Assisten` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `userdata`
--

INSERT INTO `userdata` (`Teams`, `Doelpunten`, `Assisten`) VALUES
('Napoli', 20, 18),
('Real Madrid', 18, 16),
('Liverpool', 16, 14),
('Bayern Munich', 14, 12),
('Tottenham Hotspur', 12, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(9, 'Tayfun-gebruiker', 'Tayfun-gebruiker@Mborijnland.nl', 'user', '6f2781076dd4447084958fa54e4fc1c8'),
(10, 'Tayfun-admin', 'Tayfun-admin@mborijnland.nl', 'admin', '0ce78c2d6eaaf38c6ee19210ce466655');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`Doelpunten`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `userdata`
--
ALTER TABLE `userdata`
  MODIFY `Doelpunten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
