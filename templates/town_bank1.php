<?php

$template = <<<END
Storing money in the bank prevents you from losing it if you die in combat. However, your money in the bank cannot be used when purchasing of items or maps.<br /><br />
You are currently storing {{formatbank}} gold in the bank, and you are carrying {{formatgold}} gold in your pocket.<br /><br />
<form action="index.php?do=bank" method="post">
Enter an amount and then click the Deposit or Withdraw button:<br />
<input type="text" name="amount" size="10" maxlength="20" /> <input type="submit" name="deposit" value="Deposit" /> <input type="submit" name="withdraw" value="Withdraw" />
</form>
If you've changed your mind, you may also return to <a href="index.php">town</a>.
END;

?>