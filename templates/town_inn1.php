<?php

$template = <<<END
Resting at the Inn will restore your HP, MP and TP to their maximum levels.<br /><br />
A night's rest at this Inn will cost <b>{{innprice}}</b> gold. Is that ok?<br /><br />
<form action="index.php?do=inn" method="post"><input type="submit" name="submit" value="Yes" /> <input type="submit" name="abortmission" value="No" /></form>
If you've changed your mind, you may also return to <a href="index.php">town</a>.
END;

?>