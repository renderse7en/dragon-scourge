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
<form action="login.php?do=login" method="post">
<table width="90%" cellspacing="0" cellpadding="5">
<tr><td width="20%">Username:</td><td><input type="text" name="username" size="30" maxlength="30" /></td></tr>
<tr><td>Password:</td><td><input type="password" name="password" size="30" maxlength="30" /></td></tr>
<tr><td>Remember Me?</td><td><input type="checkbox" name="remember" value="yes" /> Yes.</td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Log In" /></td></tr>
</table>
</form>
END;

?>