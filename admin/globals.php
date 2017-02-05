<?php // globals.php :: Storage for lots of super important arrays we're probably going to need eventually.

// Config.php.
include("../config.php");
if (trim($dbsettings["secretword"]) == "") { die("Invalid setting for secretword in config.php. This setting must never be blank."); }

// Control row.
$controlrow = dorow(doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control"));

// Account row.
include("cookies.php");
$acctrow = checkcookies();
if ($acctrow == false) { die(header("Location: " . $controlrow["gameurl"] . "login.php?do=login")); }
if ($acctrow["authlevel"] != 255) { die("You do not have access to this area."); }

$thetab = 1;

?>