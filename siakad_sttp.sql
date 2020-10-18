-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2020 at 03:33 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad_sttp`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_dosen`
--

CREATE TABLE `db_dosen` (
  `id_dosen` int(22) NOT NULL,
  `kd_dosen` varchar(255) NOT NULL,
  `nidn` int(22) NOT NULL,
  `nik_dosen` int(30) NOT NULL,
  `kd_jurusan` varchar(225) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `telp_dosen` int(15) NOT NULL,
  `alamat_dosen` varchar(255) NOT NULL,
  `foto_dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_dosen`
--

INSERT INTO `db_dosen` (`id_dosen`, `kd_dosen`, `nidn`, `nik_dosen`, `kd_jurusan`, `nama_dosen`, `telp_dosen`, `alamat_dosen`, `foto_dosen`) VALUES
(4, 'A001', 2147483647, 2147483647, '0001', 'Dosen 1', 387923522, 'fjsjksjflksjfklsjfkssdf', 'default/male.png'),
(5, 'A002', 2147483647, 2147483647, '0001', 'Dosen 2', 2147483647, 'sdfsdgsdfgdsf', 'default/male.png'),
(6, 'B001', 2147483647, 2147483647, '002', 'Dosen 3', 2147483647, 'sadflasjkflajsdfsda', 'default/male.png'),
(7, 'B002', 2147483647, 2147483647, '002', 'Dosen 4', 2147483647, 'alsfjlajsfkas', 'default/male.png');

-- --------------------------------------------------------

--
-- Table structure for table `db_item_krs`
--

CREATE TABLE `db_item_krs` (
  `id_item_krs` int(22) NOT NULL,
  `id_krs` int(22) NOT NULL,
  `id_jadwal` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_item_krs`
--

INSERT INTO `db_item_krs` (`id_item_krs`, `id_krs`, `id_jadwal`) VALUES
(53, 39, 11),
(54, 39, 10),
(55, 50, 13),
(56, 50, 12);

-- --------------------------------------------------------

--
-- Table structure for table `db_jadwal`
--

CREATE TABLE `db_jadwal` (
  `id_jadwal` int(22) NOT NULL,
  `kd_mk` varchar(255) NOT NULL,
  `kd_dosen` varchar(255) NOT NULL,
  `ta` varchar(255) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_jadwal`
--

INSERT INTO `db_jadwal` (`id_jadwal`, `kd_mk`, `kd_dosen`, `ta`, `hari`, `jam`) VALUES
(10, 'A001', 'A002', '2020/2021', 'Kamis', '08:00:00'),
(11, 'A002', 'A002', '2020/2021', 'Jum\'at', '08:00:00'),
(12, 'B001', 'B001', '2020/2021', 'Rabu', '08:00:00'),
(13, 'B002', 'B002', '2020/2021', 'Jum\'at', '10:00:00'),
(14, 'A006', 'A002', '2020/2021', 'Senin', '08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_jurusan`
--

CREATE TABLE `db_jurusan` (
  `id_jur` int(11) NOT NULL,
  `kd_jurusan` varchar(225) NOT NULL,
  `nama_jurusan` varchar(225) NOT NULL,
  `ketua_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_jurusan`
--

INSERT INTO `db_jurusan` (`id_jur`, `kd_jurusan`, `nama_jurusan`, `ketua_jurusan`) VALUES
(9, '0001', 'Teknik Informatika', 'Joni'),
(10, '002', 'Teknik Elektro', 'Jono');

-- --------------------------------------------------------

--
-- Table structure for table `db_mahasiswa`
--

CREATE TABLE `db_mahasiswa` (
  `id_mhs` int(50) NOT NULL,
  `nim` int(22) NOT NULL,
  `semester` int(3) NOT NULL,
  `nik_mhs` int(22) NOT NULL,
  `kd_jurusan` varchar(225) NOT NULL,
  `nama_mhs` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` int(15) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama_mhs` varchar(255) NOT NULL,
  `kewarganegaraan` varchar(255) NOT NULL,
  `nama_ortu` varchar(255) NOT NULL,
  `alamat_ortu` varchar(255) NOT NULL,
  `telp_ortu` int(15) NOT NULL,
  `foto_mhs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_mahasiswa`
--

INSERT INTO `db_mahasiswa` (`id_mhs`, `nim`, `semester`, `nik_mhs`, `kd_jurusan`, `nama_mhs`, `alamat`, `telp`, `tempat_lahir`, `tgl_lahir`, `agama_mhs`, `kewarganegaraan`, `nama_ortu`, `alamat_ortu`, `telp_ortu`, `foto_mhs`) VALUES
(20, 201811001, 2, 728472387, '0001', 'ANINDITO SATYA RAMAHDHAN', 'asdjsadj', 374298329, 'PATI', '2020-10-10', 'Islam', 'WNI', 'SDJALDJ', 'KDDFJSLKFJ', 2147483647, 'default/male.png'),
(21, 201811002, 2, 2147483647, '0001', 'ARY AKHYAR', 'SIDJKSDFJLK', 342349238, 'PATI', '2020-10-10', 'Islam', 'WNI', 'ASJDSJH', 'SAJHFSDHDJS', 2147483647, 'default/male.png'),
(22, 201812009, 1, 2147483647, '002', 'TAUFIK HIDAYAT', 'DAJDLADJ', 2147483647, 'SKLFJLSKAJKF', '2020-10-10', 'Islam', 'WNI', 'FKLASJDFKLASDF', 'ADSFASDFADSF', 569748324, 'default/male.png'),
(23, 201911001, 3, 2147483647, '0001', ' ADITYA HERA PRATAMA', 'SDJSLKDASKJ', 2147483647, 'JKSDFHSDJ', '2020-10-10', 'Islam', 'WNI', 'ASDJLKASJ', 'LKASJDASJ', 2147483647, 'default/male.png'),
(24, 201911002, 6, 247238479, '0001', 'AYU NOVITA SARI', 'ADSSDJKADJALKJ', 83472937, 'SFJSFSD', '2020-10-10', 'Islam', 'ASFSAFSAD', 'SAFASFSAD', 'SADFASDFASDF', 234324324, 'default/male.png'),
(25, 201911003, 3, 2839137, '0001', 'BINTANG TRI YOGA', 'SKJDALJDASKLJ', 2147483647, 'LSKDJSAKJ', '2020-10-10', 'Islam', 'WNI', 'SKJDLAKSJD', 'ASDJKKALSJD', 874923793, 'default/male.png'),
(26, 201911004, 3, 2147483647, '0001', 'FATIH LUTH FITRIYAH', 'SADKJASDJASKLDJ', 2147483647, 'PATI', '2020-10-10', 'Islam', 'WNI', 'SADLKDJ', 'SKAJDAL', 2147483647, 'default/male.png'),
(27, 201911005, 3, 2147483647, '0001', 'FEBBY PUTRI MARSHANDA', 'SAHDJASHDJKASH', 2147483647, 'SJDALJDLAJ', '2020-10-10', 'Islam', 'WNI', 'SADJJKLJASD', 'ASFSDFAS', 2147483647, 'default/male.png'),
(28, 2020110001, 2, 2147483647, '0001', 'EHEM SOLIH', 'asdasdsadjl', 2147483647, 'PATI', '2020-10-10', 'Islam', 'WNI', 'djasjdkaj', 'skjdlasdjas', 573987534, 'foto_mhs/mhs_20201013175233_5f85cd41d244a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `db_makul`
--

CREATE TABLE `db_makul` (
  `id_mk` int(11) NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `sks` int(5) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `kd_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_makul`
--

INSERT INTO `db_makul` (`id_mk`, `kode_mk`, `nama_mk`, `sks`, `semester`, `kd_jurusan`) VALUES
(4, 'A001', 'Matematika Teknik', 3, '2', '0001'),
(5, 'A002', 'Matematika Logika', 2, '2', '0001'),
(6, 'B001', 'Matematika Dasar', 3, '2', '002'),
(7, 'B002', 'Matematika Diskrit', 3, '2', '002'),
(8, 'A006', 'Teknologi Komputer', 3, '3', '0001');

-- --------------------------------------------------------

--
-- Table structure for table `db_nilai`
--

CREATE TABLE `db_nilai` (
  `id_nilai` int(22) NOT NULL,
  `id_krs` int(22) NOT NULL,
  `id_jadwal` int(22) NOT NULL,
  `ta` varchar(255) NOT NULL,
  `nim` int(22) NOT NULL,
  `nilai` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_nilai`
--

INSERT INTO `db_nilai` (`id_nilai`, `id_krs`, `id_jadwal`, `ta`, `nim`, `nilai`) VALUES
(62, 39, 11, '2020/2021', 2020110001, NULL),
(63, 39, 10, '2020/2021', 2020110001, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_paket_krs`
--

CREATE TABLE `db_paket_krs` (
  `id_krs` int(11) NOT NULL,
  `id_ta` int(11) NOT NULL,
  `ta` varchar(255) NOT NULL,
  `semester` int(3) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_pa` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_paket_krs`
--

INSERT INTO `db_paket_krs` (`id_krs`, `id_ta`, `ta`, `semester`, `id_jurusan`, `id_pa`) VALUES
(39, 14, '2020/2021', 2, 9, 4),
(50, 14, '2020/2021', 2, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `db_ta`
--

CREATE TABLE `db_ta` (
  `id_ta` int(11) NOT NULL,
  `ta` varchar(255) NOT NULL,
  `status` enum('active','deactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_ta`
--

INSERT INTO `db_ta` (`id_ta`, `ta`, `status`) VALUES
(13, '2019/2020', 'deactive'),
(14, '2020/2021', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` enum('mhs','dosen','admin') NOT NULL,
  `blokir` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`id`, `username`, `password`, `email`, `level`, `blokir`) VALUES
(1, 'admin', '$2y$10$DznkqMSucbCb3JCbCr3P6ejac2qaGst0/oeAjyYLCzlYYcKbxOl5u', 'admin@gmail.com', 'admin', 'n'),
(2, 'mhs', '$2y$10$V61fkrAgepN/cmnxefoTgepP/gGgywUX42OoPQkmzNgQ0Bo3gOAW6', 'mhs@gmail.com', 'mhs', 'n'),
(7, '201811001', '$2y$10$YG8KLx16V99.OFAbcGe8PeS0SigBMmv7kUprguBwvOeYnlfjef09u', NULL, 'mhs', 'y'),
(8, '201811002', '$2y$10$AyEja1uq0qc9Q0fvkFTfKeZBTWg6LKhcnKJoKWmLAjKgE8YS3mz/y', NULL, 'mhs', 'y'),
(9, '201812009', '$2y$10$udlBaRbFwdB5pvEQMeyF1.ZW1NvuqMzM0gRWd5Ag7jkda/jkpae96', NULL, 'mhs', 'y'),
(10, '201911001', '$2y$10$ZjQU6Kvvb5Xi4iY2czkUgO4.5S8vF4vzRnxWvWG6/lsImB28o2tXS', NULL, 'mhs', 'y'),
(11, '201911002', '$2y$10$wwfrxXvtc68enfxgoYvVp.qSV7tlphvRBBygc.E2kQIviLzKwzSP2', NULL, 'mhs', 'y'),
(12, '201911003', '$2y$10$98xLFaDvvmAV4cRCULjIc.urThAG8xhVrcbCOuBcM9Tmtq5x.dLa.', NULL, 'mhs', 'y'),
(13, '201911004', '$2y$10$DOWk2eH4Hyv0qhzDuQjPAuYZ.lt4fN4tWQnXLcAHDoS.4TMTs1pZK', NULL, 'mhs', 'y'),
(14, '201911005', '$2y$10$/7VA6eLiiWuPxpLFK.JPgeHI0y/ylWDMbDSlYqYPh58Hy6aou8Pmu', NULL, 'mhs', 'y'),
(15, '2020110001', '$2y$10$mjf2WDrmX7pAtwkCKeFAGOpoPRPOVB/3TJ0GsKgC.mBkpzjfh8PwK', NULL, 'mhs', 'y'),
(20, 'A001', '$2y$10$PR0/FbcM2vSSZSZll/LI2.X80Q1QvJDDEVXFLUvjdOdlinEJC/er.', NULL, 'dosen', 'y'),
(21, 'A002', '$2y$10$QyYd9SWDC19pxNkCo7gNVuJI3l.5rkksLKg3YGGRm2oxYp3C/R6GC', NULL, 'dosen', 'y'),
(22, 'B001', '$2y$10$xuGp9EpYII48c/rW9i3Qf.Rbj3pdlXwkWx2N5CyviuLB1HvQ6ImMC', NULL, 'dosen', 'y'),
(23, 'B002', '$2y$10$E9xDQTy696E4FF05Ax1ouOH61xJDkmpHSoqB0fL4KId7tLZoNUGK2', NULL, 'dosen', 'y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_dosen`
--
ALTER TABLE `db_dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `kd_dosen` (`kd_dosen`),
  ADD KEY `jurusan` (`kd_jurusan`);

--
-- Indexes for table `db_item_krs`
--
ALTER TABLE `db_item_krs`
  ADD PRIMARY KEY (`id_item_krs`),
  ADD KEY `item-id_krs` (`id_krs`),
  ADD KEY `item-id_jadwal` (`id_jadwal`);

--
-- Indexes for table `db_jadwal`
--
ALTER TABLE `db_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `jadwal-kd_mk` (`kd_mk`),
  ADD KEY `jadwal-kd_dosen` (`kd_dosen`);

--
-- Indexes for table `db_jurusan`
--
ALTER TABLE `db_jurusan`
  ADD PRIMARY KEY (`id_jur`),
  ADD UNIQUE KEY `kd_jurusan` (`kd_jurusan`);

--
-- Indexes for table `db_mahasiswa`
--
ALTER TABLE `db_mahasiswa`
  ADD PRIMARY KEY (`id_mhs`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `kd_jurusan` (`kd_jurusan`);

--
-- Indexes for table `db_makul`
--
ALTER TABLE `db_makul`
  ADD PRIMARY KEY (`id_mk`),
  ADD UNIQUE KEY `kode_mk` (`kode_mk`),
  ADD KEY `makul-kd_jur` (`kd_jurusan`);

--
-- Indexes for table `db_nilai`
--
ALTER TABLE `db_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nilai-nim` (`nim`),
  ADD KEY `nilai-id_krs` (`id_krs`),
  ADD KEY `nilai-id_jadwal` (`id_jadwal`);

--
-- Indexes for table `db_paket_krs`
--
ALTER TABLE `db_paket_krs`
  ADD PRIMARY KEY (`id_krs`);

--
-- Indexes for table `db_ta`
--
ALTER TABLE `db_ta`
  ADD PRIMARY KEY (`id_ta`),
  ADD UNIQUE KEY `ta` (`ta`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_dosen`
--
ALTER TABLE `db_dosen`
  MODIFY `id_dosen` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `db_item_krs`
--
ALTER TABLE `db_item_krs`
  MODIFY `id_item_krs` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `db_jadwal`
--
ALTER TABLE `db_jadwal`
  MODIFY `id_jadwal` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `db_jurusan`
--
ALTER TABLE `db_jurusan`
  MODIFY `id_jur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `db_mahasiswa`
--
ALTER TABLE `db_mahasiswa`
  MODIFY `id_mhs` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `db_makul`
--
ALTER TABLE `db_makul`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `db_nilai`
--
ALTER TABLE `db_nilai`
  MODIFY `id_nilai` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `db_paket_krs`
--
ALTER TABLE `db_paket_krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `db_ta`
--
ALTER TABLE `db_ta`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `db_dosen`
--
ALTER TABLE `db_dosen`
  ADD CONSTRAINT `jurusan` FOREIGN KEY (`kd_jurusan`) REFERENCES `db_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `db_item_krs`
--
ALTER TABLE `db_item_krs`
  ADD CONSTRAINT `item-id_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `db_jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item-id_krs` FOREIGN KEY (`id_krs`) REFERENCES `db_paket_krs` (`id_krs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `db_jadwal`
--
ALTER TABLE `db_jadwal`
  ADD CONSTRAINT `jadwal-kd_dosen` FOREIGN KEY (`kd_dosen`) REFERENCES `db_dosen` (`kd_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal-kd_mk` FOREIGN KEY (`kd_mk`) REFERENCES `db_makul` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `db_mahasiswa`
--
ALTER TABLE `db_mahasiswa`
  ADD CONSTRAINT `kd_jurusan` FOREIGN KEY (`kd_jurusan`) REFERENCES `db_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `db_makul`
--
ALTER TABLE `db_makul`
  ADD CONSTRAINT `makul-kd_jur` FOREIGN KEY (`kd_jurusan`) REFERENCES `db_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `db_nilai`
--
ALTER TABLE `db_nilai`
  ADD CONSTRAINT `nilai-id_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `db_jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai-id_krs` FOREIGN KEY (`id_krs`) REFERENCES `db_paket_krs` (`id_krs`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
