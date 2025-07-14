<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pesanan Selesai</title>
</head>
<body style="font-family: 'Poppins', sans-serif; background-color: #fffaf5; color: #4a4a4a; padding: 20px;">
    <div style="max-width: 600px; margin: auto; border: 1px solid #e4dcd2; border-radius: 12px; padding: 30px; background-color: #ffffff;">
        <h2 style="color: #8b4513;">☕ Pesanan Selesai</h2>
        <p>Hai <strong><?= esc($order['email']) ?></strong>,</p>

        <p>Terima kasih telah memesan di <strong>Seteguk Senja</strong>.</p>

        <p>Berikut detail pesanan kamu:</p>
        <ul style="line-height: 1.8;">
            <li><strong>Order ID:</strong> <?= esc($order['order_id']) ?></li>
            <li><strong>Menu:</strong> <?= esc($order['menu']) ?></li>
            <li><strong>Jumlah:</strong> <?= esc($order['jumlah']) ?></li>
            <li><strong>Total Harga:</strong> Rp<?= number_format($order['total_harga'], 0, ',', '.') ?></li>
            <li><strong>Status:</strong> <span style="color: green;"><strong>SELESAI</strong></span></li>
        </ul>

        <p style="margin-top: 20px;">Semoga harimu sehangat aroma kopi,</p>
        <p><em>Salam hangat dari kami,</em><br><strong>Seteguk Senja ☕</strong></p>

        <hr style="margin-top: 30px;">
        <p style="font-size: 0.9em; color: #999;">Email ini dikirim otomatis. Jika kamu tidak merasa melakukan pemesanan, silakan abaikan.</p>
    </div>
</body>
</html>
