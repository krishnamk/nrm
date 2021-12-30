-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 30, 2021 at 05:53 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u932150149_sriram_nrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_location` varchar(200) NOT NULL,
  `company_gst` varchar(30) NOT NULL,
  `company_email` varchar(200) NOT NULL,
  `company_phone` varchar(50) NOT NULL,
  `company_contact_no` varchar(200) NOT NULL,
  `company_address1` varchar(200) NOT NULL,
  `company_address2` varchar(200) NOT NULL,
  `company_city` varchar(200) NOT NULL,
  `company_state` varchar(50) NOT NULL,
  `company_pincode` varchar(30) NOT NULL,
  `company_bank_name` varchar(50) NOT NULL,
  `company_account_name` varchar(100) NOT NULL,
  `company_ifsc_code` varchar(50) NOT NULL,
  `company_account_number` varchar(50) NOT NULL,
  `purchase_dc_prefix_value` varchar(50) NOT NULL,
  `purchase_dc_prefix_count` varchar(50) NOT NULL,
  `dc_prefix_value` varchar(50) NOT NULL,
  `dc_prefix_count` varchar(50) NOT NULL,
  `invoice_prefix_value` varchar(50) NOT NULL,
  `invoice_prefix_count` varchar(50) NOT NULL,
  `estimate_prefix_value` varchar(50) NOT NULL,
  `estimate_prefix_count` varchar(50) NOT NULL,
  `expense_prefix_value` varchar(50) NOT NULL,
  `expense_prefix_count` varchar(50) NOT NULL,
  `purchase_prefix_value` varchar(50) NOT NULL,
  `purchase_prefix_count` varchar(50) NOT NULL,
  `dcreturn_prefix_value` varchar(50) NOT NULL,
  `dcreturn_prefix_count` varchar(50) NOT NULL,
  `payment_prefix_value` varchar(50) NOT NULL,
  `payment_prefix_count` varchar(50) NOT NULL,
  `quotation_prefix_value` varchar(50) NOT NULL,
  `quotation_prefix_count` varchar(50) NOT NULL,
  `purchase_return_prefix_value` varchar(50) NOT NULL,
  `purchase_return_prefix_count` varchar(50) NOT NULL,
  `sales_return_prefix_value` varchar(50) NOT NULL,
  `sales_return_prefix_count` varchar(50) NOT NULL,
  `purchase_order_prefix_value` varchar(50) NOT NULL,
  `purchase_order_prefix_count` varchar(50) NOT NULL,
  `sales_receipt_prefix_value` varchar(255) NOT NULL,
  `sales_receipt_prefix_count` varchar(255) NOT NULL,
  `purchase_payment_prefix_value` varchar(255) NOT NULL,
  `purchase_payment_prefix_count` varchar(255) NOT NULL,
  `journal_prefix_value` varchar(255) NOT NULL,
  `journal_prefix_count` varchar(255) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `company_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`company_id`, `company_name`, `company_location`, `company_gst`, `company_email`, `company_phone`, `company_contact_no`, `company_address1`, `company_address2`, `company_city`, `company_state`, `company_pincode`, `company_bank_name`, `company_account_name`, `company_ifsc_code`, `company_account_number`, `purchase_dc_prefix_value`, `purchase_dc_prefix_count`, `dc_prefix_value`, `dc_prefix_count`, `invoice_prefix_value`, `invoice_prefix_count`, `estimate_prefix_value`, `estimate_prefix_count`, `expense_prefix_value`, `expense_prefix_count`, `purchase_prefix_value`, `purchase_prefix_count`, `dcreturn_prefix_value`, `dcreturn_prefix_count`, `payment_prefix_value`, `payment_prefix_count`, `quotation_prefix_value`, `quotation_prefix_count`, `purchase_return_prefix_value`, `purchase_return_prefix_count`, `sales_return_prefix_value`, `sales_return_prefix_count`, `purchase_order_prefix_value`, `purchase_order_prefix_count`, `sales_receipt_prefix_value`, `sales_receipt_prefix_count`, `purchase_payment_prefix_value`, `purchase_payment_prefix_count`, `journal_prefix_value`, `journal_prefix_count`, `created_on`, `created_by`, `updated_on`, `updated_by`, `company_status`) VALUES
(1, 'NRM KNITTEX ', 'Tirupur', '33AXSPM0407G1ZM', 'info@pinkgirlss.com', '96885 14649', '96885 14649', '3/186, E6, Chinniya Gounden Pudur', 'Cheren Avenue, Andipalalayam (PO)', 'Tirupur', '33', '641687', 'Karur Vysya Bank', 'NRM KNITTEX', 'KVBL0001809', '1809135000007290', 'NRM/PUR_DC/21-22/', '1', 'NRM/DC/21-22/', '5', 'NRM/INV/21-22/', '3', 'NRM/ES/21-22/', '3', 'NRM/EXP/21-22/', '1', 'NRM/PUR/21-22/', '2', 'NRM/DC_RET/21-22/', '1', '', '', 'NRM/QT/21-22/', '1', 'NRM/PUR_RET/21-22/', '1', 'NRM/SAL_RET/21-22/', '1', 'CNT/PO/21-22/', '1', 'NRM/RCP/21-22/', '4', 'NRM/PAY/21-22/', '3', 'NRM/JR/21-22/', '1', '2021-06-10 13:36:09', 1, '2021-12-14 05:08:31', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_access_levels`
--

CREATE TABLE `mst_access_levels` (
  `access_level_id` int(11) NOT NULL,
  `access_level_name` varchar(255) NOT NULL,
  `modules` varchar(255) NOT NULL,
  `submodules` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `removed_on` datetime NOT NULL,
  `removed_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_access_levels`
--

INSERT INTO `mst_access_levels` (`access_level_id`, `access_level_name`, `modules`, `submodules`, `created_on`, `created_by`, `updated_on`, `updated_by`, `removed_on`, `removed_by`, `status`) VALUES
(1, 'SUPER ADMIN', '1,7,8,9,10', '1,2,3,4,5,10,11,12,13,14,16,17,43,44,18,19,20,48,49,21,27,28,29,30,31,32,33,34,35,36,37,38,39,40,22,23,24,25,26,41,42,45,46,47,50', '2021-09-23 11:30:51', 19, '2021-10-08 12:33:26', 1, '0000-00-00 00:00:00', 0, 1),
(2, 'ADMIN', '1,2,3,4,5,7,8,9', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,16,17,21,27,28,29,30,31,32,33,34,35,36,37,38,39,40,22,23,25', '2021-09-21 14:43:22', 7, '2021-12-14 05:09:26', 1, '0000-00-00 00:00:00', 0, 1),
(3, 'USER', '1,2,3,4,6', '1,2,3,4,6,7,8,10,11,12,18,19', '2021-09-22 10:09:10', 7, '2021-09-23 11:44:02', 19, '0000-00-00 00:00:00', 0, 1),
(4, 'SALES ', '1,3', '1,2,3,4,5,10,15,16', '2021-09-23 11:33:06', 19, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(5, 'PURCHASE ', '2,4', '6,7,8,9,11,12,13', '2021-09-23 11:40:01', 19, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(6, 'STOCK ADMIN', '4', '1,2,3,4,5,7,8,9,51,10,11,12,13,14,16,17,43,44,18,19,20,48,49,27,28,29,30,31,32,33,34,35,36,37,38,39,40,22,23,24,25,26,41,42,45,46,47,50', '2021-10-08 12:00:53', 1, '2021-10-08 12:35:06', 1, '0000-00-00 00:00:00', 0, 1),
(7, 'GENERAL ADMIN', '1,2,3,4,5,7,9', '4,7,10,11,12,13,14,16,17,43,44,21,23,24', '2021-10-08 12:54:15', 1, '2021-10-08 13:37:04', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_access_names`
--

CREATE TABLE `mst_access_names` (
  `access_name_id` bigint(20) NOT NULL,
  `access_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_access_names`
--

INSERT INTO `mst_access_names` (`access_name_id`, `access_name`, `status`) VALUES
(1, 'SUPER ADMIN', 1),
(2, 'ADMIN', 1),
(3, 'USER', 1),
(4, 'STAFF', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_branches`
--

CREATE TABLE `mst_branches` (
  `branch_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `branch_location` varchar(200) NOT NULL,
  `branch_gst` varchar(30) NOT NULL,
  `branch_email` varchar(200) NOT NULL,
  `branch_phone` varchar(50) NOT NULL,
  `branch_contact_no` varchar(200) NOT NULL,
  `branch_address1` varchar(200) NOT NULL,
  `branch_address2` varchar(200) NOT NULL,
  `branch_city` varchar(200) NOT NULL,
  `branch_state` varchar(50) NOT NULL,
  `branch_pincode` varchar(30) NOT NULL,
  `branch_bank_name` varchar(50) NOT NULL,
  `branch_account_name` varchar(100) NOT NULL,
  `branch_ifsc_code` varchar(50) NOT NULL,
  `branch_account_number` varchar(50) NOT NULL,
  `purchase_dc_prefix_value` varchar(50) NOT NULL,
  `purchase_dc_prefix_count` varchar(50) NOT NULL,
  `dc_prefix_value` varchar(50) NOT NULL,
  `dc_prefix_count` varchar(50) NOT NULL,
  `invoice_prefix_value` varchar(50) NOT NULL,
  `invoice_prefix_count` varchar(50) NOT NULL,
  `estimate_prefix_value` varchar(50) NOT NULL,
  `estimate_prefix_count` varchar(50) NOT NULL,
  `expense_prefix_value` varchar(50) NOT NULL,
  `expense_prefix_count` varchar(50) NOT NULL,
  `purchase_prefix_value` varchar(50) NOT NULL,
  `purchase_prefix_count` varchar(50) NOT NULL,
  `dcreturn_prefix_value` varchar(50) NOT NULL,
  `dcreturn_prefix_count` varchar(50) NOT NULL,
  `payment_prefix_value` varchar(50) NOT NULL,
  `payment_prefix_count` varchar(50) NOT NULL,
  `quotation_prefix_value` varchar(50) NOT NULL,
  `quotation_prefix_count` varchar(50) NOT NULL,
  `purchase_return_prefix_value` varchar(50) NOT NULL,
  `purchase_return_prefix_count` varchar(50) NOT NULL,
  `sales_return_prefix_value` varchar(50) NOT NULL,
  `sales_return_prefix_count` varchar(50) NOT NULL,
  `purchase_order_prefix_value` varchar(50) NOT NULL,
  `purchase_order_prefix_count` varchar(50) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `branch_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_branches`
--

INSERT INTO `mst_branches` (`branch_id`, `company_id`, `branch_name`, `branch_location`, `branch_gst`, `branch_email`, `branch_phone`, `branch_contact_no`, `branch_address1`, `branch_address2`, `branch_city`, `branch_state`, `branch_pincode`, `branch_bank_name`, `branch_account_name`, `branch_ifsc_code`, `branch_account_number`, `purchase_dc_prefix_value`, `purchase_dc_prefix_count`, `dc_prefix_value`, `dc_prefix_count`, `invoice_prefix_value`, `invoice_prefix_count`, `estimate_prefix_value`, `estimate_prefix_count`, `expense_prefix_value`, `expense_prefix_count`, `purchase_prefix_value`, `purchase_prefix_count`, `dcreturn_prefix_value`, `dcreturn_prefix_count`, `payment_prefix_value`, `payment_prefix_count`, `quotation_prefix_value`, `quotation_prefix_count`, `purchase_return_prefix_value`, `purchase_return_prefix_count`, `sales_return_prefix_value`, `sales_return_prefix_count`, `purchase_order_prefix_value`, `purchase_order_prefix_count`, `created_on`, `created_by`, `updated_on`, `updated_by`, `branch_status`) VALUES
(1, 1, 'CTRLNEXT TECHNOLOGIES', 'Goundampalayam', '24AAACC4175D1Z4', 'ctrlnext@gmail.com', '9633547854', '5478547547', 'Goundampalayam', 'Tripur', 'cbe', '33', '641027', 'Indian Bank', 'ctrlnext technologies', 'IDIB0025', '6410254', 'CN/PUR_DC/21-22/', '1', 'CN/DC/21-22/', '2', 'CN/INV/21-22/', '2', 'CN/ES/21-22/', '1', 'CN/EXP/21-22/', '1', 'CN/PUR/21-22/', '2', '', '', '', '', 'CN/QT/21-22/', '2', 'CN/PUR_RET/21-22/', '1', '', '', 'CN/PO/21-22/', '1', '2021-06-10 13:14:18', 1, '2021-07-15 08:49:55', 1, 0),
(2, 2, 'CTRLNEXT TECH', 'KCT Tech', '24AAACC4175D1Z7', 'jimails2@gmail.com', '9547125475', '7541236254', 'Saravanampatty', 'Tpr', 'Cbe', '33', '641025', 'Canara Bank', 'Ctrlnect Tech', 'CNA0012', '7754875', 'CNT/PUR_DC/21-22/', '1', 'CNT/DC/21-22/', '1', 'CNT/INV/21-22/', '1', 'CNT/ES/21-22/', '1', 'CNT/EXP/21-22/', '1', 'CNT/PUR/21-22/', '1', '', '', '', '', 'CNT/QT/21-22/', '1', 'CNT/PUR_RET/21-22/', '1', '', '', 'CNT/PO/21-22/', '1', '2021-06-10 13:36:09', 1, '2021-07-15 08:50:33', 1, 0),
(3, 1, 'CTRLNEXT SOFTWARE ', 'Ooty', '', '', '', '', '', '', 'Ooty', '33', '641001', 'IOB', 'Ctrlnect Tech', 'CNA0012', '', '', '1', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2021-09-16 13:37:45', 2, '2021-09-16 13:47:54', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_brands`
--

CREATE TABLE `mst_brands` (
  `brand_id` bigint(20) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_brands`
--

INSERT INTO `mst_brands` (`brand_id`, `brand_name`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'test_brand', '2021-03-04 18:07:50', 1, '2021-10-26 11:22:54', 1, 0),
(2, 'test_brand1', '2021-04-28 00:00:00', 1, '2021-10-26 11:23:00', 1, 0),
(3, 'NEEM PLY', '2021-10-26 10:13:31', 1, '2021-12-13 09:40:44', 7, 0),
(4, 'PRISTEGE GOLD', '2021-10-26 10:13:56', 1, '2021-12-13 09:40:35', 7, 0),
(5, '9T6', '2021-12-13 09:40:54', 7, '0000-00-00 00:00:00', 0, 1),
(6, 'JOYBUDS', '2021-12-13 10:20:26', 7, '0000-00-00 00:00:00', 0, 1),
(7, 'PINKY GIRLSS', '2021-12-13 10:21:24', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_category`
--

CREATE TABLE `mst_category` (
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_category`
--

INSERT INTO `mst_category` (`category_id`, `brand_id`, `category_name`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 'test_category', '2021-03-04 18:09:03', 1, '2021-09-09 06:35:48', 1, 0),
(2, 1, 'Accessories Category', '2021-10-07 11:15:02', 1, '2021-12-13 10:22:01', 7, 0),
(3, 5, 'R/N Allover', '2021-12-13 10:21:57', 7, '0000-00-00 00:00:00', 0, 1),
(4, 5, 'R/N Logo Print', '2021-12-13 10:22:20', 7, '0000-00-00 00:00:00', 0, 1),
(5, 5, 'R/N Cutton\'s', '2021-12-13 10:22:39', 7, '0000-00-00 00:00:00', 0, 1),
(6, 6, 'Age Group', '2021-12-13 10:25:25', 7, '0000-00-00 00:00:00', 0, 1),
(7, 6, 'Set Item', '2021-12-13 10:25:39', 7, '0000-00-00 00:00:00', 0, 1),
(8, 0, 'Yarn', '2021-12-16 05:46:22', 7, '2021-12-16 05:47:25', 7, 1),
(9, 0, 'Filament Yarn ', '2021-12-16 05:46:48', 7, '2021-12-16 05:47:09', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_colours`
--

CREATE TABLE `mst_colours` (
  `colour_id` bigint(20) NOT NULL,
  `colour_name` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_colours`
--

INSERT INTO `mst_colours` (`colour_id`, `colour_name`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'Blue', '2021-03-04 17:52:26', 1, '0000-00-00 00:00:00', 0, 1),
(2, 'Red', '2021-03-16 12:40:54', 1, '2021-03-26 08:51:06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_customers`
--

CREATE TABLE `mst_customers` (
  `customer_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `customers_mobile` varchar(50) NOT NULL,
  `customer_address1` varchar(200) NOT NULL,
  `customer_address2` varchar(200) NOT NULL,
  `customer_city` varchar(100) NOT NULL,
  `customer_state` varchar(20) NOT NULL,
  `customer_pincode` varchar(20) NOT NULL,
  `customer_gst` varchar(50) NOT NULL,
  `customer_opening_balance` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_customers`
--

INSERT INTO `mst_customers` (`customer_id`, `company_id`, `branch_id`, `customer_name`, `customer_email`, `customer_phone`, `customers_mobile`, `customer_address1`, `customer_address2`, `customer_city`, `customer_state`, `customer_pincode`, `customer_gst`, `customer_opening_balance`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 4, 0, 'Dinesh', 'developer@rbslabs.in', '8885472154', '9655585447', 'jeevandha colony', 'Ganapathy', 'coimbatore', '33', '641027', '19ABGFS2044B1ZH', '1500000', '2021-03-12 08:49:31', 1, '2021-12-13 09:35:08', 7, 0),
(2, 1, 0, 'Mohan Raj', 'mohan@gmail.com', '9944155498', '9944155498', 'cbe', 'cbe', 'cbe', '33', '641028', '', '38450', '2021-07-15 08:58:06', 1, '2021-12-13 09:35:05', 7, 0),
(3, 5, 0, 'Muthu', 'muthu@gmail.com', '9876778987', '8567563434', 'cbe', 'cbe', 'cbe', '33', '641028', '', '', '2021-07-15 08:58:39', 1, '2021-12-13 09:35:02', 7, 0),
(4, 5, 0, 'Kannan', 'kanna@gmail.com', '9856232541', '7548215632', 'cbe', 'cbe', 'cbe', '33', '641028', '', '', '2021-07-15 08:59:12', 1, '2021-12-13 09:34:59', 7, 0),
(5, 1, 0, 'FOUR SQUARE', '', '', '', '265/1 B UPPLIANGADU THOTTAM, GOUNDAMPALAYAM, ', 'PERUNTHOLUVU POST', 'TIRUPUR', '33', '641665', '33APHPR0851E2Z3', '', '2021-10-26 10:20:51', 1, '2021-12-13 09:34:56', 7, 0),
(6, 1, 0, 'Guruprasath', 'prasath@gmail.com', '6380019005', '', '110, SV Colony', 'Angeripalayam Road', 'Tirupur', '33', '641602', '', '1017480', '2021-11-09 13:03:27', 1, '2021-12-13 09:34:53', 7, 0),
(7, 1, 0, 'APOORVA TEX', '', '9952407474', '', '163/42 , Mangalam Road,Karuvampalyam ', '', 'Tirupur', '33', '', '33ABPFA2905G1ZO', '', '2021-12-13 09:36:43', 7, '2021-12-13 09:39:17', 7, 1),
(8, 1, 0, 'SRI RAM TEX', '', '9443549572', '', '3/106, Chinniya gounden pudur , andipalayam PO', '', 'Tirupur', '33', '641687', '33ABPFA2905G1ZOllllllllll', '', '2021-12-15 04:28:16', 7, '2021-12-27 13:18:08', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_customer_type`
--

CREATE TABLE `mst_customer_type` (
  `customer_type_id` bigint(20) NOT NULL,
  `customer_type` varchar(200) NOT NULL,
  `customer_type_name` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_customer_type`
--

INSERT INTO `mst_customer_type` (`customer_type_id`, `customer_type`, `customer_type_name`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'invoice', 'Invoice Payments', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(2, 'estimate', 'Estimate Payments', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_estimate_settings`
--

CREATE TABLE `mst_estimate_settings` (
  `estimate_settings_id` int(11) NOT NULL,
  `estimate_settings_name` varchar(255) NOT NULL,
  `settings_name` varchar(255) NOT NULL,
  `estimate_settings_value` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_estimate_settings`
--

INSERT INTO `mst_estimate_settings` (`estimate_settings_id`, `estimate_settings_name`, `settings_name`, `estimate_settings_value`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'estimate_dc_generate', 'Estimate Dc Generate', 0, '2021-09-28 11:34:53', 0, 1),
(2, 'estimate_dc_auto_generate', 'Estimate Dc Auto Generate', 0, '2021-09-28 11:37:44', 0, 1),
(3, 'multiple_estimate_to_dc_generate', 'Multiple Estimate to Dc ', 0, '2021-09-28 11:42:42', 0, 0),
(4, 'multiple_dc_to_estimate_generate', 'Multiple Dc to Estimate', 1, '2021-09-28 11:50:54', 0, 1),
(5, 'estimate_stock_reduce', 'Estimate Stock Reduce', 1, '2021-09-28 11:57:23', 0, 1),
(6, 'estimate_tax_included', 'Estimate Tax Included', 0, '2021-09-28 12:03:18', 0, 1),
(7, 'estimate_cash_discount', 'Estimate Cash Discount', 0, '2021-09-28 12:20:27', 0, 1),
(8, 'estimate_productwise_discount', 'Estimate Productwise Discount', 0, '2021-09-28 12:29:24', 0, 1),
(9, 'estimate_overall_discount', 'Estimate Overall Discount', 1, '2021-09-28 12:48:57', 0, 1),
(10, 'estimate_discount', 'Estimate Discount', 1, '2021-09-28 12:54:20', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_expense_categories`
--

CREATE TABLE `mst_expense_categories` (
  `expense_category_id` int(11) NOT NULL,
  `expense_category` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_expense_categories`
--

INSERT INTO `mst_expense_categories` (`expense_category_id`, `expense_category`, `created_on`, `created_by`, `updated_on`, `status`) VALUES
(1, 'Travelling Expense', '2021-03-17 05:37:10', 1, '2021-03-26 08:43:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_general_settings`
--

CREATE TABLE `mst_general_settings` (
  `general_settings_id` int(11) NOT NULL,
  `general_settings_name` varchar(255) NOT NULL,
  `settings_name` varchar(255) NOT NULL,
  `general_settings_value` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_general_settings`
--

INSERT INTO `mst_general_settings` (`general_settings_id`, `general_settings_name`, `settings_name`, `general_settings_value`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'single_company', 'Single Company', 1, '2021-09-27 12:43:51', 0, 1),
(2, 'multiple_company', 'Multiple Company', 0, '2021-09-27 12:43:51', 0, 1),
(4, 'other_expenses', 'Other Expenses', 1, '2021-09-27 12:43:51', 0, 1),
(5, 'loading_unloading_charges', 'Loading Charges', 0, '2021-09-27 12:43:51', 0, 1),
(6, 'transport_charges', 'Transport Charges', 1, '2021-09-27 12:43:51', 0, 1),
(7, 'gst_number', 'GST Number', 1, '2021-09-27 12:43:51', 0, 1),
(9, 'multiple_branch', 'Multiple Branch', 0, '2021-09-27 12:43:51', 0, 1),
(10, 'bundle', 'bundle', 1, '0000-00-00 00:00:00', 0, 1),
(11, 'date_of_supply', 'supply date & place', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_invoice_settings`
--

CREATE TABLE `mst_invoice_settings` (
  `invoice_settings_id` int(11) NOT NULL,
  `invoice_settings_name` varchar(255) NOT NULL,
  `settings_name` varchar(255) NOT NULL,
  `invoice_settings_value` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_invoice_settings`
--

INSERT INTO `mst_invoice_settings` (`invoice_settings_id`, `invoice_settings_name`, `settings_name`, `invoice_settings_value`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'multiple_dc_to_invoice_generate', 'Multiple Dc to Invoice', 1, '2021-09-28 07:52:06', 0, 1),
(5, 'invoice_dc_auto_generate', 'Invoice Dc Auto Generate', 0, '2021-09-28 07:52:06', 0, 1),
(6, 'invoice_dc_generate', 'Invoice Dc Generate', 0, '2021-09-28 07:52:06', 0, 1),
(7, 'invoice_tax_included', 'Invoice Tax Included', 1, '2021-09-28 07:52:06', 0, 1),
(8, 'invoice_stock_reduce', 'Stock Reduce', 1, '2021-09-28 07:52:06', 0, 1),
(9, 'invoice_discount', 'Discount', 1, '2021-09-28 07:52:06', 0, 1),
(11, 'sales_return_invoice_multiple_time_return', 'Sales Return Multiple Time Return', 0, '2021-09-28 07:52:06', 0, 1),
(13, 'invoice_cash_discount', 'Cash Discount', 0, '2021-09-28 07:52:06', 0, 1),
(14, 'invoice_productwise_discount', 'Productwise Discount', 0, '2021-09-28 07:52:06', 0, 1),
(15, 'invoice_overall_discount', 'Overall Discount', 1, '2021-09-28 07:58:08', 0, 1),
(16, 'sales_return_stock_added', 'Sales Return Stock Added', 1, '2021-09-28 07:52:06', 0, 1),
(17, 'sales_person_include', 'Sales Person', 1, '2021-09-28 07:52:06', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_modules`
--

CREATE TABLE `mst_modules` (
  `module_id` bigint(20) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_path` varchar(255) NOT NULL,
  `module_order` int(11) NOT NULL,
  `module_icon` varchar(255) NOT NULL,
  `module_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_modules`
--

INSERT INTO `mst_modules` (`module_id`, `module_name`, `module_path`, `module_order`, `module_icon`, `module_status`) VALUES
(1, 'SALES', '#', 1, 'bx bx-receipt', 1),
(2, 'PURCHASE', '#', 2, 'bx bx-purchase-tag', 1),
(3, 'EXPENSES', '#', 6, 'bx bx-rss', 1),
(4, 'INVENTORY', '#', 3, 'bx bx-briefcase-alt-2', 1),
(5, 'PAYMENTS', '#', 5, 'bx bxl-paypal', 1),
(6, 'REPORTS', '#', 7, 'bx bx-share-alt', 1),
(7, 'LOGS', '#', 8, 'bx bxs-log-in-circle', 1),
(8, 'MASTERS', '#', 9, 'bx bx-store', 1),
(9, 'SETTINGS', '#', 10, 'bx bx-cog', 1),
(10, 'OTHER SETTINGS', '#', 11, 'bx bxs-cog', 1),
(11, 'ACCOUNTS', '#', 4, 'bx bxs-receipt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_prefix`
--

CREATE TABLE `mst_prefix` (
  `prefix_id` int(11) NOT NULL,
  `prefix_heading` varchar(255) NOT NULL,
  `prefix_label` varchar(255) NOT NULL,
  `prefix_name` varchar(255) NOT NULL,
  `prefix_value` varchar(255) NOT NULL,
  `prefix_count` varchar(20) NOT NULL,
  `prefix_created_on` datetime NOT NULL,
  `prefix_updated_on` datetime NOT NULL,
  `prefix_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_products`
--

CREATE TABLE `mst_products` (
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_stylecode` varchar(50) DEFAULT NULL,
  `product_itemcode` varchar(50) DEFAULT NULL,
  `product_hsncode` varchar(50) DEFAULT NULL,
  `product_barcode` varchar(50) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL,
  `product_type_base_value` varchar(30) DEFAULT NULL,
  `product_mrp` varchar(50) DEFAULT NULL,
  `product_selling_price` varchar(50) DEFAULT NULL,
  `product_market_price` varchar(50) DEFAULT NULL,
  `product_purchase_price` varchar(50) DEFAULT NULL,
  `product_opening_stock` varchar(50) NOT NULL,
  `product_unit` int(11) NOT NULL,
  `product_size` int(11) NOT NULL,
  `product_colour` int(11) NOT NULL,
  `product_brand` int(11) DEFAULT NULL,
  `product_category` int(11) NOT NULL,
  `product_subcategory` int(11) NOT NULL,
  `product_tax_type` int(11) NOT NULL,
  `product_tax` int(11) DEFAULT NULL,
  `product_secondary_unit` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_products`
--

INSERT INTO `mst_products` (`product_id`, `product_name`, `product_description`, `product_stylecode`, `product_itemcode`, `product_hsncode`, `product_barcode`, `product_type`, `product_type_base_value`, `product_mrp`, `product_selling_price`, `product_market_price`, `product_purchase_price`, `product_opening_stock`, `product_unit`, `product_size`, `product_colour`, `product_brand`, `product_category`, `product_subcategory`, `product_tax_type`, `product_tax`, `product_secondary_unit`, `product_image`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'R/N A/O - M', 'R/N A/O - M', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 3, 0, 5, 3, 0, 0, 3, 0, '', '2021-12-13 10:29:54', 7, '2021-12-22 13:34:13', 1, 1),
(2, 'R/N A/O - L', 'R/N A/O - L', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 4, 0, 5, 3, 0, 0, 3, 0, '', '2021-12-13 10:31:31', 7, '2021-12-13 11:08:59', 7, 1),
(3, 'R/N A/O - XL', 'R/N A/O - XL', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 5, 0, 5, 3, 0, 0, 3, 0, '', '2021-12-13 10:31:52', 7, '2021-12-13 11:09:09', 7, 1),
(4, 'R/N A/O - XXL', 'R/N A/O - XXL', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 6, 0, 5, 3, 0, 0, 3, 0, '', '2021-12-13 10:32:13', 7, '2021-12-13 11:09:18', 7, 1),
(5, 'R/N C/U - L', 'R/N Cutton\'s - L', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 4, 0, 5, 5, 0, 0, 3, 0, '', '2021-12-13 11:11:01', 7, '2021-12-13 12:54:09', 7, 1),
(6, 'R/N C/U - XL', 'R/N Cutton\'s - XL', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 5, 0, 5, 5, 0, 0, 3, 0, '', '2021-12-13 11:11:35', 7, '2021-12-13 12:55:29', 7, 1),
(7, 'R/N C/U - XXL', 'R/N Cutton\'s - XXL', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 6, 0, 5, 5, 0, 0, 3, 0, '', '2021-12-13 11:12:03', 7, '2021-12-13 12:55:38', 7, 1),
(8, 'R/N A/O - 2 age', 'R/N A/O - 2 age', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 15, 0, 6, 6, 0, 0, 3, 0, '', '2021-12-15 04:30:14', 7, '2021-12-15 04:31:23', 7, 1),
(9, 'R/N A/O - 4 age', 'R/N A/O - 4 age', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 16, 0, 6, 6, 0, 0, 3, 0, '', '2021-12-15 04:31:14', 7, '0000-00-00 00:00:00', 0, 1),
(10, 'R/N A/O - 6 age', 'R/N A/O - 6 age', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 17, 0, 6, 6, 0, 0, 3, 0, '', '2021-12-15 04:31:52', 7, '0000-00-00 00:00:00', 0, 1),
(11, 'R/N A/O - 8 age', 'R/N A/O - 8 age', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 18, 0, 6, 6, 0, 0, 3, 0, '', '2021-12-15 04:32:16', 7, '0000-00-00 00:00:00', 0, 1),
(12, 'R/N A/O - 10 age', 'R/N A/O - 10 age', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 20, 0, 6, 6, 0, 0, 3, 0, '', '2021-12-15 04:32:52', 7, '0000-00-00 00:00:00', 0, 1),
(13, 'R/N A/O - 12 age', 'R/N A/O - 12 age', NULL, NULL, '61091000', NULL, 4, '1', '', '', '', '', '', 1, 21, 0, 6, 6, 0, 0, 3, 0, '', '2021-12-15 04:33:15', 7, '0000-00-00 00:00:00', 0, 1),
(14, 'Polyester Stitching Yarn', 'Polyester Stitching Yarn', NULL, NULL, '', NULL, 4, '2', '', '', '', '', '', 0, 0, 0, 0, 8, 0, 0, 0, 0, '', '2021-12-16 06:19:52', 7, '2021-12-16 06:22:32', 7, 0),
(15, 'Polyester Color Yarn', 'Polyester Color Yarn', NULL, NULL, '', NULL, 5, '2', '', '', '', '39', '', 3, 0, 0, 0, 8, 0, 0, 0, 0, '', '2021-12-16 06:21:02', 7, '2021-12-22 13:35:05', 1, 1),
(16, 'Flammant Color Yarn ', 'Flammant Color Yarn ', NULL, NULL, '', NULL, 5, '2', '', '', '', '19', '', 3, 0, 0, 0, 8, 0, 0, 0, 0, '', '2021-12-16 06:21:41', 7, '2021-12-22 13:34:52', 1, 1),
(17, 'test', 'test', NULL, NULL, '1111', NULL, 1, '1', '120', '', '', '', '', 1, 3, 1, 5, 3, 0, 0, 2, 0, '', '2021-12-20 12:47:24', 1, '2021-12-20 13:01:46', 1, 0),
(18, 'test 2', 'test 2', NULL, NULL, 'test 2', NULL, 2, '2', '', '', '', '50', '', 1, 18, 2, 0, 8, 0, 0, 3, 0, '', '2021-12-20 12:50:28', 1, '2021-12-20 13:01:52', 1, 0),
(19, 'Poly bags', 'poly bags', NULL, NULL, '1111', NULL, 1, '0', '12', '', '', '', '', 2, 3, 0, 0, 0, 0, 0, 3, 0, '', '2021-12-22 11:32:50', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_product_settings`
--

CREATE TABLE `mst_product_settings` (
  `product_settings_id` int(11) NOT NULL,
  `product_settings_name` varchar(255) NOT NULL,
  `settings_name` varchar(255) NOT NULL,
  `product_settings_value` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_product_settings`
--

INSERT INTO `mst_product_settings` (`product_settings_id`, `product_settings_name`, `settings_name`, `product_settings_value`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'product_stylecode', 'Style Code', 0, '0000-00-00 00:00:00', 0, 1),
(2, 'product_itemcode', 'Item Code', 0, '0000-00-00 00:00:00', 0, 1),
(3, 'product_hsncode', 'Hsn code', 1, '0000-00-00 00:00:00', 0, 1),
(4, 'product_barcode', 'Bar code', 0, '0000-00-00 00:00:00', 0, 1),
(5, 'product_mrp_price', 'MRP Price', 1, '0000-00-00 00:00:00', 0, 1),
(6, 'product_selling_price', 'Selling Price', 1, '0000-00-00 00:00:00', 0, 1),
(7, 'product_market_price', 'Market Price', 1, '0000-00-00 00:00:00', 0, 1),
(8, 'product_purchase_price', 'Purchase Price', 1, '0000-00-00 00:00:00', 0, 1),
(9, 'product_unit', 'Product Unit', 1, '0000-00-00 00:00:00', 0, 1),
(10, 'product_size', 'Product Size', 1, '0000-00-00 00:00:00', 0, 1),
(11, 'product_colour', 'Product Colour', 1, '0000-00-00 00:00:00', 0, 1),
(12, 'product_brand', 'Brand', 1, '0000-00-00 00:00:00', 0, 1),
(13, 'product_category', 'Category', 1, '0000-00-00 00:00:00', 0, 1),
(14, 'product_subcategory', 'Sub Category', 1, '0000-00-00 00:00:00', 0, 1),
(15, 'product_tax', 'Tax', 1, '0000-00-00 00:00:00', 0, 1),
(16, 'product_secondary_unit', 'Secondary Units', 0, '0000-00-00 00:00:00', 0, 1),
(17, 'product_image', 'Image', 0, '0000-00-00 00:00:00', 0, 1),
(18, 'customer_gst', 'Customer GST', 1, '0000-00-00 00:00:00', 0, 1),
(19, 'supplier_gst', 'Supplier GST', 1, '0000-00-00 00:00:00', 0, 1),
(20, 'customer_opening_balance', 'Customer Opening Balance', 1, '0000-00-00 00:00:00', 0, 1),
(21, 'supplier_opening_balance', 'Supplier Opening Balance', 1, '0000-00-00 00:00:00', 0, 1),
(22, 'product_opening_stock', 'Opening Stock', 1, '0000-00-00 00:00:00', 0, 1),
(23, 'product_type', 'Product Type', 1, '0000-00-00 00:00:00', 0, 1),
(24, 'product_filter', 'Product Filter', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_product_type`
--

CREATE TABLE `mst_product_type` (
  `product_type_id` bigint(20) NOT NULL,
  `product_type_name` varchar(200) NOT NULL,
  `product_type_base` varchar(255) NOT NULL,
  `product_type_base_value` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_product_type`
--

INSERT INTO `mst_product_type` (`product_type_id`, `product_type_name`, `product_type_base`, `product_type_base_value`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'Accessories', 'none', 0, '2021-12-21 13:50:00', 1, '2021-12-22 10:06:35', 1, 1),
(2, 'Garments', 'category', 2, '2021-12-21 13:54:25', 1, '2021-12-22 10:32:16', 1, 1),
(3, 'Processing', 'category', 2, '2021-12-21 13:57:12', 1, '2021-12-22 10:06:42', 1, 1),
(4, 'Sales Products', 'brand', 1, '2021-12-21 13:57:30', 1, '2021-12-22 10:06:45', 1, 1),
(5, 'Purchase Products', 'category', 2, '2021-12-21 13:58:01', 1, '2021-12-22 10:06:50', 1, 1),
(6, 'General', 'none', 0, '2021-12-21 14:00:05', 1, '2021-12-22 10:06:54', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_purchase_settings`
--

CREATE TABLE `mst_purchase_settings` (
  `purchase_settings_id` int(11) NOT NULL,
  `purchase_settings_name` varchar(255) NOT NULL,
  `settings_name` varchar(255) NOT NULL,
  `purchase_settings_value` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_purchase_settings`
--

INSERT INTO `mst_purchase_settings` (`purchase_settings_id`, `purchase_settings_name`, `settings_name`, `purchase_settings_value`, `updated_on`, `updated_by`, `status`) VALUES
(3, 'purchase_order_mail_status', 'Purchase Order Mail Send', 1, '2021-09-29 06:47:55', 0, 1),
(4, 'purchase_stock_add', 'Purchase Stock Add', 1, '2021-09-29 06:47:55', 0, 1),
(6, 'purchase_tax_included', 'Purchase Tax Included', 1, '2021-09-29 06:47:55', 0, 1),
(7, 'purchase_return_stock_added', 'Purchase Return Stock Added', 1, '2021-09-29 06:47:55', 0, 1),
(8, 'purchase_dc', 'Purchase DC to Purchase', 0, '2021-09-29 06:47:55', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_quotation_settings`
--

CREATE TABLE `mst_quotation_settings` (
  `quotation_settings_id` int(11) NOT NULL,
  `quotation_settings_name` varchar(255) NOT NULL,
  `settings_name` varchar(255) NOT NULL,
  `quotation_settings_value` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_quotation_settings`
--

INSERT INTO `mst_quotation_settings` (`quotation_settings_id`, `quotation_settings_name`, `settings_name`, `quotation_settings_value`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'quotation_stock_reduce', 'Stock Reduce', 0, '2021-09-28 14:38:17', 0, 1),
(2, 'quotation_tax_included', 'Quotation Tax Included', 0, '2021-09-28 14:38:17', 0, 1),
(3, 'quotation_dc_generate', 'Quotation Dc Generate', 1, '2021-09-28 14:38:17', 0, 1),
(4, 'quotation_dc_auto_generate', 'Dc Auto Generate', 0, '2021-09-28 14:38:17', 0, 1),
(5, 'quotation_dc_manual_generate', 'Dc Manual Generate', 0, '2021-09-28 14:38:17', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_sales_person`
--

CREATE TABLE `mst_sales_person` (
  `sales_person_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sales_person_name` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_sales_person`
--

INSERT INTO `mst_sales_person` (`sales_person_id`, `company_id`, `sales_person_name`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 'DEEPA', '2021-11-11 11:29:50', 1, '0000-00-00 00:00:00', 0, 1),
(2, 1, 'MOHAN', '2021-11-11 11:34:58', 1, '0000-00-00 00:00:00', 0, 1),
(3, 1, 'DINESH', '2021-11-11 11:35:07', 1, '0000-00-00 00:00:00', 0, 1),
(4, 1, 'DINESH', '2021-11-11 11:35:08', 1, '2021-11-11 11:35:13', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_secondary_units`
--

CREATE TABLE `mst_secondary_units` (
  `secondary_unit_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `secondary_unit_name` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_secondary_units`
--

INSERT INTO `mst_secondary_units` (`secondary_unit_id`, `unit_id`, `secondary_unit_name`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 'NO\'S', '0000-00-00 00:00:00', 0, '2021-09-09 09:57:51', 1, 1),
(2, 1, 'NO\'S11', '0000-00-00 00:00:00', 0, '2021-03-26 10:39:39', 1, 1),
(3, 2, 'RMT\'S', '0000-00-00 00:00:00', 0, '2021-09-09 09:57:55', 1, 1),
(4, 2, 'LENGTH', '0000-00-00 00:00:00', 0, '2021-09-09 09:57:59', 1, 1),
(5, 1, 'kg', '2020-12-05 11:13:13', 2, '2021-09-09 09:58:02', 1, 1),
(6, 2, 'ft', '2020-12-05 11:13:27', 2, '2021-09-09 09:58:05', 1, 1),
(7, 1, 'Default', '2021-03-02 16:59:37', 1, '2021-09-09 09:58:07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_settings`
--

CREATE TABLE `mst_settings` (
  `settings_id` int(11) NOT NULL,
  `settings_name` varchar(100) NOT NULL,
  `settings_value` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_settings`
--

INSERT INTO `mst_settings` (`settings_id`, `settings_name`, `settings_value`, `updated_on`, `updated_by`, `status`) VALUES
(12, 'include_bank_details', '0', '2020-05-30 07:08:54', '1', 1),
(13, 'product_common_price', '0', '2020-02-15 11:56:08', '1', 1),
(14, 'product_size_options', '1', '2018-12-28 00:00:00', '1', 1),
(15, 'stock_excel_update', '0', '2020-05-28 11:32:24', '1', 1),
(16, 'allow_qty_morethan_stock', '1', '2019-01-02 00:00:00', '1', 1),
(17, 'tax_type', '2', '2019-01-08 00:00:00', '1', 1),
(18, 'dc_number_of_zeros', '4', '2019-01-11 00:00:00', '1', 1),
(25, 'expense_number_of_zeros', '4', '0000-00-00 00:00:00', '', 1),
(26, 'estimate_tax_type', '2', '2019-01-08 00:00:00', '1', 1),
(29, 'generaldc_number_of_zeros', '4', '2019-04-02 00:00:00', '', 1),
(30, 'price_based_tax', '1', '0000-00-00 00:00:00', '', 1),
(31, 'common_tax_percentage', '5', '0000-00-00 00:00:00', '', 1),
(47, 'product_unit_master', '1', '2021-03-02 15:34:15', '1', 1),
(49, 'product_size_master', '1', '2021-03-02 15:39:12', '1', 1),
(51, 'product_colour_master', '1', '2021-03-02 15:39:12', '1', 1),
(57, 'product_secondary_unit_master', '1', '2021-03-02 15:39:12', '1', 1),
(77, 'inventory_opening_stock', '1', '2021-03-12 16:27:25', '1', 1),
(78, 'inventory_stock_adjustment', '1', '2021-03-12 16:27:25', '1', 1),
(84, 'size_master', '1', '2021-03-12 16:34:56', '1', 1),
(85, 'secondary_unit_master', '1', '2021-03-12 16:34:56', '1', 1),
(86, 'colour_master', '1', '2021-03-12 16:34:56', '1', 1),
(87, 'transport_master', '1', '2021-03-12 16:34:56', '1', 1),
(88, 'brand_master', '1', '2021-03-12 16:34:56', '1', 1),
(89, 'category_master', '1', '2021-03-12 16:34:56', '1', 1),
(90, 'subcategory_master', '1', '2021-03-12 16:34:56', '1', 1),
(91, 'tax_master', '1', '2021-03-12 16:34:56', '1', 1),
(94, 'product_opening_stock', '1', '0000-00-00 00:00:00', '', 1),
(98, 'purchase_tax_type_show', '0', '2021-04-30 00:00:00', '1', 1),
(99, 'purchase_tax_type', '2', '2021-04-30 00:00:00', '1', 1),
(107, 'quotation_number_of_zeros', '4', '2019-01-11 00:00:00', '1', 1),
(114, 'estimate_number_of_zeros', '4', '2021-07-23 14:59:10', '1', 1),
(119, 'invoice_number_of_zeros', '4', '2021-07-23 14:59:10', '1', 1),
(134, 'invoice_tax_type', '2', '2021-04-30 00:00:00', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_sizes`
--

CREATE TABLE `mst_sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(50) NOT NULL,
  `size_order` int(11) NOT NULL,
  `size_price` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_sizes`
--

INSERT INTO `mst_sizes` (`size_id`, `size_name`, `size_order`, `size_price`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'XS', 1, '', '2021-03-02 16:38:06', 1, '2021-12-13 10:17:54', 7, 0),
(2, 'S', 2, '', '2021-03-02 16:38:06', 1, '2021-12-13 10:17:51', 7, 0),
(3, 'M', 3, '', '2021-03-02 16:38:06', 1, '0000-00-00 00:00:00', 0, 1),
(4, 'L', 4, '', '2021-03-02 16:38:06', 1, '0000-00-00 00:00:00', 0, 1),
(5, 'XL', 5, '', '2021-03-02 16:38:06', 1, '0000-00-00 00:00:00', 0, 1),
(6, 'XXL', 6, '', '2021-03-02 16:38:06', 1, '0000-00-00 00:00:00', 0, 1),
(7, 'XXXL', 7, '', '2021-03-02 16:38:06', 1, '2021-12-13 10:17:46', 7, 0),
(8, '2XL', 8, '', '2021-03-02 16:38:06', 1, '2021-12-13 10:17:43', 7, 0),
(9, '3XL', 9, '', '2021-03-02 16:38:06', 1, '2021-12-13 10:17:39', 7, 0),
(10, '4XL', 10, '', '2021-03-16 11:34:39', 1, '2021-12-13 10:17:26', 7, 0),
(13, 'M(12-18 Months)', 0, '', '2021-10-05 15:01:14', 1, '2021-12-13 10:17:31', 7, 0),
(14, 'L(18-24 Months)', 0, '', '2021-10-05 15:01:15', 1, '2021-12-13 10:17:35', 7, 0),
(15, '2 age', 0, '', '2021-12-13 10:18:17', 7, '0000-00-00 00:00:00', 0, 1),
(16, '4 age', 0, '', '2021-12-13 10:18:25', 7, '0000-00-00 00:00:00', 0, 1),
(17, '6 age', 0, '', '2021-12-13 10:18:32', 7, '0000-00-00 00:00:00', 0, 1),
(18, '8 age', 0, '', '2021-12-13 10:18:39', 7, '0000-00-00 00:00:00', 0, 1),
(19, '12 age', 0, '', '2021-12-13 10:18:48', 7, '2021-12-13 10:18:58', 7, 0),
(20, '10 age', 0, '', '2021-12-13 10:19:38', 7, '0000-00-00 00:00:00', 0, 1),
(21, '12 age', 0, '', '2021-12-13 10:19:45', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_state`
--

CREATE TABLE `mst_state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(500) NOT NULL,
  `state_initial` varchar(500) NOT NULL,
  `state_code` varchar(500) NOT NULL,
  `state_type` varchar(5000) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_state`
--

INSERT INTO `mst_state` (`state_id`, `state_name`, `state_initial`, `state_code`, `state_type`, `added_date`) VALUES
(1, 'Andhra Pradesh', 'AP', '28', 'STATE', '0000-00-00 00:00:00'),
(2, 'Andaman and Nicobar Islands', 'AN', '35', 'UT', '0000-00-00 00:00:00'),
(3, 'Arunachal Pradesh', 'AR', '12', 'STATE', '0000-00-00 00:00:00'),
(4, 'Assam', 'AS', '18', 'STATE', '0000-00-00 00:00:00'),
(5, 'Bihar', 'BR', '10', 'STATE', '0000-00-00 00:00:00'),
(6, 'Chandigarh', 'CH', '4', 'UT', '0000-00-00 00:00:00'),
(7, 'Chhattisgarh', 'CG', '22', 'STATE', '0000-00-00 00:00:00'),
(8, 'Dadar and Nagar Haveli', 'DH', '26', 'UT', '0000-00-00 00:00:00'),
(9, 'Daman and Diu', 'DD', '25', 'UT', '0000-00-00 00:00:00'),
(10, 'Delhi', 'DL', '7', 'UT', '0000-00-00 00:00:00'),
(11, 'Goa', 'GA', '30', 'STATE', '0000-00-00 00:00:00'),
(12, 'Gujarat', 'GJ', '24', 'STATE', '0000-00-00 00:00:00'),
(13, 'Haryana', 'HR', '6', 'STATE', '0000-00-00 00:00:00'),
(14, 'Himachal Pradesh', 'HP', '2', 'STATE', '0000-00-00 00:00:00'),
(15, 'Jammu and Kashmir', 'JK', '1', 'STATE', '0000-00-00 00:00:00'),
(16, 'Jharkhand', 'JH', '20', 'STATE', '0000-00-00 00:00:00'),
(17, 'Karnataka', 'KA', '29', 'STATE', '0000-00-00 00:00:00'),
(18, 'Kerala', 'KL', '32', 'STATE', '0000-00-00 00:00:00'),
(19, 'Lakshadweep', 'LD', '31', 'UT', '0000-00-00 00:00:00'),
(20, 'Madhya Pradesh', 'MP', '23', 'STATE', '0000-00-00 00:00:00'),
(21, 'Maharashtra', 'MH', '27', 'STATE', '0000-00-00 00:00:00'),
(22, 'Manipur', 'MN', '14', 'STATE', '0000-00-00 00:00:00'),
(23, 'Meghalaya', 'ML', '17', 'STATE', '0000-00-00 00:00:00'),
(24, 'Mizoram', 'MZ', '15', 'STATE', '0000-00-00 00:00:00'),
(25, 'Nagaland', 'NL', '13', 'STATE', '0000-00-00 00:00:00'),
(26, 'Odisha', 'OR', '21', 'STATE', '0000-00-00 00:00:00'),
(27, 'Pondicherry', 'PY', '34', 'UT', '0000-00-00 00:00:00'),
(28, 'Punjab', 'PB', '3', 'STATE', '0000-00-00 00:00:00'),
(29, 'Rajasthan', 'RJ', '8', 'STATE', '0000-00-00 00:00:00'),
(30, 'Sikkim', 'SK', '11', 'STATE', '0000-00-00 00:00:00'),
(31, 'Tamil Nadu', 'TN', '33', 'STATE', '0000-00-00 00:00:00'),
(32, 'Telangana', 'TN', '36', 'STATE', '0000-00-00 00:00:00'),
(33, 'Tripura', 'TR', '16', 'STATE', '0000-00-00 00:00:00'),
(34, 'Uttar Pradesh', 'UP', '9', 'STATE', '0000-00-00 00:00:00'),
(35, 'Uttarakhand', 'UK', '5', 'STATE', '0000-00-00 00:00:00'),
(36, 'West Bangal', 'WB', '19', 'STATE', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_subcategory`
--

CREATE TABLE `mst_subcategory` (
  `sub_category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_name` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_subcategory`
--

INSERT INTO `mst_subcategory` (`sub_category_id`, `brand_id`, `category_id`, `sub_category_name`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 1, 'test_sub_category', '2021-03-04 18:13:48', 1, '2021-09-09 06:34:00', 1, 0),
(2, 1, 2, 'sub_category', '2021-10-07 11:15:28', 1, '2021-12-13 10:25:59', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_sub_modules`
--

CREATE TABLE `mst_sub_modules` (
  `sub_module_id` bigint(20) NOT NULL,
  `module_id` bigint(20) NOT NULL,
  `sub_module_name` varchar(255) NOT NULL,
  `sub_module_path` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_sub_modules`
--

INSERT INTO `mst_sub_modules` (`sub_module_id`, `module_id`, `sub_module_name`, `sub_module_path`, `status`) VALUES
(1, 1, 'Quotation', 'quotation_list', 1),
(2, 1, 'Dc', 'dc_list', 1),
(3, 1, 'Estimation', 'estimate_list', 1),
(4, 1, 'Invoice', 'invoice_list', 1),
(5, 1, 'Sales Return', 'sales_return_list', 1),
(6, 2, 'Purchase DC', 'purchase_dc_list', 0),
(7, 2, 'Purchase', 'purchase_list', 1),
(8, 2, 'Purchase Order', 'purchase_order_list', 1),
(9, 2, 'Purchase Return', 'purchase_return_list', 1),
(10, 3, 'Expenses', 'expenses_list', 1),
(11, 4, 'Stock List', 'stock_list', 1),
(12, 4, 'Stock Inward', 'stock_inward_list', 1),
(13, 4, 'Stock Adjustments', 'stock_adjustment_list', 1),
(14, 5, 'Purchase_Payment', 'purchase_payment_list', 1),
(16, 5, 'Invoice_Payment', 'invoice_payment_list', 1),
(17, 5, 'Expenses_Payment', 'expenses_payment_list', 0),
(18, 6, 'Customer Report', 'customer_report', 1),
(19, 6, 'Supplier Report', 'supplier_report', 1),
(20, 6, 'Sales GST Reports', 'sales_gst_reports', 1),
(21, 7, 'Log Details', 'logs', 1),
(22, 9, 'Company', 'company_list', 1),
(23, 9, 'User', 'user_list', 1),
(24, 9, 'Access Level', 'access_level_list', 1),
(25, 10, 'Module Settings', 'module_settings', 1),
(26, 10, 'Sub Module Settings', 'sub_module_settings', 1),
(27, 8, 'Customers', 'customer_list', 1),
(28, 8, 'Suppliers', 'supplier_list', 1),
(29, 8, 'Products', 'product_list', 1),
(30, 8, 'Expenses Category', 'expenses_category_list', 1),
(31, 8, 'Size', 'size_list', 1),
(32, 8, 'Units', 'unit_list', 1),
(33, 8, 'Colours', 'colour_list', 1),
(34, 8, 'Transport', 'transport_list', 1),
(35, 8, 'Brand', 'brand_list', 1),
(36, 8, 'Category', 'category_list', 1),
(37, 8, 'Sub Category', 'sub_category_list', 1),
(38, 8, 'Tax', 'tax_list', 1),
(39, 8, 'Secondary Units', 'secondary_unit_list', 1),
(40, 8, 'Sub Modules', 'sub_module_list', 1),
(41, 10, 'Invoice Settings', 'invoice_settings', 1),
(42, 10, 'General Settings', 'general_settings', 1),
(43, 5, 'Estimate_Payment', 'estimate_payment_list', 1),
(44, 5, 'Quotation_Payment', 'quotation_payment_list', 1),
(45, 10, 'Estimate Settings', 'estimate_settings', 1),
(46, 10, 'Quotation Settings', 'quotation_settings', 1),
(47, 10, 'Purchase Settings', 'purchase_settings', 1),
(48, 6, 'Purchase GST Reports', 'purchase_gst_reports', 1),
(49, 6, 'Sales Person Report', 'sales_person_based_report', 1),
(50, 10, 'Product Settings', 'product_settings', 1),
(51, 2, 'Buyers PO Upload', 'buyers_po_excel_list', 0),
(52, 6, 'Products Report', 'product_report', 1),
(53, 6, 'Hsncode Report', 'hsncode_report', 1),
(54, 8, 'Sales Person', 'sales_person_list', 0),
(55, 11, 'Sales Receipt', 'sales_receipt_list', 1),
(56, 11, 'Purchase Payments', 'purchase_payments_list', 1),
(57, 11, 'Journals', 'journal_list', 1),
(58, 6, 'Acc - Sales Reports', 'receipt_reports', 1),
(59, 6, 'Acc - Purchase Reports', 'payment_reports', 1),
(60, 8, 'Product Type', 'product_type_list', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_suppliers`
--

CREATE TABLE `mst_suppliers` (
  `supplier_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_email` varchar(200) NOT NULL,
  `supplier_phone` varchar(50) NOT NULL,
  `supplier_mobile` varchar(50) NOT NULL,
  `supplier_address1` varchar(200) NOT NULL,
  `supplier_address2` varchar(200) NOT NULL,
  `supplier_city` varchar(100) NOT NULL,
  `supplier_state` varchar(20) NOT NULL,
  `supplier_pincode` varchar(20) NOT NULL,
  `supplier_gst` varchar(50) NOT NULL,
  `supplier_opening_balance` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_suppliers`
--

INSERT INTO `mst_suppliers` (`supplier_id`, `company_id`, `branch_id`, `supplier_name`, `supplier_email`, `supplier_phone`, `supplier_mobile`, `supplier_address1`, `supplier_address2`, `supplier_city`, `supplier_state`, `supplier_pincode`, `supplier_gst`, `supplier_opening_balance`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(8, 4, 0, 'Surya', 'surya@ctrlnext.com', '9944155498', '9944155498', 'cbe', 'cbe', 'cbe', '33', '641027', '', '', '2021-09-21 07:56:09', 7, '2021-12-13 09:39:38', 7, 0),
(9, 1, 0, 'krishna', 'krishna@gmail.com', '9854332431', '8876556766', '110, SV Colony', 'Angeripalayam Road', 'Tirupur', '33', '641602', '', '430000', '2021-11-09 08:53:07', 1, '2021-12-13 09:39:35', 7, 0),
(10, 1, 0, 'PTS', '', '', '', '', '', '', '33', '', '', '', '2021-12-15 13:26:51', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_taxs`
--

CREATE TABLE `mst_taxs` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_category` varchar(50) NOT NULL,
  `tax_percentage` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_taxs`
--

INSERT INTO `mst_taxs` (`tax_id`, `tax_name`, `tax_category`, `tax_percentage`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'GST -28', 'GST', '28', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 1),
(2, 'GST -18', 'GST', '18', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 1),
(3, 'GST-5', 'Default', '5', '2021-03-02 17:00:08', '1', '2021-12-13 10:28:10', '7', 1),
(4, 'GST-12', 'GST', '12', '2021-04-30 07:06:58', '1', '0000-00-00 00:00:00', '', 1),
(5, '', '', '', '2021-10-26 10:31:16', '1', '2021-11-29 06:28:24', '7', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_tax_type`
--

CREATE TABLE `mst_tax_type` (
  `tax_type_id` int(11) NOT NULL,
  `tax_type` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_tax_type`
--

INSERT INTO `mst_tax_type` (`tax_type_id`, `tax_type`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'Inclusive', '2021-03-06 13:00:28', '1', '0000-00-00 00:00:00', '', 1),
(2, 'Exclusive', '2021-03-06 13:01:12', '1', '0000-00-00 00:00:00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_transports`
--

CREATE TABLE `mst_transports` (
  `transport_id` int(11) NOT NULL,
  `transport_type` varchar(100) NOT NULL,
  `transport_name` varchar(100) NOT NULL,
  `transport_gst` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_transports`
--

INSERT INTO `mst_transports` (`transport_id`, `transport_type`, `transport_name`, `transport_gst`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'BY ROAD', 'RIDER CARGO', '', '2019-04-19 17:35:14', '1', '0000-00-00 00:00:00', '', 1),
(2, 'BY AIR', 'Air India', '', '2019-06-13 11:23:39', '1', '0000-00-00 00:00:00', '', 1),
(3, 'BY COURIER', 'E-KART', '', '2019-06-13 11:24:01', '1', '0000-00-00 00:00:00', '', 1),
(4, 'BY AIR', 'Jet Airways', '', '2019-06-13 11:24:42', '1', '0000-00-00 00:00:00', '', 1),
(5, 'BY ROAD', 'KPN', '', '2019-12-10 12:24:40', '1', '0000-00-00 00:00:00', '', 1),
(6, 'BY ROAD', 'Self Delivery', '', '2020-06-03 06:09:10', '1', '0000-00-00 00:00:00', '', 1),
(11, 'BY COURIER', 'Professional couriers', '', '2021-03-17 06:07:46', '1', '0000-00-00 00:00:00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_units`
--

CREATE TABLE `mst_units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_units`
--

INSERT INTO `mst_units` (`unit_id`, `unit_name`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'PCS', '2020-09-14 12:35:01', 1, '2021-03-26 08:47:32', 1, 1),
(2, 'KG', '2020-10-06 17:07:22', 1, '0000-00-00 00:00:00', 0, 1),
(3, 'Nos', '2021-12-16 06:19:42', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_users`
--

CREATE TABLE `mst_users` (
  `user_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT 0,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_login` int(11) NOT NULL,
  `access_level` int(11) NOT NULL,
  `access_company` varchar(11) NOT NULL,
  `modules` varchar(255) NOT NULL,
  `submodules` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `last_login` datetime NOT NULL,
  `rev_str` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_users`
--

INSERT INTO `mst_users` (`user_id`, `company_id`, `branch_id`, `username`, `password`, `user_login`, `access_level`, `access_company`, `modules`, `submodules`, `name`, `email`, `phone`, `mobile`, `last_login`, `rev_str`, `created_on`, `updated_on`, `created_by`, `updated_by`, `status`) VALUES
(1, 1, 0, 'ctrlnext', 'ddd88999da4bb7b51e0d0160b5aaad96', 1, 1, '1,4,5,6', '1,2,3,4,5,6,7,8,9,10', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20,21,22,23,24,25,26,41,42,45,46,47,50', 'Super Admin', '', '9942518721', '9942518721', '2021-12-23 07:17:36', '321txenlrtc', '2021-10-08 06:43:38', '2021-10-08 12:33:21', 1, 1, 1),
(7, 1, 0, 'admin', '0192023a7bbd73250516f069df18b500', 1, 2, '4,5', '1,2,3,4,6,7,8,9,10,11', '2,3,4,5,7,8,9,10,11,12,13,18,19,20,48,49,52,53,58,59,21,27,28,29,30,31,32,33,34,35,36,37,38,39,54,60,22,23,41,45,47,50,55,56,57', 'Manoharan', 'manoharan@gmail.com', '8754878758', '9688514649', '2021-12-30 05:43:03', '321nimda', '2021-12-27 06:43:47', '2021-09-22 10:23:30', 7, 7, 1),
(19, 0, 0, 'poorna', '1f8539a6159366cd135b33905e6af1df', 1, 3, '4', '1,2,3,4,5,6,7,8', '1,2,3,4,6,7,8,10,11,16,17,18,21,24', 'poorna', 'poorna@ctrlnext.com', '9944155498', '9944155498', '2021-10-22 08:42:05', 'anroop', '2021-09-24 08:52:15', '0000-00-00 00:00:00', 7, 0, 1),
(20, 0, 0, 'krishna', '243bd1ce0387f18005abfc43b001646a', 1, 4, '4', '1,3,7,8', '1,2,3,4,5,10,15,16,21,23', 'krishna', 'krishna@gmail.com', '9874125475', '8554215424', '2021-09-24 09:18:17', 'anhsirk', '2021-09-24 09:18:10', '0000-00-00 00:00:00', 7, 0, 1),
(21, 0, 0, 'mohan', 'e9206237def4b4ef46fd933ed0f5a08f', 1, 7, '1,4,5,6', '1,2,4,7,9', '4,7,11,12,13,21,23,24', 'Mohan', '', '', '', '2021-10-08 13:45:48', 'nahom', '2021-10-08 13:43:51', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buyers_po`
--

CREATE TABLE `tbl_buyers_po` (
  `buyers_po_id` bigint(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buyers_po_relation`
--

CREATE TABLE `tbl_buyers_po_relation` (
  `buyers_po_relation_id` bigint(20) NOT NULL,
  `buyers_po_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_stylecode` varchar(50) NOT NULL,
  `product_itemcode` varchar(50) NOT NULL,
  `product_purchase_price` varchar(50) NOT NULL,
  `product_size_id` int(20) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dcs`
--

CREATE TABLE `tbl_dcs` (
  `dc_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` bigint(20) NOT NULL DEFAULT 1,
  `quotation_id` int(11) DEFAULT NULL,
  `estimate_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `dc_number` varchar(100) NOT NULL,
  `ref_no` int(11) NOT NULL,
  `dc_date` date NOT NULL,
  `dc_customer` bigint(20) NOT NULL,
  `dc_employee` bigint(20) DEFAULT 0,
  `transport_mode` varchar(50) NOT NULL,
  `transport_name` varchar(50) NOT NULL,
  `transport_vechile_no` varchar(50) NOT NULL,
  `dc_approved` int(11) NOT NULL,
  `dc_cancel` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `dc_status` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dcs`
--

INSERT INTO `tbl_dcs` (`dc_id`, `company_id`, `branch_id`, `quotation_id`, `estimate_id`, `invoice_id`, `dc_number`, `ref_no`, `dc_date`, `dc_customer`, `dc_employee`, `transport_mode`, `transport_name`, `transport_vechile_no`, `dc_approved`, `dc_cancel`, `created_on`, `created_by`, `updated_on`, `updated_by`, `dc_status`, `status`) VALUES
(1, 1, 1, NULL, NULL, NULL, 'NRM/DC/21-22/0001', 10, '2021-12-27', 8, 0, 'BY ROAD', 'KPG', 'TN495251462', 1, 0, '2021-12-27 13:05:00', 7, '2021-12-27 13:11:11', 7, 2, 2),
(2, 1, 1, NULL, NULL, NULL, 'NRM/DC/21-22/0002', 0, '2021-12-27', 8, 0, 'BY TRAIN', 'SRT', 'TN555', 1, 0, '2021-12-27 13:06:21', 7, '2021-12-27 13:16:36', 7, 2, 2),
(3, 1, 1, NULL, NULL, NULL, 'NRM/DC/21-22/0003', 0, '2021-12-27', 7, 0, '', '', '', 1, 0, '2021-12-27 13:31:01', 7, '2021-12-27 13:31:35', 7, 2, 2),
(4, 1, 1, NULL, NULL, NULL, 'NRM/DC/21-22/0004', 0, '2021-12-27', 7, 0, '', '', '', 1, 0, '2021-12-27 13:31:18', 7, '2021-12-27 13:31:51', 7, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dcs_relation`
--

CREATE TABLE `tbl_dcs_relation` (
  `dc_relation_id` bigint(20) NOT NULL,
  `dc_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `stock_inward_id` bigint(20) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `subcategory_name` varchar(100) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_percent` varchar(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `balance_quantity` varchar(11) DEFAULT '0',
  `rate` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dcs_relation`
--

INSERT INTO `tbl_dcs_relation` (`dc_relation_id`, `dc_id`, `product_id`, `stock_inward_id`, `product_name`, `brand_name`, `category_name`, `subcategory_name`, `tax_name`, `tax_percent`, `quantity`, `balance_quantity`, `rate`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 1, NULL, 'R/N A/O - M', '9T6', 'R/N Allover', '', 'GST-5', '5', '10', '0', '', '2021-12-27 13:05:00', 7, '2021-12-27 13:11:11', 7, 2),
(2, 1, 2, NULL, 'R/N A/O - L', '9T6', 'R/N Allover', '', 'GST-5', '5', '10', '0', '', '2021-12-27 13:05:00', 7, '2021-12-27 13:11:11', 7, 2),
(3, 1, 3, NULL, 'R/N A/O - XL', '9T6', 'R/N Allover', '', 'GST-5', '5', '10', '0', '', '2021-12-27 13:05:00', 7, '2021-12-27 13:11:11', 7, 2),
(4, 1, 4, NULL, 'R/N A/O - XXL', '9T6', 'R/N Allover', '', 'GST-5', '5', '20', '0', '', '2021-12-27 13:05:00', 7, '2021-12-27 13:11:11', 7, 2),
(5, 1, 5, NULL, 'R/N C/U - L', '9T6', 'R/N Cutton\'s', '', 'GST-5', '5', '25', '0', '', '2021-12-27 13:05:00', 7, '2021-12-27 13:11:11', 7, 2),
(6, 2, 3, NULL, 'R/N A/O - XL', '9T6', 'R/N Allover', '', 'GST-5', '5', '10', '0', '', '2021-12-27 13:06:21', 7, '2021-12-27 13:16:36', 7, 2),
(7, 3, 1, NULL, 'R/N A/O - M', '9T6', 'R/N Allover', '', 'GST-5', '5', '10', '0', '', '2021-12-27 13:31:01', 7, '2021-12-27 13:31:35', 7, 2),
(8, 4, 3, NULL, 'R/N A/O - XL', '9T6', 'R/N Allover', '', 'GST-5', '5', '50', '0', '', '2021-12-27 13:31:18', 7, '2021-12-27 13:31:51', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dcs_relation_temp`
--

CREATE TABLE `tbl_dcs_relation_temp` (
  `dc_relation_temp_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `estimate_id` bigint(20) DEFAULT NULL,
  `estimate_relation_id` int(11) DEFAULT NULL,
  `stock_id` bigint(20) DEFAULT NULL,
  `quantity` varchar(10) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dcs_relation_temp`
--

INSERT INTO `tbl_dcs_relation_temp` (`dc_relation_temp_id`, `product_id`, `estimate_id`, `estimate_relation_id`, `stock_id`, `quantity`, `rate`, `created_on`, `created_by`, `updated_on`, `status`) VALUES
(1, 3, NULL, NULL, NULL, '50', '', '2021-12-27 13:31:17', 7, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimates`
--

CREATE TABLE `tbl_estimates` (
  `estimate_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `dc_id` varchar(50) DEFAULT NULL,
  `estimate_number` varchar(100) NOT NULL,
  `estimate_date` date NOT NULL,
  `estimate_type` int(11) NOT NULL,
  `estimate_customer` bigint(20) NOT NULL,
  `transport_mode` varchar(50) NOT NULL,
  `transport_name` varchar(50) NOT NULL,
  `estimate_employee` bigint(20) NOT NULL,
  `transport_vechile_no` varchar(50) NOT NULL,
  `estimate_gst` varchar(50) NOT NULL DEFAULT '0',
  `estimate_loading_charges` varchar(50) NOT NULL DEFAULT '0',
  `estimate_transportaion_charges` varchar(50) NOT NULL DEFAULT '0',
  `estimate_other_expenses` varchar(50) NOT NULL DEFAULT '0',
  `total_bundle` varchar(11) DEFAULT '0',
  `reverse_charge` varchar(255) DEFAULT 'Y/N',
  `date_of_supply` datetime DEFAULT NULL,
  `place_of_supply` varchar(255) DEFAULT NULL,
  `estimate_overall_discount` varchar(11) DEFAULT '0',
  `estimate_cash_discount` varchar(11) DEFAULT '0',
  `estimate_discount` varchar(10) NOT NULL,
  `estimate_advance` varchar(50) NOT NULL DEFAULT '0',
  `estimate_cancel` varchar(11) NOT NULL,
  `estimate_approved` int(11) NOT NULL,
  `estimate_remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `sales_return_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_estimates`
--

INSERT INTO `tbl_estimates` (`estimate_id`, `company_id`, `branch_id`, `dc_id`, `estimate_number`, `estimate_date`, `estimate_type`, `estimate_customer`, `transport_mode`, `transport_name`, `estimate_employee`, `transport_vechile_no`, `estimate_gst`, `estimate_loading_charges`, `estimate_transportaion_charges`, `estimate_other_expenses`, `total_bundle`, `reverse_charge`, `date_of_supply`, `place_of_supply`, `estimate_overall_discount`, `estimate_cash_discount`, `estimate_discount`, `estimate_advance`, `estimate_cancel`, `estimate_approved`, `estimate_remarks`, `created_on`, `created_by`, `updated_on`, `updated_by`, `sales_return_status`, `status`) VALUES
(1, 1, 0, '1', 'NRM/ES/21-22/0001', '2021-12-27', 1, 8, '', '', 0, '', '0', '0', '100', '0', '2', 'Y/N', '2021-12-27 00:00:00', 'Coimbatore', '', '0', '', '0', '0', 1, '', '2021-12-27 13:11:11', 7, '0000-00-00 00:00:00', 0, 0, 1),
(2, 1, 0, '3', 'NRM/ES/21-22/0002', '2021-12-27', 1, 7, '', '', 0, '', '0', '0', '0', '0', '0', 'Y/N', '2021-12-27 00:00:00', '', '', '0', '', '0', '0', 1, '', '2021-12-27 13:31:35', 7, '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimates_relation`
--

CREATE TABLE `tbl_estimates_relation` (
  `estimate_relation_id` bigint(20) NOT NULL,
  `dc_id` int(11) DEFAULT NULL,
  `dc_relation_id` int(11) DEFAULT NULL,
  `estimate_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `subcategory_name` varchar(100) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_percent` varchar(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `available_quantity` varchar(10) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `discount_percentage` varchar(5) DEFAULT NULL,
  `pre_total` varchar(50) DEFAULT NULL,
  `tax_total` varchar(50) NOT NULL,
  `total` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `sales_return_product_status` int(11) NOT NULL DEFAULT 0,
  `estimate_relation_status` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_estimates_relation`
--

INSERT INTO `tbl_estimates_relation` (`estimate_relation_id`, `dc_id`, `dc_relation_id`, `estimate_id`, `product_id`, `product_name`, `brand_name`, `category_name`, `subcategory_name`, `tax_name`, `tax_percent`, `quantity`, `available_quantity`, `rate`, `discount_percentage`, `pre_total`, `tax_total`, `total`, `created_on`, `created_by`, `updated_on`, `updated_by`, `sales_return_product_status`, `estimate_relation_status`, `status`) VALUES
(1, 1, 1, 1, 1, 'R/N A/O - M', '9T6', 'R/N Allover', '', '', '', '10', '10', '100', '', '1000.00', '', '1000.00', '2021-12-27 13:11:11', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1),
(2, 1, 2, 1, 2, 'R/N A/O - L', '9T6', 'R/N Allover', '', '', '', '10', '10', '50', '', '500.00', '', '500.00', '2021-12-27 13:11:11', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1),
(3, 1, 3, 1, 3, 'R/N A/O - XL', '9T6', 'R/N Allover', '', '', '', '10', '10', '75', '', '750.00', '', '750.00', '2021-12-27 13:11:11', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1),
(4, 1, 4, 1, 4, 'R/N A/O - XXL', '9T6', 'R/N Allover', '', '', '', '20', '20', '200', '', '4000.00', '', '4000.00', '2021-12-27 13:11:11', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1),
(5, 1, 5, 1, 5, 'R/N C/U - L', '9T6', 'R/N Cutton\'s', '', '', '', '25', '25', '300', '', '7500.00', '', '7500.00', '2021-12-27 13:11:11', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1),
(6, 3, 7, 2, 1, 'R/N A/O - M', '9T6', 'R/N Allover', '', '', '', '10', '10', '100', '', '1000.00', '', '1000.00', '2021-12-27 13:31:35', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimates_relation_temp`
--

CREATE TABLE `tbl_estimates_relation_temp` (
  `estimate_relation_temp_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `dc_id` int(11) DEFAULT NULL,
  `dc_relation_id` int(11) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `subcategory_name` varchar(100) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_percent` varchar(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `discount_percentage` varchar(5) DEFAULT NULL,
  `pre_total` varchar(50) DEFAULT NULL,
  `tax_total` varchar(50) NOT NULL,
  `total` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_estimates_relation_temp`
--

INSERT INTO `tbl_estimates_relation_temp` (`estimate_relation_temp_id`, `company_id`, `branch_id`, `stock_id`, `dc_id`, `dc_relation_id`, `product_id`, `product_name`, `brand_name`, `category_name`, `subcategory_name`, `tax_name`, `tax_percent`, `quantity`, `rate`, `discount_percentage`, `pre_total`, `tax_total`, `total`, `created_on`, `created_by`, `status`) VALUES
(1, 0, NULL, NULL, 3, 7, 1, '', '', '', '', '', '', '10', '', NULL, NULL, '', '0', '2021-12-27 13:31:27', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_payments`
--

CREATE TABLE `tbl_estimate_payments` (
  `estimate_payments_id` bigint(20) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `estimate_id` varchar(20) NOT NULL,
  `estimate_amount` varchar(20) NOT NULL,
  `estimate_status` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_estimate_payments`
--

INSERT INTO `tbl_estimate_payments` (`estimate_payments_id`, `customer_id`, `company_id`, `branch_id`, `estimate_id`, `estimate_amount`, `estimate_status`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, '8', 1, 0, '1', '13850', 0, '2021-12-27 13:11:11', 7, '0000-00-00 00:00:00', 0, 1),
(2, '7', 1, 0, '2', '1000', 0, '2021-12-27 13:31:35', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_payments_history`
--

CREATE TABLE `tbl_estimate_payments_history` (
  `estimate_payments_history_id` bigint(20) NOT NULL,
  `estimate_payments_id` varchar(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `estimate_amount` varchar(100) NOT NULL,
  `paid_amount` varchar(100) NOT NULL,
  `balance_amount` varchar(50) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `upi_id` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `expense_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `expense_number` varchar(100) NOT NULL,
  `expense_date` date NOT NULL,
  `expense_category_id` varchar(50) NOT NULL,
  `expense_billno` varchar(50) NOT NULL,
  `expense_amount` varchar(20) NOT NULL,
  `expense_person` varchar(100) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `expense_remark` varchar(255) NOT NULL,
  `expense_status` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices`
--

CREATE TABLE `tbl_invoices` (
  `invoice_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `dc_id` varchar(50) DEFAULT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_type` int(11) DEFAULT NULL,
  `invoice_customer` bigint(20) NOT NULL,
  `transport_mode` varchar(50) NOT NULL,
  `transport_name` varchar(50) NOT NULL,
  `invoice_employee` bigint(20) DEFAULT NULL,
  `transport_vechile_no` varchar(50) NOT NULL,
  `invoice_gst` varchar(50) NOT NULL DEFAULT '0',
  `invoice_loading_charges` varchar(50) NOT NULL DEFAULT '0',
  `invoice_transportaion_charges` varchar(50) NOT NULL DEFAULT '0',
  `invoice_other_expenses` varchar(50) NOT NULL DEFAULT '0',
  `total_bundle` varchar(11) DEFAULT '0',
  `reverse_charge` varchar(255) DEFAULT 'Y/N',
  `date_of_supply` datetime DEFAULT NULL,
  `place_of_supply` varchar(255) DEFAULT NULL,
  `invoice_overall_discount` varchar(11) DEFAULT '0',
  `invoice_cash_discount` varchar(11) DEFAULT '0',
  `invoice_discount` varchar(10) NOT NULL,
  `invoice_advance` varchar(50) NOT NULL DEFAULT '0',
  `invoice_cancel` varchar(11) NOT NULL,
  `invoice_approved` int(11) NOT NULL,
  `invoice_remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `sales_return_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoices`
--

INSERT INTO `tbl_invoices` (`invoice_id`, `company_id`, `branch_id`, `dc_id`, `invoice_number`, `invoice_date`, `invoice_type`, `invoice_customer`, `transport_mode`, `transport_name`, `invoice_employee`, `transport_vechile_no`, `invoice_gst`, `invoice_loading_charges`, `invoice_transportaion_charges`, `invoice_other_expenses`, `total_bundle`, `reverse_charge`, `date_of_supply`, `place_of_supply`, `invoice_overall_discount`, `invoice_cash_discount`, `invoice_discount`, `invoice_advance`, `invoice_cancel`, `invoice_approved`, `invoice_remarks`, `created_on`, `created_by`, `updated_on`, `updated_by`, `sales_return_status`, `status`) VALUES
(1, 1, 0, '2', 'NRM/INV/21-22/0001', '2021-12-27', 2, 8, '', '', NULL, '', '0', '0', '0', '0', '2', 'Y/N', '2021-12-27 00:00:00', 'Coimbatore', '', '0', '', '0', '0', 1, '', '2021-12-27 13:16:36', 7, '0000-00-00 00:00:00', 0, 0, 1),
(2, 1, 0, '4', 'NRM/INV/21-22/0002', '2021-12-27', 1, 7, '', '', NULL, '', '0', '0', '0', '0', '0', 'Y/N', '2021-12-27 00:00:00', '', '', '0', '', '0', '0', 1, '', '2021-12-27 13:31:51', 7, '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices_relation`
--

CREATE TABLE `tbl_invoices_relation` (
  `invoice_relation_id` bigint(20) NOT NULL,
  `dc_id` int(11) DEFAULT NULL,
  `dc_relation_id` int(11) DEFAULT NULL,
  `invoice_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_name` varchar(100) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `subcategory_name` varchar(100) DEFAULT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_percent` varchar(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `available_quantity` varchar(10) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `discount_percentage` varchar(5) DEFAULT NULL,
  `pre_total` varchar(50) DEFAULT NULL,
  `tax_total` varchar(50) NOT NULL,
  `total` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `sales_return_product_status` int(11) NOT NULL DEFAULT 0,
  `invoice_relation_status` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoices_relation`
--

INSERT INTO `tbl_invoices_relation` (`invoice_relation_id`, `dc_id`, `dc_relation_id`, `invoice_id`, `product_id`, `product_name`, `brand_name`, `category_name`, `subcategory_name`, `tax_name`, `tax_percent`, `quantity`, `available_quantity`, `rate`, `discount_percentage`, `pre_total`, `tax_total`, `total`, `created_on`, `created_by`, `updated_on`, `updated_by`, `sales_return_product_status`, `invoice_relation_status`, `status`) VALUES
(1, 2, 6, 1, 3, 'R/N A/O - XL', '9T6', 'R/N Allover', NULL, '', '5', '10', '10', '150', '', '1500.00', '75.00', '1575.00', '2021-12-27 13:16:36', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1),
(2, 4, 8, 2, 3, 'R/N A/O - XL', '9T6', 'R/N Allover', NULL, '', '5', '50', '50', '100', '', '5000.00', '250.00', '5250.00', '2021-12-27 13:31:51', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices_relation_temp`
--

CREATE TABLE `tbl_invoices_relation_temp` (
  `invoice_relation_temp_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `dc_id` int(11) DEFAULT NULL,
  `dc_relation_id` int(11) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `subcategory_name` varchar(100) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_percent` varchar(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `discount_percentage` varchar(5) DEFAULT NULL,
  `pre_total` varchar(50) DEFAULT NULL,
  `tax_total` varchar(50) NOT NULL,
  `total` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoices_relation_temp`
--

INSERT INTO `tbl_invoices_relation_temp` (`invoice_relation_temp_id`, `company_id`, `branch_id`, `stock_id`, `dc_id`, `dc_relation_id`, `product_id`, `product_name`, `brand_name`, `category_name`, `subcategory_name`, `tax_name`, `tax_percent`, `quantity`, `rate`, `discount_percentage`, `pre_total`, `tax_total`, `total`, `created_on`, `created_by`, `status`) VALUES
(1, 0, NULL, NULL, 4, 8, 3, '', '', '', '', '', '', '50', '', NULL, NULL, '', '0', '2021-12-27 13:31:45', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_payments`
--

CREATE TABLE `tbl_invoice_payments` (
  `invoice_payments_id` bigint(20) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `invoice_amount` varchar(20) NOT NULL,
  `invoice_status` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_payments`
--

INSERT INTO `tbl_invoice_payments` (`invoice_payments_id`, `customer_id`, `company_id`, `branch_id`, `invoice_id`, `invoice_amount`, `invoice_status`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, '8', 1, 0, '1', '1575', 0, '2021-12-27 13:16:36', 7, '0000-00-00 00:00:00', 0, 1),
(2, '7', 1, 0, '2', '5250', 0, '2021-12-27 13:31:51', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_payments_history`
--

CREATE TABLE `tbl_invoice_payments_history` (
  `invoice_payments_history_id` bigint(20) NOT NULL,
  `invoice_payments_id` varchar(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_amount` varchar(100) NOT NULL,
  `paid_amount` varchar(100) NOT NULL,
  `balance_amount` varchar(50) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `upi_id` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journals`
--

CREATE TABLE `tbl_journals` (
  `journal_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `journal_number` varchar(20) NOT NULL,
  `journal_date` date NOT NULL,
  `journal_type` varchar(30) NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `log_id` bigint(20) NOT NULL,
  `log_category_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) NOT NULL DEFAULT 0,
  `operation` varchar(50) NOT NULL,
  `operation_details` text NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `invoice_id` int(11) NOT NULL DEFAULT 0,
  `dc_id` int(11) NOT NULL DEFAULT 0,
  `estimate_id` int(11) NOT NULL DEFAULT 0,
  `quotation_id` int(11) NOT NULL DEFAULT 0,
  `sales_return_id` int(11) NOT NULL DEFAULT 0,
  `purchase_dc_id` int(11) NOT NULL DEFAULT 0,
  `purchase_id` int(11) NOT NULL DEFAULT 0,
  `purchase_order_id` int(11) NOT NULL DEFAULT 0,
  `purchase_return_id` int(11) NOT NULL DEFAULT 0,
  `expense_id` int(11) NOT NULL DEFAULT 0,
  `stock_id` int(11) NOT NULL DEFAULT 0,
  `stock_inward_id` int(11) NOT NULL DEFAULT 0,
  `stock_adjustment_id` int(11) NOT NULL DEFAULT 0,
  `purchase_payment_id` int(11) NOT NULL DEFAULT 0,
  `estimate_payment_id` int(11) NOT NULL DEFAULT 0,
  `invoice_payment_id` int(11) NOT NULL DEFAULT 0,
  `logs_status` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`log_id`, `log_category_id`, `company_id`, `branch_id`, `user_id`, `customer_id`, `supplier_id`, `operation`, `operation_details`, `remarks`, `product_id`, `invoice_id`, `dc_id`, `estimate_id`, `quotation_id`, `sales_return_id`, `purchase_dc_id`, `purchase_id`, `purchase_order_id`, `purchase_return_id`, `expense_id`, `stock_id`, `stock_inward_id`, `stock_adjustment_id`, `purchase_payment_id`, `estimate_payment_id`, `invoice_payment_id`, `logs_status`, `created_on`, `updated_on`, `status`) VALUES
(1, 19, 0, 0, '7', 0, 0, 'Invoice Settings Updated', 'Invoice Settings Updated By Manoharan', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 12:31:30', '0000-00-00 00:00:00', 1),
(2, 2, 1, 0, '7', 8, 0, 'Dc Creation', 'New Dc Created For SRI RAM TEX', '', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:05:00', '0000-00-00 00:00:00', 1),
(3, 2, 1, 0, '7', 8, 0, 'Dc Creation', 'New Dc Created For SRI RAM TEX', '', 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:06:21', '0000-00-00 00:00:00', 1),
(4, 1, 1, 0, '7', 0, 0, 'estimate Created', 'estimate Created For SRI RAM TEX', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:11:11', '0000-00-00 00:00:00', 1),
(5, 1, 1, 0, '7', 0, 0, 'Invoice Created', 'Invoice Created For SRI RAM TEX', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:16:36', '0000-00-00 00:00:00', 1),
(6, 18, 0, 0, '7', 1, 0, 'Customer Edited', 'Customer Edited By  -Manoharan', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:18:08', '0000-00-00 00:00:00', 1),
(7, 7, 1, 0, '7', 0, 0, 'Purchase Created', 'Purchase Created For -PTS', '', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:20:46', '0000-00-00 00:00:00', 1),
(8, 21, 1, 0, '7', 8, 0, 'Sales Receipt Created', 'New Sales Receipt Created For SRI RAM TEX', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:22:44', '0000-00-00 00:00:00', 1),
(9, 21, 1, 0, '7', 8, 0, 'Sales Receipt Created', 'New Sales Receipt Created For SRI RAM TEX', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:23:53', '0000-00-00 00:00:00', 1),
(10, 21, 1, 0, '7', 0, 10, 'Purchase payment Created', 'New Purchase payment Created For PTS', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:25:10', '0000-00-00 00:00:00', 1),
(11, 21, 1, 0, '7', 0, 10, 'Purchase payment Created', 'New Purchase payment Created For PTS', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:25:45', '0000-00-00 00:00:00', 1),
(12, 2, 1, 0, '7', 7, 0, 'Dc Creation', 'New Dc Created For APOORVA TEX', '', 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:31:01', '0000-00-00 00:00:00', 1),
(13, 2, 1, 0, '7', 7, 0, 'Dc Creation', 'New Dc Created For APOORVA TEX', '', 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:31:18', '0000-00-00 00:00:00', 1),
(14, 1, 1, 0, '7', 0, 0, 'estimate Created', 'estimate Created For APOORVA TEX', '', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:31:35', '0000-00-00 00:00:00', 1),
(15, 1, 1, 0, '7', 0, 0, 'Invoice Created', 'Invoice Created For APOORVA TEX', '', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 13:31:51', '0000-00-00 00:00:00', 1),
(16, 21, 1, 0, '7', 7, 0, 'Sales Receipt Created', 'New Sales Receipt Created For APOORVA TEX', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-28 12:23:47', '0000-00-00 00:00:00', 1),
(17, 21, 1, 0, '7', 0, 10, 'Purchase payment Updated', 'Purchase payment Updated For PTS', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-28 12:26:26', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_category`
--

CREATE TABLE `tbl_log_category` (
  `log_category_id` bigint(20) NOT NULL,
  `log_category` varchar(50) NOT NULL,
  `log_category_name` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_log_category`
--

INSERT INTO `tbl_log_category` (`log_category_id`, `log_category`, `log_category_name`, `created_on`, `updated_on`, `status`) VALUES
(1, 'invoice', 'Invoice', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(2, 'dc', 'DC', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(3, 'estimate', 'Estimate', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(4, 'quotation', 'Quotation', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(5, 'sales_return', 'Sales Return', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(6, 'purchase_dc', 'Purchase DC', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(7, 'purchase', 'Purchase', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(8, 'purchase_order', 'Purchase Order', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(9, 'purchase_return', 'Purchase Return', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(10, 'expense', 'Expenses', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(11, 'stock', 'Stock', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(12, 'stock_inward', 'Stock Inward', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(13, 'stock_adjustment', 'Stock Adjustment', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(14, 'purchase_payment', 'Purchase Payment', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(15, 'invoice_payment', 'Invoice Payment', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(16, 'product', 'Products', '2021-08-31 09:00:21', '2021-08-31 09:00:21', 1),
(17, 'user', 'Users', '2021-08-31 09:07:59', '2021-08-31 09:07:59', 1),
(18, 'master', 'Masters', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1),
(19, 'settings', 'Settings', '2021-09-24 11:32:04', '2021-09-24 11:32:04', 1),
(20, 'Product Excel Upload', 'Product Excel Upload (Buyer Po)', '2021-09-24 11:32:04', '2021-09-24 11:32:04', 1),
(21, 'accounts', 'Accounts', '2021-08-31 08:43:56', '2021-08-31 08:43:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `payment_number` varchar(50) NOT NULL,
  `payment_date` date NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `paid_amount` varchar(50) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `upi_id` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`payment_id`, `company_id`, `payment_number`, `payment_date`, `supplier_id`, `paid_amount`, `payment_type`, `cheque_no`, `bank_name`, `upi_id`, `remarks`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 'NRM/PAY/21-22/0001', '2021-12-27', 10, '270', 'upi_id', '', '', '1124568742113222', '', '2021-12-27 13:25:10', 7, '0000-00-00 00:00:00', 0, 1),
(2, 1, 'NRM/PAY/21-22/0002', '2021-12-28', 10, '500', 'cheque', '0000250', '', '', '', '2021-12-27 13:25:45', 7, '2021-12-28 12:26:26', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `purchase_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_number` varchar(20) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_supplier` bigint(20) NOT NULL,
  `tax_included` varchar(10) DEFAULT NULL,
  `tax_type` int(11) NOT NULL,
  `purchase_ref_no` varchar(50) DEFAULT NULL,
  `purchase_dc_id` varchar(50) DEFAULT NULL,
  `purchase_bill_no` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `purchase_return_status` int(11) DEFAULT 0,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`purchase_id`, `company_id`, `branch_id`, `purchase_number`, `purchase_date`, `purchase_supplier`, `tax_included`, `tax_type`, `purchase_ref_no`, `purchase_dc_id`, `purchase_bill_no`, `created_on`, `created_by`, `updated_on`, `updated_by`, `purchase_return_status`, `status`) VALUES
(1, 1, 0, 'NRM/PUR/21-22/0001', '2021-12-27', 10, '0', 2, '', NULL, '', '2021-12-27 13:20:46', 7, '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_dc`
--

CREATE TABLE `tbl_purchase_dc` (
  `purchase_dc_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_dc_number` varchar(20) NOT NULL,
  `purchase_dc_date` date NOT NULL,
  `purchase_dc_supplier` bigint(20) NOT NULL,
  `purchase_dc_ref_no` varchar(50) NOT NULL,
  `purchase_dc_no` varchar(50) NOT NULL,
  `dc_status` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_dc_relations`
--

CREATE TABLE `tbl_purchase_dc_relations` (
  `purchase_dc_relation_id` bigint(20) NOT NULL,
  `purchase_dc_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_id` bigint(20) DEFAULT NULL,
  `brand_name` varchar(100) DEFAULT NULL,
  `quantity` varchar(10) NOT NULL,
  `available_quantity` varchar(50) NOT NULL,
  `rate` varchar(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_percentage` varchar(5) DEFAULT NULL,
  `tax_total` varchar(20) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_dc_relation_temp`
--

CREATE TABLE `tbl_purchase_dc_relation_temp` (
  `purchase_dc_relation_temp_id` bigint(20) NOT NULL,
  `purchase_dc_relation_id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_orders`
--

CREATE TABLE `tbl_purchase_orders` (
  `purchase_order_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `purchase_order_number` varchar(20) NOT NULL,
  `purchase_order_date` date NOT NULL,
  `purchase_order_supplier` bigint(20) NOT NULL,
  `purchase_order_mail_status` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_orders_relations`
--

CREATE TABLE `tbl_purchase_orders_relations` (
  `purchase_order_relation_id` bigint(20) NOT NULL,
  `purchase_order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `subcategory_id` bigint(20) DEFAULT NULL,
  `subcategory_name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tax_id` bigint(20) DEFAULT NULL,
  `tax_name` varchar(100) DEFAULT NULL,
  `tax_percent` varchar(20) DEFAULT NULL,
  `quantity` varchar(10) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_orders_relation_temp`
--

CREATE TABLE `tbl_purchase_orders_relation_temp` (
  `purchase_order_relation_temp_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_payments`
--

CREATE TABLE `tbl_purchase_payments` (
  `purchase_payments_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supplier_id` varchar(20) NOT NULL,
  `purchase_id` varchar(20) NOT NULL,
  `purchase_amount` varchar(20) NOT NULL,
  `purchase_status` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_payments`
--

INSERT INTO `tbl_purchase_payments` (`purchase_payments_id`, `company_id`, `branch_id`, `supplier_id`, `purchase_id`, `purchase_amount`, `purchase_status`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 0, '10', '1', '770', 0, '2021-12-27 13:20:46', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_payments_history`
--

CREATE TABLE `tbl_purchase_payments_history` (
  `purchase_payments_history_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_payments_id` varchar(20) NOT NULL,
  `supplier_id` bigint(11) NOT NULL,
  `purchase_amount` varchar(100) NOT NULL,
  `paid_amount` varchar(100) NOT NULL,
  `balance_amount` varchar(50) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `upi_id` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_relations`
--

CREATE TABLE `tbl_purchase_relations` (
  `purchase_relation_id` bigint(20) NOT NULL,
  `purchase_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_id` bigint(20) DEFAULT NULL,
  `brand_name` varchar(100) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `subcategory_id` bigint(20) DEFAULT NULL,
  `subcategory_name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tax_id` bigint(20) DEFAULT NULL,
  `tax_percent` varchar(20) DEFAULT NULL,
  `tax_total` varchar(50) DEFAULT NULL,
  `quantity` varchar(10) NOT NULL,
  `available_quantity` varchar(11) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `purchase_return_product_status` int(11) DEFAULT 0,
  `purchase_relation_status` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_relations`
--

INSERT INTO `tbl_purchase_relations` (`purchase_relation_id`, `purchase_id`, `product_id`, `product_name`, `brand_id`, `brand_name`, `category_id`, `category_name`, `subcategory_id`, `subcategory_name`, `image`, `tax_id`, `tax_percent`, `tax_total`, `quantity`, `available_quantity`, `rate`, `total`, `created_on`, `created_by`, `updated_on`, `updated_by`, `purchase_return_product_status`, `purchase_relation_status`, `status`) VALUES
(1, 1, 15, 'Polyester Color Yarn', 0, '', 8, 'Yarn', 0, NULL, NULL, 0, '0', '', '10', '10', '39', '390', '2021-12-27 13:20:46', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1),
(2, 1, 16, 'Flammant Color Yarn ', 0, '', 8, 'Yarn', 0, NULL, NULL, 0, '0', '', '20', '20', '19', '380', '2021-12-27 13:20:46', 7, '0000-00-00 00:00:00', 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_relation_temp`
--

CREATE TABLE `tbl_purchase_relation_temp` (
  `purchase_relation_temp_id` bigint(20) NOT NULL,
  `purchase_relation_id` int(11) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `brand_name` varchar(20) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `quantity` varchar(50) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_percent` varchar(11) DEFAULT NULL,
  `tax_total` varchar(20) DEFAULT NULL,
  `total` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_relation_temp`
--

INSERT INTO `tbl_purchase_relation_temp` (`purchase_relation_temp_id`, `purchase_relation_id`, `product_id`, `product_name`, `brand_id`, `brand_name`, `category_id`, `category_name`, `quantity`, `rate`, `amount`, `tax_id`, `tax_percent`, `tax_total`, `total`, `created_on`, `created_by`, `status`) VALUES
(1, NULL, 15, 'Polyester Color Yarn', NULL, NULL, 8, 'Yarn', '10', '39', '390', 0, '0', '', '390', '2021-12-27 13:20:36', 7, 1),
(2, NULL, 16, 'Flammant Color Yarn ', NULL, NULL, 8, 'Yarn', '20', '19', '380', 0, '0', '', '380', '2021-12-27 13:20:44', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_return`
--

CREATE TABLE `tbl_purchase_return` (
  `purchase_return_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_return_number` varchar(50) NOT NULL,
  `purchase_return_date` date NOT NULL,
  `purchase_return_supplier` bigint(20) NOT NULL,
  `purchase_return_purchase_id` bigint(20) NOT NULL,
  `purchase_return_remarks` text DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_return_relations`
--

CREATE TABLE `tbl_purchase_return_relations` (
  `purchase_return_relation_id` bigint(20) NOT NULL,
  `purchase_return_id` bigint(20) NOT NULL,
  `purchase_relation_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_id` bigint(20) DEFAULT NULL,
  `brand_name` varchar(100) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `subcategory_id` bigint(20) DEFAULT NULL,
  `subcategory_name` varchar(100) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_percentage` varchar(100) DEFAULT NULL,
  `current_quantity` int(50) NOT NULL,
  `return_quantity` varchar(50) NOT NULL,
  `balance_quantity` varchar(11) DEFAULT NULL,
  `rate` varchar(11) DEFAULT NULL,
  `total` varchar(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotations`
--

CREATE TABLE `tbl_quotations` (
  `quotation_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `quotation_number` varchar(100) NOT NULL,
  `quotation_date` date NOT NULL,
  `quotation_type` int(11) NOT NULL,
  `quotation_customer` bigint(20) NOT NULL,
  `transport_mode` varchar(50) NOT NULL,
  `transport_name` varchar(50) NOT NULL,
  `quotation_employee` bigint(20) NOT NULL,
  `transport_vechile_no` varchar(50) NOT NULL,
  `quotation_gst` varchar(50) NOT NULL DEFAULT '0',
  `quotation_loading_changes` varchar(50) NOT NULL DEFAULT '0',
  `quotation_transportaion_changes` varchar(50) NOT NULL DEFAULT '0',
  `quotation_discount` varchar(10) NOT NULL,
  `quotation_advance` varchar(50) NOT NULL DEFAULT '0',
  `quotation_approved` int(11) NOT NULL,
  `quotation_cancel` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotations_relation`
--

CREATE TABLE `tbl_quotations_relation` (
  `quotation_relation_id` bigint(20) NOT NULL,
  `quotation_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `subcategory_name` varchar(100) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_percent` varchar(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `available_quantity` varchar(10) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `tax_total` varchar(50) NOT NULL,
  `total` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotations_relation_temp`
--

CREATE TABLE `tbl_quotations_relation_temp` (
  `quotation_relation_temp_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `quantity` varchar(10) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_payments`
--

CREATE TABLE `tbl_quotation_payments` (
  `quotation_payments_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `quotation_id` varchar(20) NOT NULL,
  `quotation_amount` varchar(20) NOT NULL,
  `quotation_status` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_payments_history`
--

CREATE TABLE `tbl_quotation_payments_history` (
  `quotation_payments_history_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `quotation_payments_id` varchar(20) NOT NULL,
  `customer_id` bigint(11) NOT NULL,
  `quotation_amount` varchar(100) NOT NULL,
  `paid_amount` varchar(100) NOT NULL,
  `balance_amount` varchar(50) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `upi_id` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipts`
--

CREATE TABLE `tbl_receipts` (
  `receipt_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `receipt_type` int(11) NOT NULL DEFAULT 1 COMMENT '	1 means normal receipt, 2 means sales return	',
  `receipt_sales_return_id` bigint(20) NOT NULL DEFAULT 0,
  `receipt_number` varchar(50) NOT NULL,
  `receipt_date` date NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_type_id` int(11) DEFAULT NULL,
  `paid_amount` varchar(50) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `upi_id` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receipts`
--

INSERT INTO `tbl_receipts` (`receipt_id`, `company_id`, `receipt_type`, `receipt_sales_return_id`, `receipt_number`, `receipt_date`, `customer_id`, `customer_type_id`, `paid_amount`, `payment_type`, `cheque_no`, `bank_name`, `upi_id`, `remarks`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 1, 0, 'NRM/RCP/21-22/0001', '2021-12-27', 8, 1, '575', 'cheque', '0000250', '', '', '', '2021-12-27 13:22:44', 7, '0000-00-00 00:00:00', 0, 1),
(2, 1, 1, 0, 'NRM/RCP/21-22/0002', '2021-12-27', 8, 1, '1000', 'cash', '', '', '', '', '2021-12-27 13:23:53', 7, '0000-00-00 00:00:00', 0, 1),
(3, 1, 1, 0, 'NRM/RCP/21-22/0003', '2021-12-28', 7, 1, '2500', 'cheque', '854751', '', '', 'check', '2021-12-28 12:23:47', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_return`
--

CREATE TABLE `tbl_sales_return` (
  `sales_return_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sales_return_number` varchar(50) NOT NULL,
  `sales_return_date` date NOT NULL,
  `sales_return_customer` bigint(20) NOT NULL,
  `sales_return_invoice_id` bigint(20) NOT NULL,
  `sales_return_remarks` text DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_return_relations`
--

CREATE TABLE `tbl_sales_return_relations` (
  `sales_return_relation_id` bigint(20) NOT NULL,
  `sales_return_id` bigint(20) NOT NULL,
  `invoice_relation_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `subcategory_id` bigint(20) DEFAULT NULL,
  `subcategory_name` varchar(100) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_percentage` varchar(100) DEFAULT NULL,
  `current_quantity` int(50) NOT NULL,
  `return_quantity` varchar(50) NOT NULL,
  `balance_quantity` varchar(11) DEFAULT NULL,
  `rate` varchar(11) NOT NULL,
  `total` varchar(11) DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `company_id`, `branch_id`, `product_id`, `quantity`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 0, 0, 1, '-20', '2021-12-23 10:43:08', 7, '2021-12-23 10:44:24', 7, 1),
(2, 0, 0, 2, '12', '2021-12-23 10:43:08', 7, '2021-12-23 10:44:24', 7, 1),
(3, 0, 0, 3, '-37', '2021-12-23 10:43:08', 7, '2021-12-23 10:44:24', 7, 1),
(4, 0, 0, 4, '-8', '2021-12-23 10:43:08', 7, '2021-12-23 10:44:24', 7, 1),
(5, 0, 0, 5, '30', '2021-12-23 10:43:08', 7, '2021-12-23 10:44:24', 7, 1),
(6, 0, 0, 6, '66', '2021-12-23 10:43:08', 7, '2021-12-23 10:44:24', 7, 1),
(7, 0, 0, 7, '67', '2021-12-23 10:43:08', 7, '2021-12-23 10:44:24', 7, 1),
(8, 0, 0, 8, '88', '2021-12-23 10:43:08', 7, '2021-12-23 10:44:24', 7, 1),
(9, 0, 0, 9, '87', '2021-12-23 10:43:09', 7, '2021-12-23 10:44:24', 7, 1),
(10, 0, 0, 10, '55', '2021-12-23 10:43:09', 7, '2021-12-23 10:44:24', 7, 1),
(11, 0, 0, 11, '44', '2021-12-23 10:43:09', 7, '2021-12-23 10:44:24', 7, 1),
(12, 0, 0, 12, '70', '2021-12-23 10:43:09', 7, '2021-12-23 10:44:24', 7, 1),
(13, 0, 0, 13, '66', '2021-12-23 10:43:09', 7, '2021-12-23 10:44:24', 7, 1),
(14, 1, 0, 15, '124', '2021-12-27 13:20:46', 7, '2021-12-23 10:44:24', 7, 1),
(15, 1, 0, 16, '74', '2021-12-27 13:20:46', 7, '2021-12-23 10:44:24', 7, 1),
(16, 1, 0, 19, '268', '2021-12-27 12:10:31', 7, '2021-12-23 10:44:25', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_adjustment`
--

CREATE TABLE `tbl_stock_adjustment` (
  `stock_adjustment_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `initial_quantity` varchar(50) NOT NULL,
  `new_quantity` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_inward`
--

CREATE TABLE `tbl_stock_inward` (
  `stock_inward_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_stock_inward`
--

INSERT INTO `tbl_stock_inward` (`stock_inward_id`, `company_id`, `branch_id`, `date`, `remarks`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, 0, '2021-12-27', 'Direct Purchase Entry ', '2021-12-27 13:20:46', 7, '0000-00-00 00:00:00', 0, 1),
(2, 1, 0, '2021-12-27', 'Direct Purchase Entry ', '2021-12-27 13:20:46', 7, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_inward_relations`
--

CREATE TABLE `tbl_stock_inward_relations` (
  `stock_inward_relation_id` bigint(20) NOT NULL,
  `stock_inward_id` bigint(20) NOT NULL,
  `purchase_dc_id` int(11) DEFAULT NULL,
  `purchase_relation_id` int(11) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock_inward_relations`
--

INSERT INTO `tbl_stock_inward_relations` (`stock_inward_relation_id`, `stock_inward_id`, `purchase_dc_id`, `purchase_relation_id`, `product_id`, `quantity`, `created_on`, `created_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 1, NULL, 1, 15, '10', '2021-12-27 13:20:46', 7, '0000-00-00 00:00:00', 0, 1),
(2, 2, NULL, 2, 16, '20', '2021-12-27 13:20:46', 7, '0000-00-00 00:00:00', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `mst_access_levels`
--
ALTER TABLE `mst_access_levels`
  ADD PRIMARY KEY (`access_level_id`);

--
-- Indexes for table `mst_access_names`
--
ALTER TABLE `mst_access_names`
  ADD PRIMARY KEY (`access_name_id`);

--
-- Indexes for table `mst_branches`
--
ALTER TABLE `mst_branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `mst_brands`
--
ALTER TABLE `mst_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `mst_category`
--
ALTER TABLE `mst_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `mst_colours`
--
ALTER TABLE `mst_colours`
  ADD PRIMARY KEY (`colour_id`);

--
-- Indexes for table `mst_customers`
--
ALTER TABLE `mst_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `mst_customer_type`
--
ALTER TABLE `mst_customer_type`
  ADD PRIMARY KEY (`customer_type_id`);

--
-- Indexes for table `mst_estimate_settings`
--
ALTER TABLE `mst_estimate_settings`
  ADD PRIMARY KEY (`estimate_settings_id`);

--
-- Indexes for table `mst_expense_categories`
--
ALTER TABLE `mst_expense_categories`
  ADD PRIMARY KEY (`expense_category_id`);

--
-- Indexes for table `mst_general_settings`
--
ALTER TABLE `mst_general_settings`
  ADD PRIMARY KEY (`general_settings_id`);

--
-- Indexes for table `mst_invoice_settings`
--
ALTER TABLE `mst_invoice_settings`
  ADD PRIMARY KEY (`invoice_settings_id`);

--
-- Indexes for table `mst_modules`
--
ALTER TABLE `mst_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `mst_prefix`
--
ALTER TABLE `mst_prefix`
  ADD PRIMARY KEY (`prefix_id`);

--
-- Indexes for table `mst_products`
--
ALTER TABLE `mst_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `mst_product_settings`
--
ALTER TABLE `mst_product_settings`
  ADD PRIMARY KEY (`product_settings_id`);

--
-- Indexes for table `mst_product_type`
--
ALTER TABLE `mst_product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `mst_purchase_settings`
--
ALTER TABLE `mst_purchase_settings`
  ADD PRIMARY KEY (`purchase_settings_id`);

--
-- Indexes for table `mst_quotation_settings`
--
ALTER TABLE `mst_quotation_settings`
  ADD PRIMARY KEY (`quotation_settings_id`);

--
-- Indexes for table `mst_sales_person`
--
ALTER TABLE `mst_sales_person`
  ADD PRIMARY KEY (`sales_person_id`);

--
-- Indexes for table `mst_secondary_units`
--
ALTER TABLE `mst_secondary_units`
  ADD PRIMARY KEY (`secondary_unit_id`);

--
-- Indexes for table `mst_settings`
--
ALTER TABLE `mst_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `mst_sizes`
--
ALTER TABLE `mst_sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `mst_state`
--
ALTER TABLE `mst_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `mst_subcategory`
--
ALTER TABLE `mst_subcategory`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `mst_sub_modules`
--
ALTER TABLE `mst_sub_modules`
  ADD PRIMARY KEY (`sub_module_id`);

--
-- Indexes for table `mst_suppliers`
--
ALTER TABLE `mst_suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `mst_taxs`
--
ALTER TABLE `mst_taxs`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `mst_tax_type`
--
ALTER TABLE `mst_tax_type`
  ADD PRIMARY KEY (`tax_type_id`);

--
-- Indexes for table `mst_transports`
--
ALTER TABLE `mst_transports`
  ADD PRIMARY KEY (`transport_id`);

--
-- Indexes for table `mst_units`
--
ALTER TABLE `mst_units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `mst_users`
--
ALTER TABLE `mst_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_buyers_po`
--
ALTER TABLE `tbl_buyers_po`
  ADD PRIMARY KEY (`buyers_po_id`);

--
-- Indexes for table `tbl_buyers_po_relation`
--
ALTER TABLE `tbl_buyers_po_relation`
  ADD PRIMARY KEY (`buyers_po_relation_id`);

--
-- Indexes for table `tbl_dcs`
--
ALTER TABLE `tbl_dcs`
  ADD PRIMARY KEY (`dc_id`);

--
-- Indexes for table `tbl_dcs_relation`
--
ALTER TABLE `tbl_dcs_relation`
  ADD PRIMARY KEY (`dc_relation_id`);

--
-- Indexes for table `tbl_dcs_relation_temp`
--
ALTER TABLE `tbl_dcs_relation_temp`
  ADD PRIMARY KEY (`dc_relation_temp_id`);

--
-- Indexes for table `tbl_estimates`
--
ALTER TABLE `tbl_estimates`
  ADD PRIMARY KEY (`estimate_id`);

--
-- Indexes for table `tbl_estimates_relation`
--
ALTER TABLE `tbl_estimates_relation`
  ADD PRIMARY KEY (`estimate_relation_id`);

--
-- Indexes for table `tbl_estimates_relation_temp`
--
ALTER TABLE `tbl_estimates_relation_temp`
  ADD PRIMARY KEY (`estimate_relation_temp_id`);

--
-- Indexes for table `tbl_estimate_payments`
--
ALTER TABLE `tbl_estimate_payments`
  ADD PRIMARY KEY (`estimate_payments_id`);

--
-- Indexes for table `tbl_estimate_payments_history`
--
ALTER TABLE `tbl_estimate_payments_history`
  ADD PRIMARY KEY (`estimate_payments_history_id`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_invoices_relation`
--
ALTER TABLE `tbl_invoices_relation`
  ADD PRIMARY KEY (`invoice_relation_id`);

--
-- Indexes for table `tbl_invoices_relation_temp`
--
ALTER TABLE `tbl_invoices_relation_temp`
  ADD PRIMARY KEY (`invoice_relation_temp_id`);

--
-- Indexes for table `tbl_invoice_payments`
--
ALTER TABLE `tbl_invoice_payments`
  ADD PRIMARY KEY (`invoice_payments_id`);

--
-- Indexes for table `tbl_invoice_payments_history`
--
ALTER TABLE `tbl_invoice_payments_history`
  ADD PRIMARY KEY (`invoice_payments_history_id`);

--
-- Indexes for table `tbl_journals`
--
ALTER TABLE `tbl_journals`
  ADD PRIMARY KEY (`journal_id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_log_category`
--
ALTER TABLE `tbl_log_category`
  ADD PRIMARY KEY (`log_category_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `tbl_purchase_dc`
--
ALTER TABLE `tbl_purchase_dc`
  ADD PRIMARY KEY (`purchase_dc_id`);

--
-- Indexes for table `tbl_purchase_dc_relations`
--
ALTER TABLE `tbl_purchase_dc_relations`
  ADD PRIMARY KEY (`purchase_dc_relation_id`);

--
-- Indexes for table `tbl_purchase_dc_relation_temp`
--
ALTER TABLE `tbl_purchase_dc_relation_temp`
  ADD PRIMARY KEY (`purchase_dc_relation_temp_id`);

--
-- Indexes for table `tbl_purchase_orders`
--
ALTER TABLE `tbl_purchase_orders`
  ADD PRIMARY KEY (`purchase_order_id`);

--
-- Indexes for table `tbl_purchase_orders_relations`
--
ALTER TABLE `tbl_purchase_orders_relations`
  ADD PRIMARY KEY (`purchase_order_relation_id`);

--
-- Indexes for table `tbl_purchase_orders_relation_temp`
--
ALTER TABLE `tbl_purchase_orders_relation_temp`
  ADD PRIMARY KEY (`purchase_order_relation_temp_id`);

--
-- Indexes for table `tbl_purchase_payments`
--
ALTER TABLE `tbl_purchase_payments`
  ADD PRIMARY KEY (`purchase_payments_id`);

--
-- Indexes for table `tbl_purchase_payments_history`
--
ALTER TABLE `tbl_purchase_payments_history`
  ADD PRIMARY KEY (`purchase_payments_history_id`);

--
-- Indexes for table `tbl_purchase_relations`
--
ALTER TABLE `tbl_purchase_relations`
  ADD PRIMARY KEY (`purchase_relation_id`);

--
-- Indexes for table `tbl_purchase_relation_temp`
--
ALTER TABLE `tbl_purchase_relation_temp`
  ADD PRIMARY KEY (`purchase_relation_temp_id`);

--
-- Indexes for table `tbl_purchase_return`
--
ALTER TABLE `tbl_purchase_return`
  ADD PRIMARY KEY (`purchase_return_id`);

--
-- Indexes for table `tbl_purchase_return_relations`
--
ALTER TABLE `tbl_purchase_return_relations`
  ADD PRIMARY KEY (`purchase_return_relation_id`);

--
-- Indexes for table `tbl_quotations`
--
ALTER TABLE `tbl_quotations`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `tbl_quotations_relation`
--
ALTER TABLE `tbl_quotations_relation`
  ADD PRIMARY KEY (`quotation_relation_id`);

--
-- Indexes for table `tbl_quotations_relation_temp`
--
ALTER TABLE `tbl_quotations_relation_temp`
  ADD PRIMARY KEY (`quotation_relation_temp_id`);

--
-- Indexes for table `tbl_quotation_payments`
--
ALTER TABLE `tbl_quotation_payments`
  ADD PRIMARY KEY (`quotation_payments_id`);

--
-- Indexes for table `tbl_quotation_payments_history`
--
ALTER TABLE `tbl_quotation_payments_history`
  ADD PRIMARY KEY (`quotation_payments_history_id`);

--
-- Indexes for table `tbl_receipts`
--
ALTER TABLE `tbl_receipts`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `tbl_sales_return`
--
ALTER TABLE `tbl_sales_return`
  ADD PRIMARY KEY (`sales_return_id`);

--
-- Indexes for table `tbl_sales_return_relations`
--
ALTER TABLE `tbl_sales_return_relations`
  ADD PRIMARY KEY (`sales_return_relation_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_stock_adjustment`
--
ALTER TABLE `tbl_stock_adjustment`
  ADD PRIMARY KEY (`stock_adjustment_id`);

--
-- Indexes for table `tbl_stock_inward`
--
ALTER TABLE `tbl_stock_inward`
  ADD PRIMARY KEY (`stock_inward_id`);

--
-- Indexes for table `tbl_stock_inward_relations`
--
ALTER TABLE `tbl_stock_inward_relations`
  ADD PRIMARY KEY (`stock_inward_relation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_access_levels`
--
ALTER TABLE `mst_access_levels`
  MODIFY `access_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_access_names`
--
ALTER TABLE `mst_access_names`
  MODIFY `access_name_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_branches`
--
ALTER TABLE `mst_branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_brands`
--
ALTER TABLE `mst_brands`
  MODIFY `brand_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_category`
--
ALTER TABLE `mst_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mst_colours`
--
ALTER TABLE `mst_colours`
  MODIFY `colour_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_customers`
--
ALTER TABLE `mst_customers`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mst_customer_type`
--
ALTER TABLE `mst_customer_type`
  MODIFY `customer_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_estimate_settings`
--
ALTER TABLE `mst_estimate_settings`
  MODIFY `estimate_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_expense_categories`
--
ALTER TABLE `mst_expense_categories`
  MODIFY `expense_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_general_settings`
--
ALTER TABLE `mst_general_settings`
  MODIFY `general_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_invoice_settings`
--
ALTER TABLE `mst_invoice_settings`
  MODIFY `invoice_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mst_modules`
--
ALTER TABLE `mst_modules`
  MODIFY `module_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_prefix`
--
ALTER TABLE `mst_prefix`
  MODIFY `prefix_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_products`
--
ALTER TABLE `mst_products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mst_product_settings`
--
ALTER TABLE `mst_product_settings`
  MODIFY `product_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mst_product_type`
--
ALTER TABLE `mst_product_type`
  MODIFY `product_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_purchase_settings`
--
ALTER TABLE `mst_purchase_settings`
  MODIFY `purchase_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mst_quotation_settings`
--
ALTER TABLE `mst_quotation_settings`
  MODIFY `quotation_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_sales_person`
--
ALTER TABLE `mst_sales_person`
  MODIFY `sales_person_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_secondary_units`
--
ALTER TABLE `mst_secondary_units`
  MODIFY `secondary_unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_settings`
--
ALTER TABLE `mst_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `mst_sizes`
--
ALTER TABLE `mst_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mst_subcategory`
--
ALTER TABLE `mst_subcategory`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_sub_modules`
--
ALTER TABLE `mst_sub_modules`
  MODIFY `sub_module_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `mst_suppliers`
--
ALTER TABLE `mst_suppliers`
  MODIFY `supplier_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_taxs`
--
ALTER TABLE `mst_taxs`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_tax_type`
--
ALTER TABLE `mst_tax_type`
  MODIFY `tax_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_transports`
--
ALTER TABLE `mst_transports`
  MODIFY `transport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_units`
--
ALTER TABLE `mst_units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_users`
--
ALTER TABLE `mst_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_buyers_po`
--
ALTER TABLE `tbl_buyers_po`
  MODIFY `buyers_po_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_buyers_po_relation`
--
ALTER TABLE `tbl_buyers_po_relation`
  MODIFY `buyers_po_relation_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dcs`
--
ALTER TABLE `tbl_dcs`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_dcs_relation`
--
ALTER TABLE `tbl_dcs_relation`
  MODIFY `dc_relation_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_dcs_relation_temp`
--
ALTER TABLE `tbl_dcs_relation_temp`
  MODIFY `dc_relation_temp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_estimates`
--
ALTER TABLE `tbl_estimates`
  MODIFY `estimate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_estimates_relation`
--
ALTER TABLE `tbl_estimates_relation`
  MODIFY `estimate_relation_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_estimates_relation_temp`
--
ALTER TABLE `tbl_estimates_relation_temp`
  MODIFY `estimate_relation_temp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_estimate_payments`
--
ALTER TABLE `tbl_estimate_payments`
  MODIFY `estimate_payments_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_estimate_payments_history`
--
ALTER TABLE `tbl_estimate_payments_history`
  MODIFY `estimate_payments_history_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `expense_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_invoices_relation`
--
ALTER TABLE `tbl_invoices_relation`
  MODIFY `invoice_relation_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_invoices_relation_temp`
--
ALTER TABLE `tbl_invoices_relation_temp`
  MODIFY `invoice_relation_temp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_invoice_payments`
--
ALTER TABLE `tbl_invoice_payments`
  MODIFY `invoice_payments_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_invoice_payments_history`
--
ALTER TABLE `tbl_invoice_payments_history`
  MODIFY `invoice_payments_history_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_journals`
--
ALTER TABLE `tbl_journals`
  MODIFY `journal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_log_category`
--
ALTER TABLE `tbl_log_category`
  MODIFY `log_category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `purchase_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchase_dc`
--
ALTER TABLE `tbl_purchase_dc`
  MODIFY `purchase_dc_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_dc_relations`
--
ALTER TABLE `tbl_purchase_dc_relations`
  MODIFY `purchase_dc_relation_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_dc_relation_temp`
--
ALTER TABLE `tbl_purchase_dc_relation_temp`
  MODIFY `purchase_dc_relation_temp_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_orders`
--
ALTER TABLE `tbl_purchase_orders`
  MODIFY `purchase_order_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_orders_relations`
--
ALTER TABLE `tbl_purchase_orders_relations`
  MODIFY `purchase_order_relation_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_orders_relation_temp`
--
ALTER TABLE `tbl_purchase_orders_relation_temp`
  MODIFY `purchase_order_relation_temp_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_payments`
--
ALTER TABLE `tbl_purchase_payments`
  MODIFY `purchase_payments_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchase_payments_history`
--
ALTER TABLE `tbl_purchase_payments_history`
  MODIFY `purchase_payments_history_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_relations`
--
ALTER TABLE `tbl_purchase_relations`
  MODIFY `purchase_relation_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_purchase_relation_temp`
--
ALTER TABLE `tbl_purchase_relation_temp`
  MODIFY `purchase_relation_temp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_purchase_return`
--
ALTER TABLE `tbl_purchase_return`
  MODIFY `purchase_return_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_return_relations`
--
ALTER TABLE `tbl_purchase_return_relations`
  MODIFY `purchase_return_relation_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotations`
--
ALTER TABLE `tbl_quotations`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotations_relation`
--
ALTER TABLE `tbl_quotations_relation`
  MODIFY `quotation_relation_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotations_relation_temp`
--
ALTER TABLE `tbl_quotations_relation_temp`
  MODIFY `quotation_relation_temp_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation_payments`
--
ALTER TABLE `tbl_quotation_payments`
  MODIFY `quotation_payments_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation_payments_history`
--
ALTER TABLE `tbl_quotation_payments_history`
  MODIFY `quotation_payments_history_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_receipts`
--
ALTER TABLE `tbl_receipts`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sales_return`
--
ALTER TABLE `tbl_sales_return`
  MODIFY `sales_return_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales_return_relations`
--
ALTER TABLE `tbl_sales_return_relations`
  MODIFY `sales_return_relation_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_stock_adjustment`
--
ALTER TABLE `tbl_stock_adjustment`
  MODIFY `stock_adjustment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_stock_inward`
--
ALTER TABLE `tbl_stock_inward`
  MODIFY `stock_inward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_stock_inward_relations`
--
ALTER TABLE `tbl_stock_inward_relations`
  MODIFY `stock_inward_relation_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
