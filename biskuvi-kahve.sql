-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                8.0.17 - MySQL Community Server - GPL
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- tablo yapısı dökülüyor biskuvi-kahve.anasayfa
CREATE TABLE IF NOT EXISTS `anasayfa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ustBaslik` char(50) DEFAULT NULL,
  `link` char(50) DEFAULT NULL,
  `linkMetin` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- biskuvi-kahve.anasayfa: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `anasayfa` (`id`, `ustBaslik`, `link`, `linkMetin`) VALUES
	(1, 'Doya Doya', 'index.php', 'Daha Fazla');

-- tablo yapısı dökülüyor biskuvi-kahve.hakkimizda
CREATE TABLE IF NOT EXISTS `hakkimizda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ustBaslik` char(50) NOT NULL DEFAULT '0',
  `solYazi` char(50) NOT NULL DEFAULT '0',
  `sagYazi` char(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- biskuvi-kahve.hakkimizda: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tablo yapısı dökülüyor biskuvi-kahve.iletisim
CREATE TABLE IF NOT EXISTS `iletisim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Adi` char(50) NOT NULL DEFAULT '0',
  `Mail` char(50) NOT NULL DEFAULT '0',
  `Mesaj` char(50) NOT NULL DEFAULT '0',
  `okundu` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- biskuvi-kahve.iletisim: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tablo yapısı dökülüyor biskuvi-kahve.iletisimbaslik
CREATE TABLE IF NOT EXISTS `iletisimbaslik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ustBaslik` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- biskuvi-kahve.iletisimbaslik: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tablo yapısı dökülüyor biskuvi-kahve.kesfet
CREATE TABLE IF NOT EXISTS `kesfet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ustBaslik` char(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- biskuvi-kahve.kesfet: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `kesfet` (`id`, `ustBaslik`) VALUES
	(1, 'Mağaza');

-- tablo yapısı dökülüyor biskuvi-kahve.kesfetfoto
CREATE TABLE IF NOT EXISTS `kesfetfoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sira` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `simge` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kahveisim` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kahvefiyat` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `foto` char(50) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- biskuvi-kahve.kesfetfoto: ~8 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `kesfetfoto` (`id`, `sira`, `simge`, `kahveisim`, `kahvefiyat`, `foto`, `aktif`) VALUES
	(1, '1', 'fa fa-mug-hot', 'Cortado', '85₺', '01.jpg', 1),
	(2, '2', 'fa-solid fa-cookie-bite', 'Damla Çikolatalı Kurabiye', '65₺', '02.jpg', 1),
	(3, '3', 'fa fa-mug-hot', '--', '--', '03.jpg', 1),
	(4, '4', 'fa fa-mug-hot', '--', '--', '04.jpg', 1),
	(5, '5', 'fa fa-mug-hot', '--', '--', '05.jpg', 1),
	(6, '6', 'fa fa-mug-hot', '--', '--', '06.jpg', 1),
	(7, '7', 'fa-solid fa-cookie-bite', '--', '--', '07.jpg', 1),
	(8, '8', 'fa fa-mug-hot', '--', '--', '08.jpg', 1);

-- tablo yapısı dökülüyor biskuvi-kahve.kullanici
CREATE TABLE IF NOT EXISTS `kullanici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kadi` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parola` char(200) NOT NULL,
  `yetki` tinyint(4) NOT NULL DEFAULT '0',
  `email` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- biskuvi-kahve.kullanici: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `kullanici` (`id`, `kadi`, `parola`, `yetki`, `email`, `aktif`) VALUES
	(1, 'biskuvi', '055fc3abae9f651570f8d81a7f686caf', 1, 'biskuvi@gmail.com', 1);

-- tablo yapısı dökülüyor biskuvi-kahve.sayac_ip
CREATE TABLE IF NOT EXISTS `sayac_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarih` date NOT NULL,
  `tiklama` int(11) NOT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- biskuvi-kahve.sayac_ip: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `sayac_ip` (`id`, `tarih`, `tiklama`, `ip`) VALUES
	(15, '2023-08-14', 1, '::1'),
	(16, '2023-08-21', 11, '::1');

-- tablo yapısı dökülüyor biskuvi-kahve.sayac_online
CREATE TABLE IF NOT EXISTS `sayac_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tarih` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- biskuvi-kahve.sayac_online: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `sayac_online` (`id`, `ip`, `tarih`) VALUES
	(64, '::1', 1692661708);

-- tablo yapısı dökülüyor biskuvi-kahve.sayac_toplam
CREATE TABLE IF NOT EXISTS `sayac_toplam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `toplam_tekil` int(11) NOT NULL,
  `toplam_cogul` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- biskuvi-kahve.sayac_toplam: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `sayac_toplam` (`id`, `toplam_tekil`, `toplam_cogul`) VALUES
	(3, 1, 1);

-- tablo yapısı dökülüyor biskuvi-kahve.social
CREATE TABLE IF NOT EXISTS `social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook` char(50) DEFAULT NULL,
  `twitter` char(50) DEFAULT NULL,
  `instagram` char(50) DEFAULT NULL,
  `linkedin` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- biskuvi-kahve.social: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
