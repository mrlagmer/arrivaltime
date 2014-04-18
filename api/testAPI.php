<?php
require('PtvApi.php');

$api = new PtvApi();


?>
<pre>
<?php print_r(json_decode($api->getTimes('1174'), true)); ?>
</pre>