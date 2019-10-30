<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../../vendor/autoload.php';

$page = PlainPages::self();

?>
<?php $page->section('payload'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>sample for PlainPages library</title>
    <link rel="stylesheet" href="/demo.css">
    <?= $page->get('html-head'); ?>
</head>
<body>
<div class="header">
    <a href="/">PlainPages sample pages.</a>
</div>
<div class="contents">
    <?= $page->get('contents'); ?>
</div>
<hr>
<div class="footer">
    Wow, it does work...
</div>
</body>
</html>
<?php $page->end(); ?>