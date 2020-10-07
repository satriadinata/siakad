-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2020 at 10:01 AM
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
(1, '24412731', 2147483647, 2147483647, 'B123', 'Nama Dosen', 2402398, 'Kjsdkas', 'foto_dosen/mhs_20201003190726_5f78afce0fd2a.jpg'),
(2, 'AAA1257165', 2147483647, 34593475, 'A675', 'Hadi W', 658766678, 'asdajsdhkajsh', 'default/male.png');

-- --------------------------------------------------------

--
-- Table structure for table `db_jadwal`
--

CREATE TABLE `db_jadwal` (
  `id_jadwal` int(22) NOT NULL,
  `kd_mk` varchar(255) NOT NULL,
  `kd_dosen` varchar(255) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'B123', 'Manajemen', 'Duwi'),
(4, 'B312', 'Elektro', 'Poco Santoso'),
(6, 'B111', 'Akutansi', 'Dwi'),
(8, 'A675', 'Informatika', 'Gloria');

-- --------------------------------------------------------

--
-- Table structure for table `db_mahasiswa`
--

CREATE TABLE `db_mahasiswa` (
  `id_mhs` int(50) NOT NULL,
  `nim` int(22) NOT NULL,
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

INSERT INTO `db_mahasiswa` (`id_mhs`, `nim`, `nik_mhs`, `kd_jurusan`, `nama_mhs`, `alamat`, `telp`, `tempat_lahir`, `tgl_lahir`, `agama_mhs`, `kewarganegaraan`, `nama_ortu`, `alamat_ortu`, `telp_ortu`, `foto_mhs`) VALUES
(1, 71200626, 2147483647, 'B123', 'Joni J', 'asdaksflas asdjasdasjda', 987654321, 'Pati', '2008-08-21', 'Islam', 'WNI', 'Juono', 'asdasjkdkasjd', 98765432, 'foto_mhs/mhs_20201001135321_5f75c33112fb5.jpg'),
(9, 112334455, 212312312, 'B123', 'Doni', 'asdasfsdfasfas', 2147483647, 'asdadsfaf', '2020-09-29', 'Islam', 'sdfasfsafsdf', 'sdfasdfasdfas', 'asdfsafsafsa', 2147483647, 'foto_mhs/mhs_20201002163608_5f773ad817657.jpg'),
(10, 32648236, 2147483647, 'B111', 'afhjsjahfka', 'sjdhddkahk', 2147483647, 'jsdfkahsasf', '2020-10-05', 'Islam', 'sdfsfsdf', 'sdfsdfsdfds', 'dsfsdfsfsd', 2135678912, 'foto_mhs/mhs_20201001185513_5f7609f125a15.jpg');

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
(1, 'AA125', 'Matematika Log', 7, '2', 'B123'),
(2, 'AB156', 'Logika Matematika', 3, '1', 'B123');

-- --------------------------------------------------------

--
-- Table structure for table `db_nilai`
--

CREATE TABLE `db_nilai` (
  `id_krs` int(22) NOT NULL,
  `id_ta` int(11) NOT NULL,
  `nim` int(22) NOT NULL,
  `kd_mk` varchar(255) NOT NULL,
  `kd_dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `db_ta`
--

CREATE TABLE `db_ta` (
  `id_ta` int(11) NOT NULL,
  `ta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_ta`
--

INSERT INTO `db_ta` (`id_ta`, `ta`) VALUES
(3, '2020/2021');

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` enum('mhs','dosen','admin') NOT NULL,
  `blokir` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`id`, `username`, `password`, `email`, `level`, `blokir`) VALUES
(1, 'admin', '$2y$10$DznkqMSucbCb3JCbCr3P6ejac2qaGst0/oeAjyYLCzlYYcKbxOl5u', 'admin@gmail.com', 'admin', 'n'),
(2, 'mhs', '$2y$10$V61fkrAgepN/cmnxefoTgepP/gGgywUX42OoPQkmzNgQ0Bo3gOAW6', 'mhs@gmail.com', 'mhs', 'n');

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
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `nilai-id_ta` (`id_ta`),
  ADD KEY `nilai-nim` (`nim`),
  ADD KEY `nilai-kd_mk` (`kd_mk`),
  ADD KEY `nilai-kd_dosen` (`kd_dosen`);

--
-- Indexes for table `db_ta`
--
ALTER TABLE `db_ta`
  ADD PRIMARY KEY (`id_ta`);

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
  MODIFY `id_dosen` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_jadwal`
--
ALTER TABLE `db_jadwal`
  MODIFY `id_jadwal` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_jurusan`
--
ALTER TABLE `db_jurusan`
  MODIFY `id_jur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `db_mahasiswa`
--
ALTER TABLE `db_mahasiswa`
  MODIFY `id_mhs` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `db_makul`
--
ALTER TABLE `db_makul`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_nilai`
--
ALTER TABLE `db_nilai`
  MODIFY `id_krs` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_ta`
--
ALTER TABLE `db_ta`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `db_dosen`
--
ALTER TABLE `db_dosen`
  ADD CONSTRAINT `jurusan` FOREIGN KEY (`kd_jurusan`) REFERENCES `db_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `nilai-id_ta` FOREIGN KEY (`id_ta`) REFERENCES `db_ta` (`id_ta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai-kd_dosen` FOREIGN KEY (`kd_dosen`) REFERENCES `db_dosen` (`kd_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai-kd_mk` FOREIGN KEY (`kd_mk`) REFERENCES `db_makul` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai-nim` FOREIGN KEY (`nim`) REFERENCES `db_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
