# Host: localhost  (Version 5.5.5-10.1.37-MariaDB)
# Date: 2019-03-11 15:14:36
# Generator: MySQL-Front 6.1  (Build 1.26)

SET NAMES utf8;

#
# Structure for table "cms_aauth_groups"
#

DROP TABLE IF EXISTS `cms_aauth_groups`;
CREATE TABLE `cms_aauth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "cms_aauth_groups"
#

INSERT INTO `cms_aauth_groups` VALUES (1,'Admin','Super Admin Group'),(2,'Public','Görüntüleme Yetkisi');

#
# Structure for table "cms_aauth_perm_to_group"
#

DROP TABLE IF EXISTS `cms_aauth_perm_to_group`;
CREATE TABLE `cms_aauth_perm_to_group` (
  `perm_id` int(11) unsigned NOT NULL DEFAULT '0',
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "cms_aauth_perm_to_group"
#

INSERT INTO `cms_aauth_perm_to_group` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(14,2),(15,1),(15,2),(17,1),(17,2),(18,1),(18,2),(19,1),(20,1),(20,2),(21,2),(22,2),(23,2),(24,2);

#
# Structure for table "cms_aauth_perms"
#

DROP TABLE IF EXISTS `cms_aauth_perms`;
CREATE TABLE `cms_aauth_perms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

#
# Data for table "cms_aauth_perms"
#

INSERT INTO `cms_aauth_perms` VALUES (1,'navigation_admin-islemleri','Admin İşlemleri İşlemleri Menü Linki'),(2,'navigation_dashboard','Dashboard İşlemleri Menü Linki'),(3,'navigation_menu','Menü İşlemleri Menü Linki'),(4,'navigation_kullanicilar','Kullanıcılar İşlemleri Menü Linki'),(5,'navigation_kullanici-gruplari','Kullanıcı Grupları İşlemleri Menü Linki'),(6,'navigation_uygulama-izinleri','Uygulama İzinleri İşlemleri Menü Linki'),(7,'navigation_yetki-islemleri','Yetki İşlemleri İşlemleri Menü Linki'),(8,'navigation_popup','Popup İşlemleri Menü Linki'),(9,'navigation_manuel-sorgular','Manuel Sorgular İşlemleri Menü Linki'),(10,'navigation_otomatik-sorgular','Otomatik Sorgular İşlemleri Menü Linki'),(11,'navigation_yedekleme','Yedekleme İşlemleri Menü Linki'),(12,'navigation_kullanici-aktivitileri','Kullanıcı Aktivitileri İşlemleri Menü Linki'),(13,'navigation_ayarlar','Ayarlar İşlemleri Menü Linki'),(14,'navigation_ana-sayfa','Ana Sayfa İşlemleri Menü Linki'),(15,'navigation_ziyaretci-islemleri','Ziyaretçi İşlemleri İşlemleri Menü Linki'),(17,'navigation_telefon-gorusmeleri','Telefon Görüşmeleri İşlemleri Menü Linki'),(18,'navigation_takip-islemleri','Takip İşlemleri İşlemleri Menü Linki'),(19,'navigation_birimler','Birimler Menü Linki'),(20,'navigation_randevu-islemleri','Randevu İşlemleri İşlemleri Menü Linki'),(21,'randevu','Randevu İşlemleri'),(22,'takip','Takip İşlemleri'),(23,'telefon','Telefon İşlemleri'),(24,'ziyaretci','Ziyaretçi İşlemleri');

#
# Structure for table "cms_aauth_user_to_group"
#

DROP TABLE IF EXISTS `cms_aauth_user_to_group`;
CREATE TABLE `cms_aauth_user_to_group` (
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "cms_aauth_user_to_group"
#

INSERT INTO `cms_aauth_user_to_group` VALUES (1,1),(57,2);

#
# Structure for table "cms_aauth_users"
#

DROP TABLE IF EXISTS `cms_aauth_users`;
CREATE TABLE `cms_aauth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `full_name` varchar(200) NOT NULL,
  `user_birim` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
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
  `login_attempts` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

#
# Data for table "cms_aauth_users"
#
# password for all user: iyte+1992

INSERT INTO `cms_aauth_users` VALUES(1,	'admin@localhost',	'06a84b6d368146e9d2d72224b218417277bd4a9fbdd1c03916001236976b92c2',	'admin',	'Admin Kullanıcı',	1,	1,	'male.png',	0,	'2019-03-19 13:29:34',	'2019-03-19 13:29:34',	'2019-03-19 13:00:00',	NULL,	NULL,	NULL,	NULL,	'172.22.0.1',	NULL),(2,	'ahmetaksit@gmail.com',	'9787854009178ccbf4a46c42bf9c5a845621f376722f1ed7d0df1492b42bbc75',	'ahmetaksit',	'Ahmet AKŞİT',	1,	1,	'male.png',	0,	'2019-03-19 13:27:01',	'2019-03-19 13:27:01',	'2019-03-19 13:00:00',	NULL,	NULL,	NULL,	NULL,	'172.22.0.1',	NULL), (3,	'cskncms@gmail.com',	'd5a7974234cf24877e3d7c782dc9e706e34e3ba6e7305ff14281dfbf4a5c57f5',	'cskncms',	'Coşkun EŞKİLER',	3,	1,	'male.png',	0,	'2019-03-19 13:30:20',	'2019-03-19 13:30:20',	'2019-03-19 13:00:00',	NULL,	NULL,	NULL,	NULL,	'172.22.0.1',	NULL);

#
# Structure for table "cms_menu"
#

DROP TABLE IF EXISTS `cms_menu`;
CREATE TABLE `cms_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `icon_color` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `perm_id` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "cms_menu"
#

INSERT INTO `cms_menu` VALUES (2,'Dashboard','menu','#E80505','cms/dashboard',2,2,131,'fa-contao',1),(9,'Kullanıcılar','menu','#BED119','cms/user',4,4,131,'fa-user',1),(10,'Kullanıcı Grupları','menu','#18698C','cms/group',5,5,131,'fa-group',1),(11,'Yetki İşlemleri','menu','#0008F5','cms/access_group',7,7,131,'fa-thumb-tack',1),(12,'Uygulama İzinleri','menu','#6F21D1','cms/permission',6,6,131,'fa-check',1),(67,'Ayarlar','menu','#74AD84','cms/setting',13,13,131,'fa-cogs',1),(82,'Menü','menu','#2982FF','cms/menu',3,3,131,'fa-list',1),(87,'Yedekleme','menu','#C71418','cms/database_backup',11,11,131,'fa-database',1),(91,'Popup','menu','#965B4E','cms/popup',8,8,131,'fa-bullhorn',1),(93,'Kullanıcı Aktivitileri','menu','#FF0000','cms/log/user_activity',12,12,131,'fa-user-secret',1),(114,'Manuel Sorgular','menu','#1119CF','cms/query_builder/manuel',9,9,131,'fa-chrome',1),(115,'Otomatik Sorgular','menu','#BF111F','cms/query_builder/auto',10,10,131,'fa-houzz',1),(131,'Admin İşlemleri','menu','#DB0202','#',1,1,0,'fa-key',1),(151,'Ana Sayfa','menu','#9CB005','home',14,15,0,'fa-home',1),(168,'Ziyaretçi İşlemleri','menu','#A210E0','ziyaretci',15,16,0,'fa-users',1),(169,'Randevu İşlemleri','menu','#C71212','randevu/1',20,17,0,'fa-calendar',1),(170,'Telefon Görüşmeleri','menu','#D12469','telefon',17,19,0,'fa-phone',1),(173,'Takip İşlemleri','menu','#BA7D22','takip',18,18,0,'fa-search-plus',1),(174,'Birimler','menu','#FF1C9F','cms/birim',19,14,131,'fa-cc-diners-club',1);

#
# Structure for table "cms_menu_type"
#

DROP TABLE IF EXISTS `cms_menu_type`;
CREATE TABLE `cms_menu_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "cms_menu_type"
#

INSERT INTO `cms_menu_type` VALUES (1,'side menu',NULL);

#
# Structure for table "cms_options"
#

DROP TABLE IF EXISTS `cms_options`;
CREATE TABLE `cms_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) NOT NULL,
  `option_value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "cms_options"
#

INSERT INTO `cms_options` VALUES (3,'app_name','Ozel Kalem Büro Sistemi'),(4,'email','ahmetaksit@gmail.com'),(5,'author','İzmir Yüksek Teknoloji Enstitüsü'),(6,'site_description','sss'),(7,'keywords','ss'),(22,'theme','skin-green_2-light'),(23,'version','1.1.0'),(29,'app_logo','iyte-logo-tur.png'),(30,'app_ico','iyte-logo-tur.png'),(31,'cms_theme','default'),(32,'web_theme','default'),(33,'app_login','planner-2641215-1920.jpg'),(34,'under_note','<p>Bir şeyler ters gitti ve onu d&uuml;zeltmeye &ccedil;alışıyoruz.<br />\r\nAnlayışınız i&ccedil;in teşekk&uuml;r ederiz</p>\r\n'),(35,'modal_title_color','6494AA'),(36,'modal_title_font_color','FFFFFF'),(40,'allowed_types','doc|docx'),(41,'max_file_size','100'),(42,'max_image_width','1024'),(43,'max_image_height','768'),(44,'media_folder','storage'),(45,'max_file_name_lenght','0'),(46,'max_upload_piece','10'),(47,'write_on','1'),(48,'file_space','1'),(49,'file_encryption','1'),(50,'app_short_name','OKBS'),(60,'ft_folder_status','1');

#
# Structure for table "cms_popups"
#

DROP TABLE IF EXISTS `cms_popups`;
CREATE TABLE `cms_popups` (
  `popup_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `popup_token_key` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `page_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`popup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "cms_popups"
#


#
# Structure for table "cms_user_activity"
#

DROP TABLE IF EXISTS `cms_user_activity`;
CREATE TABLE `cms_user_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(250) NOT NULL,
  `action` varchar(100) NOT NULL,
  `data_where` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `ip_addres` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8;

#
# Data for table "cms_user_activity"
#

INSERT INTO `cms_user_activity` VALUES (1,1,'cms_menu','Read','\"131\"','cms/menu/edit/131','192.168.1.22','2019-03-10 14:02:21'),(2,1,'cms_menu','Read','\"131\"','cms/menu/edit/131','192.168.1.22','2019-03-10 14:02:21'),(3,1,'cms_menu','Read','\"131\"','cms/menu/edit/131','192.168.1.22','2019-03-10 14:02:21'),(4,1,'cms_menu','Read','\"131\"','cms/menu/edit_save/131','192.168.1.22','2019-03-10 14:02:25'),(5,1,'cms_aauth_perms','Read','{\"name\":\"navigation_admin-islemleri\"}','cms/menu/edit_save/131','192.168.1.22','2019-03-10 14:02:25'),(6,1,'cms_menu','Update','\"131\"','cms/menu/edit_save/131','192.168.1.22','2019-03-10 14:02:25'),(7,1,'cms_menu','Read','\"2\"','cms/menu/edit/2','192.168.1.22','2019-03-10 14:02:27'),(8,1,'cms_menu','Read','\"2\"','cms/menu/edit/2','192.168.1.22','2019-03-10 14:02:27'),(9,1,'cms_menu','Read','\"2\"','cms/menu/edit/2','192.168.1.22','2019-03-10 14:02:27'),(10,1,'cms_menu','Read','\"2\"','cms/menu/edit_save/2','192.168.1.22','2019-03-10 14:02:32'),(11,1,'cms_aauth_perms','Read','{\"name\":\"navigation_dashboard\"}','cms/menu/edit_save/2','192.168.1.22','2019-03-10 14:02:32'),(12,1,'cms_menu','Update','\"2\"','cms/menu/edit_save/2','192.168.1.22','2019-03-10 14:02:32'),(13,1,'cms_menu','Read','\"82\"','cms/menu/edit/82','192.168.1.22','2019-03-10 14:02:34'),(14,1,'cms_menu','Read','\"82\"','cms/menu/edit/82','192.168.1.22','2019-03-10 14:02:34'),(15,1,'cms_menu','Read','\"82\"','cms/menu/edit/82','192.168.1.22','2019-03-10 14:02:34'),(16,1,'cms_menu','Read','\"82\"','cms/menu/edit_save/82','192.168.1.22','2019-03-10 14:02:36'),(17,1,'cms_aauth_perms','Read','{\"name\":\"navigation_menu\"}','cms/menu/edit_save/82','192.168.1.22','2019-03-10 14:02:36'),(18,1,'cms_menu','Update','\"82\"','cms/menu/edit_save/82','192.168.1.22','2019-03-10 14:02:36'),(19,1,'cms_menu','Read','\"9\"','cms/menu/edit/9','192.168.1.22','2019-03-10 14:02:38'),(20,1,'cms_menu','Read','\"9\"','cms/menu/edit/9','192.168.1.22','2019-03-10 14:02:38'),(21,1,'cms_menu','Read','\"9\"','cms/menu/edit/9','192.168.1.22','2019-03-10 14:02:38'),(22,1,'cms_menu','Read','\"9\"','cms/menu/edit_save/9','192.168.1.22','2019-03-10 14:02:39'),(23,1,'cms_aauth_perms','Read','{\"name\":\"navigation_kullanicilar\"}','cms/menu/edit_save/9','192.168.1.22','2019-03-10 14:02:39'),(24,1,'cms_menu','Update','\"9\"','cms/menu/edit_save/9','192.168.1.22','2019-03-10 14:02:39'),(25,1,'cms_menu','Read','\"9\"','cms/menu/edit/9','192.168.1.22','2019-03-10 14:02:43'),(26,1,'cms_menu','Read','\"9\"','cms/menu/edit/9','192.168.1.22','2019-03-10 14:02:43'),(27,1,'cms_menu','Read','\"9\"','cms/menu/edit/9','192.168.1.22','2019-03-10 14:02:43'),(28,1,'cms_menu','Read','\"10\"','cms/menu/edit/10','192.168.1.22','2019-03-10 14:02:46'),(29,1,'cms_menu','Read','\"10\"','cms/menu/edit/10','192.168.1.22','2019-03-10 14:02:46'),(30,1,'cms_menu','Read','\"10\"','cms/menu/edit/10','192.168.1.22','2019-03-10 14:02:46'),(31,1,'cms_menu','Read','\"10\"','cms/menu/edit_save/10','192.168.1.22','2019-03-10 14:02:48'),(32,1,'cms_aauth_perms','Read','{\"name\":\"navigation_kullanici-gruplari\"}','cms/menu/edit_save/10','192.168.1.22','2019-03-10 14:02:48'),(33,1,'cms_menu','Update','\"10\"','cms/menu/edit_save/10','192.168.1.22','2019-03-10 14:02:48'),(34,1,'cms_menu','Read','\"12\"','cms/menu/edit/12','192.168.1.22','2019-03-10 14:02:50'),(35,1,'cms_menu','Read','\"12\"','cms/menu/edit/12','192.168.1.22','2019-03-10 14:02:50'),(36,1,'cms_menu','Read','\"12\"','cms/menu/edit/12','192.168.1.22','2019-03-10 14:02:50'),(37,1,'cms_menu','Read','\"12\"','cms/menu/edit_save/12','192.168.1.22','2019-03-10 14:02:52'),(38,1,'cms_aauth_perms','Read','{\"name\":\"navigation_uygulama-izinleri\"}','cms/menu/edit_save/12','192.168.1.22','2019-03-10 14:02:52'),(39,1,'cms_menu','Update','\"12\"','cms/menu/edit_save/12','192.168.1.22','2019-03-10 14:02:52'),(40,1,'cms_menu','Read','\"11\"','cms/menu/edit/11','192.168.1.22','2019-03-10 14:02:54'),(41,1,'cms_menu','Read','\"11\"','cms/menu/edit/11','192.168.1.22','2019-03-10 14:02:54'),(42,1,'cms_menu','Read','\"11\"','cms/menu/edit/11','192.168.1.22','2019-03-10 14:02:54'),(43,1,'cms_menu','Read','\"11\"','cms/menu/edit_save/11','192.168.1.22','2019-03-10 14:02:56'),(44,1,'cms_aauth_perms','Read','{\"name\":\"navigation_yetki-islemleri\"}','cms/menu/edit_save/11','192.168.1.22','2019-03-10 14:02:56'),(45,1,'cms_menu','Update','\"11\"','cms/menu/edit_save/11','192.168.1.22','2019-03-10 14:02:56'),(46,1,'cms_menu','Read','\"91\"','cms/menu/edit/91','192.168.1.22','2019-03-10 14:02:58'),(47,1,'cms_menu','Read','\"91\"','cms/menu/edit/91','192.168.1.22','2019-03-10 14:02:58'),(48,1,'cms_menu','Read','\"91\"','cms/menu/edit/91','192.168.1.22','2019-03-10 14:02:58'),(49,1,'cms_menu','Read','\"91\"','cms/menu/edit_save/91','192.168.1.22','2019-03-10 14:02:59'),(50,1,'cms_aauth_perms','Read','{\"name\":\"navigation_popup\"}','cms/menu/edit_save/91','192.168.1.22','2019-03-10 14:02:59'),(51,1,'cms_menu','Update','\"91\"','cms/menu/edit_save/91','192.168.1.22','2019-03-10 14:02:59'),(52,1,'cms_menu','Read','\"114\"','cms/menu/edit/114','192.168.1.22','2019-03-10 14:03:01'),(53,1,'cms_menu','Read','\"114\"','cms/menu/edit/114','192.168.1.22','2019-03-10 14:03:01'),(54,1,'cms_menu','Read','\"114\"','cms/menu/edit/114','192.168.1.22','2019-03-10 14:03:01'),(55,1,'cms_menu','Read','\"114\"','cms/menu/edit_save/114','192.168.1.22','2019-03-10 14:03:02'),(56,1,'cms_aauth_perms','Read','{\"name\":\"navigation_manuel-sorgular\"}','cms/menu/edit_save/114','192.168.1.22','2019-03-10 14:03:02'),(57,1,'cms_menu','Update','\"114\"','cms/menu/edit_save/114','192.168.1.22','2019-03-10 14:03:02'),(58,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:04'),(59,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:04'),(60,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:04'),(61,1,'cms_menu','Read','\"115\"','cms/menu/edit_save/115','192.168.1.22','2019-03-10 14:03:06'),(62,1,'cms_aauth_perms','Read','{\"name\":\"navigation_otomatik-sorgular\"}','cms/menu/edit_save/115','192.168.1.22','2019-03-10 14:03:06'),(63,1,'cms_menu','Update','\"115\"','cms/menu/edit_save/115','192.168.1.22','2019-03-10 14:03:06'),(64,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:09'),(65,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:09'),(66,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:09'),(67,1,'cms_menu','Read','\"114\"','cms/menu/edit/114','192.168.1.22','2019-03-10 14:03:13'),(68,1,'cms_menu','Read','\"114\"','cms/menu/edit/114','192.168.1.22','2019-03-10 14:03:13'),(69,1,'cms_menu','Read','\"114\"','cms/menu/edit/114','192.168.1.22','2019-03-10 14:03:13'),(70,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:16'),(71,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:16'),(72,1,'cms_menu','Read','\"115\"','cms/menu/edit/115','192.168.1.22','2019-03-10 14:03:16'),(73,1,'cms_menu','Read','\"87\"','cms/menu/edit/87','192.168.1.22','2019-03-10 14:03:20'),(74,1,'cms_menu','Read','\"87\"','cms/menu/edit/87','192.168.1.22','2019-03-10 14:03:20'),(75,1,'cms_menu','Read','\"87\"','cms/menu/edit/87','192.168.1.22','2019-03-10 14:03:20'),(76,1,'cms_menu','Read','\"87\"','cms/menu/edit_save/87','192.168.1.22','2019-03-10 14:03:21'),(77,1,'cms_aauth_perms','Read','{\"name\":\"navigation_yedekleme\"}','cms/menu/edit_save/87','192.168.1.22','2019-03-10 14:03:21'),(78,1,'cms_menu','Update','\"87\"','cms/menu/edit_save/87','192.168.1.22','2019-03-10 14:03:21'),(79,1,'cms_menu','Read','\"93\"','cms/menu/edit/93','192.168.1.22','2019-03-10 14:03:23'),(80,1,'cms_menu','Read','\"93\"','cms/menu/edit/93','192.168.1.22','2019-03-10 14:03:23'),(81,1,'cms_menu','Read','\"93\"','cms/menu/edit/93','192.168.1.22','2019-03-10 14:03:23'),(82,1,'cms_menu','Read','\"93\"','cms/menu/edit_save/93','192.168.1.22','2019-03-10 14:03:25'),(83,1,'cms_aauth_perms','Read','{\"name\":\"navigation_kullanici-aktivitileri\"}','cms/menu/edit_save/93','192.168.1.22','2019-03-10 14:03:25'),(84,1,'cms_menu','Update','\"93\"','cms/menu/edit_save/93','192.168.1.22','2019-03-10 14:03:25'),(85,1,'cms_menu','Read','\"67\"','cms/menu/edit/67','192.168.1.22','2019-03-10 14:03:27'),(86,1,'cms_menu','Read','\"67\"','cms/menu/edit/67','192.168.1.22','2019-03-10 14:03:27'),(87,1,'cms_menu','Read','\"67\"','cms/menu/edit/67','192.168.1.22','2019-03-10 14:03:27'),(88,1,'cms_menu','Read','\"67\"','cms/menu/edit_save/67','192.168.1.22','2019-03-10 14:03:29'),(89,1,'cms_aauth_perms','Read','{\"name\":\"navigation_ayarlar\"}','cms/menu/edit_save/67','192.168.1.22','2019-03-10 14:03:29'),(90,1,'cms_menu','Update','\"67\"','cms/menu/edit_save/67','192.168.1.22','2019-03-10 14:03:29'),(91,1,'cms_menu','Read','\"151\"','cms/menu/edit/151','192.168.1.22','2019-03-10 14:03:31'),(92,1,'cms_menu','Read','\"151\"','cms/menu/edit/151','192.168.1.22','2019-03-10 14:03:31'),(93,1,'cms_menu','Read','\"151\"','cms/menu/edit/151','192.168.1.22','2019-03-10 14:03:31'),(94,1,'cms_menu','Read','\"151\"','cms/menu/edit_save/151','192.168.1.22','2019-03-10 14:03:33'),(95,1,'cms_aauth_perms','Read','{\"name\":\"navigation_ana-sayfa\"}','cms/menu/edit_save/151','192.168.1.22','2019-03-10 14:03:33'),(96,1,'cms_menu','Update','\"151\"','cms/menu/edit_save/151','192.168.1.22','2019-03-10 14:03:33'),(97,1,'cms_menu','Read','\"168\"','cms/menu/edit/168','192.168.1.22','2019-03-10 14:03:35'),(98,1,'cms_menu','Read','\"168\"','cms/menu/edit/168','192.168.1.22','2019-03-10 14:03:36'),(99,1,'cms_menu','Read','\"168\"','cms/menu/edit/168','192.168.1.22','2019-03-10 14:03:36'),(100,1,'cms_menu','Read','\"168\"','cms/menu/edit_save/168','192.168.1.22','2019-03-10 14:03:38'),(101,1,'cms_aauth_perms','Read','{\"name\":\"navigation_ziyaretci-islemleri\"}','cms/menu/edit_save/168','192.168.1.22','2019-03-10 14:03:38'),(102,1,'cms_menu','Update','\"168\"','cms/menu/edit_save/168','192.168.1.22','2019-03-10 14:03:38'),(103,1,'cms_menu','Read','\"169\"','cms/menu/edit/169','192.168.1.22','2019-03-10 14:03:41'),(104,1,'cms_menu','Read','\"169\"','cms/menu/edit/169','192.168.1.22','2019-03-10 14:03:41'),(105,1,'cms_menu','Read','\"169\"','cms/menu/edit/169','192.168.1.22','2019-03-10 14:03:41'),(106,1,'cms_menu','Read','\"169\"','cms/menu/edit_save/169','192.168.1.22','2019-03-10 14:03:43'),(107,1,'cms_aauth_perms','Read','{\"name\":\"navigation_randevu-islemleri\"}','cms/menu/edit_save/169','192.168.1.22','2019-03-10 14:03:43'),(108,1,'cms_menu','Update','\"169\"','cms/menu/edit_save/169','192.168.1.22','2019-03-10 14:03:43'),(109,1,'cms_menu','Read','\"170\"','cms/menu/edit/170','192.168.1.22','2019-03-10 14:03:45'),(110,1,'cms_menu','Read','\"170\"','cms/menu/edit/170','192.168.1.22','2019-03-10 14:03:45'),(111,1,'cms_menu','Read','\"170\"','cms/menu/edit/170','192.168.1.22','2019-03-10 14:03:45'),(112,1,'cms_menu','Read','\"170\"','cms/menu/edit_save/170','192.168.1.22','2019-03-10 14:03:47'),(113,1,'cms_aauth_perms','Read','{\"name\":\"navigation_telefon-gorusmeleri\"}','cms/menu/edit_save/170','192.168.1.22','2019-03-10 14:03:47'),(114,1,'cms_menu','Update','\"170\"','cms/menu/edit_save/170','192.168.1.22','2019-03-10 14:03:47'),(115,1,'cms_menu','Read','\"173\"','cms/menu/edit/173','192.168.1.22','2019-03-10 14:03:49'),(116,1,'cms_menu','Read','\"173\"','cms/menu/edit/173','192.168.1.22','2019-03-10 14:03:49'),(117,1,'cms_menu','Read','\"173\"','cms/menu/edit/173','192.168.1.22','2019-03-10 14:03:49'),(118,1,'cms_menu','Read','\"173\"','cms/menu/edit_save/173','192.168.1.22','2019-03-10 14:03:51'),(119,1,'cms_aauth_perms','Read','{\"name\":\"navigation_takip-islemleri\"}','cms/menu/edit_save/173','192.168.1.22','2019-03-10 14:03:51'),(120,1,'cms_menu','Update','\"173\"','cms/menu/edit_save/173','192.168.1.22','2019-03-10 14:03:51'),(121,1,'cms_aauth_users','Logout','1','auth/logout','192.168.1.22','2019-03-10 14:05:32'),(122,1,'cms_aauth_users','Login','1','','192.168.1.22','2019-03-10 14:05:34'),(123,1,'cms_aauth_users','Read','\"56\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:15:21'),(124,1,'cms_aauth_users','Read','\"56\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:16:24'),(125,1,'cms_aauth_users','Read','\"56\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:16:53'),(126,1,'cms_aauth_users','Read','\"57\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:22:42'),(127,1,'cms_aauth_users','Read','\"57\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:23:09'),(128,1,'cms_aauth_users','Read','\"57\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:24:01'),(129,1,'cms_aauth_users','Read','\"57\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:24:07'),(130,1,'cms_aauth_users','Read','\"57\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:24:53'),(131,1,'cms_aauth_users','Read','\"57\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:25:13'),(132,1,'cms_aauth_users','Read','\"1\"','cms/user/profile','192.168.1.22','2019-03-10 14:25:32'),(133,1,'cms_aauth_users','Read','\"1\"','cms/user/profile','192.168.1.22','2019-03-10 14:25:41'),(134,1,'cms_aauth_users','Read','\"1\"','cms/user/modal_render','192.168.1.22','2019-03-10 14:25:44'),(135,1,'cms_aauth_users','Read','\"1\"','cms/user/profile','192.168.1.22','2019-03-10 14:25:53'),(136,1,'cms_aauth_users','Read','\"1\"','cms/user/profile','192.168.1.22','2019-03-10 14:27:26'),(137,1,'cms_aauth_perms','Read','{\"name\":\"navigation_birimler\"}','cms/menu/add_save','192.168.1.22','2019-03-10 14:27:51'),(138,1,'cms_menu','Insert','174','cms/menu/add_save','192.168.1.22','2019-03-10 14:27:51'),(139,1,'okbs_birim','Insert','2','cms/birim/add_save','192.168.1.22','2019-03-10 14:33:04'),(140,1,'okbs_birim','Update','\"2\"','cms/birim/set_status','192.168.1.22','2019-03-10 14:37:17'),(141,1,'okbs_birim','Update','\"2\"','cms/birim/set_status','192.168.1.22','2019-03-10 14:37:25'),(142,1,'okbs_birim','Read','\"2\"','cms/birim/modal_render','192.168.1.22','2019-03-10 14:37:39'),(143,1,'okbs_birim','Read','\"2\"','cms/birim/modal_render','192.168.1.22','2019-03-10 14:38:13'),(144,1,'okbs_birim','Update','\"2\"','cms/birim/edit_save/2','192.168.1.22','2019-03-10 14:38:16'),(145,1,'okbs_birim','Read','\"2\"','cms/birim/modal_render','192.168.1.22','2019-03-10 14:38:19'),(146,1,'okbs_birim','Update','\"2\"','cms/birim/edit_save/2','192.168.1.22','2019-03-10 14:38:21'),(147,1,'okbs_birim','Read','\"2\"','cms/birim/modal_render','192.168.1.22','2019-03-10 14:38:52'),(148,1,'okbs_birim','Read','\"2\"','cms/birim/modal_render','192.168.1.22','2019-03-10 14:38:59'),(149,1,'okbs_takip','Read','\"2\"','takip/modal_render','192.168.1.22','2019-03-10 14:46:29'),(150,1,'okbs_takip','Read','\"2\"','takip/modal_render','192.168.1.22','2019-03-10 14:47:01'),(151,1,'okbs_takip','Read','\"2\"','takip/modal_render','192.168.1.22','2019-03-10 14:47:13'),(152,1,'okbs_takip','Update','\"2\"','takip/edit_save/2','192.168.1.22','2019-03-10 14:47:16'),(153,1,'cms_menu','Read','\"169\"','cms/menu/edit/169','192.168.1.22','2019-03-10 15:27:58'),(154,1,'cms_menu','Read','\"169\"','cms/menu/edit/169','192.168.1.22','2019-03-10 15:27:58'),(155,1,'cms_menu','Read','\"169\"','cms/menu/edit/169','192.168.1.22','2019-03-10 15:27:58'),(156,1,'cms_menu','Read','\"169\"','cms/menu/edit_save/169','192.168.1.22','2019-03-10 15:28:07'),(157,1,'cms_aauth_perms','Read','{\"name\":\"navigation_randevu-islemleri\"}','cms/menu/edit_save/169','192.168.1.22','2019-03-10 15:28:07'),(158,1,'cms_menu','Update','\"169\"','cms/menu/edit_save/169','192.168.1.22','2019-03-10 15:28:07'),(159,1,'cms_aauth_users','Login','1','','::1','2019-03-11 09:16:15'),(160,1,'cms_aauth_users','Login','1','','::1','2019-03-11 09:17:13'),(161,1,'cms_aauth_users','Logout','1','auth/logout','::1','2019-03-11 09:47:31'),(162,1,'cms_aauth_users','Login','1','','::1','2019-03-11 09:47:41'),(163,1,'okbs_birim','Insert','3','cms/birim/add_save','::1','2019-03-11 09:51:03'),(164,1,'cms_aauth_users','Login','1','','::1','2019-03-11 14:46:36'),(165,1,'okbs_birim','Insert','4','cms/birim/add_save','::1','2019-03-11 14:47:44'),(166,1,'okbs_ziyaretci','Insert','77','ziyaretci/add_save','::1','2019-03-11 14:48:35'),(167,1,'okbs_ziyaretci','Read','\"77\"','ziyaretci/modal_render','::1','2019-03-11 14:48:40'),(168,1,'okbs_ziyaretci','Read','\"77\"','ziyaretci/modal_render','::1','2019-03-11 14:48:47'),(169,1,'okbs_randevu','Insert','3','randevu/add_save','::1','2019-03-11 14:49:23'),(170,1,'okbs_randevu','Read','\"3\"','randevu/modal_render','::1','2019-03-11 14:49:33'),(171,1,'okbs_randevu','Update','\"3\"','randevu/add_close_save/3','::1','2019-03-11 14:49:37'),(172,1,'okbs_takip','Insert','3','takip/add_save','::1','2019-03-11 14:50:12'),(173,1,'okbs_takip','Read','\"3\"','takip/modal_render','::1','2019-03-11 14:51:06'),(174,1,'okbs_ziyaretci','Read','\"76\"','ziyaretci/modal_render','::1','2019-03-11 14:55:29'),(175,1,'okbs_ziyaretci','Read','\"76\"','ziyaretci/modal_render','::1','2019-03-11 14:55:46'),(176,1,'okbs_randevu','Read','\"2\"','randevu/modal_render','::1','2019-03-11 14:55:52'),(177,1,'okbs_takip','Read','\"3\"','takip/modal_render','::1','2019-03-11 14:55:58'),(178,1,'okbs_takip','Read','\"3\"','takip/modal_render','::1','2019-03-11 14:56:22'),(179,1,'okbs_takip','Read','\"3\"','takip/modal_render','::1','2019-03-11 14:56:37'),(180,1,'okbs_takip','Read','\"3\"','takip/modal_render','::1','2019-03-11 14:56:50'),(181,1,'okbs_telefon','Insert','1','telefon/add_save','::1','2019-03-11 14:58:29'),(182,1,'okbs_telefon','Read','\"1\"','telefon/modal_render','::1','2019-03-11 14:58:34'),(183,1,'cms_aauth_perms','Read','\"21\"','cms/permission/modal_render','::1','2019-03-11 15:03:34'),(184,1,'cms_aauth_perms','Read','\"21\"','cms/permission/modal_render','::1','2019-03-11 15:03:41');

#
# Structure for table "okbs_birim"
#

DROP TABLE IF EXISTS `okbs_birim`;
CREATE TABLE `okbs_birim` (
  `birim_id` int(11) NOT NULL AUTO_INCREMENT,
  `birim_adi` varchar(150) NOT NULL,
  `birim_durum` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`birim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "okbs_birim"
#

INSERT INTO `okbs_birim` VALUES (1,'Rektör',1),(3,'Genel Sekreterlik',1),(4,'x daire başkanlığı',1);

#
# Structure for table "okbs_randevu"
#

DROP TABLE IF EXISTS `okbs_randevu`;
CREATE TABLE `okbs_randevu` (
  `randevu_id` int(11) NOT NULL AUTO_INCREMENT,
  `randevu_ad_soyad` varchar(255) NOT NULL,
  `randevu_calistigi_yer` varchar(255) NOT NULL,
  `randevu_sebep` text NOT NULL,
  `randevu_telefon_no` varchar(30) NOT NULL,
  `randevu_tarih` date DEFAULT NULL,
  `randevu_saat` time NOT NULL,
  `randevu_birim` int(11) DEFAULT NULL,
  `randevu_kapanis_tarihi` date DEFAULT NULL,
  `randevu_notlar` text NOT NULL,
  `randevu_durum` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`randevu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "okbs_randevu"
#


#
# Structure for table "okbs_takip"
#

DROP TABLE IF EXISTS `okbs_takip`;
CREATE TABLE `okbs_takip` (
  `takip_id` int(11) NOT NULL AUTO_INCREMENT,
  `takip_ad_soyad` varchar(255) NOT NULL,
  `takip_sicil_tc` varchar(150) NOT NULL,
  `takip_iletisim_bilgileri` varchar(255) NOT NULL,
  `takip_konu` text NOT NULL,
  `takibin_geldigi_yer` varchar(150) NOT NULL,
  `takip_sorumlu` int(11) NOT NULL,
  `takip_birim` int(11) NOT NULL,
  `takip_gelis_tarihi` date NOT NULL,
  `takip_sonuc_notu` text NOT NULL,
  `takip_sonuc_tarihi` date NOT NULL,
  `takip_durum` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`takip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "okbs_takip"
#


#
# Structure for table "okbs_takip_dosya"
#

DROP TABLE IF EXISTS `okbs_takip_dosya`;
CREATE TABLE `okbs_takip_dosya` (
  `dosya_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosya_takip_id` int(11) NOT NULL DEFAULT '0',
  `dosya_adi` varchar(150) NOT NULL,
  `dosya_tarih` date NOT NULL DEFAULT '0000-00-00',
  `dosya_tipi` varchar(255) DEFAULT NULL,
  `dosya_boyut` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dosya_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "okbs_takip_dosya"
#


#
# Structure for table "okbs_telefon"
#

DROP TABLE IF EXISTS `okbs_telefon`;
CREATE TABLE `okbs_telefon` (
  `telefon_id` int(11) NOT NULL AUTO_INCREMENT,
  `telefon_ad_soyad` varchar(255) NOT NULL,
  `telefon_calistigi_yer` varchar(255) NOT NULL,
  `telefon_sebep` text NOT NULL,
  `telefon_no` varchar(30) NOT NULL,
  `telefon_tarih` date NOT NULL,
  `telefon_saat` time NOT NULL,
  `telefon_notlar` text NOT NULL,
  `telefon_durum` tinyint(4) NOT NULL DEFAULT '1',
  `telefon_birim` int(11) DEFAULT NULL,
  PRIMARY KEY (`telefon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "okbs_telefon"
#


#
# Structure for table "okbs_ziyaretci"
#

DROP TABLE IF EXISTS `okbs_ziyaretci`;
CREATE TABLE `okbs_ziyaretci` (
  `ziyaretci_id` int(11) NOT NULL AUTO_INCREMENT,
  `ziyaretci_birim` int(11) NOT NULL,
  `ziyaretci_ad_soyad` varchar(255) NOT NULL,
  `ziyaretci_tel_no` varchar(30) NOT NULL,
  `ziyaretci_geldigi_yer` varchar(255) NOT NULL,
  `ziyaretci_referans` varchar(255) NOT NULL,
  `ziyaretci_tarih` date NOT NULL,
  `ziyaretci_saat` time NOT NULL,
  `ziyaretci_not` text NOT NULL,
  PRIMARY KEY (`ziyaretci_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

#
# Data for table "okbs_ziyaretci"
#

