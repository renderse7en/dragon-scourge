<?php // mailbox.php :: All Post Office functions.

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 20

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

// Before allowing anything else, we make sure the person is actually in town.
global $townrow;
if ($townrow == false) { die(header("Location: index.php")); }

function mailbox() {
    
    global $userrow;
    
    $messages = dorow(doquery("SELECT *, DATE_FORMAT(postdate, '%m.%d.%Y ~ %H:%i') AS fpostdate FROM <<messages>> WHERE recipientid='".$userrow["id"]."' ORDER BY postdate DESC"), "id");
    $row["messages"] = "<table width=\"97%\">\n";

    if ($messages == false) { 
        $row["messages"] .= "<tr><td>You do not have any messages.</td></tr>";
    } else {
        foreach($messages as $a=>$b) {
            if ($b["status"] == 0) { $b["new"] = "<span class=\"red\">*</span>"; } else { $b["new"] = ""; }
            if ($b["gold"] != 0) { $b["money"] = "<span class=\"blue\">\$</span>"; } else { $b["money"] = ""; }
            $row["messages"] .= parsetemplate(gettemplate("mailbox_listrow"), $b);
        }
    }

    $row["messages"] .= "</table><br />\n";
    display("Post Office", parsetemplate(gettemplate("mailbox_list"), $row));
    
}

function outbox() {
    
    global $userrow;
    
    $messages = dorow(doquery("SELECT *, DATE_FORMAT(postdate, '%m.%d.%Y ~ %H:%i') AS fpostdate FROM <<messages>> WHERE senderid='".$userrow["id"]."' ORDER BY postdate DESC"), "id");
    $row["messages"] = "<table width=\"97%\">\n";

    if ($messages == false) { 
        $row["messages"] .= "<tr><td>You do not have any sent messages.</td></tr>";
    } else {
        foreach($messages as $a=>$b) {
            $row["messages"] .= parsetemplate(gettemplate("mailbox_listoutrow"), $b);
        }
    }

    $row["messages"] .= "</table><br />\n";
    display("Post Office", parsetemplate(gettemplate("mailbox_listout"), $row));
    
}

function letter() {
    
    global $userrow;
    
    if (!is_numeric($_GET["id"])) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    $message = dorow(doquery("SELECT *, DATE_FORMAT(postdate, '%m.%d.%Y ~ %H:%i') AS fpostdate FROM <<messages>> WHERE id='".$_GET["id"]."' LIMIT 1"));
    if ($message == false) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($message["recipientid"] != $userrow["id"]) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    
    // Handle money transfers.
    $message["moneytransfer"] = "";
    if ($message["gold"] != 0) {
        $userrow["gold"] += $message["gold"];
        $message["moneytransfer"] = "<span class=\"blue\">You have received ".$message["gold"]." Gold with this message.</span><br />";
        updateuserrow(); 
    }
    
    // Reset status to old, and gold to zero, so they can't keep reading the message to get more money.
    if ($message["status"] == 0) {
        $statusquery = doquery("UPDATE <<messages>> SET status='1', gold='0' WHERE id='".$_GET["id"]."' LIMIT 1");
    }
    
    // Pull the sender's userrow so we can show avatars.
    $sender = dorow(doquery("SELECT * FROM <<users>> WHERE id='".$message["senderid"]."' LIMIT 1"));
    if ($sender["charpicture"] != "") {
        $message["senderavatar"] = "<img src=\"".$sender["charpicture"]."\" alt=\"".$sender["charname"]."\" width=\"50\" height=\"50\" />";
    } else {
        $message["senderavatar"] = "<img src=\"images/users/nopicture.gif\" alt=\"".$sender["charname"]."\" width=\"50\" height=\"50\" />";
    }
    
    $message["message"] = nl2br($message["message"]);
    display("Post Office", parsetemplate(gettemplate("mailbox_letter"), $message));
    
}

function letterout() {
    
    global $userrow;
    
    if (!is_numeric($_GET["id"])) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    $message = dorow(doquery("SELECT *, DATE_FORMAT(postdate, '%m.%d.%Y ~ %H:%i') AS fpostdate FROM <<messages>> WHERE id='".$_GET["id"]."' LIMIT 1"));
    if ($message == false) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($message["senderid"] != $userrow["id"]) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    
    $message["message"] = nl2br($message["message"]);
    display("Post Office", parsetemplate(gettemplate("mailbox_letterout"), $message));
    
}

function mailnew() {
    
    global $userrow;
    
    if (isset($_POST["submit"])) {
        
        // Check for errors.
        extract($_POST);
        $errors = 0; $errorlist = "";
        if ($userrow["gold"] < 5) { $errors++; $errorlist .= "You do not have enough gold to cover the postage fee.<br />"; }
        $checkuser = dorow(doquery("SELECT * FROM <<users>> WHERE charname='$recipient' LIMIT 1"));
        if ($checkuser == false) { $errors++; $errorlist .= "There is no player with that Character Name.<br />"; }
        if (trim($gold) != "") {
            if (!is_numeric($gold)) { $errors++; $errorlist .= "The Send Gold field must be a number.<br />"; }
            if ($gold < 1) { $errors++; $errorlist .= "Money Transfer amount must be greater than 0.<br />"; }
            if ($userrow["gold"] < $gold + 5) { $errors++; $errorlist .= "You don't have that much gold to send.<br />"; }
            if ($userrow["account"] == $checkuser["account"] && $gold >= ($userrow["gold"] / 10)) { $errors++; $errorlist .= "You are only allowed to send up to 10% of your gold to another character on your account.<br />"; }
        }
        if ($recipient == $userrow["charname"]) { $errors++; $errorlist .= "You cannot send a message to yourself. That would be a waste of 5 gold, dummy!"; }
        if (trim($title) == "") { $errors++; $errorlist .= "You must enter a Subject.<br />"; }
        
        if ($errors == 0) {
            
            // Subtract gold.
            $userrow["gold"] -= 5;
            if (trim($gold) != "") { $userrow["gold"] -= $gold; }
            updateuserrow();
            
            // And send the message.
            $send = doquery("INSERT INTO <<messages>> SET id='', postdate=NOW(), senderid='".$userrow["id"]."', sendername='".$userrow["charname"]."', recipientid='".$checkuser["id"]."', recipientname='$recipient', status='0', title='$title', message='$message', gold='$gold'");
            display("Post Office", gettemplate("mailbox_sent"));
            
        } else {
        
            // Die gracefully on errors.
            err("The following error(s) occurred when trying to send your letter:<br /><span style=\"color:red;\">$errorlist</span><br />Please <a href=\"index.php\">go back</a> and try again.");
            
        }

    }
    
    display("Post Office", gettemplate("mailbox_new"));

}

function mailreply() {
    
    global $userrow;
    
    if (!is_numeric($_GET["id"])) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    $origmessage = dorow(doquery("SELECT *, DATE_FORMAT(postdate, '%m.%d.%Y ~ %H:%i') AS fpostdate FROM <<messages>> WHERE id='".$_GET["id"]."' LIMIT 1"));
    if ($origmessage == false) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($origmessage["recipientid"] != $userrow["id"]) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    
    if (isset($_POST["submit"])) {
        
        // Check for errors.
        extract($_POST);
        $errors = 0; $errorlist = "";
        if ($userrow["gold"] < 5) { $errors++; $errorlist .= "You do not have enough gold to cover the postage fee.<br />"; }
        $checkuser = dorow(doquery("SELECT * FROM <<users>> WHERE charname='".$origmessage["sendername"]."' LIMIT 1"));
        if ($checkuser == false) { $errors++; $errorlist .= "There is no player with that Character Name.<br />"; }
        if (trim($gold) != "") {
            if (!is_numeric($gold)) { $errors++; $errorlist .= "The Send Gold field must be a number.<br />"; }
            if ($gold < 1) { $errors++; $errorlist .= "Money Transfer amount must be greater than 0.<br />"; }
            if ($userrow["gold"] < $gold + 5) { $errors++; $errorlist .= "You don't have that much gold to send.<br />"; }
            if ($userrow["account"] == $checkuser["account"] && $gold >= ($userrow["gold"] / 10)) { $errors++; $errorlist .= "You are only allowed to send up to 10% of your gold to another character on your account.<br />"; }
        }
        if (trim($title) == "") { $errors++; $errorlist .= "You must enter a Subject.<br />"; }
        
        if ($errors == 0) {
            
            // Subtract gold.
            $userrow["gold"] -= 5;
            if (trim($gold) != "") { $userrow["gold"] -= $gold; }
            updateuserrow();
            
            // And send the message.
            $send = doquery("INSERT INTO <<messages>> SET id='', postdate=NOW(), senderid='".$userrow["id"]."', sendername='".$userrow["charname"]."', recipientid='".$origmessage["senderid"]."', recipientname='".$origmessage["sendername"]."', status='0', title='$title', message='$message', gold='$gold'");
            display("Post Office", gettemplate("mailbox_sent"));
            
        } else {
        
            // Die gracefully on errors.
            err("The following error(s) occurred when trying to send your letter:<br /><span style=\"color:red;\">$errorlist</span><br />Please <a href=\"index.php\">go back</a> and try again.");
            
        }

    }
    
    
    
    $origmessage["message"] = nl2br($origmessage["message"]);
    display("Post Office", parsetemplate(gettemplate("mailbox_reply"), $origmessage));
    
}

function maildelete() {
    
    global $userrow;
    
    if (!is_numeric($_GET["id"])) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    $message = dorow(doquery("SELECT *, DATE_FORMAT(postdate, '%m.%d.%Y ~ %H:%i') AS fpostdate FROM <<messages>> WHERE id='".$_GET["id"]."' LIMIT 1"));
    if ($message == false) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    if ($message["recipientid"] != $userrow["id"]) { err("Invalid action. Please <a href=\"index.php\">go back</a> and try again."); }
    
    $delete = doquery("DELETE FROM <<messages>> WHERE id='".$_GET["id"]."'");
    die(header("Location: index.php?do=mailbox"));
        
}

?>