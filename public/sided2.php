<?php

require_once __DIR__ . '/app/app.php';

$page = getPlainPages();
$page->extend('/layouts/side.php');

?>
<h1>This is also a main content</h1>
<p>for nested extended templates but without starting a section openly.</p>
