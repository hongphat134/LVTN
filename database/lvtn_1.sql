-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 24, 2020 lúc 07:26 AM
-- Phiên bản máy phục vụ: 10.4.10-MariaDB
-- Phiên bản PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lvtn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
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
-- Cấu trúc bảng cho bảng `bangcap`
--

DROP TABLE IF EXISTS `bangcap`;
CREATE TABLE IF NOT EXISTS `bangcap` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bangcap`
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
-- Cấu trúc bảng cho bảng `capbac`
--

DROP TABLE IF EXISTS `capbac`;
CREATE TABLE IF NOT EXISTS `capbac` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `capbac`
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
-- Cấu trúc bảng cho bảng `hosoxinviec`
--

DROP TABLE IF EXISTS `hosoxinviec`;
CREATE TABLE IF NOT EXISTS `hosoxinviec` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `idTTD` int(10) UNSIGNED NOT NULL,
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

--
-- Đang đổ dữ liệu cho bảng `hosoxinviec`
--

INSERT INTO `hosoxinviec` (`idUser`, `idTTD`, `emaillienhe`, `nganh`, `kinang`, `khuvuc`, `honnhan`, `trangthailv`, `bangcap`, `capbac`, `kinhnghiem`, `muctieu`, `ngoaingu`, `tinhoc`, `sotruong`, `trangthai`, `remember_token`, `created_at`) VALUES
(3, 1, 'as@dsa.dsa', 'Lập trình viên .NET', '[\"1\",\"2\"]', 'Tiền Giang', 'Độc thân', 'Part Time', 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Chưa có kinh nghiệm', NULL, NULL, NULL, NULL, 1, 'DqwA6Xda1dRe8PqWaSTYuI78FdJm7szY7D0xQjOD', '2020-06-23 16:22:21'),
(3, 1, 'hongphat701@gmail.com', 'Lập trình viên Front End', '[\"7\",\"8\",\"9\",\"10\"]', 'Hòa Bình', 'Đã kết hôn', 'Part Time', 'Đại học', 'Nhân viên', 'Từ 1 đến 2 năm', NULL, NULL, NULL, NULL, 1, 'jcLwhWGEQiQIqskcKnMkXVatxRZNSxkWrvH2BuwT', '2020-06-23 16:24:42'),
(3, 2, 'fix@bug.com', 'Lập trình viên Android', '[\"20\",\"21\",\"23\"]', 'Quảng Ninh', 'Đã kết hôn', 'Full Time', 'Đại học', 'Mới tốt nghiệp, thực tập sinh', 'Chưa có kinh nghiệm', NULL, NULL, NULL, NULL, 1, '0AH0Vj36hMvOssaP5QiAYlsqHuNmCkL1NrnAHIpM', '2020-06-23 17:38:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kinang`
--

DROP TABLE IF EXISTS `kinang`;
CREATE TABLE IF NOT EXISTS `kinang` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kinang`
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
-- Cấu trúc bảng cho bảng `kinhnghiem`
--

DROP TABLE IF EXISTS `kinhnghiem`;
CREATE TABLE IF NOT EXISTS `kinhnghiem` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kinhnghiem`
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
-- Cấu trúc bảng cho bảng `lienhe`
--

DROP TABLE IF EXISTS `lienhe`;
CREATE TABLE IF NOT EXISTS `lienhe` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaiadmins`
--

DROP TABLE IF EXISTS `loaiadmins`;
CREATE TABLE IF NOT EXISTS `loaiadmins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaiadmins`
--

INSERT INTO `loaiadmins` (`id`, `ten`, `created_at`) VALUES
(1, 'tài khoản', '2020-06-22 12:47:15'),
(2, 'tin tuyển dụng', '2020-06-22 12:47:15'),
(3, 'hồ sơ', '2020-06-22 12:47:15'),
(4, 'report', '2020-06-22 12:47:15'),
(5, 'liên hệ', '2020-06-22 12:47:15'),
(6, 'quản trị viên', '2020-06-22 12:47:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(217, '2020_06_10_091000_create_loaiadmins_table', 1),
(218, '2020_06_10_091111_create_users_table', 1),
(219, '2020_06_10_091212_create_admins_table', 1),
(220, '2020_06_10_091326_create_nhanvien_table', 1),
(221, '2020_06_10_091404_create_nguoitimviec_table', 1),
(222, '2020_06_10_091431_create_nhatuyendung_table', 1),
(223, '2020_06_10_091459_create_tintuyendung_table', 1),
(224, '2020_06_10_091611_create_lienhe_table', 1),
(225, '2020_06_10_091628_create_report_table', 1),
(226, '2020_06_10_091646_create_hosoxinviec_table', 1),
(227, '2020_06_10_099999_create_password_resets_table', 1),
(228, '2020_06_12_065437_create_capbac_table', 1),
(229, '2020_06_12_065700_create_bangcap_table', 1),
(230, '2020_06_12_065729_create_nganhnghe_table', 1),
(231, '2020_06_13_084202_create_kinang_table', 1),
(232, '2020_06_15_061617_create_kinhnghiem_table', 1),
(233, '2020_06_15_061710_create_mucluong_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mucluong`
--

DROP TABLE IF EXISTS `mucluong`;
CREATE TABLE IF NOT EXISTS `mucluong` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mucluong`
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
-- Cấu trúc bảng cho bảng `nganhnghe`
--

DROP TABLE IF EXISTS `nganhnghe`;
CREATE TABLE IF NOT EXISTS `nganhnghe` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nganhnghe`
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
-- Cấu trúc bảng cho bảng `nguoitimviec`
--

DROP TABLE IF EXISTS `nguoitimviec`;
CREATE TABLE IF NOT EXISTS `nguoitimviec` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `idUser` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nguoitimviec_iduser_foreign` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoitimviec`
--

INSERT INTO `nguoitimviec` (`id`, `hinh`, `emaillienhe`, `nganh`, `kinang`, `khuvuc`, `honnhan`, `trangthailv`, `bangcap`, `capbac`, `kinhnghiem`, `muctieu`, `ngoaingu`, `tinhoc`, `sotruong`, `trangthai`, `idUser`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, NULL, 'phat@gmail.com', 'Lập trình viên .NET', '[\"1\",\"2\",\"3\"]', 'Tiền Giang', 'Độc thân', 'Part Time', 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Chưa có kinh nghiệm', NULL, NULL, NULL, NULL, 1, 3, '0AH0Vj36hMvOssaP5QiAYlsqHuNmCkL1NrnAHIpM', '2020-06-18 23:40:09', '2020-06-18 23:40:09'),
(3, NULL, 'thanh@gmail.com', 'Lập trình viên Back End', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 'Tiền Giang', 'Đã kết hôn', 'Part Time', 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Chưa có kinh nghiệm', NULL, NULL, NULL, NULL, 1, 3, '0AH0Vj36hMvOssaP5QiAYlsqHuNmCkL1NrnAHIpM', '2020-06-18 23:41:31', '2020-06-18 23:41:31'),
(4, NULL, 'fix@bug.com', 'Lập trình viên Android', '[\"20\",\"21\",\"23\"]', 'Quảng Ninh', 'Đã kết hôn', 'Full Time', 'Đại học', 'Mới tốt nghiệp, thực tập sinh', 'Chưa có kinh nghiệm', NULL, NULL, NULL, NULL, 1, 3, '0AH0Vj36hMvOssaP5QiAYlsqHuNmCkL1NrnAHIpM', '2020-06-18 23:45:36', '2020-06-18 23:53:36'),
(5, NULL, 'hongphat701@gmail.com', 'Lập trình viên Front End', '[\"7\",\"8\",\"9\",\"10\"]', 'Hòa Bình', 'Đã kết hôn', 'Part Time', 'Đại học', 'Nhân viên', 'Từ 1 đến 2 năm', NULL, NULL, NULL, NULL, 1, 3, 'jcLwhWGEQiQIqskcKnMkXVatxRZNSxkWrvH2BuwT', '2020-06-20 15:35:31', '2020-06-20 15:35:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
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
-- Cấu trúc bảng cho bảng `nhatuyendung`
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
-- Đang đổ dữ liệu cho bảng `nhatuyendung`
--

INSERT INTO `nhatuyendung` (`idUser`, `ten`, `diachi`, `tinhthanhpho`, `quymodansu`, `vanhoaphucloi`, `hinh`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Adidas', 'HL2, P.BTD, Q.BT', 'TP Hồ Chí Minh', '20 - 150 người', 'Lương tháng 13', 'amazon.jpg', NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(2, 'Microsoft', 'HB, P.1, Q.11', 'TP Hồ Chí Minh', '150 - 300 người', 'Lương tháng 13', 'microsoft.jpg', NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('conbaba999990@gmail.com', '$2y$10$dHm9TYbYicTwXeNn1huAH.eEy6p.I/pU6rAyznrV3nc5u6uspkuHi', '2020-06-21 12:47:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `report`
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
-- Cấu trúc bảng cho bảng `tintuyendung`
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
-- Đang đổ dữ liệu cho bảng `tintuyendung`
--

INSERT INTO `tintuyendung` (`id`, `kinang`, `nganh`, `mucluong`, `soluong`, `bangcap`, `capbac`, `trangthailv`, `tinhthanhpho`, `gioitinh`, `kinhnghiem`, `hantuyendung`, `motacv`, `quyenloi`, `idNTD`, `congkhai`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 'Lập trình viên Back End', 'Dưới 3 triệu', 20, 'Đại học', NULL, 'Full Time', '[\"TP Hồ Chí Minh\",\"Tiền Giang\",\"Hưng Yên\"]', 'Nam', 'Từ 1 đến 2 năm', '2020-06-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(2, '[\"6\",\"7\",\"8\",\"9\",\"10\"]', 'Lập trình viên Front End', '3-5 triệu', 15, 'Đại học', NULL, 'Part Time', '[\"TP Hồ Chí Minh\",\"Cà Mau\",\"Bến Tre\"]', 'Nam', 'Từ 2 đến 3 năm', '2020-07-15', 'Lập trình client', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(3, '[\"11\",\"12\"]', 'Lập trình viên C++', '7-10 triệu', 10, 'Không yêu cầu', NULL, 'Full Time', '[\"Long An\",\"Hà Nội\",\"Vũng Tàu\"]', 'Nam', 'Từ 2 đến 3 năm', '2020-08-01', 'Lập trình nhúng', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(4, '[\"16\",\"17\",\"18\",\"19\",\"20\"]', 'Lập trình viên Android', '5-7 triệu', 5, 'Cao đẳng', NULL, 'Part Time', '[\"Vĩnh Long\",\"Đồng Nai\",\"Đà Nẵng\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-06-30', 'Lập trình Mobile', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(5, '[\"21\",\"22\",\"23\",\"24\"]', 'Lập trình viên Back End', '40-50 triệu', 30, 'Cao đẳng', NULL, 'Full Time', '[\"Khánh Hoà\",\"Cần Thơ\",\"Lâm Đồng\"]', 'Bất kì', 'Từ 2 đến 3 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 2, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(6, '[\"31\",\"32\",\"33\"]', 'Lập trình viên OOP', '15-20 triệu', 20, 'Cao học', NULL, 'Part Time', '[\"TP Hồ Chí Minh\",\"Hà Nội\",\"Nghệ An\"]', 'Bất kì', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 2, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(7, '[\"13\"]', 'Lập trình viên C#', 'Trên 50 triệu', 10, 'Đại học', NULL, 'Part Time', '[\"TP Hồ Chí Minh\",\"Hà Nội\",\"Đà Nẵng\"]', 'Nam', 'Trên 5 năm', '2020-08-30', 'Lập trình server', 'Lương tháng 13', 2, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(8, '[\"1\",\"4\",\"7\",\"2\",\"3\"]', 'Kỹ sư cầu nối', 'Dưới 3 triệu', 20, 'Đại học', NULL, 'Part Time', '[\"TP Hồ Chí Minh\",\"Nam Định\",\"Đồng Tháp\"]', 'Nam', 'Từ 1 đến 2 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(9, '[\"12\",\"14\",\"27\",\"22\",\"33\"]', 'Full Stack Web Developer', '20-25 triệu', 20, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Nam Định\",\"Vĩnh Long\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(10, '[\"16\",\"12\",\"14\",\"21\"]', 'Lập trình viên Games', '20-25 triệu', 20, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Nam Định\",\"Vĩnh Long\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(11, '[\"12\",\"14\",\"22\",\"33\"]', 'Lập trình viên Ruby', '20-25 triệu', 20, 'Đại học', NULL, 'Full Time', '[\"Thanh Hoá\",\"Đồng Nai\",\"Vĩnh Long\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(12, '[\"21\",\"25\",\"17\",\"12\",\"13\"]', 'Quản trị cơ sở dữ liệu', '20-25 triệu', 25, 'Đại học', NULL, 'Full Time', '[\"Nghệ An\",\"Bình Phước\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(13, '[\"25\",\"11\",\"22\"]', 'Python Web Developer', '20-25 triệu', 45, 'Đại học', NULL, 'Full Time', '[\"Huế\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-08-15', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(14, '[\"12\",\"14\",\"25\",\"22\"]', 'Lập trình viên iOS', '25-30 triệu', 45, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-08-15', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(15, '[\"2\",\"4\",\"3\",\"1\"]', 'Lập trình viên Embedded', '20-25 triệu', 40, 'Đại học', NULL, 'Full Time', '[\"Phú Thọ\",\"Tây Ninh\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-08-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(16, '[\"8\",\"6\",\"4\",\"2\"]', 'Lập trình viên .NET', '20-25 triệu', 15, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Tuyên Quang\",\"Lai Châu\"]', 'Nam', 'Từ 3 đến 4 năm', '2020-07-15', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(17, '[\"12\",\"14\",\"25\",\"22\"]', 'Lập trình viên iOS', '25-30 triệu', 5, 'Đại học', NULL, 'Full Time', '[\"Long An\",\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(18, '[\"2\",\"4\",\"5\"]', 'Lập trình viên .NET', '20-25 triệu', 10, 'Đại học', NULL, 'Part Time', '[\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-08-15', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(19, '[\"7\",\"9\",\"11\",\"13\"]', 'Lập trình viên SQL', '25-30 triệu', 15, 'Cao học', NULL, 'Full Time', '[\"Long An\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-08-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(20, '[\"13\",\"15\",\"26\",\"23\"]', 'Lập trình viên Unity', '25-30 triệu', 30, 'Cao học', NULL, 'Full Time', '[\"Hà Nội\",\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(21, '[\"31\",\"32\",\"33\",\"34\",\"35\"]', 'Lập trình viên PHP', '25-30 triệu', 25, 'Cao học', NULL, 'Full Time', '[\"Cao Bằng\",\"Lào Cai\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(22, '[\"35\",\"36\",\"37\",\"38\",\"39\"]', 'Lập trình viên PHP', '25-30 triệu', 15, 'Cao học', NULL, 'Full Time', '[\"Cao Bằng\",\"Bắc Ninh\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(23, '[\"30\",\"36\",\"38\",\"39\"]', 'Lập trình viên OOP', '25-30 triệu', 35, 'Cao học', NULL, 'Full Time', '[\"Đắc Lắc\",\"Đắk Nông\"]', 'Nam', 'Từ 4 đến 5 năm', '2020-07-30', 'Lập trình server', 'Lương tháng 13', 1, 1, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `ten`, `email`, `password`, `loaitk`, `theodoi`, `remember_token`, `provider`, `provider_id`, `provider_token`, `created_at`, `updated_at`) VALUES
(1, 'Phát', 'phat@gmail.com', '$2y$10$IY09yUVO4NXAFOcnFHt5kOz8QGYMCCBEC.TwJK9ptuclDDV8neVhG', 1, NULL, 'M68XhgAGRgidBuZdjVRLasUmg2fdCSKY7cxOWlkeYRhx9dFmThqZN2MiVOQp', NULL, NULL, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(2, 'Tân', 'tan@gmail.com', '$2y$10$vwozPhsApnM0YIWW2rhNy.eq19htyAojrwIWPLUPibu2b8D5aT5A.', 1, NULL, NULL, NULL, NULL, NULL, '2020-06-22 12:47:16', '2020-06-22 12:47:16'),
(3, 'Thành', 'thanh@gmail.com', '$2y$10$PGCQOh2KYMki6AcxdaB.jeptJS6tBHyl8dBnFszUbuQ8wTOsEXC/m', 0, '[\"8\",\"3\",\"1\",\"2\"]', 'kDp8IjpOOa0PdoCNsuVeQl64NYPDamunywQG2cuMtWxiNHXNfzHEiDj5AHul', NULL, NULL, NULL, '2020-06-22 12:47:16', '2020-06-23 17:39:32');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `hosoxinviec`
--
ALTER TABLE `hosoxinviec`
  ADD CONSTRAINT `hosoxinviec_idttd_foreign` FOREIGN KEY (`idTTD`) REFERENCES `tintuyendung` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hosoxinviec_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nguoitimviec`
--
ALTER TABLE `nguoitimviec`
  ADD CONSTRAINT `nguoitimviec_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_idadmin_foreign` FOREIGN KEY (`idAdmin`) REFERENCES `admins` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhatuyendung`
--
ALTER TABLE `nhatuyendung`
  ADD CONSTRAINT `nhatuyendung_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tintuyendung`
--
ALTER TABLE `tintuyendung`
  ADD CONSTRAINT `tintuyendung_idntd_foreign` FOREIGN KEY (`idNTD`) REFERENCES `nhatuyendung` (`idUser`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
