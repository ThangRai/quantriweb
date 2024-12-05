-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 29, 2024 lúc 10:19 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quantriweb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Lê Văn Thắng', 'badaotulong123@gmail.com', '0914476792', 'cần tư vấn', '2024-11-25 03:31:53'),
(2, 'Lê Văn Thắng', 'badaotulong123@gmail.com', '0914476792', 'cần tư vấn', '2024-11-25 03:33:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `menu_link`, `sort_order`) VALUES
(2, 'Dịch Vụ', 'service.php', 1),
(3, 'Tin tức', 'news.php', 2),
(5, 'Sản phẩm', 'sanpham.php', 0),
(6, 'Liên Hệ', 'contact.php', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Chưa xử lý',
  `customer_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `quantity`, `total_price`, `customer_name`, `customer_email`, `customer_address`, `created_at`, `status`, `customer_phone`) VALUES
(1, 3, 2, 800000.00, 'NGUYỄN THỊ NGỌC TRÂM', 'nguyenthingoctram@gmail.com', '22/34 yên thế', '2024-11-22 03:42:39', 'Chưa xử lý', '0914476791'),
(3, 2, 9, 3600000.00, 'Lê Văn Thắng', 'thang@gmail.com', '206 Hoàng Hoa Thám Tân Bình', '2024-11-22 03:44:23', 'Chưa xử lý', '0914476792'),
(4, 4, 6, 2400000.00, 'Nguyễn Thị Minh Thi', 'minhthi@gmail.com', '473/8b lê văn quới bình tân', '2024-11-22 03:48:42', 'Chưa xử lý', '0914476793'),
(6, 2, 34, 13600000.00, 'Nguyễn Văn A', 'a@gmail.com', 'Hồ Chí Minh', '2024-11-23 01:57:52', 'Chưa xử lý', '0914476795'),
(7, 2, 12, 4800000.00, 'Lê Văn B', 'levanb@gmail.com', '473/8B Lê Văn Qưới Bình Tân HCM', '2024-11-25 06:13:56', 'Đã thanh toán', '0914476781');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `noidung` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `noidung`, `image_url`, `created_at`, `author`) VALUES
(1, 'Bài viết 1', 'Mô tả bài viết 1', 'Nội dung bài viết 1', 'uploads/Cot-thu-loi-9.jpg', '2024-11-23 04:37:23', 'Thắng'),
(2, 'Bài viết 2', 'Mô tả bài viết 2', 'Nội dung bài viết 2', 'uploads/kiem-dinh-thiet-bi-dien-1042-1.jpg', '2024-11-25 02:22:02', 'Thắng'),
(9, 'Bài viết 3', 'Mô tả bài viết 3', 'Nội dung bài viết 3', 'uploads/z3853675140187_0fc3bc75fe0b5833a.jpg', '2024-11-25 02:44:35', 'Thắng'),
(10, 'Bài viết 4', 'Mô tả bài viết 4', 'Nội dung bài viết 4', 'uploads/kiem-dinh-bon-chua-xang-dau-1.jpg', '2024-11-25 02:45:01', 'Thắng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `original_price`, `current_price`, `image`, `created_at`) VALUES
(1, 'sản phẩm 1', 1000000.00, 400000.00, 'uploads/image(7).png', '2024-11-22 02:59:38'),
(2, 'sản phẩm 2', 1000000.00, 400000.00, 'uploads/kiem-dinh-bon-chua-xang-dau-1.jpg', '2024-11-22 03:00:12'),
(3, 'sản phẩm 3', 1000000.00, 400000.00, 'uploads/kiem-dinh-bon-chua-xang-dau-1.jpg', '2024-11-22 03:00:40'),
(4, 'sản phẩm 4', 1000000.00, 400000.00, 'uploads/kiem-dinh-bon-chua-xang-dau-1.jpg', '2024-11-22 03:01:23'),
(6, 'Sản phẩm 5', 5000000.00, 2500000.00, 'uploads/cot_thu_loi_chong_set_tac.jpg', '2024-11-25 02:11:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `slideshow`
--

INSERT INTO `slideshow` (`id`, `image_url`, `sort_order`, `caption`) VALUES
(2, 'uploads/674151a611eb7.png', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(11) DEFAULT 0,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `points`, `role`) VALUES
(5, 'Admin', 'admin@gmail.com', 'admin', 100, 'user'),
(7, 'Thắng Admin', 'phimdankhoi@gmail.com', 'admin123', 0, 'admin'),
(9, 'Thắng', 'thangdesign@gmail.com', '123', 10, 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
