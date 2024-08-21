-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2023 pada 01.24
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_murakatasport`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detailbarang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detailbarang` (
`kd_barang` varchar(7)
,`nama_barang` varchar(40)
,`kd_merek` varchar(7)
,`kd_distributor` varchar(7)
,`harga_modal` int(7)
,`harga_barang` int(7)
,`stok_barang` int(4)
,`gambar` varchar(255)
,`keterangan` varchar(200)
,`merek` varchar(30)
,`foto_merek` varchar(50)
,`nama_distributor` varchar(40)
,`no_telp` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detailtransaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detailtransaksi` (
`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`kd_user` varchar(7)
,`nama_user` varchar(20)
,`kd_barang` varchar(11)
,`jumlah` int(4)
,`sub_totalmodal` int(8)
,`sub_total` int(8)
,`nama_barang` varchar(40)
,`harga_barang` int(7)
,`jumlah_beli` int(4)
,`total_harga` int(8)
,`total_modal` int(8)
,`tanggal_beli` date
,`waktu_beli` time
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_barang`
--

CREATE TABLE `table_barang` (
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kd_merek` varchar(7) NOT NULL,
  `kd_distributor` varchar(7) NOT NULL,
  `harga_modal` int(7) NOT NULL,
  `harga_barang` int(7) NOT NULL,
  `stok_barang` int(4) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_barang`
--

INSERT INTO `table_barang` (`kd_barang`, `nama_barang`, `kd_merek`, `kd_distributor`, `harga_modal`, `harga_barang`, `stok_barang`, `gambar`, `keterangan`) VALUES
('BR001', 'Barang1', 'ME001', 'DS002', 15000, 20000, 0, '167524643144.png', 'Makjreng'),
('BR002', 'Barang2', 'ME001', 'DS002', 31000, 32000, 0, '1675246802927.jpeg', 'Makjreng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_biayaoperasional`
--

CREATE TABLE `table_biayaoperasional` (
  `kd_biayaoperasional` varchar(7) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `table_biayaoperasional`
--

INSERT INTO `table_biayaoperasional` (`kd_biayaoperasional`, `tanggal`, `keterangan`, `kategori`, `jumlah`) VALUES
('BO001', '2023-02-03', 'Tes', 'Perbaikan', 300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_distributor`
--

CREATE TABLE `table_distributor` (
  `kd_distributor` varchar(7) NOT NULL,
  `nama_distributor` varchar(40) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_distributor`
--

INSERT INTO `table_distributor` (`kd_distributor`, `nama_distributor`, `alamat`, `no_telp`) VALUES
('DS001', 'Cahyono', 'Tajur Bogor', '081288819999'),
('DS002', 'Susanti', 'Bogor', '083812991999');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_merek`
--

CREATE TABLE `table_merek` (
  `kd_merek` varchar(7) NOT NULL,
  `merek` varchar(30) NOT NULL,
  `foto_merek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_merek`
--

INSERT INTO `table_merek` (`kd_merek`, `merek`, `foto_merek`) VALUES
('ME001', 'Tiktok', '1675232579545.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_pretransaksi`
--

CREATE TABLE `table_pretransaksi` (
  `kd_pretransaksi` varchar(7) NOT NULL,
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `sub_total` int(8) NOT NULL,
  `sub_totalmodal` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_pretransaksi`
--

INSERT INTO `table_pretransaksi` (`kd_pretransaksi`, `kd_transaksi`, `kd_barang`, `nama_barang`, `jumlah`, `sub_total`, `sub_totalmodal`) VALUES
('AN001', 'TR001', 'BR001', 'Barang1', 5, 100000, 75000),
('AN002', 'TR002', 'BR002', 'Barang2', 2, 64000, 62000),
('AN003', 'TR003', 'BR002', 'Barang2', 2, 64000, 62000),
('AN004', 'TR004', 'BR001', 'Barang1', 2, 40000, 30000);

--
-- Trigger `table_pretransaksi`
--
DELIMITER $$
CREATE TRIGGER `batal_beli` AFTER DELETE ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + OLD.jumlah
WHERE kd_barang = OLD.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaksi` AFTER INSERT ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang - new.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_beli` AFTER UPDATE ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + OLD.jumlah - NEW.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_stokmasuk`
--

CREATE TABLE `table_stokmasuk` (
  `kd_stokmasuk` varchar(7) NOT NULL,
  `tanggal` date NOT NULL,
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_modal` int(7) NOT NULL,
  `jumlah` int(7) NOT NULL,
  `distributor` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `table_stokmasuk`
--
DELIMITER $$
CREATE TRIGGER `hapus_stok` AFTER DELETE ON `table_stokmasuk` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang - old.jumlah
WHERE kd_barang = old.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_masuk` AFTER INSERT ON `table_stokmasuk` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + new.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_user` varchar(7) NOT NULL,
  `jumlah_beli` int(4) NOT NULL,
  `total_harga` int(8) NOT NULL,
  `total_modal` int(8) NOT NULL,
  `tanggal_beli` date NOT NULL DEFAULT current_timestamp(),
  `waktu_beli` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_transaksi`
--

INSERT INTO `table_transaksi` (`kd_transaksi`, `kd_user`, `jumlah_beli`, `total_harga`, `total_modal`, `tanggal_beli`, `waktu_beli`) VALUES
('TR001', 'US003', 7, 164000, 137000, '2023-01-31', '17:23:17'),
('TR002', 'US003', 4, 104000, 92000, '2023-02-01', '20:00:22'),
('TR003', 'US003', 4, 104000, 92000, '2023-01-30', '20:00:22'),
('TR004', 'US003', 4, 104000, 92000, '2023-01-29', '20:00:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_user`
--

CREATE TABLE `table_user` (
  `kd_user` varchar(7) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `foto_user` varchar(50) NOT NULL,
  `level` enum('Admin','Kasir','Manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_user`
--

INSERT INTO `table_user` (`kd_user`, `nama_user`, `username`, `password`, `foto_user`, `level`) VALUES
('US001', 'MANAGER', 'manager', 'bWFuYWdlcjEyMw==', '1538303665653.png', 'Manager'),
('US002', 'ADMIN', 'admin123', 'YWRtaW4xMjM=', '153777087384.png', 'Admin'),
('US003', 'KASIR', 'kasir123', 'a2FzaXIxMjM=', '1537840377928.png', 'Kasir');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `transaksi` (
`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`kd_barang` varchar(11)
,`jumlah` int(4)
,`sub_total` int(8)
,`sub_totalmodal` int(8)
,`nama_barang` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `transaksi_terbaru`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `transaksi_terbaru` (
`kd_transaksi` varchar(7)
,`kd_user` varchar(7)
,`jumlah_beli` int(4)
,`total_modal` int(8)
,`total_harga` int(8)
,`tanggal_beli` date
,`nama_user` varchar(20)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `detailbarang`
--
DROP TABLE IF EXISTS `detailbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailbarang`  AS  select `table_barang`.`kd_barang` AS `kd_barang`,`table_barang`.`nama_barang` AS `nama_barang`,`table_barang`.`kd_merek` AS `kd_merek`,`table_barang`.`kd_distributor` AS `kd_distributor`,`table_barang`.`harga_modal` AS `harga_modal`,`table_barang`.`harga_barang` AS `harga_barang`,`table_barang`.`stok_barang` AS `stok_barang`,`table_barang`.`gambar` AS `gambar`,`table_barang`.`keterangan` AS `keterangan`,`table_merek`.`merek` AS `merek`,`table_merek`.`foto_merek` AS `foto_merek`,`table_distributor`.`nama_distributor` AS `nama_distributor`,`table_distributor`.`no_telp` AS `no_telp` from ((`table_barang` join `table_merek` on(`table_barang`.`kd_merek` = `table_merek`.`kd_merek`)) join `table_distributor` on(`table_barang`.`kd_distributor` = `table_distributor`.`kd_distributor`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detailtransaksi`
--
DROP TABLE IF EXISTS `detailtransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailtransaksi`  AS  select `table_pretransaksi`.`kd_pretransaksi` AS `kd_pretransaksi`,`table_pretransaksi`.`kd_transaksi` AS `kd_transaksi`,`table_transaksi`.`kd_user` AS `kd_user`,`table_user`.`nama_user` AS `nama_user`,`table_pretransaksi`.`kd_barang` AS `kd_barang`,`table_pretransaksi`.`jumlah` AS `jumlah`,`table_pretransaksi`.`sub_totalmodal` AS `sub_totalmodal`,`table_pretransaksi`.`sub_total` AS `sub_total`,`table_barang`.`nama_barang` AS `nama_barang`,`table_barang`.`harga_barang` AS `harga_barang`,`table_transaksi`.`jumlah_beli` AS `jumlah_beli`,`table_transaksi`.`total_harga` AS `total_harga`,`table_transaksi`.`total_modal` AS `total_modal`,`table_transaksi`.`tanggal_beli` AS `tanggal_beli`,`table_transaksi`.`waktu_beli` AS `waktu_beli` from (((`table_pretransaksi` join `table_barang` on(`table_pretransaksi`.`kd_barang` = `table_barang`.`kd_barang`)) join `table_transaksi` on(`table_transaksi`.`kd_transaksi` = `table_pretransaksi`.`kd_transaksi`)) join `table_user` on(`table_user`.`kd_user` = `table_transaksi`.`kd_user`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `transaksi`
--
DROP TABLE IF EXISTS `transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi`  AS  select `table_pretransaksi`.`kd_pretransaksi` AS `kd_pretransaksi`,`table_pretransaksi`.`kd_transaksi` AS `kd_transaksi`,`table_pretransaksi`.`kd_barang` AS `kd_barang`,`table_pretransaksi`.`jumlah` AS `jumlah`,`table_pretransaksi`.`sub_total` AS `sub_total`,`table_pretransaksi`.`sub_totalmodal` AS `sub_totalmodal`,`table_barang`.`nama_barang` AS `nama_barang` from (`table_pretransaksi` join `table_barang` on(`table_pretransaksi`.`kd_barang` = `table_barang`.`kd_barang`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `transaksi_terbaru`
--
DROP TABLE IF EXISTS `transaksi_terbaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_terbaru`  AS  select `table_transaksi`.`kd_transaksi` AS `kd_transaksi`,`table_transaksi`.`kd_user` AS `kd_user`,`table_transaksi`.`jumlah_beli` AS `jumlah_beli`,`table_transaksi`.`total_modal` AS `total_modal`,`table_transaksi`.`total_harga` AS `total_harga`,`table_transaksi`.`tanggal_beli` AS `tanggal_beli`,`table_user`.`nama_user` AS `nama_user` from (`table_transaksi` join `table_user` on(`table_transaksi`.`kd_user` = `table_user`.`kd_user`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `table_barang`
--
ALTER TABLE `table_barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kd_distributor` (`kd_distributor`),
  ADD KEY `kd_merek` (`kd_merek`);

--
-- Indeks untuk tabel `table_biayaoperasional`
--
ALTER TABLE `table_biayaoperasional`
  ADD PRIMARY KEY (`kd_biayaoperasional`);

--
-- Indeks untuk tabel `table_distributor`
--
ALTER TABLE `table_distributor`
  ADD PRIMARY KEY (`kd_distributor`);

--
-- Indeks untuk tabel `table_merek`
--
ALTER TABLE `table_merek`
  ADD PRIMARY KEY (`kd_merek`);

--
-- Indeks untuk tabel `table_pretransaksi`
--
ALTER TABLE `table_pretransaksi`
  ADD PRIMARY KEY (`kd_pretransaksi`);

--
-- Indeks untuk tabel `table_stokmasuk`
--
ALTER TABLE `table_stokmasuk`
  ADD PRIMARY KEY (`kd_stokmasuk`);

--
-- Indeks untuk tabel `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indeks untuk tabel `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`kd_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
