-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2022 pada 06.35
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
-- Database: `apotik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `USERNAME` varchar(225) NOT NULL,
  `PASSWORD` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_transaksi`
--

CREATE TABLE `detil_transaksi` (
  `KODE_DETIL` int(11) NOT NULL,
  `KODE_TRANSAKSI` int(11) NOT NULL,
  `KODE_OBAT` int(11) DEFAULT NULL,
  `SUB_TOTAL` int(11) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `KODE_OBAT` int(11) NOT NULL,
  `KODE_SUPPLIER` int(11) NOT NULL,
  `KODE_DETIL` int(11) DEFAULT NULL,
  `NAMA_OBAT` varchar(225) DEFAULT NULL,
  `PRODUSEN` varchar(225) DEFAULT NULL,
  `HARGA` int(11) DEFAULT NULL,
  `JML_STOK` int(11) DEFAULT NULL,
  `FOTO` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `KODE_SUPPLIER` int(11) NOT NULL,
  `NAMA_SUPPLIER` varchar(225) DEFAULT NULL,
  `ALAMAT` varchar(225) DEFAULT NULL,
  `KOTA` varchar(225) DEFAULT NULL,
  `TELP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `KODE_TRANSAKSI` int(11) NOT NULL,
  `KODE_DETIL` int(11) NOT NULL,
  `USERNAME` varchar(225) NOT NULL,
  `NAMA_PEMBELI` varchar(225) DEFAULT NULL,
  `TGL_TRANSAKSI` date DEFAULT NULL,
  `SUB_TOTAL` int(11) DEFAULT NULL,
  `TOTAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indeks untuk tabel `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD PRIMARY KEY (`KODE_DETIL`),
  ADD KEY `FK_MEMILIKI2` (`KODE_TRANSAKSI`),
  ADD KEY `FK_MEMPUNYAI` (`KODE_OBAT`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`KODE_OBAT`),
  ADD KEY `FK_MEMPUNYAI2` (`KODE_DETIL`),
  ADD KEY `FK_MENYUPLAI` (`KODE_SUPPLIER`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`KODE_SUPPLIER`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`KODE_TRANSAKSI`),
  ADD KEY `FK_MELAKUKAN` (`USERNAME`),
  ADD KEY `FK_MEMILIKI` (`KODE_DETIL`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`KODE_TRANSAKSI`) REFERENCES `transaksi` (`KODE_TRANSAKSI`),
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`KODE_OBAT`) REFERENCES `obat` (`KODE_OBAT`);

--
-- Ketidakleluasaan untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `FK_MEMPUNYAI2` FOREIGN KEY (`KODE_DETIL`) REFERENCES `detil_transaksi` (`KODE_DETIL`),
  ADD CONSTRAINT `FK_MENYUPLAI` FOREIGN KEY (`KODE_SUPPLIER`) REFERENCES `supplier` (`KODE_SUPPLIER`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_MELAKUKAN` FOREIGN KEY (`USERNAME`) REFERENCES `admin` (`USERNAME`),
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`KODE_DETIL`) REFERENCES `detil_transaksi` (`KODE_DETIL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
