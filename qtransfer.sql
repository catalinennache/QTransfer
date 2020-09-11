-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2020 at 09:26 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qtransfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `asessions`
--

CREATE TABLE `asessions` (
  `id` int(11) NOT NULL,
  `asession_id` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `join_code` varchar(45) DEFAULT NULL,
  `creation_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asessions`
--

INSERT INTO `asessions` (`id`, `asession_id`, `password`, `join_code`, `creation_date`) VALUES
(5, '6uobrzf76p1e6yz65moyp9i61o8eopyywbb1si3f8d9m4u57niloi9al3rkx86o6kzr5u2ua6whzzk48mwbzx5p40ie32r06dmz3m1tlhc2r0lyzqnkq8cz48q79tzaj', 'cascade', NULL, '2020-07-05 18:48:46'),
(6, 'r41csredrwwnhhqxfymmnlgj47d0nmyx523dc263h901kwfiduh21k05hhitimdmibq43m4raybonyn17k73ti025dfgehdlgcjmupdtyhbo14r4fgm4uifi9xirmzlm', 'c', 'k3kp', '2020-07-20 20:56:42'),
(7, 'xctf0ghyqll2yxtc2a2mni8axqr3n87dt0j9k0q7grqdyff8756hzulmzy6zt7il8ffllzlr40y7z6hgbzflmyu9dir5soq9o8ph62ssa1xjpm05a6lfx92rg4ruc98t', 'top', NULL, '2020-07-26 18:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `asession_contents`
--

CREATE TABLE `asession_contents` (
  `id` int(11) NOT NULL,
  `asession_pk` int(11) DEFAULT NULL,
  `clipcontent` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `file_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asession_contents`
--

INSERT INTO `asession_contents` (`id`, `asession_pk`, `clipcontent`, `file_path`, `title`, `file_name`) VALUES
(11, 6, 'cascade', NULL, 'cascade', NULL),
(13, 7, 'asd', NULL, 'meq', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asessions`
--
ALTER TABLE `asessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asession_id_UNIQUE` (`asession_id`);

--
-- Indexes for table `asession_contents`
--
ALTER TABLE `asession_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asessions_idx` (`asession_pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asessions`
--
ALTER TABLE `asessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `asession_contents`
--
ALTER TABLE `asession_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asession_contents`
--
ALTER TABLE `asession_contents`
  ADD CONSTRAINT `fk_asessions` FOREIGN KEY (`asession_pk`) REFERENCES `asessions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
