-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2020 pada 16.03
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoonlinerev`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jasa_pengiriman`
--

CREATE TABLE `t_jasa_pengiriman` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_jasa_pengiriman`
--

INSERT INTO `t_jasa_pengiriman` (`id`, `nama`) VALUES
(1, 'TIKI'),
(2, 'JNE'),
(3, 'JNT'),
(4, 'Ini Paket');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kategori`
--

CREATE TABLE `t_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_kategori`
--

INSERT INTO `t_kategori` (`id`, `nama`) VALUES
(1, 'Pakaian Pria'),
(2, 'Pakaian Wanita'),
(4, 'Elektronik'),
(5, 'Rumah Tangga'),
(6, 'Fashion'),
(7, 'Jam Tangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_keranjang`
--

CREATE TABLE `t_keranjang` (
  `nama_produk` varchar(100) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `id_nota` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_keranjang`
--

INSERT INTO `t_keranjang` (`nama_produk`, `harga_satuan`, `jumlah`, `subtotal`, `id_nota`, `id_produk`) VALUES
('Patek Philippe', '2799900.00', 2, '5599800.00', 13, 1),
('Rolex Daytona', '3750000.00', 2, '7500000.00', 14, 2),
('Patek Philippe', '2799900.00', 1, '2799900.00', 34, 1),
('Rolex Daytona', '3750000.00', 1, '3750000.00', 34, 2),
('Patek Philippe', '2799900.00', 8, '22399200.00', 37, 1),
('Rolex Daytona', '3750000.00', 9, '33750000.00', 38, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_menu`
--

CREATE TABLE `t_menu` (
  `id` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `active` varchar(30) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_menu`
--

INSERT INTO `t_menu` (`id`, `urutan`, `url`, `nama`, `icon`, `active`, `id_role`) VALUES
(1, 1, 'a/home', 'Home', 'fas fa-home', 'home_active', 1),
(2, 7, 'a/logout', 'Logout', 'fas fa-power-off', '', 1),
(3, 2, 'a/category', 'Kategori', 'fas fa-list', 'category_active', 1),
(4, 3, 'a/product', 'Produk', 'fas fa-list', 'product_active', 1),
(5, 4, 'a/supplier', 'Supplier', 'fas fa-list', 'supplier_active', 1),
(6, 6, 'a/inventory', 'Riwayat Pembelian', 'fas fa-list', 'inventory_active', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_nota`
--

CREATE TABLE `t_nota` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `ppn` decimal(5,2) NOT NULL,
  `tagihan` decimal(20,2) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `jenis_faktur` varchar(20) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `status_transaksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_nota`
--

INSERT INTO `t_nota` (`id`, `tanggal`, `total`, `ppn`, `tagihan`, `id_customer`, `nama_customer`, `jenis_faktur`, `id_pegawai`, `nama_pegawai`, `status_transaksi`) VALUES
(13, '2020-04-24 02:29:01', '5599800.00', '10.00', '6159780.00', 1, 'PT Adil Makmur Indonesia Tbk', 'pembelian', 1, 'Rifqi Ardhian', 'success'),
(14, '2020-04-24 07:47:49', '7500000.00', '10.00', '8250000.00', 1, 'PT Adil Makmur Indonesia Tbk', 'pembelian', 1, 'Rifqi Ardhian', 'success'),
(34, '2020-04-25 09:45:42', '6549900.00', '10.00', '7204890.00', 5, 'Rifqi Ardhian', 'penjualan', 0, '', 'success'),
(37, '2020-04-25 13:57:37', '22399200.00', '10.00', '24639120.00', 1, 'PT Adil Makmur Indonesia Tbk', 'pembelian', 1, 'Rifqi Ardhian', 'success'),
(38, '2020-04-25 13:58:30', '33750000.00', '10.00', '37125000.00', 1, 'PT Adil Makmur Indonesia Tbk', 'pembelian', 1, 'Rifqi Ardhian', 'success');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pengiriman`
--

CREATE TABLE `t_pengiriman` (
  `id` int(11) NOT NULL,
  `id_nota` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `id_jasa_pengiriman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_pengiriman`
--

INSERT INTO `t_pengiriman` (`id`, `id_nota`, `alamat_pengiriman`, `kecamatan`, `kota`, `provinsi`, `kodepos`, `telepon`, `id_jasa_pengiriman`) VALUES
(2, 34, 'Jalan Bendungan Wlingi No. 30', 'Lowokwaru', 'Malang', 'Jawa Timur', 65145, '6281334457150', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_preview_produk`
--

CREATE TABLE `t_preview_produk` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_preview_produk`
--

INSERT INTO `t_preview_produk` (`id`, `foto`, `id_produk`) VALUES
(1, 'assets/produkpreview/men.png', 1),
(2, 'assets/produkpreview/coupe.png', 1),
(3, 'assets/produkpreview/women.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_produk`
--

CREATE TABLE `t_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_produk`
--

INSERT INTO `t_produk` (`id`, `nama`, `foto`, `harga`, `deskripsi`, `stok`, `id_kategori`) VALUES
(1, 'Patek Philippe', 'assets/gambarproduk/patek.png', '2799900.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 9, 7),
(2, 'Rolex Daytona', 'assets/gambarproduk/rolex.png', '3750000.00', 'Swiss Made', 10, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_role`
--

CREATE TABLE `t_role` (
  `id` int(11) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_role`
--

INSERT INTO `t_role` (`id`, `role`) VALUES
(1, 'Pegawai'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_supplier`
--

CREATE TABLE `t_supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_supplier`
--

INSERT INTO `t_supplier` (`id`, `nama`, `telepon`, `provinsi`, `kota`, `kecamatan`, `kodepos`, `alamat`) VALUES
(1, 'PT Adil Makmur Indonesia Tbk', '081123456788', 'Jawa Timur', 'Malang', 'Klojen', 65145, 'Jalan Raya No. 7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `provinsi` varchar(45) NOT NULL,
  `kota` varchar(45) NOT NULL,
  `kecamatan` varchar(45) NOT NULL,
  `kodepos` int(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id`, `nama`, `email`, `password`, `telepon`, `provinsi`, `kota`, `kecamatan`, `kodepos`, `alamat`, `id_role`) VALUES
(1, 'Rifqi Ardhian', 'rifqiardhian@gmail.com', '83c9c36fcc0b177e01d6182b2583bb30', '6281334457150', '', '', '', 0, '', 1),
(5, 'Rifqi Ardhian', 'rifqiardhian@gmail.com', '62a415ea2b60a33b87aa005cb9c4e9ff', '6281334457150', 'Jawa Timur', 'Malang', 'Lowokwaru', 65145, 'Jalan Bendungan Wlingi No. 30', 2),
(6, 'Administrator', 'admin@helpdesk.it', '7488e331b8b64e5794da3fa4eb10ad5d', '6281336778789', '', '', '', 0, '', 1);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_produk_kategori`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_produk_kategori` (
`id` int(11)
,`nama_produk` varchar(100)
,`harga` decimal(10,2)
,`deskripsi` text
,`foto` varchar(255)
,`stok` int(11)
,`kategori` varchar(100)
,`id_kategori` int(11)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_produk_kategori`
--
DROP TABLE IF EXISTS `v_produk_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_produk_kategori`  AS  select `t_produk`.`id` AS `id`,`t_produk`.`nama` AS `nama_produk`,`t_produk`.`harga` AS `harga`,`t_produk`.`deskripsi` AS `deskripsi`,`t_produk`.`foto` AS `foto`,`t_produk`.`stok` AS `stok`,`t_kategori`.`nama` AS `kategori`,`t_kategori`.`id` AS `id_kategori` from (`t_produk` join `t_kategori` on((`t_produk`.`id_kategori` = `t_kategori`.`id`))) order by `t_produk`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_jasa_pengiriman`
--
ALTER TABLE `t_jasa_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_menu`
--
ALTER TABLE `t_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_nota`
--
ALTER TABLE `t_nota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_pengiriman`
--
ALTER TABLE `t_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_preview_produk`
--
ALTER TABLE `t_preview_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_produk`
--
ALTER TABLE `t_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_supplier`
--
ALTER TABLE `t_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_jasa_pengiriman`
--
ALTER TABLE `t_jasa_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `t_menu`
--
ALTER TABLE `t_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_nota`
--
ALTER TABLE `t_nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `t_pengiriman`
--
ALTER TABLE `t_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_preview_produk`
--
ALTER TABLE `t_preview_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_produk`
--
ALTER TABLE `t_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_supplier`
--
ALTER TABLE `t_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
