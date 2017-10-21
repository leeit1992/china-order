-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2017 lúc 03:54 AM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project8`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_banks`
--

CREATE TABLE `avt_banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_user_name` varchar(255) DEFAULT NULL,
  `bank_number` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `avt_banks`
--

INSERT INTO `avt_banks` (`id`, `bank_name`, `bank_user_name`, `bank_number`, `bank_address`) VALUES
(1, 'Vietcombank', 'Le Trung Ha', '060967967', 'Dong Da'),
(2, 'Viettinbank', 'Le Trung Ha', '060967967', 'Hn'),
(3, 'ACB', 'Le Trung Ha', '12345678', 'Tay Ha Noi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_billoflading`
--

CREATE TABLE `avt_billoflading` (
  `id` int(11) NOT NULL,
  `day_in_stock` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `shop_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_item_id` text,
  `general_id` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `price_ship` varchar(255) DEFAULT NULL,
  `price_status` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_expenditure`
--

CREATE TABLE `avt_expenditure` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `rest_payment` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_notices`
--

CREATE TABLE `avt_notices` (
  `id` int(11) NOT NULL,
  `notice_title` varchar(255) DEFAULT NULL,
  `notice_description` text,
  `notice_sender` int(11) DEFAULT NULL,
  `notice_receiver` int(11) DEFAULT NULL,
  `notice_status` tinyint(2) DEFAULT NULL,
  `notice_link` varchar(255) DEFAULT NULL,
  `notice_type` varchar(30) DEFAULT NULL,
  `notice_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_options`
--

CREATE TABLE `avt_options` (
  `id` int(11) NOT NULL,
  `option_key` varchar(255) DEFAULT NULL,
  `option_value` longtext,
  `option_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `avt_options`
--

INSERT INTO `avt_options` (`id`, `option_key`, `option_value`, `option_type`) VALUES
(1, 'currency_rate', '3449', NULL),
(2, 'priceByWeight', '[\"2555\",\"2555\",\"2555\",\"36300\",\"12345\",\"32165\",\"12345\",\"12345\"]', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_orders`
--

CREATE TABLE `avt_orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_note` text,
  `order_quantity` int(11) DEFAULT NULL,
  `order_total_price_cn` varchar(255) DEFAULT NULL,
  `order_total_price_vn` varchar(255) DEFAULT NULL,
  `order_real_purchase` int(11) DEFAULT NULL,
  `order_status` tinyint(2) DEFAULT NULL,
  `order_buy_status` tinyint(2) DEFAULT NULL,
  `order_delivery_status` tinyint(2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_seller` varchar(255) DEFAULT NULL,
  `order_info_pay` text,
  `order_arises_price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_order_items`
--

CREATE TABLE `avt_order_items` (
  `id` int(11) NOT NULL,
  `order_item_content` longtext,
  `order_item_quantity` int(11) DEFAULT NULL,
  `order_item_real_purchase` int(11) DEFAULT NULL,
  `order_item_status` tinyint(2) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_item_seller` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_item_seller_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_recharge`
--

CREATE TABLE `avt_recharge` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `note` text,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_usermeta`
--

CREATE TABLE `avt_usermeta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avt_users`
--

CREATE TABLE `avt_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_registered` datetime DEFAULT NULL,
  `user_status` tinyint(2) DEFAULT NULL,
  `user_display_name` varchar(255) DEFAULT NULL,
  `user_role` tinyint(2) DEFAULT NULL,
  `user_money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `avt_users`
--

INSERT INTO `avt_users` (`id`, `user_name`, `user_password`, `user_email`, `user_registered`, `user_status`, `user_display_name`, `user_role`, `user_money`) VALUES
(2, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '2017-07-20 14:58:29', 1, 'Admin', 1, 0),
(3, 'Custommer', '21232f297a57a5a743894a0e4a801fc3', 'a@gmail.com', '2017-07-20 14:58:29', 1, 'Custommer', 2, 384173306);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `avt_banks`
--
ALTER TABLE `avt_banks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_billoflading`
--
ALTER TABLE `avt_billoflading`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_expenditure`
--
ALTER TABLE `avt_expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_notices`
--
ALTER TABLE `avt_notices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_options`
--
ALTER TABLE `avt_options`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_orders`
--
ALTER TABLE `avt_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_order_items`
--
ALTER TABLE `avt_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_recharge`
--
ALTER TABLE `avt_recharge`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_usermeta`
--
ALTER TABLE `avt_usermeta`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `avt_users`
--
ALTER TABLE `avt_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `avt_banks`
--
ALTER TABLE `avt_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `avt_billoflading`
--
ALTER TABLE `avt_billoflading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT cho bảng `avt_expenditure`
--
ALTER TABLE `avt_expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT cho bảng `avt_notices`
--
ALTER TABLE `avt_notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `avt_options`
--
ALTER TABLE `avt_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `avt_orders`
--
ALTER TABLE `avt_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT cho bảng `avt_order_items`
--
ALTER TABLE `avt_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT cho bảng `avt_recharge`
--
ALTER TABLE `avt_recharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `avt_usermeta`
--
ALTER TABLE `avt_usermeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `avt_users`
--
ALTER TABLE `avt_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
