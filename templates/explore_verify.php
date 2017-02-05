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
<form action="index.php?do=humanity" method="post">
In order to prevent macros and robots from abusing the game, you must verify that you are able to read the following image. Please enter the 6 character code you see in the image into the form box below to continue playing. Thank you.<br /><br />
<img src="images/botcheck/{{exploreverifyimage}}" alt="Human Verification" style="border: solid 1px black;" /><br /><br />
Verification Code: <input type="text" name="verify" size="10" maxlength="6" /><br />
<input type="submit" name="submit" value="Submit" />
</form>
END;

?>