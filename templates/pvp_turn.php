<?php

$template = <<<END
{{avatar}}<br />
You are fighting <b>{{charname}}</b>.<br />
{{charname}}'s HP: {{currenthp}}<br /><br />
{{message}}
{{charname}} attacks you for (<span style="color: black; font-weight: bold;">{{playerphysdamage}}</span>|<span style="color: green; font-weight: bold;">{{playermagicdamage}}</span>|<span style="color: red; font-weight: bold;">{{playerfiredamage}}</span>|<span style="color: blue; font-weight: bold;">{{playerlightdamage}}</span>) damage.<br /><br />
Command?
<form action="pvp.php" method="post">
<input type="submit" name="fight" value="Fight" /> <br />
{{spells}}<br />
<input type="submit" name="run" value="Run" />
</form>
END;

?>