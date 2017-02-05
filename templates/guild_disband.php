<?php

$template = <<<END
Disbanding the Guild is permanent and cannot be undone. Are you sure you want to do this?<br /><br />
<form action="index.php?do=guilddisband" method="post">
<input type="submit" name="yes" value="Yes" /> <input type="submit" name="no" value="No" />
</form>
END;

?>