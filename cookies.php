<?php // cookies.php :: Handles cookies. (Mmm, tasty!)

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

function checkcookies() {

    include('config.php');
    global $controlrow;
    
    $row = false;
    
    if (isset($_COOKIE[$controlrow["cookiename"]])) {
        
        // COOKIE FORMAT:
        // {ID} {USERNAME} {PASSWORDHASH} {REMEMBERME}
        $theuser = explode(" ",$_COOKIE[$controlrow["cookiename"]]);
        if (!is_numeric($theuser[0])) { err("Invalid cookie data (Error 0). Please clear cookies and log in again."); }
        $row = dorow(doquery("SELECT * FROM <<accounts>> WHERE username='$theuser[1]' LIMIT 1"));
        if ($row == false) { err("Invalid cookie data (Error 1). Please clear cookies and log in again."); }
        if ($row["id"] != $theuser[0]) { err("Invalid cookie data (Error 2). Please clear cookies and log in again."); }
        if (md5($row["password"] . "--" . $dbsettings["secretword"]) !== $theuser[2]) { err("Invalid cookie data (Error 3). Please clear cookies and log in again."); }
        
        // If we've gotten this far, cookie should be valid, so write a new one.
        $newcookie = implode(" ",$theuser);
        if ($theuser[3] == 1) { $expiretime = time()+31536000; } else { $expiretime = 0; }
        setcookie ($controlrow["cookiename"], $newcookie, $expiretime, "/", $controlrow["cookiedomain"], 0);
        
    }
    
    return $row;

}

?>