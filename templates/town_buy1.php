<?php

$template = <<<END
Buying weapons will increase your Attack Power. Buying armor, shields and other items will increase your Defense Power.<br /><br />
<div class="big"><b>The stats for your current items are:</b></div>
{{olditems}}<br />
<div class="big"><b>The following items are available in this town:</b></b></div>
{{itemtable}}
<br />
If you've changed your mind, you may also return to <a href="index.php">town</a>.
END;

?>