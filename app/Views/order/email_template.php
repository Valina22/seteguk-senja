<h2>Terima Kasih Telah Memesan di Seteguk Senja!</h2>
<p><strong>Nomor Pesanan:</strong> <?= esc($orderId) ?></p>
<p><strong>Menu:</strong> <?= esc($menu) ?></p>
<p><strong>Ukuran:</strong> <?= esc($size) ?></p>
<p><strong>Jumlah:</strong> <?= esc($jumlah) ?></p>
<p><strong>Harga Satuan:</strong> Rp<?= number_format($harga, 0, ',', '.') ?></p>
<p><strong>Total Harga:</strong> Rp<?= number_format($totalHarga, 0, ',', '.') ?></p>
<p><strong>Deskripsi:</strong> <?= esc($deskripsi) ?></p>
<p><strong>Catatan:</strong> <?= esc($catatan ?: '-') ?></p>
<p><strong>Pembayaran:</strong> <?= esc(ucfirst($payment)) ?></p>
<hr>
<p>📍 Silakan ambil pesanan Anda di kedai kami atau ikuti petunjuk pembayaran sesuai metode yang dipilih.</p>
