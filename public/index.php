<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../vendor/autoload.php';

$page = PlainPages::self();
$page->extend(__DIR__ . '/layouts/layout.php');
?>

---------------------------------
contents start here.
---------------------------------

<?php $page->section('contents'); ?>
<h1>Welcome to PlainPages!</h1>
<p>for raw php with low maintenance web sites. </p>
<ul>
    <li><a href="sided.php">page with nested templates.</a></li>
    <li><a href="plain.php">page without extended template.</a></li>
</ul>
<?php $page->end(); ?>
