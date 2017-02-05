<?php

$template = <<<END
<form action="index.php?do=guildnews" method="post">
Edit your Guild's news/info below.<br /><br />
<textarea name="news" rows="5" cols="30">{{news}}</textarea><br />
<input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" />
</form>
END;

?>