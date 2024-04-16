-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 11, 2022 lúc 08:16 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `final_web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET latin1 NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `acc_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `level_log` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `department_belong` int(11) NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`ID`, `first_name`, `last_name`, `avatar`, `username`, `acc_password`, `default_pass`, `level_log`, `position`, `department_belong`, `address`) VALUES
(1, 'Huynh', 'Cuong', 'IMG-61db8cbed2dca7.84221207.jpg', 'admin', '$2y$10$aQj21E9A6GRPSV1tNyG0V.QEKdE3.OJmC7l91Hkoz5hjNKhbZmL56', '', 'admin', 'Director', 101, 'VietNam'),
(100012, 'Astin', 'Baber', 'IMG-61daa0045f3584.91661127.jpg', 'astin12523', '$2y$10$OnKURYKy9IdS95MPMN3lveMkLi19jDhyP0Wh8h4ZNyQudvQ5j.s7O', '', 'user', 'Facebook Marketing', 102, 'Houston, Texas'),
(100013, 'Batcheller', 'Amis', 'IMG-61da9fe72571b9.84775112.jpg', 'amis0985', '$2y$10$1hmmtBH6uM.IWbDgekySMuaaEGR5mZSKdOcPsjkdlq6dcU9TB2w5i', '', 'user', 'Marketing Analyst', 102, 'Houston, Texas'),
(100014, 'Keaton', 'Bullard', 'IMG-61da9fac29b376.13426974.png', 'keaton2131', '$2y$10$0auGyhWZ24P.YX5gz/YdtuhLSM59XmYX9FGMXMGRtDN9kGaq4MBmG', '', 'user', 'Email marketer', 102, 'Miama, Florida'),
(100015, 'Lord', 'Rainbow', 'IMG-61da9f91644e30.59852290.jpg', 'lord1432', '$2y$10$1bXUAeJoPwa/L8.aZikPWuC392zBXqPIG5PxxqNjbYt63pKvYvZcq', '', 'user', 'Publicity Assistant', 102, 'Miama, Florida'),
(100016, 'Ethan', 'Jennings', 'IMG-61da9fc7784451.66111342.png', 'ethan5435', '$2y$10$ZANfltvZ7zT0ZKBrsq68JOG/IyiHqxh09xa7/GqmsgjPHJaksD3je', '', 'head', 'Marketing Manager', 102, 'Atlanta, Georgia'),
(200021, 'Horace', 'Mccabe', 'IMG-61daa285d71462.78878551.png', 'maccabe3231', '$2y$10$7jBXEEqeX40kMSVlgf7wWu2cU51kg5G7Xw6NnoObw/dmiUZF9LW2i', '', 'head', 'Recruitment Manager', 103, 'Chicago, Illinois'),
(200022, 'Enrique', 'Molina', 'IMG-61daa2afb64719.00022818.jpg', 'molina1234', '$2y$10$NDVwiYZk56YuEh7..0iZUeOFp/T99eseBzV2TojldHNmgMVoDo3Te', '', 'user', 'Recruiter', 103, 'Portland, Maine'),
(200023, 'Zaki', 'Cobb', 'IMG-61daa238639c68.40015615.jpg', 'cobb4234', '$2y$10$2LI6TpkvYcQHDgKtj.70geob.nxviN0RwptAc5sqR2vvpXK7xJzGm', '', 'user', 'HR Assistant', 103, 'Fargo, North Dakota'),
(200024, 'Jac', 'Berg', 'IMG-61daa26e57d6d9.38414470.jpg', 'jac54333', '$2y$10$yYlRtlkstCiHRNu406VZi.mYZ2HFpeBn/1r/dq6KHlbQzqKwfd9Uq', '', 'user', 'Employment Specialist', 103, 'Raleigh, North Carolina'),
(200025, 'Parris', 'Colon', 'IMG-61daa252cbe236.09459106.jpg', 'colon43543', '$2y$10$F.BJZSX0CkwK2oQpa3WZXOvv1xiNljV5mDgmZ3DfCw1V.tcfS4ih.', '', 'user', 'HR Coordinator', 103, 'Houston, Texas'),
(300031, 'Ashley', 'Collins', 'IMG-61dcd489152150.64296025.jpg', 'ashley_123', '$2y$10$0bkvFLf5eD6Jo99l5V2bue4ohRseVlRvApuD3.vBiv76fNS1hjgb2', '', 'user', 'Front-end Developer', 104, 'Seattle, Washington'),
(300032, 'Korban', 'Ramos', 'IMG-61dcd4a4b3b372.63341856.png', 'ramos432', '$2y$10$.tu5Aaopksq87JyVPXq88eSA7P6UEWp7j8ZCWBkb/wRt/wl4Z6aI6', '', 'user', 'Front-end Developer', 104, 'Columbia, South Carolina'),
(300033, 'Ronan', 'Macgregor', 'IMG-61dcd4bcb14206.58345327.jpg', 'macgregor4234', '$2y$10$ycK3zFFG5l5qxfd/6vBYW.4DlDBvvYkU5xRuYtV2I.SJu5Csb342O', '', 'head', 'Back-end Developer', 104, 'Memphis, Tennessee'),
(300034, 'Arda', 'Barry', 'IMG-61dcd4d1b26909.24686056.png', 'barry4324', '$2y$10$iIXlYRJ.FODZAslXZpTfzOwKYRfEhR72KAgmgqpFmUbhN14Vijo6i', '', 'user', 'Back-end Developer', 104, 'Philadelphia, Pennsylvania'),
(300035, 'Hudson', 'Guest', 'IMG-61dcd4ec0582d8.64027895.jpg', 'hudson5643', '$2y$10$TaIVzecHyfU3HfnqIGgo6OoyX3t5OucCwOkKQw2yH6dihOp8wKFLS', '', 'user', 'Designer Web', 104, 'Houston, Texas'),
(400041, 'Nikhil', 'Carlson', 'IMG-61dcd7056ba913.42947781.png', 'carlson432', '$2y$10$2aaMTcsTc39i4Ef6oM7IwOpWv0SeVbibE.gUG0TBU1h5AxjLCJyWq', '', 'user', 'Android Developer', 105, 'Chicago, Illinois'),
(400042, 'Tamera', 'Snider', 'IMG-61dcd717a6ce69.36901949.jpg', 'tamera5432', '$2y$10$h2CtNOUrc5PJQ8hxxfthqegsittJHzzWd/4qmJqTFFslYGgqRIMTO', '', 'user', 'Android Developer', 105, 'Louisville, Kentucky'),
(400043, 'Roland', 'Munro', 'IMG-61dcd7279eaf92.19750991.png', 'munro43533', '$2y$10$0F/nIQzWut.LO6y3yUU9SONkOmTvv7//u232k20iR/nfOBLpxTGFy', '', 'head', 'IOS Developer', 105, 'Detroit, Michigan'),
(400044, 'Emily', 'Stamp', 'IMG-61dcd746474da2.58222655.jpg', 'emily54332', '$2y$10$gqKKSmr7TxspNwFzY9HbburpJoDk1Nz1zeREs724vsYf8zUNOHXB2', '', 'user', 'Android Developer', 105, 'Jackson, Mississippi'),
(400045, 'Drew', 'Phillips', 'IMG-61dcd75825d002.09747946.png', 'drew34223', '$2y$10$7ZFI7h0iO9CEPiu8vgBw5Oayg9ceFawzFg.yveHlRkhrWskIADktO', '', 'user', 'IOS Developer', 105, 'Baltimore, Maryland'),
(500051, 'Jasmin', 'Stone', 'IMG-61dcd8e47ebd56.17934162.png', 'jasmin432', '$2y$10$BKZwPE2m9V7VGZk2l0fqxuhUyi9wsx5ti6KHrjE2UXDUBxIaIcXe.', '', 'user', 'Accountant', 106, 'Boise, Idaho'),
(500052, 'Kady', 'Mercer', 'IMG-61dcd8f6e07505.48431523.png', 'mercer423', '$2y$10$dIpKfONCA54cXPfPqezui.awabjNelo7a6SiRzm2UD48UyxjCYZoy', '', 'head', 'Bookkeeper', 106, 'Atlanta, Georgia'),
(500053, 'Mari', 'Hollis', 'IMG-61dcd9099967c8.77549299.png', 'hollis_4532', '$2y$10$uIaIyJn2U/ss.GH7DrCIn.S2B4hRkS0MBD7JGhIfOUGxyAy67yI7W', '', 'user', 'Auditor', 106, 'Little Rock, Arkansas'),
(500054, 'Romeo', 'Pacheco', 'IMG-61dcd919756ae2.30074161.png', 'romeo5432', '$2y$10$.E2lv8q1kb1zw5Ybspya7ep4fXJM2MmeVC2lNsaCLEQ57OG/zNYUi', '', 'user', 'Tax Accountant', 106, 'Phoenix, Arizona'),
(500055, 'Misha', 'Bush', 'IMG-61dcd93e0b3160.15781374.png', 'misha5343', '$2y$10$x./.DJVz8.6dpQMMmI4OeuqnGSkp45TJBu8llAnPLMWWcv86dO6cq', '', 'user', 'Cost Accountant', 106, 'Boston, Massachusetts'),
(600061, 'Ishika', 'Mcintyre', 'IMG-61dcdf87ed53f9.73221186.jpg', 'ishika5342', '$2y$10$Q1zDyXGaJfD.EiyBYyVuMu4lPXFJhn5b6zGhioXyb6bInPXgCbV8O', '', 'user', 'IT Support', 107, 'Billings, Montana'),
(600062, 'Peggy', 'Lowry', 'IMG-61dcdfa1d8a2d8.30706673.png', 'peggy_543', '$2y$10$YZaR0fwJFca0049OdMg7u.CJH8PkzsoZ3Q.jRnFZA65Xx5mwwJGN.', '', 'head', 'IT Support', 107, 'Wichita, Kansas'),
(600063, 'Kaylie', 'Farrell', 'IMG-61dcdfb3a5afa9.04936790.jpg', 'farrell_564', '$2y$10$UyjA8mN8DKkfasmhUjtnTODb7Y02UkO45.Gp/n4x2f67Xw/W9ZePe', '', 'user', 'IT Support', 107, 'Jackson, Mississippi'),
(600064, 'Raja', 'Vu', 'IMG-61dcdfc7a43a02.36438647.jpg', 'raja_vu345', '$2y$10$cKwL8TbTUz5W4Ukz5D4Z6.kUQRQIvwsrak3wAi4a3tr0Jg/q3YRH2', '', 'user', 'IT Support', 107, 'Detroit, Michigan'),
(600065, 'Simran', 'Schmitt', 'IMG-61dcdfda4814e4.50478975.jpg', 'simran_354', '$2y$10$XSW8acgYQhEqVlV3cJkkUOIn4J3j5/sv/xoRbQ74cW4lj8YgcZbfS', '', 'user', 'IT Support', 107, 'Omaha, Nebraska');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `department`
--

CREATE TABLE `department` (
  `ID_department` int(11) NOT NULL,
  `department_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description_department` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `room_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `head_department` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `department`
--

INSERT INTO `department` (`ID_department`, `department_name`, `description_department`, `room_number`, `head_department`) VALUES
(101, 'DIRECTOR', 'Leader of the company', 'A101', '1'),
(102, 'MARKETING', 'Marketing for the company', 'A102', '100016'),
(103, 'HUMAN RESOUCES', 'Find employee for company', 'A103', '200021'),
(104, 'WEB DEVELOPMENT', 'Programing website', 'B203', '300033'),
(105, 'APP DEVELOPMENT', 'Programing app', 'B105', '400043'),
(106, 'ACCOUNTING', 'Calculate the salary for employee', 'B405', '500052'),
(107, 'IT_SUPPORT', 'Help to repair computer', 'C102', '600062');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leave_info`
--

CREATE TABLE `leave_info` (
  `id_leave` int(11) NOT NULL,
  `username_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `leave_date` date NOT NULL,
  `reason` varchar(255) CHARACTER SET latin1 NOT NULL,
  `status` int(1) NOT NULL,
  `day_leave` int(255) NOT NULL,
  `last_submit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `leave_info`
--

INSERT INTO `leave_info` (`id_leave`, `username_id`, `leave_date`, `reason`, `status`, `day_leave`, `last_submit`) VALUES
(39, 'ethan5435', '2022-01-20', '<p>I have to get back to my country to visit my parent</p>\r\n', 3, 0, 0),
(40, 'ethan5435', '2022-01-12', '<p>My family go for vacation</p>\r\n', 0, 0, 0),
(41, 'ethan5435', '2022-06-20', '<p>Comeback to my country</p>\r\n', 1, 0, 0),
(42, 'amis0985', '2022-01-13', '<p>Daycare child problems</p>\r\n', 0, 0, 0),
(43, 'amis0985', '2022-01-27', '<p>Suffered from an accident.</p>\r\n', 3, 0, 0),
(44, 'amis0985', '2022-01-19', '<p>Have an important appointment with my doctor</p>\r\n', 0, 0, 0),
(45, 'amis0985', '2022-01-21', '<p>Back to my country</p>\r\n', 1, 0, 0),
(46, 'maccabe3231', '2022-01-05', '<p>Due to illness or injury&nbsp;</p>\r\n', 0, 0, 0),
(47, 'maccabe3231', '2022-01-19', '<p>Family emergency</p>\r\n', 1, 0, 0),
(48, 'maccabe3231', '2022-01-13', '<p>Days of mourning for the death of a relative</p>\r\n', 1, 0, 0),
(50, 'maccabe3231', '2022-01-25', '<p>For taking a mental health Day</p>\r\n', 3, 0, 0),
(51, 'maccabe3231', '2022-01-24', '<p>For medical appointments</p>\r\n', 0, 0, 0),
(52, 'maccabe3231', '2022-01-26', '<p>By Jury duty/ Duties of a citizen</p>\r\n', 0, 0, 0),
(53, 'maccabe3231', '2022-01-19', '<p>For unforeseen events</p>\r\n', 0, 0, 0),
(54, 'maccabe3231', '2022-10-22', '<p>For falling asleep</p>\r\n', 3, 0, 0),
(55, 'molina1234', '2022-01-20', '<p>Due to illness or injury&nbsp;</p>\r\n', 0, 0, 0),
(56, 'molina1234', '2022-01-12', '<p>Family emergency</p>\r\n', 0, 0, 0),
(57, 'molina1234', '2022-01-27', '<p>Days of mourning for the death of a relative</p>\r\n', 3, 0, 0),
(58, 'molina1234', '2022-11-19', '<p>For vehicle or transportation problems</p>\r\n', 1, 0, 0),
(59, 'molina1234', '2022-01-20', '<p>For taking a mental health Day</p>\r\n', 0, 0, 0),
(60, 'molina1234', '2022-01-14', '<p>By Jury duty/ Duties of a citizen</p>\r\n', 0, 0, 0),
(61, 'molina1234', '2022-06-20', '<p>For unforeseen events</p>\r\n', 3, 0, 0),
(62, 'molina1234', '2022-06-07', '<p>For falling asleep</p>\r\n', 1, 0, 0),
(63, 'cobb4234', '2022-10-20', '<p>Family emergency</p>\r\n', 1, 0, 0),
(64, 'cobb4234', '2022-01-27', '<p>Days of mourning for the death of a relative</p>\r\n', 1, 0, 0),
(65, 'cobb4234', '2022-09-10', '<p>For vehicle or transportation problems</p>\r\n', 3, 0, 0),
(66, 'cobb4234', '2022-07-10', '<p>For taking a mental health Day</p>\r\n', 1, 0, 0),
(67, 'cobb4234', '2022-06-19', '<p>By Jury duty/ Duties of a citizen</p>\r\n', 3, 0, 0),
(68, 'jac54333', '2022-01-21', '<p>For unforeseen events</p>\r\n', 0, 0, 0),
(69, 'jac54333', '2022-10-10', '<p>For falling asleep</p>\r\n', 3, 0, 0),
(70, 'jac54333', '2022-10-13', '<p>Medical tests</p>\r\n', 1, 0, 0),
(71, 'jac54333', '2022-03-20', '<p>Pets emergencies</p>\r\n', 1, 0, 0),
(72, 'jac54333', '2022-07-20', '<p>Deaths and funerals</p>\r\n', 3, 0, 0),
(73, 'colon43543', '2022-06-30', '<p>For unforeseen events</p>\r\n', 3, 0, 0),
(75, 'colon43543', '2022-01-14', '<p>For medical appointments</p>\r\n', 0, 0, 0),
(76, 'colon43543', '2022-07-15', '<p>Family emergency</p>\r\n', 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `task_info`
--

CREATE TABLE `task_info` (
  `task_id` int(255) NOT NULL,
  `task_tittle` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `task_description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL DEFAULT current_timestamp(),
  `end_time` datetime NOT NULL DEFAULT current_timestamp(),
  `task_user_id` int(11) NOT NULL,
  `department_task_id` int(11) NOT NULL,
  `task_status` int(11) NOT NULL,
  `task_rate` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `task_info`
--

INSERT INTO `task_info` (`task_id`, `task_tittle`, `task_description`, `start_time`, `end_time`, `task_user_id`, `department_task_id`, `task_status`, `task_rate`) VALUES
(45328, 'Digital and Online marketing', 'produce written and multimedia content and manage pay-per-click (PPC) and programmatic advertising.', '2022-01-10 12:00:00', '2022-01-19 08:00:00', 100012, 0, 0, ''),
(45329, 'Meeting Weekend', 'overseeing and developing marketing campaigns conducting research and analysing data to identify and define audiences devising and presenting ideas and strategies', '2022-01-20 10:00:00', '2022-01-25 08:00:00', 100012, 0, 0, ''),
(45330, 'Facebook Reply', 'viết và hiệu đính bản sao quảng cáo duy trì các trang web và xem xét phân tích dữ liệu tổ chức sự kiện và triển lãm sản phẩm', '2022-04-07 12:00:00', '2022-06-10 12:00:00', 100013, 0, 5, ''),
(45331, 'Content Writing', 'coordinating internal marketing and an organisation’s culture monitoring performance managing campaigns on social media.', '2022-01-21 06:00:00', '2022-03-23 20:40:00', 100013, 0, 3, ''),
(45332, 'Website Reply', 'overseeing and developing marketing campaigns conducting research and analysing data to identify and define audiences devising and presenting ideas and strategies promotional activities', '2022-05-11 12:00:00', '2022-08-18 05:00:00', 100014, 0, 2, ''),
(45333, 'Meetting User', 'Come to see the user and help to overseeing and developing marketing campaigns', '2022-02-08 02:00:00', '2022-04-06 01:50:00', 100014, 0, 0, ''),
(45334, 'Pay-per-click marketing', 'PPC marketing involves sponsored content in search engines, on websites—and so much more. In many cases, these are the people who make sure a business’s product or service landing page is at or near the top of search results by paying for placement. This is the “paid” portion of search engine marketing—there are also “organic” roles used for increasing a website’s search engine visibility.', '2022-03-15 09:00:00', '2022-05-10 09:00:00', 100014, 0, 0, ''),
(45335, 'Search engine optimization', 'overseeing and developing marketing campaigns conducting research and analysing data to identify and define audiences devising and presenting ideas and strategies promotional activities compiling and distributing financial and statistical information writing and proofreading creative copy', '2022-01-19 12:00:00', '2022-04-08 12:00:00', 100015, 0, 0, ''),
(45336, 'Content marketing', 'maintaining websites and looking at data analytics organising events and product exhibitions updating databases and using a customer relationship management (CRM) system coordinating internal marketing and an organisation’s culture monitoring performance', '2022-01-20 12:00:00', '2022-01-20 12:00:00', 100016, 0, 0, ''),
(45337, 'Video marketing', 'Stasiuk explains that video marketers can track engagement at a much deeper level than many other forms of marketing. “We can see not only who watched a video, but also if they paused, rewound, watched twice or clicked away after a few seconds. This data helps us make better future content and ultimately become better marketers.”', '2022-01-19 12:00:00', '2022-01-14 09:00:00', 100016, 0, 0, ''),
(45338, 'asd', 'asdsad', '2022-01-05 12:00:00', '2022-01-27 12:00:00', 200022, 0, 2, ''),
(45339, 'Job Outlook', 'Job opportunities for web developers are expected to expand by about 13% or the decade ending in 2028', '2022-01-04 12:00:00', '2022-01-20 12:00:00', 200022, 0, 5, ''),
(45340, 'Work Environment', 'Web developers work for a variety of employers in the government, nonprofit, and corporate sectors', '2022-01-19 12:00:00', '2022-06-23 09:00:00', 200022, 0, 1, ''),
(45341, 'Work Schedule', 'Work generally follows a typical business work week, but web developers working remotely for clients in other time zones', '2022-01-04 12:00:00', '2022-01-20 08:00:00', 200022, 0, 1, ''),
(45342, 'WRITE A RESUME', 'Review advice on creating the best possible resume.', '2022-01-11 12:00:00', '2022-09-14 10:00:00', 200022, 0, 0, ''),
(45343, 'Interview Process', 'HR management determines the process for interviewing candidates', '2022-02-11 12:00:00', '2022-01-05 09:00:00', 200023, 0, 5, ''),
(45344, 'Pre-Employment Steps', 'Pre-employment steps include verifying work history, criminal records and consumer reports for candidates to whom the company exten', '2022-01-04 09:00:00', '2022-01-04 10:00:00', 200023, 0, 4, ''),
(45345, 'Cost Per Hire', 'Importantly, HR management ensures that the selection process is not so long that it discourages candidates. Prolonged selection proces', '2022-01-12 12:00:00', '2022-01-07 10:00:00', 200023, 0, 1, ''),
(45346, 'Strategy', 'Human resources management strategy determines, among other things, whether recruitment and selection functions are handled in-house', '2022-01-05 12:00:00', '2022-05-18 12:00:00', 200023, 0, 2, ''),
(45347, 'Job Posting', 'Job posting is an essential component of recruitment because the venue often determines an employer', '2022-01-04 12:00:00', '2022-01-20 12:00:00', 200023, 0, 0, ''),
(45348, 'Interview Process', 'HR management determines the process for interviewing candidates. For many employers, recruiters conduct preliminary screening by comparing applications and resumes to job requirements.', '2022-01-12 12:00:00', '2022-06-23 12:00:00', 200024, 0, 3, ''),
(45349, 'Pre-Employment Steps', 'Pre-employment steps include verifying work history, criminal records and consumer reports for candidates to whom the company extends conditional job offers.', '2022-01-05 12:00:00', '2022-01-18 12:00:00', 200024, 0, 3, ''),
(45350, 'Job Posting', 'using LinkedIn and Indeed.com job boards are low-cost and effective ways to advertise job vacancies.', '2022-01-04 12:00:00', '2022-04-05 09:00:00', 200024, 0, 4, ''),
(45351, 'Pre-Employment Steps', 're-employment steps include verifying work history, criminal records and consumer reports for candidates to whom the', '2021-12-01 12:00:00', '2022-05-12 12:00:00', 200024, 0, 1, ''),
(45352, 'Cost Per Hire', 'HR management ensures that the selection process is not so long that it discourages candidates. Prolonged se', '2022-01-12 12:00:00', '2022-07-21 12:00:00', 200024, 0, 0, ''),
(45353, 'Cost Per Hire', 'Lengthy selection processes also create higher costs per hire. Employers calculate cost per hire based on the time recruiters', '2022-10-19 09:00:00', '2022-12-08 12:00:00', 200025, 0, 3, ''),
(45354, 'Pre-Employment Steps', 'steps include verifying work history, criminal records and consumer reports for candidates to whom the company', '2022-05-25 12:00:00', '2022-05-11 12:00:00', 200025, 0, 0, ''),
(45355, 'Interview Process', 'HR management determines the process for interviewing candidates. For many employers, recruiters conduct preliminary screening by comparing', '2021-12-30 12:00:00', '2022-01-18 12:00:00', 200025, 0, 1, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID_department`);

--
-- Chỉ mục cho bảng `leave_info`
--
ALTER TABLE `leave_info`
  ADD PRIMARY KEY (`id_leave`);

--
-- Chỉ mục cho bảng `task_info`
--
ALTER TABLE `task_info`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `leave_info`
--
ALTER TABLE `leave_info`
  MODIFY `id_leave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `task_info`
--
ALTER TABLE `task_info`
  MODIFY `task_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45356;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
