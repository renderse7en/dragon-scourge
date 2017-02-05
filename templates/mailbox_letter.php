<?php

$template = <<<END
<table width="95%">
<tr>
<td style="padding-right: 10px;"><a href="users.php?do=profile&uid={{senderid}}">{{senderavatar}}</a></td>
<td width="100%">
From: <a href="users.php?do=profile&uid={{senderid}}">{{sendername}}</a><br />
Date: {{fpostdate}}<br />
Subject: {{title}}<br />
{{moneytransfer}}
</td></tr></table><hr />
{{message}}<br /><hr />
<a href="index.php?do=mailreply&id={{id}}">Reply</a> | <a href="index.php?do=maildelete&id={{id}}">Delete</a> | <a href="index.php?do=mailnew">New Letter</a> | <a href="index.php?do=mailbox">Inbox</a> | <a href="index.php?do=mailsent">Outbox</a><br /><br />
You may also return to <a href="index.php">town</a>.
END;

?>