<?php
require('PtvApi.php');

$api = new PtvApi();


?>
<pre>
<?php print_r($api->checkHealth()); ?>
</pre>