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
{{charname}} is currently Rank 1. Demoting this member will remove him from your guild. Are you sure you want to do that?<br /><br />
<form action="index.php?do=guildremove" method="post">
<input type="hidden" name="charid" value="{{charid}}" />
<input type="submit" name="yes" value="Yes" /> <input type="submit" name="no" value="No" />
</form>
END;

?>