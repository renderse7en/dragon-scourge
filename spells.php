<?php // spells.php :: functions for spells.

function heal($id) {
    
    global $userrow, $spells;
    
    $failed = 0;
    if ($userrow["currentmp"] < $spells[$id]["mp"]) { $return = "<span class=\"red\"><b>Spell Failed:</b> You do not have enough MP to cast that spell.</span><br />"; $failed = 1; }
    
    if ($failed == 0) { 
        $userrow["currenthp"] += $spells[$id]["value"];
        $userrow["currentmp"] -= $spells[$id]["mp"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $userrow["currenthp"] = $userrow["maxhp"]; }
        $return = $userrow["charname"] . " casts " . $spells[$id]["name"] . " and gains " . $spells[$id]["value"] . " HP.<br />";
    }
    
    return($return);
    
}

function hurt($id) {
    
    global $userrow, $monsterrow, $fightrow, $spells;
    
    $failed = 0;
    if ($userrow["currentmp"] < $spells[$id]["mp"]) { $return = "<span class=\"red\"><b>Spell Failed:</b> You do not have enough MP to cast that spell.</span><br />"; $failed = 1; }
    
    if ($failed == 0) { 
        $userrow["currentmp"] -= $spells[$id]["mp"];
        $magichit = ceil(rand($spells[$id]["value"]*.75, $spells[$id]["value"]));
        $magicblock = ceil(rand($monsterrow["magicdefense"]*.75, $monsterrow["magicdefense"]) / 5);
        $fightrow["playermagicdamage"] = max($magichit - $magicblock, 0);
        $return = $userrow["charname"] . " casts " . $spells[$id]["name"] . " for " . $fightrow["playermagicdamage"] . " damage.<br />";
    }
    
    return($return);
    
}

function fire($id) {
    
    global $userrow, $monsterrow, $fightrow, $spells;
    
    $failed = 0;
    if ($userrow["currentmp"] < $spells[$id]["mp"]) { $return = "<span class=\"red\"><b>Spell Failed:</b> You do not have enough MP to cast that spell.</span><br />"; $failed = 1; }
    
    if ($failed == 0) { 
        $userrow["currentmp"] -= $spells[$id]["mp"];
        $magichit = ceil(rand($spells[$id]["value"]*.75, $spells[$id]["value"]));
        $magicblock = ceil(rand($monsterrow["firedefense"]*.75, $monsterrow["firedefense"]) / 5);
        $fightrow["playerfiredamage"] = max($magichit - $magicblock, 0);
        $return = $userrow["charname"] . " casts " . $spells[$id]["name"] . " for " . $fightrow["playerfiredamage"] . " damage.<br />";
    }
    
    return($return);
    
}

function light($id) {
    
    global $userrow, $monsterrow, $fightrow, $spells;
    
    $failed = 0;
    if ($userrow["currentmp"] < $spells[$id]["mp"]) { $return = "<span class=\"red\"><b>Spell Failed:</b> You do not have enough MP to cast that spell.</span><br />"; $failed = 1; }
    
    if ($failed == 0) { 
        $userrow["currentmp"] -= $spells[$id]["mp"];
        $magichit = ceil(rand($spells[$id]["value"]*.75, $spells[$id]["value"]));
        $magicblock = ceil(rand($monsterrow["lightdefense"]*.75, $monsterrow["lightdefense"]) / 5);
        $fightrow["playerlightdamage"] = max($magichit - $magicblock, 0);
        $return = $userrow["charname"] . " casts " . $spells[$id]["name"] . " for " . $fightrow["playerlightdamage"] . " damage.<br />";
    }
    
    return($return);
    
}

function prism($id) {
    
    global $userrow, $monsterrow, $fightrow, $spells;
    
    $failed = 0;
    if ($userrow["currentmp"] < $spells[$id]["mp"]) { $return = "<span class=\"red\"><b>Spell Failed:</b> You do not have enough MP to cast that spell.</span><br />"; $failed = 1; }
    
    if ($failed == 0) { 
        $userrow["currentmp"] -= $spells[$id]["mp"];
        $magichit = ceil(rand($spells[$id]["value"]*.75, $spells[$id]["value"]));
        $magicblock = ceil(rand($monsterrow["lightdefense"]*.75, $monsterrow["lightdefense"]) / 5);
        $fightrow["playerlightdamage"] = max($magichit - $magicblock, 0);
        $return = $userrow["charname"] . " casts " . $spells[$id]["name"] . " for " . $fightrow["playerlightdamage"] . " damage.<br />";
    }
    
    return($return);
    
}

// Mad crazy ninja love to Anman for writing this spell. I've cleaned it up a bit to match the format of the rest of the code, but it's his spell.
function blessedstrike($id) {

    global $userrow, $monsterrow, $fightrow, $spells;
	$failed = 0;
    if ($userrow["currentmp"] < $spells[$id]["mp"]) { $return = "<span class=\"red\"><b>Spell Failed:</b> You do not have enough MP to cast that spell.</span><br />"; $failed = 1; }

    if ($failed == 0) {
    
        //now define the power of the spell. you can stack these spells, but the more you try to stack it the harder it will be to get a decent number out of the stack. Now, this spell is more of a bonus to a player compared to the defence spell. So for this reason, the ratio of stacking has been decreased from 100 to 90 and the minimum % to take of the spell is now 10% instead of 20%.
        $userrow["currentmp"] -= $spells[$id]["mp"];
        if ($userrow["bonusattack"] == 0) { 
        	$userrow["bonusattack"] = $spells[$id]["value"];
    	} else { 
    		//if a more powerful inc attack spell is cast, replace the old value with the new one
    		if ($userrow["bonusattack"] < $spells[$id]["value"]) {
    			$userrow["bonusattack"] = $spells[$id]["value"];
			} else {
				//if the same or a weaker spell is cast, determine the maximum stack number and then apply..
				$newattmax = ((90 - $userrow["bonusattack"])+1) / 90;
				if ($newattmax < 0.1) { $newattmax = 0.1;}
				$newattmax = $spells[$id]["value"] * $newattmax;
				$newattmax = floor($newattmax);
				if ($newattmax < 1) { $newattmax = 1;}
				if ($spells[$id]["value"] > $newattmax) {$spells[$id]["value"] = $newattmax;}
				$userrow["bonusattack"] = $userrow["bonusattack"] + $spells[$id]["value"];
    	    }
    	    if ($userrow["bonusattack"] > 200) { $userrow["bonusattack"] = 200; }
    	    // *2 damage delt will never go above 50% chance. *1.75 damage will always be 50%
    	}
    	
    	$return = $userrow["charname"] . " casts " . $spells[$id]["name"] . ". Future attacks will be more powerful!<br />";
    	
    }

	return($return);

}

// Mad crazy ninja love to Anman for writing this spell. I've cleaned it up a bit to match the format of the rest of the code, but it's his spell.
function stoneskin($id) {

    global $userrow, $monsterrow, $fightrow, $spells;
	$failed = 0;
    if ($userrow["currentmp"] < $spells[$id]["mp"]) { $return = "<span class=\"red\"><b>Spell Failed:</b> You do not have enough MP to cast that spell.</span><br />"; $failed = 1; }

    if ($failed ==0 ) {
    
        //now define the power of the spell. you can stack these spells, but the more you try to stack it the harder it will be to get a decent number out of the stack. The max will always be 100. This is because the spell works with percentages and 100 will always be the highest.
        $userrow["currentmp"] -= $spells[$id]["mp"];
        if ($userrow["bonusdefence"] == 0) { 
        	$userrow["bonusdefence"] = $spells[$id]["value"];
    	} else { 
    		//if a more powerful defence spell is cast, replace the old value with the new one
    		if ($userrow["bonusdefence"] < $spells[$id]["value"]) {
			    $userrow["bonusdefence"] = $spells[$id]["value"];
			} else {
				//if the same or a weaker spell is cast, determine the maximum stack number and then apply..
				$newdefmax = ((100 - $userrow["bonusdefence"])+1) / 100;
				if ($newdefmax < 0.2) { $newdefmax = 0.2;}
				$newdefmax = $spells[$id]["value"] * $newdefmax;
				$newdefmax = floor($newdefmax);
				if ($newdefmax < 1) { $newdefmax = 1;}
				if ($spells[$id]["value"] > $newdefmax) {$spells[$id]["value"] = $newdefmax;}
				$userrow["bonusdefence"] = $userrow["bonusdefence"] + $spells[$id]["value"];
	        }
        	if ($userrow["bonusdefence"] > 200) { $userrow["bonusdefence"] = 200;}
        	// all damage will never go above 50% chance. 0.25% damage will always be 50%
    	}
    	
    	$return = $userrow["charname"] . " casts " . $spells[$id]["name"] . ". Damage taken will be reduced!<br />";
    	
	}
	return($return);
}

?>