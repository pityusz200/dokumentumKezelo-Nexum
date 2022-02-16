-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3308
-- Létrehozás ideje: 2022. Feb 13. 22:44
-- Kiszolgáló verziója: 8.0.18
-- PHP verzió: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `dokumentumkezelo-nexum`
--
CREATE DATABASE IF NOT EXISTS `dokumentumkezelo-nexum` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `dokumentumkezelo-nexum`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `alkategoria_table`
--

DROP TABLE IF EXISTS `alkategoria_table`;
CREATE TABLE IF NOT EXISTS `alkategoria_table` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `alkfajlkapocs_table`
--

DROP TABLE IF EXISTS `alkfajlkapocs_table`;
CREATE TABLE IF NOT EXISTS `alkfajlkapocs_table` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `AlK_id` int(11) NOT NULL,
  `Fajl_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fajlok_table`
--

DROP TABLE IF EXISTS `fajlok_table`;
CREATE TABLE IF NOT EXISTS `fajlok_table` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eredeti_fajlnev` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verzioszam` int(11) NOT NULL,
  `feltoltes_idopontja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feltolto_felhasznalo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fo-alkategoriakapocs_table`
--

DROP TABLE IF EXISTS `fo-alkategoriakapocs_table`;
CREATE TABLE IF NOT EXISTS `fo-alkategoriakapocs_table` (
  `Fok_id` int(11) NOT NULL,
  `AlK_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fokategoriak_table`
--

DROP TABLE IF EXISTS `fokategoriak_table`;
CREATE TABLE IF NOT EXISTS `fokategoriak_table` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2022_02_07_233053_create_fokategoriak_table', 1),
(4, '2022_02_08_003728_create_alkategoriak_table', 1),
(5, '2022_02_08_004138_create_fo-alkategoriaKapocs_table', 1),
(6, '2022_02_08_212817_create_fajlok_table', 1),
(7, '2022_02_11_154248_create_alKfajlKapocs_table', 1),
(8, '2022_02_13_003745_create_newRow', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jogosultsagFelT` int(11) NOT NULL DEFAULT '0',
  `jogosultsagLetT` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `jogosultsagFelT`, `jogosultsagLetT`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@test.hu', '$2y$10$dCD6u8n0xslhIDZVcLTZKOHBAW.wIwfjU1MRkL1dZ/1sdHaGu1Pce', 1, 1, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
