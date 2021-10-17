-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2021 at 09:13 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanly_banhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `loai_mat_hang`
--

CREATE TABLE `loai_mat_hang` (
  `ma_loai` varchar(5) NOT NULL,
  `ten_loai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loai_mat_hang`
--

INSERT INTO `loai_mat_hang` (`ma_loai`, `ten_loai`) VALUES
('L001', 'Dầu gội đầu'),
('L002', 'Sữa tắm'),
('L003', 'Kem đánh răng');

-- --------------------------------------------------------

--
-- Table structure for table `mat_hang`
--

CREATE TABLE `mat_hang` (
  `ma_mat_hang` varchar(5) NOT NULL,
  `ten_mat_hang` varchar(50) NOT NULL,
  `so_luong` int(3) NOT NULL,
  `ma_loai` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mat_hang`
--

INSERT INTO `mat_hang` (`ma_mat_hang`, `ten_mat_hang`, `so_luong`, `ma_loai`) VALUES
('001', 'Sữa tắm Lifeboy', 10, 'L002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loai_mat_hang`
--
ALTER TABLE `loai_mat_hang`
  ADD PRIMARY KEY (`ma_loai`);

--
-- Indexes for table `mat_hang`
--
ALTER TABLE `mat_hang`
  ADD PRIMARY KEY (`ma_mat_hang`),
  ADD KEY `ma_loai` (`ma_loai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
