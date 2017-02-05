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
{{story}}
{{reward}}
<br /><br />
<div class="big"><b>The stats for your current item are:</b></div>
{{olditems}}<br />
<div class="big"><b>The stats for the dropped item are:</b></b></div>
{{itemtable}}<br />
<form action="story.php" method="post">
<input type="submit" name="takeitem" value="Take the Item" /> <input type="submit" name="noitem" value="Don't Take the Item" />
</form><br /><br />
END;

?>