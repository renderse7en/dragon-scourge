<?php

$template = <<<END
The Post Office is where you can send and receive Letters and Money Transfers.<br /><br />
{{messages}}
<span class="red">*</span> = New Letter.<br />
<span class="blue">$</span> = Letter contains a Money Transfer.<br /><br />
<hr />
<a href="index.php?do=mailnew">New Letter</a> | <a href="index.php?do=mailbox">Inbox</a> | <a href="index.php?do=mailsent">Outbox</a><br /><br />
You may also return to <a href="index.php">town</a>.
END;

?>