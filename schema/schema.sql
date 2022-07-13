-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 15, 2020 at 11:43 AM
-- Server version: 5.7.29
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `name` varchar(255) ,
  `username` varchar(255) ,
  `password` varchar(255),
  `fine` int SET DEFAULT(0)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--
CREATE TABLE `books` (
  `bookname` varchar(255) ,
  `username` varchar(255) ,
  `status` int SET DEFAULT(0),
  `issued_on` datetime,
  `returned_on` datetime,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- AUTO_INCREMENT for table `posts`
--

CREATE TABLE `Book` (
  `bookname` varchar(255) ,
  `number` int SET DEFAULT(0)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `Book`
  ADD PRIMARY KEY (`bookname`);