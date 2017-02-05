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
Gambling can be a quick way to gain easy money, but it can also break you, leaving you as nothing more than a pitiful shell of wretched human filth. But hey, that won't happen to you, will it? You're a lucky guy, right? Right?<br /><br />Select a cup, enter a bet amount, and click the button to see if you win.<br /><br />
<a href="index.php?do=gamble&mode=easy">Easy gambling</a> gives 2-to-1 payouts. <a href="index.php?do=gamble&mode=hard">Hard gambling</a> gives 10-to-1 payouts, but it's a lot harder to win.<br /><br />
<form action="index.php?do=gamble&mode={{mode}}" method="post">
{{form}}
<br />
Bet amount: <input type="text" name="amount" size="5" maxlength="10" /><br /><br />
<input type="submit" name="submit" value="Give it a shot" />
</form>
If you've changed your mind, you can also <a href="index.php">return to town</a>.
END;

?>