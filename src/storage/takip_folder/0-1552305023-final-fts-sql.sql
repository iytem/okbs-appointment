-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Ara 2018, 13:57:00
-- Sunucu sürümü: 10.1.37-MariaDB
-- PHP Sürümü: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `final_fts`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_aauth_groups`
--

CREATE TABLE `cms_aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cms_aauth_groups`
--

INSERT INTO `cms_aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Grup');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_aauth_perms`
--

CREATE TABLE `cms_aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cms_aauth_perms`
--

INSERT INTO `cms_aauth_perms` (`id`, `name`, `definition`) VALUES
(1, 'kullanici-aktivitileri', 'Kullanıcı Aktiviteleri Görüntüleme'),
(2, 'kullanici-gruplari', 'Kullanıcı Grup İşlemleri'),
(3, 'yedekleme', 'MYSQL Yedekleme İşlemi'),
(4, 'dashboard', 'Admin Dashboard Panel Görüntüleme'),
(5, 'yetki-islemleri', 'Kullanıcı Grubu  Yetki Verme-İptal Etme İşlemleri'),
(6, 'kullanicilar', 'Kullanıcı İşlemleri'),
(7, 'ayarlar', 'Uygulama Ayarları'),
(8, 'otomatik-sorgular', 'Otomatik Sorgu İşlemleri'),
(9, 'manuel-sorgular', 'Manuel Sorgu İşlemleri'),
(10, 'popup', 'Popup İşlemleri'),
(11, 'uygulama-izinleri', 'Uygulama İzin Ekleme Güncelleme Silme İşlemi'),
(12, 'menu', 'Menü İşlemleri'),
(13, 'nav-admin-islemleri', 'Admin İşlemleri İşlemleri Menü Linki'),
(14, 'nav-dashboard', 'Dashboard İşlemleri Menü Linki'),
(15, 'nav-menu', 'Menü İşlemleri Menü Linki'),
(16, 'nav-kullanicilar', 'Kullanıcılar İşlemleri Menü Linki'),
(17, 'nav-kullanici-gruplari', 'Kullanıcı Grupları İşlemleri Menü Linki'),
(18, 'nav-yetki-islemleri', 'Yetki İşlemleri İşlemleri Menü Linki'),
(19, 'nav-popup', 'Popup İşlemleri Menü Linki'),
(20, 'nav-manuel-sorgular', 'Manuel Sorgular İşlemleri Menü Linki'),
(21, 'nav-otomatik-sorgular', 'Otomatik Sorgular İşlemleri Menü Linki'),
(22, 'nav-yedekleme', 'Yedekleme İşlemleri Menü Linki'),
(23, 'nav-kullanici-aktivitileri', 'Kullanıcı Aktivitileri İşlemleri Menü Linki'),
(24, 'nav-ayarlar', 'Ayarlar İşlemleri Menü Linki'),
(25, 'nav-ana-sayfa', 'Ana Sayfa İşlemleri Menü Linki');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_aauth_perm_to_group`
--

CREATE TABLE `cms_aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cms_aauth_perm_to_group`
--

INSERT INTO `cms_aauth_perm_to_group` (`perm_id`, `group_id`) VALUES
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_aauth_users`
--

CREATE TABLE `cms_aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `full_name` varchar(200) NOT NULL,
  `registry_number` int(11) NOT NULL,
  `task_status` tinyint(1) NOT NULL,
  `merkez` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_login_attempt` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `ip_address` text,
  `login_attempts` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cms_aauth_users`
--

INSERT INTO `cms_aauth_users` (`id`, `email`, `pass`, `name`, `full_name`, `registry_number`, `task_status`, `merkez`, `gender`, `title`, `avatar`, `banned`, `last_login`, `last_activity`, `last_login_attempt`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `ip_address`, `login_attempts`) VALUES
(1, 'cskncms@gmail.com', '04e1adb0fd3c47bf470297d02413eb230b51bee47c5d7dbe8c3561c50ccb1ada', 'Cskn', 'Coşkun Eşkiner', 406759, 0, 1, 1, '', 'male.png', 0, '2018-12-25 15:56:22', '2018-12-25 15:56:22', '2018-12-25 15:00:00', NULL, NULL, NULL, NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_aauth_user_to_group`
--

CREATE TABLE `cms_aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cms_aauth_user_to_group`
--

INSERT INTO `cms_aauth_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_menu`
--

CREATE TABLE `cms_menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `icon_color` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `perm_id` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `cms_menu`
--

INSERT INTO `cms_menu` (`id`, `label`, `type`, `icon_color`, `link`, `perm_id`, `sort`, `parent`, `icon`, `menu_type_id`) VALUES
(2, 'Dashboard', 'menu', '#E80505', 'cms/dashboard', 14, 2, 131, 'fa-contao', 1),
(9, 'Kullanıcılar', 'menu', '#BED119', 'cms/user', 16, 4, 131, 'fa-user', 1),
(10, 'Kullanıcı Grupları', 'menu', '#18698C', 'cms/group', 17, 5, 131, 'fa-group', 1),
(11, 'Yetki İşlemleri', 'menu', '#0008F5', 'cms/access_group', 18, 7, 131, 'fa-thumb-tack', 1),
(12, 'Uygulama İzinleri', 'menu', '#6F21D1', 'cms/permission', 6, 6, 131, 'fa-check', 1),
(67, 'Ayarlar', 'menu', '#74AD84', 'cms/setting', 24, 13, 131, 'fa-cogs', 1),
(82, 'Menü', 'menu', '#2982FF', 'cms/menu', 15, 3, 131, 'fa-list', 1),
(87, 'Yedekleme', 'menu', '#C71418', 'cms/database_backup', 22, 11, 131, 'fa-database', 1),
(91, 'Popup', 'menu', '#965B4E', 'cms/popup', 19, 8, 131, 'fa-bullhorn', 1),
(93, 'Kullanıcı Aktivitileri', 'menu', '#FF0000', 'cms/log/user_activity', 23, 12, 131, 'fa-user-secret', 1),
(114, 'Manuel Sorgular', 'menu', '#1119CF', 'cms/query_builder/manuel', 20, 9, 131, 'fa-chrome', 1),
(115, 'Otomatik Sorgular', 'menu', '#BF111F', 'cms/query_builder/auto', 21, 10, 131, 'fa-houzz', 1),
(131, 'Admin İşlemleri', 'menu', '#DB0202', '#', 13, 1, 0, 'fa-key', 1),
(151, 'Ana Sayfa', 'menu', '#9CB005', 'home', 25, 14, 0, 'fa-home', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_menu_type`
--

CREATE TABLE `cms_menu_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `cms_menu_type`
--

INSERT INTO `cms_menu_type` (`id`, `name`, `definition`) VALUES
(1, 'side menu', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_options`
--

CREATE TABLE `cms_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `option_name` varchar(200) NOT NULL,
  `option_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `cms_options`
--

INSERT INTO `cms_options` (`id`, `option_name`, `option_value`) VALUES
(3, 'app_name', 'SGK Alt Yapı'),
(4, 'email', 'ank@sgk.gov.tr'),
(5, 'author', 'Ankara Sosyal Güvenlik İl Müdürlüğü'),
(6, 'site_description', 'sss'),
(7, 'keywords', 'ss'),
(22, 'theme', 'skin-green_2-light'),
(23, 'version', '1.0.0'),
(29, 'app_logo', '20180601222723-20180516123609-cskn.png'),
(30, 'app_ico', '20180601222723-20180516123609-cskn.png'),
(31, 'cms_theme', 'default'),
(32, 'web_theme', 'default'),
(33, 'app_login', 'helicopter-2966569-1920.jpg'),
(34, 'under_note', '<p>Bir şeyler ters gitti ve onu d&uuml;zeltmeye &ccedil;alışıyoruz.<br />\r\nAnlayışınız i&ccedil;in teşekk&uuml;r ederiz</p>\r\n'),
(35, 'modal_title_color', '6494AA'),
(36, 'modal_title_font_color', 'FFFFFF'),
(40, 'allowed_types', 'xls|xlsx'),
(41, 'max_file_size', '100'),
(42, 'max_image_width', '1024'),
(43, 'max_image_height', '768'),
(44, 'media_folder', 'storage'),
(45, 'max_file_name_lenght', '0'),
(46, 'max_upload_piece', '10'),
(47, 'write_on', '1'),
(48, 'file_space', '1'),
(49, 'file_encryption', '1'),
(50, 'app_short_name', 'SGKAY'),
(60, 'ft_folder_status', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_popups`
--

CREATE TABLE `cms_popups` (
  `popup_id` int(11) UNSIGNED NOT NULL,
  `popup_token_key` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `page_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cms_user_activity`
--

CREATE TABLE `cms_user_activity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(250) NOT NULL,
  `action` varchar(100) NOT NULL,
  `data_where` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `ip_addres` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cms_user_activity`
--

INSERT INTO `cms_user_activity` (`activity_id`, `user_id`, `table_name`, `action`, `data_where`, `url`, `ip_addres`, `time`) VALUES
(18749, 1, 'cms_menu', 'Read', '\"176\"', 'cms/menu/delete/176', '::1', '2018-12-25 12:33:22'),
(18750, 1, 'cms_menu', 'Delete', '\"176\"', 'cms/menu/delete/176', '::1', '2018-12-25 12:33:22'),
(18751, 1, 'cms_aauth_perms', 'Read', '{\"id\":\"36\"}', 'cms/menu/delete/176', '::1', '2018-12-25 12:33:22'),
(18752, 1, 'cms_aauth_perms', 'Read', '\"5\"', 'cms/permission/modal_render', '::1', '2018-12-25 12:35:48'),
(18753, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:39:08'),
(18754, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:39:08'),
(18755, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:39:08'),
(18756, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:50:03'),
(18757, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:50:03'),
(18758, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:50:03'),
(18759, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit_save/131', '::1', '2018-12-25 12:50:10'),
(18760, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-admin-islemleri\"}', 'cms/menu/edit_save/131', '::1', '2018-12-25 12:50:10'),
(18761, 1, 'cms_menu', 'Update', '\"131\"', 'cms/menu/edit_save/131', '::1', '2018-12-25 12:50:10'),
(18762, 1, 'cms_menu', 'Read', '\"2\"', 'cms/menu/edit/2', '::1', '2018-12-25 12:50:12'),
(18763, 1, 'cms_menu', 'Read', '\"2\"', 'cms/menu/edit/2', '::1', '2018-12-25 12:50:12'),
(18764, 1, 'cms_menu', 'Read', '\"2\"', 'cms/menu/edit/2', '::1', '2018-12-25 12:50:12'),
(18765, 1, 'cms_menu', 'Read', '\"2\"', 'cms/menu/edit_save/2', '::1', '2018-12-25 12:50:14'),
(18766, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-dashboard\"}', 'cms/menu/edit_save/2', '::1', '2018-12-25 12:50:14'),
(18767, 1, 'cms_menu', 'Update', '\"2\"', 'cms/menu/edit_save/2', '::1', '2018-12-25 12:50:14'),
(18768, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:50:15'),
(18769, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:50:15'),
(18770, 1, 'cms_menu', 'Read', '\"131\"', 'cms/menu/edit/131', '::1', '2018-12-25 12:50:15'),
(18771, 1, 'cms_menu', 'Read', '\"82\"', 'cms/menu/edit/82', '::1', '2018-12-25 12:51:21'),
(18772, 1, 'cms_menu', 'Read', '\"82\"', 'cms/menu/edit/82', '::1', '2018-12-25 12:51:21'),
(18773, 1, 'cms_menu', 'Read', '\"82\"', 'cms/menu/edit/82', '::1', '2018-12-25 12:51:21'),
(18774, 1, 'cms_menu', 'Read', '\"82\"', 'cms/menu/edit_save/82', '::1', '2018-12-25 12:51:23'),
(18775, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-menu\"}', 'cms/menu/edit_save/82', '::1', '2018-12-25 12:51:23'),
(18776, 1, 'cms_menu', 'Update', '\"82\"', 'cms/menu/edit_save/82', '::1', '2018-12-25 12:51:23'),
(18777, 1, 'cms_menu', 'Read', '\"9\"', 'cms/menu/edit/9', '::1', '2018-12-25 12:51:25'),
(18778, 1, 'cms_menu', 'Read', '\"9\"', 'cms/menu/edit/9', '::1', '2018-12-25 12:51:25'),
(18779, 1, 'cms_menu', 'Read', '\"9\"', 'cms/menu/edit/9', '::1', '2018-12-25 12:51:25'),
(18780, 1, 'cms_menu', 'Read', '\"9\"', 'cms/menu/edit_save/9', '::1', '2018-12-25 12:51:26'),
(18781, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-kullanicilar\"}', 'cms/menu/edit_save/9', '::1', '2018-12-25 12:51:26'),
(18782, 1, 'cms_menu', 'Update', '\"9\"', 'cms/menu/edit_save/9', '::1', '2018-12-25 12:51:26'),
(18783, 1, 'cms_menu', 'Read', '\"10\"', 'cms/menu/edit/10', '::1', '2018-12-25 12:51:28'),
(18784, 1, 'cms_menu', 'Read', '\"10\"', 'cms/menu/edit/10', '::1', '2018-12-25 12:51:28'),
(18785, 1, 'cms_menu', 'Read', '\"10\"', 'cms/menu/edit/10', '::1', '2018-12-25 12:51:28'),
(18786, 1, 'cms_menu', 'Read', '\"10\"', 'cms/menu/edit_save/10', '::1', '2018-12-25 12:51:30'),
(18787, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-kullanici-gruplari\"}', 'cms/menu/edit_save/10', '::1', '2018-12-25 12:51:30'),
(18788, 1, 'cms_menu', 'Update', '\"10\"', 'cms/menu/edit_save/10', '::1', '2018-12-25 12:51:30'),
(18789, 1, 'cms_menu', 'Read', '\"11\"', 'cms/menu/edit/11', '::1', '2018-12-25 12:51:33'),
(18790, 1, 'cms_menu', 'Read', '\"11\"', 'cms/menu/edit/11', '::1', '2018-12-25 12:51:33'),
(18791, 1, 'cms_menu', 'Read', '\"11\"', 'cms/menu/edit/11', '::1', '2018-12-25 12:51:33'),
(18792, 1, 'cms_menu', 'Read', '\"11\"', 'cms/menu/edit_save/11', '::1', '2018-12-25 12:51:34'),
(18793, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-yetki-islemleri\"}', 'cms/menu/edit_save/11', '::1', '2018-12-25 12:51:34'),
(18794, 1, 'cms_menu', 'Update', '\"11\"', 'cms/menu/edit_save/11', '::1', '2018-12-25 12:51:34'),
(18795, 1, 'cms_menu', 'Read', '\"11\"', 'cms/menu/edit/11', '::1', '2018-12-25 12:51:37'),
(18796, 1, 'cms_menu', 'Read', '\"11\"', 'cms/menu/edit/11', '::1', '2018-12-25 12:51:37'),
(18797, 1, 'cms_menu', 'Read', '\"11\"', 'cms/menu/edit/11', '::1', '2018-12-25 12:51:37'),
(18798, 1, 'cms_menu', 'Read', '\"10\"', 'cms/menu/edit/10', '::1', '2018-12-25 12:51:40'),
(18799, 1, 'cms_menu', 'Read', '\"10\"', 'cms/menu/edit/10', '::1', '2018-12-25 12:51:40'),
(18800, 1, 'cms_menu', 'Read', '\"10\"', 'cms/menu/edit/10', '::1', '2018-12-25 12:51:40'),
(18801, 1, 'cms_menu', 'Read', '\"91\"', 'cms/menu/edit/91', '::1', '2018-12-25 12:51:43'),
(18802, 1, 'cms_menu', 'Read', '\"91\"', 'cms/menu/edit/91', '::1', '2018-12-25 12:51:43'),
(18803, 1, 'cms_menu', 'Read', '\"91\"', 'cms/menu/edit/91', '::1', '2018-12-25 12:51:43'),
(18804, 1, 'cms_menu', 'Read', '\"91\"', 'cms/menu/edit_save/91', '::1', '2018-12-25 12:51:45'),
(18805, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-popup\"}', 'cms/menu/edit_save/91', '::1', '2018-12-25 12:51:45'),
(18806, 1, 'cms_menu', 'Update', '\"91\"', 'cms/menu/edit_save/91', '::1', '2018-12-25 12:51:45'),
(18807, 1, 'cms_menu', 'Read', '\"114\"', 'cms/menu/edit/114', '::1', '2018-12-25 12:51:46'),
(18808, 1, 'cms_menu', 'Read', '\"114\"', 'cms/menu/edit/114', '::1', '2018-12-25 12:51:46'),
(18809, 1, 'cms_menu', 'Read', '\"114\"', 'cms/menu/edit/114', '::1', '2018-12-25 12:51:46'),
(18810, 1, 'cms_menu', 'Read', '\"114\"', 'cms/menu/edit_save/114', '::1', '2018-12-25 12:51:48'),
(18811, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-manuel-sorgular\"}', 'cms/menu/edit_save/114', '::1', '2018-12-25 12:51:48'),
(18812, 1, 'cms_menu', 'Update', '\"114\"', 'cms/menu/edit_save/114', '::1', '2018-12-25 12:51:48'),
(18813, 1, 'cms_menu', 'Read', '\"115\"', 'cms/menu/edit/115', '::1', '2018-12-25 12:51:49'),
(18814, 1, 'cms_menu', 'Read', '\"115\"', 'cms/menu/edit/115', '::1', '2018-12-25 12:51:49'),
(18815, 1, 'cms_menu', 'Read', '\"115\"', 'cms/menu/edit/115', '::1', '2018-12-25 12:51:49'),
(18816, 1, 'cms_menu', 'Read', '\"115\"', 'cms/menu/edit_save/115', '::1', '2018-12-25 12:51:51'),
(18817, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-otomatik-sorgular\"}', 'cms/menu/edit_save/115', '::1', '2018-12-25 12:51:51'),
(18818, 1, 'cms_menu', 'Update', '\"115\"', 'cms/menu/edit_save/115', '::1', '2018-12-25 12:51:51'),
(18819, 1, 'cms_menu', 'Read', '\"87\"', 'cms/menu/edit/87', '::1', '2018-12-25 12:51:53'),
(18820, 1, 'cms_menu', 'Read', '\"87\"', 'cms/menu/edit/87', '::1', '2018-12-25 12:51:53'),
(18821, 1, 'cms_menu', 'Read', '\"87\"', 'cms/menu/edit/87', '::1', '2018-12-25 12:51:53'),
(18822, 1, 'cms_menu', 'Read', '\"87\"', 'cms/menu/edit_save/87', '::1', '2018-12-25 12:51:54'),
(18823, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-yedekleme\"}', 'cms/menu/edit_save/87', '::1', '2018-12-25 12:51:54'),
(18824, 1, 'cms_menu', 'Update', '\"87\"', 'cms/menu/edit_save/87', '::1', '2018-12-25 12:51:54'),
(18825, 1, 'cms_menu', 'Read', '\"93\"', 'cms/menu/edit/93', '::1', '2018-12-25 12:51:56'),
(18826, 1, 'cms_menu', 'Read', '\"93\"', 'cms/menu/edit/93', '::1', '2018-12-25 12:51:56'),
(18827, 1, 'cms_menu', 'Read', '\"93\"', 'cms/menu/edit/93', '::1', '2018-12-25 12:51:56'),
(18828, 1, 'cms_menu', 'Read', '\"93\"', 'cms/menu/edit_save/93', '::1', '2018-12-25 12:51:58'),
(18829, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-kullanici-aktivitileri\"}', 'cms/menu/edit_save/93', '::1', '2018-12-25 12:51:58'),
(18830, 1, 'cms_menu', 'Update', '\"93\"', 'cms/menu/edit_save/93', '::1', '2018-12-25 12:51:58'),
(18831, 1, 'cms_menu', 'Read', '\"67\"', 'cms/menu/edit/67', '::1', '2018-12-25 12:52:00'),
(18832, 1, 'cms_menu', 'Read', '\"67\"', 'cms/menu/edit/67', '::1', '2018-12-25 12:52:00'),
(18833, 1, 'cms_menu', 'Read', '\"67\"', 'cms/menu/edit/67', '::1', '2018-12-25 12:52:00'),
(18834, 1, 'cms_menu', 'Read', '\"67\"', 'cms/menu/edit_save/67', '::1', '2018-12-25 12:52:01'),
(18835, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-ayarlar\"}', 'cms/menu/edit_save/67', '::1', '2018-12-25 12:52:01'),
(18836, 1, 'cms_menu', 'Update', '\"67\"', 'cms/menu/edit_save/67', '::1', '2018-12-25 12:52:01'),
(18837, 1, 'cms_menu', 'Read', '\"151\"', 'cms/menu/edit/151', '::1', '2018-12-25 12:52:03'),
(18838, 1, 'cms_menu', 'Read', '\"151\"', 'cms/menu/edit/151', '::1', '2018-12-25 12:52:03'),
(18839, 1, 'cms_menu', 'Read', '\"151\"', 'cms/menu/edit/151', '::1', '2018-12-25 12:52:03'),
(18840, 1, 'cms_menu', 'Read', '\"151\"', 'cms/menu/edit_save/151', '::1', '2018-12-25 12:52:05'),
(18841, 1, 'cms_aauth_perms', 'Read', '{\"name\":\"nav-ana-sayfa\"}', 'cms/menu/edit_save/151', '::1', '2018-12-25 12:52:05'),
(18842, 1, 'cms_menu', 'Update', '\"151\"', 'cms/menu/edit_save/151', '::1', '2018-12-25 12:52:06'),
(18843, 1, 'cms_aauth_users', 'Logout', '1', 'auth/logout', '::1', '2018-12-25 12:56:14'),
(18844, 1, 'cms_aauth_users', 'Login', '1', '', '::1', '2018-12-25 12:56:22');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cms_aauth_groups`
--
ALTER TABLE `cms_aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cms_aauth_perms`
--
ALTER TABLE `cms_aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cms_aauth_perm_to_group`
--
ALTER TABLE `cms_aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Tablo için indeksler `cms_aauth_users`
--
ALTER TABLE `cms_aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cms_aauth_user_to_group`
--
ALTER TABLE `cms_aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Tablo için indeksler `cms_menu`
--
ALTER TABLE `cms_menu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cms_menu_type`
--
ALTER TABLE `cms_menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cms_options`
--
ALTER TABLE `cms_options`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cms_popups`
--
ALTER TABLE `cms_popups`
  ADD PRIMARY KEY (`popup_id`);

--
-- Tablo için indeksler `cms_user_activity`
--
ALTER TABLE `cms_user_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cms_aauth_groups`
--
ALTER TABLE `cms_aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `cms_aauth_perms`
--
ALTER TABLE `cms_aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `cms_aauth_users`
--
ALTER TABLE `cms_aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `cms_menu`
--
ALTER TABLE `cms_menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- Tablo için AUTO_INCREMENT değeri `cms_menu_type`
--
ALTER TABLE `cms_menu_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `cms_options`
--
ALTER TABLE `cms_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Tablo için AUTO_INCREMENT değeri `cms_popups`
--
ALTER TABLE `cms_popups`
  MODIFY `popup_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `cms_user_activity`
--
ALTER TABLE `cms_user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18845;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
