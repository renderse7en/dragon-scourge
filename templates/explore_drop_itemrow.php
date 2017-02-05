<?php

$template = <<<END
<table style="border-bottom: solid 1px black; width: 95%;" cellspacing="0" cellpadding="0"><tr>
<td>{{image}}</td>
<td style="vertical-align: middle; width: 100%;">
<b>{{name}}</b><br />
{{attrtype}}: {{basevalue}}<br />
{{level}}
{{strength}}
{{dexterity}}
{{energy}}
<span class="blue">{{itemmods}}</span>
</td>
</tr></table>
END;

?>