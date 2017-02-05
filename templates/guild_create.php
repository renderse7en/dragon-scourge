<?php

$template = <<<END
<form action="index.php?do=guildcreate" method="post">
<table>
<tr><td width="30%">Name:</td><td><input type="text" name="name" size="30" maxlength="50" /><br />Your Guild's full name.<br /><br /><br /></td></tr>
<tr><td width="30%">Tagline:</td><td><input type="text" name="tagline" size="5" maxlength="4" /><br />A short abbreviation or tagline for your Guild. For example, if your Guild name is "Lords of Carnage," your tagline might be "LoC." This will appear in brackets in front of each member's name.<br /><br /><br /></td></tr>
<tr><td width="30%">Name Color:</td><td><input type="text" name="color2" size="10" maxlength="7" value="#" /><br />HTML color code used to display the name of your Guild, and the names of each member.<br />(<a href="http://hotwired.lycos.com/webmonkey/reference/color_codes/" target="_new">Click here</a> for a list of color codes.)<br /><br /><br /></td></tr>
<tr><td width="30%">Tagline Color:</td><td><input type="text" name="color1" size="10" maxlength="7" value="#" /><br />HTML color code used to display your Guild's tagline.<br />(<a href="http://hotwired.lycos.com/webmonkey/reference/color_codes/" target="_new">Click here</a> for a list of color codes.)<br /><br /><br /></td></tr>
<tr><td width="30%">Cost to Join:</td><td><input type="text" name="joincost" size="10" maxlength="7" /><br />How much gold it will cost for a member to join your guild.<br /><br /><br /></td></tr>
<tr><td width="30%">Rank 1 Title:</td><td><input type="text" name="rank1" size="30" maxlength="30" /><br />Lowest ranking Guild member's title. <br /><br /><br /></td></tr>
<tr><td width="30%">Rank 2 Title:</td><td><input type="text" name="rank2" size="30" maxlength="30" /><br />2nd ranking Guild member's title.<br /><br /><br /></td></tr>
<tr><td width="30%">Rank 3 Title:</td><td><input type="text" name="rank3" size="30" maxlength="30" /><br />3rd ranking Guild member's title.<br /><br /><br /></td></tr>
<tr><td width="30%">Rank 4 Title:</td><td><input type="text" name="rank4" size="30" maxlength="30" /><br />4th ranking Guild member's title. These are sub-leaders for your Guild.<br /><br /><br /></td></tr>
<tr><td width="30%">Rank 5 Title:</td><td><input type="text" name="rank5" size="30" maxlength="30" /><br />Highest ranking Guild member's title. This will be your title, as well as any other member you promote to this rank.<br /><br /><br /></td></tr>
<tr><td width="30%">Opening Statement</td><td><textarea name="statement" rows="5" cols="30"></textarea><br />Your Guild's introduction statement or creed.</td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" /></td></tr>
<tr><td colspan="2"><b>NOTES:</b> The cost for creating a guild is {{guildstartup}} gold.<br /><br />Ranks 1 through 3 are nominal only and are all treated identically in the game. Rank 4 members can distribute Guild funds, promote other members up to Rank 3, and demote/remove members. Rank 5 members are Guild Leaders, and can do all Rank 4 tasks as well as promote members to ranks 4 and 5, and disband the Guild.</td></tr>
</table>
</form>
END;

?>