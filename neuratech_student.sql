-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 11:19 AM
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
-- Database: `neuratech_student`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `link4to` text DEFAULT NULL,
  `number4n` varchar(20) DEFAULT NULL,
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `profilePhoto` text DEFAULT NULL,
  `contactNo` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `qrCodePath` varchar(255) DEFAULT NULL,
  `studentCardPath` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `qrPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `nic`, `link4to`, `number4n`, `registered_on`, `profilePhoto`, `contactNo`, `birthday`, `school`, `email`, `qrCodePath`, `studentCardPath`, `created_at`, `qrPath`) VALUES
(1, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:19:17', 'https://images.app.goo.gl/yF8fBS5n8RfbxHZL8', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 13:49:17', 'uploads/qrcodes/qr_1.png'),
(2, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:21:17', 'uploads/profile_photos/scan_1743841277.jpg', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 13:51:17', 'uploads/qrcodes/qr_2.png'),
(3, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:22:36', 'uploads/profile_photos/1743841356_DALL·E 2024-11-11 09.08.35 - A scene showing a young woman with curly hair, working as a web developer, sitting at a laptop with coding and web design elements around her. Beside .png', '0711743825', '1999-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 13:52:36', 'uploads/qrcodes/qr_3.png'),
(4, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:39:42', 'uploads/profile_photos/link_1743842379.jpg', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:09:42', 'uploads/qrcodes/qr_4.png'),
(5, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:42:12', 'uploads/profile_photos/1743842532_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:12:12', 'uploads/qrcodes/qr_5.png'),
(6, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:46:38', 'uploads/profile_photos/1743842798_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:16:38', 'uploads/qrcodes/qr_6.png'),
(7, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:50:09', 'uploads/profile_photos/1743843009_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:20:09', 'uploads/qrcodes/qr_7.png'),
(8, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:50:49', 'uploads/profile_photos/1743843049_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:20:49', 'uploads/qrcodes/qr_8.png'),
(9, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 08:57:24', 'uploads/profile_photos/1743843444_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:27:24', 'uploads/qrcodes/qr_9.png'),
(10, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 09:08:49', 'uploads/profile_photos/1743844129_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:38:49', 'uploads/qrcodes/qr_10.png'),
(11, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 09:08:53', 'uploads/profile_photos/1743844133_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:38:53', 'uploads/qrcodes/qr_11.png'),
(12, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 09:09:18', 'uploads/profile_photos/1743844158_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:39:18', 'uploads/qrcodes/qr_12.png'),
(13, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 09:09:51', 'uploads/profile_photos/1743844191_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:39:51', 'uploads/qrcodes/qr_13.png'),
(14, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 09:10:25', 'uploads/profile_photos/1743844225_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:40:25', 'uploads/qrcodes/qr_14.png'),
(15, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 09:10:31', 'uploads/profile_photos/1743844231_DALL·E 2024-11-11 12.17.53 - A realistic illustration of a professional woman embodying various aspects of her life. She is in a sophisticated workspace with a laptop, symbolizing.webp', '0711743825', '2025-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:40:31', 'uploads/qrcodes/qr_15.png'),
(16, 'Buddhini Madhudhani', '199951701759', NULL, NULL, '2025-04-05 09:16:50', 'uploads/profile_photos/1743844610_DALL·E 2024-11-11 09.07.37 - A vibrant illustration of a young woman with curly hair, working on her computer as a web developer in a cozy home office. The room has a blend of mod.webp', '0711743825', '1999-01-17', 'R/EMB/President college', 'wrbmadhushani@gmail.com', NULL, NULL, '2025-04-05 14:46:50', 'uploads/qrcodes/qr_16.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
