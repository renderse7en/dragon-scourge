-- phpMyAdmin SQL Dump
-- version 2.6.0-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 10, 2005 at 03:15 PM
-- Server version: 4.1.14
-- PHP Version: 5.0.5
-- 
-- Database: `scourge2`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_accounts`
-- 

CREATE TABLE `sx_accounts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `emailaddress` varchar(50) NOT NULL default '',
  `verifycode` varchar(8) NOT NULL default '',
  `regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `regip` varchar(16) NOT NULL default '',
  `authlevel` tinyint(3) unsigned NOT NULL default '1',
  `language` varchar(30) NOT NULL default '',
  `characters` tinyint(3) unsigned NOT NULL default '0',
  `activechar` int(10) unsigned NOT NULL default '0',
  `imageformat` varchar(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_babblebox`
-- 

CREATE TABLE `sx_babblebox` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `posttime` datetime NOT NULL default '0000-00-00 00:00:00',
  `charname` varchar(30) NOT NULL default '',
  `charid` int(11) unsigned NOT NULL default '0',
  `content` varchar(255) NOT NULL default '',
  `guild` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_babblebox`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_classes`
-- 

CREATE TABLE `sx_classes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `expbonus` tinyint(3) unsigned NOT NULL default '0',
  `goldbonus` tinyint(3) unsigned NOT NULL default '0',
  `damageperstrength` float unsigned NOT NULL default '0',
  `hpperdexterity` float unsigned NOT NULL default '0',
  `mpperenergy` float unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_classes`
-- 

INSERT INTO `sx_classes` VALUES (1, 'Barbarian', 0, 0, 2, 1.5, 1);
INSERT INTO `sx_classes` VALUES (2, 'Sorceress', 0, 0, 1, 1.5, 2);
INSERT INTO `sx_classes` VALUES (3, 'Paladin', 0, 0, 1.5, 2, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_control`
-- 

CREATE TABLE `sx_control` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `gamename` varchar(50) NOT NULL default '',
  `gameopen` tinyint(3) unsigned NOT NULL default '0',
  `gamepath` varchar(200) NOT NULL default '',
  `forumtype` tinyint(3) unsigned NOT NULL default '0',
  `forumurl` varchar(200) NOT NULL default '',
  `avatarpath` varchar(200) NOT NULL default '',
  `avatarurl` varchar(200) NOT NULL default '',
  `avatarmaxsize` int(10) unsigned NOT NULL default '0',
  `showshout` tinyint(3) unsigned NOT NULL default '0',
  `showonline` tinyint(3) unsigned NOT NULL default '0',
  `shownews` tinyint(3) unsigned NOT NULL default '0',
  `showimages` tinyint(3) unsigned NOT NULL default '0',
  `verifyemail` tinyint(3) unsigned NOT NULL default '0',
  `compression` tinyint(3) unsigned NOT NULL default '0',
  `debug` tinyint(3) unsigned NOT NULL default '0',
  `logerrors` tinyint(3) unsigned NOT NULL default '0',
  `botcheck` tinyint(3) unsigned NOT NULL default '0',
  `pvprefresh` int(10) NOT NULL default '0',
  `pvptimeout` int(10) NOT NULL default '0',
  `guildstartup` int(10) unsigned NOT NULL default '100000',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_control`
-- 

INSERT INTO `sx_control` VALUES (1, 'Dragon Scourge', 1, 'd:\\server\\docroot\\scourge\\', 1, 'http://se7enet.com/ubbthreads/ubbthreads.php', 'd:\\server\\docroot\\scourge\\images\\users\\', 'http://localhost/scourge/images/users/', 15000, 1, 1, 1, 1, 0, 1, 1, 1, 100, 15, 600, 100000);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_difficulties`
-- 

CREATE TABLE `sx_difficulties` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `expbonus` tinyint(3) unsigned NOT NULL default '0',
  `goldbonus` tinyint(3) unsigned NOT NULL default '0',
  `multiplier` float NOT NULL default '0',
  `deathpenalty` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

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

CREATE TABLE `sx_guildapps` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `guild` int(10) unsigned NOT NULL default '0',
  `charid` int(10) unsigned NOT NULL default '0',
  `charname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_guildapps`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `sx_guilds`
-- 

CREATE TABLE `sx_guilds` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `tagline` varchar(4) NOT NULL default '',
  `color1` varchar(7) NOT NULL default '',
  `color2` varchar(7) NOT NULL default '',
  `members` int(10) unsigned NOT NULL default '0',
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
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_guilds`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_itembase`
-- 

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
) ENGINE=MyISAM;

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
INSERT INTO `sx_itembase` VALUES (51, 'Giant Maul', 1, 0, 1, 38000, 19000, 83, 405, 0, 0, 'physattack', 400, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
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

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_itemmodnames`
-- 

CREATE TABLE `sx_itemmodnames` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `fieldname` varchar(50) NOT NULL default '',
  `prettyname` varchar(50) NOT NULL default '',
  `percent` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

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
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_itemprefixes`
-- 

INSERT INTO `sx_itemprefixes` VALUES (1, 'Sharp', 1, 0, 0, 5, 3, 1, 0, 0, 0, 'physattack', 2);
INSERT INTO `sx_itemprefixes` VALUES (2, 'Magic', 1, 0, 0, 8, 4, 1, 0, 0, 0, 'magicattack', 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_itemsuffixes`
-- 

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
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_itemsuffixes`
-- 

INSERT INTO `sx_itemsuffixes` VALUES (1, 'of the Vampire', 1, 0, 0, 5, 3, 1, 0, 0, 0, 'hpleech', 5);
INSERT INTO `sx_itemsuffixes` VALUES (2, 'of the Bear', 1, 0, 0, 5, 3, 1, 0, 0, 0, 'strength', 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_messages`
-- 

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
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_messages`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_monsters`
-- 

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
  `hpleech` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_monsters`
-- 

INSERT INTO `sx_monsters` VALUES (1, 'Small Slime', 1, 1, 3, 2, 3, 15, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (2, 'Shade', 1, 1, 4, 2, 3, 18, 18, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (3, 'Slime', 1, 2, 5, 3, 4, 21, 21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (4, 'Small Drake', 1, 2, 6, 3, 5, 24, 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (5, 'Skeleton', 1, 3, 7, 4, 7, 27, 27, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (6, 'Haunt', 1, 3, 8, 4, 8, 30, 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (7, 'Big Slime', 1, 4, 9, 5, 10, 33, 33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (8, 'Drake', 1, 4, 10, 5, 11, 36, 36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (9, 'Ghost', 1, 5, 11, 6, 12, 39, 39, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (10, 'Bee', 1, 5, 12, 6, 12, 42, 42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (11, 'Scorpion', 1, 6, 14, 7, 13, 45, 45, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (12, 'Dawk', 1, 6, 16, 8, 15, 50, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (13, 'Nymph', 1, 7, 18, 9, 16, 54, 54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (14, 'Ember', 1, 7, 20, 10, 17, 59, 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (15, 'Daydream', 1, 8, 22, 11, 18, 63, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (16, 'Wasp', 1, 8, 24, 12, 20, 68, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (17, 'Shadow', 1, 9, 26, 13, 22, 72, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (18, 'Harpy', 1, 9, 28, 14, 24, 77, 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (19, 'Air Elemental', 1, 10, 30, 15, 26, 81, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (20, 'Rogue', 1, 10, 32, 16, 29, 86, 86, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (21, 'Lynx', 1, 11, 35, 18, 32, 90, 90, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (22, 'Trickster', 1, 11, 38, 19, 35, 95, 95, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (23, 'Goblin', 1, 12, 41, 21, 35, 99, 99, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (24, 'Charmer', 1, 12, 44, 22, 38, 53, 53, 35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (25, 'Raven', 1, 13, 47, 24, 41, 108, 108, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (26, 'Bobcat', 1, 13, 50, 25, 44, 113, 113, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (27, 'Lycan', 1, 14, 53, 27, 48, 119, 119, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (28, 'Fiend', 1, 14, 56, 28, 52, 125, 125, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (29, 'Liche', 1, 15, 59, 30, 56, 131, 131, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (30, 'Dawkin', 1, 15, 62, 31, 60, 137, 137, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (31, 'Anarchist', 1, 16, 66, 33, 64, 143, 143, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (32, 'Hellcat', 1, 16, 70, 35, 68, 149, 149, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (33, 'Fallen Cherub', 1, 17, 74, 37, 72, 155, 155, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (34, 'Grey Wolf', 1, 17, 78, 39, 76, 161, 161, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (35, 'Black Bear', 1, 18, 82, 41, 80, 167, 167, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (36, 'Knight', 1, 18, 86, 43, 84, 173, 173, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (37, 'Giant', 1, 19, 90, 45, 88, 179, 179, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (38, 'Young Wyrm', 1, 19, 94, 47, 92, 185, 185, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (39, 'Lesser Devil', 1, 20, 98, 49, 96, 191, 191, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (40, 'Lesser Demon', 1, 20, 102, 51, 100, 197, 197, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `sx_monsters` VALUES (41, 'Razora', 1, 99, 300, 150, 200, 203, 203, 135, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_pvp`
-- 

CREATE TABLE `sx_pvp` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `player1id` int(10) unsigned NOT NULL default '0',
  `player2id` int(10) unsigned NOT NULL default '0',
  `player1name` varchar(30) NOT NULL default '',
  `player2name` varchar(30) NOT NULL default '',
  `playerturn` int(10) unsigned NOT NULL default '0',
  `accepted` tinyint(3) unsigned NOT NULL default '0',
  `turntime` timestamp NOT NULL,
  `fightrow` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_pvp`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `sx_spells`
-- 

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
) ENGINE=MyISAM;

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
-- Table structure for table `sx_towns`
-- 

CREATE TABLE `sx_towns` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `world` tinyint(3) unsigned NOT NULL default '0',
  `latitude` smallint(6) NOT NULL default '0',
  `longitude` smallint(6) NOT NULL default '0',
  `innprice` tinyint(4) NOT NULL default '0',
  `mapprice` smallint(6) NOT NULL default '0',
  `travelpoints` smallint(5) unsigned NOT NULL default '0',
  `itemminlvl` int(10) unsigned NOT NULL default '0',
  `itemmaxlvl` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_towns`
-- 

INSERT INTO `sx_towns` VALUES (1, 'Middleton', 1, 0, 0, 5, 0, 0, 1, 5);
INSERT INTO `sx_towns` VALUES (2, 'Norfolk', 1, 25, 25, 10, 25, 5, 3, 9);
INSERT INTO `sx_towns` VALUES (3, 'Calentia', 1, 50, -50, 25, 50, 15, 6, 14);
INSERT INTO `sx_towns` VALUES (4, 'Resmark', 1, -75, 75, 40, 100, 30, 11, 19);
INSERT INTO `sx_towns` VALUES (5, 'Erdricksburg', 1, 99, 99, 60, 500, 50, 16, 25);

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_users`
-- 

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
  `currentpvp` bigint(20) unsigned NOT NULL default '0',
  `currentaction` varchar(30) NOT NULL default 'In Town',
  `currentfight` tinyint(3) unsigned NOT NULL default '0',
  `currentmonsterid` smallint(5) unsigned NOT NULL default '0',
  `currentmonsterhp` smallint(5) unsigned NOT NULL default '0',
  `currentmonstersleep` tinyint(3) unsigned NOT NULL default '0',
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
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_users`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sx_worlds`
-- 

CREATE TABLE `sx_worlds` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `size` smallint(5) unsigned NOT NULL default '0',
  `bossid` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sx_worlds`
-- 

INSERT INTO `sx_worlds` VALUES (1, 'Raenslide', 100, 1);
INSERT INTO `sx_worlds` VALUES (2, 'Lorenfall', 100, 0);
INSERT INTO `sx_worlds` VALUES (3, 'Borderlands', 100, 0);
INSERT INTO `sx_worlds` VALUES (4, 'Inferno', 100, 0);
INSERT INTO `sx_worlds` VALUES (5, 'Unreality', 100, 0);