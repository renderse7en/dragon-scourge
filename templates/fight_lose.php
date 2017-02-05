<?php

$template = <<<END
You are fighting a <b>{{monstername}}</b>.<br />
Monster's HP: {{monsterhp}}<br /><br />
{{message}}
You attack the monster for (<span style="color: black; font-weight: bold;">{{playerphysdamage}}</span>|<span style="color: green; font-weight: bold;">{{playermagicdamage}}</span>|<span style="color: red; font-weight: bold;">{{playerfiredamage}}</span>|<span style="color: blue; font-weight: bold;">{{playerlightdamage}}</span>) damage.<br /><br />
The monster attacks you for (<span style="color: black; font-weight: bold;">{{monsterphysdamage}}</span>|<span style="color: green; font-weight: bold;">{{monstermagicdamage}}</span>|<span style="color: red; font-weight: bold;">{{monsterfiredamage}}</span>|<span style="color: blue; font-weight: bold;">{{monsterlightdamage}}</span>) damage.<br /><br />
<b>You have died.</b><br /><br />
As a consequence, you've lost half of your gold and {{deathpenalty}} percent of your experience. You have been sent to town given back a portion of your hit points to continue your journey.<br /><br />
You may now continue <a href="index.php">playing</a>, and you should probably hope that you fair better next time.
END;

?>