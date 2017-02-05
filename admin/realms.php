<?php

global $thetab;
$thetab = 8;

if (isset($_GET["fn"])) {
    $fn = $_GET["fn"];
    switch ($fn) {
        case "realms": realms(); break;
        case "towns": towns(); break;
        case "story": storyline(); break;
        default: index();
    }
} else { index(); }

function index() {
    
    display("Realms", gettemplate("realms_index"));
    
}

function realms() {
    
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
    } else { $action = "list"; }
        
    if ($action == "list") {
        
        $realms = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "worlds"), "id");
        $alt = false;
        $pagerow["realmslist"] = "";
        foreach($realms as $a => $b) {
            extract($b);
            if ($alt) { $bg = "class=\"td_alt\""; $alt = false; } else { $bg = ""; $alt = true; }
            $pagerow["realmslist"] .= "<table cellspacing=\"0\" cellpadding=\"5\" width=\"75%\"><tr><td $bg width=\"75%\"><b>$name</b></td><td $bg><a href=\"index.php?do=realms&fn=realms&action=edit&id=$id\"><img src=\"icons/world_edit.png\" alt=\"Edit\" align=\"top\" /> Edit</a> &nbsp; &nbsp; <a href=\"index.php?do=realms&fn=realms&action=delete&id=$id\"><img src=\"icons/world_delete.png\" alt=\"Delete\" align=\"top\" /> Delete</a></td></tr></table>";
        }
        
        display("Realms List", parsetemplate(gettemplate("realms_realms"), $pagerow));
        
    } elseif ($action == "edit") {
        
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) { err("Invalid Realm ID number entered."); }
        $id = $_GET["id"];
        $therealm = dorow(doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "worlds"));
        if ($therealm == false) { err("The Realm you entered does not exist."); }
        
        if (isset($_POST["submit"])) {
            
            // Check numbers.
            $numerics = array("size");
            foreach($numerics as $a => $b) { if (!is_numeric($_POST[$b])) { err("The $b field must be a number."); } }
            
            // Other stuff.
            if ($_POST["size"] < 0) { $_POST["size"] *= -1; }
            
            // Update & finish.
            extract($_POST);
            $query = doquery("UPDATE {{table}} SET name='$name', size='$size' WHERE id='$id' LIMIT 1", "worlds");
            display("Edit a Realm", "The Realm was edited successfully. <a href=\"index.php?do=realms&fn=realms\">Click here</a> to return to the Realms List.");
            
        }
        
        display("Edit a Realm", parsetemplate(gettemplate("realms_realms_edit"), $therealm));
        
    } elseif ($action == "new") {
        
        if (isset($_POST["submit"])) {
            
            // Check numbers.
            $numerics = array("size");
            foreach($numerics as $a => $b) { if (!is_numeric($_POST[$b])) { err("The $b field must be a number."); } }
            
            // Other stuff.
            if ($_POST["size"] < 0) { $_POST["size"] *= -1; }
            
            // Update & finish.
            extract($_POST);
            $query = doquery("INSERT INTO {{table}} SET id='', name='$name', size='$size'", "worlds");
            display("Add a Realm", "The Realm was created successfully. <a href=\"index.php?do=realms&fn=realms\">Click here</a> to return to the Realms List.");
            
        }
        
        display("Add a Realm", parsetemplate(gettemplate("realms_realms_add"), $therealm));
        
    } elseif ($action == "delete") {
        
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) { err("Invalid Realm ID number entered."); }
        $id = $_GET["id"];
        $therealm = dorow(doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "worlds"));
        if ($therealm == false) { err("The Realm you entered does not exist."); }
        
        if (isset($_POST["diediedie"])) {
            
            $query = doquery("DELETE FROM {{table}} WHERE id='$id'", "worlds");
            display("Delete a Realm", "The Realm was deleted successfully. <a href=\"index.php?do=realms&fn=realms\">Click here</a> to return to the Realms List.");
            
        } elseif (isset($_POST["abort"])) {
            
            die(header("Location: index.php?do=realms&fn=realms"));
            
        }
        
        display("Delete a Realm", parsetemplate(gettemplate("realms_realms_delete"), $therealm));
        
    }
    
}

function towns() {
    
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
    } else { $action = "list"; }
        
    if ($action == "list") {
        
        $towns = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "towns"), "id");
        $realms = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "worlds"), "id");
        $alt = false;
        $pagerow["townslist"] = "";
        foreach($towns as $a => $b) {
            extract($b);
            if ($alt) { $bg = "class=\"td_alt\""; $alt = false; } else { $bg = ""; $alt = true; }
            $pagerow["townslist"] .= "<table cellspacing=\"0\" cellpadding=\"5\" width=\"75%\"><tr><td $bg width=\"75%\"><b>$name</b> (".$realms[$b["world"]]["name"].")</td><td $bg><a href=\"index.php?do=realms&fn=towns&action=edit&id=$id\"><img src=\"icons/world_edit.png\" alt=\"Edit\" align=\"top\" /> Edit</a> &nbsp; &nbsp; <a href=\"index.php?do=realms&fn=towns&action=delete&id=$id\"><img src=\"icons/world_delete.png\" alt=\"Delete\" align=\"top\" /> Delete</a></td></tr></table>";
        }
        
        display("Towns List", parsetemplate(gettemplate("realms_towns"), $pagerow));
        
    } elseif ($action == "edit") {
        
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) { err("Invalid Town ID number entered."); }
        $id = $_GET["id"];
        $thetown = dorow(doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "towns"));
        if ($thetown == false) { err("The town you entered does not exist."); }
        
        if (isset($_POST["submit"])) {
            
            // Check numbers.
            $numerics = array("world","latitude","longitude","innprice","mapprice","travelpoints","itemminlvl","itemmaxlvl");
            foreach($numerics as $a => $b) { if (!is_numeric($_POST[$b])) { err("The $b field must be a number."); } }
            
            // Update & finish.
            extract($_POST);
            $query = doquery("UPDATE {{table}} SET name='$name', world='$world', latitude='$latitude', longitude='$longitude', innprice='$innprice', mapprice='$mapprice', travelpoints='$travelpoints', itemminlvl='$itemminlvl', itemmaxlvl='$itemmaxlvl' WHERE id='$id' LIMIT 1", "towns");
            display("Edit a Town", "The town was edited successfully. <a href=\"index.php?do=realms&fn=towns\">Click here</a> to return to the Towns List.");
            
        }
        
        // Realms list.
        $realms = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "worlds"), "id");
        $thetown["realmselect"] = "";
        foreach($realms as $a => $b) {
            if ($thetown["world"] == $b["id"]) { $selected = "selected=\"selected\""; } else { $selected = ""; }
            $thetown["realmselect"] .= "<option value=\"".$b["id"]."\" $selected>".$b["name"]."</option>"; 
        }
        
        // Realm max size.
        $thetown["realmsize"] = $realms[$thetown["world"]]["size"];
        
        // Display.
        display("Edit a Town", parsetemplate(gettemplate("realms_towns_edit"), $thetown));
        
    } elseif ($action == "new") {
        
        if (isset($_POST["submit"])) {
            
            // Check numbers.
            $numerics = array("world","latitude","longitude","innprice","mapprice","travelpoints","itemminlvl","itemmaxlvl");
            foreach($numerics as $a => $b) { if (!is_numeric($_POST[$b])) { err("The $b field must be a number."); } }
            
            // Update & finish.
            extract($_POST);
            $query = doquery("INSERT INTO {{table}} SET id='', name='$name', world='$world', latitude='$latitude', longitude='$longitude', innprice='$innprice', mapprice='$mapprice', travelpoints='$travelpoints', itemminlvl='$itemminlvl', itemmaxlvl='$itemmaxlvl'", "towns");
            display("Add a Town", "The town was created successfully. <a href=\"index.php?do=realms&fn=towns\">Click here</a> to return to the Towns List.");
            
        }
        
        // Realms list.
        $realms = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "worlds"), "id");
        $thetown["realmselect"] = "";
        foreach($realms as $a => $b) {
            $thetown["realmselect"] .= "<option value=\"".$b["id"]."\">".$b["name"]."</option>"; 
        }
        
        // Realm max size.
        $thetown["realmsize"] = $realms[$thetown["world"]]["size"];
        
        // Display.
        display("Add a Town", parsetemplate(gettemplate("realms_towns_add"), $thetown));
        
    } elseif ($action == "delete") {
        
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) { err("Invalid town ID number entered."); }
        $id = $_GET["id"];
        $thetown = dorow(doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "towns"));
        if ($thetown == false) { err("The town you entered does not exist."); }
        
        if (isset($_POST["diediedie"])) {
            
            $query = doquery("DELETE FROM {{table}} WHERE id='$id'", "towns");
            display("Delete a Town", "The town was deleted successfully. <a href=\"index.php?do=realms&fn=towns\">Click here</a> to return to the towns List.");
            
        } elseif (isset($_POST["abort"])) {
            
            die(header("Location: index.php?do=realms&fn=towns"));
            
        }
        
        display("Delete a Town", parsetemplate(gettemplate("realms_towns_delete"), $thetown));
        
    }
    
}

function storyline() {
    
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
    } else { $action = "list"; }
        
    if ($action == "list") {
        
        $story = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "story"), "id");
        $alt = false;
        $pagerow["storylist"] = "";
        foreach($story as $a => $b) {
            extract($b);
            if ($alt) { $bg = "class=\"td_alt\""; $alt = false; } else { $bg = ""; $alt = true; }
            $pagerow["storylist"] .= "<table cellspacing=\"0\" cellpadding=\"5\" width=\"75%\"><tr><td $bg width=\"75%\"><b>$title</b></td><td $bg><a href=\"index.php?do=realms&fn=story&action=edit&id=$id\"><img src=\"icons/world_edit.png\" alt=\"Edit\" align=\"top\" /> Edit</a> &nbsp; &nbsp; <a href=\"index.php?do=realms&fn=story&action=delete&id=$id\"><img src=\"icons/world_delete.png\" alt=\"Delete\" align=\"top\" /> Delete</a></td></tr></table>";
        }
        
        display("Story List", parsetemplate(gettemplate("realms_story"), $pagerow));
        
    } elseif ($action == "edit") {
        
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) { err("Invalid Town ID number entered."); }
        $id = $_GET["id"];
        $thetown = dorow(doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "towns"));
        if ($thetown == false) { err("The town you entered does not exist."); }
        
        if (isset($_POST["submit"])) {
            
            // Check numbers.
            $numerics = array("world","latitude","longitude","innprice","mapprice","travelpoints","itemminlvl","itemmaxlvl");
            foreach($numerics as $a => $b) { if (!is_numeric($_POST[$b])) { err("The $b field must be a number."); } }
            
            // Update & finish.
            extract($_POST);
            $query = doquery("UPDATE {{table}} SET name='$name', world='$world', latitude='$latitude', longitude='$longitude', innprice='$innprice', mapprice='$mapprice', travelpoints='$travelpoints', itemminlvl='$itemminlvl', itemmaxlvl='$itemmaxlvl' WHERE id='$id' LIMIT 1", "towns");
            display("Edit a Town", "The town was edited successfully. <a href=\"index.php?do=realms&fn=towns\">Click here</a> to return to the Towns List.");
            
        }
        
        // Realms list.
        $realms = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "worlds"), "id");
        $thetown["realmselect"] = "";
        foreach($realms as $a => $b) {
            if ($thetown["world"] == $b["id"]) { $selected = "selected=\"selected\""; } else { $selected = ""; }
            $thetown["realmselect"] .= "<option value=\"".$b["id"]."\" $selected>".$b["name"]."</option>"; 
        }
        
        // Realm max size.
        $thetown["realmsize"] = $realms[$thetown["world"]]["size"];
        
        // Display.
        display("Edit a Town", parsetemplate(gettemplate("realms_towns_edit"), $thetown));
        
    } elseif ($action == "new") {
        
        if (isset($_POST["submit"])) {
            
            // Check numbers.
            $numerics = array("world","latitude","longitude","innprice","mapprice","travelpoints","itemminlvl","itemmaxlvl");
            foreach($numerics as $a => $b) { if (!is_numeric($_POST[$b])) { err("The $b field must be a number."); } }
            
            // Update & finish.
            extract($_POST);
            $query = doquery("INSERT INTO {{table}} SET id='', name='$name', world='$world', latitude='$latitude', longitude='$longitude', innprice='$innprice', mapprice='$mapprice', travelpoints='$travelpoints', itemminlvl='$itemminlvl', itemmaxlvl='$itemmaxlvl'", "towns");
            display("Add a Town", "The town was created successfully. <a href=\"index.php?do=realms&fn=towns\">Click here</a> to return to the Towns List.");
            
        }
        
        // Realms list.
        $realms = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "worlds"), "id");
        $thetown["realmselect"] = "";
        foreach($realms as $a => $b) {
            $thetown["realmselect"] .= "<option value=\"".$b["id"]."\">".$b["name"]."</option>"; 
        }
        
        // Realm max size.
        $thetown["realmsize"] = $realms[$thetown["world"]]["size"];
        
        // Display.
        display("Add a Town", parsetemplate(gettemplate("realms_towns_add"), $thetown));
        
    } elseif ($action == "delete") {
        
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) { err("Invalid town ID number entered."); }
        $id = $_GET["id"];
        $thetown = dorow(doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "towns"));
        if ($thetown == false) { err("The town you entered does not exist."); }
        
        if (isset($_POST["diediedie"])) {
            
            $query = doquery("DELETE FROM {{table}} WHERE id='$id'", "towns");
            display("Delete a Town", "The town was deleted successfully. <a href=\"index.php?do=realms&fn=towns\">Click here</a> to return to the towns List.");
            
        } elseif (isset($_POST["abort"])) {
            
            die(header("Location: index.php?do=realms&fn=towns"));
            
        }
        
        display("Delete a Town", parsetemplate(gettemplate("realms_towns_delete"), $thetown));
        
    }
    
}

?>