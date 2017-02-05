<?php // control.php :: editing the game's controlrow.

global $thetab;
$thetab = 2;

function controlrow() {
    
    global $controlrow;
    
    if (isset($_POST["submit"])) {
        
        $numerics = array("avatarmaxsize","showitemimages","botcheck","pvprefresh","pvptimeout","guildstartup","guildstartlvl","guildjoinlvl","guildupdate");
        $toggles = array("gameopen","showshout","showonline","showmonsterimages","verifyemail","compression","debug");
        $norequires = array("forumurl");
        
        // Check errors.
        $errors = "";
        foreach($numerics as $a => $b) { 
            if (!is_numeric($_POST[$b])) { $errors .= "$b is a numeric field. Please enter numbers only. Please go back and try again.<br />"; } 
        }
        foreach($_POST as $a => $b) { 
            if (trim($_POST[$a]) == "" && !in_array($a,$norequires)) { $errors .= "$a is a required field. Please enter a value. Please go back and try again.<br />"; } 
        }
        if ($errors != "") { err($errors); }
        
        // Check toggles.
        foreach($toggles as $a => $b) {
            if (!isset($_POST[$b])) { $_POST[$b] = "0"; }
        }
        
        // Build query.
        $query = "";
        $columns = dorow(doquery("SHOW COLUMNS FROM {{table}}", "control"));
        foreach($columns as $a => $b) {
            if (isset($_POST[$b["Field"]])) { $query .= $b["Field"] . "='" . $_POST[$b["Field"]] . "',"; }
        }
        $query = rtrim($query, ",");
        
        // Save settings & finish.
        doquery("UPDATE {{table}} SET $query WHERE id='1' LIMIT 1", "control");
        display("Main Settings", "The main settings were saved successfully. <br /><br />You may return <a href=\"index.php\">Home</a> or to the <a href=\"index.php?do=control\">Main Settings page</a>.");
        
    }
    
    extract($controlrow);
    
    // Checkboxes.
    if ($gameopen == 1) { $controlrow["check_gameopen"] = "checked=\"checked\""; } else { $controlrow["check_gameopen"] = ""; }
    if ($showshout == 1) { $controlrow["check_showshout"] = "checked=\"checked\""; } else { $controlrow["check_showshout"] = ""; }
    if ($showonline == 1) { $controlrow["check_showonline"] = "checked=\"checked\""; } else { $controlrow["check_showonline"] = ""; }
    if ($showmonsterimages == 1) { $controlrow["check_showmonsterimages"] = "checked=\"checked\""; } else { $controlrow["check_showmonsterimages"] = ""; }
    if ($verifyemail == 1) { $controlrow["check_verifyemail"] = "checked=\"checked\""; } else { $controlrow["check_verifyemail"] = ""; }
    if ($compression == 1) { $controlrow["check_compression"] = "checked=\"checked\""; } else { $controlrow["check_compression"] = ""; }
    if ($debug == 1) { $controlrow["check_debug"] = "checked=\"checked\""; } else { $controlrow["check_debug"] = ""; }
    
    // Item image dropdown.
    $itemimages = array(0=>"Off",1=>"Slot",2=>"ID");
    $controlrow["select_showitemimages"] = "";
    foreach($itemimages as $a => $b) {
        if ($controlrow["showitemimages"] == $a) { $selected = "selected=\"selected=\""; } else { $selected = ""; }
        $controlrow["select_showitemimages"] .= "<option value=\"$a\" $selected>$b</option>";
    }
    
    $page = parsetemplate(gettemplate("control"), $controlrow);
    display("Main Settings", $page);

}

?>