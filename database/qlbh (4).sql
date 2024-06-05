-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2024 at 02:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlbh`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `type`, `email`, `profile_image`) VALUES
('hello', '123', 1, 'phuc180103@gmail.com222', NULL),
('phuc', '123456', 1, 'phuc1@gmail.com', NULL),
('phuc11', '223', 1, 'phuc180102223@gmail.com', NULL),
('phuc113', '123', 1, 'phuc1801023@gmail.com', NULL),
('phuc222', '123', 0, 'phuc123@gmail.com', NULL),
('sd', '123', 0, 'phuc1822@gmail.com', NULL),
('staff', '123', 0, 'phuc12@gmail.com', NULL),
('user', '123', 0, 'phuc180103@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `tieude` varchar(100) NOT NULL,
  `noidung` varchar(255) NOT NULL,
  `nguoimua` int(11) NOT NULL,
  `danhgia` int(11) NOT NULL,
  `cauhoi` varchar(255) NOT NULL,
  `tieudemot` varchar(100) NOT NULL,
  `ndtieudemot` varchar(255) NOT NULL,
  `anhmot` varchar(50) NOT NULL,
  `anhhai` varchar(50) NOT NULL,
  `tieudehai` varchar(100) NOT NULL,
  `ndtieudehai` varchar(255) NOT NULL,
  `anhba` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `tieude`, `noidung`, `nguoimua`, `danhgia`, `cauhoi`, `tieudemot`, `ndtieudemot`, `anhmot`, `anhhai`, `tieudehai`, `ndtieudehai`, `anhba`) VALUES
(1, 'Cà Phê Đâu Chỉ Là Thức Uống', 'Cà phê hay cuộc đời đều mang vị đắng chát khó quên nhưng ẩn sâu bên trong đó luôn phảng phất hương thơm và vị ngọt.', 500, 3000, 'Dưới ánh nắng sớm mai, hương thơm của ca phê lan tỏa, như là một giai điệu êm đềm, mời gọi ta bước vào thế giới của những suy tư sâu lắng và những cuộc trò chuyện bất tận.', 'Cà Phê Sữa Đá Hoà Tan\r\n', 'Thật dễ dàng để bắt đầu ngày mới với tách cà phê sữa đá sóng sánh, thơm ngon như cà phê pha phin. Vị đắng thanh của cà phê hoà quyện với vị ngọt béo của sữa, giúp bạn luôn tỉnh táo và hứng khởi cho ngày làm việc thật hiệu quả.\r\n', 'hopcoffee.jpg', 'longcoffee.jpg', 'Cà Phê Sữa Đá Hoà Tan', 'Thật dễ dàng để bắt đầu ngày mới với tách cà phê sữa đá sóng sánh, thơm ngon như cà phê pha phin. Vị đắng thanh của cà phê hoà quyện với vị ngọt béo của sữa, giúp bạn luôn tỉnh táo và hứng khởi cho ngày làm việc thật hiệu quả.', 'bottlecfsd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `total`, `status`, `created_at`) VALUES
(6, 'user', 15000010.00, 'approved', '2024-05-20 08:11:57'),
(7, 'staff', 21000014.00, 'approved', '2024-05-20 15:18:01'),
(8, 'user', 21000014.00, 'approved', '2024-05-20 15:26:55'),
(9, 'user', 3000002.00, 'approved', '2024-05-20 15:27:55'),
(10, 'user', 100000.00, 'approved', '2024-05-20 15:28:00'),
(11, 'user', 100000.00, 'approved', '2024-05-20 15:28:04'),
(12, 'user', 21000014.00, 'approved', '2024-05-20 15:31:56'),
(13, 'user', 18000012.00, 'approved', '2024-05-20 15:34:51'),
(14, 'staff', 15000010.00, 'approved', '2024-05-21 01:28:02'),
(15, 'user', 9000006.00, 'approved', '2024-05-21 01:31:33'),
(16, 'user', 500000.00, 'approved', '2024-05-21 01:31:46'),
(17, 'user', 100000.00, 'approved', '2024-05-21 01:31:52'),
(18, 'user', 3000002.00, 'approved', '2024-05-21 01:39:08'),
(19, 'user', 300000.00, 'approved', '2024-05-21 01:39:11'),
(20, 'user', 300000.00, 'approved', '2024-05-21 01:39:15'),
(21, 'user', 100000.00, 'approved', '2024-05-21 01:39:20'),
(22, 'user', 3000002.00, 'approved', '2024-05-21 02:20:39'),
(23, 'user', 100000.00, 'approved', '2024-05-21 02:20:44'),
(24, 'staff', 3000002.00, 'approved', '2024-06-02 23:19:02'),
(25, 'staff', 100000.00, 'approved', '2024-06-03 01:28:29'),
(26, 'staff', 600000.00, 'approved', '2024-06-03 07:53:09'),
(27, 'staff', 100000.00, 'approved', '2024-06-03 10:14:21'),
(28, 'staff', 6000004.00, 'approved', '2024-06-03 10:42:24'),
(29, 'staff', 100000.00, 'approved', '2024-06-03 10:42:31'),
(30, 'staff', 4900002.00, 'approved', '2024-06-03 13:12:25'),
(31, 'staff', 100000.00, 'pending', '2024-06-03 13:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(6, 6, 28, 5, 3000002.00),
(7, 7, 28, 7, 3000002.00),
(8, 8, 28, 7, 3000002.00),
(9, 9, 28, 1, 3000002.00),
(10, 10, 41, 1, 100000.00),
(11, 11, 42, 1, 100000.00),
(12, 12, 28, 7, 3000002.00),
(13, 13, 28, 6, 3000002.00),
(14, 14, 28, 5, 3000002.00),
(15, 15, 28, 3, 3000002.00),
(16, 16, 40, 5, 100000.00),
(17, 17, 42, 1, 100000.00),
(18, 18, 28, 1, 3000002.00),
(19, 19, 32, 1, 300000.00),
(20, 20, 33, 1, 300000.00),
(21, 21, 42, 1, 100000.00),
(22, 22, 28, 1, 3000002.00),
(23, 23, 42, 1, 100000.00),
(24, 24, 28, 1, 3000002.00),
(25, 25, 58, 1, 100000.00),
(26, 26, 59, 1, 100000.00),
(27, 26, 42, 1, 100000.00),
(28, 26, 58, 1, 100000.00),
(29, 26, 32, 1, 300000.00),
(30, 27, 39, 1, 100000.00),
(31, 28, 28, 2, 3000002.00),
(32, 29, 39, 1, 100000.00),
(33, 30, 28, 1, 3000002.00),
(34, 30, 32, 5, 300000.00),
(35, 30, 33, 1, 300000.00),
(36, 30, 58, 1, 100000.00),
(37, 31, 40, 1, 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `anh` varchar(255) NOT NULL,
  `baohanh` varchar(50) NOT NULL,
  `trangthai` varchar(50) NOT NULL,
  `gia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `ten`, `anh`, `baohanh`, `trangthai`, `gia`) VALUES
(28, 'iPhone 15 pro max 1', 'caramen.jpg', '12 tháng 22', '22', '3000002'),
(32, 'iPhone 15 pro max', 'caramen.jpg', '12 tháng', '0', '300000'),
(33, 'iPhone 15 pro max', 'caramen.jpg', '12 tháng', '10', '300000'),
(39, 'iphone 15 promax', 'caramen.jpg', '12 tháng', '10', '100000'),
(40, 'samsung22', 'caramen.jpg', '12 tháng', '10', '100000'),
(41, 'ip1522', 'caramen.jpg', '12 tháng', '0', '100000'),
(42, 'iphone 15 promax', 'caramen.jpg', '12 tháng 333', '0', '100000'),
(58, 'de', 'caramen.jpg', '12 tháng', '10', '100000'),
(59, 'hêh', 'caramen.jpg', '12 tháng', '0', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `facebook` varchar(255) DEFAULT '',
  `twitter` varchar(255) DEFAULT '',
  `instagram` varchar(255) DEFAULT '',
  `pinterest` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `username`, `facebook`, `twitter`, `instagram`, `pinterest`) VALUES
(1, 'phuc', 'phucnsnsns', 'đw', 'đw', 'đw'),
(2, 'phuc113', '', '', '', ''),
(3, 'user', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `social_media`
--
ALTER TABLE `social_media`
  ADD CONSTRAINT `social_media_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
