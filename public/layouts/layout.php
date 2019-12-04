<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../../vendor/autoload.php';

$page = PlainPages::self();

?>
<?php $page->section('contents'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PlainPages Samples</title>
    <link rel="stylesheet" href="/demo.css">
    <?= $page->get('html-head'); ?>
</head>
<body>
<div class="header">
    <a href="/">PlainPages Samples</a><br>
    <p><?= $page->get('sub-title', 'for raw PHP with low maintenance web sites'); ?></p>
</div>
<div class="contents">
    <?= $page->get('contents'); ?>
</div>
<div class="footer">
    Wow, it does work...
</div>
</body>
</html>
<?php $page->end(); ?>