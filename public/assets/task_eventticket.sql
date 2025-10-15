-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Okt 2025 pada 12.32
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_eventticket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_transaction`
--

CREATE TABLE `booking_transaction` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `customer_bank_name` varchar(255) DEFAULT NULL,
  `customer_bank_account` varchar(255) DEFAULT NULL,
  `customer_bank_number` varchar(50) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `total_amount` int(11) NOT NULL DEFAULT 0,
  `workshop_id` int(11) NOT NULL,
  `is_paid` tinyint(1) DEFAULT 0,
  `quantity` int(11) DEFAULT 1,
  `booking_trx_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `workshop_id` int(11) DEFAULT NULL,
  `booking_transaction_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `occupation`, `email`, `password`, `role`, `workshop_id`, `booking_transaction_id`, `created_at`, `updated_at`) VALUES
(2, 'reyhan', 'reyhan', 'reyhan@gmail.com', '$2y$10$l0z20tK95jbiDEg6yQ4aAuznqia7Dor//eI.KTUW.EFDvLCvgk0gu', 'user', NULL, NULL, '2025-10-13 20:10:48', '2025-10-13 20:10:48'),
(3, 'admin@gmail.com', 'admin', 'admin@gmail.com', '$2y$10$uKMB1B4giMuP9QLWuFkVeuFYE1sHN530SGO8FfR56zyaq9MoXO5Ha', 'admin', NULL, NULL, '2025-10-13 20:12:40', '2025-10-13 20:12:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `workshop`
--

CREATE TABLE `workshop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `venue_thumbnail` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `started_at` date DEFAULT NULL,
  `time_at` time DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bg_map` varchar(255) DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT 1,
  `has_started` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `workshop`
--

INSERT INTO `workshop` (`id`, `name`, `slug`, `thumbnail`, `venue_thumbnail`, `about`, `price`, `started_at`, `time_at`, `address`, `bg_map`, `is_open`, `has_started`, `created_at`, `updated_at`) VALUES
(1, 'Alisa Roberson', 'Aut earum iure fuga', '/uploads/thumb_68ed66f8421ba.png', NULL, 'Ut sunt anim qui la', 900000, '2025-10-22', '18:09:00', 'Ipsum ad lorem numq', NULL, 1, 0, '2025-10-13 20:54:16', '2025-10-13 20:54:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking_transaction`
--
ALTER TABLE `booking_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_trx_id` (`booking_trx_id`),
  ADD KEY `idx_booking_workshop` (`workshop_id`),
  ADD KEY `idx_booking_trxid` (`booking_trx_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `workshop_id` (`workshop_id`),
  ADD KEY `booking_transaction_id` (`booking_transaction_id`),
  ADD KEY `idx_users_email` (`email`);

--
-- Indeks untuk tabel `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_workshop_started_at` (`started_at`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking_transaction`
--
ALTER TABLE `booking_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `workshop`
--
ALTER TABLE `workshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking_transaction`
--
ALTER TABLE `booking_transaction`
  ADD CONSTRAINT `booking_transaction_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshop` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshop` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`booking_transaction_id`) REFERENCES `booking_transaction` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
