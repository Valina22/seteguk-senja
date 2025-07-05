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

        // Validasi
        if ($jumlah <= 0 || !in_array($menu, ['latte', 'kopilembayung', 'tehpeach']) || !in_array($payment, ['cash', 'qris', 'shopeepay']) || !filter_var($emailTo, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/')->with('error', 'Input tidak valid.');
        }

        // Data menu
        $menuData = [
            'latte' => ['harga' => 25000, 'deskripsi' => 'Latte Senja – Pilihan sempurna untuk menikmati suasana senja.'],
            'kopilembayung' => ['harga' => 20000, 'deskripsi' => 'Kopi Lembayung – Teman larut malam yang mendalam dan hangat.'],
            'tehpeach' => ['harga' => 15000, 'deskripsi' => 'Teh Peach – Sensasi manis dan segar yang menenangkan.']
        ];

        $harga       = $menuData[$menu]['harga'];
        $deskripsi   = $menuData[$menu]['deskripsi'];
        $totalHarga  = $harga * $jumlah;

        // Generate Order ID
        $orderFile = WRITEPATH . 'order_count.txt';
        if (!file_exists($orderFile)) file_put_contents($orderFile, 1);
        $current = (int) file_get_contents($orderFile);
        $orderId = 'ORD-' . str_pad($current, 3, '0', STR_PAD_LEFT);
        file_put_contents($orderFile, $current + 1);

        // Simpan ke database
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

        // Kirim Email
        $email = \Config\Services::email();
        $email->setTo($emailTo);
        $email->setCC('admin@seteguksenja.com'); // Ganti dengan email admin
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
        $email->send();

        // Tampilkan halaman konfirmasi
        return view('order/konfirmasi', compact(
            'orderId', 'menu', 'size', 'jumlah', 'harga',
            'totalHarga', 'catatan', 'deskripsi', 'payment'
        ));
    }
}
