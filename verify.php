<?php // verify.php :: Standalone file for verifying accounts.

include("lib.php");

if (isset($_GET["code"])) {
    $code = $_GET["code"];
} else { die("Invalid account verification code."); }
    
$query = doquery("SELECT * FROM {{table}} WHERE verifycode='$code' LIMIT 1", "accounts");
if (mysql_num_rows($query) != 1) {
    die("Invalid account verification code.");
} else {
    $update = doquery("UPDATE {{table}} SET verifycode='1' WHERE verifycode='$code' LIMIT 1", "accounts");
}
display("Account Verification",gettemplate("users_verified"), false);

?>