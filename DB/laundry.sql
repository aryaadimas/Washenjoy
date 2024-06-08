-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 06:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `alamat`, `nomor_hp`, `email`, `foto_admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Diana Putri', '-', '6281240933810', 'diana@gmail.com', '4.jpg'),
(2, 'vinka', '7fba6f27e65481b56f562c626693b020', 'vinka amelia', 'surabaya', '0897456789', 'vinka@gmail.com', '2.png');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `odr_id` int(11) NOT NULL,
  `id_pel` int(11) NOT NULL,
  `kar_pencuci` int(11) NOT NULL,
  `kar_jemput` int(11) NOT NULL,
  `kar_antar` int(11) NOT NULL,
  `rating_laundry` int(11) NOT NULL,
  `rating_pencuci` int(11) NOT NULL,
  `rating_jemput` int(11) NOT NULL,
  `rating_antar` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `foto_laundry` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `odr_id`, `id_pel`, `kar_pencuci`, `kar_jemput`, `kar_antar`, `rating_laundry`, `rating_pencuci`, `rating_jemput`, `rating_antar`, `keterangan`, `tanggal`, `foto_laundry`) VALUES
(15, 18, 7, 12, 13, 14, 5, 5, 5, 5, 'Kerenn', '2023-10-16', '697885228_sp.jpeg'),
(16, 20, 7, 12, 13, 14, 5, 5, 5, 5, 'Keren', '2023-10-16', '1641296770_sp.jpeg'),
(17, 33, 9, 12, 13, 14, 4, 5, 4, 4, 'okeokeoke', '2024-06-07', ''),
(18, 35, 9, 12, 13, 14, 4, 5, 4, 4, 'mantap', '2024-06-07', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_order`
--

CREATE TABLE `tb_detail_order` (
  `id_detail_order` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `estimasi` int(11) NOT NULL,
  `total_harga_peritem` int(11) NOT NULL,
  `bukti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_detail_order`
--

INSERT INTO `tb_detail_order` (`id_detail_order`, `order_id`, `item_id`, `jumlah_item`, `berat`, `estimasi`, `total_harga_peritem`, `bukti`) VALUES
(47, 25, 17, 4, 3, 7000, 61000, 0),
(51, 32, 25, 1, 1, 12000, 62000, 0),
(52, 33, 19, 2, 2, 7000, 34000, 0),
(53, 34, 21, 2, 2, 12000, 44000, 0),
(54, 35, 19, 3, 2, 12000, 54000, 0),
(55, 35, 22, 3, 2, 7000, 68000, 0);

--
-- Triggers `tb_detail_order`
--
DELIMITER $$
CREATE TRIGGER `PenguranganBahan` AFTER INSERT ON `tb_detail_order` FOR EACH ROW BEGIN
    UPDATE tb_stok_bahan
    SET jumlah_stok = jumlah_stok - NEW.jumlah_item
    WHERE id_bahan = NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_diskon`
--

CREATE TABLE `tb_diskon` (
  `id_diskon` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga_diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_diskon`
--

INSERT INTO `tb_diskon` (`id_diskon`, `berat`, `harga_diskon`) VALUES
(1, 10, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_estimasi`
--

CREATE TABLE `tb_estimasi` (
  `id_estimasi` int(11) NOT NULL,
  `nama_estimasi` varchar(50) NOT NULL,
  `hari` int(11) NOT NULL,
  `harga_perkilo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_estimasi`
--

INSERT INTO `tb_estimasi` (`id_estimasi`, `nama_estimasi`, `hari`, `harga_perkilo`) VALUES
(1, 'Reguler', 3, 7000),
(2, 'Express', 1, 12000),
(3, 'Kilat', 6, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `id_item` int(11) NOT NULL,
  `nama_item` varchar(50) NOT NULL,
  `harga_peritem` int(11) NOT NULL,
  `deskripsi_item` text NOT NULL,
  `foto_item` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`id_item`, `nama_item`, `harga_peritem`, `deskripsi_item`, `foto_item`) VALUES
(16, 'Sprei 1 set', 15000, '-', ''),
(17, 'Selimut Kecil', 10000, '-', ''),
(18, 'Selimut Besar', 18000, '-', ''),
(19, 'Bad Cover Kecil', 10000, '-', ''),
(20, 'Bad Cover Besar', 25000, '-', ''),
(21, 'Karpet Tipis', 10000, '-', ''),
(22, 'Karpet Tebal', 18000, '-', ''),
(23, 'Bag  & Backpack Care Small', 35000, 'Cuci Bagian Luar dalam (ets 2-3 hari)', ''),
(24, 'Bag  & Backpack Care Large', 100000, 'Cuci Bagian Luar dalam (ets 2-3 Hari)', ''),
(25, 'Shoes Care Deep Clean', 50000, 'cusi bagian luar dalam (ets 1-2 hari)', ''),
(26, 'Shoes Care Lether Shoes Care', 65000, 'Perawatan sepatu kulit, termasuk deep clean (ets 2-3 hari)', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `username_kar` varchar(50) NOT NULL,
  `password_kar` varchar(80) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `alamat_karyawan` text NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto_kar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `username_kar`, `password_kar`, `nama_karyawan`, `alamat_karyawan`, `nomor_hp`, `jabatan`, `foto_kar`) VALUES
(12, 'aliyah', '22f1dffdbf5d57f369c3fb8d3053128d', 'Aliyah Alifi', '-ketintang', '085239163541', 'Pencucian', 'orange mood.jpeg'),
(13, 'yeskil', 'c2e933b5b18b1c21c6bf873e4cfb76fe', 'yehezkiel fienathan', '-surabaya', '085268245987', 'Petugas Jemput', 'Sakera ✨.jpeg'),
(14, 'arya', '5882985c8b1e2dce2763072d56a1d6e5', 'Arya dimas', '-surabaya', '085859547269', 'Petugas Antar', 'Sakera ✨.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `kodeorder` varchar(50) NOT NULL,
  `pel_id` int(11) NOT NULL,
  `kar_id` int(11) NOT NULL,
  `status_order` int(11) NOT NULL,
  `tanggal_order` date DEFAULT NULL,
  `kurir_jemput` int(11) NOT NULL,
  `kurir_antar` int(11) NOT NULL,
  `tgl_selesai` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_notif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `kodeorder`, `pel_id`, `kar_id`, `status_order`, `tanggal_order`, `kurir_jemput`, `kurir_antar`, `tgl_selesai`, `total_harga`, `status_notif`) VALUES
(25, '829878', 7, 12, 1, '2024-03-05', 0, 0, '0000-00-00', 61000, 'dilihat'),
(26, '944760', 8, 12, 1, '2024-06-07', 0, 0, '0000-00-00', 58000, 'belum dilihat'),
(27, '242096', 8, 12, 1, '2024-06-07', 0, 0, '0000-00-00', 58000, 'belum dilihat'),
(28, '316630', 8, 12, 1, '2024-06-07', 0, 0, '0000-00-00', 78000, 'belum dilihat'),
(29, '614596', 8, 12, 1, '2024-06-07', 0, 0, '0000-00-00', 105000, 'belum dilihat'),
(30, '320349', 8, 12, 1, '2024-06-07', 0, 0, '0000-00-00', 105000, 'belum dilihat'),
(31, '602922', 9, 12, 2, '2024-06-07', 13, 0, '0000-00-00', 62000, 'dilihat'),
(32, '883443', 9, 12, 6, '2024-06-07', 0, 0, '0000-00-00', 62000, 'dilihat'),
(33, '662768', 9, 12, 9, '2024-06-07', 13, 14, '0000-00-00', 34000, 'dilihat'),
(34, '181599', 8, 12, 8, '2024-06-07', 0, 0, '0000-00-00', 44000, 'belum dilihat'),
(35, '841875', 9, 12, 9, '2024-06-07', 13, 14, '0000-00-00', 122000, 'dilihat');

--
-- Triggers `tb_order`
--
DELIMITER $$
CREATE TRIGGER `PenguranganStokBahan` AFTER INSERT ON `tb_order` FOR EACH ROW BEGIN
    -- Mengurangi jumlah_stok pada semua bahan sebesar 1
    UPDATE tb_stok_bahan
    SET jumlah_stok = jumlah_stok - 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `username_pel` varchar(50) NOT NULL,
  `password_pel` varchar(80) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `last_login` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `username_pel`, `password_pel`, `nama_pelanggan`, `alamat`, `nomor_hp`, `email`, `foto`, `last_login`) VALUES
(8, 'alyaa', '32ea9dbd75cdfdfe1dc539e38fc7ad8c', 'alyaaa', 'surabaya', '09865345678', 'alya@gmail.com', 'logo akun.jpeg', '22:10:37'),
(9, 'mike', '18126e7bd3f84b3f3e4df094def5b7de', 'mikeyy', 'surabaya', '009854567', 'mike@gmail.com', 'Sakera ✨.jpeg', '23:41:17'),
(10, 'zaki', '9784ea3da268563469df99b2e6593564', 'zaki', 'surabaya', '08983456789', 'zaki@gmail.com', 'jasmine.png', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok_bahan`
--

CREATE TABLE `tb_stok_bahan` (
  `id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_stok_bahan`
--

INSERT INTO `tb_stok_bahan` (`id_bahan`, `nama_bahan`, `jumlah_stok`, `satuan`, `gambar`) VALUES
(1, 'Deterjen', 3, 'Box', 'Deterjen.jpeg'),
(2, 'Pemutih', 18, 'Box', 'Pemutih.jpeg'),
(3, 'Pelembut pakaian', 18, 'Box', 'Pelembut pakaian.jpeg'),
(4, 'Penghilang noda', 18, 'Box', 'Penghilang noda.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `metode _bayar` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `orderid`, `metode _bayar`, `tanggal`, `total_bayar`) VALUES
(42, 25, '', '2024-03-05', 61000),
(43, 32, '', '2024-06-07', 62000),
(44, 33, '', '2024-06-07', 34000),
(45, 34, '', '2024-06-07', 44000),
(46, 35, '', '2024-06-07', 122000),
(47, 35, '', '2024-06-07', 122000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD PRIMARY KEY (`id_detail_order`);

--
-- Indexes for table `tb_diskon`
--
ALTER TABLE `tb_diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `tb_estimasi`
--
ALTER TABLE `tb_estimasi`
  ADD PRIMARY KEY (`id_estimasi`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_stok_bahan`
--
ALTER TABLE `tb_stok_bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  MODIFY `id_detail_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_diskon`
--
ALTER TABLE `tb_diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_estimasi`
--
ALTER TABLE `tb_estimasi`
  MODIFY `id_estimasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_stok_bahan`
--
ALTER TABLE `tb_stok_bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
