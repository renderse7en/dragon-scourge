<?php // town.php :: All town functions.

// Before allowing anything else, we make sure the person is actually in town.
global $townrow;
if ($townrow == false) { die(header("Location: index.php")); }

function dotown() { // Default town screen.
    
    global $userrow;
    $newpm = doquery("SELECT * FROM {{table}} WHERE recipientid='".$userrow["id"]."' AND status='0'", "messages");
    if (mysql_num_rows($newpm) > 0) {
        $row["unread"] = "<b>(".mysql_num_rows($newpm)." new)</b>";
    } else {
        $row["unread"] = "";
    }
    display("In Town", parsetemplate(gettemplate("town"), $row));

}

function inn() { // Resting at the inn restores hp/mp/tp.
    
    global $userrow, $townrow;

    // Errors.
    if ($userrow["gold"] < $townrow["innprice"]) { err("You do not have enough gold to stay at the inn. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($userrow["currenthp"] == $userrow["maxhp"] && $userrow["currentmp"] == $userrow["maxmp"] && $userrow["currenttp"] == $userrow["maxtp"]) { err("Your HP, MP and TP are already at their maximum levels. You do not need to stay at the Inn tonight.<br /><br /><a href=\"index.php\">Click here</a> to return to the main town screen."); }    

    if (isset($_POST["submit"])) {
        
        // Fill 'er up, my man!
        $userrow["currenthp"] = $userrow["maxhp"];
        $userrow["currentmp"] = $userrow["maxmp"];
        $userrow["currenttp"] = $userrow["maxtp"];
        $userrow["gold"] -= $townrow["innprice"];
        $query = doquery("UPDATE {{table}} SET currenthp='".$userrow["maxhp"]."', currentmp='".$userrow["maxmp"]."', currenttp='".$userrow["maxtp"]."', gold='".$userrow["gold"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        display("Rest at the Inn", gettemplate("town_inn2"));
        
    } elseif (isset($_POST["abortmission"])) { die(header("Location: index.php")); }
    
    display("Rest at the Inn", parsetemplate(gettemplate("town_inn1"), $townrow));
    
}

function map() { // Buy maps to towns for the Travel To menu.
    
    global $userrow;
    
    if (isset($_POST["three"])) {

        $townquery = doquery("SELECT * FROM {{table}} WHERE id='".$_POST["id"]."' LIMIT 1", "towns");
        $townrow = dorow($townquery);
        
        if ($userrow["gold"] < $townrow["mapprice"]) { err("You do not have enough gold to buy this map. Please <a href=\"index.php\">go back</a> and try again."); }
        
        if ($townrow != false) {
            $userrow["townslist"] .= "," . $townrow["id"];
            $userrow["gold"] -= $townrow["mapprice"];
            $query = doquery("UPDATE {{table}} SET townslist='".$userrow["townslist"]."', gold='".$userrow["gold"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
            display("Buy Maps", gettemplate("town_map3"));
        } else {
            err("Invalid action. Please <a href=\"index.php\">go back</a> and try again.");
        }
        
    } elseif (isset($_POST["two"])) {
        
        $townquery = doquery("SELECT * FROM {{table}} WHERE name='".$_POST["two"]."' LIMIT 1", "towns");
        $townrow = dorow($townquery);
        
        if ($userrow["gold"] < $townrow["mapprice"]) { err("You do not have enough gold to buy this map. Please <a href=\"index.php\">go back</a> and try again."); }
        
        if ($townrow != false) {
            display("Buy Maps", parsetemplate(gettemplate("town_map2"), $townrow));
        } else {
            err("Invalid action. Please <a href=\"index.php\">go back</a> and try again.");
        }
        
    } else {
    
        $townquery = doquery("SELECT * FROM {{table}} ORDER BY id", "towns");
        $townrow = dorow($townquery);
        $townslist = explode(",",$userrow["townslist"]);
        
        $row["maptable"] = "<form action=\"index.php?do=maps\" method=\"post\"><table width=\95%\">\n";
        foreach($townrow as $a=>$b) {
            if (in_array($b["id"], $townslist)) {
                if ($b["latitude"] < 0) { $latitude = ($b["latitude"] * -1) . "S"; } else { $latitude = $b["latitude"] . "N"; }
                if ($b["longitude"] < 0) { $longitude = ($b["longitude"] * -1) . "W"; } else { $longitude = $b["longitude"] . "E"; }
                $row["maptable"] .= "<tr><td width=\"20%\"><input type=\"submit\" name=\"two\" value=\"".$b["name"]."\" style=\"width: 100px;\" disabled=\"disabled\" /></td><td width=\"30%\" style=\"vertical-align: middle;\"><span class=\"grey\">Already Purchased</span></td><td width=\"30%\" style=\"vertical-align: middle;\"><span class=\"grey\">Location: <b>$latitude, $longitude</b></span></td><td width=\"20%\" style=\"vertical-align: middle;\"><span class=\"grey\">TP: <b>".$b["travelpoints"]."</b></span></td></tr>\n";
            } else {
                $row["maptable"] .= "<tr><td width=\"20%\"><input type=\"submit\" name=\"two\" value=\"".$b["name"]."\" style=\"width: 100px;\" /></td><td width=\"30%\" style=\"vertical-align: middle;\">Price: <b>".$b["mapprice"]." Gold</b></td><td colspan=\"2\" style=\"vertical-align: middle;\">Buy map to reveal details.</td></tr>\n";
            }
        }
        $row["maptable"] .= "</table></form>\n";
        display("Buy Maps", parsetemplate(gettemplate("town_map1"), $row));
        
    }
    
}

function buy() { // Buy items from merchants.
    
    /*
    1: Weapon
    2: Armor
    3: Shield
    4: Helmet
    5: Jewel
    6: Stone
    */
    
    global $userrow, $townrow;
    
    if (isset($_POST["three"])) { 
        
        $idstring = explode(",",$_POST["idstring"]);
        foreach($idstring as $a=>$b) { if(!is_numeric($b)) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); } }
        
        // Get database info on new item.
        $newbaseitem = dorow(doquery("SELECT * FROM {{table}} WHERE id='$idstring[1]' LIMIT 1", "itembase"));
        $newprefix = dorow(doquery("SELECT * FROM {{table}} WHERE id='$idstring[0]' LIMIT 1", "itemprefixes"));
        $newsuffix = dorow(doquery("SELECT * FROM {{table}} WHERE id='$idstring[2]' LIMIT 1", "itemsuffixes"));
        $premodrow = dorow(doquery("SELECT * FROM {{table}} ORDER BY id","itemmodnames"));
        
        // Format the mod name row.
        foreach($premodrow as $a=>$b) {
            $modrow[$b["fieldname"]] = $b;
        }
        
        $newfullitem = builditem($newprefix, $newbaseitem, $newsuffix, $modrow);
        
        // Get database info on old item, if applicable.
        if ($userrow["item" . $newbaseitem["slotnumber"] . "idstring"] != "0") {
            
            $oldidstring = explode(",",$userrow["item" . $newbaseitem["slotnumber"] . "idstring"]);
            $oldbaseitem = dorow(doquery("SELECT * FROM {{table}} WHERE id='$oldidstring[1]' LIMIT 1", "itembase"));
            $oldprefix = dorow(doquery("SELECT * FROM {{table}} WHERE id='$oldidstring[0]' LIMIT 1", "itemprefixes"));
            $oldsuffix = dorow(doquery("SELECT * FROM {{table}} WHERE id='$oldidstring[2]' LIMIT 1", "itemsuffixes"));
            $oldfullitem = builditem($oldprefix, $oldbaseitem, $oldsuffix, $modrow);
            
        } else { $oldfullitem = false; $oldprefix = false; $oldsuffix = false; }
        
        // Requirements check.
        if ($newfullitem["requirements"] == false) { err("You do not meet one or more of the requirements for this item. Please <a href=\"index.php\">go back</a> and try again."); }
        if ($userrow["gold"] < $newfullitem["buycost"]) { err("You do not have enough gold in your pocket to buy this item."); }
        
        // Now do stuff to userrow (new item only).
        $userrow["item" . $newfullitem["slotnumber"] . "idstring"] = $newfullitem["fullid"];
        $userrow["item" . $newfullitem["slotnumber"] . "name"] = $newfullitem["name"];
        $userrow["gold"] -= $newfullitem["buycost"];
        $userrow[$newfullitem["basename"]] += $newfullitem["baseattr"];
        for($j=1; $j<7; $j++) { 
            if ($newfullitem["mod".$j."name"] != "") {
                $userrow[$newfullitem["mod".$j."name"]] += $newfullitem["mod".$j."attr"];
            }
        }
        if ($newprefix != false) {
            $userrow[$newprefix["basename"]] += $newprefix["baseattr"];
        }
        if ($newsuffix != false) {
            $userrow[$newsuffix["basename"]] += $newsuffix["baseattr"];
        }
        
        // Do more stuff to userrow (old item only).
        if ($oldfullitem != false) {
            
            $userrow["gold"] += $oldfullitem["sellcost"];
            $userrow[$oldfullitem["basename"]] -= $oldfullitem["baseattr"];
            for($j=1; $j<7; $j++) { 
                if ($oldfullitem["mod".$j."name"] != "") {
                    $userrow[$oldfullitem["mod".$j."name"]] -= $oldfullitem["mod".$j."attr"];
                }
            }
            if ($oldprefix != false) {
                $userrow[$oldprefix["basename"]] -= $oldprefix["baseattr"];
            }
            if ($oldsuffix != false) {
                $userrow[$oldsuffix["basename"]] -= $oldsuffix["baseattr"];
            }
            
        }
        
        // And we're done.
        updateuserrow();
        display("Buy Weapons & Armor", gettemplate("town_buy3"));
        
    } elseif (isset($_POST["two"])) {
        
        $idstring = explode(",",$_POST["idstring"]);
        foreach($idstring as $a=>$b) { if(!is_numeric($b)) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); } }
        
        // Get database info on new item.
        $newbaseitem = dorow(doquery("SELECT * FROM {{table}} WHERE id='$idstring[1]' LIMIT 1", "itembase"));
        $newprefix = dorow(doquery("SELECT * FROM {{table}} WHERE id='$idstring[0]' LIMIT 1", "itemprefixes"));
        $newsuffix = dorow(doquery("SELECT * FROM {{table}} WHERE id='$idstring[2]' LIMIT 1", "itemsuffixes"));
        $premodrow = dorow(doquery("SELECT * FROM {{table}} ORDER BY id","itemmodnames"));
        
        // Format the mod name row.
        foreach($premodrow as $a=>$b) {
            $modrow[$b["fieldname"]] = $b;
        }
        
        $newfullitem = builditem($newprefix, $newbaseitem, $newsuffix, $modrow);
        
        // Get database info on old item, if applicable.
        if ($userrow["item" . $newbaseitem["slotnumber"] . "idstring"] != "0") {
            
            $oldidstring = explode(",",$userrow["item" . $newbaseitem["slotnumber"] . "idstring"]);
            $oldbaseitem = dorow(doquery("SELECT * FROM {{table}} WHERE id='$oldidstring[1]' LIMIT 1", "itembase"));
            $oldprefix = dorow(doquery("SELECT * FROM {{table}} WHERE id='$oldidstring[0]' LIMIT 1", "itemprefixes"));
            $oldsuffix = dorow(doquery("SELECT * FROM {{table}} WHERE id='$oldidstring[2]' LIMIT 1", "itemsuffixes"));
            $oldfullitem = builditem($oldprefix, $oldbaseitem, $oldsuffix, $modrow);
            
        } else { $oldfullitem = false; }
        
        // Requirements check.
        if ($newfullitem["requirements"] == false) { err("You do not meet one or more of the requirements for this item. Please <a href=\"index.php\">go back</a> and try again."); }
        if ($userrow["gold"] < $newfullitem["buycost"]) { err("You do not have enough gold in your pocket to buy this item."); }
        
        // Now make a new array to send to the template.
        $full = "_empty";
        $row["newname"] = $newfullitem["name"];
        if ($oldfullitem != false) {
            $row["oldname"] = $oldfullitem["name"];
            $row["oldsell"] = $oldfullitem["sellcost"];
            $full = "_full";
        }
        $row["newidstring"] = $newfullitem["fullid"];
        
        // And we're done.
        display("Buy Weapons & Armor", parsetemplate(gettemplate("town_buy2" . $full),$row));
        
    } else {
        
        // Grab lots of stuff from the DB.
        $itemsrow = dorow(doquery("SELECT * FROM {{table}} WHERE reqlevel>='".$townrow["itemminlvl"]."' AND reqlevel<='".$townrow["itemmaxlvl"]."' ORDER BY RAND() LIMIT 10 ", "itembase"));
        $prefixrow = dorow(doquery("SELECT * FROM {{table}} WHERE reqlevel<='".$userrow["level"]."'", "itemprefixes"));
        $suffixrow = dorow(doquery("SELECT * FROM {{table}} WHERE reqlevel<='".$userrow["level"]."'", "itemsuffixes"));
        $premodrow = dorow(doquery("SELECT * FROM {{table}} ORDER BY id","itemmodnames"));
        
        // Format the mod name row.
        foreach($premodrow as $a=>$b) {
            $modrow[$b["fieldname"]] = $b;
        }
        
        // Now build the item table.
        $row["itemtable"] = "";
        for($i=0; $i<10; $i++) {
            
            $baseitem = $itemsrow[rand(0,(sizeof($itemsrow)-1))];
            if (rand(0,1)==1) { $prefix = $prefixrow[rand(0,(sizeof($prefixrow)-1))]; } else { $prefix = false; }
            if (rand(0,1)==1) { $suffix = $suffixrow[rand(0,(sizeof($suffixrow)-1))]; } else { $suffix = false; }
            $fullitem = builditem($prefix, $baseitem, $suffix, $modrow);
            $row["itemtable"] .= parsetemplate(gettemplate("town_buy_itemrow"), $fullitem);
            
        }

        // And we're done.
        display("Buy Weapons & Armor", parsetemplate(gettemplate("town_buy1"),$row));
        
    }
    
}

function builditem($prefix, $baseitem, $suffix, $modrow) {
    
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
    
    if ($controlrow["showimages"] == 1) { 
        $baseitem["image"] = "<img src=\"images/items/".$baseitem["slotnumber"].$acctrow["imageformat"]."\" alt=\"".$baseitem["name"]."\" title=\"".$baseitem["name"]."\" />";
    }
    
    // And send it back.
    return $baseitem;
    
}

function gamble() {
    
    display("Gamble", gettemplate("town_gamble1"));
    
}

function bank() {
    
    global $userrow;
    
    if (isset($_POST["withdraw"])) {
        
        if (!is_numeric($_POST["amount"])) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
        if ($_POST["amount"] < 1) { err("Withdrawal amount must be greater than 0."); }
        if ($_POST["amount"] > $userrow["bank"]) { err("You do not have that much money in the bank."); }
        
        $userrow["gold"] += $_POST["amount"];
        $userrow["bank"] -= $_POST["amount"];
        updateuserrow();
        $row["formatbank"] = number_format($userrow["bank"]);
        $row["formatgold"] = number_format($userrow["gold"]);
        display("Deposit/Withdraw Gold at the Bank", parsetemplate(gettemplate("town_bank2"),$row));
        
    } elseif (isset($_POST["deposit"])) {
        
        if (!is_numeric($_POST["amount"])) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
        if ($_POST["amount"] < 1) { err("Deposit amount must be greater than 0."); }
        if ($_POST["amount"] > $userrow["gold"]) { err("You do not have that much money in your pocket."); }
        
        $userrow["gold"] -= $_POST["amount"];
        $userrow["bank"] += $_POST["amount"];
        updateuserrow();
        $row["formatbank"] = number_format($userrow["bank"]);
        $row["formatgold"] = number_format($userrow["gold"]);
        display("Deposit/Withdraw Gold at the Bank", parsetemplate(gettemplate("town_bank2"),$row));
        
    } else {
        
        $row["formatbank"] = number_format($userrow["bank"]);
        $row["formatgold"] = number_format($userrow["gold"]);
        
        display("Deposit/Withdraw Gold at the Bank", parsetemplate(gettemplate("town_bank1"),$row));
        
    }
    
}

function halloffame() {
    
    $topquery = doquery("SELECT *, DATE_FORMAT(birthdate, '%m.%d.%Y') AS fregdate FROM {{table}} ORDER BY experience DESC LIMIT 10", "users");
    $top = dorow($topquery);
    $row["halltable"] = "";
    $i = 1;
    
    if (mysql_num_rows($topquery) > 1) { 
        foreach($top as $a=>$b) {
            if ($b["charpicture"] != "") {
                $b["avatar"] = "<img src=\"".$b["charpicture"]."\" alt=\"".$b["charname"]."\" />";
            } else {
                $b["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$b["charname"]."\" />";
            }
            $b["experience"] = number_format($b["experience"]);
            $b["number"] = $i;
            if ($b["guild"] != 0) { 
                $charname = "[<span style=\"color: ".$b["tagcolor"].";\">".$b["guildtag"]."</span>]<span style=\"color: ".$b["namecolor"].";\">".$b["charname"]."</span>";
            } else { 
                $charname = $b["charname"];
            }
            $b["newcharname"] = $charname;
            $row["halltable"] .= parsetemplate(gettemplate("town_halloffamerow"), $b);
            $i++;
        }
    } else { 
        if ($top["charpicture"] != "") {
            $top["avatar"] = "<img src=\"".$top["charpicture"]."\" alt=\"".$top["charname"]."\" />";
        } else {
            $top["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$top["charname"]."\" />";
        }
        $top["experience"] = number_format($top["experience"]);
        $top["number"] = $i;
        if ($top["guild"] != 0) { 
            $charname = "[<span style=\"color: ".$top["tagcolor"].";\">".$top["guildtag"]."</span>]<span style=\"color: ".$top["namecolor"].";\">".$top["charname"]."</span>";
        } else { 
            $charname = $top["charname"];
        }
        $top["newcharname"] = $charname;
        $row["halltable"] .= parsetemplate(gettemplate("town_halloffamerow"), $top);
        $i++;
    }
    $row["halltable"] .= "<br />\n";
    display("Hall of Fame", parsetemplate(gettemplate("town_halloffame"), $row));
    
}

function duel() {
    
    global $userrow;
    
    $query = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."' AND world='".$userrow["world"]."' AND latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' AND id !='".$userrow["id"]."' ORDER BY id", "users");
    $row = dorow($query);
    
    $list = "";
    if (mysql_num_rows($query) == 0) {
        $list .= "There is nobody available to challenge at this time.<br />";
    } elseif (mysql_num_rows($query) == 1) { 
        if ($row["guild"] != 0) { 
            $charname = "[<span style=\"color: ".$row["tagcolor"].";\">".$row["guildtag"]."</span>]<span style=\"color: ".$row["namecolor"].";\">".$row["charname"]."</span>";
        } else { 
            $charname = $row["charname"];
        }
        $list .= "<a href=\"index.php?do=challenge&uid=".$row["id"]."\">$charname (Level ".$row["level"].")</a><br />";
    } else {
        foreach($row as $a=>$b) {
            if ($row["guild"] != 0) { 
                $charname = "[<span style=\"color: ".$row["tagcolor"].";\">".$row["guildtag"]."</span>]<span style=\"color: ".$row["namecolor"].";\">".$row["charname"]."</span>";
            } else { 
                $charname = $row["charname"];
            }
            $list .= "<a href=\"index.php?do=challenge&uid=".$b["id"]."\">".$b["charname"]." (Level ".$b["level"].")</a><br />";
        }
    }
    
    $pagerow["list"] = $list;
    display("Duel Challenge", parsetemplate(gettemplate("town_pvplist"),$pagerow));
    
}

function duelchallenge() {
    
    global $userrow, $acctrow;
    
    if(isset($_GET["uid"])) {
        if (!is_numeric($_GET["uid"])) { err("Invalid UID."); }
        if ($_GET["uid"] == $userrow["id"]) { err("You cannot duel yourself."); }
        $newuserrow = dorow(doquery("SELECT *,UNIX_TIMESTAMP(onlinetime) as fonlinetime FROM {{table}} WHERE id='".$_GET["uid"]."' LIMIT 1", "users"));
        if ($newuserrow == false) { err("That user doesn't exist."); }
        if ($newuserrow["account"] == $userrow["account"]) { err("You cannot duel another character on your own account."); }
        if ($newuserrow["fonlinetime"] <= (time() - 600)) { err("That user is not online."); }
        if ($newuserrow["currentaction"] != "In Town") { err("That user is busy."); }
        if ($newuserrow["latitude"] != $userrow["latitude"] || $newuserrow["longitude"] != $userrow["longitude"]) { err("That user is not in this town."); }
    } else { err("Invalid UID."); }
    
    // No errors, so create the PVP record and update everyone's userrow.
    $query = doquery("INSERT INTO {{table}} SET id='',player1id='".$userrow["id"]."',player2id='".$newuserrow["id"]."',player1name='".$userrow["charname"]."',player2name='".$newuserrow["charname"]."',playerturn='".$newuserrow["id"]."',turntime=NOW(),fightrow=''","pvp");
    $query2 = doquery("UPDATE {{table}} SET currentpvp='".mysql_insert_id()."' WHERE id='".$newuserrow["id"]."' OR id='".$userrow["id"]."' LIMIT 2", "users");
    display("Duel Challenge",parsetemplate(gettemplate("pvp_challenge"),$newuserrow));
    
}
    
        

?>