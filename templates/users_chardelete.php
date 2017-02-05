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
<form action="users.php?do=charedit&uid={{id}}" method="post" enctype="multipart/form-data"> 
Deleting a character is permanent, and any data will be lost forever.<br /><br />
Are you sure you want to delete this character?<br /><br />
<input type="submit" name="ultrakill" value="Yes" /> <input type="submit" name="wimpout" value="No" />
</form>
</div>
END;

?>