-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 18 jun 2025 om 22:21
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kazora`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Lady\'s choice '),
(2, 'Men\'s choice');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `productname`, `price`, `description`, `img`, `category_id`) VALUES
(1, 'Kazora Milano Nero', '2369.96', 'Deep black masterpiece with Italian craftsmanship', 'product-img/milano_nero.jpeg', 2),
(2, 'Kazora Firenze Oro', '2962.46', 'Gold-tone statement watch inspired by Firenze', 'product-img/firenze_oro.jpeg', 2),
(3, 'Kazora Roma Classico', '2727.46', 'Timeless class with Roman design', 'product-img/roma_classico.jpeg', 2),
(4, 'Kazora Venezia Notte', '3160.96', 'Midnight blue design, as elegant as Venice at night', 'product-img/venezia_notte.jpeg', 2),
(5, 'Kazora Napoli Solare', '2882.46', 'Sunny design with luxury gold accents', 'product-img/napoli_solare.jpeg', 2),
(6, 'Kazora Torino Acciaio', '2640.46', 'Steel strength with subtle Italian finesse', 'product-img/torino_acciaio.jpeg', 2),
(7, 'Kazora Palermo Eleganza', '3160.96', 'Elegant design with a mother-of-pearl dial', 'product-img/palermo_eleganza.jpeg', 2),
(8, 'Kazora Como Luna', '2841.46', 'Moon-colored dial with silver finish', 'product-img/como_luna.jpeg', 2),
(9, 'Kazora Verona Tempo', '2727.46', 'Refined chronograph inspired by romantic Verona', 'product-img/verona_tempo.jpeg', 2),
(10, 'Kazora Modena Scuro', '2991.46', 'Dark luxury with sporty details', 'product-img/modena_scuro.jpeg', 2),
(11, 'Kazora Amalfi Azure', '2804.46', 'Sea-blue dial with rose gold accents', 'product-img/amalfi_azure.jpeg', 2),
(12, 'Kazora Siena Notturna', '3160.96', 'Deep navy with a night-luxury look', 'product-img/siena_notturna.jpeg', 2),
(13, 'Kazora Milano Rosa', '2567.46', 'Soft pink elegance with rose gold details', 'product-img/milano_rosa.jpeg', 1),
(14, 'Kazora Firenze Perla', '2879.46', 'Mother-of-pearl dial with classic finesse', 'product-img/firenze_perla.jpeg', 1),
(15, 'Kazora Roma Aurelia', '2727.46', 'Gold and ivory in a timeless women’s design', 'product-img/roma_aurelia.jpeg', 1),
(16, 'Kazora Venezia Sera', '3075.46', 'Evening blue with subtle diamond elements', 'product-img/venezia_sera.jpeg', 1),
(17, 'Kazora Napoli Alba', '2760.46', 'Sunray design in light champagne tone', 'product-img/napoli_alba.jpeg', 1),
(18, 'Kazora Torino Luna', '2640.46', 'Silver moonlight on a slim leather strap', 'product-img/torino_luna.jpeg', 1),
(19, 'Kazora Palermo Rosa', '2991.46', 'Soft pink luxury with Italian charm', 'product-img/palermo_rosa.jpeg', 1),
(20, 'Kazora Como Eleganza', '2841.46', 'Minimalist women’s design with silver accents', 'product-img/como_eleganza.jpeg', 1),
(21, 'Kazora Verona Bellezza', '2727.46', 'Romance in a round mother-of-pearl case', 'product-img/verona_bellezza.jpeg', 1),
(22, 'Kazora Modena Bianca', '2910.06', 'White gold case with ivory dial', 'product-img/modena_bianca.jpeg', 1),
(23, 'Kazora Amalfi Sole', '2804.46', 'Sunny women’s watch with golden bezel', 'product-img/amalfi_sole.jpeg', 1),
(24, 'Kazora Siena Aurora', '3160.96', 'Pastel pink wrapped in midnight blue details', 'product-img/siena_aurora.jpeg', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `name`, `rating`, `review`) VALUES
(3, 1, 'Admin', '5', 'test'),
(4, 1, 'Admin', '5', 'test'),
(5, 16, 'Admin', '5', 'test'),
(6, 1, 'Admin', '3', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `role`) VALUES
(2, 'Krishna', 'test@test.nl', '$2y$10$4LFTIW1aYxJD8Mez80q/Qey8BUU/Kks7zQHB5ehASJukFTVe.C6Va', '2025-06-16 17:49:54', 'user'),
(6, 'Admin', 'admin@kazora.nl', '$2y$10$8LuobDIrpmNNBtko0d4MBeao2oDCj8Tav/IphR.4UmPS9H3mOnJL.', '2025-06-16 19:14:31', 'admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category` (`category_id`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
