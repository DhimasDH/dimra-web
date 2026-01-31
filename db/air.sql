-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 06:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `air`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian`
--

CREATE TABLE `pemakaian` (
  `no` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `meter_awal` smallint(6) NOT NULL,
  `meter_akhir` smallint(6) NOT NULL,
  `pemakaian` smallint(6) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `kd_tarif` char(3) NOT NULL,
  `tagihan` mediumint(9) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemakaian`
--

INSERT INTO `pemakaian` (`no`, `username`, `meter_awal`, `meter_akhir`, `pemakaian`, `tanggal`, `waktu`, `kd_tarif`, `tagihan`, `status`) VALUES
(14, 'warga10', 25, 40, 15, '2025-01-16', '10:08:16', 'T2', 150000, 'LUNAS'),
(16, 'warga40', 100, 110, 10, '2025-01-15', '20:39:35', 'T2', 100000, 'BLM LUNAS'),
(19, 'warga', 10, 30, 20, '2025-01-25', '22:11:28', 'T2', 200000, 'LUNAS'),
(25, 'warga20', 0, 15, 15, '2025-01-20', '21:44:08', 'T1', 225000, 'LUNAS'),
(26, 'warga40', 100, 130, 30, '2025-02-12', '09:04:04', 'T2', 300000, 'LUNAS'),
(27, 'warga', 20, 50, 30, '2025-02-11', '10:19:37', 'T2', 300000, 'BLM LUNAS'),
(28, 'warga20', 15, 35, 20, '2025-02-13', '10:20:00', 'T1', 300000, 'LUNAS'),
(29, 'warga10', 5, 40, 35, '2025-02-12', '10:20:19', 'T2', 350000, 'LUNAS'),
(30, 'warga10', 5, 40, 35, '2025-03-12', '10:21:09', 'T2', 350000, 'BLM LUNAS'),
(31, 'warga', 25, 50, 25, '2025-03-15', '10:21:48', 'T2', 250000, 'LUNAS'),
(32, 'warga20', 35, 60, 25, '2025-03-14', '10:22:01', 'T1', 375000, 'LUNAS'),
(33, 'warga40', 30, 50, 20, '2025-03-17', '10:22:11', 'T2', 200000, 'BLM LUNAS'),
(34, 'warga40', 30, 50, 20, '2025-04-16', '10:23:11', 'T2', 200000, 'LUNAS'),
(35, 'warga10', 100, 130, 30, '2025-04-17', '10:23:29', 'T2', 300000, 'LUNAS'),
(36, 'warga20', 60, 90, 30, '2025-04-15', '10:24:43', 'T1', 450000, 'LUNAS'),
(37, 'warga', 120, 150, 30, '2025-04-18', '10:23:38', 'T2', 300000, 'LUNAS'),
(38, 'warga', 120, 150, 30, '2025-05-25', '10:24:27', 'T2', 300000, 'LUNAS'),
(39, 'warga40', 150, 190, 40, '2025-05-28', '10:24:55', 'T2', 400000, 'LUNAS'),
(40, 'warga10', 150, 175, 25, '2025-05-28', '10:25:44', 'T2', 250000, 'LUNAS'),
(45, 'warga20', 90, 115, 25, '2025-05-27', '12:31:54', 'T1', 375000, 'BLM LUNAS'),
(47, 'warga20', 150, 175, 25, '2025-06-06', '18:36:05', 'T1', 375000, 'LUNAS'),
(49, 'warga', 150, 180, 30, '2025-06-06', '18:49:35', 'T2', 300000, 'LUNAS'),
(60, 'warga10', 150, 180, 30, '2025-06-20', '19:25:37', 'T2', 300000, 'LUNAS'),
(62, 'warga40', 150, 170, 20, '2025-06-24', '20:26:41', 'T2', 200000, 'BLM LUNAS');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `tanggal` date NOT NULL,
  `mode` varchar(50) NOT NULL,
  `no` char(3) NOT NULL,
  `no_bayar` int(11) NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`tanggal`, `mode`, `no`, `no_bayar`, `bukti`) VALUES
('2025-05-14', 'Transfer Bank', '14', 3, 'layer1.jpg'),
('2025-05-14', 'Tunai', '14', 4, 'layer2.jpg'),
('2025-05-14', 'Transfer Bank', '16', 5, 'andrew-schultz-EAlbsTo6nuQ-unsplash.jpg'),
('2025-05-20', 'Transfer Bank', '19', 6, '2_1.png'),
('2025-06-11', 'Tunai', '49', 7, 'Screenshot 2025-06-11 082706.png'),
('2025-06-24', 'Transfer Bank', '38', 8, 'flowcerat.png'),
('2025-06-25', 'Transfer Bank', '31', 9, 'layer2.jpg'),
('2025-06-25', 'Tunai', '63', 10, 'layer1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `kd_tarif` varchar(10) NOT NULL,
  `tarif` int(11) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`kd_tarif`, `tarif`, `tipe`, `status`) VALUES
('T1', 15000, 'RT', 'AKTIF'),
('T2', 10000, 'Kos', 'AKTIF'),
('T3', 55000, 'Kos', 'NONAKTIF'),
('T4', 45000, 'RT', 'NONAKTIF'),
('T5', 19000, 'Kos', 'NONAKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `tipe` char(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `alamat`, `kota`, `telepon`, `level`, `tipe`, `status`) VALUES
('admin', '$2y$10$UpeaBSu3JAZgjwNmL3UX8.JNKG13X2rskyEKogQa2iODoNqbG43mC', 'Admin Web', 'Polines', 'Semarang', '024111', 'admin', '', 'AKTIF'),
('admin2', '$2y$10$T5E4gWM1FjFVU.Ug2Alu3uPf8JHyMo688.K4BG7yf4jJ0/cWprmGy', 'admin2', 'Durian', 'Surabaya', '08989832', 'admin', '', 'AKTIF'),
('bendahara', '$2y$10$lMsEonRILy7xylpCz61l7uQib2UhuE//DIyLF2DyZN16woL8HGbyy', 'Bendahara Air', 'Polines', 'Semarang', '024111', 'bendahara', '-', 'AKTIF'),
('Petugas', '$2y$10$66YfYv.5gu.eABzUVzu7hOzq8VKnGTd0L782dCqKTKuTHk2og3ADy', 'Petugas', 'Polines', 'Semarang', '024111', 'petugas', '-', 'AKTIF'),
('warga', '$2y$10$lDzGI/NxEtToHg2zccCw9OflMD7o76YbUx4WXhx4xjJd/zUvpUKHe', 'warga', 'Polines', 'Semarang', '0241112', 'warga', 'Kos', 'AKTIF'),
('warga10', '$2y$10$.7hae8b9m.jS.Yvmdx2bruuM.xCiLp0cHQIeBzWtGDZTbPxLncSce', 'warga10', 'Durian Jatuh', 'Kendal', '02465272', 'warga', 'Kos', 'AKTIF'),
('warga20', '$2y$10$Q9agbxfQAkj6RKV9igUIaubThVLoY62wvB9Fv8ghwYB1.gUYJ4lAe', 'warga20', 'Mijen Raya', 'Ungaran', '089537758', 'warga', 'RT', 'AKTIF'),
('warga40', '$2y$10$nsDg0q6ERCjHt149mPcbRe3U5iLOIiHTjd1cWy6OP9ieURFg4HBti', 'warga40', 'Durian', 'Tegal', '089763994', 'warga', 'Kos', 'AKTIF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemakaian`
--
ALTER TABLE `pemakaian`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_bayar`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`kd_tarif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemakaian`
--
ALTER TABLE `pemakaian`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
