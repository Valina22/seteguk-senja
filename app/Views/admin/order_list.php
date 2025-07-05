<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Daftar Order</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 2rem;
      background-color: #f9f9f9;
    }

    h2 {
      margin-bottom: 1rem;
    }

    form,
    table {
      margin-bottom: 1.5rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 10px;
      text-align: left;
      border: 1px solid #ccc;
    }

    th {
      background-color: #eee;
    }

    select, button {
      padding: 5px 10px;
      font-size: 14px;
    }

    .export-btn {
      display: inline-block;
      margin-bottom: 1rem;
      background-color: #4CAF50;
      color: white;
      padding: 8px 12px;
      text-decoration: none;
      border-radius: 4px;
    }

    .export-btn:hover {
      background-color: #45a049;
    }

    .filter-box {
      margin-bottom: 1rem;
    }

    .no-data {
      text-align: center;
      color: #777;
    }
  </style>
</head>
<body>

  <h2>Daftar Order</h2>

  <!-- Filter -->
  <form method="get" action="/admin/dashboard" class="filter-box">
    <label for="payment">Filter Metode Pembayaran:</label>
    <select name="payment" id="payment">
      <option value="">Semua</option>
      <option value="Transfer" <?= ($filter == 'Transfer') ? 'selected' : '' ?>>Transfer</option>
      <option value="QRIS" <?= ($filter == 'QRIS') ? 'selected' : '' ?>>QRIS</option>
      <option value="DANA" <?= ($filter == 'DANA') ? 'selected' : '' ?>>DANA</option>
      <option value="ShopeePay" <?= ($filter == 'ShopeePay') ? 'selected' : '' ?>>ShopeePay</option>
    </select>
    <button type="submit">Terapkan</button>
  </form>

  <!-- Export -->
  <a href="/admin/export-excel" class="export-btn">Export ke Excel</a>

  <!-- Tabel -->
  <?php if (!empty($orders)): ?>
    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Email</th>
          <th>Menu</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
          <th>Metode Pembayaran</th>
          <th>Status</th>
          <th>Update Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): ?>
        <tr>
          <td><?= $order['order_id'] ?></td>
          <td><?= $order['email'] ?></td>
          <td><?= $order['menu'] ?></td>
          <td><?= $order['jumlah'] ?></td>
          <td>Rp<?= number_format($order['total_harga'], 0, ',', '.') ?></td>
          <td><?= $order['payment'] ?></td>
          <td><?= ucfirst($order['status']) ?></td>
          <td>
            <form method="post" action="/admin/update-status">
              <input type="hidden" name="id" value="<?= $order['id'] ?>">
              <select name="status" onchange="this.form.submit()">
                <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="selesai" <?= $order['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="dibatalkan" <?= $order['status'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
              </select>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="no-data">Belum ada data order untuk ditampilkan.</p>
  <?php endif; ?>

</body>
</html>
