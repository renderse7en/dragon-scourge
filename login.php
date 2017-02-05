<?php // login.php :: Handles user logins and logouts.

include("lib.php");
if (isset($_GET["do"])) { $do = $_GET["do"]; } else { $do = ""; }

switch($do) {
    case "logout":
        logout();
        break;
    default:
        login();
}

function login() {
    
    if (isset($_POST["submit"])) {
        
        // Setup.
        include("config.php");
        extract($_POST);
        $query = doquery("SELECT * FROM {{table}} WHERE username='$username' LIMIT 1", "accounts");
        $row = dorow($query);
        
        // Errors.
        if ($row == false) { err("Invalid username. Please <a href=\"index.php\">go back</a> and try again.", false, false); }
        if ($row["password"] != md5($password)) { err("Invalid password. Please <a href=\"index.php\">go back</a> and try again.", false, false); }
        if ($row["verifycode"] != 1) { err("You have not yet verified your account. Please click the link found in your Accoutn Verification email before continuing. If you never received the email, please check your spam filter settings or contact the game administrator for further assistance.", false, false); }
        
        // Finish.
        $newcookie = $row["id"] . " " . $username . " " . md5($row["password"] . "--" . $dbsettings["secretword"]);
        if (isset($remember)) { $expiretime = time()+31536000; $newcookie .= " 1"; } else { $expiretime = 0; $newcookie .= " 0"; }
        setcookie("scourge", $newcookie, $expiretime, "/", "", 0);
        die(header("Location: index.php"));
        
    } else {
        
        display("Log In", gettemplate("login"), false);
        
    }
    
}

function logout() {
    
    setcookie("scourge", "", (time()-3600), "/", "", 0);
    die(header("Location: login.php?do=login"));
    
}

?>