<?php

$template = <<<END
<tr>
<td width="40%"><a href="index.php?do=mailviewsent&id={{id}}">{{title}}</a></td>
<td width="30%">To: <a href="users.php?do=profile&uid={{recipientid}}">{{recipientname}}</a></td>
<td width="30%">{{fpostdate}}</td>
</tr>
END;

?>