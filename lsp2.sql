-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Apr 2023 pada 17.29
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsp2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laptop_tb`
--

CREATE TABLE `laptop_tb` (
  `idPrinter` int(10) NOT NULL,
  `NamaLaptop` char(50) DEFAULT NULL,
  `SpesifikasiPrinter` char(50) DEFAULT NULL,
  `HargaLaptop` int(50) DEFAULT NULL,
  `stok` int(255) DEFAULT NULL,
  `GambarPrinter` varchar(50) NOT NULL,
  `UserIdUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laptop_tb`
--

INSERT INTO `laptop_tb` (`idPrinter`, `NamaLaptop`, `SpesifikasiPrinter`, `HargaLaptop`, `stok`, `GambarPrinter`, `UserIdUser`) VALUES
(25, 'Acer Prants', 'Cepat Untuk Ngeprint', 3400000, 9, 'download (1).jpg', NULL),
(26, 'P Asus', 'Diskon 50%', 3500000, 14, 'banner.png', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `Jumlah`, `alamat`, `no_telp`, `email`, `NamaAnda`, `subtotal`, `status`, `tanggal`, `HargaLaptop`, `UserIdUser`, `Laptop_tblIdPrinter`, `UserIdUser2`) VALUES
(108, 2, 'JKT', 2147483647, 'rasyidiqbal52@gmail.com', 'DAX CIN NO', 8000, 2, '2023-04-11 11:20:45', 4000, 7, 24, 7),
(113, 1, 'JKT', 2147483647, 'rhtgdfs83@gmail.com', 'Muhammad Iqbal Arrasyid', 43242, 2, '2023-04-11 11:50:25', 43242, 9, 25, 9),
(114, 1, 'Mars', 2147483647, 'rasyidiqbal52@gmail.com', 'Alexuyy', 3123, 2, '2023-04-11 11:50:26', 3123, 9, 26, 9),
(115, 2, 'JKT', 2147483647, 'rasyidiqbal52@gmail.com', 'Alexuyy', 6246, 2, '2023-04-11 12:00:21', 3123, 9, 26, 9),
(116, 1, 'JKT', 2147483647, 'rasyidiqbal52@gmail.com', 'DAX CIN NO', 3123, 2, '2023-04-11 12:08:35', 3123, 9, 26, 9),
(117, 1, 'JKT', 2147483647, 'rasyidiqbal52@gmail.com', 'Alexuyy', 43242, 1, '2023-04-11 12:09:25', 43242, 9, 25, 9),
(118, 1, 'Jakarta', 9221344, 'dianl52@gmail.com', 'Dina', 43242, 1, '2023-04-11 12:36:06', 43242, 7, 25, 7),
(119, 1, 'Bumi', 9213445, 'Sateol52@gmail.com', 'Satria', 43242, 1, '2023-04-11 12:37:44', 43242, 7, 25, 7),
(120, 2, 'Yt', 2811293, 'dav83@gmail.com', 'david', 12000000, 2, '2023-04-11 14:42:31', 6000000, 7, 27, 7),
(121, 6, 'jln Kucing', 314827842, 'maw6@gmail.com', 'Miaw', 36000000, 2, '2023-04-11 15:03:26', 6000000, 7, 27, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(10) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `roles` int(11) DEFAULT NULL,
  `Password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `Username`, `roles`, `Password`) VALUES
(1, 'user', 1, 'user'),
(2, 'admin', 2, 'admin'),
(5, 'Goat', 1, '123'),
(6, 'admin', NULL, '321'),
(7, 'iqbal', NULL, '123'),
(8, 'dayat', NULL, '123'),
(9, 'boy', NULL, '123'),
(10, 'admin', NULL, '123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laptop_tb`
--
ALTER TABLE `laptop_tb`
  ADD PRIMARY KEY (`idPrinter`),
  ADD UNIQUE KEY `UserIdUser` (`UserIdUser`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laptop_tb`
--
ALTER TABLE `laptop_tb`
  MODIFY `idPrinter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idTransaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laptop_tb`
--
ALTER TABLE `laptop_tb`
  ADD CONSTRAINT `laptop_tb_ibfk_1` FOREIGN KEY (`UserIdUser`) REFERENCES `user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
