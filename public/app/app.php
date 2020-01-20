<?php

use WScore\PlainPages\PlainPages;

require_once __DIR__ . '/../../vendor/autoload.php';

$page = PlainPages::self(dirname(__DIR__));
$page->extend('/layouts/layout.php');

/**
 * @return PlainPages
 */
function getPlainPages()
{
    return PlainPages::self();
}

return $page;