-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Waktu pembuatan: 16. Februari 2008 jam 12:39
-- Versi Server: 5.0.18
-- Versi PHP: 5.1.2
-- 
-- Database: `ijga`
-- 
CREATE DATABASE `ijga` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE ijga;

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_boardmanager`
-- 

DROP TABLE IF EXISTS `m_boardmanager`;
CREATE TABLE IF NOT EXISTS `m_boardmanager` (
  `id` int(5) NOT NULL auto_increment,
  `description` text,
  `status` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `m_boardmanager`
-- 

INSERT INTO `m_boardmanager` (`id`, `description`, `status`) VALUES (1, 'Management Profile', 1);
INSERT INTO `m_boardmanager` (`id`, `description`, `status`) VALUES (2, 'Board of Director Profile', 1);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_course`
-- 

DROP TABLE IF EXISTS `m_course`;
CREATE TABLE IF NOT EXISTS `m_course` (
  `course_id` int(10) unsigned NOT NULL auto_increment,
  `course_name` varchar(45) NOT NULL default '',
  `course_desc` varchar(255) default NULL,
  `course_address` varchar(128) default NULL,
  `course_phone` varchar(15) default NULL,
  `course_logopath` varchar(255) default NULL,
  PRIMARY KEY  (`course_id`),
  UNIQUE KEY `course_name_unique` (`course_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data untuk tabel `m_course`
-- 

INSERT INTO `m_course` (`course_id`, `course_name`, `course_desc`, `course_address`, `course_phone`, `course_logopath`) VALUES (8, 'Mountain View Golf Club', 'Truly Golf Experience at the most scenic and challenging golf course overlooking the city of bandung', 'Jl Resor Dago Pakar Raya, Bandung 40198', '+62 22 235 6089', '../images/upload/noPict.gif');
INSERT INTO `m_course` (`course_id`, `course_name`, `course_desc`, `course_address`, `course_phone`, `course_logopath`) VALUES (6, 'Mentari Golf', 'Enjoy a clallenging course in a scenic surrounds', 'Bukit Sentul, Bogor 16810', '+61 21 87960266', '../images/upload/noPict.gif');
INSERT INTO `m_course` (`course_id`, `course_name`, `course_desc`, `course_address`, `course_phone`, `course_logopath`) VALUES (7, 'Imperial Klub - Lippo Karawaci', '', 'Lippo Karawaci, Tangerang - Indonesia', '+61 21 5460 120', '../images/upload/noPict.gif');
INSERT INTO `m_course` (`course_id`, `course_name`, `course_desc`, `course_address`, `course_phone`, `course_logopath`) VALUES (9, 'Sawangan Golf', '', 'Jl Raya Sawangan - Depok Km 34, Depok 16511', '+62 21 7402194', '../images/upload/noPict.gif');
INSERT INTO `m_course` (`course_id`, `course_name`, `course_desc`, `course_address`, `course_phone`, `course_logopath`) VALUES (10, 'Jakarta Golf Club', '', 'Jl Rawamangun Muka Raya no 1, Jakarta Timur 13220', '+62 21 475 4732', '../images/upload/noPict.gif');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_course_detail`
-- 

DROP TABLE IF EXISTS `m_course_detail`;
CREATE TABLE IF NOT EXISTS `m_course_detail` (
  `course_sub_id` int(10) unsigned NOT NULL auto_increment,
  `course_id` int(10) unsigned NOT NULL default '0',
  `hole1_par` int(10) unsigned NOT NULL default '0',
  `hole1_hcp` int(10) unsigned NOT NULL default '0',
  `hole2_par` int(10) unsigned NOT NULL default '0',
  `hole2_hcp` int(10) unsigned NOT NULL default '0',
  `hole3_par` int(10) unsigned NOT NULL default '0',
  `hole3_hcp` int(10) unsigned NOT NULL default '0',
  `hole4_par` int(10) unsigned NOT NULL default '0',
  `hole4_hcp` int(10) unsigned NOT NULL default '0',
  `hole5_par` int(10) unsigned NOT NULL default '0',
  `hole5_hcp` int(10) unsigned NOT NULL default '0',
  `hole6_par` int(10) unsigned NOT NULL default '0',
  `hole6_hcp` int(10) unsigned NOT NULL default '0',
  `hole7_par` int(10) unsigned NOT NULL default '0',
  `hole7_hcp` int(10) unsigned NOT NULL default '0',
  `hole8_par` int(10) unsigned NOT NULL default '0',
  `hole8_hcp` int(10) unsigned NOT NULL default '0',
  `hole9_par` int(10) unsigned NOT NULL default '0',
  `hole9_hcp` int(10) unsigned NOT NULL default '0',
  `hole10_par` int(10) unsigned NOT NULL default '0',
  `hole10_hcp` int(10) unsigned NOT NULL default '0',
  `hole11_par` int(10) unsigned NOT NULL default '0',
  `hole11_hcp` int(10) unsigned NOT NULL default '0',
  `hole12_par` int(10) unsigned NOT NULL default '0',
  `hole12_hcp` int(10) unsigned NOT NULL default '0',
  `hole13_par` int(10) unsigned NOT NULL default '0',
  `hole13_hcp` int(10) unsigned NOT NULL default '0',
  `hole14_par` int(10) unsigned NOT NULL default '0',
  `hole14_hcp` int(10) unsigned NOT NULL default '0',
  `hole15_par` int(10) unsigned NOT NULL default '0',
  `hole15_hcp` int(10) unsigned NOT NULL default '0',
  `hole16_par` int(10) unsigned NOT NULL default '0',
  `hole16_hcp` int(10) unsigned NOT NULL default '0',
  `hole17_par` int(10) unsigned NOT NULL default '0',
  `hole17_hcp` int(10) unsigned NOT NULL default '0',
  `hole18_par` int(10) unsigned NOT NULL default '0',
  `hole18_hcp` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`course_sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data untuk tabel `m_course_detail`
-- 

INSERT INTO `m_course_detail` (`course_sub_id`, `course_id`, `hole1_par`, `hole1_hcp`, `hole2_par`, `hole2_hcp`, `hole3_par`, `hole3_hcp`, `hole4_par`, `hole4_hcp`, `hole5_par`, `hole5_hcp`, `hole6_par`, `hole6_hcp`, `hole7_par`, `hole7_hcp`, `hole8_par`, `hole8_hcp`, `hole9_par`, `hole9_hcp`, `hole10_par`, `hole10_hcp`, `hole11_par`, `hole11_hcp`, `hole12_par`, `hole12_hcp`, `hole13_par`, `hole13_hcp`, `hole14_par`, `hole14_hcp`, `hole15_par`, `hole15_hcp`, `hole16_par`, `hole16_hcp`, `hole17_par`, `hole17_hcp`, `hole18_par`, `hole18_hcp`) VALUES (11, 6, 4, 15, 4, 3, 5, 5, 3, 17, 4, 1, 5, 13, 3, 11, 4, 7, 4, 9, 4, 2, 5, 6, 3, 10, 4, 18, 4, 12, 3, 14, 5, 4, 5, 8, 4, 16);
INSERT INTO `m_course_detail` (`course_sub_id`, `course_id`, `hole1_par`, `hole1_hcp`, `hole2_par`, `hole2_hcp`, `hole3_par`, `hole3_hcp`, `hole4_par`, `hole4_hcp`, `hole5_par`, `hole5_hcp`, `hole6_par`, `hole6_hcp`, `hole7_par`, `hole7_hcp`, `hole8_par`, `hole8_hcp`, `hole9_par`, `hole9_hcp`, `hole10_par`, `hole10_hcp`, `hole11_par`, `hole11_hcp`, `hole12_par`, `hole12_hcp`, `hole13_par`, `hole13_hcp`, `hole14_par`, `hole14_hcp`, `hole15_par`, `hole15_hcp`, `hole16_par`, `hole16_hcp`, `hole17_par`, `hole17_hcp`, `hole18_par`, `hole18_hcp`) VALUES (12, 7, 4, 15, 4, 1, 4, 9, 4, 5, 3, 13, 5, 7, 3, 17, 4, 11, 5, 3, 4, 12, 5, 10, 4, 8, 4, 4, 3, 18, 4, 6, 3, 14, 4, 16, 5, 2);
INSERT INTO `m_course_detail` (`course_sub_id`, `course_id`, `hole1_par`, `hole1_hcp`, `hole2_par`, `hole2_hcp`, `hole3_par`, `hole3_hcp`, `hole4_par`, `hole4_hcp`, `hole5_par`, `hole5_hcp`, `hole6_par`, `hole6_hcp`, `hole7_par`, `hole7_hcp`, `hole8_par`, `hole8_hcp`, `hole9_par`, `hole9_hcp`, `hole10_par`, `hole10_hcp`, `hole11_par`, `hole11_hcp`, `hole12_par`, `hole12_hcp`, `hole13_par`, `hole13_hcp`, `hole14_par`, `hole14_hcp`, `hole15_par`, `hole15_hcp`, `hole16_par`, `hole16_hcp`, `hole17_par`, `hole17_hcp`, `hole18_par`, `hole18_hcp`) VALUES (13, 8, 4, 7, 4, 5, 3, 9, 5, 1, 4, 13, 3, 11, 5, 3, 3, 15, 5, 17, 4, 2, 5, 18, 4, 14, 3, 12, 4, 8, 3, 10, 4, 4, 5, 16, 4, 6);
INSERT INTO `m_course_detail` (`course_sub_id`, `course_id`, `hole1_par`, `hole1_hcp`, `hole2_par`, `hole2_hcp`, `hole3_par`, `hole3_hcp`, `hole4_par`, `hole4_hcp`, `hole5_par`, `hole5_hcp`, `hole6_par`, `hole6_hcp`, `hole7_par`, `hole7_hcp`, `hole8_par`, `hole8_hcp`, `hole9_par`, `hole9_hcp`, `hole10_par`, `hole10_hcp`, `hole11_par`, `hole11_hcp`, `hole12_par`, `hole12_hcp`, `hole13_par`, `hole13_hcp`, `hole14_par`, `hole14_hcp`, `hole15_par`, `hole15_hcp`, `hole16_par`, `hole16_hcp`, `hole17_par`, `hole17_hcp`, `hole18_par`, `hole18_hcp`) VALUES (14, 9, 4, 17, 4, 1, 5, 11, 3, 9, 4, 7, 4, 13, 3, 15, 5, 5, 4, 3, 4, 12, 4, 2, 3, 14, 4, 18, 4, 6, 5, 4, 3, 10, 5, 8, 4, 0);
INSERT INTO `m_course_detail` (`course_sub_id`, `course_id`, `hole1_par`, `hole1_hcp`, `hole2_par`, `hole2_hcp`, `hole3_par`, `hole3_hcp`, `hole4_par`, `hole4_hcp`, `hole5_par`, `hole5_hcp`, `hole6_par`, `hole6_hcp`, `hole7_par`, `hole7_hcp`, `hole8_par`, `hole8_hcp`, `hole9_par`, `hole9_hcp`, `hole10_par`, `hole10_hcp`, `hole11_par`, `hole11_hcp`, `hole12_par`, `hole12_hcp`, `hole13_par`, `hole13_hcp`, `hole14_par`, `hole14_hcp`, `hole15_par`, `hole15_hcp`, `hole16_par`, `hole16_hcp`, `hole17_par`, `hole17_hcp`, `hole18_par`, `hole18_hcp`) VALUES (15, 10, 4, 5, 4, 1, 3, 13, 3, 17, 4, 7, 4, 9, 5, 3, 4, 11, 5, 15, 4, 8, 4, 10, 3, 12, 4, 5, 4, 14, 5, 2, 3, 18, 4, 16, 4, 6);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_course_length`
-- 

DROP TABLE IF EXISTS `m_course_length`;
CREATE TABLE IF NOT EXISTS `m_course_length` (
  `course_sub_id` int(10) unsigned NOT NULL auto_increment,
  `course_id` int(10) unsigned NOT NULL default '0',
  `course_type_id` int(10) unsigned NOT NULL default '0',
  `course_measure` varchar(10) NOT NULL default '',
  `course_rating` float NOT NULL default '0',
  `slope_rating` float NOT NULL default '0',
  `hole1_length` int(10) unsigned NOT NULL default '0',
  `hole2_length` int(10) unsigned NOT NULL default '0',
  `hole3_length` int(10) unsigned NOT NULL default '0',
  `hole4_length` int(10) unsigned NOT NULL default '0',
  `hole5_length` int(10) unsigned NOT NULL default '0',
  `hole6_length` int(10) unsigned NOT NULL default '0',
  `hole7_length` int(10) unsigned NOT NULL default '0',
  `hole8_length` int(10) unsigned NOT NULL default '0',
  `hole9_length` int(10) unsigned NOT NULL default '0',
  `hole10_length` int(10) unsigned NOT NULL default '0',
  `hole11_length` int(10) unsigned NOT NULL default '0',
  `hole12_length` int(10) unsigned NOT NULL default '0',
  `hole13_length` int(10) unsigned NOT NULL default '0',
  `hole14_length` int(10) unsigned NOT NULL default '0',
  `hole15_length` int(10) unsigned NOT NULL default '0',
  `hole16_length` int(10) unsigned NOT NULL default '0',
  `hole17_length` int(10) unsigned NOT NULL default '0',
  `hole18_length` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`course_sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- 
-- Dumping data untuk tabel `m_course_length`
-- 

INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (7, 6, 11, 'meters', 71.1, 132, 383, 364, 438, 108, 364, 445, 135, 343, 344, 359, 445, 126, 262, 334, 115, 301, 481, 307);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (6, 6, 10, 'meters', 73.2, 139, 401, 397, 460, 126, 382, 479, 156, 348, 368, 375, 455, 151, 288, 354, 137, 331, 501, 332);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (5, 6, 9, 'meters', 75.5, 144, 428, 430, 494, 132, 405, 500, 170, 370, 390, 393, 572, 176, 310, 376, 160, 360, 530, 342);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (8, 6, 12, 'meters', 71.3, 124, 343, 260, 399, 82, 298, 329, 116, 286, 282, 313, 378, 104, 237, 304, 84, 262, 434, 247);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (9, 6, 13, 'meters', 0, 0, 365, 328, 419, 95, 330, 384, 116, 314, 329, 340, 413, 104, 246, 322, 99, 288, 460, 291);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (10, 7, 9, 'yards', 73.9, 139, 381, 453, 416, 353, 157, 535, 162, 407, 563, 357, 514, 409, 397, 205, 445, 185, 384, 584);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (11, 7, 10, 'yards', 71.7, 133, 349, 419, 384, 339, 139, 495, 133, 346, 507, 333, 485, 375, 370, 163, 415, 171, 355, 559);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (12, 7, 11, 'yards', 70, 130, 320, 385, 356, 328, 126, 465, 100, 322, 482, 319, 453, 354, 362, 141, 383, 150, 339, 548);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (13, 7, 12, 'yards', 71.5, 122, 297, 334, 308, 283, 78, 433, 73, 294, 445, 257, 421, 331, 330, 105, 345, 114, 300, 462);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (14, 8, 10, 'meters', 0, 0, 330, 284, 151, 484, 287, 166, 491, 121, 418, 339, 420, 303, 157, 306, 155, 354, 478, 339);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (15, 8, 12, 'meters', 0, 0, 316, 241, 102, 460, 271, 145, 468, 110, 412, 260, 397, 278, 131, 302, 137, 327, 456, 324);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (16, 8, 13, 'meters', 0, 0, 273, 220, 63, 410, 248, 141, 403, 106, 384, 200, 362, 244, 104, 241, 109, 268, 416, 262);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (17, 9, 9, 'meters', 0, 0, 348, 374, 520, 215, 350, 349, 154, 533, 398, 332, 357, 163, 329, 372, 550, 208, 529, 348);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (18, 9, 10, 'meters', 0, 0, 333, 346, 491, 191, 327, 310, 136, 501, 356, 324, 336, 147, 311, 326, 501, 189, 499, 239);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (19, 9, 11, 'meters', 0, 0, 303, 327, 484, 174, 307, 300, 125, 459, 337, 301, 324, 138, 299, 306, 492, 172, 486, 292);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (20, 9, 12, 'meters', 0, 0, 263, 306, 447, 160, 298, 282, 121, 443, 324, 292, 304, 123, 285, 302, 466, 158, 454, 280);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (21, 9, 13, 'meters', 0, 0, 245, 276, 400, 148, 269, 248, 102, 408, 278, 257, 273, 92, 260, 272, 434, 132, 415, 255);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (22, 10, 9, 'meters', 72.3, 128, 308, 386, 199, 168, 359, 394, 508, 289, 433, 382, 284, 183, 308, 332, 453, 167, 332, 386);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (23, 10, 10, 'meters', 70.8, 127, 282, 368, 186, 356, 338, 375, 489, 273, 418, 361, 269, 173, 282, 309, 437, 156, 314, 378);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (24, 10, 11, 'meters', 29.4, 126, 272, 347, 174, 142, 322, 357, 470, 262, 400, 344, 255, 163, 272, 292, 425, 147, 303, 365);
INSERT INTO `m_course_length` (`course_sub_id`, `course_id`, `course_type_id`, `course_measure`, `course_rating`, `slope_rating`, `hole1_length`, `hole2_length`, `hole3_length`, `hole4_length`, `hole5_length`, `hole6_length`, `hole7_length`, `hole8_length`, `hole9_length`, `hole10_length`, `hole11_length`, `hole12_length`, `hole13_length`, `hole14_length`, `hole15_length`, `hole16_length`, `hole17_length`, `hole18_length`) VALUES (25, 10, 12, 'meters', 72.6, 120, 268, 285, 158, 125, 302, 333, 459, 252, 386, 324, 245, 153, 268, 272, 390, 137, 289, 306);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_course_type`
-- 

DROP TABLE IF EXISTS `m_course_type`;
CREATE TABLE IF NOT EXISTS `m_course_type` (
  `course_type_id` int(10) unsigned NOT NULL auto_increment,
  `type_name` varchar(20) NOT NULL default '',
  `type_color` varchar(10) default '#FFFFFF',
  PRIMARY KEY  (`course_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data untuk tabel `m_course_type`
-- 

INSERT INTO `m_course_type` (`course_type_id`, `type_name`, `type_color`) VALUES (10, 'Blue', '#6D89F7');
INSERT INTO `m_course_type` (`course_type_id`, `type_name`, `type_color`) VALUES (11, 'White', '#FFFFFF');
INSERT INTO `m_course_type` (`course_type_id`, `type_name`, `type_color`) VALUES (9, 'Black', '#89878A');
INSERT INTO `m_course_type` (`course_type_id`, `type_name`, `type_color`) VALUES (12, 'Red', '#FA4B3E');
INSERT INTO `m_course_type` (`course_type_id`, `type_name`, `type_color`) VALUES (13, 'Yellow', '#FADF75');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_foundation`
-- 

DROP TABLE IF EXISTS `m_foundation`;
CREATE TABLE IF NOT EXISTS `m_foundation` (
  `id` int(5) NOT NULL auto_increment,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data untuk tabel `m_foundation`
-- 

INSERT INTO `m_foundation` (`id`, `description`) VALUES (1, 'Chairman');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (2, 'Guardian');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (3, 'Fellows');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (4, 'Benefactors');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (5, 'Patron');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (6, 'Associate');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (7, 'Platinum');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (8, 'Gold');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (9, 'Silver');
INSERT INTO `m_foundation` (`id`, `description`) VALUES (10, 'Bronze');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_group`
-- 

DROP TABLE IF EXISTS `m_group`;
CREATE TABLE IF NOT EXISTS `m_group` (
  `id` int(5) NOT NULL auto_increment,
  `type` varchar(1) default NULL,
  `description` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data untuk tabel `m_group`
-- 

INSERT INTO `m_group` (`id`, `type`, `description`) VALUES (1, 'A', '15 -17 Tahun');
INSERT INTO `m_group` (`id`, `type`, `description`) VALUES (2, 'B', '13 - 14 Tahun');
INSERT INTO `m_group` (`id`, `type`, `description`) VALUES (3, 'C', '11 -12 Tahun');
INSERT INTO `m_group` (`id`, `type`, `description`) VALUES (4, 'D', '9 - 10');
INSERT INTO `m_group` (`id`, `type`, `description`) VALUES (5, 'E', '8 And Under');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_membership`
-- 

DROP TABLE IF EXISTS `m_membership`;
CREATE TABLE IF NOT EXISTS `m_membership` (
  `id` int(2) NOT NULL auto_increment,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `m_membership`
-- 

INSERT INTO `m_membership` (`id`, `type`) VALUES (1, 'Parent');
INSERT INTO `m_membership` (`id`, `type`) VALUES (2, 'Child');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_news`
-- 

DROP TABLE IF EXISTS `m_news`;
CREATE TABLE IF NOT EXISTS `m_news` (
  `id` int(5) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  `icon` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `m_news`
-- 

INSERT INTO `m_news` (`id`, `description`, `icon`) VALUES (1, 'Other News', 'oNews.gif');
INSERT INTO `m_news` (`id`, `description`, `icon`) VALUES (2, 'Player News', 'pNews.gif');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_package`
-- 

DROP TABLE IF EXISTS `m_package`;
CREATE TABLE IF NOT EXISTS `m_package` (
  `id` int(5) NOT NULL auto_increment,
  `type` varchar(1) default NULL,
  `description` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data untuk tabel `m_package`
-- 

INSERT INTO `m_package` (`id`, `type`, `description`) VALUES (1, 'A', '2x Intensive Training/month');
INSERT INTO `m_package` (`id`, `type`, `description`) VALUES (2, 'B', '1x Intensive Training/month ');
INSERT INTO `m_package` (`id`, `type`, `description`) VALUES (3, 'C', 'Membership only');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_param_rankingpoints`
-- 

DROP TABLE IF EXISTS `m_param_rankingpoints`;
CREATE TABLE IF NOT EXISTS `m_param_rankingpoints` (
  `id_param` int(10) unsigned NOT NULL auto_increment,
  `position_no` int(10) unsigned NOT NULL default '0',
  `ranking_points` double NOT NULL default '0',
  `prosentase_reward` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_param`),
  UNIQUE KEY `POS_UNIQUE` (`position_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- 
-- Dumping data untuk tabel `m_param_rankingpoints`
-- 

INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (2, 2, 270, 17);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (1, 1, 450, 22);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (3, 3, 170, 13);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (4, 4, 120, 12);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (5, 5, 100, 10);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (6, 6, 90, 7);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (7, 7, 84, 5);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (8, 8, 78, 5);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (9, 9, 73, 5);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (10, 10, 68, 5);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (11, 11, 63, 0);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (12, 12, 58, 0);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (13, 13, 53, 0);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (14, 14, 48, 0);
INSERT INTO `m_param_rankingpoints` (`id_param`, `position_no`, `ranking_points`, `prosentase_reward`) VALUES (18, 15, 45, 0);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_partner`
-- 

DROP TABLE IF EXISTS `m_partner`;
CREATE TABLE IF NOT EXISTS `m_partner` (
  `id` int(5) NOT NULL auto_increment,
  `description` text,
  `icon` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data untuk tabel `m_partner`
-- 

INSERT INTO `m_partner` (`id`, `description`, `icon`) VALUES (1, 'National Partners', 'nPartner.gif');
INSERT INTO `m_partner` (`id`, `description`, `icon`) VALUES (2, 'Official Partner', 'oPartner.gif');
INSERT INTO `m_partner` (`id`, `description`, `icon`) VALUES (3, 'Event Sponsor', 'ePartner.gif');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_products`
-- 

DROP TABLE IF EXISTS `m_products`;
CREATE TABLE IF NOT EXISTS `m_products` (
  `id` int(5) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  `icon` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data untuk tabel `m_products`
-- 

INSERT INTO `m_products` (`id`, `description`, `icon`) VALUES (1, 'Latest Products', 'lProducts.gif');
INSERT INTO `m_products` (`id`, `description`, `icon`) VALUES (2, 'Conforming Products', 'cProducts.gif');
INSERT INTO `m_products` (`id`, `description`, `icon`) VALUES (3, 'Product Exchange', 'eProducts.gif');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_tips`
-- 

DROP TABLE IF EXISTS `m_tips`;
CREATE TABLE IF NOT EXISTS `m_tips` (
  `id` int(5) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  `icon` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data untuk tabel `m_tips`
-- 

INSERT INTO `m_tips` (`id`, `description`, `icon`) VALUES (1, 'Getting Started', 'gTips.gif');
INSERT INTO `m_tips` (`id`, `description`, `icon`) VALUES (2, 'For The Parents', 'fTips.gif');
INSERT INTO `m_tips` (`id`, `description`, `icon`) VALUES (3, 'Quick Fix', 'qTips.gif');
INSERT INTO `m_tips` (`id`, `description`, `icon`) VALUES (4, 'Golf Clinics', 'cTips.gif');
INSERT INTO `m_tips` (`id`, `description`, `icon`) VALUES (5, 'Golf Academies', 'aTips.gif');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_type_tour`
-- 

DROP TABLE IF EXISTS `m_type_tour`;
CREATE TABLE IF NOT EXISTS `m_type_tour` (
  `id` int(1) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data untuk tabel `m_type_tour`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `national`
-- 

DROP TABLE IF EXISTS `national`;
CREATE TABLE IF NOT EXISTS `national` (
  `id` int(5) NOT NULL auto_increment,
  `negara` char(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data untuk tabel `national`
-- 

INSERT INTO `national` (`id`, `negara`) VALUES (1, 'Indonesia');
INSERT INTO `national` (`id`, `negara`) VALUES (2, 'india');
INSERT INTO `national` (`id`, `negara`) VALUES (3, 'Pakistan');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `t_games`
-- 

DROP TABLE IF EXISTS `t_games`;
CREATE TABLE IF NOT EXISTS `t_games` (
  `games_id` varchar(255) NOT NULL,
  `games_date` datetime NOT NULL,
  `games_type` tinyint(3) unsigned NOT NULL,
  `games_weather` varchar(50) NOT NULL,
  `games_note` varchar(128) NOT NULL,
  `games_holeplay` tinyint(3) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `course_length_id` int(10) unsigned NOT NULL,
  `members_id` varchar(100) default NULL,
  `members_name` varchar(45) default NULL,
  `members_group` varchar(10) default NULL,
  `members_age` int(10) unsigned default '0',
  `id_round_tour` int(10) unsigned default NULL,
  `id_player` int(10) unsigned default NULL,
  PRIMARY KEY  (`games_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `t_games`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `t_games_result`
-- 

DROP TABLE IF EXISTS `t_games_result`;
CREATE TABLE IF NOT EXISTS `t_games_result` (
  `result_id` int(10) unsigned NOT NULL auto_increment,
  `games_id` varchar(255) NOT NULL,
  `total_hole` int(10) unsigned NOT NULL default '0',
  `total_length` int(10) unsigned NOT NULL default '0',
  `total_par` int(10) unsigned NOT NULL default '0',
  `total_hcp` int(10) unsigned NOT NULL default '0',
  `total_score` int(10) unsigned NOT NULL default '0',
  `total_putts` int(10) unsigned NOT NULL default '0',
  `total_saves` int(10) unsigned NOT NULL default '0',
  `total_FIR` int(10) unsigned NOT NULL default '0',
  `total_GIR` int(10) unsigned NOT NULL default '0',
  `total_RR` int(10) unsigned NOT NULL default '0',
  `total_LR` int(10) unsigned NOT NULL default '0',
  `total_on` int(10) unsigned NOT NULL default '0',
  `total_fairways` int(10) unsigned NOT NULL default '0',
  `total_bunkers` int(10) unsigned NOT NULL default '0',
  `total_penalties` int(10) unsigned NOT NULL default '0',
  `condor` int(10) unsigned NOT NULL default '0',
  `albatros` int(10) unsigned NOT NULL default '0',
  `eagles` int(10) unsigned NOT NULL default '0',
  `birdies` int(10) unsigned NOT NULL default '0',
  `pars` int(10) unsigned NOT NULL default '0',
  `bogeys` int(10) unsigned NOT NULL default '0',
  `dbogeys` int(10) unsigned NOT NULL default '0',
  `tbogeys` int(10) unsigned NOT NULL default '0',
  `others` int(10) unsigned NOT NULL default '0',
  `hole_in_one` int(10) unsigned NOT NULL default '0',
  `par3_hole` int(10) unsigned NOT NULL default '0',
  `par3_score` int(10) unsigned NOT NULL default '0',
  `par4_hole` int(10) unsigned NOT NULL default '0',
  `par4_score` int(10) unsigned NOT NULL default '0',
  `par5_hole` int(10) unsigned NOT NULL default '0',
  `par5_score` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

-- 
-- Dumping data untuk tabel `t_games_result`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `t_games_score`
-- 

DROP TABLE IF EXISTS `t_games_score`;
CREATE TABLE IF NOT EXISTS `t_games_score` (
  `score_id` int(10) unsigned NOT NULL auto_increment,
  `games_id` varchar(255) NOT NULL,
  `hole_no` int(10) unsigned NOT NULL,
  `hole_length` int(10) unsigned NOT NULL default '0',
  `hole_par` int(10) unsigned NOT NULL default '0',
  `hole_hcp` int(10) unsigned NOT NULL default '0',
  `hole_score` int(10) unsigned NOT NULL default '0',
  `condor` int(10) unsigned NOT NULL default '0',
  `albatros` int(10) unsigned NOT NULL default '0',
  `eagles` int(10) unsigned NOT NULL default '0',
  `birdies` int(10) unsigned NOT NULL default '0',
  `pars` int(10) unsigned NOT NULL default '0',
  `bogeys` int(10) unsigned NOT NULL default '0',
  `dbogeys` int(10) unsigned NOT NULL default '0',
  `tbogeys` int(10) unsigned NOT NULL default '0',
  `others` int(10) unsigned NOT NULL default '0',
  `hole_in_one` int(10) unsigned NOT NULL default '0',
  `fir` int(10) unsigned NOT NULL default '0',
  `rr1` int(10) unsigned NOT NULL default '0',
  `lr1` int(10) unsigned NOT NULL default '0',
  `bunker1` int(10) unsigned NOT NULL default '0',
  `penalty1` int(10) unsigned NOT NULL default '0',
  `gir` int(10) unsigned NOT NULL default '0',
  `fairway` int(10) unsigned NOT NULL default '0',
  `rr2` int(10) unsigned NOT NULL default '0',
  `lr2` int(10) unsigned NOT NULL default '0',
  `on_` int(10) unsigned NOT NULL default '0',
  `bunker2` int(10) unsigned NOT NULL default '0',
  `penalty2` int(10) unsigned NOT NULL default '0',
  `putts` int(10) unsigned NOT NULL default '0',
  `control` int(10) unsigned NOT NULL default '0',
  `saves` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`score_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1297 ;

-- 
-- Dumping data untuk tabel `t_games_score`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `t_tournaments`
-- 

DROP TABLE IF EXISTS `t_tournaments`;
CREATE TABLE IF NOT EXISTS `t_tournaments` (
  `tour_id` varchar(100) NOT NULL,
  `tour_name` varchar(45) NOT NULL,
  `tour_place` varchar(45) NOT NULL,
  `tour_descr` varchar(255) NOT NULL,
  `tour_type` tinyint(3) unsigned NOT NULL,
  `tour_due_date` datetime NOT NULL,
  `tour_evt_date` datetime NOT NULL,
  `tour_max_player` int(10) unsigned NOT NULL,
  `tour_reward` double NOT NULL,
  `tour_trial_points` int(10) unsigned NOT NULL,
  `tour_levels` int(10) unsigned NOT NULL,
  `tour_status` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `course_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`tour_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `t_tournaments`
-- 

INSERT INTO `t_tournaments` (`tour_id`, `tour_name`, `tour_place`, `tour_descr`, `tour_type`, `tour_due_date`, `tour_evt_date`, `tour_max_player`, `tour_reward`, `tour_trial_points`, `tour_levels`, `tour_status`, `course_id`, `course_type_id`) VALUES ('G2120080216123303', 'IJGC All Stars', 'Jakarta', '', 1, '2008-02-16 00:00:00', '2008-02-16 00:00:00', 20, 1000000, 50, 2, 1, 6, 5);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `t_tournaments_indent`
-- 

DROP TABLE IF EXISTS `t_tournaments_indent`;
CREATE TABLE IF NOT EXISTS `t_tournaments_indent` (
  `indent_id` int(10) unsigned NOT NULL auto_increment,
  `tour_id` varchar(100) NOT NULL,
  `register_date` datetime NOT NULL,
  `player_members_id` varchar(45) NOT NULL default ' ',
  `player_name` varchar(45) NOT NULL,
  `player_age` int(10) unsigned NOT NULL,
  `player_birthdate` datetime NOT NULL,
  `player_parents_name` varchar(45) NOT NULL,
  `player_contactno` varchar(20) NOT NULL,
  `player_email` varchar(45) NOT NULL,
  `player_home_address` varchar(128) NOT NULL,
  `player_group` varchar(10) default NULL,
  `player_approved` tinyint(1) NOT NULL,
  PRIMARY KEY  (`indent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data untuk tabel `t_tournaments_indent`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `t_tournaments_player`
-- 

DROP TABLE IF EXISTS `t_tournaments_player`;
CREATE TABLE IF NOT EXISTS `t_tournaments_player` (
  `tour_playerid` int(10) unsigned NOT NULL auto_increment,
  `tour_id` varchar(100) NOT NULL,
  `player_members_id` varchar(128) NOT NULL default ' ',
  `player_name` varchar(45) NOT NULL,
  `player_age` int(10) unsigned NOT NULL,
  `player_birthdate` datetime NOT NULL,
  `player_parents_name` varchar(45) NOT NULL,
  `player_contactno` varchar(20) default NULL,
  `player_email` varchar(45) default NULL,
  `player_homeaddress` varchar(120) default NULL,
  `player_group` varchar(10) NOT NULL,
  `player_confirmed` tinyint(1) NOT NULL default '0',
  `par_total` int(10) unsigned default '0',
  `ranking_points` double default '0',
  `voucher_points` double default '0',
  `trial_points` double default '0',
  `position` int(10) unsigned default '0',
  `indent_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`tour_playerid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data untuk tabel `t_tournaments_player`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `t_tournaments_round`
-- 

DROP TABLE IF EXISTS `t_tournaments_round`;
CREATE TABLE IF NOT EXISTS `t_tournaments_round` (
  `id_round_tour` int(10) unsigned NOT NULL auto_increment,
  `tour_id` varchar(100) NOT NULL,
  `round_no` tinyint(3) unsigned NOT NULL,
  `round_date` datetime NOT NULL,
  `round_weather` varchar(45) NOT NULL,
  `round_holeplay` int(10) unsigned default NULL,
  `round_note` varchar(255) default NULL,
  PRIMARY KEY  (`id_round_tour`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- 
-- Dumping data untuk tabel `t_tournaments_round`
-- 

INSERT INTO `t_tournaments_round` (`id_round_tour`, `tour_id`, `round_no`, `round_date`, `round_weather`, `round_holeplay`, `round_note`) VALUES (20, 'G2120080216123303', 1, '2008-02-16 10:00:00', 'Sunny', 1, '');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_admin`
-- 

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `usn` varchar(15) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `unique_id` varchar(32) default NULL,
  `last_login` datetime default NULL,
  `level` int(2) default NULL,
  PRIMARY KEY  (`usn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `tbl_admin`
-- 

INSERT INTO `tbl_admin` (`usn`, `pwd`, `nama`, `email`, `unique_id`, `last_login`, `level`) VALUES ('admin', 'd41d8cd98f00b204e9800998ecf8427e', 'Administrator', 'admin@setyoclub.com', 's6banyu8n14rc3ehwbobui9stust1yt', '2008-02-16 12:27:53', 1);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_boardmanager`
-- 

DROP TABLE IF EXISTS `tbl_boardmanager`;
CREATE TABLE IF NOT EXISTS `tbl_boardmanager` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `jabatan` varchar(200) default NULL,
  `deskripsi` text,
  `photo` varchar(200) default NULL,
  `status` int(1) default NULL,
  `urut` int(5) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- 
-- Dumping data untuk tabel `tbl_boardmanager`
-- 

INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (1, 'Saibun Sitompul', '1', '<P>Advisors</P>', '', 1, 1);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (2, 'Hardi Artoko', '1', '<P>Advisors</P>', '', 1, 1);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (3, 'Christine Wiradinata', '1', '<P>Advisors</P>', NULL, 1, 2);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (4, 'Gita Wirjawan', '1', '<P>Advisors</P>', NULL, 0, 3);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (5, 'Budi Oei', '2', 'Board of Directors', NULL, 1, 4);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (6, 'Hendro', '2', 'Board of Directors', NULL, 1, 5);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (7, 'Ganny Rachmadi', '2', 'Board of Directors', NULL, 1, 6);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (8, 'Dedy Irianto', '2', 'Board of Directors ', NULL, 1, 7);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (9, 'Dading Soetarso', '2', 'Board of Directors', NULL, 1, 8);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (10, 'Wira Perdana', '2', 'Board of Directors', NULL, 1, 9);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (11, 'James Irawan', '2', 'Board of Directors', NULL, 1, 10);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (12, 'Dading Soetarso', '1', '<P>Management</P>', NULL, 1, 11);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (13, 'Ganny Rachmadi', '1', '<P>Management</P>', NULL, 1, 12);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (14, 'James Irawan', '1', '<P>Management</P>', NULL, 1, 13);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (15, 'Budi Oei', '1', '<P>Management</P>', NULL, 1, 14);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (16, 'Rina Perdana', '1', 'Finance', NULL, 1, 15);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (17, 'Simawati', '1', 'Finance', NULL, 1, 16);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (18, 'Nur Rahma', '1', 'Finance', NULL, 1, 17);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (19, 'Janto Utomo', '1', 'Class Division', NULL, 1, 18);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (20, 'Dian Wirjawan', '1', 'Class Division', NULL, 1, 19);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (21, 'George Harjani', '1', 'Class Division', NULL, 1, 20);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (22, 'Hing Chi', '1', 'Class Division', NULL, 1, 21);
INSERT INTO `tbl_boardmanager` (`id`, `name`, `jabatan`, `deskripsi`, `photo`, `status`, `urut`) VALUES (23, 'Supriyanto', '1', 'Class Division', NULL, 1, 22);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_child`
-- 

DROP TABLE IF EXISTS `tbl_child`;
CREATE TABLE IF NOT EXISTS `tbl_child` (
  `id_user` int(5) NOT NULL,
  `name` varchar(100) default NULL,
  `no_membership` varchar(100) default NULL,
  `age` int(3) default NULL,
  `birth_date` date default NULL,
  `parent_id` int(5) NOT NULL,
  `jigc_played` int(2) default NULL,
  `tournament_played` int(2) default NULL,
  `background` text,
  `hobby` text,
  `avg_score` int(5) default NULL,
  `email` varchar(100) default NULL,
  `cp` varchar(100) default NULL,
  `address` varchar(100) default NULL,
  `group` int(3) default NULL,
  PRIMARY KEY  (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `tbl_child`
-- 

INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (1, 'AHMAD FAUZAN', 'A.930405.08.018', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (2, 'ADRIAN HALIMI', 'A.931027.08.021', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (3, 'ALDWIN D. KENDARWAN', 'A.950710.08.027', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (4, 'ARTHUR JESIMEIL BUDIHADIANTO', 'A.960106.08.001', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (5, 'BOBBY CAHYO', 'B.920729.08.017', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (6, 'BERNICE INTAN T.SITOMPUL', 'B.941212.08.012', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (7, 'BRANDON OTTO POLANA', 'B.971116.08.011', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (8, 'DIMITRI JESSE', 'D.060106.08.031', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (9, 'DICKY PRIONGGO', 'D.950226.08.025', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (10, 'ELKI KOW', 'E.940908.08.023', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (11, 'FADHLI RAHMAN SOETARSO', 'F.960421.08.002', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (12, 'GIAN WIRJAWAN', 'G.950125.08.024', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (13, 'GUIDDO  I.PURBA', 'G.950614.08.026', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (14, 'GRIVANDI ILYAS PURBA', 'G.970822.08.010', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (15, 'IRVAN ARVENZIA', 'I.970104.08.007', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (16, 'JORDAN IRAWAN', 'J.951101.08.029', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (17, 'JOBEL IRAWAN', 'J.970402.08.008', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (18, 'JOHN AMADEO D.KARNADJAJA', 'J.970715.08.009', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (19, 'LEONARDUS TAN', 'L.940101.08.022', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (20, 'MUHAMMAD AKMAL', 'M.950711.08.028', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (21, 'MICHAEL HARJANI', 'M.960911.08.004', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (22, 'MICHELLE HARJANI', 'M.960911.08.014', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (23, 'MONIQUE HARJANI', 'M.960911.08.015', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (24, 'MARCO KANARDI', 'M.960916.08.005', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (25, 'CELINE HARJANI', 'M.970924.08.016', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (26, 'PETER GUNAWAN', 'P.961004.08.006', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (27, 'RAKYAN BAYUNDRIYO', 'R.930707.08.019', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (28, 'STEFAN CHRISTIAN', 'S.930923.08.020', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (29, 'TATIANA JAQUELINE WIJAYA', 'T.960618.08.013', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (30, 'WINALDA  A. PERDANA', 'W.051102.08.030', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_child` (`id_user`, `name`, `no_membership`, `age`, `birth_date`, `parent_id`, `jigc_played`, `tournament_played`, `background`, `hobby`, `avg_score`, `email`, `cp`, `address`, `group`) VALUES (31, 'WRESNI PRINGGOWERDHI', 'W.960907.08.003', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_config`
-- 

DROP TABLE IF EXISTS `tbl_config`;
CREATE TABLE IF NOT EXISTS `tbl_config` (
  `varName` varchar(30) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`varName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `tbl_config`
-- 

INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('FTP_PATH', '/ijgc');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('ftp_user_name', 'ijgc');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('ftp_user_pass', 'ijgc');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('GB_PER_PAGE', '10');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('JML_LINKS', '5');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('LIST_PER_PAGE', '10');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('NODIRECT', 'true');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('PATH_IMAGES', '/images');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('PATH_MARS', 'mars');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('PATH_PROFILE', '/images/profile');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('PATH_THUMB_NEWS', '/images/news/thumbs');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('PHOTO_PER_PAGE', '10');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('PTM_PER_PAGE', '10');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('REC_PER_PAGE', '10');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('WEB_PATH', 'C:/wamp/www/ijgc');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('IMAGE_TIPS_PATH', '/images/tips');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('PATH_FOUNDATION', '/images/foundation');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('IMAGE_PRODUCT', '/images/product');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('IMAGE_LINK', '/images/links');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('IMAGE_PARTNER', '/images/partner');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('IMAGE_MEMBER', '/images/membership');
INSERT INTO `tbl_config` (`varName`, `value`) VALUES ('FTP_HOME', '10.1.10.20');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_foundation`
-- 

DROP TABLE IF EXISTS `tbl_foundation`;
CREATE TABLE IF NOT EXISTS `tbl_foundation` (
  `id` int(5) NOT NULL auto_increment,
  `gambar` varchar(200) default NULL,
  `deskripsi` text,
  `link` varchar(200) default NULL,
  `kategori` int(5) default NULL,
  `status` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data untuk tabel `tbl_foundation`
-- 

INSERT INTO `tbl_foundation` (`id`, `gambar`, `deskripsi`, `link`, `kategori`, `status`) VALUES (1, '1.jpg', '<P>Mr Yusuf Halami</P>', 'localhost.com', 1, 1);
INSERT INTO `tbl_foundation` (`id`, `gambar`, `deskripsi`, `link`, `kategori`, `status`) VALUES (2, NULL, '<P>Mr. Hendro</P>', 'localhost.com', 1, 1);
INSERT INTO `tbl_foundation` (`id`, `gambar`, `deskripsi`, `link`, `kategori`, `status`) VALUES (3, NULL, 'Mr. Brandon Polana ', 'www.localhost.com', 1, 1);
INSERT INTO `tbl_foundation` (`id`, `gambar`, `deskripsi`, `link`, `kategori`, `status`) VALUES (4, NULL, 'Mr. Hardi Hartoko', 'www.localhost.com', 1, 1);
INSERT INTO `tbl_foundation` (`id`, `gambar`, `deskripsi`, `link`, `kategori`, `status`) VALUES (5, NULL, 'Mr. Emanza Kow', 'www.localhost.com', 1, 1);
INSERT INTO `tbl_foundation` (`id`, `gambar`, `deskripsi`, `link`, `kategori`, `status`) VALUES (6, NULL, 'Mr. Budi Oei', 'www.localhost.com', 1, 1);
INSERT INTO `tbl_foundation` (`id`, `gambar`, `deskripsi`, `link`, `kategori`, `status`) VALUES (7, NULL, 'Mr. Dading Soetarso', 'www.localhost.com', 1, 1);
INSERT INTO `tbl_foundation` (`id`, `gambar`, `deskripsi`, `link`, `kategori`, `status`) VALUES (8, NULL, '<P>Mr. Wira Perdana</P>', 'www.localhost.com', 1, 1);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_links`
-- 

DROP TABLE IF EXISTS `tbl_links`;
CREATE TABLE IF NOT EXISTS `tbl_links` (
  `id` int(5) NOT NULL auto_increment,
  `content` text,
  `gambar` varchar(100) default NULL,
  `link` varchar(200) default NULL,
  `status` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data untuk tabel `tbl_links`
-- 

INSERT INTO `tbl_links` (`id`, `content`, `gambar`, `link`, `status`) VALUES (1, '<P>Asosiasi Pemilik Lapangan Golf Indonesia</P>', '1.jpg', 'http://www.indonesia-gcoa.org/', 1);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_membership`
-- 

DROP TABLE IF EXISTS `tbl_membership`;
CREATE TABLE IF NOT EXISTS `tbl_membership` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) default NULL,
  `email` varchar(200) default NULL,
  `tglLahir` date default NULL,
  `tmpLahir` varchar(200) default NULL,
  `alamat` varchar(200) default NULL,
  `negara` int(5) default NULL,
  `noRumah` varchar(100) default NULL,
  `noHp` varchar(200) default NULL,
  `hobby` varchar(100) default NULL,
  `ortu` varchar(100) default NULL,
  `noHportu` varchar(100) default NULL,
  `handicap` varchar(200) default NULL,
  `golfClub` varchar(200) default NULL,
  `gambar` varchar(200) default NULL,
  `recomendation` int(1) default NULL,
  `level` int(1) default NULL,
  `group_type` int(1) default NULL,
  `package` int(1) default NULL,
  `status` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `tbl_membership`
-- 

INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('B.941212.08.012', 'BERNICE INTAN T.SITOMPUL', NULL, '1994-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('B.971116.08.011', 'BRANDON OTTO POLANA', NULL, '1997-11-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('D.060106.08.031', 'DIMITRI JESSE', NULL, '1996-01-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('D.950226.08.025', 'DICKY PRIONGGO', NULL, '1995-02-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('A.931027.08.021', 'ADRIAN HALIMI', NULL, '1993-10-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('A.950710.08.027', 'ALDWIN D. KENDARWAN', NULL, '1995-07-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('A.960106.08.001', 'ARTHUR JESIMEIL BUDIHADIANTO', NULL, '1996-01-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('B.920729.08.017', 'BOBBY CAHYO', NULL, '1992-07-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('A.930405.08.018', 'AHMAD FAUZAN', NULL, '1993-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('E.940908.08.023', 'ELKI KOW', NULL, '1994-09-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('F.960421.08.002', 'FADHLI RAHMAN SOETARSO', NULL, '1996-04-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('G.950125.08.024', 'GIAN WIRJAWAN', NULL, '1995-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('G.950614.08.026', 'GUIDDO  I.PURBA', NULL, '1995-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('G.970822.08.010', 'GRIVANDI ILYAS PURBA', NULL, '1997-08-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('I.970104.08.007', 'IRVAN ARVENZIA', NULL, '1997-01-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('J.951101.08.029', 'JORDAN IRAWAN', NULL, '1995-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('J.970402.08.008', 'JOBEL IRAWAN', NULL, '1997-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('J.970715.08.009', 'JOHN AMADEO D.KARNADJAJA', NULL, '1997-07-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('L.940101.08.022', 'LEONARDUS TAN', NULL, '1994-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('M.950711.08.028', 'MUHAMMAD AKMAL', NULL, '1995-07-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('M.960911.08.004', 'MICHAEL HARJANI', NULL, '1996-09-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('M.960911.08.014', 'MICHELLE HARJANI', NULL, '1996-09-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('M.960911.08.015', 'MONIQUE HARJANI', NULL, '1996-09-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('M.960916.08.005', 'MARCO KANARDI', NULL, '1996-09-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('M.970924.08.016', 'CELINE HARJANI', NULL, '1997-09-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('P.961004.08.006', 'PETER GUNAWAN', NULL, '1996-10-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('R.930707.08.019', 'RAKYAN BAYUNDRIYO', NULL, '1993-07-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('S.930923.08.020', 'STEFAN CHRISTIAN', NULL, '1993-09-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('T.960618.08.013', 'TATIANA JAQUELINE WIJAYA', NULL, '1996-06-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('W.051102.08.030', 'WINALDA  A. PERDANA', NULL, '1995-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_membership` (`id`, `name`, `email`, `tglLahir`, `tmpLahir`, `alamat`, `negara`, `noRumah`, `noHp`, `hobby`, `ortu`, `noHportu`, `handicap`, `golfClub`, `gambar`, `recomendation`, `level`, `group_type`, `package`, `status`) VALUES ('W.960907.08.003', 'WRESNI PRINGGOWERDHI', NULL, '1996-09-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_membership_reward`
-- 

DROP TABLE IF EXISTS `tbl_membership_reward`;
CREATE TABLE IF NOT EXISTS `tbl_membership_reward` (
  `reward_id` int(10) unsigned NOT NULL auto_increment,
  `membership_id` varchar(100) NOT NULL,
  `membership_name` varchar(45) NOT NULL,
  `starts_session` datetime NOT NULL,
  `close_session` datetime NOT NULL,
  `earning_reward` double NOT NULL default '0',
  `earning_ranking_points` double NOT NULL default '0',
  `earning_trial_points` double NOT NULL default '0',
  PRIMARY KEY  (`reward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data untuk tabel `tbl_membership_reward`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_news`
-- 

DROP TABLE IF EXISTS `tbl_news`;
CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(5) NOT NULL auto_increment,
  `kategori` varchar(2) default NULL,
  `judul` text,
  `tanggal` tinytext,
  `cuplikan` tinytext,
  `isi` text,
  `gambar` varchar(200) default NULL,
  `status` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `tbl_news`
-- 

INSERT INTO `tbl_news` (`id`, `kategori`, `judul`, `tanggal`, `cuplikan`, `isi`, `gambar`, `status`) VALUES (1, '1', 'Testing', '2008-01-03', 'IJGC started when a group of parents would like to see their children have more opportunity to play golf in a competitive environment, and at the same time learn more than “just golf”.', 'IJGC started when a group of parents would like to see their children have more opportunity to play golf in a competitive environment, and at the same time learn more than “just golf”. \r\n<P>We have seen in other countries where they have set up organizations to support the golfing bodies to help the development. We want our children to pursue excellence and appreciate the opportunities they receive.</P>', '1.jpg', 1);
INSERT INTO `tbl_news` (`id`, `kategori`, `judul`, `tanggal`, `cuplikan`, `isi`, `gambar`, `status`) VALUES (2, '2', 'Test', '2008-01-03', 'IJGC started when a group of parents would like to see their children have more opportunity to play golf in a competitive environment, and at the same time learn more than “just golf”.', 'IJGC started when a group of parents would like to see their children have more opportunity to play golf in a competitive environment, and at the same time learn more than “just golf”. ', '2.jpg', 1);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_partner`
-- 

DROP TABLE IF EXISTS `tbl_partner`;
CREATE TABLE IF NOT EXISTS `tbl_partner` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `description` text,
  `logo` varchar(100) default NULL,
  `link` varchar(200) default NULL,
  `type_partner` int(2) default NULL,
  `status` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `tbl_partner`
-- 

INSERT INTO `tbl_partner` (`id`, `name`, `description`, `logo`, `link`, `type_partner`, `status`) VALUES (1, 'APLGI-edit', 'Adalah sebuah badan yang menaungi golf di Indonesia.-edit', '1.jpg', 'localhost.com-edit', 1, 1);
INSERT INTO `tbl_partner` (`id`, `name`, `description`, `logo`, `link`, `type_partner`, `status`) VALUES (2, 'Test', 'Testing juga ', NULL, 'testing.com', 2, 1);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_products`
-- 

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` int(5) NOT NULL auto_increment,
  `information` text,
  `gambar` varchar(100) default NULL,
  `link` varchar(200) default NULL,
  `type` varchar(1) default NULL,
  `status` varchar(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data untuk tabel `tbl_products`
-- 

INSERT INTO `tbl_products` (`id`, `information`, `gambar`, `link`, `type`, `status`) VALUES (1, 'Test Product', '1.jpg', 'localhost.com', '1', '1');
INSERT INTO `tbl_products` (`id`, `information`, `gambar`, `link`, `type`, `status`) VALUES (2, 'Test Product 2 ', '', 'localhost.com', '2', '1');
INSERT INTO `tbl_products` (`id`, `information`, `gambar`, `link`, `type`, `status`) VALUES (3, 'test3 test3 test', NULL, 'localhost.com', '3', '1');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_tips`
-- 

DROP TABLE IF EXISTS `tbl_tips`;
CREATE TABLE IF NOT EXISTS `tbl_tips` (
  `id` int(5) NOT NULL auto_increment,
  `photo` varchar(100) default NULL,
  `content` text,
  `link` varchar(200) default NULL,
  `kategori` varchar(1) default NULL,
  `status` varchar(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `tbl_tips`
-- 

INSERT INTO `tbl_tips` (`id`, `photo`, `content`, `link`, `kategori`, `status`) VALUES (1, '1.jpg', 'IJGC started when a group of parents would like to see their children have more opportunity to play golf in a competitive environment, and at the same time learn more than “just golf”. \r\n<P>We have seen in other countries where they have set up organizations to support the golfing bodies to help the development. We want our children to pursue excellence and appreciate the opportunities they receive.</P>', 'localhost.com', '1', '1');
INSERT INTO `tbl_tips` (`id`, `photo`, `content`, `link`, `kategori`, `status`) VALUES (2, '2.jpg', 'IJGC started when a group of parents would like to see their children have more opportunity to play golf in a competitive environment, and at the same time learn more than “just golf”. \r\n<P>We have seen in other countries where they have set up organizations to support the golfing bodies to help the development. We want our children to pursue excellence and appreciate the opportunities they receive.</P>', 'localhost.com', '1', '1');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `tbl_user`
-- 

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `uid` int(5) NOT NULL auto_increment,
  `id_unik` varchar(100) default NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_tipe` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `last_login` varchar(100) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;

-- 
-- Dumping data untuk tabel `tbl_user`
-- 

INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (999, NULL, 'child', 'child', 2, 1, '2008-02-03 16:28:49');
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (998, NULL, 'parent', 'parent', 1, 1, '2008-02-01 00:05:27');
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (1, NULL, 'AHMADF', '1234', 2, 1, '2008-02-03 16:30:01');
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (2, NULL, 'ADRIAN', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (3, NULL, 'ALDWIN', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (4, NULL, 'ARTHUR', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (5, NULL, 'BOBBY', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (6, NULL, 'BERNICE', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (7, NULL, 'BRANDON', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (8, NULL, 'DIMITRI', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (9, NULL, 'DICKY', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (10, NULL, 'ELKI', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (11, NULL, 'FADHLI', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (12, NULL, 'GIAN', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (13, NULL, 'GUIDDO', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (14, NULL, 'GRIVANDI', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (15, NULL, 'IRVAN', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (16, NULL, 'JORDAN', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (17, NULL, 'JOBEL', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (18, NULL, 'JOHN', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (19, NULL, 'LEONARDUS', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (20, NULL, 'MAKHMAL', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (21, NULL, 'MICHAEL', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (22, NULL, 'MICHELLE', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (23, NULL, 'MONIQUE', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (24, NULL, 'MARCO', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (25, NULL, 'CELINE', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (26, NULL, 'PETERG', '1234', 2, 1, '2008-02-14 03:44:26');
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (27, NULL, 'RAKYAN', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (28, NULL, 'STEFAN', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (29, NULL, 'TATIANA', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (30, NULL, 'WINALDA', '1234', 2, 1, NULL);
INSERT INTO `tbl_user` (`uid`, `id_unik`, `user`, `password`, `user_tipe`, `status`, `last_login`) VALUES (31, NULL, 'WRESNI', '1234', 2, 1, NULL);
