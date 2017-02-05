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
In order to prevent mouse macro bots from playing the game automatically, this game requires a periodic manual security code confirmation to ensure that only real people are playing the game. Please enter the code you see below into the box and click the Submit button. You will then be returned to the game.
<form action="index.php?do=botcheck" method="post">
{{images}}<br />
<input type="text" name="botcheck" size="10" maxlength="10" /><br />
<input type="submit" name="submit" value="Submit" />
</form>
END;

?>