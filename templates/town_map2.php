<?php

$template = <<<END
You are buying the {{name}} map. Is that ok?<br /><br />
<form action="index.php?do=maps" method="post"><input type="hidden" name="id" value="{{id}}" /><input type="submit" name="three" value="Yes" /> <input type="submit" name="pullout" value="No" /></form>
END;

?>