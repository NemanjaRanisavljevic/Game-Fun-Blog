-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2019 at 09:02 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamefun`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id_a` int(11) NOT NULL,
  `pitanje` text COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`id_a`, `pitanje`, `aktivna`) VALUES
(1, 'Koju igricu igras?', 1),
(3, 'Mora da radi ?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anketa_korisnik_odgovor`
--

CREATE TABLE `anketa_korisnik_odgovor` (
  `id_a_k_o` int(11) NOT NULL,
  `idK` int(11) NOT NULL,
  `idOdgovor` int(11) NOT NULL,
  `anketaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa_korisnik_odgovor`
--

INSERT INTO `anketa_korisnik_odgovor` (`id_a_k_o`, `idK`, `idOdgovor`, `anketaId`) VALUES
(4, 42, 3, 1),
(7, 42, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `anketa_odgovori`
--

CREATE TABLE `anketa_odgovori` (
  `id_od` int(11) NOT NULL,
  `odgovor` text COLLATE utf8_unicode_ci NOT NULL,
  `idAnketa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa_odgovori`
--

INSERT INTO `anketa_odgovori` (`id_od`, `odgovor`, `idAnketa`) VALUES
(1, 'PlayerUnknown\'s Battlegrounds', 1),
(3, 'World of Warcraft', 1),
(6, 'FORTNITE', 1),
(7, 'Sada ce da radi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(1, 'PlayerUnknown\'s Battlegrounds'),
(3, 'World of Warcraft'),
(4, 'FORTNITE');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(11) NOT NULL,
  `sadrzaj` text COLLATE utf8_unicode_ci NOT NULL,
  `postId` int(11) NOT NULL,
  `korisnikId` int(11) NOT NULL,
  `vreme_komentara` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idKategirije` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `sadrzaj`, `postId`, `korisnikId`, `vreme_komentara`, `idKategirije`) VALUES
(36, 'Ovo je vrunska stvar.', 39, 42, '2019-02-10 19:32:07', 1),
(37, 'To se ocekivalo.\n', 42, 42, '2019-02-10 20:00:19', 3);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnik` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sifra` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `datum_registracije` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aktivan` bit(1) NOT NULL,
  `ulogaId` int(11) NOT NULL,
  `polId` int(11) NOT NULL,
  `token` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnik`, `ime`, `prezime`, `email`, `sifra`, `datum_registracije`, `aktivan`, `ulogaId`, `polId`, `token`) VALUES
(42, 'Nemanja', 'Ranisavljevic', 'beka9977@gmail.com', '7a6ac7cbfcd01b3c5dc63b35bfd57ea4', '2019-01-26 13:47:04', b'1', 2, 1, 'd14f0de1d8abfbd1cdcafbc84879f340'),
(46, 'Peric', 'Vesic', 'nemanjabeka97@gmail.com', '7a6ac7cbfcd01b3c5dc63b35bfd57ea4', '2019-02-05 21:18:38', b'1', 1, 2, 'b64c8888db491dccfb98a3d0d7614167'),
(47, 'Verica', 'Zivic', 'vericaveca@gmail.com', '4b72e1d9039f10e3d56bf7d89991a047', '2019-02-05 22:41:50', b'1', 1, 2, ''),
(48, 'Vesna', 'Gavranovic', 'gavranovicka@gmail.com', '0599d208d0f51bf7db8292c4024d1aa2', '2019-02-05 22:44:52', b'1', 1, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id` int(11) NOT NULL,
  `naziv` text COLLATE utf8_unicode_ci NOT NULL,
  `putanja` text COLLATE utf8_unicode_ci NOT NULL,
  `roditelj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id`, `naziv`, `putanja`, `roditelj`) VALUES
(1, 'Pocetna', 'index.php?page=index', 0),
(2, 'Kategorije', '', 0),
(3, 'Kontakt', 'index.php?page=kontakt', 0),
(4, 'Izloguj se', 'views/logout.php', 0),
(5, 'Registracija', 'index.php?page=registracija', 0),
(7, 'Postavi objavu', 'index.php?page=postaviPost', 0),
(8, 'PlayerUnknown\'s Battlegrounds', 'index.php?page=sviPostoviKategorije&x=1', 2),
(9, 'FORTNITE', 'index.php?page=sviPostoviKategorije&x=2', 2),
(10, 'World of Worcraft', 'index.php?page=sviPostoviKategorije&x=3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pol`
--

CREATE TABLE `pol` (
  `id` int(11) NOT NULL,
  `nazivP` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pol`
--

INSERT INTO `pol` (`id`, `nazivP`) VALUES
(1, 'muski'),
(2, 'zenski');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `naslov` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idKategorija` int(11) NOT NULL,
  `idKomentar` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`idPost`, `naslov`, `opis`, `slika`, `vreme`, `idKategorija`, `idKomentar`, `idKorisnik`) VALUES
(39, 'Zombiji stigli u PUBG Mobile', 'Navikli smo da s vremena na vreme u PUBG Mobile vidimo neke specijalne događaje i krosovere koji dolaze zahvaljujući nekoj drugoj igri ili filmu, pa su tako zahvaljujući Resident Evil 2 u ovu igru stigli i zombiji. 0.11.0 verzija igre je donela novi mod igranja, u kojem se igrači bore protiv hordi živih mrtvaka, umesto sa ostalim igračima, a za njihove eliminacije će se dobijati resursi kako bi mogli dalje da se bore. To nije sve što je novo u PUBG Mobile, pošto su developeri dodali i noćno okruženje na zimsku mapu, koje je tek nedavno postalo dostupno i za PC igrače, tako da ove dve verzije ne zaostaju mnogo. PUBG Mobile definitnivno predstavlja bolju igru od one na PC-u, o čemu najbolje govori broj igrača i ovakva velika partnerstva kao što je Resident Evil 2.', 'images/1549827100web4.jpg', '2019-02-10 19:31:40', 1, 0, 42),
(40, 'Sezona sedam u Fortnite završava  se zemljotresom ', 'Do kraja sedme sezone u Fortnite: Battle Royale je ostalo dosta malo vremena, a do sada smo nailazili na dosta zanimljivih teorija o tome šta nas čeka u narednoj sezoni, poput zmajeva i nestanka Wailing Woodsa.\r\n\r\nMeđutim, datamineri su sada otkrili nešto dosta intrigantnije, a to je da nas sa krajem tekuće sezone čeka zemljotres.\r\n\r\nDatamineri su među fajlovima igre pronašli one koji sa sobom nose naziv EartQuake_Shakes, što upućuje na to da nas čekaju potresi tla, a očekuje se i da će zemljotres dovesti velike promene u igru.\r\n\r\nObzirom na to da smo imali Kevina, ogromnu ljubičastu kocku, raketu, portale, zemljotres je zapravo novina u nizu spektakla koje sprema sam Epic Games, i jedva čekamo da vidimo šta se sprema. A vi?', 'images/1549828453web3.jpg', '2019-02-10 19:54:13', 4, 0, 42),
(41, 'Lite je besplatna verzija igre za slabe računare ', 'Originalni PUBG je, i uprkos naporima developera da ga što bolje optimizuju, dosta zahtevna igra te vam je potrebna jaka mašina kako bi igru pokretali bez većih problema.\r\n\r\nToga su svesni i iz PUBG korporacije, pa su u želji da prošire publiku kreirali PUBG Lite. U pitanju je besplatna verzija igre namenjena slabim računarima. Ova verzija zahteva Intel HD 4000 integrisanu grafiku koja je sastavni deo mnogih low-end laptopova i procesora istog proizvođača, dok je u istovreme očuvan gejmplej sa 100 igrača po meču na mapama Miramar i Erangel.\r\n\r\nProblem? Ova verzija igre nije dostupna u svim regijama, već je trenutno prisutna samo na Tajlandu, a nadamo se da će se eventualno proširiti i na naš region, pošto znamo da bi većina igrača želela baš ovako nešto', 'images/1549828608web2.jpg', '2019-02-10 19:56:48', 1, 0, 42),
(42, 'World of Warcraft konačno smenio Fortnite sa trona', 'Fortnite se gotovo od početka godine ustalio na poziciji najgledanije igre na Twitchu i tu se nalazio čak nekoliko meseci i ponekad sa duplo većim brojkama od drugoplasiranih igara.\r\n\r\nDominaciji ove Battle Royale igre je došao kraj, jer ju je sa trona uklonio dolazak nove ekspanzije u World of Warcraft. Tako sada WoW zbog Battle for Azeroth nosi titulu igre sa najviše gledalaca na Twitchu pošto u trenutku pisanja ovog teksta postoji 212,797, dok Fortnite ima 187,000 ljudi koji gledaju svoje omiljene strimere.\r\n\r\nOno što ostaje da vidimo koliko će se dugo World of Warcraft zadržati na prvoj poziciji najgledanije igre na Twitchu i kada će se Fortnite vratiti na prvo mesto, jer je već u pripremi jedan događaj povodom odlaska pukotina sa neba u igri.', 'images/1549828731web1.jpg', '2019-02-10 19:59:45', 3, 0, 42);

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'korisnik'),
(2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id_a`);

--
-- Indexes for table `anketa_korisnik_odgovor`
--
ALTER TABLE `anketa_korisnik_odgovor`
  ADD PRIMARY KEY (`id_a_k_o`),
  ADD KEY `idK` (`idK`),
  ADD KEY `idOdgovor` (`idOdgovor`),
  ADD KEY `anketaId` (`anketaId`);

--
-- Indexes for table `anketa_odgovori`
--
ALTER TABLE `anketa_odgovori`
  ADD PRIMARY KEY (`id_od`),
  ADD KEY `idAnketa` (`idAnketa`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId` (`postId`),
  ADD KEY `korisnikId` (`korisnikId`),
  ADD KEY `idKategirije` (`idKategirije`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnik`),
  ADD KEY `ulogaId` (`ulogaId`),
  ADD KEY `polId` (`polId`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pol`
--
ALTER TABLE `pol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `idKorisnik` (`idKorisnik`),
  ADD KEY `idKomentar` (`idKomentar`),
  ADD KEY `idKategorija` (`idKategorija`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anketa_korisnik_odgovor`
--
ALTER TABLE `anketa_korisnik_odgovor`
  MODIFY `id_a_k_o` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `anketa_odgovori`
--
ALTER TABLE `anketa_odgovori`
  MODIFY `id_od` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pol`
--
ALTER TABLE `pol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketa_korisnik_odgovor`
--
ALTER TABLE `anketa_korisnik_odgovor`
  ADD CONSTRAINT `anketa_korisnik_odgovor_ibfk_1` FOREIGN KEY (`idOdgovor`) REFERENCES `anketa_odgovori` (`id_od`),
  ADD CONSTRAINT `anketa_korisnik_odgovor_ibfk_2` FOREIGN KEY (`idK`) REFERENCES `korisnik` (`idKorisnik`),
  ADD CONSTRAINT `anketa_korisnik_odgovor_ibfk_3` FOREIGN KEY (`anketaId`) REFERENCES `anketa` (`id_a`);

--
-- Constraints for table `anketa_odgovori`
--
ALTER TABLE `anketa_odgovori`
  ADD CONSTRAINT `anketa_odgovori_ibfk_1` FOREIGN KEY (`idAnketa`) REFERENCES `anketa` (`id_a`);

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `post` (`idPost`),
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`korisnikId`) REFERENCES `korisnik` (`idKorisnik`),
  ADD CONSTRAINT `komentari_ibfk_3` FOREIGN KEY (`idKategirije`) REFERENCES `kategorije` (`id`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`ulogaId`) REFERENCES `uloga` (`id`),
  ADD CONSTRAINT `korisnik_ibfk_2` FOREIGN KEY (`polId`) REFERENCES `pol` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnik` (`idKorisnik`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`idKategorija`) REFERENCES `kategorije` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
