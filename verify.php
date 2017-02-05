<?php // verify.php :: Standalone file for verifying accounts.

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 20

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

include("lib.php");

if (isset($_GET["code"])) {
    $code = $_GET["code"];
} else { die("Invalid account verification code."); }
    
$query = doquery("SELECT * FROM <<accounts>> WHERE verifycode='$code' LIMIT 1");
if (mysql_num_rows($query) != 1) {
    die("Invalid account verification code.");
} else {
    $update = doquery("UPDATE <<accounts>> SET verifycode='1' WHERE verifycode='$code' LIMIT 1");
}
display("Account Verification",gettemplate("users_verified"), false);

?>