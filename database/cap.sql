-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
<<<<<<< HEAD
-- Host: localhost
-- Generation Time: Feb 10, 2023 at 08:49 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12
=======
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 06:28 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30
>>>>>>> 8ad7ba608e0e4f7500fb0e357050a2fe133a47c3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cap`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Marketing'),
(2, 'Sales'),
(3, 'Project Management'),
(4, 'Infrastucture and Operation'),
(5, 'Product Inovation'),
(6, 'Business Development'),
(7, 'People Relation and Development'),
(8, 'General Affair'),
(9, 'Finance'),
(10, 'Special');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pegawai`
--

CREATE TABLE `hasil_pegawai` (
  `id_hasil` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_pegawai`
--

INSERT INTO `hasil_pegawai` (`id_hasil`, `id_pegawai`, `id_periode`, `nilai`) VALUES
(11, 1, 2, 86.3852),
(12, 2, 2, 86.8757),
(13, 3, 2, 87.8755),
(14, 4, 2, 82.9613),
(15, 5, 2, 87.3889),
(16, 6, 2, 87.5462),
(17, 7, 2, 82.7868),
(18, 8, 2, 81.3551),
(19, 9, 2, 84.5368),
(20, 10, 2, 86.5868),
(81, 1, 1, 95.1882),
(82, 2, 1, 84.1413),
(83, 3, 1, 95.6299),
(84, 4, 1, 86.6847),
(85, 5, 1, 86.6536),
(86, 6, 1, 85.318),
(87, 7, 1, 90.5413),
(88, 8, 1, 93.8921),
(89, 9, 1, 89.2278),
(90, 10, 1, 84.569);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pelamar`
--

CREATE TABLE `hasil_pelamar` (
  `id_hasil` int(11) NOT NULL,
  `id_pelamar` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_pelamar`
--

INSERT INTO `hasil_pelamar` (`id_hasil`, `id_pelamar`, `id_lowongan`, `nilai`) VALUES
(196, 9, 2, 0.194267),
(197, 10, 2, 0.189124),
(198, 11, 2, 0.159006),
(199, 12, 2, 0.135723),
(200, 13, 2, 0.169518),
(201, 15, 2, 0.152362),
(278, 1, 1, 0.121505),
(279, 2, 1, 0.140209),
(280, 3, 1, 0.105007),
(281, 4, 1, 0.138862),
(282, 5, 1, 0.121172),
(283, 6, 1, 0.104719),
(284, 7, 1, 0.129183),
(285, 8, 1, 0.139343);

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id_indikator` int(11) NOT NULL,
  `kode_indikator` varchar(5) NOT NULL,
  `nama_indikator` varchar(100) NOT NULL,
  `type` enum('Benefit','Cost') NOT NULL,
  `bobot` int(3) NOT NULL,
  `ada_pilihan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id_indikator`, `kode_indikator`, `nama_indikator`, `type`, `bobot`, `ada_pilihan`) VALUES
(1, 'C01', 'Kehadiran', 'Benefit', 10, 0),
(2, 'C02', 'Tanggung Jawab', 'Benefit', 15, 0),
(3, 'C03', 'Kerjasama', 'Benefit', 20, 0),
(4, 'C04', 'Kedisiplinan', 'Benefit', 15, 0),
(9, 'C05', 'Kinerja', 'Benefit', 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `type` enum('Benefit','Cost') NOT NULL,
  `bobot` int(3) NOT NULL,
  `ada_pilihan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama`, `type`, `bobot`, `ada_pilihan`) VALUES
(1, 'K01', 'Tingkat Pendidikan', 'Benefit', 4, 1),
(2, 'K02', 'Usia', 'Benefit', 3, 1),
(3, 'K03', 'Pengalaman Kerja', 'Benefit', 4, 1),
(4, 'K04', 'Hasil Uji Kompetensi', 'Benefit', 5, 1),
(10, 'K05 ', 'Wawancara', 'Benefit', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL,
  `nama_lowongan` varchar(50) NOT NULL,
  `kuota` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id_lowongan`, `nama_lowongan`, `kuota`) VALUES
(1, 'Staff Marketing April 2022', 2),
(2, 'Staff Sales April 2022', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` char(8) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nip`, `nama_pegawai`, `no_telp`, `email`, `tgl_bergabung`, `id_status`, `id_divisi`) VALUES
(1, '40120109', 'Berlian Ardiansyah', '081346884191', 'berlianardi@gmail.com', '2020-10-08', 2, 7),
(2, '50116055', 'Denny Octavian', '085693500196', 'dennyoctavian@gmail.com', '2016-12-01', 2, 9),
(3, '30219075', 'Dimas Pambudi', '081277419012', 'dimaspambudi97@gmail.com', '2019-02-23', 2, 5),
(4, '10119087', 'Elizabeth Yaspis', '087851467830', 'elizayespis@gmail.com', '2019-07-22', 2, 2),
(5, '10219079', 'Fauziyah Rani', '081267098841', 'fauziyahrani@gmail.com', '2019-07-22', 2, 1),
(6, '40221119', 'Fuad Ashadi', '085723018854', 'fuadhasi@gmail.com', '2021-12-11', 2, 8),
(7, '20117059', 'Kiki Prasetya', '087834580818', 'kikipras21@gmail.com', '2017-06-01', 2, 3),
(8, '10218063', 'Muhammad Faiz', '081398619041', 'muhfaiz88@gmail.com', '2018-03-12', 2, 1),
(9, '50120100', 'Tiara Paramita', '082698019061', 'tiaraip@gmail.com', '2020-10-01', 2, 9),
(10, '50120108', 'Wahyu Santoso', '085688670184', 'wahyusan86@gmail.com', '2020-10-07', 2, 9),
(13, '10121125', 'Azkia Raihani', '087864310187', 'azkiarhni@gmail.com', '2021-12-25', 1, 2),
(14, '20221117', 'Alfin Nurhidayat', '081377619041', 'alfinnurhidayat@gmail.com', '2021-10-22', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `nama_pelamar` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_lowongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`id_pelamar`, `nama_pelamar`, `no_telp`, `email`, `id_lowongan`) VALUES
(1, 'Ira Nuraini', '081226918501', 'iranuraini@gmail.com', 1),
(2, 'Rifki Satrio Utomo', '087777700401', 'rifkisatrio90@gmail.com', 1),
(3, 'Ihsan Naufal', '085766663692', 'ihsan00@gmail.com', 1),
(4, 'Diah Ayu', '081938889093', 'ayudiah26@gmail.com', 1),
(5, 'Satria Aji Julianto', '081394039018', 'satriaaj24@gmail.com', 1),
(6, 'Aziza Nuraini', '08974650548', 'aznuraini13@gmail.com', 1),
(7, 'Yuanita Permata', '081280784990', 'yuanita.permata99@gmail.com', 1),
(8, 'Dimas Ardiansyah', '089610343696', 'dimas.ardi11@gmail.com', 1),
(9, 'Yogie Alfin Salim', '08227771906', 'yg@gmail.ocm', 2),
(10, 'Auliya Haunan', '081344123567', 'auliyahf@gmail.com', 2),
(11, 'Veronica', '088823279906', 'vero@gmail.com', 2),
(12, 'Mamad', '081299704328', 'mamad@gmail.com', 2),
(13, 'yunus', '081256119043', 'yunusnsr@gmail.com', 2),
(15, 'Ira Denira', '081388705412', 'iraden@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_pelamar` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_pelamar`, `id_kriteria`, `id_lowongan`, `nilai`) VALUES
(11, 9, 1, 2, 4),
(12, 9, 2, 2, 7),
(13, 9, 3, 2, 10),
(14, 9, 4, 2, 16),
(15, 9, 10, 2, 30),
(16, 10, 1, 2, 3),
(17, 10, 2, 2, 7),
(18, 10, 3, 2, 10),
(19, 10, 4, 2, 15),
(20, 10, 10, 2, 32),
(21, 11, 1, 2, 3),
(22, 11, 2, 2, 6),
(23, 11, 3, 2, 10),
(24, 11, 4, 2, 15),
(25, 11, 10, 2, 30),
(26, 12, 1, 2, 2),
(27, 12, 2, 2, 5),
(28, 12, 3, 2, 12),
(29, 12, 4, 2, 15),
(30, 12, 10, 2, 29),
(31, 13, 1, 2, 3),
(32, 13, 2, 2, 7),
(33, 13, 3, 2, 10),
(34, 13, 4, 2, 15),
(35, 13, 10, 2, 30),
(36, 15, 1, 2, 2),
(37, 15, 2, 2, 7),
(38, 15, 3, 2, 11),
(39, 15, 4, 2, 14),
(40, 15, 10, 2, 30),
(46, 1, 1, 1, 3),
(47, 1, 2, 1, 8),
(48, 1, 3, 1, 10),
(49, 1, 4, 1, 14),
(50, 1, 10, 1, 30),
(51, 2, 1, 1, 3),
(52, 2, 2, 1, 5),
(53, 2, 3, 1, 12),
(54, 2, 4, 1, 15),
(55, 2, 10, 1, 32),
(56, 3, 1, 1, 3),
(57, 3, 2, 1, 8),
(58, 3, 3, 1, 9),
(59, 3, 4, 1, 14),
(60, 3, 10, 1, 30),
(61, 4, 1, 1, 4),
(62, 4, 2, 1, 6),
(63, 4, 3, 1, 10),
(64, 4, 4, 1, 16),
(65, 4, 10, 1, 30),
(66, 5, 1, 1, 2),
(67, 5, 2, 1, 6),
(68, 5, 3, 1, 11),
(69, 5, 4, 1, 15),
(70, 5, 10, 1, 30),
(71, 6, 1, 1, 3),
(72, 6, 2, 1, 8),
(73, 6, 3, 1, 9),
(74, 6, 4, 1, 15),
(75, 6, 10, 1, 29),
(76, 7, 1, 1, 3),
(77, 7, 2, 1, 7),
(78, 7, 3, 1, 10),
(79, 7, 4, 1, 15),
(80, 7, 10, 1, 30),
(81, 8, 1, 1, 3),
(82, 8, 2, 1, 7),
(83, 8, 3, 1, 10),
(84, 8, 4, 1, 16),
(85, 8, 10, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_pegawai`
--

CREATE TABLE `penilaian_pegawai` (
  `id_penilaian` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian_pegawai`
--

INSERT INTO `penilaian_pegawai` (`id_penilaian`, `id_pegawai`, `id_indikator`, `id_periode`, `nilai`) VALUES
(1, 1, 1, 1, 85),
(2, 1, 2, 1, 95),
(3, 1, 3, 1, 90),
(4, 1, 4, 1, 88),
(5, 1, 9, 1, 96),
(6, 2, 1, 1, 81),
(7, 2, 2, 1, 84),
(8, 2, 3, 1, 84),
(9, 2, 4, 1, 95),
(10, 2, 9, 1, 75),
(11, 3, 1, 1, 83),
(12, 3, 2, 1, 86),
(13, 3, 3, 1, 95),
(14, 3, 4, 1, 100),
(15, 3, 9, 1, 94),
(16, 4, 1, 1, 77),
(17, 4, 2, 1, 93),
(18, 4, 3, 1, 95),
(19, 4, 4, 1, 90),
(20, 4, 9, 1, 75),
(26, 6, 1, 1, 90),
(27, 6, 2, 1, 95),
(28, 6, 3, 1, 77),
(29, 6, 4, 1, 76),
(30, 6, 9, 1, 82),
(31, 7, 1, 1, 100),
(32, 7, 2, 1, 88),
(33, 7, 3, 1, 86),
(34, 7, 4, 1, 82),
(35, 7, 9, 1, 88),
(36, 8, 1, 1, 92),
(37, 8, 2, 1, 98),
(38, 8, 3, 1, 80),
(39, 8, 4, 1, 94),
(40, 8, 9, 1, 93),
(41, 9, 1, 1, 79),
(42, 9, 2, 1, 79),
(43, 9, 3, 1, 81),
(44, 9, 4, 1, 84),
(45, 9, 9, 1, 95),
(46, 10, 1, 1, 75),
(47, 10, 2, 1, 85),
(48, 10, 3, 1, 80),
(49, 10, 4, 1, 87),
(50, 10, 9, 1, 82),
(51, 1, 1, 2, 80),
(52, 1, 2, 2, 77),
(53, 1, 3, 2, 81),
(54, 1, 4, 2, 90),
(55, 1, 9, 2, 85),
(56, 1, 1, 2, 80),
(57, 1, 2, 2, 77),
(58, 1, 3, 2, 81),
(59, 1, 4, 2, 90),
(60, 1, 9, 2, 85),
(61, 2, 1, 2, 81),
(62, 2, 2, 2, 90),
(63, 2, 3, 2, 76),
(64, 2, 4, 2, 80),
(65, 2, 9, 2, 88),
(66, 3, 1, 2, 90),
(67, 3, 2, 2, 100),
(68, 3, 3, 2, 75),
(69, 3, 4, 2, 68),
(70, 3, 9, 2, 90),
(71, 4, 1, 2, 100),
(72, 4, 2, 2, 78),
(73, 4, 3, 2, 89),
(74, 4, 4, 2, 9),
(75, 4, 9, 2, 100),
(91, 6, 1, 2, 77),
(92, 6, 2, 2, 80),
(93, 6, 3, 2, 81),
(94, 6, 4, 2, 84),
(95, 6, 9, 2, 90),
(96, 7, 1, 2, 100),
(97, 7, 2, 2, 80),
(98, 7, 3, 2, 90),
(99, 7, 4, 2, 80),
(100, 7, 9, 2, 69),
(101, 8, 1, 2, 90),
(102, 8, 2, 2, 81),
(103, 8, 3, 2, 75),
(104, 8, 4, 2, 70),
(105, 8, 9, 2, 80),
(106, 9, 1, 2, 78),
(107, 9, 2, 2, 77),
(108, 9, 3, 2, 90),
(109, 9, 4, 2, 80),
(110, 9, 9, 2, 80),
(111, 10, 1, 2, 77),
(112, 10, 2, 2, 86),
(113, 10, 3, 2, 90),
(114, 10, 4, 2, 80),
(115, 10, 9, 2, 82),
(121, 5, 1, 1, 80),
(122, 5, 2, 1, 90),
(123, 5, 3, 1, 85),
(124, 5, 4, 1, 91),
(125, 5, 9, 1, 80);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `nama_periode` varchar(100) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `nama_periode`, `id_status`) VALUES
(1, 'Penilaian Pegawai Tetap Tahun 2021', 2),
(2, 'Penilaian Pegawai Tetap Tahun 2022', 2),
(3, 'Penilaian Pegawai Kontrak Periode September 2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` enum('Kontrak','Tetap') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Kontrak'),
(2, 'Tetap');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `nama`, `nilai`) VALUES
(1, 1, 'SMA/SMK', 1),
(2, 1, 'D3', 2),
(3, 1, 'S1', 3),
(4, 1, 'S2', 4),
(5, 2, 'Umur >= 31 Tahun', 1),
(6, 2, '27 - 30 Tahun', 2),
(7, 2, '24 - 26 Tahun', 3),
(8, 2, '<= 23 Tahun', 4),
(9, 3, 'Tidak Ada Pengalaman Kerja', 1),
(10, 3, '1 - 2 Tahun Pengalaman Kerja', 2),
(11, 3, '3 - 5 Tahun Pengalaman Kerja', 3),
(12, 3, 'Pengalaman Kerja diatas 5 Tahun', 4),
(13, 4, 'Nilai dibawah 64', 1),
(14, 4, 'Nilai 65 - 75', 2),
(15, 4, 'Nilai 76 - 85', 3),
(16, 4, 'Nilai diatas 85', 4),
(29, 10, 'Tidak Cocok', 1),
(30, 10, 'Cukup Cocok', 2),
(31, 10, 'Cocok', 3),
(32, 10, 'Sangat Cocok', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` char(1) NOT NULL,
  `id_divisi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `role`, `id_divisi`) VALUES
(2, 'alfalaq', '$2y$10$OM.2hICAf5TmpbBAaoyyke4kv4DvBiIZ2ocavmWM9y9MN5xaa3dKS', 'Alfalaq', 'alfalaq@gmail.com', '1', 10),
(4, 'hrcap', '$2y$10$fmrj5pPlKdxHviTzAc6XpeCtMXdIFrQ1KBL1drzL0zVg6WGG4ZkSi', 'Jatu Madasari', 'jtmdsr@gmail.com', '2', 7),
(6, 'marketingcap', '$2y$10$YsoHHxxbhlQCcqm502oqt.KttmbwuPkimdB1rPUb2qaH2goB8o/76', 'Iwan Abdulrahman', 'iwanabdul@gmail.com', '2', 1),
(7, 'pmcap', '$2y$10$1kt/OhB/fK965hEEOUxwX.galoVL4v3rqbCW2Yh5BWdfkTKTAuftm', 'Tjatursari Oetoro', 'tjatursarioetoro@gmail.com', '2', 3),
(8, 'salescap', '$2y$10$y8zDkRNy2fuJ9fY5saP/deXCqRsx9pHPO/sR5lonZFj4OeqLgTAIC', 'Theresia Suzana Ramschie', 'theresiasuzana@gmail.com', '2', 2),
(9, 'iocap', '$2y$10$VwIVtfJcI/TTJsvv.YXFbOuCtw9tOLQYjNdQDC5w/go8shv9DC8xW', 'Satria Aji Julianto', 'satriaaji22@gmail.com', '2', 4),
(10, 'picap', '$2y$10$TerPDYZxqtLGVUxU9VkE3OVOx7dsyiHlO/A4kAh9Kom.JjZvXDMMK', 'Debora Ayu', 'deborayu@gmail.com', '2', 5),
(11, 'busdevcap', '$2y$10$PMufkdyh72.bDmpMsctvnOU7eLEGPx.CbNaIMUk9./H4eFCN/vfqy', 'Onma Pasti', 'onmapas@gmail.com', '2', 6),
(12, 'gacap', '$2y$10$QDLqn4QgYPmWrooIpzA2JOxcmkZDjRgumMiDPUd7thRMwRhhDX6am', 'Fadel Nur Akhmad', 'fadelna88@gmail.com', '2', 8),
(13, 'fincap', '$2y$10$h34tp9iNQx67m6PJ.sTEoOfxuCrsd2KB.ZwRwugdOFSnp.yZFMdgO', 'Ahmad Nurudin', 'ahmadnur@gmail.com', '2', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `hasil_pegawai`
--
ALTER TABLE `hasil_pegawai`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_pgw` (`id_pegawai`),
  ADD KEY `id_perd` (`id_periode`);

--
-- Indexes for table `hasil_pelamar`
--
ALTER TABLE `hasil_pelamar`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_pelamar` (`id_pelamar`) USING BTREE,
  ADD KEY `id_lwng` (`id_lowongan`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id_indikator`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_lowongan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `sts` (`id_status`),
  ADD KEY `div` (`id_divisi`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`id_pelamar`),
  ADD KEY `id_lowongan` (`id_lowongan`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_pelamar` (`id_pelamar`),
  ADD KEY `id_kirteria` (`id_kriteria`),
  ADD KEY `id_low` (`id_lowongan`);

--
-- Indexes for table `penilaian_pegawai`
--
ALTER TABLE `penilaian_pegawai`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_peg` (`id_pegawai`),
  ADD KEY `id_idktr` (`id_indikator`),
  ADD KEY `id_prd` (`id_periode`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`),
  ADD KEY `id_sts` (`id_status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kritera` (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hasil_pegawai`
--
ALTER TABLE `hasil_pegawai`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `hasil_pelamar`
--
ALTER TABLE `hasil_pelamar`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pelamar`
--
ALTER TABLE `pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `penilaian_pegawai`
--
ALTER TABLE `penilaian_pegawai`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_pegawai`
--
ALTER TABLE `hasil_pegawai`
  ADD CONSTRAINT `id_perd` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pgw` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_pelamar`
--
ALTER TABLE `hasil_pelamar`
  ADD CONSTRAINT `id_lwng` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_plmr` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `div` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sts` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `id_lowongan` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `id_kirteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_low` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pelamar` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian_pegawai`
--
ALTER TABLE `penilaian_pegawai`
  ADD CONSTRAINT `id_idktr` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_peg` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_prd` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `periode`
--
ALTER TABLE `periode`
  ADD CONSTRAINT `id_sts` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `id_kritera` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `id_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
