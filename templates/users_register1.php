<?php

$template = <<<END
<form action="users.php?do=register" method="post">
<table>
<tr><td width="30%">Username:</td><td><input type="text" name="username" size="30" maxlength="30" /><br />Usernames can contain letters, numbers, dashes and underscores.<br /><br /><br /></td></tr>
<tr><td width="30%">Password:</td><td><input type="password" name="password1" size="30" maxlength="30" /></td></tr>
<tr><td width="30%">Verify Password:</td><td><input type="password" name="password2" size="30" maxlength="30" /><br /><br /><br /></td></tr>
<tr><td width="30%">Email Address:</td><td><input type="text" name="email1" size="30" maxlength="200" /></td></tr>
<tr><td width="30%">Verify Email Address:</td><td><input type="text" name="email2" size="30" maxlength="200" /><br /><br /><br /></td></tr>
<tr><td width="30%">Image Format:</td><td><select name="imageformat">{{imageformat}}</select><br />(Older versions of Internet Explorer may not be compatible with transparent PNG images. If you notice problems with item and monster images, please select GIF.)</td></tr>
<tr><td width="30%">Show Minimap:</td><td><select name="minimap">{{minimap}}</select><br />(The maps in this game are Flash-based. Setting this option to 'No' may increase page download times if you have a slow internet connection.)</td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" /></td></tr>
</table>
</form>
END;

?>