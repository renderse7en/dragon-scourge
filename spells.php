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

?>