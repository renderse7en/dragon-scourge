<?php // fight.php :: primary fight controller.

include("lib.php");
include("globals.php");
include("fightmods.php");

// Global userrow.
global $userrow;
if ($userrow["currentaction"] != "Fighting") { die(header("Location: index.php")); }

// Global monsterrow.
if($userrow["currentmonsterid"] != 0) {
    $monsterquery = doquery("SELECT * FROM <<monsters>> WHERE id='".$userrow["currentmonsterid"]."' LIMIT 1");
    $monsterrow = dorow($monsterquery);
} else {
    rollmonster();
}

// Now we get to the real guts of the game. Yippy skippy.
dofight();

function rollmonster() {
    
    global $userrow, $monsterrow, $fightrow;
    if($userrow["latitude"] < 0) { $latitude = $userrow["latitude"] * -1; } else { $latitude = $userrow["latitude"]; }
    if($userrow["longitude"] < 0) { $longitude = $userrow["longitude"] * -1; } else { $longitude = $userrow["longitude"]; }
    $maxlevel = ceil(max($latitude, $longitude) / 5);
    $minlevel = $maxlevel - 3;
    $monsterquery = doquery("SELECT * FROM <<monsters>> WHERE world='".$userrow["world"]."' AND level >= $minlevel AND level <= $maxlevel ORDER BY RAND() LIMIT 1");
    $monsterrow = dorow($monsterquery);
    
    $userrow["currentmonsterhp"] = (ceil(rand($monsterrow["maxhp"] * .75, $monsterrow["maxhp"]) * $userrow["difficulty"]));
    $userrow["currentmonsterid"] = $monsterrow["id"];
    $userrow["currentaction"] = "Fighting";
    
    $fightrow["track"] .= "init fight / roll monster\nmid: ".$monsterrow["id"]."\nmhp:".$userrow["currentmonsterhp"]."\n\n";
    
    updateuserrow();
    dofight();
    
}

function dofight() {
    
    global $userrow, $monsterrow, $fightrow, $spells;
    
    if (isset($_POST["fight"])) {
        
        $fightrow["track"] .= "init turn\nmid:".$userrow["currentmonsterid"]."\nmhp:".$userrow["currentmonsterhp"]."\n\n";
        
        playerturn();
        if ($userrow["currentmonsterhp"] <= 0) { youwin(); }
        monsterturn();
        if ($userrow["currenthp"] <= 0) { youlose(); }
        updateuserrow();
        
        $pagerow = array(
            "message"=>$fightrow["message"],
            "monstername"=>$monsterrow["name"],
            "monsterhp"=>$userrow["currentmonsterhp"],
            "playerphysdamage"=>$fightrow["playerphysdamage"],
            "playermagicdamage"=>$fightrow["playermagicdamage"],
            "playerfiredamage"=>$fightrow["playerfiredamage"],
            "playerlightdamage"=>$fightrow["playerlightdamage"],
            "monsterphysdamage"=>$fightrow["monsterphysdamage"],
            "monstermagicdamage"=>$fightrow["monstermagicdamage"],
            "monsterfiredamage"=>$fightrow["monsterfiredamage"],
            "monsterlightdamage"=>$fightrow["monsterlightdamage"],
            "track"=>$fightrow["track"]);
        $pagerow["spells"] = dospellslist();
        display("Fighting",parsetemplate(gettemplate("fight_turn"),$pagerow));
        
    } elseif (isset($_POST["spell"])) {
    
        if (! is_numeric($_POST["spellid"])) { err("Invalid spell selection."); }
        $isavailable = 0;
        for ($i = 1; $i < 11; $i++) {
            if ($userrow["spell".$i."id"] == $_POST["spellid"]) { $isavailable = 1; }
        }
        if ($isavailable == 0) { err("You don't have that spell."); }
        
        include("spells.php");
        $castspell = $spells[$_POST["spellid"]]["fname"]($_POST["spellid"]);
        $userrow["currentmonsterhp"] -= ($fightrow["playerphysdamage"] + $fightrow["playermagicdamage"] + $fightrow["playerfiredamage"] + $fightrow["playerlightdamage"]);
        if ($userrow["currentmonsterhp"] <= 0) { youwin(); }
        monsterturn();
        if ($userrow["currenthp"] <= 0) { youlose(); }
        updateuserrow();
        
        $pagerow = array(
            "message"=>$castspell,
            "monstername"=>$monsterrow["name"],
            "monsterhp"=>$userrow["currentmonsterhp"],
            "playerphysdamage"=>$fightrow["playerphysdamage"],
            "playermagicdamage"=>$fightrow["playermagicdamage"],
            "playerfiredamage"=>$fightrow["playerfiredamage"],
            "playerlightdamage"=>$fightrow["playerlightdamage"],
            "monsterphysdamage"=>$fightrow["monsterphysdamage"],
            "monstermagicdamage"=>$fightrow["monstermagicdamage"],
            "monsterfiredamage"=>$fightrow["monsterfiredamage"],
            "monsterlightdamage"=>$fightrow["monsterlightdamage"],
            "track"=>$fightrow["track"]);
        $pagerow["spells"] = dospellslist();
        display("Fighting",parsetemplate(gettemplate("fight_turn"),$pagerow));
    
    } elseif (isset($_POST["run"])) {
        
        if (rand(4,10) + ceil(sqrt($userrow["dexterity"])) < (rand(1,5) + ceil(sqrt((0.75 * $monsterrow["physattack"]))))) {
            
            monsterturn();
            $fightrow["message"] .= "You tried to run away, but the monster blocked you!<br />";
            if ($userrow["currenthp"] <= 0) { youlose(); }
            updateuserrow();
            
            $pagerow = array(
                "message"=>$fightrow["message"],
                "monstername"=>$monsterrow["name"],
                "monsterhp"=>$userrow["currentmonsterhp"],
                "monsterphysdamage"=>$fightrow["monsterphysdamage"],
                "monstermagicdamage"=>$fightrow["monstermagicdamage"],
                "monsterfiredamage"=>$fightrow["monsterfiredamage"],
                "monsterlightdamage"=>$fightrow["monsterlightdamage"],
                "track"=>$fightrow["track"]);
            $pagerow["spells"] = dospellslist();
            display("Fighting",parsetemplate(gettemplate("fight_monsteronly"),$pagerow));
            
        }
    
        $userrow["currentaction"] = "Exploring";
        $userrow["currentmonsterid"] = 0;
        $userrow["currentmonsterhp"] = 0;
        updateuserrow();
        die(header("Location: index.php"));
        
    } else {
        
        if (rand(1,10) + ceil(sqrt($userrow["dexterity"])) < (rand(1,7) + ceil(sqrt((0.75 * $monsterrow["physattack"]))))) {
 
            monsterturn();
            $fightrow["message"] .= "The monster attacked before you were ready!<br />";
            if ($userrow["currenthp"] <= 0) { youlose(); }
            updateuserrow();
            
            $pagerow = array(
                "message"=>$fightrow["message"],
                "monstername"=>$monsterrow["name"],
                "monsterhp"=>$userrow["currentmonsterhp"],
                "monsterphysdamage"=>$fightrow["monsterphysdamage"],
                "monstermagicdamage"=>$fightrow["monstermagicdamage"],
                "monsterfiredamage"=>$fightrow["monsterfiredamage"],
                "monsterlightdamage"=>$fightrow["monsterlightdamage"],
                "track"=>$fightrow["track"]);
            $pagerow["spells"] = dospellslist();
            display("Fighting",parsetemplate(gettemplate("fight_monsteronly"),$pagerow));
            
        }
    
        $pagerow = array(
            "monstername"=>$monsterrow["name"],
            "monsterhp"=>$userrow["currentmonsterhp"],
            "track"=>$fightrow["track"]);
        $pagerow["spells"] = dospellslist();
        display("Fighting",parsetemplate(gettemplate("fight_new"),$pagerow));
        
    }
    
}

function playerturn() {
    
    global $userrow, $monsterrow, $fightrow;
    
    // Calculate all damages.
    if ($userrow["physattack"] != 0) {
        $physhit = ceil(rand($userrow["physattack"]*.75, $userrow["physattack"]) / 3);
        $physblock = ceil(rand($monsterrow["physdefense"]*.75, $monsterrow["physdefense"]) / 3);
        $fightrow["playerphysdamage"] = max($physhit - $physblock, 1);
        $fightrow["track"] .= "physdam init: " . $fightrow["playerphysdamage"] . "\n";
    }
    
    if ($userrow["magicattack"] != 0) {
        $magichit = ceil(rand($userrow["magicattack"]*.75, $userrow["magicattack"]) / 3);
        $magicblock = ceil(rand($monsterrow["magicdefense"]*.75, $monsterrow["magicdefense"]) / 3);
        $fightrow["playermagicdamage"] = max($magichit - $magicblock, 0);
        $fightrow["track"] .= "magicdam init: " . $fightrow["playermagicdamage"] . "\n";
    }
    
    if ($userrow["fireattack"] != 0) {
        $firehit = ceil(rand($userrow["fireattack"]*.75, $userrow["fireattack"]) / 3);
        $fireblock = ceil(rand($monsterrow["firedefense"]*.75, $monsterrow["firedefense"]) / 3);
        $fightrow["playerfiredamage"] = max($firehit - $fireblock, 0);
        $fightrow["track"] .= "firedam init: " . $fightrow["playerfiredamage"] . "\n";
    }
    
    if ($userrow["lightattack"] != 0) {
        $lighthit = ceil(rand($userrow["lightattack"]*.75, $userrow["lightattack"]) / 3);
        $lightblock = ceil(rand($monsterrow["lightdefense"]*.75, $monsterrow["lightdefense"]) / 3);
        $fightrow["playerlightdamage"] = max($lighthit - $lightblock, 0);
        $fightrow["track"] .= "lightdam init: " . $fightrow["playerlightdamage"] . "\n";
    }
    
    // Chance to make an excellent hit.
    $toexcellent = rand(0,150);
    if ($toexcellent <= sqrt($userrow["dexterity"])) { 
        $fightrow["playerphysdamage"] *= 2;
        $fightrow["playermagicdamage"] *= 2;
        $fightrow["playerfiredamage"] *= 2;
        $fightrow["playerlightdamage"] *= 2;
        $fightrow["message"] .= "<b>Excellent hit!</b><br />"; 
        $fightrow["track"] .= "excellent\nphys:".$fightrow["playerphysdamage"]."\nmagic:".$fightrow["playermagicdamage"]."\nfire:".$fightrow["playerfiredamage"]."\nlight:".$fightrow["playerlightdamage"]."\n";
    }
    
    // Chance for monster to dodge.
    $tododge = rand(0,200);
    if ($tododge <= sqrt($monsterrow["physdefense"])) { 
        $fightrow["playerphysdamage"] = 0;
        $fightrow["playermagicdamage"] = 0;
        $fightrow["playerfiredamage"] = 0;
        $fightrow["playerlightdamage"] = 0;
        $fightrow["message"] .= "<b>The monster dodged your hit!</b><br />"; 
        $fightrow["track"] .= "monster dodge: all damage to zero\n";
    }
    
    // Now we add Per Turn mods.
    bonusattack();
    hpleech("player");
    mpleech("player");
    
    // Subtract all damage from monster's hp.
    $userrow["currentmonsterhp"] -= ($fightrow["playerphysdamage"] + $fightrow["playermagicdamage"] + $fightrow["playerfiredamage"] + $fightrow["playerlightdamage"]);
    $fightrow["track"] .= "end turn - mhp:".$userrow["currentmonsterhp"];
    
}

function monsterturn() {
    
    global $userrow, $monsterrow, $fightrow;
    
    if ($monsterrow["physattack"] != 0) {
        $physhit = ceil((rand($monsterrow["physattack"]*.75, $monsterrow["physattack"]) / 3) * $userrow["difficulty"]);
        $physblock = ceil(rand($userrow["physdefense"]*.75, $userrow["physdefense"]) / 3);
        $fightrow["monsterphysdamage"] = max($physhit - $physblock, 1); // Have to do at least 1 physical damage.
    }
    
    if ($monsterrow["magicattack"] != 0) {
        $magichit = ceil((rand($monsterrow["magicattack"]*.75, $monsterrow["magicattack"]) / 3) * $userrow["difficulty"]);
        $magicblock = ceil(rand($userrow["magicdefense"]*.75, $userrow["magicdefense"]) / 3);
        $fightrow["monstermagicdamage"] = max($magichit - $magicblock, 0);
    }
    
    if ($monsterrow["fireattack"] != 0) {
        $firehit = ((rand($monsterrow["fireattack"]*.75, $monsterrow["fireattack"]) / 3) * $userrow["difficulty"]);
        $fireblock = ceil(rand($userrow["firedefense"]*.75, $userrow["firedefense"]) / 3);
        $fightrow["monsterfiredamage"] = max($firehit - $fireblock, 0);
    }
    
    if ($monsterrow["lightattack"] != 0) {
        $lighthit = ceil((rand($monsterrow["lightattack"]*.75, $monsterrow["lightattack"]) / 3) * $userrow["difficulty"]);
        $lightblock = ceil(rand($userrow["lightdefense"]*.75, $userrow["lightdefense"]) / 3);
        $fightrow["monsterlightdamage"] = max($lighthit - $lightblock, 0);
    }
    
    // Chance to make an excellent hit.
    $toexcellent = rand(0,150);
    if ($toexcellent <= sqrt($monsterrow["physdefense"])) { 
        $fightrow["monsterphysdamage"] *= 2;
        $fightrow["monstermagicdamage"] *= 2;
        $fightrow["monsterfiredamage"] *= 2;
        $fightrow["monsterlightdamage"] *= 2;
        $fightrow["message"] .= "<b>The monster made an excellent hit!</b><br />"; 
    }
    
    // Chance for player to dodge.
    $tododge = rand(0,200);
    if ($tododge <= sqrt($userrow["physdefense"])) { 
        $fightrow["monsterphysdamage"] = 0;
        $fightrow["monstermagicdamage"] = 0;
        $fightrow["monsterfiredamage"] = 0;
        $fightrow["monsterlightdamage"] = 0;
        $fightrow["message"] .= "<b>You dodged the monster's hit!</b><br />"; 
    }
    
    // Now we add Per Turn mods.
    bonusdefense();
    hpleech("monster");
    
    // Subtract all damage from player's hp.
    $userrow["currenthp"] -= ($fightrow["monsterphysdamage"] + $fightrow["monstermagicdamage"] + $fightrow["monsterfiredamage"] + $fightrow["monsterlightdamage"]);
    
}

function youwin() {
    
    global $userrow, $monsterrow, $fightrow;
    
    $template = "fight_win";

    $newexp = ceil(rand($monsterrow["maxexp"]*.75, $monsterrow["maxexp"]) * (1 + ($userrow["expbonus"] / 100)));
    $newgold = ceil(rand($monsterrow["maxgold"]*.75, $monsterrow["maxgold"]) * (1 + ($userrow["goldbonus"] / 100)));
    $userrow["experience"] += $newexp;
    $userrow["gold"] += $newgold;
    $userrow["currentaction"] = "Exploring";
    $userrow["currentfight"] = 0;
    $userrow["currentmonsterid"] = 0;
    $userrow["currentmonsterhp"] = 0;
    if ($monsterrow["newstory"] != "0") {
        $userrow["story"] = $monsterrow["newstory"];
    }
    $userrow["bonusattack"] = 0;
    $userrow["bonusdefense"] = 0;
    
    // Now we add Per Kill mods.
    hpgain();
    mpgain();
    
    // Check for new levelup.
    if ($userrow["experience"] >= dolevels($userrow["level"]+1)) {
        $template = "fight_levelup";
        $userrow["level"]++;
        $userrow["levelup"] += 5;
        $userrow["maxtp"] += 5;
        $userrow["currenthp"] = $userrow["maxhp"];
        $userrow["currentmp"] = $userrow["maxmp"];
        $userrow["currenttp"] = $userrow["maxtp"];
        if (($userrow["level"] % 5 == 0)) { $userrow["levelspell"]++; $template = "fight_levelupspell"; }
    }
    
    // Roll for monster drop.
    if (rand(0,7) == 1) {
        
        // Grab lots of stuff from the DB.
        $preitemsrow = dorow(doquery("SELECT * FROM <<itembase>> WHERE reqlevel>='".($userrow["level"] - 5)."' AND reqlevel<='".$userrow["level"]."' AND willdrop='1' ORDER BY RAND() LIMIT 1", "itembase"));
        $preprefixrow = dorow(doquery("SELECT * FROM <<itemprefixes>> WHERE reqlevel<='".$userrow["level"]."' ORDER BY RAND() LIMIT 1", "itemprefixes"));
        $presuffixrow = dorow(doquery("SELECT * FROM <<itemsuffixes>> WHERE reqlevel<='".$userrow["level"]."' ORDER BY RAND() LIMIT 1", "itemsuffixes"));
        
        if ($preitemsrow["isunique"] == 1) {
            $idstring = "0," . $preitemsrow["id"] . ",0";
        } else {
            $idstring = "";
            if (rand(0,4)==1) { $idstring .= $preprefixrow["id"] . ","; } else { $idstring .= "0,"; }
            $idstring .= $preitemsrow["id"] . ",";
            if (rand(0,4)==1) { $idstring .= $presuffixrow["id"]; } else { $idstring .= "0"; }
        }
        $userrow["dropidstring"] = $idstring;
        $fightrow["message"] .= "<a href=\"index.php?do=itemdrop\" class=\"red\"><b>The monster has dropped an item! Click here for more information.</b></a><br />";
        
    }
    
    // Update for new stats.
    updateuserrow();
    
    // And we're done.
    $pagerow = array(
        "message"=>$fightrow["message"],
        "monstername"=>$monsterrow["name"],
        "monsterhp"=>$userrow["currentmonsterhp"],
        "playerphysdamage"=>$fightrow["playerphysdamage"],
        "playermagicdamage"=>$fightrow["playermagicdamage"],
        "playerfiredamage"=>$fightrow["playerfiredamage"],
        "playerlightdamage"=>$fightrow["playerlightdamage"],
        "monsterphysdamage"=>$fightrow["monsterphysdamage"],
        "monstermagicdamage"=>$fightrow["monstermagicdamage"],
        "monsterfiredamage"=>$fightrow["monsterfiredamage"],
        "monsterlightdamage"=>$fightrow["monsterlightdamage"],
        "newexp"=>$newexp,
        "newgold"=>$newgold);
    display("Victory!",parsetemplate(gettemplate($template),$pagerow));
    
}

function youlose() {
    
    global $userrow, $monsterrow, $fightrow;
    
    // First take away half the gold.
    $userrow["gold"] = ceil($userrow["gold"] / 2);
    
    // Then take away experience.
    $thislevel = dolevels($userrow["level"]);
    $nextlevel = dolevels($userrow["level"]+1);
    $userrow["experience"] -= ceil((($nextlevel - $thislevel) / 100) * $userrow["deathpenalty"]);
    
    // And we're done.
    $pagerow = array(
        "message"=>$fightrow["message"],
        "monstername"=>$monsterrow["name"],
        "monsterhp"=>$userrow["currentmonsterhp"],
        "playerphysdamage"=>$fightrow["playerphysdamage"],
        "playermagicdamage"=>$fightrow["playermagicdamage"],
        "playerfiredamage"=>$fightrow["playerfiredamage"],
        "playerlightdamage"=>$fightrow["playerlightdamage"],
        "monsterphysdamage"=>$fightrow["monsterphysdamage"],
        "monstermagicdamage"=>$fightrow["monstermagicdamage"],
        "monsterfiredamage"=>$fightrow["monsterfiredamage"],
        "monsterlightdamage"=>$fightrow["monsterlightdamage"],
        "deathpenalty"=>$userrow["deathpenalty"]);
        
    // Then put them in town & reset fight stuff.
    $townrow = dorow(doquery("SELECT * FROM <<towns>> WHERE world='".$userrow["world"]."' ORDER BY id ASC LIMIT 1"));
    $userrow["latitude"] = $townrow["latitude"];
    $userrow["longitude"] = $townrow["longitude"];
    $userrow["currentaction"] = "In Town";
    $userrow["currentfight"] = 0;
    $userrow["currentmonsterid"] = 0;
    $userrow["currentmonsterhp"] = 0;
    $userrow["currenthp"] = ceil($userrow["maxhp"] / 4);
    $userrow["bonusattack"] = 0;
    $userrow["bonusdefense"] = 0;
    
    // Update.
    updateuserrow();
    
    display("Thou Art Dead.",parsetemplate(gettemplate("fight_lose"),$pagerow));

}

function dolevels($level) {
    
    $leveltotal = 15;
    $leveladd = 15;
    $i = 2;
    while ($i < $level) {
        $levelstart = $leveltotal;
        if ($i < 4) { 
            $leveladd = ceil($leveladd * 2.0);
        } elseif ($i < 13) { 
            $leveladd = floor($leveladd * 1.45);
        } elseif ($i < 40) { 
            $leveladd = floor($leveladd * 1.20);
        } elseif ($i < 60) { 
            $leveladd = 150000;
        } elseif ($i < 80) { 
            $leveladd = 200000;
        } elseif ($i < 100) { 
            $leveladd = 300000;
        } elseif ($i >= 100) { 
            $leveladd = 500000;
        }
        $leveltotal = $levelstart + $leveladd;
        $i++;
    }
    return $leveltotal;
    
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