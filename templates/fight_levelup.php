<?php

$template = <<<END
You are fighting a <b>{{monstername}}</b>.<br /><br />
{{message}}
You attack the monster for (<span style="color: black; font-weight: bold;">{{playerphysdamage}}</span>|<span style="color: green; font-weight: bold;">{{playermagicdamage}}</span>|<span style="color: red; font-weight: bold;">{{playerfiredamage}}</span>|<span style="color: blue; font-weight: bold;">{{playerlightdamage}}</span>) damage.<br /><br />
You have defeated the <b>{{monstername}}</b>.<br />
You gain <b>{{newexp}}</b> Experience.<br />
You gain <b>{{newgold}}</b> Gold.<br /><br />
<span class="red"><b>You have gained a level! You have 5 Level Points to spend on your character<br />
Level points can be accessed in your Extended Profile.</b></span><br /><br />
You may now continue <a href="index.php">exploring</a>.
END;

?>