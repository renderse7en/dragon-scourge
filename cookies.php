<?php // cookies.php :: Handles cookies. (Mmm, tasty!)

function checkcookies() {

    include('config.php');
    
    $row = false;
    
    if (isset($_COOKIE["scourge"])) {
        
        // COOKIE FORMAT:
        // {ID} {USERNAME} {PASSWORDHASH} {REMEMBERME}
        $theuser = explode(" ",$_COOKIE["scourge"]);
        if (!is_numeric($theuser[0])) { err("Invalid cookie data (Error 0). Please clear cookies and log in again."); }
        $row = dorow(doquery("SELECT * FROM <<accounts>> WHERE username='$theuser[1]' LIMIT 1"));
        if ($row == false) { err("Invalid cookie data (Error 1). Please clear cookies and log in again."); }
        if ($row["id"] != $theuser[0]) { err("Invalid cookie data (Error 2). Please clear cookies and log in again."); }
        if (md5($row["password"] . "--" . $dbsettings["secretword"]) !== $theuser[2]) { err("Invalid cookie data (Error 3). Please clear cookies and log in again."); }
        
        // If we've gotten this far, cookie should be valid, so write a new one.
        $newcookie = implode(" ",$theuser);
        if ($theuser[3] == 1) { $expiretime = time()+31536000; } else { $expiretime = 0; }
        setcookie ("scourge", $newcookie, $expiretime, "/", "", 0);
        
    }
    
    return $row;

}

?>