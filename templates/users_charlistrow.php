<?php

$template = <<<END
<table width="95%">
<tr>
<td style="padding-right: 10px;"><a href="users.php?do=charedit&uid={{id}}">{{avatar}}</a></td>
<td width="100%">
<a href="users.php?do=charedit&uid={{id}}">{{charname}}</a> {{isdefault}}<br />
Level: <b>{{level}}</b><br />
Exp: <b>{{experience}}</b><br />
Birthday: <b>{{fregdate}}</b><br />
</td></tr>
</table>
END;

?>