-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 27, 2014 at 12:17 PM
-- Server version: 5.5.38
-- PHP Version: 5.3.10-1ubuntu3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `artiste`
--

CREATE TABLE IF NOT EXISTS `artiste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) NOT NULL,
  `path_pics` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `url` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `artiste`
--

INSERT INTO `artiste` (`id`, `date_creation`, `date_update`, `name`, `path_pics`, `text`, `url`) VALUES
(9, '2014-08-27 09:59:59', '0000-00-00 00:00:00', 'Aloe Black', '../portfolio/artistes/Aloe Black', '\r\nOfficial video for Aloe Blacc''s "I Need A Dollar" from the album Good Things (Stones Throw)\r\n\r\nDirector: Kahlil Joseph\r\nPhotography: Matthew J.Lloyd\r\nVideo Produced by WHat Matters Most and Funk Factory Films\r\n\r\nThis video also contains a short section with a new track called "So Hard" from the album Good Things', 'https://fr.wikipedia.org/wiki/Aloe_Blacc');

-- --------------------------------------------------------

--
-- Table structure for table `quartier`
--

CREATE TABLE IF NOT EXISTS `quartier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) NOT NULL,
  `path_pics` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `nb_videos` int(11) NOT NULL DEFAULT '0',
  `url` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quartier`
--

INSERT INTO `quartier` (`id`, `date_creation`, `date_update`, `name`, `path_pics`, `text`, `nb_videos`, `url`) VALUES
(4, '2014-08-27 09:58:17', '0000-00-00 00:00:00', 'Capitole', '../portfolio/quartiers/Capitole', '\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 'https://docs.angularjs.org/api/ng/function/angular.forEach');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ta_login` varchar(255) NOT NULL,
  `ta_password` text NOT NULL,
  `rights` int(11) NOT NULL,
  `nb_visits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(512) NOT NULL,
  `id_artiste` int(11) NOT NULL,
  `id_quartier` int(11) NOT NULL,
  `text` text NOT NULL,
  `weekly` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `date_creation`, `date_update`, `category`, `name`, `url`, `id_artiste`, `id_quartier`, `text`, `weekly`) VALUES
(21, '2014-08-27 09:59:59', '0000-00-00 00:00:00', 0, 'I Need A Dollar', 'https://www.youtube.com/watch?v=iR6oYX1D-0w', 9, 4, 'Aloe Blacc est un chanteur soul, rappeur et musicien amÃ©ricain. Son premier album solo, intitulÃ© Shine Through a Ã©tÃ© Ã©ditÃ© par Stones Throw Records en 2006, et son second album Good Things en 2010. Il a commencÃ© sa carriÃ¨re en 1995 dans le groupe Emanon, mais les mÃ©dias s''intÃ©ressent Ã  lui Ã  partir de la chanson I Need a Dollar.', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
