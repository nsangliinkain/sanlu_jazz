-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 02, 2025 alle 13:33
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanlu_jazz`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `artista_id` int(11) DEFAULT NULL,
  `titolo` varchar(100) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `data` date DEFAULT NULL,
  `orario` time DEFAULT NULL,
  `luogo` varchar(100) DEFAULT NULL,
  `prezzo` decimal(6,2) DEFAULT NULL,
  `posti_disponibili` int(11) DEFAULT NULL,
  `stato` varchar(50) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`id`, `artista_id`, `titolo`, `descrizione`, `data`, `orario`, `luogo`, `prezzo`, `posti_disponibili`, `stato`, `venue_id`) VALUES
(57, 9, 'Jazz Night Session', 'Una serata di puro jazz con artisti internazionali.', '2025-06-10', '21:00:00', 'Blue Note Milano', 25.00, 100, 'attivo', 3),
(58, 5, 'Soulful Vibes', 'Esibizione soul dal vivo con atmosfera intima.', '2025-06-15', '20:30:00', 'Teatro Soul Roma', 30.00, 80, 'attivo', 4),
(59, 4, 'Pop Mania Festival', 'Una giornata all\'insegna del pop italiano.', '2025-07-01', '18:00:00', 'Arena di Verona', 35.00, 500, 'attivo', 5),
(60, 5, 'Pop Summer Nights', 'Concerto pop estivo con DJ e artisti dal vivo.', '2025-07-05', '22:00:00', 'Arena di Verona', 28.00, 300, 'attivo', 5),
(61, 4, 'R&B Lovers Live', 'Spettacolo R&B con talenti emergenti.', '2025-06-20', '21:30:00', 'Black Hall Bologna', 22.00, 120, 'attivo', 6),
(62, 9, 'Soul Explosion', 'Energia soul sul palco con band storiche.', '2025-06-25', '20:00:00', 'Palasoul Milano', 32.00, 200, 'attivo', 7),
(63, 9, 'Anita 2.0', '237', '2025-09-02', '21:00:00', 'La Maison du Mbolé', 45.00, 200, 'attivo', 8),
(64, 5, 'Marco Mengoni', 'Europe Tour \'25', '2025-10-24', '21:00:00', 'Unipol Arena', 78.00, 200, 'attivo', 11),
(65, 2, 'Pop Maniaa', 'Miglior serata pop a cui assistere', '2025-10-27', '22:00:00', 'Black Hall Bologna', 20.00, 105, 'attivo', 6),
(69, 10, 'Fally Ipupa', 'Dal Congo KInshasa all\'Italia', '2025-07-31', '16:00:00', 'La Maison du Mbolé', 55.00, 200, 'attivo', 8),
(70, 10, 'Afro Festival', 'Un sacco di artisti africani pronti a far conoscere al mondo nuove vibes', '2025-08-15', '20:00:00', 'Carroponte', 45.00, 300, 'attivo', 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `event_genre`
--

CREATE TABLE `event_genre` (
  `event_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `event_genre`
--

INSERT INTO `event_genre` (`event_id`, `genre_id`) VALUES
(57, 1),
(58, 4),
(59, 2),
(60, 2),
(61, 3),
(62, 4),
(63, 5),
(64, 2),
(65, 2),
(69, 5),
(70, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `genres`
--

INSERT INTO `genres` (`id`, `nome`) VALUES
(1, 'jazz'),
(2, 'pop'),
(3, 'r&b'),
(4, 'soul'),
(5, 'afro');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_05_07_132638_create_sessions_table', 1),
(2, '2025_05_17_231215_add_numero_posto_to_tickets_table', 2),
(3, '2025_05_19_084228_change_numero_posto_to_integer_in_tickets_table', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HcL3FgSjxocnx5GAWFYWkTKB7dwUx7ARRIDNORNe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRm9NSUpWUHlaUEJIaVdNTEtTYWNuRGU1NnlIeFl4RGo4eGZUNU9jRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746634834),
('XoBR0VbABF2wWChLdRa8OTAULEvuCt116UaB08Fr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXFITjllY3d4aW00MVpkeXJBdWIzcjlMaENIb3VhYk5waFFVMXZ6eSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746624697);

-- --------------------------------------------------------

--
-- Struttura della tabella `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `codice` varchar(100) DEFAULT NULL,
  `data_acquisto` datetime DEFAULT current_timestamp(),
  `prezzo` decimal(6,2) DEFAULT NULL,
  `numero_posto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `event_id`, `codice`, `data_acquisto`, `prezzo`, `numero_posto`) VALUES
(3, 1, 62, '88D90B6350', '2025-05-17 15:29:36', 32.00, 1),
(4, 1, 60, '5482AD4B1F', '2025-05-17 15:47:03', 28.00, 2),
(8, 8, 59, '6CE4434249', '2025-05-19 15:54:15', 35.00, 1),
(10, 8, 60, '3422C04ABE', '2025-05-19 15:54:25', 28.00, 2),
(11, 8, 58, '0702922E3B', '2025-05-20 14:53:09', 30.00, 1),
(12, 11, 70, '3576B3FC5C', '2025-06-02 10:11:22', 45.00, 1),
(13, 11, 63, '6F19AAB20F', '2025-06-02 10:11:26', 45.00, 1),
(15, 11, 61, '58800B4F35', '2025-06-02 10:14:03', 22.00, 1),
(17, 11, 57, 'FE3142BB6C', '2025-06-02 10:27:40', 25.00, 1),
(18, 11, 69, 'D3DEB0BCB2', '2025-06-02 10:29:16', 55.00, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ruolo` enum('spettatore','artista','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `password`, `ruolo`) VALUES
(1, 'John Doe', 'john@example.com', 'password123', 'spettatore'),
(2, 'Jane Smith', 'jane@example.com', 'password456', 'artista'),
(3, 'Alice Johnson', 'alice@sanlujazz.com', 'password789', 'admin'),
(4, 'Gianni', 'gianni@example.com', 'abcd1234', 'artista'),
(5, 'Luca', 'luca@example.com', 'bcde2345', 'artista'),
(6, 'Alessandro', 'alessandro@sanlujazz.com', 'cdef3456', 'admin'),
(8, 'sanlu inkein', 'sanlu@gmail.com', 'sanlu123', 'spettatore'),
(9, 'yazer', 'yazergram@yazer.com', 'yazer12345', 'artista'),
(10, 'bebba', 'bebba@bebba.com', 'bebba12345', 'artista'),
(11, 'dylan', 'dylan@dylan.it', 'dylan12345', 'spettatore');

-- --------------------------------------------------------

--
-- Struttura della tabella `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `nome_locale` varchar(100) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `capienza` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `venues`
--

INSERT INTO `venues` (`id`, `nome_locale`, `indirizzo`, `capienza`) VALUES
(1, 'Loc-Ale', 'Via San Leornardo 120', 500),
(3, 'Blue Note Milano', 'Milano, Via Borsieri 37', 219),
(4, 'Teatro Soul Roma', 'Roma, Via Soul 15', 436),
(5, 'Arena di Verona', 'Verona, Piazza Bra 1', 222),
(6, 'Black Hall Bologna', 'Bologna, Via Lame 101', 105),
(7, 'Palasoul Milano', 'Milano, Via Palasoul 56', 161),
(8, 'La Maison du Mbolé', 'Via Aosta 3', 250),
(11, 'Unipol Arena', 'Via Gino Cervi, 40033 CASALECCHIO DI RENO BO', 200),
(12, 'Carroponte', 'Via Luigi Granelli, 1, 20099 Sesto San Giovanni MI', 300);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artista_id` (`artista_id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indici per le tabelle `event_genre`
--
ALTER TABLE `event_genre`
  ADD PRIMARY KEY (`event_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indici per le tabelle `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indici per le tabelle `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codice` (`codice`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT per la tabella `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`artista_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`);

--
-- Limiti per la tabella `event_genre`
--
ALTER TABLE `event_genre`
  ADD CONSTRAINT `event_genre_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
