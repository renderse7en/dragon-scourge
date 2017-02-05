<?php

$template = <<<END
<table style="border-bottom: solid 1px black; width: 95%;" cellspacing="0" cellpadding="0"><tr>
<td>{{image}}</td>
<td style="vertical-align: middle; width: 100%;">
<b>{{name}}</b><br />
{{attrtype}}: {{basevalue}}<br />
Price: {{buycost}} Gold<br />
{{level}}
{{strength}}
{{dexterity}}
{{energy}}
<span class="blue">{{itemmods}}</span>
<form action="index.php?do=buy" method="post">
<input type="submit" name="two" value="Buy This Item" style="width: 150px;" />
<input type="hidden" name="idstring" value="{{fullid}}" />
</form>
</td>
</tr></table>
END;

?>