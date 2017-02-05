<?php

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

// Get a bunch of stuff.
if (isset($_GET["id"]) && is_numeric($_GET["id"])) { $id = $_GET["id"]; }
if (!isset($id)) { die(); }
$userrow = dorow(doquery("SELECT *, UNIX_TIMESTAMP(onlinetime) AS fonlinetime FROM <<users>> WHERE id='$id' LIMIT 1"));
if (!$userrow) { die(); }
$class = dorow(doquery("SELECT * FROM <<classes>> WHERE id='".$userrow["charclass"]."' LIMIT 1"));
$world = dorow(doquery("SELECT * FROM <<worlds>> WHERE id='".$userrow["world"]."' LIMIT 1"));

// Start our image.
$img = imagecreatefrompng("images/sigbotback.png");
$textcolor = imagecolorallocate($img, 0, 0, 0);

// Add the user's name.
if ($userrow["guildtag"] != "") {
    $tagcolor = hexToRGB(ltrim($userrow["tagcolor"], "#"));
    $namecolor = hexToRGB(ltrim($userrow["namecolor"], "#"));
    $tagcolor = imagecolorallocate($img, $tagcolor[0], $tagcolor[1], $tagcolor[2]);
    $namecolor = imagecolorallocate($img, $namecolor[0], $namecolor[1], $namecolor[2]);
    imagestring($img, 3, 40, 5, "[" . $userrow["guildtag"] . "]", $tagcolor);
    imagestring($img, 3, 78, 5, $userrow["charname"], $namecolor);
} else {
    imagestring($img, 3, 50, 5, $userrow["charname"], $textcolor);
}

// Add some other stats.
imagestring($img, 2, 78, 20, "Level " . $userrow["level"] . " " . $class["name"], $textcolor);
imagestring($img, 2, 78, 30, "In " . $world["name"], $textcolor);

// Is online or not?
if ($userrow["fonlinetime"] >= (mktime() - 600)) { 
    imagestring($img, 2, 78, 40, "Currently: Online", $textcolor);
} else {
    imagestring($img, 2, 78, 40, "Currently: Offline", $textcolor);
}

// Final output to browser.
header("Content-type: image/png");
imagepng($img);
imagedestroy($img);

function hexToRGB($hexstr) {
    
    $hexstr = strtolower($hexstr);
    $replace = array("a"=>10, "b"=>11, "c"=>12, "d"=>13, "e"=>14, "f"=>15);
    $hex = array();
    for ($i = 0; $i < 6; $i++) {
        if (isset($replace[$hexstr{$i}])) { $hex[$i] = $replace[$hexstr{$i}]; } else { $hex[$i] = $hexstr{$i}; }
    }
    
    $red = ($hex[0] * 16) + $hex[1];
    $green = ($hex[2] * 16) + $hex[3];
    $blue = ($hex[4] * 16) + $hex[5];
    
    return array($red,$green,$blue);
}

?>