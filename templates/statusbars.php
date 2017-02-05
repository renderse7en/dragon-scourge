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
<table cellspacing="2" cellpadding="0" title="{{bigname}}: {{current}} / {{max}}"><tr><td style="width: 25px; height:10px; font: 10px Verdana; vertical-align: middle;">{{littlename}}:</td><td style="padding:0px; width:100px; height:10px; border:solid 1px black; background-image:url(images/bars_grey.gif);">
<div style="text-align:right; padding:0px; width:{{width}}px; background-image:url(images/bars_{{color}}.gif);"><img src="images/bars_{{color}}end.gif" alt="" /></div></td><td style="width: 60px; height:10px; font: 10px Verdana; vertical-align: middle;">&nbsp;{{current}} / {{max}}</td></tr></table>
END;

?>