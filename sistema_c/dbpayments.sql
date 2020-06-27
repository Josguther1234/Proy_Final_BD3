-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2020 at 02:02 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1-log
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpayments`
--
CREATE DATABASE IF NOT EXISTS `dbpayments` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `dbpayments`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `config_usuarios_add`$$
CREATE DEFINER=`dba`@`%` PROCEDURE `config_usuarios_add` (IN `acct` VARCHAR(15), IN `fnm` VARCHAR(100), IN `role` VARCHAR(1))  NO SQL
BEGIN
   DECLARE cuantos INT;
   DECLARE respu INT;
   SELECT COUNT(*) INTO cuantos FROM users
    WHERE acct_name = acct;
   IF cuantos = 0 THEN
      INSERT INTO users 
          VALUES(NULL,fnm,NOW(),acct,role,NULL);
      IF ROW_COUNT() = 1 THEN
         SET respu = 1;
      ELSE 
         SET respu = 2;
      END IF;
   ELSE 
      SET respu = 3;
   END IF;
   SELECT respu;
END$$

DROP PROCEDURE IF EXISTS `config_usuarios_del`$$
CREATE DEFINER=`dba`@`%` PROCEDURE `config_usuarios_del` (IN `idu` INT)  NO SQL
BEGIN
   DECLARE resp INT;
   DELETE FROM users WHERE id = idu;
   IF ROW_COUNT() = 1 THEN
      SET resp = 1;
   ELSE 
      SET resp = 0;
   END IF;
   SELECT resp;
END$$

DROP PROCEDURE IF EXISTS `config_usuarios_getrs`$$
CREATE DEFINER=`dba`@`%` PROCEDURE `config_usuarios_getrs` ()  NO SQL
SELECT * FROM users ORDER BY acct_name$$

DROP PROCEDURE IF EXISTS `config_usuarios_login`$$
CREATE DEFINER=`dba`@`%` PROCEDURE `config_usuarios_login` (IN `uc` VARCHAR(15), IN `up` VARCHAR(256))  NO SQL
BEGIN
   DECLARE elid INTEGER;
   DECLARE elno VARCHAR(75);
   DECLARE elti CHAR(1);
   DECLARE elrol VARCHAR(15);
   DECLARE howmany INTEGER;
   SELECT id, full_name, role, 
      (CASE role
         WHEN "A" THEN "Administrador"
         WHEN "O" THEN "Operador"
         WHEN "C" THEN "Cajero"
         WHEN "W" THEN "WebService" END) AS nomrole
     INTO elid, elno, elti, elrol
     FROM users
    WHERE acct_name = uc AND userkey = up;
   SELECT FOUND_ROWS() INTO howmany;
   IF howmany = 1 THEN
      SELECT elid, elno, elti, elrol;
   END IF;
END$$

DROP PROCEDURE IF EXISTS `config_usuarios_mod`$$
CREATE DEFINER=`dba`@`%` PROCEDURE `config_usuarios_mod` (IN `idu` INT, IN `fnm` VARCHAR(100), IN `vrole` VARCHAR(1))  NO SQL
BEGIN
   DECLARE resp INT;
   UPDATE users 
      SET full_name = fnm, role = vrole
    WHERE id = idu;
   IF ROW_COUNT() = 1 THEN
      SET resp = 1;
   ELSE 
      SET resp = 2;
   END IF;
   SELECT resp;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `certiforder`
--

DROP TABLE IF EXISTS `certiforder`;
CREATE TABLE `certiforder` (
  `order_id` int(11) NOT NULL,
  `dpi` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `datepaid` date DEFAULT NULL,
  `userpay` int(11) DEFAULT NULL,
  `ornamentid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `certiforder`
--

INSERT INTO `certiforder` (`order_id`, `dpi`, `paid`, `datepaid`, `userpay`, `ornamentid`) VALUES
(2, '1948123450901', 0, NULL, NULL, NULL),
(3, '1811875900901', 0, NULL, NULL, 2),
(4, '1234567890123', 0, NULL, NULL, 3),
(5, '1811875900901', 0, NULL, NULL, 2),
(6, '1811875900901', 0, NULL, NULL, 2),
(7, '1811875900901', 0, NULL, NULL, 2),
(8, '1234567890123', 0, NULL, NULL, 3),
(9, '1234567890123', 0, NULL, NULL, 3);

--
-- Triggers `certiforder`
--
DROP TRIGGER IF EXISTS `trgCheckOrnament`;
DELIMITER $$
CREATE TRIGGER `trgCheckOrnament` BEFORE INSERT ON `certiforder` FOR EACH ROW BEGIN 
   DECLARE idor INT;
   DECLARE flgp INT;
   SELECT id, paid INTO idor, flgp 
     FROM ornament
    WHERE dpi = NEW.dpi;
   IF idor > 0 AND flgp = 1 THEN
      SET NEW.ornamentid = idor;
   ELSE 
      SIGNAL SQLSTATE '45000';
   END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ornament`
--

DROP TABLE IF EXISTS `ornament`;
CREATE TABLE `ornament` (
  `id` int(11) NOT NULL,
  `dpi` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ticketno` int(11) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `datepaid` date DEFAULT NULL,
  `ammount` decimal(10,0) DEFAULT NULL,
  `ornamenttariff` int(11) DEFAULT NULL,
  `userpay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ornament`
--

INSERT INTO `ornament` (`id`, `dpi`, `ticketno`, `paid`, `datepaid`, `ammount`, `ornamenttariff`, `userpay`) VALUES
(2, '1811875900901', 123456, 1, '2020-06-01', '100', 1, 1),
(3, '1234567890123', 123457, 1, '2020-06-02', '100', 1, 1),
(4, '1234567890124', 123471, 1, '2020-06-02', '100', 1, 1),
(5, '1234567890125', 123470, 1, '2020-06-02', '100', 1, 1),
(6, '1234567890126', 123469, 1, '2020-06-02', '100', 1, 1),
(7, '1234567890127', 123468, 1, '2020-06-02', '100', 1, 1),
(8, '1234567890128', 123467, 1, '2020-06-02', '100', 1, 1),
(9, '1234567890129', 123466, 1, '2020-06-02', '100', 1, 1),
(10, '1234567890130', 123465, 1, '2020-06-02', '100', 1, 1),
(11, '1234567890131', 123464, 1, '2020-06-02', '100', 1, 1),
(12, '1234567890132', 123463, 1, '2020-06-02', '100', 1, 1),
(13, '1234567890133', 123462, 1, '2020-06-02', '100', 1, 1),
(14, '1234567890134', 123461, 1, '2020-06-02', '100', 1, 1),
(15, '1234567890135', 123460, 1, '2020-06-02', '100', 1, 1),
(16, '1234567890136', 123459, 1, '2020-06-02', '100', 1, 1),
(17, '1234567890137', 123458, 1, '2020-06-02', '100', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ornamenttariff`
--

DROP TABLE IF EXISTS `ornamenttariff`;
CREATE TABLE `ornamenttariff` (
  `idtariff` int(11) NOT NULL,
  `floor` decimal(10,0) DEFAULT NULL,
  `ceiling` decimal(10,0) DEFAULT NULL,
  `tariff` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ornamenttariff`
--

INSERT INTO `ornamenttariff` (`idtariff`, `floor`, `ceiling`, `tariff`) VALUES
(1, '7500', '10500', '100');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acct_name` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `role` enum('A','O','Q','W') COLLATE latin1_spanish_ci DEFAULT NULL,
  `userkey` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `created_at`, `acct_name`, `role`, `userkey`) VALUES
(1, 'Usuario de Prueba', '2020-06-25 22:12:26', 'usuarioprueba', 'A', 'c70b5dd9ebfb6f51d09d4132b7170c9d20750a7852f00680f65658f0310e810056e6763c34c9a00b0e940076f54495c169fc2302cceb312039271c43469507dc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certiforder`
--
ALTER TABLE `certiforder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `ornamentid` (`ornamentid`),
  ADD KEY `userpay` (`userpay`);

--
-- Indexes for table `ornament`
--
ALTER TABLE `ornament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ornamenttariff` (`ornamenttariff`),
  ADD KEY `userpay` (`userpay`);

--
-- Indexes for table `ornamenttariff`
--
ALTER TABLE `ornamenttariff`
  ADD PRIMARY KEY (`idtariff`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certiforder`
--
ALTER TABLE `certiforder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ornament`
--
ALTER TABLE `ornament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `ornamenttariff`
--
ALTER TABLE `ornamenttariff`
  MODIFY `idtariff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `certiforder`
--
ALTER TABLE `certiforder`
  ADD CONSTRAINT `certiforder_ibfk_1` FOREIGN KEY (`ornamentid`) REFERENCES `ornament` (`id`),
  ADD CONSTRAINT `certiforder_ibfk_2` FOREIGN KEY (`userpay`) REFERENCES `users` (`id`);

--
-- Constraints for table `ornament`
--
ALTER TABLE `ornament`
  ADD CONSTRAINT `ornament_ibfk_1` FOREIGN KEY (`ornamenttariff`) REFERENCES `ornamenttariff` (`idtariff`),
  ADD CONSTRAINT `ornament_ibfk_2` FOREIGN KEY (`userpay`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
