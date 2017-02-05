-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: mysql.dragonscourge.com
-- Generation Time: Feb 08, 2006 at 07:47 AM
-- Server version: 4.1.14
-- PHP Version: 4.4.1
-- 
-- Database: `scourge`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_accounts`
-- 

DROP TABLE IF EXISTS `sx_accounts`;
CREATE TABLE `sx_accounts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `emailaddress` varchar(200) NOT NULL default '',
  `verifycode` varchar(8) NOT NULL default '',
  `regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `regip` varchar(16) NOT NULL default '',
  `authlevel` tinyint(3) unsigned NOT NULL default '1',
  `language` varchar(30) NOT NULL default '',
  `characters` tinyint(3) unsigned NOT NULL default '0',
  `activechar` int(10) unsigned NOT NULL default '0',
  `imageformat` varchar(4) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_accounts`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_babblebox`
-- 

DROP TABLE IF EXISTS `sx_babblebox`;
CREATE TABLE `sx_babblebox` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `posttime` datetime NOT NULL default '0000-00-00 00:00:00',
  `charname` varchar(30) NOT NULL default '',
  `charid` int(11) unsigned NOT NULL default '0',
  `content` varchar(255) NOT NULL default '',
  `guild` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_babblebox`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_classes`
-- 

DROP TABLE IF EXISTS `sx_classes`;
CREATE TABLE `sx_classes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `expbonus` tinyint(3) unsigned NOT NULL default '0',
  `goldbonus` tinyint(3) unsigned NOT NULL default '0',
  `damageperstrength` float unsigned NOT NULL default '0',
  `hpperdexterity` float unsigned NOT NULL default '0',
  `mpperenergy` float unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_classes`
-- 

INSERT INTO `sx_classes` VALUES (1, 'Barbarian', 0, 0, 3, 2, 1);
INSERT INTO `sx_classes` VALUES (2, 'Sorceress', 0, 0, 1, 2, 3);
INSERT INTO `sx_classes` VALUES (3, 'Paladin', 0, 0, 2, 3, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_control`
-- 

DROP TABLE IF EXISTS `sx_control`;
CREATE TABLE `sx_control` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `gamename` varchar(50) NOT NULL default '',
  `gameopen` tinyint(3) unsigned NOT NULL default '0',
  `gamepath` varchar(200) NOT NULL default '',
  `gameurl` varchar(200) NOT NULL default '',
  `forumtype` tinyint(3) unsigned NOT NULL default '0',
  `forumurl` varchar(200) NOT NULL default '',
  `avatarpath` varchar(200) NOT NULL default '',
  `avatarurl` varchar(200) NOT NULL default '',
  `avatarmaxsize` int(10) unsigned NOT NULL default '0',
  `showshout` tinyint(3) unsigned NOT NULL default '0',
  `showonline` tinyint(3) unsigned NOT NULL default '0',
  `shownews` tinyint(3) unsigned NOT NULL default '0',
  `showimages` tinyint(3) unsigned NOT NULL default '0',
  `adminemail` varchar(200) NOT NULL default '',
  `verifyemail` tinyint(3) unsigned NOT NULL default '0',
  `compression` tinyint(3) unsigned NOT NULL default '0',
  `debug` tinyint(3) unsigned NOT NULL default '0',
  `logerrors` tinyint(3) unsigned NOT NULL default '0',
  `botcheck` tinyint(3) unsigned NOT NULL default '0',
  `pvprefresh` int(10) NOT NULL default '0',
  `pvptimeout` int(10) NOT NULL default '0',
  `guildstartup` int(10) unsigned NOT NULL default '100000',
  `guildupdate` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_control`
-- 

INSERT INTO `sx_control` VALUES (1, 'Dragon Scourge', 1, '/home/renderse7en/dragonscourge.com/play/', 'http://www.dragonscourge.com/play/', 1, 'http://se7enet.com/forums/ubbthreads.php', '/home/renderse7en/dragonscourge.com/play/images/users/', 'http://www.dragonscourge.com/play/images/users/', 15000, 1, 1, 1, 1, 'jamin@se7enet.com', 1, 1, 0, 1, 255, 30, 120, 100000, 24);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_difficulties`
-- 

DROP TABLE IF EXISTS `sx_difficulties`;
CREATE TABLE `sx_difficulties` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `expbonus` tinyint(3) unsigned NOT NULL default '0',
  `goldbonus` tinyint(3) unsigned NOT NULL default '0',
  `multiplier` float NOT NULL default '0',
  `deathpenalty` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_difficulties`
-- 

INSERT INTO `sx_difficulties` VALUES (1, 'Easy', 0, 0, 1, 0);
INSERT INTO `sx_difficulties` VALUES (2, 'Medium', 3, 3, 1.5, 3);
INSERT INTO `sx_difficulties` VALUES (3, 'Hard', 5, 5, 2, 7);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_guildapps`
-- 

DROP TABLE IF EXISTS `sx_guildapps`;
CREATE TABLE `sx_guildapps` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `guild` int(10) unsigned NOT NULL default '0',
  `charid` int(10) unsigned NOT NULL default '0',
  `charname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_guildapps`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_guilds`
-- 

DROP TABLE IF EXISTS `sx_guilds`;
CREATE TABLE `sx_guilds` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `lastupdate` bigint(20) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `tagline` varchar(4) NOT NULL default '',
  `color1` varchar(7) NOT NULL default '',
  `color2` varchar(7) NOT NULL default '',
  `members` int(10) unsigned NOT NULL default '0',
  `honor` int(10) unsigned NOT NULL default '0',
  `founder` int(10) unsigned NOT NULL default '0',
  `bank` int(10) unsigned NOT NULL default '0',
  `joincost` int(10) unsigned NOT NULL default '0',
  `image` varchar(30) NOT NULL default '',
  `rank1` varchar(30) NOT NULL default '',
  `rank2` varchar(30) NOT NULL default '',
  `rank3` varchar(30) NOT NULL default '',
  `rank4` varchar(30) NOT NULL default '',
  `rank5` varchar(30) NOT NULL default '',
  `isactive` tinyint(3) unsigned NOT NULL default '0',
  `statement` text NOT NULL,
  `news` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_guilds`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_itembase`
-- 

DROP TABLE IF EXISTS `sx_itembase`;
CREATE TABLE `sx_itembase` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `slotnumber` tinyint(3) unsigned NOT NULL default '0',
  `unique` tinyint(3) unsigned NOT NULL default '0',
  `willdrop` tinyint(3) unsigned NOT NULL default '0',
  `buycost` int(10) unsigned NOT NULL default '0',
  `sellcost` int(10) unsigned NOT NULL default '0',
  `reqlevel` smallint(5) unsigned NOT NULL default '0',
  `reqstrength` smallint(5) unsigned NOT NULL default '0',
  `reqdexterity` smallint(5) unsigned NOT NULL default '0',
  `reqenergy` smallint(5) unsigned NOT NULL default '0',
  `basename` varchar(50) NOT NULL default '',
  `baseattr` smallint(5) unsigned NOT NULL default '0',
  `mod1name` varchar(50) NOT NULL default '',
  `mod1attr` smallint(5) unsigned NOT NULL default '0',
  `mod2name` varchar(50) NOT NULL default '',
  `mod2attr` smallint(5) unsigned NOT NULL default '0',
  `mod3name` varchar(50) NOT NULL default '',
  `mod3attr` smallint(5) unsigned NOT NULL default '0',
  `mod4name` varchar(50) NOT NULL default '',
  `mod4attr` smallint(5) unsigned NOT NULL default '0',
  `mod5name` varchar(50) NOT NULL default '',
  `mod5attr` smallint(5) unsigned NOT NULL default '0',
  `mod6name` varchar(50) NOT NULL default '',
  `mod6attr` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_itembase`
-- 

INSERT INTO `sx_itembase` VALUES (1, 'Pointy Stick', 1, 0, 1, 10, 5, 1, 0, 0, 0, 'physattack', 3, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (2, 'Big Stick', 1, 0, 1, 15, 8, 1, 0, 0, 0, 'physattack', 4, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (3, 'Dagger', 1, 0, 1, 20, 10, 1, 0, 0, 0, 'physattack', 5, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (4, 'Hand Axe', 1, 0, 1, 30, 15, 1, 0, 0, 0, 'physattack', 7, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (5, 'Leg Bone', 1, 0, 1, 40, 20, 1, 0, 0, 0, 'physattack', 8, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (6, 'Dirk', 1, 0, 1, 60, 30, 3, 10, 0, 0, 'physattack', 10, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (7, 'Small Axe', 1, 0, 1, 80, 40, 3, 10, 0, 0, 'physattack', 11, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (8, 'Club', 1, 0, 1, 110, 55, 3, 15, 0, 0, 'physattack', 12, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (9, 'Kris', 1, 0, 1, 140, 70, 3, 15, 0, 0, 'physattack', 15, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (10, 'Light Axe', 1, 0, 1, 180, 90, 5, 20, 0, 0, 'physattack', 18, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (11, 'Spiked Club', 1, 0, 1, 220, 110, 5, 20, 0, 0, 'physattack', 20, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (12, 'Cudgel', 1, 0, 1, 270, 135, 5, 25, 0, 0, 'physattack', 23, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (13, 'Stiletto', 1, 0, 1, 330, 165, 7, 25, 0, 0, 'physattack', 25, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (14, 'Pick Axe', 1, 0, 1, 400, 200, 9, 30, 0, 0, 'physattack', 30, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (15, 'Nailed Club', 1, 0, 1, 480, 240, 11, 30, 0, 0, 'physattack', 30, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (16, 'Cutlass', 1, 0, 1, 570, 285, 13, 35, 0, 0, 'physattack', 35, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (17, 'Bayonet', 1, 0, 1, 670, 335, 15, 35, 0, 0, 'physattack', 38, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (18, 'Tomahawk', 1, 0, 1, 800, 400, 17, 40, 0, 0, 'physattack', 40, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (19, 'Light Mace', 1, 0, 1, 950, 475, 19, 40, 0, 0, 'physattack', 43, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (20, 'Falchion', 1, 0, 1, 1200, 600, 21, 45, 0, 0, 'physattack', 45, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (21, 'Foil', 1, 0, 1, 1400, 700, 23, 50, 0, 0, 'physattack', 48, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (22, 'Short Sword', 1, 0, 1, 1600, 800, 25, 50, 0, 0, 'physattack', 50, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (23, 'Double Axe', 1, 0, 1, 1900, 950, 27, 60, 0, 0, 'physattack', 55, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (24, 'Mace', 1, 0, 1, 2300, 1150, 29, 60, 0, 0, 'physattack', 60, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (25, 'Scimitar', 1, 0, 1, 2800, 1400, 31, 70, 0, 0, 'physattack', 65, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (26, 'Bardiche', 1, 0, 1, 3400, 1700, 33, 70, 0, 0, 'physattack', 70, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (27, 'Knobbed Mace', 1, 0, 1, 4100, 2050, 35, 80, 0, 0, 'physattack', 75, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (28, 'Rapier', 1, 0, 1, 4900, 2450, 37, 90, 0, 0, 'physattack', 85, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (29, 'Morning Star', 1, 0, 1, 5800, 2900, 39, 100, 0, 0, 'physattack', 95, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (30, 'Battle Axe', 1, 0, 1, 6800, 3400, 41, 110, 0, 0, 'physattack', 105, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (31, 'Saber', 1, 0, 1, 7800, 3900, 43, 120, 0, 0, 'physattack', 115, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (32, 'Francisca', 1, 0, 1, 9000, 4500, 45, 130, 0, 0, 'physattack', 125, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (33, 'Flanged Mace', 1, 0, 1, 10000, 5000, 47, 140, 0, 0, 'physattack', 135, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (34, 'Broadsword', 1, 0, 1, 11000, 5500, 49, 150, 0, 0, 'physattack', 145, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (35, 'War Axe', 1, 0, 1, 12500, 6250, 51, 165, 0, 0, 'physattack', 155, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (36, 'Trench Mace', 1, 0, 1, 14000, 7000, 53, 180, 0, 0, 'physattack', 165, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (37, 'Long Sword', 1, 0, 1, 15500, 7750, 55, 195, 0, 0, 'physattack', 180, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (38, 'Broad Axe', 1, 0, 1, 17000, 8500, 57, 210, 0, 0, 'physattack', 195, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (39, 'Flail', 1, 0, 1, 18500, 9250, 59, 225, 0, 0, 'physattack', 210, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (40, 'Claymore', 1, 0, 1, 20000, 10000, 61, 240, 0, 0, 'physattack', 225, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (41, 'Poleaxe', 1, 0, 1, 21500, 10750, 63, 255, 0, 0, 'physattack', 240, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (42, 'War Hammer', 1, 0, 1, 23000, 11500, 65, 270, 0, 0, 'physattack', 255, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (43, 'Katana', 1, 0, 1, 24500, 12250, 67, 285, 0, 0, 'physattack', 270, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (44, 'Scythe', 1, 0, 1, 26000, 13000, 69, 300, 0, 0, 'physattack', 280, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (45, 'Zweihander', 1, 0, 1, 27500, 13750, 71, 315, 0, 0, 'physattack', 295, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (46, 'Halberd', 1, 0, 1, 29000, 14500, 73, 330, 0, 0, 'physattack', 310, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (47, 'Flamberge', 1, 0, 1, 30000, 15000, 75, 345, 0, 0, 'physattack', 330, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (48, 'Great Axe', 1, 0, 1, 32000, 16000, 77, 360, 0, 0, 'physattack', 345, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (49, 'Great Sword', 1, 0, 1, 34000, 17000, 79, 375, 0, 0, 'physattack', 360, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (50, 'Giant Axe', 1, 0, 1, 36000, 18000, 81, 390, 0, 0, 'physattack', 380, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (173, 'Xiran''s Bite', 1, 1, 0, 0, 0, 83, 150, 100, 50, 'physattack', 600, 'fireattack', 600, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (52, 'Skivvies', 2, 0, 1, 20, 10, 1, 0, 0, 0, 'physdefense', 2, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (53, 'Cloak', 2, 0, 1, 30, 15, 1, 0, 0, 0, 'physdefense', 3, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (54, 'Cloth Armor', 2, 0, 1, 40, 20, 1, 0, 0, 0, 'physdefense', 3, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (55, 'Quilted Coat', 2, 0, 1, 50, 25, 1, 0, 0, 0, 'physdefense', 5, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (56, 'Quilted Armor', 2, 0, 1, 70, 35, 1, 0, 0, 0, 'physdefense', 5, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (57, 'Leather Coat', 2, 0, 1, 90, 45, 3, 5, 6, 0, 'physdefense', 6, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (58, 'Leather Hauberk', 2, 0, 1, 110, 55, 3, 5, 6, 0, 'physdefense', 7, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (59, 'Leather Coat', 2, 0, 1, 150, 75, 3, 8, 10, 0, 'physdefense', 8, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (60, 'Hard Leather Armor', 2, 0, 1, 190, 95, 3, 8, 10, 0, 'physdefense', 9, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (61, 'Riveted Leather Armor', 2, 0, 1, 230, 115, 5, 10, 12, 0, 'physdefense', 11, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (62, 'Spiked Leather Armor', 2, 0, 1, 270, 135, 5, 10, 12, 0, 'physdefense', 12, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (63, 'Light Chain Mail', 2, 0, 1, 310, 155, 5, 13, 16, 0, 'physdefense', 14, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (64, 'Heavy Chain Mail', 2, 0, 1, 360, 180, 7, 13, 16, 0, 'physdefense', 15, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (65, 'Chain Mail Shirt', 2, 0, 1, 420, 210, 9, 15, 18, 0, 'physdefense', 18, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (66, 'Chain Mail Hauberk', 2, 0, 1, 500, 250, 11, 15, 18, 0, 'physdefense', 18, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (67, 'Full Chain Mail', 2, 0, 1, 580, 290, 13, 18, 22, 0, 'physdefense', 21, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (68, 'Light Plate Mail', 2, 0, 1, 680, 340, 15, 18, 22, 0, 'physdefense', 23, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (69, 'Heavy Plate Mail', 2, 0, 1, 800, 400, 17, 20, 24, 0, 'physdefense', 24, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (70, 'Plate Mail Shirt', 2, 0, 1, 950, 475, 19, 20, 24, 0, 'physdefense', 26, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (71, 'Plate Mail Hauberk', 2, 0, 1, 1200, 600, 21, 23, 28, 0, 'physdefense', 27, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (72, 'Full Plate Mail', 2, 0, 1, 1500, 750, 23, 25, 30, 0, 'physdefense', 29, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (73, 'Light Scale Mail', 2, 0, 1, 1800, 900, 25, 25, 30, 0, 'physdefense', 30, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (172, 'Crestfall''s Chain Mail', 2, 1, 0, 0, 0, 50, 75, 80, 0, 'physdefense', 100, 'magicdefense', 75, 'firedefense', 75, 'lightdefense', 75, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (171, 'Numoren''s Ring', 5, 1, 0, 0, 0, 0, 0, 0, 0, '', 0, 'magicattack', 25, 'fireattack', 25, 'lightattack', 25, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (170, 'Shirreh''s Sword', 1, 1, 0, 0, 0, 25, 0, 0, 0, 'physattack', 75, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (74, 'Heavy Scale Mail', 2, 0, 1, 2400, 1200, 27, 30, 36, 0, 'physdefense', 33, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (75, 'Scale Mail Shirt', 2, 0, 1, 2800, 1400, 29, 30, 36, 0, 'physdefense', 36, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (76, 'Scale Mail Hauberk', 2, 0, 1, 3500, 1750, 31, 35, 42, 0, 'physdefense', 39, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (77, 'Full Scale Mail', 2, 0, 1, 4800, 2400, 33, 35, 42, 0, 'physdefense', 42, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (78, 'Copper Breastplate', 2, 0, 1, 6000, 3000, 35, 40, 48, 0, 'physdefense', 45, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (79, 'Bronze Breastplate', 2, 0, 1, 7500, 3750, 37, 45, 54, 0, 'physdefense', 50, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (80, 'Iron Breastplate', 2, 0, 1, 9000, 4500, 39, 50, 60, 0, 'physdefense', 56, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (81, 'Steel Breastplate', 2, 0, 1, 10500, 5250, 41, 55, 66, 0, 'physdefense', 62, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (82, 'Titanium Breastplate', 2, 0, 1, 12000, 6000, 43, 60, 72, 0, 'physdefense', 68, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (83, 'Copper Field Plate', 2, 0, 1, 14000, 7000, 45, 65, 78, 0, 'physdefense', 74, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (84, 'Bronze Field Plate', 2, 0, 1, 16000, 8000, 47, 70, 84, 0, 'physdefense', 80, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (85, 'Iron Field Plate', 2, 0, 1, 18000, 9000, 49, 75, 90, 0, 'physdefense', 86, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (86, 'Steel Field Plate', 2, 0, 1, 20000, 10000, 51, 83, 100, 0, 'physdefense', 92, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (87, 'Titanium Field Plate', 2, 0, 1, 24000, 12000, 53, 90, 108, 0, 'physdefense', 98, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (88, 'Copper Articulated Plate', 2, 0, 1, 28000, 14000, 55, 98, 118, 0, 'physdefense', 106, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (89, 'Bronze Articulated Plate', 2, 0, 1, 32000, 16000, 57, 105, 126, 0, 'physdefense', 115, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (90, 'Iron Articulated Plate', 2, 0, 1, 36000, 18000, 59, 113, 136, 0, 'physdefense', 124, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (91, 'Steel Articulated Plate', 2, 0, 1, 40000, 20000, 61, 120, 144, 0, 'physdefense', 133, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (92, 'Titanium Articulated Plate', 2, 0, 1, 45000, 22500, 63, 128, 154, 0, 'physdefense', 142, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (93, 'Copper Battle Armor', 2, 0, 1, 50000, 25000, 65, 135, 162, 0, 'physdefense', 150, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (94, 'Bronze Battle Armor', 2, 0, 1, 55000, 27500, 67, 143, 172, 0, 'physdefense', 159, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (95, 'Iron Battle Armor', 2, 0, 1, 60000, 30000, 69, 150, 180, 0, 'physdefense', 165, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (96, 'Steel Battle Armor', 2, 0, 1, 65000, 32500, 71, 158, 190, 0, 'physdefense', 174, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (97, 'Titanium Battle Armor', 2, 0, 1, 70000, 35000, 73, 165, 198, 0, 'physdefense', 183, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (98, 'Copper Gothic Plate', 2, 0, 1, 75000, 37500, 75, 173, 208, 0, 'physdefense', 195, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (99, 'Bronze Gothic Plate', 2, 0, 1, 80000, 40000, 77, 180, 216, 0, 'physdefense', 203, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (100, 'Iron Gothic Plate', 2, 0, 1, 85000, 42500, 79, 188, 226, 0, 'physdefense', 212, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (101, 'Steel Gothic Plate', 2, 0, 1, 90000, 45000, 81, 195, 234, 0, 'physdefense', 224, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (102, 'Titanium Gothic Plate', 2, 0, 1, 95000, 47500, 83, 203, 244, 0, 'physdefense', 236, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (103, 'Leather Buckler', 4, 0, 1, 25, 13, 1, 0, 0, 0, 'physdefense', 3, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (104, 'Wood Buckler', 4, 0, 1, 50, 25, 1, 0, 0, 0, 'physdefense', 5, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (105, 'Steel Buckler', 4, 0, 1, 75, 38, 1, 0, 0, 0, 'physdefense', 7, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (106, 'Titanium Buckler', 4, 0, 1, 100, 50, 1, 0, 0, 0, 'physdefense', 8, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (107, 'Leather Targe', 4, 0, 1, 150, 75, 3, 0, 5, 0, 'physdefense', 11, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (108, 'Wood Targe', 4, 0, 1, 200, 100, 3, 0, 10, 0, 'physdefense', 12, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (109, 'Steel Targe', 4, 0, 1, 300, 150, 5, 0, 15, 0, 'physdefense', 15, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (110, 'Titanium Targe', 4, 0, 1, 400, 200, 5, 0, 20, 0, 'physdefense', 18, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (111, 'Small Aspis', 4, 0, 1, 600, 300, 8, 0, 25, 0, 'physdefense', 21, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (112, 'Large Aspis', 4, 0, 1, 800, 400, 11, 0, 35, 0, 'physdefense', 23, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (113, 'Full Aspis', 4, 0, 1, 1200, 600, 14, 0, 45, 0, 'physdefense', 26, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (114, 'Great Aspis', 4, 0, 1, 1500, 750, 17, 0, 55, 0, 'physdefense', 27, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (115, 'Small Kite Shield', 4, 0, 1, 2000, 1000, 20, 0, 65, 0, 'physdefense', 30, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (116, 'Large Kite Shield', 4, 0, 1, 2500, 1250, 23, 0, 80, 0, 'physdefense', 36, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (117, 'Full Kite Shield', 4, 0, 1, 3000, 1500, 26, 0, 95, 0, 'physdefense', 39, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (118, 'Great Kite Shield', 4, 0, 1, 4000, 2000, 29, 0, 110, 0, 'physdefense', 45, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (119, 'Small Heater Shield', 4, 0, 1, 5000, 2500, 31, 0, 130, 0, 'physdefense', 56, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (120, 'Large Heater Shield', 4, 0, 1, 6000, 3000, 34, 0, 150, 0, 'physdefense', 62, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (121, 'Full Heater Shield', 4, 0, 1, 8000, 4000, 37, 0, 170, 0, 'physdefense', 74, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (122, 'Great Heater Shield', 4, 0, 1, 10000, 5000, 40, 0, 190, 0, 'physdefense', 80, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (123, 'Small Scuta', 4, 0, 1, 12000, 6000, 43, 0, 210, 0, 'physdefense', 86, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (124, 'Large Scuta', 4, 0, 1, 15000, 7500, 46, 0, 230, 0, 'physdefense', 98, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (125, 'Full Scuta', 4, 0, 1, 18000, 9000, 49, 0, 250, 0, 'physdefense', 106, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (126, 'Great Scuta', 4, 0, 1, 22000, 11000, 51, 0, 270, 0, 'physdefense', 115, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (127, 'Small Pavise', 4, 0, 1, 26000, 13000, 54, 0, 300, 0, 'physdefense', 133, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (128, 'Large Pavise', 4, 0, 1, 30000, 15000, 57, 0, 320, 0, 'physdefense', 142, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (129, 'Full Pavise', 4, 0, 1, 35000, 17500, 60, 0, 340, 0, 'physdefense', 159, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (130, 'Great Pavise', 4, 0, 1, 40000, 20000, 65, 0, 360, 0, 'physdefense', 165, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (131, 'Small Heraldic Shield', 4, 0, 1, 45000, 22500, 70, 0, 380, 0, 'physdefense', 183, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (132, 'Large Heraldic Shield', 4, 0, 1, 50000, 25000, 75, 0, 400, 0, 'physdefense', 195, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (133, 'Full Heraldic Shield', 4, 0, 1, 55000, 27500, 80, 0, 420, 0, 'physdefense', 212, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (134, 'Great Heraldic Shield', 4, 0, 1, 60000, 30000, 85, 0, 440, 0, 'physdefense', 236, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (135, 'Leather Cap', 3, 0, 1, 20, 10, 1, 0, 0, 0, 'physdefense', 2, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (136, 'Copper Cap', 3, 0, 1, 40, 20, 1, 0, 0, 0, 'physdefense', 3, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (137, 'Bronze Cap', 3, 0, 1, 60, 30, 1, 0, 0, 0, 'physdefense', 5, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (138, 'Steel Cap', 3, 0, 1, 80, 40, 1, 0, 0, 0, 'physdefense', 5, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (139, 'Titanium Cap', 3, 0, 1, 110, 55, 1, 0, 0, 0, 'physdefense', 7, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (140, 'Leather Skull Cap', 3, 0, 1, 140, 70, 3, 5, 6, 0, 'physdefense', 8, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (141, 'Copper Skull Cap', 3, 0, 1, 170, 85, 3, 5, 6, 0, 'physdefense', 9, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (142, 'Bronze Skull Cap', 3, 0, 1, 200, 100, 3, 8, 10, 0, 'physdefense', 11, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (143, 'Steel Skull Cap', 3, 0, 1, 240, 120, 5, 10, 12, 0, 'physdefense', 13, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (144, 'Titanium Skull Cap', 3, 0, 1, 280, 140, 5, 10, 12, 0, 'physdefense', 14, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (145, 'Copper Helm', 3, 0, 1, 330, 165, 5, 13, 16, 0, 'physdefense', 16, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (146, 'Bronze Helm', 3, 0, 1, 380, 190, 8, 13, 16, 0, 'physdefense', 16, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (147, 'Iron Helm', 3, 0, 1, 440, 220, 11, 15, 18, 0, 'physdefense', 18, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (148, 'Steel Helm', 3, 0, 1, 500, 250, 14, 18, 22, 0, 'physdefense', 22, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (149, 'Titanium Helm', 3, 0, 1, 600, 300, 17, 18, 22, 0, 'physdefense', 23, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (150, 'Copper Corinthian Helmet', 3, 0, 1, 700, 350, 20, 20, 24, 0, 'physdefense', 27, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (151, 'Bronze Corinthian Helmet', 3, 0, 1, 850, 425, 23, 23, 28, 0, 'physdefense', 33, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (152, 'Iron Corinthian Helmet', 3, 0, 1, 1000, 500, 26, 25, 30, 0, 'physdefense', 37, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (153, 'Steel Corinthian Helmet', 3, 0, 1, 2000, 1000, 29, 25, 30, 0, 'physdefense', 44, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (154, 'Titanium Corinthian Helmet', 3, 0, 1, 3200, 1600, 31, 30, 36, 0, 'physdefense', 48, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (155, 'Copper Sallet', 3, 0, 1, 4400, 2200, 34, 30, 36, 0, 'physdefense', 51, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (156, 'Bronze Sallet', 3, 0, 1, 6000, 3000, 37, 35, 42, 0, 'physdefense', 58, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (157, 'Iron Sallet', 3, 0, 1, 7000, 3500, 40, 35, 42, 0, 'physdefense', 63, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (158, 'Steel Sallet', 3, 0, 1, 8000, 4000, 43, 40, 48, 0, 'physdefense', 68, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (159, 'Titanium Sallet', 3, 0, 1, 10000, 5000, 46, 45, 54, 0, 'physdefense', 79, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (160, 'Copper Bascinet', 3, 0, 1, 12000, 6000, 49, 50, 60, 0, 'physdefense', 84, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (161, 'Bronze Bascinet', 3, 0, 1, 15000, 7500, 51, 55, 66, 0, 'physdefense', 94, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (162, 'Iron Bascinet', 3, 0, 1, 18000, 9000, 54, 60, 72, 0, 'physdefense', 98, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (163, 'Steel Bascinet', 3, 0, 1, 22000, 11000, 57, 65, 78, 0, 'physdefense', 108, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (164, 'Titanium Bascinet', 3, 0, 1, 26000, 13000, 60, 70, 84, 0, 'physdefense', 115, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (165, 'Copper Horned Helm', 3, 0, 1, 30000, 15000, 65, 75, 90, 0, 'physdefense', 125, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (166, 'Bronze Horned Helm', 3, 0, 1, 35000, 17500, 70, 83, 100, 0, 'physdefense', 139, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (167, 'Iron Horned Helm', 3, 0, 1, 40000, 20000, 75, 90, 108, 0, 'physdefense', 145, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (168, 'Steel Horned Helm', 3, 0, 1, 45000, 22500, 80, 98, 118, 0, 'physdefense', 160, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (169, 'Titanium Horned Helm', 3, 0, 1, 50000, 25000, 85, 105, 126, 0, 'physdefense', 175, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `sx_itembase` VALUES (51, 'Giant Maul', 1, 0, 1, 38000, 19000, 83, 405, 0, 0, 'physattack', 400, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_itemmodnames`
-- 

DROP TABLE IF EXISTS `sx_itemmodnames`;
CREATE TABLE `sx_itemmodnames` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `fieldname` varchar(50) NOT NULL default '',
  `prettyname` varchar(50) NOT NULL default '',
  `percent` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_itemmodnames`
-- 

INSERT INTO `sx_itemmodnames` VALUES (1, 'expbonus', 'Experience Bonus', 1);
INSERT INTO `sx_itemmodnames` VALUES (2, 'goldbonus', 'Gold Bonus', 1);
INSERT INTO `sx_itemmodnames` VALUES (3, 'maxhp', 'Max HP', 0);
INSERT INTO `sx_itemmodnames` VALUES (4, 'maxmp', 'Max MP', 0);
INSERT INTO `sx_itemmodnames` VALUES (5, 'maxtp', 'Max TP', 0);
INSERT INTO `sx_itemmodnames` VALUES (6, 'strength', 'Strength', 0);
INSERT INTO `sx_itemmodnames` VALUES (7, 'dexterity', 'Dexterity', 0);
INSERT INTO `sx_itemmodnames` VALUES (8, 'energy', 'Energy', 0);
INSERT INTO `sx_itemmodnames` VALUES (9, 'physattack', 'Physical Attack', 0);
INSERT INTO `sx_itemmodnames` VALUES (10, 'physdefense', 'Physical Defense', 0);
INSERT INTO `sx_itemmodnames` VALUES (11, 'magicattack', 'Magic Attack', 0);
INSERT INTO `sx_itemmodnames` VALUES (12, 'magicdefense', 'Magid Defense', 0);
INSERT INTO `sx_itemmodnames` VALUES (13, 'fireattack', 'Fire Attack', 0);
INSERT INTO `sx_itemmodnames` VALUES (14, 'firedefense', 'Fire Defense', 0);
INSERT INTO `sx_itemmodnames` VALUES (15, 'lightattack', 'Lightning Attack', 0);
INSERT INTO `sx_itemmodnames` VALUES (16, 'lightdefense', 'Lightning Defense', 0);
INSERT INTO `sx_itemmodnames` VALUES (17, 'hpleech', 'HP Leech', 1);
INSERT INTO `sx_itemmodnames` VALUES (18, 'mpleech', 'MP Leech', 1);
INSERT INTO `sx_itemmodnames` VALUES (19, 'hpgain', 'HP Per Kill', 0);
INSERT INTO `sx_itemmodnames` VALUES (20, 'mpgain', 'MP Per Kill', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_itemprefixes`
-- 

DROP TABLE IF EXISTS `sx_itemprefixes`;
CREATE TABLE `sx_itemprefixes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `slotnumber` tinyint(3) unsigned NOT NULL default '0',
  `unique` tinyint(3) unsigned NOT NULL default '0',
  `willdrop` tinyint(3) unsigned NOT NULL default '0',
  `buycost` int(10) unsigned NOT NULL default '0',
  `sellcost` int(10) unsigned NOT NULL default '0',
  `reqlevel` smallint(5) unsigned NOT NULL default '0',
  `reqstrength` smallint(5) unsigned NOT NULL default '0',
  `reqdexterity` smallint(5) unsigned NOT NULL default '0',
  `reqenergy` smallint(5) unsigned NOT NULL default '0',
  `basename` varchar(50) NOT NULL default '',
  `baseattr` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_itemprefixes`
-- 

INSERT INTO `sx_itemprefixes` VALUES (1, 'Sharp', 1, 0, 0, 5, 3, 1, 0, 0, 0, 'physattack', 2);
INSERT INTO `sx_itemprefixes` VALUES (2, 'Magic', 1, 0, 0, 8, 4, 1, 0, 0, 0, 'magicattack', 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_itemsuffixes`
-- 

DROP TABLE IF EXISTS `sx_itemsuffixes`;
CREATE TABLE `sx_itemsuffixes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `slotnumber` tinyint(3) unsigned NOT NULL default '0',
  `unique` tinyint(3) unsigned NOT NULL default '0',
  `willdrop` tinyint(3) unsigned NOT NULL default '0',
  `buycost` int(10) unsigned NOT NULL default '0',
  `sellcost` int(10) unsigned NOT NULL default '0',
  `reqlevel` smallint(5) unsigned NOT NULL default '0',
  `reqstrength` smallint(5) unsigned NOT NULL default '0',
  `reqdexterity` smallint(5) unsigned NOT NULL default '0',
  `reqenergy` smallint(5) unsigned NOT NULL default '0',
  `basename` varchar(50) NOT NULL default '',
  `baseattr` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_itemsuffixes`
-- 

INSERT INTO `sx_itemsuffixes` VALUES (1, 'of the Vampire', 1, 0, 0, 5, 3, 1, 0, 0, 0, 'hpleech', 5);
INSERT INTO `sx_itemsuffixes` VALUES (2, 'of the Bear', 1, 0, 0, 5, 3, 1, 0, 0, 0, 'strength', 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_messages`
-- 

DROP TABLE IF EXISTS `sx_messages`;
CREATE TABLE `sx_messages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `postdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `senderid` int(10) unsigned NOT NULL default '0',
  `sendername` varchar(30) NOT NULL default '',
  `recipientid` int(10) unsigned NOT NULL default '0',
  `recipientname` varchar(30) NOT NULL default '',
  `status` tinyint(3) unsigned NOT NULL default '0',
  `title` varchar(200) NOT NULL default '',
  `message` text NOT NULL,
  `gold` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_messages`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_monsters`
-- 

DROP TABLE IF EXISTS `sx_monsters`;
CREATE TABLE `sx_monsters` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `world` tinyint(3) unsigned NOT NULL default '0',
  `level` smallint(5) unsigned NOT NULL default '0',
  `maxexp` int(10) unsigned NOT NULL default '0',
  `maxgold` int(10) unsigned NOT NULL default '0',
  `maxhp` smallint(5) unsigned NOT NULL default '0',
  `physattack` smallint(5) unsigned NOT NULL default '0',
  `physdefense` smallint(5) unsigned NOT NULL default '0',
  `magicattack` smallint(5) unsigned NOT NULL default '0',
  `magicdefense` smallint(5) unsigned NOT NULL default '0',
  `fireattack` smallint(5) unsigned NOT NULL default '0',
  `firedefense` smallint(5) unsigned NOT NULL default '0',
  `lightattack` smallint(5) unsigned NOT NULL default '0',
  `lightdefense` smallint(5) unsigned NOT NULL default '0',
  `spell1` smallint(5) unsigned NOT NULL default '0',
  `spell2` smallint(5) unsigned NOT NULL default '0',
  `spellimmune1` smallint(5) unsigned NOT NULL default '0',
  `spellimmune2` smallint(5) unsigned NOT NULL default '0',
  `boss` tinyint(3) unsigned NOT NULL default '0',
  `newstory` int(10) unsigned NOT NULL default '0',
  `hpleech` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_monsters`
-- 

INSERT INTO `sx_monsters` VALUES (1, 'Small Slime', 1, 1, 3, 2, 3, 5, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (2, 'Shade', 1, 1, 3, 3, 3, 5, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (3, 'Slime', 1, 2, 4, 3, 4, 7, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (4, 'Small Drake', 1, 2, 5, 4, 5, 8, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (5, 'Skeleton', 1, 3, 7, 5, 7, 12, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (6, 'Haunt', 1, 3, 8, 6, 8, 13, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (7, 'Big Slime', 1, 4, 10, 7, 10, 16, 17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (8, 'Drake', 1, 4, 11, 8, 11, 18, 17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (9, 'Ghost', 1, 5, 11, 8, 12, 19, 21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (10, 'Bee', 1, 5, 12, 9, 12, 19, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (11, 'Scorpion', 1, 6, 12, 9, 13, 21, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (12, 'Dawk', 1, 6, 15, 10, 15, 23, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (13, 'Nymph', 1, 7, 16, 11, 16, 25, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (14, 'Ember', 1, 7, 16, 11, 17, 27, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (15, 'Daydream', 1, 8, 18, 12, 18, 29, 29, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (16, 'Wasp', 1, 8, 19, 13, 20, 30, 33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (17, 'Shadow', 1, 9, 22, 16, 22, 35, 37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (18, 'Harpy', 1, 9, 22, 16, 24, 38, 39, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (19, 'Air Elemental', 1, 10, 24, 17, 26, 41, 43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (20, 'Rogue', 1, 10, 28, 19, 29, 44, 47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (21, 'Lynx', 1, 11, 31, 23, 32, 49, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (22, 'Trickster', 1, 11, 33, 25, 35, 56, 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (23, 'Goblin', 1, 12, 34, 24, 35, 56, 51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (24, 'Charmer', 1, 12, 38, 26, 38, 61, 58, 35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (25, 'Raven', 1, 13, 39, 25, 41, 62, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (26, 'Bobcat', 1, 13, 44, 29, 44, 70, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (27, 'Lycan', 1, 14, 48, 34, 48, 73, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (28, 'Fiend', 1, 14, 49, 32, 52, 81, 90, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (29, 'Liche', 1, 15, 51, 38, 56, 84, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (30, 'Dawkin', 1, 15, 54, 36, 60, 94, 104, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (31, 'Anarchist', 1, 16, 58, 45, 64, 102, 113, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (32, 'Hellcat', 1, 16, 64, 47, 68, 102, 101, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (33, 'Fallen Cherub', 1, 17, 70, 46, 72, 111, 109, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (34, 'Grey Wolf', 1, 17, 74, 54, 76, 118, 115, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (35, 'Black Bear', 1, 18, 77, 50, 80, 127, 133, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (36, 'Knight', 1, 18, 78, 58, 84, 132, 125, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (37, 'Giant', 1, 19, 84, 56, 88, 134, 128, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (38, 'Young Wyrm', 1, 19, 92, 58, 92, 145, 156, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (39, 'Lesser Devil', 1, 20, 91, 62, 96, 153, 157, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (40, 'Lesser Demon', 1, 20, 100, 68, 100, 154, 158, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (42, 'Silver Slime', 2, 1, 100, 70, 104, 165, 157, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (43, 'Apparition', 2, 1, 101, 75, 108, 162, 158, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (44, 'Phantasm', 2, 2, 101, 74, 112, 174, 164, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (45, 'Poltergeist', 2, 2, 114, 82, 116, 174, 159, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (46, 'Wraith', 2, 3, 113, 80, 120, 185, 176, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (47, 'Big Drake', 2, 3, 112, 86, 124, 186, 186, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (48, 'Illusion', 2, 4, 118, 81, 128, 198, 208, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (49, 'Dawkare', 2, 4, 130, 89, 132, 201, 206, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (50, 'Illusionist', 2, 5, 130, 85, 136, 204, 221, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (51, 'Skeleton Soldier', 2, 5, 126, 93, 140, 210, 219, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (52, 'Devil', 2, 6, 141, 101, 145, 232, 209, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (53, 'Demon', 2, 6, 150, 99, 150, 228, 210, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (54, 'Brown Bear', 2, 7, 155, 104, 155, 244, 237, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (55, 'Black Wolf', 2, 7, 151, 111, 160, 248, 248, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (56, 'Water Elemental', 2, 8, 149, 113, 165, 255, 253, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (57, 'Harridan', 2, 8, 169, 102, 170, 269, 288, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (58, 'Sylph', 2, 9, 170, 111, 175, 275, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (59, 'Orc', 2, 9, 164, 121, 180, 287, 302, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (60, 'Dawkra', 2, 10, 167, 128, 185, 296, 276, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (61, 'Shaman', 2, 10, 175, 128, 190, 295, 295, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (62, 'Cinder', 2, 11, 194, 133, 195, 309, 322, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (63, 'Yellowjacket', 2, 11, 190, 130, 200, 318, 315, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (64, 'Rogue Scorpion', 2, 12, 197, 142, 205, 324, 337, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (65, 'Magidrake', 2, 12, 202, 133, 210, 324, 347, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (66, 'Dream', 2, 13, 211, 151, 215, 342, 363, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (67, 'Ocelot', 2, 13, 198, 148, 220, 348, 328, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (68, 'Shadow Raven', 2, 14, 216, 156, 225, 342, 342, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (69, 'Knave', 2, 14, 217, 141, 230, 357, 329, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (70, 'Lycanthor', 2, 15, 217, 165, 235, 365, 362, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (71, 'Mirage', 2, 15, 236, 168, 240, 384, 369, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (72, 'Magician', 2, 16, 236, 152, 245, 378, 401, 160, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (73, 'Mace Knight', 2, 16, 250, 150, 250, 380, 392, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (74, 'Lesser Wyvern', 2, 17, 245, 169, 255, 408, 380, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (75, 'Serafiend', 2, 17, 245, 156, 260, 409, 397, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (76, 'Zhora''s Follower', 2, 18, 255, 183, 265, 422, 389, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (77, 'Zhora''s Cantor', 2, 18, 268, 181, 270, 416, 425, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (78, 'Liche Captain', 2, 19, 267, 176, 275, 421, 455, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (79, 'Leviathan', 2, 19, 278, 188, 280, 448, 462, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (80, 'Renegade', 2, 20, 268, 177, 285, 445, 450, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (81, 'Dark Slime', 3, 1, 270, 195, 290, 456, 429, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (82, 'Phantom', 3, 1, 287, 180, 295, 470, 513, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (83, 'Spirit', 3, 2, 291, 204, 300, 474, 512, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (84, 'Specter', 3, 2, 292, 209, 307, 476, 505, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (85, 'Winged Drake', 3, 3, 299, 189, 314, 484, 523, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (86, 'Shimmer', 3, 3, 312, 196, 321, 498, 459, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (87, 'Dawkor', 3, 4, 319, 197, 328, 515, 546, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (88, 'Enchanter', 3, 4, 312, 201, 335, 530, 546, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (89, 'Mounted Skeleton', 3, 5, 336, 209, 342, 548, 565, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (90, 'Greater Devil', 3, 5, 336, 224, 349, 559, 571, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (91, 'Greater Demon', 3, 6, 346, 235, 356, 542, 526, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (92, 'Polar Bear', 3, 6, 331, 236, 363, 581, 541, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (93, 'Red Wolf', 3, 7, 352, 259, 370, 589, 631, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (94, 'Earth Elemental', 3, 7, 351, 261, 377, 581, 628, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (95, 'Ogress', 3, 8, 377, 231, 384, 603, 664, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (96, 'Nisse', 3, 8, 360, 262, 391, 607, 559, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (97, 'Troll', 3, 9, 359, 251, 398, 613, 613, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (98, 'Wizard', 3, 9, 377, 252, 405, 628, 679, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (99, 'Fire', 3, 10, 396, 252, 412, 631, 581, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (100, 'Hornet', 3, 10, 407, 260, 419, 650, 618, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (101, 'Red Scorpion', 3, 11, 409, 256, 426, 678, 678, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (102, 'Hallucination', 3, 11, 403, 269, 433, 676, 676, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (103, 'Leopard', 3, 12, 432, 295, 440, 687, 687, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (104, 'Frost Raven', 3, 12, 421, 273, 447, 698, 671, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (105, 'Scoundrel', 3, 13, 441, 296, 454, 691, 761, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (106, 'Fallen Muse', 3, 13, 448, 314, 461, 706, 650, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (107, 'Snow Leopard', 3, 14, 431, 286, 468, 745, 760, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (108, 'Lycanthra', 3, 14, 452, 323, 475, 713, 671, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (109, 'Axe Knight', 3, 15, 454, 328, 482, 767, 775, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (110, 'Cheetah', 3, 15, 460, 313, 489, 783, 729, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (111, 'Wyvern', 3, 16, 477, 333, 496, 774, 744, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (112, 'Cherufiend', 3, 16, 478, 322, 503, 755, 725, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (113, 'Zhora''s Advocate', 3, 17, 485, 342, 510, 781, 750, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (114, 'Zhora''s Elder', 3, 17, 497, 362, 517, 786, 779, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (115, 'Liche Prince', 3, 18, 524, 367, 524, 813, 757, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (116, 'Behemoth', 3, 18, 505, 319, 531, 829, 788, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (117, 'Insurgent', 3, 19, 517, 350, 538, 818, 761, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (118, 'Greater Wyvern', 3, 20, 491, 371, 545, 834, 901, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (119, 'Devil Lord', 4, 1, 500, 339, 555, 866, 841, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (120, 'Demon Lord', 4, 1, 565, 390, 565, 888, 906, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (121, 'Grizzly Bear', 4, 2, 547, 368, 575, 880, 863, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (122, 'Arctic Wolf', 4, 2, 580, 369, 585, 884, 805, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (123, 'Fire Elemental', 4, 3, 548, 381, 595, 947, 919, 0, 0, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (124, 'Gorgon', 4, 3, 575, 382, 605, 920, 865, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (125, 'Enchantress', 4, 4, 560, 369, 615, 984, 1014, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (126, 'Ogre', 4, 4, 588, 432, 625, 938, 845, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (127, 'Sorcerer', 4, 5, 610, 445, 635, 991, 932, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (128, 'Blaze', 4, 5, 607, 400, 645, 968, 1056, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (129, 'Demon Hornet', 4, 6, 629, 413, 655, 1009, 1090, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (130, 'Silver Scorpion', 4, 6, 626, 433, 665, 1045, 1045, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (131, 'Torment', 4, 7, 648, 459, 675, 1020, 1020, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (132, 'Fire Raven', 4, 7, 651, 439, 685, 1090, 1178, 0, 0, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (133, 'Hellion', 4, 8, 640, 480, 695, 1085, 1064, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (134, 'Fallen Angel', 4, 8, 642, 459, 705, 1058, 1037, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (135, 'Werewolf', 4, 9, 673, 444, 715, 1130, 1130, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (136, 'Armored Knight', 4, 9, 667, 464, 725, 1153, 1130, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (137, 'Archfiend', 4, 10, 684, 486, 735, 1140, 1220, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (138, 'Zhora''s Fanatic', 4, 10, 686, 515, 745, 1192, 1145, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (139, 'Zhora''s Priest', 4, 11, 718, 529, 755, 1156, 1099, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (140, 'Liche King', 4, 11, 765, 490, 765, 1224, 1114, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (141, 'Colossus', 4, 12, 706, 473, 775, 1194, 1159, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (142, 'Nihilist', 4, 12, 785, 534, 785, 1202, 1178, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (143, 'Armored Skeleton', 4, 13, 795, 501, 795, 1209, 1197, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (144, 'Puma', 4, 13, 749, 556, 805, 1248, 1211, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (145, 'Devil King', 4, 14, 758, 563, 815, 1304, 1239, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (146, 'Demon King', 4, 14, 751, 545, 825, 1246, 1271, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (147, 'Kodiak Bear', 4, 15, 810, 568, 835, 1320, 1360, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (148, 'Haunted Wolf', 4, 15, 829, 507, 845, 1352, 1285, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (149, 'Light Elemental', 4, 16, 830, 590, 855, 1368, 1396, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (150, 'Medusa', 4, 16, 831, 597, 865, 1384, 1495, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (151, 'Siren', 4, 17, 797, 525, 875, 1400, 1400, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (152, 'Uruk', 4, 17, 868, 611, 885, 1381, 1492, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (153, 'Warlock', 4, 18, 851, 627, 895, 1343, 1249, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (154, 'Jaguar', 4, 18, 869, 589, 905, 1394, 1436, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (155, 'Necromancer', 4, 19, 842, 577, 915, 1373, 1470, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (156, 'Demagogue', 4, 19, 833, 555, 925, 1434, 1320, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (157, 'Titan', 4, 20, 917, 571, 935, 1403, 1263, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (158, 'Lion', 4, 20, 870, 577, 945, 1512, 1603, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (159, 'Pyre', 5, 1, 941, 596, 960, 1460, 1606, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (160, 'Figment', 5, 1, 975, 644, 975, 1560, 1701, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (161, 'Demon Scorpion', 5, 1, 981, 674, 990, 1505, 1611, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (162, 'Nightmare', 5, 2, 945, 674, 1005, 1558, 1403, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (163, 'Silver Raven', 5, 2, 929, 684, 1020, 1632, 1600, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (164, 'Bandit', 5, 2, 932, 621, 1035, 1553, 1398, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (165, 'Fallen Archangel', 5, 3, 966, 672, 1050, 1607, 1511, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (166, 'Tiger', 5, 3, 1044, 693, 1065, 1704, 1773, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (167, 'Fallen Seraph', 5, 3, 1070, 670, 1080, 1696, 1595, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (168, 'Werebear', 5, 4, 1095, 657, 1095, 1698, 1648, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (169, 'Demon Knight', 5, 4, 1110, 700, 1110, 1754, 1912, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (170, 'Magic Wyvern', 5, 4, 1125, 720, 1125, 1789, 1754, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (171, 'Fiendlord', 5, 5, 1026, 764, 1140, 1767, 1927, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (172, 'Zhora''s Zealot', 5, 5, 1144, 740, 1155, 1802, 1983, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (173, 'Zhora''s Bishop', 5, 6, 1135, 726, 1170, 1755, 1633, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (174, 'Liche Lord', 5, 6, 1150, 783, 1185, 1825, 1698, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (175, 'Fire Wyvern', 5, 7, 1176, 756, 1200, 1800, 1872, 0, 0, 1500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (176, 'Zhora''s Obsessive', 5, 7, 1094, 851, 1215, 1920, 1882, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (177, 'Zhora''s Archbishop', 5, 8, 1194, 861, 1230, 1907, 1736, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (178, 'Grey Daemon', 5, 8, 1196, 810, 1245, 1968, 2047, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (179, 'Hellhound', 5, 9, 1248, 832, 1260, 1941, 1883, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (180, 'Great Wyrm', 5, 9, 1250, 765, 1275, 2002, 2183, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (181, 'Green Dragon', 5, 10, 1252, 787, 1290, 1987, 1809, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (182, 'Red Daemon', 5, 10, 1214, 823, 1305, 2023, 2125, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (183, 'Hellbeast', 5, 11, 1281, 911, 1320, 2086, 2024, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (184, 'Frost Wyrm', 5, 11, 1269, 801, 1335, 2136, 2286, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (185, 'Blue Dragon', 5, 12, 1229, 851, 1350, 2106, 2296, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (186, 'Dark Daemon', 5, 12, 1229, 888, 1365, 2144, 1973, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (187, 'Hellbear', 5, 13, 1353, 966, 1380, 2195, 2020, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (188, 'Red Wyrm', 5, 13, 1270, 921, 1395, 2107, 2150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (189, 'Red Dragon', 5, 14, 1368, 875, 1410, 2242, 2310, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (190, 'Black Daemon', 5, 14, 1326, 984, 1425, 2138, 1946, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (191, 'Hellwolf', 5, 15, 1397, 908, 1440, 2204, 2359, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (192, 'Blue Wyrm', 5, 15, 1383, 1004, 1455, 2212, 2257, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (193, 'Dark Dragon', 5, 16, 1323, 941, 1470, 2323, 2207, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (194, 'Fallen Dragon', 5, 16, 1382, 981, 1485, 2317, 2503, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (195, 'Shadow Dragon', 5, 17, 1440, 1005, 1500, 2355, 2214, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (196, 'Black Dragon', 5, 17, 1409, 970, 1515, 2349, 2443, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (197, 'Ancient Dragon', 5, 18, 1500, 980, 1530, 2418, 2660, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (198, 'False Dragon', 5, 18, 1545, 1020, 1545, 2333, 2124, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (199, 'Daemonlord', 5, 19, 1420, 1092, 1560, 2372, 2230, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (200, 'Dragonlord', 5, 20, 1497, 1024, 1575, 2410, 2555, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (201, 'Razora', 1, 99, 150, 60, 120, 192, 189, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3, 0);
INSERT INTO `sx_monsters` VALUES (202, 'Numoren', 2, 99, 300, 300, 300, 453, 499, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6, 0);
INSERT INTO `sx_monsters` VALUES (203, 'Crestfall', 3, 99, 800, 1000, 500, 755, 808, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 9, 0);
INSERT INTO `sx_monsters` VALUES (204, 'Lucifuge''s Throneguard', 4, 99, 200, 300, 700, 1064, 958, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 12, 0);
INSERT INTO `sx_monsters` VALUES (205, 'Lucifuge', 4, 99, 1500, 1500, 850, 1318, 1358, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 13, 0);
INSERT INTO `sx_monsters` VALUES (206, 'Xiran''s Minion', 5, 99, 500, 400, 1200, 1908, 1928, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 16, 0);
INSERT INTO `sx_monsters` VALUES (207, 'Xiran''s Cardinal', 5, 99, 750, 750, 1300, 1976, 1917, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 17, 0);
INSERT INTO `sx_monsters` VALUES (208, 'Xiran', 5, 99, 1000, 1000, 1400, 2128, 2150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 18, 0);
INSERT INTO `sx_monsters` VALUES (209, 'Xiran', 5, 99, 5000, 5000, 1600, 2528, 2478, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 19, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_pvp`
-- 

DROP TABLE IF EXISTS `sx_pvp`;
CREATE TABLE `sx_pvp` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `player1id` int(10) unsigned NOT NULL default '0',
  `player2id` int(10) unsigned NOT NULL default '0',
  `player1name` varchar(30) NOT NULL default '',
  `player2name` varchar(30) NOT NULL default '',
  `playerturn` int(10) unsigned NOT NULL default '0',
  `accepted` tinyint(3) unsigned NOT NULL default '0',
  `turntime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `fightrow` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_pvp`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_spells`
-- 

DROP TABLE IF EXISTS `sx_spells`;
CREATE TABLE `sx_spells` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `fname` varchar(30) NOT NULL default '',
  `value` int(10) unsigned NOT NULL default '0',
  `mp` int(10) unsigned NOT NULL default '0',
  `minlevel` int(10) unsigned NOT NULL default '0',
  `classonly` int(10) unsigned NOT NULL default '0',
  `classexclude` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_spells`
-- 

INSERT INTO `sx_spells` VALUES (1, 'Heal 1', 'heal', 5, 2, 5, 2, 0);
INSERT INTO `sx_spells` VALUES (2, 'Heal 2', 'heal', 10, 5, 10, 0, 0);
INSERT INTO `sx_spells` VALUES (3, 'Heal 3', 'heal', 20, 10, 15, 0, 0);
INSERT INTO `sx_spells` VALUES (4, 'Heal 4', 'heal', 30, 15, 20, 0, 0);
INSERT INTO `sx_spells` VALUES (5, 'Heal 5', 'heal', 45, 25, 25, 0, 0);
INSERT INTO `sx_spells` VALUES (6, 'Heal 6', 'heal', 60, 35, 30, 0, 0);
INSERT INTO `sx_spells` VALUES (7, 'Heal 7', 'heal', 80, 50, 35, 3, 0);
INSERT INTO `sx_spells` VALUES (8, 'Heal 8', 'heal', 100, 75, 40, 3, 0);
INSERT INTO `sx_spells` VALUES (9, 'Heal 9', 'heal', 150, 100, 45, 3, 0);
INSERT INTO `sx_spells` VALUES (10, 'Heal 10', 'heal', 200, 150, 50, 3, 0);
INSERT INTO `sx_spells` VALUES (11, 'Hurt 1', 'hurt', 5, 2, 5, 0, 0);
INSERT INTO `sx_spells` VALUES (12, 'Hurt 2', 'hurt', 10, 5, 10, 0, 0);
INSERT INTO `sx_spells` VALUES (13, 'Hurt 3', 'hurt', 15, 7, 15, 0, 0);
INSERT INTO `sx_spells` VALUES (14, 'Hurt 4', 'hurt', 25, 12, 20, 0, 0);
INSERT INTO `sx_spells` VALUES (15, 'Hurt 5', 'hurt', 35, 20, 25, 0, 0);
INSERT INTO `sx_spells` VALUES (16, 'Hurt 6', 'hurt', 50, 30, 30, 0, 0);
INSERT INTO `sx_spells` VALUES (17, 'Hurt 7', 'hurt', 65, 40, 35, 3, 0);
INSERT INTO `sx_spells` VALUES (18, 'Hurt 8', 'hurt', 85, 50, 40, 3, 0);
INSERT INTO `sx_spells` VALUES (19, 'Hurt 9', 'hurt', 105, 65, 45, 3, 0);
INSERT INTO `sx_spells` VALUES (20, 'Hurt 10', 'hurt', 130, 80, 50, 3, 0);
INSERT INTO `sx_spells` VALUES (21, 'Sleep 1', 'sleep', 80, 20, 10, 0, 0);
INSERT INTO `sx_spells` VALUES (22, 'Sleep 2', 'sleep', 60, 35, 20, 0, 0);
INSERT INTO `sx_spells` VALUES (23, 'Sleep 3', 'sleep', 40, 50, 30, 2, 0);
INSERT INTO `sx_spells` VALUES (24, 'Sleep 4', 'sleep', 20, 75, 40, 2, 0);
INSERT INTO `sx_spells` VALUES (25, 'Sleep 5', 'sleep', 5, 100, 50, 2, 0);
INSERT INTO `sx_spells` VALUES (26, 'Fire 1', 'fire', 5, 2, 5, 0, 0);
INSERT INTO `sx_spells` VALUES (27, 'Fire 2', 'fire', 10, 5, 10, 0, 0);
INSERT INTO `sx_spells` VALUES (28, 'Fire 3', 'fire', 15, 7, 15, 0, 0);
INSERT INTO `sx_spells` VALUES (29, 'Fire 4', 'fire', 25, 12, 20, 0, 0);
INSERT INTO `sx_spells` VALUES (30, 'Fire 5', 'fire', 35, 20, 25, 0, 0);
INSERT INTO `sx_spells` VALUES (31, 'Fire 6', 'fire', 50, 30, 30, 0, 0);
INSERT INTO `sx_spells` VALUES (32, 'Fire 7', 'fire', 65, 40, 35, 2, 0);
INSERT INTO `sx_spells` VALUES (33, 'Fire 8', 'fire', 85, 50, 40, 2, 0);
INSERT INTO `sx_spells` VALUES (34, 'Fire 9', 'fire', 105, 65, 45, 2, 0);
INSERT INTO `sx_spells` VALUES (35, 'Fire 10', 'fire', 130, 80, 50, 2, 0);
INSERT INTO `sx_spells` VALUES (36, 'Lightning 1', 'light', 5, 2, 5, 0, 0);
INSERT INTO `sx_spells` VALUES (37, 'Lightning 2', 'light', 10, 5, 10, 0, 0);
INSERT INTO `sx_spells` VALUES (38, 'Lightning 3', 'light', 15, 7, 15, 0, 0);
INSERT INTO `sx_spells` VALUES (39, 'Lightning 4', 'light', 25, 12, 20, 0, 0);
INSERT INTO `sx_spells` VALUES (40, 'Lightning 5', 'light', 35, 20, 25, 0, 0);
INSERT INTO `sx_spells` VALUES (41, 'Lightning 6', 'light', 50, 30, 30, 0, 0);
INSERT INTO `sx_spells` VALUES (42, 'Lightning 7', 'light', 65, 40, 35, 2, 0);
INSERT INTO `sx_spells` VALUES (43, 'Lightning 8', 'light', 85, 50, 40, 2, 0);
INSERT INTO `sx_spells` VALUES (44, 'Lightning 9', 'light', 105, 65, 45, 2, 0);
INSERT INTO `sx_spells` VALUES (45, 'Lightning 10', 'light', 130, 80, 50, 2, 0);
INSERT INTO `sx_spells` VALUES (46, 'Prismatic Blast 1', 'prism', 2, 2, 5, 0, 0);
INSERT INTO `sx_spells` VALUES (47, 'Prismatic Blast 2', 'prism', 5, 5, 10, 0, 0);
INSERT INTO `sx_spells` VALUES (48, 'Prismatic Blast 3', 'prism', 10, 7, 15, 0, 0);
INSERT INTO `sx_spells` VALUES (49, 'Prismatic Blast 4', 'prism', 15, 12, 20, 0, 0);
INSERT INTO `sx_spells` VALUES (50, 'Prismatic Blast 5', 'prism', 15, 20, 25, 0, 0);
INSERT INTO `sx_spells` VALUES (51, 'Prismatic Blast 6', 'prism', 20, 30, 30, 0, 0);
INSERT INTO `sx_spells` VALUES (52, 'Prismatic Blast 7', 'prism', 25, 40, 35, 0, 1);
INSERT INTO `sx_spells` VALUES (53, 'Prismatic Blast 8', 'prism', 30, 50, 40, 0, 1);
INSERT INTO `sx_spells` VALUES (54, 'Prismatic Blast 9', 'prism', 35, 65, 45, 0, 1);
INSERT INTO `sx_spells` VALUES (55, 'Prismatic Blast 10', 'prism', 40, 80, 50, 0, 1);
INSERT INTO `sx_spells` VALUES (56, 'Stone Skin 1', 'stone', 5, 10, 10, 1, 0);
INSERT INTO `sx_spells` VALUES (57, 'Stone Skin 2', 'stone', 10, 20, 20, 1, 0);
INSERT INTO `sx_spells` VALUES (58, 'Stone Skin 3', 'stone', 20, 30, 30, 1, 0);
INSERT INTO `sx_spells` VALUES (59, 'Stone Skin 4', 'stone', 35, 40, 40, 1, 0);
INSERT INTO `sx_spells` VALUES (60, 'Stone Skin 5', 'stone', 50, 50, 50, 1, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_story`
-- 

DROP TABLE IF EXISTS `sx_story`;
CREATE TABLE `sx_story` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` text NOT NULL,
  `story` text NOT NULL,
  `world` int(10) unsigned NOT NULL default '0',
  `latitude` smallint(6) NOT NULL default '0',
  `longitude` smallint(6) NOT NULL default '0',
  `nextstory` int(10) unsigned NOT NULL default '0',
  `targetmonster` int(10) unsigned NOT NULL default '0',
  `targetitem` varchar(10) NOT NULL default '',
  `targetworld` int(10) unsigned NOT NULL default '0',
  `targetlat` smallint(6) NOT NULL default '0',
  `targetlon` smallint(6) NOT NULL default '0',
  `targetaction` varchar(30) NOT NULL default '',
  `rewardname` varchar(30) NOT NULL default '',
  `rewardattr` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_story`
-- 

INSERT INTO `sx_story` VALUES (1, 'Prologue', 'The light has forsaken this land, and not for the first time. Centuries ago, it was overrun by darkness and then saved by a hero whose lifelong quest was to eradicate evil. The hero succeeded, and in the end, Lucifuge, King of the Dragons, was destroyed... at least for the time being. In the many long years since that time, Lucifuge has been gathering his forces and his power, and has finally regained enough of his former strength to return.\r\n\r\nSo the land is once again in need of a saviour. It will be no easy task, dear adventurer. In the last age, Lucifuge and his minions controlled but a small country. This time, he has sent his forces to sow chaos and darkness throughout the world. Only a brave adventurer will be able to conquer him and restore peace and order to the world.\r\n\r\nContinue on, dear adventurer. You shall be tested dearly, but the rewards will be great.', 1, 0, 0, 2, 0, '', 1, 0, 0, 'In Town', '', 0);
INSERT INTO `sx_story` VALUES (2, 'Queen of Demons', 'You come to a great stone door, with the inscription ''RAZORA'' carved in the Language of the Fallen. Next to the door lie the skeletons of several dead warriors who failed to enter. One of the skeletons is holding a scrap of paper, which reads:\r\n\r\n"We finally made it. The legends are true, Razora does exist. As I write this, we are standing outside the demon queen''s throneroom. Something is following us, though, and has been for several days. We''re making camp tonight, and we''ll head inside in the morning. After the months of travelling, we definitely need our rest if we''re really preparing to face Razora. We''ve survived this far, surely whatever is following us will hold off one more night..."\r\n\r\nYou are now faced with a choice, dear adventurer. Are you ready to face the demon queen Razora, or do you still need more preparation?', 1, 100, -100, 0, 201, '', 0, 0, 0, 'Fighting', '', 0);
INSERT INTO `sx_story` VALUES (3, 'Fallen Queen', 'Razora, the Demon Queen, lies dead at your feet. Even now, her body and all the black blood spilled from it are melting away into the nether. Soon, all that''s left is her heart, which you take with you as proof that you destroyed her.\r\n\r\nOne section of the wall crumbles and falls, and leads to a doorway, guarded by a large statue of an angel. In the angel''s hand is a sword with flames engraved in the blade.\r\n\r\nIt wouldn''t be too much trouble to take the sword, and it does seem like your right to take it, after all the trouble you went through to kill Razora. You can now take the sword and continue through the doorway, or just continue on without it.', 1, 100, -100, 4, 0, '0,170,0', 2, 0, 0, 'Exploring', 'maxhp', 50);
INSERT INTO `sx_story` VALUES (4, 'Shirreh''s Door', 'As you step through the doorway, you have a momentary feeling of the ground being swept out beneath you. Then you are surrounded by light, and you enter a new town. The townsfolk, surprised at your sudden entry through a door that has never been opened, quickly inform you of the legend surrounding the door.\r\n\r\nIt was created by the archangel Shirreh, as a path between this land and the last you were in. Shirreh made the door so that whoever did eventually destroy Razora would be able to travel here and attempt to defeat Numoren, the demon who was given dominion over this land by Lucifuge.\r\n\r\nIt''s time to continue on, dear adventurer. You did well in the last land, but a new evil awaits you here. One small dirt path leads out of town and into the dense jungle.', 2, 0, 0, 5, 0, '', 0, 0, 0, 'In Town', '', 0);
INSERT INTO `sx_story` VALUES (5, 'Numoren''s Portal', 'Deep in the heart of the jungles that cover this land, you come to a clearing. In the center of the clearing are two large upright stones, with one more stone on top. You walk around it, and looking through the doorway from one side only shows the other side of the clearing. But looking through it from the other side shows a dark hallway.\r\n\r\nWould you like to step through the magic doorway into the hall, or would you like some more time to get ready for this battle?', 2, 100, 100, 0, 202, '', 0, 0, 0, 'Fighting', '', 0);
INSERT INTO `sx_story` VALUES (6, 'Numoren''s Ring', 'Numoren has fallen at your hand, and this land is safe. Shirreh''s second door, identical to the first except for the rune carvings at the top of the frame, appears in a wall behind you.\r\n\r\nAs Numoren''s body disappears in a puff of smoke, you hear a small jingling sound and notice a gold ring falling to the ground. Numoren''s ring glows and you can almost hear it calling your name.\r\n\r\nWould you like to pick up the ring, dear adventurer?', 2, 100, 100, 7, 0, '0,171,0', 3, 0, 0, '', 'goldbonus', 5);
INSERT INTO `sx_story` VALUES (7, 'Forsaken Land', 'You step through Shirreh''s second door, and again feel the ground fall away for a few seconds. You come out of the darkness into a land even stranger than the last two. The sky is filled with dark storm clouds, but the clouds are a discomforting red color. The ground and trees are all bare. You are standing in what apparently used to be a town, but it''s completely deserted, and looks as if it has been for a long time.\r\n\r\nTwo signs hang from a tree nearby the doorway you came through. The first, which appears to be the only thing in town with a somewhat fresh coat of paint, points east and reads "Fort Kayne - 2 Miles."\r\n\r\nThe second is less friendly: "BEWARE CRESTFALL"', 3, 0, 0, 8, 0, '', 0, 0, 0, 'Exploring', '', 0);
INSERT INTO `sx_story` VALUES (8, 'Lord of Plague', 'So much for killing Lucifuge any time soon. Now you have to deal with Crestfall. The castle you''ve seen from a distance looked ominous before, but now that you''re up close, it''s even worse. Skeletons of fallen warriors are hanging on crosses in the courtyard - these are the first signs of actual human "life" you''ve seen since you came through Shirreh''s door. All the bare and stunted trees are covered with flocks of ravens.\r\n\r\n"LORD OF PLAGUE" is carved in the stone above the gateway into the courtyard. With so much already accomplished, and Lucifuge still somewhere ahead of you, you have no other choice now, dear adventurer.', 3, -100, -100, 0, 203, '', 0, 0, 0, 'Fighting', '', 0);
INSERT INTO `sx_story` VALUES (9, 'Bellerophon', 'Crestfall, the mortally-wounded Lord of Plague, lies writhing at your feet, and you are rather enjoying watching his throes of agony. As of yet, he has not exactly died, but instead he seems to... age... somehow. His skin is drying up and wrinkling, his hair is falling out, and before long all that''s left is a crusty old skeleton surrounded by a brilliantly gleaming chainmail coat.\r\n\r\nShirreh''s third door appears, but this time you can read the runes carved on it. And you don''t really like what the runes say.\r\n\r\nABANDON HOPE, ALL YE WHO ENTER HERE', 3, -100, -100, 10, 0, '0,172,0', 4, 0, 0, '', 'strength', 50);
INSERT INTO `sx_story` VALUES (10, 'Inferno', 'The last land was weird. This land is... spooky. You find yourself in the middle of a desert. The dark red clouds still cover the sky, but now the dry and cracked ground is also red. The exact same color as blood. Everywhere, you can see little vents of steam drifting up from the ground. Whoever - or whatever - created this place must not have much need for decoration. Other than the steam vents, the landscape is completely flat and featureless for miles around.\r\n\r\nOne nice thing about the land being so featureless is that you''ll at least be able to see your enemies long before they ever actually get close enough to do any damage.\r\n\r\nWith nothing but a vague feeling that you should probably head south, you decide not to stick around and wait for something to try eating you for breakfast.', 4, 0, 0, 11, 0, '', 0, 0, 0, 'Exploring', '', 0);
INSERT INTO `sx_story` VALUES (11, 'Welcome To My Parlor', 'At long last, you''ve made it. Lucifuge''s mountain fortress is all that stands between you and world peace. The huge black gates swing open, awating your entry, before you even arrive. No sunlight penetrates into the courtyard, even though you can''t see anything really blocking it out. The only light inside seems to be coming directly from the great stone gargoyle statue in the center.\r\n\r\nBut as you get closer, the stone gargoyle stands up and turns around.\r\n\r\n"Greetings, human. Lucifuge has been expecting you. He doesn''t really like to be bothered, though, so I''m here to take care of you."', 4, -100, 100, 0, 204, '', 0, 0, 0, 'Fighting', '', 0);
INSERT INTO `sx_story` VALUES (12, 'Throneguard''s Demise', 'The throneguard screams, and falls. From deep in the bowels of the fortress, you hear a roar so loud that even the ground is shaking beneath you.\r\n\r\nYou have nowhere left to go but inside the fortress, and you''ve come too far to give up now.', 4, -100, 100, 0, 205, '', 0, 0, 0, 'Fighting', '', 0);
INSERT INTO `sx_story` VALUES (13, 'The Light Restored', 'Lucifuge, the overlord of all the evil that has destroyed this land, lies vanquished at your feet. You take his heart, still warm and dripping with his black blood, and put it in your pack, next to the one you already took from Razora.\r\n\r\nYou can''t help but be mildly disturbed by the last words uttered by Lucifuge before he died, though...\r\n\r\n"But... Xiran said it wouldn''t be like this."', 4, -100, 100, 14, 0, '', 5, 0, 0, '', 'dexterity', 50);
INSERT INTO `sx_story` VALUES (14, 'The Blacklands', 'Just as you''re catching your breath, the fortress starts to shake and the floor crumbles beneath you. You fall for what seems like an eternity, until finally landing in yet another place. The ground and sky are both black. This land, like the last, is also dotted with little vents in the ground - here, though, the vents spout fire instead of steam. And it''s a good thing, too, because in this place there is no sun. The fire vents are your only source of light. Thankfully the place where you fell is only a short distance from what looks like a town.\r\n\r\nAs you enter the place, which the sign out front identifies as simply "Outpost 5," the guards tell you just what you''ve been waiting for: your quest isn''t over.\r\n\r\n"Lucifuge was Xiran''s highest ranking general. But he was still only second in command. Xiran himself is locked in his ice prison, Dreadguard, to the north. Shirreh banished him there ages ago, and throughout the centuries these outposts have served as guard stations to make sure he doesn''t escape. But now through the work of Lucifuge, Xiran could regain enough of his strength to escape the prison and destroy the world. You must hurry, traveller. Your only chance at killing Xiran rests on getting there while Xiran is still chained down."', 5, 0, 0, 15, 0, '', 0, 0, 0, 'In Town', '', 0);
INSERT INTO `sx_story` VALUES (15, 'Xiran''s Minion', 'The ice prison Dreadguard looms tall and white before you. In an odd little twist that seems to defy all logic, more of the fire vents seem to be coming straight out of the ice.\r\n\r\nAs you come close to the prison, a large beast strides out towards you. The beast has the body of a man, but the head of a snake, and wings like a bat.\r\n\r\nJust before drawing its sword and preparing to fight, the beast calls out a warning: "Take heed, hero, you now come to the palace of Xiran, and it shall not fall quietly. Better souls than yours now inhabit this place, and Xiran takes pleasure in their eternal torment."', 5, 100, 100, 0, 206, '', 0, 0, 0, 'Fighting', '', 0);
INSERT INTO `sx_story` VALUES (16, 'Xiran''s Cardinal', 'As the minion falls, another figure steps out of the darkness. This one looks like a man, a plain ordinary man. The Cardinal, highest among all the mortals who worship Xiran, wears only a plain black cloak, and carries nothing more than a walking stick.\r\n\r\nSurely it can''t be this easy...', 5, 100, 100, 0, 207, '', 0, 0, 0, 'Fighting', '', 0);
INSERT INTO `sx_story` VALUES (17, 'The Demon God', 'With both the minion and the Cardinal slain, you enter the prison. The entire building seems to be one huge room, and in the very center of it is the demon god, Xiran. He looks something like a man, except he is about twenty feet tall and covered with black scales. Two horns are coming out of his head, and his eyes are bright red. His arms are stretched out, held by massive chains to the walls. But despite the obvious pain this is causing him, he seems to be smiling at you.\r\n\r\n"Welcome, mortal. I''m glad you''ve come, for it is you who shall set me free."', 5, 100, 100, 0, 208, '', 0, 0, 0, 'Fighting', '', 0);
INSERT INTO `sx_story` VALUES (18, 'Bonds Broken', 'After a great battle, Xiran finally sags down as far as the chains will stretch. The red light from his eyes dims and goes out. You listen closely, and the beating from his huge heart slows and finally stops altogether.\r\n\r\nSuddenly the temperature drops, and the huge chains holding Xiran''s lifeless body get frosty with ice crystals. Then you see the chains glowing beneath the layer of ice, and with a thunderous crack, the shackles break and fall away from Xiran''s hands.\r\n\r\nImmediately his eyes flash, and almost before you can blink, Xiran has lept into the air and a great sword has appeared in his hands.\r\n\r\n"See, mortal! I told you I would be freed. You should have left well enough alone in matters that did not concern you. You''ve come so far, it will be such a shame to have to kill you now."', 5, 100, 100, 0, 209, '', 0, 0, 0, 'Fighting', 'energy', 50);
INSERT INTO `sx_story` VALUES (19, 'Epilogue', 'With one final triumphant swing, you pierce Xiran''s heart and immediately your weapon disintegrates in front of your eyes. Xiran falls to the ground, and as the walls of the ice prison are falling down around you, Xiran''s body bursts into flames and is utterly consumed in seconds, leaving only a pile of ash on the floor.\r\n\r\nHis sword, though, remains unscathed by the fire, so as you are looking for the quickest way out of the crumbling building, you grab it and sling it over your shoulder. It''s only fair, after all, since the demon god''s heart took your own weapon away from you.\r\n\r\nYou make your way back to the last outpost, and the entire population has come out to see you. After many long ages, the dreadful task of awating Xiran''s escape has been lifted from their shoulders.\r\n\r\nNow that you''ve finally saved the world, you can''t wait to have a drink...\r\n\r\nThe End', 5, 100, 100, 20, 0, '0,173,0', 0, 0, 0, '', '', 0);
INSERT INTO `sx_story` VALUES (20, 'Fin', 'You have now beat the game and have been added to the Scroll of Heroes.  You may continue playing if you want, or of course you could also take a well-deserved rest. Thank you for playing, and we hope you''ve enjoyed it.', 5, 100, 100, 9999, 0, '', 0, 0, 0, '', '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_towns`
-- 

DROP TABLE IF EXISTS `sx_towns`;
CREATE TABLE `sx_towns` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `world` tinyint(3) unsigned NOT NULL default '0',
  `latitude` smallint(6) NOT NULL default '0',
  `longitude` smallint(6) NOT NULL default '0',
  `innprice` int(10) unsigned NOT NULL default '0',
  `mapprice` int(10) unsigned NOT NULL default '0',
  `travelpoints` smallint(5) unsigned NOT NULL default '0',
  `itemminlvl` int(10) unsigned NOT NULL default '0',
  `itemmaxlvl` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_towns`
-- 

INSERT INTO `sx_towns` VALUES (1, 'Middleton', 1, 0, 0, 5, 0, 0, 1, 5);
INSERT INTO `sx_towns` VALUES (2, 'Norfolk', 1, 25, 25, 10, 25, 5, 3, 8);
INSERT INTO `sx_towns` VALUES (3, 'Calentia', 1, 50, -50, 25, 50, 15, 6, 11);
INSERT INTO `sx_towns` VALUES (4, 'Resmark', 1, -75, 75, 40, 100, 30, 9, 14);
INSERT INTO `sx_towns` VALUES (5, 'Erdricksburg', 1, 99, 99, 60, 500, 50, 12, 17);
INSERT INTO `sx_towns` VALUES (6, 'Lorensgaard', 2, 0, 0, 75, 0, 40, 15, 20);
INSERT INTO `sx_towns` VALUES (7, 'Nailes', 2, 17, -23, 100, 150, 55, 18, 23);
INSERT INTO `sx_towns` VALUES (8, 'Nostrum', 2, 46, 33, 150, 300, 70, 21, 27);
INSERT INTO `sx_towns` VALUES (9, 'Vauderellin', 2, -70, 65, 200, 500, 85, 24, 30);
INSERT INTO `sx_towns` VALUES (10, 'Underwood', 2, -95, -95, 250, 750, 90, 27, 33);
INSERT INTO `sx_towns` VALUES (11, 'Fort Kayne', 3, 0, 2, 200, 0, 75, 30, 36);
INSERT INTO `sx_towns` VALUES (12, 'Fort Minor', 3, -20, -25, 250, 800, 100, 33, 40);
INSERT INTO `sx_towns` VALUES (13, 'Fort Oligard', 3, 48, 37, 300, 1000, 125, 37, 44);
INSERT INTO `sx_towns` VALUES (14, 'Fort Wilmor', 3, 78, 68, 350, 1200, 150, 41, 48);
INSERT INTO `sx_towns` VALUES (15, 'Fort Plastid', 3, 98, 98, 400, 1400, 175, 45, 52);
INSERT INTO `sx_towns` VALUES (16, 'Luxor', 4, -5, 0, 200, 0, 200, 49, 56);
INSERT INTO `sx_towns` VALUES (17, 'Trake', 4, -20, 5, 300, 1800, 225, 53, 60);
INSERT INTO `sx_towns` VALUES (18, 'Cormorent', 4, -40, 15, 400, 2000, 250, 57, 64);
INSERT INTO `sx_towns` VALUES (19, 'Illuvian', 4, -60, 35, 500, 2500, 275, 61, 68);
INSERT INTO `sx_towns` VALUES (20, 'Pogue', 4, -80, 60, 600, 3000, 300, 65, 72);
INSERT INTO `sx_towns` VALUES (21, 'Outpost 5', 5, 0, 0, 350, 0, 325, 69, 76);
INSERT INTO `sx_towns` VALUES (22, 'Outpost 7', 5, 20, 20, 500, 3500, 350, 73, 80);
INSERT INTO `sx_towns` VALUES (23, 'Outpost 15', 5, 35, -55, 650, 4000, 375, 77, 82);
INSERT INTO `sx_towns` VALUES (24, 'Outpost 22', 5, -74, -69, 800, 4500, 400, 80, 84);
INSERT INTO `sx_towns` VALUES (25, 'Outpost 42', 5, 89, 94, 950, 5000, 425, 83, 85);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_users`
-- 

DROP TABLE IF EXISTS `sx_users`;
CREATE TABLE `sx_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `account` int(10) unsigned NOT NULL default '0',
  `birthdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastip` varchar(16) NOT NULL default '',
  `onlinetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `exploreverify` varchar(6) NOT NULL default '',
  `exploreverifyimage` varchar(12) NOT NULL default '',
  `explorefailed` int(10) unsigned NOT NULL default '0',
  `charname` varchar(30) NOT NULL default '',
  `charclass` tinyint(3) unsigned NOT NULL default '0',
  `charpicture` varchar(100) NOT NULL default '',
  `difficulty` float unsigned NOT NULL default '1',
  `deathpenalty` tinyint(3) unsigned NOT NULL default '0',
  `latitude` smallint(6) NOT NULL default '0',
  `longitude` smallint(6) NOT NULL default '0',
  `story` tinyint(3) unsigned NOT NULL default '1',
  `storylat` smallint(6) NOT NULL default '0',
  `storylon` smallint(6) NOT NULL default '0',
  `world` tinyint(3) unsigned NOT NULL default '1',
  `guild` int(10) unsigned NOT NULL default '0',
  `guildrank` int(10) unsigned NOT NULL default '0',
  `guildtag` varchar(4) NOT NULL default '',
  `tagcolor` varchar(7) NOT NULL default '',
  `namecolor` varchar(7) NOT NULL default '',
  `level` smallint(5) unsigned NOT NULL default '1',
  `levelup` int(10) unsigned NOT NULL default '0',
  `levelspell` int(10) unsigned NOT NULL default '0',
  `experience` int(10) unsigned NOT NULL default '0',
  `expbonus` tinyint(4) NOT NULL default '0',
  `gold` int(10) unsigned NOT NULL default '150',
  `goldbonus` tinyint(4) NOT NULL default '0',
  `bank` int(10) unsigned NOT NULL default '0',
  `maxhp` smallint(5) unsigned NOT NULL default '15',
  `maxmp` smallint(5) unsigned NOT NULL default '5',
  `maxtp` smallint(5) unsigned NOT NULL default '5',
  `currenthp` smallint(5) unsigned NOT NULL default '15',
  `currentmp` smallint(5) unsigned NOT NULL default '5',
  `currenttp` smallint(5) unsigned NOT NULL default '5',
  `strength` smallint(5) unsigned NOT NULL default '0',
  `dexterity` smallint(5) unsigned NOT NULL default '0',
  `energy` smallint(5) unsigned NOT NULL default '0',
  `physattack` smallint(5) unsigned NOT NULL default '5',
  `physdefense` smallint(5) unsigned NOT NULL default '5',
  `magicattack` smallint(5) unsigned NOT NULL default '0',
  `magicdefense` smallint(5) unsigned NOT NULL default '0',
  `fireattack` smallint(5) unsigned NOT NULL default '0',
  `firedefense` smallint(5) unsigned NOT NULL default '0',
  `lightattack` smallint(5) unsigned NOT NULL default '0',
  `lightdefense` smallint(5) unsigned NOT NULL default '0',
  `spellslist` varchar(200) NOT NULL default '0',
  `townslist` varchar(200) NOT NULL default '0,1',
  `pvpwins` int(10) unsigned NOT NULL default '0',
  `pvplosses` int(10) unsigned NOT NULL default '0',
  `pvphighest` int(10) unsigned NOT NULL default '0',
  `currentpvp` bigint(20) unsigned NOT NULL default '0',
  `currentaction` varchar(30) NOT NULL default 'In Town',
  `currentfight` tinyint(3) unsigned NOT NULL default '0',
  `currentmonsterid` smallint(5) unsigned NOT NULL default '0',
  `currentmonsterhp` smallint(5) unsigned NOT NULL default '0',
  `currentmonstersleep` tinyint(3) unsigned NOT NULL default '0',
  `dropidstring` varchar(10) NOT NULL default '0',
  `item1idstring` varchar(10) NOT NULL default '0',
  `item2idstring` varchar(10) NOT NULL default '0',
  `item3idstring` varchar(10) NOT NULL default '0',
  `item4idstring` varchar(10) NOT NULL default '0',
  `item5idstring` varchar(10) NOT NULL default '0',
  `item6idstring` varchar(10) NOT NULL default '0',
  `item1name` varchar(200) NOT NULL default '',
  `item2name` varchar(200) NOT NULL default '',
  `item3name` varchar(200) NOT NULL default '',
  `item4name` varchar(200) NOT NULL default '',
  `item5name` varchar(200) NOT NULL default '',
  `item6name` varchar(200) NOT NULL default '',
  `spell1id` int(10) unsigned NOT NULL default '0',
  `spell2id` int(10) unsigned NOT NULL default '0',
  `spell3id` int(10) unsigned NOT NULL default '0',
  `spell4id` int(10) unsigned NOT NULL default '0',
  `spell5id` int(10) unsigned NOT NULL default '0',
  `spell6id` int(10) unsigned NOT NULL default '0',
  `spell7id` int(10) unsigned NOT NULL default '0',
  `spell8id` int(10) unsigned NOT NULL default '0',
  `spell9id` int(10) unsigned NOT NULL default '0',
  `spell10id` int(10) unsigned NOT NULL default '0',
  `spell1name` varchar(30) NOT NULL default '',
  `spell2name` varchar(30) NOT NULL default '',
  `spell3name` varchar(30) NOT NULL default '',
  `spell4name` varchar(30) NOT NULL default '',
  `spell5name` varchar(30) NOT NULL default '',
  `spell6name` varchar(30) NOT NULL default '',
  `spell7name` varchar(30) NOT NULL default '',
  `spell8name` varchar(30) NOT NULL default '',
  `spell9name` varchar(30) NOT NULL default '',
  `spell10name` varchar(30) NOT NULL default '',
  `hpleech` tinyint(3) unsigned NOT NULL default '0',
  `mpleech` tinyint(3) unsigned NOT NULL default '0',
  `hpgain` tinyint(3) unsigned NOT NULL default '0',
  `mpgain` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `item1name` (`item1name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_users`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_worlds`
-- 

DROP TABLE IF EXISTS `sx_worlds`;
CREATE TABLE `sx_worlds` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `size` smallint(5) unsigned NOT NULL default '0',
  `bossid` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `sx_worlds`
-- 

INSERT INTO `sx_worlds` VALUES (1, 'Raenslide', 100, 1);
INSERT INTO `sx_worlds` VALUES (2, 'Lorenfall', 100, 0);
INSERT INTO `sx_worlds` VALUES (3, 'Borderlands', 100, 0);
INSERT INTO `sx_worlds` VALUES (4, 'Inferno', 100, 0);
INSERT INTO `sx_worlds` VALUES (5, 'Unreality', 100, 0);
