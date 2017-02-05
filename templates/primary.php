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
<link rel="stylesheet" href="css/primary.css" type="text/css" />
<script type="text/javascript" src="scripts/tooltip.js"></script>
<style type="text/css">
body { background-image: url(images/{{background}}.jpg); }
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
END;

?>