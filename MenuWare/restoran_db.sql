-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 05 Haz 2023, 14:32:53
-- Sunucu sürümü: 10.3.32-MariaDB
-- PHP Sürümü: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `restoran_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_kadi` text NOT NULL,
  `admin_parola` text NOT NULL,
  `admin_tarih` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_kadi`, `admin_parola`, `admin_tarih`) VALUES
(1, 'admin', '123', '2023-03-06 08:51:47'),
(3, 'test', '123', '2023-05-31 20:02:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_title` text NOT NULL,
  `ayar_logo` text NOT NULL,
  `ayar_aciklama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`ayar_id`, `ayar_title`, `ayar_logo`, `ayar_aciklama`) VALUES
(1, 'MenuWare', 'img/2347428722unnamed.png', 'Restoranını Bul');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `masalar`
--

CREATE TABLE `masalar` (
  `masa_id` int(11) NOT NULL,
  `masa_rest_id` int(11) NOT NULL,
  `masa_no` int(11) NOT NULL,
  `masa_kisi` varchar(2) NOT NULL,
  `masa_durum` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `masalar`
--

INSERT INTO `masalar` (`masa_id`, `masa_rest_id`, `masa_no`, `masa_kisi`, `masa_durum`) VALUES
(1, 1, 1, '8', 1),
(4, 1, 3, '8', 0),
(5, 1, 4, '6', 0),
(6, 1, 5, '8', 0),
(8, 1, 6, '6', 0),
(9, 1, 2, '6', 1),
(10, 1, 7, '4', 0),
(11, 3, 7, '4', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menuler`
--

CREATE TABLE `menuler` (
  `menu_id` int(11) NOT NULL,
  `menu_rest_id` int(11) NOT NULL,
  `menu_adi` text NOT NULL,
  `menu_fiyat` text NOT NULL,
  `menu_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `menuler`
--

INSERT INTO `menuler` (`menu_id`, `menu_rest_id`, `menu_adi`, `menu_fiyat`, `menu_img`) VALUES
(1, 1, 'Çorba', '55', 'images/04-06-2023gut.jpg'),
(2, 3, 'Çorba', '55', ''),
(3, 1, 'Köfte', '100', 'images/04-06-2023gpu.webp'),
(5, 1, 'Hamburger', '110', 'images/05-06-2023hamburger.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restoran`
--

CREATE TABLE `restoran` (
  `rest_id` int(11) NOT NULL,
  `rest_adi` text NOT NULL,
  `rest_logo` text NOT NULL,
  `rest_bg` text NOT NULL,
  `rest_tel` text NOT NULL,
  `rest_adres` text NOT NULL,
  `rest_aciklama` text NOT NULL,
  `rest_iban` text NOT NULL,
  `rest_odeme` text NOT NULL,
  `rest_tarih` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `restoran`
--

INSERT INTO `restoran` (`rest_id`, `rest_adi`, `rest_logo`, `rest_bg`, `rest_tel`, `rest_adres`, `rest_aciklama`, `rest_iban`, `rest_odeme`, `rest_tarih`) VALUES
(1, 'Çınar Restoran', 'images/05-06-2023vintage-restaurant-logo-template-circle-600w-1258520974.jpg', 'images/03-06-2023resttt.webp', '907872', 'Çınar Restoran', '<p>restoran açıklaması</p>', 'TR 5161 51561651 515 51', 'Ödemesi yapılmayan restoranın rezervasyonu kabul edilmez!', '2023-05-30 16:35:24'),
(3, 'Ramiz Döner', 'images/03-06-2023md.png', 'images/03-06-2023resttt.webp', '190957', '1R6haRztey', 'Ramiz Döner', '', '', '2023-05-30 19:34:47'),
(4, 'Sushi Bar', 'images//04-06-2023sushi-logo-fish-food-japan-260nw-1176867943 (1).jpg', 'images//04-06-202307_77.jpg', '1231414', 'asldkjakd', 'asffaf', '', '', '2023-06-04 19:44:08'),
(5, 'Starbucks', 'images//05-06-2023starbucks.png', 'images//05-06-2023starbucks arkaplan.jpeg', '524528568', 'ÜNİVERSİTELER MAHALLESİ DUMLUPINAR BULVARI NO:137 GALYUM BLOK ZEMİN KAT ODTÜ 06531 ÇANKAYA - ANKARA', '', '', '', '2023-06-05 13:02:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rezerveler`
--

CREATE TABLE `rezerveler` (
  `rezerve_id` int(11) NOT NULL,
  `rezerve_uye_id` int(11) NOT NULL,
  `rezerve_rest_id` int(11) NOT NULL,
  `rezerve_masa_id` int(11) NOT NULL,
  `rezerve_siparis_durum` int(1) NOT NULL DEFAULT 0,
  `rezerve_tarih` datetime NOT NULL,
  `rezerve_siparis` text DEFAULT NULL,
  `rezerve_durum` int(1) NOT NULL DEFAULT 0,
  `rezerve_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `rezerveler`
--

INSERT INTO `rezerveler` (`rezerve_id`, `rezerve_uye_id`, `rezerve_rest_id`, `rezerve_masa_id`, `rezerve_siparis_durum`, `rezerve_tarih`, `rezerve_siparis`, `rezerve_durum`, `rezerve_date`) VALUES
(1, 1, 1, 1, 1, '2023-05-30 20:00:00', '', 1, '2023-05-30 21:57:26'),
(3, 1, 1, 1, 1, '2023-05-30 20:00:00', '', 1, '2023-05-30 21:57:26'),
(4, 1, 1, 9, 0, '2023-05-30 20:00:00', '3 adet Köfte -> 300₺ \r\n', 1, '2023-06-03 21:11:35'),
(6, 1, 3, 11, 0, '2023-06-13 19:00:00', '1 adet Çorba -> 55₺ \r\n', 0, '2023-06-03 21:38:57'),
(8, 1, 1, 9, 0, '2023-06-02 19:00:00', '1 adet Çorba -> 55₺ \r\n', 1, '2023-06-04 19:51:47'),
(10, 6, 1, 4, 0, '2023-06-05 12:00:00', '4 adet Çorba -> 220₺ \r\n2 adet Köfte -> 200₺ \r\n', 1, '2023-06-05 12:31:57'),
(11, 6, 1, 4, 0, '2023-06-05 11:00:00', '1 adet Hamburger -> 110₺ \r\n', 1, '2023-06-05 12:55:29'),
(12, 1, 1, 1, 0, '2023-06-06 16:00:00', '1 adet Hamburger -> 110₺ \r\n', 1, '2023-06-05 13:20:46'),
(14, 5, 1, 9, 0, '2023-06-06 16:00:00', '1 adet Hamburger -> 110₺ \r\n1 adet Köfte -> 100₺ \r\n', 1, '2023-06-05 14:09:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `siparis_id` int(11) NOT NULL,
  `siparis_uye_id` int(11) NOT NULL,
  `siparis_icerik` text NOT NULL,
  `siparis_tutar` text NOT NULL,
  `siparis_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `siparis_durum` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`siparis_id`, `siparis_uye_id`, `siparis_icerik`, `siparis_tutar`, `siparis_tarih`, `siparis_durum`) VALUES
(1, 1, 'tost 2 adet', '20', '2023-05-30 21:57:07', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye`
--

CREATE TABLE `uye` (
  `uye_id` int(11) NOT NULL,
  `uye_email` text NOT NULL,
  `uye_adi` text NOT NULL,
  `uye_parola` text NOT NULL,
  `uye_tel` text NOT NULL,
  `uye_tarih` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `uye`
--

INSERT INTO `uye` (`uye_id`, `uye_email`, `uye_adi`, `uye_parola`, `uye_tel`, `uye_tarih`) VALUES
(1, 'rslprlt@gmail.com', 'RES', '123', '247382', '2023-05-30 19:47:44'),
(2, 'vd6k0@livb.com', 'SXhRQPNxvr', '0WgOiz8XvR', '190782', '2023-05-30 19:49:58'),
(3, 'avd6k0@livb.com', 'Qpw6nFgM22', 'SjZ9QbOzfR', '093113', '2023-05-30 20:28:41'),
(4, 'rslprlt1@gmail.com', 'sdfsdf', '123', '61515615', '2023-06-02 23:12:24'),
(5, 'deneme@deneme.com', 'deneme', '123', '123121', '2023-06-04 18:52:52'),
(6, 'demo@demo.com', 'demo', '123', '0877687676', '2023-06-04 18:53:12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yetkili`
--

CREATE TABLE `yetkili` (
  `yetkili_id` int(11) NOT NULL,
  `yetkili_rest_id` int(11) NOT NULL,
  `yetkili_adi` text NOT NULL,
  `yetkili_parola` text NOT NULL,
  `yetkili_tip` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `yetkili`
--

INSERT INTO `yetkili` (`yetkili_id`, `yetkili_rest_id`, `yetkili_adi`, `yetkili_parola`, `yetkili_tip`) VALUES
(3, 1, 'rest', '123', 1),
(4, 1, 'sef', '123', 0),
(10, 4, 'sushiyönetici', '123', 1),
(11, 3, 'ramiz', '123', 0),
(12, 3, 'ramiz2', '123', 1),
(13, 5, 'ekin', '123', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `masalar`
--
ALTER TABLE `masalar`
  ADD PRIMARY KEY (`masa_id`);

--
-- Tablo için indeksler `menuler`
--
ALTER TABLE `menuler`
  ADD PRIMARY KEY (`menu_id`);

--
-- Tablo için indeksler `restoran`
--
ALTER TABLE `restoran`
  ADD PRIMARY KEY (`rest_id`);

--
-- Tablo için indeksler `rezerveler`
--
ALTER TABLE `rezerveler`
  ADD PRIMARY KEY (`rezerve_id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`siparis_id`);

--
-- Tablo için indeksler `uye`
--
ALTER TABLE `uye`
  ADD PRIMARY KEY (`uye_id`);

--
-- Tablo için indeksler `yetkili`
--
ALTER TABLE `yetkili`
  ADD PRIMARY KEY (`yetkili_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `ayar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `masalar`
--
ALTER TABLE `masalar`
  MODIFY `masa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `menuler`
--
ALTER TABLE `menuler`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `restoran`
--
ALTER TABLE `restoran`
  MODIFY `rest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `rezerveler`
--
ALTER TABLE `rezerveler`
  MODIFY `rezerve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `siparis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `uye`
--
ALTER TABLE `uye`
  MODIFY `uye_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `yetkili`
--
ALTER TABLE `yetkili`
  MODIFY `yetkili_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
