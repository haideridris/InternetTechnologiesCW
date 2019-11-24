-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2019 at 11:24 AM
-- Server version: 5.5.21
-- PHP Version: 5.6.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hraoof`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productno` int(2) NOT NULL AUTO_INCREMENT,
  `name_of_product` varchar(30) NOT NULL,
  `price_of_product` varchar(30) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`productno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productno`, `name_of_product`, `price_of_product`, `image`) VALUES
(1, 'Flat White', '2.40 ', './images/flatwhitesmall.jpg'),
(2, 'Cappuccino', '2.55 ', './images/cappucinotwo.jpg'),
(3, 'Americano', '2.20 ', './images/americano.jpg'),
(4, 'Expresso Macchiato', '1.80', './images/expressomacchiato.jpg'),
(5, 'Hot Chocolate', '2.90 ', './images/hot-chocolate.jpg'),
(6, 'Chai Latte', '2.70', './images/chailatte.jpg'),
(7, 'Mocha', '2.50', './images/mocha.jpg'),
(8, 'Kashmiri Tea', '3.00', './images/kashmiritea.jpg'),
(9, 'Caffe Latte', '2.65', './images/caffelatte.jpg'),
(10, 'Caramel Cappuccino', '2.65', './images/caramelcappuccino.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
