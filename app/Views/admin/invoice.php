<!DOCTYPE html>
<html>
<head>
    <title>Invoice - <?= $order['order_id'] ?></title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .invoice-box { border: 1px solid #eee; padding: 20px; max-width: 600px; margin: auto; }
        .heading { font-size: 20px; margin-bottom: 10px; }
        table { width: 100%; }
        th, td { text-align: left; padding: 5px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="heading">Invoice - <?= $order['order_id'] ?></div>
        <table>
            <tr><th>Email</th><td><?= $order['email'] ?></td></tr>
            <tr><th>Menu</th><td><?= $order['menu'] ?></td></tr>
            <tr><th>Jumlah</th><td><?= $order['jumlah'] ?></td></tr>
            <tr><th>Total Harga</th><td>Rp<?= number_format($order['total_harga'], 0, ',', '.') ?></td></tr>
            <tr><th>Metode Pembayaran</th><td><?= $order['payment'] ?></td></tr>
            <tr><th>Status</th><td><?= $order['status'] ?></td></tr>
            <tr><th>Tanggal</th><td><?= $order['created_at'] ?></td></tr>
        </table>
        <br><br>
        <button onclick="window.print()">🖨️ Cetak</button>
    </div>
</body>
</html>
