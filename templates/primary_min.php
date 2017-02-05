<?php

$template = <<<END
<head>
<title>{{gamename}} :: {{pagetitle}}</title>
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
<body>
{{content}}
</body>
</html>
END;

?>