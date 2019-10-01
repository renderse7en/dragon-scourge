<?php // index.php :: Case switching to decide what function we need to be running.

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

//error_reporting(E_STRICT);

include("lib.php");
include("globals.php");

if(isset($_GET["do"])) {
    $do = explode(":",$_GET["do"]);
    switch ($do[0]) {
        
        // Exploring.
        case "explore": include("explore.php"); move(); break;
        case "travel": include("explore.php"); travel($do[1]); break;
        case "quickheal": include("explore.php"); quickheal(); break;
        case "itemdrop": include("explore.php"); itemdrop(); break;
        case "humanity": include("explore.php"); botkillah(); break;
        // Towns.
        case "inn": include("town.php"); inn(); break;
        case "maps": include("town.php"); map(); break;
        case "duel": include("town.php"); duel(); break;
        case "challenge": include("town.php"); duelchallenge(); break;
        case "buy": include("town.php"); buy(); break;
        case "gamble": include("town.php"); gamble(); break;
        case "bank": include("town.php"); bank(); break;
        case "top10": include("town.php"); halloffame(); break;
        // Mailbox.
        case "mailbox": include("mailbox.php"); mailbox(); break;
        case "mailview": include("mailbox.php"); letter(); break;
        case "maildelete": include("mailbox.php"); maildelete(); break;
        case "mailnew": include("mailbox.php"); mailnew(); break;
        case "mailreply": include("mailbox.php"); mailreply(); break;
        case "mailsent": include("mailbox.php"); outbox(); break;
        case "mailviewsent": include("mailbox.php"); letterout(); break;
        // Fights.
        // Guilds.
        case "guilds": include("guilds.php"); guildmain(); break;
        case "guildhome": include("guilds.php"); guildhome(); break;
        case "guildcreate": include("guilds.php"); guildcreate(); break;
        case "guildapp": include("guilds.php"); guildapp(); break;
        case "guildmembers": include("guilds.php"); guildmembers(); break;
        case "guildbank": include("guilds.php"); guildbank(); break;
        case "guildpromote": include("guilds.php"); guildpromote(); break;
        case "guildremove": include("guilds.php"); guildremove(); break;
        case "guildapprove": include("guilds.php"); guildapprove(); break;
        case "guildnews": include("guilds.php"); guildnews(); break;
        case "guilddisband": include("guilds.php"); guilddisband(); break;
        case "guildedit": include("guilds.php"); guildedit(); break;
        case "guildleave": include("guilds.php"); guildleave(); break;
        case "guildupdate": include("guilds.php"); guildupdate(); break;
        // Misc.
        case "babblebox": include("misc.php"); babblebox2(); break;
        case "showmap": include("misc.php"); showmap(); break;
        case "version": include("misc.php"); version(); break;
        case "iddqd": include("misc.php"); iddqd(); break;
        default: donothing();
        
    }
} else {
    donothing();
}

function donothing() {
    
    global $userrow;
    if ($userrow["story"] != "0" && $userrow["storylat"] == $userrow["latitude"] && $userrow["storylon"] == $userrow["longitude"]) {
        die(header("Location: story.php"));
    }
    if ($userrow["currentpvp"] != 0) { 
        die(header("Location: pvp.php"));
    }
    if ($userrow["currentaction"] == "In Town") {
        include("town.php");
        dotown();
    }
    if ($userrow["currentaction"] == "Exploring") {
        include("explore.php");
        doexplore();
    }
    if ($userrow["currentaction"] == "Fighting") {
        die(header("Location: fight.php"));
    }
    if ($userrow["currentaction"] == "PVP") { 
        die(header("Location: pvp.php"));
    }
    
}

?>
