<?php

$template = <<<END
<form action="users.php?do=charedit&uid={{id}}" method="post" enctype="multipart/form-data"> 
Deleting a character is permanent, and any data will be lost forever.<br /><br />
Are you sure you want to delete this character?<br /><br />
<input type="submit" name="ultrakill" value="Yes" /> <input type="submit" name="wimpout" value="No" />
</form>
</div>
END;

?>