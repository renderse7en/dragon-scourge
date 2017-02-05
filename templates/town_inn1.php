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
Resting at the Inn will restore your HP, MP and TP to their maximum levels.<br /><br />
A night's rest at this Inn will cost <b>{{innprice}}</b> gold. Is that ok?<br /><br />
<form action="index.php?do=inn" method="post"><input type="submit" name="submit" value="Yes" /> <input type="submit" name="abortmission" value="No" /></form>
If you've changed your mind, you may also return to <a href="index.php">town</a>.
END;

?>