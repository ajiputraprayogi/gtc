-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 02:46 PM
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
(1, 1, 'xVfOSypOs9', 'mentorbaik2', 'administrator1@test.com', 'Karyawan', 'Pusat', 1, '2022-05-16 16:48:58', '2022-05-16 16:48:58');

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
(1, 2, '0.123.1234567', '2vpVYUEYGr', '082131231', 'anggota@test.com', 1, 6555555555555552, 'Laki-laki', 'jhgjghj2', '2022-06-06', 'Sudah Nikah', 2, 'alamat domisili', '3571030001,Blabak', '3571030,Pesantren', '3571,Kota Kediri', '35,Jawa Timur', 'tidakSesuai', 'alamat domisili', '3571030001,Blabak', '3571030,Pesantren', '3571,Kota Kediri', '35,Jawa Timur', 'oicndi20_poster_breakouts_1.png', 'F:\\Projek 2022\\SI_Pinjam\\si_pinjam\\public/images/data_penting/ktp\\oicndi20_poster_breakouts_1.png', '2022-05-16 16:48:58', '2022-06-24 06:51:30');

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
(184, 'A.1234567.1', '2', NULL, 'EOA Gold 0.5', 'Reguler', '0.5', '7', '480000', '2022-07-11 02:06:57', '2022-07-11 09:07:37');

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
  `pembayaran_pinjaman` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_histori_transaksi`
--

INSERT INTO `gtc_histori_transaksi` (`id`, `kode_pengajuan`, `kode_transaksi`, `id_emas`, `keping`, `pembayaran_pinjaman`, `created_at`, `updated_at`) VALUES
(92, 'A.1234567.1', 'B.1234567.1.1', '182', '0', NULL, '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(93, 'A.1234567.1', 'B.1234567.1.1', '183', '0', NULL, '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(94, 'A.1234567.1', 'B.1234567.1.1', '184', '0', NULL, '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(167, 'A.1234567.1', 'B.1234567.1.2', '182', '1', '3000000', '2022-07-14 02:44:59', '2022-07-14 04:17:14'),
(168, 'A.1234567.1', 'B.1234567.1.2', '183', '1', '3000000', '2022-07-14 02:44:59', '2022-07-14 04:17:14'),
(169, 'A.1234567.1', 'B.1234567.1.2', '184', '1', '3000000', '2022-07-14 02:44:59', '2022-07-14 04:17:14'),
(170, 'A.1234567.1', 'B.1234567.1.3', '182', '4', '1604400', '2022-07-14 02:45:22', '2022-07-14 02:56:14'),
(171, 'A.1234567.1', 'B.1234567.1.3', '183', '5', '1604400', '2022-07-14 02:45:22', '2022-07-14 02:56:14'),
(172, 'A.1234567.1', 'B.1234567.1.3', '184', '6', '1604400', '2022-07-14 02:45:22', '2022-07-14 02:56:14');

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
(4, 'Jasa diawal', 'Perhitungan Baru', '0.5', '2.3', '2.5', '1', '2.3', '2.5', '2', '2.3', '2.5', '0', '0', '0', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `gtc_pengajuan`
--

CREATE TABLE `gtc_pengajuan` (
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
  `aproval_bm` varchar(250) DEFAULT NULL,
  `catatan_bm` varchar(250) DEFAULT NULL,
  `tgl_aproval_bm` varchar(250) DEFAULT NULL,
  `aproval_opr` varchar(250) DEFAULT NULL,
  `catatan_opr` varchar(250) DEFAULT NULL,
  `tgl_aproval_opr` varchar(250) DEFAULT NULL,
  `aproval_keu` varchar(250) DEFAULT NULL,
  `catatan_keu` varchar(250) DEFAULT NULL,
  `tgl_aproval_keu` varchar(250) DEFAULT NULL,
  `status_akhir` varchar(250) DEFAULT NULL,
  `tanggal_jatuh_tempo` varchar(250) DEFAULT NULL,
  `nomor_sbte` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_pengajuan`
--

INSERT INTO `gtc_pengajuan` (`id`, `tanggal_pengajuan`, `id_anggota`, `id_perwada`, `kode_pengajuan`, `tujuan`, `plafond_pinjaman`, `pengajuan`, `pilihan_bank`, `nomor_rekening`, `nama_pemilik_rekening`, `kode_transaksi`, `aproval_bm`, `catatan_bm`, `tgl_aproval_bm`, `aproval_opr`, `catatan_opr`, `tgl_aproval_opr`, `aproval_keu`, `catatan_keu`, `tgl_aproval_keu`, `status_akhir`, `tanggal_jatuh_tempo`, `nomor_sbte`, `created_at`, `updated_at`) VALUES
(60, '11 Juli 2022 16:07', '1', '1', 'A.1234567.1', 'Biaya Pendidikan', '4604400', '4604400', 'Bank BRI', '12121212121212', 'pemilik', 'B.1234567.1.1', 'Proses', 'a', '11 Juli 2022 16:08', 'Proses', 'a', '11 Juli 2022 16:08', 'Disetujui', 'a', '11 Juli 2022 16:08', 'Aktif', NULL, NULL, '2022-07-11 09:07:37', '2022-07-11 09:07:37');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtc_transaksi`
--

INSERT INTO `gtc_transaksi` (`id`, `kode_pengajuan`, `kode_transaksi`, `jenis_transaksi`, `pilihan_jasa`, `perhitungan_jasa`, `jangka_waktu_permohonan`, `jasa_gtc`, `pembayaran_jasa`, `upload_bukti_transfer`, `jumlah_transfer`, `pembayaran_jasa_manual`, `ket_simpwa`, `nominal_potongan`, `jumlah_yang_di_transfer`, `tipe_transaksi`, `upload_foto_gold`, `upload_surat_terima_transfer`, `upload_form_pengajuan`, `surat_kuasa_penjualan_jaminan_marhum`, `catatan`, `tanda_tangan`, `sbte`, `buktitrf_tgl`, `buktitrf_nominal`, `buktitrf_upload`, `aproval_opr`, `aproval_opr_tgl`, `aproval_keu`, `aproval_keu_tgl`, `status`, `created_at`, `updated_at`) VALUES
(73, 'A.1234567.1', 'B.1234567.1.1', 'Pengajuan Baru', 'Jasa diawal', 'Perhitungan Baru', '1', '118000', 'Dipotong dari GTC', '1657772234-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '0', '118000', 'Lunas', '0', '4486400', 'Anggota Datang Langsung', '1657530457-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', NULL, '1657530457-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '1657530457-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '118.000', '62cbe859b7b9e.png', '062.13.12000001-04', '12/07/2022', '10.000', '1657609400-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', 'Y', '2022-07-11 13:11:27', 'Y', '2022-07-11 13:11:33', NULL, '2022-07-11 09:07:37', '2022-07-11 09:07:37'),
(100, 'A.1234567.1', 'B.1234567.1.2', 'Pelunasan Sebagian', 'Jasa diawal', 'Perhitungan Baru', '1', '118000', 'Transfer', '1657772234-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '118000', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 02:44:59', '2022-07-14 04:17:14'),
(101, 'A.1234567.1', 'B.1234567.1.3', 'Pelunasan', 'Jasa diawal', 'Perhitungan Baru', '0', '0', '', '1657772234-mobile_legends_fanny_skylark_transparent_4k_png_by_divoras_deevq28-fullview.png', '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 02:45:22', '2022-07-14 02:56:14');

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
(1, '001', 'KP Ngawi', 'Ngawi', 'Aktif'),
(2, '002', 'KP Nganjuk', 'Nganjuk', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'xVfOSypOs9', 'administrator1@test.com', NULL, '$2y$10$DVolQMJj6pVpW.MC.gdehu7Blk1YDOngrPibv4wL.FWWUeIJpNWhi', 'Administrator', 1, NULL, '2022-05-16 16:48:58', '2022-05-16 16:48:58'),
(2, '2vpVYUEYGr', 'anggota@test.com', NULL, '$2y$10$YB2GEDQo40FyzAtUx/rYtu8809lKEHlmkGBtMpcgDEVY6clDwgtNC', 'User', 1, 'b6xvxvGumbcCIyCk8sQSzmLRZvT45OEVsCx7dZL27ve2g6jtzhRcUKhHIegW', '2022-05-16 16:48:58', '2022-05-16 16:48:58');

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
-- Indexes for table `perwada`
--
ALTER TABLE `perwada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gtc_emas`
--
ALTER TABLE `gtc_emas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `gtc_jenis_jasa`
--
ALTER TABLE `gtc_jenis_jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gtc_pengajuan`
--
ALTER TABLE `gtc_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `gtc_transaksi`
--
ALTER TABLE `gtc_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `item_emas_syirkah`
--
ALTER TABLE `item_emas_syirkah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `perwada`
--
ALTER TABLE `perwada`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
