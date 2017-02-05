<?php

$template = <<<END
<table cellspacing="2" cellpadding="0" title="{{bigname}}: {{current}} / {{max}}"><tr><td style="width: 25px; height:10px; font: 10px Verdana; vertical-align: middle;">{{littlename}}:</td><td style="padding:0px; width:100px; height:10px; border:solid 1px black; background-image:url(images/bars_grey.gif);">
<div style="text-align:right; padding:0px; width:{{width}}px; background-image:url(images/bars_{{color}}.gif);"><img src="images/bars_{{color}}end.gif" alt="" /></div></td><td style="width: 60px; height:10px; font: 10px Verdana; vertical-align: middle;">&nbsp;{{current}} / {{max}}</td></tr></table>
END;

?>