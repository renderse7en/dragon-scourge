<?php

$template = <<<END
<form action="index.php?do=guildedit" method="post">
<table>
<tr><td width="30%">Name:</td><td>{{name}}<br /><br /><br /></td></tr>
<tr><td width="30%">Tagline:</td><td>{{tagline}}<br /><br /><br /></td></tr>
<tr><td width="30%">Name Color:</td><td><input type="text" name="color2" size="10" maxlength="7" value="{{color2}}" /><br />HTML color code used to display the name of your Guild, and the names of each member.<br />(<a href="http://hotwired.lycos.com/webmonkey/reference/color_codes/" target="_new">Click here</a> for a list of color codes.)<br /><br /><br /></td></tr>
<tr><td width="30%">Tagline Color:</td><td><input type="text" name="color1" size="10" maxlength="7" value="{{color1}}" /><br />HTML color code used to display your Guild's tagline.<br />(<a href="http://hotwired.lycos.com/webmonkey/reference/color_codes/" target="_new">Click here</a> for a list of color codes.)<br /><br /><br /></td></tr>
<tr><td width="30%">Cost to Join:</td><td><input type="text" name="joincost" size="10" maxlength="7" value="{{joincost}}" /><br />How much gold it will cost for a member to join your guild.<br /><br /><br /></td></tr>
<tr><td width="30%">Rank 1 Title:</td><td><input type="text" name="rank1" size="30" maxlength="30" value="{{rank1}}" /><br />Lowest ranking Guild member's title. <br /><br /><br /></td></tr>
<tr><td width="30%">Rank 2 Title:</td><td><input type="text" name="rank2" size="30" maxlength="30" value="{{rank2}}" /><br />2nd ranking Guild member's title.<br /><br /><br /></td></tr>
<tr><td width="30%">Rank 3 Title:</td><td><input type="text" name="rank3" size="30" maxlength="30" value="{{rank3}}" /><br />3rd ranking Guild member's title.<br /><br /><br /></td></tr>
<tr><td width="30%">Rank 4 Title:</td><td><input type="text" name="rank4" size="30" maxlength="30" value="{{rank4}}" /><br />4th ranking Guild member's title. These are sub-leaders for your Guild.<br /><br /><br /></td></tr>
<tr><td width="30%">Rank 5 Title:</td><td><input type="text" name="rank5" size="30" maxlength="30" value="{{rank5}}" /><br />Highest ranking Guild member's title. This will be your title, as well as any other member you promote to this rank.<br /><br /><br /></td></tr>
<tr><td width="30%">Opening Statement</td><td><textarea name="statement" rows="5" cols="30">{{statement}}</textarea><br />Your Guild's introduction statement or creed.</td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" /></td></tr>
</table>
</form>
END;

?>