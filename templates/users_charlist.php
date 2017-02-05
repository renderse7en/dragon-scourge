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
The Characters section lets you create and modify the characters on your account, and select a default character to play with.  Each account is allowed to create up to 4 different characters.<br /><hr />
Your account currently has <b>{{characters}}</b> characters ({{remaining}} remaining).<br />
Your current default character is <b>{{activecharname}}</b>.<br />
{{newcharlink}}<br />
<form action="users.php?do=characters" method="post">
Select a new default character:<br />
<select name="makeactive">{{selectcharlist}}</select> <input type="submit" name="submit" value="Submit" />
</form>
<hr />
Click on one of your characters from the list below to edit its avatar or delete it from your account.<br />
{{fullcharlist}}
<br />
When you're done with your characters, you may continue playing <a href="index.php">the game</a>.
END;

?>
