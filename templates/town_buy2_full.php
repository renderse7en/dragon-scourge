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
If you are buying the {{newname}}, then I will buy the {{oldname}} for {{oldsell}} Gold. Is that ok?<br /><br />
<form action="index.php?do=buy" method="post"><input type="hidden" name="idstring" value="{{newidstring}}" /><input type="submit" name="three" value="Yes" /> <input type="submit" name="pullout" value="No" /></form>
END;

?>