<?php // mapmini.php :: minimap flash controller.

include("lib.php");
include("globals.php");

$perpix = 100 / ($worldrow["size"] * 2);
$text = "&";

// First do towns.
$towns = dorow(doquery("SELECT * FROM {{table}} WHERE world='".$worldrow["id"]."'", "towns"));
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

$users = doquery("SELECT * FROM {{table}} WHERE world='".$worldrow["id"]."' AND UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."' AND id != '".$userrow["id"]."'", "users");
$text .= "users=".mysql_num_rows($users)."&";
$count = 0;
while ($b = mysql_fetch_array($users)) { 
    $lat = $b["latitude"];
    $lon = $b["longitude"];
    if ($lat >= 0) { $y = ceil(($worldrow["size"] - $lat) * $perpix); } else { $y = 50 + ceil(($lat * -1) * $perpix); }
    if ($lon >= 0) { $x = 50 + ceil($lon * $perpix); } else { $x = ceil(($worldrow["size"] + $lon) * $perpix); }
    $text .= "user".$count."_x=".$x."&";
    $text .= "user".$count."_y=".$y."&";
    $count++;
}

echo($text);

?>