-- Membuat database jika belum ada
CREATE DATABASE IF NOT EXISTS `chatbot_db`;
USE `chatbot_db`;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 11:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatbot_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

DROP TABLE IF EXISTS `chatbot`;
CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `jawaban` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `keyword`, `jawaban`) VALUES
(1, 'jam, buka, tutup', 'Kami buka dari jam 08.00 sampai 16.00'),
(2, 'alamat', 'Alamat kantor kami di Jl. Pahlawan No.4, Pleburan, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50241'),
(4, 'izin, perizinan', 'Untuk mengurus izin, anda bisa mengakses di bagian menu perizinan'),
(5, 'halo', 'Halo juga! Ada yang bisa saya bantu? 😊'),
(6, 'hai', 'Hai! Silakan, ada yang bisa dibantu?'),
(7, 'pagi', 'Selamat pagi! Semoga harimu menyenangkan ☀️'),
(8, 'siang', 'Selamat siang! 🌤️ Ada yang bisa saya bantu terkait layanan Disperindag?'),
(9, 'sore', 'Selamat sore!'),
(10, 'malam', 'Selamat malam! Ada yang bisa saya bantu?'),
(11, 'nama kamu siapa', 'Saya adalah NUSA, AI Assistant yang selalu siap membantu kamu!'),
(12, 'kamu siapa', 'Saya adalah NUSA, AI Assistant yang selalu siap membantu kamu!'),
(13, 'kamu bisa apa', 'Saya bisa membantu menjawab pertanyaan seputar layanan dan informasi.'),
(14, 'terima kasih', 'Sama-sama! Senang bisa membantu 😊'),
(15, 'makasih', 'Siap! Kalau perlu bantuan lagi, tinggal tanya ya.'),
(16, 'apa kabar', 'Saya baik-baik saja 😄 Kamu gimana?'),
(17, 'lagi apa', 'Lagi nunggu kamu nanya 😁'),
(18, 'jam', 'Kami buka dari jam 08.00 sampai 16.00'),
(20, 'kontak', 'Silakan hubungi 0281-123456'),
(21, 'izin', 'Untuk mengurus izin silakan ke menu perizinan'),
(22, 'bye', 'Sampai jumpa! Semoga harimu menyenangkan 👋'),
(23, 'dadah', 'Dadah! Jangan sungkan kalau butuh bantuan lagi ya 😊'),
(24, 'malem', 'Selamat malam! 🌙 Ada yang bisa saya bantu?'),
(25, 'layanan', 'Disperindag Provinsi Jawa Tengah menyediakan beberapa layanan utama, antara lain: 1) Layanan Perizinan Usaha Perdagangan dan Industri, 2) Fasilitasi UMKM dan IKM, 3) Pembinaan Industri, 4) Pengawasan Perdagangan, 5) Perlindungan Konsumen, dan 6) Informasi Harga serta Ketersediaan Barang Pokok. Selain itu, Disperindag juga melayani PENGADUAN masyarakat terkait masalah perdagangan dan perlindungan konsumen. Silakan ketik \"pengaduan\" jika ingin tahu cara menyampaikan pengaduan.'),
(26, 'pelayanan', 'Disperindag Provinsi Jawa Tengah melayani perizinan usaha, pembinaan UMKM/IKM, pengawasan perdagangan, perlindungan konsumen, serta informasi harga barang pokok. Disperindag juga menyediakan layanan PENGADUAN masyarakat. Jika ingin melapor, silakan ketik \"pengaduan\".'),
(27, 'disperindag melayani apa', 'Disperindag Provinsi Jawa Tengah melayani perizinan usaha perdagangan dan industri, pembinaan UMKM/IKM, pengawasan perdagangan, perlindungan konsumen, serta informasi harga dan ketersediaan barang pokok. Selain itu, tersedia juga layanan PENGADUAN masyarakat terkait masalah perdagangan dan konsumen.'),
(28, 'bisa ngapain', 'Di Disperindag Anda bisa mengurus perizinan usaha, mendapatkan pembinaan UMKM/IKM, memperoleh informasi perdagangan, serta menyampaikan PENGADUAN terkait masalah perdagangan dan perlindungan konsumen.'),
(29, 'pengaduan', 'Disperindag Provinsi Jawa Tengah melayani pengaduan masyarakat terkait masalah perdagangan, barang beredar, dan perlindungan konsumen. Anda dapat menyampaikan pengaduan melalui website resmi Disperindag atau kanal pengaduan yang tersedia. Silakan jelaskan secara singkat masalah yang ingin Anda adukan.'),
(30, 'lapor', 'Anda dapat menyampaikan pengaduan atau laporan terkait masalah perdagangan dan perlindungan konsumen melalui layanan pengaduan Disperindag Provinsi Jawa Tengah. Silakan ketik \"pengaduan\" untuk informasi lebih lanjut.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
