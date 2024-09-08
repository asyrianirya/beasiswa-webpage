SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `beasiswa_webpage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `beasiswa_webpage`;

CREATE TABLE `jenis_beasiswa` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nama_beasiswa` varchar(50) NOT NULL,
  `deskripsi_beasiswa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jenis_beasiswa` (`id`, `nama_beasiswa`, `deskripsi_beasiswa`) VALUES
(0000000001, 'Beasiswa Akademik', 'Diberikan kepada siswa atau mahasiswa dengan nilai akademik yang tinggi.'),
(0000000002, 'Beasiswa Non-Akademik', 'Diberikan untuk program studi atau disiplin ilmu tertentu.'),
(0000000003, 'Beasiswa Ekonomi', 'Diberikan kepada siswa atau mahasiswa yang membutuhkan dukungan finansial.');

CREATE TABLE `siswa_beasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hp` varchar(50) NOT NULL,
  `semester` int(1) NOT NULL,
  `ipk` float NOT NULL,
  `beasiswa` int(100) NOT NULL,
  `berkas` varchar(200) NOT NULL,
  `status_ajuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `jenis_beasiswa`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `jenis_beasiswa`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
