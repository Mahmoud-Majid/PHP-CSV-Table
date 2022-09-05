<!DOCTYPE html>
<html lang="en">

<head>
  <title>Transactions</title>
  <style>
  table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
  }

  table tr th,
  table tr td {
    padding: 5px;
    border: 1px #eee solid;
  }

  tfoot tr th,
  tfoot tr td {
    font-size: 20px;
  }

  tfoot tr th {
    text-align: left;
  }
  </style>
</head>

<body>
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Check #</th>
        <th>Description</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($transactions)) : ?>
      <?php foreach ($transactions[0] as $transaction) : ?>
      <tr>
        <td><?= date('M j, Y', strtotime($transaction['date'])) ?></td>
        <td><?= $transaction['checkNumber'] ?></td>
        <td><?= $transaction['description'] ?></td>
        <td>
          <span style="<?= $transaction['amount'] > 0 ? 'color: green;' : 'color: red;' ?> font-weight: bold;">
            <?= $transaction['amount'] ?>
            $
          </span>
      </tr>
      <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="3">Total Income:</th>
        <td><?= $totals['totalIncome'] ?? 0 ?></td>
      </tr>
      <tr>
        <th colspan="3">Total Expense:</th>
        <td><?= $totals['totalExpense'] ?? 0 ?></td>
      </tr>
      <tr>
        <th colspan="3">Net Total:</th>
        <td><?= $totals['netTotal'] ?? 0 ?></td>
      </tr>
    </tfoot>
  </table>
</body>

</html>