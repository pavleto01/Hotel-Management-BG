-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 05:21 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id_agent` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_phone` varchar(255) NOT NULL,
  `agent_position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id_agent`, `agent_name`, `agent_phone`, `agent_position`) VALUES
(1, 'Стефан', '0875961787', 1),
(2, 'Ивайла', '0891456327', 2),
(3, 'Петър', '08741564895', 3),
(5, 'Драган', '0871564896', 3),
(6, 'Георги', '08781578945', 4),
(8, 'Петър', '084616794', 4);

-- --------------------------------------------------------

--
-- Table structure for table `agent_pos`
--

CREATE TABLE `agent_pos` (
  `id_pos` int(11) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent_pos`
--

INSERT INTO `agent_pos` (`id_pos`, `position`) VALUES
(1, 'Фронт-офис мениджър'),
(2, 'Старши администратор'),
(3, 'Администратор'),
(4, 'Пиколо'),
(5, 'Чистач');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `client_fname` varchar(255) NOT NULL,
  `client_lname` varchar(255) NOT NULL,
  `client_address` varchar(255) NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_bill` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `client_fname`, `client_lname`, `client_address`, `client_phone`, `client_email`, `client_bill`) VALUES
(1, 'Павел', 'Тодоров', 'Шумен', '0874596578', 'pavel@gmail.com', '0.00'),
(2, 'Иван', 'Димитров', 'Варна', '0874561578', 'ivan@gmail.com', '0.00'),
(4, 'Тодор', 'Петров', 'Бургас', '0561489715', 'todor@gmail.com', '100.00'),
(5, 'Стефан', 'Георгиев', 'Смолян', '0874961578', 'stefan@abv.bg', '0.00'),
(6, 'Никола', 'Николов', 'Русе', '054800161', 'nik@mail.bg', '0.00'),
(7, 'Димитър', 'Иванов', 'Пловдив', '054800000', 'mitaka@abv.bg', '0.00'),
(8, 'Мария', 'Петрова', 'София 19', '0789463158', 'mariq@gmail.com', '0.00'),
(9, 'Гергана', 'Попова', 'Плевен', '0878956230', 'gergana@abv.bg', '0.00'),
(10, 'Наташа', 'Романов', 'Габрово', '084516497', 'scarletwitch@gmail.com', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `res_client` int(11) NOT NULL,
  `res_agent` int(11) NOT NULL,
  `res_room` int(11) NOT NULL,
  `date_in` datetime NOT NULL,
  `date_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `res_client`, `res_agent`, `res_room`, `date_in`, `date_out`) VALUES
(1, 1, 2, 2, '2022-04-04 13:16:53', '2022-04-12 16:01:00'),
(11, 4, 3, 1, '2022-04-18 16:34:00', '2022-04-20 16:34:00'),
(12, 1, 5, 7, '2022-04-19 16:35:00', '2022-04-21 16:35:00'),
(13, 2, 2, 3, '2022-05-04 11:21:00', '2022-05-07 11:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_type` int(255) NOT NULL,
  `room_price` varchar(255) NOT NULL,
  `room_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `room_number`, `room_type`, `room_price`, `room_status`) VALUES
(1, '101', 1, '150', 'FREE'),
(2, '102', 1, '100', 'FREE'),
(3, '103', 1, '250', 'FREE'),
(4, '201', 2, '450', 'FREE'),
(5, '202', 2, '250', 'FREE'),
(6, '203', 2, '500', 'FREE'),
(7, '301', 3, '1095', 'FREE'),
(8, '302', 4, '950', 'FREE'),
(9, '303', 4, '1200', 'FREE');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id_type` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id_type`, `type`) VALUES
(1, 'Една спалня'),
(2, 'Две спални'),
(3, 'Мезонет със 7 легла'),
(4, 'Мезонет с 8 легла'),
(5, 'Мезонет с 9 легла');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id_agent`),
  ADD KEY `agent_position` (`agent_position`);

--
-- Indexes for table `agent_pos`
--
ALTER TABLE `agent_pos`
  ADD PRIMARY KEY (`id_pos`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `room` (`res_room`),
  ADD KEY `agent` (`res_agent`),
  ADD KEY `client` (`res_client`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `room_type` (`room_type`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `agent_pos`
--
ALTER TABLE `agent_pos`
  MODIFY `id_pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_position` FOREIGN KEY (`agent_position`) REFERENCES `agent_pos` (`id_pos`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `agent` FOREIGN KEY (`res_agent`) REFERENCES `agent` (`id_agent`),
  ADD CONSTRAINT `client` FOREIGN KEY (`res_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `room` FOREIGN KEY (`res_room`) REFERENCES `room` (`id_room`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_type` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
