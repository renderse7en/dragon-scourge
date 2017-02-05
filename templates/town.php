<?php

$template = <<<END
<center>
<table style="width: 450px;">
<tr>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=inn">Stay at the Inn<br /><img src="images/town_inn.png" alt="" /></a><br /><br /><br /><br /></td>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=buy">Buy Weapons and Armor<br /><img src="images/town_buy.png" alt="" /></a><br /><br /><br /><br /></td>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=maps">Buy Maps<br /><img src="images/town_maps.png" alt="" /></a><br /><br /><br /><br /></td>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=duel">Duelling Grounds<br /><img src="images/town_duel.png" alt="" /></a><br /><br /><br /><br /></td>
</tr>
<tr>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=bank">Deposit/Withdraw Gold at the Bank<br /><img src="images/town_bank.png" alt="" /></a></td>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=mailbox">Enter the Post Office<br /><img src="images/town_post.png" alt="" /></a> {{unread}}</td>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=gamble">Enter the Gambling Hall<br /><img src="images/town_gamble.png" alt="" /></a></td>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=top10">View the Hall of Fame<br /><img src="images/town_hall.png" alt="" /></a></td>
</tr>
<tr>
<td width="25%" style="text-align: center; vertical-align: top;"><a href="index.php?do=guilds">Enter the Guild Hall<br /><img src="images/town_guilds.png" alt="" /></a></td>
<td width="25%" style="text-align: center; vertical-align: top;"></td>
<td width="25%" style="text-align: center; vertical-align: top;"></td>
<td width="25%" style="text-align: center; vertical-align: top;"></td>
</tr>
</table>
</center>
END;

?>