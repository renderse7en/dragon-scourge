<?php // fightmods.php :: functions for modifiers granted to you by items.

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
        if ($userrow["currentmonsterhp"] > $monsterrow["maxhp"]) { $userrow["currentmonsterhp"] = $monsterrow["maxhp"]; }
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

?>