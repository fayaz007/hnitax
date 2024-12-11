-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 08:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tax_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustments_to_income`
--

CREATE TABLE `adjustments_to_income` (
  `adjustment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tax_year` year(4) NOT NULL,
  `education_expenses` enum('yes','no') DEFAULT 'no',
  `education_expenses_spouse` enum('yes','no') DEFAULT 'no',
  `student_loan_interest` enum('yes','no') DEFAULT 'no',
  `student_loan_interest_spouse` enum('yes','no') DEFAULT 'no',
  `ira_contribution` enum('yes','no') DEFAULT 'no',
  `ira_contribution_type` varchar(255) DEFAULT NULL,
  `ira_contribution_spouse` enum('yes','no') DEFAULT 'no',
  `ira_contribution_spouse_type` varchar(255) DEFAULT NULL,
  `hsa_contribution` enum('yes','no') DEFAULT 'no',
  `hsa_contribution_spouse` enum('yes','no') DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adjustments_to_income`
--

INSERT INTO `adjustments_to_income` (`adjustment_id`, `user_id`, `tax_year`, `education_expenses`, `education_expenses_spouse`, `student_loan_interest`, `student_loan_interest_spouse`, `ira_contribution`, `ira_contribution_type`, `ira_contribution_spouse`, `ira_contribution_spouse_type`, `hsa_contribution`, `hsa_contribution_spouse`, `created_at`, `updated_at`) VALUES
(1, 43, '2024', 'no', 'no', 'no', 'no', 'yes', '1', 'yes', '2', 'no', 'no', '2024-10-28 09:36:57', '2024-10-29 09:48:35'),
(3, 60, '2024', 'no', 'no', 'no', 'no', 'no', '', 'no', '', 'no', 'no', '2024-11-01 16:25:52', '2024-11-02 10:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `business_income`
--

CREATE TABLE `business_income` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tax_year` int(11) NOT NULL,
  `has_business_income` enum('yes','no') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_income`
--

INSERT INTO `business_income` (`id`, `user_id`, `tax_year`, `has_business_income`, `created_at`, `updated_at`) VALUES
(1, 43, 2024, 'yes', '2024-10-29 07:16:15', '2024-10-30 06:43:24'),
(3, 60, 2024, 'yes', '2024-11-01 16:26:04', '2024-11-01 16:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `apartment_number` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `work_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tax_year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`contact_id`, `user_id`, `street_address`, `apartment_number`, `city`, `state`, `zip_code`, `email_id`, `mobile_number`, `work_number`, `created_at`, `updated_at`, `tax_year`) VALUES
(1, 43, 'Rahim Nagar Line 07', ' Apartment Number 07', 'Aurangabad', 'Maharashtra', '431004', 'fayazkhan8237@gmail.com', '8237175508', '02406417811', '2024-10-22 17:41:02', '2024-10-26 12:19:26', '2024'),
(2, 56, 'kranti chowk aurangabad', ' Apartment Number 07', 'Aurangabad', 'Maharashtra', '431001', 'muzzamildasda@gmail.com', '08237175508', '02406417811', '2024-11-01 07:03:54', '2024-11-01 07:09:34', '2024'),
(9, 58, '10173 Crist Plaza', '347', 'Centennial', 'Louisiana', '14506', 'your.email+fakedata55336@gmail.com', '288-407-2486', '375-519-3426', '2024-11-12 13:59:12', '2024-11-12 13:59:51', '2024'),
(10, 58, '10173 Crist Plaza', '347', 'Centennial', 'Louisiana', '14506', 'your.email+fakedata55336@gmail.com', '288-407-2486', '375-519-3426', '2024-11-12 15:20:22', '2024-11-12 15:20:22', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `deduction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tax_year` year(4) NOT NULL,
  `charitable_contributions` enum('yes','no') DEFAULT 'no',
  `home_mortgage_interest` enum('yes','no') DEFAULT 'no',
  `hybrid_vehicle` enum('yes','no') DEFAULT 'no',
  `energy_equipment` enum('yes','no') DEFAULT 'no',
  `medical_expenses` enum('yes','no') DEFAULT 'no',
  `medical_expenses_notes` varchar(255) DEFAULT NULL,
  `car_taxes` enum('yes','no') DEFAULT 'no',
  `car_details` varchar(255) DEFAULT NULL,
  `motor_vehicle_tax` enum('yes','no') DEFAULT 'no',
  `college_saving_plan` enum('yes','no') DEFAULT 'no',
  `charitable_contributions_spouse` enum('yes','no') DEFAULT 'no',
  `home_mortgage_interest_spouse` enum('yes','no') DEFAULT 'no',
  `hybrid_vehicle_spouse` enum('yes','no') DEFAULT 'no',
  `energy_equipment_spouse` enum('yes','no') DEFAULT 'no',
  `medical_expenses_spouse` enum('yes','no') DEFAULT 'no',
  `medical_expenses_spouse_notes` varchar(255) DEFAULT NULL,
  `car_taxes_spouse` enum('yes','no') DEFAULT 'no',
  `car_details_spouse` varchar(255) DEFAULT NULL,
  `motor_vehicle_tax_spouse` enum('yes','no') DEFAULT 'no',
  `college_saving_plan_spouse` enum('yes','no') DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`deduction_id`, `user_id`, `tax_year`, `charitable_contributions`, `home_mortgage_interest`, `hybrid_vehicle`, `energy_equipment`, `medical_expenses`, `medical_expenses_notes`, `car_taxes`, `car_details`, `motor_vehicle_tax`, `college_saving_plan`, `charitable_contributions_spouse`, `home_mortgage_interest_spouse`, `hybrid_vehicle_spouse`, `energy_equipment_spouse`, `medical_expenses_spouse`, `medical_expenses_spouse_notes`, `car_taxes_spouse`, `car_details_spouse`, `motor_vehicle_tax_spouse`, `college_saving_plan_spouse`, `created_at`, `updated_at`) VALUES
(1, 43, '2024', 'yes', 'yes', 'yes', 'yes', 'yes', 'Please write only unreimbursed medical expenses:', 'yes', 'Please write only unreimbursed medical expenses:', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'Please write only unreimbursed medical expenses:', 'yes', 'Please write only unreimbursed medical expenses:', 'yes', 'no', '2024-10-28 12:49:44', '0000-00-00 00:00:00'),
(3, 60, '2024', 'yes', 'yes', 'yes', 'yes', 'yes', 'Please write only unreimbursed medical expenses:', 'yes', 'If yes, please provide car details in Notes:', 'yes', 'yes', 'no', 'no', 'no', 'no', 'no', 'Please write only unreimbursed medical expenses:', 'no', 'sdasd', 'no', 'no', '2024-11-01 16:25:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dependents`
--

CREATE TABLE `dependents` (
  `dependent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tax_year` year(4) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `ssn` varchar(200) DEFAULT NULL,
  `ssn_select` varchar(200) DEFAULT NULL,
  `relationship` varchar(50) NOT NULL,
  `entry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dependents`
--

INSERT INTO `dependents` (`dependent_id`, `user_id`, `tax_year`, `first_name`, `last_name`, `dob`, `ssn`, `ssn_select`, `relationship`, `entry_date`, `created_at`, `updated_at`) VALUES
(13, 43, '2024', 'First Name', 'Last Name (as Per SSN)', '2024-10-11', 'SSN/ITIN', NULL, 'Step Son', '2024-10-18', '2024-10-24 12:26:46', '2024-10-24 12:26:46'),
(14, 43, '2024', 'fayaz', 'khan', '2024-10-18', 'SSN/ITINsds', NULL, 'Mother in Law', '2024-10-26', '2024-10-26 15:31:22', '2024-10-26 15:31:22'),
(15, 43, '2024', 'fayazsdasdasdasdasd', 'khan', '2024-10-09', 'sadasdasdas', NULL, 'Mother', '2024-10-17', '2024-10-26 15:32:02', '2024-10-26 15:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `tax_year` int(11) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `from_admin` int(11) DEFAULT 0,
  `admin_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `user_id`, `document_type`, `file_name`, `file_path`, `tax_year`, `uploaded_at`, `from_admin`, `admin_file`) VALUES
(5, 43, '1099B', 'ayaz_19971211_43_1730013213_List of Features for HNI Tax (1).pdf', 'C:/xampp/htdocs/__work/hnitax/assets/uploads/documents/ayaz_19971211_43_1730013213_List of Features for HNI Tax (1).pdf', 2024, '2024-10-27 07:13:33', 0, NULL),
(6, 43, '1099INT', 'ayaz_19971211_43_1730013213_ayaz_19971211_43_1730009639_ayaz_19971211_43_1729765085_1723459159-remove-member-icon.png', 'C:/xampp/htdocs/__work/hnitax/assets/uploads/documents/ayaz_19971211_43_1730013213_ayaz_19971211_43_1730009639_ayaz_19971211_43_1729765085_1723459159-remove-member-icon.png', 2024, '2024-10-27 07:13:33', 0, NULL),
(7, 43, '1099DIV', 'ayaz_19971211_43_1730013213_WhatsApp Image 2024-09-26 at 1.29.22 AM.jpeg', 'C:/xampp/htdocs/__work/hnitax/assets/uploads/documents/ayaz_19971211_43_1730013213_WhatsApp Image 2024-09-26 at 1.29.22 AM.jpeg', 2024, '2024-10-27 07:13:33', 0, NULL),
(8, 43, 'Form_1095A', 'ayaz_19971211_43_1730179529_ayaz_19971211_43_1730013213_WhatsApp Image 2024-09-26 at 1.29.22 AM.jpeg', 'C:/xampp/htdocs/__work/hnitax/assets/uploads/documents/ayaz_19971211_43_1730179529_ayaz_19971211_43_1730013213_WhatsApp Image 2024-09-26 at 1.29.22 AM.jpeg', 2024, '2024-10-29 05:25:29', 0, NULL),
(16, 60, '1099INT', 'Yousuf_20140401_60_1730478473_💸 Pay ₹10k-15k Plus Incentives.pdf', '/home/u898896087/domains/nextverse.in/public_html/hnitax/assets/uploads/documents/Yousuf_20140401_60_1730478473_💸 Pay ₹10k-15k Plus Incentives.pdf', 2024, '2024-11-01 16:27:53', 0, NULL),
(17, 60, 'SIGNATURE', 'Yousuf_20140401_60_1730478488_signature.png', '/home/u898896087/domains/nextverse.in/public_html/hnitax/assets/uploads/documents/Yousuf_20140401_60_1730478488_signature.png', 2024, '2024-11-01 16:28:08', 0, NULL),
(18, 60, '1099DIV', 'Yousuf_20140401_60_1730478574_HNI TAX website development Proposal updated (2).pdf', '/home/u898896087/domains/nextverse.in/public_html/hnitax/assets/uploads/documents/Yousuf_20140401_60_1730478574_HNI TAX website development Proposal updated (2).pdf', 2024, '2024-11-01 16:29:34', 0, NULL),
(23, 60, '1099B', 'Yousuf_20140401_60_1730541069_ayaz_19971211_43_1730364253_signature.png', '/home/u898896087/domains/nextverse.in/public_html/hnitax/assets/uploads/documents/Yousuf_20140401_60_1730541069_ayaz_19971211_43_1730364253_signature.png', 2024, '2024-11-02 09:51:09', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employment_details`
--

CREATE TABLE `employment_details` (
  `employment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employer_name` varchar(255) NOT NULL,
  `employment_start_date` date NOT NULL,
  `employment_end_date` date DEFAULT NULL,
  `tax_year` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fbar`
--

CREATE TABLE `fbar` (
  `fbar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tax_year` year(4) NOT NULL,
  `fbar_status` enum('yes','no') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fbar`
--

INSERT INTO `fbar` (`fbar_id`, `user_id`, `tax_year`, `fbar_status`, `created_at`, `updated_at`) VALUES
(1, 43, '2024', 'no', '2024-10-29 02:13:56', '2024-10-29 09:49:02'),
(4, 60, '2024', 'no', '2024-11-01 16:25:57', '2024-11-01 16:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_details`
--

CREATE TABLE `insurance_details` (
  `insurance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `health_insurance` enum('Yes','No') NOT NULL,
  `coverage_duration` enum('Full Year','Part Year') NOT NULL,
  `insurance_provider` enum('Employer','Market') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `form_1095a_upload` varchar(255) DEFAULT NULL,
  `tax_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance_details`
--

INSERT INTO `insurance_details` (`insurance_id`, `user_id`, `health_insurance`, `coverage_duration`, `insurance_provider`, `created_at`, `updated_at`, `form_1095a_upload`, `tax_year`) VALUES
(1, 43, 'Yes', 'Full Year', 'Market', '2024-10-24 08:01:53', '2024-10-29 05:25:29', 'ayaz_19971211_43_1730179529_ayaz_19971211_43_1730013213_WhatsApp Image 2024-09-26 at 1.29.22 AM.jpeg', 2024),
(3, 60, 'Yes', 'Full Year', 'Employer', '2024-11-01 16:22:46', '2024-11-01 16:22:46', NULL, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(10) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `login_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`log_id`, `user_id`, `action`, `ip_address`, `user_agent`, `login_time`) VALUES
(1, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-12 19:06:24'),
(2, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-13 10:16:03'),
(3, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-13 10:16:12'),
(4, 43, 'Login', '192.168.1.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-13 12:04:34'),
(5, 43, 'Login', '192.168.1.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-13 12:59:50'),
(6, 43, 'Logout', '192.168.1.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-13 18:59:26'),
(7, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-14 10:48:39'),
(8, 43, 'Login', '192.168.1.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-14 12:33:05'),
(9, 43, 'Login', '192.168.1.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-15 11:31:03'),
(10, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-15 18:38:47'),
(11, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-15 18:39:18'),
(12, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-15 19:00:45'),
(13, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-19 16:39:48'),
(14, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-19 19:03:55'),
(15, 43, 'Login', '192.168.1.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-20 11:34:39'),
(16, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-20 11:48:28'),
(17, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-22 10:27:20'),
(18, 43, 'Login', '192.168.1.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-23 18:46:29'),
(19, 43, 'Logout', '192.168.1.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-23 19:26:44'),
(20, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 15:24:25'),
(21, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 15:52:59'),
(22, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 15:55:00'),
(23, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 15:57:30'),
(24, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 15:58:26'),
(25, 43, 'Login', '192.168.1.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 17:46:44'),
(26, 43, 'Login', '192.168.1.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 18:04:04'),
(27, 43, 'Logout', '192.168.1.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 18:04:14'),
(28, 43, 'Login', '192.168.1.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 18:07:17'),
(29, 43, 'Logout', '192.168.1.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 18:07:25'),
(30, 43, 'Login', '192.168.1.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2023-12-30 18:07:37'),
(31, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2024-01-01 10:42:42'),
(32, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2024-01-01 15:43:24'),
(33, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', '2024-02-09 11:31:21'),
(34, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', '2024-02-09 11:33:27'),
(35, 43, 'Login', '192.168.1.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-21 14:25:37'),
(36, 43, 'Login', '192.168.1.152', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-06-21 14:28:14'),
(37, 43, 'Logout', '192.168.1.152', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-21 15:50:05'),
(38, 43, 'Login', '192.168.1.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-21 15:54:20'),
(39, 43, 'Logout', '192.168.1.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-21 16:00:46'),
(40, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', '2024-08-22 11:39:48'),
(41, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', '2024-08-22 11:41:02'),
(42, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 19:29:16'),
(43, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 21:19:33'),
(44, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:03:56'),
(45, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:04:02'),
(46, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:23:30'),
(47, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:23:36'),
(48, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:24:08'),
(49, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:33:53'),
(50, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:34:08'),
(51, 49, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:38:07'),
(52, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:38:22'),
(53, 49, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:57:01'),
(54, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-26 22:57:09'),
(55, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-09-28 14:56:10'),
(56, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 10:08:57'),
(57, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 10:25:27'),
(58, 49, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 10:25:50'),
(59, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 11:04:56'),
(60, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 11:16:20'),
(61, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 17:53:53'),
(62, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 17:54:13'),
(63, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 17:54:20'),
(64, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 17:54:22'),
(65, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 18:41:13'),
(66, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 18:41:27'),
(67, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:16:30'),
(68, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:16:33'),
(69, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:16:35'),
(70, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:16:41'),
(71, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:16:44'),
(72, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:16:57'),
(73, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:17:07'),
(74, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:17:10'),
(75, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:17:12'),
(76, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:17:17'),
(77, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:17:44'),
(78, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:17:52'),
(79, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:17:56'),
(80, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 20:18:07'),
(81, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 21:11:30'),
(82, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 21:11:33'),
(83, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 21:13:40'),
(84, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-01 21:13:43'),
(85, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-18 22:35:40'),
(86, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-19 21:57:46'),
(87, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-20 18:10:24'),
(88, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-20 18:10:43'),
(89, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-20 21:05:10'),
(90, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-21 20:45:01'),
(91, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-23 17:36:57'),
(92, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-23 17:52:14'),
(93, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-23 17:52:21'),
(94, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-23 17:53:18'),
(95, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-23 18:45:39'),
(96, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-23 19:17:49'),
(97, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2024-10-23 21:30:53'),
(98, 43, 'Login', '192.168.1.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-24 11:04:36'),
(99, 43, 'Login', '192.168.1.113', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-24 11:24:32'),
(100, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-24 15:27:46'),
(101, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-25 12:22:15'),
(102, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-27 10:31:28'),
(103, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-28 10:47:27'),
(104, 43, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-28 10:49:43'),
(105, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-28 16:49:35'),
(106, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-29 10:54:09'),
(107, 43, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-30 11:37:42'),
(108, 56, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-10-31 20:31:52'),
(109, 57, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 15:24:39'),
(111, 58, 'Login', '2409:40c2:8057:d9b6:c037:efff:febb:95a4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36', '2024-11-01 17:44:09'),
(112, 58, 'Login', '2409:40c2:8057:d9b6:136:2c5b:4b10:7ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 17:50:00'),
(113, 58, 'Login', '2409:40c2:8057:d9b6:136:2c5b:4b10:7ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 19:17:44'),
(114, 58, 'Login', '2409:40c2:8057:d9b6:c037:efff:febb:95a4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36', '2024-11-01 19:19:10'),
(115, 58, 'Logout', '2409:40c2:8057:d9b6:136:2c5b:4b10:7ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 20:15:28'),
(116, 58, 'Login', '2409:40c2:8057:d9b6:136:2c5b:4b10:7ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 20:15:58'),
(117, 58, 'Logout', '2409:40c2:8057:d9b6:136:2c5b:4b10:7ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 20:16:01'),
(118, 58, 'Logout', '2409:40c2:8057:d9b6:c037:efff:febb:95a4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36', '2024-11-01 20:21:43'),
(119, 59, 'Login', '2409:40c2:8000:3eac:54f5:cab9:60d3:e2bb', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1', '2024-11-01 20:35:36'),
(120, 58, 'Login', '2409:40c2:8057:d9b6:54b3:cfff:feb6:5f1c', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36', '2024-11-01 21:00:00'),
(121, 60, 'Login', '2409:40f0:11c0:164a:a868:1d58:68ec:f69d', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 21:47:24'),
(122, 61, 'Login', '2409:40f0:11c0:164a:3c60:c8f2:978a:502a', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 22:05:27'),
(123, 58, 'Login', '2409:40c2:804b:1bdb:fc6a:1916:cd7e:f7ea', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 22:31:40'),
(124, 61, 'Logout', '2409:40f0:11c0:164a:3c60:c8f2:978a:502a', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 22:54:32'),
(125, 61, 'Login', '2409:40f0:11c0:164a:3c60:c8f2:978a:502a', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 22:54:43'),
(126, 61, 'Logout', '2409:40f0:11c0:164a:3c60:c8f2:978a:502a', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-01 22:59:13'),
(127, 59, 'Login', '103.162.158.152', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 13:09:03'),
(128, 58, 'Logout', '2409:40c2:8018:635e:f5cb:c983:d2be:e5d5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 15:03:21'),
(129, 60, 'Login', '2409:40c2:8018:635e:f5cb:c983:d2be:e5d5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 15:03:52'),
(130, 60, 'Logout', '2409:40c2:8018:635e:85c4:99d4:546e:341b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 17:02:40'),
(131, 58, 'Login', '2409:40c2:8018:635e:85c4:99d4:546e:341b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 17:05:16'),
(132, 58, 'Logout', '2409:40c2:8018:635e:85c4:99d4:546e:341b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 17:05:22'),
(133, 49, 'Login', '2409:40c2:8018:635e:85c4:99d4:546e:341b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 17:05:30'),
(134, 58, 'Login', '2409:40c2:8018:635e:85c4:99d4:546e:341b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 17:13:02'),
(135, 58, 'Logout', '2409:40c2:8018:635e:85c4:99d4:546e:341b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 17:13:06'),
(136, 58, 'Login', '2409:40c2:8018:635e:85c4:99d4:546e:341b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-02 17:13:24'),
(137, 58, 'Login', '2409:40c2:8018:635e:dc85:43ff:fed6:b41c', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36', '2024-11-02 18:09:09'),
(138, 58, 'Login', '2409:40c2:800a:1c31:3423:4190:a191:bada', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-03 18:40:29'),
(139, 49, 'Login', '2409:40c2:800a:1c31:3423:4190:a191:bada', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-03 18:48:14'),
(140, 58, 'Logout', '2409:40c2:800a:1c31:3423:4190:a191:bada', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-03 19:16:04'),
(141, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-03 19:24:10'),
(142, 58, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-03 20:36:14'),
(143, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-04 10:45:20'),
(144, 58, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-04 11:05:29'),
(145, 58, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-05 16:04:23'),
(146, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-05 16:04:56'),
(147, 58, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-05 21:02:55'),
(148, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-05 21:03:11'),
(149, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-06 14:29:46'),
(150, 58, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-06 14:48:30'),
(151, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-07 10:58:27'),
(152, 49, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-07 18:34:27'),
(153, 58, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-08 22:43:24'),
(154, 58, 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-08 22:43:54'),
(155, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-08 22:44:11'),
(156, 58, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-09 00:37:03'),
(157, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-10 10:08:49'),
(158, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-10 21:06:35'),
(159, 58, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-12 16:43:12'),
(160, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-12 16:44:05'),
(161, 58, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-12 20:09:38'),
(162, 49, 'Login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '2024-11-12 20:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `other_income`
--

CREATE TABLE `other_income` (
  `income_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tax_year` year(4) NOT NULL,
  `sold_stocks` enum('yes','no') NOT NULL,
  `interest_income` enum('yes','no') NOT NULL,
  `dividend_income` enum('yes','no') NOT NULL,
  `rental_income` enum('yes','no') NOT NULL,
  `ira_distributions` enum('yes','no') NOT NULL,
  `foreign_income` enum('yes','no') NOT NULL,
  `foreign_income_nature` varchar(255) DEFAULT NULL,
  `hsa_distributions` enum('yes','no') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other_income`
--

INSERT INTO `other_income` (`income_id`, `user_id`, `tax_year`, `sold_stocks`, `interest_income`, `dividend_income`, `rental_income`, `ira_distributions`, `foreign_income`, `foreign_income_nature`, `hsa_distributions`, `created_at`) VALUES
(1, 43, '2024', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'dfgdfgdf', 'yes', '2024-10-27 07:13:33'),
(3, 60, '2024', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'sdasdasd', 'yes', '2024-11-01 16:23:55'),
(4, 61, '2024', 'no', 'no', 'no', 'no', 'no', 'no', '', 'no', '2024-11-01 16:47:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_information`
--

CREATE TABLE `personal_information` (
  `personal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `filing_status` varchar(255) NOT NULL,
  `marriage_date` date DEFAULT NULL,
  `taxpayer_dob` date NOT NULL,
  `current_occupation` varchar(255) DEFAULT NULL,
  `taxpayer_ssn_select` varchar(255) NOT NULL,
  `taxpayer_ssn_input` varchar(11) DEFAULT NULL,
  `taxpayer_entry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tax_year` year(4) DEFAULT NULL,
  `review_documents_status` varchar(50) DEFAULT 'Pending',
  `tax_filing_status` varchar(50) DEFAULT 'Pending',
  `payment_status` varchar(50) DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_information`
--

INSERT INTO `personal_information` (`personal_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `marital_status`, `filing_status`, `marriage_date`, `taxpayer_dob`, `current_occupation`, `taxpayer_ssn_select`, `taxpayer_ssn_input`, `taxpayer_entry_date`, `created_at`, `updated_at`, `tax_year`, `review_documents_status`, `tax_filing_status`, `payment_status`) VALUES
(4, 60, 'Yousuf', '', 'khan', 'Married', 'Married Filing Jointly', '2022-08-01', '2014-04-01', 'employee', 'yes', '123-45-6879', '2024-09-11', '2024-11-01 16:22:05', '2024-11-01 16:35:18', '2024', 'Pending', 'Pending', 'Unpaid'),
(5, 61, 'Chandu', '', 'Allenki', 'Single', 'Single', '0000-00-00', '2001-02-28', 'CSR', 'yes', '012-23-456', '2023-11-03', '2024-11-01 16:41:36', '2024-11-01 16:42:18', '2024', 'Pending', 'Pending', 'Unpaid'),
(23, 58, 'Ramiro', 'Gerry Pacocha', 'Donnelly-Carroll', 'Head of House Hold', 'Single', '2025-04-28', '2024-07-08', 'Magni nulla quas placeat adipisci.', 'yes', 'Reprehender', '2025-07-12', '2024-11-12 13:59:12', '2024-11-12 13:59:51', '2024', 'Pending', 'Pending', 'Unpaid'),
(24, 58, 'Ramiro', 'Gerry Pacocha', 'Donnelly-Carroll', 'Head of House Hold', 'Single', '2025-04-28', '2024-07-08', 'Magni nulla quas placeat adipisci.', 'yes', 'Reprehender', '2025-07-12', '2024-11-12 15:20:22', '2024-11-12 15:20:22', '2023', 'Pending', 'Pending', 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `referral_name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tax_year` int(11) DEFAULT year(current_timestamp()),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `user_id`, `referral_name`, `phone`, `email`, `tax_year`, `created_at`) VALUES
(3, 56, 'Referral Name', '8237175508', 'fayazkhan5022@gmail.com', 2024, '2024-11-01 09:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `residency_details`
--

CREATE TABLE `residency_details` (
  `residency_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `residency_for` varchar(50) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `residency_start_date` date NOT NULL,
  `residency_end_date` date NOT NULL,
  `rent_paid` decimal(10,2) NOT NULL,
  `tax_year` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residency_details`
--

INSERT INTO `residency_details` (`residency_id`, `user_id`, `residency_for`, `state_name`, `residency_start_date`, `residency_end_date`, `rent_paid`, `tax_year`, `created_at`) VALUES
(17, 43, 'Taxpayer', 'Arizona', '2024-10-11', '2024-10-27', 60.00, 2024, '2024-10-24 13:53:11'),
(18, 43, 'Taxpayer', 'Alaska', '2024-10-25', '2024-10-26', 10.00, 2024, '2024-10-25 07:36:45'),
(19, 43, 'Spouse', 'Alaska', '2024-10-25', '2024-10-27', 1.00, 2024, '2024-10-25 07:39:26'),
(20, 43, 'Taxpayer', 'Alaska', '2024-10-03', '2024-10-16', 10.00, 2024, '2024-10-26 15:54:13'),
(21, 43, 'Taxpayer', 'Arizona', '2024-10-11', '2024-10-17', 1.00, 2024, '2024-10-26 15:55:24'),
(23, 60, 'Taxpayer', 'Arizona', '2024-09-06', '2024-11-01', 2022.00, 2024, '2024-11-01 16:23:18'),
(24, 61, 'Taxpayer', 'Texas', '2024-01-01', '2024-08-16', 5000.00, 2024, '2024-11-01 16:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `spouse_information`
--

CREATE TABLE `spouse_information` (
  `spouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `spouse_first_name` varchar(255) NOT NULL,
  `spouse_middle_name` varchar(255) DEFAULT NULL,
  `spouse_last_name` varchar(255) NOT NULL,
  `spouse_dob` date NOT NULL,
  `spouse_visa_category` varchar(50) NOT NULL,
  `spouse_itin` enum('yes','no','Need to apply') NOT NULL,
  `spouse_ssn` varchar(11) DEFAULT NULL,
  `spouse_entry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tax_year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spouse_information`
--

INSERT INTO `spouse_information` (`spouse_id`, `user_id`, `spouse_first_name`, `spouse_middle_name`, `spouse_last_name`, `spouse_dob`, `spouse_visa_category`, `spouse_itin`, `spouse_ssn`, `spouse_entry_date`, `created_at`, `updated_at`, `tax_year`) VALUES
(1, 43, 'amaira ', 'khan', 'pathan', '2022-01-25', 'H1B', 'yes', '123-45-6789', '2024-10-22', '2024-10-22 17:41:02', '2024-10-26 12:19:26', '2024'),
(2, 56, 'Lysanne', 'Jazmyne O\'Conner', '8237175508', '2024-11-10', 'H4-EAD', 'yes', 'sdasdasdas', '2024-11-06', '2024-11-01 07:03:54', '2024-11-01 07:09:34', '2024'),
(4, 60, 'meharan', '', 'banni ', '1999-08-02', 'H4', 'yes', '123-45-7890', '2024-09-05', '2024-11-01 16:22:05', '2024-11-01 16:35:18', '2024'),
(13, 58, 'Assunta', 'Mason Dach', 'Fisher-O\'Kon', '2024-05-13', 'H4-EAD', 'yes', 'Sammie_Wael', '2024-10-07', '2024-11-12 13:59:12', '2024-11-12 13:59:12', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `tax_estimates`
--

CREATE TABLE `tax_estimates` (
  `estimate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tax_year` year(4) NOT NULL,
  `federal_refund` varchar(255) DEFAULT '0.00',
  `state_refund` varchar(255) DEFAULT '0.00',
  `city_refund` varchar(255) DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'no-img.png',
  `user_type` enum('User','Admin') DEFAULT 'User' COMMENT '2 roles',
  `status` enum('Active','Inactive','Pending') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `reset_token_expiration` datetime DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `phone`, `avatar`, `user_type`, `status`, `created_at`, `updated_at`, `reset_token`, `auth_token`, `reset_token_expiration`, `otp_code`, `otp_expiry`) VALUES
(49, 'ADMIN USER', 'admin@gmail.com', '$2y$10$XeaVTp23YNegvteYrbOzcucJIiDFcx5a6NcDMsNHbrE2zQ549Ucre', '9999999999', 'no-img.png', 'Admin', 'Active', '2023-11-01 11:59:22', '2024-11-02 11:34:37', NULL, NULL, NULL, NULL, NULL),
(58, 'Fayaz khan', 'fayazkhan8237@gmail.com', '$2y$10$XeaVTp23YNegvteYrbOzcucJIiDFcx5a6NcDMsNHbrE2zQ549Ucre', '+918237175508', 'no-img.png', 'User', 'Active', '2024-11-01 12:13:55', '2024-11-03 13:46:04', NULL, NULL, NULL, NULL, NULL),
(59, 'Siddiqui', 'siddiquiinam9@gmail.com', '$2y$10$/j2GdjmHIYAOpFl03zTXuO6zRB91TlmRA8hYTrQs.7icou7FFkeWC', '+919156222666', 'no-img.png', 'User', 'Active', '2024-11-01 15:05:12', '2024-11-01 15:05:12', NULL, NULL, NULL, NULL, NULL),
(60, 'Yousuf', 'ramgupta11011@gmail.com', '$2y$10$jgHoeubLRyOJJq8Oau0/S.p0zx9J/q.IghSNq8drMTO61dGZN5vOa', '+13127888232', 'no-img.png', 'User', 'Active', '2024-11-01 16:17:11', '2024-11-01 16:17:11', NULL, NULL, NULL, NULL, NULL),
(61, 'Chandu Gupta Allnki', 'allenkichandu6@gmail.com', '$2y$10$HbZkzSyFanjYCfcEwcK3weIXKVO1mBhOB5nmiWScPAtonaHkwSMw.', '+919542925005', 'no-img.png', 'User', 'Active', '2024-11-01 16:35:13', '2024-11-01 17:24:20', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjustments_to_income`
--
ALTER TABLE `adjustments_to_income`
  ADD PRIMARY KEY (`adjustment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `business_income`
--
ALTER TABLE `business_income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`deduction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`dependent_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employment_details`
--
ALTER TABLE `employment_details`
  ADD PRIMARY KEY (`employment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fbar`
--
ALTER TABLE `fbar`
  ADD PRIMARY KEY (`fbar_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `insurance_details`
--
ALTER TABLE `insurance_details`
  ADD PRIMARY KEY (`insurance_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `other_income`
--
ALTER TABLE `other_income`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `personal_information`
--
ALTER TABLE `personal_information`
  ADD PRIMARY KEY (`personal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residency_details`
--
ALTER TABLE `residency_details`
  ADD PRIMARY KEY (`residency_id`);

--
-- Indexes for table `spouse_information`
--
ALTER TABLE `spouse_information`
  ADD PRIMARY KEY (`spouse_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tax_estimates`
--
ALTER TABLE `tax_estimates`
  ADD PRIMARY KEY (`estimate_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjustments_to_income`
--
ALTER TABLE `adjustments_to_income`
  MODIFY `adjustment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_income`
--
ALTER TABLE `business_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dependents`
--
ALTER TABLE `dependents`
  MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `employment_details`
--
ALTER TABLE `employment_details`
  MODIFY `employment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `fbar`
--
ALTER TABLE `fbar`
  MODIFY `fbar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `insurance_details`
--
ALTER TABLE `insurance_details`
  MODIFY `insurance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `other_income`
--
ALTER TABLE `other_income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `personal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `residency_details`
--
ALTER TABLE `residency_details`
  MODIFY `residency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `spouse_information`
--
ALTER TABLE `spouse_information`
  MODIFY `spouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tax_estimates`
--
ALTER TABLE `tax_estimates`
  MODIFY `estimate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adjustments_to_income`
--
ALTER TABLE `adjustments_to_income`
  ADD CONSTRAINT `adjustments_to_income_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `business_income`
--
ALTER TABLE `business_income`
  ADD CONSTRAINT `business_income_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD CONSTRAINT `contact_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `deductions`
--
ALTER TABLE `deductions`
  ADD CONSTRAINT `deductions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `dependents`
--
ALTER TABLE `dependents`
  ADD CONSTRAINT `dependents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `employment_details`
--
ALTER TABLE `employment_details`
  ADD CONSTRAINT `employment_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `fbar`
--
ALTER TABLE `fbar`
  ADD CONSTRAINT `fbar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `insurance_details`
--
ALTER TABLE `insurance_details`
  ADD CONSTRAINT `insurance_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `other_income`
--
ALTER TABLE `other_income`
  ADD CONSTRAINT `other_income_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `personal_information`
--
ALTER TABLE `personal_information`
  ADD CONSTRAINT `personal_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `spouse_information`
--
ALTER TABLE `spouse_information`
  ADD CONSTRAINT `spouse_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tax_estimates`
--
ALTER TABLE `tax_estimates`
  ADD CONSTRAINT `tax_estimates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
