<?php

$template = <<<END
You have Level Points to spend. Different character classes get extra bonuses to certain stats from level points. Your stat bonuses are listed below.<br /><br />
Class: {{classname}}<br />
Damage Per Strength: {{damageperstrength}}<br />
Defense Per Dexterity: {{defenseperdex}}<br />
HP Per Life: {{hpperlife}}<br />
MP Per Energy: {{mpperenergy}}<br /><br />
You have <b>{{levelup}} point(s)</b> to spend.<br /><br />
<form action="users.php?do=levelup" method="post">
{{dropdowns}}
<input type="submit" name="submit" value="Submit" />
</form>
END;

?>