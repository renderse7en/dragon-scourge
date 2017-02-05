<?php

$template = <<<END
<center><table width="90%"><tr>
<td colspan="2" style="border-bottom: solid 1px #cccccc">
<center>{{profcharpicture}}<br /><b>{{newcharname}}</b><br /></center>
</td></tr>
<tr>
<td width="50%">
Class: <b>{{charclass}}</b><br />
Gold: <b>{{formatgold}}</b> <span class="grey">{{goldbonus}}</span><br />
Level: <b>{{level}}</b><br />
Experience: <b>{{formatexperience}}</b> <span class="grey">{{expbonus}}</span><br />
Next Level: <b>{{formatnextlvl}}</b><br /><br />

Hit Points: <b>{{currenthp}} / {{maxhp}}</b><br />
Magic Points: <b>{{currentmp}} / {{maxmp}}</b><br />
Travel Points: <b>{{currenttp}} / {{maxtp}}</b><br /><br />

Weapon: <b>{{item1name}}</b><br />
Armor: <b>{{item2name}}</b><br />
Shield: <b>{{item4name}}</b><br />
Helmet: <b>{{item3name}}</b><br />
</td>
<td>
Strength: <b>{{strength}}</b><br />
Dexterity: <b>{{dexterity}}</b><br />
Physical Damage: <b>{{physattack}}</b><br />
Physical Defense: <b>{{physdefense}}</b><br /><br />

Energy: <b><span style="color:green">{{energy}}</style></b><br />
Magic Damage: <b><span style="color: green">{{magicattack}}</span></b><br />
Magic Defense: <b><span style="color: green">{{magicdefense}}</span></b><br /><br />

Fire Damage: <b><span style="color: red">{{fireattack}}</span></b><br />
Fire Defense: <b><span style="color: red">{{firedefense}}</span></b><br /><br />

Lightning Damage: <b><span style="color: blue">{{lightattack}}</span></b><br />
Lightning Defense: <b><span style="color: blue">{{lightdefense}}</span></b><br /><br />
</td>
</tr><tr>
<td colspan="2" style="border-top: solid 1px #cccccc"><center><a href="index.php">Return to the game.</a></center></td>
</tr></table></center>
END;

?>
