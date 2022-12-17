-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 17 Ara 2022, 22:24:13
-- Sunucu sürümü: 10.4.10-MariaDB
-- PHP Sürümü: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `lupusoft`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adresler`
--

DROP TABLE IF EXISTS `adresler`;
CREATE TABLE IF NOT EXISTS `adresler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sahip` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  `isim` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `sirket` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `sehir` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `semt` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `postakodu` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `adresler`
--

INSERT INTO `adresler` (`id`, `sahip`, `durum`, `isim`, `sirket`, `adres`, `sehir`, `semt`, `postakodu`, `telefon`) VALUES
(1, 1, 1, 'Evim', 'Lupusoft Yazılım ve Donanım Hizmetleri', 'Cumhuriyet mh. Orta sk. No : 9C, Daire : 7', 'TEKİRDAĞ', 'ŞARKÖY', '59150', '535 025 23 54'),
(10, 1, 0, 'İşyerim', 'Şirket Adı', 'Şirket Adresi', 'TEKİRDAĞ', 'ŞARKÖY', '59800', '555 555 55 55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

DROP TABLE IF EXISTS `ayarlar`;
CREATE TABLE IF NOT EXISTS `ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kurulum` int(11) NOT NULL,
  `kadi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `baslik` varchar(180) COLLATE utf8_turkish_ci NOT NULL,
  `sifr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `stokuyari` int(11) NOT NULL,
  `stokuyarideger` int(11) NOT NULL,
  `bitikstok` int(11) NOT NULL,
  `footeryazi` varchar(350) COLLATE utf8_turkish_ci NOT NULL,
  `footericerik` text COLLATE utf8_turkish_ci NOT NULL,
  `footersosyal` int(11) NOT NULL,
  `urunsosyal` int(11) NOT NULL,
  `urunetiket` int(11) NOT NULL,
  `urunyorum` int(11) NOT NULL,
  `titlebosta` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `iletisimadres` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `iletisimiframe` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `iletisimyazi` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `paket` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `uniq_customer_no` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `license_life` int(11) NOT NULL,
  `rapor_gun` int(11) NOT NULL,
  `kuponaktif` int(11) NOT NULL,
  `barkodaktif` int(11) NOT NULL,
  `goruntulenmeaktif` int(11) NOT NULL,
  `vitrintipi` int(11) NOT NULL,
  `vitrinustbaslik` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `vitrinaltbaslik` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `markagoster` int(11) NOT NULL,
  `favicon` varchar(120) COLLATE utf8_turkish_ci NOT NULL,
  `odemeaciklama` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `sipmintutar` int(11) NOT NULL,
  `sozlesmeonayli` int(11) NOT NULL,
  `parabirimi` int(11) NOT NULL,
  `dil` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `taramasikligi` int(11) NOT NULL,
  `siptamamsepetsil` int(11) NOT NULL,
  `uyesayfasiduyuru` text COLLATE utf8_turkish_ci NOT NULL,
  `benzerurunler` int(11) NOT NULL,
  `gelistirici` int(11) NOT NULL,
  `getirilecek_icerik_sayisi` int(11) NOT NULL,
  `slider_aktif` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `logo`, `kurulum`, `kadi`, `baslik`, `sifr`, `tel`, `eposta`, `stokuyari`, `stokuyarideger`, `bitikstok`, `footeryazi`, `footericerik`, `footersosyal`, `urunsosyal`, `urunetiket`, `urunyorum`, `titlebosta`, `iletisimadres`, `iletisimiframe`, `iletisimyazi`, `paket`, `uniq_customer_no`, `start_date`, `license_life`, `rapor_gun`, `kuponaktif`, `barkodaktif`, `goruntulenmeaktif`, `vitrintipi`, `vitrinustbaslik`, `vitrinaltbaslik`, `markagoster`, `favicon`, `odemeaciklama`, `sipmintutar`, `sozlesmeonayli`, `parabirimi`, `dil`, `taramasikligi`, `siptamamsepetsil`, `uyesayfasiduyuru`, `benzerurunler`, `gelistirici`, `getirilecek_icerik_sayisi`, `slider_aktif`) VALUES
(1, 'logo_1.png', 1, 'Lupusoft', 'Lupusoft® Gelişmiş E-Ticaret Sistemleri', '123123', '+90 212 123 45 67', 'lupusyazilim@gmail.com', 1, 13, 10, 'Gelişmiş E-ticaret yazılımları, uygun yazılım paketleri ve ömürboyu destek imkanı sunuyoruz.\r\n<hr><img style=\"margin:0px 10px;width:120px;\" src=\"images/facebookpartner.png\">\r\n<a href=\"https://play.google.com/store/apps/dev?id=7563126433923050253&hl=tr\" target=\"_blank\"><img style=\"margin:0px 10px;width:120px;\" \r\n src=\"images/google-play.png\"></a>', '<!-- Feature -->					<div class=\"col-lg-4 feature_col\">						<div class=\"feature d-flex flex-row align-items-start justify-content-start\">							<div class=\"feature_left\">								<div class=\"feature_icon\"><img src=\"images/icon_1.svg\" alt=\"\"></div>							</div>							<div class=\"feature_right d-flex flex-column align-items-start justify-content-center\">								<div class=\"feature_title\">Güvenli Alışveriş</div>							</div>						</div>					</div>					<!-- Feature -->					<div class=\"col-lg-4 feature_col\">						<div class=\"feature d-flex flex-row align-items-start justify-content-start\">							<div class=\"feature_left\">								<div class=\"feature_icon ml-auto mr-auto\"><img src=\"images/icon_2.svg\" alt=\"\"></div>							</div>							<div class=\"feature_right d-flex flex-column align-items-start justify-content-center\">								<div class=\"feature_title\">Kaliteli Hizmet</div>							</div>						</div>					</div>					<!-- Feature -->					<div class=\"col-lg-4 feature_col\">						<div class=\"feature d-flex flex-row align-items-start justify-content-start\">							<div class=\"feature_left\">								<div class=\"feature_icon\"><img src=\"images/icon_3.svg\" alt=\"\"></div>							</div>							<div class=\"feature_right d-flex flex-column align-items-start justify-content-center\">								<div class=\"feature_title\">Tıkla Gelsin</div>							</div>						</div>					</div>', 1, 1, 1, 1, '#HayatEveSigar', 'Cumhuriyet, Orta Sk. 9 C, 59800 Şarköy/Tekirdağ', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d757.1730866683404!2d27.11596248814398!3d40.614611016742394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b3f9cfc3667a5d%3A0xd779cbe7c5db0c9d!2zQ3VtaHVyaXlldCwgT3J0YSBTay4gOSBDLCA1OTgwMCDFnmFya8O2eS9UZWtpcmRhxJ8!5e0!3m2!1str!2str!4v1607980393663!5m2!1str!2str', 'Hemen formu doldurarak bizimle iletişime geçebilirsiniz.', 'Lupusoft® Radyant E-Ticaret Paketi', 1, '2021-10-01', 1, 30, 1, 1, 1, 1, 'Fırsat Ürünleri', 'Sizin için seçtiklerimiz', 1, 'favicon.svg', 'Siparişler ortalama 3 iş saati içerisinde teslim edilir.', 15, 0, 1, 'Turkish', 1, 1, '&nbsp;', 1, 1, 50, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bankalar`
--

DROP TABLE IF EXISTS `bankalar`;
CREATE TABLE IF NOT EXISTS `bankalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `logo` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `bankalar`
--

INSERT INTO `bankalar` (`id`, `isim`, `logo`) VALUES
(1, 'Ziraat Bankası', 'l1z.jpg'),
(2, 'Garanti Bankası', 'l2g.jpg'),
(3, 'ING Bank', 'l3i.jpg'),
(4, 'Akbank', 'l4a.jpg'),
(5, 'İş Bankası', 'l5i.jpg'),
(6, 'HSBC', 'l6h.jpg'),
(7, 'YapıKredi Bankası', 'l7y.jpg'),
(8, 'QNB Finansbank', 'l8q.jpg'),
(9, 'Halkbank', 'l9h.jpg'),
(10, 'Vakıfbank', 'l10v.jpg'),
(11, 'Denizbank', 'l11d.jpg'),
(12, 'TEB', 'l12t.jpg'),
(13, 'Kuveyt Türk', 'l13k.jpg'),
(14, 'Albaraka', 'l14a.jpg'),
(15, 'Şekerbank', 'l15s.jpg'),
(16, 'Anadolubank', 'l16a.jpg'),
(17, 'Fibabanka', 'l17f.jpg'),
(18, 'Burgan Bank', 'l18b.jpg'),
(19, 'Bank Mellat', 'l19b.jpg'),
(20, 'Habib Bank Ltd', 'l20h.jpg'),
(21, 'Odeabank', 'l210.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birimler`
--

DROP TABLE IF EXISTS `birimler`;
CREATE TABLE IF NOT EXISTS `birimler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `birimler`
--

INSERT INTO `birimler` (`id`, `isim`) VALUES
(1, 'Adet'),
(2, 'Kg'),
(3, 'Paket'),
(4, 'Koli');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `calisilanbankalar`
--

DROP TABLE IF EXISTS `calisilanbankalar`;
CREATE TABLE IF NOT EXISTS `calisilanbankalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banka` int(11) NOT NULL,
  `iban` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `hesapno` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `subeadi` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `subekodu` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `unvan` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `calisilanbankalar`
--

INSERT INTO `calisilanbankalar` (`id`, `banka`, `iban`, `hesapno`, `subeadi`, `subekodu`, `unvan`) VALUES
(2, 1, 'TR11 0000 1111 2222 3333 4444 55', '0123456789101112', 'TEKİRDAĞ ŞARKÖY ŞUBESİ', '0123', 'BURAK PALİÇ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `destekmesajlari`
--

DROP TABLE IF EXISTS `destekmesajlari`;
CREATE TABLE IF NOT EXISTS `destekmesajlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `sahip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ebulten`
--

DROP TABLE IF EXISTS `ebulten`;
CREATE TABLE IF NOT EXISTS `ebulten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eposta` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favoriler`
--

DROP TABLE IF EXISTS `favoriler`;
CREATE TABLE IF NOT EXISTS `favoriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun` int(11) NOT NULL,
  `sahip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iadedurum`
--

DROP TABLE IF EXISTS `iadedurum`;
CREATE TABLE IF NOT EXISTS `iadedurum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `durum` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `iadedurum`
--

INSERT INTO `iadedurum` (`id`, `durum`) VALUES
(1, 'Talep alındı'),
(2, 'İnceleniyor'),
(3, 'Onaylandı'),
(4, 'İade edildi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iadetalepleri`
--

DROP TABLE IF EXISTS `iadetalepleri`;
CREATE TABLE IF NOT EXISTS `iadetalepleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siparis` int(11) NOT NULL,
  `urun` int(11) NOT NULL,
  `durum` int(50) NOT NULL,
  `sahip` int(11) NOT NULL,
  `takipno` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

DROP TABLE IF EXISTS `iletisim`;
CREATE TABLE IF NOT EXISTS `iletisim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(80) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(80) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `iletisim`
--

INSERT INTO `iletisim` (`id`, `isim`, `eposta`, `mesaj`) VALUES
(4, 'burak', 'admin@lupusoft.com', 'test');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kategorikodu` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `resim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `isim`, `kategorikodu`, `resim`, `aciklama`) VALUES
(16, 'E-Ticaret Yazılımları', 'E-Ticaret-Yazilimlari', '1613404733_5955ff01c9de3d2fb06ed002.jpg', ' kategorisine ait ürünler bu sayfada yer alır.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `konusmalar`
--

DROP TABLE IF EXISTS `konusmalar`;
CREATE TABLE IF NOT EXISTS `konusmalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarih` date NOT NULL,
  `ipadresi` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `sahip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kuponkodu`
--

DROP TABLE IF EXISTS `kuponkodu`;
CREATE TABLE IF NOT EXISTS `kuponkodu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kod` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `tutar` float NOT NULL,
  `durum` int(11) NOT NULL,
  `kullanan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kuponkodu`
--

INSERT INTO `kuponkodu` (`id`, `kod`, `tutar`, `durum`, `kullanan`) VALUES
(3, 'YVZSG-1356A-173DG-ABCDE-FGHJK', 0.1, 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `markalar`
--

DROP TABLE IF EXISTS `markalar`;
CREATE TABLE IF NOT EXISTS `markalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(120) COLLATE utf8_turkish_ci NOT NULL,
  `logo` varchar(120) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` varchar(180) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `markalar`
--

INSERT INTO `markalar` (`id`, `isim`, `logo`, `aciklama`) VALUES
(2, 'Lupusoft', 'lupusoft-logo.jpg', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

DROP TABLE IF EXISTS `mesajlar`;
CREATE TABLE IF NOT EXISTS `mesajlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `konusma` int(11) NOT NULL,
  `sahip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odemeyontemleri`
--

DROP TABLE IF EXISTS `odemeyontemleri`;
CREATE TABLE IF NOT EXISTS `odemeyontemleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(120) COLLATE utf8_turkish_ci NOT NULL,
  `tutar` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  `href` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `odemeyontemleri`
--

INSERT INTO `odemeyontemleri` (`id`, `isim`, `tutar`, `durum`, `href`) VALUES
(1, 'Kapıda nakit ödeme', 10, 1, '?sayfa=sipTamamla&t=tamamlandi&o=kn'),
(2, 'Kapıda kredi kartı ile ödeme', 10, 1, '?sayfa=sipTamamla&t=tamamlandi&o=kk'),
(3, 'Online kredi kartı ile ödeme', 0, 1, '?sayfa=sipTamamla&t=kartGir'),
(4, 'Havale ile ödeme', 0, 1, '?sayfa=sipTamamla&t=havale');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `parabirimleri`
--

DROP TABLE IF EXISTS `parabirimleri`;
CREATE TABLE IF NOT EXISTS `parabirimleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `birim` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `parabirimleri`
--

INSERT INTO `parabirimleri` (`id`, `birim`) VALUES
(1, '₺'),
(2, '€'),
(3, '£'),
(4, '$'),
(5, 'CHF'),
(6, '¥'),
(7, '﷼'),
(8, 'kr'),
(9, 'د.ك'),
(10, 'руб'),
(11, '؋'),
(12, 'Kz'),
(13, 'Lek'),
(14, 'ƒ'),
(15, 'ман'),
(16, 'د.إ'),
(17, 'د.ب'),
(18, '৳'),
(19, 'p.'),
(20, 'BZ$'),
(21, 'Nu'),
(22, '$b'),
(23, 'KM'),
(24, 'P'),
(25, 'R$'),
(26, 'лв'),
(27, 'Kč'),
(28, 'RD$'),
(29, 'Rp'),
(30, '₱'),
(31, '¢'),
(32, 'Q'),
(33, '₩'),
(34, '₹'),
(35, '₪'),
(36, 'J$'),
(37, '៛'),
(38, '₦');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resimler`
--

DROP TABLE IF EXISTS `resimler`;
CREATE TABLE IF NOT EXISTS `resimler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sahip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `resimler`
--

INSERT INTO `resimler` (`id`, `isim`, `sahip`) VALUES
(64, '1613396375_lupusoft-eticaret-paketi-3.jpg', 99),
(63, '1613396368_lupusoft-eticaret-paketi-2.jpg', 99),
(62, '1613396308_lupusoft-eticaret-paketi-1.jpg', 99);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sayfalar`
--

DROP TABLE IF EXISTS `sayfalar`;
CREATE TABLE IF NOT EXISTS `sayfalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kod` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `baslik` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `footeracik` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sayfalar`
--

INSERT INTO `sayfalar` (`id`, `kod`, `baslik`, `icerik`, `footeracik`) VALUES
(1, 'teslimat-ve-iade', 'Teslimat & İade', '<p>&nbsp;İPTAL ve İADE/CAYMA ŞARTLARI</p>\r\n\r\n<p>Alıcı, kullanmış olduğu web sitesi &uuml;zerinden vermiş olduğu sipariş ile mesafeli satış s&ouml;zleşmesini ve t&uuml;m koşullarını kabul etmiş durumdadır. Aldığınız her &uuml;r&uuml;n, &uuml;retici firmasının garantisi altındadır.</p>\r\n\r\n<p>Firmamız, t&uuml;ketici haklarını korumakta ve satış sonrası m&uuml;şteri memnuniyetini en &ouml;n planda tutmakta olup, Satın aldığınız &uuml;r&uuml;nlerle ilgili yaşayabileceğiniz memnuniyetsizlik, &uuml;retim ve servis kaynaklı her t&uuml;rl&uuml; sorun, titizlikle değerlendirilmekte ve en kısa s&uuml;rede &ccedil;&ouml;z&uuml;me kavuşturulmaktadır.</p>\r\n\r\n<p>Almış olduğunuz &uuml;r&uuml;n&uuml;n&uuml; ambalajını a&ccedil;madan/tahrip etmeden//bozmadan, &uuml;r&uuml;n&uuml; kullanmadan teslim tarihinden itibaren 14 (ond&ouml;rt) g&uuml;nl&uuml;k s&uuml;re i&ccedil;inde &quot;İade etme&rdquo; başlığı altında teslim aldığınız şekli ile iade edebilirsiniz.</p>\r\n\r\n<p>İade edilmek istenen &Uuml;r&uuml;n&rsquo;le birlikte, &uuml;r&uuml;n faturası, sipariş numaranızı ile iade gerek&ccedil;enizi de i&ccedil;eren bir dilek&ccedil;e veya iade formu ile iadenin ger&ccedil;ekleştirilmesi gerekmektedir.</p>\r\n\r\n<p>&Uuml;r&uuml;n iadesine ilişkin koşul ve şartlar ise şu şekilde şekildedir;</p>\r\n\r\n<p>İade İ&ccedil;in Gerekli Koşul ve Esaslar:</p>\r\n\r\n<p>1. &nbsp; &nbsp;İadeler mutlak surette &uuml;r&uuml;n&uuml;n orijinal kutusu ve/veya ambalajı ile birlikte yapılmalıdır. (Orijinal kutu/ambalaj, eğer mevcutsa &uuml;r&uuml;n&uuml;n kendi ambalajıdır.)</p>\r\n\r\n<p>2. &nbsp;&Uuml;r&uuml;nde ve ambalajında herhangi bir a&ccedil;ılma, bozulma, kırılma, tahrip, yırtılma, kullanılma ve sair durumları tespit ettiği hallerde ve &uuml;r&uuml;n&uuml;n m&uuml;şteriye teslim edildiği andaki hali ile iade edilememesi halinde &uuml;r&uuml;n&uuml; iade almayacak ve bedelini iade etmeyecektir.</p>\r\n\r\n<p>3. &nbsp;Ambalajı a&ccedil;ılmış/bozulmuş, tahrip edilmiş ya da ekonomik değerini/tekrar satılabilme &ouml;zelliğini kaybetmiş, bir kez dahi olsa kullanılmış, herhangi bir şekilde hasar verilmiş, herhangi bir şekilde Firmamızdan kaynaklanmayan nedenler ile başka bir m&uuml;şteri tarafından satın alınamayacak durumda olan vb. &uuml;r&uuml;nlerin iadesi kabul edilmemektedir.&nbsp;</p>\r\n\r\n<p>4. &nbsp;M&uuml;şteri &uuml;r&uuml;n&uuml;, kendisine teslim edildiği andaki durumu ile geri vermekle ve kullanım s&ouml;z konusu ise kullanma dolayısıyla malın ticari değerindeki kaybı tazminle y&uuml;k&uuml;ml&uuml;d&uuml;r.</p>\r\n\r\n<p>5. &nbsp;Sevkiyat sırasında zarar g&ouml;rd&uuml;ğ&uuml;n&uuml; d&uuml;ş&uuml;nd&uuml;ğ&uuml;n&uuml;z paketleri teslim aldığınız firma yetkilisi &ouml;n&uuml;nde a&ccedil;ıp kontrol ediniz. Eğer &uuml;r&uuml;nde herhangi bir zarar varsa kargo firmasına tutanak tutturarak &uuml;r&uuml;n&uuml; teslim almayınız. &Uuml;r&uuml;n teslim alındıktan sonra kargo firmasının g&ouml;revini tam olarak yerine getirdiğini kabul etmiş olduğunuzu unutmayınız.</p>\r\n\r\n<p>6. &nbsp;Alıcının isteği ile kişiye &ouml;zel olarak &uuml;retilen veya &uuml;zerinden değişiklik ya da ilave yapılarak kişiye &ouml;zel hale getirilen &uuml;r&uuml;nler iade/cayma hakkı kapsamı dışındadır.</p>\r\n\r\n<p>7. &nbsp;İade edeceğiniz &uuml;r&uuml;n kurumsal fatura ile satın alınmışsa yani faturası şirket adına kesilmişse, iade ederken şirketinizin d&uuml;zenlemiş olduğu fatura ile birlikte g&ouml;nderilmelidir. İade faturası, kargo payı dahil edilmeden (&uuml;r&uuml;n birim fiyatı + KDV şeklinde) kesilmelidir.</p>\r\n\r\n<p>8. &nbsp;Yukarıdaki şartlara uygun hallerde iade edilen &uuml;r&uuml;ne ilişkin kargo &uuml;creti; tarafınıza &uuml;r&uuml;n teslimatın yapıldığı, anlaşmalı kargo şirketimiz vasıtasıyla iade yapılması koşuluyla tarafımızca &ouml;denecektir.</p>\r\n\r\n<p>9. &nbsp;M&uuml;şterinin &uuml;r&uuml;n&uuml; iade etmesi veya alışverişinden cayması halinde, iade edilen &uuml;r&uuml;n firmamıza ulaştığı andan itibaren gerekli incelemelerin yapılması &uuml;zerine ve iade koşul ve şartlarının da sağlanması halinde on (10) g&uuml;n i&ccedil;erisinde iade talebiniz onaylanır ve &uuml;r&uuml;n bedeli iade edilir. Kredi kartına &uuml;r&uuml;n iade bedeli bankanız tarafından 2-6 hafta arasında yapılmaktadır. Bu s&uuml;rede firmamızın tasarrufu bulunmamakta olup, firmamızın herhangi bir sorumluluğu yoktur.</p>\r\n\r\n<p>Havale iadeleri 2 (İki) iş g&uuml;n&uuml; i&ccedil;inde Kredi Kartı iadeleri 3(&Uuml;&ccedil;) iş g&uuml;n&uuml; i&ccedil;inde yapılacaktır. Bankanız kredi kartı iadelerini aynı g&uuml;n hesabınıza yansıtmayabilir. Bu durumda bankanızın kredi kartı servisini aramanız gereklidir.</p>\r\n\r\n<p><br />\r\nTaksitli kredi kartı &ouml;demelerinin iadesinde tutarın tamamı kredi kartınızın bankasına tek seferde &ouml;denir. Bu aşamadan sonra banka, bu tutarı kredi kartınıza her ay taksit tutarı kadar yatırır ve &ccedil;eker (ekstreye + ve &ndash; olarak yansır). Bu işlem, taksit sayısı kadar ay devam eder.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>TESLİMAT</p>\r\n\r\n<p>Siparişiniz onaylandıktan sonra &uuml;r&uuml;n&uuml;n&uuml;z&uuml;n hazırlanması ve faturalama işlemlerinin yapılmasının ardından siparişiniz kargo firmasına teslim edilecektir. Siparişiniz kargoya teslim edildikten sonra &uuml;r&uuml;nlerin teslim s&uuml;resi, teslimat adresine ve kargo firmasının teslimat hızına g&ouml;re değişkenlik g&ouml;sterebilir. Siparişiniz ile ilgili olarak tarafınıza bir e &ndash;mail g&ouml;nderilecektir. Detaylı bilgiyi ilgili kargo firmasından alabilirsiniz.</p>\r\n\r\n<p>Kargonuz, kargo personeli tarafından size kargo teslim fişi imzalanması karşılığı teslim edilecektir. Kargo teslim fişini imzaladıktan sonra, kargo ambalajında sorun olmasa bile, kargo paketini a&ccedil;ıp kontrol etmenizi &ouml;neriyoruz. Paket i&ccedil;eriğinde herhangi bir yanlışlık varsa ya da &uuml;r&uuml;nler hasar g&ouml;rm&uuml;şse kargo g&ouml;revlisine hasar tespit tutanağı hazırlatıp Firmamızla iletişime ge&ccedil;melisiniz.</p>\r\n\r\n<p>Teslimatı ger&ccedil;ekleştirecek kargo firmasının belirtmiş olduğunuz adreste teslimat i&ccedil;in kimseye ulaşamazsa kapınıza pusula bırakacaktır. İlgili pusula &uuml;zerinde size teslimat yapacak olan kargo şubesinin adres ve telefonları bulabilirsiniz. Kargo şubesi kolinizi 3 g&uuml;n boyunca bekletecektir. Şayet 3 g&uuml;n i&ccedil;erisinde de kargonuzu teslim almadığınız ve size ulaşamadığı takdirde siparişinizi tarafımıza geri g&ouml;nderilecektir. Pusulada belirtilen kargo şubesi ile iletişime ge&ccedil;erek daha ayrıntılı bilgi sahibi olabilirsiniz.</p>\r\n\r\n<p>Teslimat Takibi:</p>\r\n\r\n<p>Sipariş formumuzda teslimat i&ccedil;in izin verdiğimiz zaman, teslimatı ger&ccedil;ekleştirebileceğimiz zamana g&ouml;re %100 oranında toleranslıdır.</p>\r\n\r\n<p>Belirtilen adreste herhangi bir hata durumunda teslimatı ger&ccedil;ekleşemeyen sipariş ile ilgili olarak siparişi veren ile bağlantı kurulmaktadır. Ziyaret&ccedil;imiz tarafından belirtilen e-posta adresinin ge&ccedil;erliliği siparişin aktarılmasını takiben g&ouml;nderilen otomatik e-posta ile teyid edilmektedir. Teslimatın ger&ccedil;ekleşmesi konusunda m&uuml;şteri kadar kredi kartı sistemini kullandığımız bankaya karşı da sorumluluğumuz s&ouml;z konusudur.</p>\r\n\r\n<p>Teslimat Y&ouml;ntemi:</p>\r\n\r\n<p>Kullanıcı teslimat y&ouml;ntemi olarak 2 farklı yolu se&ccedil;ebilir. Şirket teslim ve kargo ile teslim şeklinde 2 y&ouml;ntemden birini se&ccedil;en kullanıcı alışveriş bedeline g&ouml;re kargo &uuml;cretinden muaf tutulmaktadır.<br />\r\n&nbsp;</p>\r\n', 1),
(2, 'uyelik-sozlesmesi', 'Üyelik Sözleşmesi', '<p>Sitenin genel kullanım şartları, bununla ilgili genel kurallar ve yasal sorumluluklar</p>\r\n\r\n<p>Aşağıda belirtilen şartlar, kurallar ve yasal sorumlulukları i&ccedil;eren &Uuml;yelik S&ouml;zleşmesi&rsquo;nin kullanıcının kullanmış olduğu websitesi kullanılmadan &ouml;nce okunması tavsiye edilir.<br />\r\nBelirtilen şartların sizin i&ccedil;in uygun olmaması halinde l&uuml;tfen kullanıcının kullanmış olduğu websitesini &nbsp;kullanmayınız. Siteyi kullanarak ve kişisel bilgilerinizin yer alacağı formu doldurarak bu sayfalarda yazılı şartları kabul etmiş sayılmaktasınız.&nbsp;</p>\r\n\r\n<p><br />\r\n1. Kullanım ve G&uuml;venlik Kuralları&nbsp;<br />\r\nkullanıcının kullanmış olduğu websitesi t&uuml;m &uuml;yelerine a&ccedil;ıktır. Site &uuml;zerinde verilen hizmetler aksi belirtilmedik&ccedil;e, &uuml;cretsizdir.&nbsp;</p>\r\n\r\n<p>Aşağıdaki yazılı durumlarda, site y&ouml;netimi &uuml;yenin site kullanımını engelleyebilir ve aşağıdaki girişimlere karışan kişi veya kişiler hakkında kanuni haklarını saklı tutar:</p>\r\n\r\n<p>1.a. Yanlış, d&uuml;zensiz, eksik ve yanıltıcı bilgiler, genel ahlak kurallarına uygun olmayan ifadeler i&ccedil;eren ve T&uuml;rkiye Cumhuriyeti yasalarıyla ters d&uuml;şen bilgilerin siteye kaydedilmesi</p>\r\n\r\n<p>1.b. Site i&ccedil;eriğinin izinsiz olarak kısmen veya t&uuml;m&uuml;yle kopyalanması</p>\r\n\r\n<p>1.c. Kullanıcılara verilen ya da kendi belirledikleri kullanıcı adı, şifre gibi bilgilerin, kullanım haklarının, &uuml;&ccedil;&uuml;nc&uuml; kişi ya da kuruluşlarla paylaşılmasından (bu bilgilerin kullanıcı dışındaki kişiler tarafından kullanılmasından) kaynaklanacak her t&uuml;rl&uuml; zarardan doğrudan Kullanıcı sorumludur. Aynı şekilde Kullanıcı, Internet ortamında bir başkasına ait IP adresi, elektronik posta adresi, kullanıcı adı gibi kişisel bilgileri kullanamayacağı gibi diğer kullanıcıların &ouml;zel bilgilerine de izinsiz olarak ulaşamaz veya bunları kullanamaz. Kullanıcı bu şekilde bir kullanımdan dolayı doğabilecek her t&uuml;rl&uuml; hukuki ve cezai y&uuml;k&uuml;ml&uuml;l&uuml;ğ&uuml; kabul etmiş sayılmaktadır.</p>\r\n\r\n<p>1.d. Sitenin g&uuml;venliğini tehdit edecek, sitenin ve kullanılan yazılımların &ccedil;alışmasını engelleyecek yazılımların kullanılması, faaliyetlerin yapılması, yapılmaya &ccedil;alışılması ve bilgilerin alınması, silinmesi, değiştirilmesi</p>\r\n\r\n<p>2. İ&ccedil;erik Kullanımı</p>\r\n<div>\r\n<p>3. Sorumluluklar</p>\r\n\r\n<p>3a. kullanıcının kullanmış olduğu websitesi&#39;u ziyaret eden kullanıcıların bilgileri (ziyaret s&uuml;resi, zamanı, g&ouml;r&uuml;nt&uuml;lenen sayfalar) onlara daha iyi hizmet edebilmek amacı ile takip edilmektedir. Bu bilgiler, gizlilik şartlarına bağlı kalınarak, i&ccedil;eriği genişletmek ve iyileştirmek amacı ile reklam vb. konularda işbirliği yaptığımız firmalarla paylaşılmaktadır. Buradaki ama&ccedil;, sitenin kullanıcılarına sunduğu deneyimi geliştirmek ve kullanıcının kullanmış olduğu websitesi&rsquo;u geliştirmektir.</p>\r\n\r\n<p>3.b. kullanıcının kullanmış olduğu websitesi kullanıcısı, kayıt i&ccedil;in gerekli olan b&ouml;l&uuml;mleri doldurup elektronik posta adresini onayladıktan sonra &nbsp;işbu s&ouml;zleşmede belirtilen şartlara uymak koşulu ile, elektronik posta adresini ve şifresini girerek kullanıcının kullanmış olduğu websitesi sitesini kullanmaya başlayabilir.&nbsp;</p>\r\n\r\n<p>3.c. Kullanıcı, kullanıcının kullanmış olduğu websitesi sitesi ve hizmetlerinden yararlanırken, T&uuml;rk Ceza Kanunu, T&uuml;rk Ticaret Kanunu, Fikir ve Sanat Eserleri Kanunu, Marka ve Patent Haklarının Korunması ile ilgili Kanun H&uuml;km&uuml;nde Kararnameler ve yasal d&uuml;zenlemeler, Bor&ccedil;lar Yasası, diğer ilgili mevzuat h&uuml;k&uuml;mleri ile kullanıcının kullanmış olduğu websitesi&#39;un hizmetlerine ilişkin olarak yayımlayacağı her t&uuml;rl&uuml; duyuru ve bildirimlere uymayı kabul eder. Bu bildirimlere ve yasalara aykırı kullanım sebebiyle doğabilecek hukuki, cezai ve mali her t&uuml;rl&uuml; sorumluluk Kullanıcıya aittir.</p>\r\n\r\n<p>3.d. Kullanıcının işbu s&ouml;zleşmede belirtilen y&uuml;k&uuml;ml&uuml;l&uuml;klere veya kullanıcının kullanmış olduğu websitesi sitesinde bildirilen genel kurallara uymamasının tespiti halinde, Kullanıcının kullanıcının kullanmış olduğu websitesi&#39;dan yararlanması Faruk Apel tarafından s&uuml;reli veya s&uuml;resiz olarak engellenebilir ve/veya hesabı kapatılabilir.</p>\r\n\r\n<p>3.e. Kullanıcı, diğer kullanıcıların ve ziyaret&ccedil;ilerin kullanıcının kullanmış olduğu websitesi&#39;u kullanmasını &ouml;nleyici veya zorlaştırıcı hareketlerde bulunamaz, sunucuları ya da veritabanlarını otomatik programlar y&uuml;kleyip zorlayamaz/kilitleyemez. Hile girişimlerinde bulunamaz. Bulunması halinde &uuml;yeliğinin sonlandırılacağını ve durumdan doğabilecek her t&uuml;rl&uuml; hukuki, cezai sorumluluğu kabul eder.</p>\r\n\r\n<p><br />\r\n3.g. Kullanıcı, kullanıcının kullanmış olduğu websitesi&#39;dan kopyalanmış veya yazıcı ile yazdırılmış hi&ccedil;bir materyal &uuml;zerinden Telif Hakkı, Ticari Marka ve her t&uuml;rl&uuml; Fikir ve Sanat Eserleri Kanunu kapsamı notlarını silemez veya &ccedil;ıkartamaz.&nbsp;</p>\r\n\r\n<p>3.h. &Uuml;yelik iptali ve hesap silme işlemi, kullanıcı tarafından kullanıcının kullanmış olduğu websitesi &uuml;zerinden yapılabilir. &Uuml;yeliğini bitiren kullanıcının siteye giriş yetkisi iptal edilecektir. &Uuml;yeliğini iptal eden kişi bu işlemin geri d&ouml;n&uuml;ş&uuml; olmadığını kabul eder.</p>\r\n\r\n<p><br />\r\n3.j. Site kullanıcılarının birbirleri ya da &uuml;&ccedil;&uuml;nc&uuml; şahıslarla olan ilişkileri kişilerin sorumluluğundadır.</p>\r\n\r\n<p>3.m. Sitenin belirli yerlerinde o b&ouml;l&uuml;me &ouml;zel farklı kurallar ve y&uuml;k&uuml;ml&uuml;l&uuml;kler belirtilebilir. Bu b&ouml;l&uuml;mleri kullanan kişi ve kuruluşlar peşinen belirtilen bu kuralları kabul etmiş sayılır.</p>\r\n\r\n<p>3.n. Kullanıcılarımızın kişisel bilgilerini ve gizliliklerini korumak i&ccedil;in aldığımız &ouml;nlemler ve bu konudaki genel politikamızı okumak i&ccedil;in, l&uuml;tfen &ldquo;Gizlilik Politikası&rdquo; b&ouml;l&uuml;m&uuml;n&uuml; okuyunuz.</p>\r\n\r\n<p>3.o Kullanıcı site &uuml;zerinden yapacağı alışverişlerde kullanacağı &ouml;deme bilgilerinin (kredi kartı, GSM numarası bilgileri v.b.) doğru olduğunu, bunlardan kaynaklanan hukuki ve cezai sorumlulukların kendisine ait olduğunu kabul ve taah&uuml;t eder.&nbsp;</p>\r\n\r\n<p>7. Tebligat Adresleri</p>\r\n\r\n<p>7.a. kullanıcının kullanmış olduğu websitesi sitesi kullanıcılarından peşinen posta adreslerini istememektedir. Ancak kullanıcının kullanmış olduğu websitesi&#39;ne bildirdiği elektronik posta adresi, bu s&ouml;zleşme ile ilgili olarak yapılacak her t&uuml;rl&uuml; bildirim i&ccedil;in yasal adresin isteneceği elektronik posta olarak kabul edilir.</p>\r\n\r\n<p>7.b. Taraflar, mevcut elektronik postalarındaki değişiklikleri yazılı olarak diğer tarafa 3 (&uuml;&ccedil;) g&uuml;n i&ccedil;inde bildirmedik&ccedil;e, eski elektronik postalara yapılacak isteklerin ge&ccedil;erli olacağını ve kendilerine yapılmış sayılacağını kabul ederler.</p>\r\n\r\n<p>7.c. Yine kullanıcının kullanmış olduğu websitesi&#39;nin kullanıcının kayıtlı elektronik posta adresini kullanarak yapacağı her t&uuml;rl&uuml; bildirimin elektronik postanın kullanıcının kullanmış olduğu websitesi tarafından yollanmasından 1 (bir) g&uuml;n sonra kullanıcıya ulaştığı kabul edilecektir. Kullanıcı, bu katılım s&ouml;zleşmesinde yer alan maddelerin t&uuml;m&uuml;n&uuml; okuduğunu, anladığını, kabul ettiğini ve kendisiyle ilgili olarak verdiği bilgilerin doğruluğunu onayladığını beyan, kabul ve taahh&uuml;t eder.</p></div>\r\n', 1),
(3, 'kvkk-aydinlatma-metni', 'Kişisel Verilerin Korunması', '<p>KİŞİSEL VERİLERİN KORUNMASI KANUNU(6698 S.K.) KAPSAMI VE GENEL<br />\r\nGİZLİLİK S&Ouml;ZLEŞMESİ<br />\r\n1- TARAFLAR<br />\r\nBir tarafta bu web sitesi ve grup şirketleri (bu s&ouml;zleşmede kısaca<br />\r\n&ldquo;İŞVEREN&rdquo; olarak anılacaktır.)<br />\r\nDiğer tarafta, veri paylaşılan, m&uuml;şteriler ve tedarik&ccedil;iler ile &uuml;r&uuml;n servisleri, distrib&uuml;t&ouml;rler,<br />\r\nbayiler, &ccedil;alışanlar, &ccedil;alışan adayları, stajyerler, servis sağlayıcıları ve danışmanlar (bu<br />\r\ns&ouml;zleşmede kısaca &ldquo;&Ccedil;ALIŞANLAR VE DİĞERLERİ&rdquo; olarak anılacaktır.) aralarında<br />\r\naşağıdaki koşullarda anlaşmışlardır.<br />\r\n2- S&Ouml;ZLEŞMENİN KONUSU<br />\r\nTaraflar arasından akdedilen yazılı veya s&ouml;zl&uuml; hizmet s&ouml;zleşmesinin (bundan b&ouml;yle &ldquo;HİZMET<br />\r\nS&Ouml;ZLEŞMESİ&rdquo; olarak anılacaktır.) eki niteliğindeki işbu s&ouml;zleşmenin konusu, hizmet<br />\r\ns&ouml;zleşmesi kapsamında iş&ccedil;iler ve diğerleri tarafından y&uuml;r&uuml;t&uuml;len &ccedil;alışmalar ile ilgili olarak<br />\r\niş&ccedil;iler ve diğerlerine işveren (Veri Sorumlusu) tarafından verilen bilgi ve belgelerin işverenin<br />\r\nonayı veya iş&ccedil;iler ve diğerlerinin a&ccedil;ık rıza beyanı olmaksızın kişisel verilerin, &ouml;zel nitelikli<br />\r\nkişisel verilerin ve genel verilerin herhangi bir &uuml;&ccedil;&uuml;nc&uuml; ger&ccedil;ek ve/veya t&uuml;zel kişiye<br />\r\na&ccedil;ıklanmasının, erişmesinin, verilmesinin, sızdırılmasının &ouml;n&uuml;ne ge&ccedil;ecek olan gizliliğin<br />\r\nsınırlarının ve koşullarının belirlenmesidir.<br />\r\n3- GİZLİ BİLGİNİN TANIMI<br />\r\nKişisel Verilerin Korunması Kanunu kapsamında tanımını bulan kişiye ait bilgiler ile<br />\r\nKimliği belirli veya belirlenebilir ger&ccedil;ek kişiye ilişkin her t&uuml;rl&uuml; bilgi, Kimliği belirli veya<br />\r\nbelirlenebilir ger&ccedil;ek kişiye ilişkin her t&uuml;rl&uuml; sağlık bilgisi, Kişilerin ırkı, etnik k&ouml;keni, siyasi<br />\r\nd&uuml;ş&uuml;ncesi, felsefi inancı, dini, mezhebi veya diğer inan&ccedil;ları, kılık ve kıyafeti, dernek, vakıf ya<br />\r\nda sendika &uuml;yeliği, sağlığı, cinsel hayatı, ceza mahk&ucirc;miyeti ve g&uuml;venlik tedbirleriyle ilgili<br />\r\nverileri ile biyometrik ve genetik veriler.<br />\r\nHizmet s&ouml;zleşmesinde tanımlanan işler/g&ouml;revler/hizmetler esnasında işveren tarafından<br />\r\niş&ccedil;iye a&ccedil;ıklanan fikir, proje, uzmanlık bilgileri, tasarım, buluş, iş metodu ve patent, telif<br />\r\nhakkı, marka, ticari sır, know how ya da diğer yasal korunmaya konu olan ya da olmayan her<br />\r\nt&uuml;rl&uuml; yenilik ve &ccedil;alışma esnasında &ouml;ğrenilecek yazılı veya s&ouml;zl&uuml; t&uuml;m ticari, mali, teknik<br />\r\nbilgiler ve iletişim y&ouml;ntemleri gizli bilgi olarak kabul edilir.<br />\r\n4- TARAFLARIN Y&Uuml;K&Uuml;ML&Uuml;L&Uuml;KLERİ<br />\r\n4.1. İşveren hizmet s&ouml;zleşmesi kapsamında iş&ccedil;iye işini tam ve eksiksiz olarak yerine<br />\r\ngetirebilmesi ve gerekli her t&uuml;rl&uuml; bilgi ve belgeyi iş&ccedil;iye vermeyi taahh&uuml;t eder.<br />\r\n4.2. İşveren iş&ccedil;iye ve diğerlerine a&ccedil;ıklanan gizli bilgilerin eksik ya da hatalı olması sebebiyle<br />\r\nortaya &ccedil;ıkabilecek olan eksiklik, gecikme veya aksaklıklardan dolayı iş&ccedil;inin sorumlu<br />\r\ntutulamayacağını kabul ve taahh&uuml;t eder.<br />\r\n4.3 İş&ccedil;i ve diğerlerine işveren tarafından kendisine a&ccedil;ıklanan bilgi ve belgelerin gizli<br />\r\nolduğunu bildiğini ve bu nedenle s&ouml;z konusu gizli bilgileri sadece kendisinin bileceğini ve işin<br />\r\nyerine getirilmesi aşamasında katkıda bulunması muhtemel &uuml;&ccedil;&uuml;nc&uuml; kişi, kurum ya da<br />\r\nkuruluşların gizli bilgilerden sadece işin gereği kadar haberdar olacaklarını, işbu bilgi ve<br />\r\nbelgelerin hi&ccedil;bir şekilde işverenin izni olmaksızın &uuml;&ccedil;&uuml;nc&uuml; ger&ccedil;ek ve/veya t&uuml;zel kişi ve<br />\r\nkuruluşlara &ccedil;alışma ama&ccedil;ları dışında a&ccedil;ıklanmayacağını kabul ve taahh&uuml;t eder.&nbsp;<br />\r\n2<br />\r\n4.4. İş&ccedil;i ve diğerleri işin yerine getirilmesi aşamasında katkıda bulunması muhtemel &uuml;&ccedil;&uuml;nc&uuml;<br />\r\nkişi, kurum ya da kuruluşların işbu s&ouml;zleşmede &ouml;ng&ouml;r&uuml;len gizlilik ilkelerine aykırı<br />\r\ndavranışlarından dolayı sorumlu olacağını, s&ouml;z konusu &uuml;&ccedil;&uuml;nc&uuml; kişi, kurum ya da kuruluşların<br />\r\ngizlilik ilkelerine riayet edeceğini, aykırılık hallerinden haberdar olduğu takdirde, derhal ve<br />\r\nyazılı olarak işverene s&ouml;z konusu aykırılık durumunu bildireceğini kabul ve taahh&uuml;t eder.<br />\r\n4.5. Gizli bilgilerin ve kişisel verilerin işbu s&ouml;zleşmeye aykırı olarak a&ccedil;ıklanması, erişilmesine<br />\r\nimkan sağlanması, sızdırılması veya benzeri davranışlarla bilgilerin ele ge&ccedil;irilmesine ortam<br />\r\nsağlanması halinde işveren, masrafları iş&ccedil;iye ait olmak kaydıyla t&uuml;m yasal yollara başvurma<br />\r\nve uğradığı her t&uuml;rl&uuml; zararın giderimini iş&ccedil;iden ve diğerlerinden talep etme hakkına sahiptir.<br />\r\n5- S&Uuml;RE<br />\r\n5.1. Hizmet s&ouml;zleşmesinin eki niteliğindeki işbu s&ouml;zleşme, taraflarca imzalandığı tarihte<br />\r\ny&uuml;r&uuml;rl&uuml;ğe girecek olup, işbu s&ouml;zleşmeden doğan y&uuml;k&uuml;ml&uuml;l&uuml;kler hizmet s&ouml;zleşmesinin<br />\r\nge&ccedil;erliliğini koruduğu m&uuml;ddet&ccedil;e devam edecektir.<br />\r\n5.2. Hizmet s&ouml;zleşmesinin sona ermesi halinde dahi işbu s&ouml;zleşme, hizmet s&ouml;zleşmesinin sona<br />\r\nerme tarihinden itibaren işletmeye ve &uuml;r&uuml;nlere ait bilgiler ile kişisel verilerin anonim hale<br />\r\ngetirilmiş olanları ve işverenliğin izni olan bilgiler hari&ccedil; ve kişisel veri sahibinin rızası hari&ccedil;<br />\r\nkişisel verilerin s&uuml;resiz olarak gizliliği ve korunması olarak ge&ccedil;erliliğini koruyacaktır.<br />\r\n6- S&Ouml;ZLEŞME DEĞİŞİKLİĞİ<br />\r\nİşbu s&ouml;zleşme taraflarca daha &ouml;nce &ouml;zellikle gizlilik konusunda yapılmış olabilecek yazılı<br />\r\nve/veya s&ouml;zl&uuml; t&uuml;m s&ouml;zleşmelerin (burada sayılmamış bilgiler ve patent ve benzeri buluş<br />\r\ns&ouml;zleşmeleri hari&ccedil;) yerine ge&ccedil;er. S&ouml;zleşme değişiklikleri ancak yazılı yapılabilir.<br />\r\n7- TEBLİGAT<br />\r\nTarafların işbu s&ouml;zleşmenin atıfta bulunduğu s&ouml;zleşmelerde, belge ve metinlerde belirttikleri<br />\r\nadresleri tebligata elverişli adresleri olup herhangi bir değişiklik karşı tarafa yazılı olarak<br />\r\nbildirilmemiş bulunduk&ccedil;a bu adreslere y&ouml;neltilecek tebligatlar hukuken ge&ccedil;erli<br />\r\naddolunacaktır.<br />\r\n8- Y&Uuml;R&Uuml;RL&Uuml;K<br />\r\nİşbu s&ouml;zleşme 8 (sekiz) maddeden oluşmakta olup taraflar arasında d&uuml;zenlenmiş &ouml;zg&uuml;r<br />\r\niradeleriyle okunup kabul edilmiştir.</p>\r\n', 1),
(4, 'mesafeli-satis-sozlesmesi', 'Mesafeli Satış Sözleşmesi', '<p>Mesafeli Satış S&ouml;zleşmesi<br />\r\nMesafeli Satış Koşulları</p>\r\n<div>\r\n<p>İşbu s&ouml;zleşme 13.06.2003 tarih ve 25137 sayılı Resmi Gazetede yayınlanan Mesafeli S&ouml;zleşmeler Uygulama Usul ve Esasları Hakkında Y&ouml;netmelik gereği internet &uuml;zerinden ger&ccedil;ekleştiren satışlar i&ccedil;in s&ouml;zleşme yapılması zorunluluğuna istinaden d&uuml;zenlenmiş olup, maddeler halinde aşağıdaki gibidir.</p>\r\n\r\n<p>Madde 1 &ndash; Konu</p>\r\n\r\n<p>İşbu s&ouml;zleşmenin konusu, SATICI&#39;nın, ALICI&#39;ya satışını yaptığı, aşağıda nitelikleri ve satış fiyatı belirtilen &uuml;r&uuml;n&uuml;n satışı ve teslimi ile ilgili olarak 4077 sayılı T&uuml;keticilerin Korunması Hakkındaki Kanun-Mesafeli S&ouml;zleşmeleri Uygulama Esas ve Usulleri Hakkında Y&ouml;netmelik h&uuml;k&uuml;mleri gereğince tarafların hak ve y&uuml;k&uuml;ml&uuml;l&uuml;klerinin kapsamaktadır.</p>\r\n\r\n<p>Madde 2.1 - Satıcı Bilgileri</p>\r\n\r\n<p>&Uuml;nvan: {&Uuml;NVAN GİRİNİZ}<br>\r\nAdres: {ADRES GİRİNİZ}<br />\r\nTelefon: {TELEFON GİRİNİZ}<br />\r\nFaks: {FAKS GİRİNİZ}<br />\r\nE-mail: {E-MAİL ADRESİ GİRİNİZ}</p></div>\r\n(bu s&ouml;zleşmede kısaca\r\n&ldquo;İŞVEREN&rdquo; olarak anılacaktır.)<br>&nbsp;<br><div>\r\n<p>Madde 2.2 - Alıcı Bilgileri</p>\r\n\r\n<p>M&uuml;şteri olarak İŞVEREN alışveriş sitesine &uuml;ye olan kişi. &Uuml;ye olurken kullanılan adres ve iletişim bilgileri esas alınır.</p>\r\n\r\n<p>Madde 3 - S&ouml;zleşme Konusu &Uuml;r&uuml;n Bilgileri</p>\r\n\r\n<p>Malın / &Uuml;r&uuml;n&uuml;n / Hizmetin t&uuml;r&uuml;, miktarı, marka/modeli, rengi, adedi, satış bedeli, &ouml;deme şekli, siparişin sonlandığı andaki bilgilerden oluşmaktadır.</p>\r\n\r\n<p>Madde 4 - Genel H&uuml;k&uuml;mler</p>\r\n\r\n<p>4.1 - ALICI, Madde 3&#39;te belirtilen s&ouml;zleşme konusu &uuml;r&uuml;n veya &uuml;r&uuml;nlerin temel nitelikleri, satış fiyatı ve &ouml;deme şekli ile teslimata ilişkin t&uuml;m &ouml;n bilgileri okuyup bilgi sahibi olduğunu ve elektronik ortamda gerekli teyidi verdiğini beyan eder.</p>\r\n\r\n<p>4.2 - S&ouml;zleşme konusu &uuml;r&uuml;n veya &uuml;r&uuml;nler, yasal 30 g&uuml;nl&uuml;k s&uuml;reyi aşmamak koşulu ile her bir &uuml;r&uuml;n i&ccedil;in ALICI&#39;nın yerleşim yerinin uzaklığına bağlı olarak &ouml;n bilgiler i&ccedil;inde a&ccedil;ıklanan s&uuml;re i&ccedil;inde ALICI veya g&ouml;sterdiği adresteki kişi/kuruluşa teslim edilir. Bu s&uuml;re ALICI&#39;ya daha &ouml;nce bildirilmek kaydıyla en fazla 10 g&uuml;n daha uzatılabilir.</p>\r\n\r\n<p>4.3 - S&ouml;zleşme konusu &uuml;r&uuml;n, ALICI&#39;dan başka bir kişi/kuruluşa teslim edilecek ise, teslim edilecek kişi/kuruluşun teslimatı kabul etmemesinden İŞVEREN sorumlu tutulamaz.</p>\r\n\r\n<p>4.4 - İŞVEREN, s&ouml;zleşme konusu &uuml;r&uuml;n&uuml;n sağlam, eksiksiz, siparişte belirtilen niteliklere uygun ve varsa garanti belgeleri ve kullanım kılavuzları ile teslim edilmesinden sorumludur.</p>\r\n\r\n<p>4.5 - S&ouml;zleşme konusu &uuml;r&uuml;n&uuml;n teslimatı i&ccedil;in işbu s&ouml;zleşmenin imzalı n&uuml;shasının İŞVEREN iletişim adresine ulaştırılmış olması ve bedelinin ALICI&#39;nın tercih ettiği &ouml;deme şekli ile &ouml;denmiş olması şarttır. Herhangi bir nedenle &uuml;r&uuml;n bedeli &ouml;denmez veya banka kayıtlarında iptal edilir ise, İŞVEREN &uuml;r&uuml;n&uuml;n teslimi y&uuml;k&uuml;ml&uuml;l&uuml;ğ&uuml;nden kurtulmuş kabul edilir.</p>\r\n\r\n<p>4.6- &Uuml;r&uuml;n&uuml;n tesliminden sonra ALICI&#39;ya ait kredi kartının ALICI&#39;nın kusurundan kaynaklanmayan bir şekilde yetkisiz kişilerce haksız veya hukuka aykırı olarak kullanılması nedeni ile ilgili banka veya finans kuruluşun &uuml;r&uuml;n bedelini İŞVEREN namına &ouml;dememesi halinde, ALICI&#39;nın kendisine teslim edilmiş olması kaydıyla &uuml;r&uuml;n&uuml;n 3 g&uuml;n i&ccedil;inde İŞVEREN iletişim adres(ler)ine g&ouml;nderilmesi zorunludur. Bu takdirde nakliye giderleri ALICI&#39;ya aittir.</p>\r\n\r\n<p>4.7- İŞVEREN m&uuml;cbir sebepler veya nakliyeyi engelleyen hava muhalefeti, ulaşımın kesilmesi gibi olağan&uuml;st&uuml; durumlar nedeni ile s&ouml;zleşme konusu &uuml;r&uuml;n&uuml; s&uuml;resi i&ccedil;inde teslim edemez ise, durumu ALICI&#39;ya bildirmekle y&uuml;k&uuml;ml&uuml;d&uuml;r. Bu takdirde ALICI siparişin iptal edilmesini, s&ouml;zleşme konusu &uuml;r&uuml;n&uuml;n varsa emsali ile değiştirilmesini, ve/veya teslimat s&uuml;resinin engelleyici durumun ortadan kalkmasına kadar ertelenmesi haklarından birini kullanabilir. ALICI&#39;nın siparişi iptal etmesi halinde &ouml;dediği tutar 10 g&uuml;n i&ccedil;inde kendisine nakden ve defaten &ouml;denir.</p>\r\n\r\n<p>4.8- Garanti belgesi ile satılan &uuml;r&uuml;nlerden olan veya olmayan &uuml;r&uuml;nlerin arızalı veya bozuk olanlar, garanti şartları i&ccedil;inde gerekli onarımın yapılması i&ccedil;in İŞVEREN iletişim adreslerine g&ouml;nderilebilir, bu takdirde kargo giderleri İŞVEREN tarafından karşılanacaktır.</p>\r\n\r\n<p>4.9- işbu s&ouml;zleşme, ALICI tarafından imzalanıp İŞVEREN iletişim kanallarını kullanarak faks veya posta yoluyla ulaştırılmasından sonra ge&ccedil;erlilik kazanır.</p>\r\n\r\n<p>Madde 5 - Cayma Hakkı</p>\r\n\r\n<p>ALICI, s&ouml;zleşme konusu &uuml;r&uuml;n&uuml;n kendisine veya g&ouml;sterdiği adresteki kişi/kuruluşa tesliminden itibaren (7) g&uuml;n i&ccedil;inde cayma hakkına sahiptir. Cayma hakkının kullanılması i&ccedil;in bu s&uuml;re i&ccedil;inde İŞVEREN iletişim kanallarına faks, e-mail veya telefon ile bildirimde bulunulması ve &uuml;r&uuml;n&uuml;n ilgili madde h&uuml;k&uuml;mleri &ccedil;er&ccedil;evesinde kullanılmamış olması şarttır. Bu hakkın kullanılması halinde, 3. kişiye veya ALICI&#39;ya teslim edilen &uuml;r&uuml;n&uuml;n {_firma_adi_} iletişim adreslerine g&ouml;nderildiğine ilişkin kargo teslim tutanağı &ouml;rneği ile fatura aslının iadesi zorunludur. Bu belgelerin ulaşmasını takip eden 7 g&uuml;n i&ccedil;inde &uuml;r&uuml;n bedeli ALICI&#39;ya iade edilir. Fatura aslı g&ouml;nderilmez ise KDV ve varsa sair yasal y&uuml;k&uuml;ml&uuml;l&uuml;kler iade edilemez. Cayma hakkı nedeni ile iade edilen &uuml;r&uuml;n&uuml;n kargo bedeli ALICI tarafından karşılanır. Ayrıca, t&uuml;keticinin &ouml;zel istek ve talepleri uyarınca &uuml;retilen veya &uuml;zerinde değişiklik ya da ilaveler yapılarak kişiye &ouml;zel hale getirilen mallarda t&uuml;ketici cayma hakkını kullanamaz.</p>\r\n\r\n<p>&Ouml;demenin kredi kartı veya benzeri bir &ouml;deme kartı ile yapılması halinde t&uuml;ketici, kartın kendi rızası dışında ve hukuka aykırı bi&ccedil;imde kullanıldığı gerek&ccedil;esiyle &ouml;deme işleminin iptal edilmesini talep edebilir. Bu halde, kartı &ccedil;ıkaran kuruluş itirazın kendisine bildirilmesinden itibaren 10 g&uuml;n i&ccedil;inde &ouml;deme tutarını t&uuml;keticiye iade eder.</p>\r\n\r\n<p>işbu s&ouml;zleşmenin uygulanmasın da, Sanayi ve Ticaret Bakanlığınca ilan edilen değere kadar T&uuml;ketici Hakem Heyetleri ile İŞVEREN yerleşim yerindeki T&uuml;ketici Mahkemeleri yetkilidir.</p>\r\n\r\n<p>Siparişin sonu&ccedil;lanması durumunda ALICI işbu s&ouml;zleşmenin t&uuml;m koşullarını kabul etmiş sayılacaktır.</p></div>\r\n', 1),
(5, 'hakkimizda', 'Hakkımızda', '<div class=\"row\">\r\n	<div class=\'col-lg-6\'>\r\n		<img src=\'images/hakkimizda1.gif\' style=\'width:80%;display:block;margin:5px auto\' />\r\n	</div>\r\n	<div class=\'col-lg-6\'>\r\n		<h1>Kurumsal</h1>\r\n		<h2>E-ticaret çözümleri hazırlıyoruz</h2>\r\n		<p>\r\nGelişen  teknoloji çağımızda Türkiye’nin e-ticaret yazılım sağlayıcısı görevini üstlenerek hizmet vermeye hız kesmeden devam ediyoruz.<br>Tecrübemiz; bilgili, değişime açık, kuvvetli takımlar ve güven ilkelerini barındırmaktadır.<br>E-ticaret alanında en büyük tercih olmak için çalışıyoruz.<br>Tüm hizmet aktivitemiz tek cümleyi esas almaktadır;<br> <i>\"Sınırlarınızı zorlayarak bulursunuz.\" – Herbert A. Simon</i><br>\r\n		</p>\r\n	</div>\r\n</div>\r\n<div class=\"row mt-6\">\r\n	<div class=\'col-lg-6\'>\r\n		<h1>Bizi tercih eden</h1>\r\n		<h2>Mutlu müşterilere sahibiz</h2>\r\n		<p>\r\nE-ticaret sektörüne atılmak ve bulunduğumuz sanal pazarda yerini büyütmek isteyen binlerce insan için ticaret hizmetini daha kârlı bir hâle getiriyoruz.<br>\r\nSiz merkezli çalışarak beklentilerinizi arşa çıkarıyor ve kaliteli e-ticaret çözümünüzü sağlıyoruz.<br>Mutlu müşterilere sahip olmamızın sebebi; hizmetinizi çözümlerken bizimde sizler kadar mutlu olmamızdır.\r\n		</p>\r\n	</div>\r\n	<div class=\'col-lg-6\'>\r\n		<img src=\'images/hakkimizda2.gif\' style=\'width:40%;display:block;margin:5px auto;\' />\r\n	</div>\r\n</div>\r\n<div class=\"row mt-6\">\r\n	<div class=\'col-lg-6\'>\r\n		<img src=\'images/hakkimizda3.gif\' style=\'width:70%;display:block;margin:5px auto\' />\r\n	</div>\r\n	<div class=\'col-lg-6\'>\r\n		<h1>E-ticaret eğitimi</h1>\r\n		<h2>Hizmetlerimizi kaçırmayın</h2>\r\n		<p>\r\nToplumumuz ile artık bir bütün olmuş teknoloji ve çözümleri için buradayız.<br>Eğitimin yeri ve yaşı yoktur.<br>Ücretsiz webinar ve seminerlerimizi websitemizden düzenli olarak takip edebilirsiniz.<br>Hizmetlerimiz e-ticaretin nasıl olması gerektiği ve lupusoft firmamızın tüm yayınlamış olduğu yazılımların nasıl kullanıldığı ile alakalıdır.\r\n		</p>\r\n	</div>\r\n</div>\r\n\r\n<div class=\"row mt-6\">\r\n	<div class=\'col-lg-6\'>\r\n		<h1>Neden</h1>\r\n		<h2>Lupusoft\'u tercih etmeliyim?</h2>\r\n		<p>\r\n<b><u>Basit</u> :</b> Detaylı ve bir o kadar kolay kullanışlı arayüzü ile pazar kitlenizle daha hızlı iletişime geçebilirsiniz.<br>\r\n<b><u>Güvenli</u> :</b> W3 standartlarında hazırlanan yazılımlarımız ile sorunsuz bir E-Ticaret pazaryeriniz olsun.<br>\r\n<b><u>SEO</u> :</b> Gelişmiş arama motoru optimizasyonu (SEO) sayesinde ürünleriniz aramalarda üst sıralarda çıkar.<br>\r\n<b><u>Kontrol elinizde</u> :</b> İstediğiniz zaman E-Ticaret sitenizin içeriklerini kolayca düzenleyebilirsiniz.\r\n		</p>\r\n	</div>\r\n	<div class=\'col-lg-6\'>\r\n		<img src=\'images/hakkimizda4.gif\' style=\'width:80%;display:block;margin:5px auto;\' />\r\n	</div>\r\n</div>\r\n<div class=\"col-lg-12 mt-6\" style=\'background:#f8fcfe!important;padding:20px;text-align:center;color:#333;\'>\r\n<h2>Lupusoft Kariyer</h2>\r\n<p style=\'color:#333;\'>Kariyerinde hızla büyümeyi hedefleyen, gelişmiş ve yenilikçi fikirlere sahip takım arkadaşlarımıza katılmak için yazılım, grafik tasarım, satış ve finans departmanımızdaki iş fırsatlarımıza göz atabilirsiniz. Staj ve iş başvurularınızı bu bölümden yapabilirsiniz. Sizi de aramızda görmekten büyük keyif duyarız. Birbirimize katacaklarımız için heyecanlıyız. Kariyer fırsatlarımız sizi bekliyor.</p><br>\r\n<a class=\"btn btn-primary\" href=\"index.php?sayfa=sayfa&icerik=iletisim\">Kariyer Fırsatları</a>\r\n</div>\r\n', 0),
(6, 'iletisim', 'İletişim', '<script src=\"js/jquery-3.2.1.min.js\"></script>\r\n<script type=\"text/javascript\">\r\n$(document).ready(function(){\r\n   $.ajax({\r\n      url:\'iletisim.php?data=yazi\',\r\n      type:\'GET\',\r\n      success:function(result){\r\n					 \r\n      $(\'.yazi\').html(result);\r\n      }\r\n   });\r\n    $.ajax({\r\n      url:\'iletisim.php?data=iframe\',\r\n      type:\'GET\',\r\n      success:function(result){\r\n					 \r\n      $(\'.iframe\').attr(\"src\",result);\r\n      }\r\n   });\r\n    $.ajax({\r\n      url:\'iletisim.php?data=tel\',\r\n      type:\'GET\',\r\n      success:function(result){\r\n					 \r\n      $(\'.tel\').html(result);\r\n      }\r\n   });\r\n    $.ajax({\r\n      url:\'iletisim.php?data=adres\',\r\n      type:\'GET\',\r\n      success:function(result){\r\n					 \r\n      $(\'.adres\').html(result);\r\n      }\r\n   });\r\n    $.ajax({\r\n      url:\'iletisim.php?data=eposta\',\r\n      type:\'GET\',\r\n      success:function(result){\r\n					 \r\n      $(\'.epost\').html(result);\r\n      }\r\n   });\r\n});\r\n</script>\r\n<style type=\"text/css\">\r\n\r\n  .overlay {\r\n\r\n    background: #fff;\r\n\r\n    width: 100%;\r\n\r\n    height: 100%;\r\n\r\n    z-index: 1;\r\n\r\n    position: relative;\r\n\r\n    padding: 0 0 110px 0;\r\n\r\n}\r\n\r\n.section-bg {\r\n\r\n    background-size: cover;\r\n\r\n    position: relative;\r\n\r\n    background-position: left;\r\n\r\n    z-index: 0;\r\n\r\n    padding: 0;\r\n\r\n    min-height: auto;\r\n\r\n    overflow: hidden;\r\n\r\n}\r\n\r\n.contact-form {\r\n\r\n    position: relative;\r\n\r\n    padding: 45px 0 45px 60px;\r\n\r\n}\r\n\r\n\r\n\r\n.contact-form:before {\r\n\r\n    position: absolute;\r\n\r\n    content: \'\';\r\n\r\n    top: 0;\r\n\r\n    right: 0;\r\n\r\n    bottom: 0;\r\n\r\n    left: 0;\r\n\r\n    border-radius: 6px;\r\n\r\n    background: #EFDA;\r\n\r\n    box-shadow: 10px 40px 40px rgba(0,0,0,.2);\r\n\r\n    pointer-events: none;\r\n\r\n    right: auto;\r\n\r\n    width: 100vw;\r\n\r\n}\r\n\r\n.particles-js-canvas-el {\r\n\r\n    position: absolute;\r\n\r\n    left: 0;\r\n\r\n    top: 0;\r\n\r\n    z-index: 1;\r\n\r\n}\r\n\r\n.contact-form input {\r\n\r\n    border: 0;\r\n\r\n    background: transparent;\r\n\r\n\r\n\r\n    display: block;\r\n\r\n    width: 100%;\r\n\r\n    min-height: 50px;\r\n\r\n    padding: 11px 0;\r\n\r\n    font-size: 16px;\r\n\r\n    font-weight: 600;\r\n\r\n    line-height: 27px;\r\n\r\n\r\n\r\n    background-color: transparent;\r\n\r\n    background-image: none;\r\n\r\n    border-radius: 0;\r\n\r\n    -webkit-appearance: none;\r\n\r\n    transition: .3s ease-in-out;\r\n\r\n    border: 2px solid transparent;\r\n\r\n    border-bottom-color: rgba(0,0,0,.1);\r\n\r\n}\r\n\r\n\r\n\r\n.contact-form textarea {\r\n\r\n    border: 0;\r\n\r\n    background: transparent;\r\n\r\n    display: block;\r\n\r\n    width: 100%;\r\n\r\n    min-height: 50px;\r\n\r\n    padding: 11px 0;\r\n\r\n    font-size: 16px;\r\n\r\n    font-weight: 600;\r\n\r\n    line-height: 27px;\r\n\r\n\r\n\r\n    background-color: transparent;\r\n\r\n    background-image: none;\r\n\r\n    border-radius: 0;\r\n\r\n    -webkit-appearance: none;\r\n\r\n    transition: .3s ease-in-out;\r\n\r\n    border: 2px solid transparent;\r\n\r\n    border-bottom-color: rgba(0,0,0,.1);\r\n\r\n}\r\n\r\n.contact-form input::placeholder {\r\n\r\n  color:#222;\r\n\r\n}\r\n\r\n.contact-form textarea::placeholder {\r\n\r\n  color:#222;\r\n\r\n\r\n\r\n}\r\n\r\n.contact-form input {\r\n\r\n    margin-bottom: 30px;\r\n\r\n    font-size: 16px;\r\n\r\n    font-weight: 600;\r\n\r\n    height: 55px;\r\n\r\n}\r\n\r\n.contact-form input:hover, .contact-form input:focus{\r\n\r\n    outline: none;\r\n\r\n    box-shadow: none;\r\n\r\n    background: transparent;\r\n\r\n    border: 2px solid transparent;\r\n\r\n    border-bottom-color: rgb(254, 132, 111);\r\n\r\n\r\n\r\n}\r\n\r\n.contact-form textarea:hover, .contact-form textarea:focus{\r\n\r\n  background: transparent; \r\n\r\n    outline: none;\r\n\r\n  box-shadow: none;\r\n\r\n     border: 2px solid transparent;\r\n\r\n    border-bottom-color: rgb(254, 132, 111);\r\n\r\n\r\n\r\n}\r\n\r\n\r\n\r\n\r\n\r\n.taso-btn {\r\n\r\n    background-color: #fff;\r\n\r\n    margin: 25px 0;\r\n\r\n    color: #214dcb;\r\n\r\n    -webkit-box-shadow: 0px 10px 30px 0px rgba(255, 255, 255, 0.32);\r\n\r\n    box-shadow: 0px 10px 30px 0px rgba(255, 255, 255, 0.17);\r\n\r\n}\r\n\r\n.contact-info {\r\n\r\n    padding: 0 30px 0px 0;\r\n\r\n}\r\n\r\n\r\n\r\nh2.contact-title {\r\n\r\n    font-size: 35px;\r\n\r\n    font-weight: 600;\r\n\r\n    color: #222;\r\n\r\n    margin-bottom: 30px;\r\n\r\n}\r\n\r\n\r\n\r\n.contact-info p {\r\n\r\n    color: #222;\r\n\r\n}\r\n\r\n\r\n\r\nul.contact-info {\r\n\r\n    margin-top: 30px;\r\n\r\n}\r\n\r\n\r\n\r\nul.contact-info li {\r\n\r\n    margin-bottom: 22px;\r\n\r\n}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nul.contact-info span {\r\n\r\n    font-size: 20px;\r\n\r\n    line-height: 26px;\r\n\r\n}\r\n\r\nul.contact-info li {\r\n\r\n    display: flex;\r\n\r\n    width: 100%;\r\n\r\n}\r\n\r\n\r\n\r\n.info-left {\r\n\r\n    width: 10%;\r\n\r\n}\r\n\r\n\r\n\r\n.info-left i {\r\n\r\n    width: 30px;\r\n\r\n    height: 30px;\r\n\r\n    line-height: 30px;\r\n\r\n    font-size: 30px;\r\n\r\n    color: #333;\r\n\r\n}\r\n\r\n\r\n\r\n.info-right h4 {\r\n\r\n    color: #444;\r\n\r\n    font-size: 18px;\r\n\r\n}\r\n\r\n.contact-page .info-left i{\r\n\r\ncolor: #FE846F;\r\n\r\n}\r\n\r\n.btn {\r\n\r\ndisplay: inline-block;\r\n\r\n    font-weight: 400;\r\n\r\n    text-align: center;\r\n\r\n    white-space: nowrap;\r\n\r\n    vertical-align: middle;\r\n\r\n    -webkit-user-select: none;\r\n\r\n    -moz-user-select: none;\r\n\r\n    -ms-user-select: none;\r\n\r\n    user-select: none;\r\n\r\n    font-family: \'Poppins\', sans-serif;\r\n\r\n    padding: 10px 30px 10px;\r\n\r\n    font-size: 17px;\r\n\r\n    line-height: 28px;\r\n\r\n    border: 0px;\r\n\r\n    border-radius: 10px;\r\n\r\n    -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;\r\n\r\n    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;\r\n\r\n    -o-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\r\n\r\n    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\r\n\r\n    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;\r\n\r\n}\r\n\r\n.btn-big {\r\n\r\n    color: #ffffff;\r\n\r\n    -webkit-box-shadow: 0px 5px 20px 0px rgba(45, 45, 45, 0.47843137254901963);\r\n\r\n    box-shadow: 2px 5px 10px 0px rgba(45, 45, 45, 0.19);\r\n\r\n    color: #fff !important;\r\n\r\n    margin-right: 20px;\r\n\r\n    background: #FE846F;\r\n\r\n    transition: .2s;\r\n\r\n    border: 2px solid #FE846F;\r\n\r\n    margin-top: 50px;\r\n\r\n}\r\n\r\n\r\n\r\n@media only screen and (max-width: 767px) {\r\n\r\n.contact-form {\r\n\r\n    padding: 30px;\r\n\r\n}\r\n\r\n.contact-form:before {\r\n\r\n    width: 100%;\r\n\r\n}\r\n\r\n\r\n\r\n}\r\n\r\n</style>\r\n\r\n<section class=\"section-bg\" data-scroll-index=\"7\">\r\n\r\n          <div class=\"overlay\">\r\n\r\n            <div class=\"container\">\r\n\r\n               <div class=\"row\">\r\n\r\n                    <div class=\"col-lg-12 pb-100\"><iframe src=\"\" class=\"iframe\" width=\"100%\" height=\"300\" frameborder=\"0\" style=\"border:0;width:100%;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe></div>\r\n\r\n                    <div class=\"col-lg-6 d-flex align-items-center\">\r\n\r\n                        <div class=\"contact-info\">\r\n\r\n\r\n\r\n                            <h2 class=\"contact-title\">Bize sorularınız mı var?</h2>\r\n\r\n                            <p><span class=\"yazi\"></span><br><small>* zorunlu alanlar</small></p>\r\n\r\n                            <ul class=\"contact-info\">\r\n\r\n                                <li>\r\n\r\n                                  <div class=\"info-left\">\r\n\r\n                                    <big><big>&#x1F4DE;</big></big>\r\n\r\n                                  </div>\r\n\r\n                                  <div class=\"info-right\">\r\n\r\n                                      <h4 class=\"tel\"></h4>\r\n\r\n                                  </div>\r\n\r\n                                </li>\r\n\r\n                                <li>\r\n\r\n                                  <div class=\"info-left\">\r\n\r\n                                    <big><big>&#x1F4E9;</big></big>\r\n\r\n                                  </div>\r\n\r\n                                  <div class=\"info-right\">\r\n\r\n                                      <h4 class=\"epost\"></h4>\r\n\r\n                                  </div>\r\n\r\n                                </li>\r\n\r\n                                <li>\r\n\r\n                                  <div class=\"info-left\">\r\n\r\n                                    <big><big>&#x1F3E0;</big></big>\r\n\r\n                                  </div>\r\n\r\n                                  <div class=\"info-right\">\r\n\r\n                                      <h4 class=\"adres\"></h4>\r\n\r\n                                  </div>\r\n\r\n                                </li>\r\n\r\n                            </ul>\r\n\r\n                        </div>\r\n\r\n                    </div>\r\n\r\n                    <div class=\"col-lg-6 d-flex align-items-center\">\r\n\r\n                            <div class=\"contact-form\">\r\n\r\n                                        <!--Contact Form-->\r\n\r\n                                        <form id=\'contact-form\' method=\'POST\' action=\'iletisim.php\'><input type=\'hidden\' name=\'form-name\' value=\'contactForm\' />\r\n\r\n                                            <div class=\"row\">\r\n\r\n                                               <div class=\"col-md-12\">\r\n\r\n                                                  <div class=\"form-group\">\r\n\r\n                                                     <input type=\"text\" name=\"isim\" class=\"form-control\" id=\"first-name\" placeholder=\"İsiminizi girin *\" required=\"required\">\r\n\r\n                                                  </div>\r\n\r\n                                               </div>\r\n\r\n                                               <div class=\"col-md-12\">\r\n\r\n                                                  <div class=\"form-group\">\r\n\r\n                                                     <input type=\"email\" name=\"eposta\" class=\"form-control\" id=\"email\" placeholder=\"E-posta adresinizi girin *\" required=\"required\">\r\n\r\n                                                  </div>\r\n\r\n                                               </div>\r\n\r\n\r\n\r\n                                               <div class=\"col-md-12\">\r\n\r\n                                                  <div class=\"form-group\">\r\n\r\n                                                       <textarea rows=\"4\" name=\"mesaj\" class=\"form-control\" id=\"description\" placeholder=\"Mesajınızı girin*\" required=\"required\"></textarea>\r\n\r\n                                                  </div>\r\n\r\n                                               </div>\r\n\r\n                                                <div class=\"col-md-12\">\r\n\r\n                                                    <!--contact button--><button  class=\"btn-big btn btn-bg\">Gönder &#x21B2;</button>\r\n\r\n                                                </div>\r\n\r\n                                            </div>\r\n\r\n                                        </form>\r\n\r\n                                    </div>\r\n\r\n                    </div>\r\n\r\n               </div>\r\n\r\n           </div>\r\n\r\n              </div>\r\n\r\n        </section>', 0);
INSERT INTO `sayfalar` (`id`, `kod`, `baslik`, `icerik`, `footeracik`) VALUES
(7, 's-s-s', 'Sıkça Sorulan Sorular', '<style type=\"text/css\">\r\n\r\n.panel-heading .accordion-toggle:after {\r\n\r\n    /* symbol for \"opening\" panels */\r\n\r\n    font-family: \'Glyphicons Halflings\';  /* essential for enabling glyphicon */\r\n\r\n    content: \"\\e114\";    /* adjust as needed, taken from bootstrap.css */\r\n\r\n    float: right;        /* adjust as needed */\r\n\r\n    color: grey;         /* adjust as needed */\r\n\r\n}\r\n\r\n.panel-heading .accordion-toggle.collapsed:after {\r\n\r\n    /* symbol for \"collapsed\" panels */\r\n\r\n    content: \"\\e080\";    /* adjust as needed, taken from bootstrap.css */\r\n\r\n}\r\n\r\n.arama-input{\r\n\r\nwidth:100%;margin:25px;font-size:22px;padding:10px;\r\n\r\n}\r\n\r\n</style>\r\n\r\n<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css\">\r\n\r\n<input type=\"text\" id=\"txtbxArama\" placeholder=\"Bana soru sor\" class=\"arama-input\">\r\n\r\n<div class = \"container\">\r\n\r\n  <div class=\"panel-group\" id=\"accordion\">\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\">\r\n\r\n          Ürünü nasıl değiştirebilirim?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseOne\" class=\"panel-collapse collapse in\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Siparişlerim menüsündeki Mevcut Siparişinizin detaylarından İade Talebi Oluştur butonuna basın. <br>\r\n\r\n\r\n\r\nİade talebi oluşturup iade talebinizin onaylanması ardından ürünü iade kodu ile birlikte ilgili birime teslim edin. <br>\r\n\r\n\r\n\r\nİade talebi onaylandıktan sonra 3 iş günü içerisinde ürünü ilgili birime teslim ederek destek birimine iletiniz. Destek birimleriyle iletişime geçilmediği takdirde değişim talebi iptal edilir. (İade kodu ile yapılan iade işlemlerinde ürün ilgili birime teslim edildikten sonra iade kodu sisteme otomatik olarak yansır.)<br><br>\r\n\r\n\r\n\r\nİade talebi oluşturulduktan sonra mağazanın talebin incelenme süresi 3 iş günü + 24 saattir. <br>\r\n\r\n\r\n\r\nMağaza, iade sürecinin tamamlandığını onaylayıp sisteme yeni ürünü kargoya verir.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwo\">\r\n\r\n          İade talep etmiştim ama vazgeçtim. Ne yapmalıyım?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseTwo\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       İade talebinizin oluşturduktan sonraki süreçte mağaza talebi onaylanmadığı sürece iade talebinizi Hesabım(Profil) sayfasına girerek sol alttan iade taleplerim sekmesinden iptal edebilirsiniz.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseThree\">\r\n\r\n          Kupon kodu nedir? Nasıl elde edilir?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseThree\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Mağaza tarafından dağıtılan birnevi indirim kodlarıdır. Sepet ekranında ilgili yere girilerek kuponun % tutarı kadar indirim sağlanabilir.<br><br>Kupon kodu mağaza tarafından müşterilere dağıtılmaktadır. Kuponlar kayıt olduğunuz e-posta adresiniz ile tarafınıza paylaşılır. Her kodun 1 kullanımlık ömrü vardır bu yüzden kupon kodunuzu kimse ile paylaşmayınız.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseFour\">\r\n\r\n          Müşteri Hizmetlerine Nasıl Ulaşabilirim?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseFour\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Müşteri hizmetlerimize (Canlı destek) 7/24 hesabım(Profil) sayfasındaki <i>\"Bilet oluştur\"</i> bağlantısından ya da mesai saatleri arasında telefon numaramızdan ulaşabilirsiniz. \r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseFive\">\r\n\r\n          Fatura adresini ve fatura bilgisini nasıl ekleyeceğim?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseFive\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Sipariş verdiğiniz sırada girdiğiniz [<i>\"Varsa Şirket İsmi\"</i>] bölümüne faturanız kesilmektedir.<br> Eğer şirket ismi girmezseniz faturanız bireysel olarak adınıza kesilir.<br>Sipariş vermeden önce Hesabım(Profil) sayfasından Adres defterim penceresini açıp  yeni adres ekleyebilir veya kayıtlı adresleriniz arasından siparişin hangi adrese geleceğine dair seçim yapabilirsiniz. \r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseSix\">\r\n\r\n          Hileli alışveriş nedir?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseSix\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Adil ve güvenli alışveriş ortamı oluşturmak için aşağıda belirtilen hileli işlemler kesinlikle yasaktır:\r\n\r\n       <ul>\r\n\r\n<li>- Hileli yollarla kredi kartı kullanma </li>\r\n\r\n<li>- Site üzerinde her türlü kredi kartı sahtecilik ve kopyalama işlemlerinin yapılmaması için, mümkün olan tüm önlemler alınır. Bu yönde girişimde bulunanların tespiti halinde, haklarında gerekli her türlü hukuki ve cezai işlem başlatılacaktır. </li>\r\n\r\n<li>- Kupon ve promosyonlar ile dolandırıcılık </li>\r\n\r\n<li>- Diğer üyelere zarar verebilecek kupon kullanımı veya promosyonlu ihaleler yasaktır.</li>\r\n\r\n</ul>\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseSeven\">\r\n\r\n          Ürünlerin orijinalliği ve garanti durumu hakkında bilgi alabilir miyim?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseSeven\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Siteden satın aldığınız ürünler, marka firmalarının garantisi kapsamında ve sorumluluğundadır. Garanti belgesinde yer alan irtibat numarasından firmayla irtibata geçerek garanti durumunu sorgulatabilirsiniz. <br>\r\n\r\n      Sahte ve taklit ürünlerin satışını engellemek adına fikri mülkiyet ve telif hakları konusunda markalara %100 destek veririz.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseEight\">\r\n\r\n          Siparişim neden reddedildi?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseEight\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Talep ettiğiniz ürünü; ürün arama sayfasından aratarak farklı, varyant ürünleri tercih edebilirsiniz. Ücret iadesi, bankanızın süreç ve uygulamalarına bağlı olarak ortalama 3 gün içerisinde kartınıza artı bakiye olarak yansıyacaktır.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseNine\">\r\n\r\n          Nasıl ürün satın alırım?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseNine\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       <img src=\"images/surec.gif\" style=\"width:250px;display:inline-block;vertical-align:middle;margin:10px auto;\"><p style=\"display:inline-block;vertical-align:middle;margin:10px auto; width:70%;\">-İstediğiniz ürüne ulaşmak için, anahtar kelimeleri yazarak arama yapın ya da ana kategoriden ilgili alt kategoriye doğru ilerleyerek ürün çeşitlerine göz atabilirsiniz.<br>\r\n\r\n       -Ürün sayfasından ürün özelliklerini, aynı kategorinin diğer ürünlerini, taksit seçeneklerini ve ürün yorumlarını görebilirsiniz.<br>\r\n\r\n       -Ürün sayfasındaki sepete ekle butonuna tıklayıp ürünü alışveriş sepetinize ekleyin.<br>\r\n\r\n       -Ödeme yapacağınız ürünleri sepete ekledikten sonra \"Siparişi Tamamla\" butonuna tıklayın.<br>\r\n\r\n       -Ürünlerin ve faturanızın kargolanmasını istediğiniz adresi seçin veya sisteme yeni bir adres tanımlayın.<br>\r\n\r\n       -İstediğiniz ödeme seçeneklerinden birini seçerek ödeme yapabilirsiniz. Ayrıca alışverişlerinizde iyzi Ödeme ve Elektronik Para Hizmetleri A.Ş. (iyzico) uygun kart bonuslarını da kullanabilirsiniz.</p>\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTen\">\r\n\r\n          TC kimlik numarası yazılması neden zorunludur?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseTen\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Ürünlerin faturasının adınıza kesilmesi ve teslimatın doğru kişiye yapılması için alıcıların alışverişlerinde TC kimlik numarası yazması zorunludur.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseEleven\">\r\n\r\n          Siparişim ne zaman gelir?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseEleven\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Satın aldığınız ürünler sepet sayfasında seçimini yapmış olduğunuz teslimat\'ın belirtilen tarihleri aralığında teslim edilir. Satın aldığınız ürünlerin teslimat tarihine \'Hesabım\' bölümünde \'Siparişlerim\' sayfasından da ulaşabilirsiniz.<br>\r\n\r\n       <i>\"Kendim teslim alacağım\"</i> ibaresi seçildiğinde ürün teslimata hazır hale getirilir ve müşteriye haber verilir.<br>\r\n\r\n       Sipariş teslimata çıktığında teslimat birimi tarafından bilgilendirilirsiniz.<br>\r\n\r\n       Teslimat birimine verildikten sonra siparişinizin teslimat bilgilerine \'Hesabım\' bölümünde \'Siparişlerim\' sekmesinde bulunan siparişinizin detayından takip edebilirsiniz.<br>\r\n\r\n       Siparişleriniz ilgili teslimat birimi tarafından Cumartesi, Pazar ve Resmi tatiller hariç 09:00 - 18:00 arasında sistemde tanımladığınız teslimat adresine ulaştırılmaktadır.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwelve\">\r\n\r\n          Şifremi unuttum, nasıl giriş yapabilirim?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseTwelve\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Şifrenizi unuttuysanız eğer, şifre sıfırlama işlemi yaparak hesabınıza giriş yapabilirsiniz.<br><br>\r\n\r\n       Bunun için takip edeceğiniz adımlar;<br>\r\n\r\n       \'Üye Girişi\' sayfasından \'Şifremi unuttum\' yazısına tıklayın. Üyeliğinize ait e-posta adresinizi girerek \'Gönder\' dediğinizde ilgili e-posta adresinize bir link gelecek.<br>\r\n\r\n       Gelen linke tıklayarak yeni şifre oluşturma işleminizi yapabilirsiniz.<br>\r\n\r\n       Eğer link size ulaşmadı ise spam klasörünüzü kontrol edin.<br>\r\n\r\n       Ayrıca dilediğiniz zaman <i>\"Profil>Hesap Ayarları>Bilgilerimi Güncelle\"</i> adımlarını takip ederek şifre değişiklik işleminizi yapabilirsiniz.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseThreeteen\">\r\n\r\n          Nasıl üye olurum?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseThreeteen\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Sayfanın sağ üstünden yer alan <i>\"Profil>Üye Ol\"</i> alanından kullandığınız aktif bir e-posta adresi girerek oluşturacağınız şifre ile üyeliğinizi tamamlayabilirsiniz.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseFourteen\">\r\n\r\n          Üye olmadan sipariş verebilir miyim?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseFourteen\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       Maalesef üye olmadan sipariş vermeniz söz konusu değildir. Bu yüzden alışverişinize üye girişi yaparak veya yeni üyelik kaydı oluşturarak devam etmeniz yeterli. Siparişlerinize ait bilgilere erişebilmek için üye olmak zorunludur.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseFifteen\">\r\n\r\n          Satın aldığım ürünü iptal/iade ettikten sonra kullandığım indirim kuponum/kodum hesabıma tekrar yüklenir mi?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseFifteen\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       • Mağazanın tanımladığı indirim kuponları iptal/iade işlemi sonrasında hesabınıza yeniden <u>tanımlanmaz.</u><br>\r\n\r\n       • Kullanılan kodlar tek kullanımlık olup yeniden tanımlanamaz.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseSixteen\">\r\n\r\n          E-bülten almak istemiyorum. Ne yapmam gerekiyor?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseSixteen\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n       • Ana sayfada sağ üst köşeden profil sayfasına girin.<br>\r\n\r\n       • <i>“Hesap Ayarları>Bilgilerimi Güncelle“</i> alanından e-bülten tercihlerinizi değiştirin.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseSeventeen\">\r\n\r\n          Kapıda ödeme seçeneğiniz var mı?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseSeventeen\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n        Kapıda ödeme seçeneği opsiyoneldir. Mağazanın ödeme tercihleri arasında yer alıyor ise kapıda nakit, kapıda kredi kartı, havale, kredi kartı ve banka kartı yöntemleri ile sipariş oluşturma aşamasında ödeme yapabilirsiniz.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseEighteen\">\r\n\r\n          Siparişim nerede?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseEighteen\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n\r\n        Siparişinizin anlık lokasyonu mağazaya opsiyonel tanımlıdır. Mağaza dilerse bunu müşteriyle paylaşabilir.  Mağaza lokasyonu paylaşıma açmış ise sipariş detayınızda yer alan bilgilendirme panelinden tarafınıza paylaşılan bağlantıya tıklayarak siparişinizin nerede olduğunu öğrenebilirsiniz.\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n  <div class=\"panel panel-default\">\r\n\r\n    <div class=\"panel-heading\">\r\n\r\n      <h4 class=\"panel-title\">\r\n\r\n        <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseNineteen\">\r\n\r\n          Siparişimi kapıda ödeme işlemi olarak verdim fakat ürün geldiğinde kredi kartı ile ödeyebilir miyim?\r\n\r\n        </a>\r\n\r\n      </h4>\r\n\r\n    </div>\r\n\r\n    <div id=\"collapseNineteen\" class=\"panel-collapse collapse\">\r\n\r\n      <div class=\"panel-body\">\r\n        Teslimat birimiyle irtibata geçerek yanlarında post cihazının getirilmesi hatırlatıldıktan sonra kredi kartınız ile tek çekim olarak işleminiz gerçekleştirebilirsiniz.\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </div>\r\n\r\n</div>\r\n\r\n</div> <!-- end container -->\r\n\r\n\r\n\r\n<!-- Latest compiled and minified JavaScript -->\r\n\r\n<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js\"></script>\r\n\r\n<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js\"></script>\r\n\r\n<script type=\"text/javascript\">\r\n\r\n$(\"#txtbxArama\").keyup(function(){\r\n\r\n        aramaFonk(\"txtbxArama\",\"accordion\");\r\n\r\n    });\r\n\r\nfunction aramaFonk(inputId,ulId) {\r\n\r\n    var input, filter, ul, li, a, i, txtValue;\r\n\r\n    input = document.getElementById(inputId);\r\n\r\n    filter = input.value.toUpperCase();\r\n\r\n    ul = document.getElementById(ulId);\r\n\r\n  li = ul.getElementsByClassName(\"panel\");\r\n\r\n    for (i = 0; i < li.length; i++) {\r\n\r\n      //a = li[i].getElementsByTagName(\"li\")[0];\r\n\r\n      txtValue = li[i].textContent || li[i].innerText;\r\n\r\n      if (txtValue.toUpperCase().indexOf(filter) > -1) {\r\n\r\n        li[i].style.display = \"\";\r\n\r\n      } else {\r\n\r\n        li[i].style.display = \"none\";\r\n\r\n      }\r\n\r\n  }\r\n\r\n}\r\n\r\n</script>', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

DROP TABLE IF EXISTS `sepet`;
CREATE TABLE IF NOT EXISTS `sepet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun` int(11) NOT NULL,
  `miktar` int(11) NOT NULL,
  `sahip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=385 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepetvaryasyon`
--

DROP TABLE IF EXISTS `sepetvaryasyon`;
CREATE TABLE IF NOT EXISTS `sepetvaryasyon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varyasyon` int(11) NOT NULL,
  `varyasyondeger` int(11) NOT NULL,
  `sahipsepet` int(11) NOT NULL,
  `urun` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=739 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

DROP TABLE IF EXISTS `siparis`;
CREATE TABLE IF NOT EXISTS `siparis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sahip` int(11) NOT NULL,
  `adsoyad` varchar(120) COLLATE utf8_turkish_ci NOT NULL,
  `tckn` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `sirket` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `ililce` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `tutar` float NOT NULL,
  `ipvetarih` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL,
  `siptakipno` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sipnot` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `odemeTipi` int(11) NOT NULL,
  `havaleisebanka` int(11) NOT NULL,
  `teslimat` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`id`, `sahip`, `adsoyad`, `tckn`, `telefon`, `sirket`, `adres`, `eposta`, `ililce`, `tutar`, `ipvetarih`, `durum`, `siptakipno`, `sipnot`, `odemeTipi`, `havaleisebanka`, `teslimat`) VALUES
(99, 1, 'Burak Palic', '11111111111', '535 025 23 54', 'Lupusoft Yazılım ve Donanım Hizmetleri', 'Cumhuriyet mh. Orta sk. No : 9C, Daire : 7', 'info@lupusoft.com', 'TEKİRDAĞ/ŞARKÖY', 3610, '13.01.2022 | ::1', 1, 'SIP165561E08AD28488B', 'yok', 3, 0, 'Hızlı Kargo(1-3 iş günü) 10₺'),
(98, 1, 'Burak Palic', '11111111111', '535 025 23 54', 'Lupusoft Yazılım ve Donanım Hizmetleri', 'Cumhuriyet mh. Orta sk. No : 9C, Daire : 7', 'info@lupusoft.com', 'TEKİRDAĞ/ŞARKÖY', 710, '13.01.2022 | ::1', 1, 'SIP183661E08AA842DF4', '', 1, 0, 'Hızlı Kargo(1-3 iş günü) 10₺'),
(96, 1, 'Burak  Paliç', '11111111111', '535 025 23 54', 'test sirket', 'Cumhuriyet mh. Orta sk. No : 9C, Daire : 7', 'info@lupusoft.com', 'TEKİRDAĞ/ŞARKÖY', 1210, '11.10.2021 | ::1', 4, 'SIP13466165E2DF0FC50', 'test', 1, 0, 'Kendim Teslim Alacağım 0 ₺'),
(97, 1, 'Burak  Paliç', '11111111111', '535 025 23 54', 'Lupusoft Yazılım ve Donanım Hizmetleri test', 'Cumhuriyet mh. Orta sk. No : 9C, Daire : 7', 'info@lupusoft.com', 'TEKİRDAĞ/ŞARKÖY', 3760, '13.10.2021 | ::1', 3, 'SIP13461672703EF4C5', '', 2, 1, 'Hızlı Kargo(1-3 iş günü) 10₺');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisdurum`
--

DROP TABLE IF EXISTS `siparisdurum`;
CREATE TABLE IF NOT EXISTS `siparisdurum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `durum` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparisdurum`
--

INSERT INTO `siparisdurum` (`id`, `durum`) VALUES
(1, 'Sipariş alındı'),
(2, 'Paketleniyor'),
(3, 'Kargoya verildi'),
(4, 'Teslim edildi'),
(5, 'Silindi'),
(6, 'İptal Edildi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparislistesi`
--

DROP TABLE IF EXISTS `siparislistesi`;
CREATE TABLE IF NOT EXISTS `siparislistesi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun` int(11) NOT NULL,
  `miktar` int(11) NOT NULL,
  `siparis` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparislistesi`
--

INSERT INTO `siparislistesi` (`id`, `urun`, `miktar`, `siparis`) VALUES
(59, 99, 3, 99),
(58, 99, 1, 98),
(57, 99, 2, 97),
(56, 99, 1, 97),
(55, 99, 1, 96);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siplistevaryasyon`
--

DROP TABLE IF EXISTS `siplistevaryasyon`;
CREATE TABLE IF NOT EXISTS `siplistevaryasyon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varyasyon` int(11) NOT NULL,
  `varyasyondeger` int(11) NOT NULL,
  `sahipsipliste` int(11) NOT NULL,
  `urun` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=715 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siplistevaryasyon`
--

INSERT INTO `siplistevaryasyon` (`id`, `varyasyon`, `varyasyondeger`, `sahipsipliste`, `urun`) VALUES
(714, 28, 115, 59, 99),
(713, 28, 114, 58, 99),
(712, 28, 116, 57, 99),
(711, 29, 118, 57, 99),
(710, 28, 114, 56, 99),
(709, 28, 115, 55, 99);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyal`
--

DROP TABLE IF EXISTS `sosyal`;
CREATE TABLE IF NOT EXISTS `sosyal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `sosyalmedya` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sosyal`
--

INSERT INTO `sosyal` (`id`, `link`, `sosyalmedya`) VALUES
(1, 'https://facebook.com/lupusoft', 2),
(2, 'https://twitter.com/lupusoft', 3),
(3, 'https://instagram.com/lupusoft', 1),
(5, 'https://tr.linkedin.com/in/lupusoft-yazılım-ve-donanım-hizmetleri-8a19041bb', 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyalmedyalar`
--

DROP TABLE IF EXISTS `sosyalmedyalar`;
CREATE TABLE IF NOT EXISTS `sosyalmedyalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sosyalmedyalar`
--

INSERT INTO `sosyalmedyalar` (`id`, `isim`) VALUES
(1, 'instagram'),
(2, 'facebook'),
(3, 'twitter'),
(4, 'youtube'),
(5, 'pinterest'),
(6, 'tumblr'),
(7, 'whatsapp'),
(8, 'telegram'),
(9, 'envelope'),
(10, 'linkedin'),
(12, 'app-store');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teslimat`
--

DROP TABLE IF EXISTS `teslimat`;
CREATE TABLE IF NOT EXISTS `teslimat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(80) COLLATE utf8_turkish_ci NOT NULL,
  `tutar` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `teslimat`
--

INSERT INTO `teslimat` (`id`, `isim`, `tutar`, `durum`) VALUES
(1, 'Hızlı Kargo(1-3 iş günü)', 10, 1),
(2, 'Normal Kargo(5-7 iş günü)', 5, 1),
(3, 'Kendim Teslim Alacağım', 0, 1),
(4, 'Acele Kargo (Aynı Gün)', 20, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barkod` varchar(13) COLLATE utf8_turkish_ci DEFAULT NULL,
  `isim` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `fiyat` float NOT NULL,
  `kategori` int(11) NOT NULL,
  `vitrin` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `goruntuleme` int(11) NOT NULL,
  `etiketler` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `minimumalis` int(11) NOT NULL,
  `maksimumalis` int(11) NOT NULL,
  `birim` int(11) NOT NULL,
  `marka` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `barkod`, `isim`, `aciklama`, `fiyat`, `kategori`, `vitrin`, `stok`, `goruntuleme`, `etiketler`, `minimumalis`, `maksimumalis`, `birim`, `marka`) VALUES
(99, '&nbsp;', 'E-Ticaret Paketlerimiz', '', 690, 16, 1, 997, 78, '', 1, 999, 1, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

DROP TABLE IF EXISTS `uyeler`;
CREATE TABLE IF NOT EXISTS `uyeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `sirket` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `sehir` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `semt` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `postakodu` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(64) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `adsoyad`, `sirket`, `adres`, `sehir`, `semt`, `postakodu`, `telefon`, `eposta`, `sifre`) VALUES
(1, 'Burak Palic', 'Lupusoft Yazılım ve Donanım Hizmetleri', 'Cumhuriyet mh. Orta sk. No : 9C, Daire : 7', 'TEKİRDAĞ', 'ŞARKÖY', '59150', '535 025 23 54', 'info@lupusoft.com', '4297f44b13955235245b2497399d7a93');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `varyasyon`
--

DROP TABLE IF EXISTS `varyasyon`;
CREATE TABLE IF NOT EXISTS `varyasyon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varyasyonadi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `urunid` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `varyasyon`
--

INSERT INTO `varyasyon` (`id`, `varyasyonadi`, `urunid`, `durum`) VALUES
(28, 'Paket', 99, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `varyasyondeger`
--

DROP TABLE IF EXISTS `varyasyondeger`;
CREATE TABLE IF NOT EXISTS `varyasyondeger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deger` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `tutar` float NOT NULL,
  `sahip` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `varyasyondeger`
--

INSERT INTO `varyasyondeger` (`id`, `deger`, `tutar`, `sahip`, `durum`) VALUES
(114, 'Varyant', 0, 28, 1),
(115, 'Standart', 510, 28, 1),
(116, 'Radyant', 2110, 28, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

DROP TABLE IF EXISTS `yoneticiler`;
CREATE TABLE IF NOT EXISTS `yoneticiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kadi` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(80) COLLATE utf8_turkish_ci NOT NULL,
  `yardim` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `kadi`, `sifre`, `eposta`, `yardim`) VALUES
(1, 'admin', '4297f44b13955235245b2497399d7a93', 'admin@lupusoft.com', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE IF NOT EXISTS `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun` int(11) NOT NULL,
  `uye` int(11) NOT NULL,
  `yorum` varchar(280) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
