<?php

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

$template = <<<END
You can send a letter to another player using the form below. Fields marked with a <span class="red">*</span> are required.
The Send Gold field allows you to attach money to the letter, which will be given to the recipient when they read it.<br /><br />
Note that there is a 5 Gold postage fee for sending all letters.<br /><br />
<form action="index.php?do=mailnew" method="post">
<table width="95%">
<tr><td width="20%">To:<span class="red">*</span></td><td><input type="text" name="recipient" size="30" maxlength="30" /> (Character Name)</td></tr>
<tr><td width="20%">Subject:<span class="red">*</span></td><td><input type="text" name="title" size="40" maxlength="200" /></td></tr>
<tr><td width="20%">Send Gold:</td><td><input type="text" name="gold" size="10" maxlength="10" /></td></tr>
<tr><td colspan="2">
Message:<br />
<textarea name="message" rows="7" cols="40"></textarea>
</td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Send" /> <input type="reset" name="reset" value="Reset" /></td></tr>
</table>
</form>
<hr />
<a href="index.php?do=mailnew">New Letter</a> | <a href="index.php?do=mailbox">Inbox</a> | <a href="index.php?do=mailsent">Outbox</a><br /><br />
You may also return to <a href="index.php">town</a>.
END;

?>