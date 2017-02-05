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
    
    // Breakout for towns.
    $query = doquery("SELECT * FROM {{table}} WHERE world='".$userrow["world"]."' AND latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    $row = dorow($query);
    if ($row != false) {
        $townslist = explode(",",$userrow["townslist"]);
        if (!in_array($row["id"], $townslist)) { 
            $userrow["townslist"] .= ",".$row["id"]; 
            $string .= ", townslist='".$userrow["townslist"]."'";
        }
        doquery("UPDATE {{table}} SET currentaction='In Town' $string WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        display("Exploring", parsetemplate(gettemplate("town_enter"), $row));
    }
    
    // Decide if we want to pick a fight with someone.
    if (rand(1,5) == 1 && $userrow["currentaction"] != "In Town") { 
        doquery("UPDATE {{table}} SET currentaction='Fighting' $string WHERE id='".$userrow["id"]."' LIMIT 1", "users");
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
    doquery("UPDATE {{table}} SET currentaction='Exploring' $string WHERE id='".$userrow["id"]."' LIMIT 1", "users");
    display("Exploring", gettemplate("explore"));
    
}

function travel($id) { // Move them with the Travel To list.
    
    global $userrow, $worldrow;
    
    if ($userrow["currentpvp"] != 0) { die(header("Location: pvp.php")); }
    if ($userrow["currentaction"] == "PVP") { die(header("Location: pvp.php")); }
    if ($userrow["currentaction"] == "Fighting") { die(header("Location: fight.php")); }
    if ($userrow["exploreverify"] != "") { botkillah(); }
    
    if (!is_numeric($id)) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "towns");
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
    $query = doquery("UPDATE {{table}} SET latitude='".$userrow["latitude"]."', longitude='".$userrow["longitude"]."', currenttp='".$userrow["currenttp"]."', currentaction='In Town' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
    display("Exploring", parsetemplate(gettemplate("town_enter"), $row));
    
}

function botkillah() { // Bust a cap in the asses of macro bots. Word.
    
    global $userrow;
    
    if (isset($_POST["submit"])) {
        
        if (strtoupper($_POST["verify"]) == $userrow["exploreverify"]) {
            $query = doquery("UPDATE {{table}} SET exploreverify='',exploreverifyimage='' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
            unlink("images/botcheck/".$userrow["exploreverifyimage"]);
            die(header("Location: index.php"));
        } else {
            $query = doquery("UPDATE {{table}} SET explorefailed=explorefailed+1 WHERE id='".$userrow["id"]."' LIMIT 1", "users");
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
            $query = doquery("UPDATE {{table}} SET exploreverify='$new_string',exploreverifyimage='$randomext".".png' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
            
            $pagerow["exploreverifyimage"] = $randomext.".png";
            
        } else { $pagerow["exploreverifyimage"] = $userrow["exploreverifyimage"]; }
        
        display("Anti-Macro Verification", parsetemplate(gettemplate("explore_verify"),$pagerow));
        
    }
    
}

?>