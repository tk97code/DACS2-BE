-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 07:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: tracnghiemonline
--

-- --------------------------------------------------------

--
-- Table structure for table question
--

CREATE TABLE question (
  question_id int(11) NOT NULL,
  content varchar(500) NOT NULL,
  difficulty int(11) NOT NULL,
  subject_id int(11) NOT NULL,
  chapter_id int(11) NOT NULL,
  creator int DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table question
--

-- --------------------------------------------------------

--
-- Table structure for table answer
--

CREATE TABLE answer (
  answer_id int(11) NOT NULL,
  question_id int(11) NOT NULL,
  answer_content varchar(500) NOT NULL,
  is_answer tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table answer
--


-- --------------------------------------------------------

--
-- Table structure for table test_detail
--

CREATE TABLE test_detail (
  test_id int(11) NOT NULL,
  question_id int(11) NOT NULL,
  `index` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table test_detail
--


CREATE TABLE `result_detail` (
  `result_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choosed_answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table group_detail
--

CREATE TABLE group_detail (
  group_id int(11) NOT NULL,
  user_id int NOT NULL DEFAULT 0,
  `show` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table group_detail
--


--
-- Triggers group_detail
--
DELIMITER $$
CREATE TRIGGER update_group_participants_after_delete AFTER DELETE ON group_detail FOR EACH ROW UPDATE `group`
SET number_student = 
(SELECT count(*) FROM group_detail where group_id = OLD.group_id)
WHERE group_id = OLD.group_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER update_group_participants_after_insert AFTER INSERT ON group_detail FOR EACH ROW UPDATE `group`
SET number_student = 
(SELECT count(*) FROM group_detail where group_id = NEW.group_id)
WHERE group_id = NEW.group_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table permission_detail
--

CREATE TABLE permission_detail (
  permission_id int(11) NOT NULL,
  `function` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table permission_detail
--


-- --------------------------------------------------------

--
-- Table structure for table notication_detail
--

CREATE TABLE notication_detail (
  noti_id int(11) NOT NULL,
  group_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table notication_detail
--
-- --------------------------------------------------------

--
-- Table structure for table chapter
--

CREATE TABLE chapter (
  chapter_id int(11) NOT NULL,
  chapter_name varchar(255) NOT NULL,
  subject_id int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table chapter
--

-- --------------------------------------------------------

--
-- Table structure for table `list_function`
--

CREATE TABLE `list_function` (
  `function` varchar(50) NOT NULL,
  `function_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_function`
--

-- --------------------------------------------------------

--
-- Table structure for table test
--

CREATE TABLE test (
  test_id int(11) NOT NULL,
  subject_exam int(11) DEFAULT NULL,
  creator int DEFAULT NULL,
  test_name varchar(255) DEFAULT NULL,
  create_time datetime DEFAULT current_timestamp(),
  exam_time int(11) DEFAULT NULL,
  start_time datetime DEFAULT NULL,
  end_time datetime DEFAULT NULL,
  show_exam tinyint(1) DEFAULT NULL,
  show_mark tinyint(1) DEFAULT NULL,
  show_answer tinyint(1) DEFAULT NULL,
  mix_question tinyint(1) DEFAULT NULL,
  mix_answer tinyint(1) DEFAULT NULL,
  submit_change_tab tinyint(1) DEFAULT NULL,
  test_type int(11) DEFAULT NULL,
  easy_quantity int(11) DEFAULT NULL,
  medium_quantity int(11) DEFAULT NULL,
  hard_quantity int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table test
--

-- --------------------------------------------------------

--
-- Table structure for table auto_test
--

CREATE TABLE auto_test (
  test_id int(11) NOT NULL,
  chapter_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table auto_test
--

-- --------------------------------------------------------

--
-- Table structure for table test_delivery
--

CREATE TABLE test_delivery (
  test_id int(11) NOT NULL,
  group_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table test_delivery
--


-- --------------------------------------------------------

--
-- Table structure for table result
--

CREATE TABLE result (
  result_id int(11) NOT NULL,
  test_id int(11) NOT NULL,
  user_id int NOT NULL DEFAULT 0,
  mark double DEFAULT NULL,
  enter_exam_time datetime DEFAULT current_timestamp(),
  do_test_time int(11) DEFAULT NULL,
  correct_quantity int(11) DEFAULT NULL,
  change_tab_time int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table result
--

-- --------------------------------------------------------

--
-- Table structure for table subject
--

CREATE TABLE subject (
  subject_id int(11) NOT NULL,
  subject_name varchar(255) NOT NULL,
  creadit int(11) DEFAULT NULL,
  theory_quantity int(11) DEFAULT NULL,
  practice_quantity int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table subject
--



-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  email varchar(255) NOT NULL,
  id int NOT NULL AUTO_INCREMENT,
  googleid varchar(150) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  gender tinyint(1) DEFAULT NULL,
  dob date DEFAULT '1990-01-01',
  avatar varchar(255) DEFAULT NULL,
  join_date date NOT NULL DEFAULT current_timestamp(),
  `password` varchar(60) DEFAULT NULL,
  `status` int(11) NOT NULL,
  phone_number int(11) DEFAULT NULL,
  token varchar(255) DEFAULT NULL,
  otp varchar(10) DEFAULT NULL,
  permission_id int(11) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table users
--


--
-- Triggers users
--
DELIMITER $$
CREATE TRIGGER delete_group_detail_by_id BEFORE DELETE ON users FOR EACH ROW DELETE FROM group_detail WHERE group_detail.user_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table group
--

CREATE TABLE `group` (
  group_id int(11) NOT NULL,
  `group` varchar(255) NOT NULL,
  invite_code varchar(50) DEFAULT NULL,
  number_student int(11) DEFAULT 0,
  note varchar(255) DEFAULT NULL,
  school_year int(11) DEFAULT NULL,
  term int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `show` tinyint(1) DEFAULT 1,
  lecture varchar(50) NOT NULL DEFAULT '',
  subject_id int(11) NOT NULL,
  PRIMARY KEY (group_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table group
--

-- --------------------------------------------------------

--
-- Table structure for table permission
--

CREATE TABLE permission (
  permission_id int(11) NOT NULL,
  permission_name varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table permission
--

-- --------------------------------------------------------

--
-- Table structure for table assginments
--

CREATE TABLE assginments (
  subject_id int(11) NOT NULL,
  user_id int NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table assginments
--


-- --------------------------------------------------------

--
-- Table structure for table notification
--

CREATE TABLE notification (
  noti_id int(11) NOT NULL,
  content varchar(255) DEFAULT NULL,
  create_time datetime DEFAULT NULL,
  creator int NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table notification
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table question
--
ALTER TABLE question
  ADD PRIMARY KEY (question_id),
  ADD KEY FK_question_users (creator),
  ADD KEY FK_question_chapter (chapter_id),
  ADD KEY FK_question_subject (subject_id);

--
-- Indexes for table answer
--
ALTER TABLE answer
  ADD PRIMARY KEY (answer_id),
  ADD KEY FK_answer_question (question_id);

--
-- Indexes for table test_detail
--
ALTER TABLE test_detail
  ADD PRIMARY KEY (test_id,question_id),
  ADD KEY FK_test_detail_question (question_id);

--
-- Indexes for table result_detail
--
ALTER TABLE result_detail
  ADD PRIMARY KEY (result_id,question_id),
  ADD KEY FK_result_detail_question (question_id),
  ADD KEY FK_result_detail_answer (choosed_answer);

--
-- Indexes for table group_detail
--
ALTER TABLE group_detail
  ADD PRIMARY KEY (group_id,user_id),
  ADD KEY FK_group_detail_users (user_id);

--
-- Indexes for table permission_detail
--
ALTER TABLE permission_detail
  ADD PRIMARY KEY (permission_id,`function`,`action`) USING BTREE,
  ADD KEY `action` (`function`) USING BTREE;

--
-- Indexes for table notication_detail
--
ALTER TABLE notication_detail
  ADD PRIMARY KEY (noti_id,group_id),
  ADD KEY `group` (group_id);

--
-- Indexes for table chapter
--
ALTER TABLE chapter
  ADD PRIMARY KEY (chapter_id),
  ADD KEY FK_chapter_subject (subject_id);

--
-- Indexes for table `list_function`
--
ALTER TABLE `list_function`
  ADD PRIMARY KEY (`function`) USING BTREE;

--
-- Indexes for table test
--
ALTER TABLE test
  ADD PRIMARY KEY (test_id);

--
-- Indexes for table auto_test
--
ALTER TABLE auto_test
  ADD PRIMARY KEY (test_id,chapter_id),
  ADD KEY auto_test_chapter (chapter_id);

--
-- Indexes for table test_delivery
--
ALTER TABLE test_delivery
  ADD PRIMARY KEY (test_id,group_id),
  ADD KEY `group` (group_id);

--
-- Indexes for table result
--
ALTER TABLE result
  ADD PRIMARY KEY (test_id,user_id),
  ADD UNIQUE KEY stt (result_id) USING BTREE,
  ADD KEY FK_result_users (user_id);

--
-- Indexes for table subject
--
ALTER TABLE subject
  ADD PRIMARY KEY (subject_id);

--
-- Indexes for table users
--
ALTER TABLE users
  -- ADD PRIMARY KEY (id),
  ADD KEY permission (permission_id);

--
-- Indexes for table group
--
ALTER TABLE `group`
  -- ADD PRIMARY KEY (group_id),
  ADD KEY group_users (lecture),
  ADD KEY group_subject (subject_id);

--
-- Indexes for table permission
--
ALTER TABLE permission
  ADD PRIMARY KEY (permission_id);

--
-- Indexes for table assginments
--
ALTER TABLE assginments
  ADD PRIMARY KEY (subject_id,user_id),
  ADD KEY FK_giangday_users (user_id);

--
-- Indexes for table notification
--
ALTER TABLE notification
  ADD PRIMARY KEY (noti_id),
  ADD KEY notification_users (creator);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table question
--
ALTER TABLE question
  MODIFY question_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=538;

--
-- AUTO_INCREMENT for table answer
--
ALTER TABLE answer
  MODIFY answer_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147;

--
-- AUTO_INCREMENT for table chapter
--
ALTER TABLE chapter
  MODIFY chapter_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table test
--
ALTER TABLE test
  MODIFY test_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table result
--
ALTER TABLE result
  MODIFY result_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table subject
--
ALTER TABLE subject
  MODIFY subject_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=841465;

--
-- AUTO_INCREMENT for table group
--
ALTER TABLE `group`
  MODIFY group_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table permission
--
ALTER TABLE permission
  MODIFY permission_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table notification
--
ALTER TABLE notification
  MODIFY noti_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table question
--
ALTER TABLE question
  ADD CONSTRAINT FK_question_chapter FOREIGN KEY (chapter_id) REFERENCES chapter (chapter_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_question_subject FOREIGN KEY (subject_id) REFERENCES subject (subject_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table answer
--
ALTER TABLE answer
  ADD CONSTRAINT FK_answer_question FOREIGN KEY (question_id) REFERENCES question (question_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table test_detail
--
ALTER TABLE test_detail
  ADD CONSTRAINT FK_test_detail_question FOREIGN KEY (question_id) REFERENCES question (question_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_test_detail_test FOREIGN KEY (test_id) REFERENCES test (test_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table result_detail
--
ALTER TABLE result_detail
  ADD CONSTRAINT FK_result_detail_question FOREIGN KEY (question_id) REFERENCES question (question_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_result_detail_answer FOREIGN KEY (choosed_answer) REFERENCES answer (answer_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_result_detail_result FOREIGN KEY (result_id) REFERENCES result (result_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table group_detail
--
ALTER TABLE group_detail
  ADD CONSTRAINT `FK_group_detail_group` FOREIGN KEY (group_id) REFERENCES `group` (group_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_group_detail_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table permission_detail
--
ALTER TABLE permission_detail
  ADD CONSTRAINT `FK_permission_detail_permission` FOREIGN KEY (permission_id) REFERENCES permission (permission_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT permission_detail_ibfk_1 FOREIGN KEY (`function`) REFERENCES `list_function` (`function`);

--
-- Constraints for table notication_detail
--
ALTER TABLE notication_detail
  ADD CONSTRAINT `FK_notification_detail_group` FOREIGN KEY (group_id) REFERENCES `group` (group_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_notification_detail_notification` FOREIGN KEY (noti_id) REFERENCES notification (noti_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table chapter
--
ALTER TABLE chapter
  ADD CONSTRAINT FK_chapter_subject FOREIGN KEY (subject_id) REFERENCES subject (subject_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table auto_test
--
ALTER TABLE auto_test
  ADD CONSTRAINT auto_test_chapter FOREIGN KEY (chapter_id) REFERENCES chapter (chapter_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT auto_test_test FOREIGN KEY (test_id) REFERENCES test (test_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table test_delivery
--
ALTER TABLE test_delivery
  ADD CONSTRAINT `FK_test_delivery_test` FOREIGN KEY (test_id) REFERENCES test (test_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_test_delivery_group` FOREIGN KEY (group_id) REFERENCES `group` (group_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table result
--
ALTER TABLE result
  ADD CONSTRAINT FK_result_test FOREIGN KEY (test_id) REFERENCES test (test_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_result_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table users
--
ALTER TABLE users
  ADD CONSTRAINT `FK_permission_detail_users` FOREIGN KEY (permission_id) REFERENCES permission (permission_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table group
--
ALTER TABLE `group`
  ADD CONSTRAINT `FK_group_subject` FOREIGN KEY (subject_id) REFERENCES subject (subject_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table assginments
--
ALTER TABLE assginments
  ADD CONSTRAINT FK_giangday_subject FOREIGN KEY (subject_id) REFERENCES subject (subject_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_assginments_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;