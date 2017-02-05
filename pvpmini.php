<?php // pvpmini.php :: update tester for pvp.

include("lib.php");
include("globals.php");

global $userrow, $controlrow;
$row = dorow(doquery("SELECT *,UNIX_TIMESTAMP(turntime) as fturntime FROM {{table}} WHERE id='".$userrow["currentpvp"]."' LIMIT 1", "pvp"));

// Check for timeout.
if ($row["fturntime"] < (time() - $controlrow["pvptimeout"])) {
    
    $query = doquery("UPDATE {{table}} SET currentpvp='0', currentaction='In Town' WHERE id='".$row["player1id"]."' OR id='".$row["player2id"]."' LIMIT 2", "users");
    $query2 = doquery("DELETE FROM {{table}} WHERE id='".$row["id"]."'", "pvp");
    $pagerow["content"] = "The other player did not respond and this Duel has timed out. Thanks for playing.<br /><br />This window will refresh to the main screen in ".$controlrow["pvprefresh"]." seconds.";
    $pagerow["target"] = "_top";
    $pagerow["parentreload"] = "onload=\"setTimeout('top.location.href=\'index.php\'',".($controlrow["pvprefresh"] * 1000).")\"";
    $pagerow["metareload"] = "";
    
    $page = parsetemplate(gettemplate("pvp_mini"),$pagerow);
    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();
    
}

// No timeout so check for whose turn it is.
if ($row["playerturn"] == $userrow["id"]) {
    
    $pagerow["content"] = "Please hold while this window refreshes to the game screen...";
    $pagerow["target"] = "_top";
    $pagerow["metareload"] = "";
    $pagerow["parentreload"] = "onload=\"setTimeout('top.location.href=\'pvp.php\'',".($controlrow["pvprefresh"] * 100).")\"";
    $pagerow["metareload"] = "";
    
    $page = parsetemplate(gettemplate("pvp_mini"),$pagerow);
    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();
    
} else {

    $pagerow["content"] = "Waiting for player to respond...";
    $pagerow["target"] = "_self";
    $pagerow["parentreload"] = "";
    $pagerow["metareload"] = "<meta http-equiv=\"refresh\" content=\"".$controlrow["pvprefresh"].";url=pvpmini.php\">";
    
    $page = parsetemplate(gettemplate("pvp_mini"),$pagerow);
    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();
    
}

?>