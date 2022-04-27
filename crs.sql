-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 06:56 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crs`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(10) NOT NULL,
  `bill_dt` datetime DEFAULT NULL,
  `bid` int(20) DEFAULT NULL,
  `base_pay` int(6) DEFAULT NULL,
  `late_fees` int(6) DEFAULT NULL,
  `discount` int(6) DEFAULT NULL,
  `total` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bid` int(20) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `pickup_locid` varchar(10) NOT NULL,
  `drop_locid` varchar(10) DEFAULT NULL,
  `driver_opted` int(1) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `act_ret_time` datetime DEFAULT NULL,
  `dcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bid`, `start_date`, `end_date`, `status`, `pickup_locid`, `drop_locid`, `driver_opted`, `user_email`, `act_ret_time`, `dcode`) VALUES
(57, '2021-07-05 17:22:00', '2021-07-08 17:22:00', 'unpaid', 'L101', '', 1, 'f20190333@example.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `regno` varchar(15) NOT NULL,
  `model` varchar(15) DEFAULT NULL,
  `make` varchar(15) DEFAULT NULL,
  `model_year` int(4) DEFAULT NULL,
  `mileage` int(2) DEFAULT NULL,
  `category` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`regno`, `model`, `make`, `model_year`, `mileage`, `category`) VALUES
('UP 61 AX 0868', 'S Class', 'BMW', 2017, 25, 'Sedan'),
('UP 63 AX 0868', 'swift', 'Maruti', 2017, 16, 'Sedan'),
('UP 65 AX 0868', 'Estilo', 'Maruti', 2021, 15, 'Sedan'),
('UP 65 AX 0869', 'Innova', 'Toyota', 2016, 22, 'SUV'),
('UP 65 AX 0870', 'SX4', 'Maruti', 2014, 16, 'Sedan'),
('UP 65 AY 0868', 'Estilo', 'Maruti', 2010, 16, 'Sedan');

-- --------------------------------------------------------

--
-- Table structure for table `car_booking`
--

CREATE TABLE `car_booking` (
  `regno` varchar(15) NOT NULL,
  `bid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_booking`
--

INSERT INTO `car_booking` (`regno`, `bid`) VALUES
('UP 65 AX 0868', 57);

-- --------------------------------------------------------

--
-- Table structure for table `car_cat`
--

CREATE TABLE `car_cat` (
  `cat_name` varchar(15) NOT NULL,
  `pcap` int(2) DEFAULT NULL,
  `lug_cap` int(10) DEFAULT NULL,
  `cost_pd` int(10) DEFAULT NULL,
  `late_fees_ph` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_cat`
--

INSERT INTO `car_cat` (`cat_name`, `pcap`, `lug_cap`, `cost_pd`, `late_fees_ph`) VALUES
('Mini', 4, 200, 5000, 50),
('Sedan', 7, 500, 10000, 100),
('SUV', 9, 750, 15000, 150);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `Dcode` varchar(10) NOT NULL,
  `Dname` varchar(20) DEFAULT NULL,
  `Dpercent` int(3) DEFAULT NULL,
  `expiry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`Dcode`, `Dname`, `Dpercent`, `expiry`) VALUES
('K101', 'hello', 12, '2021-07-02'),
('M101', 'Welcome', 10, '2024-12-31'),
('M102', 'SUMMER', 5, '2021-07-31'),
('M103', 'ENDSEMSALE', 15, '2021-05-15'),
('M110', 'Prsp', 12, '2022-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `dl_num` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `aadhar_num` int(30) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pincode` int(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `experience` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`dl_num`, `fname`, `mname`, `lname`, `aadhar_num`, `street`, `city`, `state`, `pincode`, `email`, `experience`) VALUES
('123456789', 'Harish', 'Chandra', 'Sinha', 123456, 'kandivali', 'Ghazipur', 'Uttar Pradesh', 233001, 'abc@example.com', 5),
('445566778899', 'Shivam', 'Kumar', 'Agrawal', 987654321, 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001, 'f20190326@hyderabad.bits-pilani.ac.in', 5);

-- --------------------------------------------------------

--
-- Table structure for table `driver_booking`
--

CREATE TABLE `driver_booking` (
  `dl_num` varchar(30) NOT NULL,
  `bid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver_booking`
--

INSERT INTO `driver_booking` (`dl_num`, `bid`) VALUES
('445566778899', 57);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `email` varchar(256) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `aadhar` varchar(12) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `pincode` int(8) DEFAULT NULL,
  `dl` varchar(20) DEFAULT NULL,
  `is_admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`email`, `password`, `fname`, `mname`, `lname`, `aadhar`, `phone`, `street`, `city`, `state`, `pincode`, `dl`, `is_admin`) VALUES
('f2019032612@example.com', '', 'Shivam', 'Kumar', 'Agrawal', '123456784567', 2147483647, 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001, '123456789655', 1),
('f20190326@example.com', '', 'Shivam', 'Kumar', 'Agrawal', '', 2147483647, 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001, '', 0),
('f20190327@example.com', 'hello', 'Shivam', 'Kumar', 'Agrawal', '123456789123', 2147483647, 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001, '', 0),
('f20190328@example.com', 'hello', 'Shivam', 'Kumar', 'Agrawal', '123456789125', 2147483647, 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001, '123456789', 1),
('f20190333@example.com', 'hello', 'Shivam', 'Kumar', 'Agrawal', '123456789445', 2147483647, 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001, '123456789', 1),
('f20190358@gmail.com', 'anurodh', 'Anurodh', '', 'Chadha', '999988887777', 2147483647, 'Kusum vatika', 'Mathura', 'Uttar Pradesh', 281003, NULL, 1),
('f20190428@example.com', 'ui', 'Shivam', 'Kumar', 'Agrawal', '723456789124', 2147483647, 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001, NULL, 0),
('f20190@example.com', 'ui', 'Shivam', 'Kumar', 'Agrawal', '723456789123', 2147483647, 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locid` varchar(10) NOT NULL,
  `locname` varchar(20) DEFAULT NULL,
  `street` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locid`, `locname`, `street`, `city`, `state`, `pincode`) VALUES
('L101', 'Lanka', 'Navkapura', 'Ghazipur', 'Uttar Pradesh', 233001),
('L102', 'mahuabag', 'mahuabag', 'Ghazipur', 'Uttar Pradesh', 233001),
('L103', 'BHU', 'Lanka', 'Varanasi', 'Uttar Pradesh', 233001);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD UNIQUE KEY `Myunique` (`bid`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `fkuser` (`user_email`),
  ADD KEY `fkdisc` (`dcode`),
  ADD KEY `fkpick` (`pickup_locid`),
  ADD KEY `fkdroploc` (`drop_locid`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`regno`),
  ADD KEY `fk1` (`category`);

--
-- Indexes for table `car_booking`
--
ALTER TABLE `car_booking`
  ADD PRIMARY KEY (`regno`,`bid`),
  ADD KEY `fkbid` (`bid`);

--
-- Indexes for table `car_cat`
--
ALTER TABLE `car_cat`
  ADD PRIMARY KEY (`cat_name`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`Dcode`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`dl_num`);

--
-- Indexes for table `driver_booking`
--
ALTER TABLE `driver_booking`
  ADD PRIMARY KEY (`dl_num`,`bid`),
  ADD KEY `fkbid` (`bid`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `aadhar` (`aadhar`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fkbbid` FOREIGN KEY (`bid`) REFERENCES `booking` (`bid`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fkdisc` FOREIGN KEY (`dcode`) REFERENCES `discount` (`Dcode`),
  ADD CONSTRAINT `fkpick` FOREIGN KEY (`pickup_locid`) REFERENCES `location` (`locid`),
  ADD CONSTRAINT `fkuser` FOREIGN KEY (`user_email`) REFERENCES `info` (`email`);

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`category`) REFERENCES `car_cat` (`cat_name`);

--
-- Constraints for table `driver_booking`
--
ALTER TABLE `driver_booking`
  ADD CONSTRAINT `fkbid` FOREIGN KEY (`bid`) REFERENCES `booking` (`bid`),
  ADD CONSTRAINT `fkdl` FOREIGN KEY (`dl_num`) REFERENCES `driver` (`dl_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
