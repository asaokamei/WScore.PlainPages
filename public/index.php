<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../vendor/autoload.php';

$page = PlainPages::self();
$page->extend(__DIR__ . '/layouts/layout.php');
?>
<h1>Welcome to PlainPages!</h1>
<p>for raw php with low maintenance web sites. </p>

<h2>Nested Template</h2>
<ul>
    <li><a href="sided.php">page with nested templates.</a></li>
    <li><a href="sided2.php">page with nested templates but without explicitly starting a section.</a></li>
</ul>

<h2>Plain PHP File</h2>
<ul>
    <li><a href="plain.php">page without extended template.</a></li>
    <li><a href="plain2.php">page without extended template but without explicitly starting a section.</a></li>
</ul>