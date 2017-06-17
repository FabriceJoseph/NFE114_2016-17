-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2017 at 11:01 
-- Server version: 10.1.11-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nfe114`
--

-- --------------------------------------------------------

--
-- Table structure for table `Artiste`
--

CREATE TABLE `Artiste` (
  `idArtiste` int(11) NOT NULL,
  `civilite` enum('0','1') NOT NULL DEFAULT '1',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Categorie`
--

CREATE TABLE `Categorie` (
  `idCategorie` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Categorie`
--

INSERT INTO `Categorie` (`idCategorie`, `nom`) VALUES
(1, 'categorie1'),
(2, 'categorie2'),
(3, 'categorie3'),
(4, 'categorie4');

-- --------------------------------------------------------

--
-- Table structure for table `Genre`
--

CREATE TABLE `Genre` (
  `idGenre` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Genre`
--

INSERT INTO `Genre` (`idGenre`, `nom`) VALUES
(1, 'Comedie'),
(2, 'Drame');

-- --------------------------------------------------------

--
-- Table structure for table `Illustration`
--

CREATE TABLE `Illustration` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idSpectacle` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Illustration`
--

INSERT INTO `Illustration` (`id`, `name`, `idSpectacle`, `path`) VALUES
(1, 'LeComteDeBouderbala', 1, 'images/comte_de_bouderbala.jpg'),
(2, 'LaGarconniere', 2, 'images/lagarconniere.jpg'),
(3, 'Napoleon', 3, 'images/napoleon.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Lieu`
--

CREATE TABLE `Lieu` (
  `idLieu` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Lieu`
--

INSERT INTO `Lieu` (`idLieu`, `nom`, `adresse`, `ville`) VALUES
(1, 'Theatre de Paris', '15 rue Blanche', '75009 Paris');

-- --------------------------------------------------------

--
-- Table structure for table `Place`
--

CREATE TABLE `Place` (
  `idRepresentation` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `capacite` int(11) NOT NULL,
  `placeDispo` int(11) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Place`
--

INSERT INTO `Place` (`idRepresentation`, `idCategorie`, `capacite`, `placeDispo`, `prix`) VALUES
(1, 1, 250, 250, 15),
(1, 2, 150, 150, 22),
(1, 3, 100, 100, 35),
(1, 4, 50, 50, 41);

-- --------------------------------------------------------

--
-- Table structure for table `Producteur`
--

CREATE TABLE `Producteur` (
  `idProducteur` int(11) NOT NULL,
  `civilite` enum('0','1') DEFAULT '1',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Representation`
--

CREATE TABLE `Representation` (
  `idRepresentation` int(11) NOT NULL,
  `idSpectacle` int(11) NOT NULL,
  `nomSpectacle` varchar(255) NOT NULL,
  `lieu` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `reservations` int(11) NOT NULL,
  `nomSalle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Representation`
--

INSERT INTO `Representation` (`idRepresentation`, `idSpectacle`, `nomSpectacle`, `lieu`, `date`, `heure`, `reservations`, `nomSalle`) VALUES
(1, 2, 'La Garconniere', 1, '2017-06-21', '15:30:00', 0, 'Réjane'),
(2, 2, 'La Garconniere', 1, '2017-06-19', '17:00:00', 0, 'Réjane');

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE `Reservation` (
  `idReservation` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idRepresentation` int(11) NOT NULL,
  `idSiege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Salle`
--

CREATE TABLE `Salle` (
  `nomSalle` varchar(255) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `capacite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Salle`
--

INSERT INTO `Salle` (`nomSalle`, `idLieu`, `capacite`) VALUES
('Rejane', 1, 550);

-- --------------------------------------------------------

--
-- Table structure for table `Siege`
--

CREATE TABLE `Siege` (
  `idSiege` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `nomSalle` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Societe`
--

CREATE TABLE `Societe` (
  `idSociete` int(11) NOT NULL,
  `idProducteur` int(11) NOT NULL,
  `denominationSociale` varchar(255) NOT NULL,
  `formeJuridique` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Spectacle`
--

CREATE TABLE `Spectacle` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `idProducteur` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL,
  `description` text NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Spectacle`
--

INSERT INTO `Spectacle` (`id`, `nom`, `idProducteur`, `idGenre`, `description`, `dateDebut`, `dateFin`, `status`) VALUES
(1, 'Le Comte De Bouderbala ', 0, 1, '', '2017-06-13', '2017-07-04', '1'),
(2, 'La Garçonniere', 0, 1, 'Nous sommes dans l’Amérique des années 50, celle des grattes ciel et du rêve américain triomphant. Monsieur Baxter, un « petit employé de bureau » dans une importante compagnie d’assurances new yorkaise, prête régulièrement son appartement à ses supérieurs hiérarchiques qui s’en servent comme garçonnière. En échange, ils lui promettent une promotion qui n’arrive jamais. M. Sheldrake, le grand patron, s’aperçoit du manège. Il demande à Baxter de lui  prêter l’appartement pour y emmener sa maîtresse, mais il exige d’être dorénavant le seul à en profiter. Shelkdrake est un mari et un père respectable, il a besoin de discrétion. Baxter accepte, il monte en grade de façon spectaculaire. Mais lorsque Baxter comprend que Sheldrake y emmène celle qu’il aime, mademoiselle Novak, Baxter est face à un dilemme : renoncer à son amour, ou à sa carrière.', '2017-06-01', '2017-07-01', '1'),
(3, 'Napoleon', 0, 2, '', '2017-06-09', '2017-07-01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idClient` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `civilite` enum('0','1') NOT NULL DEFAULT '1',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `genreFavori` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idClient`, `mail`, `pass`, `civilite`, `nom`, `prenom`, `genreFavori`, `adresse`, `telephone`) VALUES
(1, 'julien@hotmail.fr', '123456', '1', '', '', '', '', ''),
(2, 'mathieu@hotmail.fr', '12345678', '1', '', '', '', '', ''),
(3, 'julienbernardi@hotmail.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Artiste`
--
ALTER TABLE `Artiste`
  ADD PRIMARY KEY (`idArtiste`);

--
-- Indexes for table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Indexes for table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`idGenre`);

--
-- Indexes for table `Illustration`
--
ALTER TABLE `Illustration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Lieu`
--
ALTER TABLE `Lieu`
  ADD PRIMARY KEY (`idLieu`);

--
-- Indexes for table `Place`
--
ALTER TABLE `Place`
  ADD PRIMARY KEY (`idRepresentation`,`idCategorie`);

--
-- Indexes for table `Producteur`
--
ALTER TABLE `Producteur`
  ADD PRIMARY KEY (`idProducteur`);

--
-- Indexes for table `Representation`
--
ALTER TABLE `Representation`
  ADD PRIMARY KEY (`idRepresentation`);

--
-- Indexes for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`idReservation`);

--
-- Indexes for table `Salle`
--
ALTER TABLE `Salle`
  ADD PRIMARY KEY (`nomSalle`);

--
-- Indexes for table `Siege`
--
ALTER TABLE `Siege`
  ADD PRIMARY KEY (`idSiege`);

--
-- Indexes for table `Societe`
--
ALTER TABLE `Societe`
  ADD PRIMARY KEY (`idSociete`);

--
-- Indexes for table `Spectacle`
--
ALTER TABLE `Spectacle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idClient`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Artiste`
--
ALTER TABLE `Artiste`
  MODIFY `idArtiste` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Genre`
--
ALTER TABLE `Genre`
  MODIFY `idGenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Illustration`
--
ALTER TABLE `Illustration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Producteur`
--
ALTER TABLE `Producteur`
  MODIFY `idProducteur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Societe`
--
ALTER TABLE `Societe`
  MODIFY `idSociete` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Spectacle`
--
ALTER TABLE `Spectacle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
