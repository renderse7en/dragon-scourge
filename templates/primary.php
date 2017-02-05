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