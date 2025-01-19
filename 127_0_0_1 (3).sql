-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jan 2025 pada 07.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_web`
--
CREATE DATABASE IF NOT EXISTS `app_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `app_web`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `nidn` varchar(10) NOT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama_dosen`) VALUES
('Nip2023001', 'Jihadul Akbar,M.kom'),
('Nip2023002', 'Hairul Fahmi,M.kom'),
('Nip2023003', 'Ahmad Tantoni,M.kom'),
('Nip2023004', 'Baiq Yulia Fitriani,S.pd'),
('Nip2023005', 'Pink boy,ST.,Meng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama_mhs` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mhs`, `tgl_lahir`, `alamat`, `jenis_kelamin`) VALUES
('SI20023003', 'Rido Ul Ambari', '2005-03-15', 'Praya', 'L'),
('SI20230007', 'Baiq Nabila Sari', '2005-11-24', 'Beraim', 'P'),
('SI20230016', 'Ikhwan Maulan Ivansyah', '2005-06-08', 'Ganti', 'L'),
('SI20230031', 'Suaebatul Islamiah', '2006-07-01', 'Dakung', 'P'),
('SI20230032', 'Sucianti', '2005-10-12', 'Pagutan', 'P');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_matakuliah` varchar(10) NOT NULL,
  `nama_matakuliah` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`kode_matakuliah`, `nama_matakuliah`, `sks`) VALUES
('BI033', 'Bahasa Indonesia', 2),
('DB305', 'Data Base', 3),
('JK032', 'Jaringan Komputer', 3),
('Pw031', 'Pemrograman web1', 3),
('SI034', 'Sistem Oprasi', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `id` int(11) NOT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `kode_matakuliah` varchar(10) DEFAULT NULL,
  `nidn` varchar(10) DEFAULT NULL,
  `nilai` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perkuliahan`
--

INSERT INTO `perkuliahan` (`id`, `nim`, `kode_matakuliah`, `nidn`, `nilai`) VALUES
(1, 'SI20023003', 'JK032', 'Nip2023003', 'A'),
(2, 'SI20230007', 'BI033', 'Nip2023004', 'A'),
(3, 'SI20230016', 'SI034', 'Nip2023005', 'A'),
(4, 'SI20230032', 'DB305', 'Nip2023002', 'A'),
(5, 'SI20230031', 'Pw031', 'Nip2023001', 'A');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_matakuliah`);

--
-- Indeks untuk tabel `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`),
  ADD KEY `kode_matakuliah` (`kode_matakuliah`),
  ADD KEY `nidn` (`nidn`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `perkuliahan`
--
ALTER TABLE `perkuliahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD CONSTRAINT `perkuliahan_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `perkuliahan_ibfk_2` FOREIGN KEY (`kode_matakuliah`) REFERENCES `matakuliah` (`kode_matakuliah`),
  ADD CONSTRAINT `perkuliahan_ibfk_3` FOREIGN KEY (`nidn`) REFERENCES `dosen` (`nidn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
