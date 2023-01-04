-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2023 at 09:24 AM
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
(7, 2022081023, 'Qonita', 'Manager HR', NULL, 'hr@alamanda.com', NULL, '$2y$10$gtJCIqwzJNO7b/UGPwmhoOvTTdxgEuh9xibS4sQvkzL1eProMNQ/.', 1, NULL, '2022-12-26 10:21:03', '2023-01-02 15:03:25');

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
(10, 'Product Inovation', 'Lucas Modric', '2022-12-26 10:51:31', '2022-12-26 12:31:36'),
(12, 'Finance', 'ane', '2023-01-02 14:20:22', '2023-01-02 14:20:22');

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
  `nilai0` varchar(255) NOT NULL,
  `nilai1` varchar(255) NOT NULL,
  `nilai2` varchar(255) NOT NULL,
  `nilai3` varchar(100) DEFAULT NULL,
  `nilai4` varchar(255) NOT NULL,
  `nilai5` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria_faktor_penilaian`
--

INSERT INTO `kriteria_faktor_penilaian` (`id`, `kriteria`, `faktor`, `bobot`, `nilai0`, `nilai1`, `nilai2`, `nilai3`, `nilai4`, `nilai5`, `created_at`, `updated_at`) VALUES
(8, 'Kemampuan Kerja', 'Target Penyelesaian Kerja', 10, 'Kecendrungan menyelesaikan janji pekerjaan & atau perintah atasan, dalam periode tahun ini rata-rata sangat dibawah batas waktu yang dijanjikan (batas waktu < 90 %)', 'Kecendrungan menyelesaikan janji pekerjaan & atau perintah atasan, dalam periode tahun ini rata-rata di -\nbawah batas waktu yang dijanjikan (91 ~ 95 %)  \n', 'Kecendrungan menyelesaikan janji pekerjaan & atau perintah atasan, dalam periode tahun ini rata-rata sedi-\nkit dibawah batas waktu  yang dijanjikan (96 ~ 99 %)\n', '', 'Kecendrungan menyelesaikan janji pekerjaan & perintah atasan, dalam periode tahun ini rata-rata\npas dgn batas waktu yang dijanjikan (100 %)  \n', 'Kecendrungan menyelesaikan janji pekerjaan & perintah atasan, dalam periode tahun ini \nrata-rata mendahului batas waktu yg di janjikan\n', '2023-01-03 13:46:11', '0000-00-00 00:00:00'),
(9, 'Kemampuan Kerja', 'Ketelitian', 10, 'Kecendrungan pencapaian hasil  ketelitian kerja langsung atau tidak langsung dalam periode \ntahun ini  rata-rata sangat dibawah ketelitian yang \ndiinginkan (Ketelitian < 90 %)\n', 'Kecendrungan pencapaian hasil  ketelitian kerja langsung atau tidak langsung dalam periode \ntahun ini  rata-rata dibawah ketelitian yang diinginkan\n(91 ~ 95 %)\n', 'Kecendrungan pencapaian hasil  ketelitian kerja langsung atau tidak langsung dalam periode \ntahun ini  rata-rata sedikit dibawah ketelitian yang di -\ninginkan (96 ~ 99 %)\n', '', 'Kecendrungan pencapaian hasil  ketelitian kerja langsung atau tidak langsung dalam periode \ntahun ini  rata-rata pas dgn ketelitian yang diinginkan\n(100%)\n', 'Kecendrungan pencapaian hasil  ketelitian kerja langsung atau tidak langsung dalam periode \ntahun ini  rata-rata melebihi ketelitian yang di -\ninginkan\n', '2023-01-03 13:46:15', '0000-00-00 00:00:00'),
(10, 'Kemampuan Kerja', 'Kemampuan teknis ', 8, 'Kemampuan dan pengetahuan mengoperasikan bidang  kerjanya kurang sekali dari standar yang ada', 'Kemampuan dan pengetahuan mengoperasikan bidang kerjanya  kurang dari standar yang ada ', 'Kemampuan dan pengetahuan mengoperasikan bidang kerjanya kurang sedikit dari standar yang ada', '', 'Kemampuan dan pengetahuan mengoperasikan bidang kerjanya sesuai dengan standar yang ada ', 'Kemampuan dan pengetahuan mengoperasikan bidang kerjanya melebihi standar yang ada \ndan sangat menunjang hasil yang terjaga baik\n', '2023-01-03 13:46:19', '0000-00-00 00:00:00'),
(11, 'Disiplin', 'Kehadiran (absolut) dan Ketepatan waktu kerja.', 10, 'Kehadiran dalam periode tahun ini rata-rata < 98.9 %, dibarengi dengan tidak atau pernah\ndatang terlambat di area kerja & atau ijin\n', 'Kehadiran dalam periode tahun ini rata-rata 98.9 ~ 99.4 %, dibarengi dengan tidak atau pernah\ndatang terlambat di area kerja & atau pulang cepat\n', 'Kehadiran dalam periode tahun ini rata-rata 99.5 ~ 99.9%, dibarengi dengan pernah\ndatang terlambat di area kerja & atau ijin\n', '', 'Kehadiran dalam periode tahun ini rata-rata 99.5 ~ 99.9%, dibarengi dengan tidak pernah\ndatang terlambat di area kerja & atau pulang cepat\natau sama juga dengan kehadiran 100 % tapi pernah\ndatang terlambat di area kerja & atau Ijin\n', 'Kehadiran dalam periode tahun ini rata-rata 100%, dibarengi dengan tidak pernah datang\nterlambat di area kerja & atau Ijin \n', '2023-01-03 13:46:24', '0000-00-00 00:00:00'),
(12, 'Disiplin', 'Prosedur kerja ', 6, 'Cendrung tidak mentaati prosedur kerja dan instruksi kerja (IK )', 'Mentaati prosedur kerja dan instruksi kerja (IK) tapi terlihat tidak konsisten', 'Mentaati prosedur kerja dan Instruksi kerja (IK) tapi kadang-kadang masih terlihat tidak konsisten', '', 'Selalu mentaati prosedur kerja dan Instruksi kerja (IK)', 'Selalu mentaati prosedur kerja dan Instruksi kerja (IK), dibarengi dengan kesadaran untuk\nselalu ikut memperbaruhinya\n', '2023-01-03 13:46:28', '0000-00-00 00:00:00'),
(13, 'Disiplin', 'Kerapian dan kebersihan', 6, 'Cendrung melanggar kerapian dan kebersihan', 'Mentaati hal kebersihan area dan meja kerja tapi tidak menjaga kerapian', 'Selalu mentaati dalam hal kebersihan dan kerapian tapi kadang-kadang masih terlihat\ntidak konsisten terhadap pelaksanaan nya\n', '', 'Selalu mentaati pelaksanaan kebersihan dan kerapian dengan konsisten', 'Selalu mentaati pelaksanaan kebersihan dan kerapian dengan konsisten\nDan juga ikut aktif dalam mensosialisasikannya\n', '2023-01-03 13:46:33', '0000-00-00 00:00:00'),
(14, 'Disiplin', 'Surat peringatan', 6, 'Mendapatkan surat peringatan kedua atau ketiga pada periode tahun ini', 'Mendapatkan surat peringatan pertama pada periode tahun ini  ', 'Tidak pernah mendapatkan surat peringatan tapi pernah mendapatkan teguran lisan dalam periode\ntahun ini  \n', '', 'Tidak pernah mendapatkan surat peringatan dan juga belum pernah mendapatkan teguran lisan dalam \nperiode tahun ini  \n', 'Tidak pernah mendapatkan surat peringatan malah menjadi saritauladan bagi rekan kerja \nyang lainnya dalam masa periode tahun ini\n', '2023-01-03 13:46:39', '0000-00-00 00:00:00'),
(15, 'Attitude', 'Sifat Tolak Ukur (tindakan terhadap prioritas)', 6, 'Sikap dalam menentukan dan mematuhi prioritas tindakan sesuai tujuan yang telah disepakati bersama \nmasih perlu diingatkan, dibimbing dan diawasi\nDan terlihat masih tidak disiplin\n', 'Sikap dalam menentukan dan mematuhi prioritas tindakan sesuai tujuan yang telah disepakati bersama \nmasih perlu diingatkan dan dibimbing\n', 'Sikap sanggup menentukan dan mematuhi prioritas tindakan sesuai tujuan yang telah disepakati bersama \ntapi kadang-kadang masih tidak disiplin\n', '', 'Sikap sanggup menentukan dan mematuhi prioritas tindakan sesuai tujuan yang telah disepakati bersama \nsecara disiplin\n', 'Sikap sanggup menentukan dan mematuhi prioritas tindakan sesuai tujuan yang telah di \nsepakati bersama secara disiplin, konsisten dan\nkonsekuen\n', '2023-01-03 13:46:42', '0000-00-00 00:00:00'),
(16, 'Attitude', 'Inisiatif', 6, 'Sikap kurang bersegera/tanggap untuk mengambil tindakan yang dianggap perlu, sering menunggu\nperintah atau pernmintaan\n', 'Sikap bersegera/tanggap untuk mengambil tindakan yang dianggap perlu, tidak menunggu\nperintah atau pernmintaan, namun mengabaikan\naturan kewenangan\n', 'Sikap bersegera/tanggap untuk mengambil tindakan yang dianggap perlu, tidak menunggu\nperintah atau pernmintaan, namun kadang-kadang\nmengabaikan aturan kewenangan\n', '', 'Sikap bersegera/tanggap untuk mengambil tindakan yang dianggap perlu, tidak menunggu\nperintah atau pernmintaan, namun tidak \nmengabaikan aturan kewenangan\n', 'Sikap bersegera/tanggap untuk mengambil tindakan yang dianggap perlu, tidak menunggu\nperintah atau pernmintaan, namun tidak \nmengabaikan aturan kewenangan dan selalu\nmendukung atasan\n', '2023-01-03 13:46:46', '0000-00-00 00:00:00'),
(17, 'Attitude', 'Orientasi Diri', 4, 'Minat & motivasi kerja yang berakar pada pencapaian hasil terlihat kecendrungannya menurun hasil', 'Minat & motivasi kerja yang berakar pada pencapaian hasil terlihat kadang-kadang naik turun', 'Minat & motivasi kerja yang berakar pada pencapaian hasil yang lebih baik kadang-kadang masih perlu di\nfollowup\n', '', 'Minat & motivasi kerja yang berakar pada pencapaian hasil yang lebih baik ', 'Minat & motivasi kerja yang berakar pada pencapaian hasil yang lebih baik \nDorongan yang kuat dalam diri untuk selalu\nbelajar dan tidak puas dengan hasil sekarang\nMau berubah dalam mencapai hasil yang lebih\nbaik\n', '2023-01-03 13:46:50', '0000-00-00 00:00:00'),
(18, 'Attitude', 'Fleksibilitas', 6, 'Sikap Mental yang tidak bisa menyesuaikan diri dengan perubahan maupun kenyataan yang tidak \nsesuai dengan keinginannya sendiri\n', 'Sikap Mental yang kurang mudah dalam menyesuaikan diri dengan perubahan maupun kenyataan yang tidak \nsesuai dengan keinginannya sendiri, \nWalaupun sudah dilakukan bimbingan kepadanya\n', 'Sikap Mental yang mau menyesuaikan diri dengan perubahan maupun kenyataan yang \ntidak sesuai dengan keinginannya sendiri, karena\nadanya bimbingan\n', '', 'Sikap Mental yang mudah menyesuaikan diri dengan perubahan maupun kenyataan yang \ntidak sesuai dengan keinginannya sendiri\n', 'Sikap Mental yang mudah menyesuaikan diri dengan perubahan maupun kenyataan yang \ntidak sesuai dengan keinginannya sendiri\nSelalu mampu bersikap gembira dalam tekanan\n', '2023-01-03 13:46:53', '0000-00-00 00:00:00');

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
(7, 'HR', 7);

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
('091d037cce64460017dcdd20e361931a3c8d0ccf242f82ea90af2717901d43a325a83fb84f8ed429', 20, 1, 'adminApiToken', '[]', 0, '2023-01-02 14:25:43', '2023-01-02 14:25:43', '2024-01-02 21:25:43'),
('0f30a74494840ef7e24d9f017d8f83bb8c07bd5115870327370de8037eba0075f45dea05b7c9db9b', 16, 1, 'adminApiToken', '[]', 0, '2022-12-30 08:47:50', '2022-12-30 08:47:50', '2023-12-30 15:47:50'),
('110ee8f6a062135cc2a8a0f233da116294209d5d16a8802d1dc7869d0bcabee515d2ac5b0f5c8ee5', 19, 1, 'adminApiToken', '[]', 0, '2022-12-27 03:52:57', '2022-12-27 03:52:57', '2023-12-27 10:52:57'),
('19282775f90970bb011e26079eefc9fc9e83b884aeafb80249cb8eb1a3f3ab778f4c0cc44ae2f4bc', 7, 1, 'adminApiToken', '[]', 0, '2022-12-27 03:42:32', '2022-12-27 03:42:32', '2023-12-27 10:42:32'),
('1946339036a29ab2dbeff4fd064621c76da8016b248a1383909b7d1f1c369a8a50538bdfd314faf9', 16, 1, 'adminApiToken', '[]', 0, '2023-01-02 14:27:17', '2023-01-02 14:27:17', '2024-01-02 21:27:17'),
('1d2c7f807557926765daf09c2233360306992af1cb11722cb256a58bc7be3587fedc7328669540b3', 7, 1, 'adminApiToken', '[]', 0, '2023-01-02 15:34:21', '2023-01-02 15:34:21', '2024-01-02 22:34:21'),
('1d304dfb5a0df149fe40fe3a15eb347d1113bf5e9bd592c62b87f11c876df760d7dccf186fc693fd', 19, 1, 'adminApiToken', '[]', 0, '2022-12-29 16:26:51', '2022-12-29 16:26:51', '2023-12-29 23:26:51'),
('213e14511fa34290b6bab15acdeea1c74f860a6848a2f1041facaf0846506e5fb28b2fa9e088d3ba', 7, 1, 'adminApiToken', '[]', 0, '2022-12-29 16:06:19', '2022-12-29 16:06:19', '2023-12-29 23:06:19'),
('256d0e571dc4e8b47f8e636307a64304085a504b0f85edbbcbdc6c90058f85bc51ab21ab0e786afc', 3, 1, 'adminApiToken', '[]', 0, '2022-12-25 09:57:11', '2022-12-25 09:57:11', '2023-12-25 16:57:11'),
('2b59bdacfcc04361dbf43f8628a8414f1bf432632eb912ce807f6106cc0dd716b909d13fbc60b4df', 7, 1, 'adminApiToken', '[]', 0, '2022-12-27 08:15:23', '2022-12-27 08:15:23', '2023-12-27 15:15:23'),
('2e1aa3cda2a16a8458b8ada6aca6a0d305fa15bed1ea11bdfe36aced73090aa5807dfc8ac9ac35de', 19, 1, 'adminApiToken', '[]', 0, '2022-12-27 06:54:46', '2022-12-27 06:54:46', '2023-12-27 13:54:46'),
('2e5a99fc8fc28167fc82acfe8e94c5e76e35a331623ccf2a2d5427cc584e2557549ec9b001bf24d7', 2, 1, 'adminApiToken', '[]', 0, '2022-12-23 07:25:08', '2022-12-23 07:25:08', '2023-12-23 14:25:08'),
('2eec4d76b7904aabcef9fdf73311b5f52c5573e56efb2b372645ad46370a93ce4fd828acb61d3290', 7, 1, 'adminApiToken', '[]', 0, '2022-12-30 08:05:12', '2022-12-30 08:05:12', '2023-12-30 15:05:12'),
('320bab0e89d12bdb055f39e768bf8246f1dd6d1178f5ba6fda6572093991b22a92e1dcbd0031deee', 21, 1, 'adminApiToken', '[]', 0, '2023-01-02 14:27:51', '2023-01-02 14:27:51', '2024-01-02 21:27:51'),
('3ecd1100b12225881ef4c278a5388d559bc34c8f2ec5bba86efda2fd0022f6ccce0b9737865dec51', 1, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:04:29', '2022-12-22 09:04:29', '2023-12-22 16:04:29'),
('4308c889e7bb20fb60b922dfa96d68782580dd7fb20ef3de1acb2894348edfa80817684a88160ce8', 7, 1, 'adminApiToken', '[]', 0, '2023-01-02 15:33:52', '2023-01-02 15:33:52', '2024-01-02 22:33:52'),
('471ab5c8f7d80e9a439a4a1c58b92ea961b7fce2deee2603f1c1e4942f793e781e2b10be51011e09', 2, 1, 'adminApiToken', '[]', 0, '2022-12-23 03:07:54', '2022-12-23 03:07:54', '2023-12-23 10:07:54'),
('48500ba462424c79f48911f5396a226a7c6f81873f1b38de4e523ed103d15f05598a2c9e0f406802', 16, 1, 'adminApiToken', '[]', 0, '2022-12-30 05:18:48', '2022-12-30 05:18:48', '2023-12-30 12:18:48'),
('4a128c3d102cd638034f5fb9cd3af5d48f2a98b4802a0755d13a1a65acac83a233daed3f111fc1d2', 7, 1, 'adminApiToken', '[]', 0, '2022-12-27 12:26:07', '2022-12-27 12:26:07', '2023-12-27 19:26:07'),
('4c775659488045ba0f4320641330281a8eb0e10a1580a9d2a464a5fe73f5bf2bd9d36fe8e9c77855', 2, 1, 'adminApiToken', '[]', 0, '2022-12-23 12:42:06', '2022-12-23 12:42:06', '2023-12-23 19:42:06'),
('4f20c728c1b4cad07c67c1880e8a1eaf5ec7edad710e4f0c1b3e2dbcc8b1797bb1e8233c89b7a062', 2, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:14:37', '2022-12-22 09:14:37', '2023-12-22 16:14:37'),
('50d7d3dbd47a13c7b189b46d189190003a0f11551bf472a3a400081ea0eaf461131fe88dd3f6b63f', 1, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:15:11', '2022-12-22 09:15:11', '2023-12-22 16:15:11'),
('567b905e848719bc34d5c8a8979aaa81a53041d75f364cc3f6fc13efdf6346a9be8cf90fe1e80614', 7, 1, 'adminApiToken', '[]', 0, '2022-12-26 10:21:19', '2022-12-26 10:21:19', '2023-12-26 17:21:19'),
('5ddc60b8bef99363d82145577fbd26720236bac49c338495dc381a6a75b060ee0737a59beb367ea7', 16, 1, 'adminApiToken', '[]', 0, '2023-01-02 15:34:02', '2023-01-02 15:34:02', '2024-01-02 22:34:02'),
('62a659e32a3a6f16efc766a3b54e0a8e52241995fbfa6cad4d8c5ce7e4682fa37d0519c0f332e1de', 2, 1, 'adminApiToken', '[]', 0, '2022-12-26 03:57:54', '2022-12-26 03:57:54', '2023-12-26 10:57:54'),
('6422eb91a071db123bb1a63ed0378b9e1d9c5b98cd7b2411bd82d098426261dc1ae7c3d35566745c', 7, 1, 'adminApiToken', '[]', 0, '2023-01-01 04:43:01', '2023-01-01 04:43:01', '2024-01-01 11:43:01'),
('6bbed9d0b80015de05798564fa84756fec73867cec8f8dc291442ab65f850e91e1e45c526d6da003', 2, 1, 'adminApiToken', '[]', 0, '2022-12-23 13:07:14', '2022-12-23 13:07:14', '2023-12-23 20:07:14'),
('6e172fb5026ba179beb667a7411ca4daf582ffd4af2cd7096c0c8b63ef54018b4c933baffad9c331', 19, 1, 'adminApiToken', '[]', 0, '2022-12-30 05:18:09', '2022-12-30 05:18:09', '2023-12-30 12:18:09'),
('6f815817403d2f707a3067cdf7b45cbbe21a56c0dbe9cbc04748f504ed723d2ce3afcdfa59138eff', 4, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:17:24', '2022-12-22 09:17:24', '2023-12-22 16:17:24'),
('6fe00b5b046b6a5f3c6a05d098610ab8184bbf1ef812b43e03a353e889c8e34b952c237785e7708a', 2, 1, 'adminApiToken', '[]', 0, '2022-12-22 04:29:06', '2022-12-22 04:29:06', '2023-12-22 11:29:06'),
('7398a39f148db3184523930f4c928e8fbe482378334089a1e38894163745f4eef3f55737fbb0ec5d', 7, 1, 'adminApiToken', '[]', 0, '2023-01-04 06:48:11', '2023-01-04 06:48:11', '2024-01-04 13:48:11'),
('81a93daad243e2406e5240170ec3f846ed4108fbb7a723b3fe28efac3bab37e1e8e35ad2b6d18879', 1, 1, 'adminApiToken', '[]', 0, '2022-12-21 15:27:39', '2022-12-21 15:27:39', '2023-12-21 22:27:39'),
('82ae70e97339a223fa3691ffbf755107d18b36d0568a072dc55388d712561c31131d60cbade75036', 7, 1, 'adminApiToken', '[]', 0, '2023-01-01 03:01:44', '2023-01-01 03:01:44', '2024-01-01 10:01:44'),
('8adff2d7541db0bb5df5dad705a95ee7bc5477d1dfe80af2f599a4ebd8f88ebcefe620fd436472e7', 7, 1, 'adminApiToken', '[]', 0, '2023-01-02 14:26:45', '2023-01-02 14:26:45', '2024-01-02 21:26:45'),
('8b581795469d6b1f721a4816423a191b41441db65b0910117afac5f852c0a18053d6ab3268a1657d', 7, 1, 'adminApiToken', '[]', 0, '2022-12-29 16:26:26', '2022-12-29 16:26:26', '2023-12-29 23:26:26'),
('8eae19c5308b87c3c50f26e5e8b1edb846bfa3268385f07015164494b3a688799504a14eb4760385', 2, 1, 'adminApiToken', '[]', 0, '2022-12-21 09:31:51', '2022-12-21 09:31:51', '2023-12-21 16:31:51'),
('924bd41458f47af5176a55603c44c1b6f7a69140b201c8b9a67911801b369790876b070509dab0ac', 19, 1, 'adminApiToken', '[]', 0, '2022-12-29 15:58:35', '2022-12-29 15:58:35', '2023-12-29 22:58:35'),
('98726dc88bb97d0883fb4d7206c977e5ad830557f50e01249d37be485dc72e973fc937b171a7f7fa', 19, 1, 'adminApiToken', '[]', 0, '2022-12-30 06:54:36', '2022-12-30 06:54:36', '2023-12-30 13:54:36'),
('9c36d33004cceb021f93b8a228d8577b5b3868d64fdca31f9591cabc6b327ecef123abb486d9aff4', 2, 1, 'adminApiToken', '[]', 0, '2022-12-24 11:50:47', '2022-12-24 11:50:47', '2023-12-24 18:50:47'),
('9e95efef1f7c637360c1cfbd07c981d5daeb29938de69b5620409460bc17ccbd9b876ee422c77573', 19, 1, 'adminApiToken', '[]', 0, '2022-12-30 06:46:47', '2022-12-30 06:46:47', '2023-12-30 13:46:47'),
('9fb6b290e2e07e618b16d4ad838a9cd6e8664ef85da1a7804da2105f08d67da74ff2bb57f51d6c63', 1, 1, 'adminApiToken', '[]', 0, '2022-12-21 09:10:22', '2022-12-21 09:10:22', '2023-12-21 16:10:22'),
('aaccba4eedf5021b49c065d696484b4e2921c79b616931c16ed75af6801375997ac8b11c85c12ea9', 4, 1, 'adminApiToken', '[]', 0, '2022-12-23 12:53:33', '2022-12-23 12:53:33', '2023-12-23 19:53:33'),
('abd016c6342e34c7afbf62f0135381f621b5e0820fc53718e8dc1c91415f0c9db6a8257cbb0f7692', 16, 1, 'adminApiToken', '[]', 0, '2022-12-30 06:52:30', '2022-12-30 06:52:30', '2023-12-30 13:52:30'),
('acb52d28704f235624d15f1f4f37754eb00ed2c5ee630c1e41db66bfc6920b07d619a8236b2880ec', 22, 1, 'adminApiToken', '[]', 0, '2023-01-02 15:27:28', '2023-01-02 15:27:28', '2024-01-02 22:27:28'),
('b6ff83530ea8f87b5035746135ad28d795b414355418c2852ff4ec934b6391462884d357ef757449', 7, 1, 'adminApiToken', '[]', 0, '2022-12-31 03:30:55', '2022-12-31 03:30:55', '2023-12-31 10:30:55'),
('ba8aea0ac76d2b5b86e772a12aa4bde2410c23446b19858aa0c7ee7ca21d89d60c24251af2fafb85', 2, 1, 'adminApiToken', '[]', 0, '2022-12-25 08:30:25', '2022-12-25 08:30:25', '2023-12-25 15:30:25'),
('c32f3043c9ef2bd8031ec1965e02276e57d54762783093936eeb9e6a9a267e4b520801100faec237', 19, 1, 'adminApiToken', '[]', 0, '2022-12-29 16:18:28', '2022-12-29 16:18:28', '2023-12-29 23:18:28'),
('c54c15a6c48e844cf1cee6695d7d11c9ac079d7483bf96d3d4308d39a22d36efe87dda1f828e0da3', 6, 1, 'adminApiToken', '[]', 0, '2022-12-23 12:56:30', '2022-12-23 12:56:30', '2023-12-23 19:56:30'),
('c71ce5c94cbab4761c32e0a7310888e58305223a5d23fb5c25e0adb3d465d17431844699755be464', 7, 1, 'adminApiToken', '[]', 0, '2023-01-02 14:13:48', '2023-01-02 14:13:48', '2024-01-02 21:13:48'),
('c72b63470c97697e2e441ae960c111a64923d4141ec0770eccbdb086d29c20fba5d42deccaf3ea8f', 2, 1, 'adminApiToken', '[]', 0, '2022-12-22 13:45:10', '2022-12-22 13:45:10', '2023-12-22 20:45:10'),
('c833ae0d326564f344e9a14c75fef771f9ae24087430777ad7bfa912f49fea48ee80f51c6e65b6a1', 7, 1, 'adminApiToken', '[]', 0, '2022-12-30 08:48:36', '2022-12-30 08:48:36', '2023-12-30 15:48:36'),
('cb7fc010c70c792ffa26a30da43baffffd05c55a1a852e9501963e39f6acf4416358662780e3aea0', 7, 1, 'adminApiToken', '[]', 0, '2022-12-30 06:53:28', '2022-12-30 06:53:28', '2023-12-30 13:53:28'),
('d28ae1712e8c362a128529ccc437164ac114a0230270b9aae7fdd69b60448c832811cf81c8aebdb2', 20, 1, 'adminApiToken', '[]', 0, '2023-01-02 15:17:05', '2023-01-02 15:17:05', '2024-01-02 22:17:05'),
('d416411538931d2d30ac60757d9b277fcc0b2c1901e936279fe4851d25606073b4cfcdd8fa1f7a7c', 2, 1, 'adminApiToken', '[]', 0, '2022-12-24 08:56:43', '2022-12-24 08:56:43', '2023-12-24 15:56:43'),
('d8a2ba0eb551546e9e931fbae52e0bb4d822d4e4d79c244a4520a0c8192fe7aa60b3d9e56a1bfb01', 7, 1, 'adminApiToken', '[]', 0, '2023-01-02 15:26:23', '2023-01-02 15:26:23', '2024-01-02 22:26:23'),
('d918d47cd3df5371417a892fe7b2adf6db77a9127852d77b3402a332acc55698eb032bd05b2bc779', 2, 1, 'adminApiToken', '[]', 0, '2022-12-22 09:23:15', '2022-12-22 09:23:15', '2023-12-22 16:23:15'),
('daa72cb0aa1c75fe468efb4aeaa9eafccf2bf9889c964e3c766f1c74d602d66b863066e9045976ad', 16, 1, 'adminApiToken', '[]', 0, '2022-12-27 08:06:40', '2022-12-27 08:06:40', '2023-12-27 15:06:40'),
('de6e93faa2029fa1cde24486c4ee166c942f2bf892e9051f74d4ebd69ad769f4d78e4c78f0d5c72e', 2, 1, 'adminApiToken', '[]', 0, '2022-12-24 02:42:28', '2022-12-24 02:42:28', '2023-12-24 09:42:28'),
('e50eaabbba2927023e8e45da3e96f32843d1e9050590e8ae02270e7e5d24ccc47a0f50605aa52153', 20, 1, 'adminApiToken', '[]', 0, '2023-01-02 15:02:05', '2023-01-02 15:02:05', '2024-01-02 22:02:05'),
('e5212c19f15b654df1ff366bea053eb331c370edaa285fe6f66e118205b7af7d5f1a687879e16ccf', 7, 1, 'adminApiToken', '[]', 0, '2023-01-02 15:02:32', '2023-01-02 15:02:32', '2024-01-02 22:02:32'),
('e73612d554e00b68a8a1a13aca50cfaa215c7f1460b252d5d0557edac3b529481492a35c42291958', 2, 1, 'adminApiToken', '[]', 0, '2022-12-26 09:24:59', '2022-12-26 09:24:59', '2023-12-26 16:24:59'),
('f46201c6cf510b7dd1bbc89394d9ca8d80bf8170389e815477c09f77e8956584210becf45428a993', 16, 1, 'adminApiToken', '[]', 0, '2022-12-30 08:03:30', '2022-12-30 08:03:30', '2023-12-30 15:03:30'),
('f85abe5b5b63591c4e7805331c47810155b2f10add17b89476dc939e65b90d09d412e41ee7d700da', 7, 1, 'adminApiToken', '[]', 0, '2023-01-03 12:45:35', '2023-01-03 12:45:35', '2024-01-03 19:45:35');

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
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `jabatan`, `created_at`, `updated_at`) VALUES
(4, 'Atasan Langsung', 'Product Manager', '2022-12-22 09:35:19', '2022-12-26 10:01:37'),
(5, 'Karyawan', 'Staff Operational', '2022-12-26 10:11:57', '2022-12-26 10:11:57'),
(6, 'Karyawan', 'Supervisor Operationals', '2022-12-26 10:18:38', '2023-01-02 15:36:47'),
(7, 'HR', 'Manager HR', '2022-12-26 10:18:52', '2022-12-26 10:18:52'),
(9, 'Atasan Langsung', 'Finance Manager', '2023-01-02 14:17:08', '2023-01-02 14:17:08'),
(10, 'Karyawan', 'Finance Staff', '2023-01-02 14:22:09', '2023-01-02 14:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, 10, 'Operational Product', 'Thomas Darmawan', '2022-12-26 12:32:30', '2022-12-26 11:32:30'),
(9, 10, 'Production Implement', 'Lucas Modric', '2022-12-31 03:33:50', '2022-12-31 03:33:50'),
(10, 10, 'Product Monitoring', 'Lucas Modric', '2022-12-31 03:35:18', '2022-12-31 03:35:18'),
(12, 12, 'Finance Payable', 'ane', '2023-01-02 14:20:39', '2023-01-02 14:20:39');

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
(15, 7, 4, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria_faktor_penilaian`
--
ALTER TABLE `kriteria_faktor_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `nilai_karyawan`
--
ALTER TABLE `nilai_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seksi_has_divisi`
--
ALTER TABLE `seksi_has_divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_nilai_karyawan`
--
ALTER TABLE `status_nilai_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_has_seksi`
--
ALTER TABLE `user_has_seksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

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
