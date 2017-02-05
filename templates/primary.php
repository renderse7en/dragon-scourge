<?php

/*
MODIFYING THIS FILE IN ANY WAY WILL CAUSE THE GAME TO STOP FUNCTIONING.
In order to protect my intellectual property, certain security measures had to be taken.
As such, the primary template is locked. Any change to this file will result in the game
becoming nonfunctional. While I realize that there are valid reasons for wanting to change
the page structure, it is impossible to allow that without users also being able to remove
or change my copyright information. If you feel you absolutely must have access to change
this file at will, consider upgrading to the licensed commercial version of Dragon Scourge.
Thank you.
*/

$template = <<<END
<head>
<title>{{gamename}} :: {{pagetitle}}</title>
<style type="text/css">
body { font: 10px Verdana; background-image: url(images/{{background}}.jpg); padding: 0px; }
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

<table cellspacing="0" cellpadding="3" style="width: 800px; height: 570px; border: solid 1px black; background-color: white; ">
  <tr>
    <td colspan="3" style="border-bottom: solid 1px #cccccc;">
      <table width="100%" cellspacing="0" cellpadding="0"><tr><td width="65%">
      <a href="index.php"><img src="images/logo.png" alt="{{gamename}}" title="{{gamename}}" /></a>
      </td><td style="vertical-align:middle; white-space:nowrap;">
      {{topnav}}
      </td></tr></table>
    </td>
  </tr>
  <tr>
    <td valign="top" style="height: 100%; border-right: solid 1px #cccccc;">
      <img src="images/spacer.gif" alt="" width="140" height="1" /><br />
      {{leftnav}}
    </td>
    <td valign="top" style="height: 100%;">
      <div style="width: 475px; height: 405px; overflow: auto;">
      <div class="big"><b>{{pagetitle}}</b></div>
      {{content}}
      </div>
    </td>
    <td valign="top" style="height: 100%; border-left: solid 1px #cccccc;">
      <img src="images/spacer.gif" alt="" width="160" height="1" /><br />
      {{rightnav}}
    </td>
  </tr>
  <tr>
    <td colspan="3" style="border-top: solid 1px #cccccc;">{{bottomnav}}</td>
  </tr>
</table>
<table cellspacing="0" cellpadding="3" style="width: 800px; border: solid 1px black; background-color: white; margin-top: 2px;">
  <tr>
    <td width="50%">
    Version <a href="index.php?do=version">{{version}}</a> / {{numqueries}} Queries / {{totaltime}} Seconds
    </td>
    <td width="50%" style="text-align:right;">
    <a href="http://www.dragonscourge.com">Dragon Scourge</a> &copy; 2003-2005 by <a href="http://www.renderse7en.com">renderse7en</a>
    </td>
  </tr>
</table>
</center></body>
</html>
END;

?>