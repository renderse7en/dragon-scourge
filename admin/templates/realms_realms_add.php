<?php

$template = <<<END
<h3>Add a Realm</h3>
<a href="index.php?do=realms&fn=realms">Back to Realms List</a><br /><br />
<form action="index.php?do=realms&fn=realms&action=new" method="post">
<table cellspacing="0" cellpadding="5" width="98%">
<tr><td width="25%">Realm Name</td><td><input type="text" name="name" size="20" maxlength="30" /><br /><span class="grey">The name of this Realm.</span><br /><br /></td></tr>
<tr><td width="25%" class="td_alt">Realm Size</td><td class="td_alt"><input type="text" name="size" size="5" maxlength="5" /><br /><span class="grey">Realms are divided into four square quadrants. This number is the length/width of each individual quadrant.<br />Range: 0 to 65535.</span><br /><br /></td></tr>
<tr><td colspan="2" style="border-top: solid 2px black;"><center>
<button type="submit" name="submit"><img src="icons/tick.png" align="top" /> Save</button> <button type="reset"><img src="icons/cross.png" align="top" /> Reset</button>
</center></td></tr>
</table>
END;

?>