<?php

$template = <<<END
In order to prevent mouse macro bots from playing the game automatically, this game requires a periodic manual security code confirmation to ensure that only real people are playing the game. Please enter the code you see below into the box and click the Submit button. You will then be returned to the game.
<form action="index.php?do=botcheck" method="post">
{{images}}<br />
<input type="text" name="botcheck" size="10" maxlength="10" /><br />
<input type="submit" name="submit" value="Submit" />
</form>
END;

?>