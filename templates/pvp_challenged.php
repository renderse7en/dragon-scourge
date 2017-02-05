<?php

$template = <<<END
{{avatar}}<br />
You have been challenged to a duel by <b>{{charname}} (Level {{level}})</b>.<br />
Duels Won: <b>{{pvpwins}}</b><br />
Duels Lost: <b>{{pvplosses}}</b><br />
Highest Character Defeated: <b>{{pvphighest}}</b><br /><br />
Do you accept?<br /><br />
<form action="pvp.php?do=accept" method="post">
<input type="submit" name="yes" value="Yes" /> <input type="submit" name="no" value="No" />
</form>
END;

?>