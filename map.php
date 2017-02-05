<?php // map.php :: full map flash controller.

include("lib.php");
include("globals.php");

$perpix = 500 / ($worldrow["size"] * 2);
$text = "&";

// First do towns.
$towns = dorow(doquery("SELECT * FROM <<towns>> WHERE world='".$worldrow["id"]."'"));
$text .= "towns=".sizeof($towns)."&";
$count = 0;
foreach($towns as $a=>$b) {
    $lat = $b["latitude"];
    $lon = $b["longitude"];
    if ($lat >= 0) { $y = ceil(($worldrow["size"] - $lat) * $perpix); } else { $y = 250 + ceil(($lat * -1) * $perpix); }
    if ($lon >= 0) { $x = 250 + ceil($lon * $perpix); } else { $x = ceil(($worldrow["size"] + $lon) * $perpix); }
    $text .= "town".$count."_x=".$x."&";
    $text .= "town".$count."_y=".$y."&";
    $text .= "town".$count."_name=".$b["name"]."&";
    $count++;
}

// Then do your character.
$lat = $userrow["latitude"];
$lon = $userrow["longitude"];
if ($lat >= 0) { $y = ceil(($worldrow["size"] - $lat) * $perpix); } else { $y = 250 + ceil(($lat * -1) * $perpix); }
if ($lon >= 0) { $x = 250 + ceil($lon * $perpix); } else { $x = ceil(($worldrow["size"] + $lon) * $perpix); }
$text .= "player_x=".$x."&";
$text .= "player_y=".$y."&";
$text .= "player_name=".$userrow["charname"]."&";

// Then do everyone else.
$users = dorow(doquery("SELECT * FROM <<users>> WHERE world='".$worldrow["id"]."' AND UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."' AND id != '".$userrow["id"]."'"), "id");
$text .= "users=".count($users)."&";
$count = 0;
if ($users != false) {
    foreach ($users as $a => $b) {
        $lat = $b["latitude"];
        $lon = $b["longitude"];
        if ($lat >= 0) { $y = ceil(($worldrow["size"] - $lat) * $perpix); } else { $y = 250 + ceil(($lat * -1) * $perpix); }
        if ($lon >= 0) { $x = 250 + ceil($lon * $perpix); } else { $x = ceil(($worldrow["size"] + $lon) * $perpix); }
        $text .= "user".$count."_x=".$x."&";
        $text .= "user".$count."_y=".$y."&";
        $text .= "user".$count."_name=".$b["charname"]."&";
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