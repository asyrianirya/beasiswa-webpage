-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Sep 2024 pada 14.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beasiswa_webpage`
--
CREATE DATABASE IF NOT EXISTS `beasiswa_webpage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `beasiswa_webpage`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_beasiswa`
--

CREATE TABLE `jenis_beasiswa` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nama_beasiswa` varchar(50) NOT NULL,
  `deskripsi_beasiswa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_beasiswa`
--

INSERT INTO `jenis_beasiswa` (`id`, `nama_beasiswa`, `deskripsi_beasiswa`) VALUES
(0000000001, 'Beasiswa Akademik', 'Diberikan kepada siswa atau mahasiswa dengan nilai akademik yang tinggi.'),
(0000000002, 'Beasiswa Non-Akademik', 'Diberikan untuk program studi atau disiplin ilmu tertentu.'),
(0000000003, 'Beasiswa Ekonomi', 'Diberikan kepada siswa atau mahasiswa yang membutuhkan dukungan finansial.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_beasiswa`
--

CREATE TABLE `siswa_beasiswa` (
  `id` int(11) NOT NULL,
  `nama` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `hp` int(20) NOT NULL,
  `semester` int(1) NOT NULL,
  `ipk` float NOT NULL,
  `beasiswa` int(100) NOT NULL,
  `berkas` varchar(200) NOT NULL,
  `status_ajuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_beasiswa`
--
ALTER TABLE `jenis_beasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_beasiswa`
--
ALTER TABLE `jenis_beasiswa`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
