<?php

$template = <<<END
<table width="95%">
<tr>
<td style="padding-right: 10px;"><h1>{{number}}</h1></td>
<td style="padding-right: 10px;"><a href="users.php?do=profile&uid={{id}}">{{avatar}}</a></td>
<td width="100%">
<a href="users.php?do=profile&uid={{id}}">{{newcharname}}</a><br />
Level: <b>{{level}}</b><br />
Exp: <b>{{experience}}</b><br />
Birthday: <b>{{fregdate}}</b>
</td></tr>
</table>
END;

?>