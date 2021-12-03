-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 03:25 AM
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
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_guru` varchar(200) NOT NULL,
  `NIG` char(9) NOT NULL,
  `mapel_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama_guru`, `NIG`, `mapel_id`, `user_id`) VALUES
(5, 'Guru 1', '190123001', 1, 10),
(6, 'Guru 2', '190121002', 3, 11),
(7, 'Guru3', '190121003', 3, 12),
(8, 'Guru 4', '190121004', 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(10) UNSIGNED NOT NULL,
  `jawaban` varchar(200) NOT NULL,
  `nilai` int(10) UNSIGNED DEFAULT 0,
  `siswa` int(10) UNSIGNED NOT NULL,
  `tugas` int(10) UNSIGNED NOT NULL,
  `mapel` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id`, `jawaban`, `nilai`, `siswa`, `tugas`, `mapel`) VALUES
(1, 'E-Commerce.pdf', 80, 4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kelas` varchar(12) NOT NULL,
  `jurusan` enum('IPA','IPS') DEFAULT NULL,
  `wali_kelas` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan`, `wali_kelas`) VALUES
(2, '10 A', 'IPA', 5),
(3, '11 A', 'IPA', 6),
(4, '12 A', 'IPA', 7),
(5, '12 B', 'IPS', 8);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_mapel` varchar(200) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama_mapel`, `Created_at`) VALUES
(1, 'Matematika Wajib', '2021-11-13 02:28:45'),
(2, 'B. Indonesia', '2021-11-13 02:50:46'),
(3, 'Matematika Peminatan', '2021-11-13 17:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `mapel_kelas`
--

CREATE TABLE `mapel_kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `kelas` int(10) UNSIGNED NOT NULL,
  `guru` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel_kelas`
--

INSERT INTO `mapel_kelas` (`id`, `kelas`, `guru`) VALUES
(1, 2, 6),
(2, 2, 8),
(3, 5, 6),
(5, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `NIS` char(9) NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama_siswa`, `NIS`, `kelas_id`, `user_id`) VALUES
(3, 'Siswa 4', '211121004', 2, 7),
(4, 'Siswa 2', '211121002', 2, 8),
(5, 'Siswa 3', '211121003', 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_tugas` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `guru` int(10) UNSIGNED NOT NULL,
  `kelas` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `nama_tugas`, `deskripsi`, `deadline`, `created_at`, `guru`, `kelas`) VALUES
(2, 'E-Commerce', '<p><strong>Buatlah</strong></p><ul><li>makalah tentang e-commerce</li><li>Buat PPT nya</li></ul>', '2021-12-25', '2021-12-02 09:57:52', 6, 2),
(3, 'Quiz', '<p>Dengan Kelompok yang sudah dibagikan kemarin. Buatlah :</p><ol><li>Mindmapping</li><li>Daftar Tugas</li><li>Form</li></ol><p>Dikumpul dalam bentuk PDF</p>', '2021-12-04', '2021-12-02 15:44:10', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` enum('ADMIN','GURU','SISWA') DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `status`, `Created_at`) VALUES
(1, 'admin', '$2y$10$YUgrqufmksozuj1VtDN1C.8DwEPPBOx3AMT5yFCeYCUsResux2qBq', 'admin@gmail.com', 'ADMIN', '2021-11-13 02:28:01'),
(6, 'admin3', '$2y$10$7QGWGfFoBpnO/0kF79LQ3ulVtr0FKJPh77PKbN7RzumVlxnwsIW.e', 'admin3@gmail.com', 'ADMIN', '2021-11-18 02:41:54'),
(7, 'siswa4', '$2y$10$9DeaZ/QWJA7OKNcpLvZ82.zLCIRk0Cb3vPeExoSq2ShHmOvpMQ09e', 'siswa4@gmail.com', 'SISWA', '2021-11-20 03:30:49'),
(8, 'siswa2', '$2y$10$flZcNQKe0n0dN01V.tSHh.Y.4oHS9HNWwc219DO5y2jOmNaC37VG.', 'siswa2@gmail.com', 'SISWA', '2021-11-20 03:31:01'),
(9, 'siswa3', '$2y$10$7j8uWayxjYTuOwsJDJpNAOwZ3zfn5XB534S4jnQ8mple0chX0J8u.', 'siswa3@gmail.com', 'SISWA', '2021-11-20 03:31:23'),
(10, 'guru1', '$2y$10$ppGIBjiJknu.sDn.hHl66OCz9M/KmitNLt5nFYXXmPlJ4ijGbt2yi', 'guru1@gmail.com', 'GURU', '2021-11-20 03:31:40'),
(11, 'guru2', '$2y$10$NK0X0ZL1eeikZTOGJPeNpeX2YeC6LKvbWXQ6nvHSH..kUg23zaXKe', 'guru2@gmail.com', 'GURU', '2021-11-20 03:31:55'),
(12, 'guru3', '$2y$10$zdcUodI1eKn0JSDioMzrUuj2QcrPqAI4LMz1jZg25po0I7C2AUwaa', 'guru3@gmail.com', 'GURU', '2021-11-20 03:36:22'),
(13, 'guru4', '$2y$10$U29xmEr.yfAf/kMwIFobzewtEX67/o/Yd2ZKs/7nX.hxGengTShWK', 'guru4@gmail.com', 'GURU', '2021-11-21 01:52:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_guru` (`user_id`),
  ADD KEY `fk_mapel_guru` (`mapel_id`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nilai_siswa` (`siswa`),
  ADD KEY `fk_jawaban_tugas` (`tugas`),
  ADD KEY `fk_mapel_jawaban` (`mapel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wali` (`wali_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_kelas` (`kelas`),
  ADD KEY `fk_pengajar` (`guru`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kelas` (`kelas_id`),
  ADD KEY `fk_user_siswa` (`user_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tugas_guru` (`guru`),
  ADD KEY `fk_tugas_kelas` (`kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_mapel_guru` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_guru` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `fk_jawaban_tugas` FOREIGN KEY (`tugas`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mapel_jawaban` FOREIGN KEY (`mapel`) REFERENCES `mapel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_siswa` FOREIGN KEY (`siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `fk_wali` FOREIGN KEY (`wali_kelas`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD CONSTRAINT `fk_mapel_kelas` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengajar` FOREIGN KEY (`guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_siswa` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `fk_tugas_guru` FOREIGN KEY (`guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tugas_kelas` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
