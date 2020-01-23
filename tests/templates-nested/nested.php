<?php
/** @var \WScore\PlainPages\PlainPages $this */
$this->extend(__DIR__.'/layout.php');
$this->section('contents');
?>
Nested:
<?= $this->get('contents'); ?>
<?php $this->end(); ?>
