<?php

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 19

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

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