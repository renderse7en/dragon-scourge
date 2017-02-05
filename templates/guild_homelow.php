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
<center>
<table style="width: 450px;"><tr>
<td width="50%">
<div class="big"><b>News</b></div>
<div style="border: solid 1px #aaaaaa; background-color: #eeeeee; padding: 5px; text-align: left;">
{{news}}<br /><br />
<a href="index.php?do=guildnews">Edit</a>
</div>
</td>
<td>
{{babblebox}}
</td>
</tr><tr>
<td>
<div class="big"><b>Bank</b></div>
Your Guild has {{bank}} gold.<hr />
<form action="index.php?do=guildbank" method="post">
Deposit <input type="text" name="golddeposit" size="5" maxlength="10" /> Gold <input type="submit" name="in" value="Go" />
</form>
</td>
<td>
<div class="big"><b>More Guild Functions</b></div>
<ul>
<li /><a href="index.php?do=guildleave">Leave Guild</a>
</ul>
</td>
</tr></table><br /><br />
You may also return to <a href="index.php">town</a> or the <a href="index.php?do=guilds&list=list">Guild List</a>.
END;

?>