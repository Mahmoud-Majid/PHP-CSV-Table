<?php

declare(strict_types=1);

function getFiles(string $dirpath): array
{
  $files = [];

  foreach (scandir($dirpath) as $file) {
    if (is_dir($file)) {
      continue;
    }
    $files[] = $dirpath . $file;
  }

  return $files;
}


function getContent(string $fileName, ?callable $transactionHandler = null): array
{
  if (!file_exists($fileName)) {
    return [];
  }


  $file = fopen($fileName, 'r');

  fgetcsv($file);

  $transactions = [];

  while (($transaction = fgetcsv($file)) !== false) {
    if ($transactionHandler) {
      $transaction = $transactionHandler($transaction);
    }
    $transactions[] = $transaction;
  }

  return $transactions;
}

function extractTransaction(array $transactionRow): array
{
  [$date, $checkNumber, $description, $amount] = $transactionRow;

  $amount = (float) str_replace(['$', ','], '', $amount);

  return [
    'date'        => $date,
    'checkNumber' => $checkNumber,
    'description' => $description,
    'amount'      => $amount,
  ];
}

function calculateTotals(array $transactions): array
{
  $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

  foreach ($transactions as $transaction) {
    if ($transaction['amount'] >= 0) {
      $totals['totalIncome'] += $transaction['amount'];
    } else {
      $totals['totalExpense'] += $transaction['amount'];
    }
  }

  $totals['netTotal']  = $totals['totalExpense'] + $totals['totalIncome'];


  return $totals;
}