SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `attractiepagina`
--
DROP DATABASE IF EXISTS `banking`;
CREATE DATABASE IF NOT EXISTS `banking` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `banking`;

--
-- Tabel: `rides`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;



--
-- Tabel: `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userbalance`INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`username`, `password`, `userbalance`) VALUES ('user1', '$2y$10$E1RRrlkzSBf9gUJrJZgYl.sXnqLBcWbEm.bBX30TcKS.NCEYaoo7q', 90000);
INSERT INTO `users` (`username`, `password`, `userbalance`) VALUES ('user2', '$2y$10$5c9ztGrjrt/iFtTWfyq1p.KVxzEQd/C8YKkesSMy3NVbmHnaRRrrO', 600);
INSERT INTO `users` (`username`, `password`, `userbalance`) VALUES ('user3', '$2y$10$2H8uaI4z/sGH.fIlAsCxquUVLB4f9nLhad..NnfjDE4eemi3ufMUO', 20000000);
