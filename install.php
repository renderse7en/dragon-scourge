<?php

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 19

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

opendb();

// Handling for servers with magic_quotes turned on.
if (get_magic_quotes_gpc()) {

   $_POST = array_map('uber_ss', $_POST);
   $_GET = array_map('uber_ss', $_GET);
   $_COOKIE = array_map('uber_ss', $_COOKIE);

}
$_POST = array_map('uber_mres', $_POST);
$_POST = array_map('uber_hsc', $_POST);
$_GET = array_map('uber_mres', $_GET);
$_GET = array_map('uber_hsc', $_GET);
$_COOKIE = array_map('uber_mres', $_COOKIE);
$_COOKIE = array_map('uber_hsc', $_COOKIE);

$page = "one";
if (isset($_GET["page"])) { $page = $_GET["page"]; }
switch ($page) {
    case "one": one(); break;
    case "two": two(); break;
    case "three": three(); break;
    case "four": four(); break;
    case "five": five(); break;
    default: one(); break;
}

function uber_ss($value) {
    
   $value = is_array($value) ?
               array_map('uber_ss', $value) :
               stripslashes($value);
   return $value;
   
}

function uber_mres($value) {
    
   $value = is_array($value) ?
               array_map('uber_mres', $value) :
               mysql_real_escape_string($value);
   return $value;
   
}

function uber_hsc($value) {
    
   $value = is_array($value) ?
               array_map('uber_hsc', $value) :
               htmlspecialchars($value);
   return $value;
   
}

function opendb() { // Open database connection.

    include("config.php");
    extract($dbsettings);
    if (!mysql_connect($server, $user, $pass)) {
        define("MYSQLRESULT",false);
    } else {
        define("MYSQLRESULT",true);
    }
    if (MYSQLRESULT) {
        if (!mysql_select_db($name)) {
            define("DBRESULT", false);
        } else {
            define("DBRESULT", true);
        }
    }
    return $link;

}

function doquery($query) { // Something of a tiny little database abstraction layer.
    
    include('config.php');
    $sqlquery = mysql_query(preg_replace("/<<([a-zA-Z0-9_\-]+)>>/", $dbsettings["prefix"]."_$1", $query));
    
    if ($sqlquery == false) {
        die(mysql_error() . "<br /><br />" . $query);
    }
    
    return $sqlquery;
    
}

function dorow($sqlquery, $force = "") { // Abstraction layer part deux.
    
    switch (mysql_num_rows($sqlquery)) {
        
        case 0:
            $row = false;
            break;
        case 1:
            if ($force == "") {
                $row = mysql_fetch_assoc($sqlquery);
            } else {
                $temprow = mysql_fetch_assoc($sqlquery);
                $row[$temprow[$force]] = $temprow;
            }
            break;
        default:
            if ($force == "") {
                while ($temprow = mysql_fetch_assoc($sqlquery)) {
                    $row[] = $temprow;
                }
            } else {
                while ($temprow = mysql_fetch_assoc($sqlquery)) {
                    $row[$temprow[$force]] = $temprow;
                }
            }
            break;
    
    }
        
    return $row;
    
}

// Thanks to Predrag Supurovic from php.net for this function!
function dobatch($p_query) {
    $query_split = preg_split ("/[;]+/", $p_query);
    foreach ($query_split as $command_line) {
        $command_line = trim($command_line);
        if ($command_line != '') {
            $query_result = doquery($command_line);
            if ($query_result == 0) {
                break;
            }
        }
    }
    return $query_result;
}

/***** DONE WITH ALL THE SETUP STUFF, SO ACTUALLY START INSTALLING. *****/

function one() {
    
    // Test file permissions.
    $botcheck = false;
    $f = fopen("images/botcheck/test.txt", "a");
    if ($f) { 
        if (fwrite($f,"test")) {
            $botcheck = true;
            fclose($f);
            unlink("images/botcheck/test.txt");
        }
    }
    $users = false;
    $f = fopen("images/users/test.txt", "a");
    if ($f) { 
        if (fwrite($f,"test")) {
            $users = true;
            fclose($f);
            unlink("images/users/test.txt");
        }
    }
    
    // Display status.
    if ($botcheck) { $botcheck = "<span style=\"color: Green;\">Pass</span>"; } else { $botcheck = "<span style=\"color: red;\">Fail</span>"; }
    if ($users) { $users = "<span style=\"color: Green;\">Pass</span>"; } else { $users = "<span style=\"color: red;\">Fail</span>"; }
    if (MYSQLRESULT) { $mysqlresult = "<span style=\"color: Green;\">Pass</span>"; } else { $mysqlresult = "<span style=\"color: red;\">Fail</span>"; }
    if (DBRESULT) { $dbresult = "<span style=\"color: Green;\">Pass</span>"; } else { $dbresult = "<span style=\"color: red;\">Fail</span>"; }
    
    // Done. Show page.
$page = <<<THEVERYENDOFYOU
<html>
    <head>
        <title>Dragon Scourge :: Installation (Step 1)</title>
        <style type="text/css">
            body, table, td, div { font: 11px Verdana; }
            body { background-image: url(images/background.jpg); }
            h3 { margin-top: 0px; }
            td { vertical-align: top; }
            .main { background-color: white; border: solid 1px black; text-align: left; padding: 10px; }
        </style>
    </head>
    <body><center>
        <div class="main" style="width: 700px;">
        
            <h3>Dragon Scourge :: Installation (Step 1)</h3>
            <ol>
                <li><b>Verify Settings</b></li>
                <li>Install Database</li>
                <li>Primary Game Settings</li>
                <li>Create Admin User</li>
            </ol>
            
            <table border="1">
                <tr><th colspan="2">Verify Settings</th></tr>
                <tr><td>MySQL Connection</td><td>$mysqlresult</td></tr>
                <tr><td>MySQL Database</td><td>$dbresult</td></tr>
                <tr><td>File Permissions: /images/users/</td><td>$users</td></tr>
                <tr><td>File Permissions: /images/botcheck/</td><td>$botcheck</td></tr>
            </table><br /><br />
            
            If any of the above settings display <span style="color: red;">Fail</span>, please go back and make sure everything is correct.<br /><br />
            For failures on either MySQL Connection or MySQL Database, please ensure that you have inserted the correct values for your server configuration into config.php, and make sure that the database to which you will be installing Dragon Scourge already exists on your server.<br /><br />
            For failures on either of the two File Permissions settings, make sure that the appropriate folders have been CHMODed to 0777 (on Unix/Linux servers), or are not set to read-only (on Windows servers). If you need help with this, <a href="http://www.stadtaus.com/en/tutorials/chmod-ftp-file-permissions.php" target="_new">click here</a> for tutorials on how to do this in several major FTP clients.<br /><br />
            Once you have checked all the appropriate settings, reload this page and make sure that all four tests indicate <span style="color: green;">Pass</span> before continuing.<br /><br />
            Once all tests pass, click the link below to continue to step two.<br /><br />
            
            <a href="install.php?page=two">Continue to Step Two: Install Database</a><br />
            Installing the database may take several seconds. Please click the link only once.
        
        </div>
    </center></body>
</html>
THEVERYENDOFYOU;
die($page);

}

function two() {
    
    $installsql = file_get_contents("install.sql");
    $status = dobatch($installsql);
    
$page = <<<THEVERYENDOFYOU
<html>
    <head>
        <title>Dragon Scourge :: Installation (Step 2)</title>
        <style type="text/css">
            body, table, td, div { font: 11px Verdana; }
            body { background-image: url(images/background.jpg); }
            h3 { margin-top: 0px; }
            td { vertical-align: top; }
            .main { background-color: white; border: solid 1px black; text-align: left; padding: 10px; }
        </style>
    </head>
    <body><center>
        <div class="main" style="width: 700px;">
        
            <h3>Dragon Scourge :: Installation (Step 2)</h3>
            <ol>
                <li>Verify Settings</li>
                <li><b>Install Database</b></li>
                <li>Primary Game Settings</li>
                <li>Create Admin User</li>
            </ol>
            
            The database installation is now complete. Click the link below to set up your initial game settings.<br /><br />
            
            <a href="install.php?page=three">Continue to Step Three: Primary Game Settings</a>
        
        </div>
    </center></body>
</html>
THEVERYENDOFYOU;
die($page);

}

function three() {
    
    // Path stuff. Easy.
    $gamepath = str_replace("install.php","",__FILE__);
    $gamepath = str_replace("\\","/",$gamepath);
    $avatarpath = $gamepath . "images/users/";
    $gameurl = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];
    $gameurl = str_replace("install.php","",$gameurl);
    $avatarurl = $gameurl . "images/users/";
    
    
$page = <<<THEVERYENDOFYOU
<html>
    <head>
        <title>Dragon Scourge :: Installation (Step 3)</title>
        <style type="text/css">
            body, table, td, div { font: 11px Verdana; }
            body { background-image: url(images/background.jpg); }
            h3 { margin-top: 0px; }
            td { vertical-align: top; }
            .grey { color: #888888; }
            .main { background-color: white; border: solid 1px black; text-align: left; padding: 10px; }
        </style>
    </head>
    <body><center>
        <div class="main" style="width: 700px;">
        
            <h3>Dragon Scourge :: Installation (Step 3)</h3>
            <ol>
                <li>Verify Settings</li>
                <li>Install Database</li>
                <li><b>Primary Game Settings</b></li>
                <li>Create Admin User</li>
            </ol>
            
            <form action="install.php?page=four" method="post">
            <table cellspacing="0" cellpadding="5" width="98%">
            <tr><td width="25%">Game Name</td><td><input type="text" name="gamename" size="20" maxlength="50" value="Dragon Scourge" /><br /><span class="grey">The name of your game. Used in page titles and when sending email to new users.</span><br /><br /></td></tr>
            <tr><td width="25%">Game Path</td><td><input type="text" name="gamepath" size="40" maxlength="200" value="$gamepath" /><br /><span class="grey">The full server path to your game. If you don't know this, please ask your host for assistance.</span><br /><br /></td></tr>
            <tr><td width="25%">Game URL</td><td><input type="text" name="gameurl" size="40" maxlength="200" value="$gameurl" /><br /><span class="grey">The full URL to your game.</span><br /><br /></td></tr>
            <tr><td width="25%">Forum URL</td><td><input type="text" name="forumurl" size="40" maxlength="200" value="" /><br /><span class="grey">If you have a support forum for your game, enter its URL here - otherwise leave blank to disable this link.</span><br /><br /></td></tr>
            <tr><td width="25%">Avatar Path</td><td><input type="text" name="avatarpath" size="40" maxlength="200" value="$avatarpath" /><br /><span class="grey">The full server path to your avatar uploads folder.</span><br /><br /></td></tr>
            <tr><td width="25%">Avatar URL</td><td><input type="text" name="avatarurl" size="40" maxlength="200" value="$avatarurl" /><br /><span class="grey">The full URL to your avatar uploads folder.</span><br /><br /></td></tr>
            <tr><td width="25%">Avatar Max Filesize</td><td><input type="text" name="avatarmaxsize" size="10" maxlength="10" value="15000" /><br /><span class="grey">Enter the maximum file size (in bytes) for uploaded avatars.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Show Babblebox?</td><td><input type="checkbox" name="showshout" value="1" /> Yes<br /><span class="grey">Enables the Babblebox iframe in the right panel.</span><br /><br /></td></tr>
            <tr><td width="25%">Show Who's Online?</td><td><input type="checkbox" name="showonline" value="1" /> Yes<br /><span class="grey">Enables the Who's Online listing in the right panel.</span><br /><br /></td></tr>
            <tr><td width="25%">Show SigBot URL?</td><td><input type="checkbox" name="showsigbot" value="1" /> Yes<br /><span class="grey">The SigBot allows users to display their character stats in forum signature images. This setting only controls whether SigBot URLs are displayed on the Characters page. To disable SigBot completely, remove the file <b>.htaccess</b> from your game installation folder.</span><br /><br /></td></tr>
            <tr><td width="25%">Admin's Email</td><td><input type="text" name="adminemail" size="20" maxlength="200" value="" /><br /><span class="grey">This is the game owner's email address, used when sending email to new users.</span><br /><br /></td></tr>
            <tr><td width="25%">Enable Email Functions?</td><td><input type="checkbox" name="verifyemail" value="1" /> Yes<br /><span class="grey">Sends a verification letter to anyone who registers an account, to enforce valid email addresses. Also allows users to request new passwords if they lose/forget theirs.<br /><b>NOTE:</b> Some Windows servers may have issues if their php.ini settings are improperly configured. If you're on a Windows host and get a lot of email sending errors, disable this setting or contact your host for more information.</b></span><br /><br /></td></tr>
            <tr><td width="25%">Enable ZLib Compression?</td><td><input type="checkbox" name="compression" value="1" /> Yes<br /><span class="grey">Enables ZLib output compression, which reduces bandwidth and speeds up page access time for end-users.</span><br /><br /></td></tr>
            <tr><td width="25%">Enable Debug Info?</td><td><input type="checkbox" name="debug" value="1" /> Yes<br /><span class="grey">Displays extra information (query count & page generation time) in the footer, and displays full MySQL query errors if they occur.</span><br /><br /></td></tr>
            <tr><td width="25%">Bot Check</td><td><input type="text" name="botcheck" size="10" maxlength="10" value="255" /><br /><span class="grey">Bot Check ensures that players are human by displaying a CAPTCHA challenge form every so often (random 1 in <i>n</i> chance) during exploring. Higher numbers show the Bot Check less often, but may not be as secure. Lower numbers will show the bot check more often, but may annoy some users. Enter 0 to disable the bot check completely.<br />Range: 0 to 4294967295.<br />Recommended: 255.</span><br /><br /></td></tr>
            <tr><td width="25%">PVP Refresh Time</td><td><input type="text" name="pvprefresh" size="10" maxlength="10" value="15" /><br /><span class="grey">The amount of time (in seconds) the mini PVP frame should wait before refreshing itself to check for new data. Low numbers may cause strain on your server if you have a lot of concurrent users.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">PVP Timeout Limit</td><td><input type="text" name="pvptimeout" size="10" maxlength="10" value="45" /><br /><span class="grey">The amount of time (in seconds) it takes for someone to remain inactive and cause the PVP battle to close.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Guild Startup Cost</td><td><input type="text" name="guildstartup" size="10" maxlength="10" value="100000" /><br /><span class="grey">The amount of gold it takes for a player to start their own Guild.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Guild Start Level</td><td><input type="text" name="guildstartlvl" size="10" maxlength="10" value="35" /><br /><span class="grey">The minimum level a player must reach before being allowed to start a Guild.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Guild Join Level</td><td><input type="text" name="guildjoinlvl" size="10" maxlength="10" value="10" /><br /><span class="grey">The minimum level a player must reach before being allowed to join a Guild.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Guild Update Time</td><td><input type="text" name="guildupdate" size="10" maxlength="10" value="24" /><br /><span class="grey">The amount of time (in hours) before automatically recalculating Guild Honor Points.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td colspan="2" style="border-top: solid 2px black;"><center>
            <input type="submit" name="submit" value="Continue to Step Four: Create Admin User" /><br />
            </center></td></tr>
            </table>
            </form>
        
        </div>
    </center></body>
</html>
THEVERYENDOFYOU;
die($page);

}

function four() {
    
    // Check for errors.
    $requires = array("gamename","gamepath","gameurl","avatarpath","avatarurl","avatarmaxsize","adminemail","botcheck","pvprefresh","pvptimeout","guildstartup","guildstartlvl","guildjoinlvl","guildupdate");
    $numerics = array("avatarmaxsize","botcheck","pvprefresh","pvptimeout","guildstartup","guildstartlvl","guildjoinlvl","guildupdate");
    $toggles = array("showshout","showonline","showsigbot","verifyemail","compression","debug");
    $errors = "";
    foreach($requires as $a => $b) {
        if (!isset($_POST[$b]) || trim($_POST[$b])=="") { $errors .= "$b field is required.<br />"; }
    }
    foreach($numerics as $a => $b) {
        if (!is_numeric($_POST[$b])) { $errors .= "$b field must contain numbers only.<br />"; }
    }
    if ($errors != "") { die("The following errors occurred. Please go back and correct these errors before continuing.<br /><br />$errors"); }
    
    // Check toggles.
    foreach($toggles as $a => $b) {
        if (!isset($_POST[$b])) { $_POST[$b] = "0"; }
    }
    
    // No errors, so set up the table.
    extract($_POST);
    doquery("INSERT INTO <<control>> SET 
        id='1',
        gamename='$gamename',
        gameopen='1',
        gamepath='$gamepath',
        gameurl='$gameurl',
        forumurl='$forumurl',
        avatarpath='$avatarpath',
        avatarurl='$avatarurl',
        avatarmaxsize='$avatarmaxsize',
        cookiename='scourge',
        cookiedomain='',
        showshout='$showshout',
        showonline='$showonline',
        showitemimages='1',
        showmonsterimages='0',
        showsigbot='$showsigbot',
        adminemail='$adminemail',
        verifyemail='$verifyemail',
        compression='$compression',
        debug='$debug',
        botcheck='$botcheck',
        moddedby='',
        pvprefresh='$pvprefresh',
        pvptimeout='$pvptimeout',
        guildstartup='$guildstartup',
        guildstartlvl='$guildstartlvl',
        guildjoinlvl='$guildjoinlvl',
        guildupdate='$guildupdate'
        ");
        
    // Done with the controlrow creator. Now show admin user creation form.'
$page = <<<THEVERYENDOFYOU
<html>
    <head>
        <title>Dragon Scourge :: Installation (Step 4)</title>
        <style type="text/css">
            body, table, td, div { font: 11px Verdana; }
            body { background-image: url(images/background.jpg); }
            h3 { margin-top: 0px; }
            td { vertical-align: top; }
            .grey { color: #888888; }
            .main { background-color: white; border: solid 1px black; text-align: left; padding: 10px; }
        </style>
    </head>
    <body><center>
        <div class="main" style="width: 700px;">
        
            <h3>Dragon Scourge :: Installation (Step 4)</h3>
            <ol>
                <li>Verify Settings</li>
                <li>Install Database</li>
                <li>Primary Game Settings</li>
                <li><b>Create Admin User</b></li>
            </ol>
            
            <form action="install.php?page=five" method="post">
            <table cellspacing="0" cellpadding="5" width="98%">
            <tr><td width="25%">Username</td><td><input type="text" name="username" size="20" maxlength="30" value="" /><br /><br /></td></tr>
            <tr><td width="25%">Password</td><td><input type="text" name="password" size="20" maxlength="30" value="" /><br /><br /></td></tr>
            <tr><td width="25%">Email Address</td><td><input type="text" name="emailaddress" size="40" maxlength="200" value="$adminemail" /><br /><br /></td></tr>
            <tr><td colspan="2" style="border-top: solid 2px black;"><center>
            <input type="submit" name="submit" value="Create Admin User and Complete Installation" />
            </center></td></tr>
            </table>
            </form>
        
        </div>
    </center></body>
</html>
THEVERYENDOFYOU;
die($page);
}

function five() {
    
    // Check for errors.
    $requires = array("username","password","emailaddress");
    $errors = "";
    foreach($requires as $a => $b) {
        if (!isset($_POST[$b]) || trim($_POST[$b])=="") { $errors .= "$b field is required.<br />"; }
    }
    if ($errors != "") { die("The following errors occurred. Please go back and correct these errors before continuing.<br /><br />$errors"); }
    
    // No errors, so set up the table.
    extract($_POST);
    $password = md5($password);
    
    doquery("INSERT INTO <<accounts>> SET 
        id='1',
        username='$username',
        password='$password',
        emailaddress='$emailaddress',
        verifycode='1',
        regdate=NOW(),
        regip='".$_SERVER["REMOTE_ADDR"]."',
        authlevel='255',
        language='English',
        characters='0',
        activechar='0',
        imageformat='.png',
        minimap='1'
        ");
        
    // Done with the controlrow creator. Now show admin user creation form.'
$page = <<<THEVERYENDOFYOU
<html>
    <head>
        <title>Dragon Scourge :: Installation Complete</title>
        <style type="text/css">
            body, table, td, div { font: 11px Verdana; }
            body { background-image: url(images/background.jpg); }
            h3 { margin-top: 0px; }
            td { vertical-align: top; }
            .grey { color: #888888; }
            .main { background-color: white; border: solid 1px black; text-align: left; padding: 10px; }
        </style>
    </head>
    <body><center>
        <div class="main" style="width: 700px;">
        
            <h3>Dragon Scourge :: Installation Complete</h3>
            Dragon Scourge Installation has now completed. Congratulations.<br /><br />
            For security reasons, <b>please delete install.php and install.sql from your game directory at this time!</b><br /><br />
            <a href="login.php?do=login">Click here</a> to log into your game for the first time. Once you log in, you will be asked to create your first Character.
            
        </div>
    </center></body>
</html>
THEVERYENDOFYOU;
die($page);
}

?>