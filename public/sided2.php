<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../vendor/autoload.php';

$page = PlainPages::self();
$page->extend(__DIR__ . '/layouts/side.php');
?>
<h1>This is also a main content</h1>
<p>for nested extended templates but without starting a section openly.</p>
