<?php

declare(strict_types=1);
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transactions' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require(APP_PATH . 'App.php');

$files = getFiles(FILES_PATH);

$transactions = [];

foreach ($files as $file) {
  $transactions[] = getContent($file, 'extractTransaction');
}
$totals = calculateTotals($transactions[0]);


require VIEWS_PATH . 'transactions.php';