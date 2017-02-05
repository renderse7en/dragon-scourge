<?php

$template = <<<END
You have Spell Points to spend. Each character is allowed 10 Spell Slots, to be filled however you wish. If you put a spell in a non-empty slot, the old spell will be overwritten.<br /><br />
You have <b>{{levelspell}} point(s)</b> to spend.<br /><br />
<form action="users.php?do=levelspell" method="post">
{{spelldropdowns}}
<input type="submit" name="submit" value="Submit" />
</form>
END;

?>