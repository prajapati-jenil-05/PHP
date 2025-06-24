-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2025 at 04:26 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_request`
--

CREATE TABLE `contact_request` (
  `id` int NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `message` varchar(200) NOT NULL,
  `is_replied` tinyint(1) NOT NULL DEFAULT '0',
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_request`
--

INSERT INTO `contact_request` (`id`, `fullname`, `email`, `subject`, `mobile`, `message`, `is_replied`, `replied_at`, `created_at`) VALUES
(23, 'Durgesh kanzariya', 'dkanzariya172@rku.ac.in', 'Subject ', '1234567890', 'awdawdawda', 1, '2025-05-01 15:00:12', '2025-05-01 15:08:05'),
(24, 'Hemal Kanzariya', 'durgesh.j.kanzariya@gmail.com', 'Demo Subject ', '9054831231', 'Demo Message', 1, '2025-05-01 15:00:08', '2025-05-01 15:08:05'),
(25, 'hemal ', 'hemal@gmail.com', 'subject is subject', '9012901290', 'this is demo message', 1, '2025-05-01 15:16:30', '2025-05-01 15:12:10'),
(26, 'Hemal Kanzariya', 'hemal.j.kanjariya@gmail.com', 'hemal', '1290129012', 'hiwew qw dqw dq wqd', 1, '2025-05-01 15:18:59', '2025-05-01 15:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int NOT NULL,
  `dep_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`) VALUES
(1, 'Sales'),
(2, 'Human Resources'),
(3, 'IT'),
(4, 'Marketing'),
(5, 'Finance'),
(6, 'Operations'),
(7, 'Research and Development'),
(8, 'Customer Support'),
(9, 'Legal'),
(10, 'Procurement'),
(11, 'Quality Assurance'),
(12, 'Public Relations'),
(13, 'Training and Development'),
(14, 'Logistics'),
(15, 'Health and Safety');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) DEFAULT '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
  `salary` decimal(10,2) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `address` text,
  `photo` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'employee',
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `firstname`, `lastname`, `email`, `PASSWORD`, `salary`, `department`, `mobile`, `country`, `state`, `city`, `date_of_birth`, `date_of_joining`, `address`, `photo`, `role`, `gender`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '$2y$10$Kfon6EojHdLE7IYknoHlN.Gg4MGmHWnNeymoaWwFlLklJvY.Cq.5a', 50000.00, 'ADMIN', '1234567890', 'USA', 'California', 'San Francisco', '1990-05-15', '2020-01-10', '123 Main St, Apt 4B', '6813974c0e99ajonas-kakaroto-mjRwhvqEC0U-unsplash.jpg', 'admin', 'Male'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 60000.00, 'HR', '9876543210', 'USA', 'New York', 'New York City', '1985-08-20', '2019-03-15', '456 Park Ave, Apt 7C', '67f12d5563e54rocknwool-akAnLCSDoD8-unsplash.jpg', 'employee', 'Female'),
(3, 'Alice', 'Johnson', 'alice.johnson@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 55000.00, 'Finance', '5551234567', 'USA', 'Texas', 'Houston', '1992-11-30', '2021-07-22', '789 Elm St, Apt 2A', 'photo_url_or_blob_data', 'employee', 'Female'),
(4, 'Bob', 'Brown', 'bob.brown@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 70000.00, 'Sales', '4445556666', 'USA', 'Illinois', 'Chicago', '1988-04-25', '2018-09-05', '101 Oak St, Apt 5D', 'photo_url_or_blob_data', 'employee', 'Male'),
(5, 'Charlie', 'Davis', 'charlie.davis@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 65000.00, 'Marketing', '7778889999', 'USA', 'Florida', 'Miami', '1995-02-10', '2022-11-18', '202 Pine St, Apt 3E', 'photo_url_or_blob_data', 'employee', 'Male'),
(26, 'David', 'Williams', 'david.williams@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 75000.00, 'IT', '9876543210', 'USA', 'California', 'Los Angeles', '1988-05-21', '2020-06-15', '123 Main St', 'david.jpg', 'employee', 'Male'),
(27, 'Emma', 'Jones', 'emma.jones@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 72000.00, 'HR', '9876543211', 'UK', 'England', 'London', '1990-08-14', '2019-03-20', '456 Elm St', 'emma.jpg', 'employee', 'Female'),
(28, 'Michael', 'Miller', 'michael.miller@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 80000.00, 'Finance', '9876543212', 'Canada', 'Ontario', 'Toronto', '1985-02-10', '2018-07-01', '789 Oak St', 'michael.jpg', 'employee', 'Male'),
(29, 'Sophia', 'Wilson', 'sophia.wilson@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 69000.00, 'Marketing', '9876543213', 'Australia', 'Victoria', 'Melbourne', '1992-11-30', '2021-09-10', '321 Pine St', 'sophia.jpg', 'employee', 'Female'),
(30, 'Daniel', 'Anderson', 'daniel.anderson@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 85000.00, 'IT', '9876543214', 'Germany', 'Bavaria', 'Munich', '1987-07-07', '2017-01-25', '987 Birch St', 'daniel.jpg', 'employee', 'Male'),
(31, 'Olivia', 'Martinez', 'olivia.martinez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 71000.00, 'HR', '9876543215', 'France', 'Île-de-France', 'Paris', '1993-04-19', '2022-05-10', '654 Cedar St', 'olivia.jpg', 'employee', 'Female'),
(32, 'James', 'Hernandez', 'james.hernandez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 88000.00, 'Finance', '9876543216', 'Spain', 'Madrid', 'Madrid', '1984-09-25', '2016-08-05', '852 Walnut St', 'james.jpg', 'employee', 'Male'),
(33, 'Isabella', 'Lopez', 'isabella.lopez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 73000.00, 'Marketing', '9876543217', 'Italy', 'Lazio', 'Rome', '1991-12-15', '2020-11-12', '159 Maple St', 'isabella.jpg', 'employee', 'Female'),
(34, 'Ethan', 'Gonzalez', 'ethan.gonzalez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 77000.00, 'IT', '9876543218', 'Brazil', 'São Paulo', 'São Paulo', '1989-06-02', '2019-10-08', '753 Aspen St', 'ethan.jpg', 'employee', 'Male'),
(35, 'Mia', 'Rodriguez', 'mia.rodriguez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 70000.00, 'HR', '9876543219', 'Mexico', 'Mexico City', 'Mexico City', '1994-03-27', '2023-02-17', '369 Sycamore St', 'mia.jpg', 'employee', 'Female'),
(36, 'Liam', 'Perez', 'liam.perez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 78000.00, 'Finance', '9876543220', 'India', 'Maharashtra', 'Mumbai', '1986-10-12', '2015-04-30', '147 Fir St', 'liam.jpg', 'employee', 'Male'),
(37, 'Charlotte', 'Brown', 'charlotte.brown@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 76000.00, 'Marketing', '9876543221', 'Japan', 'Tokyo', 'Tokyo', '1990-01-08', '2021-06-23', '258 Magnolia St', 'charlotte.jpg', 'employee', 'Female'),
(38, 'Benjamin', 'Garcia', 'benjamin.garcia@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 83000.00, 'IT', '9876543222', 'China', 'Beijing', 'Beijing', '1988-09-18', '2018-12-04', '357 Hickory St', 'benjamin.jpg', 'employee', 'Male'),
(39, 'Amelia', 'Martinez', 'amelia.martinez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 71000.00, 'HR', '9876543223', 'South Korea', 'Seoul', 'Seoul', '1993-07-16', '2022-08-22', '951 Redwood St', 'amelia.jpg', 'employee', 'Female'),
(40, 'Lucas', 'Davis', 'lucas.davis@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 79000.00, 'Finance', '9876543224', 'Russia', 'Moscow', 'Moscow', '1985-05-09', '2017-05-19', '159 Spruce St', 'lucas.jpg', 'employee', 'Male'),
(41, 'Harper', 'Wilson', 'harper.wilson@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 72000.00, 'Marketing', '9876543225', 'Netherlands', 'North Holland', 'Amsterdam', '1992-11-05', '2020-04-14', '753 Dogwood St', 'harper.jpg', 'employee', 'Female'),
(42, 'Henry', 'Harris', 'henry.harris@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 86000.00, 'IT', '9876543226', 'Sweden', 'Stockholm', 'Stockholm', '1987-02-21', '2016-09-07', '369 Juniper St', 'henry.jpg', 'employee', 'Male'),
(43, 'Ella', 'Clark', 'ella.clark@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 73000.00, 'HR', '9876543227', 'Switzerland', 'Zurich', 'Zurich', '1991-06-22', '2021-12-30', '654 Palm St', 'ella.jpg', 'employee', 'Female'),
(44, 'Jack', 'Adams', 'jack.adams@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 81000.00, 'Finance', '9876543228', 'Argentina', 'Buenos Aires', 'Buenos Aires', '1986-08-03', '2015-11-11', '789 Acacia St', 'jack.jpg', 'employee', 'Male'),
(45, 'Avery', 'Hall', 'avery.hall@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 74000.00, 'Marketing', '9876543229', 'South Africa', 'Gauteng', 'Johannesburg', '1993-09-29', '2022-03-25', '321 Mulberry St', 'avery.jpg', 'employee', 'Female'),
(52, 'anant', 'panjari', 'apanjari245@rku.ac.in', '$2y$10$tsHK.Ry2dbXa7rLIta71oum4800dKf4cufKeheQIfNCqOSfEw763C', 123123.00, 'te', '1233451231', 'USA', 'California', 'San Francisco', '2005-11-13', '2024-12-11', 'qwqwdqwdqw q', '67f12ccaed733jonas-kakaroto-mjRwhvqEC0U-unsplash.jpg', 'employee', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_joining` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `salary` decimal(10,2) NOT NULL DEFAULT '50000.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `email`, `password`, `department`, `mobile_number`, `country`, `state`, `city`, `date_of_birth`, `date_of_joining`, `address`, `created_at`, `salary`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', 'SGVsbG9Xb3JsZCE=', 'IT', '123-456-7890', 'India', 'Maharashtra', 'Mumbai', '1990-05-15', '2023-01-10', '123 Main St, Los Angeles, CA', '2025-02-22 06:41:05', 65000.00),
(2, 'Jane', 'Smith', 'jane.smith@example.com', 'SGVsbG9Xb3JsZCE=', 'HR', '234-567-8901', 'India', 'Delhi', 'New Delhi', '1985-08-22', '2022-11-05', '456 Elm St, New York City, NY', '2025-02-22 06:41:05', 65000.00),
(3, 'Alice', 'Johnson', 'alice.johnson@example.com', 'SGVsbG9Xb3JsZCE=', 'Finance', '345-678-9012', 'India', 'Karnataka', 'Bengaluru', '1988-12-30', '2021-09-15', '789 Oak St, Houston, TX', '2025-02-22 06:41:05', 65000.00),
(4, 'Bob', 'Williams', 'bob.williams@example.com', 'SGVsbG9Xb3JsZCE=', 'Marketing', '456-789-0123', 'India', 'Tamil Nadu', 'Chennai', '1992-03-25', '2020-07-20', '101 Pine St, Chicago, IL', '2025-02-22 06:41:05', 65000.00),
(5, 'Charlie', 'Brown', 'charlie.brown@example.com', 'SGVsbG9Xb3JsZCE=', 'Sales', '567-890-1234', 'India', 'Uttar Pradesh', 'Lucknow', '1995-07-10', '2019-05-12', '202 Maple St, Miami, FL', '2025-02-22 06:41:05', 65000.00),
(6, 'David', 'Jones', 'david.jones@example.com', 'SGVsbG9Xb3JsZCE=', 'IT', '678-901-2345', 'India', 'Gujarat', 'Ahmedabad', '1987-11-18', '2018-03-22', '303 Cedar St, Seattle, WA', '2025-02-22 06:41:05', 65000.00),
(7, 'Eva', 'Garcia', 'eva.garcia@example.com', 'SGVsbG9Xb3JsZCE=', 'HR', '789-012-3456', 'India', 'Rajasthan', 'Jaipur', '1991-02-14', '2022-08-30', '404 Birch St, Phoenix, AZ', '2025-02-22 06:41:05', 65000.00),
(8, 'Frank', 'Martinez', 'frank.martinez@example.com', 'SGVsbG9Xb3JsZCE=', 'Finance', '890-123-4567', 'India', 'West Bengal', 'Kolkata', '1984-06-05', '2021-12-01', '505 Walnut St, Denver, CO', '2025-02-22 06:41:05', 65000.00),
(9, 'Grace', 'Lee', 'grace.lee@example.com', 'SGVsbG9Xb3JsZCE=', 'Marketing', '901-234-5678', 'India', 'Telangana', 'Hyderabad', '1993-09-20', '2020-04-18', '606 Cherry St, Atlanta, GA', '2025-02-22 06:41:05', 65000.00),
(10, 'Henry', 'Taylor', 'henry.taylor@example.com', 'SGVsbG9Xb3JsZCE=', 'Sales', '012-345-6789', 'India', 'Kerala', 'Thiruvananthapuram', '1989-04-12', '2019-10-25', '707 Ash St, Detroit, MI', '2025-02-22 06:41:05', 65000.00),
(11, 'Isabella', 'Moore', 'isabella.moore@example.com', 'SGVsbG9Xb3JsZCE=', 'IT', '123-456-7890', 'India', 'Punjab', 'Chandigarh', '1994-08-08', '2023-02-14', '808 Oak St, Columbus, OH', '2025-02-22 06:41:05', 65000.00),
(12, 'Jack', 'Anderson', 'jack.anderson@example.com', 'SGVsbG9Xb3JsZCE=', 'HR', '234-567-8901', 'India', 'Haryana', 'Gurgaon', '1986-01-30', '2022-06-10', '909 Pine St, Philadelphia, PA', '2025-02-22 06:41:05', 65000.00),
(13, 'Karen', 'Thomas', 'karen.thomas@example.com', 'SGVsbG9Xb3JsZCE=', 'Finance', '345-678-9012', 'India', 'Bihar', 'Patna', '1990-07-22', '2021-03-05', '1010 Maple St, Charlotte, NC', '2025-02-22 06:41:05', 65000.00),
(14, 'Liam', 'Jackson', 'liam.jackson@example.com', 'SGVsbG9Xb3JsZCE=', 'Marketing', '456-789-0123', 'India', 'Odisha', 'Bhubaneswar', '1983-10-15', '2020-09-12', '1111 Cedar St, Richmond, VA', '2025-02-22 06:41:05', 65000.00),
(15, 'Mia', 'White', 'mia.white@example.com', 'SGVsbG9Xb3JsZCE=', 'Sales', '567-890-1234', 'India', 'Madhya Pradesh', 'Bhopal', '1996-12-03', '2019-11-20', '1212 Birch St, Boston, MA', '2025-02-22 06:41:05', 65000.00),
(16, 'Noah', 'Harris', 'noah.harris@example.com', 'SGVsbG9Xb3JsZCE=', 'IT', '678-901-2345', 'India', 'Andhra Pradesh', 'Visakhapatnam', '1982-05-28', '2018-07-15', '1313 Walnut St, Portland, OR', '2025-02-22 06:41:05', 65000.00),
(17, 'Olivia', 'Clark', 'olivia.clark@example.com', 'SGVsbG9Xb3JsZCE=', 'HR', '789-012-3456', 'India', 'Assam', 'Guwahati', '1997-03-17', '2022-04-22', '1414 Cherry St, Las Vegas, NV', '2025-02-22 06:41:05', 65000.00),
(18, 'Peter', 'Lewis', 'peter.lewis@example.com', 'SGVsbG9Xb3JsZCE=', 'Finance', '890-123-4567', 'India', 'Jharkhand', 'Ranchi', '1981-09-10', '2021-08-30', '1515 Ash St, Salt Lake City, UT', '2025-02-22 06:41:05', 65000.00),
(19, 'Quinn', 'Walker', 'quinn.walker@example.com', 'SGVsbG9Xb3JsZCE=', 'Marketing', '901-234-5678', 'India', 'Chhattisgarh', 'Raipur', '1998-06-25', '2020-12-05', '1616 Oak St, Nashville, TN', '2025-02-22 06:41:05', 65000.00),
(20, 'Rachel', 'Hall', 'rachel.hall@example.com', 'SGVsbG9Xb3JsZCE=', 'Sales', '012-345-6789', 'India', 'Uttarakhand', 'Dehradun', '1980-04-18', '2019-02-10', '1717 Pine St, Indianapolis, IN', '2025-02-22 06:41:05', 65000.00);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_balances`
--

CREATE TABLE `employee_leave_balances` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL,
  `leave_id` int NOT NULL,
  `allocated_days` int NOT NULL,
  `used_days` int DEFAULT '0',
  `remaining_days` int GENERATED ALWAYS AS ((`allocated_days` - `used_days`)) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leave_id` int NOT NULL,
  `leave_name` varchar(50) NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `default_days` int DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`leave_id`, `leave_name`, `is_paid`, `default_days`, `description`) VALUES
(1, 'Annual Leave', 1, 20, 'Paid time off for vacation or personal rest.'),
(2, 'Sick Leave', 1, 10, 'Paid leave for illness or medical appointments.'),
(3, 'Maternity Leave', 1, 84, 'Paid leave for pregnant employees (12 weeks).'),
(4, 'Paternity Leave', 1, 14, 'Paid leave for new fathers (2 weeks).'),
(7, 'Unpaid Leave', 0, NULL, 'Unpaid leave for extended personal reasons.');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `leave_Id` int NOT NULL,
  `employee_id` int NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `posting_date` date NOT NULL,
  `STATUS` varchar(20) NOT NULL DEFAULT 'New',
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`leave_Id`, `employee_id`, `leave_type`, `from_date`, `to_date`, `posting_date`, `STATUS`, `id`) VALUES
(1, 1, 'Annual Leave', '2023-10-01', '2023-10-02', '2023-09-25', 'New', 1),
(7, 2, 'Unpaid Leave', '2023-10-05', '2023-10-07', '2023-09-30', 'Approved', 2),
(3, 3, 'Maternity Leave', '2023-10-10', '2023-10-15', '2023-10-01', 'Approved', 3),
(4, 4, 'Paternity Leave', '2023-10-20', '2023-11-20', '2023-10-10', 'New', 4),
(7, 3, 'Unpaid Leave', '2023-11-05', '2023-11-06', '2023-10-30', 'Rejected', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_token`
--

CREATE TABLE `password_token` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  `otp_attempts` int NOT NULL,
  `last_resend` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `password_token`
--

INSERT INTO `password_token` (`id`, `email`, `otp`, `created_at`, `expires_at`, `otp_attempts`, `last_resend`) VALUES
(22, 'durgesh.j.kanzariya@gmail.com', NULL, '2025-04-05 00:54:39', '2025-04-05 00:56:39', 0, '2025-04-04 19:24:43'),
(23, 'john.doe@example.com', NULL, '2025-04-05 01:33:44', '2025-04-05 01:34:44', 0, '2025-04-04 20:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskID` int NOT NULL,
  `Title` varchar(255) NOT NULL,
  `TaskDescription` text,
  `AssignedTo` varchar(255) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `Status` enum('Not Started','In Progress','Completed') DEFAULT 'Not Started',
  `employee_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskID`, `Title`, `TaskDescription`, `AssignedTo`, `StartTime`, `EndTime`, `Status`, `employee_id`) VALUES
(113, 'Durgesh demo', 'durgesh demo', 'Jane Smith', '2005-11-13 00:00:00', '2005-11-15 00:00:00', 'Completed', 2),
(114, 'Durgesh demo dwadawda', 'awdawdawdaw', 'Jane Smith', '2005-11-14 00:00:00', '2005-11-16 00:00:00', 'Completed', 2),
(115, 'Durgesh ', 'wadwadawdaw', 'Jane Smith', '3212-12-12 00:00:00', '3231-12-31 00:00:00', 'Completed', 2),
(117, 'adwdawd', '11212e1 dqdwdqwdqw', 'Jane Smith', '1111-11-21 00:00:00', '1111-11-25 00:00:00', 'Completed', 2);

--
-- Triggers `tasks`
--
DELIMITER $$
CREATE TRIGGER `update_assigned_to` BEFORE INSERT ON `tasks` FOR EACH ROW BEGIN
    DECLARE emp_name VARCHAR(255);
    SELECT CONCAT(firstname, ' ', lastname) INTO emp_name FROM `employee` WHERE id = NEW.employee_id;
    SET NEW.AssignedTo = emp_name;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `task_completion_requests`
--

CREATE TABLE `task_completion_requests` (
  `RequestID` int NOT NULL,
  `TaskID` int DEFAULT NULL,
  `EmployeeID` int DEFAULT NULL,
  `RequestTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `RequestDescription` text,
  `Status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task_completion_requests`
--

INSERT INTO `task_completion_requests` (`RequestID`, `TaskID`, `EmployeeID`, `RequestTime`, `RequestDescription`, `Status`) VALUES
(39, 113, 2, '2025-04-06 11:57:48', '', 'Approved'),
(40, 114, 2, '2025-04-06 11:58:29', '', 'Approved'),
(41, 115, 2, '2025-04-06 12:01:09', '', 'Approved'),
(42, 117, 2, '2025-04-06 15:44:06', '', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_request`
--
ALTER TABLE `contact_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employee_leave_balances`
--
ALTER TABLE `employee_leave_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `leave_id` (`leave_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_leave` (`leave_Id`),
  ADD KEY `fk_employee_id` (`employee_id`);

--
-- Indexes for table `password_token`
--
ALTER TABLE `password_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `task_completion_requests`
--
ALTER TABLE `task_completion_requests`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `TaskID` (`TaskID`),
  ADD KEY `task_completion_requests_ibfk_2` (`EmployeeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_request`
--
ALTER TABLE `contact_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee_leave_balances`
--
ALTER TABLE `employee_leave_balances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leave_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `password_token`
--
ALTER TABLE `password_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `TaskID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `task_completion_requests`
--
ALTER TABLE `task_completion_requests`
  MODIFY `RequestID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_leave_balances`
--
ALTER TABLE `employee_leave_balances`
  ADD CONSTRAINT `employee_leave_balances_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `employee_leave_balances_ibfk_2` FOREIGN KEY (`leave_id`) REFERENCES `leaves` (`leave_id`);

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_leave` FOREIGN KEY (`leave_Id`) REFERENCES `leaves` (`leave_id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_completion_requests`
--
ALTER TABLE `task_completion_requests`
  ADD CONSTRAINT `task_completion_requests_ibfk_1` FOREIGN KEY (`TaskID`) REFERENCES `tasks` (`TaskID`),
  ADD CONSTRAINT `task_completion_requests_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
