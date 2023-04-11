-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2023 at 11:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptoop`
--

-- --------------------------------------------------------

--
-- Table structure for table `laptop_tb`
--

CREATE TABLE `laptop_tb` (
  `idPrinter` int(10) NOT NULL,
  `NamaLaptop` char(50) DEFAULT NULL,
  `SpesifikasiPrinter` char(50) DEFAULT NULL,
  `HargaLaptop` int(50) DEFAULT NULL,
  `stok` int(255) DEFAULT NULL,
  `GambarPrinter` varchar(50) NOT NULL,
  `UserIdUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laptop_tb`
--

INSERT INTO `laptop_tb` (`idPrinter`, `NamaLaptop`, `SpesifikasiPrinter`, `HargaLaptop`, `stok`, `GambarPrinter`, `UserIdUser`) VALUES
(12, 'Asus', 'diskon 8%', 4500000, 47, 'download (2).jpg', NULL),
(13, 'Sony A8+', 'Gorenggg', 7000000, 39, 'download.jpg', NULL),
(14, 'ROGZ++', 'DISKON 50%', 20000000, 5, 'gambar-laptop-d.1647854423.jpg', NULL),
(15, 'Lenovo A+', 'NO LECETTT', 3000000, 13, 'gambar-laptop-d.1647854423.jpg', NULL),
(16, 'Window 11', 'Murah', 2000000, 5, 'images.jpg', NULL),
(17, 'Acer', 'Acer Wangy', 4500000, 16, 'images (1).jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` int(10) NOT NULL,
  `Jumlah` int(10) DEFAULT NULL,
  `alamat` char(255) DEFAULT NULL,
  `no_telp` int(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `NamaAnda` varchar(255) DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `HargaLaptop` int(50) DEFAULT NULL,
  `UserIdUser` int(11) NOT NULL,
  `Laptop_tblIdPrinter` int(11) NOT NULL,
  `UserIdUser2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `Jumlah`, `alamat`, `no_telp`, `email`, `NamaAnda`, `subtotal`, `status`, `tanggal`, `HargaLaptop`, `UserIdUser`, `Laptop_tblIdPrinter`, `UserIdUser2`) VALUES
(52, 1, 'Jakbar', 223567998, 'wany@gmail.com', 'M IQbal ', 7000000, 2, '2023-04-06 06:34:04', 7000000, 7, 13, 7),
(53, 1, 'Jakbar', 223567998, 'wany@gmail.com', 'M IQbal ', 4500000, 3, '2023-04-06 06:34:18', 4500000, 7, 17, 7),
(54, 1, 'Jakbar', 223567998, 'wany@gmail.com', 'M IQbal ', 20000000, 3, '2023-04-06 06:34:22', 20000000, 7, 14, 7),
(55, 2, 'Jakbar', 223567998, 'wany@gmail.com', 'M IQbal ', 9000000, 2, '2023-04-06 06:34:34', 4500000, 7, 12, 7),
(56, 1, 'Jl BOgor', 898898989, 'dani@gmail.com', 'Alex', 4500000, 2, '2023-04-06 08:04:58', 4500000, 7, 17, 7),
(57, 2, 'Jl BOgor', 898898989, 'dani@gmail.com', 'Alex', 6000000, 1, '2023-04-06 08:00:48', 3000000, 7, 15, 7),
(58, 1, 'Jl BOgor', 8866, 'dani@gmail.com', 'bayu', 7000000, 1, '2023-04-06 08:15:00', 7000000, 7, 13, 7),
(59, 1, 'Jl BOgor', 898898989, 'dani@gmail.com', 'Alex', 2000000, 1, '2023-04-06 08:30:08', 2000000, 7, 16, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(10) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `roles` int(11) DEFAULT NULL,
  `Password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `Username`, `roles`, `Password`) VALUES
(1, 'user', 1, 'user'),
(2, 'admin', 2, 'admin'),
(5, 'Goat', 1, '123'),
(6, 'admin', NULL, '321'),
(7, 'iqbal', NULL, '123'),
(8, 'dayat', NULL, '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laptop_tb`
--
ALTER TABLE `laptop_tb`
  ADD PRIMARY KEY (`idPrinter`),
  ADD UNIQUE KEY `UserIdUser` (`UserIdUser`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laptop_tb`
--
ALTER TABLE `laptop_tb`
  MODIFY `idPrinter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idTransaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laptop_tb`
--
ALTER TABLE `laptop_tb`
  ADD CONSTRAINT `laptop_tb_ibfk_1` FOREIGN KEY (`UserIdUser`) REFERENCES `user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
