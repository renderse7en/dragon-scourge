<?php // globals.php :: Storage for lots of super important arrays we're probably going to need eventually.

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 19

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

// Config.php.
include("config.php");
if (trim($dbsettings["secretword"]) == "") { die("Invalid setting for secretword in config.php. This setting must never be blank."); }

// Control row.
$controlrow = dorow(doquery("SELECT * FROM <<control>> WHERE id='1' LIMIT 1"));

// Account row.
include("cookies.php");
$acctrow = checkcookies();
if ($acctrow == false && substr($_SERVER["REQUEST_URI"], -21) != "users.php?do=register") { die(header("Location: login.php?do=login")); }
if ($acctrow != false && $acctrow["characters"] == 0 && substr($_SERVER["REQUEST_URI"], -20) != "users.php?do=charnew") { die(header("Location: users.php?do=charnew")); }

// User row.
if (substr($_SERVER["REQUEST_URI"], -19) != "login.php?do=logout") {
    $online = doquery("UPDATE <<users>> SET onlinetime=NOW() WHERE id='".$acctrow["activechar"]."' LIMIT 1");
} else {
    $online = doquery("UPDATE <<users>> SET onlinetime = DATE_SUB(onlinetime, INTERVAL 11 MINUTE) WHERE id='".$acctrow["activechar"]."' LIMIT 1");
}
$userrow = dorow(doquery("SELECT * FROM <<users>> WHERE id='".$acctrow["activechar"]."' LIMIT 1"));
if ($userrow != false) { $userrow = array_map("stripslashes", $userrow); }

// World row.
$worldrow = dorow(doquery("SELECT * FROM <<worlds>> WHERE id='".$userrow["world"]."' LIMIT 1")); 

// Town row.
if ($userrow["currentaction"] == "In Town") {
    $townrow = dorow(doquery("SELECT * FROM <<towns>> WHERE world='".$userrow["world"]."' AND longitude='".$userrow["longitude"]."' AND latitude='".$userrow["latitude"]."' LIMIT 1"));
} else {
    $townrow = false;
}

// Spells.
$spells = dorow(doquery("SELECT * FROM <<spells>> ORDER BY id", "spells"), "id");

// Global fightrow.
$fightrow = array(
    "playerphysdamage"=>0,
    "playermagicdamage"=>0,
    "playerfiredamage"=>0,
    "playerlightdamage"=>0,
    "monsterphysdamage"=>0,
    "monstermagicdamage"=>0,
    "monsterfiredamage"=>0,
    "monsterlightdamage"=>0,
    "track"=>"",
    "message"=>"");

?>