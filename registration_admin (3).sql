-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 09:24 AM
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
-- Database: `registration_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `date_of_birth`, `gender`, `username`, `password`, `created_at`) VALUES
(6, 'Kasih', 'Leona', 'leona@admin.com', '01478902071', '2000-03-13', 'Female', 'kasihirisleona', '$2y$10$qJ7aT1YhUoyhErmkD8sCKORRCtGB/hiRWDNGVtK8IUJ5cQpD2Fjhq', '2024-05-27 21:27:17'),
(21, 'Levi ', 'Ackerman', 'levi338@gmail.com', '38495293', '2004-05-28', 'Male', 'yareyarelevi', '$2y$10$XyfuvllMS8f9O4rWKMZNk.8XDRk1VtWBFdOg8Gu/kI2JsYcPjjbsq', '2024-05-28 06:51:22'),
(22, 'Five ', 'Hargreeves', 'five2019@yahoo.com', '32344452', '1989-10-01', 'Female', 'Number 5', '$2y$10$UFizOwHpcSWH68wFBPimUOOS.bc4c5EC70oIdrPqRjZo1sxLy9I/i', '2024-06-18 15:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) DEFAULT NULL,
  `description` text NOT NULL,
  `availability` varchar(50) NOT NULL,
  `rating` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `image_url`, `price`, `discounted_price`, `description`, `availability`, `rating`, `created_at`) VALUES
(1, '1010, Chelco Versions', 'uploads/tapeRecord.png', 375.90, 469.00, 'The 1010, Chelco Version is a compact cassette data recorder designed for use with Atari 8-bit home computers. It enables users to store and load programs and data on standard audio cassettes. Featuring easy connectivity and reliable performance, the 1010 offers a user-friendly interface for data management, enhancing the functionality of Atari\'s classic computer systems.', '1', 4, '2024-06-19 14:31:22'),
(2, '1010, Sanyo Versions', 'tapeRecord2.png', 395.90, 499.00, '1010, Sanyo Versions tape record is a nostalgic reproduction of classic arcade gaming soundtracks on cassette tapes. It captures the essence of retro gaming with its authentic audio experience, featuring iconic sound effects and music from the Sanyo Versions of the game. Perfect for collectors and enthusiasts seeking to relive the golden age of arcade gaming.', '1', 4, '2024-06-20 11:37:00'),
(3, 'Atari 822 Printer Thermal Head CB101726', 'Tprinter.png', 450.90, 699.00, 'The ATARI 822 Printer Thermal Head CB101726 is a reliable and high-quality thermal print head designed specifically for the ATARI 822 printer. With precise engineering and advanced thermal printing technology, it ensures crisp and clear prints with every use. Ideal for businesses, offices, and enthusiasts who demand professional printing results.', '1', 4, '2024-06-20 14:51:33'),
(4, 'Atari CX85 Keypad Handle Disk CX8139', 'Atari-CX85.png', 350.90, 599.00, 'The Atari CX85 Keypad is a handy accessory designed for easy input on Atari computers. It features a disk handle, making it convenient for users to navigate menus, input commands, and control various functions with precision. With its ergonomic design and compatibility with Atari systems, it enhances user experience and productivity during computing tasks.', '1', 4, '2024-06-20 14:54:00'),
(5, 'Atari CX77 Touch Tablet CX779', 'uploads/TouchTablet.png', 350.90, 599.00, 'The Atari CX77 Touch Tablet, model CX779, offers intuitive input for Atari computers. With its touch-sensitive surface, users can draw, write, or interact with software directly on the tablet, providing a versatile and precise input method. It enhances creativity, productivity, and ease of use for graphic design, gaming, and educational applications on Atari systems.', '1', 4, '2024-06-20 14:58:43'),
(6, 'Atari Reconditioned US 800XL Computer CB101939RO', 'uploads/RecondComputer.png', 550.90, 899.00, 'The Atari Reconditioned US 800XL computer, model CB101939RO, is a refurbished version of the classic Atari 800XL home computer. Featuring improved reliability and performance, this reconditioned unit offers the nostalgic experience of retro computing with modern reliability. Ideal for enthusiasts, collectors, or those seeking a vintage computing experience, it provides access to a vast library of classic software and games from the Atari era.', '1', 4, '2024-06-20 15:00:10'),
(7, 'Atari 1050 Tandon Track 00 Sensor CB101148', 'uploads/floppyDisk.png', 450.90, 799.00, 'The Atari 1050 Tandon Track 00 Sensor, model CB101148, is a crucial component of the Atari 1050 disk drive system. This sensor ensures accurate positioning of the read/write head to track 00, enabling proper reading and writing of data on floppy disks. It plays a vital role in the functionality and reliability of the Atari 1050 disk drive, ensuring smooth operation and data integrity for users.', '1', 4, '2024-06-20 15:01:55'),
(8, 'Atari 810 MPI Motor CB101132', 'uploads/MPI.png', 450.90, 799.00, 'The Atari 810 MPI Motor, model CB101132, is a replacement motor specifically designed for the Atari 810 Memory Module Port Interface (MPI). This motor ensures smooth and reliable operation of the MPI, which expands the capabilities of Atari 8-bit computers by providing additional memory and peripheral connectivity. With this motor, users can maintain or restore the functionality of their Atari 810 MPI, ensuring continued enjoyment of expanded computing capabilities.', '1', 4, '2024-06-20 16:23:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
