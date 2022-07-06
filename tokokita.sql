-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2022 at 06:12 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokokita`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Royhan Daffa', 'admin@gmail.com', '$2y$10$/Jkys/0vL3vkYL3vX13A1efQ9P00rMpfFZU2qO89QCcnAfua642VW');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `createAt`) VALUES
(1, 'Aksesoris', '2022-06-30 09:14:44'),
(3, 'Pakaian', '2022-06-30 09:02:46'),
(4, 'Sepatu', '2022-06-30 09:14:51'),
(5, 'Peralatan', '2022-06-30 09:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `customer_id`, `cart_id`, `payment_id`, `status`, `total_price`, `createAt`) VALUES
(4, 1, 19, 3, 'Belum Dibayar', 2990000, '2022-07-01 07:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` char(15) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `password`, `email`, `phone_number`, `address`) VALUES
(1, 'Hari Prakoso', '$2y$10$QDBseeibeB.lEKBHYCZjoOQ6t7rOw9w4V0pqMoslhEZuOxc9JgCJ2', 'ambon@gmail.com', '', 'pasuruan');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `account_number` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `payment_method`, `account_number`) VALUES
(1, 'Bank BRI', '6723 2123 1235 923'),
(2, 'Bank BSI', '0895 3960 02259'),
(3, 'Dana', '0895396002259');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `size` char(10) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `size`, `createAt`) VALUES
(1, 5, 'Molten Gr7d Outdoor Rubber', 'Bola Basket Molten Orange Ukuran 7 Yang Dapat Digunakan Di Lapangan Outdoor\r\n', 299000, 100, '7', '2022-07-01 10:03:38'),
(2, 5, 'Nike Pro Ankle Sleeve 3.0', 'Nike Pro Ankle Sleeve Adalah Pilihan Tepat Saat Anda Membutuhkan Dukungan Ekstra Saat Berolahraga. Dengan Konstruksi Peregangan Bernapas, Pembungkus Pergelangan Kaki Ini Memberikan Dukungan Kompresi Ringan.', 359000, 99, 'XL', '2022-06-30 16:39:50'),
(3, 4, 'Under Armour Curry 8 Iridium', 'Curry Flow 8 Benar-benar Tanpa Karet, Membuatnya Lebih Ringan Dan Sangat Mencengkeram. Ini Memberi Anda Nuansa Lapangan Yang Lebih Baik, Memungkinkan Anda Memulai Dan Berhenti Sepeserpun, Dan Turun Lebih Cepat.', 1799000, 99, '43', '2022-06-30 16:41:12'),
(4, 4, 'Nike Lebron 17 Gs Constellations', 'Sepatu Lebron 17 Berwarna Biru', 1999000, 99, '36', '2022-06-30 16:43:07'),
(5, 4, 'Nike Kd Trey 5 Ix Ep', 'Midsole Mengelilingi Busa Nike yang Lembut dan Responsif Dengan Busa Yang Lebih Kaku Untuk Kenyamanan Dan Stabilitas', 1099000, 99, '41', '2022-06-30 16:46:24'),
(6, 3, 'Nike Kevin Durant Brooklyn Nets Jersey', 'Produk Ini Dibuat Dengan 100% Serat Poliester Daur Ulang, Standar Cocok Untuk Perasaan Santai dan Mudah, Grafik Tim Dan Pemain yang Diterapkan Panas, Teknologi Dri-fit Memindahkan Keringat Dari Kulit Anda Untuk Penguapan Lebih Cepat—membantu Anda Tetap Kering, Nyaman, Dan Fokus.', 999000, 99, 'L', '2022-06-30 20:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_galleries`
--

INSERT INTO `product_galleries` (`id`, `product_id`, `image`) VALUES
(1, 1, '62bd6bb3ddaff.jpg'),
(3, 3, '62bd6fb89e15c.jpg'),
(4, 4, '62bd702b918c6.jpg'),
(6, 6, '62bda29ca054a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `report_text` text NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `customer_id`, `report_text`, `createAt`) VALUES
(2, 1, 'Tidak ada informasi seputar pengiriman barang', '2022-07-01 03:36:28'),
(4, 1, 'Tidak ada diskon', '2022-07-01 03:38:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_product` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_detail` (`customer_id`),
  ADD KEY `fk_product_order` (`cart_id`),
  ADD KEY `fk_payment_checkout` (`payment_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_product` (`category_id`);

--
-- Indexes for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_photo` (`product_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_report_customer` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `fk_customer_checkout` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `fk_payment_checkout` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_category_product` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD CONSTRAINT `fk_product_photo` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
