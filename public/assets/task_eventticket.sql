-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2025 pada 15.07
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
  `user_id` int(10) DEFAULT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `used_at` datetime DEFAULT NULL,
  `used_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking_transaction`
--

INSERT INTO `booking_transaction` (`id`, `user_id`, `name`, `phone`, `email`, `customer_bank_name`, `customer_bank_account`, `customer_bank_number`, `proof`, `total_amount`, `workshop_id`, `is_paid`, `quantity`, `booking_trx_id`, `created_at`, `updated_at`, `is_used`, `used_at`, `used_by`) VALUES
(9, 2, 'Nichole Underwood', '+1 (808) 395-1582', 'vemyripum@mailinator.com', 'Giacomo Wilkerson', 'Aperiam sit numquam', '569', '/uploads/proofs/proof_69023a84a3127.png', 990, 4, 1, 1, 'TRX-20251029-53c0', '2025-10-29 16:02:12', '2025-10-30 13:58:43', 1, '2025-10-30 20:58:43', NULL),
(10, 2, 'budi', '08892379824', 'budi@gmail.com', 'BCA', 'Budi', '395830384', '/uploads/proofs/proof_69036fd1c55af.jpg', 900000, 6, 1, 1, 'TRX-20251030-5ba2', '2025-10-30 14:01:53', '2025-10-30 14:06:01', 1, '2025-10-30 21:06:01', NULL);

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
(3, 'admin@gmail.com', 'admin', 'admin@gmail.com', '$2y$10$uKMB1B4giMuP9QLWuFkVeuFYE1sHN530SGO8FfR56zyaq9MoXO5Ha', 'admin', NULL, NULL, '2025-10-13 20:12:40', '2025-10-13 20:12:40'), --password: "admin123"
(4, 'kaisa', 'dosen', 'kaisa@gmail.com', '$2y$10$ODZzl2M.z3YzHVnQfbNhDekW0fMlMyLalIRWVeyQ2PBhKS.z9ZlO.', 'user', NULL, NULL, '2025-10-16 20:09:45', '2025-10-16 20:09:45'),
(5, 'Vaughan Hanson', 'Elit do non ea dolo', 'pufenaka@mailinator.com', '$2y$10$1uTb9nlDRI.lPY.OS4j6AezKWwSlbBr3zK4rOFyoUXJUgYT6QNiwi', 'user', NULL, NULL, '2025-10-17 20:12:18', '2025-10-17 20:12:18');

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
(1, 'Bitcoin Converence', 'bitcoin-converence', '/uploads/thumb_68f1530506c74.png', '/uploads/venue_68f153050735c.png', 'Velit quae commodi c', 100000, '2025-10-07', '22:53:00', 'Nostrum nihil molest', 'https://www.google.com/maps', 0, 0, '2025-10-13 20:54:16', '2025-10-19 14:29:24'),
(2, 'Coin Fest Asia 2025', 'coin-fest-asia-2025-1', '/uploads/thumb_68f16226ad8d5.jpg', '/uploads/venue_68f16226ade74.jpg', 'lorem insum dolor sit amet', 4250000, '2025-10-30', '06:22:00', 'Bali', 'https://www.google.com/maps', 1, 0, '2025-10-16 21:22:46', '2025-10-16 21:24:38'),
(4, 'token 2049 Singapore', 'token-2049-singapore-1', '/uploads/thumb_68f4f5839031c.png', '/uploads/venue_68f4f58390857.png', 'Error autem magnam a', 990, '2025-11-12', '17:04:00', 'Fuga Labore aut qui', 'https://www.tynidymicizova.com.au', 1, 0, '2025-10-16 21:25:23', '2025-10-19 14:29:38'),
(5, 'Blockchain week asia', 'blockchain-week-asia-1', '/uploads/thumb_68f2a753caa7a.jpeg', '/uploads/venue_68f2a753cafed.png', 'Omnis itaque aliqua', 999, '2025-10-29', '13:44:00', 'Consequatur tenetur ', 'https://www.pusizudalefek.biz', 1, 0, '2025-10-17 20:30:11', '2025-10-19 14:29:11'),
(6, 'test 1', 'test-1-1', '/uploads/thumb_68ffb4ade38f2.jpg', '/uploads/venue_68ffb4ade44fb.png', 'tetstststst o', 900000, '2025-11-07', '01:09:00', 'test', 'https://test.com', 1, 0, '2025-10-27 18:06:37', '2025-10-27 18:06:56');

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
  ADD KEY `idx_booking_trxid` (`booking_trx_id`),
  ADD KEY `idx_booking_transaction_user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `workshop`
--
ALTER TABLE `workshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
