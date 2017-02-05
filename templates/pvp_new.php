<?php

$template = <<<END
{{avatar}}<br />
You are fighting <b>{{charname}}</b>.<br />
{{charname}}'s HP: {{currenthp}}<br /><br />
Command?
<form action="pvp.php" method="post">
<input type="submit" name="fight" value="Fight" /> <br />
{{spells}}<br />
<input type="submit" name="run" value="Run" />
</form>
END;

?>