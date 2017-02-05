<?php // login.php :: Handles user logins and logouts.

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

include("lib.php");
if (isset($_GET["do"])) { $do = $_GET["do"]; } else { $do = ""; }

switch($do) {
    case "logout":
        logout();
        break;
    default:
        login();
}

function login() {
    
    $controlrow = dorow(doquery("SELECT * FROM <<control>> WHERE id='1' LIMIT 1"));
    
    if (isset($_POST["submit"])) {
        
        // Setup.
        include("config.php");
        extract($_POST);
        $query = doquery("SELECT * FROM <<accounts>> WHERE username='$username' LIMIT 1");
        $row = dorow($query);
        
        // Errors.
        if ($row == false) { err("Invalid username. Please <a href=\"index.php\">go back</a> and try again.", false, false); }
        if ($row["password"] != md5($password)) { err("Invalid password. Please <a href=\"index.php\">go back</a> and try again.", false, false); }
        if ($row["verifycode"] != 1) { err("You have not yet verified your account. Please click the link found in your Account Verification email before continuing. If you never received the email, please check your spam filter settings or contact the game administrator for further assistance.", false, false); }
        
        // Finish.
        $newcookie = $row["id"] . " " . $username . " " . md5($row["password"] . "--" . $dbsettings["secretword"]);
        if (isset($remember)) { $expiretime = time()+31536000; $newcookie .= " 1"; } else { $expiretime = 0; $newcookie .= " 0"; }
        setcookie($controlrow["cookiename"], $newcookie, $expiretime, "/", $controlrow["cookiedomain"], 0);
        die(header("Location: index.php"));
        
    } else {
        
        display("Log In", gettemplate("login"), false);
        
    }
    
}

function logout() {
    
    include("globals.php");
    setcookie($controlrow["cookiename"], "", (time()-3600), "/", $controlrow["cookiedomain"], 0);
    die(header("Location: login.php?do=login"));
    
}

?>