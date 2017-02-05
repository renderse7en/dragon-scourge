<?php

$template = <<<END
Your Outbox shows all letters that you have sent to other players. Any letters that have been deleted by the recipient will not be available in your Outbox.<br /><br />
{{messages}}
<hr />
<a href="index.php?do=mailnew">New Letter</a> | <a href="index.php?do=mailbox">Inbox</a> | <a href="index.php?do=mailsent">Outbox</a><br /><br />
You may also return to <a href="index.php">town</a>.
END;

?>