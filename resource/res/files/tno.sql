-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 21, 2019 lúc 03:22 AM
-- Phiên bản máy phục vụ: 10.1.31-MariaDB
-- Phiên bản PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tno`
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
(1, 'admin', 'admin@ikun.org', 'e10adc3949ba59abbe56e057f20f883e', 'ADMIN', 1, '2019-02-21 09:17:30', 1, 'avatar-default.jpg', '1997-01-01');

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
(1, 1, 'Lớp 1A', 1),
(2, 1, 'Lớp 1B', 1);

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
(1, 'Chưa Xác Định'),
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
(1, 'Khối 1'),
(2, 'Khối 2'),
(3, 'Khối 3'),
(4, 'Khối 4'),
(5, 'Khối 5'),
(6, 'Khối 6'),
(7, 'Khối 7'),
(8, 'Khối 8'),
(9, 'Khối 9'),
(10, 'Khối 10'),
(11, 'Khối 11'),
(12, 'Khối 12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `levels`
--

CREATE TABLE `levels` (
  `level_id` int(11) NOT NULL,
  `level_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `levels`
--

INSERT INTO `levels` (`level_id`, `level_detail`) VALUES
(1, 'Dễ'),
(2, 'Trung Bình'),
(3, 'Khó');

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
  `level_id` int(11) NOT NULL,
  `question_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_a` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_b` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_c` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_d` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `correct_answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL DEFAULT '1',
  `sent_by` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`grade_id`, `unit`, `level_id`, `question_content`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `correct_answer`, `question_id`, `subject_id`, `sent_by`, `status_id`) VALUES
(1, 1, 1, '30 - 12 = ?', '10', '15', '18', '82', '18', 1, 1, 'Admin', 4),
(1, 1, 1, '5 + 7 = ?', '12', '13', '14', '11', '12', 2, 1, 'Admin', 4),
(1, 1, 1, '5 + 9 = ?', '13', '15', '17', '14', '14', 3, 1, 'Admin', 4),
(1, 1, 2, '2 x 1 = ?', '1', '2', '3', '4', '2', 4, 1, 'Admin', 4),
(1, 1, 2, '11 + 2 = ?', '15', '16', '13', '18', '13', 5, 1, 'Admin', 4),
(1, 1, 2, '18 + 5 = ?', '20', '21', '22', '23', '23', 6, 1, 'Admin', 4),
(1, 1, 3, '14 + 8 = ?', '20', '21', '22', '23', '22', 7, 1, 'Admin', 4),
(1, 1, 3, '13 - 3 = ?', '7', '8', '9', '10', '10', 8, 1, 'Admin', 4),
(1, 1, 3, '14 - 7 = ?', '7', '6', '5', '8', '7', 9, 1, 'Admin', 4),
(1, 2, 1, '10 - 8 = ?', '2', '3', '4', '5', '2', 10, 1, 'Admin', 4),
(1, 2, 1, '3 + 6 = ?', '7', '6', '9', '8', '9', 11, 1, 'Admin', 4),
(1, 2, 1, '5+10 ?', '15', '10', '5', '4', '15', 12, 1, 'Admin', 4),
(1, 2, 2, '2 x 7 = ?', '14', '16', '18', '12', '14', 13, 1, 'Admin', 4),
(1, 2, 2, '2 x 9 = ?', '14', '16', '18', '12', '18', 14, 1, 'Admin', 4),
(1, 2, 2, '3 x 7 = ?', '14', '16', '18', '21', '21', 15, 1, 'Admin', 4),
(1, 2, 3, '3 x 5 = ?', '14', '16', '15', '12', '15', 16, 1, 'Admin', 4),
(1, 2, 3, '4 x 10 = ?', '40', '4', '10', '1', '40', 17, 1, 'Admin', 4),
(1, 2, 3, '2 x 10 = ?', '14', '16', '18', '20', '20', 18, 1, 'Admin', 4),
(1, 2, 3, '10 + 20 = ?', '10', '20', '30', '03', '30', 19, 1, 'Admin', 4),
(1, 3, 1, '10 x 10 = ?', '10', '20', '100', '11', '100', 20, 1, 'Admin', 4),
(1, 3, 1, '2 x 5 = ?', '14', '16', '10', '12', '10', 21, 1, 'Admin', 4),
(1, 3, 1, '4 x 7 =?', '27', '28', '29', '30', '28', 22, 1, 'Admin', 4),
(1, 3, 2, '10 * 0 = ?', '10', '0', '1', '11', '0', 23, 1, 'Admin', 4),
(1, 3, 2, '4 x 5 =?', '27', '28', '29', '20', '20', 24, 1, 'Admin', 4),
(1, 3, 2, '5 x 8 =?', '37', '38', '39', '40', '40', 25, 1, 'Admin', 4),
(1, 3, 3, '5 x 5 =?', '27', '28', '25', '30', '25', 26, 1, 'Admin', 4),
(1, 3, 3, '7 x 9 = ?', '61', '63', '65', '67', '63', 27, 1, 'Admin', 4),
(1, 3, 3, '7 x 7 = ?', '41', '43', '45', '49', '49', 28, 1, 'Admin', 4),
(1, 3, 3, '7 x 8 = ?', '61', '63', '56', '67', '56', 29, 1, 'Admin', 4),
(1, 4, 1, '9 x 9 = ?', '81', '63', '65', '67', '81', 30, 1, 'Admin', 4),
(1, 4, 1, '6 x 9 = ?', '61', '63', '65', '54', '54', 31, 1, 'Admin', 4),
(1, 4, 1, '21 : 3 = ?', '5', '6', '7', '8', '7', 32, 1, 'Admin', 4),
(1, 4, 2, '24 : 8 = ?', '1', '2', '3', '4', '3', 33, 1, 'Admin', 4),
(1, 4, 2, '27 : 3 = ?', '6', '7', '8', '9', '9', 34, 1, 'Admin', 1),
(1, 4, 2, '32 : 8 = ?', '1', '2', '3', '4', '4', 35, 1, 'Admin', 4),
(1, 4, 1, '25 : 5 = ?', '5', '2', '3', '4', '5', 36, 1, 'Admin', 4),
(1, 4, 1, '42 : 7 = ?', '6', '5', '3', '4', '6', 37, 1, 'Admin', 4),
(1, 4, 2, '56 : 8 = ?', '8', '7', '3', '4', '7', 38, 1, 'Admin', 4),
(1, 4, 2, '81 : 9 = ?', '7', '8', '9', '81', '9', 39, 1, 'Admin', 4),
(1, 4, 3, '40 : 8 = ?', '5', '2', '3', '4', '5', 40, 1, 'Admin', 4),
(1, 4, 3, '18 : 9 = ?', '1', '2', '3', '4', '2', 41, 1, 'Admin', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quest_of_test`
--

CREATE TABLE `quest_of_test` (
  `test_code` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `timest` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quest_of_test`
--

INSERT INTO `quest_of_test` (`test_code`, `question_id`, `timest`) VALUES
(587581, 1, '2019-02-21 01:55:19'),
(587581, 3, '2019-02-21 01:55:19'),
(587581, 4, '2019-02-21 01:55:19'),
(587581, 6, '2019-02-21 01:55:19'),
(587581, 8, '2019-02-21 01:55:19'),
(587581, 9, '2019-02-21 01:55:19'),
(587581, 10, '2019-02-21 01:55:19'),
(587581, 12, '2019-02-21 01:55:19'),
(587581, 13, '2019-02-21 01:55:19'),
(587581, 15, '2019-02-21 01:55:19'),
(587581, 18, '2019-02-21 01:55:19'),
(587581, 19, '2019-02-21 01:55:19'),
(587581, 20, '2019-02-21 01:55:19'),
(587581, 22, '2019-02-21 01:55:19'),
(587581, 23, '2019-02-21 01:55:19'),
(587581, 25, '2019-02-21 01:55:19'),
(587581, 26, '2019-02-21 01:55:19'),
(587581, 29, '2019-02-21 01:55:19'),
(587581, 30, '2019-02-21 01:55:19'),
(587581, 31, '2019-02-21 01:55:19'),
(587581, 32, '2019-02-21 01:55:19'),
(587581, 33, '2019-02-21 01:55:19'),
(587581, 34, '2019-02-21 01:55:19'),
(587581, 35, '2019-02-21 01:55:19'),
(587581, 36, '2019-02-21 01:55:19'),
(587581, 37, '2019-02-21 01:55:19'),
(587581, 38, '2019-02-21 01:55:19'),
(587581, 39, '2019-02-21 01:55:19'),
(587581, 40, '2019-02-21 01:55:19'),
(587581, 41, '2019-02-21 01:55:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `scores`
--

CREATE TABLE `scores` (
  `student_id` int(11) NOT NULL,
  `test_code` int(11) NOT NULL,
  `score_number` varchar(10) DEFAULT NULL,
  `score_detail` varchar(50) NOT NULL,
  `completion_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(3, 'Chờ Duyệt'),
(4, 'Đã Duyệt');

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
  `birthday` date NOT NULL,
  `doing_exam` int(11) DEFAULT NULL,
  `starting_time` datetime DEFAULT NULL,
  `time_remaining` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`student_id`, `username`, `email`, `password`, `name`, `permission`, `class_id`, `last_login`, `gender_id`, `avatar`, `birthday`, `doing_exam`, `starting_time`, `time_remaining`) VALUES
(1, '2017HS1', 'example1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Phúc An', 3, 1, '2019-02-21 09:22:31', 2, 'avatar-default.jpg', '2008-01-25', NULL, NULL, NULL),
(2, '2017HS2', 'example2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lều Tuấn Anh', 3, 1, '2018-11-15 19:37:31', 1, 'avatar-default.jpg', '2008-09-07', NULL, NULL, NULL),
(3, '2017HS3', 'example3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Bội', 3, 1, '2018-11-16 08:50:02', 1, 'avatar-default.jpg', '2008-12-01', NULL, NULL, NULL),
(4, '2017HS4', 'example4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Khánh Duy', 3, 1, '2018-09-20 04:19:27', 1, 'avatar-default.jpg', '2008-05-10', NULL, NULL, NULL),
(5, '2017HS5', 'example5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Thành Đạt', 3, 1, '2018-09-19 04:09:18', 1, 'avatar-default.jpg', '2008-05-03', NULL, NULL, NULL),
(6, '2017HS6', 'example6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Quang Điện', 3, 1, '2018-09-24 06:13:23', 1, 'avatar-default.jpg', '2008-10-10', NULL, NULL, NULL),
(7, '2017HS7', 'example7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Thị Diệu Hằng', 3, 1, '2018-09-26 05:17:17', 1, 'avatar-default.jpg', '2008-02-03', NULL, NULL, NULL),
(8, '2017HS8', 'example8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Khánh Hoàng', 3, 1, '2018-09-18 06:17:12', 1, 'avatar-default.jpg', '2008-01-01', NULL, NULL, NULL),
(9, '2017HS9', 'example9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Khánh Linh', 3, 1, '2018-09-18 05:10:10', 1, 'avatar-default.jpg', '2008-01-03', NULL, NULL, NULL),
(10, '2017HS10', 'example10@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ngô Trần Khôi', 3, 1, '2018-09-28 06:17:28', 1, 'avatar-default.jpg', '2008-04-06', NULL, NULL, NULL),
(11, '2017HS11', 'example11@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Thị Khánh Ly', 3, 1, '2018-09-20 03:13:13', 1, 'avatar-default.jpg', '2008-01-03', NULL, NULL, NULL),
(12, '2017HS12', 'example12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Phương Mai', 3, 1, '2018-09-20 09:13:13', 1, 'avatar-default.jpg', '2008-01-06', NULL, NULL, NULL),
(13, '2017HS13', 'example13@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ Thị Mùi', 3, 1, '2018-09-20 03:07:11', 1, 'avatar-default.jpg', '2008-09-13', NULL, NULL, NULL),
(14, '2017HS14', 'example14@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bùi Kim Oanh', 3, 1, '2018-09-20 10:23:16', 1, 'avatar-default.jpg', '2008-10-30', NULL, NULL, NULL),
(15, '2017HS15', 'example15@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Kiều Oanh', 3, 1, '2018-09-15 00:00:00', 1, 'avatar-default.jpg', '2008-11-20', NULL, NULL, NULL),
(16, '2017HS16', 'example16@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị Hà', 3, 1, '2018-09-22 08:17:14', 1, 'avatar-default.jpg', '2008-03-26', NULL, NULL, NULL),
(17, '2017HS17', 'example17@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị G', 3, 1, '2018-09-14 06:15:15', 1, 'avatar-default.jpg', '2008-01-12', NULL, NULL, NULL),
(18, '2017HS18', 'example18@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị H', 3, 1, '2018-09-21 10:20:11', 1, 'avatar-default.jpg', '2008-01-03', NULL, NULL, NULL),
(19, '2017HS19', 'example19@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Thị Khánh Ly', 3, 1, '2018-09-20 06:14:11', 1, 'avatar-default.jpg', '2008-06-06', NULL, NULL, NULL),
(20, '2017HS20', 'example20@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vũ Huy Hoàng', 3, 1, '2018-09-28 13:12:12', 1, 'avatar-default.jpg', '2008-01-02', NULL, NULL, NULL),
(21, '2017HS21', 'example21@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Văn Thịnh', 3, 1, '2018-01-26 02:06:09', 1, 'avatar-default.jpg', '2008-01-26', NULL, NULL, NULL),
(22, '2017HS22', 'example22@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Thi', 3, 1, '2018-01-26 02:06:09', 1, 'avatar-default.jpg', '2008-01-26', NULL, NULL, NULL),
(23, '2017HS23', 'example23@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Nguyễn Thị Thu', 3, 1, '2018-11-16 10:48:33', 1, 'avatar-default.jpg', '2008-01-26', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_notifications`
--

CREATE TABLE `student_notifications` (
  `ID` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_test_detail`
--

CREATE TABLE `student_test_detail` (
  `ID` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `test_code` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_a` text COLLATE utf8_unicode_ci,
  `answer_b` text COLLATE utf8_unicode_ci,
  `answer_c` text COLLATE utf8_unicode_ci,
  `answer_d` text COLLATE utf8_unicode_ci,
  `student_answer` text COLLATE utf8_unicode_ci,
  `timest` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 'Toán');

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
(1, 'giaovien', 'giaovien@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'giaovien', 2, '2019-02-21 09:21:15', 3, 'avatar-default.jpg', '1997-01-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher_notifications`
--

CREATE TABLE `teacher_notifications` (
  `ID` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tests`
--

CREATE TABLE `tests` (
  `test_code` int(11) NOT NULL,
  `test_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_id` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `time_to_do` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `timest` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tests`
--

INSERT INTO `tests` (`test_code`, `test_name`, `password`, `subject_id`, `grade_id`, `total_questions`, `time_to_do`, `note`, `status_id`, `timest`) VALUES
(587581, 'Thi Thử', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 30, 30, 'Không', 1, '2019-02-21 01:55:29');

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
-- Chỉ mục cho bảng `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

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
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `k9` (`grade_id`),
  ADD KEY `unit` (`unit`),
  ADD KEY `subjects_key` (`subject_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Chỉ mục cho bảng `quest_of_test`
--
ALTER TABLE `quest_of_test`
  ADD PRIMARY KEY (`test_code`,`question_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `test_code` (`test_code`);

--
-- Chỉ mục cho bảng `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`student_id`,`test_code`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `test_code` (`test_code`);

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
-- Chỉ mục cho bảng `student_test_detail`
--
ALTER TABLE `student_test_detail`
  ADD PRIMARY KEY (`student_id`,`test_code`,`question_id`),
  ADD KEY `fk4` (`test_code`),
  ADD KEY `fk6` (`question_id`);

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
-- Chỉ mục cho bảng `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_code`),
  ADD KEY `fk1` (`subject_id`),
  ADD KEY `fk2` (`status_id`),
  ADD KEY `grade_id` (`grade_id`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `student_notifications`
--
ALTER TABLE `student_notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `teacher_notifications`
--
ALTER TABLE `teacher_notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tests`
--
ALTER TABLE `tests`
  MODIFY `test_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=587582;

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
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`);

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `k9` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `levels` (`level_id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `subjects_key` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Các ràng buộc cho bảng `quest_of_test`
--
ALTER TABLE `quest_of_test`
  ADD CONSTRAINT `quest_of_test_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `quest_of_test_ibfk_2` FOREIGN KEY (`test_code`) REFERENCES `tests` (`test_code`);

--
-- Các ràng buộc cho bảng `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`test_code`) REFERENCES `tests` (`test_code`);

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
-- Các ràng buộc cho bảng `student_test_detail`
--
ALTER TABLE `student_test_detail`
  ADD CONSTRAINT `fk4` FOREIGN KEY (`test_code`) REFERENCES `tests` (`test_code`),
  ADD CONSTRAINT `fk6` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `fk9` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

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
-- Các ràng buộc cho bảng `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
