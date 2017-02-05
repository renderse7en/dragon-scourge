<?php // users.php :: Functions for creating/editing/viewing user accounts and statistics.

include("lib.php");
include("globals.php");

if(isset($_GET["do"])) {
    $do = explode(":",$_GET["do"]);
    switch ($do[0]) {
        
        case "register": register(); break;
        case "profile": profile(); break;
        case "characters": characters(); break;
        case "charnew": charnew(); break;
        case "charedit": charedit(); break;
        case "settings": settings(); break;
        case "levelup": levelup(); break;
        case "levelspell": levelspell(); break;
        default: donothing();
        
    }
} else {
    donothing();
}

function donothing() {
    
    die(header("Location: index.php"));
    
}

function register() {
    
    if(isset($_POST["submit"])) {
        
        extract($_POST);
        global $controlrow;
        $errors = 0; $errorlist = "";
        
        // Process username.
        if (trim($username) == "") { $errors++; $errorlist .= "Username field is required.<br />"; }
        if (preg_match("/[^A-z0-9_\-]/", $username)==1) { $errors++; $errorlist .= "Username must be alphanumeric.<br />"; } // Thanks to "Carlos Pires" from php.net!
        $usernamequery = doquery("SELECT username FROM {{table}} WHERE username='$username' LIMIT 1","accounts");
        if (mysql_num_rows($usernamequery) > 0) { $errors++; $errorlist .= "Username already taken - unique username required.<br />"; }

        // Process password.
        if (trim($password1) == "") { $errors++; $errorlist .= "Password fields is required.<br />"; }
        if (preg_match("/[^A-z0-9_\-]/", $password1)==1) { $errors++; $errorlist .= "Password must be alphanumeric.<br />"; } // Thanks to "Carlos Pires" from php.net!
        if ($password1 != $password2) { $errors++; $errorlist .= "Passwords don't match.<br />"; }
        $password = md5($password1);
        
        // Process email address.
        if (trim($email1) == "") { $errors++; $errorlist .= "Email field is required.<br />"; }
        if ($email1 != $email2) { $errors++; $errorlist .= "Emails don't match.<br />"; }
        if (! is_email($email1)) { $errors++; $errorlist .= "Email isn't valid.<br />"; }
        $emailquery = doquery("SELECT emailaddress FROM {{table}} WHERE emailaddress='$email1' LIMIT 1","accounts");
        if (mysql_num_rows($emailquery) > 0) { $errors++; $errorlist .= "Email already taken - unique email address required.<br />"; }
        
        // Process other stuff.
        if ($imageformat != ".png" && $imageformat != ".gif") { $errors++; $errorlist .= "Invalid input for image format selection.<br />"; }
        if (!is_numeric($minimap)) { $errors++; $errorlist .= "Invalid input for minimap selection.<br />"; }
        
        if ($errors == 0) {
            
            if ($controlrow["verifyemail"] == 1) {
                $verifycode = "";
                for ($i=0; $i<8; $i++) {
                    $verifycode .= chr(rand(65,90));
                }
                $verifycode = md5($verifycode);
            } else {
                $verifycode='1';
            }
            
            // Now update.
            $query = doquery("INSERT INTO {{table}} SET id='',regdate=NOW(),regip='".$_SERVER["REMOTE_ADDR"]."',verifycode='$verifycode',username='$username',password='$password',emailaddress='$email1',language='English',imageformat='$imageformat', minimap='$minimap'", "accounts") or die(mysql_error());
            
            // Send confirmation email if necessary.
            if ($controlrow["verifyemail"] == 1) {
                if (sendregmail($email1, $verifycode) == true) {
                    $page = "Your account was created successfully.<br /><br />You should receive an Account Verification email shortly. You will need the verification code contained in that email before you are allowed to log in. Once you have received the email, please visit the <a href=\"users.php?do=verify\">Verification Page</a> to enter your code and start playing.";
                } else {
                    $page = "Your account was created successfully.<br /><br />However, there was a problem sending your verification email. Please check with the game administrator to help resolve this problem.";
                }
            } else {
                $page = "Your account was created succesfully.<br /><br />You may now continue to the <a href=\"login.php?do=login\">Login Page</a> and continue playing ".$controlrow["gamename"]."!";
            }
            
        } else {
            
            // Die gracefully on errors.
            $page = "The following error(s) occurred when your account was being made:<br /><span style=\"color:red;\">$errorlist</span><br />Please <a href=\"users.php?do=register\">go back</a> and try again.";
            
        }
        
        display("Register", $page, false);
        
    }

    $row["imageformat"] = "<option value=\".png\">PNG</option><option value=\".gif\">GIF</option>";
    $row["minimap"] = "<option value=\"1\">Yes</option><option value=\"0\">No</option>";
    display("Register", parsetemplate(gettemplate("users_register1"), $row), false);
    
}

function sendregmail($emailaddress, $vercode) {
    
    global $controlrow;
    extract($controlrow);
    $verurl = $gameurl . "verify.php?code=$vercode";
    
$email = <<<END
You or someone using your email address recently signed up for an account on the $gamename server, located at $gameurl.

This email is sent to verify your registration email. In order to begin using your account, you must verify your email address. 
Please click on the link below or copy/paste it into your browser to activate your account. You will not be able to play the game until your account is activated.

Verification URL:
$verurl

If you were not the person who signed up for the game, please disregard this message. You will not be emailed again.
END;

    $status = mymail($emailaddress, "$gamename Account Verification", $email);
    return $status;
    
}

function profile() {
    
    global $userrow;
    $newuserrow = $userrow;
    $template = "users_profile";
    
    // Setup for viewing other people's profiles.
    if(isset($_GET["uid"])) {
        if (!is_numeric($_GET["uid"])) { err("Invalid UID."); }
        $newuserrow = dorow(doquery("SELECT * FROM {{table}} WHERE id='".$_GET["uid"]."' LIMIT 1", "users"));
        if ($newuserrow == false) { err("No such UID."); }
        $template = "users_onlinechar";
    }
    
    if ($newuserrow["guild"] != 0) { 
        $newuserrow["newcharname"] = "[<span style=\"color: ".$newuserrow["tagcolor"].";\">".$newuserrow["guildtag"]."</span>]<span style=\"color: ".$newuserrow["namecolor"].";\">".$newuserrow["charname"]."</span>";
    } else { 
        $newuserrow["newcharname"] = $newuserrow["charname"];
    }

    if ($newuserrow["charpicture"] != "") {
        $newuserrow["profcharpicture"] = "<img src=\"".$newuserrow["charpicture"]."\" alt=\"".$newuserrow["charname"]."\" />";
    } else {
        $newuserrow["profcharpicture"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$newuserrow["charname"]."\" />";
    }
    
    $newuserrow["formatexperience"] = number_format($newuserrow["experience"]);
    $newuserrow["formatgold"] = number_format($newuserrow["gold"]);
    
    if ($newuserrow["expbonus"] == 0) { $newuserrow["expbonus"] = ""; } else { if ($newuserrow["expbonus"]>0) { $expsign="+"; } else { $expsign=""; } $newuserrow["expbonus"] = "($expsign".$newuserrow["expbonus"]."%)"; }
    if ($newuserrow["goldbonus"] == 0) { $newuserrow["goldbonus"] = ""; } else { if ($newuserrow["goldbonus"]>0) { $goldsign="+"; } else { $goldsign=""; }$newuserrow["goldbonus"] = "($goldsign".$newuserrow["goldbonus"]."%)"; }
    
    // Next level.
    $leveltotal = 15;
    $leveladd = 15;
    $i = 2;
    while ($i < ($newuserrow["level"] + 1)) {
        $levelstart = $leveltotal;
        if ($i < 4) { 
            $leveladd = ceil($leveladd * 2.0);
        } elseif ($i < 13) { 
            $leveladd = floor($leveladd * 1.45);
        } elseif ($i < 40) { 
            $leveladd = floor($leveladd * 1.20);
        } elseif ($i < 60) { 
            $leveladd = 150000;
        } elseif ($i < 80) { 
            $leveladd = 200000;
        } elseif ($i < 100) { 
            $leveladd = 300000;
        } elseif ($i >= 100) { 
            $leveladd = 500000;
        }
        $leveltotal = $levelstart + $leveladd;
        $i++;
    }
    $newuserrow["formatnextlvl"] = number_format($leveltotal);
    
    // Level points.
    if ($newuserrow["levelup"] != 0 || $newuserrow["levelspell"] != 0) { $newuserrow["levelpointscharnotice"] = "You have Level/Spell Points available."; } else { $newuserrow["levelpointscharnotice"] = ""; }
    
    // Class.
    $class = dorow(doquery("SELECT * FROM {{table}} WHERE id='".$userrow["charclass"]."' LIMIT 1", "classes"));
    $newuserrow["charclass"] = $class["name"];

    display("Extended Profile",parsetemplate(gettemplate($template),$newuserrow));
    
}

function settings() {
    
    global $acctrow;
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        
        // Process password.
        if (trim($password1) != "") { 
            if (md5($oldpassword) != $acctrow["password"]) { $errors++; $errorlist .= "Incorrect old password.<br />"; }
            if (preg_match("/[^A-z0-9_\-]/", $password1)==1) { $errors++; $errorlist .= "Password must be alphanumeric.<br />"; } // Thanks to "Carlos Pires" from php.net!
            if ($password1 != $password2) { $errors++; $errorlist .= "New passwords don't match.<br />"; }
            $password = "password='".md5($password1)."',";
            $newpass = true;
        } else { $password = ""; }
        
        // Process email address.
        if (trim($email) == "") { $errors++; $errorlist .= "Email field is required.<br />"; }
        if (! is_email($email)) { $errors++; $errorlist .= "Email isn't valid.<br />"; }
        $emailquery = doquery("SELECT emailaddress FROM {{table}} WHERE emailaddress='$email' AND id != '".$acctrow["id"]."' LIMIT 1","accounts");
        if (mysql_num_rows($emailquery) > 0) { $errors++; $errorlist .= "Email already taken - unique email address required.<br />"; }
        
        // Process other stuff.
        if ($imageformat != ".png" && $imageformat != ".gif") { $errors++; $errorlist .= "Invalid input for image format selection.<br />"; }
        if (!is_numeric($minimap)) { $errors++; $errorlist .= "Invalid input for minimap selection.<br />"; }
        
        if ($errors == 0) { 
            
            $query = doquery("UPDATE {{table}} SET $password emailaddress='$email', imageformat='$imageformat', minimap='$minimap' WHERE id='".$acctrow["id"]."' LIMIT 1", "accounts");
        
            if (isset($newpass)) { 
                setcookie("scourge", "", (time()-3600), "/", "", 0);
                $page = "Your information was updated successfully. Because you changed your password, you have been logged out to avoid cookie errors.<br /><br />Please use the Log In link above to log back into the game and continue playing.";
                unset($GLOBALS["acctrow"]);
                display("Account Settings", $page, false);
            } else {
                $page = "Your information was updated successfully. You may now continue <a href=\"index.php\">playing</a>.";
                display("Account Settings", $page);
            }
            
        } else {
            
            err("The following error(s) occurred when your account was being made:<br /><span style=\"color:red;\">$errorlist</span><br />Please <a href=\"users.php?do=settings\">go back</a> and try again.");
            
        }

    }
    
    $row["emailaddress"] = $acctrow["emailaddress"];
    $row["language"] = "<option value=\"English\">English</option>";
    if ($acctrow["imageformat"] == ".png") { 
        $row["imageformat"] = "<option value=\".png\" selected=\"selected\">PNG</option><option value=\".gif\">GIF</option>";
    } else {
        $row["imageformat"] = "<option value=\".png\">PNG</option><option value=\".gif\" selected=\"selected\">GIF</option>";
    }
    if ($acctrow["minimap"] == 0) {
        $row["minimap"] = "<option value=\"1\">Yes</option><option value=\"0\" selected=\"selected=\">No</option>";
    } else {
        $row["minimap"] = "<option value=\"1\">Yes</option><option value=\"0\">No</option>";
    }
    display("Account Settings", parsetemplate(gettemplate("users_settings"), $row));
    
}

function characters() {
    
    global $acctrow, $userrow;
    
    if (isset($_POST["submit"])) { 
        
        // Change the active character for the account.
        if (!is_numeric($_POST["makeactive"])) { err("Invalid UID."); }
        $newuserrow = dorow(doquery("SELECT * FROM {{table}} WHERE id='".$_POST["makeactive"]."' LIMIT 1", "users"));
        if ($newuserrow == false) { err("No such UID."); }
        if ($newuserrow["account"] != $acctrow["id"]) { err("You don't own that UID."); }
        $setnewchar = doquery("UPDATE {{table}} SET activechar='".$_POST["makeactive"]."' WHERE id='".$acctrow["id"]."' LIMIT 1", "accounts");
        die(header("Location: users.php?do=characters"));
        
    }
    
    if ($userrow != false) {  
        
        // Pagerow setup.  
        $row["characters"] = $acctrow["characters"];
        $row["remaining"] = 4 - $acctrow["characters"];
        $row["activecharname"] = $userrow["charname"];
        $row["selectcharlist"] = "";
        $row["fullcharlist"] = "";
        if($row["characters"] < 4) {
            $row["newcharlink"] = "<a href=\"users.php?do=charnew\">Click here to create a new character.</a><br />";
        } else { $row["newcharlink"] = ""; }
        
        // Grab characters.
        $charrow = dorow(doquery("SELECT *, DATE_FORMAT(birthdate, '%m.%d.%Y') AS fregdate FROM {{table}} WHERE account='".$acctrow["id"]."' ORDER BY birthdate", "users"), "id");
        
            foreach($charrow as $a=>$b) { 
                
                // Default character.
                if ($b["id"] == $acctrow["activechar"]) { 
                    
                    $row["selectcharlist"] .= "<option value=\"".$b["id"]."\" selected=\"selected\">".$b["charname"]." (Default)</option>";
                    
                    if ($b["charpicture"] != "") {
                        $b["avatar"] = "<img src=\"".$b["charpicture"]."\" alt=\"".$b["charname"]."\" />";
                    } else {
                        $b["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$b["charname"]."\" />";
                    }
                    $b["isdefault"] = "<span class=\"red\">(Default)</span>";
                    $row["fullcharlist"] .= parsetemplate(gettemplate("users_charlistrow"), $b);
                
                // Non-default characters.
                } else {
                
                    $row["selectcharlist"] .= "<option value=\"".$b["id"]."\">".$b["charname"]."</option>";
                    
                    if ($b["charpicture"] != "") {
                        $b["avatar"] = "<img src=\"".$b["charpicture"]."\" alt=\"".$b["charname"]."\" />";
                    } else {
                        $b["avatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$b["charname"]."\" />";
                    }
                    $b["isdefault"] = "";
                    $row["fullcharlist"] .= parsetemplate(gettemplate("users_charlistrow"), $b);
                    
                }
            }
            
        display("Characters", parsetemplate(gettemplate("users_charlist"), $row));
        
    } else {
    
        display("Characters", gettemplate("users_charlistnew"));
    
    }

}

function charnew() {
    
    global $controlrow, $acctrow;
    
    if ($acctrow["characters"] >= 4) { err("You are not allowed to make any more new characters."); }
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        
        // Process charname.
        if (trim($charname) == "") { $errors++; $errorlist .= "Character Name field is required.<br />"; }
        if (preg_match("/[^A-z\ 0-9_\-]/", $charname)==1) { $errors++; $errorlist .= "Character names can only contain letters, numbers, spaces and hyphens.<br />"; } // Thanks to "Carlos Pires" from php.net!
        $characternamequery = doquery("SELECT charname FROM {{table}} WHERE charname='$charname' LIMIT 1","users");
        if (mysql_num_rows($characternamequery) > 0) { $errors++; $errorlist .= "Character Name already taken - unique Character Name required.<br />"; }
        
	    // Upload new charpicture, if required.
	    if ($_FILES["intavatar"]["error"] != 4) {
	        
	        $allowed = array(".gif",".jpg",".png");
	        $type = substr($_FILES["intavatar"]["name"],-4);
	        
	        // Errors.
	        if (!in_array(strtolower($type),$allowed)) { die("Unallowed filetype for avatar."); }
	        if ($_FILES["intavatar"]["size"] > $controlrow["avatarmaxsize"]) { die("Avatar filesize too big."); }
	        $imagesize = getimagesize($_FILES["intavatar"]["tmp_name"]);
	        if (($imagesize[0]>50) || ($imagesize[1]>50)) { die("Avatar dimensions too big."); }	
	                
	        // Move file and finish.
	        $randomext = "";
	        for($i=0; $i<8; $i++) { $randomext .= rand(0,9); }
	        $uploadfile = $controlrow["avatarpath"] . $acctrow["username"] . $randomext . $type;
	        if (!move_uploaded_file($_FILES["intavatar"]["tmp_name"], $uploadfile)) { die("Unable to upload avatar."); }
	        $newcharpicture = $controlrow["avatarurl"] . $acctrow["username"] . $randomext . $type;
	        
	    }
        
        // Process everything else important.
        if (!is_numeric($charclass)) { $errors++; $errorlist .= "Invalid character class.<br />"; }
        if (!is_numeric($difficulty)) { $errors++; $errorlist .= "Invalid character class.<br />"; }
        
        // Get bonuses and multipliers from classes/difficulties tables.
        $expbonus = 0;
        $goldbonus = 0;
        $classes = dorow(doquery("SELECT * FROM {{table}} WHERE id='$charclass' LIMIT 1", "classes"));
        if ($classes != false) { 
            $expbonus += $classes["expbonus"]; 
            $goldbonus += $classes["goldbonus"]; 
        } else { $errors++; $errorlist .= "Invalid character class"; }
            
        $difficulties = dorow(doquery("SELECT * FROM {{table}} WHERE id='$difficulty' LIMIT 1", "difficulties"));
        if ($difficulties != false) { 
            $expbonus += $difficulties["expbonus"]; 
            $goldbonus += $difficulties["goldbonus"]; 
            $difficulty = $difficulties["multiplier"];
            $deathpenalty = $difficulties["deathpenalty"];
        } else { $errors++; $errorlist .= "Invalid character class"; }
            
        if ($errors == 0) {
            
            // Now everything's cool. Create new character row.
            $query = doquery("INSERT INTO {{table}} SET id='', account='".$acctrow["id"]."', birthdate=NOW(), lastip='".$_SERVER["REMOTE_ADDR"]."', onlinetime=NOW(), charname='$charname', charpicture='$newcharpicture', charclass='$charclass', difficulty='$difficulty', deathpenalty='$deathpenalty', expbonus='$expbonus', goldbonus='$goldbonus'", "users");
            
            // Update account row.
            $default = "";
            if (isset($setdefault)) { $default = "activechar='".mysql_insert_id()."', "; }
            if ($acctrow["characters"] == 0) { $default = "activechar='".mysql_insert_id()."', "; }
            $query2 = doquery("UPDATE {{table}} SET $default characters=characters+1 WHERE id='".$acctrow["id"]."' LIMIT 1", "accounts");
            
            // And we're finished.
            die(header("Location: users.php?do=characters"));
            
        } else {
            
            // Die gracefully on errors.
            if ($acctrow["characters"] != 0) {
                err("The following error(s) occurred when your character was being made:<br /><span style=\"color:red;\">$errorlist</span><br />Please <a href=\"users.php?do=charnew\">go back</a> and try again.");
            } else {
                die("The following error(s) occurred when your character was being made:<br /><span style=\"color:red;\">$errorlist</span><br />Please <a href=\"users.php?do=charnew\">go back</a> and try again.");
            }
            
        }
            
    }
    
    
    $classes = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "classes"));
    $row["charclass"] = "";
    $row["classdesc"] = "";
    foreach($classes as $a=>$b) {
        $row["charclass"] .= "<option value=\"".$b["id"]."\">".$b["name"]."</option>";
        $row["classdesc"] .= "<a title=\"".$b["description"]."\">".$b["name"]."</a> | ";
    }
    $row["classdesc"] = rtrim($row["classdesc"], " |");
    $difficulty = dorow(doquery("SELECT * FROM {{table}} ORDER BY id", "difficulties"));
    $row["difficulty"] = "";
    foreach($difficulty as $a=>$b) {
        $row["difficulty"] .= "<option value=\"".$b["id"]."\">".$b["name"]."</option>";
    }
    
    if ($acctrow["characters"] == 0) { $row["defaultenabled"] = "disabled=\"disabled\""; } else { $row["defaultenabled"] = ""; }
    $row["maxsize"] = round($controlrow["avatarmaxsize"] / 1000, 1);
    
    display("Characters", parsetemplate(gettemplate("users_charnew"), $row), false);
    
}

function charedit() {
    
    global $controlrow, $acctrow;
    
    // Change the active character for the account.
    if (!is_numeric($_GET["uid"])) { err("Invalid UID."); }
    $newuserrow = dorow(doquery("SELECT * FROM {{table}} WHERE id='".$_GET["uid"]."' LIMIT 1", "users"));
    if ($newuserrow == false) { err("No such UID."); }
    if ($newuserrow["account"] != $acctrow["id"]) { err("You don't own that UID."); }
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        
	    // Upload new charpicture, if required.
	    if ($_FILES["intavatar"]["error"] != 4) {
	        
	        $allowed = array(".gif",".jpg",".png");
	        $type = substr($_FILES["intavatar"]["name"],-4);
	        
	        // Errors.
	        if (!in_array(strtolower($type),$allowed)) { err("Unallowed filetype for avatar."); }
	        if ($_FILES["intavatar"]["size"] > $controlrow["avatarmaxsize"]) { err("Avatar filesize too big."); }
	        $imagesize = getimagesize($_FILES["intavatar"]["tmp_name"]);
	        if (($imagesize[0]>50) || ($imagesize[1]>50)) { err("Avatar dimensions too big."); }	
	                
	        // Move file and finish.
	        $randomext = "";
	        for($i=0; $i<8; $i++) { $randomext .= rand(0,9); }
	        $uploadfile = $controlrow["avatarpath"] . $acctrow["username"] . $randomext . $type;
	        if (!move_uploaded_file($_FILES["intavatar"]["tmp_name"], $uploadfile)) { err("Unable to upload avatar."); }
	        $newcharpicture = $controlrow["avatarurl"] . $acctrow["username"] . $randomext . $type;
	        
	        if ($newuserrow["charpicture"] != "") {
	            $oldav = ltrim($newuserrow["charpicture"], $controlrow["avatarurl"]);
	            unlink($controlrow["avatarpath"] . $oldav);
	        }
	        
	    }
            
        // Now everything's cool.
        $query = doquery("UPDATE {{table}} SET charpicture='$newcharpicture' WHERE id='".$newuserrow["id"]."' LIMIT 1", "users");
        die(header("Location: users.php?do=characters"));
            
    } elseif (isset($_POST["delete"])) {
        
        if ($acctrow["characters"] == 1) { err("You only have one character on your account. If you wish to delete this character, please make a new one first before trying to delete this one."); }
        display("Characters", parsetemplate(gettemplate("users_chardelete"), $newuserrow));
    
    } elseif (isset($_POST["ultrakill"])) {
        
        // First we delete the char.
        $query = doquery("DELETE FROM {{table}} WHERE id='".$newuserrow["id"]."'", "users");
        
        // Then we gotta update acctrow accordingly.
        $query2 = dorow(doquery("SELECT * FROM {{table}} WHERE account='".$acctrow["id"]."' ORDER BY id LIMIT 1", "users"));
        $query3 = doquery("UPDATE {{table}} SET characters=characters-1, activechar='".$query2["id"]."' WHERE id='".$acctrow["id"]."' LIMIT 1", "accounts");
        die(header("Location: users.php?do=characters"));
    
    } elseif (isset($_POST["wimpout"])) {
    
        die(header("Location: users.php?do=characters"));
    
    }
    
    $newuserrow["maxsize"] = round($controlrow["avatarmaxsize"] / 1000, 1);
    display("Characters", parsetemplate(gettemplate("users_charedit"), $newuserrow));
    
}

function levelup() {
    
    global $userrow;
    
    if ($userrow["levelup"] == 0) { err("You do not currently have any Level Points to spend."); }
    
    $classrow = dorow(doquery("SELECT * FROM {{table}} WHERE id='".$userrow["charclass"]."' LIMIT 1", "classes"));
    
    if (isset($_POST["submit"])) {
        
        unset($_POST["submit"]);
        
        // Check to make sure they didn't mess with the input names.
        foreach($_POST as $a=>$b) { 
            if (!is_numeric($a)) { err("Invalid input format."); }
        }
        
        // Loop through and add points where appropriate.
        // Note that we loop through the number of points in $userrow, rather than the number of fields. 
        // This is to ensure that people don't edit the source to just add more fields.
        $total = $userrow["levelup"];
        for($i=0; $i<$total; $i++) {
            switch($_POST[$i]) {
                case "str": 
                    $userrow["strength"]++;
                    $userrow["physattack"] += (1 * $classrow["damageperstrength"]);
                    $userrow["levelup"]--;
                    break;
                case "dex":
                    $userrow["dexterity"]++;
                    $userrow["maxhp"] += (1 * $classrow["hpperdexterity"]);
                    $userrow["currenthp"] += (1 * $classrow["hpperdexterity"]);
                    $userrow["levelup"]--;
                    break;
                case "enr":
                    $userrow["energy"]++;
                    $userrow["maxmp"] += (1 * $classrow["mpperenergy"]);
                    $userrow["currentmp"] += (1 * $classrow["mpperenergy"]);
                    $userrow["levelup"]--;
                    break;
                default:
                    break;
            }
        }
        
        // Round down any fractions.
        $userrow["physattack"] = floor($userrow["physattack"]);
        $userrow["maxhp"] = floor($userrow["maxhp"]);
        $userrow["maxmp"] = floor($userrow["maxmp"]);
        
        // Finish.
        updateuserrow();
        display("Level Points", parsetemplate(gettemplate("users_levelup2"), $userrow));
        
    } else {
        
        $row["dropdowns"] = "";
        for($i=0; $i<$userrow["levelup"]; $i++) {
            $row["dropdowns"] .= "<div style=\"padding-bottom: 5px;\"><select name=\"$i\"><option value=\"0\">Pick One</option><option value=\"str\">Strength</option><option value=\"dex\">Dexterity</option><option value=\"enr\">Energy</option></select></div>\n";
        }
        $row["classname"] = $classrow["name"];
        $row["damageperstrength"] = $classrow["damageperstrength"];
        $row["hpperdexterity"] = $classrow["hpperdexterity"];
        $row["mpperenergy"] = $classrow["mpperenergy"];
        $row["levelup"] = $userrow["levelup"];
        
        display("Level Points", parsetemplate(gettemplate("users_levelup1"), $row));
    
    }
    
}

function levelspell() {
    
    global $userrow, $spells;
    
    if ($userrow["levelspell"] == 0) { err("You do not currently have any Spell Points to spend."); }
    
    if (isset($_POST["submit"])) {
        
        unset($_POST["submit"]);
        
        // Check to make sure they didn't mess with the input names.
        foreach($_POST as $a=>$b) {
            $a = ltrim($a,"spelot");
            if (!is_numeric($a)) { err("Invalid input format."); }
        }
        
        // Loop through and add points where appropriate.
        // Note that we loop through the number of points in $userrow, rather than the number of fields. 
        // This is to ensure that people don't edit the source to just add more fields.
        $total = $userrow["levelspell"];
        for($i=0; $i<$total; $i++) {
            if ($_POST["spell".$i] != 0) {
                if (!isset($spells[$_POST["spell".$i]])) { err("That spell doesn't exist."); }
                $userrow["spell".$_POST["slot".$i]."id"] = $_POST["spell".$i];
                $userrow["spell".$_POST["slot".$i]."name"] = $spells[$_POST["spell".$i]]["name"];
                $userrow["levelspell"]--;
            }
        }
        
        // Finish.
        updateuserrow();
        display("Spell Points", parsetemplate(gettemplate("users_levelspell2"), $userrow));
        
    } else {
        
        if ($userrow["levelspell"] != 0) {
            $row["spelldropdowns"] = "";
            for ($j=0; $j<$userrow["levelspell"]; $j++) {
                $row["spelldropdowns"] .= "<select name=\"spell$j\"><option value=\"0\">Pick One</option>\n";
                foreach($spells as $a=>$b) {
                    if (($b["minlevel"] <= $userrow["level"]) && ($b["classonly"] == $userrow["charclass"] ^ $b["classexclude"] != $userrow["charclass"])) { 
                        $row["spelldropdowns"] .= "<option value=\"".$b["id"]."\">".$b["name"]."</option>\n";
                    }
                }
                $row["spelldropdowns"] .= "</select> goes in <select name=\"slot$j\"><option value=\"0\">Pick One</option>\n";
                for ($k=1; $k<11; $k++) {
                    if ($userrow["spell".$k."id"] != 0) {
                        $row["spelldropdowns"] .= "<option value=\"$k\">Slot $k: ".$userrow["spell".$k."name"]."</option>";
                    } else { 
                        $row["spelldropdowns"] .= "<option value=\"$k\">Slot $k: Empty</option>";
                    }
                }
                $row["spelldropdowns"] .= "</select><br />";
            }
            $row["spelldropdowns"] .= "<br />";
        }
        
        $row["levelspell"] = $userrow["levelspell"];
        
        display("Spell Points", parsetemplate(gettemplate("users_levelspell1"), $row));
    
    }
    
}

?>