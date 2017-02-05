<?php // lib.php :: Common functions used throughout the program.

// Setup for superglobal stuff that can't go in globals.php.
$starttime = getmicrotime();
$numqueries = 0;
$link = opendb();
$version = "Beta 4";
$bnumber = "17";
$bname = "Haiku";
$bdate = "8.09.2006";
include("lib2.php");

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
    $link = mysql_connect($server, $user, $pass) or err(mysql_error(),true);
    mysql_select_db($name) or err(mysql_error(),true);
    return $link;

}

function doquery($query) { // Something of a tiny little database abstraction layer.
    
    include('config.php');
    global $numqueries, $controlrow;
    $sqlquery = mysql_query(preg_replace('/<<([a-zA-Z0-9_\-]+)>>/', $dbsettings["prefix"].'_$1', $query));
    
    if ($sqlquery == false) {
        if ($controlrow["debug"] == 1) { die(mysql_error() . "<br /><br />" . $query); } else { die("A MySQL query error occurred. Please contact the game administrator for more help."); }
    }
    
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

function getmicrotime() { // Used for timing script operations.

    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 

}

function is_email($email) { // Thanks to "mail(at)philipp-louis.de" from php.net!

    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));

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
     
}



function display($title, $content, $panels = true) { // Finalize page and output to browser.
    
    include('config.php');
    global $controlrow, $userrow, $worldrow, $numqueries, $starttime, $version, $build;
    
    if (!isset($controlrow)) {
        $controlrow = dorow(doquery("SELECT * FROM <<control>> WHERE id='1' LIMIT 1"));
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
    $row["content"] = $content;
    if ($controlrow["forumurl"] != "") { $row["forumslink"] = "<a href=\"".$controlrow["forumurl"]."\">Support Forums</a>"; } else { $row["forumslink"] = ""; }
    if ($controlrow["debug"] == 1) { $row["debug"] = "/ " . $numqueries . " Queries / " . round(getmicrotime()-$starttime,4) . " Seconds"; } else { $row["debug"] = ""; }
    
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
    
    $page = rtrim($page, "<-!");
    
$page .= <<<THEVERYENDOFYOU
<table cellspacing="0" cellpadding="3" style="width: 800px; border: solid 1px black; background-color: white; margin-top: 2px;">
  <tr>
    <td width="40%">
    Version <a href="index.php?do=version">{{version}}</a> {{debug}}
    </td>
    <td width="20%" style="text-align: center;">
    {{forumslink}}
    </td>
    <td width="40%" style="text-align:right;">
    <a href="http://www.dragonscourge.com">Dragon Scourge</a> &copy; by <a href="http://www.renderse7en.com">renderse7en</a>
    </td>
  </tr>
</table>
</center></body>
</html>
THEVERYENDOFYOU;
    
    // Finalize control array for output.
    $page = parsetemplate($page, $row); 
    
    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();
    
}

?>