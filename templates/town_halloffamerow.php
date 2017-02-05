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
<table width="95%">
<tr>
<td style="padding-right: 10px;"><h1>{{number}}</h1></td>
<td style="padding-right: 10px;"><a href="users.php?do=profile&uid={{id}}">{{avatar}}</a></td>
<td width="100%">
<a href="users.php?do=profile&uid={{id}}">{{newcharname}}</a><br />
Level: <b>{{level}}</b><br />
Exp: <b>{{experience}}</b><br />
Birthday: <b>{{fregdate}}</b><br />
Duel Record: <b>{{pvpwins}} Won / {{pvplosses}} Lost / Highest Won: {{pvphighest}}</b>
</td></tr>
</table>
END;

?>