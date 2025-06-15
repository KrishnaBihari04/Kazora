-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 15 jun 2025 om 23:30
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
(1, 'Dames horloges'),
(2, 'Heren horloges');

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
(1, 'Kazora Milano Nero', '599.99', 'Diepzwart meesterwerk met Italiaans vakmanschap', 'product-img/milano_nero.jpeg', 2),
(2, 'Kazora Firenze Oro', '749.99', 'Goudkleurig statement horloge geïnspireerd op Firenze', 'product-img/firenze_oro.jpeg', 2),
(3, 'Kazora Roma Classico', '689.99', 'Tijdloze klasse met Romeins design', 'product-img/roma_classico.jpeg', 2),
(4, 'Kazora Venezia Notte', '799.99', 'Middernachtblauw ontwerp, elegant als Venetië bij nacht', 'product-img/venezia_notte.jpeg', 2),
(5, 'Kazora Napoli Solare', '729.99', 'Zonnig design met een luxe goud-accent', 'product-img/napoli_solare.jpeg', 2),
(6, 'Kazora Torino Acciaio', '669.99', 'Stalen kracht met subtiele Italiaanse finesse', 'product-img/torino_acciaio.jpeg', 2),
(7, 'Kazora Palermo Eleganza', '799.99', 'Elegant ontwerp met parelmoeren wijzerplaat', 'product-img/palermo_eleganza.jpeg', 2),
(8, 'Kazora Como Luna', '719.99', 'Maankleurige wijzerplaat met zilveren afwerking', 'product-img/como_luna.jpeg', 2),
(9, 'Kazora Verona Tempo', '689.99', 'Verfijnde chronograaf geïnspireerd op romantisch Verona', 'product-img/verona_tempo.jpeg', 2),
(10, 'Kazora Modena Scuro', '759.99', 'Donkere luxe met sportieve details', 'product-img/modena_scuro.jpeg', 2),
(11, 'Kazora Amalfi Azure', '709.99', 'Zee-blauwe wijzerplaat met roségouden accenten', 'product-img/amalfi_azure.jpeg', 2),
(12, 'Kazora Siena Notturna', '799.99', 'Diep donkerblauw met nachtluxe uitstraling', 'product-img/siena_notturna.jpeg', 2),
(13, 'Kazora Milano Rosa', '649.99', 'Zachtroze elegantie met roségouden details', 'product-img/milano_rosa.jpeg', 1),
(14, 'Kazora Firenze Perla', '729.99', 'Parelmoer wijzerplaat met klassieke finesse', 'product-img/firenze_perla.jpeg', 1),
(15, 'Kazora Roma Aurelia', '689.99', 'Goud en ivoor in een tijdloos damesdesign', 'product-img/roma_aurelia.jpeg', 1),
(16, 'Kazora Venezia Sera', '779.99', 'Avondblauw met subtiele diamantelementen', 'product-img/venezia_sera.jpeg', 1),
(17, 'Kazora Napoli Alba', '699.99', 'Zonnestraal-ontwerp met lichte champagnekleur', 'product-img/napoli_alba.jpeg', 1),
(18, 'Kazora Torino Luna', '669.99', 'Zilveren maanlicht op een smalle leren band', 'product-img/torino_luna.jpeg', 1),
(19, 'Kazora Palermo Rosa', '759.99', 'Zachtroze luxe met Italiaanse charme', 'product-img/palermo_rosa.jpeg', 1),
(20, 'Kazora Como Eleganza', '719.99', 'Minimalistisch damesdesign met zilveren accenten', 'product-img/como_eleganza.jpeg', 1),
(21, 'Kazora Verona Bellezza', '689.99', 'Romantiek in een ronde parelmoer kast', 'product-img/verona_bellezza.jpeg', 1),
(22, 'Kazora Modena Bianca', '739.99', 'Witgouden kast met ivoorkleurige wijzerplaat', 'product-img/modena_bianca.jpeg', 1),
(23, 'Kazora Amalfi Sole', '709.99', 'Zonnig dameshorloge met gouden rand', 'product-img/amalfi_sole.jpeg', 1),
(24, 'Kazora Siena Aurora', '799.99', 'Pastelroze omhuld in nachtblauwe details', 'product-img/siena_aurora.jpeg', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
