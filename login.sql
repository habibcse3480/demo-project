-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2017 at 07:20 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `agree` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `fname`, `lname`, `email`, `pass`, `dob`, `gender`, `image`, `agree`) VALUES
(1, 'marufcsediu', 'Pathaksa', 'Tongpitak', 'casino@pressclick.nl', '5824fd60d32582b74599f4ffca8a072f', '2017-12-28', 'male', '89046___Desktop-hd-background.jpg', 'agree'),
(2, 'rion', 'Rion', 'Maruf', 'naniksufianti@pressclick.nl', '5e07f9fcb745af01a249f3623471cc85', '2017-12-13', 'male', '50956___', 'agree'),
(3, 'maruf', 'dghsdg', 'dggdgd', 'dgdhd@mail.com', '5aff6e5c79b1cadcb1ec5c3f28b8525e', '2017-12-28', 'male', '24077___', 'agree');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
