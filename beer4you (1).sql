-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 26 avr. 2019 à 17:02
-- Version du serveur :  5.7.25-0ubuntu0.16.04.2
-- Version de PHP :  7.2.15-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `beer4you`
--

-- --------------------------------------------------------

--
-- Structure de la table `beers`
--

CREATE TABLE `beers` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Photo` varchar(30) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `QuantityInStock` tinyint(4) NOT NULL,
  `BuyPrice` double NOT NULL,
  `SalePrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `beers`
--

INSERT INTO `beers` (`Id`, `Name`, `Photo`, `Description`, `QuantityInStock`, `BuyPrice`, `SalePrice`) VALUES
(23, 'La fabuleuse 86', '86.jpeg', 'Une subtile bière adoré des gilets jaune et des travailleurs dans BTP ! Son goût à la fois acide et fortement alcoolisé ravira les plus soulard d\'entre vous <3 							', 50, 0.8, 55),
(24, 'l\'indemodable kro', 'kro.png', '	Un subtile mélange d\'urine et de parfum enivrant		', 32, 5, 15),
(25, 'L\'intestable Amstel', 'amstel.jpg', 'On ne la présente plus, pour animer vos soirée saucisson Lidle, rien de tel qu\'une bonne Amstel. Facile à vomir, elle est le préférée des vrai pochtrons !', 12, 0.5, 15);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `TotalAmount` double DEFAULT NULL,
  `TaxRate` float DEFAULT NULL,
  `TaxAmount` double DEFAULT NULL,
  `CreationTimestamp` datetime NOT NULL,
  `CompleteTimestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `orderline`
--

CREATE TABLE `orderline` (
  `Id` int(11) NOT NULL,
  `QuantityOrdered` int(4) NOT NULL,
  `Meal_Id` int(11) NOT NULL,
  `Order_Id` int(11) NOT NULL,
  `PriceEach` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `BirthDate` date NOT NULL,
  `Address` varchar(250) NOT NULL,
  `City` varchar(40) NOT NULL,
  `ZipCode` char(5) NOT NULL,
  `Country` varchar(20) DEFAULT NULL,
  `Phone` char(10) NOT NULL,
  `CreationTimestamp` datetime NOT NULL,
  `LastLoginTimestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `firstName` varchar(80) NOT NULL,
  `lastName` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(120) NOT NULL,
  `creationTimeStamp` datetime DEFAULT NULL,
  `lastConnexion` datetime DEFAULT NULL,
  `address` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `email`, `password`, `creationTimeStamp`, `lastConnexion`, `address`, `city`, `zip`, `role`) VALUES
(7, 'Thibaut', 'Monesma', 'thib@gmail.com', '$2y$11$8009c476f72e77a2aff1dOi/CukqvTX37rx5av4pzEgUF1R1efJ5y', '2019-03-28 12:11:26', NULL, '17 rue Perdonnet', 'Paris', '75010', 'admin'),
(8, 'b', 'b', 'b', '$2y$11$11c8b445ec2c43004a0d1uR9OjuFDeB7pVvQTh.3DDy67TXTSRvNq', '2019-04-02 17:32:18', NULL, 'b', 'b', 'b', 'user'),
(9, 'a', 'a', 'a', '$2y$11$b5c76ed33b6e6446952c0urF.dfaiJ4UgaiiJD6I3dQY7npfBCedu', '2019-04-02 17:32:26', NULL, 'a', 'a', 'a', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `beers`
--
ALTER TABLE `beers`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Index pour la table `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UniciteMealOrder` (`Meal_Id`,`Order_Id`),
  ADD KEY `Meal_Id` (`Meal_Id`),
  ADD KEY `Order_Id` (`Order_Id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `beers`
--
ALTER TABLE `beers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orderline`
--
ALTER TABLE `orderline`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `OrderLine_ibfk_1` FOREIGN KEY (`Meal_Id`) REFERENCES `beers` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `OrderLine_ibfk_2` FOREIGN KEY (`Order_Id`) REFERENCES `order` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
