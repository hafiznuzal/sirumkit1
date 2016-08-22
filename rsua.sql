-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for rsua
CREATE DATABASE IF NOT EXISTS `rsua` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `rsua`;


-- Dumping structure for table rsua.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `Id_Transaksi` bigint(11) NOT NULL,
  `No_Transaksi` int(5) NOT NULL,
  `Item_Transaksi` varchar(50) NOT NULL,
  `Uraian` varchar(100) NOT NULL,
  `Biaya` bigint(13) NOT NULL,
  `Tanggal` date NOT NULL,
  `Jenis` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id_Transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table rsua.transaksi: ~20 rows (approximately)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
REPLACE INTO `transaksi` (`Id_Transaksi`, `No_Transaksi`, `Item_Transaksi`, `Uraian`, `Biaya`, `Tanggal`, `Jenis`) VALUES
	(10704201610, 10, 'Rawat Inap - Kelas II', 'ayam den lapeh', 11, '2016-04-07', 1),
	(11003160001, 1, '', 'masuk 1', 100000, '2016-03-10', 1),
	(11003160002, 2, '', 'masuk 2', 110000, '2016-03-10', 1),
	(11103160003, 3, '', 'masuk 3', 111000, '2016-03-11', 1),
	(21003160001, 1, '', 'keluar1', 110000, '2016-03-10', 2),
	(21003160002, 2, '', 'keluar2', 11000, '2016-03-10', 2),
	(1060420160001, 1, 'VK- Persalinan', 'q', 1, '2016-04-06', 1),
	(1060420160002, 2, 'VK- Persalinan', 'nvk', 1, '2016-04-06', 1),
	(1070420160003, 3, 'VK- Persalinan', 'transaksi hari ini', 1000000, '2016-04-07', 1),
	(1070420160004, 4, 'VK- Perawatan Bayi', 'qqq', 111, '2016-04-07', 1),
	(1070420160005, 5, 'Rawat Inap - VIP', 'thiar', 1111, '2016-04-07', 1),
	(1070420160006, 6, 'Rawat Inap - VIP', 'hafiz', 1111, '2016-04-07', 1),
	(1070420160007, 7, 'Rawat Inap - VIP', 'wahyu', 1111, '2016-04-07', 1),
	(1070420160008, 8, 'Rawat Inap - Kelas I', 'icank', 111, '2016-04-07', 1),
	(1070420160009, 9, 'Rawat Inap - Kelas I', 'ipul', 111, '2016-04-07', 1),
	(1120820160001, 1, 'VK- Persalinan', 'Persalinan Ny. Mwar (12/08/16) 15:00 WIB', 15000000, '2016-08-12', 1),
	(1180420160011, 11, 'VK- Persalinan', 'abcd', 1000, '2016-04-18', 1),
	(1190420160012, 12, 'VK- Persalinan', 'asd', 100, '2016-04-19', 1),
	(1210420160013, 13, 'VK- Persalinan', 'a', 1, '2016-04-21', 1),
	(1210420160014, 14, 'VK- Persalinan', 'a', 1, '2016-04-21', 1),
	(1220820160002, 2, 'Penerimaan Lain-Lain', 'hayolooo', 100000, '2016-08-22', 1),
	(2070420160001, 1, 'B.Pegawai - Gaji Karyawan', 'trans hari ini', 11111, '2016-04-07', 2),
	(2120820160001, 1, 'B.Pegawai - Gaji Karyawan', 'Gaji Dr. Budi Setyawan', 20000000, '2016-08-12', 2);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;


-- Dumping structure for table rsua.user
CREATE TABLE IF NOT EXISTS `user` (
  `NIP` bigint(10) NOT NULL,
  `Nama_Pengguna` varchar(50) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table rsua.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`NIP`, `Nama_Pengguna`, `Username`, `Password`) VALUES
	(5112100170, 'Administrasi Keuangan', 'adminkeu', 'a42c47cb0c915b7468c7db0293a359a8'),
	(5112100173, 'Super Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
