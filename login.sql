-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 10:05 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `answers2`
--

CREATE TABLE `answers2` (
  `Tid` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers2`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers_premium`
--

CREATE TABLE `answers_premium` (
  `Testid` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `f` text NOT NULL,
  `g` text NOT NULL,
  `h` text NOT NULL,
  `i` text NOT NULL,
  `j` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `a_code`
--

CREATE TABLE `a_code` (
  `AdminName` text NOT NULL,
  `Code` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_code`
--

INSERT INTO `a_code` (`AdminName`, `Code`) VALUES
('bikramghuku05@gmail.com', 'lol');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `USERNAME` text NOT NULL,
  `profilepwd` text NOT NULL,
  `PASSWORD` text NOT NULL,
  `TYPE` varchar(255) NOT NULL,
  `ADMINNAME` varchar(255) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--



-- --------------------------------------------------------

--
-- Table structure for table `questions2`
--

CREATE TABLE `questions2` (
  `Tid` text NOT NULL,
  `Tpwd` text NOT NULL,
  `TIME` int(255) NOT NULL,
  `CNAME` text NOT NULL,
  `a` text NOT NULL,
  `aa` text NOT NULL,
  `ab` text NOT NULL,
  `ac` text NOT NULL,
  `ad` text NOT NULL,
  `b` text NOT NULL,
  `ba` text NOT NULL,
  `bb` text NOT NULL,
  `bc` text NOT NULL,
  `bd` text NOT NULL,
  `c` text NOT NULL,
  `ca` text NOT NULL,
  `cb` text NOT NULL,
  `cc` text NOT NULL,
  `cd` text NOT NULL,
  `d` text NOT NULL,
  `da` text NOT NULL,
  `db` text NOT NULL,
  `dc` text NOT NULL,
  `dd` text NOT NULL,
  `e` text NOT NULL,
  `ea` text NOT NULL,
  `eb` text NOT NULL,
  `ec` text NOT NULL,
  `ed` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions2`
--



-- --------------------------------------------------------

--
-- Table structure for table `question_premium`
--

CREATE TABLE `question_premium` (
  `Testid` text NOT NULL,
  `Pwd` text NOT NULL,
  `TIME` text NOT NULL,
  `a` text NOT NULL,
  `aa` text NOT NULL,
  `ab` text NOT NULL,
  `ac` text NOT NULL,
  `ad` text NOT NULL,
  `b` text NOT NULL,
  `ba` text NOT NULL,
  `bb` text NOT NULL,
  `bc` text NOT NULL,
  `bd` text NOT NULL,
  `c` text NOT NULL,
  `ca` text NOT NULL,
  `cb` text NOT NULL,
  `cc` text NOT NULL,
  `cd` text NOT NULL,
  `d` text NOT NULL,
  `da` text NOT NULL,
  `db` text NOT NULL,
  `dc` text NOT NULL,
  `dd` text NOT NULL,
  `e` text NOT NULL,
  `ea` text NOT NULL,
  `eb` text NOT NULL,
  `ec` text NOT NULL,
  `ed` text NOT NULL,
  `f` text NOT NULL,
  `fa` text NOT NULL,
  `fb` text NOT NULL,
  `fc` text NOT NULL,
  `fd` text NOT NULL,
  `g` text NOT NULL,
  `ga` text NOT NULL,
  `gb` text NOT NULL,
  `gc` text NOT NULL,
  `gd` text NOT NULL,
  `h` text NOT NULL,
  `ha` text NOT NULL,
  `hb` text NOT NULL,
  `hc` text NOT NULL,
  `hd` text NOT NULL,
  `i` text NOT NULL,
  `ia` text NOT NULL,
  `ib` text NOT NULL,
  `ic` text NOT NULL,
  `id` text NOT NULL,
  `j` text NOT NULL,
  `ja` text NOT NULL,
  `jb` text NOT NULL,
  `jc` text NOT NULL,
  `jd` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `SESSION` text NOT NULL,
  `USERNAME` text NOT NULL,
  `IDENTITY` text NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `attribute` text NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
