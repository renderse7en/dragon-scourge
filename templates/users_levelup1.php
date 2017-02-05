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
You have Level Points to spend. Different character classes get extra bonuses to certain stats from level points. Your stat bonuses are listed below.<br /><br />
Class: {{classname}}<br />
Damage Per Strength: {{damageperstrength}}<br />
Defense Per Dexterity: {{defenseperdex}}<br />
HP Per Life: {{hpperlife}}<br />
MP Per Energy: {{mpperenergy}}<br /><br />
You have <b>{{levelup}} point(s)</b> to spend.<br /><br />
<form action="users.php?do=levelup" method="post">
{{dropdowns}}
<input type="submit" name="submit" value="Submit" />
</form>
END;

?>