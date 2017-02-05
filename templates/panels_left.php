<?php

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