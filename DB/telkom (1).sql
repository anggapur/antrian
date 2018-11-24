-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 12:47 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `telkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_banner_text`
--

CREATE TABLE IF NOT EXISTS `m_banner_text` (
`banner_text_id` int(11) NOT NULL,
  `type` varchar(32) DEFAULT NULL,
  `banner_text` varchar(128) DEFAULT NULL,
  `active_flag` varchar(4) DEFAULT NULL,
  `keterangan` varchar(1024) DEFAULT NULL,
  `plasa_cd` varchar(32) DEFAULT NULL,
  `created_who` varchar(32) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `changed_who` varchar(32) DEFAULT NULL,
  `changed_date` date DEFAULT NULL,
  `ORDERNUM` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=39 ;

--
-- Dumping data for table `m_banner_text`
--

INSERT INTO `m_banner_text` (`banner_text_id`, `type`, `banner_text`, `active_flag`, `keterangan`, `plasa_cd`, `created_who`, `created_date`, `changed_who`, `changed_date`, `ORDERNUM`) VALUES
(36, 'BG4', 'HOLAA', 'Y', 'HOLAA', NULL, 'sevanam', '2018-05-16', 'sevanam', '2018-05-16', 2),
(37, 'BGBARU', 'HALO', 'Y', '-', NULL, 'sevanam', '2018-05-16', NULL, NULL, 4),
(33, 'BANNER-4', 'Testsss', 'Y', '-', NULL, 'sevanam', '2018-05-16', 'sevanam', '2018-05-16', 3),
(34, 'TEST', 'OPOPOPO', 'Y', '-', NULL, 'sevanam', '2018-05-16', 'sevanam', '2018-05-16', 5),
(35, 'BANNER-4', 'POPO', 'Y', '-', NULL, 'sevanam', '2018-05-16', 'sevanam', '2018-05-16', 6),
(38, 'Agak Pink', 'Selamat Pagi', 'Y', 'Selamat Pagi', NULL, 'sevanam', '2018-05-21', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_content`
--

CREATE TABLE IF NOT EXISTS `m_content` (
`CONTENT_ID` int(10) NOT NULL,
  `TYPE` varchar(10) NOT NULL,
  `FILENAME` varchar(100) NOT NULL,
  `DURATION` int(11) DEFAULT NULL,
  `CREATED_WHO` varchar(50) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CHANGE_WHO` varchar(50) DEFAULT NULL,
  `CHANGE_DATE` datetime DEFAULT NULL,
  `ORDERNUM` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `m_content`
--

INSERT INTO `m_content` (`CONTENT_ID`, `TYPE`, `FILENAME`, `DURATION`, `CREATED_WHO`, `CREATED_DATE`, `CHANGE_WHO`, `CHANGE_DATE`, `ORDERNUM`) VALUES
(69, 'BANNER', '5d0899d98754c8b321f6321ec97cbf612.png', 3, '', '0000-00-00 00:00:00', 'sevanam', '2018-05-15 18:58:31', 4),
(139, 'BANNER', 'banner2.jpg', 2, 'sevanam', '2016-03-04 13:20:02', 'sevanam', '2018-05-21 09:54:57', 1),
(153, 'BANNER', '5d0899d98754c8b321f6321ec97cbf611.png', 2, 'sevanam', '2018-05-15 17:58:30', 'sevanam', '2018-05-15 18:45:24', 3),
(161, 'VIDEO', 'videoplayback_(3).mp4', 30, 'sevanam', '2018-05-21 07:48:55', 'sevanam', '2018-06-04 08:44:13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_datel`
--

CREATE TABLE IF NOT EXISTS `m_datel` (
`DATEL_ID` int(10) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `ALAMAT` varchar(100) NOT NULL,
  `KABUPATEN` varchar(50) NOT NULL,
  `PROPINSI` varchar(50) NOT NULL,
  `CREATED_WHO` varchar(50) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CHANGE_WHO` varchar(50) DEFAULT NULL,
  `CHANGE_DATE` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `m_datel`
--

INSERT INTO `m_datel` (`DATEL_ID`, `NAMA`, `ALAMAT`, `KABUPATEN`, `PROPINSI`, `CREATED_WHO`, `CREATED_DATE`, `CHANGE_WHO`, `CHANGE_DATE`) VALUES
(1, 'BALI', ' ', ' ', 'BALIKU', 'Admin', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_plaza`
--

CREATE TABLE IF NOT EXISTS `m_plaza` (
`PLAZA_ID` int(10) NOT NULL,
  `DATEL_ID` int(10) NOT NULL,
  `PLAZA_CD` varchar(50) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `CLASS` varchar(50) NOT NULL,
  `ALAMAT` varchar(100) NOT NULL,
  `JUMLAH_CSR` int(11) NOT NULL,
  `MESIN_ANTRIAN` varchar(10) DEFAULT NULL,
  `SATPAM_PLASA` varchar(10) DEFAULT NULL,
  `POLLING_LAYANAN` varchar(10) DEFAULT NULL,
  `PERSONAL_COMPUTER` varchar(10) DEFAULT NULL,
  `TEMPAT_KORAN` varchar(10) DEFAULT NULL,
  `BISPRO_LAYANAN` varchar(10) DEFAULT NULL,
  `TEMPAT_BROSUR` varchar(10) DEFAULT NULL,
  `LOKET_SOPP` varchar(10) DEFAULT NULL,
  `KOTAK_SARAN` varchar(10) DEFAULT NULL,
  `SOUND_SYSTEM` varchar(10) DEFAULT NULL,
  `TOILET` varchar(10) DEFAULT NULL,
  `TEMPAT_PARKIR` varchar(10) DEFAULT NULL,
  `LAINNYA` varchar(50) DEFAULT NULL,
  `KETERANGAN` varchar(100) DEFAULT NULL,
  `STATUS` varchar(50) NOT NULL,
  `IMAGE1` varchar(30) DEFAULT NULL,
  `IMAGE2` varchar(30) DEFAULT NULL,
  `IMAGE3` varchar(30) DEFAULT NULL,
  `IMAGE4` varchar(30) DEFAULT NULL,
  `IMAGE5` varchar(30) DEFAULT NULL,
  `STO` int(11) DEFAULT NULL,
  `SST` int(11) DEFAULT NULL,
  `IT_TOOLS` varchar(512) DEFAULT NULL,
  `IT_TOOLS_OTHERS` varchar(512) DEFAULT NULL,
  `IPADDRESS` varchar(20) DEFAULT NULL,
  `CREATED_WHO` varchar(50) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CHANGE_WHO` varchar(50) DEFAULT NULL,
  `CHANGE_DATE` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `m_plaza`
--

INSERT INTO `m_plaza` (`PLAZA_ID`, `DATEL_ID`, `PLAZA_CD`, `NAMA`, `CLASS`, `ALAMAT`, `JUMLAH_CSR`, `MESIN_ANTRIAN`, `SATPAM_PLASA`, `POLLING_LAYANAN`, `PERSONAL_COMPUTER`, `TEMPAT_KORAN`, `BISPRO_LAYANAN`, `TEMPAT_BROSUR`, `LOKET_SOPP`, `KOTAK_SARAN`, `SOUND_SYSTEM`, `TOILET`, `TEMPAT_PARKIR`, `LAINNYA`, `KETERANGAN`, `STATUS`, `IMAGE1`, `IMAGE2`, `IMAGE3`, `IMAGE4`, `IMAGE5`, `STO`, `SST`, `IT_TOOLS`, `IT_TOOLS_OTHERS`, `IPADDRESS`, `CREATED_WHO`, `CREATED_DATE`, `CHANGE_WHO`, `CHANGE_DATE`) VALUES
(18, 1, 'BADUNG', 'PDAM BADUNG', ' ', 'Jln. Bedahulu', 5, 'ADA', 'ADA', 'ADA', 'ADA', 'TIDAK', 'ADA', 'ADA', 'ADA', 'ADA', 'ADA', 'ADA', 'ADA', NULL, NULL, '', 'NEGARA01.jpg', NULL, NULL, NULL, NULL, 0, 0, ' ', ' ', '192.168.1.2', '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_polling`
--

CREATE TABLE IF NOT EXISTS `m_polling` (
`polling_id` int(11) NOT NULL,
  `type` varchar(32) DEFAULT NULL,
  `judul` varchar(128) DEFAULT NULL,
  `jawaban1` varchar(32) DEFAULT NULL,
  `jawaban2` varchar(32) DEFAULT NULL,
  `jawaban3` varchar(32) DEFAULT NULL,
  `jawaban4` varchar(32) DEFAULT NULL,
  `jawaban5` varchar(32) DEFAULT NULL,
  `jawaban6` varchar(32) DEFAULT NULL,
  `jawaban7` varchar(32) DEFAULT NULL,
  `jawaban8` varchar(32) DEFAULT NULL,
  `jawaban9` varchar(32) DEFAULT NULL,
  `jawaban10` varchar(32) DEFAULT NULL,
  `active_flag` varchar(4) DEFAULT NULL,
  `keterangan` varchar(1024) DEFAULT NULL,
  `plasa_cd` varchar(32) DEFAULT NULL,
  `created_who` varchar(32) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `changed_who` varchar(32) DEFAULT NULL,
  `changed_date` date DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `m_polling`
--

INSERT INTO `m_polling` (`polling_id`, `type`, `judul`, `jawaban1`, `jawaban2`, `jawaban3`, `jawaban4`, `jawaban5`, `jawaban6`, `jawaban7`, `jawaban8`, `jawaban9`, `jawaban10`, `active_flag`, `keterangan`, `plasa_cd`, `created_who`, `created_date`, `changed_who`, `changed_date`) VALUES
(2, ' ', 'Pendapat Anda Dengan Layanan Badan Pengelola Keuangan dan Aset Daerah?', 'Puas', 'Biasa', 'Kurang', 'Mengecewakan', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', NULL, 'PDAM', NULL, '2007-12-30', 'admin', '2016-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `m_request_command`
--

CREATE TABLE IF NOT EXISTS `m_request_command` (
`REQUEST_COMMAND_ID` int(10) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `TYPE` varchar(50) DEFAULT NULL,
  `RESULT` text,
  `GROUP` varchar(50) DEFAULT NULL,
  `TEMPLATE` text,
  `STATUS` varchar(50) DEFAULT NULL,
  `LOKETNO` varchar(50) DEFAULT NULL,
  `CREATED_WHO` varchar(50) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CHANGE_WHO` varchar(50) DEFAULT NULL,
  `CHANGE_DATE` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `m_request_command`
--

INSERT INTO `m_request_command` (`REQUEST_COMMAND_ID`, `NAME`, `TYPE`, `RESULT`, `GROUP`, `TEMPLATE`, `STATUS`, `LOKETNO`, `CREATED_WHO`, `CREATED_DATE`, `CHANGE_WHO`, `CHANGE_DATE`) VALUES
(2, 'GET_NEXT_COUNTER', 'KONSULTASI', 'SELECT (antrian_no) antrianNo,antrian_id,TYPE,\r\nserviced_by,serviced_startdate \r\nFROM t_antrian WHERE STATUS=''OPEN'' AND TYPE IN (''KONSULTASI'')\r\nAND CAST(trx_date AS DATE) = CAST(NOW() AS DATE)\r\nORDER BY CAST(REPLACE(antrian_no,''A'','''') AS SIGNED)  ASC LIMIT 1\r\n', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(4, 'GET_NEXT_TICKET', 'KONSULTASI', 'select (concat(''A'',replace(antrian_no,''A'','''')+1)) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate from t_antrian where \r\ncast(trx_date as date) = cast(now() as date)and TYPE IN (''KONSULTASI'')\r\norder by cast(replace(antrian_no,''A'','''') as signed) desc limit 1', 'TICKET', 'Selamat Datang di<br>B P K A D<br>Kabupaten Jembrana<br>Antrian no.<br><style:bold>[QUEUENO]<br>KONSULTASI<br>Terima kasih atas kunjungan Anda<br>[DATE]', 'A', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(8, 'GET_TOTAL_ANTRIAN', 'KONSULTASI', 'select concat(\r\n(select count(*) from t_antrian where TYPE IN (''KONSULTASI'')\r\nand cast(trx_date as date) = cast(now() as date)\r\nand status!=''OPEN'')\r\n,concat('' dari '',count(antrian_no)))\r\nfrom t_antrian where TYPE IN (''KONSULTASI'')\r\nand cast(trx_date as date) = cast(now() as date)\r\n', 'INFO', '', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(10, 'GET_REPLAY_COUNTER', 'KONSULTASI', 'select (antrian_no) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where status=''INPROGRESS''\r\nand cast(trx_date as date) = cast(now() as date)\r\nand antrian_id=?\r\norder by (antrian_no)  asc limit 1', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(12, 'GET_REPLAY_COUNTER', 'PBB', 'select (antrian_no) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where status=''INPROGRESS''\r\nand cast(trx_date as date) = cast(now() as date)\r\nand antrian_id=?\r\norder by (antrian_no)  asc limit 1', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(13, 'GET_NEXT_COUNTER', 'PBB', 'select (antrian_no) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where status=''OPEN'' and type=''PBB''\r\nand cast(trx_date as date) = cast(now() as date)\r\norder by type asc,cast(replace(antrian_no,''B'','''') as signed)  asc\r\n\r\n\r\n', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(63, 'GET_TOTAL_ANTRIAN', 'PEMBAYARAN', 'select concat(\r\n(select count(*) from t_antrian where TYPE IN (''PEMBAYARAN'')\r\nand cast(trx_date as date) = cast(now() as date)\r\nand status!=''OPEN'')\r\n,concat('' dari '',count(antrian_no)))\r\nfrom t_antrian where TYPE IN (''PEMBAYARAN'')\r\nand cast(trx_date as date) = cast(now() as date)\r\n', 'INFO', '', 'ACTIVE', '', 'MOTEX', '2016-02-03 19:55:27', NULL, NULL),
(64, 'GET_REPLAY_COUNTER', 'PEMBAYARAN', 'select (antrian_no) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where status=''INPROGRESS''\r\nand cast(trx_date as date) = cast(now() as date)\r\nand antrian_id=?\r\norder by (antrian_no)  asc limit 1', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'MOTEX', '2016-02-03 19:55:27', NULL, NULL),
(65, 'GET_NEXT_TICKET_SMS', 'PEMBAYARAN', 'select concat(concat(concat((concat(''D'',replace(antrian_no,''D'','''')+1)),\r\n'' (antrian akhir ''),\r\n	ifnull((select antrian_no \r\n	from t_antrian where status!=''OPEN''\r\n	and cast(trx_date as date) = cast(now() as date)\r\n	and TYPE IN (''PEMBAYARAN'')\r\n	order by cast(replace(antrian_no,''D'','''') as signed)   desc limit 1),''belum ada'')\r\n),'')'') antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where \r\ncast(trx_date as date) = cast(now() as date)\r\nand TYPE IN (''PEMBAYARAN'')\r\norder by cast(replace(antrian_no,''D'','''') as signed) desc limit 1;\r\n', 'TICKET', 'Selamat Datang di<br>B P K A D<br>Kabupaten Jembrana<br>Antrian no.<br><style:bold>[QUEUENO]<br>[TYPE]<br>Terima kasih atas kunjungan Anda<br>[DATE]', 'D', '', 'MOTEX', '2016-02-03 19:55:27', NULL, NULL),
(18, 'GET_NEXT_COUNTER', 'BPHTB', 'select (antrian_no) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where status=''OPEN'' and type=''BPHTB''\r\nand cast(trx_date as date) = cast(now() as date)\r\norder by cast(replace(antrian_no,''C'','''') as signed)  asc limit 1\r\n', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(20, 'GET_NEXT_TICKET', 'PBB', 'select (concat(''B'',replace(antrian_no,''B'','''')+1)) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate from t_antrian where \r\ncast(trx_date as date) = cast(now() as date)and type=''PBB''\r\norder by cast(replace(antrian_no,''B'','''') as signed) desc limit 1', 'TICKET', 'Selamat Datang di<br>B P K A D<br>Kabupaten Jembrana<br>Antrian no.<br><style:bold>[QUEUENO]<br>PELAYANAN PBB-P2<br>Terima kasih atas kunjungan Anda<br>[DATE]', 'B', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(61, 'GET_NEXT_COUNTER', 'PEMBAYARAN', 'SELECT (antrian_no) antrianNo,antrian_id,TYPE,\r\nserviced_by,serviced_startdate \r\nFROM t_antrian WHERE STATUS=''OPEN'' AND TYPE IN (''PEMBAYARAN'')\r\nAND CAST(trx_date AS DATE) = CAST(NOW() AS DATE)\r\nORDER BY CAST(REPLACE(antrian_no,''D'','''') AS SIGNED)  ASC LIMIT 1\r\n', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'MOTEX', '2016-02-03 19:55:27', NULL, NULL),
(62, 'GET_NEXT_TICKET', 'PEMBAYARAN', 'select (concat(''D'',replace(antrian_no,''D'','''')+1)) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate from t_antrian where \r\ncast(trx_date as date) = cast(now() as date)and TYPE IN (''PEMBAYARAN'')\r\norder by cast(replace(antrian_no,''D'','''') as signed) desc limit 1', 'TICKET', 'Selamat Datang di<br>B P K A D<br>Kabupaten Jembrana<br>Antrian no.<br><style:bold>[QUEUENO]<br>PEMBAYARAN PAJAK<br>Terima kasih atas kunjungan Anda<br>[DATE]', 'D', '', 'MOTEX', '2016-02-03 19:55:27', NULL, NULL),
(25, 'GET_NEXT_TICKET', 'BPHTB', 'select (concat(''C'',replace(antrian_no,''C'','''')+1)) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate from t_antrian where \r\ncast(trx_date as date) = cast(now() as date)and type=''BPHTB'' \r\norder by cast(replace(antrian_no,''C'','''') as signed) desc limit 1', 'TICKET', 'Selamat Datang di<br>B P K A D<br>Kabupaten Jembrana<br>Antrian no.<br><style:bold>[QUEUENO]<br>PELAYANAN BPHTB TERPADU<br>Terima kasih atas kunjungan Anda<br>[DATE]', 'C', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(31, 'GET_TOTAL_ANTRIAN', 'PBB', 'select concat(\r\n(select count(*) from t_antrian where type=''PBB''\r\nand cast(trx_date as date) = cast(now() as date)\r\nand status!=''OPEN'')\r\n,concat('' dari '',count(antrian_no)))\r\nfrom t_antrian where type=''PBB''\r\nand cast(trx_date as date) = cast(now() as date)\r\n', 'INFO', '', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(33, 'GET_TOTAL_ANTRIAN', 'BPHTB', 'select concat(\r\n(select count(*) from t_antrian where type=''BPHTB''\r\nand cast(trx_date as date) = cast(now() as date)\r\nand status!=''OPEN'')\r\n,concat('' dari '',count(antrian_no)))\r\nfrom t_antrian where type=''BPHTB''\r\nand cast(trx_date as date) = cast(now() as date)\r\n', 'INFO', '', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(38, 'GET_NEXT_COUNTER', 'ALL', 'select (antrian_no) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where status=''OPEN''\r\nand cast(trx_date as date) = cast(now() as date)\r\norder by (antrian_no)  asc limit 1\r\n', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(39, 'GET_TOTAL_ANTRIAN', 'ALL', 'select concat(\r\n(select count(*) from t_antrian \r\nwhere \r\ncast(trx_date as date) = cast(now() as date)\r\nand status!=''OPEN'')\r\n,concat('' dari '',count(antrian_no)))\r\nfrom \r\nt_antrian where \r\ncast(trx_date as date) = cast(now() as date)', 'INFO', '', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(40, 'VERIFY_LOGIN', 'LOGIN', 'select login from s_user where login=''?'' and pwd=''?''', 'INFO', '', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(41, 'GET_REPLAY_COUNTER', 'ALL', 'select (antrian_no) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where status=''INPROGRESS''\r\nand cast(trx_date as date) = cast(now() as date)\r\nand antrian_id=?\r\norder by (antrian_no)  asc limit 1\r\n', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket [LOKETNO] blank', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(44, 'GET_REPLAY_COUNTER', 'BPHTB', 'select (antrian_no) antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where status=''INPROGRESS''\r\nand cast(trx_date as date) = cast(now() as date)\r\nand antrian_id=?\r\norder by (antrian_no)  asc limit 1', 'COUNTER', 'blank dingdong Antrian No [QUEUENO] ke loket blank', 'ACTIVE', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(50, 'GET_NEXT_TICKET_SMS', 'PBB', 'select concat(concat(concat((concat(''B'',replace(antrian_no,''B'','''')+1)),\r\n'' (antrian akhir ''),\r\n	ifnull((select antrian_no \r\n	from t_antrian where status!=''OPEN''\r\n	and cast(trx_date as date) = cast(now() as date)\r\n	and type=''PBB''\r\n	order by cast(replace(antrian_no,''B'','''') as signed)   desc limit 1),''belum ada'')\r\n),'')'') antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where \r\ncast(trx_date as date) = cast(now() as date)\r\nand type=''PBB''\r\norder by cast(replace(antrian_no,''B'','''') as signed) desc limit 1;\r\n', 'TICKET', 'Selamat Datang di<br>B P K A D<br>Kabupaten Jembrana<br>Antrian no.<br><style:bold>[QUEUENO]<br>[TYPE]<br>Terima kasih atas kunjungan Anda<br>[DATE]', 'B', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(48, 'GET_NEXT_TICKET_SMS', 'KONSULTASI', 'select concat(concat(concat((concat(''A'',replace(antrian_no,''A'','''')+1)),\r\n'' (antrian akhir ''),\r\n	ifnull((select antrian_no \r\n	from t_antrian where status!=''OPEN''\r\n	and cast(trx_date as date) = cast(now() as date)\r\n	and TYPE IN (''KONSULTASI'')\r\n	order by cast(replace(antrian_no,''A'','''') as signed)   desc limit 1),''belum ada'')\r\n),'')'') antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where \r\ncast(trx_date as date) = cast(now() as date)\r\nand TYPE IN (''KONSULTASI'')\r\norder by cast(replace(antrian_no,''A'','''') as signed) desc limit 1;\r\n', 'TICKET', 'Selamat Datang di<br>B P K A D<br>Kabupaten Jembrana<br>Antrian no.<br><style:bold>[QUEUENO]<br>[TYPE]<br>Terima kasih atas kunjungan Anda<br>[DATE]', 'A', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL),
(49, 'GET_NEXT_TICKET_SMS', 'BPHTB', 'select concat(concat(concat((concat(''C'',replace(antrian_no,''C'','''')+1)),\r\n'' (antrian akhir ''),\r\n	ifnull((select antrian_no \r\n	from t_antrian where status!=''OPEN''\r\n	and cast(trx_date as date) = cast(now() as date)\r\n	and type=''BPHTB''\r\n	order by cast(replace(antrian_no,''C'','''') as signed)   desc limit 1),''belum ada'')\r\n),'')'') antrianNo,antrian_id,type,\r\nserviced_by,serviced_startdate \r\nfrom t_antrian where \r\ncast(trx_date as date) = cast(now() as date)\r\nand type=''BPHTB''\r\norder by cast(replace(antrian_no,''C'','''') as signed) desc limit 1;\r\n', 'TICKET', 'Selamat Datang di<br>B P K A D<br>Kabupaten Jembrana<br>Antrian no.<br><style:bold>[QUEUENO]<br>[TYPE]<br>Terima kasih atas kunjungan Anda<br>[DATE]', 'C', '', 'Admin', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `s_lov_value`
--

CREATE TABLE IF NOT EXISTS `s_lov_value` (
`LOV_VALUE_ID` int(11) NOT NULL,
  `CODE` varchar(25) DEFAULT NULL,
  `DESCRIPTION` varchar(150) DEFAULT NULL,
  `CODE_VAL` varchar(20) NOT NULL,
  `SERVICE_CD` varchar(8) DEFAULT NULL,
  `REMARK` varchar(200) DEFAULT NULL,
  `ACTIVE_FLAG` varchar(1) DEFAULT NULL,
  `CREATED_WHO` varchar(50) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CHANGE_WHO` varchar(20) DEFAULT NULL,
  `CHANGE_DATE` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

--
-- Dumping data for table `s_lov_value`
--

INSERT INTO `s_lov_value` (`LOV_VALUE_ID`, `CODE`, `DESCRIPTION`, `CODE_VAL`, `SERVICE_CD`, `REMARK`, `ACTIVE_FLAG`, `CREATED_WHO`, `CREATED_DATE`, `CHANGE_WHO`, `CHANGE_DATE`) VALUES
(51, 'SKIN', 'Diagonal Hijau', '1', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(52, 'SKIN', 'Gradasi Biru', '2', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(53, 'SKIN', 'Tribal Merah', '3', NULL, NULL, 'Y', '', '0000-00-00 00:00:00', NULL, NULL),
(56, 'SKIN', 'Bintang Merah', '5', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(55, 'SKIN', 'Vista Hijau', '4', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(54, 'SKIN_SETTING', '4', 'RANDOM', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(57, 'SKIN', 'Vista Biru', '6', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(58, 'SKIN', 'Vista Merah', '7', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(59, 'SKIN', 'Vista Biru', '8', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(60, 'SKIN', 'Diagonal Hijau', '9', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(61, 'SKIN', 'Vista Hijau', '10', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(64, 'SKIN', 'Vista Biru', '0', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(65, 'OTORITAS', 'admin', 'admin', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(66, 'OTORITAS', 'operator', 'operator', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(67, 'JK', 'LAKI-LAKI', 'LAKI-LAKI', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(68, 'JK', 'PEREMPUAN', 'PEREMPUAN', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(69, 'STATUS_KAWIN', 'LAJANG', 'LAJANG', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(70, 'STATUS_KAWIN', 'KAWIN', 'KAWIN', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(71, 'STATUS_KAWIN', 'JANDA/DUDA', 'JANDA/DUDA', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(72, 'AGAMA', 'HINDU', 'HINDU', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(73, 'AGAMA', 'BUDHA', 'BUDHA', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(74, 'AGAMA', 'ISLAM', 'ISLAM', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(75, 'AGAMA', 'PROTESTAN', 'PROTESTAN', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(76, 'AGAMA', 'KATOLIK', 'KATOLIK', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(78, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-1', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(79, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-2', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(80, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-3', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(81, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-4', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(82, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-5', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(83, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-6', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(85, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-8', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(86, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-9', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(87, 'TYPE_BANNER', '#ffffff,#000000', 'BANNER-10', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(88, 'TYPE_CONTENT', 'BANNER', 'BANNER', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(89, 'TYPE_CONTENT', 'VIDEO', 'VIDEO', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(90, 'ACTIVE_FLAG', 'YA', 'Y', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(91, 'ACTIVE_FLAG', 'TIDAK', 'N', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(93, 'VOLUME', 'Volume Video Di Dispay TV', '43', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(94, 'TYPE_BANNER', '#ffffff,#000000', '0', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(95, 'TYPE_BANNER', '#ffffff,#000000', '0', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(96, 'TYPE_BANNER', '#ffffff,#000000', '0', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(97, 'TYPE_BANNER', '#ffffff,#000000', '0', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(98, 'TYPE_BANNER', '#ffffff,#000000', 'A1', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(99, 'TYPE_BANNER', '#ffffff,#f0e3e3', 'BG5', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(100, 'TYPE_BANNER', '#ffffff,#f0e3e3', 'BG5', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(101, 'TYPE_BANNER', '#ffffff,#bd97be', 'TEST', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(102, 'TYPE_BANNER', '#ffffff,#bd97be', 'TEST', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(103, 'TYPE_BANNER', '#ffffff,#b6b6b6', 'BG4', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(104, 'TYPE_BANNER', '#000000,#102d82', 'BGBARU', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(105, 'TYPE_BANNER', '#ffffff,#ffebeb', 'Agak Pink', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(106, 'MAIN_NAMA', 'BPKAD JEMBRANA', 'MAIN_NAMA', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(107, 'MAIN_TELPON', '0361 730170', 'MAIN_TELPON', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(108, 'MAIN_ALAMAT', 'Jl Raya Kerobokan No 123 Kuta Utara - Badung', 'MAIN_NALAMAT', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(109, 'MAIN_LOGO_LOGIN', 'lambang2.png', 'MAIN_LOGO_LOGIN', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(110, 'MAIN_LOGO_DISPLAY', 'logo-bppkd1.png', 'MAIN_LOGO_DISPLAy', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(111, 'MAIN_PRINTER', 'EPSON TM-T88V Receipt', 'MAIN_PRINTER', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `s_user`
--

CREATE TABLE IF NOT EXISTS `s_user` (
`USER_ID` int(10) NOT NULL,
  `LOGIN` varchar(20) NOT NULL,
  `PWD` varchar(20) NOT NULL,
  `GROUP` varchar(20) DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  `TEMPAT_LAHIR` varchar(100) NOT NULL,
  `TGL_LAHIR` varchar(100) NOT NULL,
  `JENIS_KELAMIN` varchar(10) NOT NULL,
  `ALAMAT` varchar(100) NOT NULL,
  `HP1` varchar(100) DEFAULT NULL,
  `HP2` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `JILBAB_FLAG` varchar(10) DEFAULT NULL,
  `PHOTO` varchar(100) NOT NULL,
  `PLAZA_CD` varchar(20) NOT NULL,
  `SERVICE_TYPE` varchar(20) DEFAULT NULL,
  `PENDIDIKAN` varchar(20) DEFAULT NULL,
  `LOKETNO` int(11) DEFAULT NULL,
  `TGL_STARTKERJA` datetime NOT NULL,
  `AGAMA` varchar(50) NOT NULL,
  `STATUS_KAWIN` varchar(10) NOT NULL,
  `TYPE_USER` varchar(10) NOT NULL,
  `NO_PKS` varchar(5) DEFAULT NULL,
  `TGL_AWAL_PKS` datetime DEFAULT NULL,
  `TGL_AKHIR_PKS` datetime DEFAULT NULL,
  `CREATED_WHO` varchar(50) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CHANGE_WHO` varchar(50) DEFAULT NULL,
  `CHANGE_DATE` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `s_user`
--

INSERT INTO `s_user` (`USER_ID`, `LOGIN`, `PWD`, `GROUP`, `NAME`, `TEMPAT_LAHIR`, `TGL_LAHIR`, `JENIS_KELAMIN`, `ALAMAT`, `HP1`, `HP2`, `EMAIL`, `JILBAB_FLAG`, `PHOTO`, `PLAZA_CD`, `SERVICE_TYPE`, `PENDIDIKAN`, `LOKETNO`, `TGL_STARTKERJA`, `AGAMA`, `STATUS_KAWIN`, `TYPE_USER`, `NO_PKS`, `TGL_AWAL_PKS`, `TGL_AKHIR_PKS`, `CREATED_WHO`, `CREATED_DATE`, `CHANGE_WHO`, `CHANGE_DATE`) VALUES
(15, 'sevanam', 'admin123', 'admin', 'Sevanam Enterprise', 'Badung', '2012-08-23', 'LAKI-LAKI', 'Jln. Raya Kerobokan 123 Umalas Kangin', ' ', ' ', ' ', 'YA', 'sevanam.png', ' ', ' ', ' ', 1, '0000-00-00 00:00:00', 'HINDU', 'KAWIN', 'admin', ' ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'admin', '2016-02-05 14:39:54'),
(39, 'natama', 'natama', NULL, 'Natama Enterprise', 'Gianyar', ' ', 'LAKI-LAKI', 'Jln. Kebo Iwa 10A Gianyar', ' ', ' ', ' ', 'YA', 'natama.jpg', ' ', ' ', ' ', 5, '0000-00-00 00:00:00', '0', 'LAJANG', 'operator', ' ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', NULL, NULL),
(50, 'suarsini', 'suarsini', NULL, 'Ni Ketut Suarsini', 'a', '1989-10-08', 'PEREMPUAN', 'kasir', '0', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '0000-00-00 00:00:00', 'HINDU', 'LAJANG', 'admin', NULL, NULL, NULL, '', '0000-00-00 00:00:00', 'sevanam', '2016-02-15 15:45:48'),
(51, 'bugek', 'bugek', NULL, 'Gusti Agung Ayu Susilawati', 'Klungkung', '1989-03-30', 'PEREMPUAN', 'kerobokan', '0', NULL, NULL, NULL, '', '', NULL, NULL, 1, '0000-00-00 00:00:00', 'HINDU', 'KAWIN', 'operator', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL),
(52, 'dekuni', 'dekuni', NULL, 'Ni Made Dyan Dwi Juni Priantini', 'gianyar', '10/10/1990', 'PEREMPUAN', 'gianyar', '0', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '0000-00-00 00:00:00', 'HINDU', 'LAJANG', 'admin', NULL, NULL, NULL, '', '0000-00-00 00:00:00', 'sevanam', '2016-02-15 15:46:12'),
(53, 'dekoka', 'dekoka', NULL, 'Ni Kade Oka Wiarsini', 'gianyar', '10/10/1990', 'PEREMPUAN', 'gianyar', '0', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '0000-00-00 00:00:00', 'HINDU', 'LAJANG', 'admin', NULL, NULL, NULL, '', '0000-00-00 00:00:00', 'sevanam', '2016-02-15 15:46:12'),
(54, 'mangdewi', 'mangdewi', NULL, 'Gusti Ayu Komang Sutrisna Dewi', 'gianyar', '10/10/1990', 'PEREMPUAN', 'gianyar', '0', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '0000-00-00 00:00:00', 'HINDU', 'LAJANG', 'admin', NULL, NULL, NULL, '', '0000-00-00 00:00:00', 'sevanam', '2016-02-15 15:46:12'),
(55, 'uci', 'uci', NULL, 'Gex Uci', 'gianyar', '10/10/1990', 'PEREMPUAN', 'gianyar', '0', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '0000-00-00 00:00:00', 'HINDU', 'LAJANG', 'operator', NULL, NULL, NULL, '', '0000-00-00 00:00:00', 'sevanam', '2018-05-14 17:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `t_antrian`
--

CREATE TABLE IF NOT EXISTS `t_antrian` (
`ANTRIAN_ID` int(10) NOT NULL,
  `TRX_DATE` datetime NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `ANTRIAN_NO` varchar(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `LOKETNO` int(11) DEFAULT NULL,
  `SERVICED_BY` varchar(50) DEFAULT NULL,
  `SERVICED_STARTDATE` datetime DEFAULT NULL,
  `SERVICED_ENDDATE` datetime DEFAULT NULL,
  `PLAZA_CD` varchar(50) NOT NULL,
  `REMARK` varchar(150) DEFAULT NULL,
  `CREATED_WHO` varchar(50) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CHANGE_WHO` varchar(50) DEFAULT NULL,
  `CHANGE_DATE` datetime DEFAULT NULL,
  `UPLOAD_FLAG` varchar(1) DEFAULT NULL,
  `KODE` varchar(10) NOT NULL,
  `NO` varchar(10) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=159 ;

--
-- Dumping data for table `t_antrian`
--

INSERT INTO `t_antrian` (`ANTRIAN_ID`, `TRX_DATE`, `TYPE`, `ANTRIAN_NO`, `STATUS`, `LOKETNO`, `SERVICED_BY`, `SERVICED_STARTDATE`, `SERVICED_ENDDATE`, `PLAZA_CD`, `REMARK`, `CREATED_WHO`, `CREATED_DATE`, `CHANGE_WHO`, `CHANGE_DATE`, `UPLOAD_FLAG`, `KODE`, `NO`) VALUES
(1, '2018-05-21 13:09:11', 'KONSULTASI', 'A1', 'CLOSE', 1, '51', '2018-05-21 01:09:25', NULL, '', NULL, '', '2018-05-21 13:09:11', NULL, NULL, NULL, 'A', '1'),
(2, '2018-05-21 13:09:14', 'PEMBETULAN', 'B1', 'CLOSE', 1, '51', '2018-05-21 01:09:36', NULL, '', NULL, '', '2018-05-21 13:09:14', NULL, NULL, NULL, 'B', '1'),
(3, '2018-05-21 13:09:15', 'MUTASI', 'C1', 'CLOSE', 1, '51', '2018-05-21 01:09:47', NULL, '', NULL, '', '2018-05-21 13:09:15', NULL, NULL, NULL, 'C', '1'),
(4, '2018-05-21 13:09:17', 'KONSULTASI', 'A2', 'CLOSE', 1, '51', '2018-05-21 01:52:22', NULL, '', NULL, '', '2018-05-21 13:09:17', NULL, NULL, NULL, 'A', '2'),
(5, '2018-05-21 13:09:20', 'PEMBETULAN', 'B2', 'CLOSE', 1, '51', '2018-05-21 01:52:38', NULL, '', NULL, '', '2018-05-21 13:09:20', NULL, NULL, NULL, 'B', '2'),
(6, '2018-05-21 13:53:14', 'KONSULTASI', 'A301', 'CLOSE', 1, '51', '2018-05-21 01:53:25', NULL, '', NULL, '', '2018-05-21 13:53:14', NULL, NULL, NULL, 'A', '3'),
(7, '2018-05-21 13:53:17', 'PEMBETULAN', 'B30', 'CLOSE', 1, '51', '2018-05-21 01:53:27', NULL, '', NULL, '', '2018-05-21 13:53:17', NULL, NULL, NULL, 'B', '3'),
(8, '2018-05-21 13:53:19', 'MUTASI', 'C2', 'CLOSE', 1, '51', '2018-05-21 02:32:57', NULL, '', NULL, '', '2018-05-21 13:53:19', NULL, NULL, NULL, 'C', '2'),
(9, '2018-05-21 13:53:56', 'KONSULTASI', 'A409', 'INPROGRESS', 1, '51', '2018-05-21 02:47:14', NULL, '', NULL, '', '2018-05-21 13:53:56', NULL, NULL, NULL, 'A', '4'),
(10, '2018-05-21 13:53:59', 'PEMBETULAN', 'B4', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 13:53:59', NULL, NULL, NULL, 'B', '4'),
(11, '2018-05-21 16:03:00', 'KONSULTASI', 'A5', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 16:03:00', NULL, NULL, NULL, 'A', '5'),
(12, '2018-05-21 18:01:02', 'KONSULTASI', 'A6', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:01:02', NULL, NULL, NULL, 'A', '6'),
(13, '2018-05-21 18:03:19', 'KONSULTASI', 'A7', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:03:19', NULL, NULL, NULL, 'A', '7'),
(14, '2018-05-21 18:03:29', 'KONSULTASI', 'A8', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:03:29', NULL, NULL, NULL, 'A', '8'),
(15, '2018-05-21 18:03:38', 'KONSULTASI', 'A9', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:03:38', NULL, NULL, NULL, 'A', '9'),
(16, '2018-05-21 18:03:45', 'KONSULTASI', 'A10', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:03:45', NULL, NULL, NULL, 'A', '10'),
(17, '2018-05-21 18:04:10', 'KONSULTASI', 'A11', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:04:10', NULL, NULL, NULL, 'A', '11'),
(18, '2018-05-21 18:09:55', 'KONSULTASI', 'A12', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:09:55', NULL, NULL, NULL, 'A', '12'),
(19, '2018-05-21 18:16:01', 'KONSULTASI', 'A13', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:16:01', NULL, NULL, NULL, 'A', '13'),
(20, '2018-05-21 18:16:19', 'KONSULTASI', 'A14', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:16:19', NULL, NULL, NULL, 'A', '14'),
(21, '2018-05-21 18:17:14', 'KONSULTASI', 'A15', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:17:14', NULL, NULL, NULL, 'A', '15'),
(22, '2018-05-21 18:17:29', 'KONSULTASI', 'A16', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:17:29', NULL, NULL, NULL, 'A', '16'),
(23, '2018-05-21 18:17:38', 'KONSULTASI', 'A17', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:17:38', NULL, NULL, NULL, 'A', '17'),
(24, '2018-05-21 18:17:52', 'KONSULTASI', 'A18', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:17:52', NULL, NULL, NULL, 'A', '18'),
(25, '2018-05-21 18:18:03', 'KONSULTASI', 'A19', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:03', NULL, NULL, NULL, 'A', '19'),
(26, '2018-05-21 18:18:26', 'KONSULTASI', 'A20', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:26', NULL, NULL, NULL, 'A', '20'),
(27, '2018-05-21 18:18:44', 'KONSULTASI', 'A21', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:44', NULL, NULL, NULL, 'A', '21'),
(28, '2018-05-21 18:18:45', 'KONSULTASI', 'A22', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:45', NULL, NULL, NULL, 'A', '22'),
(29, '2018-05-21 18:18:46', 'KONSULTASI', 'A23', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:46', NULL, NULL, NULL, 'A', '23'),
(30, '2018-05-21 18:18:47', 'KONSULTASI', 'A24', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:47', NULL, NULL, NULL, 'A', '24'),
(31, '2018-05-21 18:18:48', 'KONSULTASI', 'A25', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:48', NULL, NULL, NULL, 'A', '25'),
(32, '2018-05-21 18:18:48', 'KONSULTASI', 'A26', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:48', NULL, NULL, NULL, 'A', '26'),
(33, '2018-05-21 18:18:48', 'KONSULTASI', 'A27', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:48', NULL, NULL, NULL, 'A', '27'),
(34, '2018-05-21 18:18:54', 'KONSULTASI', 'A28', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:54', NULL, NULL, NULL, 'A', '28'),
(35, '2018-05-21 18:18:54', 'KONSULTASI', 'A29', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:54', NULL, NULL, NULL, 'A', '29'),
(36, '2018-05-21 18:18:54', 'KONSULTASI', 'A30', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:18:54', NULL, NULL, NULL, 'A', '30'),
(37, '2018-05-21 18:19:04', 'KONSULTASI', 'A31', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:19:04', NULL, NULL, NULL, 'A', '31'),
(38, '2018-05-21 18:19:08', 'PEMBETULAN', 'B5', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:19:08', NULL, NULL, NULL, 'B', '5'),
(39, '2018-05-21 18:19:09', 'PEMBETULAN', 'B6', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:19:09', NULL, NULL, NULL, 'B', '6'),
(40, '2018-05-21 18:29:06', 'KONSULTASI', 'A32', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:29:06', NULL, NULL, NULL, 'A', '32'),
(41, '2018-05-21 18:34:05', 'KONSULTASI', 'A33', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-21 18:34:05', NULL, NULL, NULL, 'A', '33'),
(42, '2018-05-23 23:07:07', 'KONSULTASI', 'A1', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:07:07', NULL, NULL, NULL, 'A', '1'),
(43, '2018-05-23 23:08:34', 'KONSULTASI', 'A2', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:08:34', NULL, NULL, NULL, 'A', '2'),
(44, '2018-05-23 23:08:48', 'PEMBAYARAN', 'D1', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:08:48', NULL, NULL, NULL, 'D', '1'),
(45, '2018-05-23 23:09:06', 'MUTASI', 'C1', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:09:06', NULL, NULL, NULL, 'C', '1'),
(46, '2018-05-23 23:09:55', 'MUTASI', 'C2', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:09:55', NULL, NULL, NULL, 'C', '2'),
(47, '2018-05-23 23:13:36', 'PEMBETULAN', 'B1', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:13:36', NULL, NULL, NULL, 'B', '1'),
(48, '2018-05-23 23:15:15', 'MUTASI', 'C3', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:15:15', NULL, NULL, NULL, 'C', '3'),
(49, '2018-05-23 23:16:29', 'PEMBETULAN', 'B2', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:16:29', NULL, NULL, NULL, 'B', '2'),
(50, '2018-05-23 23:17:49', 'PEMBAYARAN', 'D2', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:17:49', NULL, NULL, NULL, 'D', '2'),
(51, '2018-05-23 23:20:40', 'PEMBETULAN', 'B3', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:20:40', NULL, NULL, NULL, 'B', '3'),
(52, '2018-05-23 23:26:30', 'PEMBAYARAN', 'D3', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:26:30', NULL, NULL, NULL, 'D', '3'),
(53, '2018-05-23 23:33:24', 'MUTASI', 'C4', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:33:24', NULL, NULL, NULL, 'C', '4'),
(54, '2018-05-23 23:34:40', 'KONSULTASI', 'A3', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:34:40', NULL, NULL, NULL, 'A', '3'),
(55, '2018-05-23 23:36:13', 'PEMBAYARAN', 'D4', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:36:13', NULL, NULL, NULL, 'D', '4'),
(56, '2018-05-23 23:38:20', 'KONSULTASI', 'A4', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:38:20', NULL, NULL, NULL, 'A', '4'),
(57, '2018-05-23 23:39:14', 'MUTASI', 'C5', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:39:14', NULL, NULL, NULL, 'C', '5'),
(58, '2018-05-23 23:40:18', 'MUTASI', 'C6', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:40:18', NULL, NULL, NULL, 'C', '6'),
(59, '2018-05-23 23:52:13', 'KONSULTASI', 'A5', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-05-23 23:52:13', NULL, NULL, NULL, 'A', '5'),
(60, '2018-06-03 09:09:29', 'KONSULTASI', 'A1', 'CLOSE', 1, '51', '2018-06-03 09:09:55', NULL, '', NULL, '', '2018-06-03 09:09:29', NULL, NULL, NULL, 'A', '1'),
(61, '2018-06-03 09:09:41', 'PEMBETULAN', 'B1', 'CLOSE', 1, '51', '2018-06-03 09:10:08', NULL, '', NULL, '', '2018-06-03 09:09:41', NULL, NULL, NULL, 'B', '1'),
(62, '2018-06-03 09:09:44', 'MUTASI', 'C1', 'CLOSE', 1, '51', '2018-06-03 09:10:32', NULL, '', NULL, '', '2018-06-03 09:09:44', NULL, NULL, NULL, 'C', '1'),
(63, '2018-06-03 09:09:47', 'PEMBAYARAN', 'D1', 'CLOSE', 2, '39', '2018-06-03 09:14:26', NULL, '', NULL, '', '2018-06-03 09:09:47', NULL, NULL, NULL, 'D', '1'),
(64, '2018-06-03 09:13:52', 'KONSULTASI', 'A2', 'CLOSE', 1, '51', '2018-06-03 09:14:40', NULL, '', NULL, '', '2018-06-03 09:13:52', NULL, NULL, NULL, 'A', '2'),
(65, '2018-06-03 09:13:57', 'PEMBETULAN', 'B2', 'CLOSE', 1, '51', '2018-06-03 09:16:04', NULL, '', NULL, '', '2018-06-03 09:13:57', NULL, NULL, NULL, 'B', '2'),
(66, '2018-06-03 09:14:00', 'MUTASI', 'C2', 'CLOSE', 2, '39', '2018-06-03 09:14:52', NULL, '', NULL, '', '2018-06-03 09:14:00', NULL, NULL, NULL, 'C', '2'),
(67, '2018-06-03 09:14:02', 'PEMBAYARAN', 'D2', 'CLOSE', 2, '39', '2018-06-03 09:16:03', NULL, '', NULL, '', '2018-06-03 09:14:02', NULL, NULL, NULL, 'D', '2'),
(68, '2018-06-03 09:16:25', 'KONSULTASI', 'A3', 'CLOSE', 1, '51', '2018-06-03 09:17:14', NULL, '', NULL, '', '2018-06-03 09:16:25', NULL, NULL, NULL, 'A', '3'),
(69, '2018-06-03 09:16:33', 'PEMBETULAN', 'B3', 'CLOSE', 1, '51', '2018-06-03 09:19:52', NULL, '', NULL, '', '2018-06-03 09:16:33', NULL, NULL, NULL, 'B', '3'),
(70, '2018-06-03 09:16:42', 'MUTASI', 'C3', 'CLOSE', 2, '39', '2018-06-03 09:16:57', NULL, '', NULL, '', '2018-06-03 09:16:42', NULL, NULL, NULL, 'C', '3'),
(71, '2018-06-03 09:16:48', 'PEMBAYARAN', 'D3', 'CLOSE', 2, '39', '2018-06-03 09:17:13', NULL, '', NULL, '', '2018-06-03 09:16:48', NULL, NULL, NULL, 'D', '3'),
(72, '2018-06-03 09:17:34', 'PEMBAYARAN', 'D4', 'CLOSE', 2, '39', '2018-06-03 09:19:51', NULL, '', NULL, '', '2018-06-03 09:17:34', NULL, NULL, NULL, 'D', '4'),
(73, '2018-06-03 09:19:58', 'PEMBAYARAN', 'D5', 'CLOSE', 2, '39', '2018-06-03 09:20:42', NULL, '', NULL, '', '2018-06-03 09:19:58', NULL, NULL, NULL, 'D', '5'),
(74, '2018-06-03 09:20:01', 'MUTASI', 'C4', 'CLOSE', 1, '51', '2018-06-03 09:20:22', NULL, '', NULL, '', '2018-06-03 09:20:01', NULL, NULL, NULL, 'C', '4'),
(76, '2018-06-03 09:20:47', 'MUTASI', 'C6', 'INPROGRESS', 2, '39', '2018-06-03 09:20:53', NULL, '', NULL, '', '2018-06-03 09:20:47', NULL, NULL, NULL, 'C', '6'),
(77, '2018-06-03 09:37:06', 'MUTASI', 'C6', 'CLOSE', 1, '51', '2018-06-03 09:37:18', NULL, '', NULL, '', '2018-06-03 09:37:06', NULL, NULL, NULL, 'C', '6'),
(78, '2018-06-03 09:37:21', 'PEMBAYARAN', 'D6', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-03 09:37:21', NULL, NULL, NULL, 'D', '6'),
(79, '2018-06-03 09:37:26', 'MUTASI', 'C7', 'CLOSE', 1, '51', '2018-06-03 09:37:35', NULL, '', NULL, '', '2018-06-03 09:37:26', NULL, NULL, NULL, 'C', '7'),
(80, '2018-06-03 09:37:28', 'PEMBAYARAN', 'D7', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-03 09:37:28', NULL, NULL, NULL, 'D', '7'),
(81, '2018-06-03 09:37:31', 'MUTASI', 'C8', 'CLOSE', 1, '51', '2018-06-03 09:37:45', NULL, '', NULL, '', '2018-06-03 09:37:31', NULL, NULL, NULL, 'C', '8'),
(82, '2018-06-03 09:37:47', 'PEMBETULAN', 'B4', 'CLOSE', 1, '51', '2018-06-03 09:37:56', NULL, '', NULL, '', '2018-06-03 09:37:47', NULL, NULL, NULL, 'B', '4'),
(83, '2018-06-03 09:37:50', 'KONSULTASI', 'A4', 'CLOSE', 1, '51', '2018-06-03 09:38:14', NULL, '', NULL, '', '2018-06-03 09:37:50', NULL, NULL, NULL, 'A', '4'),
(84, '2018-06-03 09:37:52', 'PEMBETULAN', 'B5', 'INPROGRESS', 1, '51', '2018-06-03 10:16:39', NULL, '', NULL, '', '2018-06-03 09:37:52', NULL, NULL, NULL, 'B', '5'),
(85, '2018-06-03 15:51:57', 'KONSULTASI', 'A5', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-03 15:51:57', NULL, NULL, NULL, 'A', '5'),
(86, '2018-06-04 13:40:28', 'KONSULTASI', 'A1', 'CLOSE', 1, '51', '2018-06-04 01:46:07', NULL, '', NULL, '', '2018-06-04 13:40:28', NULL, NULL, NULL, 'A', '1'),
(87, '2018-06-04 13:40:34', 'PEMBETULAN', 'B1', 'CLOSE', 1, '51', '2018-06-04 01:56:33', NULL, '', NULL, '', '2018-06-04 13:40:34', NULL, NULL, NULL, 'B', '1'),
(88, '2018-06-04 13:56:22', 'PEMBAYARAN', 'D1', 'CLOSE', 2, '39', '2018-06-04 01:59:04', NULL, '', NULL, '', '2018-06-04 13:56:22', NULL, NULL, NULL, 'D', '1'),
(89, '2018-06-04 13:56:46', 'MUTASI', 'C1', 'CLOSE', 1, '51', '2018-06-04 01:57:22', NULL, '', NULL, '', '2018-06-04 13:56:46', NULL, NULL, NULL, 'C', '1'),
(90, '2018-06-04 13:57:31', 'MUTASI', 'C2', 'CLOSE', 1, '51', '2018-06-04 01:57:39', NULL, '', NULL, '', '2018-06-04 13:57:31', NULL, NULL, NULL, 'C', '2'),
(91, '2018-06-04 13:59:10', 'MUTASI', 'C3', 'INPROGRESS', 2, '39', '2018-06-04 03:36:22', NULL, '', NULL, '', '2018-06-04 13:59:10', NULL, NULL, NULL, 'C', '3'),
(92, '2018-06-04 13:59:16', 'MUTASI', 'C4', 'CLOSE', 1, '51', '2018-06-04 03:33:36', NULL, '', NULL, '', '2018-06-04 13:59:16', NULL, NULL, NULL, 'C', '4'),
(93, '2018-06-04 14:24:30', 'KONSULTASI', 'A2', 'CLOSE', 1, '51', '2018-06-04 03:34:38', NULL, '', NULL, '', '2018-06-04 14:24:30', NULL, NULL, NULL, 'A', '2'),
(94, '2018-06-04 14:25:01', 'KONSULTASI', 'A3', 'CLOSE', 1, '51', '2018-06-04 04:12:46', NULL, '', NULL, '', '2018-06-04 14:25:01', NULL, NULL, NULL, 'A', '3'),
(95, '2018-06-04 14:26:21', 'PEMBETULAN', 'B2', 'CLOSE', 1, '51', '2018-06-04 04:14:26', NULL, '', NULL, '', '2018-06-04 14:26:21', NULL, NULL, NULL, 'B', '2'),
(96, '2018-06-04 14:27:14', 'KONSULTASI', 'A4', 'CLOSE', 1, '51', '2018-06-04 04:24:52', NULL, '', NULL, '', '2018-06-04 14:27:14', NULL, NULL, NULL, 'A', '4'),
(97, '2018-06-04 14:28:50', 'KONSULTASI', 'A5', 'CLOSE', 1, '51', '2018-06-04 04:25:56', NULL, '', NULL, '', '2018-06-04 14:28:50', NULL, NULL, NULL, 'A', '5'),
(98, '2018-06-04 14:29:51', 'KONSULTASI', 'A6', 'CLOSE', 1, '51', '2018-06-04 04:29:27', NULL, '', NULL, '', '2018-06-04 14:29:51', NULL, NULL, NULL, 'A', '6'),
(99, '2018-06-04 14:32:37', 'KONSULTASI', 'A7', 'CLOSE', 1, '51', '2018-06-04 04:29:36', NULL, '', NULL, '', '2018-06-04 14:32:37', NULL, NULL, NULL, 'A', '7'),
(100, '2018-06-04 14:32:49', 'KONSULTASI', 'A8', 'CLOSE', 1, '51', '2018-06-04 04:29:44', NULL, '', NULL, '', '2018-06-04 14:32:49', NULL, NULL, NULL, 'A', '8'),
(101, '2018-06-04 14:33:06', 'KONSULTASI', 'A9', 'CLOSE', 1, '51', '2018-06-04 04:32:16', NULL, '', NULL, '', '2018-06-04 14:33:06', NULL, NULL, NULL, 'A', '9'),
(102, '2018-06-04 14:33:26', 'KONSULTASI', 'A10', 'CLOSE', 1, '51', '2018-06-04 04:32:30', NULL, '', NULL, '', '2018-06-04 14:33:26', NULL, NULL, NULL, 'A', '10'),
(103, '2018-06-04 14:34:20', 'KONSULTASI', 'A11', 'CLOSE', 1, '51', '2018-06-04 04:34:39', NULL, '', NULL, '', '2018-06-04 14:34:20', NULL, NULL, NULL, 'A', '11'),
(104, '2018-06-04 14:34:29', 'KONSULTASI', 'A12', 'CLOSE', 1, '51', '2018-06-04 04:34:59', NULL, '', NULL, '', '2018-06-04 14:34:29', NULL, NULL, NULL, 'A', '12'),
(105, '2018-06-04 14:36:39', 'KONSULTASI', 'A13', 'CLOSE', 1, '51', '2018-06-04 04:37:01', NULL, '', NULL, '', '2018-06-04 14:36:39', NULL, NULL, NULL, 'A', '13'),
(106, '2018-06-04 14:36:50', 'KONSULTASI', 'A14', 'CLOSE', 1, '51', '2018-06-04 04:41:40', NULL, '', NULL, '', '2018-06-04 14:36:50', NULL, NULL, NULL, 'A', '14'),
(107, '2018-06-04 14:37:05', 'KONSULTASI', 'A15', 'CLOSE', 1, '51', '2018-06-04 04:42:09', NULL, '', NULL, '', '2018-06-04 14:37:05', NULL, NULL, NULL, 'A', '15'),
(108, '2018-06-04 14:37:16', 'PEMBETULAN', 'B3', 'CLOSE', 1, '51', '2018-06-04 04:42:19', NULL, '', NULL, '', '2018-06-04 14:37:16', NULL, NULL, NULL, 'B', '3'),
(109, '2018-06-04 14:38:07', 'KONSULTASI', 'A16', 'CLOSE', 1, '51', '2018-06-04 04:45:37', NULL, '', NULL, '', '2018-06-04 14:38:07', NULL, NULL, NULL, 'A', '16'),
(110, '2018-06-04 14:42:04', 'KONSULTASI', 'A17', 'CLOSE', 1, '51', '2018-06-04 04:47:04', NULL, '', NULL, '', '2018-06-04 14:42:04', NULL, NULL, NULL, 'A', '17'),
(111, '2018-06-04 14:42:53', 'KONSULTASI', 'A18', 'CLOSE', 1, '51', '2018-06-04 04:49:45', NULL, '', NULL, '', '2018-06-04 14:42:53', NULL, NULL, NULL, 'A', '18'),
(112, '2018-06-04 14:43:15', 'KONSULTASI', 'A19', 'CLOSE', 1, '51', '2018-06-04 04:50:10', NULL, '', NULL, '', '2018-06-04 14:43:15', NULL, NULL, NULL, 'A', '19'),
(113, '2018-06-04 14:45:57', 'KONSULTASI', 'A20', 'CLOSE', 1, '51', '2018-06-04 04:50:27', NULL, '', NULL, '', '2018-06-04 14:45:57', NULL, NULL, NULL, 'A', '20'),
(114, '2018-06-04 14:47:23', 'PEMBETULAN', 'B4', 'CLOSE', 1, '51', '2018-06-04 04:51:29', NULL, '', NULL, '', '2018-06-04 14:47:23', NULL, NULL, NULL, 'B', '4'),
(115, '2018-06-04 14:51:44', 'KONSULTASI', 'A21', 'CLOSE', 1, '51', '2018-06-04 04:52:01', NULL, '', NULL, '', '2018-06-04 14:51:44', NULL, NULL, NULL, 'A', '21'),
(116, '2018-06-04 14:53:31', 'MUTASI', 'C5', 'CLOSE', 1, '51', '2018-06-04 04:52:28', NULL, '', NULL, '', '2018-06-04 14:53:31', NULL, NULL, NULL, 'C', '5'),
(117, '2018-06-04 14:54:07', 'PEMBETULAN', 'B5', 'CLOSE', 1, '51', '2018-06-04 04:52:40', NULL, '', NULL, '', '2018-06-04 14:54:07', NULL, NULL, NULL, 'B', '5'),
(118, '2018-06-04 14:55:11', 'PEMBAYARAN', 'D2', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 14:55:11', NULL, NULL, NULL, 'D', '2'),
(119, '2018-06-04 14:56:00', 'PEMBETULAN', 'B6', 'CLOSE', 1, '51', '2018-06-04 04:52:56', NULL, '', NULL, '', '2018-06-04 14:56:00', NULL, NULL, NULL, 'B', '6'),
(120, '2018-06-04 14:57:27', 'PEMBETULAN', 'B7', 'CLOSE', 1, '51', '2018-06-04 04:55:48', NULL, '', NULL, '', '2018-06-04 14:57:27', NULL, NULL, NULL, 'B', '7'),
(121, '2018-06-04 14:57:51', 'KONSULTASI', 'A22', 'CLOSE', 1, '51', '2018-06-04 04:56:50', NULL, '', NULL, '', '2018-06-04 14:57:51', NULL, NULL, NULL, 'A', '22'),
(122, '2018-06-04 14:58:31', 'KONSULTASI', 'A23', 'CLOSE', 1, '51', '2018-06-04 05:00:12', NULL, '', NULL, '', '2018-06-04 14:58:31', NULL, NULL, NULL, 'A', '23'),
(123, '2018-06-04 14:58:57', 'KONSULTASI', 'A24', 'CLOSE', 1, '51', '2018-06-04 05:06:15', NULL, '', NULL, '', '2018-06-04 14:58:57', NULL, NULL, NULL, 'A', '24'),
(124, '2018-06-04 14:59:10', 'KONSULTASI', 'A25', 'CLOSE', 1, '51', '2018-06-04 05:07:40', NULL, '', NULL, '', '2018-06-04 14:59:10', NULL, NULL, NULL, 'A', '25'),
(125, '2018-06-04 15:01:18', 'KONSULTASI', 'A26', 'CLOSE', 1, '51', '2018-06-04 05:20:22', NULL, '', NULL, '', '2018-06-04 15:01:18', NULL, NULL, NULL, 'A', '26'),
(126, '2018-06-04 15:30:26', 'KONSULTASI', 'A27', 'CLOSE', 1, '51', '2018-06-04 05:20:32', NULL, '', NULL, '', '2018-06-04 15:30:26', NULL, NULL, NULL, 'A', '27'),
(127, '2018-06-04 15:39:53', 'KONSULTASI', 'A28', 'CLOSE', 1, '51', '2018-06-04 05:20:41', NULL, '', NULL, '', '2018-06-04 15:39:53', NULL, NULL, NULL, 'A', '28'),
(128, '2018-06-04 15:50:54', 'KONSULTASI', 'A29', 'CLOSE', 1, '51', '2018-06-04 05:20:50', NULL, '', NULL, '', '2018-06-04 15:50:54', NULL, NULL, NULL, 'A', '29'),
(129, '2018-06-04 15:50:56', 'KONSULTASI', 'A30', 'CLOSE', 1, '51', '2018-06-04 05:21:03', NULL, '', NULL, '', '2018-06-04 15:50:56', NULL, NULL, NULL, 'A', '30'),
(130, '2018-06-04 15:51:45', 'KONSULTASI', 'A31', 'CLOSE', 1, '51', '2018-06-04 05:21:36', NULL, '', NULL, '', '2018-06-04 15:51:45', NULL, NULL, NULL, 'A', '31'),
(131, '2018-06-04 15:51:51', 'KONSULTASI', 'A32', 'CLOSE', 1, '51', '2018-06-04 05:21:40', NULL, '', NULL, '', '2018-06-04 15:51:51', NULL, NULL, NULL, 'A', '32'),
(132, '2018-06-04 15:51:59', 'KONSULTASI', 'A33', 'CLOSE', 1, '51', '2018-06-04 05:21:49', NULL, '', NULL, '', '2018-06-04 15:51:59', NULL, NULL, NULL, 'A', '33'),
(133, '2018-06-04 15:52:24', 'KONSULTASI', 'A34', 'CLOSE', 1, '51', '2018-06-04 05:22:14', NULL, '', NULL, '', '2018-06-04 15:52:24', NULL, NULL, NULL, 'A', '34'),
(134, '2018-06-04 15:52:26', 'KONSULTASI', 'A35', 'CLOSE', 1, '51', '2018-06-04 05:23:07', NULL, '', NULL, '', '2018-06-04 15:52:26', NULL, NULL, NULL, 'A', '35'),
(135, '2018-06-04 15:52:26', 'KONSULTASI', 'A36', 'CLOSE', 1, '51', '2018-06-04 05:23:31', NULL, '', NULL, '', '2018-06-04 15:52:26', NULL, NULL, NULL, 'A', '36'),
(136, '2018-06-04 15:52:27', 'KONSULTASI', 'A37', 'CLOSE', 1, '51', '2018-06-04 05:23:59', NULL, '', NULL, '', '2018-06-04 15:52:27', NULL, NULL, NULL, 'A', '37'),
(137, '2018-06-04 15:52:27', 'PEMBETULAN', 'B8', 'CLOSE', 1, '51', '2018-06-04 05:24:29', NULL, '', NULL, '', '2018-06-04 15:52:27', NULL, NULL, NULL, 'B', '8'),
(138, '2018-06-04 15:52:28', 'PEMBETULAN', 'B9', 'CLOSE', 1, '51', '2018-06-04 05:24:57', NULL, '', NULL, '', '2018-06-04 15:52:28', NULL, NULL, NULL, 'B', '9'),
(139, '2018-06-04 15:52:36', 'PEMBETULAN', 'B10', 'CLOSE', 1, '51', '2018-06-04 05:25:00', NULL, '', NULL, '', '2018-06-04 15:52:36', NULL, NULL, NULL, 'B', '10'),
(140, '2018-06-04 15:52:37', 'PEMBETULAN', 'B11', 'CLOSE', 1, '51', '2018-06-04 05:25:46', NULL, '', NULL, '', '2018-06-04 15:52:37', NULL, NULL, NULL, 'B', '11'),
(141, '2018-06-04 15:52:38', 'PEMBETULAN', 'B12', 'INPROGRESS', 1, '51', '2018-06-04 05:28:44', NULL, '', NULL, '', '2018-06-04 15:52:38', NULL, NULL, NULL, 'B', '12'),
(142, '2018-06-04 15:52:58', 'PEMBETULAN', 'B13', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 15:52:58', NULL, NULL, NULL, 'B', '13'),
(143, '2018-06-04 15:53:11', 'PEMBETULAN', 'B14', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 15:53:11', NULL, NULL, NULL, 'B', '14'),
(144, '2018-06-04 15:53:14', 'MUTASI', 'C6', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 15:53:14', NULL, NULL, NULL, 'C', '6'),
(145, '2018-06-04 15:53:15', 'KONSULTASI', 'A38', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 15:53:15', NULL, NULL, NULL, 'A', '38'),
(146, '2018-06-04 15:53:23', 'KONSULTASI', 'A39', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 15:53:23', NULL, NULL, NULL, 'A', '39'),
(147, '2018-06-04 15:55:56', 'KONSULTASI', 'A40', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 15:55:56', NULL, NULL, NULL, 'A', '40'),
(148, '2018-06-04 15:56:39', 'MUTASI', 'C7', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 15:56:39', NULL, NULL, NULL, 'C', '7'),
(149, '2018-06-04 16:36:53', 'KONSULTASI', 'A41', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 16:36:53', NULL, NULL, NULL, 'A', '41'),
(150, '2018-06-04 16:37:09', 'PEMBETULAN', 'B15', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 16:37:09', NULL, NULL, NULL, 'B', '15'),
(151, '2018-06-04 16:37:24', 'PEMBETULAN', 'B16', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 16:37:24', NULL, NULL, NULL, 'B', '16'),
(152, '2018-06-04 16:37:26', 'MUTASI', 'C8', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 16:37:26', NULL, NULL, NULL, 'C', '8'),
(153, '2018-06-04 16:37:26', 'MUTASI', 'C9', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 16:37:26', NULL, NULL, NULL, 'C', '9'),
(154, '2018-06-04 16:37:27', 'PEMBAYARAN', 'D3', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 16:37:27', NULL, NULL, NULL, 'D', '3'),
(155, '2018-06-04 16:37:28', 'PEMBAYARAN', 'D4', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 16:37:28', NULL, NULL, NULL, 'D', '4'),
(156, '2018-06-04 17:20:07', 'MUTASI', 'C10', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 17:20:07', NULL, NULL, NULL, 'C', '10'),
(157, '2018-06-04 17:20:09', 'PEMBETULAN', 'B17', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 17:20:09', NULL, NULL, NULL, 'B', '17'),
(158, '2018-06-04 17:20:44', 'MUTASI', 'C11', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, '', '2018-06-04 17:20:44', NULL, NULL, NULL, 'C', '11');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_loket`
--

CREATE TABLE IF NOT EXISTS `t_jenis_loket` (
`JENIS_LOKET_ID` int(11) NOT NULL,
  `TYPE_LOKET` varchar(20) NOT NULL,
  `KODE_LOKET` varchar(2) NOT NULL,
  `STATUS` enum('Y','N','','') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `t_jenis_loket`
--

INSERT INTO `t_jenis_loket` (`JENIS_LOKET_ID`, `TYPE_LOKET`, `KODE_LOKET`, `STATUS`) VALUES
(1, 'KONSULTASI', 'A', 'Y'),
(2, 'PEMBETULAN', 'B', 'Y'),
(3, 'MUTASI', 'C', 'Y'),
(4, 'PEMBAYARAN', 'D', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_loket`
--

CREATE TABLE IF NOT EXISTS `t_loket` (
`LOKET_ID` int(11) NOT NULL,
  `NAMA_LOKET` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t_loket`
--

INSERT INTO `t_loket` (`LOKET_ID`, `NAMA_LOKET`) VALUES
(1, '1'),
(2, '10');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelatihan`
--

CREATE TABLE IF NOT EXISTS `t_pelatihan` (
`pelatihan_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(256) DEFAULT NULL,
  `tempat` varchar(64) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `lama` int(11) DEFAULT NULL,
  `sertifikat` varchar(32) DEFAULT NULL,
  `keterangan` varchar(1024) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=14 ;

--
-- Dumping data for table `t_pelatihan`
--

INSERT INTO `t_pelatihan` (`pelatihan_id`, `user_id`, `nama`, `tempat`, `tanggal`, `lama`, `sertifikat`, `keterangan`) VALUES
(1, 15, 'Pelatian CSR', 'Denpasar', '2007-12-17', 2, 'SER/../', ' '),
(2, 15, 'Pelatihan Plasa', 'Denpasar', '2007-12-16', 1, 'SER', ' '),
(3, 15, ' Pelatihan Ada deh', ' ', '2007-12-16', 3, ' ', ' '),
(4, 13, 'Pelatihan', ' ', '0000-00-00', 0, ' ', ' '),
(5, 13, 'test pelatihan', ' ', '0000-00-00', 0, ' ', ' '),
(7, 13, ' ', ' ', '0000-00-00', 0, ' ', ' '),
(8, 13, ' ', ' ', '0000-00-00', 0, ' ', ' '),
(10, 13, 'testing', ' ', '0000-00-00', 0, ' ', ' '),
(11, 13, 'testing lagi', ' ', '0000-00-00', 0, ' ', ' '),
(12, 15, 'nama', ' ', '0000-00-00', 0, ' ', ' '),
(13, 22, 'SAP', 'jakarta sela', '2008-02-01', 7, ' ', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `t_trx_code_temp`
--

CREATE TABLE IF NOT EXISTS `t_trx_code_temp` (
`trx_code_temp_id` int(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL,
  `value2` varchar(20) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `t_trx_code_temp`
--

INSERT INTO `t_trx_code_temp` (`trx_code_temp_id`, `code`, `value`, `value2`) VALUES
(1, 'LAST_ANTRIAN_A', '-', '-'),
(2, 'LAST_ANTRIAN_B', '-', '-'),
(3, 'LAST_ANTRIAN_C', '-', '-'),
(4, 'LAST_ANTRIAN_D', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_loket`
--

CREATE TABLE IF NOT EXISTS `t_user_loket` (
`USER_LOKET_ID` int(11) NOT NULL,
  `USER_ID` varchar(10) NOT NULL,
  `JENIS_LOKET_ID` varchar(10) NOT NULL,
  `LOKET_ID` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `t_user_loket`
--

INSERT INTO `t_user_loket` (`USER_LOKET_ID`, `USER_ID`, `JENIS_LOKET_ID`, `LOKET_ID`) VALUES
(30, '39', '3', 2),
(31, '39', '4', 2),
(32, '51', '1', 1),
(33, '51', '2', 1),
(34, '51', '3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_user_polling`
--

CREATE TABLE IF NOT EXISTS `t_user_polling` (
`USER_POLLING_ID` int(10) NOT NULL,
  `POLLING_ID` int(11) DEFAULT NULL,
  `TRX_DATE` datetime NOT NULL,
  `USER_COMMENT` varchar(1000) DEFAULT NULL,
  `STATUS` varchar(50) NOT NULL,
  `CREATED_WHO` varchar(50) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CHANGE_WHO` varchar(50) DEFAULT NULL,
  `CHANGE_DATE` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `t_user_polling`
--

INSERT INTO `t_user_polling` (`USER_POLLING_ID`, `POLLING_ID`, `TRX_DATE`, `USER_COMMENT`, `STATUS`, `CREATED_WHO`, `CREATED_DATE`, `CHANGE_WHO`, `CHANGE_DATE`) VALUES
(1, 2, '2017-11-21 10:10:28', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(2, 2, '2017-11-21 11:58:00', 'BIASA', '', '', '0000-00-00 00:00:00', NULL, NULL),
(3, 2, '2017-11-21 11:58:03', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(4, 2, '2017-11-21 18:21:01', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(5, 2, '2017-11-21 18:21:04', 'KURANG', '', '', '0000-00-00 00:00:00', NULL, NULL),
(6, 2, '2017-11-21 18:21:07', 'MENGECEWAKAN', '', '', '0000-00-00 00:00:00', NULL, NULL),
(7, 2, '2017-11-21 18:21:23', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(8, 2, '2017-11-22 19:49:12', 'KURANG', '', '', '0000-00-00 00:00:00', NULL, NULL),
(9, 2, '2017-11-22 19:49:12', 'MENGECEWAKAN', '', '', '0000-00-00 00:00:00', NULL, NULL),
(10, 2, '2017-11-22 19:51:39', 'MENGECEWAKAN', '', '', '0000-00-00 00:00:00', NULL, NULL),
(11, 2, '2017-11-22 20:00:03', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(12, 2, '2017-11-22 20:00:10', 'MENGECEWAKAN', '', '', '0000-00-00 00:00:00', NULL, NULL),
(13, 2, '2017-11-22 21:39:20', 'BIASA', '', '', '0000-00-00 00:00:00', NULL, NULL),
(14, 2, '2017-11-22 22:38:08', 'MENGECEWAKAN', '', '', '0000-00-00 00:00:00', NULL, NULL),
(15, 2, '2017-11-22 22:43:29', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(16, 2, '2017-11-22 23:28:02', 'MENGECEWAKAN', '', '', '0000-00-00 00:00:00', NULL, NULL),
(17, 2, '2018-05-08 07:32:07', 'Puas', '', '', '0000-00-00 00:00:00', NULL, NULL),
(18, 2, '2018-05-08 07:32:09', 'Biasa', '', '', '0000-00-00 00:00:00', NULL, NULL),
(19, 2, '2018-05-08 07:32:23', 'Puas', '', '', '0000-00-00 00:00:00', NULL, NULL),
(20, 2, '2018-05-08 07:33:51', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(21, 2, '2018-05-08 07:40:28', 'MENGECEWAKAN', '', '', '0000-00-00 00:00:00', NULL, NULL),
(22, 2, '2018-05-08 07:42:59', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(23, 2, '2018-05-08 07:43:05', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(24, 2, '2018-05-08 07:46:28', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(25, 2, '2018-05-08 07:46:40', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(26, 2, '2018-05-08 07:46:54', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(27, 2, '2018-05-08 07:46:58', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(28, 2, '2018-05-08 07:47:12', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(29, 2, '2018-05-08 07:47:14', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(30, 2, '2018-05-08 07:49:54', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(31, 2, '2018-05-08 07:50:07', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(32, 2, '2018-05-08 07:50:23', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(33, 2, '2018-05-08 07:50:32', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(34, 2, '2018-05-08 07:50:45', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(35, 2, '2018-05-08 07:51:13', 'KURANG', '', '', '0000-00-00 00:00:00', NULL, NULL),
(36, 2, '2018-05-08 08:42:57', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(37, 2, '2018-05-08 11:55:45', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(38, 2, '2018-05-08 11:58:29', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(39, 2, '2018-05-10 12:10:33', 'PUAS', '', '', '0000-00-00 00:00:00', NULL, NULL),
(40, 2, '2018-05-10 12:11:18', 'KURANG', '', '', '2018-05-10 12:11:18', NULL, NULL),
(41, 2, '2018-05-14 04:30:12', 'PUAS', '', '', '2018-05-14 04:30:12', NULL, NULL),
(42, 2, '2018-05-14 07:00:18', 'PUAS', '', '', '2018-05-14 07:00:18', NULL, NULL),
(43, 2, '2018-06-04 05:21:34', 'BIASA', '', '', '2018-06-04 05:21:34', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_banner_text`
--
ALTER TABLE `m_banner_text`
 ADD PRIMARY KEY (`banner_text_id`);

--
-- Indexes for table `m_content`
--
ALTER TABLE `m_content`
 ADD PRIMARY KEY (`CONTENT_ID`);

--
-- Indexes for table `m_datel`
--
ALTER TABLE `m_datel`
 ADD PRIMARY KEY (`DATEL_ID`);

--
-- Indexes for table `m_plaza`
--
ALTER TABLE `m_plaza`
 ADD PRIMARY KEY (`PLAZA_ID`);

--
-- Indexes for table `m_polling`
--
ALTER TABLE `m_polling`
 ADD PRIMARY KEY (`polling_id`);

--
-- Indexes for table `m_request_command`
--
ALTER TABLE `m_request_command`
 ADD PRIMARY KEY (`REQUEST_COMMAND_ID`);

--
-- Indexes for table `s_lov_value`
--
ALTER TABLE `s_lov_value`
 ADD PRIMARY KEY (`LOV_VALUE_ID`);

--
-- Indexes for table `s_user`
--
ALTER TABLE `s_user`
 ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `t_antrian`
--
ALTER TABLE `t_antrian`
 ADD PRIMARY KEY (`ANTRIAN_ID`);

--
-- Indexes for table `t_jenis_loket`
--
ALTER TABLE `t_jenis_loket`
 ADD PRIMARY KEY (`JENIS_LOKET_ID`);

--
-- Indexes for table `t_loket`
--
ALTER TABLE `t_loket`
 ADD PRIMARY KEY (`LOKET_ID`);

--
-- Indexes for table `t_pelatihan`
--
ALTER TABLE `t_pelatihan`
 ADD PRIMARY KEY (`pelatihan_id`);

--
-- Indexes for table `t_trx_code_temp`
--
ALTER TABLE `t_trx_code_temp`
 ADD PRIMARY KEY (`trx_code_temp_id`);

--
-- Indexes for table `t_user_loket`
--
ALTER TABLE `t_user_loket`
 ADD PRIMARY KEY (`USER_LOKET_ID`);

--
-- Indexes for table `t_user_polling`
--
ALTER TABLE `t_user_polling`
 ADD PRIMARY KEY (`USER_POLLING_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_banner_text`
--
ALTER TABLE `m_banner_text`
MODIFY `banner_text_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `m_content`
--
ALTER TABLE `m_content`
MODIFY `CONTENT_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `m_datel`
--
ALTER TABLE `m_datel`
MODIFY `DATEL_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `m_plaza`
--
ALTER TABLE `m_plaza`
MODIFY `PLAZA_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `m_polling`
--
ALTER TABLE `m_polling`
MODIFY `polling_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_request_command`
--
ALTER TABLE `m_request_command`
MODIFY `REQUEST_COMMAND_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `s_lov_value`
--
ALTER TABLE `s_lov_value`
MODIFY `LOV_VALUE_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `s_user`
--
ALTER TABLE `s_user`
MODIFY `USER_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `t_antrian`
--
ALTER TABLE `t_antrian`
MODIFY `ANTRIAN_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `t_jenis_loket`
--
ALTER TABLE `t_jenis_loket`
MODIFY `JENIS_LOKET_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_loket`
--
ALTER TABLE `t_loket`
MODIFY `LOKET_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_pelatihan`
--
ALTER TABLE `t_pelatihan`
MODIFY `pelatihan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `t_trx_code_temp`
--
ALTER TABLE `t_trx_code_temp`
MODIFY `trx_code_temp_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_user_loket`
--
ALTER TABLE `t_user_loket`
MODIFY `USER_LOKET_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `t_user_polling`
--
ALTER TABLE `t_user_polling`
MODIFY `USER_POLLING_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
