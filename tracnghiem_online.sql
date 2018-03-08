-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th3 08, 2018 lúc 04:35 PM
-- Phiên bản máy phục vụ: 10.1.29-MariaDB
-- Phiên bản PHP: 7.2.0

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
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` int(1) DEFAULT '1',
  `last_login` datetime NOT NULL,
  `gender_id` int(1) NOT NULL DEFAULT '1',
  `avatar` varchar(255) DEFAULT 'avatar-default.jpg',
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `email`, `password`, `name`, `permission`, `last_login`, `gender_id`, `avatar`, `birthday`) VALUES
(1, 'admin', 'dzu6996@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 1, '2018-03-07 20:15:59', 1, 'admin_201756a1fdba-26f1-4d69-9c16-447ced66f994.jpg', '2018-01-20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chats`
--

CREATE TABLE `chats` (
  `ID` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `time_sent` datetime NOT NULL,
  `chat_content` text COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chats`
--

INSERT INTO `chats` (`ID`, `username`, `name`, `time_sent`, `chat_content`, `class_id`) VALUES
(1, '2017HS2', 'Lều Tuấn Anh', '2018-01-12 00:04:35', 'Chào mọi người, mình là học sinh mới', 1),
(2, '2017HS2', 'Lều Tuấn Anh', '2018-01-12 00:04:43', 'cùng nhau giúp đỡ nhé', 1),
(3, '2017HS1', 'Trần Phúc An', '2018-01-12 00:05:50', 'Mình là lớp trưởng, có gì bạn liện mình nhé, mai mọi người đi học đầy đủ nha', 1),
(4, '2017HS1', 'Trần Phúc An', '2018-01-12 00:05:58', 'Bye', 1),
(5, '2017HS3', 'Phạm Văn Bội', '2018-01-12 00:06:24', 'Mai tớ nghỉ nhé, mai nhà tớ có việc', 1),
(6, '2017HS3', 'Phạm Văn Bội', '2018-01-12 00:06:34', 'có gì viết giấy hộ tớ với', 1),
(7, '2017HS4', 'Trần Khánh Duy', '2018-01-12 00:06:58', 'Đừng nghe nó', 1),
(8, '2017HS4', 'Trần Khánh Duy', '2018-01-12 00:07:09', 'nó toàn chém đó, đi chơi net thì có', 1),
(9, '2017HS5', 'Trần Thành Đạt', '2018-01-12 00:07:27', 'Tớ méc cô :D', 1),
(10, '2017HS5', 'Trần Thành Đạt', '2018-01-12 00:07:51', 'thức thời thì hối lộ anh em đi', 1),
(11, '2017HS6', 'Nguyễn Quang Điện', '2018-01-12 00:08:23', 'tớ lưu lại hết rồi :D', 1),
(12, '2017HS6', 'Nguyễn Quang Điện', '2018-01-12 00:08:29', 'khỏi ai chối nhé', 1),
(13, '2017HS1', 'Trần Phúc An', '2018-01-12 13:39:40', 'Cố lên', 1),
(14, '2017HS1', 'Trần Phúc An', '2018-03-08 19:41:27', 'Thứ 6 ngày 13', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`class_id`, `grade_id`, `class_name`, `teacher_id`) VALUES
(1, 3, 'Lớp 3A', 1),
(2, 3, 'Lớp 3B', 1),
(3, 3, 'Lớp 3C', 1),
(4, 3, 'Lớp 3D', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genders`
--

CREATE TABLE `genders` (
  `gender_id` int(1) NOT NULL,
  `gender_detail` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `genders`
--

INSERT INTO `genders` (`gender_id`, `gender_detail`) VALUES
(1, 'Không Xác Định'),
(2, 'Nam'),
(3, 'Nữ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `detail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `grades`
--

INSERT INTO `grades` (`grade_id`, `detail`) VALUES
(1, 'Lớp 1'),
(2, 'Lớp 2'),
(3, 'Lớp 3'),
(4, 'Lớp 4'),
(5, 'Lớp 5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `notification_title` text COLLATE utf8_unicode_ci NOT NULL,
  `notification_content` text COLLATE utf8_unicode_ci NOT NULL,
  `time_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`notification_id`, `username`, `name`, `notification_title`, `notification_content`, `time_sent`) VALUES
(1, 'giaovien', 'Nguyễn Thị Hương', 'Thông Báo!', 'Các em nộp hết bảo hiểm y tế trong tuần này nhé, \r\nai không nộp bị trừ điểm rèn luyện nhé.', '2018-01-12 00:10:22'),
(2, 'Admin', 'Admin', 'Thông Báo!', 'Thông báo tất cả cán bộ chủ nhiệm lớp nhanh chóng hoàn thành tiền bảo hiểm y tế của lớp trong tuần này.', '2018-01-12 00:11:24'),
(3, 'Admin', 'Admin', 'Thông Báo!', 'từ ngày 13/01/2018 nhà trường mở đăng ký học phần kỳ 2, các em theo dõi và đăng ký nhé.', '2018-01-12 00:12:39'),
(4, 'admin', 'Admin', 'Thông Báo!', 'từ 20/01/2018. nhà trường mở đăng ký thi lại, các em chú ý xem lịch để đăng ký.', '2018-01-12 00:18:52'),
(5, 'giaovien', 'Nguyễn Thị Hương', 'Thông Báo!', 'Tết đựoc nghỉ 1 tháng nhé các em.', '2018-01-12 13:52:27'),
(6, 'admin', 'Admin', 'Thông Báo!', 'Các đồng chí nhanh chóng hoàn thành danh sách học sinh nhận học bổng kỳ 2017', '2018-01-12 14:40:45'),
(7, 'admin', 'Admin', 'Thông Báo!', 'Các đồng chí nhanh chóng hoàn thành danh sách học sinh nhận học bổng kỳ 2017', '2018-01-12 14:40:49'),
(8, 'giaovien', 'Nguyễn Thị Hương', 'Thông Báo', 'Các em làm bài tập để tuần sau nộp nhé', '2018-01-12 18:20:21'),
(9, 'giaovien', 'Nguyễn Thị Hương', 'Thông Báo', 'Thông báo cập nhật lịch học', '2018-01-12 18:25:23'),
(10, 'giaovien', 'Nguyễn Thị Hương', 'Thông Báo', 'Cạp nhật nhỉ lễ nguyên đán', '2018-01-12 18:26:25'),
(18, 'admin', 'Admin', 'Thông Báo Nghỉ Tết', 'Các đồng chí quán triệt cam kết cấm đốt pháo với lớp mình', '2018-01-22 09:07:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `permission` int(11) NOT NULL,
  `permission_detail` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`permission`, `permission_detail`) VALUES
(1, 'Admin'),
(2, 'Giáo Viên'),
(3, 'Học Sinh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `grade_id` int(10) NOT NULL,
  `unit` int(2) NOT NULL,
  `question_detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_a` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_b` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_c` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_d` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `correct_answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ID` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`grade_id`, `unit`, `question_detail`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `correct_answer`, `ID`, `subject_id`) VALUES
(3, 1, '30 - 12 = ?', '10', '15', '18', '82', '18', 1, 1),
(3, 1, '5 + 7 = ?', '12', '13', '14', '11', '12', 2, 1),
(3, 1, '5 + 9 = ?', '13', '15', '17', '14', '14', 3, 1),
(3, 1, '2 x 1 = ?', '1', '2', '3', '4', '2', 4, 1),
(3, 1, '11 + 2 = ?', '15', '16', '13', '18', '13', 5, 1),
(3, 1, '18 + 5 = ?', '20', '21', '22', '23', '23', 6, 1),
(3, 1, '14 + 8 = ?', '20', '21', '22', '23', '22', 7, 1),
(3, 1, '13 - 3 = ?', '7', '8', '9', '10', '10', 8, 1),
(3, 1, '14 - 7 = ?', '7', '6', '5', '8', '7', 9, 1),
(3, 1, '10 - 8 = ?', '2', '3', '4', '5', '2', 10, 1),
(3, 1, '3 + 6 = ?', '7', '6', '9', '8', '9', 11, 1),
(3, 2, '5+10 ?', '15', '10', '5', '4', '15', 12, 1),
(3, 2, '2 x 7 = ?', '14', '16', '18', '12', '14', 13, 1),
(3, 2, '2 x 9 = ?', '14', '16', '18', '12', '18', 14, 1),
(3, 2, '3 x 7 = ?', '14', '16', '18', '21', '21', 15, 1),
(3, 2, '3 x 5 = ?', '14', '16', '15', '12', '15', 16, 1),
(3, 2, '4 x 10 = ?', '40', '4', '10', '1', '40', 17, 1),
(3, 2, '2 x 10 = ?', '14', '16', '18', '20', '20', 18, 1),
(3, 2, '10 + 20 = ?', '10', '20', '30', '03', '30', 19, 1),
(3, 2, '10 x 10 = ?', '10', '20', '100', '11', '100', 20, 1),
(3, 2, '2 x 5 = ?', '14', '16', '10', '12', '10', 21, 1),
(3, 3, '4 x 7 =?', '27', '28', '29', '30', '28', 22, 1),
(3, 3, '10 * 0 = ?', '10', '0', '1', '11', '0', 23, 1),
(3, 3, '4 x 5 =?', '27', '28', '29', '20', '20', 24, 1),
(3, 3, '5 x 8 =?', '37', '38', '39', '40', '40', 25, 1),
(3, 3, '5 x 5 =?', '27', '28', '25', '30', '25', 26, 1),
(3, 3, '7 x 9 = ?', '61', '63', '65', '67', '63', 27, 1),
(3, 3, '7 x 7 = ?', '41', '43', '45', '49', '49', 28, 1),
(3, 3, '7 x 8 = ?', '61', '63', '56', '67', '56', 29, 1),
(3, 3, '9 x 9 = ?', '81', '63', '65', '67', '81', 30, 1),
(3, 3, '6 x 9 = ?', '61', '63', '65', '54', '54', 31, 1),
(3, 4, '21 : 3 = ?', '5', '6', '7', '8', '7', 32, 1),
(3, 4, '24 : 8 = ?', '1', '2', '3', '4', '3', 33, 1),
(3, 4, '27 : 3 = ?', '6', '7', '8', '9', '9', 34, 1),
(3, 4, '32 : 8 = ?', '1', '2', '3', '4', '4', 35, 1),
(3, 4, '25 : 5 = ?', '5', '2', '3', '4', '5', 36, 1),
(3, 4, '42 : 7 = ?', '6', '5', '3', '4', '6', 37, 1),
(3, 4, '56 : 8 = ?', '8', '7', '3', '4', '7', 38, 1),
(3, 4, '81 : 9 = ?', '7', '8', '9', '81', '9', 39, 1),
(3, 4, '40 : 8 = ?', '5', '2', '3', '4', '5', 40, 1),
(1, 4, '18 : 9 = ?', '1', '2', '3', '4', '2', 41, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `scores`
--

CREATE TABLE `scores` (
  `ID` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `unit` int(2) NOT NULL,
  `score` int(2) DEFAULT NULL,
  `class_id` int(11) NOT NULL,
  `completion_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `scores`
--

INSERT INTO `scores` (`ID`, `student_id`, `unit`, `score`, `class_id`, `completion_time`) VALUES
(1, 1, 1, 6, 1, '2018-01-18 03:00:10'),
(3, 1, 3, 3, 1, '2018-01-18 00:17:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(1) NOT NULL,
  `detail` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `statuses`
--

INSERT INTO `statuses` (`status_id`, `detail`) VALUES
(1, 'Mở'),
(2, 'Đóng'),
(3, 'Chờ Đóng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` int(1) DEFAULT '3',
  `class_id` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `gender_id` int(1) NOT NULL DEFAULT '1',
  `avatar` varchar(255) DEFAULT 'avatar-default.jpg',
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`student_id`, `username`, `email`, `password`, `name`, `permission`, `class_id`, `last_login`, `gender_id`, `avatar`, `birthday`) VALUES
(1, '2017HS1', 'example1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Phúc An', 3, 1, '2018-03-08 22:35:00', 1, '2017HS1_Download Wallpaper 1920x1080 Anime, Face, Hair, Mask Full HD 1080p HD Background.jpg', '2018-01-25'),
(2, '2017HS2', 'example2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lều Tuấn Anh', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(3, '2017HS3', 'example3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Bội', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(4, '2017HS4', 'example4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Khánh Duy', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(5, '2017HS5', 'example5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Thành Đạt', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(6, '2017HS6', 'example6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Quang Điện', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(7, '2017HS7', 'example7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Thị Diệu Hằng', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(8, '2017HS8', 'example8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Khánh Hoàng', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(9, '2017HS9', 'example9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Khánh Linh', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(10, '2017HS10', 'example10@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ngô Trần Khôi', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(11, '2017HS11', 'example11@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Thị Khánh Ly', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(12, '2017HS12', 'example12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Phương Mai', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(13, '2017HS13', 'example13@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ Thị Mùi', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(14, '2017HS14', 'example14@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bùi Kim Oanh', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(15, '2017HS15', 'example15@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Kiều Oanh', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(16, '2017HS16', 'example16@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị Hà', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(17, '2017HS17', 'example17@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị G', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(18, '2017HS18', 'example18@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị H', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(19, '2017HS19', 'example19@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Thị Khánh Ly', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '0000-00-00'),
(20, '2017HS20', 'example20@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vũ Huy Hoàng', 3, 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '2018-01-02'),
(21, '2017HS21', 'example21@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Văn Thịnh', 3, 2, '2018-01-26 02:06:09', 1, 'avatar-default.jpg', '2018-01-26'),
(22, '2017HS22', 'example22@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Thi', 3, 3, '2018-01-26 02:06:09', 1, 'avatar-default.jpg', '2018-01-26'),
(23, '2017HS23', 'example23@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Thu', 3, 4, '2018-01-26 02:06:09', 1, 'avatar-default.jpg', '2018-01-26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_notifications`
--

CREATE TABLE `student_notifications` (
  `ID` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_notifications`
--

INSERT INTO `student_notifications` (`ID`, `notification_id`, `class_id`) VALUES
(1, 1, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_detail`) VALUES
(1, 'Toán'),
(2, 'Tiếng Anh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` int(1) DEFAULT '2',
  `last_login` datetime NOT NULL,
  `gender_id` int(1) NOT NULL DEFAULT '1',
  `avatar` varchar(255) DEFAULT 'avatar-default.jpg',
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `username`, `email`, `password`, `name`, `permission`, `last_login`, `gender_id`, `avatar`, `birthday`) VALUES
(1, 'giaovien', 'teacher1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Hương', 2, '2018-03-08 13:20:14', 1, 'giaovien_13692472_1251877004862630_5032812334842572056_n.jpg', '1990-01-18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher_notifications`
--

CREATE TABLE `teacher_notifications` (
  `ID` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher_notifications`
--

INSERT INTO `teacher_notifications` (`ID`, `notification_id`, `teacher_id`) VALUES
(2, 2, 1),
(5, 6, 1),
(6, 7, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `units`
--

CREATE TABLE `units` (
  `unit` int(2) NOT NULL,
  `detail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(1) NOT NULL DEFAULT '1',
  `close_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `units`
--

INSERT INTO `units` (`unit`, `detail`, `status_id`, `close_time`) VALUES
(1, 'Chương 1', 2, '2018-03-13 02:06:07'),
(2, 'Chương 2', 1, '0000-00-00 00:00:00'),
(3, 'Chương 3', 1, '0000-00-00 00:00:00'),
(4, 'Chương 4', 1, '0000-00-00 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `n4` (`permission`),
  ADD KEY `admins_gender_id` (`gender_id`);

--
-- Chỉ mục cho bảng `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `class_id` (`class_id`);

--
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_name` (`class_name`),
  ADD KEY `n7` (`teacher_id`),
  ADD KEY `k4` (`grade_id`);

--
-- Chỉ mục cho bảng `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Chỉ mục cho bảng `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `k9` (`grade_id`),
  ADD KEY `unit` (`unit`),
  ADD KEY `subjects_key` (`subject_id`);

--
-- Chỉ mục cho bảng `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `unit` (`unit`),
  ADD KEY `class_id` (`class_id`);

--
-- Chỉ mục cho bảng `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `n9` (`class_id`),
  ADD KEY `n11` (`permission`),
  ADD KEY `students_gender_id` (`gender_id`);

--
-- Chỉ mục cho bảng `student_notifications`
--
ALTER TABLE `student_notifications`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `notification_id` (`notification_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Chỉ mục cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Chỉ mục cho bảng `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `n2` (`permission`),
  ADD KEY `teachers_gender_id` (`gender_id`);

--
-- Chỉ mục cho bảng `teacher_notifications`
--
ALTER TABLE `teacher_notifications`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `notification_id` (`notification_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Chỉ mục cho bảng `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit`),
  ADD KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `chats`
--
ALTER TABLE `chats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `scores`
--
ALTER TABLE `scores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `student_notifications`
--
ALTER TABLE `student_notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `teacher_notifications`
--
ALTER TABLE `teacher_notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `units`
--
ALTER TABLE `units`
  MODIFY `unit` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_gender_id` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`),
  ADD CONSTRAINT `n4` FOREIGN KEY (`permission`) REFERENCES `permissions` (`permission`);

--
-- Các ràng buộc cho bảng `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chat_classes_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Các ràng buộc cho bảng `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `k9` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `units` (`unit`),
  ADD CONSTRAINT `subjects_key` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Các ràng buộc cho bảng `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`unit`) REFERENCES `units` (`unit`),
  ADD CONSTRAINT `scores_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Các ràng buộc cho bảng `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `n11` FOREIGN KEY (`permission`) REFERENCES `permissions` (`permission`),
  ADD CONSTRAINT `n9` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `students_gender_id` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`);

--
-- Các ràng buộc cho bảng `student_notifications`
--
ALTER TABLE `student_notifications`
  ADD CONSTRAINT `student_notifications_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`notification_id`),
  ADD CONSTRAINT `student_notifications_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Các ràng buộc cho bảng `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `n2` FOREIGN KEY (`permission`) REFERENCES `permissions` (`permission`),
  ADD CONSTRAINT `teachers_gender_id` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`);

--
-- Các ràng buộc cho bảng `teacher_notifications`
--
ALTER TABLE `teacher_notifications`
  ADD CONSTRAINT `teacher_notifications_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`notification_id`),
  ADD CONSTRAINT `teacher_notifications_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Các ràng buộc cho bảng `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
