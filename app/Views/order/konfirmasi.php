<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pesanan</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .konfirmasi-wrapper {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 700px;
            margin: 40px auto;
            font-family: 'Poppins', sans-serif;
            color: #4a2c18;
        }

        .konfirmasi-wrapper h2 {
            color: #8b4513;
            margin-bottom: 20px;
        }

        .konfirmasi-wrapper p {
            margin: 8px 0;
            font-size: 1em;
        }

        .konfirmasi-wrapper img {
            margin-top: 15px;
            border-radius: 8px;
            max-width: 220px;
            display: block;
        }

        .cta-btn {
            display: inline-block;
            margin-top: 30px;
            background-color: #8b4513;
            color: #fff;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #6f3510;
        }
    </style>
</head>
<body class="section">

<div class="konfirmasi-wrapper">
    <h2>✅ Terima Kasih atas Pesanan Anda!</h2>
    <p><strong>No. Pesanan:</strong> <?= esc($orderId) ?></p>
    <p><strong>Menu:</strong> <?= esc($menu) ?></p>
    <p><strong>Ukuran:</strong> <?= esc($size) ?></p>
    <p><strong>Jumlah:</strong> <?= esc($jumlah) ?></p>
    <p><strong>Harga Satuan:</strong> Rp<?= number_format($harga, 0, ',', '.') ?></p>
    <p><strong>Total Harga:</strong> Rp<?= number_format($totalHarga, 0, ',', '.') ?></p>
    <p><strong>Catatan:</strong> <?= esc($catatan) ?: '-' ?></p>
    <p><strong>Deskripsi:</strong> <?= esc($deskripsi) ?></p>

    <h3>Pembayaran via: <?= esc(ucfirst($payment)) ?></h3>

    <?php if ($payment == 'qris'): ?>
        <p>Silakan scan QR berikut untuk membayar:</p>
        <img src="<?= base_url('assets/img/qris.jpg') ?>" alt="QRIS">
    <?php elseif ($payment == 'shopeepay'): ?>
        <p>Kirim pembayaran ke ShopeePay: <strong>0812-3456-7890</strong> (a.n. Seteguk Senja)</p>
    <?php else: ?>
        <p>Silakan lakukan pembayaran langsung saat mengambil pesanan Anda di kedai kami.</p>
    <?php endif; ?>

    <a href="<?= base_url() ?>" class="cta-btn">Kembali ke Beranda</a>
    </div>

</body>
</html>
