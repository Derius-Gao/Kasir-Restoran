-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2025 pada 07.16
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_resto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id_activity` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id_activity`, `id_user`, `username`, `aksi`, `timestamp`, `ip_address`) VALUES
(334, 2, 'Derpyus', 'User mengakses menu', '2025-04-10 00:40:40', '::1'),
(335, 2, 'Derpyus', 'User menambahkan item ke keranjang', '2025-04-10 00:41:06', '::1'),
(336, 2, 'Derpyus', 'User mengakses menu', '2025-04-10 00:41:17', '::1'),
(337, 2, 'Derpyus', 'User mengakses keranjang', '2025-04-10 00:41:37', '::1'),
(338, 2, 'Derpyus', 'User Melakukan checkout', '2025-04-10 00:41:56', '::1'),
(339, 2, 'Derpyus', 'User mengakses keranjang', '2025-04-10 00:42:04', '::1'),
(340, 2, 'Derpyus', 'User mengakses halaman transaksi', '2025-04-10 00:42:23', '::1'),
(341, 2, 'Derpyus', 'User melihat Logs', '2025-04-10 00:42:44', '::1'),
(342, 2, 'Derpyus', 'User mengakses menu', '2025-04-10 00:48:50', '::1'),
(343, 2, 'Derpyus', 'User mengakses menu', '2025-04-10 00:48:55', '::1'),
(344, 2, 'Derpyus', 'User menambahkan item ke keranjang', '2025-04-10 00:49:16', '::1'),
(345, 2, 'Derpyus', 'User mengakses menu', '2025-04-10 00:49:20', '::1'),
(346, 2, 'Derpyus', 'User mengakses keranjang', '2025-04-10 00:49:52', '::1'),
(347, 2, 'Derpyus', 'User mengakses keranjang', '2025-04-10 00:49:58', '::1'),
(348, 2, 'Derpyus', 'User Melakukan checkout', '2025-04-10 00:50:19', '::1'),
(349, 2, 'Derpyus', 'User mengakses keranjang', '2025-04-10 00:50:24', '::1'),
(350, 2, 'Derpyus', 'User mengakses halaman transaksi', '2025-04-10 00:50:44', '::1'),
(351, 2, 'Derpyus', 'User melihat Logs', '2025-04-10 00:51:09', '::1'),
(352, 2, 'Derpyus', 'User melihat Logs', '2025-04-10 00:51:31', '::1'),
(353, 2, 'Derpyus', 'User mengakses tabel user', '2025-04-10 00:52:00', '::1'),
(354, 2, 'Derpyus', 'User mengakses tabel user', '2025-04-10 00:52:30', '::1'),
(355, 2, 'Derpyus', 'User mengakses halaman transaksi', '2025-04-10 01:30:59', '::1'),
(356, 2, 'Derpyus', 'User mengakses tabel user', '2025-04-10 01:31:40', '::1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `status` enum('tersedia','habis') DEFAULT NULL,
  `kategori` enum('makanan','minuman') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `status`, `kategori`) VALUES
(1, 'Donat kacang', 13000, 'tersedia', 'makanan'),
(2, 'Donat Bebek', 10000, 'tersedia', 'makanan'),
(7, 'Es teh', 8000, 'tersedia', 'minuman'),
(8, 'Kopi tarik', 11000, 'tersedia', 'minuman'),
(9, 'Kopi laksamana', 8000, 'habis', 'minuman'),
(10, 'Kopi titan', 11000, 'tersedia', 'minuman'),
(30, 'Ketoprak', 13000, 'tersedia', 'makanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan_app`
--

CREATE TABLE `pengaturan_app` (
  `id_pengaturan` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_web` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan_app`
--

INSERT INTO `pengaturan_app` (`id_pengaturan`, `judul`, `logo`, `logo_web`, `created_at`, `updated_at`) VALUES
(1, 'Toko Roti', '1743675870_a99d35ed8f4878a9eee4.png', '1744019486_e007e7d8651029c09312.png', '2025-03-17 00:47:01', '2025-04-07 09:51:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_harga` double NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` enum('pending','Lunas','Batal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tanggal`, `total_harga`, `metode_pembayaran`, `bukti_pembayaran`, `status_pembayaran`) VALUES
(24, 2, '2025-04-10 07:41:57', 10000, 'Gopay', 'uploads/1744288917_c3e067ac1491a3198ea5.jpg', 'pending'),
(25, 2, '2025-04-10 07:50:19', 10000, 'Gopay', 'uploads/1744289419_c35783e47ee2a0de1757.jpg', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` enum('superadmin','admin','kasir','pelanggan') DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama_user`, `email`, `level`, `password`, `delete_status`, `reset_token`, `reset_token_expiry`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'Derpyus', 'der', 'der@gmail.com', 'admin', '111', 0, NULL, NULL, NULL, NULL, 0, '2025-03-31 09:09:18', 0, NULL),
(2, 'Derpyus', 'der', 'sup@min.com', 'superadmin', '1', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(5, 'Boboiboy', 'boboy', 'tanderius05@gmail.com\r\n', 'pelanggan', '14', 1, '', '0000-00-00 00:00:00', NULL, NULL, 2, '2025-03-31 09:24:23', 2, '2025-03-31 09:24:23'),
(16, 'sugma', 'anjas', 'maxff2104@gmail.com', 'pelanggan', 'permata123', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(18, 'Pori', 'Sera', 'serrra@gmail.com', 'kasir', 'hend', 0, NULL, NULL, NULL, NULL, 2, '2025-04-07 04:55:16', 2, '2025-04-07 04:54:13'),
(19, 'hendro', 'aea', 'lg@pa.id', 'kasir', 'ser', 1, NULL, NULL, 2, '2025-03-31 09:37:05', 2, '2025-04-10 07:52:21', 2, '2025-04-10 07:52:21'),
(25, 'Maria', 'Mar', 'mar@gmail.com', 'pelanggan', '1adakmdkam', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id_activity`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
