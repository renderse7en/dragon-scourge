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

$template = <<<END
<form action="users.php?do=settings" method="post">
<table>
<tr><td width="30%">Change Password:</td><td>
Leave these fields blank if you wish to keep your old password.<br /><br />
Old Password:<br /><input type="password" name="oldpassword" size="30" maxlength="30" /><br />
New Password:<br /><input type="password" name="password1" size="30" maxlength="30" /><br />
Verify New Password:<br /><input type="password" name="password2" size="30" maxlength="30" /><br /><br /><br />
</td></tr>
<tr><td width="30%">Email Address:</td><td><input type="text" name="email" size="30" maxlength="200" value="{{emailaddress}}"/></td></tr>
<tr><td width="30%">Image Format:</td><td><select name="imageformat">{{imageformat}}</select><br />(Older versions of Internet Explorer may not be compatible with transparent PNG images. If you notice problems with item and monster images, please select GIF.)</td></tr>
<tr><td width="30%">Show Minimap:</td><td><select name="minimap">{{minimap}}</select><br />(The maps in this game are Flash-based. Setting this option to 'No' may increase page download times if you have a slow internet connection.)</td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" /></td></tr>
</table>
</form>
When you're done with your account, you may continue playing <a href="index.php">the game</a>.
END;

?>