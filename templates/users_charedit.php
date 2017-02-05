<?php

$template = <<<END
<form action="users.php?do=charedit&uid={{id}}" method="post" enctype="multipart/form-data"> 
<table>
<tr><td width="30%">Avatar:</td><td>Upload an avatar:<br /><input type="file" name="intavatar" /><br />Avatars must be 50x50 pixels & {{maxsize}}kb or smaller.<br />JPG, GIF, and PNG file types only.<br /><br /><br /></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Save Changes" /> <input type="reset" name="reset" value="Reset" /> &nbsp; &nbsp; or &nbsp; &nbsp; <input type="submit" name="delete" value="Delete This Character" /></td></tr>
</table>
</form>
You may also continue playing <a href="index.php">the game</a> or return to the main <a href="users.php?do=characters">Characters</a> screen
END;

?>