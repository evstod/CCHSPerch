-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 04:18 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perchweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogpost`
--

CREATE TABLE `blogpost` (
  `Prim` int(3) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Title` varchar(80) NOT NULL,
  `Body` text NOT NULL,
  `HasImage` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogpost`
--

INSERT INTO `blogpost` (`Prim`, `Date`, `Title`, `Body`, `HasImage`) VALUES
(1, '2021-04-29', 'A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Convallis tellus id interdum velit laoreet id donec. Gravida cum sociis natoque penatibus et. Nulla facilisi cras fermentum odio. Facilisis sed odio morbi quis commodo. Est ante in nibh mauris cursus. Euismod quis viverra nibh cras pulvinar mattis nunc sed blandit. Adipiscing elit ut aliquam purus. Integer feugiat scelerisque varius morbi enim nunc faucibus a pellentesque. Velit dignissim sodales ut eu. Aliquam id diam maecenas ultricies mi eget. Est placerat in egestas erat. Amet facilisis magna etiam tempor orci eu lobortis. Luctus venenatis lectus magna fringilla urna porttitor rhoncus dolor.\r\n\r\nIaculis eu non diam phasellus. Netus et malesuada fames ac. Accumsan in nisl nisi scelerisque eu ultrices vitae auctor. Ante in nibh mauris cursus mattis molestie a. Nisl rhoncus mattis rhoncus urna neque viverra. Pretium viverra suspendisse potenti nullam. Nulla facilisi etiam dignissim diam quis enim lobortis. Tincidunt arcu non sodales neque sodales ut etiam sit amet. Tincidunt vitae semper quis lectus nulla at. Sed risus ultricies tristique nulla aliquet. Congue eu consequat ac felis. Magna sit amet purus gravida quis blandit turpis cursus in. Ultrices gravida dictum fusce ut placerat orci. Congue quisque egestas diam in arcu cursus euismod.\r\n\r\nDictum at tempor commodo ullamcorper a. Cursus metus aliquam eleifend mi in nulla posuere sollicitudin. Fringilla est ullamcorper eget nulla facilisi etiam dignissim diam quis. Mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa. Curabitur vitae nunc sed velit dignissim sodales ut eu. Leo vel fringilla est ullamcorper eget. Dolor magna eget est lorem ipsum dolor sit amet. Nullam non nisi est sit amet facilisis magna. Laoreet suspendisse interdum consectetur libero id faucibus nisl. Id volutpat lacus laoreet non curabitur gravida arcu ac tortor. Felis eget velit aliquet sagittis id.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coffee_flavor`
--

CREATE TABLE `coffee_flavor` (
  `Prim` int(2) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coffee_flavor`
--

INSERT INTO `coffee_flavor` (`Prim`, `Name`, `Enabled`) VALUES
(1, 'Regular', 1),
(2, 'Decaf', 1),
(3, 'Flavor of the Month', 1),
(4, 'Iced Coffee', 0),
(5, 'Iced Vanilla Latte', 1);

-- --------------------------------------------------------

--
-- Table structure for table `misc_flavor`
--

CREATE TABLE `misc_flavor` (
  `Prim` int(2) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `misc_flavor`
--

INSERT INTO `misc_flavor` (`Prim`, `Name`, `Enabled`) VALUES
(1, 'Hot Chocolate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Prim` int(2) NOT NULL,
  `UserType` varchar(15) NOT NULL,
  `UserID` varchar(30) NOT NULL,
  `Contents` text NOT NULL,
  `Notes` text NOT NULL,
  `Delivery` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Prim`, `UserType`, `UserID`, `Contents`, `Notes`, `Delivery`) VALUES
(7, 'Staff', 'ateacher@clsd.k12.pa.us', '1 - Lipton Black Tea\n13 - Chai\nTotal Cost: 14\r\nDelivery requested to ROOM\r\n', '403', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tea_flavor`
--

CREATE TABLE `tea_flavor` (
  `Prim` int(2) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tea_flavor`
--

INSERT INTO `tea_flavor` (`Prim`, `Name`, `Enabled`) VALUES
(1, 'Lipton Black Tea', 1),
(2, 'Honey Vanilla', 1),
(3, 'Chai', 1),
(4, 'Peppermint', 1),
(5, 'Green Tea', 1),
(6, 'Iced Tea', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_staff`
--

CREATE TABLE `user_staff` (
  `Prim` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `PIN` int(8) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_staff`
--

INSERT INTO `user_staff` (`Prim`, `FirstName`, `LastName`, `Email`, `PIN`, `isAdmin`) VALUES
(1, 'User', 'Teacher', 'ateacher@clsd.k12.pa.us', 1, 0),
(2, 'Teacher', 'Admin', 'teach2@clsd.k12.pa.us', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_student`
--

CREATE TABLE `user_student` (
  `ID` int(8) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `PIN` int(8) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_student`
--

INSERT INTO `user_student` (`ID`, `LastName`, `FirstName`, `PIN`, `isAdmin`) VALUES
(1, 'User', 'Test', 0, 1),
(2, 'Student', 'User', 1, 0),
(3, 'Student', 'Staff', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogpost`
--
ALTER TABLE `blogpost`
  ADD PRIMARY KEY (`Prim`);

--
-- Indexes for table `coffee_flavor`
--
ALTER TABLE `coffee_flavor`
  ADD PRIMARY KEY (`Prim`);

--
-- Indexes for table `misc_flavor`
--
ALTER TABLE `misc_flavor`
  ADD PRIMARY KEY (`Prim`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Prim`);

--
-- Indexes for table `tea_flavor`
--
ALTER TABLE `tea_flavor`
  ADD PRIMARY KEY (`Prim`);

--
-- Indexes for table `user_staff`
--
ALTER TABLE `user_staff`
  ADD PRIMARY KEY (`Prim`);

--
-- Indexes for table `user_student`
--
ALTER TABLE `user_student`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogpost`
--
ALTER TABLE `blogpost`
  MODIFY `Prim` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coffee_flavor`
--
ALTER TABLE `coffee_flavor`
  MODIFY `Prim` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `misc_flavor`
--
ALTER TABLE `misc_flavor`
  MODIFY `Prim` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Prim` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tea_flavor`
--
ALTER TABLE `tea_flavor`
  MODIFY `Prim` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_staff`
--
ALTER TABLE `user_staff`
  MODIFY `Prim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_student`
--
ALTER TABLE `user_student`
  MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
