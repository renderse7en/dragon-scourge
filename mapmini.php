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

// Then do everyone else.
$users = dorow(doquery("SELECT * FROM {{table}} WHERE world='".$worldrow["id"]."' AND UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."' AND id != '".$userrow["id"]."'", "users"), "id");
$text .= "users=".count($users)."&";
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