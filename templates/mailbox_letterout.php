<?php

$template = <<<END
To: <a href="users.php?do=profile&uid={{recipientid}}">{{recipientname}}</a><br />
Date: {{fpostdate}}<br />
Subject: {{title}}<br /><hr />
{{message}}<br /><hr />
<a href="index.php?do=mailnew">New Letter</a> | <a href="index.php?do=mailbox">Inbox</a> | <a href="index.php?do=mailsent">Outbox</a><br /><br />
You may also return to <a href="index.php">town</a>.
END;

?>