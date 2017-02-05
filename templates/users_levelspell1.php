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
You have Spell Points to spend. Each character is allowed 10 Spell Slots, to be filled however you wish. If you put a spell in a non-empty slot, the old spell will be overwritten.<br /><br />
You have <b>{{levelspell}} point(s)</b> to spend.<br /><br />
<form action="users.php?do=levelspell" method="post">
{{spelldropdowns}}
<input type="submit" name="submit" value="Submit" />
</form>
END;

?>