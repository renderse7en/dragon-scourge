<?php

$template = <<<END
{{charname}} is currently Rank 1. Demoting this member will remove him from your guild. Are you sure you want to do that?<br /><br />
<form action="index.php?do=guildremove" method="post">
<input type="hidden" name="charid" value="{{charid}}" />
<input type="submit" name="yes" value="Yes" /> <input type="submit" name="no" value="No" />
</form>
END;

?>