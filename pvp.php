<?php // pvp.php :: primary duel controller.

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
include("fightmods.php");

global $userrow;
$monsterrow = array();

if ($userrow["currentpvp"] == 0) { die(header("Location: index.php")); }
donothing();

function donothing() {
    
    global $userrow, $monsterrow, $fightrow;
    $pvp = dorow(doquery("SELECT * FROM pvp WHERE id='".$userrow["currentpvp"]."' LIMIT 1"));
    
    // Check if they need to accept challenge.
    if ($pvp["accepted"] == 0 && $pvp["player2id"] == $userrow["id"]) { challenged(); }
    
    // Check if challenge has been declined.
    if ($pvp["accepted"] == 2) { 
        $query = doquery("UPDATE users SET currentpvp='0',currentaction='In Town' WHERE id='".$userrow["id"]."' LIMIT 1");
        $query = doquery("DELETE FROM pvp WHERE id='".$pvp["id"]."' LIMIT 1");
        display("Duel Challenge", gettemplate("pvp_declined")); 
    }
    
    // Check if they're dead.
    if ($userrow["currenthp"] <= 0) { youlose(); }
    
    // Check if it's their turn.
    if ($pvp["playerturn"] == $userrow["id"]) { dofight(); }
    
    // Not their turn, so wait.
    dowait();
    
}

function challenged() {
    
    global $userrow, $monsterrow, $fightrow;
    $pvp = dorow(doquery("SELECT * FROM pvp WHERE id='".$userrow["currentpvp"]."' LIMIT 1"));
    if ($pvp == false) { die("Location: index.php"); }
    $newuserrow = dorow(doquery("SELECT * FROM users WHERE id='".$pvp["player1id"]."' LIMIT 1"));
    
    if ($newuserrow["charpicture"] != "") {
        $newuserrow["avatar"] = "<img src=\"".$newuserrow["charpicture"]."\" alt=\"".$newuserrow["charname"]."\" width=\"50\" height=\"50\" />";
    } else {
        $newuserrow["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$newuserrow["charname"]."\" width=\"50\" height=\"50\" />";
    }
    
    if (isset($_POST["yes"])) { 
        
        $query = doquery("UPDATE pvp SET accepted='1' WHERE id='".$userrow["currentpvp"]."' LIMIT 1");
        $query = doquery("UPDATE users SET currentaction='Duelling' WHERE id='".$pvp["player1id"]."' OR id='".$pvp["player2id"]."' LIMIT 2");
        dofight();
        
    } elseif (isset($_POST["no"])) {
        
        $query = doquery("UPDATE pvp SET accepted='2',playerturn=player1id WHERE id='".$userrow["currentpvp"]."' LIMIT 1");
        $query = doquery("UPDATE users SET currentaction='In Town', currentpvp='0' WHERE id='".$userrow["id"]."' LIMIT 1");
        display("Duel Challenge",parsetemplate(gettemplate("pvp_decline"),$newuserrow));
    
    } else {
    
        display("Duel Challenge",parsetemplate(gettemplate("pvp_challenged"),$newuserrow));
        
    }
    
}

function dowait() {
    
    global $userrow, $monsterrow, $fightrow;
    $pvp = dorow(doquery("SELECT * FROM pvp WHERE id='".$userrow["currentpvp"]."' LIMIT 1"));
    
    // "monsterrow" now becomes the other player's character.
    if ($pvp["player1id"] == $userrow["id"]) { 
        $monsterrow = dorow(doquery("SELECT * FROM users WHERE id='".$pvp["player2id"]."' LIMIT 1"));
    } else {
        $monsterrow = dorow(doquery("SELECT * FROM users WHERE id='".$pvp["player1id"]."' LIMIT 1"));
    }
    
    $pagerow = array(
            "message"=>$fightrow["message"],
            "charname"=>$monsterrow["charname"],
            "currenthp"=>$monsterrow["currenthp"],
            "playerphysdamage"=>$fightrow["playerphysdamage"],
            "playermagicdamage"=>$fightrow["playermagicdamage"],
            "playerfiredamage"=>$fightrow["playerfiredamage"],
            "playerlightdamage"=>$fightrow["playerlightdamage"]);
            if ($monsterrow["charpicture"] != "") {
    $pagerow["avatar"] = "<img src=\"".$monsterrow["charpicture"]."\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
    } else {
        $pagerow["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
    }
    
    display("Duelling",parsetemplate(gettemplate("pvp_wait"),$pagerow));
    
}
    
function dofight() {
    
    global $userrow, $monsterrow, $fightrow, $spells;
    $pvp = dorow(doquery("SELECT * FROM pvp WHERE id='".$userrow["currentpvp"]."' LIMIT 1"));
    
    // "monsterrow" now becomes the other player's character.
    if ($pvp["player1id"] == $userrow["id"]) { 
        $nextplayer = $pvp["player2id"];
        $monsterrow = dorow(doquery("SELECT * FROM users WHERE id='".$pvp["player2id"]."' LIMIT 1"));
    } else {
        $nextplayer = $pvp["player1id"];
        $monsterrow = dorow(doquery("SELECT * FROM users WHERE id='".$pvp["player1id"]."' LIMIT 1"));
    }
    
    if (isset($_POST["fight"])) {
        
        playerturn();
        if ($monsterrow["currenthp"] <= 0) { youwin(); }
        updateopponent();
        
        $fightrowimploded = $fightrow["playerphysdamage"].",".$fightrow["playermagicdamage"].",".$fightrow["playerfiredamage"].",".$fightrow["playerlightdamage"].",".$fightrow["message"];
        $query = doquery("UPDATE pvp SET fightrow='$fightrowimploded', playerturn='$nextplayer' WHERE id='".$pvp["id"]."' LIMIT 1");
        
        $pagerow = array(
            "message"=>$fightrow["message"],
            "charname"=>$monsterrow["charname"],
            "currenthp"=>$monsterrow["currenthp"],
            "playerphysdamage"=>$fightrow["playerphysdamage"],
            "playermagicdamage"=>$fightrow["playermagicdamage"],
            "playerfiredamage"=>$fightrow["playerfiredamage"],
            "playerlightdamage"=>$fightrow["playerlightdamage"]);
        $pagerow["spells"] = dospellslist();
        
        if ($monsterrow["charpicture"] != "") {
            $pagerow["avatar"] = "<img src=\"".$monsterrow["charpicture"]."\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
        } else {
            $pagerow["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
        }

        display("Duelling",parsetemplate(gettemplate("pvp_wait"),$pagerow));
        
    } elseif (isset($_POST["spell"])) {
    
        if (! is_numeric($_POST["spellid"])) { err("Invalid spell selection."); }
        $isavailable = 0;
        for ($i = 1; $i < 11; $i++) {
            if ($userrow["spell".$i."id"] == $_POST["spellid"]) { $isavailable = 1; }
        }
        if ($isavailable == 0) { err("You don't have that spell."); }
        
        include("spells.php");
        $fightrow["message"] = $spells[$_POST["spellid"]]["fname"]($_POST["spellid"]);
        $monsterrow["currenthp"] -= ($fightrow["playerphysdamage"] + $fightrow["playermagicdamage"] + $fightrow["playerfiredamage"] + $fightrow["playerlightdamage"]);
        if ($monsterrow["currenthp"] <= 0) { youwin(); }
        updateopponent();
        
        $fightrowimploded = $fightrow["playerphysdamage"].",".$fightrow["playermagicdamage"].",".$fightrow["playerfiredamage"].",".$fightrow["playerlightdamage"].",".$fightrow["message"];
        $query = doquery("UPDATE pvp SET fightrow='$fightrowimploded', playerturn='$nextplayer' WHERE id='".$pvp["id"]."' LIMIT 1");
        
        $pagerow = array(
            "message"=>$fightrow["message"],
            "charname"=>$monsterrow["charname"],
            "currenthp"=>$monsterrow["currenthp"],
            "playerphysdamage"=>$fightrow["playerphysdamage"],
            "playermagicdamage"=>$fightrow["playermagicdamage"],
            "playerfiredamage"=>$fightrow["playerfiredamage"],
            "playerlightdamage"=>$fightrow["playerlightdamage"]);
        $pagerow["spells"] = dospellslist();
        
        if ($monsterrow["charpicture"] != "") {
            $pagerow["avatar"] = "<img src=\"".$monsterrow["charpicture"]."\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
        } else {
            $pagerow["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
        }
        
        display("Fighting",parsetemplate(gettemplate("pvp_wait"),$pagerow));
    
    }
    
    if ($pvp["fightrow"] != "") { 
        
        $tempfightrow = explode(",",$pvp["fightrow"]);
        $fightrow["playerphysdamage"] = $tempfightrow[0];
        $fightrow["playermagicdamage"] = $tempfightrow[1];
        $fightrow["playerfiredamage"] = $tempfightrow[2];
        $fightrow["playerlightdamage"] = $tempfightrow[3];
        $fightrow["message"] = $tempfightrow[4];
        
        $pagerow = array(
            "message"=>$fightrow["message"],
            "charname"=>$monsterrow["charname"],
            "currenthp"=>$monsterrow["currenthp"],
            "playerphysdamage"=>$fightrow["playerphysdamage"],
            "playermagicdamage"=>$fightrow["playermagicdamage"],
            "playerfiredamage"=>$fightrow["playerfiredamage"],
            "playerlightdamage"=>$fightrow["playerlightdamage"]);
        $pagerow["spells"] = dospellslist();
        
        if ($monsterrow["charpicture"] != "") {
            $pagerow["avatar"] = "<img src=\"".$monsterrow["charpicture"]."\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
        } else {
            $pagerow["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
        }
        
        display("Duelling",parsetemplate(gettemplate("pvp_turn"),$pagerow));
        
    } else {
    
        $pagerow = array(
            "charname"=>$monsterrow["charname"],
            "currenthp"=>$monsterrow["currenthp"]);
        $pagerow["spells"] = dospellslist();
        
        if ($monsterrow["charpicture"] != "") {
            $pagerow["avatar"] = "<img src=\"".$monsterrow["charpicture"]."\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
        } else {
            $pagerow["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
        }
        
        display("Duelling",parsetemplate(gettemplate("pvp_new"),$pagerow));
        
    }
    
}

function playerturn() {
    
    global $userrow, $monsterrow, $fightrow;
    
    // Calculate all damages.
    if ($userrow["physattack"] != 0) {
        $physhit = ceil(rand($userrow["physattack"]*.75, $userrow["physattack"]) / 3);
        $physblock = ceil(rand($monsterrow["physdefense"]*.75, $monsterrow["physdefense"]) / 3);
        $fightrow["playerphysdamage"] = max($physhit - $physblock, 0);
    } else { $fightrow["playerphysdamage"] = 0; }
    
    if ($userrow["magicattack"] != 0) {
        $magichit = ceil(rand($userrow["magicattack"]*.75, $userrow["magicattack"]) / 3);
        $magicblock = ceil(rand($monsterrow["magicdefense"]*.75, $monsterrow["magicdefense"]) / 3);
        $fightrow["playermagicdamage"] = max($magichit - $magicblock, 0);
    } else { $fightrow["playermagicdamage"] = 0; }
    
    if ($userrow["fireattack"] != 0) {
        $firehit = ceil(rand($userrow["fireattack"]*.75, $userrow["fireattack"]) / 3);
        $fireblock = ceil(rand($monsterrow["firedefense"]*.75, $monsterrow["firedefense"]) / 3);
        $fightrow["playerfiredamage"] = max($firehit - $fireblock, 0);
    } else { $fightrow["playerfiredamage"] = 0; }
    
    if ($userrow["lightattack"] != 0) {
        $lighthit = ceil(rand($userrow["lightattack"]*.75, $userrow["lightattack"]) / 3);
        $lightblock = ceil(rand($monsterrow["lightdefense"]*.75, $monsterrow["lightdefense"]) / 3);
        $fightrow["playerlightdamage"] = max($lighthit - $lightblock, 0);
    } else { $fightrow["playerlightdamage"] = 0; }
        
    // Chance to make an excellent hit.
    $toexcellent = rand(0,150);
    if ($toexcellent <= sqrt($userrow["dexterity"])) { 
        $fightrow["playerphysdamage"] *= 2;
        $fightrow["playermagicdamage"] *= 2;
        $fightrow["playerfiredamage"] *= 2;
        $fightrow["playerlightdamage"] *= 2;
        $fightrow["message"] = "<b>Excellent hit!</b><br />"; 
    }
    
    // Chance for monster to dodge.
    $tododge = rand(0,200);
    if ($tododge <= sqrt($monsterrow["dexterity"])) { 
        $fightrow["playerphysdamage"] = 0;
        $fightrow["playermagicdamage"] = 0;
        $fightrow["playerfiredamage"] = 0;
        $fightrow["playerlightdamage"] = 0;
        $fightrow["message"] = "<b>".$monsterrow["charname"]." dodged the hit!</b><br />"; 
    }
    
    // Now we add Per Turn mods.
    bonusattack();
    bonusdefense_pvp();
    hpleech("player");
    mpleech("player");
    
    // Subtract all damage from monster's hp.
    $monsterrow["currenthp"] -= ($fightrow["playerphysdamage"] + $fightrow["playermagicdamage"] + $fightrow["playerfiredamage"] + $fightrow["playerlightdamage"]);
    
}

function youwin() {
    
    global $userrow, $monsterrow, $fightrow;
    $pvp = dorow(doquery("SELECT * FROM pvp WHERE id='".$userrow["currentpvp"]."' LIMIT 1"));
    
    // "monsterrow" now becomes the other player's character.
    if ($pvp["player1id"] == $userrow["id"]) { 
        $nextplayer = $pvp["player2id"];
    } else {
        $nextplayer = $pvp["player1id"];
    }
    
    $template = "pvp_win";

    $userrow["currentaction"] = "In Town";
    $userrow["currentfight"] = 0;
    $userrow["currentpvp"] = 0;
    $userrow["bonusattack"] = 0;
    $userrow["bonusdefense"] = 0;
    
    // Now we add Per Kill mods.
    hpgain();
    mpgain();
    
    // Update for new stats.
    $userrow["pvpwins"] += 1;
    $monsterrow["pvplosses"] += 1;
    if ($monsterrow["level"] > $userrow["pvphighest"]) { $userrow["pvphighest"] = $monsterrow["level"]; }
    updateopponent();
    updateuserrow();
    $fightrowimploded = $fightrow["playerphysdamage"].",".$fightrow["playermagicdamage"].",".$fightrow["playerfiredamage"].",".$fightrow["playerlightdamage"].",".$fightrow["message"];
    $query = doquery("UPDATE pvp SET fightrow='$fightrowimploded', playerturn='$nextplayer' WHERE id='".$pvp["id"]."' LIMIT 1");
    
    // And we're done.
    $pagerow = array(
        "message"=>$fightrow["message"],
        "monstername"=>$monsterrow["charname"],
        "monsterhp"=>$userrow["currentmonsterhp"],
        "playerphysdamage"=>$fightrow["playerphysdamage"],
        "playermagicdamage"=>$fightrow["playermagicdamage"],
        "playerfiredamage"=>$fightrow["playerfiredamage"],
        "playerlightdamage"=>$fightrow["playerlightdamage"]);
        
    if ($monsterrow["charpicture"] != "") {
        $pagerow["avatar"] = "<img src=\"".$monsterrow["charpicture"]."\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
    } else {
        $pagerow["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
    }
        
    display("Victory!",parsetemplate(gettemplate($template),$pagerow));
    
}

function youlose() {
    
    global $userrow, $monsterrow, $fightrow;
    $pvp = dorow(doquery("SELECT * FROM pvp WHERE id='".$userrow["currentpvp"]."' LIMIT 1"));
    
    if ($pvp["player1id"] == $userrow["id"]) { 
        $monsterrow = dorow(doquery("SELECT * FROM users WHERE id='".$pvp["player2id"]."' LIMIT 1"));
    } else {
        $monsterrow = dorow(doquery("SELECT * FROM users WHERE id='".$pvp["player1id"]."' LIMIT 1"));
    }
    
    $tempfightrow = explode(",",$pvp["fightrow"]);
    $fightrow["playerphysdamage"] = $tempfightrow[0];
    $fightrow["playermagicdamage"] = $tempfightrow[1];
    $fightrow["playerfiredamage"] = $tempfightrow[2];
    $fightrow["playerlightdamage"] = $tempfightrow[3];
    $fightrow["message"] = $tempfightrow[4];
    
    // Then put them in town & reset fight stuff.
    $userrow["currentaction"] = "In Town";
    $userrow["currentfight"] = 0;
    $userrow["currentpvp"] = 0;
    $userrow["currenthp"] = ceil($userrow["maxhp"] / 4);
    $userrow["bonusattack"] = 0;
    $userrow["bonusdefense"] = 0;
    
    // Update.
    updateuserrow();
    $query = doquery("DELETE FROM pvp WHERE id='".$pvp["id"]."' LIMIT 1");
    
    // And we're done.
    $pagerow = array(
        "message"=>$fightrow["message"],
        "monstername"=>$monsterrow["charname"],
        "monsterhp"=>$userrow["currentmonsterhp"],
        "playerphysdamage"=>$fightrow["playerphysdamage"],
        "playermagicdamage"=>$fightrow["playermagicdamage"],
        "playerfiredamage"=>$fightrow["playerfiredamage"],
        "playerlightdamage"=>$fightrow["playerlightdamage"]);
        
    if ($monsterrow["charpicture"] != "") {
        $pagerow["avatar"] = "<img src=\"".$monsterrow["charpicture"]."\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
    } else {
        $pagerow["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$monsterrow["charname"]."\" width=\"50\" height=\"50\" />";
    }
    
    display("Thou Art Dead.",parsetemplate(gettemplate("pvp_lose"),$pagerow));

}

function updateopponent() {
    
    global $monsterrow;
    $monsterrow = array_map("uber_mres", $monsterrow);
    
    $querystring = "";
    foreach($monsterrow as $a=>$b) {
        $querystring .= "$a='$b',";
    }
    $querystring = rtrim($querystring, ",");
    
    $query = doquery("UPDATE users SET $querystring WHERE id='".$monsterrow["id"]."' LIMIT 1");
    
}

function dospellslist() {
    
    global $userrow, $spells;
    $options = "";
    for ($i = 1; $i < 11; $i++) {
        if ($userrow["spell".$i."id"] != 0) { 
            $options .= "<option value=\"".$userrow["spell".$i."id"]."\">".$userrow["spell".$i."name"]."</option>\n";
        }
    }
    if ($options != "") { 
        $list = "<select name=\"spellid\">$options</select> <input type=\"submit\" name=\"spell\" value=\"Cast Spell\" />";
    } else { $list = "<input type=\"submit\" name=\"spell\" value=\"Cast Spell\" disabled=\"disabled\" />"; }
    return $list;
    
}

?>
