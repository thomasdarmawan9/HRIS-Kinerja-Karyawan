-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 25, 2022 at 10:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restapi_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `NIP` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `tempat_kerja` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `NIP`, `name`, `jabatan`, `tempat_kerja`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 2016081019, 'Qonita', 'Supervisor', NULL, 'hr@alamanda.com', NULL, '$2y$10$N7PJq0gEezzH6SoWEBAhquT4TcGHkG6JMjXsIPYTSnDCNPEqITVIW', 1, NULL, '2022-12-21 03:52:45', '2022-12-21 03:52:45'),
(3, 2016081020, 'Danu', 'Staff', NULL, 'danu@almanda.com', NULL, '$2y$10$9GBqd.nTo4HgOyXdc1KsjO9HwyeEXNSN7EyA5sP7OkUGyUb0ESsl6', 1, NULL, '2022-12-22 04:50:43', '2022-12-23 12:44:52'),
(4, 2016081021, 'awan', 'Manager', NULL, 'awan@gmail.com', NULL, '$2y$10$Jhk/XIG5bNRhZ/BpPucdb.fGWjjysAQRlq/FKTf.ZiI.adeTbjZT.', 1, NULL, '2022-12-22 09:17:12', '2022-12-23 12:45:04'),
(6, 2016081023, 'Gina', 'Manager', NULL, 'gina@gmail.com', NULL, '$2y$10$SNw1IKdWYQGAXmMBhbQFTeeOtNOHPmbW.UIUHstGGAIPIpDNbI6Ky', 1, NULL, '2022-12-23 12:56:13', '2022-12-23 12:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `category` int(11) DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT 1,
  `file_path` varchar(255) DEFAULT 'assets/images/blog/default.png',
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_division` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leader_team_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `name_division`, `leader_team_name`, `created_at`, `updated_at`) VALUES
(5, 'Human Resources', 'Qonita', '2022-12-19 07:50:07', '2022-12-21 04:54:28'),
(9, 'Sales & Marketing', 'Thomas Darmawan', '2022-12-22 09:47:58', '2022-12-22 09:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_faktor_penilaian`
--

CREATE TABLE `kriteria_faktor_penilaian` (
  `id` int(11) NOT NULL,
  `kriteria` varchar(100) NOT NULL,
  `faktor` varchar(200) NOT NULL,
  `bobot` int(11) NOT NULL,
  `nilai0` varchar(100) NOT NULL,
  `nilai1` varchar(100) NOT NULL,
  `nilai2` varchar(100) NOT NULL,
  `nilai3` varchar(100) DEFAULT NULL,
  `nilai4` varchar(100) NOT NULL,
  `nilai5` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria_faktor_penilaian`
--

INSERT INTO `kriteria_faktor_penilaian` (`id`, `kriteria`, `faktor`, `bobot`, `nilai0`, `nilai1`, `nilai2`, `nilai3`, `nilai4`, `nilai5`, `created_at`, `updated_at`) VALUES
(1, 'Kemampuan Kerja', 'Target Penyesuaian Kerja', 10, 'batas waktu <90%', 'batas waktu <91% - 95%', 'batas waktu <96% - 99%', NULL, 'batas waktu 100%', 'mendahului batas waktu', '2022-12-21 17:59:32', '2022-12-21 10:36:14'),
(2, 'Kemampuan Kerja', 'Ketelitian', 8, 'ketelitian <90%', 'ketelitian <91% - 95%', 'ketelitian <96% - 99%', NULL, 'ketelitian 100%', 'melebihi ketelitian yang diinginkan', '2022-12-21 17:59:29', '2022-12-21 10:43:34'),
(3, 'Kemampuan Kerja', 'Tindakan Perbaikan', 8, 'Cendrungan praduga saja dan perlu di follow up', 'Cenderung praduga saja dan perlu petunjuk', 'Perlu diberi petunjuk', NULL, 'Hanya satu alternatif untuk satu faktor', '>2 alternatif untuk satu faktor (investigasi & kreatif)', '2022-12-21 17:08:14', '2022-12-21 17:08:14'),
(4, 'Disiplin', 'Prosedur Kerja', 6, 'Tidak mentaati', 'mentaati, cendrung tidak konsisten', 'mentaati, kadang kadang tidak konsisten', NULL, 'selalu mentaati', 'selalu mentaati dan kesadaran pembaharuan', '2022-12-21 17:35:11', '2022-12-21 17:35:11'),
(5, 'Disiplin', 'Kerapihan & kebersihan', 8, 'melanggar', 'mentaati kerapihan', 'selalu mentaati namun tidak konsisten', NULL, 'selalu mentaati dan konsisten', 'selalu mentaati, konsisten dan mensosialisasikan', '2022-12-22 08:31:14', '2022-12-22 08:31:14'),
(7, 'Attitude', 'Kesopanan', 10, 'tidak sopan', 'sopan, tidak konsisten', 'sopan, konsisten kadang2', NULL, 'sopan, konsisten', 'sangat sopan', '2022-12-24 06:22:05', '2022-12-24 06:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2020_05_21_100000_create_teams_table', 1),
(16, '2020_05_21_200000_create_team_user_table', 1),
(17, '2020_10_01_155957_create_sessions_table', 1),
(18, '2020_10_28_064511_create_customer_data_table', 1),
(100, '2014_10_12_000000_create_users_table', 2),
(101, '2014_10_12_100000_create_password_resets_table', 2),
(102, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(103, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(104, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(105, '2016_06_01_000004_create_oauth_clients_table', 2),
(106, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(107, '2019_02_02_112609_create_settings_table', 2),
(108, '2019_08_19_000000_create_failed_jobs_table', 2),
(109, '2020_07_08_141130_create_admins_table', 2),
(110, '2020_07_08_145603_create_permission_tables', 2),
(111, '2020_07_12_220312_create_blogs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\Admin', 2),
(2, 'App\\Models\\Admin', 3),
(4, 'App\\Models\\Admin', 6);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_karyawan`
--

CREATE TABLE `nilai_karyawan` (
  `id` int(11) NOT NULL,
  `form_id` varchar(11) NOT NULL,
  `user_id_ternilai` int(11) NOT NULL,
  `user_id_penilai` int(11) NOT NULL,
  `faktor_id` int(11) NOT NULL,
  `bobot` int(5) NOT NULL,
  `nilai` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tahun` year(4) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_karyawan`
--

INSERT INTO `nilai_karyawan` (`id`, `form_id`, `user_id_ternilai`, `user_id_penilai`, `faktor_id`, `bobot`, `nilai`, `jumlah`, `tahun`, `periode`, `created_at`, `updated_at`) VALUES
(144, 'pkk001', 2, 2, 1, 10, 5, 50, 2022, 'Q12022', '2022-12-25 03:23:02', '2022-12-25 03:23:02'),
(145, 'pkk001', 2, 2, 2, 8, 5, 40, 2022, 'Q12022', '2022-12-25 03:23:02', '2022-12-25 03:23:02'),
(146, 'pkk001', 2, 2, 3, 8, 5, 40, 2022, 'Q12022', '2022-12-25 03:23:02', '2022-12-25 03:23:02'),
(147, 'pkk001', 2, 2, 4, 6, 5, 30, 2022, 'Q12022', '2022-12-25 03:25:41', '2022-12-25 03:25:41'),
(148, 'pkk001', 2, 2, 5, 8, 5, 40, 2022, 'Q12022', '2022-12-25 03:25:41', '2022-12-25 03:25:41'),
(149, 'pkk001', 2, 2, 7, 10, 5, 50, 2022, 'Q12022', '2022-12-25 03:26:32', '2022-12-25 03:26:32'),
(150, 'pkk001', 2, 2, 7, 10, 5, 50, 2022, 'Q12022', '2022-12-25 03:46:40', '2022-12-25 03:46:40'),
(153, 'pkk002', 3, 2, 4, 6, 5, 30, 2022, 'Q12022', '2022-12-25 03:52:25', '2022-12-25 03:52:25'),
(154, 'pkk002', 3, 2, 5, 8, 5, 40, 2022, 'Q12022', '2022-12-25 03:52:25', '2022-12-25 03:52:25'),
(155, 'pkk002', 3, 2, 7, 10, 5, 50, 2022, 'Q12022', '2022-12-25 03:52:55', '2022-12-25 03:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('028f43ac89dca879b27c363b734f7857c46d0f68827edc9782d3d89b7f01ecccf4b761d53633edd6', 2, 1, 'adminApiToken', '[]', 0, '2022-12-25 01:36:41', '2022-12-25 01:36:41', '2023-12-25 08:36:41'),
('2e5a99fc8fc28167fc82acfe8e94c5e76e35a331623ccf2a2d5427cc584e2557549ec9b001bf24d7', 2, 1, 'adminApiToken', '[]', 0, '2022-12-23 07:25:08', '2022-12-23 07:25:08', '2023-12-23 14:25:08'),
('3ecd1100b12225881ef4c278a5388d559bc34c8f2ec5bba86efda2fd0022f6ccce0b9737865dec51', 1, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:04:29', '2022-12-22 09:04:29', '2023-12-22 16:04:29'),
('471ab5c8f7d80e9a439a4a1c58b92ea961b7fce2deee2603f1c1e4942f793e781e2b10be51011e09', 2, 1, 'adminApiToken', '[]', 0, '2022-12-23 03:07:54', '2022-12-23 03:07:54', '2023-12-23 10:07:54'),
('4c775659488045ba0f4320641330281a8eb0e10a1580a9d2a464a5fe73f5bf2bd9d36fe8e9c77855', 2, 1, 'adminApiToken', '[]', 0, '2022-12-23 12:42:06', '2022-12-23 12:42:06', '2023-12-23 19:42:06'),
('4f20c728c1b4cad07c67c1880e8a1eaf5ec7edad710e4f0c1b3e2dbcc8b1797bb1e8233c89b7a062', 2, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:14:37', '2022-12-22 09:14:37', '2023-12-22 16:14:37'),
('50d7d3dbd47a13c7b189b46d189190003a0f11551bf472a3a400081ea0eaf461131fe88dd3f6b63f', 1, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:15:11', '2022-12-22 09:15:11', '2023-12-22 16:15:11'),
('6bbed9d0b80015de05798564fa84756fec73867cec8f8dc291442ab65f850e91e1e45c526d6da003', 2, 1, 'adminApiToken', '[]', 0, '2022-12-23 13:07:14', '2022-12-23 13:07:14', '2023-12-23 20:07:14'),
('6f815817403d2f707a3067cdf7b45cbbe21a56c0dbe9cbc04748f504ed723d2ce3afcdfa59138eff', 4, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:17:24', '2022-12-22 09:17:24', '2023-12-22 16:17:24'),
('6fe00b5b046b6a5f3c6a05d098610ab8184bbf1ef812b43e03a353e889c8e34b952c237785e7708a', 2, 1, 'adminApiToken', '[]', 0, '2022-12-22 04:29:06', '2022-12-22 04:29:06', '2023-12-22 11:29:06'),
('81a93daad243e2406e5240170ec3f846ed4108fbb7a723b3fe28efac3bab37e1e8e35ad2b6d18879', 1, 1, 'adminApiToken', '[]', 0, '2022-12-21 15:27:39', '2022-12-21 15:27:39', '2023-12-21 22:27:39'),
('8eae19c5308b87c3c50f26e5e8b1edb846bfa3268385f07015164494b3a688799504a14eb4760385', 2, 1, 'adminApiToken', '[]', 0, '2022-12-21 09:31:51', '2022-12-21 09:31:51', '2023-12-21 16:31:51'),
('9c36d33004cceb021f93b8a228d8577b5b3868d64fdca31f9591cabc6b327ecef123abb486d9aff4', 2, 1, 'adminApiToken', '[]', 0, '2022-12-24 11:50:47', '2022-12-24 11:50:47', '2023-12-24 18:50:47'),
('9fb6b290e2e07e618b16d4ad838a9cd6e8664ef85da1a7804da2105f08d67da74ff2bb57f51d6c63', 1, 1, 'adminApiToken', '[]', 0, '2022-12-21 09:10:22', '2022-12-21 09:10:22', '2023-12-21 16:10:22'),
('aaccba4eedf5021b49c065d696484b4e2921c79b616931c16ed75af6801375997ac8b11c85c12ea9', 4, 1, 'adminApiToken', '[]', 0, '2022-12-23 12:53:33', '2022-12-23 12:53:33', '2023-12-23 19:53:33'),
('ba8aea0ac76d2b5b86e772a12aa4bde2410c23446b19858aa0c7ee7ca21d89d60c24251af2fafb85', 2, 1, 'adminApiToken', '[]', 0, '2022-12-25 08:30:25', '2022-12-25 08:30:25', '2023-12-25 15:30:25'),
('c54c15a6c48e844cf1cee6695d7d11c9ac079d7483bf96d3d4308d39a22d36efe87dda1f828e0da3', 6, 1, 'adminApiToken', '[]', 0, '2022-12-23 12:56:30', '2022-12-23 12:56:30', '2023-12-23 19:56:30'),
('c72b63470c97697e2e441ae960c111a64923d4141ec0770eccbdb086d29c20fba5d42deccaf3ea8f', 2, 1, 'adminApiToken', '[]', 0, '2022-12-22 13:45:10', '2022-12-22 13:45:10', '2023-12-22 20:45:10'),
('d416411538931d2d30ac60757d9b277fcc0b2c1901e936279fe4851d25606073b4cfcdd8fa1f7a7c', 2, 1, 'adminApiToken', '[]', 0, '2022-12-24 08:56:43', '2022-12-24 08:56:43', '2023-12-24 15:56:43'),
('d918d47cd3df5371417a892fe7b2adf6db77a9127852d77b3402a332acc55698eb032bd05b2bc779', 2, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:23:15', '2022-12-22 09:23:15', '2023-12-22 16:23:15'),
('de6e93faa2029fa1cde24486c4ee166c942f2bf892e9051f74d4ebd69ad769f4d78e4c78f0d5c72e', 2, 1, 'adminApiToken', '[]', 0, '2022-12-24 02:42:28', '2022-12-24 02:42:28', '2023-12-24 09:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'UZqk3OhYmuoGDGqzHkg7r0wnDFj0LlYJ4nm7ruPp', NULL, 'http://localhost', 1, 0, 0, '2022-12-21 03:43:35', '2022-12-21 03:43:35'),
(2, NULL, 'Laravel Password Grant Client', 'l6GAV4b7GpNggBnCYcHlhvSQ4P2NJurRjchXslx6', 'users', 'http://localhost', 0, 1, 0, '2022-12-21 03:43:35', '2022-12-21 03:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-12-21 03:43:35', '2022-12-21 03:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-view', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(2, 'role-create', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(3, 'role-edit', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(4, 'role-delete', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(5, 'permission-view', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(6, 'permission-create', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(7, 'permission-edit', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(8, 'permission-delete', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(9, 'user-view', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(10, 'user-create', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(11, 'user-edit', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18'),
(12, 'user-delete', 'admin', '2022-12-20 02:06:18', '2022-12-20 02:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'HR', 'admin', '2022-12-21 03:50:19', '2022-12-21 03:50:19'),
(4, 'Atasan Langsung', 'admin', '2022-12-22 09:35:19', '2022-12-22 09:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `seksi_has_divisi`
--

CREATE TABLE `seksi_has_divisi` (
  `id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `seksi_name` varchar(100) NOT NULL,
  `leader_seksi_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seksi_has_divisi`
--

INSERT INTO `seksi_has_divisi` (`id`, `divisi_id`, `seksi_name`, `leader_seksi_name`, `created_at`, `updated_at`) VALUES
(4, 5, 'Employee Improvement', 'Qonita', '2022-12-21 07:10:24', '2022-12-21 06:10:24'),
(6, 5, 'Recruitment', 'Gina', '2022-12-24 09:16:38', '2022-12-24 09:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jeJBN9dl6GlSw7s2pKmFovEY55PjjfLI9yyparua', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXNxVHlKamhLclI5V0hqZ2Q2azFseW13c3RIcjlBV3E2WnVySk1KayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1669534833),
('LRx8ePfLBQtjJnAwTotYLPIMVbRbBU3wepy6vEEm', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVMxWEJGZTNZYzBXMHJud0o3bGlBYjJIMDFZNHFsdmljZWZnQWtqdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fX0=', 1669377204),
('mX0iYKnhfDQNVmpm3XK2Gi5I9o0550cznRb1cmq6', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWk55WWI4bTk3NGY1ZE05ZEVZcGtUZmN1b0JHQjBMdVJvbVQzMjVVZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkeUl4dUxkejRCSW5tUHNkeHhQcXZ5ZXFmQUYzSThyWkxqY2xHVDBsQW5VWm1FWkpHbko4cWkiO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJHlJeHVMZHo0QklubVBzZHh4UHF2eWVxZkFGM0k4clpMamNsR1QwbEFuVVptRVpKR25KOHFpIjt9', 1669259140),
('nbbtGA2oGxAnXKJZPGpkErMfR6LioXZ2KFQDxPiD', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaU5YWU9reWtnd0g5Sm11Q2YzVGRiUFBYTGxZenI5aThPNWV0NkFucSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1670652567);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `reg` varchar(255) DEFAULT NULL,
  `stablished` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `layout` varchar(255) NOT NULL DEFAULT '1',
  `running_year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `slogan`, `reg`, `stablished`, `email`, `contact`, `address`, `website`, `logo`, `favicon`, `layout`, `running_year`, `created_at`, `updated_at`) VALUES
(1, 'Laravel Boilerplate', 'Admin Dashboard', '12345', '2020', 'riyadhahmed777@gmail.com', '01851334237', 'Chittagong,Bangladesh', 'http://www.laravelboilerplate.com', 'assets/images/logo/default.png', NULL, '1', '2020', '2022-12-19 17:00:00', '2022-12-19 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `status_nilai_karyawan`
--

CREATE TABLE `status_nilai_karyawan` (
  `id` int(11) NOT NULL,
  `user_id_ternilai` int(11) NOT NULL,
  `form_id` varchar(11) NOT NULL,
  `status_kemampuan_kerja` enum('open','close') NOT NULL DEFAULT 'open',
  `status_disiplin` enum('open','close') NOT NULL DEFAULT 'open',
  `status_attitude` enum('open','close') NOT NULL DEFAULT 'open',
  `nilai_akhir` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_nilai_karyawan`
--

INSERT INTO `status_nilai_karyawan` (`id`, `user_id_ternilai`, `form_id`, `status_kemampuan_kerja`, `status_disiplin`, `status_attitude`, `nilai_akhir`, `created_at`, `updated_at`) VALUES
(15, 2, 'pkk001', 'close', 'close', 'close', 250, '2022-12-25 04:46:40', '2022-12-25 03:46:40'),
(16, 3, 'pkk002', 'open', 'close', 'close', 120, '2022-12-25 04:52:55', '2022-12-25 03:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_has_seksi`
--

CREATE TABLE `user_has_seksi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seksi_id` int(11) NOT NULL,
  `divisi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_has_seksi`
--

INSERT INTO `user_has_seksi` (`id`, `user_id`, `seksi_id`, `divisi_id`) VALUES
(1, 4, 1, NULL),
(5, 10, 1, 3),
(6, 11, 2, 3),
(8, 5, 1, 3),
(9, 6, 1, 5),
(10, 2, 4, 5),
(11, 3, 4, 5),
(12, 4, 4, 5),
(13, 5, 4, 5),
(14, 6, 4, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria_faktor_penilaian`
--
ALTER TABLE `kriteria_faktor_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `nilai_karyawan`
--
ALTER TABLE `nilai_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seksi_has_divisi`
--
ALTER TABLE `seksi_has_divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_email_unique` (`email`);

--
-- Indexes for table `status_nilai_karyawan`
--
ALTER TABLE `status_nilai_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `user_has_seksi`
--
ALTER TABLE `user_has_seksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria_faktor_penilaian`
--
ALTER TABLE `kriteria_faktor_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `nilai_karyawan`
--
ALTER TABLE `nilai_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seksi_has_divisi`
--
ALTER TABLE `seksi_has_divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_nilai_karyawan`
--
ALTER TABLE `status_nilai_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_has_seksi`
--
ALTER TABLE `user_has_seksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
