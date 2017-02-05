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
<head>
<title>Map</title>
<style type="text/css">
body { font: 10px Verdana; background-color: white; padding: 0px; margin: 0px; }
table { font: 10px Verdana; }
td { vertical-align: top; }
input { font: 10px Verdana; }
img { border-style: none; }
a { color: #996600; text-decoration: none; font-weight: bold; }
a:hover { color: #663300; }
.main { border: solid 1px black; }
.grey { color: #999999; }
.red { color: #ff0000; }
.blue { color: #0000ff; }
.big { font: 11px Verdana; background-color: #dddddd; border: solid 1px #aaaaaa; padding: 2px; margin-bottom: 3px; }
.babble1 { background-color: #eeeeee; font: 10px Verdana; margin: 0px; padding: 2px; }
.babble2 { background-color: #ffffff; font: 10px Verdana; margin: 0px; padding: 2px; }
</style>
</head>
<body><center>
<div style="border: solid 1px black; width: 510px; height: 510px; padding: 0px; margin: 0px 0px 5px 0px;">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="510" height="510" id="map" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="map.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="map.swf" quality="high" bgcolor="#ffffff" width="510" height="510" name="map" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</div>
<font color="gray">Town</font> | <font color="red">You</font> | <font color="blue">Player</font>
</center></body>
</html>
END;

?>