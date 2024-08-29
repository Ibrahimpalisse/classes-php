-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2024 at 07:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classes`
--

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(55) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `firstname`, `lastname`) VALUES
(3, 'ibra', '$2y$10$TyVOAxY9Z.FhYjTk3Tvtg.bBx3.Ppf7tn.y5zNi69SzdNfmOHgbbO', 'ibrahim.vignes@laplateforme.io', 'vignes', 'ibrahi'),
(4, 'ibrahim', '$2y$10$C1UpqaiRoUucb7iqcMoxg.cyoSn56fwJ7pLWE8aBe301aQdIWoAc6', 'ibrahim.vignes@laplateforme.io', 'vignes', 'ibrahim'),
(5, 'vigne', '$2y$10$DL9mpQU7IBrEPEM1LKrmOuntGp7.MhwCFvvljX332fAcAQSiav9zi', 'ibrahim.vignes@laplateforme.io', 'vignes', 'ibrahim'),
(6, 'vi', '$2y$10$5cwmPCHB6Dht1DtFUrmJ8Op/XDzY4gXg0o2V7vKMVHCINRQ48f6Gq', 'ibrahim.vignes@laplateforme.io', 'jz', 'ibra'),
(8, 'you', '$2y$10$JwPDM4Ikt9gv8G.mw388Ae.q.DPVO0wr2skhMutC4My3WsdXTbK.y', 'ibrahim.vignes@laplateforme.io', 'vignes', 'vignes'),
(11, 'vignes', '$2y$10$Y6rynkS4NIJVwG24DAiuceL5vCsxuKLkn5Yu9tDL4Oxpuv42DLV5G', 'ibrahim.vignes@laplateforme.io', 'vignes', 'vignes'),
(14, 'ABD', '$2y$10$Fnf6xDSukYg/lkVmGNzo..VkpryMQKzbDQ4m3kVuLUY1grEy58gOK', 'ibrahim.vignes@laplateforme.io', 'AAAA', 'AAAA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
