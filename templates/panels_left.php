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
<div style="border: solid 1px black; width: 106px; height: 106px; padding: 0px; margin: 0px 0px 5px 0px;">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="106" height="106" id="mapmini" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="mapmini.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="mapmini.swf" quality="high" bgcolor="#ffffff" width="106" height="106" name="mapmini" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</div>
</center>
<div class="big"><b>Travel To</b></div>
{{travelto}}

END;

?>