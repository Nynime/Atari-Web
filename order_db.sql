-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 06:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `star_reviews` decimal(3,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `details_link` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `star_reviews`, `price`, `original_price`, `description`, `details_link`, `stock`) VALUES
(1, '1010, Chelco Versions', 4.50, 375.90, 469.00, 'The 1010, Chelco Version is a compact cassette data recorder designed for use with Atari 8-bit home computers. It enables users to store and load programs and data on standard audio cassettes. Featuring easy connectivity and reliable performance, the 1010 offers a user-friendly interface for data management, enhancing the functionality of Atari\'s classic computer systems.', 'product_info.html', 1),
(2, '1010, Sanyo Versions', 4.50, 395.90, 499.00, '1010, Sanyo Versions tape record is a nostalgic reproduction of classic arcade gaming soundtracks on cassette tapes. It captures the essence of retro gaming with its authentic audio experience, featuring iconic sound effects and music from the Sanyo Versions of the game. Perfect for collectors and enthusiasts seeking to relive the golden age of arcade gaming.', 'product_info2.html', 1),
(3, 'ATARI 822 Printer Thermal Head CB101726', 4.50, 450.90, 699.00, 'The ATARI 822 Printer Thermal Head CB101726 is a reliable and high-quality thermal print head designed specifically for the ATARI 822 printer. With precise engineering and advanced thermal printing technology, it ensures crisp and clear prints with every use. Ideal for businesses, offices, and enthusiasts who demand professional printing results.', 'product_info3.html', 1),
(4, 'ATARI CX85 Keypad Handle Disk CX8139', 4.00, 350.90, 599.00, 'The Atari CX85 Keypad is a handy accessory designed for easy input on Atari computers. It features a disk handle, making it convenient for users to navigate menus, input commands, and control various functions with precision. With its ergonomic design and compatibility with Atari systems, it enhances user experience and productivity during computing tasks.', 'product_info4.html', 1),
(5, 'ATARI CX77 Touch Tablet CX779', 4.00, 350.90, 599.00, 'The Atari CX77 Touch Tablet, model CX779, offers intuitive input for Atari computers. With its touch-sensitive surface, users can draw, write, or interact with software directly on the tablet, providing a versatile and precise input method. It enhances creativity, productivity, and ease of use for graphic design, gaming, and educational applications on Atari systems.', 'product_info5.html', 1),
(6, 'ATARI Reconditioned US 800XL Computer CB101939RO', 4.00, 550.90, 899.00, 'The Atari Reconditioned US 800XL computer, model CB101939RO, is a refurbished version of the classic Atari 800XL home computer. Featuring improved reliability and performance, this reconditioned unit offers the nostalgic experience of retro computing with modern reliability. Ideal for enthusiasts, collectors, or those seeking a vintage computing experience, it provides access to a vast library of classic software and games from the Atari era.', 'product_info6.html', 1),
(7, 'ATARI 1050 Tandon Track 00 Sensor CB101148', 4.00, 450.90, 799.00, 'The Atari 1050 Tandon Track 00 Sensor, model CB101148, is a crucial component of the Atari 1050 disk drive system. This sensor ensures accurate positioning of the read/write head to track 00, enabling proper reading and writing of data on floppy disks. It plays a vital role in the functionality and reliability of the Atari 1050 disk drive, ensuring smooth operation and data integrity for users.', 'product_info7.html', 1),
(8, 'ATARI 810 MPI Motor CB101132', 4.00, 450.90, 799.00, 'The Atari 810 MPI Motor, model CB101132, is a replacement motor specifically designed for the Atari 810 Memory Module Port Interface (MPI). This motor ensures smooth and reliable operation of the MPI, which expands the capabilities of Atari 8-bit computers by providing additional memory and peripheral connectivity. With this motor, users can maintain or restore the functionality of their Atari 810 MPI, ensuring continued enjoyment of expanded computing capabilities.', 'product_info8.html', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `card` varchar(20) DEFAULT NULL,
  `expiry_date` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product`, `quantity`, `total`, `name`, `address`, `phone`, `email`, `card`, `expiry_date`, `created_at`) VALUES
(48, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'HANIM BINTI HABIDI', 'NO 133 KAMPUNG TELAGA AIR, JALAN MATANG', '01125140052', 'hanimhabidi2003@gmail.com', '9348085809458', '23/10', '2024-05-27 13:51:11'),
(49, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:22:38'),
(50, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:22:50'),
(51, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:23:02'),
(52, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:23:13'),
(53, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:23:25'),
(54, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:24:55'),
(55, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:25:07'),
(56, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:25:18'),
(57, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:25:30'),
(58, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:25:41'),
(59, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:25:52'),
(60, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:26:04'),
(61, '1010, Sanyo Versions', 1, '395.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:39:29'),
(62, '1010, Sanyo Versions', 1, '395.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:39:40'),
(63, '1010, Sanyo Versions', 1, '395.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:39:52'),
(64, '1010, Sanyo Versions', 1, '395.90', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:40:03'),
(65, '1010, Chelco Versions', 2, '901.80', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:50:16'),
(66, '1010, Chelco Versions', 2, '901.80', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:50:28'),
(67, '1010, Chelco Versions', 2, '901.80', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:50:39'),
(68, '1010, Chelco Versions', 2, '901.80', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:50:51'),
(69, '1010, Chelco Versions', 2, '901.80', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:51:02'),
(70, '1010, Chelco Versions', 2, '901.80', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/28', '2024-05-27 14:51:13'),
(71, 'Atari 822 Printer Thermal Head CB101726', 1, '450.90', 'miya', 'no 89 kampung heritage ', '0143173431', 'miya@gmail.com', '6973285282352872', '4/28', '2024-05-27 14:57:42'),
(72, 'Atari 822 Printer Thermal Head CB101726', 1, '450.90', 'miya', 'no 89 kampung heritage ', '0143173431', 'miya@gmail.com', '6973285282352872', '4/28', '2024-05-27 14:57:54'),
(73, 'Atari 822 Printer Thermal Head CB101726', 1, '450.90', 'miya', 'no 89 kampung heritage ', '0143173431', 'miya@gmail.com', '6973285282352872', '4/28', '2024-05-27 14:58:05'),
(74, 'Atari 822 Printer Thermal Head CB101726', 1, '450.90', 'miya', 'no 89 kampung heritage ', '0143173431', 'miya@gmail.com', '6973285282352872', '4/28', '2024-05-27 14:58:17'),
(75, 'Atari 822 Printer Thermal Head CB101726', 1, '450.90', 'miya', 'no 89 kampung heritage ', '0143173431', 'miya@gmail.com', '6973285282352872', '4/28', '2024-05-27 14:58:28'),
(76, 'Atari CX85 Keypad handle disk  CX8139', 1, '350.90', 'layla', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'layla@gmail.com', '9828762382', '5/30', '2024-05-27 15:04:31'),
(77, 'Atari CX77 Touch Tablet CX779', 1, '350.90', 'xavier', 'no 7 kampung bunga raya', '01125140052', 'xavier@gmail.com', '840404598', '9/25', '2024-05-27 15:13:08'),
(78, 'Atari Reconditioned US 800XL computer CB101939RO', 3, '1352.70', 'guinevere', 'no 13 kampung allamanda', '01754688754', 'guine@gmail.com', '9878667676', '2/28', '2024-05-27 15:20:48'),
(79, 'Atari 1050 Tandon track 00 sensor CB101148', 1, '450.90', 'Alpha', 'no 23 kampung cempaka', '0189989887', 'alpha@gmail.com', '763873487', '9/29', '2024-05-27 15:27:48'),
(80, 'Atari 1050 Tandon track 00 sensor CB101148', 1, '450.90', 'Alpha', 'no 23 kampung cempaka', '0189989887', 'alpha@gmail.com', '763873487', '9/29', '2024-05-27 15:28:00'),
(81, 'Atari 810 MPI Motor CB101132', 1, '450.90', 'Khai', 'No 7 Kampung Bunga Kasturi', '01235656467', 'khai@gmail.com', '9878667676', '2/28', '2024-05-27 15:34:34'),
(82, '1010, Sanyo Versions', 1, '450.90', 'zafran', 'no 123 kampung sakura', '0123456780', 'zaf@gmail.com', '9878667676', '2/28', '2024-05-27 15:54:47'),
(83, '1010, Sanyo Versions', 1, '395.90', 'zafran', 'no 123 kampung sakura', '0123456780', 'zaf@gmail.com', '9878667676', '2/28', '2024-05-27 16:09:49'),
(84, '1010, Sanyo Versions', 1, '395.90', 'Alpha', 'no 23 kampung cempaka', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-27 16:20:48'),
(85, '1010, Chelco Versions', 1, ' 375.90', 'Alpha', 'no 23 kampung bunga raya ', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-27 16:25:05'),
(86, '1010, Chelco Versions', 1, ' 375.90', 'Alpha', 'no 23 kampung bunga raya ', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-27 16:25:17'),
(87, '1010, Chelco Versions', 1, ' 375.90', 'Alpha', 'no 23 kampung bunga raya ', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-27 16:35:24'),
(88, '1010, Sanyo Versions', 1, '395.90', 'Alpha', 'no 23 kampung bunga raya ', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-27 16:44:07'),
(89, '1010, Sanyo Versions', 1, '395.90', 'Alpha', 'no 23 kampung bunga raya ', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-27 16:46:22'),
(90, '1010, Sanyo Versions', 1, '395.90', 'Alpha', 'no 23 kampung bunga raya ', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-27 16:46:38'),
(91, '1010, Chelco Versions', 1, ' 375.90', 'Alpha', 'no 23 kampung bunga raya ', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-27 17:01:18'),
(92, '1010, Chelco Versions', 1, ' 375.90', 'Alpha', 'no 23 kampung bunga raya ', '0189989887', 'alpha@gmail.com', '60478645628', '4/29', '2024-05-28 04:14:51'),
(93, '1010, Chelco Versions', 3, '1352.70', 'xavier', 'no 7 kampung bunga raya', '01125140052', 'xavier@gmail.com', '60478645628', '4/29', '2024-05-28 05:56:22'),
(94, 'Atari CX85 Keypad handle disk  CX8139', 10, '4509.00', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/29', '2024-05-28 05:59:39'),
(95, 'Atari Reconditioned US 800XL computer CB101939RO', 5, '2254.50', 'nynim', 'NO 115 KAMPUNG TELAGA AIR JALAN MATANG', '0143173431', 'nynim@gmail.com', '60478645628', '4/29', '2024-05-28 06:08:30'),
(96, 'Atari Reconditioned US 800XL computer CB101939RO', 3, '1352.70', 'HANIM ', 'NO 133 KAMPUNG TELAGA AIR, JALAN MATANG', '01111715052', 'hanimhabidi2003@gmail.com', '60478645628', '4/29', '2024-05-28 13:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_name`, `amount`, `transaction_date`) VALUES
(1, 'Alice Johnson', 120.50, '2024-06-19 10:30:00'),
(2, 'Bob Smith', 75.00, '2024-06-18 15:45:00'),
(3, 'Carol White', 150.75, '2024-06-17 12:20:00'),
(4, 'David Brown', 200.10, '2024-06-15 09:00:00'),
(5, 'Eve Davis', 99.99, '2024-06-10 17:35:00'),
(6, 'Frank Wilson', 50.50, '2024-05-25 13:15:00'),
(7, 'Grace Lee', 175.25, '2024-05-20 14:50:00'),
(8, 'Henry King', 220.40, '2024-05-15 16:25:00'),
(9, 'Ivy Martinez', 180.30, '2024-04-30 11:10:00'),
(10, 'John Doe', 130.80, '2024-04-25 08:50:00'),
(11, 'Alicia Kheng', 520.50, '2024-06-20 10:45:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
