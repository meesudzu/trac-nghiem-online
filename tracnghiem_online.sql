-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 20, 2017 lúc 03:43 PM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tracnghiem_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `tai_khoan` varchar(16) NOT NULL,
  `mat_khau` varchar(32) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `chuc_vu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id_admin`, `tai_khoan`, `mat_khau`, `ten`, `chuc_vu`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cau_hoi`
--

CREATE TABLE `cau_hoi` (
  `id_cauhoi` int(11) NOT NULL,
  `id_khoi` int(10) NOT NULL,
  `unit` int(2) NOT NULL,
  `cau_hoi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `da_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `da_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `da_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `da_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `da_dung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `cau_hoi`
--

INSERT INTO `cau_hoi` (`id_cauhoi`, `id_khoi`, `unit`, `cau_hoi`, `da_1`, `da_2`, `da_3`, `da_4`, `da_dung`) VALUES
(1, 1, 1, '5 + 7 = ?', '12', '13', '14', '11', '12'),
(2, 3, 1, '5 + 9 = ?', '13', '15', '17', '14', '14'),
(3, 3, 1, '2 x 1 = ?', '1', '2', '3', '4', '2'),
(4, 3, 1, '11 + 2 = ?', '15', '16', '13', '18', '13'),
(5, 3, 1, '18 + 5 = ?', '20', '21', '22', '23', '23'),
(6, 3, 1, '14 + 8 = ?', '20', '21', '22', '23', '22'),
(7, 3, 1, '13 - 3 = ?', '7', '8', '9', '10', '10'),
(8, 3, 1, '14 - 7 = ?', '7', '6', '5', '8', '7'),
(9, 3, 1, '10 - 8 = ?', '2', '3', '4', '5', '2'),
(10, 3, 1, '3 + 6 = ?', '7', '6', '9', '8', '9'),
(11, 3, 2, '5+10 ?', '15', '10', '5', '4', '15'),
(12, 3, 2, '2 x 7 = ?', '14', '16', '18', '12', '14'),
(13, 3, 2, '2 x 9 = ?', '14', '16', '18', '12', '18'),
(14, 3, 2, '3 x 7 = ?', '14', '16', '18', '21', '21'),
(15, 3, 2, '3 x 5 = ?', '14', '16', '15', '12', '15'),
(16, 3, 2, '4 x 10 = ?', '40', '4', '10', '1', '40'),
(17, 3, 2, '2 x 10 = ?', '14', '16', '18', '20', '20'),
(18, 3, 2, '6 x 7 = ?', '40', '41', '42', '43', '42'),
(19, 3, 2, '4 x 4 = ?', '14', '16', '18', '12', '16'),
(20, 3, 2, '2 x 5 = ?', '14', '16', '10', '12', '10'),
(21, 3, 3, '4 x 7 =?', '27', '28', '29', '30', '28'),
(22, 3, 3, '10 * 0 = ?', '10', '0', '1', '11', '0'),
(23, 3, 3, '4 x 5 =?', '27', '28', '29', '20', '20'),
(24, 3, 3, '5 x 8 =?', '37', '38', '39', '40', '40'),
(25, 3, 3, '5 x 5 =?', '27', '28', '25', '30', '25'),
(26, 3, 3, '7 x 9 = ?', '61', '63', '65', '67', '63'),
(27, 3, 3, '7 x 7 = ?', '41', '43', '45', '49', '49'),
(28, 3, 3, '7 x 8 = ?', '61', '63', '56', '67', '56'),
(29, 3, 3, '9 x 9 = ?', '81', '63', '65', '67', '81'),
(30, 3, 3, '6 x 9 = ?', '61', '63', '65', '54', '54'),
(31, 3, 4, '21 : 3 = ?', '5', '6', '7', '8', '7'),
(32, 3, 4, '24 : 8 = ?', '1', '2', '3', '4', '3'),
(33, 3, 4, '27 : 3 = ?', '6', '7', '8', '9', '9'),
(34, 3, 4, '32 : 8 = ?', '1', '2', '3', '4', '4'),
(35, 3, 4, '25 : 5 = ?', '5', '2', '3', '4', '5'),
(36, 3, 4, '42 : 7 = ?', '6', '5', '3', '4', '6'),
(37, 3, 4, '56 : 8 = ?', '8', '7', '3', '4', '7'),
(38, 3, 4, '81 : 9 = ?', '7', '8', '9', '81', '9'),
(39, 3, 4, '40 : 8 = ?', '5', '2', '3', '4', '5'),
(40, 3, 4, '18 : 9 = ?', '1', '2', '3', '4', '2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chat_lop`
--

CREATE TABLE `chat_lop` (
  `id` int(11) NOT NULL,
  `tai_khoan` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian` datetime NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `id_lop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diem`
--

CREATE TABLE `diem` (
  `id_hs` int(11) NOT NULL,
  `unit_1` int(2) DEFAULT NULL,
  `unit_2` int(2) DEFAULT NULL,
  `unit_3` int(2) DEFAULT NULL,
  `unit_4` int(2) DEFAULT NULL,
  `id_lop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `diem`
--

INSERT INTO `diem` (`id_hs`, `unit_1`, `unit_2`, `unit_3`, `unit_4`, `id_lop`) VALUES
(1, 0, 2, -1, -1, 1),
(2, -1, -1, -1, -1, 1),
(3, -1, -1, -1, -1, 1),
(4, -1, -1, -1, -1, 1),
(5, -1, -1, -1, -1, 1),
(6, -1, -1, -1, -1, 1),
(7, -1, -1, -1, -1, 1),
(8, -1, -1, -1, -1, 1),
(9, -1, -1, -1, -1, 1),
(10, -1, -1, -1, -1, 1),
(11, -1, -1, -1, -1, 1),
(12, -1, -1, -1, -1, 1),
(13, -1, -1, -1, -1, 1),
(14, -1, -1, -1, -1, 1),
(15, -1, -1, -1, -1, 1),
(16, -1, -1, -1, -1, 1),
(17, -1, -1, -1, -1, 1),
(18, -1, -1, -1, -1, 1),
(19, -1, -1, -1, -1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giao_vien`
--

CREATE TABLE `giao_vien` (
  `id_gv` int(11) NOT NULL,
  `tai_khoan` varchar(16) NOT NULL,
  `mat_khau` varchar(32) NOT NULL,
  `ten` varchar(16) NOT NULL,
  `chuc_vu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `giao_vien`
--

INSERT INTO `giao_vien` (`id_gv`, `tai_khoan`, `mat_khau`, `ten`, `chuc_vu`) VALUES
(1, 'giaovien', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Hương', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoc_sinh`
--

CREATE TABLE `hoc_sinh` (
  `id_hs` int(11) NOT NULL,
  `tai_khoan` varchar(16) NOT NULL,
  `mat_khau` varchar(32) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `chuc_vu` int(1) NOT NULL,
  `id_lop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hoc_sinh`
--

INSERT INTO `hoc_sinh` (`id_hs`, `tai_khoan`, `mat_khau`, `ten`, `chuc_vu`, `id_lop`) VALUES
(1, '2017HS1', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Phúc An', 3, 1),
(2, '2017HS2', 'e10adc3949ba59abbe56e057f20f883e', 'Lều Tuấn Anh', 3, 1),
(3, '2017HS3', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Bội', 3, 1),
(4, '2017HS4', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Khánh Duy', 3, 1),
(5, '2017HS5', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Thành Đạt', 3, 1),
(6, '2017HS6', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Quang Điện', 3, 1),
(7, '2017HS7', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Thị Diệu Hằng', 3, 1),
(8, '2017HS8', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Khánh Hoàng', 3, 1),
(9, '2017HS9', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Khánh Linh', 3, 1),
(10, '2017HS10', 'e10adc3949ba59abbe56e057f20f883e', 'Ngô Trần Khôi', 3, 1),
(11, '2017HS11', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Thị Khánh Ly', 3, 1),
(12, '2017HS12', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Phương Mai', 3, 1),
(13, '2017HS13', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ Thị Mùi', 3, 1),
(14, '2017HS14', 'e10adc3949ba59abbe56e057f20f883e', 'Bùi Kim Oanh', 3, 1),
(15, '2017HS15', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Kiều Oanh', 3, 1),
(16, '2017HS16', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị Hà', 3, 1),
(17, '2017HS17', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị G', 3, 1),
(18, '2017HS18', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị H', 3, 1),
(19, '2017HS19', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Thị Khánh Ly', 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoi`
--

CREATE TABLE `khoi` (
  `id_khoi` int(10) NOT NULL,
  `mo_ta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khoi`
--

INSERT INTO `khoi` (`id_khoi`, `mo_ta`) VALUES
(1, 'Lớp 1'),
(2, 'Lớp 2'),
(3, 'Lớp 3'),
(4, 'Lớp 4'),
(5, 'Lớp 5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `id_lop` int(11) NOT NULL,
  `id_khoi` int(10) NOT NULL,
  `ten_lop` varchar(50) NOT NULL,
  `id_gv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`id_lop`, `id_khoi`, `ten_lop`, `id_gv`) VALUES
(1, 3, 'Lớp 3A', 1),
(2, 3, 'Lớp 3B', 1),
(3, 3, 'Lớp 3C', 1),
(4, 3, 'Lớp 3D', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `chuc_vu` int(1) NOT NULL,
  `mo_ta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`chuc_vu`, `mo_ta`) VALUES
(1, 'Admin'),
(2, 'Giáo Viên'),
(3, 'Học Sinh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_bao`
--

CREATE TABLE `thong_bao` (
  `id` int(11) NOT NULL,
  `tai_khoan` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chu_de` text COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian` datetime NOT NULL,
  `chuc_vu` int(1) NOT NULL COMMENT 'đây là chức vụ nhận thông báo, không phải chức vụ ngừơi gửi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `tai_khoan` (`tai_khoan`),
  ADD KEY `n4` (`chuc_vu`);

--
-- Chỉ mục cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD KEY `k9` (`id_khoi`);

--
-- Chỉ mục cho bảng `chat_lop`
--
ALTER TABLE `chat_lop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lop` (`id_lop`);

--
-- Chỉ mục cho bảng `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`id_hs`),
  ADD KEY `k2` (`id_lop`);

--
-- Chỉ mục cho bảng `giao_vien`
--
ALTER TABLE `giao_vien`
  ADD PRIMARY KEY (`id_gv`),
  ADD UNIQUE KEY `tai_khoan` (`tai_khoan`),
  ADD KEY `n2` (`chuc_vu`);

--
-- Chỉ mục cho bảng `hoc_sinh`
--
ALTER TABLE `hoc_sinh`
  ADD PRIMARY KEY (`id_hs`),
  ADD UNIQUE KEY `tai_khoan` (`tai_khoan`),
  ADD KEY `n9` (`id_lop`),
  ADD KEY `n11` (`chuc_vu`);

--
-- Chỉ mục cho bảng `khoi`
--
ALTER TABLE `khoi`
  ADD PRIMARY KEY (`id_khoi`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id_lop`),
  ADD UNIQUE KEY `ten_lop` (`ten_lop`),
  ADD KEY `n7` (`id_gv`),
  ADD KEY `k4` (`id_khoi`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`chuc_vu`);

--
-- Chỉ mục cho bảng `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chuc_vu` (`chuc_vu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `chat_lop`
--
ALTER TABLE `chat_lop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `diem`
--
ALTER TABLE `diem`
  MODIFY `id_hs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `giao_vien`
--
ALTER TABLE `giao_vien`
  MODIFY `id_gv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hoc_sinh`
--
ALTER TABLE `hoc_sinh`
  MODIFY `id_hs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `lop`
--
ALTER TABLE `lop`
  MODIFY `id_lop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thong_bao`
--
ALTER TABLE `thong_bao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `n4` FOREIGN KEY (`chuc_vu`) REFERENCES `quyen` (`chuc_vu`);

--
-- Các ràng buộc cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD CONSTRAINT `k9` FOREIGN KEY (`id_khoi`) REFERENCES `khoi` (`id_khoi`);

--
-- Các ràng buộc cho bảng `chat_lop`
--
ALTER TABLE `chat_lop`
  ADD CONSTRAINT `chat_lop_ibfk_1` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id_lop`);

--
-- Các ràng buộc cho bảng `diem`
--
ALTER TABLE `diem`
  ADD CONSTRAINT `k1` FOREIGN KEY (`id_hs`) REFERENCES `hoc_sinh` (`id_hs`),
  ADD CONSTRAINT `k2` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id_lop`);

--
-- Các ràng buộc cho bảng `giao_vien`
--
ALTER TABLE `giao_vien`
  ADD CONSTRAINT `n2` FOREIGN KEY (`chuc_vu`) REFERENCES `quyen` (`chuc_vu`);

--
-- Các ràng buộc cho bảng `hoc_sinh`
--
ALTER TABLE `hoc_sinh`
  ADD CONSTRAINT `n11` FOREIGN KEY (`chuc_vu`) REFERENCES `quyen` (`chuc_vu`),
  ADD CONSTRAINT `n9` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id_lop`);

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `k4` FOREIGN KEY (`id_khoi`) REFERENCES `khoi` (`id_khoi`),
  ADD CONSTRAINT `n7` FOREIGN KEY (`id_gv`) REFERENCES `giao_vien` (`id_gv`);

--
-- Các ràng buộc cho bảng `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD CONSTRAINT `thong_bao_ibfk_1` FOREIGN KEY (`chuc_vu`) REFERENCES `quyen` (`chuc_vu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
