<?php

$template = <<<END
<form action="index.php?do=humanity" method="post">
In order to prevent macros and robots from abusing the game, you must verify that you are able to read the following image. Please enter the 6 character code you see in the image into the form box below to continue playing. Thank you.<br /><br />
<img src="images/botcheck/{{exploreverifyimage}}" alt="Human Verification" style="border: solid 1px black;" /><br /><br />
Verification Code: <input type="text" name="verify" size="10" maxlength="6" /><br />
<input type="submit" name="submit" value="Submit" />
</form>
END;

?>