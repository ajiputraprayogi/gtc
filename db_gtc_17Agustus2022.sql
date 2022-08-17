-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 09:55 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_syirkah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kantor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `nama_karyawan`, `user_name`, `email`, `jabatan`, `kantor`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'xVfOSypOs9', 'mentorbaik2', 'administrator1@test.com', 'Karyawan', 'Pusat', 1, '2022-05-16 16:48:58', '2022-05-16 16:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_ba` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `no_ktp` bigint(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_nikah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_npwp` bigint(20) DEFAULT NULL,
  `alamat_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_tinggal` enum('sesuai','tidakSesuai') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_domisili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan_domisili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_domisili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_domisili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi_domisili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `user_id`, `nomor_ba`, `nama_lengkap`, `no_hp`, `email`, `status`, `no_ktp`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `status_nikah`, `no_npwp`, `alamat_ktp`, `kelurahan_ktp`, `kecamatan_ktp`, `kota_ktp`, `provinsi_ktp`, `alamat_tinggal`, `alamat_domisili`, `kelurahan_domisili`, `kecamatan_domisili`, `kota_domisili`, `provinsi_domisili`, `foto_ktp`, `lokasi_foto_ktp`, `created_at`, `updated_at`) VALUES
(1, 2, '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', 1, 6555555555555552, 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', 2, 'alamat domisili', '0,Blabak', '0,Pesantren', '0,Kota Kediri', '0,Jawa Timur', 'tidakSesuai', 'alamat domisili', '3571030001,Blabak', '3571030,Pesantren', '3571,Kota Kediri', '35,Jawa Timur', 'oicndi20_poster_breakouts_1.png', 'F:\\Projek 2022\\SI_Pinjam\\si_pinjam\\public/images/data_penting/ktp\\oicndi20_poster_breakouts_1.png', '2022-05-16 16:48:58', '2022-06-24 06:51:30'),
(2, 24, '0.123.1234568', 'Aji Putra Prayogi', '082131231', 'test@gmail.com', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'alamat domisili', '3571030001,Blabak', '3571030,Pesantren', '3571,Kota Kediri', '35,Jawa Timur', 'tidakSesuai', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gtc_emas`
--

CREATE TABLE `gtc_emas` (
  `id` int(11) NOT NULL,
  `kode_pengajuan` varchar(50) DEFAULT NULL,
  `id_item_emas_syirkah` varchar(50) DEFAULT NULL,
  `id_harga_buyback` varchar(50) DEFAULT NULL,
  `item_emas` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `gramasi` varchar(50) DEFAULT NULL,
  `keping` varchar(50) DEFAULT NULL,
  `harga_buyback` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_emas`
--

INSERT INTO `gtc_emas` (`id`, `kode_pengajuan`, `id_item_emas_syirkah`, `id_harga_buyback`, `item_emas`, `jenis`, `gramasi`, `keping`, `harga_buyback`, `created_at`, `updated_at`) VALUES
(182, 'A.1234567.1', '5', NULL, 'EOA Gold 0.1', 'Reguler', '0.1', '5', '101000', '2022-07-11 02:06:50', '2022-07-11 09:07:37'),
(183, 'A.1234567.1', '6', NULL, 'EOA Gold 0.2', 'reguler', '0.2', '6', '208500', '2022-07-11 02:06:54', '2022-07-11 09:07:37'),
(184, 'A.1234567.1', '2', NULL, 'EOA Gold 0.5', 'Reguler', '0.5', '7', '480000', '2022-07-11 02:06:57', '2022-07-11 09:07:37'),
(185, 'A.1234567.2', '4', NULL, 'EOA Gold 0.1', 'Series If', '0.1', '100', '101000', '2022-07-19 01:34:27', '2022-07-19 08:36:53'),
(186, 'A.1234567.2', '6', NULL, 'EOA Gold 0.2', 'reguler', '0.2', '100', '208500', '2022-07-19 01:34:31', '2022-07-19 08:36:53'),
(187, 'A.1234567.2', '2', NULL, 'EOA Gold 0.5', 'Reguler', '0.5', '100', '480000', '2022-07-19 01:34:35', '2022-07-19 08:36:53'),
(188, 'A.1234567.2', '1', NULL, 'EOA Gold 1', 'Reguler', '1', '100', '907500', '2022-07-19 01:34:41', '2022-07-19 08:36:53'),
(189, 'A.1234567.3', '1', NULL, 'EOA Gold 1', 'Reguler', '1', '10', '907500', '2022-07-20 19:37:03', '2022-07-21 02:39:02'),
(190, 'A.1234567.3', '7', NULL, 'EOA Gold 2', 'reguler', '2', '10', '1753000', '2022-07-20 19:37:07', '2022-07-21 02:39:02'),
(191, 'A.1234567.3', '8', NULL, 'EOA Gold 5', 'reguler', '5', '10', '4419500', '2022-07-20 19:37:13', '2022-07-21 02:39:02'),
(192, 'A.1234567.4', '1', NULL, 'EOA Gold 1', 'Reguler', '1', '10', '907500', '2022-07-31 23:13:46', '2022-08-01 06:17:30'),
(193, 'A.1234567.4', '7', NULL, 'EOA Gold 2', 'reguler', '2', '10', '1753000', '2022-07-31 23:13:49', '2022-08-01 06:17:30'),
(194, 'A.1234567.4', '8', NULL, 'EOA Gold 5', 'reguler', '5', '10', '4419500', '2022-07-31 23:13:52', '2022-08-01 06:17:30'),
(195, 'A.1234567.5', '1', NULL, 'EOA Gold 1', 'Reguler', '1', '10', '907500', '2022-08-02 21:17:02', '2022-08-03 04:18:13'),
(196, 'A.1234567.5', '7', NULL, 'EOA Gold 2', 'reguler', '2', '10', '1753000', '2022-08-02 21:17:05', '2022-08-03 04:18:13'),
(197, 'A.1234567.5', '8', NULL, 'EOA Gold 5', 'reguler', '5', '10', '4419500', '2022-08-02 21:17:10', '2022-08-03 04:18:13'),
(198, 'A.1234567.6', '4', NULL, 'EOA Gold 0.1', 'Series If', '0.1', '5', '101000', '2022-08-14 04:39:37', '2022-08-14 11:40:32'),
(199, 'A.1234567.7', '2', NULL, 'EOA Gold 0.5', 'Reguler', '0.5', '4', '480000', '2022-08-14 04:51:20', '2022-08-14 11:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `gtc_harga_harian`
--

CREATE TABLE `gtc_harga_harian` (
  `id` int(11) NOT NULL,
  `tgl_rilis` varchar(50) NOT NULL DEFAULT '',
  `nolsatu_gram` varchar(50) NOT NULL,
  `noldua_gram` varchar(50) NOT NULL,
  `nollima_gram` varchar(50) NOT NULL,
  `satu_gram` varchar(50) NOT NULL,
  `dua_gram` varchar(50) NOT NULL,
  `lima_gram` varchar(50) NOT NULL,
  `sepuluh_gram` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_harga_harian`
--

INSERT INTO `gtc_harga_harian` (`id`, `tgl_rilis`, `nolsatu_gram`, `noldua_gram`, `nollima_gram`, `satu_gram`, `dua_gram`, `lima_gram`, `sepuluh_gram`, `status`) VALUES
(14, '26 Mei 2022', '10000', '20000', '50000', '100000', '200000', '500000', '1000000', 'Nonactive'),
(15, '10 Juni 2022', '1000', '4000', '6000', '10000', '12000', '14000', '16000', 'Nonactive'),
(16, '10 Juni 2022', '101000', '208500', '480000', '907500', '1753000', '4419500', '8829000', 'Active'),
(17, '21 Juni 2022', '4000', '10000', '12000', '14000', '16000', '18000', '20000', 'Nonactive');

-- --------------------------------------------------------

--
-- Table structure for table `gtc_histori_anggota`
--

CREATE TABLE `gtc_histori_anggota` (
  `id` int(11) NOT NULL,
  `id_anggota` varchar(50) DEFAULT NULL,
  `nomor_ba` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `nomor_hp` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `no_ktp` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` varchar(50) DEFAULT NULL,
  `status_nikah` varchar(50) DEFAULT NULL,
  `no_npwp` varchar(50) DEFAULT NULL,
  `alamat_ktp` varchar(50) DEFAULT NULL,
  `provinsi_ktp` varchar(50) DEFAULT NULL,
  `kota_ktp` varchar(50) DEFAULT NULL,
  `kecamatan_ktp` varchar(50) DEFAULT NULL,
  `kelurahan_ktp` varchar(50) DEFAULT NULL,
  `alamat_tinggal` varchar(50) DEFAULT NULL,
  `alamat_domisili` varchar(50) DEFAULT NULL,
  `provinsi_domisili` varchar(50) DEFAULT NULL,
  `kota_domisili` varchar(50) DEFAULT NULL,
  `kecamatan_domisili` varchar(50) DEFAULT NULL,
  `kelurahan_domisili` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_histori_anggota`
--

INSERT INTO `gtc_histori_anggota` (`id`, `id_anggota`, `nomor_ba`, `nama_lengkap`, `nomor_hp`, `email`, `status`, `no_ktp`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `status_nikah`, `no_npwp`, `alamat_ktp`, `provinsi_ktp`, `kota_ktp`, `kecamatan_ktp`, `kelurahan_ktp`, `alamat_tinggal`, `alamat_domisili`, `provinsi_domisili`, `kota_domisili`, `kecamatan_domisili`, `kelurahan_domisili`, `created_at`, `updated_at`) VALUES
(20, '1', '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', '1', '6555555555555552', 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', '2', 'alamat domisili', '51,Bali', '5108,Kabupaten Buleleng', '5108070,Sawan', '5108070004,Bebetin', 'tidakSesuai', 'alamat domisili', '36,Banten', '3603,Kabupaten Tangerang', '3603132,Sukamulya', '3603132003,Suka Mulya', '2022-06-22 02:50:28', '2022-06-22 02:50:28'),
(21, '1', '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', '1', '6555555555555552', 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', '2', 'alamat domisili', '35,Jawa Timur', '3516,Kabupaten Mojokerto', '3516130,Sooko', '3516130012,Karangkedawang', 'tidakSesuai', 'alamat domisili', '31,Dki Jakarta', '3172,Kota Jakarta Timur', '3172080,Cakung', '3172080003,Pulo Gebang', '2022-06-22 02:52:33', '2022-06-22 02:52:33'),
(22, '1', '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', '1', '6555555555555552', 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', '2', 'alamat domisili', '51,Bali', '5104,Kabupaten Gianyar', '5104030,Gianyar', '5104030014,Petak', 'tidakSesuai', 'alamat domisili', '15,Jambi', '1504,Kabupaten Batang Hari', '1504042,Maro Sebo Ilir', '1504042006,Karya Mukti', '2022-06-22 02:54:17', '2022-06-22 02:54:17'),
(23, '1', '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', '1', '6555555555555552', 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', '2', 'alamat domisili', '36,Banten', '3673,Kota Serang', '3673020,Walantaka', '3673020004,Tegalsari', 'tidakSesuai', 'alamat domisili', '52,Nusa Tenggara Barat', '5204,Kabupaten Sumbawa', '5204112,Lantung', '5204112003,Lantung', '2022-06-22 02:55:05', '2022-06-22 02:55:05'),
(24, '1', '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', '1', '6555555555555552', 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', '2', 'alamat domisili', '36,Banten', '3673,Kota Serang', '3673020,Walantaka', '3673020004,Tegalsari', 'tidakSesuai', 'alamat domisili', '52,Nusa Tenggara Barat', '5204,Kabupaten Sumbawa', '5204112,Lantung', '5204112003,Lantung', '2022-06-22 02:55:15', '2022-06-22 02:55:15'),
(25, '1', '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', '1', '6555555555555552', 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', '2', 'alamat domisili', '36,Banten', '3673,Kota Serang', '3673020,Walantaka', '3673020004,Tegalsari', 'tidakSesuai', 'alamat domisili', '52,Nusa Tenggara Barat', '5204,Kabupaten Sumbawa', '5204112,Lantung', '5204112003,Lantung', '2022-06-22 02:56:26', '2022-06-22 02:56:26'),
(26, '1', '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', '1', '6555555555555552', 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', '2', 'alamat domisili', '53,Nusa Tenggara Timur', '5302,Kabupaten Sumba Timur', '5302060,Pandawai', '5302060009,Kadumbul', 'tidakSesuai', 'alamat domisili', '52,Nusa Tenggara Barat', '5208,Kabupaten Lombok Utara', '5208030,Gangga', '5208030003,Genggelang', '2022-06-22 03:01:11', '2022-06-22 03:01:11'),
(27, '1', '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', '1', '6555555555555552', 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', '2', 'alamat domisili', '33,Jawa Tengah', '3314,Kabupaten Sragen', '3314160,Mondokan', '3314160004,Jekani', 'tidakSesuai', 'alamat domisili', '36,Banten', '3604,Kabupaten Serang', '3604120,Cikande', '3604120010,Gembor Udik', '2022-06-24 06:51:30', '2022-06-24 06:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `gtc_histori_pengajuan`
--

CREATE TABLE `gtc_histori_pengajuan` (
  `id` int(11) NOT NULL,
  `tanggal_pengajuan` varchar(50) DEFAULT NULL,
  `id_anggota` varchar(250) DEFAULT NULL,
  `id_perwada` varchar(250) DEFAULT NULL,
  `kode_pengajuan` varchar(250) DEFAULT NULL,
  `tujuan` varchar(250) DEFAULT NULL,
  `plafond_pinjaman` varchar(250) DEFAULT NULL,
  `pengajuan` varchar(250) DEFAULT NULL,
  `pilihan_bank` varchar(250) DEFAULT NULL,
  `nomor_rekening` varchar(250) DEFAULT NULL,
  `nama_pemilik_rekening` varchar(250) DEFAULT NULL,
  `kode_transaksi` varchar(250) DEFAULT NULL,
  `jenis_transaksi` varchar(250) DEFAULT NULL,
  `pilihan_jasa` varchar(250) DEFAULT NULL,
  `perhitungan_jasa` varchar(250) DEFAULT NULL,
  `jangka_waktu_permohonan` varchar(250) DEFAULT NULL,
  `jasa_gtc` varchar(250) DEFAULT NULL,
  `pembayaran_jasa` varchar(250) DEFAULT NULL,
  `upload_bukti_transfer` varchar(250) DEFAULT NULL,
  `pembayaran_jasa_manual` varchar(250) DEFAULT NULL,
  `ket_simpwa` varchar(250) DEFAULT NULL,
  `nominal_potongan` varchar(250) DEFAULT NULL,
  `jumlah_yang_di_transfer` varchar(250) DEFAULT NULL,
  `tipe_transaksi` varchar(250) DEFAULT NULL,
  `upload_foto_gold` varchar(250) DEFAULT NULL,
  `upload_surat_terima_transfer` varchar(250) DEFAULT NULL,
  `upload_form_pengajuan` varchar(250) DEFAULT NULL,
  `surat_kuasa_penjualan_jaminan_marhum` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gtc_histori_transaksi`
--

CREATE TABLE `gtc_histori_transaksi` (
  `id` int(11) NOT NULL,
  `kode_pengajuan` varchar(50) DEFAULT NULL,
  `kode_transaksi` varchar(50) DEFAULT NULL,
  `id_emas` varchar(50) DEFAULT NULL,
  `keping` varchar(50) DEFAULT NULL,
  `harga_buyback` varchar(50) DEFAULT NULL,
  `pembayaran_pinjaman` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_histori_transaksi`
--

INSERT INTO `gtc_histori_transaksi` (`id`, `kode_pengajuan`, `kode_transaksi`, `id_emas`, `keping`, `harga_buyback`, `pembayaran_pinjaman`, `created_at`, `updated_at`) VALUES
(92, 'A.1234567.1', 'B.1234567.1.1', '182', '0', NULL, '0', '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(93, 'A.1234567.1', 'B.1234567.1.1', '183', '0', NULL, '0', '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(94, 'A.1234567.1', 'B.1234567.1.1', '184', '0', NULL, '0', '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(167, 'A.1234567.1', 'B.1234567.1.2', '182', '1', NULL, '3000000', '2022-07-14 02:44:59', '2022-07-14 04:17:14'),
(168, 'A.1234567.1', 'B.1234567.1.2', '183', '1', NULL, '3000000', '2022-07-14 02:44:59', '2022-07-14 04:17:14'),
(169, 'A.1234567.1', 'B.1234567.1.2', '184', '1', NULL, '3000000', '2022-07-14 02:44:59', '2022-07-14 04:17:14'),
(170, 'A.1234567.1', 'B.1234567.1.3', '182', '4', NULL, '1604400', '2022-07-14 02:45:22', '2022-07-14 02:56:14'),
(171, 'A.1234567.1', 'B.1234567.1.3', '183', '5', NULL, '1604400', '2022-07-14 02:45:22', '2022-07-14 02:56:14'),
(172, 'A.1234567.1', 'B.1234567.1.3', '184', '6', NULL, '1604400', '2022-07-14 02:45:22', '2022-07-14 02:56:14'),
(173, 'A.1234567.2', 'B.1234567.2.1', '185', '0', NULL, NULL, '2022-07-19 08:36:53', '2022-07-19 08:36:53'),
(174, 'A.1234567.2', 'B.1234567.2.1', '186', '0', NULL, NULL, '2022-07-19 08:36:53', '2022-07-19 08:36:53'),
(175, 'A.1234567.2', 'B.1234567.2.1', '187', '0', NULL, NULL, '2022-07-19 08:36:53', '2022-07-19 08:36:53'),
(176, 'A.1234567.2', 'B.1234567.2.1', '188', '0', NULL, NULL, '2022-07-19 08:36:53', '2022-07-19 08:36:53'),
(193, 'A.1234567.3', 'B.1234567.3.1', '189', '0', NULL, NULL, '2022-07-21 02:39:02', '2022-07-21 02:39:02'),
(194, 'A.1234567.3', 'B.1234567.3.1', '190', '0', NULL, NULL, '2022-07-21 02:39:02', '2022-07-21 02:39:02'),
(195, 'A.1234567.3', 'B.1234567.3.1', '191', '0', NULL, NULL, '2022-07-21 02:39:02', '2022-07-21 02:39:02'),
(204, 'A.1234567.2', 'B.1234567.2.2', '185', '0', NULL, '0', '2022-07-22 06:19:16', '2022-07-22 06:19:16'),
(205, 'A.1234567.2', 'B.1234567.2.2', '186', '0', NULL, '0', '2022-07-22 06:19:16', '2022-07-22 06:19:16'),
(206, 'A.1234567.2', 'B.1234567.2.2', '187', '0', NULL, '0', '2022-07-22 06:19:16', '2022-07-22 06:19:16'),
(207, 'A.1234567.2', 'B.1234567.2.2', '188', '0', NULL, '0', '2022-07-22 06:19:16', '2022-07-22 06:19:16'),
(208, 'A.1234567.2', 'B.1234567.2.3', '185', '50', NULL, '77230000', '2022-07-22 06:21:05', '2022-07-22 06:21:05'),
(209, 'A.1234567.2', 'B.1234567.2.3', '186', '50', NULL, '77230000', '2022-07-22 06:21:05', '2022-07-22 06:21:05'),
(210, 'A.1234567.2', 'B.1234567.2.3', '187', '50', NULL, '77230000', '2022-07-22 06:21:05', '2022-07-22 06:21:05'),
(211, 'A.1234567.2', 'B.1234567.2.3', '188', '50', NULL, '77230000', '2022-07-22 06:21:05', '2022-07-22 06:21:05'),
(212, 'A.1234567.2', 'B.1234567.2.4', '185', '50', NULL, '75500000', '2022-07-22 06:21:44', '2022-07-22 06:21:44'),
(213, 'A.1234567.2', 'B.1234567.2.4', '186', '50', NULL, '75500000', '2022-07-22 06:21:44', '2022-07-22 06:21:44'),
(214, 'A.1234567.2', 'B.1234567.2.4', '187', '50', NULL, '75500000', '2022-07-22 06:21:44', '2022-07-22 06:21:44'),
(215, 'A.1234567.2', 'B.1234567.2.4', '188', '50', NULL, '75500000', '2022-07-22 06:21:44', '2022-07-22 06:21:44'),
(216, 'A.1234567.3', 'B.1234567.3.2', '189', '5', NULL, '32000000', '2022-07-26 05:38:19', '2022-07-26 05:38:19'),
(217, 'A.1234567.3', 'B.1234567.3.2', '190', '5', NULL, '32000000', '2022-07-26 05:38:19', '2022-07-26 05:38:19'),
(218, 'A.1234567.3', 'B.1234567.3.2', '191', '5', NULL, '32000000', '2022-07-26 05:38:19', '2022-07-26 05:38:19'),
(219, 'A.1234567.3', 'B.1234567.3.3', '189', '0', NULL, '0', '2022-07-26 05:39:27', '2022-07-26 05:39:27'),
(220, 'A.1234567.3', 'B.1234567.3.3', '190', '0', NULL, '0', '2022-07-26 05:39:27', '2022-07-26 05:39:27'),
(221, 'A.1234567.3', 'B.1234567.3.3', '191', '0', NULL, '0', '2022-07-26 05:39:27', '2022-07-26 05:39:27'),
(252, 'A.1234567.3', 'B.1234567.3.4', '189', '5', NULL, '31720000', '2022-07-27 04:03:20', '2022-07-27 04:03:20'),
(253, 'A.1234567.3', 'B.1234567.3.4', '190', '5', NULL, '31720000', '2022-07-27 04:03:20', '2022-07-27 04:03:20'),
(254, 'A.1234567.3', 'B.1234567.3.4', '191', '5', NULL, '31720000', '2022-07-27 04:03:20', '2022-07-27 04:03:20'),
(258, 'A.1234567.4', 'B.1234567.4.1', '192', '0', NULL, NULL, '2022-08-01 06:17:30', '2022-08-01 06:17:30'),
(259, 'A.1234567.4', 'B.1234567.4.1', '193', '0', NULL, NULL, '2022-08-01 06:17:30', '2022-08-01 06:17:30'),
(260, 'A.1234567.4', 'B.1234567.4.1', '194', '0', NULL, NULL, '2022-08-01 06:17:30', '2022-08-01 06:17:30'),
(264, 'A.1234567.4', 'B.1234567.4.2', '192', '0', NULL, '0', '2022-08-02 03:49:54', '2022-08-02 04:00:16'),
(265, 'A.1234567.4', 'B.1234567.4.2', '193', '0', NULL, '0', '2022-08-02 03:49:54', '2022-08-02 04:00:16'),
(266, 'A.1234567.4', 'B.1234567.4.2', '194', '0', NULL, '0', '2022-08-02 03:49:54', '2022-08-02 04:00:16'),
(267, 'A.1234567.4', 'B.1234567.4.3', '192', '5', NULL, '32000000', '2022-08-02 03:53:51', '2022-08-02 03:53:51'),
(268, 'A.1234567.4', 'B.1234567.4.3', '193', '5', NULL, '32000000', '2022-08-02 03:53:51', '2022-08-02 03:53:51'),
(269, 'A.1234567.4', 'B.1234567.4.3', '194', '5', NULL, '32000000', '2022-08-02 03:53:51', '2022-08-02 03:53:51'),
(270, 'A.1234567.5', 'B.1234567.5.1', '195', '0', NULL, NULL, '2022-08-03 04:18:13', '2022-08-03 04:18:13'),
(271, 'A.1234567.5', 'B.1234567.5.1', '196', '0', NULL, NULL, '2022-08-03 04:18:13', '2022-08-03 04:18:13'),
(272, 'A.1234567.5', 'B.1234567.5.1', '197', '0', NULL, NULL, '2022-08-03 04:18:13', '2022-08-03 04:18:13'),
(273, 'A.1234567.5', 'B.1234567.5.2', '195', '0', NULL, '0', '2022-08-03 04:27:10', '2022-08-03 04:31:11'),
(274, 'A.1234567.5', 'B.1234567.5.2', '196', '0', NULL, '0', '2022-08-03 04:27:10', '2022-08-03 04:31:11'),
(275, 'A.1234567.5', 'B.1234567.5.2', '197', '0', NULL, '0', '2022-08-03 04:27:10', '2022-08-03 04:31:11'),
(276, 'A.1234567.5', 'B.1234567.5.3', '195', '1', NULL, '20000000', '2022-08-03 04:33:29', '2022-08-03 04:33:29'),
(277, 'A.1234567.5', 'B.1234567.5.3', '196', '2', NULL, '20000000', '2022-08-03 04:33:29', '2022-08-03 04:33:29'),
(278, 'A.1234567.5', 'B.1234567.5.3', '197', '3', NULL, '20000000', '2022-08-03 04:33:29', '2022-08-03 04:33:29'),
(279, 'A.1234567.5', 'B.1234567.5.4', '195', '0', NULL, '0', '2022-08-03 05:05:34', '2022-08-03 05:05:34'),
(280, 'A.1234567.5', 'B.1234567.5.4', '196', '0', NULL, '0', '2022-08-03 05:05:34', '2022-08-03 05:05:34'),
(281, 'A.1234567.5', 'B.1234567.5.4', '197', '0', NULL, '0', '2022-08-03 05:05:34', '2022-08-03 05:05:34'),
(282, 'A.1234567.5', 'B.1234567.5.5', '195', '5', NULL, '30000000', '2022-08-03 05:34:47', '2022-08-03 05:34:47'),
(283, 'A.1234567.5', 'B.1234567.5.5', '196', '5', NULL, '30000000', '2022-08-03 05:34:47', '2022-08-03 05:34:47'),
(284, 'A.1234567.5', 'B.1234567.5.5', '197', '5', NULL, '30000000', '2022-08-03 05:34:47', '2022-08-03 05:34:47'),
(285, 'A.1234567.5', 'B.1234567.5.6', '195', '4', NULL, '13720000', '2022-08-03 05:41:27', '2022-08-03 05:41:27'),
(286, 'A.1234567.5', 'B.1234567.5.6', '196', '3', NULL, '13720000', '2022-08-03 05:41:27', '2022-08-03 05:41:27'),
(287, 'A.1234567.5', 'B.1234567.5.6', '197', '2', NULL, '13720000', '2022-08-03 05:41:27', '2022-08-03 05:41:27'),
(288, 'A.1234567.4', 'B.1234567.4.4', '192', '1', NULL, '7000000', '2022-08-04 05:11:31', '2022-08-04 05:11:31'),
(289, 'A.1234567.4', 'B.1234567.4.4', '193', '1', NULL, '7000000', '2022-08-04 05:11:31', '2022-08-04 05:11:31'),
(290, 'A.1234567.4', 'B.1234567.4.4', '194', '1', NULL, '7000000', '2022-08-04 05:11:31', '2022-08-04 05:11:31'),
(291, 'A.1234567.4', 'B.1234567.4.5', '192', '0', NULL, '0', '2022-08-08 07:44:02', '2022-08-08 07:44:02'),
(292, 'A.1234567.4', 'B.1234567.4.5', '193', '0', NULL, '0', '2022-08-08 07:44:02', '2022-08-08 07:44:02'),
(293, 'A.1234567.4', 'B.1234567.4.5', '194', '0', NULL, '0', '2022-08-08 07:44:02', '2022-08-08 07:44:02'),
(294, 'A.1234567.4', 'B.1234567.4.6', '192', '0', NULL, '0', '2022-08-12 06:44:47', '2022-08-12 06:44:47'),
(295, 'A.1234567.4', 'B.1234567.4.6', '193', '0', NULL, '0', '2022-08-12 06:44:47', '2022-08-12 06:44:47'),
(296, 'A.1234567.4', 'B.1234567.4.6', '194', '0', NULL, '0', '2022-08-12 06:44:47', '2022-08-12 06:44:47'),
(297, 'A.1234567.4', 'B.1234567.4.7', '192', '0', NULL, '0', '2022-08-12 06:45:58', '2022-08-12 06:45:58'),
(298, 'A.1234567.4', 'B.1234567.4.7', '193', '0', NULL, '0', '2022-08-12 06:45:58', '2022-08-12 06:45:58'),
(299, 'A.1234567.4', 'B.1234567.4.7', '194', '0', NULL, '0', '2022-08-12 06:45:58', '2022-08-12 06:45:58'),
(300, 'A.1234567.4', 'B.1234567.4.8', '192', '0', NULL, '0', '2022-08-12 06:50:37', '2022-08-12 07:20:59'),
(301, 'A.1234567.4', 'B.1234567.4.8', '193', '0', NULL, '0', '2022-08-12 06:50:37', '2022-08-12 07:20:59'),
(302, 'A.1234567.4', 'B.1234567.4.8', '194', '0', NULL, '0', '2022-08-12 06:50:37', '2022-08-12 07:20:59'),
(303, 'A.1234567.6', 'B.1234567.6.1', '198', '0', NULL, NULL, '2022-08-14 11:40:32', '2022-08-14 11:40:32'),
(304, 'A.1234567.7', 'B.1234567.7.1', '199', '0', NULL, NULL, '2022-08-14 11:57:06', '2022-08-14 11:57:06'),
(305, 'A.1234567.7', 'B.1234567.7.2', '199', '1', NULL, '900000', '2022-08-15 11:14:21', '2022-08-15 11:14:21'),
(306, 'A.1234567.4', 'B.1234567.4.9', '192', '1', '907500', '20000000', '2022-08-17 06:18:21', '2022-08-17 06:18:21'),
(307, 'A.1234567.4', 'B.1234567.4.9', '193', '0', '1753000', '20000000', '2022-08-17 06:18:21', '2022-08-17 06:18:21'),
(308, 'A.1234567.4', 'B.1234567.4.9', '194', '0', '4419500', '20000000', '2022-08-17 06:18:21', '2022-08-17 06:18:21'),
(309, 'A.1234567.4', 'B.1234567.4.10', '192', '0', '14000', '4600000', '2022-08-17 06:31:41', '2022-08-17 06:31:41'),
(310, 'A.1234567.4', 'B.1234567.4.10', '193', '1', '16000', '4600000', '2022-08-17 06:31:41', '2022-08-17 06:31:41'),
(311, 'A.1234567.4', 'B.1234567.4.10', '194', '0', '18000', '4600000', '2022-08-17 06:31:41', '2022-08-17 06:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `gtc_jenis_jasa`
--

CREATE TABLE `gtc_jenis_jasa` (
  `id` int(11) NOT NULL,
  `pilihan_jasa` varchar(250) NOT NULL DEFAULT '0',
  `perhitungan_jasa` varchar(250) NOT NULL DEFAULT '0',
  `jangka_waktu_1` varchar(250) NOT NULL DEFAULT '0',
  `pengali_kurangdari_satudelapan_1` varchar(250) NOT NULL DEFAULT '0',
  `pengali_diatas_dua_1` varchar(250) NOT NULL DEFAULT '0',
  `jangka_waktu_2` varchar(250) NOT NULL DEFAULT '0',
  `pengali_kurangdari_satudelapan_2` varchar(250) NOT NULL DEFAULT '0',
  `pengali_diatas_dua_2` varchar(250) NOT NULL DEFAULT '0',
  `jangka_waktu_3` varchar(250) NOT NULL DEFAULT '0',
  `pengali_kurangdari_satudelapan_3` varchar(250) NOT NULL DEFAULT '0',
  `pengali_diatas_dua_3` varchar(250) NOT NULL DEFAULT '0',
  `jangka_waktu_4` varchar(250) NOT NULL DEFAULT '0',
  `pengali_kurangdari_satudelapan_4` varchar(250) NOT NULL DEFAULT '0',
  `pengali_diatas_dua_4` varchar(250) NOT NULL DEFAULT '0',
  `status` varchar(250) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_jenis_jasa`
--

INSERT INTO `gtc_jenis_jasa` (`id`, `pilihan_jasa`, `perhitungan_jasa`, `jangka_waktu_1`, `pengali_kurangdari_satudelapan_1`, `pengali_diatas_dua_1`, `jangka_waktu_2`, `pengali_kurangdari_satudelapan_2`, `pengali_diatas_dua_2`, `jangka_waktu_3`, `pengali_kurangdari_satudelapan_3`, `pengali_diatas_dua_3`, `jangka_waktu_4`, `pengali_kurangdari_satudelapan_4`, `pengali_diatas_dua_4`, `status`) VALUES
(1, 'Jasa diawal', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'NonAktif'),
(2, 'Jasa diawal', '2', '11', '11', '11', '12', '12', '12', '13', '13', '13', '14', '14', '14', 'NonAktif'),
(3, 'Jasa diawal', '1', '11', '11', '11', '12', '12', '12', '13', '13', '13', '14', '14', '14', 'NonAktif'),
(4, 'Jasa diawal', 'Perhitungan Baru', '0.5', '2.3', '2.5', '1', '2.3', '2.5', '2', '2.3', '2.5', '0', '0', '0', 'NonAktif'),
(5, 'Jasa diakhir', 'Perhitungan Lama', '0.5', '2.3', '2.5', '1', '2.3', '2.5', '2', '2.3', '2.5', '0', '2.3', '2.5', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `gtc_pengajuan`
--

CREATE TABLE `gtc_pengajuan` (
  `id` int(11) NOT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `id_anggota` varchar(250) DEFAULT NULL,
  `id_perwada` varchar(250) DEFAULT NULL,
  `kode_pengajuan` varchar(250) DEFAULT NULL,
  `tujuan` varchar(250) DEFAULT NULL,
  `plafond_pinjaman` varchar(250) DEFAULT NULL,
  `pengajuan` varchar(250) DEFAULT NULL,
  `pilihan_bank` varchar(250) DEFAULT NULL,
  `nomor_rekening` varchar(250) DEFAULT NULL,
  `nama_pemilik_rekening` varchar(250) DEFAULT NULL,
  `kode_transaksi` varchar(250) DEFAULT NULL,
  `aproval_bm` varchar(250) DEFAULT NULL,
  `catatan_bm` varchar(250) DEFAULT NULL,
  `tgl_aproval_bm` datetime DEFAULT NULL,
  `aproval_opr` varchar(250) DEFAULT NULL,
  `catatan_opr` varchar(250) DEFAULT NULL,
  `tgl_aproval_opr` datetime DEFAULT NULL,
  `aproval_keu` varchar(250) DEFAULT NULL,
  `catatan_keu` varchar(250) DEFAULT NULL,
  `tgl_aproval_keu` datetime DEFAULT NULL,
  `status_akhir` varchar(250) DEFAULT NULL,
  `tanggal_jatuh_tempo` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_pengajuan`
--

INSERT INTO `gtc_pengajuan` (`id`, `tanggal_pengajuan`, `id_anggota`, `id_perwada`, `kode_pengajuan`, `tujuan`, `plafond_pinjaman`, `pengajuan`, `pilihan_bank`, `nomor_rekening`, `nama_pemilik_rekening`, `kode_transaksi`, `aproval_bm`, `catatan_bm`, `tgl_aproval_bm`, `aproval_opr`, `catatan_opr`, `tgl_aproval_opr`, `aproval_keu`, `catatan_keu`, `tgl_aproval_keu`, `status_akhir`, `tanggal_jatuh_tempo`, `created_at`, `updated_at`) VALUES
(60, '2022-07-11 16:07:37', '1', '1', 'A.1234567.1', 'Biaya Pendidikan', '4604400', '4604400', 'Bank BRI', '12121212121212', 'pemilik', 'B.1234567.1.1', 'Proses', 'a', '2022-07-11 16:07:37', 'Proses', 'a', '2022-07-11 16:07:37', 'Disetujui', 'a', '2022-07-11 16:07:37', 'Aktif', '2022-07-11 16:07:37', '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(61, '2022-07-19 15:36:53', '1', '2', 'A.1234567.2', 'Biaya Pendidikan', '152730000', '152730000', 'Bank BRI', '234232', 'sdfkjlhas', 'B.1234567.2.1', 'Proses', 'b', '2022-07-19 15:36:53', 'Proses', 'b', '2022-07-19 15:36:53', 'Disetujui', 'b', '2022-07-19 15:36:53', 'Lunas', '2022-07-19 15:36:53', '2022-07-19 08:36:53', '2022-07-19 08:36:53'),
(62, '2022-07-21 09:39:02', '1', '1', 'A.1234567.3', 'Biaya Pendidikan', '63720000', '63720000', 'Bank BNI', '121212121212123', 'pemilik3', 'B.1234567.3.1', 'Proses', 'c', '2022-07-21 09:39:02', 'Proses', 'c', '2022-07-21 09:39:02', 'Disetujui', 'c', '2022-07-21 09:39:02', 'Lunas', '2022-07-21 09:39:02', '2022-07-21 02:39:02', '2022-07-21 02:39:02'),
(64, '2022-08-01 13:17:30', '1', '2', 'A.1234567.4', 'Biaya Pendidikan', '63720000', '63720000', 'Bank BCA', '121212121212123', '222222', 'B.1234567.4.1', 'Proses', 'a', '2022-08-01 13:31:11', 'Proses', 'a', '2022-08-01 13:31:40', 'Disetujui', 'a', '2022-08-01 13:59:10', 'Aktif', '2022-08-16 13:59:10', '2022-08-01 06:17:30', '2022-08-01 06:17:30'),
(65, '2022-08-03 11:18:13', '1', '1', 'A.1234567.5', 'Investasi', '63720000', '63720000', 'Bank BNI', '45356347658', 'sadfesadgsd', 'B.1234567.5.1', 'Proses', 'a', '2022-08-10 17:27:34', 'Proses', 't', '2022-08-03 11:19:35', 'Disetujui', 'y', '2022-08-03 11:23:00', 'Lunas', '2022-09-02 11:23:00', '2022-08-03 04:18:13', '2022-08-03 04:18:13'),
(66, '2022-08-14 18:40:32', '1', '1', 'A.1234567.6', 'Pilih', '454500', '454500', 'Bank BRI', '121212121212123', 'adsfsadfad', 'B.1234567.6.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-14 11:40:32', '2022-08-14 11:40:32'),
(67, '2022-08-14 18:57:06', '1', '1', 'A.1234567.7', 'Biaya Pendidikan', '1728000', '1728000', 'Bank BRI', '234232', 'sdfsdf', 'B.1234567.7.1', 'Proses', 'a', '2022-08-15 18:12:48', 'Proses', 'a', '2022-08-15 18:12:59', 'Disetujui', 'a', '2022-08-15 18:13:10', 'Aktif', '2022-08-30 18:13:10', '2022-08-14 11:57:06', '2022-08-14 11:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `gtc_transaksi`
--

CREATE TABLE `gtc_transaksi` (
  `id` int(11) NOT NULL,
  `kode_pengajuan` varchar(250) NOT NULL DEFAULT '0',
  `kode_transaksi` varchar(250) DEFAULT NULL,
  `jenis_transaksi` varchar(250) DEFAULT NULL,
  `pilihan_jasa` varchar(250) DEFAULT NULL,
  `perhitungan_jasa` varchar(250) DEFAULT NULL,
  `tanggal_sebelumnya` datetime DEFAULT NULL,
  `tanggal_jatuh_tempo` datetime DEFAULT NULL,
  `jangka_waktu_permohonan` varchar(250) DEFAULT NULL,
  `jasa_gtc` varchar(250) DEFAULT NULL,
  `pembayaran_jasa` varchar(250) DEFAULT NULL,
  `upload_bukti_transfer` varchar(250) DEFAULT NULL,
  `jumlah_transfer` varchar(250) DEFAULT NULL,
  `pembayaran_jasa_manual` varchar(250) DEFAULT NULL,
  `ket_simpwa` varchar(250) DEFAULT NULL,
  `nominal_potongan` varchar(250) NOT NULL DEFAULT '0',
  `jumlah_yang_di_transfer` varchar(250) DEFAULT NULL,
  `tipe_transaksi` varchar(250) DEFAULT NULL,
  `upload_foto_gold` varchar(250) DEFAULT NULL,
  `upload_surat_terima_transfer` varchar(250) DEFAULT NULL,
  `upload_form_pengajuan` varchar(250) DEFAULT NULL,
  `surat_kuasa_penjualan_jaminan_marhum` varchar(250) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tanda_tangan` text DEFAULT NULL,
  `sbte` varchar(50) DEFAULT NULL,
  `buktitrf_tgl` varchar(50) DEFAULT NULL,
  `buktitrf_nominal` varchar(50) DEFAULT NULL,
  `buktitrf_upload` text DEFAULT NULL,
  `aproval_opr` varchar(50) DEFAULT NULL,
  `aproval_opr_tgl` varchar(50) DEFAULT NULL,
  `aproval_keu` varchar(50) DEFAULT NULL,
  `aproval_keu_tgl` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `sisa_pembayaran` varchar(50) DEFAULT NULL,
  `catatan2` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_transaksi`
--

INSERT INTO `gtc_transaksi` (`id`, `kode_pengajuan`, `kode_transaksi`, `jenis_transaksi`, `pilihan_jasa`, `perhitungan_jasa`, `tanggal_sebelumnya`, `tanggal_jatuh_tempo`, `jangka_waktu_permohonan`, `jasa_gtc`, `pembayaran_jasa`, `upload_bukti_transfer`, `jumlah_transfer`, `pembayaran_jasa_manual`, `ket_simpwa`, `nominal_potongan`, `jumlah_yang_di_transfer`, `tipe_transaksi`, `upload_foto_gold`, `upload_surat_terima_transfer`, `upload_form_pengajuan`, `surat_kuasa_penjualan_jaminan_marhum`, `catatan`, `tanda_tangan`, `sbte`, `buktitrf_tgl`, `buktitrf_nominal`, `buktitrf_upload`, `aproval_opr`, `aproval_opr_tgl`, `aproval_keu`, `aproval_keu_tgl`, `status`, `sisa_pembayaran`, `catatan2`, `created_at`, `updated_at`) VALUES
(73, 'A.1234567.1', 'B.1234567.1.1', 'Pengajuan Baru', 'Jasa diawal', 'Perhitungan Baru', '2022-08-02 10:38:43', '2022-08-02 10:38:43', '1', '118000', 'Dipotong dari GTC', '1657772234-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '0', '118000', 'Lunas', '0', '4486400', 'Anggota Datang Langsung', '1657530457-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', NULL, '1657530457-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '1657530457-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '118.000', '62cbe859b7b9e.png', '062.13.12000001-04', '12/07/2022', '10.000', '1657609400-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', 'Y', '2022-07-11 13:11:27', 'Y', '2022-08-02 06:00:03', 'Non Aktif', '0', NULL, '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(100, 'A.1234567.1', 'B.1234567.1.2', 'Pelunasan Sebagian', 'Jasa diawal', 'Perhitungan Baru', '2022-08-02 10:38:43', '2022-08-02 10:38:43', '1', '118000', 'Transfer', '1657772234-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '118000', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '062.13.12000002-04', NULL, NULL, NULL, NULL, NULL, 'Y', '2022-08-02 06:00:08', 'Non Aktif', '0', NULL, '2022-07-14 02:44:59', '2022-07-14 04:17:14'),
(101, 'A.1234567.1', 'B.1234567.1.3', 'Pelunasan', 'Jasa diawal', 'Perhitungan Baru', '2022-08-02 10:38:43', '2022-08-02 10:38:43', '0', '0', '', '1657772234-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '062.13.12000003-04', NULL, NULL, NULL, NULL, NULL, 'Y', '2022-08-02 06:00:11', 'Aktif', '0', NULL, '2022-07-14 02:45:22', '2022-07-14 02:56:14'),
(102, 'A.1234567.2', 'B.1234567.2.1', 'Pengajuan Baru', 'Jasa diawal', 'Perhitungan Baru', '2022-08-02 10:38:43', '2022-08-02 10:38:43', '2', '8485000', 'Transfer', '1658219813-screenshot_1.png', '8485000', '', 'Dipotong dari GTC', '8485000', '144245000', 'Online', '1658219813-color.png', '1658219813-color.png', '1658219813-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', '1658219813-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', 'banyak', '62d66d2525de2.png', '062.13.12000004-04', '19/07/2022', '100.000.000', '1658220254-transformers-skin-wallpaper-mobile-legends-(2).jpg', 'Y', '2022-07-19 08:44:38', 'Y', '2022-08-02 06:00:27', 'Non Aktif', '0', NULL, '2022-07-19 08:36:53', '2022-07-19 08:36:53'),
(107, 'A.1234567.3', 'B.1234567.3.1', 'Pengajuan Baru', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-02 10:39:22', '2022-08-02 10:38:43', '2', '6372000', NULL, '1658469273-mlbb_riseofthenecrokeep_project_next.jpg', '6372000', '118000', 'Lunas', '', '57348000', 'Anggota Datang Langsung', '1658371142-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', NULL, '1658371142-screenshot_1.png', '1658371142-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', 'jasa diakhir', '62d8bc46d8e1c.png', '062.13.12000008-04', NULL, NULL, NULL, NULL, NULL, 'Y', '2022-08-02 06:00:59', 'Non Aktif', '0', NULL, '2022-07-21 02:39:02', '2022-07-21 22:54:33'),
(110, 'A.1234567.2', 'B.1234567.2.2', 'Perpanjangan', 'Jasa diawal', 'Perhitungan Baru', '2022-08-02 10:38:43', '2022-08-02 10:38:43', '1', '6788000', 'Transfer', '1658470756-mlbb_riseofthenecrokeep_project_next.jpg', '6788000', '', 'Dipotong dari GTC', '8485000', '144245000', 'Online', '1658219813-color.png', '1658219813-color.png', '1658219813-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', '1658219813-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', 'banyak', '62d66d2525de2.png', '062.13.12000005-04', '19/07/2022', '100.000.000', '1658220254-transformers-skin-wallpaper-mobile-legends-(2).jpg', NULL, NULL, 'Y', '2022-08-02 06:00:34', 'Non Aktif', '0', NULL, '2022-07-22 06:19:16', '2022-07-22 06:19:16'),
(111, 'A.1234567.2', 'B.1234567.2.3', 'Pelunasan Sebagian', 'Jasa diawal', 'Perhitungan Baru', '2022-08-02 10:38:43', '2022-08-02 10:38:43', '1', '6788000', 'Transfer', NULL, '7770000', '', 'Dipotong dari GTC', '8485000', '144245000', 'Online', '1658219813-color.png', '1658219813-color.png', '1658219813-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', '1658219813-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', 'banyak', '62d66d2525de2.png', '062.13.12000006-04', '19/07/2022', '100.000.000', '1658220254-transformers-skin-wallpaper-mobile-legends-(2).jpg', NULL, NULL, 'Y', '2022-08-02 06:00:38', 'Non Aktif', '0', NULL, '2022-07-22 06:21:05', '2022-07-22 06:21:05'),
(112, 'A.1234567.2', 'B.1234567.2.4', 'Pelunasan', 'Jasa diawal', 'Perhitungan Baru', '2022-08-02 10:38:43', '2022-08-02 10:38:43', '0', '0', 'Transfer', NULL, '0', '', 'Dipotong dari GTC', '8485000', '144245000', 'Online', '1658219813-color.png', '1658219813-color.png', '1658219813-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', '1658219813-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', 'banyak', '62d66d2525de2.png', '062.13.12000007-04', '19/07/2022', '100.000.000', '1658220254-transformers-skin-wallpaper-mobile-legends-(2).jpg', NULL, NULL, 'Y', '2022-08-02 06:00:43', 'Aktif', '0', NULL, '2022-07-22 06:21:44', '2022-07-22 06:21:44'),
(113, 'A.1234567.3', 'B.1234567.3.2', 'Pelunasan Sebagian', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-02 10:38:43', '2022-07-21 09:39:02', '1', '2832000', 'Transfer', '1658813899-photo-1628260412297-a3377e45006f.jpeg', '2832000', '118000', 'Lunas', '', '57348000', 'Anggota Datang Langsung', '1658371142-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', NULL, '1658371142-screenshot_1.png', '1658371142-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', 'jasa diakhir', '62d8bc46d8e1c.png', '062.13.12000009-04', NULL, NULL, NULL, NULL, NULL, 'Y', '2022-08-02 06:01:04', 'Non Aktif', '0', NULL, '2022-07-26 05:38:19', '2022-07-26 05:38:19'),
(114, 'A.1234567.3', 'B.1234567.3.3', 'Perpanjangan', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-02 10:38:44', '2022-07-21 09:39:02', '2', '3186000', 'Transfer', '1658813967-photo-1628260412297-a3377e45006f.jpeg', '3186000', '118000', 'Lunas', '', '57348000', 'Anggota Datang Langsung', '1658371142-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', NULL, '1658371142-screenshot_1.png', '1658371142-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', 'jasa diakhir', '62d8bc46d8e1c.png', '062.13.12000010-04', NULL, NULL, NULL, NULL, NULL, 'Y', '2022-08-02 06:01:07', 'Non Aktif', '0', NULL, '2022-07-26 05:39:27', '2022-07-26 05:39:27'),
(125, 'A.1234567.3', 'B.1234567.3.4', 'Pelunasan', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-02 10:38:44', '2022-07-21 09:39:02', '0', '0', 'Transfer', NULL, '0', '118000', 'Lunas', '', '57348000', 'Anggota Datang Langsung', '1658371142-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', NULL, '1658371142-screenshot_1.png', '1658371142-mlbb_riseofthenecrokeep_vexana_faramis_leomord.jpg', 'jasa diakhir', '62d8bc46d8e1c.png', '062.13.12000011-04', NULL, NULL, NULL, NULL, NULL, 'Y', '2022-08-02 06:02:48', 'Aktif', '0', NULL, '2022-07-27 04:03:20', '2022-07-27 04:03:20'),
(127, 'A.1234567.4', 'B.1234567.4.1', 'Pengajuan Baru', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-16 13:59:10', '2022-08-16 13:59:10', '0.5', '708000', 'Transfer', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '708000', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000012-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', 'Y', '2022-08-02 03:38:07', 'Y', '2022-08-02 06:03:11', 'Non Aktif', '0', NULL, '2022-08-01 06:17:30', '2022-08-01 06:17:30'),
(129, 'A.1234567.4', 'B.1234567.4.2', 'Perpanjangan', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-16 13:59:10', '2022-08-31 13:59:10', '0.5', '708000', 'Transfer', NULL, '708000', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000013-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-02 06:03:16', 'Non Aktif', '0', NULL, '2022-08-02 03:49:54', '2022-08-02 04:00:16'),
(130, 'A.1234567.4', 'B.1234567.4.3', 'Pelunasan Sebagian', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-31 13:59:10', '2022-09-30 13:59:10', '1', '2832000', 'Transfer', '1659412431-photo-1628260412297-a3377e45006f.jpeg', '2832000', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000014-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-02 06:03:21', 'Non Aktif', '0', NULL, '2022-08-02 03:53:51', '2022-08-02 03:53:51'),
(131, 'A.1234567.5', 'B.1234567.5.1', 'Pengajuan Baru', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-03 11:23:00', '2022-09-02 11:23:00', '1', '2832000', 'Transfer', '1659500293-photo-1628260412297-a3377e45006f.jpeg', '2832000', '', 'Lunas', '', '63720000', 'Anggota Datang Langsung', '1659500293-photo-1628260412297-a3377e45006f.jpeg', NULL, '1659500293-photo-1628260412297-a3377e45006f.jpeg', '1659500293-photo-1628260412297-a3377e45006f.jpeg', 'gfjhghjhgk', '62e9f7055af84.png', '062.13.12000015-04', '03/08/2022', '20.000', '1659500621-photo-1628260412297-a3377e45006f.jpeg', 'Y', '2022-08-03 04:23:46', 'Y', '2022-08-03 04:23:51', 'Non Aktif', '0', NULL, '2022-08-03 04:18:13', '2022-08-03 04:18:13'),
(132, 'A.1234567.5', 'B.1234567.5.2', 'Perpanjangan', 'Jasa diakhir', 'Perhitungan Lama', '2022-09-02 11:23:00', '2022-10-02 11:23:00', '1', '2832000', 'Transfer', NULL, '2832100', '', 'Lunas', '', '63720000', 'Anggota Datang Langsung', '1659500293-photo-1628260412297-a3377e45006f.jpeg', NULL, '1659500293-photo-1628260412297-a3377e45006f.jpeg', '1659500293-photo-1628260412297-a3377e45006f.jpeg', 'gfjhghjhgk', '62e9f7055af84.png', '062.13.12000016-04', '03/08/2022', '20.000', '1659500621-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-03 04:31:24', 'Non Aktif', '0', NULL, '2022-08-03 04:27:10', '2022-08-03 04:31:11'),
(133, 'A.1234567.5', 'B.1234567.5.3', 'Pelunasan Sebagian', 'Jasa diakhir', 'Perhitungan Lama', '2022-10-02 11:23:00', '2022-11-01 11:23:00', '1', '2832000', 'Transfer', '1659501209-photo-1628260412297-a3377e45006f.jpeg', '2832000', '', 'Lunas', '', '63720000', 'Anggota Datang Langsung', '1659500293-photo-1628260412297-a3377e45006f.jpeg', NULL, '1659500293-photo-1628260412297-a3377e45006f.jpeg', '1659500293-photo-1628260412297-a3377e45006f.jpeg', 'gfjhghjhgk', '62e9f7055af84.png', '062.13.12000017-04', '03/08/2022', '20.000', '1659500621-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-03 04:33:44', 'Non Aktif', '0', NULL, '2022-08-03 04:33:29', '2022-08-03 04:33:29'),
(134, 'A.1234567.5', 'B.1234567.5.4', 'Perpanjangan', 'Jasa diakhir', 'Perhitungan Lama', '2022-11-01 11:23:00', '2022-11-16 11:23:00', '0.5', '532000', 'Transfer', '1659503134-photo-1628260412297-a3377e45006f.jpeg', '532000', '', 'Lunas', '', '63720000', 'Anggota Datang Langsung', '1659500293-photo-1628260412297-a3377e45006f.jpeg', NULL, '1659500293-photo-1628260412297-a3377e45006f.jpeg', '1659500293-photo-1628260412297-a3377e45006f.jpeg', 'gfjhghjhgk', '62e9f7055af84.png', '062.13.12000018-04', '03/08/2022', '20.000', '1659500621-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-03 05:05:45', 'Non Aktif', '0', NULL, '2022-08-03 05:05:34', '2022-08-03 05:05:34'),
(135, 'A.1234567.5', 'B.1234567.5.5', 'Pelunasan Sebagian', 'Jasa diakhir', 'Perhitungan Lama', '2022-11-16 11:23:00', '2022-12-01 11:23:00', '0.5', '532000', 'Transfer', '1659504887-photo-1628260412297-a3377e45006f.jpeg', '532000', '', 'Lunas', '', '63720000', 'Anggota Datang Langsung', '1659500293-photo-1628260412297-a3377e45006f.jpeg', NULL, '1659500293-photo-1628260412297-a3377e45006f.jpeg', '1659500293-photo-1628260412297-a3377e45006f.jpeg', 'gfjhghjhgk', '62e9f7055af84.png', '062.13.12000019-04', '03/08/2022', '20.000', '1659500621-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-03 05:34:56', 'Non Aktif', '0', NULL, '2022-08-03 05:34:47', '2022-08-03 05:34:47'),
(136, 'A.1234567.5', 'B.1234567.5.6', 'Pelunasan', 'Jasa diakhir', 'Perhitungan Lama', '2022-12-01 11:23:00', '2022-08-03 12:41:27', '0', '0', 'Transfer', NULL, '0', '', 'Lunas', '', '63720000', 'Anggota Datang Langsung', '1659500293-photo-1628260412297-a3377e45006f.jpeg', NULL, '1659500293-photo-1628260412297-a3377e45006f.jpeg', '1659500293-photo-1628260412297-a3377e45006f.jpeg', 'gfjhghjhgk', '62e9f7055af84.png', '062.13.12000020-04', '03/08/2022', '20.000', '1659500621-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-03 05:42:05', 'Aktif', '0', NULL, '2022-08-03 05:41:27', '2022-08-03 05:41:27'),
(137, 'A.1234567.4', 'B.1234567.4.4', 'Pelunasan Sebagian', 'Jasa diakhir', 'Perhitungan Lama', '2022-09-30 13:59:10', '2022-10-15 13:59:10', '0.5', '354000', 'Transfer', '1659589891-514-5147412_default-avatar-icon.png', '354000', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000021-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-11 03:39:41', 'Non Aktif', '0', NULL, '2022-08-04 05:11:31', '2022-08-04 05:11:31'),
(138, 'A.1234567.4', 'B.1234567.4.5', 'Perpanjangan', 'Jasa diakhir', 'Perhitungan Lama', '2022-10-15 13:59:10', '2022-10-30 13:59:10', '0.5', '284000', 'Transfer', '1659944642-514-5147412_default-avatar-icon.png', '284000', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000022-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-12 09:10:47', 'Non Aktif', '0', NULL, '2022-08-08 07:44:02', '2022-08-08 07:44:02'),
(139, 'A.1234567.4', 'B.1234567.4.6', 'Perpanjangan', 'Jasa diakhir', 'Perhitungan Lama', '2022-10-30 13:59:10', '2022-11-29 13:59:10', '1', '652000', 'Transfer', NULL, '652100', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000023-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-12 09:10:52', 'Non Aktif', '100', 'lebih wkkw', '2022-08-12 06:44:47', '2022-08-12 06:44:47'),
(140, 'A.1234567.4', 'B.1234567.4.7', 'Perpanjangan', 'Jasa diakhir', 'Perhitungan Lama', '2022-11-29 13:59:10', '2022-12-29 13:59:10', '1', '652000', 'Transfer', NULL, '652020', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000024-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-12 09:10:55', 'Non Aktif', '20', 'test', '2022-08-12 06:45:58', '2022-08-12 06:45:58'),
(141, 'A.1234567.4', 'B.1234567.4.8', 'Perpanjangan', 'Jasa diakhir', 'Perhitungan Lama', '2022-12-29 13:59:10', '2022-12-29 13:59:10', '0', '0', 'Transfer', NULL, '100100', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000026-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-12 09:13:49', 'Non Aktif', '100100', 'test2', '2022-08-12 06:50:37', '2022-08-12 07:20:59'),
(142, 'A.1234567.6', 'B.1234567.6.1', 'Pengajuan Baru', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-14 18:46:54', '2022-08-14 18:46:58', '1', '12000', 'Dipotong dari GTC', NULL, '', '12000', 'Lunas', '', '442500', 'Anggota Datang Langsung', '1660477232-514-5147412_default-avatar-icon.png', NULL, '1660477232-514-5147412_default-avatar-icon.png', '1660477232-514-5147412_default-avatar-icon.png', 'sdf', '62f8df301b5e2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Aktif', NULL, NULL, '2022-08-14 11:40:32', '2022-08-14 11:40:32'),
(143, 'A.1234567.7', 'B.1234567.7.1', 'Pengajuan Baru', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-15 18:13:10', '2022-08-30 18:13:10', '0.5', '23000', 'Transfer', '1660478226-514-5147412_default-avatar-icon.png', '23000', '', 'Dipotong dari GTC', '23000', '1705000', 'Anggota Datang Langsung', '1660478226-514-5147412_default-avatar-icon.png', NULL, '1660478226-514-5147412_default-avatar-icon.png', '1660478226-514-5147412_default-avatar-icon.png', 'aaaa', '62f8e31206539.png', '062.13.12000027-04', NULL, NULL, NULL, NULL, NULL, 'Y', '2022-08-15 11:13:36', 'Non Aktif', NULL, NULL, '2022-08-14 11:57:06', '2022-08-14 11:57:06'),
(144, 'A.1234567.7', 'B.1234567.7.2', 'Pelunasan Sebagian', 'Jasa diakhir', 'Perhitungan Lama', '2022-08-30 18:13:10', '2022-09-14 18:13:10', '0.5', '17000', 'Transfer', '1660562061-514-5147412_default-avatar-icon.png', '17000', '', 'Dipotong dari GTC', '23000', '1705000', 'Anggota Datang Langsung', '1660478226-514-5147412_default-avatar-icon.png', NULL, '1660478226-514-5147412_default-avatar-icon.png', '1660478226-514-5147412_default-avatar-icon.png', 'aaaa', '62f8e31206539.png', '062.13.12000028-04', NULL, NULL, NULL, NULL, NULL, 'Y', '2022-08-16 08:12:49', 'Aktif', '0', 'test', '2022-08-15 11:14:21', '2022-08-15 11:14:21'),
(145, 'A.1234567.4', 'B.1234567.4.9', 'Pelunasan Sebagian', 'Jasa diakhir', 'Perhitungan Lama', '2022-12-29 13:59:10', '2022-12-29 13:59:10', '0', '0', 'Transfer', '1660717101-514-5147412_default-avatar-icon.png', '0', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '062.13.12000029-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-17 06:18:56', 'Non Aktif', '0', 'test', '2022-08-17 06:18:21', '2022-08-17 06:18:21'),
(146, 'A.1234567.4', 'B.1234567.4.10', 'Pelunasan Sebagian', 'Jasa diakhir', 'Perhitungan Lama', '2022-12-29 13:59:10', '2022-12-29 13:59:10', '0', '0', 'Transfer', '1660717901-514-5147412_default-avatar-icon.png', '0', '', 'Dipotong dari GTC', '708000', '63012000', 'Online', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', '1659334650-photo-1628260412297-a3377e45006f.jpeg', 'assa', '62e76ffa518d5.png', '002.13.12000030-04', '02/08/2022', '10.000', '1659411474-photo-1628260412297-a3377e45006f.jpeg', NULL, NULL, 'Y', '2022-08-17 06:37:40', 'Aktif', '0', 'test', '2022-08-17 06:31:41', '2022-08-17 06:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `item_emas_syirkah`
--

CREATE TABLE `item_emas_syirkah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gramasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_emas_syirkah`
--

INSERT INTO `item_emas_syirkah` (`id`, `nama`, `jenis`, `gramasi`, `status`) VALUES
(1, 'EOA Gold 1', 'Reguler', '1', 0),
(2, 'EOA Gold 0.5', 'Reguler', '0.5', 0),
(4, 'EOA Gold 0.1', 'Series If', '0.1', 0),
(5, 'EOA Gold 0.1', 'Reguler', '0.1', 0),
(6, 'EOA Gold 0.2', 'reguler', '0.2', 0),
(7, 'EOA Gold 2', 'reguler', '2', 0),
(8, 'EOA Gold 5', 'reguler', '5', 0),
(9, 'EOA Gold 10', 'reguler', '10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 2),
(1, 'App\\User', 24),
(2, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(2, 'App\\User', 5),
(2, 'App\\User', 6),
(2, 'App\\User', 9),
(2, 'App\\User', 10),
(2, 'App\\User', 11),
(2, 'App\\User', 12),
(2, 'App\\User', 13),
(2, 'App\\User', 14),
(2, 'App\\User', 19),
(2, 'App\\User', 20),
(2, 'App\\User', 21),
(2, 'App\\User', 22),
(2, 'App\\User', 23);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view-users', 'web', NULL, NULL),
(2, 'create-users', 'web', NULL, NULL),
(3, 'edit-users', 'web', NULL, NULL),
(4, 'delete-users', 'web', NULL, NULL),
(5, 'view-roles', 'web', NULL, NULL),
(6, 'create-roles', 'web', NULL, NULL),
(7, 'edit-roles', 'web', NULL, NULL),
(8, 'delete-roles', 'web', NULL, NULL),
(9, 'setting-web', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `perwada`
--

CREATE TABLE `perwada` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Hold','Non Aktif') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perwada`
--

INSERT INTO `perwada` (`id`, `kode`, `nama`, `wilayah`, `status`) VALUES
(1, '002', 'KP Nganjuk', 'Nganjuk', 'Aktif'),
(2, '001', 'KP Ngawi', 'Ngawi', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', NULL, NULL),
(2, 'admin perwada', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kantor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `email_verified_at`, `jabatan`, `kantor`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', 'administrator@gmail.com', NULL, 'Superadmin', '1', '$2y$10$Gvmyjjo9k93cbMfMr3lZAO34mQu3WW6ngfHccvRdVZwm79CO6trei', '1', 0, 'ghclVM2rNRf2trZEGmvALE7VLGqjQ1QCBPztNTlnx2sPSo7gCKz31HOhFWSj', '2022-08-04 02:38:29', '2022-08-12 00:03:27'),
(2, 'test4', 'test4', 'anggota@test.com', NULL, 'test4', '2', '$2y$10$YB2GEDQo40FyzAtUx/rYtu8809lKEHlmkGBtMpcgDEVY6clDwgtNC', '2', 0, 'b6xvxvGumbcCIyCk8sQSzmLRZvT45OEVsCx7dZL27ve2g6jtzhRcUKhHIegW', '2022-05-16 16:48:58', '2022-08-05 00:29:21'),
(3, 'test3', 'test3', 'administrator1@test.com', NULL, 'test3', '2', '$2y$10$tPcV33tmca.Fu1Vh/BVIg.FCIflC37mXgxjCzrG30MMOjz3cfYP5W', '2', 0, NULL, '2022-05-16 16:48:58', '2022-08-12 00:02:29'),
(24, 'test', 'test', 'test@gmail.com', NULL, 'test', '2', '$2y$10$t7T68s7yPO8SxEcqsHPTUuAnGBmLbqloa5RY4B7ma9WROYGtaI2ka', '2', 1, 'M4ZPZxCAEo5R57jWpGZgOyzaVnIxFWGwMEjxo8VgY7tfl2qpNigXraKn5Hin', '2022-08-04 23:46:59', '2022-08-05 00:31:04'),
(25, 'test2', 'test2', 'test2@gmail.com', NULL, 'test2', '1', '$2y$10$25Sifgu2zcP1.LOJwYXhK.NteZRkqywIpkmMnSXSOb3qfB5Z1MdbW', '1', 0, NULL, '2022-08-04 23:49:26', '2022-08-04 23:49:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_user_id_foreign` (`user_id`);

--
-- Indexes for table `gtc_emas`
--
ALTER TABLE `gtc_emas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtc_harga_harian`
--
ALTER TABLE `gtc_harga_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtc_histori_anggota`
--
ALTER TABLE `gtc_histori_anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtc_histori_pengajuan`
--
ALTER TABLE `gtc_histori_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtc_histori_transaksi`
--
ALTER TABLE `gtc_histori_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtc_jenis_jasa`
--
ALTER TABLE `gtc_jenis_jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtc_pengajuan`
--
ALTER TABLE `gtc_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtc_transaksi`
--
ALTER TABLE `gtc_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_emas_syirkah`
--
ALTER TABLE `item_emas_syirkah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `perwada`
--
ALTER TABLE `perwada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gtc_emas`
--
ALTER TABLE `gtc_emas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `gtc_harga_harian`
--
ALTER TABLE `gtc_harga_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gtc_histori_anggota`
--
ALTER TABLE `gtc_histori_anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gtc_histori_pengajuan`
--
ALTER TABLE `gtc_histori_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gtc_histori_transaksi`
--
ALTER TABLE `gtc_histori_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT for table `gtc_jenis_jasa`
--
ALTER TABLE `gtc_jenis_jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gtc_pengajuan`
--
ALTER TABLE `gtc_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `gtc_transaksi`
--
ALTER TABLE `gtc_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `item_emas_syirkah`
--
ALTER TABLE `item_emas_syirkah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `perwada`
--
ALTER TABLE `perwada`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `FK_model_has_permissions_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `FK_role_has_permissions_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_role_has_permissions_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
