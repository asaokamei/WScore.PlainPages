<?php

use WScore\PlainPages\PlainPages;
require_once __DIR__ . '/../../vendor/autoload.php';

$page = PlainPages::self();
$page->extend(__DIR__ . '/layout.php');

?>
<?php $page->section('contents'); ?>
<table class="contents">
    <tr>
        <td class="side">
            <?= $page->get('side'); ?>
            <br>
            this is the left side of this layout. please add sub-menu here...</td>
        <td><?= $page->get('contents'); ?></td>
    </tr>
</table>
<?php $page->end(); ?>

---------------------------------
some style for side menus.
---------------------------------

<?php $page->section('html-head'); ?>
<style>
    table.contents {
        border: 2px solid #cccccc;
        border-collapse: collapse;
    }
    table.contents td {
        padding: 1em;
        vertical-align: top;
    }
    table.contents td.side {
        width: 30%;
        border: 1px solid #eeeeee;
        background-color: #f8f8f8;
    }
</style>
<?= $page->get('html-head'); ?>
<?php $page->end(); ?>
