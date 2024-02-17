-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 09:39 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_car`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userType` enum('admin','coAdmin') DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `recoveryQuestionOption` int(11) DEFAULT NULL,
  `recoveryAnswer` varchar(50) DEFAULT NULL,
  `status` enum('unblock','block') NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userType`, `username`, `email`, `password`, `mobile`, `address`, `recoveryQuestionOption`, `recoveryAnswer`, `status`, `image`) VALUES
(1, 'admin', 'Ubaid Khan', 'ubaid@gmail.com', '6c474b7fe72b60d28857f5ee1d300045', '3216598878', 'Nowshera', 1, 'Islamabad', 'unblock', 'uploads/1749417995402273.jpg'),
(4, 'coAdmin', 'Co Admin', 'coadmin@gmail.com', '9673a5085810ad1dd3274abd75c03cea', '0333255558', 'Islamabad', 2, 'Sir Sahib Zada', 'unblock', 'uploads/1749412662173499.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `bookingNumber` bigint(12) NOT NULL,
  `userId` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `driver` enum('no','yes') NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `message` longtext DEFAULT NULL,
  `bookingStatus` enum('notConfirm','confirm','cancel') NOT NULL,
  `bookingDate` timestamp NULL DEFAULT current_timestamp(),
  `lastUpdationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `bookingNumber`, `userId`, `vehicleId`, `driver`, `fromDate`, `toDate`, `message`, `bookingStatus`, `bookingDate`, `lastUpdationDate`) VALUES
(1, 253002, 4, 6, 'no', '2022-11-08', '2022-11-10', 'I need it for one day', 'confirm', '2022-11-07 21:17:35', '2022-12-04 14:22:23'),
(2, 504023, 4, 5, 'yes', '2022-11-08', '2022-11-10', 'I Need Audi for 3 days picknick', 'notConfirm', '2022-11-07 21:21:53', '2022-12-25 12:21:10'),
(3, 669854, 4, 6, 'no', '2022-11-09', '2022-11-12', 'I Need Audi for 3 days picknick.', 'notConfirm', '2022-11-09 11:04:41', '2022-12-24 10:49:58'),
(5, 202071844, 4, 6, 'yes', '2022-12-04', '2022-12-05', 'I need this car', 'cancel', '0000-00-00 00:00:00', '2022-12-25 12:23:08'),
(6, 766873937, 4, 10, 'no', '2022-12-03', '2022-12-06', 'I need this car for three days', 'confirm', '0000-00-00 00:00:00', '2022-12-04 15:20:49'),
(7, 573020645, 4, 10, 'yes', '2022-12-25', '2022-12-28', 'I need this car', 'cancel', '0000-00-00 00:00:00', '2022-12-25 12:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updation_date` varchar(155) NOT NULL,
  `status` enum('unblock','block') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `creation_date`, `updation_date`, `status`) VALUES
(8, 'Suzuki', '2022-12-04 13:00:20', '', 'unblock'),
(9, 'Audi', '2022-12-05 12:48:42', '2022/12/05', 'unblock'),
(10, 'BMW', '2022-11-04 19:00:00', '', 'unblock'),
(11, 'Mazda', '2022-11-07 11:00:40', '2022/11/06', 'block'),
(15, 'Toyota', '2022-12-03 19:00:00', '', 'unblock');

-- --------------------------------------------------------

--
-- Table structure for table `companyprofile`
--

CREATE TABLE `companyprofile` (
  `id` int(11) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `regNo` varchar(20) NOT NULL,
  `companyEmail` varchar(120) NOT NULL,
  `companyphone` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `companyAddress` varchar(150) NOT NULL,
  `companyLogo` varchar(150) NOT NULL,
  `status` enum('open','close') NOT NULL,
  `creationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companyprofile`
--

INSERT INTO `companyprofile` (`id`, `companyName`, `regNo`, `companyEmail`, `companyphone`, `country`, `companyAddress`, `companyLogo`, `status`, `creationDate`) VALUES
(1, 'Fast Car Rent Services', '888999111', 'fast@rentcar.com', '051589748', 'Pakistan', 'Office#25, 2nd Floor Near Liberty   Chowk, Gullberg III, Lahore', 'uploads/1749498364178793.jpg', 'open', '2022-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('Pending','Seen') NOT NULL,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullName`, `email`, `message`, `status`, `dateTime`) VALUES
(2, 'hashim', 'hashim@gmail.com', 'your services are very good and fast', 'Pending', '2022-12-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `license` varchar(13) NOT NULL,
  `dob` date NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL,
  `applyOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `fullname`, `mobile`, `email`, `license`, `dob`, `city`, `country`, `address`, `status`, `applyOn`) VALUES
(1, 'test user', '1112225554', 'test@gmail.com', '1548796587452', '2022-01-01', 'Islamabad', 'Pakistan', 'Islamabad Punjab, Pakitan', 'rejected', '2022-12-15 00:00:00'),
(4, 'Ali', '7687867', 'ali@gmail.com', '1121212121212', '2023-01-01', 'nn', 'mm', 'lkjlk', 'pending', '2023-01-25 20:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `registeredcars`
--

CREATE TABLE `registeredcars` (
  `id` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `carName` varchar(255) NOT NULL,
  `pricePerDay` double NOT NULL,
  `makeYear` int(11) NOT NULL,
  `seatCapacity` int(11) NOT NULL,
  `fuelType` varchar(255) NOT NULL,
  `imageOne` varchar(255) NOT NULL,
  `imageTwo` varchar(255) NOT NULL,
  `imageThree` varchar(255) NOT NULL,
  `imageFour` varchar(255) NOT NULL,
  `imageFive` varchar(255) NOT NULL,
  `carDesc` text NOT NULL,
  `airConditioner` enum('off','on') NOT NULL,
  `powerLockDoor` enum('off','on') NOT NULL,
  `ABS` enum('off','on') NOT NULL,
  `breakAssist` enum('off','on') NOT NULL,
  `powerSteering` enum('off','on') NOT NULL,
  `driverAirbag` enum('off','on') NOT NULL,
  `passengerAirbag` enum('off','on') NOT NULL,
  `powerWindow` enum('off','on') NOT NULL,
  `cdPlayer` enum('off','on') NOT NULL,
  `centralLocking` enum('off','on') NOT NULL,
  `crashSensor` enum('off','on') NOT NULL,
  `leatherSeats` enum('off','on') NOT NULL,
  `registrationDate` date NOT NULL,
  `updationDate` date NOT NULL,
  `carStatus` enum('unblock','block') NOT NULL DEFAULT 'unblock'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registeredcars`
--

INSERT INTO `registeredcars` (`id`, `brandId`, `carName`, `pricePerDay`, `makeYear`, `seatCapacity`, `fuelType`, `imageOne`, `imageTwo`, `imageThree`, `imageFour`, `imageFive`, `carDesc`, `airConditioner`, `powerLockDoor`, `ABS`, `breakAssist`, `powerSteering`, `driverAirbag`, `passengerAirbag`, `powerWindow`, `cdPlayer`, `centralLocking`, `crashSensor`, `leatherSeats`, `registrationDate`, `updationDate`, `carStatus`) VALUES
(5, 10, 'BMW Series 5', 7000, 2016, 5, 'hybird', 'uploads/1748868075285753.jpg', 'uploads/1748868075286429.jpg', 'uploads/1748868075286970.jpg', 'uploads/1748868075287455.jpg', 'uploads/1748868075287911.jpg', 'Series 5 full option\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi maxime nihil corporis, illum magnam sit architecto rerum voluptates ex nam cumque explicabo vitae dolorum dicta eum eos maiores odit accusantium. Debitis magni aperiam animi, alias nesciunt possimus aspernatur explicabo. Consectetur ipsam autem a laboriosam quisquam suscipit obcaecati ipsum? Possimus, sed.', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', '2022-11-07', '2022-11-17', 'unblock'),
(6, 9, 'Audi v5', 8000, 2018, 5, 'hybird', 'uploads/1748868177158264.jpg', 'uploads/1748868177158737.jpg', 'uploads/1748868177159323.jpg', 'uploads/1748868177184708.jpg', 'uploads/1748868177185443.jpg', 'Audi v5 Red colour.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi maxime nihil corporis, illum magnam sit architecto rerum voluptates ex nam cumque explicabo vitae dolorum dicta eum eos maiores odit accusantium. Debitis magni aperiam animi, alias nesciunt possimus aspernatur explicabo. Consectetur ipsam autem a laboriosam quisquam suscipit obcaecati ipsum? Possimus, sed.', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', '2022-11-07', '2022-11-17', 'unblock'),
(7, 8, 'Maruti', 3000, 2018, 4, 'hybird', 'uploads/1751288552120945.jpg', 'uploads/1751288552135372.jpg', 'uploads/1751288552135983.jpg', 'uploads/1751288552150831.jpg', 'uploads/1751288552151611.jpg', 'Maruti swift hybird car', 'on', 'on', 'off', 'off', 'on', 'on', 'on', 'on', 'on', 'on', 'off', 'on', '2022-12-04', '0000-00-00', 'unblock'),
(8, 15, 'Furtuner', 6000, 2019, 8, 'deisel', 'uploads/1751288693252406.jpg', 'uploads/1751288693253044.jpg', 'uploads/1751288693254050.jpg', 'uploads/1751288693254703.jpg', 'uploads/1751288693255265.jpg', 'Furtuner', 'on', 'on', 'on', 'on', 'on', 'on', 'off', 'on', 'on', 'on', 'on', 'on', '2022-12-04', '0000-00-00', 'unblock'),
(9, 15, 'Altis SSR', 3500, 2020, 4, 'hybird', 'uploads/1751288894578409.jpg', 'uploads/1751288894579027.jpg', 'uploads/1751288894579558.jpg', 'uploads/1751288894580060.jpg', 'uploads/1751288894580569.jpg', 'Toyota altis LTD.\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Officia molestias distinctio minus doloribus reprehenderit. Non consectetur nihil quae fugit eveniet?', 'on', 'on', 'on', 'off', 'on', 'off', 'off', 'on', 'on', 'on', 'off', 'on', '2022-12-04', '0000-00-00', 'unblock'),
(10, 10, 'BMW 7 Edition', 6500, 2021, 4, 'petrol', 'uploads/1751289064614359.jpg', 'uploads/1751289064615196.jpg', 'uploads/1751289064616337.jpg', 'uploads/1751289064617112.jpg', 'uploads/1751289064617709.jpg', 'BMW 7 EDITION SPORTS CAR\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Officia molestias distinctio minus doloribus reprehenderit. Non consectetur nihil quae fugit eveniet?', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', '2022-12-04', '0000-00-00', 'unblock');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cnic` varchar(13) NOT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `contactNo` varchar(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(120) NOT NULL,
  `status` enum('unblock','block') NOT NULL,
  `regDate` date NOT NULL,
  `updationDate` date NOT NULL,
  `userImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `email`, `cnic`, `dob`, `password`, `contactNo`, `address`, `city`, `country`, `status`, `regDate`, `updationDate`, `userImage`) VALUES
(4, 'Ubaid', 'ubaid@gmail.com', '1785965478965', '1996-02-06', '6c474b7fe72b60d28857f5ee1d300045', '032190000000', 'Akora khattak', 'Nowshera, Soria Khel', 'Pakistan', 'unblock', '0000-00-00', '2022-12-04', 'uploads/1751291866470675.jpg'),
(8, 'Ali', 'ali@gmail.com', '1748574859645', '2023-01-01', '81dc9bdb52d04dc20036dbd8313ed055', 'pooiipoi', '', 'nn', 'mm', 'unblock', '2023-01-25', '0000-00-00', ''),
(9, 'Ali', 'ali1@gmail.com', '1212121212121', '2023-01-01', 'b59c67bf196a4758191e42f76670ceba', 'jkhjkj', '', 'hgjh', 'yryt', 'unblock', '2023-01-25', '0000-00-00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookingNumber` (`bookingNumber`),
  ADD KEY `vehicleId` (`vehicleId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_name` (`brand_name`),
  ADD KEY `brand_name_2` (`brand_name`);

--
-- Indexes for table `companyprofile`
--
ALTER TABLE `companyprofile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regNo` (`regNo`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registeredcars`
--
ALTER TABLE `registeredcars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brandId` (`brandId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `companyprofile`
--
ALTER TABLE `companyprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registeredcars`
--
ALTER TABLE `registeredcars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`vehicleId`) REFERENCES `registeredcars` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `registeredcars`
--
ALTER TABLE `registeredcars`
  ADD CONSTRAINT `registeredcars_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
