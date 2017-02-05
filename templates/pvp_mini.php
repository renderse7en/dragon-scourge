<?php

$template = <<<END
<head>
{{metareload}}
<base target="{{target}}" />
<style type="text/css">
body { font: 10px Verdana; background-color: white; padding: 0px; margin: 0px; }
</style>
</head>
<body {{parentreload}}>
{{content}}
</body>
</html>
END;

?>