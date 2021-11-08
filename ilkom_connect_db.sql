-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2021 at 06:48 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ilkom_connect_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tahun_angkatan` int(4) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `kampus` varchar(50) NOT NULL,
  `nama_file_foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `nama`, `email`, `nim`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `no_telpon`, `alamat`, `tahun_angkatan`, `jurusan`, `kampus`, `nama_file_foto`) VALUES
(1, 'rifqirr', '$2y$10$1mW98bB7wqvCdGVkhqN1GuXjj9887sJkEa0hLPpnuSnANJVJmO8Jm', 'Muhammad Rifqi Ramadhan', 'mrifqiramadhan2002@gmail.com', '09021182025028', 'Palembang', '2002-11-23', 'Laki-Laki', '081373668830', 'Jl. Cemara no.24', 2020, 'Teknik Informatika', 'Indralaya', 'pfp/1.jpg'),
(2, 'agungelfatih', '$2y$10$H67sMLFuqt9htF2tr5b0kOitKZQHDckI6kzJa5eeKD5TDQPAysA5K', 'Muhammad Rizky Agung Elfatih', 'rizkyagung@gmail.com', '09021182025029', 'Palembang', '2000-12-12', 'Laki-Laki', '081373668830', 'Briarwood Drive 146', 2006, 'Teknik Informatika', 'Indralaya', 'pfp/2.png'),
(3, 'Checking_12', '$2y$10$a5MPv3Sr6rvttoqmW9401eRFhGPom/3GCeqzKN7CGxQDGirXyR7zi', 'Check', 'rifqi23@gmail.com', '', '', '0000-00-00', '', '', '', 0, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
