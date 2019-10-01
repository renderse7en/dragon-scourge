<?php // mapmini.php :: minimap flash controller.

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
include("globals.php");

$perpix = 100 / ($worldrow["size"] * 2);
$text = "&";

// First do towns.
$towns = dorow(doquery("SELECT * FROM towns WHERE world='".$worldrow["id"]."'"));
$text .= "towns=".sizeof($towns)."&";
$count = 0;
foreach($towns as $a=>$b) {
    $lat = $b["latitude"];
    $lon = $b["longitude"];
    if ($lat >= 0) { $y = ceil(($worldrow["size"] - $lat) * $perpix); } else { $y = 50 + ceil(($lat * -1) * $perpix); }
    if ($lon >= 0) { $x = 50 + ceil($lon * $perpix); } else { $x = ceil(($worldrow["size"] + $lon) * $perpix); }
    $text .= "town".$count."_x=".$x."&";
    $text .= "town".$count."_y=".$y."&";
    $count++;
}

// Then do your character.
$lat = $userrow["latitude"];
$lon = $userrow["longitude"];
if ($lat >= 0) { $y = ceil(($worldrow["size"] - $lat) * $perpix); } else { $y = 50 + ceil(($lat * -1) * $perpix); }
if ($lon >= 0) { $x = 50 + ceil($lon * $perpix); } else { $x = ceil(($worldrow["size"] + $lon) * $perpix); }
$text .= "player_x=".$x."&";
$text .= "player_y=".$y."&";

// Then do everyone else.
$users = dorow(doquery("SELECT * FROM users WHERE world='".$worldrow["id"]."' AND UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."' AND id != '".$userrow["id"]."'"), "id");
if ($users) { $text .= "users=".count($users)."&"; } else { $text .= "users=0&"; }
$count = 0;
if ($users != false) {
    foreach ($users as $a => $b) {
        $lat = $b["latitude"];
        $lon = $b["longitude"];
        if ($lat >= 0) { $y = ceil(($worldrow["size"] - $lat) * $perpix); } else { $y = 50 + ceil(($lat * -1) * $perpix); }
        if ($lon >= 0) { $x = 50 + ceil($lon * $perpix); } else { $x = ceil(($worldrow["size"] + $lon) * $perpix); }
        $text .= "user".$count."_x=".$x."&";
        $text .= "user".$count."_y=".$y."&";
        $count++;
    }
}

// Then do quests.
if ($userrow["story"] != "0" && $userrow["story"] != "9999") {
    
    $lat = $userrow["storylat"];
    $lon = $userrow["storylon"];
    if ($lat >= 0) { $y = ceil(($worldrow["size"] - $lat) * $perpix); } else { $y = 250 + ceil(($lat * -1) * $perpix); }
    if ($lon >= 0) { $x = 250 + ceil($lon * $perpix); } else { $x = ceil(($worldrow["size"] + $lon) * $perpix); }
    
    $text .= "story=1&";
    $text .= "story_x=".$x."&";
    $text .= "story_y=".$y."&";
    $text .= "story_name=Quest&";
    
} else { $text .= "story=0&"; }

echo($text);

?>
