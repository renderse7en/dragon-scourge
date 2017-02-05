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
<center>
<div style="border: solid 1px #aaaaaa; background-color: #eeeeee; padding: 5px; width: 400px; text-align: left;">
<b>Guild Statement for {{name}}:</b><br /><br />
{{statement}}
</div></center><br /><br />
Applying for this Guild costs {{joincost}} gold. This is non-refundable. Are you sure you want to apply to this Guild?<br /><br />
<form action="index.php?do=guildapp&id={{id}}" method="post">
<input type="submit" name="yes" value="Yes" /> <input type="submit" name="no" value="No" />
</form>
END;

?>