<?php

$template = <<<END
{{story}}
{{reward}}
<br /><br />
<div class="big"><b>The stats for your current item are:</b></div>
{{olditems}}<br />
<div class="big"><b>The stats for the dropped item are:</b></b></div>
{{itemtable}}<br />
<form action="story.php" method="post">
<input type="submit" name="takeitem" value="Take the Item" /> <input type="submit" name="noitem" value="Don't Take the Item" />
</form><br /><br />
END;

?>