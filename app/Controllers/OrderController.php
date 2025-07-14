<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\Controller;

class OrderController extends BaseController
{
    public function process()
{
    helper(['form']);

    $menu    = $this->request->getPost('menu');
    $size    = $this->request->getPost('size');
    $jumlah  = (int) $this->request->getPost('jumlah');
    $payment = $this->request->getPost('payment');
    $catatan = $this->request->getPost('catatan');
    $emailTo = $this->request->getPost('email');

    // ✅ DEKLARASI DULUAN MENU DATA
    $menuData = [
        'latte' => ['harga' => 25000, 'deskripsi' => 'Latte Senja – Pilihan sempurna untuk menikmati suasana senja.'],
        'kopilembayung' => ['harga' => 20000, 'deskripsi' => 'Kopi Lembayung – Teman larut malam yang mendalam dan hangat.'],
        'cappuccino' => ['harga' => 28000, 'deskripsi' => 'Cappuccino Mega Jingga – Harmoni cita rasa dalam kehangatan jingga.'],
        'kopihitam' => ['harga' => 18000, 'deskripsi' => 'Kopi Hitam Langit Petang – Klasik dan tegas seperti senja terakhir.'],
        'awantemaram' => ['harga' => 23000, 'deskripsi' => 'Es Kopi Awan Temaram – Dingin menyegarkan di tengah ketenangan senja.'],
        'aren' => ['harga' => 24000, 'deskripsi' => 'Kopi Aren Rintik Senja – Rasa lokal dalam kehangatan romantis.'],
        'redvelvet' => ['harga' => 26000, 'deskripsi' => 'Red Velvet Mentari Padam – Lembut, manis, dan memanjakan.'],
        'matcha' => ['harga' => 27000, 'deskripsi' => 'Matcha Fajar Merona – Tenang dan segar untuk awal hari.'],
        'coklat' => ['harga' => 24000, 'deskripsi' => 'Coklat Hangat Cahaya Senja – Peluk manis saat petang tiba.'],
        'taro' => ['harga' => 25000, 'deskripsi' => 'Taro Malam Berbintang – Manis lembut dengan nuansa magis.'],
        'cookiescream' => ['harga' => 26000, 'deskripsi' => 'Cookies & Cream Awan Sore – Lezat seperti awan manis yang lewat.'],
        'butterflypea' => ['harga' => 17000, 'deskripsi' => 'Butterfly Pea Dusk – Unik dan menenangkan.'],
        'tehpeach' => ['harga' => 15000, 'deskripsi' => 'Teh Peach – Sensasi manis dan segar yang menenangkan.'],
        'tehberry' => ['harga' => 22000, 'deskripsi' => 'Teh Berry Pelangi – Ceria dan menyegarkan.'],
        'lemonade' => ['harga' => 22000, 'deskripsi' => 'Lemonade Cahaya Purnama – Segar seperti cahaya bulan.'],
        'yakult' => ['harga' => 24000, 'deskripsi' => 'Sunset Yakult Splash – Asam manis yang menyegarkan.'],
        'mangga' => ['harga' => 23000, 'deskripsi' => 'Mangga Senja Tropis – Manis tropis untuk menyambut malam.'],
        'lychee' => ['harga' => 18000, 'deskripsi' => 'Lychee Tea Mentari – Ringan dan manis menyegarkan.'],
        'waffle' => ['harga' => 28000, 'deskripsi' => 'Banana Waffle Senja – Renyah manis di waktu senja.'],
        'rotipanggang' => ['harga' => 18000, 'deskripsi' => 'Roti Panggang Selimut Awan – Hangat dan lembut untuk soremu.'],
        'croissant' => ['harga' => 22000, 'deskripsi' => 'Croissant Peluk Fajar – Renyah lembut seperti pagi yang cerah.'],
        'cinnamon' => ['harga' => 20000, 'deskripsi' => 'Cinnamon Roll Pelipur Lara – Manis penghibur hati.'],
        'donat' => ['harga' => 19000, 'deskripsi' => 'Donat Kopi Rembulan – Gurih manis kopi malam hari.'],
        'platter' => ['harga' => 25000, 'deskripsi' => 'Mix Platter Senja – Camilan lengkap untuk berbagi cerita.'],
    ];

    // ✅ VALIDASI INPUT
    if (
        $jumlah <= 0 ||
        !array_key_exists($menu, $menuData) ||
        !in_array($payment, ['cash', 'qris', 'shopeepay']) ||
        !filter_var($emailTo, FILTER_VALIDATE_EMAIL)
    ) {
        return redirect()->to('/')->with('error', 'Input tidak valid.');
    }

    $harga      = $menuData[$menu]['harga'];
    $deskripsi  = $menuData[$menu]['deskripsi'];
    $totalHarga = $harga * $jumlah;

    // ✅ ORDER ID
    $orderFile = WRITEPATH . 'order_count.txt';
    if (!file_exists($orderFile)) file_put_contents($orderFile, 1);
    $current = (int) file_get_contents($orderFile);
    $orderId = 'ORD-' . str_pad($current, 3, '0', STR_PAD_LEFT);
    file_put_contents($orderFile, $current + 1);

    // ✅ SIMPAN DATABASE
    $orderModel = new OrderModel();
    $orderModel->insert([
        'order_id'    => $orderId,
        'email'       => $emailTo,
        'menu'        => $menu,
        'size'        => $size,
        'jumlah'      => $jumlah,
        'harga'       => $harga,
        'total_harga' => $totalHarga,
        'deskripsi'   => $deskripsi,
        'catatan'     => $catatan,
        'payment'     => $payment
    ]);

    // ✅ KIRIM EMAIL
    $email = \Config\Services::email();
    $email->setTo($emailTo);
    $email->setCC('admin@seteguksenja.com');
    $email->setSubject("Konfirmasi Pesanan #$orderId – Seteguk Senja");

    $message = view('order/email_template', [
        'orderId'    => $orderId,
        'menu'       => $menu,
        'size'       => $size,
        'jumlah'     => $jumlah,
        'harga'      => $harga,
        'totalHarga' => $totalHarga,
        'catatan'    => $catatan,
        'deskripsi'  => $deskripsi,
        'payment'    => $payment
    ]);

    $email->setMessage($message);
    $email->setMailType('html');

    if (! $email->send()) {
        log_message('error', '❌ Gagal mengirim email: ' . print_r($email->printDebugger(['headers', 'subject', 'body']), true));
    }

    // ✅ TAMPILKAN KONFIRMASI
    return view('order/konfirmasi', compact(
        'orderId', 'menu', 'size', 'jumlah', 'harga',
        'totalHarga', 'catatan', 'deskripsi', 'payment'
    ));
}
public function delete($id)
{
    $orderModel = new \App\Models\OrderModel();

    $order = $orderModel->find($id);
    if ($order) {
        // Jika ada bukti bayar, hapus filenya
        if (!empty($order['bukti_bayar'])) {
            $path = FCPATH . 'uploads/bukti_bayar/' . $order['bukti_bayar'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $orderModel->delete($id);
        return redirect()->back()->with('success', '✅ Pesanan berhasil dihapus.');
    }

    return redirect()->back()->with('error', '❌ Pesanan tidak ditemukan.');
}
}