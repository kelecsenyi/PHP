-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Ápr 14. 14:23
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webshop`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(46, 'u', '$2y$10$GXHOOknvTg93NxZOycDw1u/sOmYv4NgLji9fHfziytfN8PAtLSIla'),
(47, 'i', '$2y$10$necD0FGlxYukO9PxULxOeuakkteBVHv4ZzysfCw/Maj6wOW1Pi4Ri');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` int(11) NOT NULL,
  `product_code` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `currentuser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postcode` int(10) NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `bname` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `bpostcode` int(10) NOT NULL,
  `bcity` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `baddress` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `taxnumber` varchar(20) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `pmode` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `odate` datetime NOT NULL,
  `products` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `qty` varchar(11) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `amountpaid` int(11) NOT NULL,
  `currentuser` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `postcode`, `city`, `address`, `bname`, `bpostcode`, `bcity`, `baddress`, `taxnumber`, `pmode`, `odate`, `products`, `qty`, `amountpaid`, `currentuser`, `userid`) VALUES
(17, 'Kelecsényi Balázs Kelecsény', 'kelecsenyibalazs99@gmail.com', '06309677176', 1174, 'Budapest', 'Dózsa György utca 15.', 'bali', 1174, 'Budapest', 'dózsa györgy utca 15.', 'Nem vagyok jogi szem', 'Utánvét', '2021-04-14 12:52:32', 'FFP2 maszk, Vegyvédelmi maszk', '1, 2', 27000, NULL, 34),
(21, 'Kelecsényi Balázs Kelecsény', 'kelecsenyibalazs99@gmail.com', '06309677176', 1174, 'Budapest', 'Dózsa György utca 15.', 'bali', 1174, 'Budapest', 'dózsa györgy utca 15.', 'Nem vagyok jogi szem', 'Utánvét', '2021-04-14 02:11:15', '3M 6800 teljesálarc', '2', 20000, NULL, 34);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `ID` int(20) NOT NULL,
  `pbrand` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `pname` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `pdetails` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `pprice` int(10) NOT NULL,
  `pimage` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `pquantity` int(6) NOT NULL,
  `pcode` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`ID`, `pbrand`, `pname`, `pdetails`, `pprice`, `pimage`, `pquantity`, `pcode`) VALUES
(17, 'ffp2', 'FFP2 maszk', 'Arcformához illeszkedő, összehajtható, higiénikus maszk. Könnyen az arcra illeszthető, kényelmes', 3000, 'Assets/ffp.jpg', 20, '001'),
(18, 'teljesálarc', 'Vegyvédelmi maszk', 'Arcformához illeszkedő. Könnyen felhejezhető', 12000, 'Assets/gasmask.jpg', 20, '002'),
(19, 'teljesálarc', 'PANAREA teljesálarc', 'Könnyű, tartós, archoz kiválóan illeszkedő. Egy kilégzőszelep', 20000, 'Assets/teljes2.jpg', 20, '003'),
(20, 'szövetmaszk', 'Egyedi maszk', 'Arcformához illeszkedő, összehajtható - Törésbiztos és alaktartó, higiénikus maszk', 2000, 'Assets/style.jpg', 20, '004'),
(21, 'orvosi maszk', 'Orvosi maszk', 'CE minősítéssel rendelkezik -háromrétegű szájmaszk. Eldobható maszk', 2000, 'Assets/medical.jpg', 20, '005'),
(22, 'teljesálarc', '3M 6800 teljesálarc', 'Komfortos, lágy és jól illeszkedő. Ikerszűrős kialakítás', 10000, 'Assets/teljes.jpg', 20, '006');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `mobil` varchar(15) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postcode` int(4) NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `billname` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `billpostcode` int(4) NOT NULL,
  `billcity` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `billaddress` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `taxcode` varchar(25) COLLATE utf8mb4_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `mobil`, `password`, `postcode`, `city`, `address`, `billname`, `billpostcode`, `billcity`, `billaddress`, `taxcode`) VALUES
(34, 'Kelecsényi Balázs ', 'kelecsenyibalazs99@gmail.com', '06309677176', '$2y$10$tdA0H8t8ZtPDIJEZjnl/jupJIkMofIhIHqkLMFEkxLq3y4iATJBfC', 1174, 'Budapest', 'Dózsa György utca 15.', 'Kelecsényi Balázs ', 1174, 'Budapest', 'dózsa györgy utca 15.', 'Nem vagyok jogi személy');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT a táblához `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
