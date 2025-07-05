<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="section" style="max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2>Struk Pesanan Anda</h2>
        <p><strong>Menu:</strong> <?= esc($menu) ?></p>
        <p><strong>Ukuran:</strong> <?= esc($size) ?></p>
        <p><strong>Jumlah:</strong> <?= esc($quantity) ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= esc($payment) ?></p>
        <p><strong>Catatan:</strong> <?= esc($notes) ?></p>
        <p><strong>Total Harga:</strong> <?= esc($formatted_total) ?></p>

        <a href="<?= base_url() ?>" style="display:inline-block; margin-top:20px; padding:10px 20px; background:#8b4513; color:white; border-radius:5px; text-decoration:none;">Kembali ke Beranda</a>
    </div>
</body>
</html>
