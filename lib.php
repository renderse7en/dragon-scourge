<?php // lib.php :: Common functions used throughout the program.

// Setup for superglobal stuff that can't go in globals.php.
$starttime = getmicrotime();
$numqueries = 0;
$link = opendb();
$version = "Beta 3";
$bnumber = "15";
$bname = "Dead Man's Chest";
$bdate = "4.08.2006";

// Handling for servers with magic_quotes turned on.
// Example from php.net.
if (get_magic_quotes_gpc()) {

   $_POST = array_map('stripslashes_deep', $_POST);
   $_GET = array_map('stripslashes_deep', $_GET);
   $_COOKIE = array_map('stripslashes_deep', $_COOKIE);

}
$_POST = array_map('addslashes_deep', $_POST);
$_POST = array_map('makesafe', $_POST);
$_GET = array_map('addslashes_deep', $_GET);
$_GET = array_map('makesafe', $_GET);
$_COOKIE = array_map('addslashes_deep', $_COOKIE);
$_COOKIE = array_map('makesafe', $_COOKIE);

function opendb() { // Open database connection.

    include("config.php");
    extract($dbsettings);
    $link = mysql_connect($server, $user, $pass) or err(mysql_error(),true);
    mysql_select_db($name) or err(mysql_error(),true);
    return $link;

}

function doquery($query, $table) { // Something of a tiny little database abstraction layer.
    
    include('config.php');
    global $numqueries;
    $sqlquery = mysql_query(str_replace("{{table}}", $dbsettings["prefix"] . "_" . $table, $query)) or die(mysql_error() . "<br /><br />$query");
    $numqueries++;
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

function gettemplate($templatename) { // SQL query for the template.
    
    $filename = "templates/" . $templatename . ".php";
    include("$filename");
    return $template;
    
}

function parsetemplate($template, $array) { // Replace template with proper content. Also does languages.
    
    foreach($array as $a => $b) {
        $template = str_replace("{{{$a}}}", $b, $template);
    }
    return $template;
    
}

function prettydate($uglydate) { // Change the MySQL date format (YYYY-MM-DD) into something friendlier.

    return date("F j, Y", mktime(0,0,0,substr($uglydate, 5, 2),substr($uglydate, 8, 2),substr($uglydate, 0, 4)));

}

function prettyforumdate($uglydate) { // Change the MySQL date format (YYYY-MM-DD) into something friendlier.

    return date("F j, Y\<\b\\r \/\>G:i", mktime(0,0,0,substr($uglydate, 5, 2),substr($uglydate, 8, 2),substr($uglydate, 0, 4)));

}

function getmicrotime() { // Used for timing script operations.

    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 

}

function is_email($email) { // Thanks to "mail(at)philipp-louis.de" from php.net!

    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));

}

function stripslashes_deep($value) {
    
   $value = is_array($value) ?
               array_map('stripslashes_deep', $value) :
               stripslashes($value);
   return $value;
   
}

function addslashes_deep($value) {
    
   $value = is_array($value) ?
               array_map('addslashes_deep', $value) :
               addslashes($value);
   return $value;
   
}

function makesafe($d) {
    
    $d = str_replace("\t","",$d);
    $d = str_replace("<","&#60;",$d);
    $d = str_replace(">","&#62;",$d);
    $d = str_replace("\n","",$d);
    $d = str_replace("|","??",$d);
    $d = str_replace("  "," &nbsp;",$d);
    return $d;
    
}

function mymail($to, $title, $body, $from = '') { // thanks to arto dot PLEASE dot DO dot NOT dot SPAM at artoaaltonen dot fi.

    global $controlrow;
    extract($controlrow);
    

    $from = trim($from);

    if (!$from) {
    $from = '<$adminemail>';
    }
    
    $rp    = $adminemail;
    $org    = '$gameurl';
    $mailer = 'PHP';
    
    $head  = '';
    $head  .= "Content-Type: text/plain \r\n";
    $head  .= "Date: ". date('r'). " \r\n";
    $head  .= "Return-Path: $rp \r\n";
    $head  .= "From: $from \r\n";
    $head  .= "Sender: $from \r\n";
    $head  .= "Reply-To: $from \r\n";
    $head  .= "Organization: $org \r\n";
    $head  .= "X-Sender: $from \r\n";
    $head  .= "X-Priority: 3 \r\n";
    $head  .= "X-Mailer: $mailer \r\n";
    
    $body  = str_replace("\r\n", "\n", $body);
    $body  = str_replace("\n", "\r\n", $body);
    
    return mail($to, $title, $body, $head);
  
}

function err($error, $system = false, $panels = true) { // Basic little error handler.

     display("Error", $error, $panels);
/*    
    // Don't display major system errors (sql errors).
    if ($system == true) {
        if ($handle = fopen("errorlog/errorlog.txt", 'a')) {
            $written = fwrite($handle, $error."\n");
            fclose($handle);
        }
        if ($written != false) {
            display("Error", "A critical game system error has occurred.<br /><br />Please have the game administrator check the game error logs and fix the problem.<br /><br />Please <a href=\"index.php\">go back</a> and try again.");
        } else {
            display("Error", "A critical game system error has occurred. Additionally, an error occurred when trying to create a game error log entry. Please have the game administrator check the server logs and fix the problem.<br /><br />Please <a href=\"index.php\">go back</a> and try again.");
        }
    } else {
        display("Error", $error);
    }
*/    
}

function updateuserrow() {
    
    global $userrow;
    $userrow = array_map("addslashes", $userrow);
    
    $querystring = "";
    foreach($userrow as $a=>$b) {
        $querystring .= "$a='$b',";
    }
    $querystring = rtrim($querystring, ",");
    
    $query = doquery("UPDATE {{table}} SET $querystring WHERE id='".$userrow["id"]."' LIMIT 1", "users");
    
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
    
    if ($controlrow["showimages"] == 1) { 
        $baseitem["image"] = "<img src=\"images/items/".$baseitem["slotnumber"].$acctrow["imageformat"]."\" alt=\"".$baseitem["name"]."\" title=\"".$baseitem["name"]."\" />";
    }
    
    // And send it back.
    return $baseitem;
    
}

function display($title, $content, $panels = true) { // Finalize page and output to browser.
    
    include('config.php');
    global $controlrow, $userrow, $worldrow, $numqueries, $starttime, $version, $build;
    
    if (!isset($controlrow)) {
        $controlrow = dorow(doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control"));
    }

    // Make page tags for XHTML validation.
    $page = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    $page .= gettemplate("primary");
    
    // Setup for primary page array indexes.
    $row = array();
    $row["gamename"] = $controlrow["gamename"];
    $row["pagetitle"] = $title;
    $row["background"] = "background" . $userrow["world"];
    $row["version"] = $version;
    $row["numqueries"] = $numqueries;
    $row["totaltime"] = round(getmicrotime()-$starttime,4);
    $row["content"] = $content;
    if ($controlrow["forumurl"] != "") { $row["forumslink"] = "<a href=\"".$controlrow["forumurl"]."\">Support Forums</a>"; } else { $row["forumslink"] = ""; }
    
    // Setup for side panels.
    include("panels.php");
    if ($panels == true) { 
        $row["leftnav"] = panelleft(); 
        $row["rightnav"] = panelright();
        $row["topnav"] = paneltop(true);
        $row["bottomnav"] = panelbottom();
        $row["middlenav"] = panelmiddle();
    } else { 
        $row["leftnav"] = ""; 
        $row["rightnav"] = "";
        $row["topnav"] = paneltop(false);
        $row["bottomnav"] = "";
    }
    
    //if(md5_file("templates/primary.php") != "0aeec5eb64ff875a697142528afe8fc7") { die("Primary template modified. Cannot continue."); }
    
    // Finalize control array for output.
    $page = parsetemplate($page, $row); 
    
    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();
    
}

?>