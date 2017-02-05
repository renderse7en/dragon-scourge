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
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td width="175" style="vertical-align: middle;">
    <table width="100%" cellspacing="2" cellpadding="0">
    <tr>
    <td><img src="{{charpicture}}" alt="" /></td>
    <td width="100%">Level: <b>{{level}}</b> <br />
    Exp: <b>{{experience}}</b><br />
    Gold: <b>{{gold}}</b><br />
    <a href="users.php?do=profile">Extended Profile</a>
    </td>
    </tr>
    </table>
</td><td style="vertical-align: middle;">
    {{levelup}}<br />
    {{levelspell}}<br />
    {{quickheal}}
</td>
</td><td style="vertical-align: middle;">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td width="33%" style="text-align: right; padding-right: 3px;">Weapon:<br />Armor:<br />Helmet:<br />Shield:</td>
    <td align="left"><b>{{weapon}}</b><br /><b>{{armor}}</b><br /><b>{{helmet}}</b><br /><b>{{shield}}</b></td>
    </tr>
    </table>
</td><td width="200" style="vertical-align: middle;">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr><td align="right">{{hpbar}}</td></tr>
    <tr><td align="right">{{mpbar}}</td></tr>
    <tr><td align="right">{{tpbar}}</td></tr>
    </table>
</td>
</tr>
</table>
END;

?>