<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        return view('home'); // View utama (berisi HTML website kamu)
    }

    public function processOrder()
    {
        // Ambil data dari form
        $menu = $this->request->getPost('menu-item');
        $size = $this->request->getPost('size');
        $quantity = $this->request->getPost('quantity');
        $payment = $this->request->getPost('payment');
        $notes = $this->request->getPost('address');

        // Hitung harga
        $priceList = [
            'Latte Senja' => 25000,
            'Es Kopi Lembayung' => 20000,
            'Teh Peach' => 18000
        ];

        $multiplier = [
            'Kecil' => 1,
            'Medium' => 1.2,
            'Besar' => 1.5
        ];

        $price = $priceList[$menu] ?? 0;
        $total = $price * ($multiplier[$size] ?? 1) * intval($quantity);

        // Kirim data ke view struk
        $data = [
            'menu' => $menu,
            'size' => $size,
            'quantity' => $quantity,
            'payment' => $payment,
            'notes' => $notes,
            'total' => $total,
            'formatted_total' => "Rp" . number_format($total, 0, ',', '.')
        ];

        return view('receipt', $data);
    }
}
