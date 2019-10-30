<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../vendor/autoload.php';

$page = PlainPages::self();
?>

---------------------------------
contents start here.
---------------------------------

<?php $page->section('contents'); ?>
<h1>This is a plain page</h1>
<p>for raw php with low maintenance web sites. </p>
<?php $page->end(); ?>
