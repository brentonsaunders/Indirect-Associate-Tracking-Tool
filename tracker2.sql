-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 02:13 PM
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
-- Database: `tracker2`
--

-- --------------------------------------------------------

--
-- Table structure for table `associates`
--

CREATE TABLE `associates` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `associates`
--

INSERT INTO `associates` (`id`, `name`) VALUES
('saubrent', 'Brenton Saunders'),
('tamabrag', 'Tamara Bragg');

-- --------------------------------------------------------

--
-- Table structure for table `associate_locations`
--

CREATE TABLE `associate_locations` (
  `id` int(11) NOT NULL,
  `associate_id` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `associate_locations`
--

INSERT INTO `associate_locations` (`id`, `associate_id`, `location_id`, `note`, `time`) VALUES
(15, 'saubrent', 'dKbz5DCdzaRwmlDTawPBrSUKpo1iEgkY', '', '2022-04-17 09:57:36'),
(16, 'saubrent', 'Yd5ouLviqz3RJj7mTXG5XkqSO3n90kCf', '', '2022-04-17 11:12:04'),
(17, 'saubrent', 'cUZxr48J4HI87eAUuyPtSht6qPTyrYrF', '', '2022-04-17 11:13:39'),
(18, 'saubrent', 'cUZxr48J4HI87eAUuyPtSht6qPTyrYrF', '', '2022-04-17 11:14:04'),
(19, 'saubrent', 'jfqw0nZiCb97eum6CGbpSQ9Vu7AQ4uJV', '', '2022-04-17 11:14:52'),
(20, 'saubrent', 'ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', '', '2022-04-17 11:15:08'),
(21, 'saubrent', 'ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', '', '2022-04-17 11:21:36'),
(22, 'saubrent', 'ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', '', '2022-04-17 11:29:57'),
(23, 'saubrent', 'ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', '', '2022-04-17 11:31:01'),
(24, 'saubrent', 'ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', '', '2022-04-17 11:31:37'),
(25, 'saubrent', 'ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', '', '2022-04-17 11:32:23'),
(26, 'saubrent', 'ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', '', '2022-04-17 11:34:42'),
(27, 'saubrent', 'ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', 'petty', '2022-04-17 11:35:03'),
(28, 'saubrent', 'mOkbiTA3CmhHqh9MTgrXbUa1zlKf0QI9', 'Have to take a shit real quick! Brb', '2022-04-17 11:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
('0jfAoh37xuwEo25Do6Nw9vz1K3ENPKNe', 'DD343'),
('1Pnn9eIhJSek6EhYEJNUEr8dx5JlqFF3', 'DD338'),
('3e3GbU91uubZ3pR9qPPcSbi72lELQ4th', 'DD341'),
('aNYf95eUrh7fwbyuRQFwahgDBM4BkzwY', 'DD339'),
('aZUcyMa3zCRUQ25zM3sPJ8OvhGG1BfbW', 'DD331'),
('ChNZpfPpaMEdlHXdJfZoDIFpkbgfQocO', 'DD335'),
('ClOMcxdWNOMZv0sTdhSjVlQDaIdrp0Mq', 'DD328'),
('cUZxr48J4HI87eAUuyPtSht6qPTyrYrF', 'DD333'),
('DaOnktIPTvMvrrTu3V5rCGGgNg3Ll9O7', 'DD340'),
('dKbz5DCdzaRwmlDTawPBrSUKpo1iEgkY', 'DD330'),
('iOpOmiG1lRxME2Zup8DMDYzgvp4sbOaL', 'DD329'),
('jfqw0nZiCb97eum6CGbpSQ9Vu7AQ4uJV', 'DD334'),
('kvYhTfZP8NRxdFGw5RQZ4lhehV2Kb0qM', 'DD327'),
('mOkbiTA3CmhHqh9MTgrXbUa1zlKf0QI9', 'Break'),
('Q9HlhUTHxXXcKKqs3efrfDqjUw735Ghw', 'DD344'),
('ueJVIsMAz4W5iK1Ta0P2LUkBiGzIiUjR', 'DD342'),
('x8WhvfR5wF0V4AUy7dyHbB5CSwM6UwCv', 'DD337'),
('Y3j3C4b1a8flDKTR8rKlwOSJBDzjpmdy', 'DD336'),
('Yd5ouLviqz3RJj7mTXG5XkqSO3n90kCf', 'DD332');

-- --------------------------------------------------------

--
-- Table structure for table `shift_changes`
--

CREATE TABLE `shift_changes` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shift_changes`
--

INSERT INTO `shift_changes` (`id`, `time`) VALUES
(1, '2022-04-16 06:30:00'),
(4, '2022-04-16 18:30:00'),
(5, '2022-04-17 06:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associates`
--
ALTER TABLE `associates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `associate_locations`
--
ALTER TABLE `associate_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`associate_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_changes`
--
ALTER TABLE `shift_changes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associate_locations`
--
ALTER TABLE `associate_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `shift_changes`
--
ALTER TABLE `shift_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
