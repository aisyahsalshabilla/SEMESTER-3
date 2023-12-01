-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 04:43 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sirohandpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(100) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stock_minimal` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `barcode`, `nama_barang`, `harga_beli`, `harga_jual`, `stock`, `satuan`, `stock_minimal`, `gambar`) VALUES
('BRG-001', '0011', 'Gelang 1', 3000, 5000, 45, 'piece', 5, ''),
('BRG-002', '002', 'Kalung 1', 3000, 4000, 5, 'piece', 5, ''),
('BRG-003', '003', 'Cincin 1', 2000, 4000, 0, 'piece', 5, 'BRG-003.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `beli_detail`
--

CREATE TABLE `beli_detail` (
  `id` int(11) NOT NULL,
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beli_detail`
--

INSERT INTO `beli_detail` (`id`, `no_beli`, `tgl_beli`, `kode_brg`, `nama_barang`, `qty`, `harga_beli`, `jml_harga`) VALUES
(3, 'PB0001', '2023-11-29', 'BRG-001', 'BRG-001', 2, 3000, 6000),
(4, 'PB0001', '2023-11-29', 'BRG-002', 'BRG-002', 2, 3000, 6000),
(5, 'PB0002', '2023-11-29', 'BRG-001', 'BRG-001', 1, 3000, 3000),
(6, 'PB0002', '2023-11-29', 'BRG-002', 'BRG-002', 2, 3000, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `telpon`, `deskripsi`, `alamat`) VALUES
(1, 'Umum', '0000', 'Customer Umum', ''),
(2, 'Customer Lain', '0000', 'Customers Lain', '');

-- --------------------------------------------------------

--
-- Table structure for table `head_beli`
--

CREATE TABLE `head_beli` (
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `suplier` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `head_beli`
--

INSERT INTO `head_beli` (`no_beli`, `tgl_beli`, `suplier`, `total`, `keterangan`) VALUES
('', '2023-11-29', '12000', 0, ''),
('PB0001', '2023-11-29', '12000', 0, ''),
('PB0002', '2023-11-29', '', 9000, '');

-- --------------------------------------------------------

--
-- Table structure for table `jual_detail`
--

CREATE TABLE `jual_detail` (
  `id` int(11) NOT NULL,
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jual_detail`
--

INSERT INTO `jual_detail` (`id`, `no_jual`, `tgl_jual`, `barcode`, `nama_brg`, `qty`, `harga_jual`, `jml_harga`) VALUES
(1, 'PJ0001', '2023-11-29', '0011', 'gelang imut lucu', 2, 5000, 10000),
(3, 'PJ0002', '2023-11-29', '0011', 'gelang imut lucu', 2, 5000, 10000),
(4, 'PJ0003', '2023-11-29', '0011', 'gelang imut lucu', 3, 5000, 15000),
(5, 'PJ0004', '2023-11-29', '0011', 'gelang imut lucu', 3, 5000, 15000),
(6, 'PJ0005', '2023-11-30', '0011', 'gelang imut lucu', 3, 5000, 15000),
(7, 'PJ0006', '2023-11-30', '0011', 'gelang imut lucu', 3, 5000, 15000),
(8, 'PJ0007', '2023-11-30', '0011', 'gelang imut lucu', 3, 5000, 15000),
(9, 'PJ0008', '2023-11-30', '0011', 'gelang imut lucu', 2, 5000, 10000),
(10, 'PJ0009', '2023-11-30', '0011', 'gelang imut lucu', 3, 5000, 15000),
(11, 'PJ0010', '2023-11-30', '0011', 'gelang imut lucu', 2, 5000, 10000),
(12, 'PJ0011', '2023-11-30', '0011', 'gelang imut lucu', 3, 5000, 15000),
(13, 'PJ0012', '2023-11-30', '0011', 'gelang imut lucu', 2, 5000, 10000),
(14, 'PJ0013', '2023-11-30', '0011', 'gelang imut lucu', 3, 5000, 15000),
(15, 'PJ0013', '2023-11-30', '002', 'Kalung', 1, 4000, 4000),
(16, 'PJ0014', '2023-11-30', '0011', 'gelang imut lucu', 3, 5000, 15000),
(17, 'PJ0015', '2023-11-30', '0011', 'gelang imut lucu', 2, 5000, 10000),
(18, 'PJ0016', '2023-12-01', '0011', 'gelang imut lucu', 3, 5000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `jual_head`
--

CREATE TABLE `jual_head` (
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `customer` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jual_head`
--

INSERT INTO `jual_head` (`no_jual`, `tgl_jual`, `customer`, `total`, `keterangan`, `jml_bayar`, `kembalian`) VALUES
('PJ0001', '2023-11-29', 'Umum', 10000, '', 20000, 10000),
('PJ0002', '2023-11-29', 'Umum', 10000, '', 20000, 10000),
('PJ0003', '2023-11-29', 'Umum', 15000, '', 20000, 5000),
('PJ0004', '2023-11-29', 'Umum', 15000, '', 20000, 5000),
('PJ0005', '2023-11-30', 'Umum', 15000, '', 20000, 5000),
('PJ0006', '2023-11-30', 'Umum', 15000, '', 0, 0),
('PJ0007', '2023-11-30', 'Umum', 15000, '', 20000, 5000),
('PJ0008', '2023-11-30', 'Umum', 10000, '', 20000, 10000),
('PJ0009', '2023-11-30', 'Umum', 15000, '', 20000, 5000),
('PJ0010', '2023-11-30', 'Umum', 10000, '', 10000, 0),
('PJ0011', '2023-11-30', 'Umum', 15000, '', 20000, 5000),
('PJ0012', '2023-11-30', 'Umum', 10000, '', 10000, 0),
('PJ0013', '2023-11-30', 'Umum', 19000, '', 20000, 1000),
('PJ0014', '2023-11-30', 'Umum', 15000, '', 20000, 5000),
('PJ0015', '2023-11-30', 'Umum', 10000, '', 20000, 10000),
('PJ0016', '2023-12-01', 'Umum', 15000, '', 20000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` varchar(100) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1-administrator\r\n2-supervisor\r\n3-operator',
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `fullname`, `password`, `address`, `level`, `foto`) VALUES
(4, 'admin', 'administrator', '$2y$10$3bZmoAUALh9.q3DP.hoe/OKjkTkD6xhnkXlUbSYUP7tQFWx3ZpSqe', 'Jember', 1, '404-profilorg.png'),
(7, 'kasir', 'kasirku', '$2y$10$LX197tOOX3FfbfWZ3qL5WuJUtY4C.QzhEK9zEDZBuZBerapOHbhDS', 'Jember', 3, '311-fotoo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `beli_detail`
--
ALTER TABLE `beli_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `head_beli`
--
ALTER TABLE `head_beli`
  ADD PRIMARY KEY (`no_beli`);

--
-- Indexes for table `jual_detail`
--
ALTER TABLE `jual_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jual_head`
--
ALTER TABLE `jual_head`
  ADD PRIMARY KEY (`no_jual`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beli_detail`
--
ALTER TABLE `beli_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jual_detail`
--
ALTER TABLE `jual_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
