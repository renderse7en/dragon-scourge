<?php // lib2.php :: functions with an arguably narrower focus than the stuff in the primary library.

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

function updateuserrow() {
    
    global $userrow;
    $userrow = array_map("uber_mres", $userrow);
    
    $querystring = "";
    foreach($userrow as $a=>$b) {
        $querystring .= "$a='$b',";
    }
    $querystring = rtrim($querystring, ",");
    
    $query = doquery("UPDATE users SET $querystring WHERE id='".$userrow["id"]."' LIMIT 1");
    
}

function builditem($prefix, $baseitem, $suffix, $modrow) { // Copy of town.php's builditem().
    
    global $controlrow, $acctrow, $userrow;
    
    // First setup the basic item attributes.
    $baseitem["baseid"] = $baseitem["id"];
    $baseitem["fullid"] = $baseitem["id"];
    $baseitem["attrtype"] = $modrow[$baseitem["basename"]]["prettyname"];
    $baseitem["basevalue"] = $baseitem["baseattr"];
    $baseitem["image"] = "";
    
    // Next give pretty names to any item modifiers.
    $baseitem["itemmods"] = "";
    for($j=1; $j<7; $j++) { 
        if ($baseitem["mod".$j."name"] != "") {
            $baseitem["itemmods"] .= $modrow[$baseitem["mod".$j."name"]]["prettyname"] . ": +" . $baseitem["mod".$j."attr"];
            if ($modrow[$baseitem["mod".$j."name"]]["percent"] == 1) { $baseitem["itemmods"] .= "%"; }
            $baseitem["itemmods"] .= "<br />\n";
        }
    }
    
    // Add prefix mods if applicable.
    if ($prefix != false) {
        $baseitem["fullid"] = $prefix["id"] . "," . $baseitem["fullid"];
        $baseitem["name"] = $prefix["name"] . " " . $baseitem["name"];
        $baseitem["buycost"] += $prefix["buycost"];
        $baseitem["sellcost"] += $prefix["sellcost"];
        $baseitem["reqlevel"] = max($baseitem["reqlevel"], $prefix["reqlevel"]);
        $baseitem["reqstrength"] += $prefix["reqstrength"];
        $baseitem["reqenergy"] += $prefix["reqenergy"];
        $baseitem["reqdexterity"] += $prefix["reqdexterity"];
        $baseitem["itemmods"] .= $modrow[$prefix["basename"]]["prettyname"] . ": +" . $prefix["baseattr"];
        if ($modrow[$prefix["basename"]]["percent"] == 1) { $baseitem["itemmods"] .= "%"; }
        $baseitem["itemmods"] .= "<br />\n";
    } else { $baseitem["fullid"] = "0," . $baseitem["fullid"]; }
    
    // Add suffix mods if applicable.
    if ($suffix != false) {
        $baseitem["fullid"] .= "," . $suffix["id"];
        $baseitem["name"] .= " " . $suffix["name"];
        $baseitem["buycost"] += $suffix["buycost"];
        $baseitem["sellcost"] += $suffix["sellcost"];
        $baseitem["reqlevel"] = max($baseitem["reqlevel"], $suffix["reqlevel"]);
        $baseitem["reqstrength"] += $suffix["reqstrength"];
        $baseitem["reqenergy"] += $suffix["reqenergy"];
        $baseitem["reqdexterity"] += $suffix["reqdexterity"];
        $baseitem["itemmods"] .= $modrow[$suffix["basename"]]["prettyname"] . ": +" . $suffix["baseattr"];
        if ($modrow[$suffix["basename"]]["percent"] == 1) { $baseitem["itemmods"] .= "%"; }
        $baseitem["itemmods"] .= "<br />\n";
    } else { $baseitem["fullid"] .= ",0"; }
    
    // Check requirements.
    $baseitem["requirements"] = true;
    if ($baseitem["reqlevel"] == 1) { $baseitem["level"] = ""; } else { 
        $baseitem["level"] = "Required Level: " . $baseitem["reqlevel"];
        if ($baseitem["reqlevel"] > $userrow["level"]) { 
            $baseitem["level"] = "<span class=\"red\">".$baseitem["level"]."</span>"; 
            $baseitem["requirements"] = false; 
        }
        $baseitem["level"] .= "<br />\n";
    }
    if ($baseitem["reqstrength"] == 0) { $baseitem["strength"] = ""; } else { 
        $baseitem["strength"] = "Required Strength: " . $baseitem["reqstrength"];
        if ($baseitem["reqstrength"] > $userrow["strength"]) { 
            $baseitem["strength"] = "<span class=\"red\">".$baseitem["strength"]."</span>"; 
            $baseitem["requirements"] = false; 
        }
        $baseitem["strength"] .= "<br />\n";
    }
    if ($baseitem["reqdexterity"] == 0) { $baseitem["dexterity"] = ""; } else { 
        $baseitem["dexterity"] = "Required Dexterity: " . $baseitem["reqdexterity"];
        if ($baseitem["reqdexterity"] > $userrow["dexterity"]) { 
            $baseitem["dexterity"] = "<span class=\"red\">".$baseitem["dexterity"]."</span>"; 
            $baseitem["requirements"] = false; 
        }
        $baseitem["dexterity"] .= "<br />\n";
    }
    if ($baseitem["reqenergy"] == 0) { $baseitem["energy"] = ""; } else { 
        $baseitem["energy"] = "Required Energy: " . $baseitem["reqenergy"];
        if ($baseitem["reqenergy"] > $userrow["energy"]) { 
            $baseitem["energy"] = "<span class=\"red\">".$baseitem["energy"]."</span>"; 
            $baseitem["requirements"] = false; 
        }
        $baseitem["energy"] .= "<br />\n";
    }
    
    if ($controlrow["showitemimages"] == 1) { 
        $baseitem["image"] = "<img src=\"images/items/".$baseitem["slotnumber"].$acctrow["imageformat"]."\" alt=\"".$baseitem["name"]."\" title=\"".$baseitem["name"]."\" />";
    } elseif ($controlrow["showitemimages"] == 2) { 
        $baseitem["image"] = "<img src=\"images/items/".$baseitem["id"].$acctrow["imageformat"]."\" alt=\"".$baseitem["name"]."\" title=\"".$baseitem["name"]."\" />";
    } else {
        $baseitem["image"] = "";
    }
    
    // And send it back.
    return $baseitem;
    
}

?>
