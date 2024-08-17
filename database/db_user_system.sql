-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 11:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_user_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `feedback` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `uid`, `subject`, `feedback`, `created_at`, `replied`) VALUES
(1, 11, 'Nothing', 'No problem to here from you guy!', '2023-02-26 13:54:51', 0),
(2, 10, 'Data Science', 'Data science is a &quot;concept to unify statistics, data analysis, informatics, and their related methods &quot; in order to &quot;understand and analyse actual phenomena &quot; with data. [5] It uses techniques and theories drawn from many fields within the context of mathematics, statistics, computer science, information science, and domain knowledge', '2023-02-26 15:31:06', 1),
(3, 9, 'broadcast', 'too be continue', '2023-03-06 14:24:19', 1),
(4, 10, 'Hello', 'I miss you admin!', '2023-03-07 07:56:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `note` mediumtext NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `uid`, `title`, `note`, `create_at`, `update_at`) VALUES
(6, 10, 'Computer', 'A computer is a machine that can be programmed to carry out sequences of arithmetic or logical operations automatically. Modern digital electronic computers can perform generic sets of operations known as programs. These programs enable computers to perform a wide range of tasks.', '2023-02-21 05:04:22', '2023-02-21 05:04:22'),
(9, 10, 'AJAX', 'AJAX is an acronym for Asynchronous JavaScript and XML. It is a group of inter-related technologies like JavaScript, DOM, XML, HTML/XHTML, CSS, SASS, BOOSTRAP, ...', '2023-02-23 15:55:14', '2023-02-23 15:58:32'),
(11, 11, 'Subplier', 'Definition and examples. A supplier is a person, organization, or other entity that provides something that another person, organization, or entity needs. During transactions, there are suppliers and buyers. Suppliers provide or supply products or services, while buyers receive them. We commonly use the term &#039; vendor &#039; with the same meaning ...', '2023-02-26 13:57:11', '2023-02-26 13:57:11'),
(13, 11, 'Bokator', 'Bokator is an ancient battlefield martial art used by ancient Khmer military groups. It is one of the oldest existing fighting systems originating from Cambodia. Oral tradition indicates that bokator was the close quarter combat system used by the ancient Cambodian armies before the founding of Angkor. A common misconception is that bokator refers to all Khmer/Cambodian martial arts, while in reality it only represents one particular style.', '2023-02-26 15:14:34', '2023-02-26 15:14:34'),
(14, 10, 'Func Delegate', 'is a general-purpose high-level programming language supporting multiple paradigms.', '2023-03-01 15:45:04', '2023-03-05 15:50:55'),
(15, 10, 'Protected access modifier', 'The Protected access modifier allows a subclass to access member variables and member functions of its base class. This helps achieve inheritance. We will discuss this in detail in the chapter on inheritance. Discuss this in more detail.', '2023-03-05 16:18:19', '2023-03-05 16:18:19'),
(16, 10, 'Blood', 'blood: [noun] the fluid that circulates in the heart, arteries, capillaries, and veins of a vertebrate animal carrying nourishment and oxygen to and bringing away waste products from all parts of the body. a comparable fluid of an invertebrate. a fluid resembling blood.', '2023-03-05 16:38:37', '2023-03-05 16:38:37'),
(17, 9, 'International Women&#039;s Day', 'International Women&#039;s Day (March 8) is a global day celebrating the social, economic, cultural, and political achievements of women. The day also marks a call to action for accelerating women&#039;s equality. IWD has occurred for well over a century, with the first IWD gathering in 1911 supported by over a million people.', '2023-03-07 14:19:43', '2023-03-07 14:21:37'),
(18, 9, 'PHP', 'PHP is a general-purpose scripting language geared toward web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1993 and released in 1995. The PHP reference implementation is now produced by The PHP Group. PHP was originally an abbreviation of Personal Home Page, but it now stands for the recursive initialism PHP', '2023-03-07 14:26:17', '2023-03-07 14:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `uid`, `type`, `message`, `created_at`) VALUES
(23, 10, 'user', 'You&#039;re welcome!', '2023-03-06 17:54:56'),
(29, 10, 'user', 'Hello', '2023-03-07 07:57:17'),
(32, 10, 'user', 'It&#039;s got the flame.', '2023-03-07 08:20:49'),
(33, 10, 'user', 'It&#039;s got the flame.', '2023-03-07 08:20:49'),
(34, 9, 'user', 'Please verify your email.', '2023-03-07 08:24:45'),
(37, 9, 'admin', 'Note added', '2023-03-07 14:19:43'),
(38, 9, 'admin', 'Note updated', '2023-03-07 14:21:37'),
(39, 9, 'admin', 'Profile updated', '2023-03-07 14:22:23'),
(41, 9, 'admin', 'Note added', '2023-03-07 14:26:17'),
(42, 9, 'admin', 'Note deleted', '2023-03-07 14:29:32'),
(43, 12, 'admin', 'Profile updated', '2023-03-07 15:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_exspire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `gender`, `dob`, `photo`, `token`, `token_exspire`, `created_at`, `verified`, `deleted`) VALUES
(9, 'User', 'User@gmail.com', '$2y$10$fnTgsacWf8u/QKuP3lix..bKS1CBWkJ6zftMckdXOvXox66tI0A8S', '0999333', 'Female', '2023-03-07', 'uploaded/img-5.jpg', '', '2023-05-25 10:02:17', '2023-02-16 05:03:25', 1, 1),
(10, 'Ron Ratanak', 'ron.ratanakPTM@gmail.com', '$2y$10$rKYlNOrEptcfsLYLZ3jBFequN6qtexOltp8OvUHTz3Il/9JfBaolm', '12345678', 'Male', '2001-03-05', 'uploaded/pic-2.png', '76c61b983dee4', '2023-03-06 16:58:47', '2023-02-16 05:14:10', 1, 1),
(11, 'Eourn Seyha', 'SeyhaCoding$123@gmail.com', '$2y$10$VSeF.XgyrR6pzE4ISKotBe8yYweYwpPr.5hzWo9zI6QGM4w2PBNSm', '', '', '', 'uploaded/pic-6.png', '', '2023-03-07 09:12:05', '2023-02-24 15:42:32', 1, 0),
(12, 'Coding', 'CodingTester@gmail.com', '$2y$10$WrKn2Cvy4l/BMijGAemlyOF5Bi4mYWwjElp3zKZr5O6rUu8CCnz/e', '086472804', 'Female', '2005-05-05', 'uploaded/img6.png', '', '2023-03-07 15:37:38', '2023-03-07 15:30:09', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `hits`) VALUES
(0, 77);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
