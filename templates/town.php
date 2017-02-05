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
<center>
<table style="width: 450px;">
<tr>
<td width="33%" style="text-align: center; vertical-align: top;"><a href="index.php?do=inn">The Inn<br /><img src="images/town_inn.png" alt="" /></a><br /><br /></td>
<td width="34%" style="text-align: center; vertical-align: top;"><a href="index.php?do=buy">Buy Items<br /><img src="images/town_buy.png" alt="" /></a><br /><br /></td>
<td width="33%" style="text-align: center; vertical-align: top;"><a href="index.php?do=maps">Buy Maps<br /><img src="images/town_maps.png" alt="" /></a><br /><br /></td>
</tr>
<tr>
<td width="33%" style="text-align: center; vertical-align: top;"><a href="index.php?do=bank">The Bank<br /><img src="images/town_bank.png" alt="" /></a><br /><br /></td>
<td width="34%" style="text-align: center; vertical-align: top;"><a href="index.php?do=mailbox">The Post Office {{unread}}<br /><img src="images/town_post.png" alt="" /></a> <br /><br /></td>
<td width="33%" style="text-align: center; vertical-align: top;"><a href="index.php?do=gamble">The Gambling Hall<br /><img src="images/town_gamble.png" alt="" /></a><br /><br /></td>
</tr>
<tr>
<td width="33%" style="text-align: center; vertical-align: top;"><a href="index.php?do=duel">Duelling Grounds<br /><img src="images/town_duel.png" alt="" /></a></td>
<td width="34%" style="text-align: center; vertical-align: top;"><a href="index.php?do=guilds">The Guild Hall<br /><img src="images/town_guilds.png" alt="" /></a></td>
<td width="33%" style="text-align: center; vertical-align: top;"><a href="index.php?do=top10">Hall of Fame<br /><img src="images/town_hall.png" alt="" /></a></td>
</tr>
</table>
</center>
END;

?>