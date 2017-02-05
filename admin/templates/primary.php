<?php

$template = <<<END
<head>
<title>{{gamename}} :: {{pagetitle}}</title>
<style type="text/css">
body { font: 10px Verdana; background-image: url(../images/background1.jpg); padding: 0px; }
table { font: 10px Verdana; }
td { vertical-align: top; }
input { font: 10px Verdana; }
select { font: 10px Verdana; }
img { border-style: none; }
a { color: #996600; text-decoration: none; font-weight: bold; }
a:hover { color: #663300; }
.main { border: solid 1px black; }
.grey { color: #888888; }
.red { color: #ff0000; }
.blue { color: #0000ff; }
.big { font: 11px Verdana; background-color: #dddddd; border: solid 1px #aaaaaa; padding: 2px; margin-bottom: 3px; }
.babble1 { background-color: #eeeeee; font: 10px Verdana; margin: 0px; padding: 2px; }
.babble2 { background-color: #ffffff; font: 10px Verdana; margin: 0px; padding: 2px; }
.tab_on { background-color: #ffffff; border: solid 1px black; border-bottom: none; padding: 5px; text-align: center; margin: 0px 2px; }
.tab_off { background-color: #eeeeee; border: solid 1px black; padding: 5px; text-align: center; }
.td_alt { background-color: #f0f0f0; }
</style>
</head>
<body><center>

<table cellspacing="0" cellpadding="3" style="width: 800px;">
    <tr>
        {{tabstrip}}
    </tr>
</table>
<table cellspacing="0" cellpadding="3" style="width: 800px; height: 570px; border: solid 1px black; border-top: none; background-color: white; ">
    <tr><td style="padding: 10px;">
        {{content}}
    </td></tr>
</table>
END;

?>