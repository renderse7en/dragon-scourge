<?php // explore.php :: All exploring/traveling functions.


function doexplore() { // Default explore screen.
    
    display("Exploring", gettemplate("explore"));
    
}

function move() { // Primary exploring function. Move them with the compass buttons.
    
    global $controlrow, $userrow, $worldrow;
    
    if ($userrow["currentpvp"] != 0) { die(header("Location: pvp.php")); }
    if ($userrow["currentaction"] == "PVP") { die(header("Location: pvp.php")); }
    if ($userrow["currentaction"] == "Fighting") { die(header("Location: fight.php")); }
    if ($userrow["exploreverify"] != "") { botkillah(); }
    
    // Move the character.
    if (isset($_GET["dir"])) { 
        $dir = $_GET["dir"];
        if($dir=="n") {
            $latlon = "latitude";
            if (($userrow[$latlon]+1) <= $worldrow["size"]) { $userrow[$latlon]++; $string = ", latitude=latitude+1"; } else { $string = ""; }
        } elseif($dir=="s") {
            $latlon = "latitude";
            if ((($userrow[$latlon]-1)*-1) <= $worldrow["size"]) { $userrow[$latlon]--; $string = ", latitude=latitude-1"; } else { $string = ""; }
        } elseif($dir=="e") {
            $latlon = "longitude";
            if (($userrow[$latlon]+1) <= $worldrow["size"]) { $userrow[$latlon]++; $string = ", longitude=longitude+1"; } else { $string = ""; }
        } elseif($dir=="w") {
            $latlon = "longitude";
            if ((($userrow[$latlon]-1)*-1) <= $worldrow["size"]) { $userrow[$latlon]--; $string = ", longitude=longitude-1"; } else { $string = ""; }
        } else {
            err("Invalid input format. Please <a href=\"index.php\">go back</a> and try again.");
        }
    }
    
    // Breakout for story.
    if ($userrow["story"] != "0" && $userrow["storylat"] == $userrow["latitude"] && $userrow["storylon"] == $userrow["longitude"]) {
        $string = ltrim($string," ,");
        doquery("UPDATE <<users>> SET $string WHERE id='".$userrow["id"]."' LIMIT 1");
        die(header("Location: story.php"));
    }
    
    // Breakout for towns.
    $row = dorow(doquery("SELECT * FROM <<towns>> WHERE world='".$userrow["world"]."' AND latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1"));
    if ($row != false) {
        $townslist = explode(",",$userrow["townslist"]);
        if (!in_array($row["id"], $townslist)) { 
            $userrow["townslist"] .= ",".$row["id"]; 
            $string .= ", townslist='".$userrow["townslist"]."'";
        }
        doquery("UPDATE <<users>> SET currentaction='In Town' $string WHERE id='".$userrow["id"]."' LIMIT 1");
        display("Exploring", parsetemplate(gettemplate("town_enter"), $row));
    }
    
    // Decide if we want to pick a fight with someone.
    if (rand(1,5) == 1 && $userrow["currentaction"] != "In Town") { 
        doquery("UPDATE <<users>> SET currentaction='Fighting' $string WHERE id='".$userrow["id"]."' LIMIT 1");
        die(header("Location: fight.php"));
    }
    
    // Random check for protection against macro bots.
    if ($controlrow["botcheck"] > 0) { 
        if (rand(1,$controlrow["botcheck"]) == 1) { 
            botkillah();
        }
    }
    
    // If we've gotten this far, nothing has happened.
    $userrow["currentaction"] = "Exploring";
    doquery("UPDATE <<users>> SET currentaction='Exploring', dropidstring='0' $string WHERE id='".$userrow["id"]."' LIMIT 1");
    display("Exploring", gettemplate("explore"));
    
}

function travel($id) { // Move them with the Travel To list.
    
    global $userrow, $worldrow;
    
    if ($userrow["currentpvp"] != 0) { die(header("Location: pvp.php")); }
    if ($userrow["currentaction"] == "PVP") { die(header("Location: pvp.php")); }
    if ($userrow["currentaction"] == "Fighting") { die(header("Location: fight.php")); }
    if ($userrow["exploreverify"] != "") { botkillah(); }
    
    if (!is_numeric($id)) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    $query = doquery("SELECT * FROM <<towns>> WHERE id='$id' LIMIT 1");
    $row = dorow($query);
    
    // Errors.
    if ($userrow["currenttp"] < $row["travelpoints"]) { err("You do not have enough Travel Points to travel to this town. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($userrow["world"] != $row["world"]) { err("You can only travel to towns in ".$worldrow["name"].". Please <a href=\"index.php\">go back</a> and try again."); }
    if ($userrow["latitude"] == $row["latitude"] && $userrow["longitude"] == $row["longitude"] && $userrow["world"] == $row["world"]) { err("You are already in ".$row["name"].". You do not need to travel there.<br /><br /><a href=\"index.php\">Click here</a> to return to the main town screen."); }
    $townslist = explode(",",$userrow["townslist"]);
    if (!in_array($id,$townslist)) { err("You have not purchased the map to this town. Please <a href=\"index.php\">go back</a> and try again."); }
    
    // Now move them.
    $userrow["longitude"] = $row["longitude"];
    $userrow["latitude"] = $row["latitude"];
    $userrow["currenttp"] -= $row["travelpoints"];
    $query = doquery("UPDATE <<users>> SET dropidstring='0', latitude='".$userrow["latitude"]."', longitude='".$userrow["longitude"]."', currenttp='".$userrow["currenttp"]."', currentaction='In Town' WHERE id='".$userrow["id"]."' LIMIT 1");
    display("Exploring", parsetemplate(gettemplate("town_enter"), $row));
    
}

function quickheal() { // Quick heal.
    
    global $userrow, $spells;
    
    if (isset($_GET["id"])) { $id = $_GET["id"]; } else { err("Invalid ID entered. Please <a href=\"index.php\">go back</a> and try again."); }
    
    // Errors.
    if (!is_numeric($id)) { err("Invalid ID entered. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($userrow["currentaction"] != "Exploring") { err("The Quick Heal function is only available while exploring. You cannot use it in town or while fighting. Please <a href=\"index.php\">go back</a> and try again."); }
    $hasspell = false;
    for($i=1; $i<11; $i++) {
        if ($userrow["spell".$i."id"] == $id) { $hasspell = true; }
    }
    if ($hasspell == false) { err("You don't have that spell yet. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($spells[$id]["fname"] != "heal") { err("That is not a Heal spell. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($userrow["currentmp"] < $spells[$id]["mp"]) { err("You don't have enough MP to cast that spell. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($userrow["currenthp"] == $userrow["maxhp"]) { err("Your HP is already full. Please <a href=\"index.php\">go back</a> and try again."); }
    
    // Now heal them.
    $userrow["currenthp"] = min($userrow["currenthp"] + $spells[$id]["value"], $userrow["maxhp"]);
    $userrow["currentmp"] = $userrow["currentmp"] - $spells[$id]["mp"];
    doquery("UPDATE <<users>> SET currenthp='".$userrow["currenthp"]."', currentmp='".$userrow["currentmp"]."' WHERE id='".$userrow["id"]."' LIMIT 1");
    display("Exploring", gettemplate("explore_quickheal"));
    
}

function itemdrop() { // Handling for item drops from monsters.
    
    global $userrow;
    
    if ($userrow["dropidstring"] == "0") { err("No item has been dropped. Please <a href=\"index.php\">go back</a> and try again."); }
    
    $premodrow = dorow(doquery("SELECT * FROM <<itemmodnames>> ORDER BY id"));
    foreach($premodrow as $a=>$b) {
            $modrow[$b["fieldname"]] = $b;
    }
    
    $thenewitem = explode(",",$userrow["dropidstring"]);
    $newitem = dorow(doquery("SELECT * FROM <<itembase>> WHERE id='".$thenewitem[1]."' LIMIT 1"));
    $newprefix = dorow(doquery("SELECT * FROM <<itemprefixes>> WHERE id='".$thenewitem[0]."' LIMIT 1"));
    $newsuffix = dorow(doquery("SELECT * FROM <<itemsuffixes>> WHERE id='".$thenewitem[2]."' LIMIT 1"));
    $newfullitem = builditem($newprefix, $newitem, $newsuffix, $modrow);
    $row["itemtable"] = parsetemplate(gettemplate("explore_drop_itemrow"), $newfullitem);
    
    if ($userrow["item".$newitem["slotnumber"]."idstring"] != "0") {
        $theolditem = explode(",",$userrow["item".$newitem["slotnumber"]."idstring"]);
        $olditem = dorow(doquery("SELECT * FROM <<itembase>> WHERE id='".$theolditem[1]."' LIMIT 1"));
        $oldprefix = dorow(doquery("SELECT * FROM <<itemprefixes>> WHERE id='".$theolditem[0]."' LIMIT 1"));
        $oldsuffix = dorow(doquery("SELECT * FROM <<itemsuffixes>> WHERE id='".$theolditem[2]."' LIMIT 1"));
        $oldfullitem = builditem($oldprefix, $olditem, $oldsuffix, $modrow);
        $row["olditems"] = parsetemplate(gettemplate("town_buy_olditemrow"), $oldfullitem);
    } else {
        $oldfullitem = false; $oldprefix = false; $oldsuffix = false;
        $row["olditems"] = "You don't have any item in this slot.";
    }
    
    if (isset($_POST["accept"])) {
        
        // Requirements check.
        if ($newfullitem["requirements"] == false) { err("You do not meet one or more of the requirements for this item. Please <a href=\"index.php\">go back</a> and try again."); }
       
        // Now do stuff to userrow (new item only).
        $userrow["item" . $newfullitem["slotnumber"] . "idstring"] = $newfullitem["fullid"];
        $userrow["item" . $newfullitem["slotnumber"] . "name"] = $newfullitem["name"];
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
        
        updateuserrow();
        display("Item Drop", gettemplate("explore_drop_accept"));
        
    }
    
    if (isset($_POST["ignore"])) {
        
        die(header("Location: index.php"));
        
    }
    
    // And we're done.
    display("Item Drop", parsetemplate(gettemplate("explore_drop"),$row));

    
}

function botkillah() { // Bust a cap in the asses of macro bots. Word.
    
    global $userrow;
    
    if (isset($_POST["submit"])) {
        
        if (strtoupper($_POST["verify"]) == $userrow["exploreverify"]) {
            $query = doquery("UPDATE <<users>> SET exploreverify='',exploreverifyimage='' WHERE id='".$userrow["id"]."' LIMIT 1");
            unlink("images/botcheck/".$userrow["exploreverifyimage"]);
            die(header("Location: index.php"));
        } else {
            $query = doquery("UPDATE <<users>> SET explorefailed=explorefailed+1 WHERE id='".$userrow["id"]."' LIMIT 1");
            die(header("Location: index.php?do=humanity"));
        }
        
    } else {
    
        if ($userrow["exploreverify"] == "") {
    
            // Thanks to phpNoise for the tutorial on this - http://www.phpnoise.com/tutorials/1/2
            // Image setup.
            $im = ImageCreate(200, 40);
            $white = ImageColorAllocate($im, 240, 240, 240);
            $black = ImageColorAllocate($im, 102, 51, 0);
            
            // Get us some random text.
            $new_string = "";
            for($i=0; $i<6; $i++) {
                $new_string .= chr(rand(65,90));
            }
            
            // Finalize, update userrow & output.
            ImageFill($im, 0, 0, $white);
            ImageString($im, 5, rand(10,120), rand(5,25), $new_string, $black);
            $randomext = "";
            for($i=0; $i<8; $i++) { $randomext .= rand(0,9); }
            ImagePNG($im, "images/botcheck/$randomext".".png");
            ImageDestroy($im);
            $query = doquery("UPDATE <<users>> SET exploreverify='$new_string',exploreverifyimage='$randomext".".png' WHERE id='".$userrow["id"]."' LIMIT 1");
            
            $pagerow["exploreverifyimage"] = $randomext.".png";
            
        } else { $pagerow["exploreverifyimage"] = $userrow["exploreverifyimage"]; }
        
        display("Anti-Macro Verification", parsetemplate(gettemplate("explore_verify"),$pagerow));
        
    }
    
}

?>