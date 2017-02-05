<?php

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 20

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

$template = <<<END
<div class="big"><b>Location</b></div>
{{action}} {{townname}}<br />
Realm: {{worldname}}<br />
Latitude: {{latitude}}<br />
Longitude: {{longitude}}<br /><br />
<center>
<a href="index.php?do=explore&dir=n"><img src="images/compass_01.png" alt="North" title="North" /></a><br />
<a href="index.php?do=explore&dir=w"><img src="images/compass_02.png" alt="West" title="West" /></a><a href="index.php?do=explore&dir=e"><img src="images/compass_03.png" alt="East" title="East" /></a><br />
<a href="index.php?do=explore&dir=s"><img src="images/compass_04.png" alt="South" title="South" /></a><br /><br />
{{minimap}}
</center>
<div class="big"><b>Travel To</b></div>
{{travelto}}

END;

?>