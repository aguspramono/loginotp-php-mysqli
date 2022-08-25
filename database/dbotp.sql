-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2022 at 03:43 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbotp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_otp`
--

CREATE TABLE `tb_otp` (
  `IDOtp` double NOT NULL,
  `tanggalCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kodeUser` varchar(255) NOT NULL,
  `kodeOtp` varchar(20) NOT NULL,
  `expDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_otp`
--

INSERT INTO `tb_otp` (`IDOtp`, `tanggalCreate`, `kodeUser`, `kodeOtp`, `expDate`) VALUES
(21, '2022-08-12 01:38:45', 'b2176393f20b2e3ed1304d178f44fb0d', '451448', '2022-08-12 08:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_privilege`
--

CREATE TABLE `tb_privilege` (
  `idPrevilege` double NOT NULL,
  `kodeUser` varchar(255) NOT NULL,
  `privilege` varchar(150) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_privilege`
--

INSERT INTO `tb_privilege` (`idPrevilege`, `kodeUser`, `privilege`) VALUES
(5, 'b2176393f20b2e3ed1304d178f44fb0d', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `idUser` double NOT NULL,
  `kodeUser` varchar(255) NOT NULL,
  `tanggalCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `NamaLengkap` varchar(255) NOT NULL,
  `EmailUser` varchar(255) NOT NULL,
  `NopeUser` varchar(20) NOT NULL,
  `statusVerif` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`idUser`, `kodeUser`, `tanggalCreate`, `NamaLengkap`, `EmailUser`, `NopeUser`, `statusVerif`) VALUES
(24, 'b2176393f20b2e3ed1304d178f44fb0d', '2022-08-10 03:44:17', 'Admin', 'agus.pramono3545@gmail.com', '085270347513', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_otp`
--
ALTER TABLE `tb_otp`
  ADD PRIMARY KEY (`IDOtp`);

--
-- Indexes for table `tb_privilege`
--
ALTER TABLE `tb_privilege`
  ADD PRIMARY KEY (`idPrevilege`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_otp`
--
ALTER TABLE `tb_otp`
  MODIFY `IDOtp` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_privilege`
--
ALTER TABLE `tb_privilege`
  MODIFY `idPrevilege` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `idUser` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
