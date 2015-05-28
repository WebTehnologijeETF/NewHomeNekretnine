-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2015 at 01:45 AM
-- Server version: 5.6.24-0ubuntu2
-- PHP Version: 5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newhomedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
`id` int(11) NOT NULL,
  `vijest` int(11) NOT NULL,
  `autor` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `vijest`, `autor`, `mail`, `tekst`, `vrijeme`) VALUES
(1, 2, 'Tarik', NULL, 'Ovo je primjer nekog pitanja/komentara na jednu nekretninu cisto da vidim kako to izgleda i tako', '2015-05-28 12:28:10'),
(2, 2, 'Tarik Demirovic', 'tdemirovic1@etf.unsa.ba', 'Da li ha hu nesto', '2015-05-28 12:20:57'),
(3, 2, 'Enis Demirović', NULL, 'Da li ha hu nesto', '2015-05-28 12:28:02'),
(9, 2, 'Tarik Demirović', 'demirovict@gmail.com', 'Ma jeste', '2015-05-28 12:42:41'),
(10, 1, 'Tarik Demirović', 'demirovict@gmail.com', 'Poruka neka da vidimo radil', '2015-05-28 12:45:07'),
(11, 1, 'Tarik Demirović', NULL, 'Bez mejla jedna kao odgovor ono ''na', '2015-05-28 12:45:32'),
(12, 1, 'XSS', 'demirovict@gmail.com', '&lt;script&gt;alert(''papak'')&lt;/script&gt;', '2015-05-28 12:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `username` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `mail` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`username`, `mail`, `password`) VALUES
('admin', 'demirovict@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
('korisnik', 'mail@mail.ba', '923352284767451ab158a387a283df26'),
('noviuser', 'user@mail.ba', '923352284767451ab158a387a283df26');

-- --------------------------------------------------------

--
-- Table structure for table `nekretnina`
--

CREATE TABLE IF NOT EXISTS `nekretnina` (
`id` int(11) NOT NULL,
  `vrsta` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `grad` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `adresa` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `naslov` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `opis` text COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci,
  `agent` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `slika` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `nekretnina`
--

INSERT INTO `nekretnina` (`id`, `vrsta`, `grad`, `adresa`, `naslov`, `opis`, `tekst`, `agent`, `slika`, `vrijeme`) VALUES
(1, 'stan', 'Sarajevo', 'Marcela Šnajdera 3', 'Opremljen stan u centru Sarajeva', 'Stan od 50m^2, na ekskluzivnoj lokaciji, 15 minuta hoda udaljen od jezgre grada. Stan je trosoban, sa dva kupatila, tri veš mašine i četiri frižidera.', 'Stan je svježe okrečen, registrovan, nije puno prešo, prvi sam vlasnik. Ne može zamjena, samo pare. Ko ponudi golfa dvicu biće poparen.', 'Tarik Demirović', 'slike_nekretnine/stan1.jpg', '2015-05-27 21:33:33'),
(2, 'kuca', 'Sarajevo', 'Svetozara Ćorovića 6', 'Kuća u Sarajevu, općina Centar', 'Kuća u Sarajevu, 80m², sa dvorištem i kerom u dvorištu. Gratis znak "Čuvaj se psa" koji se može okačiti na kapiju.', NULL, 'Tarik Demirović', 'slike_nekretnine/kuca1.jpg', '2015-05-27 22:37:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
 ADD PRIMARY KEY (`id`), ADD KEY `vijest` (`vijest`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `nekretnina`
--
ALTER TABLE `nekretnina`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `nekretnina`
--
ALTER TABLE `nekretnina`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`vijest`) REFERENCES `nekretnina` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
