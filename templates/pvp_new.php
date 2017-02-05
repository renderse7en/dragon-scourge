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
{{avatar}}<br />
You are fighting <b>{{charname}}</b>.<br />
{{charname}}'s HP: {{currenthp}}<br /><br />
Command?
<form action="pvp.php" method="post">
<input type="submit" name="fight" value="Fight" /> <br />
{{spells}}<br />
<input type="submit" name="run" value="Run" />
</form>
END;

?>