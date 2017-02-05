<?php

$template = <<<END
<tr>
<td width="40%">{{new}}{{money}}<a href="index.php?do=mailview&id={{id}}">{{title}}</a></td>
<td width="30%">From: <a href="users.php?do=profile&uid={{senderid}}">{{sendername}}</a></td>
<td width="30%">{{fpostdate}}</td>
</tr>
END;

?>