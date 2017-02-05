<?php

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 20

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

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