<?php

include("lib.php");
include("globals.php");

if (isset($_GET["do"])) {
    $do = $_GET["do"];
    switch ($do) {
        case "control": include("control.php"); controlrow(); break;
        case "realms": include("realms.php"); break;
        default: donothing();
    }
} else { donothing(); }
        
function donothing() {
    
    $accounts = dorow(doquery("SELECT * FROM {{table}}", "accounts"), "id");
    $pagerow["accounts"] = sizeof($accounts);
    
    $characters = dorow(doquery("SELECT * FROM {{table}}", "users"), "id");
    $pagerow["characters"] = sizeof($characters);
    
    $guildchars = dorow(doquery("SELECT * FROM {{table}} WHERE guild != 0", "users"), "id");
    $pagerow["guildchars"] = sizeof($guildchars);
    
    $guilds = dorow(doquery("SELECT * FROM {{table}}", "guilds"), "id");
    $pagerow["guilds"] = sizeof($guilds);
    
    $page = parsetemplate(gettemplate("index"), $pagerow);
    display("Administrator", $page);
    
}

?>