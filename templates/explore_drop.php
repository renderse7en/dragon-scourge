<?php

$template = <<<END
The monster dropped an item. You can either accept or ignore the item, but any item you currently have in that slot will be discarded if you choose to accept the item.<br /><br />
<div class="big"><b>The stats for your current item are:</b></div>
{{olditems}}<br />
<div class="big"><b>The stats for the dropped item are:</b></b></div>
{{itemtable}}
<br />
<form action="index.php?do=itemdrop" method="post">
<input type="submit" name="accept" value="Accept This Item" /> <input type="submit" name="ignore" value="Ignore This Item" />
</form>
END;

?>