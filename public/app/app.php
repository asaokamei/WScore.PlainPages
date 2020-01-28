<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../../vendor/autoload.php';

$page = new PlainPages(dirname(__DIR__));
$page->section('contents');
$page->extend('/layouts/layout.php');

return $page;