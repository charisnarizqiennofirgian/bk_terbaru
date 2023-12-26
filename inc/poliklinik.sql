-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2023 pada 17.03
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poliklinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `alamat`, `nomor_hp`) VALUES
(28, 'dr. Farida', 'Jl. Pahlawan No. 6, Medan', '0812-1234-5678'),
(29, 'dr. Joko', 'Jl. Cendrawasih No. 7, Semarang', '0812-2345-6789'),
(30, 'dr. Susi', 'Jl. Merdeka No. 8, Surabaya', '0812-3456-7890'),
(31, 'dr. Eko', 'Jl. Diponegoro No. 9, Jakarta', '0812-4567-8901'),
(32, 'dr. Rita', 'Jl. Sudirman No. 10, Bandung', '0812-5678-9012'),
(33, 'dr. Bambang', 'Jl. Gatot Subroto No. 11, Bali', '0812-6789-0123'),
(34, 'dr. Rina', 'Jl. Gajah Mada No. 12, Yogyakarta', '0812-7890-1234'),
(35, 'dr. Ahmad', 'Jl. Darmo No. 13, Malang', '0812-8901-2345'),
(36, 'dr. Siti', 'Jl. Surya No. 14, Makassar', '0812-9012-3456'),
(37, 'dr. Anton', 'Jl. Veteran No. 15, Palembang', '0812-0123-4567'),
(38, 'dr. Maria', 'Jl. Dipa No. 16, Banjarmasin', '0812-1234-5678'),
(39, 'dr. Adi', 'Jl. Pemuda No. 17, Samarinda', '0812-2345-6789'),
(40, 'dr. Ani', 'Jl. Ahmad Yani No. 18, Padang', '0812-3456-7890'),
(41, 'dr. Dina', 'Jl. Pahlawan No. 19, Bandar Lampung', '0812-4567-8901'),
(42, 'dr. Andi', 'Jl. Merdeka No. 20, Tangerang', '0812-5678-9012'),
(43, 'dr. Faisal', 'Jl. Sudirman No. 21, Denpasar', '0812-6789-0123'),
(44, 'dr. Maya', 'Jl. Jendral Sudirman No. 22, Mataram', '0812-7890-1234'),
(45, 'dr. Agung', 'Jl. Cendana No. 23, Banda Aceh', '0812-8901-2345'),
(46, 'dr. Lina', 'Jl. Pemuda No. 24, Manado', '0812-9012-3456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `alamat`, `nomor_hp`) VALUES
(9, 'Budi Santoso', 'Jl. Ahmad Yani No. 12, Surabaya', '0812-3456-7898'),
(10, 'Siti Rahmah', 'Jl. Cempaka No. 13, Bandung', '0812-3456-7899'),
(11, 'Rina Wijaya', 'Jl. Merdeka No. 14, Jakarta', '0812-3456-7900'),
(12, 'Agus Setiawan', 'Jl. Jendral Sudirman No. 15, Medan', '0812-3456-7901'),
(13, 'Rini Agustina', 'Jl. Gajah Mada No. 16, Semarang', '0812-3456-7902'),
(14, 'Bambang Supriyanto', 'Jl. Diponegoro No. 17, Yogyakarta', '0812-3456-7903'),
(15, 'Tuti Suryati', 'Jl. Surya No. 18, Makassar', '0812-3456-7904'),
(16, 'Ahmad Tohari', 'Jl. Darmo No. 19, Malang', '0812-3456-7905'),
(17, 'Siti Maryam', 'Jl. Suroboyo No. 20, Makassar', '0812-3456-7906'),
(18, 'Anton Susanto', 'Jl. Pelajar No. 21, Semarang', '0812-3456-7907'),
(19, 'Maria Salim', 'Jl. Veteran No. 22, Surabaya', '0812-3456-7908'),
(20, 'Adi Surya', 'Jl. Dipa No. 23, Malang', '0812-3456-7909'),
(21, 'Ani Suryani', 'Jl. Gajah Mada No. 24, Denpasar', '+6282345678901'),
(22, 'Dina Agustina', 'Jl. Merdeka No. 25, Bandung', '+6283456789012'),
(23, 'Andi Prabowo', 'Jl. Pemuda No. 26, Jakarta', '+6284567890123'),
(24, 'Faisal Ramadhan', 'Jl. Sudirman No. 27, Medan', '+6285678901234'),
(25, 'Maya Wulandari', 'Jl. Jendral Sudirman No. 28, Semarang', '+6286789012345'),
(26, 'Agung Pribadi', 'Jl. Cendana No. 29, Yogyakarta', '+6287890123456'),
(27, 'Lina Setyawati', 'Jl. Pemuda No. 30, Surabaya', '+6288901234567'),
(28, 'Taufik Hidayat', 'Jl. Raya No. 31, Bandung', '+6289012345678');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE `periksa` (
  `id` int(10) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal_periksa` datetime NOT NULL,
  `waktu` time NOT NULL,
  `obat` varchar(20) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`id`, `id_pasien`, `id_dokter`, `tanggal_periksa`, `waktu`, `obat`, `catatan`) VALUES
(36, 9, 29, '2023-11-04 00:00:00', '09:00:00', 'Ibuprofen', 'Demam Tinggi'),
(37, 10, 28, '2023-11-04 00:00:00', '10:00:00', 'Amoxicillin', 'Batuk dan Pilek'),
(38, 11, 30, '2023-11-04 00:00:00', '11:30:00', 'Cetirizine', 'Alergi Gatal'),
(39, 12, 32, '2023-11-04 00:00:00', '12:00:00', 'Loratadine', 'Flu dan bersin-bersin'),
(40, 25, 40, '2023-11-05 00:00:00', '08:00:00', 'Paracetamol', 'Demam tinggi'),
(41, 24, 38, '2023-11-05 00:00:00', '10:00:00', 'Cetirizine', 'Alergi mata benngkak'),
(42, 27, 44, '2023-11-06 00:00:00', '13:00:00', 'Loratadine', 'Flu dan Demam tinggi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(4, 'finzaengr', '$2y$10$7Er827WMY1b9FIJSsv5Or.dnJXSTctKf4.2XBZsfcWRDHniq3l6JG'),
(7, 'admin', '$2y$10$qhuwjClhGqaTv.aOESQoFO/EEevmXDTTs9HZqveNBz9qyKKJhZfUO');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
