-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2021 at 09:42 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daw2_20_comparaprecios`
--

-- --------------------------------------------------------

--
-- Table structure for table `copias_seg`
--

CREATE TABLE `copias_seg` (
  `id` int(11) NOT NULL COMMENT 'Clave para identificar las copias de seguridad, autoincrementada',
  `fecha` date DEFAULT NULL COMMENT 'fecha de realización de la copia de seguridad',
  `ruta` varchar(1000) DEFAULT NULL COMMENT 'ruta en la que se guarda la copia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `copias_seg`
--

INSERT INTO `copias_seg` (`id`, `fecha`, `ruta`) VALUES
(10, '2021-02-09', 'BackUp2021-02-09-18-45-24\r'),
(11, '2021-02-10', 'BackUp2021-02-10-18-35-19\r'),
(12, '2021-02-10', 'BackUp2021-02-10-18-39-45'),
(13, '2021-02-13', 'BackUp2021-02-13-17-29-25'),
(14, '2021-02-13', 'BackUp2021-02-13-17-29-32'),
(15, '2021-02-13', 'BackUp2021-02-13-17-29-40'),
(16, '2021-02-15', 'BackUp2021-02-15-09-42-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `copias_seg`
--
ALTER TABLE `copias_seg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `copias_seg`
--
ALTER TABLE `copias_seg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave para identificar las copias de seguridad, autoincrementada', AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
