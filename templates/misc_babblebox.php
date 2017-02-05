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
<head>
<meta http-equiv="refresh" content="45">
<title>Babblebox</title>
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
<body onload="window.scrollTo(0,99999)">
{{shouts}}
<div class="babble1">
<form action="index.php?do=babblebox{{guild}}" method="post">
<input type="text" name="babble" size="15" maxlength="100" /> <input type="submit" name="submit" value="Babble!" />
</form>
</div>
</body>
</html>
END;

?>