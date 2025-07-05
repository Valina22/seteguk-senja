<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $allowedFields = [
        'order_id', 'email', 'menu', 'size', 'jumlah', 'harga', 'total_harga',
        'catatan', 'deskripsi', 'payment', 'status', 'created_at'
    ];
}
