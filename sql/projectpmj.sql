-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 04:11 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectpmj`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_user` varchar(255) NOT NULL,
  `emp_pass` varchar(255) NOT NULL,
  `emp_fname` varchar(255) NOT NULL,
  `emp_lname` varchar(255) NOT NULL,
  `emp_position` varchar(255) NOT NULL,
  `emp_role` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_user`, `emp_pass`, `emp_fname`, `emp_lname`, `emp_position`, `emp_role`) VALUES
(1, 'user', '1234', 'ผู้ใช้', 'พนักงาน', 'พนักงานชำนาญการพิเศษ', 1),
(2, 'admin', '1234', 'ผู้ดูแล', 'ระบบ', 'เจ้าหน้าที่ดูแลด้านระบบชำนาญการพิเศษ', 2),
(6, 'oat', 'oat', 'ข้าวโอ๊ต', 'ประดิษฐ์', 'หัวหน้าฝ่ายนโยบาย', 2),
(7, 'japan', 'japan', 'รัตติยาพร', 'ลืมแล้วจ๊ะ', 'หัวหน้าฝ่ายการพัฒฯ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `office_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `office_name`, `office_qty`) VALUES
(1, 'กระดาษ', 0),
(2, 'หมึก', 0),
(3, 'ดินสอ', 40),
(4, 'ปากกา', 90),
(5, 'ไม้บรรทัด', 0),
(6, 'ยางลบ', 0),
(7, 'คลิป', 0),
(8, 'เป็ก', 0),
(9, 'เข็มหมุด', 0),
(10, 'เทปใส', 0),
(11, 'กระดาษคาร์บอน', 0),
(12, 'กระดาษไข', 0),
(13, 'ลวดเย็บกระดาษ', 0),
(14, 'กาว', 0),
(15, 'แฟ้ม', 10),
(16, 'สมุดบัญชี', 0),
(17, 'สมุดประวัติข้าราชการ', 0),
(18, 'แบบพิมพ์', 0),
(19, 'ชอล์ค', 0),
(20, 'ผ้าสำลี', 0),
(21, 'ตรายาง', 0),
(22, 'ซอง', 0),
(23, 'ธงชาติ', 0),
(24, 'สิ่งพิมพ์ที่ได้จากการซื้อหรือจ้างพิมพ์', 0),
(25, 'ของใช้ในการบรรจุหีบห่อ', 0),
(26, 'ที่ถูพื้น', 0),
(27, 'ตะแกรงวางเอกสาร', 0),
(28, 'น้ำดื่ม', 0),
(29, 'เครื่องตัดกระดาษ', 0),
(30, 'เครื่องเย็บกระดาษ', 0),
(31, 'กุญแจ', 0),
(32, 'ภาพเขียน', 0),
(33, 'แผนที่', 0),
(34, 'เครื่องดับเพลิง', 0),
(35, 'พระบรมฉายาลักษณ์', 0),
(36, 'แผงปิดประกาศ', 0),
(37, 'ม่านปรับแสง (ต่อผืน)', 0),
(38, 'พรม (ต่อผืน)', 0),
(39, 'นาฬิกาตั้ง', 0),
(40, 'นาฬิกาแขวน', 0),
(41, 'เครื่องคำนวณเลข', 0),
(42, 'หีบเหล็กเก็บเงิน', 0),
(43, 'พระพุทธรูป', 0),
(44, 'พระบรมรูปจำลอง', 0),
(45, 'กระเป๋า', 0),
(46, 'โต๊ะ', 0),
(47, 'โต๊ะทำงาน', 0),
(48, 'โต๊ะต่าง ๆ', 0),
(49, 'โต๊ะหมู่บูชา', 0),
(50, 'ชุดรับแขก', 0),
(51, 'เก้าอี้', 0),
(52, 'เก้าอี้ทำงาน', 0),
(53, 'เก้าอี้ฟังคำบรรยาย', 0),
(54, 'เก้าอี้เขียนแบบ', 0),
(55, 'เก้าอี้ผู้มาติดต่อ', 0),
(56, 'ชั้นวางเอกสาร', 0),
(57, 'ตู้', 0),
(58, 'ตู้ไม้', 0),
(59, 'ตู้เหล็ก', 0),
(60, 'ตู้ดรรชนี', 0),
(61, 'ตู้เก็บแผนที่', 0),
(62, 'ตู้นิรภัย', 0),
(63, 'ตู้เก็บแบบฟอร์ม', 0),
(64, 'ตู้เสื้อผ้า', 0),
(65, 'ตู้ล็อกเกอร์', 0),
(66, 'ตู้ติดประกาศ', 0),
(67, 'ตู้โชว์', 0),
(68, 'ตู้เก็บเอกสาร', 0),
(69, 'เครื่องพิมพ์ดีด', 0),
(70, 'เครื่องโทรศัพท์', 0),
(71, 'เครื่องถ่ายเอกสาร', 0),
(72, 'เครื่องพิมพ์สำเนาระบบดิจิตอล', 0),
(73, 'เครื่องทำลายเอกสาร', 0),
(74, 'เครื่องเจาะเอกสารเข้าเล่ม', 0),
(75, 'เครื่องปรับอากาศ', 0),
(76, 'พัดลม', 0),
(77, 'เครื่องดูดอากาศ', 0),
(78, 'เครื่องดูดฝุ่น', 0),
(79, 'รถเข็น', 0),
(80, 'ถังเก็บน้ำ', 0),
(81, 'เคาน์เตอร์', 0),
(82, 'แท่นอ่านหนังสือ', 0),
(83, 'เครื่องขัดพื้น', 0),
(84, 'เครื่องชุมสายโทรศัพท์', 0),
(85, 'เครื่องฟอกอากาศ', 0),
(86, 'สายไฟฟ้า', 0),
(87, 'ปลั้กไฟฟ้า', 0),
(88, 'สวิตซ์ไฟฟ้า', 0),
(89, 'หลอดไฟฟ้า', 0),
(90, 'ไมโครโฟน', 0),
(91, 'ลำโพง', 0),
(92, 'ขาตั้งไมโครโฟน', 0),
(94, 'เครื่องบันทึกเสียง', 0),
(95, 'แปรง', 0),
(96, 'ไม้กวาด', 0),
(97, 'เข่ง', 0),
(98, 'มุ่ง', 0),
(99, 'ผ้าปูโต๊ะ', 0),
(100, 'ถ้วยชาม', 0),
(101, 'ช้อนส้อม', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reported`
--

CREATE TABLE `reported` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `report_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reported`
--

INSERT INTO `reported` (`id`, `path`, `report_datetime`) VALUES
(1, 'pmj2023-01-29_04-01-57-pm.pdf', '2023-01-29 15:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `stat_id` int(11) NOT NULL,
  `stat_status` int(11) NOT NULL DEFAULT 1,
  `stat_reason` varchar(255) NOT NULL,
  `stat_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`stat_id`, `stat_status`, `stat_reason`, `stat_datetime`, `emp_id`) VALUES
(1, 3, '', '2023-01-26 14:49:37', 2),
(2, 1, '', '2023-01-28 08:23:50', 0),
(3, 1, '', '2023-01-28 08:55:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `t_id` int(11) NOT NULL,
  `t_type` int(11) NOT NULL,
  `stat_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `t_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`t_id`, `t_type`, `stat_id`, `emp_id`, `t_datetime`) VALUES
(1, 1, 1, 7, '2023-01-26 14:49:03'),
(2, 1, 2, 1, '2023-01-28 08:23:50'),
(3, 1, 3, 7, '2023-01-28 08:55:26'),
(4, 2, 0, 2, '2023-01-28 09:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_detail`
--

CREATE TABLE `transfer_detail` (
  `tdel_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `tdel_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transfer_detail`
--

INSERT INTO `transfer_detail` (`tdel_id`, `t_id`, `office_id`, `tdel_qty`) VALUES
(1, 1, 4, 10),
(2, 1, 3, 10),
(3, 2, 15, 1),
(4, 2, 3, 1),
(5, 2, 4, 1),
(6, 3, 4, 9),
(7, 3, 3, 9),
(8, 3, 15, 2),
(9, 4, 15, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `reported`
--
ALTER TABLE `reported`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `transfer_detail`
--
ALTER TABLE `transfer_detail`
  ADD PRIMARY KEY (`tdel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `reported`
--
ALTER TABLE `reported`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transfer_detail`
--
ALTER TABLE `transfer_detail`
  MODIFY `tdel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
