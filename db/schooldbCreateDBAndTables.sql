
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schooldb`
--
CREATE DATABASE IF NOT EXISTS `schooldb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `schooldb`;

-- --------------------------------------------------------

--
-- Структура на таблица `address`
--

CREATE TABLE `address` (
  `ID` int(11) NOT NULL,
  `countryID` int(11) NOT NULL,
  `cityID` int(11) NOT NULL,
  `streetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `address`
--

INSERT INTO `address` (`ID`, `countryID`, `cityID`, `streetID`) VALUES
(1, 1, 1, 4),
(2, 1, 1, 6),
(3, 1, 1, 6),
(4, 1, 1, 6),
(5, 1, 1, 6),
(6, 1, 1, 7),
(7, 1, 1, 7),
(8, 1, 1, 7),
(9, 1, 1, 6),
(10, 1, 1, 7),
(11, 1, 1, 8),
(12, 1, 1, 9),
(13, 1, 1, 9),
(14, 1, 1, 9),
(15, 1, 1, 8),
(16, 1, 1, 8),
(17, 1, 1, 9);

-- --------------------------------------------------------

--
-- Структура на таблица `cities`
--

CREATE TABLE `cities` (
  `ID` int(11) NOT NULL,
  `cityName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `cities`
--

INSERT INTO `cities` (`ID`, `cityName`) VALUES
(1, 'Пловдив'),
(2, 'Бургас');

-- --------------------------------------------------------

--
-- Структура на таблица `class`
--

CREATE TABLE `class` (
  `ID` int(11) NOT NULL,
  `studyPeriodID` int(11) NOT NULL,
  `formMasterID` int(11) DEFAULT NULL,
  `classManegerID` int(11) DEFAULT NULL,
  `classgroupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `class`
--

INSERT INTO `class` (`ID`, `studyPeriodID`, `formMasterID`, `classManegerID`, `classgroupID`) VALUES
(1, 1, 1, 1, 2),
(2, 1, 2, NULL, 1),
(3, 1, NULL, NULL, 4),
(4, 1, NULL, NULL, 12);

-- --------------------------------------------------------

--
-- Структура на таблица `classgroup`
--

CREATE TABLE `classgroup` (
  `ID` int(11) NOT NULL,
  `numberID` int(11) NOT NULL,
  `letterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `classgroup`
--

INSERT INTO `classgroup` (`ID`, `numberID`, `letterID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(12, 6, 4),
(13, 4, 5),
(14, 9, 6),
(15, 5, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `classletters`
--

CREATE TABLE `classletters` (
  `ID` int(11) NOT NULL,
  `classLetterType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `classletters`
--

INSERT INTO `classletters` (`ID`, `classLetterType`) VALUES
(1, 'а'),
(2, 'б'),
(3, 'в'),
(4, 'г'),
(5, 'д'),
(6, 'е'),
(7, 'ж'),
(8, 'з'),
(9, 'и');

-- --------------------------------------------------------

--
-- Структура на таблица `classmanagers`
--

CREATE TABLE `classmanagers` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `classmanagers`
--

INSERT INTO `classmanagers` (`ID`, `StudentID`, `ClassID`) VALUES
(1, 1, 1),
(2, 4, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `classnumbers`
--

CREATE TABLE `classnumbers` (
  `ID` int(11) NOT NULL,
  `classNumberType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `classnumbers`
--

INSERT INTO `classnumbers` (`ID`, `classNumberType`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV'),
(5, 'V'),
(6, 'VI'),
(7, 'VII'),
(8, 'VIII'),
(9, 'IX'),
(10, 'X'),
(12, 'XI'),
(13, 'XII');

-- --------------------------------------------------------

--
-- Структура на таблица `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `countryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `countries`
--

INSERT INTO `countries` (`ID`, `countryName`) VALUES
(1, 'България');

-- --------------------------------------------------------

--
-- Структура на таблица `evaluation`
--

CREATE TABLE `evaluation` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `exammark` int(11) NOT NULL,
  `examdate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `evaluation`
--

INSERT INTO `evaluation` (`ID`, `StudentID`, `TeacherID`, `SubjectID`, `exammark`, `examdate`) VALUES
(1, 1, 1, 1, 5, '2017-02-25 15:41:27'),
(2, 1, 1, 1, 9, '2017-02-25 15:41:35'),
(3, 1, 1, 2, 7, '2017-02-25 20:25:57'),
(4, 1, 1, 2, 8, '2017-02-25 20:26:02'),
(6, 1, 1, 2, 1, '2017-02-25 20:33:17'),
(7, 4, 2, 8, 10, '2017-03-01 00:41:23'),
(8, 3, 2, 8, 6, '2017-03-01 01:08:17'),
(9, 3, 2, 8, 9, '2017-03-01 01:07:49'),
(10, 3, 2, 8, 4, '2017-03-01 01:07:54'),
(11, 3, 2, 8, 8, '2017-03-01 01:08:00'),
(12, 1, 2, 9, 4, '2017-03-01 15:33:45'),
(13, 1, 2, 9, 9, '2017-03-01 15:33:50'),
(14, 1, 2, 9, 6, '2017-03-01 15:33:54'),
(15, 1, 2, 9, 10, '2017-03-01 15:34:08'),
(16, 1, 2, 8, 9, '2017-03-01 15:34:23'),
(17, 1, 2, 8, 10, '2017-03-01 15:34:27'),
(18, 1, 2, 8, 8, '2017-03-01 15:34:31'),
(19, 1, 2, 8, 8, '2017-03-01 15:34:49'),
(20, 4, 2, 9, 10, '2017-03-01 15:36:29'),
(21, 4, 2, 9, 9, '2017-03-01 15:36:34'),
(22, 4, 2, 9, 10, '2017-03-01 15:36:39'),
(23, 8, 2, 8, 10, '2017-03-13 18:10:44'),
(24, 8, 2, 8, 4, '2017-03-13 18:10:49');

-- --------------------------------------------------------

--
-- Структура на таблица `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `dateofcreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `events`
--

INSERT INTO `events` (`ID`, `Title`, `content`, `TeacherID`, `dateofcreate`) VALUES
(4, 'Родителска среща I-а клас.', '<p>                                Родителската среща на I-а кл. ще се проведе на 19.12 от 18:30 в зала 4404. \r\nБлагодаря</p>', 1, '2017-02-24 12:42:14');

-- --------------------------------------------------------

--
-- Структура на таблица `familyconnect`
--

CREATE TABLE `familyconnect` (
  `ID` int(11) NOT NULL,
  `connectType` varchar(50) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ParentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `familyconnect`
--

INSERT INTO `familyconnect` (`ID`, `connectType`, `StudentID`, `ParentID`) VALUES
(4, 'Майка', 7, 3),
(5, 'Баща', 7, 2),
(6, 'Баща', 1, 1),
(8, 'Баща', 4, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `formmaster`
--

CREATE TABLE `formmaster` (
  `ID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `formmaster`
--

INSERT INTO `formmaster` (`ID`, `ClassID`, `TeacherID`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `parents`
--

CREATE TABLE `parents` (
  `ID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `positionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `parents`
--

INSERT INTO `parents` (`ID`, `personID`, `positionID`) VALUES
(1, 4, 4),
(2, 11, 4),
(3, 12, 4);

-- --------------------------------------------------------

--
-- Структура на таблица `persons`
--

CREATE TABLE `persons` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Mname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `gender` enum('МЪЖ','ЖЕНА','ДРУГ') NOT NULL,
  `status` enum('Изчакване','Активиран','Забранен') NOT NULL,
  `PhoneN` varchar(50) NOT NULL,
  `AdressID` int(11) NOT NULL,
  `egn` varchar(20) NOT NULL,
  `schoolID` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `persons`
--

INSERT INTO `persons` (`ID`, `UserID`, `Fname`, `Mname`, `Lname`, `DOB`, `gender`, `status`, `PhoneN`, `AdressID`, `egn`, `schoolID`) VALUES
(1, 2, 'Георги', 'Стефанов', 'Георгиев', '2017-02-01', 'МЪЖ', 'Активиран', '0883463510', 4, '8911300000', 1),
(2, 5, 'Петър', 'Йорданов', 'Петров', '2017-02-08', 'МЪЖ', 'Активиран', '855', 5, '32423', 1),
(3, 6, 'Иван', 'Иванов', 'Петков', '2017-02-06', 'МЪЖ', 'Активиран', '0888808808', 6, '882828', 1),
(4, 7, 'Йордан', 'Петров', 'Петров', '1970-05-22', 'МЪЖ', 'Активиран', '088808801', 7, '7005225454', 1),
(5, 8, 'Драган', 'Цанков', 'Георгиев', '1990-08-16', 'МЪЖ', 'Активиран', '0888088001', 8, '9008164545', 1),
(6, 9, 'Бисер', 'Киров', 'Киров', '1990-06-13', 'МЪЖ', 'Активиран', '0888088003', 9, '9006134545', 1),
(7, 10, 'Божидар', 'Здравков', 'Здравков', '1991-02-09', 'МЪЖ', 'Активиран', '0888088004', 10, '9102094545', 1),
(8, 11, 'Гергана', 'Петрова', 'Григорова', '1990-02-10', 'ЖЕНА', 'Активиран', '0888088005', 11, '9002104545', 1),
(9, 25, 'Цанко', 'Иванов', 'Георгиев', '1970-06-18', 'МЪЖ', 'Активиран', '0888008001', 12, '7006184545', 1),
(10, 26, 'Албена', 'Семова', 'Халачева', '1991-10-14', 'ЖЕНА', 'Активиран', '0888088006', 13, '9110144545', 1),
(11, 27, 'Димитър', 'Петров', 'Гъделев', '1964-06-19', 'МЪЖ', 'Активиран', '0888008002', 14, '6406194545', 1),
(12, 28, 'Костадинка', 'Николова', 'Гъделевa', '1969-06-30', 'ЖЕНА', 'Активиран', '0888008003', 15, '6906304545', 1),
(13, 29, 'Красимира', 'Димитрова', 'Гъделева', '1991-04-20', 'ЖЕНА', 'Активиран', '0888088007', 16, '9104204545', 1),
(14, 30, 'Ивайла', 'Тодорова', 'Йорданова', '1990-07-18', 'ЖЕНА', 'Активиран', '0888088008', 17, '9007184545', 1);

-- --------------------------------------------------------

--
-- Структура на таблица `position`
--

CREATE TABLE `position` (
  `ID` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `position`
--

INSERT INTO `position` (`ID`, `type`) VALUES
(1, 'admin'),
(2, 'ученик'),
(3, 'учител'),
(4, 'родител');

-- --------------------------------------------------------

--
-- Структура на таблица `present`
--

CREATE TABLE `present` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `present` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `schools`
--

CREATE TABLE `schools` (
  `ID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `schools`
--

INSERT INTO `schools` (`ID`, `addressID`, `name`) VALUES
(1, 1, 'Основно Училище Петър Берон');

-- --------------------------------------------------------

--
-- Структура на таблица `streets`
--

CREATE TABLE `streets` (
  `ID` int(11) NOT NULL,
  `streetName` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `streets`
--

INSERT INTO `streets` (`ID`, `streetName`) VALUES
(1, 'Петър Берон 164'),
(2, 'Петър Берон 136'),
(3, 'Иван Рилски 6'),
(4, 'Стефан Стамболов 10'),
(5, 'Марица 35'),
(6, 'Спас Гинев 3'),
(7, 'Няма адрес'),
(8, '<P>Александър Стамболийски Бл. 45</p>'),
(9, '<P>Няма Адрес</p>');

-- --------------------------------------------------------

--
-- Структура на таблица `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL,
  `studentnumber` varchar(50) DEFAULT NULL,
  `classID` int(11) DEFAULT NULL,
  `positionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `students`
--

INSERT INTO `students` (`ID`, `PersonID`, `studentnumber`, `classID`, `positionID`) VALUES
(1, 2, '6', 1, 2),
(2, 8, '4', 1, 2),
(3, 6, '2', 2, 2),
(4, 5, '4', 2, 2),
(5, 7, '1', 2, 2),
(6, 10, '1', 3, 2),
(7, 13, '11', 3, 2),
(8, 14, '14', 4, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `studyperiod`
--

CREATE TABLE `studyperiod` (
  `ID` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `termYearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `studyperiod`
--

INSERT INTO `studyperiod` (`ID`, `termID`, `termYearID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 4, 1),
(4, 1, 2),
(5, 2, 3),
(6, 1, 4),
(7, 2, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `subjects`
--

CREATE TABLE `subjects` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ABB` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `subjects`
--

INSERT INTO `subjects` (`ID`, `Name`, `ABB`) VALUES
(1, 'Математика', 'МАТ'),
(2, 'Литература', 'ЛИТ'),
(5, 'Български Език', 'БЕЛ'),
(6, 'Роден Край', 'РКР'),
(7, 'Музика', 'МУЗ'),
(8, 'Информационни Технологии', 'ИНТ'),
(9, 'Домашен Бит И Техника', 'ДБТ');

-- --------------------------------------------------------

--
-- Структура на таблица `teach`
--

CREATE TABLE `teach` (
  `ID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `teach`
--

INSERT INTO `teach` (`ID`, `TeacherID`, `SubjectID`) VALUES
(5, 1, 1),
(7, 1, 2),
(8, 2, 8),
(9, 2, 9);

-- --------------------------------------------------------

--
-- Структура на таблица `teachers`
--

CREATE TABLE `teachers` (
  `ID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL,
  `positionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `teachers`
--

INSERT INTO `teachers` (`ID`, `PersonID`, `positionID`) VALUES
(1, 3, 3),
(2, 9, 3);

-- --------------------------------------------------------

--
-- Структура на таблица `teaching`
--

CREATE TABLE `teaching` (
  `ID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `teaching`
--

INSERT INTO `teaching` (`ID`, `TeacherID`, `ClassID`, `date`) VALUES
(1, 1, 1, '2017-02-24 14:23:54'),
(2, 2, 1, '2017-02-28 19:37:11'),
(3, 2, 2, '2017-02-28 19:37:15'),
(4, 2, 3, '2017-03-01 13:51:25'),
(6, 2, 4, '2017-03-13 18:10:17');

-- --------------------------------------------------------

--
-- Структура на таблица `terms`
--

CREATE TABLE `terms` (
  `ID` int(11) NOT NULL,
  `term` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `terms`
--

INSERT INTO `terms` (`ID`, `term`) VALUES
(1, 'първи'),
(2, 'втори'),
(3, 'трети'),
(4, 'n'),
(5, 'п'),
(6, 'е'),
(7, 'х');

-- --------------------------------------------------------

--
-- Структура на таблица `termyear`
--

CREATE TABLE `termyear` (
  `ID` int(11) NOT NULL,
  `termYear` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `termyear`
--

INSERT INTO `termyear` (`ID`, `termYear`) VALUES
(1, '2001'),
(2, '2002'),
(3, '2020'),
(4, '1998'),
(5, '2000'),
(6, '1988');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `positionID` int(11) DEFAULT NULL,
  `status` enum('изчакване','Активиран','Забранен') NOT NULL DEFAULT 'изчакване',
  `dateofcreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`ID`, `username`, `password_hash`, `email`, `positionID`, `status`, `dateofcreate`) VALUES
(2, 'admin', '$2y$10$996LUYlbAErS7DIJzq/SduO8nIIXcfvJMwW4fhSjKmopnsXaBjj.i', 'admin@school.bb', 1, 'Активиран', '2017-02-20 18:11:08'),
(5, 'students', '$2y$10$wx1zyvY84LTQZnw5.NKSku8P.7vrJUbArbQm49LARKFF8GpRzFBfq', 'students@school.bb', 2, 'Активиран', '2017-02-20 21:44:46'),
(6, 'ivan', '$2y$10$EVc6CQA/dMbB9/PFPDqop.iITEylMKVjofPb21IIKQiYZrKnOtl7K', 'ivan@exam.com', 3, 'Активиран', '2017-02-23 17:40:03'),
(7, 'parents', '$2y$10$fmQthfYBFii1zhdZvoZBAOJvvsqWaAcDXtE2iylKFrBzbz/oYw9s6', 'parents@exam.net', 4, 'Активиран', '2017-02-25 20:48:33'),
(8, 'student2', '$2y$10$xDtZiCGrXpOGlNbkyO9FTOS2I73HMOLDANFxs6/l2ycbbP22zce26', 'student2@school.db', 2, 'Активиран', '2017-02-26 15:09:42'),
(9, 'student3', '$2y$10$m17qa7rABocsb1fc4AmFo.ZiEhN7SVogxqKnU44cwdKXKtAQnA7u.', 'student3@school.db', 2, 'Активиран', '2017-02-26 15:47:06'),
(10, 'student4', '$2y$10$SZAzvJ8jny3XybwYo.kt0O.AocjU0DAg2vzjrI7n408wflMRfFQ9a', 'student4@school.db', 2, 'Активиран', '2017-02-26 15:52:47'),
(11, 'student5', '$2y$10$SPHU1U4Fak37HUbKkAz7oe2mE1u1MiPfFzJKh4375D9C5hwhgryDC', 'student5@school.db', 2, 'Активиран', '2017-02-28 13:12:05'),
(25, 'teachers', '$2y$10$IJkKTn2DPbYxTNdotJCaZuTsGg.KnVP2R05N26JVnmUvQ21ZjGEl6', 'teachers@school.db', 3, 'Активиран', '2017-02-28 18:33:10'),
(26, 'student6', '$2y$10$LwTU7yPFYiRmimkzkQbvsOTrP/Jb28qF3yZUCKpYCeYKFMG6/K1jq', 'student6@school.db', 2, 'Активиран', '2017-03-01 13:43:45'),
(27, 'parent1', '$2y$10$Ahun3wjlGLokUHeUA58uZOa0M.GL3uiTvrtubioG4r4cmj/do9Y2W', 'parent1@school.db', 4, 'Активиран', '2017-03-01 14:07:42'),
(28, 'parent2', '$2y$10$EYN7KQjiewjA52lC.Z.ErOceV0vvVnPBCOF6qYthPStZRl.DjCMHy', 'parent2@school.db', 4, 'Активиран', '2017-03-01 14:10:32'),
(29, 'student7', '$2y$10$VXyM1A8fTtvvuVGD5mj03Ogaar/tXUVZXckpw7lC6fxpL36iWuHxu', 'student7@school.db', 2, 'Активиран', '2017-03-01 14:18:25'),
(30, 'student8', '$2y$10$Rq82BiE8YIt2htt0GqxH9uWmzQjOtlUibgG2TRxKJUlqWOURLinJe', 'student8@school.db', 2, 'Активиран', '2017-03-13 15:41:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `countryID` (`countryID`),
  ADD KEY `cityID` (`cityID`),
  ADD KEY `streetID` (`streetID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `studyPeriodID` (`studyPeriodID`),
  ADD KEY `formMasterID` (`formMasterID`),
  ADD KEY `classManegerID` (`classManegerID`),
  ADD KEY `classgroupID` (`classgroupID`);

--
-- Indexes for table `classgroup`
--
ALTER TABLE `classgroup`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `numberID` (`numberID`),
  ADD KEY `letterID` (`letterID`);

--
-- Indexes for table `classletters`
--
ALTER TABLE `classletters`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `classmanagers`
--
ALTER TABLE `classmanagers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `ClassID` (`ClassID`);

--
-- Indexes for table `classnumbers`
--
ALTER TABLE `classnumbers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `SubjectID` (`SubjectID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TeacherID` (`TeacherID`);

--
-- Indexes for table `familyconnect`
--
ALTER TABLE `familyconnect`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `ParentID` (`ParentID`);

--
-- Indexes for table `formmaster`
--
ALTER TABLE `formmaster`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClassID` (`ClassID`),
  ADD KEY `TeacherID` (`TeacherID`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `personID` (`personID`),
  ADD KEY `positionID` (`positionID`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `AdressID` (`AdressID`),
  ADD KEY `schoolID` (`schoolID`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `present`
--
ALTER TABLE `present`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `ClassID` (`ClassID`),
  ADD KEY `SubjectID` (`SubjectID`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `addressID` (`addressID`);

--
-- Indexes for table `streets`
--
ALTER TABLE `streets`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PersonID` (`PersonID`),
  ADD KEY `classID` (`classID`),
  ADD KEY `positionID` (`positionID`);

--
-- Indexes for table `studyperiod`
--
ALTER TABLE `studyperiod`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `termID` (`termID`),
  ADD KEY `termYearID` (`termYearID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teach`
--
ALTER TABLE `teach`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `SubjectID` (`SubjectID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PersonID` (`PersonID`),
  ADD KEY `positionID` (`positionID`);

--
-- Indexes for table `teaching`
--
ALTER TABLE `teaching`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `ClassID` (`ClassID`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `termyear`
--
ALTER TABLE `termyear`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `positionID` (`positionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `classgroup`
--
ALTER TABLE `classgroup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `classletters`
--
ALTER TABLE `classletters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `classmanagers`
--
ALTER TABLE `classmanagers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `classnumbers`
--
ALTER TABLE `classnumbers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `familyconnect`
--
ALTER TABLE `familyconnect`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `formmaster`
--
ALTER TABLE `formmaster`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `present`
--
ALTER TABLE `present`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `streets`
--
ALTER TABLE `streets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `studyperiod`
--
ALTER TABLE `studyperiod`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `teach`
--
ALTER TABLE `teach`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teaching`
--
ALTER TABLE `teaching`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `termyear`
--
ALTER TABLE `termyear`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`countryID`) REFERENCES `countries` (`ID`),
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`cityID`) REFERENCES `cities` (`ID`),
  ADD CONSTRAINT `address_ibfk_3` FOREIGN KEY (`streetID`) REFERENCES `streets` (`ID`);

--
-- Ограничения за таблица `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`studyPeriodID`) REFERENCES `studyperiod` (`ID`),
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`classManegerID`) REFERENCES `classmanagers` (`ID`),
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`formMasterID`) REFERENCES `formmaster` (`ID`),
  ADD CONSTRAINT `class_ibfk_4` FOREIGN KEY (`classgroupID`) REFERENCES `classgroup` (`ID`);

--
-- Ограничения за таблица `classgroup`
--
ALTER TABLE `classgroup`
  ADD CONSTRAINT `classgroup_ibfk_1` FOREIGN KEY (`numberID`) REFERENCES `classnumbers` (`ID`),
  ADD CONSTRAINT `classgroup_ibfk_2` FOREIGN KEY (`letterID`) REFERENCES `classletters` (`ID`);

--
-- Ограничения за таблица `classmanagers`
--
ALTER TABLE `classmanagers`
  ADD CONSTRAINT `classmanagers_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`ID`),
  ADD CONSTRAINT `classmanagers_ibfk_2` FOREIGN KEY (`ClassID`) REFERENCES `class` (`ID`);

--
-- Ограничения за таблица `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`ID`),
  ADD CONSTRAINT `evaluation_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`ID`),
  ADD CONSTRAINT `evaluation_ibfk_3` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`ID`);

--
-- Ограничения за таблица `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`ID`);

--
-- Ограничения за таблица `familyconnect`
--
ALTER TABLE `familyconnect`
  ADD CONSTRAINT `familyconnect_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`ID`),
  ADD CONSTRAINT `familyconnect_ibfk_2` FOREIGN KEY (`ParentID`) REFERENCES `parents` (`ID`);

--
-- Ограничения за таблица `formmaster`
--
ALTER TABLE `formmaster`
  ADD CONSTRAINT `formmaster_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `class` (`ID`),
  ADD CONSTRAINT `formmaster_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`ID`);

--
-- Ограничения за таблица `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `persons` (`ID`),
  ADD CONSTRAINT `parents_ibfk_2` FOREIGN KEY (`positionID`) REFERENCES `position` (`ID`);

--
-- Ограничения за таблица `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`schoolID`) REFERENCES `schools` (`ID`),
  ADD CONSTRAINT `persons_ibfk_2` FOREIGN KEY (`AdressID`) REFERENCES `address` (`ID`),
  ADD CONSTRAINT `persons_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Ограничения за таблица `present`
--
ALTER TABLE `present`
  ADD CONSTRAINT `present_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`ID`),
  ADD CONSTRAINT `present_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`ID`),
  ADD CONSTRAINT `present_ibfk_3` FOREIGN KEY (`ClassID`) REFERENCES `class` (`ID`),
  ADD CONSTRAINT `present_ibfk_4` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`ID`);

--
-- Ограничения за таблица `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_ibfk_1` FOREIGN KEY (`addressID`) REFERENCES `address` (`ID`);

--
-- Ограничения за таблица `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `persons` (`ID`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`positionID`) REFERENCES `position` (`ID`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`classID`) REFERENCES `class` (`ID`);

--
-- Ограничения за таблица `studyperiod`
--
ALTER TABLE `studyperiod`
  ADD CONSTRAINT `studyperiod_ibfk_1` FOREIGN KEY (`termID`) REFERENCES `terms` (`ID`),
  ADD CONSTRAINT `studyperiod_ibfk_2` FOREIGN KEY (`termYearID`) REFERENCES `termyear` (`ID`);

--
-- Ограничения за таблица `teach`
--
ALTER TABLE `teach`
  ADD CONSTRAINT `teach_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`ID`),
  ADD CONSTRAINT `teach_ibfk_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`ID`);

--
-- Ограничения за таблица `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `persons` (`ID`),
  ADD CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`positionID`) REFERENCES `position` (`ID`);

--
-- Ограничения за таблица `teaching`
--
ALTER TABLE `teaching`
  ADD CONSTRAINT `teaching_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`ID`),
  ADD CONSTRAINT `teaching_ibfk_2` FOREIGN KEY (`ClassID`) REFERENCES `class` (`ID`);

--
-- Ограничения за таблица `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`positionID`) REFERENCES `position` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
