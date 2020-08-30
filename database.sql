-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th8 30, 2020 lúc 11:07 AM
-- Phiên bản máy phục vụ: 10.4.10-MariaDB
-- Phiên bản PHP: 7.4.0

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
-- Cấu trúc bảng cho bảng `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tieude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `noidung` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_pheduyet` tinyint(4) NOT NULL DEFAULT 0,
  `idUser` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_iduser_foreign` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blog`
--

INSERT INTO `blog` (`id`, `tieude`, `phude`, `hinh`, `noidung`, `ad_pheduyet`, `idUser`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dsasdadasdasasdds', 'sdasdadsdssdds', 'default.jpg', 'asdasdadsadsdsds\r\n\r\nsdads\r\nasd\r\nds\r\nadsdsadsdsadsads', 1, 3, '5H9C9iJn8rocFDypxamLg9FZNSeR3gL4hg78Xcr2', '2020-08-29 15:11:19', '2020-08-29 15:13:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `noidung` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `idBlog` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `comment_iduser_foreign` (`idUser`),
  KEY `comment_idblog_foreign` (`idBlog`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `noidung`, `idUser`, `idBlog`, `created_at`) VALUES
(2, '12321312', 3, 1, '2020-08-29 15:20:54'),
(3, '12321312', 3, 1, '2020-08-29 15:20:55'),
(4, '12321312', 3, 1, '2020-08-29 15:20:55'),
(5, '12321312', 3, 1, '2020-08-29 15:20:55'),
(6, '12321312', 3, 1, '2020-08-29 15:20:55'),
(7, '12321312', 3, 1, '2020-08-29 15:20:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hosoxinviec`
--

DROP TABLE IF EXISTS `hosoxinviec`;
CREATE TABLE IF NOT EXISTS `hosoxinviec` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUser` int(10) UNSIGNED NOT NULL,
  `idTTD` int(10) UNSIGNED NOT NULL,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emaillienhe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdtlienhe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thongtinthem` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nganh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kinang`)),
  `khuvuc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `honnhan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinhthuc_lv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bangcap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capbac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinhnghiem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mucluongmm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muctieu` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngoaingu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ngoaingu`)),
  `tinhoc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tinhoc`)),
  `sotruong` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noidung_ungtuyen` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new` tinyint(1) NOT NULL DEFAULT 1,
  `ntd_ungtuyen` tinyint(4) NOT NULL DEFAULT 0,
  `ad_pheduyet` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hosoxinviec_iduser_foreign` (`idUser`),
  KEY `hosoxinviec_idttd_foreign` (`idTTD`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hosoxinviec`
--

INSERT INTO `hosoxinviec` (`id`, `idUser`, `idTTD`, `hoten`, `hinh`, `emaillienhe`, `sdtlienhe`, `thongtinthem`, `nganh`, `kinang`, `khuvuc`, `ngaysinh`, `gioitinh`, `honnhan`, `hinhthuc_lv`, `bangcap`, `capbac`, `kinhnghiem`, `mucluongmm`, `muctieu`, `ngoaingu`, `tinhoc`, `sotruong`, `noidung_ungtuyen`, `new`, `ntd_ungtuyen`, `ad_pheduyet`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 3, 2, 'Hồng Phát', NULL, 'DH51603902@student.stu.edu.vn', '0938922315', 'dsaasd\r\nasd\r\nads\r\nasd\r\ndsa', 'Lập trình viên .NET', '[\"Ruby\",\"Swift\"]', 'Hòa Bình', '5050-05-05', 'Nam', 'Độc thân', 'Part Time', 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Chưa có kinh nghiệm', 'Dưới 3 triệu', 'dsaads\r\nsda\r\nsda\r\ndsad', '[\"Tiếng Anh\",\"Tiếng Pháp\",\"Mỹ Latin\",\"Tiếng ý\"]', '[\"MS Word\",\"MS Excel\",\"Github\",\"Bitbucket\"]', 'sddsaads\r\ndas\r\ndas\r\ndsa', 'Ok!', 1, 1, 1, 'gmOwvIV8uyjGmRTqIf0g01bxDzH3TZmBKzzTxW47', '2020-08-29 18:26:30', '2020-08-30 02:49:21'),
(9, 3, 3, 'Hồng Phát', '1598775024_5c44662f08c3d1abeea7f9c04b8492b6.jpg', 'DH51603902@student.stu.edu.vn', '0938922315', NULL, 'Lập trình viên Android', '[\"C++\",\"Database\",\".NET\"]', 'Hòa Bình', '1998-08-30', 'Nam', 'Đã kết hôn', 'Part Time', 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Từ 2 đến 3 năm', 'Dưới 3 triệu', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 'uAGM0VsJIPVFYWkeZAtfqMvs8DlNcujqI179UJtU', '2020-08-30 08:37:08', '2020-08-30 08:37:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `from_email`, `ho`, `ten`, `tieude`, `noidung`, `trangthai`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'conbaba999990@gmail.com', 'AA', 'sddsa', '123456456', '1231311323123122\r\n312\r\n3\r\n312132', 1, 'xoSkHnAkNdqCG8U5CZAcErHyHBAj9cjukvXW6kBp', '2020-08-29 15:03:09', '2020-08-29 15:06:56'),
(2, 'DH51603902@student.stu.edu.vn', 'sdaasdsadsa', 'dassdadas', 'sdadsadsaads', 'saddsadsasdaadsasddsdasdssdadsadsa\r\nadssdasdasdasadsdsdadsadsdssdsdsd\r\ndsasdsdasdadsdsdssddsadsdssdadsds\r\nsdsddsdasadsadsdssddsdssddsadssdsd\r\nsddssddssdadssdasdads', 1, '5H9C9iJn8rocFDypxamLg9FZNSeR3gL4hg78Xcr2', '2020-08-29 15:05:37', '2020-08-29 15:08:35');

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
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(71, '2020_06_10_091111_create_users_table', 1),
(72, '2020_06_10_091404_create_nguoitimviec_table', 1),
(73, '2020_06_10_091431_create_nhatuyendung_table', 1),
(74, '2020_06_10_091459_create_tintuyendung_table', 1),
(75, '2020_06_10_091611_create_lienhe_table', 1),
(76, '2020_06_10_091646_create_hosoxinviec_table', 1),
(77, '2020_06_10_099999_create_password_resets_table', 1),
(78, '2020_07_08_220057_create_table_other', 1),
(79, '2020_07_30_220450_create_table_blog', 1),
(80, '2020_07_30_220701_create_table_comment', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoitimviec`
--

DROP TABLE IF EXISTS `nguoitimviec`;
CREATE TABLE IF NOT EXISTS `nguoitimviec` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emaillienhe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdtlienhe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nganh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kinang`)),
  `khuvuc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `honnhan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinhthuc_lv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bangcap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capbac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinhnghiem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mucluongmm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muctieu` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngoaingu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ngoaingu`)),
  `tinhoc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tinhoc`)),
  `sotruong` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thongtinthem` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luotxem` int(11) NOT NULL DEFAULT 0,
  `ad_pheduyet` tinyint(4) NOT NULL DEFAULT 0,
  `congkhai` tinyint(4) DEFAULT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nguoitimviec_iduser_foreign` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoitimviec`
--

INSERT INTO `nguoitimviec` (`id`, `hinh`, `hoten`, `emaillienhe`, `sdtlienhe`, `nganh`, `kinang`, `khuvuc`, `ngaysinh`, `gioitinh`, `honnhan`, `hinhthuc_lv`, `bangcap`, `capbac`, `kinhnghiem`, `mucluongmm`, `muctieu`, `ngoaingu`, `tinhoc`, `sotruong`, `thongtinthem`, `luotxem`, `ad_pheduyet`, `congkhai`, `idUser`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Hồng Phát', 'DH51603902@student.stu.edu.vn', '0938922315', 'Lập trình viên C', '[\"Ruby\",\"Swift\"]', 'Hòa Bình', '5050-05-05', 'Nam', 'Độc thân', 'Part Time', 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Chưa có kinh nghiệm', 'Dưới 3 triệu', 'dsaads\r\nsda\r\nsda\r\ndsad', '[\"Tiếng Anh\",\"Tiếng Pháp\",\"Mỹ Latin\",\"Tiếng ý\"]', '[\"MS Word\",\"MS Excel\",\"Github\",\"Bitbucket\"]', 'sddsaads\r\ndas\r\ndas\r\ndsa', 'dsaasd\r\nasd\r\nads\r\nasd\r\ndsa', 41, 1, 1, 3, 'Im6DsDIodjxvWFFDTdD9jHVTux9699d7ZvE36YSf', '2020-08-29 12:20:11', '2020-08-30 09:20:23'),
(2, '1598775024_5c44662f08c3d1abeea7f9c04b8492b6.jpg', 'Hồng Phát', 'DH51603902@student.stu.edu.vn', '0938922315', 'Lập trình viên Android', '[\"C++\",\"Database\",\".NET\"]', 'Hòa Bình', '1998-08-30', 'Nam', 'Đã kết hôn', 'Part Time', 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Từ 2 đến 3 năm', 'Dưới 3 triệu', NULL, NULL, NULL, NULL, NULL, 5, 1, 1, 3, 'uAGM0VsJIPVFYWkeZAtfqMvs8DlNcujqI179UJtU', '2020-08-30 08:10:24', '2020-08-30 09:20:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhatuyendung`
--

DROP TABLE IF EXISTS `nhatuyendung`;
CREATE TABLE IF NOT EXISTS `nhatuyendung` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenlh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinhthanhpho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quymodansu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vanhoaphucloi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `nhatuyendung_iduser_foreign` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhatuyendung`
--

INSERT INTO `nhatuyendung` (`idUser`, `ten`, `tenlh`, `email`, `sdt`, `diachi`, `tinhthanhpho`, `quymodansu`, `vanhoaphucloi`, `website`, `hinh`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ABC', 'Hồng pHát', '123456@dsac.com', '0938922315', '10', 'Hòa Bình', 'Dưới 20 người', 'dsadas\r\ndas\r\nads\r\ndsa\r\ndsadsa', 'abc.def', '1598766569_3k2Dame.PNG', 'f8gSxhI0LH7WDfCSV9ecJnPb8rTh09COVnn62UKM', '2020-08-28 13:06:43', '2020-08-30 05:49:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `other`
--

DROP TABLE IF EXISTS `other`;
CREATE TABLE IF NOT EXISTS `other` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `other`
--

INSERT INTO `other` (`id`, `ten`, `loai`, `created_at`, `updated_at`) VALUES
(2, 'Lập trình viên back end', 'ngành', '2020-08-28 17:57:03', '2020-08-28 17:57:03'),
(3, 'Abcdef', 'ngành', '2020-08-28 17:58:40', '2020-08-28 17:58:40'),
(4, 'Abcdef', 'ngành', '2020-08-28 17:59:06', '2020-08-28 17:59:06'),
(5, '12312132', 'ngành', '2020-08-28 18:01:02', '2020-08-28 18:01:02'),
(6, 'Asdadsasas', 'ngành', '2020-08-29 07:52:13', '2020-08-29 07:52:13'),
(7, '12312132', 'ngành', '2020-08-30 04:50:45', '2020-08-30 04:50:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuyendung`
--

DROP TABLE IF EXISTS `tintuyendung`;
CREATE TABLE IF NOT EXISTS `tintuyendung` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kinang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kinang`)),
  `nganh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mucluong` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `bangcap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capbac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinhthuc_lv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinhthanhpho` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tinhthanhpho`)),
  `gioitinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinhnghiem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngoaingu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ngoaingu`)),
  `tinhoc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tinhoc`)),
  `tg_thuviec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hantuyendung` date DEFAULT NULL,
  `motacv` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`motacv`)),
  `yeucau_cv` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`yeucau_cv`)),
  `quyenloi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`quyenloi`)),
  `ttlienhe` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ttlienhe`)),
  `luotxem` int(11) NOT NULL DEFAULT 0,
  `idNTD` int(10) UNSIGNED NOT NULL,
  `ad_pheduyet` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tintuyendung_idntd_foreign` (`idNTD`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuyendung`
--

INSERT INTO `tintuyendung` (`id`, `kinang`, `nganh`, `mucluong`, `soluong`, `bangcap`, `capbac`, `hinhthuc_lv`, `tinhthanhpho`, `gioitinh`, `kinhnghiem`, `ngoaingu`, `tinhoc`, `tg_thuviec`, `hantuyendung`, `motacv`, `yeucau_cv`, `quyenloi`, `ttlienhe`, `luotxem`, `idNTD`, `ad_pheduyet`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, '[\"C language\",\"C++\",\"Database\",\"Blockchain\",\"PHP\"]', 'Lập trình viên Android', 'Dưới 3 triệu', 12, 'Lao động phổ thông', 'Cộng tác viên', 'Full Time', '[\"Hòa Bình\",\"Điện Biên\",\"Yên Bái\"]', 'Không yêu cầu', 'Chưa có kinh nghiệm', NULL, NULL, 'Nhận việc ngay', '2020-08-31', NULL, NULL, NULL, '[\"Email liên hệ:\",\"SDT liên hệ:\",\"Tên:\",\"Địa chỉ: 10, Hòa Bình\"]', 15, 1, 1, 'PLOWYy9zshZAfoZHKXnQru8S791xOesb1Tslwpvl', '2020-08-28 18:01:02', '2020-08-30 09:15:41'),
(3, '[\"C language\",\"C#\"]', 'Lập trình viên .NET', 'Dưới 3 triệu', 10, 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Full Time', '[\"Hòa Bình\",\"Điện Biên\"]', 'Nam', 'Chưa có kinh nghiệm', '[\"Tiếng Pháp\",\"Tiếng Trung\",\"Tiếng Hàn\"]', '[\"MS Word\",\"MS Excel\"]', 'Nhận việc ngay', '2020-08-31', '[\"sdadsadassdasdasda\",\"adsdasads\",\"adsds\",\"sdasda\"]', NULL, '[\"dsaads\",\"dasdas\",\"dasads\"]', '[\"Email liên hệ: 123456@dsac.com\",\"SDT liên hệ: 0938922315\",\"Tên: Hồng pHát\",\"Địa chỉ: 10, Hòa Bình\"]', 6, 1, 1, 'PLOWYy9zshZAfoZHKXnQru8S791xOesb1Tslwpvl', '2020-08-30 08:25:44', '2020-08-30 08:37:27'),
(4, '[\"C#\",\"C++\",\"Database\"]', 'Lập trình viên Back End', 'Dưới 3 triệu', 10, 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Full Time', '[\"Hòa Bình\",\"Điện Biên\"]', 'Nam', 'Chưa có kinh nghiệm', '[\"Tiếng Anh\",\"Tiếng Trung\"]', NULL, 'Nhận việc ngay', '2020-09-09', NULL, NULL, NULL, '[\"Email liên hệ: 123456@dsac.com\",\"SDT liên hệ: 0938922315\",\"Tên: Hồng pHát\",\"Địa chỉ: 10, Hòa Bình\"]', 0, 1, 0, 'PLOWYy9zshZAfoZHKXnQru8S791xOesb1Tslwpvl', '2020-08-30 08:50:55', '2020-08-30 09:05:34'),
(5, '[\"C language\",\"C#\"]', 'Lập trình viên .NET', 'Dưới 3 triệu', 15, 'Lao động phổ thông', 'Mới tốt nghiệp, thực tập sinh', 'Part Time', '[\"Hòa Bình\",\"Điện Biên\",\"Yên Bái\"]', 'Không yêu cầu', 'Chưa có kinh nghiệm', '[\"Tiếng Anh\",\"Tiếng Pháp\"]', '[\"MS Word\",\"MS Excel\"]', '1 tháng', '2020-09-17', NULL, NULL, NULL, '[\"Email liên hệ: 123456@dsac.com\",\"SDT liên hệ: 0938922315\",\"Tên: Hồng pHát\",\"Địa chỉ: 10, Hòa Bình\"]', 1, 1, 1, 'PLOWYy9zshZAfoZHKXnQru8S791xOesb1Tslwpvl', '2020-08-30 08:53:28', '2020-08-30 09:05:51');

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
  `theodoi_ntd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `ten`, `email`, `password`, `loaitk`, `theodoi`, `theodoi_ntd`, `remember_token`, `provider`, `provider_id`, `provider_token`, `verified`, `created_at`, `updated_at`) VALUES
(1, 'FSoft', 'conbaba999990@gmail.com', '$2y$10$L.spj6kiON2ZhACzu0jvT.GdkuEeWDh.6zTuhs5tj679GpxeuurcC', 1, '[\"2\",\"1\"]', NULL, '7BwSbfeLXx1vjkJyhO5qT8hN2xUgnL0hg5JhyEzXFQmuBBHJZpzAtEGLWEXf', NULL, NULL, NULL, 1, '2020-08-28 13:06:43', '2020-08-30 08:42:58'),
(2, 'Admin', 'hongphat701@gmail.com', '$2y$10$pV1T9rjxQcpzoA5whW6REuRvZ5.T/1rkK7lEaiV0oSGknviv1cVqa', 2, NULL, NULL, 'K3L1sETQH88fuSr7xeyZ4htNmCO6rxkTPMdG57cBh1ejEdUb6kBX0DZ4sasQ', NULL, NULL, NULL, 1, '2020-08-29 07:54:36', '2020-08-29 07:54:50'),
(3, 'Phát', 'DH51603902@student.stu.edu.vn', '$2y$10$nB70n530jG3zpTbRhf3WyOzZKl0lSx5oqtXw8iobIW53PyIYtxkHq', 0, '[\"2\"]', '[\"1\"]', 'PA9XNxytU6JHDWVvb7gMO1N620VC9nZgDt8DleJA', NULL, NULL, NULL, 1, '2020-08-29 12:18:28', '2020-08-30 09:19:45');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_idblog_foreign` FOREIGN KEY (`idBlog`) REFERENCES `blog` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hosoxinviec`
--
ALTER TABLE `hosoxinviec`
  ADD CONSTRAINT `hosoxinviec_idttd_foreign` FOREIGN KEY (`idTTD`) REFERENCES `tintuyendung` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hosoxinviec_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nguoitimviec`
--
ALTER TABLE `nguoitimviec`
  ADD CONSTRAINT `nguoitimviec_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

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
