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
<form action="index.php?do=guildnews" method="post">
Edit your Guild's news/info below.<br /><br />
<textarea name="news" rows="5" cols="30">{{news}}</textarea><br />
<input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" />
</form>
END;

?>