<?php

$template = <<<END
You are fighting a <b>{{monstername}}</b>.<br />
Monster's HP: {{monsterhp}}<br /><br />
Command?
<form action="fight.php" method="post">
<input type="submit" name="fight" value="Fight" /> <br />
{{spells}}<br />
<input type="submit" name="run" value="Run" />
</form>
END;

?>