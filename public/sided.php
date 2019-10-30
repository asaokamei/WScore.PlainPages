<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../vendor/autoload.php';

$page = PlainPages::self();
$page->extend(__DIR__ . '/layouts/side.php');
?>

---------------------------------
right-side menu.
---------------------------------

<?php $page->section('side'); ?>
<h3>This is side menu</h3>
<p>for showing up as side menu. </p>
<?php $page->end(); ?>

---------------------------------
main contents.
---------------------------------

<?php $page->section('main'); ?>
<h1>This is main content</h1>
<p>for nested extended templates.</p>
<?php $page->end(); ?>

---------------------------------
stylesheet for this page only.
---------------------------------

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
