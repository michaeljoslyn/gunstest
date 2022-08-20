-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 05:38 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gun`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_barrel`
--

CREATE TABLE `acc_barrel` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `accuracy` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_barrel`
--

INSERT INTO `acc_barrel` (`id`, `name`, `accuracy`) VALUES
(1, 'Short barrel', 0),
(2, 'Long barrel', 36),
(3, 'Long light ported barrel', 50);

-- --------------------------------------------------------

--
-- Table structure for table `acc_magazine`
--

CREATE TABLE `acc_magazine` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `capacity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_magazine`
--

INSERT INTO `acc_magazine` (`id`, `name`, `capacity`) VALUES
(2, 'Standard magazine', 0),
(3, 'Large magazine', 50),
(4, 'Super Large magazine', 100);

-- --------------------------------------------------------

--
-- Table structure for table `acc_receiver`
--

CREATE TABLE `acc_receiver` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `damage` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_receiver`
--

INSERT INTO `acc_receiver` (`id`, `name`, `damage`) VALUES
(4, 'Calibrated receiver', 0),
(5, 'Powerful receiver', 20),
(6, 'Advanced receiver', 30);

-- --------------------------------------------------------

--
-- Table structure for table `acc_sights`
--

CREATE TABLE `acc_sights` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `accuracy` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_sights`
--

INSERT INTO `acc_sights` (`id`, `name`, `accuracy`) VALUES
(1, 'Standard sights', 0),
(2, 'Reflex sight', 7),
(3, 'Recon scope', 20);

-- --------------------------------------------------------

--
-- Table structure for table `base_pistol`
--

CREATE TABLE `base_pistol` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `damage` int(3) NOT NULL,
  `accuracy` int(3) NOT NULL,
  `capacity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `base_pistol`
--

INSERT INTO `base_pistol` (`id`, `name`, `damage`, `accuracy`, `capacity`) VALUES
(1, '10mm pistol', 18, 60, 12);

-- --------------------------------------------------------

--
-- Table structure for table `build_gun`
--

CREATE TABLE `build_gun` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `base` int(11) NOT NULL,
  `barrel` int(11) NOT NULL,
  `magazine` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `sights` int(11) NOT NULL,
  `totalAccuracy` int(3) NOT NULL,
  `totalCapacity` int(3) NOT NULL,
  `totalDamage` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `build_gun`
--

INSERT INTO `build_gun` (`id`, `name`, `base`, `barrel`, `magazine`, `receiver`, `sights`, `totalAccuracy`, `totalCapacity`, `totalDamage`) VALUES
(37, 'Gunner', 1, 1, 2, 4, 1, 60, 12, 18),
(46, 'Powe', 1, 3, 4, 6, 3, 130, 112, 48);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_barrel`
--
ALTER TABLE `acc_barrel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_magazine`
--
ALTER TABLE `acc_magazine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_receiver`
--
ALTER TABLE `acc_receiver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_sights`
--
ALTER TABLE `acc_sights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_pistol`
--
ALTER TABLE `base_pistol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `build_gun`
--
ALTER TABLE `build_gun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barrel` (`barrel`),
  ADD KEY `magazine` (`magazine`),
  ADD KEY `receiver` (`receiver`),
  ADD KEY `sights` (`sights`),
  ADD KEY `base` (`base`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_barrel`
--
ALTER TABLE `acc_barrel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `acc_magazine`
--
ALTER TABLE `acc_magazine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `acc_receiver`
--
ALTER TABLE `acc_receiver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acc_sights`
--
ALTER TABLE `acc_sights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `base_pistol`
--
ALTER TABLE `base_pistol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `build_gun`
--
ALTER TABLE `build_gun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `build_gun`
--
ALTER TABLE `build_gun`
  ADD CONSTRAINT `barrel` FOREIGN KEY (`barrel`) REFERENCES `acc_barrel` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `base` FOREIGN KEY (`base`) REFERENCES `base_pistol` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `magazine` FOREIGN KEY (`magazine`) REFERENCES `acc_magazine` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `receiver` FOREIGN KEY (`receiver`) REFERENCES `acc_receiver` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sights` FOREIGN KEY (`sights`) REFERENCES `acc_sights` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
