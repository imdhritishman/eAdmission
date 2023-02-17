-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2022 at 04:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eadmission`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_details`
--

CREATE TABLE `academic_details` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_previousinstitution` varchar(50) DEFAULT NULL,
  `s_yearofpassing` varchar(50) DEFAULT NULL,
  `s_boardname` varchar(50) DEFAULT NULL,
  `s_sub1` varchar(50) DEFAULT NULL,
  `s_theory1` int(11) DEFAULT NULL,
  `s_practical1` int(11) DEFAULT NULL,
  `s_total1` int(11) DEFAULT NULL,
  `s_sub2` varchar(50) DEFAULT NULL,
  `s_theory2` int(11) DEFAULT NULL,
  `s_practical2` int(11) DEFAULT NULL,
  `s_total2` int(11) DEFAULT NULL,
  `s_sub3` varchar(50) DEFAULT NULL,
  `s_theory3` int(11) DEFAULT NULL,
  `s_practical3` int(11) DEFAULT NULL,
  `s_total3` int(11) DEFAULT NULL,
  `s_sub4` varchar(50) DEFAULT NULL,
  `s_theory4` int(11) DEFAULT NULL,
  `s_practical4` int(11) DEFAULT NULL,
  `s_total4` int(11) DEFAULT NULL,
  `s_sub5` varchar(50) DEFAULT NULL,
  `s_theory5` int(11) DEFAULT NULL,
  `s_practical5` int(11) DEFAULT NULL,
  `s_total5` int(11) DEFAULT NULL,
  `s_sub6` varchar(50) DEFAULT NULL,
  `s_theory6` int(11) DEFAULT NULL,
  `s_practical6` int(11) DEFAULT NULL,
  `s_total6` int(11) DEFAULT NULL,
  `s_total` int(11) DEFAULT NULL,
  `s_percentage` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_details`
--

INSERT INTO `academic_details` (`s_id`, `s_name`, `s_previousinstitution`, `s_yearofpassing`, `s_boardname`, `s_sub1`, `s_theory1`, `s_practical1`, `s_total1`, `s_sub2`, `s_theory2`, `s_practical2`, `s_total2`, `s_sub3`, `s_theory3`, `s_practical3`, `s_total3`, `s_sub4`, `s_theory4`, `s_practical4`, `s_total4`, `s_sub5`, `s_theory5`, `s_practical5`, `s_total5`, `s_sub6`, `s_theory6`, `s_practical6`, `s_total6`, `s_total`, `s_percentage`) VALUES
(25, 'Dhritishman Kalita', 'Anundoram Borooah Academy', '2019', 'Assam Higher Secondary Education Council', 'English', 84, 0, 84, 'Alternative English', 82, 0, 82, 'Computer Science & Applications', 45, 29, 74, 'Mathematics', 72, 0, 72, 'Chemistry', 36, 30, 66, NULL, NULL, NULL, NULL, 378, 75.6);

-- --------------------------------------------------------

--
-- Table structure for table `additional_details`
--

CREATE TABLE `additional_details` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_extracarricularquota` varchar(50) DEFAULT NULL,
  `s_fieldofproficiency` varchar(50) DEFAULT NULL,
  `s_levelofproficiency` varchar(50) DEFAULT NULL,
  `s_differentlyabledquota` varchar(50) DEFAULT NULL,
  `s_nccquota` varchar(50) DEFAULT NULL,
  `s_resideinhostel` varchar(50) DEFAULT NULL,
  `s_bplcategory` varchar(50) DEFAULT NULL,
  `s_domiclestate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `additional_details`
--

INSERT INTO `additional_details` (`s_id`, `s_name`, `s_extracarricularquota`, `s_fieldofproficiency`, `s_levelofproficiency`, `s_differentlyabledquota`, `s_nccquota`, `s_resideinhostel`, `s_bplcategory`, `s_domiclestate`) VALUES
(25, 'Dhritishman Kalita', 'Yes', 'Art & Craft', 'National', 'No', 'Yes', NULL, 'No', 'Assam');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(11) NOT NULL,
  `adm_name` varchar(50) DEFAULT NULL,
  `adm_phone` varchar(15) DEFAULT NULL,
  `adm_email` varchar(50) DEFAULT NULL,
  `adm_username` varchar(15) DEFAULT NULL,
  `adm_password` varchar(100) DEFAULT NULL,
  `adm_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `adm_name`, `adm_phone`, `adm_email`, `adm_username`, `adm_password`, `adm_status`) VALUES
(1, 'Admin', '8638719449', 'admin@eadmission.com', 'admin', 'e6e061838856bf47e1de730719fb2609', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_bankname` varchar(50) DEFAULT NULL,
  `s_branchname` varchar(50) DEFAULT NULL,
  `s_beneficiaryname` varchar(50) DEFAULT NULL,
  `s_accountno` varchar(50) DEFAULT NULL,
  `s_confirmaccountno` varchar(50) DEFAULT NULL,
  `s_ifsccode` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`s_id`, `s_name`, `s_bankname`, `s_branchname`, `s_beneficiaryname`, `s_accountno`, `s_confirmaccountno`, `s_ifsccode`) VALUES
(25, 'Dhritishman Kalita', 'HDFC Bank Ltd', 'Pathsala', 'Dhritishman Kalita', '50100296990551', '50100296990551', 'HDFC0002824');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cour_id` int(11) NOT NULL,
  `cour_name` varchar(50) DEFAULT NULL,
  `cour_duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cour_id`, `cour_name`, `cour_duration`) VALUES
(1, 'Higher Secondary', 2),
(2, 'Under Graduate', 3),
(3, 'Post Graduate', 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_coresubject1` varchar(50) DEFAULT NULL,
  `s_coresubject2` varchar(50) DEFAULT NULL,
  `s_electivesubject1` varchar(50) DEFAULT NULL,
  `s_electivesubject2` varchar(50) DEFAULT NULL,
  `s_electivesubject3` varchar(50) DEFAULT NULL,
  `s_electivesubject4` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`s_id`, `s_name`, `s_coresubject1`, `s_coresubject2`, `s_electivesubject1`, `s_electivesubject2`, `s_electivesubject3`, `s_electivesubject4`) VALUES
(25, 'Dhritishman Kalita', 'English', 'Alternative English', 'Computer Science & Applications', 'Business Mathematics & Statistics', 'Accountancy', 'Business Studies');

-- --------------------------------------------------------

--
-- Table structure for table `family_details`
--

CREATE TABLE `family_details` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_fathersname` varchar(50) DEFAULT NULL,
  `s_fathersoccupation` varchar(50) DEFAULT NULL,
  `s_fathersphoneno` varchar(10) DEFAULT NULL,
  `s_mothersname` varchar(50) DEFAULT NULL,
  `s_mothersoccupation` varchar(50) DEFAULT NULL,
  `s_mothersphoneno` varchar(10) DEFAULT NULL,
  `s_gurdiansname` varchar(50) DEFAULT NULL,
  `s_gurdiansphoneno` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `family_details`
--

INSERT INTO `family_details` (`s_id`, `s_name`, `s_fathersname`, `s_fathersoccupation`, `s_fathersphoneno`, `s_mothersname`, `s_mothersoccupation`, `s_mothersphoneno`, `s_gurdiansname`, `s_gurdiansphoneno`) VALUES
(25, 'Dhritishman Kalita', 'Dwijendra Nath Kalita', 'Business', '9876543210', 'Himani Talukdar Kalita', 'Business', '9876543211', 'Dwijendra Nath Kalita', '9876543210');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `ins_id` int(11) NOT NULL,
  `ins_code` varchar(4) DEFAULT NULL,
  `ins_name` varchar(100) DEFAULT NULL,
  `ins_address` varchar(100) DEFAULT NULL,
  `ins_phone` varchar(15) DEFAULT NULL,
  `ins_email` varchar(50) DEFAULT NULL,
  `ins_password` varchar(50) DEFAULT NULL,
  `ins_website` varchar(30) DEFAULT NULL,
  `ins_regdate` date DEFAULT NULL,
  `ins_logo` varchar(100) DEFAULT NULL,
  `ins_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`ins_id`, `ins_code`, `ins_name`, `ins_address`, `ins_phone`, `ins_email`, `ins_password`, `ins_website`, `ins_regdate`, `ins_logo`, `ins_status`) VALUES
(19, 'ADTU', 'Assam Down Town University', 'Gandhi Nagar, Panikhaiti, Guwahati, Assam, 781026', '9864137777', 'admission@adtu.in', 'e6e061838856bf47e1de730719fb2609', 'www.adtu.in', '2022-07-15', 'assets/docs/institute-logo/LOGO1316800778.png', 1),
(20, 'ARBA', 'Anundoram Borooah Academy', 'Pathsala, Bajali, Assam, 781325', '9435123646', 'arb.academy@gmail.com', 'e6e061838856bf47e1de730719fb2609', 'www.arba.ac.in', '2022-07-15', 'assets/docs/institute-logo/LOGO649719591.png', 1),
(21, 'ADBU', 'Assam Don Bosco University', 'Azara, Guwahati, Assam, 781017', '9435545754', 'contact@dbuniversity.ac.in', 'e6e061838856bf47e1de730719fb2609', 'www.dbuniversity.ac.in', '2022-07-15', 'assets/docs/institute-logo/LOGO451438265.png', 1),
(22, 'ASTU', 'Assam Science and Technology University', 'Jalukbari, Guwahati, Assam, 781013', '8811079300', 'registrar@astu.ac.in', 'e6e061838856bf47e1de730719fb2609', 'www.astu.ac.in', '2022-07-15', 'assets/docs/institute-logo/LOGO257303706.png', 1),
(23, 'CTNU', 'Cotton University', 'Panbazar, Guwahati, Assam, 781001', '3612733530', 'registrar@cottonuniversity.ac.in', 'e6e061838856bf47e1de730719fb2609', 'www.cottonuniversity.ac.in', '2022-07-15', 'assets/docs/institute-logo/LOGO1599529533.png', 1),
(24, 'GAUU', 'Gauhati University', 'Jalukbari, Guwahati, Assam, 781014', '9401450207', 'registrar@gauhati.ac.in', 'e6e061838856bf47e1de730719fb2609', 'www.gauhati.ac.in', '2022-07-15', 'assets/docs/institute-logo/LOGO26526436.png', 1),
(26, 'NERM', 'Nerim Group of Institutions', 'Joyanagar, Khanapara, Guwahati, Assam, 781022', '9864750000', 'nerimindia@gmail.com', 'e6e061838856bf47e1de730719fb2609', 'www.nerimindia.org', '2022-07-15', 'assets/docs/institute-logo/LOGO2050571015.png', 1),
(29, 'KKHC', 'Krishna Kanta Handiqui Junior College', 'Pathsala, Bajali, Assam, 781325', '9678776095', 'kkhmk123@gmail.com', 'e6e061838856bf47e1de730719fb2609', 'www.kkhjc.in', '2022-07-15', 'assets/docs/institute-logo/LOGO1029086171.png', 1),
(31, 'ROGU', 'Royal Global University', 'Betkuchi, Guwahati, Assam, 781035', '7879998811', 'admissions@rgu.ac', 'e6e061838856bf47e1de730719fb2609', 'www.rgu.ac', '2022-07-15', 'assets/docs/institute-logo/LOGO1011874649.png', 1),
(35, 'DIBR', 'Dibrugarh University', 'Dibrugarh, Assam, 784006', '3732370239', 'registrar@dibru.ac.in', 'e6e061838856bf47e1de730719fb2609', 'www.dibru.ac.in', '2022-07-19', 'assets/docs/institute-logo/LOGO662698119.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_dob` date DEFAULT NULL,
  `s_gender` varchar(50) DEFAULT NULL,
  `s_nationality` varchar(50) DEFAULT NULL,
  `s_religion` varchar(50) DEFAULT NULL,
  `s_caste` varchar(50) DEFAULT NULL,
  `s_bloodgroup` varchar(50) DEFAULT NULL,
  `s_marritialstatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`s_id`, `s_name`, `s_dob`, `s_gender`, `s_nationality`, `s_religion`, `s_caste`, `s_bloodgroup`, `s_marritialstatus`) VALUES
(25, 'Dhritishman Kalita', '2001-01-18', 'Male', 'Indian', 'Hindu', 'General', 'O+', 'Unmarried');

-- --------------------------------------------------------

--
-- Table structure for table `registration_details`
--

CREATE TABLE `registration_details` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_email` varchar(50) DEFAULT NULL,
  `s_phone` varchar(10) DEFAULT NULL,
  `s_password` varchar(50) DEFAULT NULL,
  `s_institute1` varchar(100) DEFAULT NULL,
  `s_institute2` varchar(100) DEFAULT NULL,
  `s_institute3` varchar(100) DEFAULT NULL,
  `s_stream` varchar(100) DEFAULT NULL,
  `s_course` varchar(100) DEFAULT NULL,
  `s_aplno1` varchar(20) DEFAULT NULL,
  `s_aplno2` varchar(20) DEFAULT NULL,
  `s_aplno3` varchar(20) DEFAULT NULL,
  `s_apldate` date DEFAULT NULL,
  `s_aplstatus1` int(11) DEFAULT 0,
  `s_aplstatus2` int(11) DEFAULT 0,
  `s_aplstatus3` int(11) DEFAULT 0,
  `s_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration_details`
--

INSERT INTO `registration_details` (`s_id`, `s_name`, `s_email`, `s_phone`, `s_password`, `s_institute1`, `s_institute2`, `s_institute3`, `s_stream`, `s_course`, `s_aplno1`, `s_aplno2`, `s_aplno3`, `s_apldate`, `s_aplstatus1`, `s_aplstatus2`, `s_aplstatus3`, `s_status`) VALUES
(25, 'Dhritishman Kalita', 'dhritishmankalita@gmail.com', '8638719449', 'e6e061838856bf47e1de730719fb2609', 'Assam Down Town University', 'Royal Global University', 'Assam Don Bosco University', 'Science', 'Under Graduate', 'ADTU2022472463', 'ROGU2022580683', 'ADBU2022918862', '2022-07-23', 1, 3, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `residential_details`
--

CREATE TABLE `residential_details` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_villagetown` varchar(50) DEFAULT NULL,
  `s_postoffice` varchar(50) DEFAULT NULL,
  `s_policestation` varchar(50) DEFAULT NULL,
  `s_pinno` int(11) DEFAULT NULL,
  `s_state` varchar(50) DEFAULT NULL,
  `s_district` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `residential_details`
--

INSERT INTO `residential_details` (`s_id`, `s_name`, `s_villagetown`, `s_postoffice`, `s_policestation`, `s_pinno`, `s_state`, `s_district`) VALUES
(25, 'Dhritishman Kalita', 'Patacharkuchi', 'Patacharkuchi', 'Patacharkuchi', 781326, 'Assam', 'Bajali');

-- --------------------------------------------------------

--
-- Table structure for table `stream`
--

CREATE TABLE `stream` (
  `str_id` int(11) NOT NULL,
  `str_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stream`
--

INSERT INTO `stream` (`str_id`, `str_name`) VALUES
(1, 'Science'),
(2, 'Arts'),
(3, 'Commerce');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(11) NOT NULL,
  `std_name` varchar(100) DEFAULT NULL,
  `std_aplno` varchar(50) DEFAULT NULL,
  `std_institute` varchar(100) DEFAULT NULL,
  `std_rollno` varchar(50) DEFAULT NULL,
  `std_admdate` date DEFAULT NULL,
  `std_status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_name`, `std_aplno`, `std_institute`, `std_rollno`, `std_admdate`, `std_status`) VALUES
(22, 'Dhritishman Kalita', 'ROGU2022580683', 'Royal Global University', 'ROGU/2022/7159', '2022-07-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `phone`, `email`) VALUES
(1, 'user 1', '9876543210', 'user1@demo.com'),
(2, 'user 2', '9876543211', 'user2@demo.com'),
(3, 'user 3', '9876543212', 'user3@demo.com'),
(4, 'user 4', '9876543213', 'user4@demo.com');

-- --------------------------------------------------------

--
-- Table structure for table `upload_documents`
--

CREATE TABLE `upload_documents` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `s_passportphotograph` varchar(100) DEFAULT NULL,
  `s_signature` varchar(100) DEFAULT NULL,
  `s_hslccertificate` varchar(100) DEFAULT NULL,
  `s_hslcmarksheet` varchar(100) DEFAULT NULL,
  `s_hscertificate` varchar(100) DEFAULT NULL,
  `s_hsmarksheet` varchar(100) DEFAULT NULL,
  `s_ugcertificate` varchar(100) DEFAULT NULL,
  `s_ugmarksheet` varchar(100) DEFAULT NULL,
  `s_bankpassbook` varchar(100) DEFAULT NULL,
  `s_extracarricular` varchar(100) DEFAULT NULL,
  `s_differentlyabled` varchar(100) DEFAULT NULL,
  `s_ncccertificate` varchar(100) DEFAULT NULL,
  `s_castecertificate` varchar(100) DEFAULT NULL,
  `s_incomecertificate` varchar(100) DEFAULT NULL,
  `s_domicilecertificate` varchar(100) DEFAULT NULL,
  `s_aadhaarcard` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_documents`
--

INSERT INTO `upload_documents` (`s_id`, `s_name`, `s_passportphotograph`, `s_signature`, `s_hslccertificate`, `s_hslcmarksheet`, `s_hscertificate`, `s_hsmarksheet`, `s_ugcertificate`, `s_ugmarksheet`, `s_bankpassbook`, `s_extracarricular`, `s_differentlyabled`, `s_ncccertificate`, `s_castecertificate`, `s_incomecertificate`, `s_domicilecertificate`, `s_aadhaarcard`) VALUES
(25, 'Dhritishman Kalita', 'assets/docs/passport-photograph/eAdmission2093743199.png', 'assets/docs/signature/eAdmission750260895.png', 'assets/docs/hslc-certificate/eAdmission151136976.pdf', 'assets/docs/hslc-marksheet/eAdmission1894122931.pdf', 'assets/docs/hs-certificate/eAdmission922596775.pdf', 'assets/docs/hs-marksheet/eAdmission1335366074.pdf', NULL, NULL, 'assets/docs/bank-passbook/eAdmission1316434600.pdf', 'assets/docs/extracarricular-activity-certificate/eAdmission367973407.pdf', NULL, 'assets/docs/ncc-certificate/eAdmission77164402.pdf', NULL, NULL, 'assets/docs/domicile-certificate/eAdmission1759767115.pdf', 'assets/docs/aadhaar-card/eAdmission592166940.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_details`
--
ALTER TABLE `academic_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `additional_details`
--
ALTER TABLE `additional_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`),
  ADD UNIQUE KEY `adm_username` (`adm_username`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cour_id`);

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `family_details`
--
ALTER TABLE `family_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`ins_id`),
  ADD UNIQUE KEY `ins_name` (`ins_name`),
  ADD UNIQUE KEY `ins_code` (`ins_code`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `registration_details`
--
ALTER TABLE `registration_details`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `s_phone` (`s_phone`),
  ADD UNIQUE KEY `s_email` (`s_email`);

--
-- Indexes for table `residential_details`
--
ALTER TABLE `residential_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `stream`
--
ALTER TABLE `stream`
  ADD PRIMARY KEY (`str_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`),
  ADD UNIQUE KEY `std_aplno` (`std_aplno`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_documents`
--
ALTER TABLE `upload_documents`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `registration_details`
--
ALTER TABLE `registration_details`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stream`
--
ALTER TABLE `stream`
  MODIFY `str_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
