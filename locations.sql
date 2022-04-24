-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2022 at 03:32 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
