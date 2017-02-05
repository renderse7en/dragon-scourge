<?php // fightmods.php :: functions for modifiers granted to you by items.

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

function hpleech($player) {
    
    /***********
    Description:    A percentage of the final damage is given back to the player's HP.
    Occurs:         Per Turn.
    Applies To:     Player or Monster.
    ***********/
    
    global $userrow, $fightrow, $monsterrow;
    if ($player == "player") {
        $userrow["currenthp"] += floor(($fightrow["playerphysdamage"]+$fightrow["playermagicdamage"]+$fightrow["playerfiredamage"]+$fightrow["playerlightdamage"]) * ($userrow["hpleech"]/100));
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $userrow["currenthp"] = $userrow["maxhp"]; }
    } else {
        $userrow["currentmonsterhp"] += floor(($fightrow["monsterphysdamage"]+$fightrow["monstermagicdamage"]+$fightrow["monsterfiredamage"]+$fightrow["monsterlightdamage"]) * ($monsterrow["hpleech"]/100));
        if ($userrow["currentmonsterhp"] > ($monsterrow["maxhp"] * $userrow["difficulty"])) { $userrow["currentmonsterhp"] = ($monsterrow["maxhp"] * $userrow["difficulty"]); }
    }
    
}

function mpleech() {
    
    /***********
    Description:    A percentage of the final damage is given back to the player's MP.
    Occurs:         Per Turn.
    Applies To:     Player only.
    ***********/
    
    global $userrow, $fightrow;
    $userrow["currentmp"] += floor(($fightrow["playerphysdamage"]+$fightrow["playermagicdamage"]+$fightrow["playerfiredamage"]+$fightrow["playerlightdamage"]) * ($userrow["mpleech"]/100));
    if ($userrow["currentmp"] > $userrow["maxmp"]) { $userrow["currentmp"] = $userrow["maxmp"]; }
    
}

function hpgain() {
    
    /***********
    Description:    A fixed number is added to player's HP.
    Occurs:         Per Kill.
    Applies To:     Player only.
    ***********/
    
    global $userrow, $fightrow;
    $userrow["currenthp"] += $userrow["hpgain"];
    if ($userrow["currenthp"] > $userrow["maxhp"]) { $userrow["currenthp"] = $userrow["maxhp"]; }
        
}

function mpgain() {
    
    /***********
    Description:    A fixed number is added to player's MP.
    Occurs:         Per Kill.
    Applies To:     Player only.
    ***********/
    
    global $userrow, $fightrow;
    $userrow["currentmp"] += $userrow["mpgain"];
    if ($userrow["currentmp"] > $userrow["maxmp"]) { $userrow["currentmp"] = $userrow["maxmp"]; }
        
}

function bonusattack() {
    
    /***********
    Description:    Chance to deal extra damage.
    Occurs:         Per Turn.
    Applies To:     Player only.
    Written By:     Anman.
    ***********/
    
    global $userrow, $fightrow;
    
    if ($userrow["bonusattack"] > 0) {
        
        $first = $userrow["bonusattack"] * 0.25;
        $sec = $userrow["bonusattack"] * 0.5;
        $third = $userrow["bonusattack"] * 0.75;
        $rand = rand(0,100);
        
        if ($rand <= $first) { $multiplier = 2; } 
        elseif ($rand <= $sec) { $multiplier = 1.75; } 
        elseif ($rand <= $third) { $multiplier = 1.5; } 
        elseif ($rand <= $userrow["bonusattack"] && $rand > $third) { $multiplier = 1.25; } 
        else { $multiplier = 1; }
        
     	$fightrow["playerphysdamage"] = floor($fightrow["playerphysdamage"] * $multiplier);
     	$fightrow["track"] .= "bonusattack - physdamage:".$fightrow["playerphysdamage"]."\n";
     	
    }
    
}

function bonusdefense() {
    
    /***********
    Description:    Chance to reduce incurred damage.
    Occurs:         Per Turn.
    Applies To:     Player only.
    Written By:     Anman.
    ***********/
    
    global $userrow, $fightrow;
    
    if ($userrow["bonusdefense"] > 0) {
        
        $first = $userrow["bonusdefense"] * 0.25;
        $sec = $userrow["bonusdefense"] * 0.5;
        $third = $userrow["bonusdefense"] * 0.75;
        $rand = rand(0,100);
        
        if ($rand <= $first) { $multiplier = 0; } 
        elseif ($rand <= $sec) { $multiplier = 0.25; } 
        elseif ($rand <= $third) { $multiplier = 0.5; } 
        elseif ($rand <= $userrow["bonusdefense"] && $rand > $third) { $multiplier = 0.75; } 
        else { $multiplier = 1; }
        
    	$fightrow["monsterphysdamage"] = floor($fightrow["monsterphysdamage"] * $multiplier);
    	$fightrow["monstermagicdamage"] = floor($fightrow["monstermagicdamage"] * $multiplier);
    	$fightrow["monsterfiredamage"] = floor($fightrow["monsterfiredamage"] * $multiplier);
    	$fightrow["monsterlightdamage"] = floor($fightrow["monsterlightdamage"] * $multiplier);
    	
    }
    
}

function bonusdefense_pvp() {
    
    /***********
    Description:    Chance to reduce incurred damage - PVP version.
    Occurs:         Per Turn.
    Applies To:     Player only.
    Written By:     Anman.
    ***********/
    
    global $userrow, $monsterrow, $fightrow;
    
    if ($userrow["bonusdefense"] > 0) {
        
        $first = $monsterrow["bonusdefense"] * 0.25;
        $sec = $monsterrow["bonusdefense"] * 0.5;
        $third = $monsterrow["bonusdefense"] * 0.75;
        $rand = rand(0,100);
        
        if ($rand <= $first) { $multiplier = 0; } 
        elseif ($rand <= $sec) { $multiplier = 0.25; } 
        elseif ($rand <= $third) { $multiplier = 0.5; } 
        elseif ($rand <= $monsterrow["bonusdefense"] && $rand > $third) { $multiplier = 0.75; } 
        else { $multiplier = 1; }
        
    	$fightrow["playerphysdamage"] = floor($fightrow["playerphysdamage"] * $multiplier);
    	$fightrow["playermagicdamage"] = floor($fightrow["playermagicdamage"] * $multiplier);
    	$fightrow["playerfiredamage"] = floor($fightrow["playerfiredamage"] * $multiplier);
    	$fightrow["playerlightdamage"] = floor($fightrow["playerlightdamage"] * $multiplier);
    	
    }
    
}

?>