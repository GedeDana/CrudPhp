-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2022 at 09:07 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakan`
--
CREATE DATABASE IF NOT EXISTS `perpustakan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `perpustakan`;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_perpus`
--

CREATE TABLE `anggota_perpus` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `jurusan_anggota` varchar(255) NOT NULL,
  `angkatan_anggota` varchar(255) NOT NULL,
  `nim_anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota_perpus`
--

INSERT INTO `anggota_perpus` (`id_anggota`, `nama_anggota`, `jurusan_anggota`, `angkatan_anggota`, `nim_anggota`) VALUES
(1, 'I Gede Dana Suyoga', '    Sistem Informasi', '2019', 190010060),
(21, 'I Kadek Adi Suryatama', ' SIstem Komputer', '2019', 190010056);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kode_buku` varchar(255) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `jumlah_halaman` int(255) NOT NULL,
  `tahun_terbit` int(10) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kode_buku`, `judul_buku`, `pengarang`, `penerbit`, `jumlah_halaman`, `tahun_terbit`, `id_kategori`, `id_status`) VALUES
('AN89017228920', 'Suikoden 4', 'Margeng Susono', 'PT Gramedia', 640, 2009, 2, 1),
('TI98763456', '7 IN 1 Pemograman Web Untuk Pemula', 'Roni Abdulloh', 'PT Gramedia', 209, 2018, 2, 1),
('TI98763457', '7 IN 1 Pemograman Web Untuk Pemula', 'Roni Abdulloh', 'PT Gramedia', 304, 2018, 2, 2),
('TI98763458', '7 IN 1 Pemograman Web Untuk Pemula', 'Pakde', 'PT Gramedia', 304, 2018, 2, 1),
('WB20345889', 'Karl Marx dan Utopia Sosialisme', 'Margeng Susono', 'PT Gramedia', 1222, 1998, 4, 1),
('WB20345890', 'Suikoden 2', 'Margeng Susono', 'PT Gramedia', 640, 2009, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Website'),
(3, 'Sejarah'),
(4, 'Filsafat'),
(5, 'Anime');

-- --------------------------------------------------------

--
-- Table structure for table `status_buku`
--

CREATE TABLE `status_buku` (
  `id_status` int(11) NOT NULL,
  `status_buku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_buku`
--

INSERT INTO `status_buku` (`id_status`, `status_buku`) VALUES
(1, 'Ada'),
(2, 'Tidak ada');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pinjam`
--

CREATE TABLE `transaksi_pinjam` (
  `id_transaksi` int(11) NOT NULL,
  `kode_buku` varchar(255) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal_pinjam` varchar(255) NOT NULL,
  `tanggal_kembali` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_pinjam`
--

INSERT INTO `transaksi_pinjam` (`id_transaksi`, `kode_buku`, `id_anggota`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(71, 'AN89017228920', 1, '25-06-2022', '08-08-2022', 'Kembali'),
(73, 'TI98763456', 1, '20-06-2022', '21-06-2022', 'Kembali'),
(74, 'AN89017228920', 1, '15-06-2022', '20-06-2022', 'Kembali'),
(75, 'TI98763457', 1, '26-06-2022', '05-07-2022', 'Pinjam');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(100) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `jabatan_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `status_buku`
--
ALTER TABLE `status_buku`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `transaksi_pinjam`
--
ALTER TABLE `transaksi_pinjam`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_buku`
--
ALTER TABLE `status_buku`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_pinjam`
--
ALTER TABLE `transaksi_pinjam`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_buku` (`id_kategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status_buku` (`id_status`);

--
-- Constraints for table `transaksi_pinjam`
--
ALTER TABLE `transaksi_pinjam`
  ADD CONSTRAINT `transaksi_pinjam_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota_perpus` (`id_anggota`),
  ADD CONSTRAINT `transaksi_pinjam_ibfk_2` FOREIGN KEY (`kode_buku`) REFERENCES `buku` (`kode_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
