-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 14, 2023 at 09:08 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_kue`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `name`) VALUES
(1, 'Kue'),
(2, 'Makanan'),
(3, 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pemesan` varchar(45) NOT NULL,
  `alamat_pemesan` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `tanggal`, `nama_pemesan`, `alamat_pemesan`, `no_hp`, `email`, `jumlah_pesanan`, `deskripsi`, `product_id`) VALUES
(2, '2023-05-14', 'Farrah', 'Jl. Cililitan Besar, RT.7/RW.11, Kb. Pala, Kec. Makasar', '08213213', 'farrah@gmail.com', 10, 'test', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga_jual` double NOT NULL,
  `harga_beli` double NOT NULL,
  `stok` int(11) NOT NULL,
  `min_stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama`, `harga_jual`, `harga_beli`, `stok`, `min_stok`, `deskripsi`, `kategori_product`) VALUES
(2, 'K3G9', 'Chocolate Cake', 129900, 79900, 50, 1, 'Delicious chocolate cake', 1),
(3, 'H6J2', 'Vanilla Cake', 109900, 69900, 30, 1, 'Classic vanilla cake', 1),
(4, 'R9L5', 'Strawberry Cake', 149900, 99900, 40, 1, 'Refreshing strawberry cake', 1),
(5, 'P2C8', 'Red Velvet Cake', 169900, 119900, 20, 1, 'Decadent red velvet cake', 1),
(6, 'T5F1', 'Carrot Cake', 139900, 89900, 25, 1, 'Moist carrot cake', 1),
(7, 'M4K7', 'Lemon Cake', 119900, 79900, 35, 1, 'Zesty lemon cake', 1),
(8, 'B7N3', 'Coconut Cake', 129900, 99900, 30, 1, 'Flavorful coconut cake', 1),
(9, 'D8V6', 'Banana Cake', 119900, 79900, 30, 1, 'Tropical banana cake', 1),
(10, 'S1W9', 'Pineapple Cake', 149900, 109900, 25, 1, 'Tangy pineapple cake', 1),
(11, 'G9T4', 'Blueberry Cake', 159900, 119900, 20, 1, 'Luscious blueberry cake', 1),
(12, 'K3H7', 'Raspberry Cake', 159900, 119900, 20, 1, 'Tart raspberry cake', 1),
(13, 'F7J2', 'Mango Cake', 149900, 109900, 25, 1, 'Tropical mango cake', 1),
(14, 'E5L6', 'Caramel Cake', 139900, 99900, 30, 1, 'Indulgent caramel cake', 1),
(15, 'R4P9', 'Hazelnut Cake', 159900, 119900, 20, 1, 'Rich hazelnut cake', 1),
(16, 'N6D3', 'Coffee Cake', 129900, 99900, 30, 1, 'Flavorful coffee cake', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id_produk_id` (`product_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id_kategori_produk` (`kategori_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_id_produk_id` FOREIGN KEY (`product_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_id_kategori_produk` FOREIGN KEY (`kategori_product`) REFERENCES `kategori_produk` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
