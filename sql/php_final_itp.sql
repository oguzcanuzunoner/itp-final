CREATE DATABASE `php_final_itp`;
USE `php_final_itp`;
CREATE TABLE `sanatci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sanatci` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
CREATE TABLE `sarki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sanatciId` int(11) COLLATE utf8_turkish_ci NOT NULL,
  `sarki` varchar(500) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eposta` varchar(250) NOT NULL,
  `sifre` varchar(10) NOT NULL,
  `ad` varchar(250) NOT NULL,
  `soyad` varchar(250) NOT NULL,
  `fotograf` varchar(250) NOT NULL,
  `aktif_mi` int(11) NOT NULL DEFAULT 0,
  `aktivasyon` varchar(1000) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
