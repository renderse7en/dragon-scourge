<?php

$template = <<<END
<h3>Delete a Town</h3>
<a href="index.php?do=realms&fn=town">Back to Towns List</a><br /><br />
<form action="index.php?do=realms&fn=towns&action=delete&id={{id}}" method="post">
<table cellspacing="0" cellpadding="5">
<tr><td colspan="2" style="border-top: solid 2px black;"><center>
Are you sure you want to delete {{name}}?
</center></td></tr>
<tr><td colspan="2" style="border-top: solid 2px black;"><center>
<button type="submit" name="diediedie"><img src="icons/tick.png" align="top" /> Yes</button> <button type="submit" name="abort"><img src="icons/cross.png" align="top" /> No</button>
</center></td></tr>
</table>
END;

?>