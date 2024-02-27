-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 10:40 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir_winda`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_produk` ()  SELECT tbl_produk.id_produk,tbl_produk.kode_produk,tbl_produk.nama_produk,tbl_kategori.nama_kategori,tbl_satuan.nama_satuan,
        tbl_produk.harga_beli,tbl_produk.harga_jual,
        tbl_produk.stok
        FROM tbl_produk
        JOIN tbl_satuan on tbl_satuan.id_satuan=tbl_produk.id_satuan
        join tbl_kategori on tbl_kategori.id_kategori=tbl_produk.id_kategori
        WHERE stok > 0$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_penjualan`
--

CREATE TABLE `tbl_detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detail_penjualan`
--

INSERT INTO `tbl_detail_penjualan` (`id_detail`, `id_penjualan`, `id_produk`, `qty`, `total_harga`) VALUES
(6, 4, 28, 3, '30000000'),
(7, 4, 28, 3, '30000000'),
(8, 4, 30, 3, '6000000'),
(9, 4, 29, 3, '3000000'),
(10, 5, 28, 1, '10000000');

--
-- Triggers `tbl_detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangistok` AFTER INSERT ON `tbl_detail_penjualan` FOR EACH ROW UPDATE tbl_produk SET tbl_produk.stok = tbl_produk.stok - NEW.qty WHERE tbl_produk.id_produk = NEW.id_produk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nambahTotalHarga` AFTER INSERT ON `tbl_detail_penjualan` FOR EACH ROW UPDATE tbl_penjualan SET tbl_penjualan.total = tbl_penjualan.total + NEW.total_harga WHERE tbl_penjualan.id_penjualan = NEW.id_penjualan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(8, 'flatshoes'),
(9, 'sneakers'),
(10, 'higheels');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` enum('admin','kasir','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'winda siti', 'winda', '12345', 'admin'),
(2, 'christian', 'ian', '4567', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `no_faktur` varchar(32) NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id_penjualan`, `no_faktur`, `tgl_penjualan`, `id_user`, `total`) VALUES
(4, 'KSRWD2402270001', '2024-02-27 15:43:34', 2, '3000000'),
(5, 'KSRWD2402270002', '2024-02-27 16:01:38', 2, '10000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(11) NOT NULL,
  `nama_produk` varchar(32) NOT NULL,
  `harga_beli` decimal(10,0) NOT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `id_satuan`, `id_kategori`, `stok`) VALUES
(28, 'PRD001', 'adidas', '5000000', '10000000', 1, 9, 99),
(29, 'PRD002', 'YSL', '900000', '1000000', 1, 10, 9),
(30, 'PRD003', 'zara', '1000000', '2000000', 4, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'box'),
(4, 'pasang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  ADD CONSTRAINT `tbl_detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_penjualan` (`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_penjualan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD CONSTRAINT `tbl_penjualan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_pengguna` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `tbl_satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
