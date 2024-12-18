-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 04:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin127@gmail.com', 'deep');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` int(155) NOT NULL,
  `user_id` int(155) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `course_id` int(155) NOT NULL,
  `course_name` varchar(155) NOT NULL,
  `create_time` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `username`, `mail`, `message`) VALUES
(5, 'Deep Roy', 'royd5333@gmail.com', 'hello'),
(6, 'Arijit Manna', '10arijitmanna@gmail.com', 'I can not answer any questions it is really tough'),
(7, 'Dilip Roy', 'diliproy37426@gmail.com', 'Hello! If you\'re reading this, you\'re awesome. Let\'s chat soon and make the day even better!'),
(8, 'Archana Debnath', 'archana@gmail.com', 'nothing');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_desc` text NOT NULL,
  `c_category` varchar(100) NOT NULL,
  `instructor_name` varchar(60) NOT NULL,
  `image_url` varchar(60) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `c_name`, `c_desc`, `c_category`, `instructor_name`, `image_url`, `timestamp`) VALUES
(59, 'C', 'C is a general-purpose computer programming language. It was created in the 1970s by Dennis Ritchie, and remains very widely used and influential. By design, C&#039;s features cleanly reflect the capabilities of the targeted CPUs. ', 'Programming', 'TeTechno India Hooghly', '653ed1482c183.jpg', '2023-10-30 03:10:24'),
(60, 'Javscript', 'JavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. As of 2023, 98.7% of websites use JavaScript on the client side for webpage behavior, often incorporating third-party libraries.', 'Programming', 'Techno India Hooghly', '653ed2e04d36b.jpg', '2023-10-30 03:17:12'),
(61, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically typed and garbage-collected. It supports multiple programming paradigms, including structured, object-oriented and functional programming. ', 'Programming', 'Techno India Hooghly', '653fcfae9e5ef.jpg', '2023-10-30 21:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `f_id` int(255) NOT NULL,
  `f_content` varchar(155) NOT NULL,
  `user_id` int(255) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`f_id`, `f_content`, `user_id`, `time`) VALUES
(22, 'I can not change my name please help ', 31, '2023-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(255) NOT NULL,
  `lesson_name` text NOT NULL,
  `lesson_desc` text NOT NULL,
  `lesson_link` text NOT NULL,
  `course_id` int(255) NOT NULL,
  `course_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `lesson_name`, `lesson_desc`, `lesson_link`, `course_id`, `course_name`) VALUES
(53, 'Javascript for beginners', 'Lesson one', 'lessonvid/javascript1.mp4', 60, 'Javscript'),
(54, 'Setting up environment in local machine for Javascript', 'Lesson two', 'lessonvid/javascript2.mp4', 60, 'Javscript'),
(55, 'Why Learn C Programming Language? : C Tutorial In Hindi #1', 'Lesson One', 'lessonvid/c1.mp4', 59, 'C'),
(56, 'What Is Coding &amp; C Programming Language? : C Tutorial In Hindi #2', 'Lesson Two', 'lessonvid/c2.mp4', 59, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `razorpay_payment_id` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `course_id` int(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(120) NOT NULL,
  `course_id` int(11) NOT NULL,
  `question` varchar(155) NOT NULL,
  `first_ans` varchar(155) NOT NULL,
  `second_ans` varchar(155) NOT NULL,
  `third_ans` varchar(155) NOT NULL,
  `fourth_ans` varchar(155) NOT NULL,
  `orginal_ans` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `course_id`, `question`, `first_ans`, `second_ans`, `third_ans`, `fourth_ans`, `orginal_ans`) VALUES
(20, 60, 'What is JavaScript?', 'JavaScript is a scripting language used to make the website interactive', 'JavaScript is an assembly language used to make the website interactive', 'JavaScript is a compiled language used to make the website interactive', ' None of the mentioned', 'JavaScript is a scripting language used to make the website interactive'),
(21, 60, 'Which of the following is correct about JavaScript?', ' JavaScript is an Object-Based language', 'JavaScript is Assembly-language', 'JavaScript is an Object-Oriented language', ' JavaScript is a High-level language', 'JavaScript is an Object-Based language'),
(22, 60, 'Among the given statements, which statement defines closures in JavaScript?', ' JavaScript is a function that is enclosed with references to its inner function scope', 'JavaScript is a function that is enclosed with references to its lexical environment', 'JavaScript is a function that is enclosed with the object to its inner function scope', 'None of the mentioned', 'JavaScript is a function that is enclosed with references to its lexical environment'),
(23, 60, 'Arrays in JavaScript are defined by which of the following statements?', 'It is an ordered list of values', 'It is an ordered list of objects', 'It is an ordered list of string', 'It is an ordered list of functions', 'It is an ordered list of values'),
(24, 60, ' Which of the following is not javascript data types?', 'Null type', 'Undefined type', 'Number type', 'All of the mentioned', 'All of the mentioned'),
(25, 59, 'Who is the father of C language?', 'Steve Jobs', ' James Gosling', 'Dennis Ritchie', 'Rasmus Lerdorf', 'Dennis Ritchie'),
(26, 59, 'Which of the following is not a valid C variable name?', 'int number;', 'float rate;', 'int variable_count;', ' int $main;', ' int $main;'),
(27, 59, 'All keywords in C are in ____________', 'LowerCase letters', ' UpperCase letters', 'CamelCase letters', ' None of the mentioned', 'LowerCase letters'),
(28, 59, 'Which of the following is true for variable names in C?', 'They can contain alphanumeric characters as well as special characters', 'It is not an error to declare a variable to be one of the keywords(like goto, static)', 'Variable names cannot start with a digit', 'Variable can be of any length', 'Variable names cannot start with a digit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(155) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_ph` varchar(10) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_occupation` varchar(255) NOT NULL,
  `img_url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_ph`, `user_password`, `user_occupation`, `img_url`) VALUES
(31, 'Dilip Roy', 'diliproy37426@gmail.com', '9903893066', '$2y$10$mCtw02vT1IS6L8YhPhMZ7eoX3E0Bj2bvp70nFKRP3ZoMBQGgzIP1C', 'Businessman', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `fk_feedbacks_user_id` (`user_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(155) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `f_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(120) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `certificate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_certificate_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `fk_feedbacks_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
