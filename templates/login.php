<?php

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