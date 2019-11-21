-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2019 at 02:12 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banbanh`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SODONHH` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `MSHH` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `SOLUONG` smallint(6) NOT NULL,
  `GIADATHANG` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`SODONHH`, `MSHH`, `SOLUONG`, `GIADATHANG`) VALUES
('1', '2', 10, 290000),
('1', '3', 5, 145000),
('2', '3', 1, 29000);

-- --------------------------------------------------------

--
-- Table structure for table `dathang`
--

CREATE TABLE `dathang` (
  `SODONHH` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `MSNV` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `MSKH` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `NGAYDH` datetime NOT NULL,
  `TRANGTHAI` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `dathang`
--

INSERT INTO `dathang` (`SODONHH`, `MSNV`, `MSKH`, `NGAYDH`, `TRANGTHAI`) VALUES
('1', '1', '1', '2019-11-21 15:31:39', 'pending'),
('2', '1', '2', '2019-11-21 15:50:12', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `MANHOM` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENHH` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `GIA` int(11) NOT NULL,
  `SOLUONGHANG` int(11) NOT NULL,
  `HINH` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `MOTAHH` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `MANHOM`, `TENHH`, `GIA`, `SOLUONGHANG`, `HINH`, `MOTAHH`) VALUES
('1', '01', 'Banh bong lan trung muoi', 29000, 70, 'https://product.hstatic.net/1000075078/product/trungmui1_9abf7c43946b44e9948dbac1eff95e40_large.jpg', 'Banh bong lan trung muoi'),
('2', '01', 'Banh chocolate', 29000, 40, 'https://product.hstatic.net/1000075078/product/choco_1x1_4faf8c80e6604cad88ce30528e2bd409_large.jpg', 'Banh chocolate'),
('3', '01', 'Banh matcha', 29000, 24, 'https://product.hstatic.net/1000075078/product/matcha_178bdeeb1f9b47ea9f782048eb145f49_large.jpg', 'Banh matcha'),
('4', '01', 'Banh mi cha bong pho mai', 32000, 120, 'https://product.hstatic.net/1000075078/product/phomaichabong_1x1_e86c140c8a084458afcace64a93d2fd1_large.jpg', 'Banh mi cha bong pho mai'),
('5', '01', 'Americano', 29000, 100, 'https://product.hstatic.net/1000075078/product/americano_large.jpg', 'ÄÃ¢y lÃ  cafe, Ä‘Ã©o pháº£i bÃ¡nh. Äá»“ ngu!!');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `HOTENKH` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `DIACHI` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `SODIENTHOAI` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HOTENKH`, `DIACHI`, `SODIENTHOAI`) VALUES
('1', 'Phan Thanh Giáº£ng', 'VÄ©nh Long', '0868442808'),
('2', 'Tráº§n VÄƒn Khá»Ÿi', 'VÄ©nh Long', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `HOTENNV` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `CHUCVU` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `DIACHI` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `SODIENTHOAI` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HOTENNV`, `CHUCVU`, `DIACHI`, `SODIENTHOAI`) VALUES
('1', 'Phan Thanh Giang', 'Quan ly', 'Vinh Long', '0868442808');

-- --------------------------------------------------------

--
-- Table structure for table `nhomhanghoa`
--

CREATE TABLE `nhomhanghoa` (
  `MANHOM` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENNHOM` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `nhomhanghoa`
--

INSERT INTO `nhomhanghoa` (`MANHOM`, `TENNHOM`) VALUES
('01', 'Banh bong lan');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MSNV` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `TAIKHOAN` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `MATKHAU` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`MSNV`, `TAIKHOAN`, `MATKHAU`) VALUES
('1', 'giangphan', 'a940d8b1b4dbed2f777656fd0d965759d99c8ea9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`SODONHH`,`MSHH`),
  ADD KEY `FK_CTDH_HH` (`MSHH`);

--
-- Indexes for table `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SODONHH`),
  ADD KEY `FK_DH_KH` (`MSKH`),
  ADD KEY `FK_NV_DH` (`MSNV`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `FK_NHOMHANGHOA_HANGHOA` (`MANHOM`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- Indexes for table `nhomhanghoa`
--
ALTER TABLE `nhomhanghoa`
  ADD PRIMARY KEY (`MANHOM`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MSNV`),
  ADD KEY `AK_IDENTIFIER_1` (`MSNV`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `FK_CTDH_DH` FOREIGN KEY (`SODONHH`) REFERENCES `dathang` (`SODONHH`),
  ADD CONSTRAINT `FK_CTDH_HH` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);

--
-- Constraints for table `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `FK_DH_KH` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `FK_NV_DH` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`);

--
-- Constraints for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `FK_NHOMHANGHOA_HANGHOA` FOREIGN KEY (`MANHOM`) REFERENCES `nhomhanghoa` (`MANHOM`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `FK_NV_TK2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
