<?php
require('PtvApi.php');

$api = new PtvApi();


?>
<pre>
<?php echo $api->getStops(6); ?>
</pre>