<?php // panels.php :: Handling for left/right/top/bottom status panels.

function panelleft() {
    
    global $controlrow, $userrow, $townrow, $worldrow;
    $row = array();
    
    // Action handling.
    if ($userrow["currentaction"] == "In Town") { 
        $row["action"] = "In Town:";
        $row["townname"] = $townrow["name"];
    } else { 
        $row["action"] = $userrow["currentaction"]; 
        $row["townname"] = "";
    }
    
    // World handling.
    $row["worldname"] = $worldrow["name"];
    
    // Location handling.
    if ($userrow["latitude"] < 0) { 
        $row["latitude"] = ($userrow["latitude"] * -1) . "S"; 
    } else { 
        $row["latitude"] = $userrow["latitude"] . "N";
    }
    
    if ($userrow["longitude"] < 0) { 
        $row["longitude"] = ($userrow["longitude"] * -1) . "W"; 
    } else { 
        $row["longitude"] = $userrow["longitude"] . "E";
    }
    
    // Travel To handling.
    $row["travelto"] = "";
    
    // First we build the query string.
    $townstring = "(";
    $townslist = explode(",",$userrow["townslist"]);
    foreach($townslist as $a=>$b) {
        $townstring .= "id='$b' OR ";
    }
    $townstring = rtrim($townstring, " OR ");
    $townstring .= ") AND world='".$userrow["world"]."'";
    
    // Then we do the query.
    $traveltoquery = doquery("SELECT id,name FROM {{table}} WHERE $townstring ORDER BY id", "towns");
    
    // Finally we build the link list.
    while ($d = mysql_fetch_array($traveltoquery)) {
        $row["travelto"] .= "<a href=\"index.php?do=travel:".$d["id"]."\">".$d["name"]."</a><br />\n";
    }
    
    // And then we're done with this panel.
    return parsetemplate(gettemplate("panels_left"), $row);
    
}

function panelright() {
    
    global $controlrow;
    $row["babblebox"] = "";
    $row["whosonline"] = "";
    
    // Babblebox.
    if ($controlrow["showshout"] == 1) {
        $row["babblebox"] = "<div class=\"big\"><b>Babblebox</b></div>";
        $row["babblebox"] .= "<iframe src=\"index.php?do=babblebox\" name=\"sbox\" width=\"100%\" height=\"200\" frameborder=\"0\" id=\"bbox\">Your browser does not support inline frames! The Babble Box will not be available until you upgrade to a newer <a href=\"http://www.mozilla.org\" target=\"_new\">browser</a>.</iframe>";
    }
    
    // Who's Online.
    if ($controlrow["showonline"] == 1) {
        $row["whosonline"] = "<div class=\"big\"><b>Who's Online</b></div>";
        $users = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."'", "users");
        $number = mysql_num_rows($users);
        $row["whosonline"] .= "There are <b>$number</b> user(s) online within the last 10 minutes: ";
        while($b = mysql_fetch_array($users)) { 
            if ($b["guild"] != 0) { 
                $charname = "[<span style=\"color: ".$b["tagcolor"].";\">".$b["guildtag"]."</span>]<span style=\"color: ".$b["namecolor"].";\">".$b["charname"]."</span>";
            } else { 
                $charname = $b["charname"];
            }
            $row["whosonline"] .= "<a href=\"users.php?do=profile&uid=".$b["id"]."\">$charname</a>, ";
        }
        $row["whosonline"] = rtrim($row["whosonline"], ", ");
    }
    
    // And then we're done with this panel.
    return parsetemplate(gettemplate("panels_right"), $row);
    
}

function paneltop($loggedin = true) {
    
    global $acctrow, $userrow;
    if ($loggedin == true || isset($acctrow)) {
        
        if ($userrow == false) { $userrow["charname"] = "No Characters Yet"; }
        if ($acctrow["authlevel"] == 2) { $admin = " (<a href=\"admin/index.php\">Admin</a>)"; } else { $admin = ""; }
        if ($userrow["guild"] != 0) { 
            $charname = "[<span style=\"color: ".$userrow["tagcolor"].";\">".$userrow["guildtag"]."</span>]<span style=\"color: ".$userrow["namecolor"].";\">".$userrow["charname"]."</span>";
        } else { 
            $charname = $userrow["charname"];
        }
        $top = "<div class=\"big\">\n<center><b>$charname</b>$admin<br />\n";
        $top .= "[ <a href=\"login.php?do=logout\">Log Out</a> | <a href=\"users.php?do=settings\">Account</a> | <a href=\"users.php?do=characters\">Characters</a> | <a href=\"help.php\">Help</a> ]\n";
        $top .= "</center></div>\n";
        
    } else {
        
        $top = "<div class=\"big\">\n<center><b>Not Logged In</b><br />\n";
        $top .= "[ <a href=\"login.php?do=login\">Log In</a> | <a href=\"users.php?do=register\">Register</a> | <a href=\"help.php\">Help</a> ]\n";
        $top .= "</center></div>\n";
        
    }
    
    return $top;
    
}

function panelbottom() {
    
    global $userrow, $spells;
    $row = array();
    
    if ($userrow["charpicture"] != "") {
        $row["charpicture"] = $userrow["charpicture"];
    } else {
        $row["charpicture"] = "images/users/nopicture.gif";
    }
    
    // Do quickspell stuff.
    $quickhealid = 0;
    $quickhealvalue = 0;
    if ($userrow["currentaction"] == "Exploring") {
        for ($i=1; $i<11; $i++) {
            if ($userrow["spell".$i."id"] != 0) {
                if ($spells[$userrow["spell".$i."id"]]["fname"] == "heal") {
                    if ($spells[$userrow["spell".$i."id"]]["value"] > $quickhealvalue) { 
                        $quickhealvalue = $spells[$userrow["spell".$i."id"]]["value"]; 
                        $quickhealid = $spells[$userrow["spell".$i."id"]]["id"]; 
                    }
                }
            }
        }
    }
    if ($quickhealid != 0) { 
        $row["quickheal"] = "<a href=\"index.php?do=quickheal&id=$quickhealid\" class=\"red\">(Heal)</a>";
    } else {
        $row["quickheal"] = "";
    }
    
    // Do the rest of it.
    $row["level"] = $userrow["level"];
    if ($userrow["levelup"] > 0) { $row["levelup"] = "<a href=\"users.php?do=levelup\" class=\"red\">(".$userrow["levelup"]." LP)</a>"; } else { $row["levelup"] = ""; }
    if ($userrow["levelspell"] > 0) { $row["levelspell"] = "<a href=\"users.php?do=levelspell\" class=\"blue\">(".$userrow["levelspell"]." SP)</a>"; } else { $row["levelspell"] = ""; }
    $row["experience"] = number_format($userrow["experience"]);
    $row["gold"] = number_format($userrow["gold"]);
    $row["weapon"] = $userrow["item1name"];
    $row["armor"] = $userrow["item2name"];
    $row["helmet"] = $userrow["item3name"];
    $row["shield"] = $userrow["item4name"];
    $row["hpbar"] = statusbars("hp", $userrow["currenthp"], $userrow["maxhp"]);
    $row["mpbar"] = statusbars("mp", $userrow["currentmp"], $userrow["maxmp"]);
    $row["tpbar"] = statusbars("tp", $userrow["currenttp"], $userrow["maxtp"]);
    
    
    return parsetemplate(gettemplate("panels_bottom"),$row);
    
}

function panelmiddle() {
    
    global $userrow, $townrow, $worldrow;
    
    
    
    return gettemplate("panels_middle");
    
}

function statusbars($stat, $current, $max) {
    
    $row = array();
    switch ($stat) { 
        case "hp":
            $row["bigname"] = "Hit Points";
            $row["littlename"] = "HP";
            break;
        case "mp":
            $row["bigname"] = "Magic Points";
            $row["littlename"] = "MP";
            break;
        case "tp":
            $row["bigname"] = "Travel Points";
            $row["littlename"] = "TP";
            break;
        case "exp":
            $row["bigname"] = "Experience";
            $row["littlename"] = "Exp";
            break;
    }
    
    $row["width"] = ceil(($current / $max) * 100);
    if ($row["width"] >= 66) { $row["color"] = "green"; }
    if ($row["width"] < 66 && $row["width"] >= 33) { $row["color"] = "yellow"; }
    if ($row["width"] < 33) { $row["color"] = "red"; }
    
    $row["current"] = $current;
    $row["max"] = $max;
    return parsetemplate(gettemplate("statusbars"),$row);
    
}

?>