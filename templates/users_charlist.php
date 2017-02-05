<?php

$template = <<<END
The Characters section lets you create and modify the characters on your account, and select a default character to play with.  Each account is allowed to create up to 4 different characters.<br /><hr />
Your account currently has <b>{{characters}}</b> characters ({{remaining}} remaining).<br />
Your current default character is <b>{{activecharname}}</b>.<br />
{{newcharlink}}<br />
<form action="users.php?do=characters" method="post">
Select a new default character:<br />
<select name="makeactive">{{selectcharlist}}</select> <input type="submit" name="submit" value="Submit" />
</form>
<hr />
Click on one of your characters from the list below to edit its avatar or delete it from your account.<br />
{{fullcharlist}}
<br />
When you're done with your characters, you may continue playing <a href="index.php">the game</a>.
END;

?>
