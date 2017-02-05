<?php

$template = <<<END
{{avatar}}<br />
You are fighting <b>{{monstername}}</b>.<br /><br />
{{message}}
You attack {{monstername}} for (<span style="color: black; font-weight: bold;">{{playerphysdamage}}</span>|<span style="color: green; font-weight: bold;">{{playermagicdamage}}</span>|<span style="color: red; font-weight: bold;">{{playerfiredamage}}</span>|<span style="color: blue; font-weight: bold;">{{playerlightdamage}}</span>) damage.<br /><br />
You have defeated <b>{{monstername}}</b>.<br />
You may now <a href="index.php">return to the game</a>.
END;

?>