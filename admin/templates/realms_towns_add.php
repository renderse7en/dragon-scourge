<?php

$template = <<<END
<h3>Add a Town</h3>
<a href="index.php?do=realms&fn=towns">Back to Towns List</a><br /><br />
<form action="index.php?do=realms&fn=towns&action=new" method="post">
<table cellspacing="0" cellpadding="5" width="98%">
<tr><td width="25%">Town Name</td><td><input type="text" name="name" size="20" maxlength="30" /><br /><span class="grey">The name of this Town.</span><br /><br /></td></tr>
<tr><td width="25%" class="td_alt">Realm</td><td class="td_alt"><select name="world">{{realmselect}}</select><br /><span class="grey">The Realm this Town is a part of.</span><br /><br /></td></tr>
<tr><td width="25%">Latitude</td><td><input type="text" name="latitude" size="5" maxlength="6" /><br /><span class="grey">The vertical location of this town on the map.<br />Must be within the map size of the selected Realm.</span><br /><br /></td></tr>
<tr><td width="25%" class="td_alt">Longitude</td><td class="td_alt"><input type="text" name="longitude" size="5" maxlength="6" /><br /><span class="grey">The horizontal location of this town on the map.<br />Must be within the map size of the selected Realm.</span><br /><br /></td></tr>
<tr><td width="25%">Inn Price</td><td><input type="text" name="innprice" size="5" maxlength="10" /><br /><span class="grey">The cost to stay at this town's Inn.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
<tr><td width="25%" class="td_alt">Map Price</td><td class="td_alt"><input type="text" name="mapprice" size="5" maxlength="10" /><br /><span class="grey">The cost to buy the map to this town.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
<tr><td width="25%">TP Price</td><td><input type="text" name="travelpoints" size="5" maxlength="5" /><br /><span class="grey">The travel points to jump to this town.<br />Range: 0 to 65535.</span><br /><br /></td></tr>
<tr><td width="25%" class="td_alt">Minimum Item Level</td><td class="td_alt"><input type="text" name="itemminlvl" size="5" maxlength="10" /><br /><span class="grey">The minimum base item level that will be generated in this town.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
<tr><td width="25%">Maximum Item Level</td><td><input type="text" name="itemmaxlvl" size="5" maxlength="10"/><br /><span class="grey">The maximum base item level that will be generated in this town.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
<tr><td colspan="2" style="border-top: solid 2px black;"><center>
<button type="submit" name="submit"><img src="icons/tick.png" align="top" /> Save</button> <button type="reset"><img src="icons/cross.png" align="top" /> Reset</button>
</td></tr>
</table>
END;

?>