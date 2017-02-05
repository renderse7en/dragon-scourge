<?php // pvpmini.php :: update tester for pvp.

include("lib.php");
include("globals.php");

global $userrow, $controlrow;
$row = dorow(doquery("SELECT *,UNIX_TIMESTAMP(turntime) as fturntime FROM <<pvp>> WHERE id='".$userrow["currentpvp"]."' LIMIT 1"));

// Check for timeout.
if ($row["fturntime"] < (time() - $controlrow["pvptimeout"])) {
    
    // If the PVP was accepted, whoever timed out loses.
    if ($row["accepted"] == 1) {
        $monsterrow = dorow(doquery("SELECT * FROM <<users>> WHERE id='".$row["player2id"]."' LIMIT 1"));
        if ($monsterrow["level"] > $userrow["pvphighest"]) { $highest = ", pvphighest='".$monsterrow["level"]."'"; } else { $highest = ""; }
        doquery("UPDATE <<users>> SET currentpvp='0', currentaction='In Town', pvpwins = pvpwins + 1 $highest WHERE id='".$row["player1id"]."' LIMIT 1");
        doquery("UPDATE <<users>> SET currentpvp='0', currentaction='In Town', pvplosses = pvplosses + 1 WHERE id='".$row["player2id"]."' LIMIT 1");
    } else {
        doquery("UPDATE <<users>> SET currentpvp='0', currentaction='In Town' WHERE id='".$row["player1id"]."' OR id='".$row["player2id"]."' LIMIT 2");
    }
    
    $query2 = doquery("DELETE FROM <<pvp>> WHERE id='".$row["id"]."'");
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