<?php

$template = <<<END
{{avatar}}<br />
You have been challenged to a duel by <b>{{charname}} (Level {{level}})</b>. Do you accept?<br /><br />
<form action="pvp.php?do=accept" method="post">
<input type="submit" name="yes" value="Yes" /> <input type="submit" name="no" value="No" />
</form>
END;

?>