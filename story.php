<?php // story.php :: Storyline handling.

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

$story = dorow(doquery("SELECT * FROM story WHERE id='".$userrow["story"]."' LIMIT 1"));

// Decide which type of story to run.
if ($story["targetmonster"] != "0") { storymonster(); }
if ($story["targetitem"] != "") { storyitem(); }
storyteleport();

function storyteleport() { // Sends to a new location, or just displays a chunk of the story with no associated action.
    
    global $userrow, $story;
    
    if (isset($_POST["submit"])) {
        
        if ($story["nextstory"] != "0") { 
            $nextstory = dorow(doquery("SELECT * FROM story WHERE id='".$story["nextstory"]."' LIMIT 1"));
            $userrow["story"] = $nextstory["id"];
            $userrow["storylat"] = $nextstory["latitude"];
            $userrow["storylon"] = $nextstory["longitude"];
        }
        if ($story["targetworld"] != "0") {
            $userrow["world"] = $story["targetworld"];
            $userrow["latitude"] = $story["targetlat"];
            $userrow["longitude"] = $story["targetlon"];
            // Get first town from new world.
            $newtown = dorow(doquery("SELECT * FROM towns WHERE world='".$userrow["world"]."' ORDER BY id LIMIT 1"));
            $towns = explode(",",$userrow["townslist"]);
            $towns[] = $newtown["id"];
            $userrow["townslist"] = implode(",",$towns);
            
        }
        if ($story["targetaction"] != "") {
            $userrow["currentaction"] = $story["targetaction"];
        }
        if ($story["rewardname"] != "") {
            $userrow[$story["rewardname"]] += $story["rewardattr"];
        }
        
        updateuserrow();
        die(header("Location: index.php"));
        
    }
    
    $story["reward"] = "";
    if ($story["rewardname"] != "") {
        $premodrow = dorow(doquery("SELECT * FROM itemmodnames ORDER BY id"));
        foreach($premodrow as $a=>$b) {
                $modrow[$b["fieldname"]] = $b;
        }
        $story["reward"] .= "<hr />You've gained a permanent reward from this quest:<br />";
        $story["reward"] .= $modrow[$story["rewardname"]]["prettyname"] . ": +" . $story["rewardattr"];
        if ($modrow[$story["rewardname"]]["percent"] == 1) { $story["reward"] .= "%"; }
        $story["reward"] .= "<br />This reward will be applied when you continue on your adventure.";
    }
        
    $story["story"] = nl2br($story["story"]);
    display($story["title"], parsetemplate(gettemplate("story_teleport"), $story));

}

function storymonster() {
    
    global $userrow, $story;
    
    if (isset($_POST["submit"])) {
        
        $monster = dorow(doquery("SELECT * FROM monsters WHERE id='".$story["targetmonster"]."' LIMIT 1"));
        $querystring = "currentmonsterid='".$monster["id"]."', currentmonsterhp='".(ceil(rand($monster["maxhp"] * .75, $monster["maxhp"]) * $userrow["difficulty"]))."', currentaction='Fighting'";
        $update = doquery("UPDATE users SET $querystring WHERE id='".$userrow["id"]."' LIMIT 1");
        die(header("Location: fight.php"));
        
    }

    $story["story"] = nl2br($story["story"]);
    display($story["title"], parsetemplate(gettemplate("story_monster"), $story));
    
}

function storyitem() {
    
    global $userrow, $story;
    
    $modrow = dorow(doquery("SELECT * FROM itemmodnames ORDER BY id"), "fieldname");
    $thenewitem = explode(",",$story["targetitem"]);
    $newitem = dorow(doquery("SELECT * FROM itembase WHERE id='".$thenewitem[1]."' LIMIT 1"));
    $newprefix = dorow(doquery("SELECT * FROM itemprefixes WHERE id='".$thenewitem[0]."' LIMIT 1"));
    $newsuffix = dorow(doquery("SELECT * FROM itemsuffixes WHERE id='".$thenewitem[2]."' LIMIT 1"));
    $newfullitem = builditem($newprefix, $newitem, $newsuffix, $modrow);
    $story["itemtable"] = parsetemplate(gettemplate("explore_drop_itemrow"), $newfullitem);
    
    if ($userrow["item".$newitem["slotnumber"]."idstring"] != "0") {
        $theolditem = explode(",",$userrow["item".$newitem["slotnumber"]."idstring"]);
        $olditem = dorow(doquery("SELECT * FROM itembase WHERE id='".$theolditem[1]."' LIMIT 1"));
        $oldprefix = dorow(doquery("SELECT * FROM itemprefixes WHERE id='".$theolditem[0]."' LIMIT 1"));
        $oldsuffix = dorow(doquery("SELECT * FROM itemsuffixes WHERE id='".$theolditem[2]."' LIMIT 1"));
        $oldfullitem = builditem($oldprefix, $olditem, $oldsuffix, $modrow);
        $story["olditems"] = parsetemplate(gettemplate("town_buy_olditemrow"), $oldfullitem);
    } else {
        $oldfullitem = false; $oldprefix = false; $oldsuffix = false;
        $story["olditems"] = "You don't have any item in this slot.";
    }
    
    if (isset($_POST["takeitem"])) {
        
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
        
        if ($story["nextstory"] != "0") { 
            $nextstory = dorow(doquery("SELECT * FROM story WHERE id='".$story["nextstory"]."' LIMIT 1"));
            $userrow["story"] = $nextstory["id"];
            $userrow["storylat"] = $nextstory["latitude"];
            $userrow["storylon"] = $nextstory["longitude"];
        }
        if ($story["targetworld"] != "0") {
            $userrow["world"] = $story["targetworld"];
            $userrow["latitude"] = $story["targetlat"];
            $userrow["longitude"] = $story["targetlon"];
            // Get first town from new world.
            $newtown = dorow(doquery("SELECT * FROM towns WHERE world='".$userrow["world"]."' ORDER BY id LIMIT 1"));
            $towns = explode(",",$userrow["townslist"]);
            $towns[] = $newtown["id"];
            $userrow["townslist"] = implode(",",$towns);
        }
        if ($story["targetaction"] != "") {
            $userrow["currentaction"] = $story["targetaction"];
        }
        if ($story["rewardname"] != "") {
            $userrow[$story["rewardname"]] += $story["rewardattr"];
        }
        
        updateuserrow();
        die(header("Location: index.php"));

    }
    
    if (isset($_POST["noitem"])) {
        
        if ($story["nextstory"] != "0") { 
            $nextstory = dorow(doquery("SELECT * FROM story WHERE id='".$story["nextstory"]."' LIMIT 1"));
            $userrow["story"] = $nextstory["id"];
            $userrow["storylat"] = $nextstory["latitude"];
            $userrow["storylon"] = $nextstory["longitude"];
        }
        if ($story["targetworld"] != "0") {
            $userrow["world"] = $story["targetworld"];
            $userrow["latitude"] = $story["targetlat"];
            $userrow["longitude"] = $story["targetlon"];
            // Get first town from new world.
            $newtown = dorow(doquery("SELECT * FROM towns WHERE world='".$userrow["world"]."' ORDER BY id LIMIT 1"));
            $towns = explode(",",$userrow["townslist"]);
            $towns[] = $newtown["id"];
            $userrow["townslist"] = implode(",",$towns);
        }
        if ($story["targetaction"] != "") {
            $userrow["currentaction"] = $story["targetaction"];
        }
        if ($story["rewardname"] != "") {
            $userrow[$story["rewardname"]] += $story["rewardattr"];
        }
        
        updateuserrow();
        die(header("Location: index.php"));
        
    }
    
    $story["reward"] = "";
    if ($story["rewardname"] != "") {
        $premodrow = dorow(doquery("SELECT * FROM itemmodnames ORDER BY id"));
        foreach($premodrow as $a=>$b) {
                $modrow[$b["fieldname"]] = $b;
        }
        $story["reward"] .= "<hr />You've gained a permanent reward from this quest:<br />";
        $story["reward"] .= $modrow[$story["rewardname"]]["prettyname"] . ": +" . $story["rewardattr"];
        if ($modrow[$story["rewardname"]]["percent"] == 1) { $story["reward"] .= "%"; }
        $story["reward"] .= "<br />This reward will be applied when you continue on your adventure.";
    }
    
    $story["story"] = nl2br($story["story"]);
    display($story["title"], parsetemplate(gettemplate("story_item"), $story));
    
}

?>
