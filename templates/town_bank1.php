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
<script type="text/javascript">
function autopop(theValue) {
    document.bank.amount.value = theValue;
}
</script>
Storing money in the bank prevents you from losing it if you die in combat. However, your money in the bank cannot be used when purchasing of items or maps.<br /><br />
You are currently storing {{formatbank}} gold in the bank, and you are carrying {{formatgold}} gold in your pocket.<br /><br />
<form action="index.php?do=bank" method="post" name="bank">
Enter an amount and then click the Deposit or Withdraw button:<br />
<input type="text" name="amount" size="10" maxlength="20" id="amount" /> <input type="submit" name="deposit" value="Deposit" /> <input type="submit" name="withdraw" value="Withdraw" /><br />
<a href="#" onClick="javascript:autopop('{{maxpocket}}');">Deposit All</a> | <a href="#" onClick="javascript:autopop('{{maxbank}}');">Withdraw All</a><br /><br />
</form>
If you've changed your mind, you may also return to <a href="index.php">town</a>.
END;

?>