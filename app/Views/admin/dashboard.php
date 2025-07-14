<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Utama -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container">
        <!-- Header -->
        <header>
            <h2>Dashboard Admin</h2>
            <p>Halo, <strong><?= session()->get('admin_username') ?></strong> (<?= session()->get('admin_role') ?>)</p>
            <a class="btn btn-logout" href="<?= base_url('/admin/logout') ?>">🔓 Logout</a>
        </header>

        <!-- Filter Pembayaran -->
        <form class="filter-form" method="get" action="">
            <label>Filter Pembayaran:</label>
            <select name="payment" onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="cash" <?= $filter == 'cash' ? 'selected' : '' ?>>Cash</option>
                <option value="qris" <?= $filter == 'qris' ? 'selected' : '' ?>>QRIS</option>
                <option value="shopeepay" <?= $filter == 'shopeepay' ? 'selected' : '' ?>>ShopeePay</option>
            </select>
        </form>

        <!-- Pagination -->
        <?= $pager->links() ?>

        <!-- Tabel Pesanan -->
        <div class="table-container">
            <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Email</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                        <th>Bukti Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($orders as $o): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($o['order_id']) ?></td>
                            <td><?= esc($o['email']) ?></td>
                            <td><?= esc($o['menu']) ?></td>
                            <td><?= esc($o['jumlah']) ?></td>
                            <td>Rp<?= number_format($o['total_harga'], 0, ',', '.') ?></td>
                            <td><?= esc($o['payment']) ?></td>
                            <td><?= esc($o['status']) ?></td>
                            <td>
                                <form action="<?= base_url('/admin/update-status') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $o['id'] ?>">
                                    <select name="status" onchange="this.form.submit()">
                                        <option <?= $o['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                        <option <?= $o['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                        <option <?= $o['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <?php if (!empty($o['bukti_bayar'])): ?>
                                    <a href="<?= base_url('uploads/bukti_bayar/' . $o['bukti_bayar']) ?>" target="_blank">Lihat</a>
                                <?php else: ?>
                                    <span>-</span>
                                <?php endif; ?>
                            </td>
                            <td style="display:flex; gap:5px;">
    <a class="btn btn-print" href="<?= base_url('/admin/cetak/' . $o['id']) ?>" target="_blank">🧾 Cetak</a>

    <form action="<?= base_url('/order/delete/' . $o['id']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-delete">🗑️ Hapus</button>
    </form>
</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Statistik -->
        <div class="statistik">
            <a class="btn btn-export" href="<?= base_url('/admin/export-excel') ?>">📥 Export ke Excel</a>

            <h3>Statistik</h3>
            <p><strong>Total Income:</strong> Rp<?= number_format($totalIncome, 0, ',', '.') ?></p>

            <canvas id="statusChart" width="300" height="300"></canvas>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Sukses', 'Gagal'],
                datasets: [{
                    label: 'Status Pesanan',
                    data: [<?= $successCount ?>, <?= $failedCount ?>],
                    backgroundColor: ['#4CAF50', '#F44336']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>
