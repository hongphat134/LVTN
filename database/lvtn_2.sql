-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 01, 2020 at 04:37 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lvtn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quyen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bangcap`
--

DROP TABLE IF EXISTS `bangcap`;
CREATE TABLE IF NOT EXISTS `bangcap` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bangcap`
--

INSERT INTO `bangcap` (`id`, `ten`) VALUES
(1, 'Lao động phổ thông'),
(2, 'Trung học'),
(3, 'Trung cấp'),
(4, 'Cao đẳng'),
(5, 'Đại học'),
(6, 'Cao học'),
(7, 'Chứng chỉ'),
(8, 'Không yêu cầu');

-- --------------------------------------------------------

--
-- Table structure for table `capbac`
--

DROP TABLE IF EXISTS `capbac`;
CREATE TABLE IF NOT EXISTS `capbac` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `capbac`
--

INSERT INTO `capbac` (`id`, `ten`) VALUES
(1, 'Mới tốt nghiệp, thực tập sinh'),
(2, 'Nhân viên'),
(3, 'Trưởng nhóm'),
(4, 'Trưởng phòng'),
(5, 'Phó Giám đốc'),
(6, 'Giám đốc'),
(7, 'Tổng giám đốc điều hành');

-- --------------------------------------------------------

--
-- Table structure for table `hosoxinviec`
--

DROP TABLE IF EXISTS `hosoxinviec`;
CREATE TABLE IF NOT EXISTS `hosoxinviec` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `idTTD` int(10) UNSIGNED NOT NULL,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emaillienhe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nganh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khuvuc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `honnhan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthailv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bangcap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capbac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinhnghiem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muctieu` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngoaingu` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinhoc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sotruong` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` tinyint(4) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `hosoxinviec_iduser_foreign` (`idUser`),
  KEY `hosoxinviec_idttd_foreign` (`idTTD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kinang`
--

DROP TABLE IF EXISTS `kinang`;
CREATE TABLE IF NOT EXISTS `kinang` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kinang`
--

INSERT INTO `kinang` (`id`, `ten`) VALUES
(1, 'C language'),
(2, 'C#'),
(3, 'C++'),
(4, 'Database'),
(5, '.NET'),
(6, 'Blockchain'),
(7, 'PHP'),
(8, 'Python'),
(9, 'Ruby'),
(10, 'Swift'),
(11, 'Angular'),
(12, 'Java'),
(13, 'Kotlin'),
(14, 'iOS'),
(15, 'React Native'),
(16, 'ReactJS'),
(17, 'AngularJS'),
(18, 'NodeJS'),
(19, 'VueJS'),
(20, 'Android'),
(21, 'JSON'),
(22, 'J2EE'),
(23, 'ASP.NET'),
(24, 'Tester'),
(25, 'Embedded'),
(26, 'Designer'),
(27, 'Golang'),
(28, 'Javascript'),
(29, 'Scala'),
(30, 'Django'),
(31, 'Hybrid'),
(32, 'Magento'),
(33, 'Objective C'),
(34, 'Laravel'),
(35, 'Xamarin'),
(36, 'UI-UX'),
(37, 'Oracle'),
(38, 'OOP'),
(39, 'Spring');

-- --------------------------------------------------------

--
-- Table structure for table `kinhnghiem`
--

DROP TABLE IF EXISTS `kinhnghiem`;
CREATE TABLE IF NOT EXISTS `kinhnghiem` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kinhnghiem`
--

INSERT INTO `kinhnghiem` (`id`, `ten`) VALUES
(1, 'Chưa có kinh nghiệm'),
(2, 'Dưới 1 năm'),
(3, 'Từ 1 đến 2 năm'),
(4, 'Từ 2 đến 3 năm'),
(5, 'Từ 3 đến 4 năm'),
(6, 'Từ 4 đến 5 năm'),
(7, 'Trên 5 năm');

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

DROP TABLE IF EXISTS `lienhe`;
CREATE TABLE IF NOT EXISTS `lienhe` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tieude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noidung` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lienhe`
--

INSERT INTO `lienhe` (`id`, `from_email`, `ho`, `ten`, `tieude`, `noidung`, `trangthai`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abc@def.com', 'Hồng', 'Phát', 'Lỗi đăng nhập', 'Lỗi hiển thị trang', 0, 'DC3eK8vrlr5HmpilvUdYOutDOYO8xfyvsv4ONlr9', '2020-06-30 22:24:57', '2020-06-30 22:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `loaiadmins`
--

DROP TABLE IF EXISTS `loaiadmins`;
CREATE TABLE IF NOT EXISTS `loaiadmins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loaiadmins`
--

INSERT INTO `loaiadmins` (`id`, `ten`, `created_at`) VALUES
(1, 'tài khoản', '2020-06-30 22:23:08'),
(2, 'tin tuyển dụng', '2020-06-30 22:23:08'),
(3, 'hồ sơ', '2020-06-30 22:23:08'),
(4, 'report', '2020-06-30 22:23:08'),
(5, 'liên hệ', '2020-06-30 22:23:08'),
(6, 'quản trị viên', '2020-06-30 22:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(269, '2017_02_27_170020_add_verified_to_user_table', 1),
(321, '2020_06_10_091000_create_loaiadmins_table', 2),
(322, '2020_06_10_091111_create_users_table', 2),
(323, '2020_06_10_091212_create_admins_table', 2),
(324, '2020_06_10_091326_create_nhanvien_table', 2),
(325, '2020_06_10_091404_create_nguoitimviec_table', 2),
(326, '2020_06_10_091431_create_nhatuyendung_table', 2),
(327, '2020_06_10_091459_create_tintuyendung_table', 2),
(328, '2020_06_10_091611_create_lienhe_table', 2),
(329, '2020_06_10_091628_create_report_table', 2),
(330, '2020_06_10_091646_create_hosoxinviec_table', 2),
(331, '2020_06_10_099999_create_password_resets_table', 2),
(332, '2020_06_12_065437_create_capbac_table', 2),
(333, '2020_06_12_065700_create_bangcap_table', 2),
(334, '2020_06_12_065729_create_nganhnghe_table', 2),
(335, '2020_06_13_084202_create_kinang_table', 2),
(336, '2020_06_15_061617_create_kinhnghiem_table', 2),
(337, '2020_06_15_061710_create_mucluong_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mucluong`
--

DROP TABLE IF EXISTS `mucluong`;
CREATE TABLE IF NOT EXISTS `mucluong` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mucluong`
--

INSERT INTO `mucluong` (`id`, `ten`) VALUES
(1, 'Dưới 3 triệu'),
(2, '3-5 triệu'),
(3, '5-7 triệu'),
(4, '7-10 triệu'),
(5, '10-12 triệu'),
(6, '12-15 triệu'),
(7, '15-20 triệu'),
(8, '20-25 triệu'),
(9, '25-30 triệu'),
(10, '35-40 triệu'),
(11, '40-50 triệu'),
(12, 'Trên 50 triệu');

-- --------------------------------------------------------

--
-- Table structure for table `nganhnghe`
--

DROP TABLE IF EXISTS `nganhnghe`;
CREATE TABLE IF NOT EXISTS `nganhnghe` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nganhnghe`
--

INSERT INTO `nganhnghe` (`id`, `ten`) VALUES
(1, 'Lập trình viên .NET'),
(2, 'Lập trình viên AngularJS'),
(3, 'Lập trình viên Back End'),
(4, 'Lập trình viên Android'),
(5, 'Lập trình viên C++'),
(6, 'Lập trình viên C#'),
(7, 'Lập trình viên Front End'),
(8, 'Lập trình viên iOS'),
(9, 'Lập trình viên SQL'),
(10, 'Quản trị cơ sở dữ liệu'),
(11, 'Kỹ sư cầu nối'),
(12, 'Lập trình viên Oracle'),
(13, 'Python Web Developer'),
(14, 'Lập trình viên Ruby'),
(15, 'Lập trình viên Unity'),
(16, 'Lập trình viên PHP'),
(17, 'Lập trình viên Embedded'),
(18, 'Lập trình viên Games'),
(19, 'Lập trình viên OOP'),
(20, 'Lập trình viên Python'),
(21, 'Full Stack Web Developer'),
(22, 'Quản lý sản phẩm'),
(23, 'Lập trình viên phần mềm'),
(24, 'Lập trình viên ứng dụng di động'),
(25, 'Lập trình viên Linux'),
(26, 'Chuyên viên phân tích nghiệp vụ'),
(27, 'Lập trình viên UI-UX'),
(28, 'Lập trình viên Windows Phone'),
(29, 'Lập trình viên Django'),
(30, 'Lập trình viên C'),
(31, 'Lập trình viên JavaScript'),
(32, 'Lập trình viên ASP.NET'),
(33, 'Lập trình viên Drupal'),
(34, 'Lập trình viên NodeJS'),
(35, 'Lập trình viên Java');

-- --------------------------------------------------------

--
-- Table structure for table `nguoitimviec`
--

DROP TABLE IF EXISTS `nguoitimviec`;
CREATE TABLE IF NOT EXISTS `nguoitimviec` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emaillienhe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nganh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khuvuc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `honnhan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthailv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bangcap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capbac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinhnghiem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muctieu` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngoaingu` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinhoc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sotruong` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` tinyint(4) DEFAULT NULL,
  `congkhai` tinyint(4) DEFAULT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nguoitimviec_iduser_foreign` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cmnd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idAdmin` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nhanvien_idadmin_foreign` (`idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhatuyendung`
--

DROP TABLE IF EXISTS `nhatuyendung`;
CREATE TABLE IF NOT EXISTS `nhatuyendung` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinhthanhpho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quymodansu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vanhoaphucloi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `nhatuyendung_iduser_foreign` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nhatuyendung`
--

INSERT INTO `nhatuyendung` (`idUser`, `ten`, `diachi`, `tinhthanhpho`, `quymodansu`, `vanhoaphucloi`, `hinh`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Adidas', 'HL2, P.BTD, Q.BT', 'TP Hồ Chí Minh', '20 - 150 người', 'Lương tháng 13', 'amazon.jpg', NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(2, 'Microsoft', 'HB, P.1, Q.11', 'TP Hồ Chí Minh', '150 - 300 người', 'Lương tháng 13', 'microsoft.jpg', NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tintuyendung`
--

DROP TABLE IF EXISTS `tintuyendung`;
CREATE TABLE IF NOT EXISTS `tintuyendung` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kinang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nganh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mucluong` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `bangcap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capbac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthailv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinhthanhpho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gioitinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinhnghiem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hantuyendung` date DEFAULT NULL,
  `motacv` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quyenloi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idNTD` int(10) UNSIGNED NOT NULL,
  `congkhai` tinyint(4) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tintuyendung_idntd_foreign` (`idNTD`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tintuyendung`
--

INSERT INTO `tintuyendung` (`id`, `kinang`, `nganh`, `mucluong`, `soluong`, `bangcap`, `capbac`, `trangthailv`, `tinhthanhpho`, `gioitinh`, `kinhnghiem`, `hantuyendung`, `motacv`, `quyenloi`, `idNTD`, `congkhai`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 'Lập trình viên Back End', 'Dưới 3 triệu', 20, 'Đại học', NULL, 'Full Time', '[\"TP Hồ Chí Minh\",\"Tiền Giang\",\"Hưng Yên\"]', 'Nam', 'Từ 1 đến 2 năm', '2020-06-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(2, '[\"6\",\"7\",\"8\",\"9\",\"10\"]', 'Lập trình viên Front End', '3-5 triệu', 15, 'Đại học', NULL, 'Part Time', '[\"TP Hồ Chí Minh\",\"Cà Mau\",\"Bến Tre\"]', 'Nam', 'Từ 2 đến 3 năm', '2020-07-15', 'Lập trình client', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(3, '[\"11\",\"12\"]', 'Lập trình viên C++', '7-10 triệu', 10, 'Không yêu cầu', NULL, 'Full Time', '[\"Long An\",\"Hà Nội\",\"Vũng Tàu\"]', 'Nam', 'Từ 2 đến 3 năm', '2020-08-01', 'Lập trình nhúng', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(4, '[\"16\",\"17\",\"18\",\"19\",\"20\"]', 'Lập trình viên Android', '5-7 triệu', 5, 'Cao đẳng', NULL, 'Part Time', '[\"Vĩnh Long\",\"Đồng Nai\",\"Đà Nẵng\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-06-30', 'Lập trình Mobile', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(5, '[\"21\",\"22\",\"23\",\"24\"]', 'Lập trình viên Back End', '40-50 triệu', 30, 'Cao đẳng', NULL, 'Full Time', '[\"Khánh Hoà\",\"Cần Thơ\",\"Lâm Đồng\"]', 'Bất kì', 'Từ 2 đến 3 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 2, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(6, '[\"31\",\"32\",\"33\"]', 'Lập trình viên OOP', '15-20 triệu', 20, 'Cao học', NULL, 'Part Time', '[\"TP Hồ Chí Minh\",\"Hà Nội\",\"Nghệ An\"]', 'Bất kì', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 2, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(7, '[\"13\"]', 'Lập trình viên C#', 'Trên 50 triệu', 10, 'Đại học', NULL, 'Part Time', '[\"TP Hồ Chí Minh\",\"Hà Nội\",\"Đà Nẵng\"]', 'Nam', 'Trên 5 năm', '2020-08-30', 'Lập trình server', 'Lương tháng 13', 2, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(8, '[\"1\",\"4\",\"7\",\"2\",\"3\"]', 'Kỹ sư cầu nối', 'Dưới 3 triệu', 20, 'Đại học', NULL, 'Part Time', '[\"TP Hồ Chí Minh\",\"Nam Định\",\"Đồng Tháp\"]', 'Nam', 'Từ 1 đến 2 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(9, '[\"12\",\"14\",\"27\",\"22\",\"33\"]', 'Full Stack Web Developer', '20-25 triệu', 20, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Nam Định\",\"Vĩnh Long\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(10, '[\"16\",\"12\",\"14\",\"21\"]', 'Lập trình viên Games', '20-25 triệu', 20, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Nam Định\",\"Vĩnh Long\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(11, '[\"12\",\"14\",\"22\",\"33\"]', 'Lập trình viên Ruby', '20-25 triệu', 20, 'Đại học', NULL, 'Full Time', '[\"Thanh Hoá\",\"Đồng Nai\",\"Vĩnh Long\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(12, '[\"21\",\"25\",\"17\",\"12\",\"13\"]', 'Quản trị cơ sở dữ liệu', '20-25 triệu', 25, 'Đại học', NULL, 'Full Time', '[\"Nghệ An\",\"Bình Phước\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(13, '[\"25\",\"11\",\"22\"]', 'Python Web Developer', '20-25 triệu', 45, 'Đại học', NULL, 'Full Time', '[\"Huế\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-08-15', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(14, '[\"12\",\"14\",\"25\",\"22\"]', 'Lập trình viên iOS', '25-30 triệu', 45, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-08-15', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(15, '[\"2\",\"4\",\"3\",\"1\"]', 'Lập trình viên Embedded', '20-25 triệu', 40, 'Đại học', NULL, 'Full Time', '[\"Phú Thọ\",\"Tây Ninh\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-08-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(16, '[\"8\",\"6\",\"4\",\"2\"]', 'Lập trình viên .NET', '20-25 triệu', 15, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Tuyên Quang\",\"Lai Châu\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-15', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(17, '[\"12\",\"14\",\"25\",\"22\"]', 'Lập trình viên iOS', '25-30 triệu', 5, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(18, '[\"2\",\"4\",\"5\"]', 'Lập trình viên .NET', '20-25 triệu', 10, 'Đại học', NULL, 'Part Time', '[\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-08-15', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(19, '[\"7\",\"9\",\"11\",\"13\"]', 'Lập trình viên SQL', '25-30 triệu', 15, 'Cao học', NULL, 'Full Time', '[\"Long An\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-08-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(20, '[\"13\",\"15\",\"26\",\"23\"]', 'Lập trình viên Unity', '25-30 triệu', 30, 'Cao học', NULL, 'Full Time', '[\"Hà Nội\",\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(21, '[\"31\",\"32\",\"33\",\"34\",\"35\"]', 'Lập trình viên PHP', '25-30 triệu', 25, 'Cao học', NULL, 'Full Time', '[\"Cao Bằng\",\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(22, '[\"35\",\"36\",\"37\",\"38\",\"39\"]', 'Lập trình viên PHP', '25-30 triệu', 15, 'Cao học', NULL, 'Full Time', '[\"Cao Bằng\",\"Bắc Ninh\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(23, '[\"30\",\"36\",\"38\",\"39\"]', 'Lập trình viên OOP', '25-30 triệu', 35, 'Cao học', NULL, 'Full Time', '[\"Đắc Lắc\",\"Đắk Nông\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-30 22:23:09', '2020-06-30 22:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loaitk` tinyint(4) DEFAULT NULL,
  `theodoi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ten`, `email`, `password`, `loaitk`, `theodoi`, `remember_token`, `provider`, `provider_id`, `provider_token`, `verified`, `created_at`, `updated_at`) VALUES
(1, 'Phát', 'phat@gmail.com', '$2y$10$/m7pc3hOVtIxIISjve06h.sULTr8zlEQfeRhyJ.cxzO1WOPK1xVxS', 1, NULL, NULL, NULL, NULL, NULL, 1, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(2, 'Tân', 'tan@gmail.com', '$2y$10$X4osmURMYNbzmBZnb4h2OeM/Z53ckFF7EjTcqpiY2rV6GX0Fkunte', 1, NULL, NULL, NULL, NULL, NULL, 1, '2020-06-30 22:23:09', '2020-06-30 22:23:09'),
(3, 'Thành', 'thanh@gmail.com', '$2y$10$PE1k1wq757HdCFggAFUyju2BSP8ZBlyRJBAerDWFgMbOfnOW2Epfe', 0, NULL, NULL, NULL, NULL, NULL, 1, '2020-06-30 22:23:09', '2020-06-30 22:23:09');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hosoxinviec`
--
ALTER TABLE `hosoxinviec`
  ADD CONSTRAINT `hosoxinviec_idttd_foreign` FOREIGN KEY (`idTTD`) REFERENCES `tintuyendung` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hosoxinviec_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `nguoitimviec`
--
ALTER TABLE `nguoitimviec`
  ADD CONSTRAINT `nguoitimviec_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_idadmin_foreign` FOREIGN KEY (`idAdmin`) REFERENCES `admins` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `nhatuyendung`
--
ALTER TABLE `nhatuyendung`
  ADD CONSTRAINT `nhatuyendung_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tintuyendung`
--
ALTER TABLE `tintuyendung`
  ADD CONSTRAINT `tintuyendung_idntd_foreign` FOREIGN KEY (`idNTD`) REFERENCES `nhatuyendung` (`idUser`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
