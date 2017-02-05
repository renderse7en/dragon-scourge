ALTER TABLE `sx_control` ADD `cookiename` VARCHAR( 255 ) NOT NULL default 'scourge' AFTER `avatarmaxsize` ,
ADD `cookiedomain` VARCHAR( 255 ) NOT NULL AFTER `cookiename` ;
ALTER TABLE `sx_itembase` CHANGE `unique` `isunique` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0'