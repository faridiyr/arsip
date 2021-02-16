-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2021 at 03:49 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_minangkabau`
--

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `isi_singkat` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `nomor`, `tanggal`, `tujuan`, `isi_singkat`, `file`) VALUES
(4, '01/WN/MK-2021', '2021-01-11', 'BPRN, Ka Jor, Masyarakat', 'Undangan rapat lelang minang', 'surat_keluar_03-02-2021_09-30-17.pdf'),
(5, '421/05/SM-2021', '2021-02-17', 'BPRN', 'tesss', 'surat_keluar_05-02-2021_11-03-10.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_ahli_waris`
--

CREATE TABLE `surat_keterangan_ahli_waris` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(250) NOT NULL,
  `ahli_waris` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keterangan_ahli_waris`
--

INSERT INTO `surat_keterangan_ahli_waris` (`id`, `nomor`, `tanggal`, `nama`, `ahli_waris`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `file`) VALUES
(3, '12/KET/MK-2020', '2020-11-30', 'Kasma L Saty', 'Khairul', 'Minangkabau', '1949-02-09', 'Badinah Murni', 'surat_keterangan_ahli_waris_03-02-2021_10-06-24.pdf'),
(4, '13/KET/MK-2020', '2020-12-11', 'Rafdi', 'Rosmiati', 'Minangkabau', '1959-11-05', 'Minang Jaya', 'surat_keterangan_ahli_waris_03-02-2021_10-39-11.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_catatan_kepolisian`
--

CREATE TABLE `surat_keterangan_catatan_kepolisian` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `suku` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keterangan_catatan_kepolisian`
--

INSERT INTO `surat_keterangan_catatan_kepolisian` (`id`, `nomor`, `tanggal`, `nama`, `tempat_lahir`, `tanggal_lahir`, `suku`, `pekerjaan`, `alamat`, `keterangan`, `file`) VALUES
(4, '331/01/SKCK-2021', '2021-01-04', 'Beni Ahmad Firdaus', 'Kutianyir', '1998-06-28', 'Kutianyir', 'Pelajar', 'Badinah Murni', 'Mengambil Lisensi Sepak Bola', 'surat_keterangan_catatan_kepolisian_03-02-2021_09-58-43.pdf'),
(5, '331/02/SKCK-2021', '2021-01-27', 'Imran Jumaidil', 'Batusangkar', '2001-07-26', 'Piliang', 'Ex Pelajar', 'Minang Jaya', 'Melamar Pekerjaan', 'surat_keterangan_catatan_kepolisian_03-02-2021_10-33-56.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_izin_kayu`
--

CREATE TABLE `surat_keterangan_izin_kayu` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `suku` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keterangan_izin_kayu`
--

INSERT INTO `surat_keterangan_izin_kayu` (`id`, `nomor`, `tanggal`, `nama`, `suku`, `jumlah`, `pekerjaan`, `alamat`, `keterangan`, `file`) VALUES
(3, '13/SIPK/MK-2020', '2020-11-12', 'Surya Arianto', 'Piliang', '2 kubik kayu durian', 'wiraswasta', 'Minang Jaya', 'Izin membawa kayu', 'surat_keterangan_izin_kayu_03-02-2021_10-01-35.pdf'),
(4, '12/SIPK?MK-2020', '2021-01-27', 'Rikky', 'Kutianyir', '5 batang', 'wiraswasta', 'minang jaya', 'izin menebang kayu', 'surat_keterangan_izin_kayu_05-02-2021_11-19-22.docx');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_kematian`
--

CREATE TABLE `surat_keterangan_kematian` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `umur` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `suku` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keterangan_kematian`
--

INSERT INTO `surat_keterangan_kematian` (`id`, `nomor`, `tanggal`, `nama`, `jenis_kelamin`, `umur`, `nik`, `suku`, `alamat`, `nama_ibu`, `nama_ayah`, `keterangan`, `file`) VALUES
(8, '472/02/SKK/MK-2021', '2021-01-18', 'Muchlis', 'Laki-laki', 78, '1304071208420001', 'Simabur', 'Kelarasan Tanjung', '-', '-', '-', 'surat_keterangan_kematian_03-02-2021_10-09-41.pdf'),
(9, '472/03/SKK/MK-2021', '2021-01-27', 'Nurlian', 'Perempuan', 90, '0000000000000000', 'Kutianyir', 'Badinah Murni', '-', '-', '-', 'surat_keterangan_kematian_03-02-2021_10-41-52.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_lainnya`
--

CREATE TABLE `surat_keterangan_lainnya` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `suku` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keterangan_lainnya`
--

INSERT INTO `surat_keterangan_lainnya` (`id`, `nomor`, `tanggal`, `nama`, `suku`, `pekerjaan`, `alamat`, `keterangan`, `file`) VALUES
(3, '15/KET/MK-2021', '2021-01-26', 'Muthia Elvina Sari', '-', 'Mahasiswa', 'Minang Jaya', 'Surat Keterangan Penghasilan', 'surat_keterangan_lainnya_03-02-2021_09-40-59.pdf'),
(4, '14/KET/MK-2021', '2021-01-25', 'Ainil Fitri', 'Mandahiling', 'Pelajar/ Mahasiswa', 'Badinah Murni', 'Surat keterangan belum pernah menikah', 'surat_keterangan_lainnya_03-02-2021_10-46-29.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_nikah`
--

CREATE TABLE `surat_keterangan_nikah` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_suami` varchar(50) NOT NULL,
  `nama_istri` varchar(50) NOT NULL,
  `tempat_lahir_suami` varchar(50) NOT NULL,
  `tanggal_lahir_suami` date NOT NULL,
  `suku_suami` varchar(50) NOT NULL,
  `pekerjaan_suami` varchar(50) NOT NULL,
  `nama_ortu_suami` varchar(50) NOT NULL,
  `alamat_suami` varchar(50) NOT NULL,
  `tempat_lahir_istri` varchar(50) NOT NULL,
  `tanggal_lahir_istri` date NOT NULL,
  `suku_istri` varchar(50) NOT NULL,
  `pekerjaan_istri` varchar(50) NOT NULL,
  `nama_ortu_istri` varchar(50) NOT NULL,
  `alamat_istri` varchar(50) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keterangan_nikah`
--

INSERT INTO `surat_keterangan_nikah` (`id`, `nomor`, `tanggal`, `nama_suami`, `nama_istri`, `tempat_lahir_suami`, `tanggal_lahir_suami`, `suku_suami`, `pekerjaan_suami`, `nama_ortu_suami`, `alamat_suami`, `tempat_lahir_istri`, `tanggal_lahir_istri`, `suku_istri`, `pekerjaan_istri`, `nama_ortu_istri`, `alamat_istri`, `file`) VALUES
(3, '02/NA/MK-2021', '2021-01-05', 'Ego Saputra', 'Rahma Agatha Fatriza', 'Lariang', '1993-01-11', 'Caniago', 'Pedagang', 'Darlis, Mariana', 'Palupuh', 'Padang', '1996-08-08', 'Melayu', 'Pedagang', '... (alm), Fatmawati', 'Badinah Murni', 'surat_keterangan_nikah_03-02-2021_09-53-16.pdf'),
(4, '03/NA/MK-2021', '2021-01-21', 'Firma Grata Yuda', 'Suci Rahmadani', 'Minangkabau', '1995-04-02', 'Melayu', 'Wiraswasta', 'Rusli, Asmawati', 'Minang Jaya', 'Medan', '1998-01-03', 'Koto', 'Wiraswasta', 'Syafrialdi, Syamsiar', 'Medan', 'surat_keterangan_nikah_03-02-2021_10-24-52.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_tidak_mampu`
--

CREATE TABLE `surat_keterangan_tidak_mampu` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `suku` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keterangan_tidak_mampu`
--

INSERT INTO `surat_keterangan_tidak_mampu` (`id`, `nomor`, `tanggal`, `nama`, `tempat_lahir`, `tanggal_lahir`, `suku`, `alamat`, `nama_ibu`, `nama_ayah`, `keterangan`, `file`) VALUES
(3, '421/06/SKTM-2021', '2021-02-02', 'Novita Sari', 'Batusangkar', '1999-11-21', 'Kutianyir', 'Badinah Murni', 'Ratna Juwita', 'Khairul Saleh', 'Beasiswa', 'surat_keterangan_tidak_mampu_03-02-2021_09-44-04.pdf'),
(4, '421/05/SKTM-2021', '2021-01-28', 'Anisa Rahmadani', 'Batusangkar', '1998-12-28', 'Mandahiling', 'Minang Jaya', 'Elda Yeni', 'Risnaldi', 'Pengurangan UKT', 'surat_keterangan_tidak_mampu_03-02-2021_10-44-38.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_usaha`
--

CREATE TABLE `surat_keterangan_usaha` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `suku` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jenis_usaha` varchar(250) NOT NULL,
  `tempat_usaha` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keterangan_usaha`
--

INSERT INTO `surat_keterangan_usaha` (`id`, `nomor`, `tanggal`, `nama`, `pekerjaan`, `suku`, `alamat`, `jenis_usaha`, `tempat_usaha`, `file`) VALUES
(4, '412.1/33/SKU-2021', '2021-02-02', 'Rahmat Hultri', 'Buruh Harian Lepas', 'Kutianyir', 'Badinah Murni', 'Dagang Pakaian', 'Badinah Murni', 'surat_keterangan_usaha_03-02-2021_09-56-05.pdf'),
(5, '412.1/32/SKU-2021', '2021-02-02', 'Zulhayati', 'Mengurus Rumah Tangga', 'Piliang', 'Minang Jaya', 'Laundry', 'Minang Jaya', 'surat_keterangan_usaha_03-02-2021_10-29-41.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `isi_singkat` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor`, `tanggal`, `pengirim`, `isi_singkat`, `file`) VALUES
(9, '412.1/552/PMDPPKB/XII-2020', '2020-12-30', 'Sekda Tanah Datar', 'Pembentukan pengembangan dan revitalisasi BUMNAG', 'surat_masuk_03-02-2021_09-28-58.pdf'),
(10, '414.2/12/PMDPPKB/1-2021', '2021-01-08', 'B', 'Pelaksanaan Musrembang Nagari & penyampaian RKP serta DU RKP Nagari', 'surat_masuk_03-02-2021_10-18-07.pdf'),
(11, '412.1/553/PPDPKB/1-2021', '2021-01-25', 'Sekda Tanah Datar', 'BUMNAGG', 'surat_masuk_05-02-2021_11-02-21.pdf'),
(12, '412.1/27/SKU-2021', '2021-02-11', 'Sekda Tanah Datar', 'bumnag', 'surat_masuk_05-02-2021_11-24-14.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `file_gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `password`, `level`, `file_gambar`) VALUES
(1, 'admin', 'Rizky Winanda', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin.png'),
(2, 'operator', 'Operator', '4b583376b2767b923c3e1da60d10de59', 'operator', 'operator.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_ahli_waris`
--
ALTER TABLE `surat_keterangan_ahli_waris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_catatan_kepolisian`
--
ALTER TABLE `surat_keterangan_catatan_kepolisian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_izin_kayu`
--
ALTER TABLE `surat_keterangan_izin_kayu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_kematian`
--
ALTER TABLE `surat_keterangan_kematian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_lainnya`
--
ALTER TABLE `surat_keterangan_lainnya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_nikah`
--
ALTER TABLE `surat_keterangan_nikah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_tidak_mampu`
--
ALTER TABLE `surat_keterangan_tidak_mampu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_usaha`
--
ALTER TABLE `surat_keterangan_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_keterangan_ahli_waris`
--
ALTER TABLE `surat_keterangan_ahli_waris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keterangan_catatan_kepolisian`
--
ALTER TABLE `surat_keterangan_catatan_kepolisian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_keterangan_izin_kayu`
--
ALTER TABLE `surat_keterangan_izin_kayu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keterangan_kematian`
--
ALTER TABLE `surat_keterangan_kematian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat_keterangan_lainnya`
--
ALTER TABLE `surat_keterangan_lainnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keterangan_nikah`
--
ALTER TABLE `surat_keterangan_nikah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keterangan_tidak_mampu`
--
ALTER TABLE `surat_keterangan_tidak_mampu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keterangan_usaha`
--
ALTER TABLE `surat_keterangan_usaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
