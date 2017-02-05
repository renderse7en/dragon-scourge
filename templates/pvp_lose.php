<?php

$template = <<<END
{{avatar}}<br />
You are fighting <b>{{monstername}}</b>.<br />
{{message}}
{{monstername}} attacks you for (<span style="color: black; font-weight: bold;">{{playerphysdamage}}</span>|<span style="color: green; font-weight: bold;">{{playermagicdamage}}</span>|<span style="color: red; font-weight: bold;">{{playerfiredamage}}</span>|<span style="color: blue; font-weight: bold;">{{playerlightdamage}}</span>) damage.<br /><br />
<b>You have died.</b><br /><br />
You have been sent to town given back a portion of your hit points to continue your journey.<br /><br />
You may now continue <a href="index.php">playing</a>, and you should probably hope that you fair better next time.
END;

?>