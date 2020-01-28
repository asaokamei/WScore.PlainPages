<?php

$page = require_once __DIR__ . '/app/app.php';
$page->extend('/layouts/side.php');
?>
<?php $page->section('side'); ?>
<h3>This is side menu</h3>
<p>for showing up as side menu. </p>
<?php $page->end(); ?>
<?php $page->section('contents'); ?>
<h1>This is main content</h1>
<p>for nested extended templates.</p>
<?php $page->end(); ?>
<?php $page->section('html-head'); ?>
<style>
    h1, h3 {
        margin: 0;
        color: red;
    }
    h1 {
        color: red;
    }
    h3 {
        color: blue;
    }
</style>
<?php $page->end(); ?>
