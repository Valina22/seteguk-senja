<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\OrderModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends BaseController
{
    public function login()
    {
        return view('admin/login');
    }

    public function loginProcess()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $adminModel = new AdminModel();
    $admin = $adminModel->where('username', $username)->first();

    if ($admin && password_verify($password, $admin['password'])) {
    session()->set([
        'admin_logged_in' => true,
        'admin_username'  => $admin['username'],
        'admin_role'      => $admin['role']
    ]);

    // Uji manual tanpa redirect
return redirect()->to('/admin/dashboard');
}

}

    public function updateStatus()
{
    $id = $this->request->getPost('id');
    $status = $this->request->getPost('status');

    $orderModel = new \App\Models\OrderModel();
    $order = $orderModel->find($id);

    if ($order) {
        $orderModel->update($id, ['status' => $status]);

        // Jika status = 'Selesai', kirim email ke customer
        if ($status === 'Selesai') {
            $email = \Config\Services::email();
            $email->setTo($order['email']);
            $email->setFrom('seteguksenja@gmail.com', 'Seteguk Senja');
            $email->setSubject('Pesanan Anda Telah Selesai');
            $email->setMessage(view('emails/order_success', ['order' => $order]));

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email ke ' . $order['email']);
            }
        }
    }

return view('emails/order_success', ['order' => $order]);
}

    public function dashboard()
{
    if (!session()->get('admin_logged_in')) {
        return redirect()->to('/admin/login');
    }

    $payment = $this->request->getGet('payment');
    $orderModel = new \App\Models\OrderModel();

    $perPage = 10;
    $currentPage = $this->request->getGet('page') ?? 1;

    if ($payment) {
        $orders = $orderModel->where('payment', $payment)
                             ->orderBy('created_at', 'DESC')
                             ->paginate($perPage);
    } else {
        $orders = $orderModel->orderBy('created_at', 'DESC')
                             ->paginate($perPage);
    }

    // Cek koneksi database untuk menghindari MySQL server has gone away
    $db = \Config\Database::connect();
    if (! $db->connID || ! mysqli_ping($db->connID)) {
        $db->initialize();
    }

    // Perhitungan statistik (pakai clone model agar tidak bentrok kondisi)
    $totalIncome = $orderModel->selectSum('total_harga')->get()->getRow()->total_harga ?? 0;
    $successCount = (clone $orderModel)->where('status', 'Selesai')->countAllResults();
    $failedCount  = (clone $orderModel)->where('status !=', 'Selesai')->countAllResults();

    return view('admin/dashboard', [
        'orders' => $orders,
        'pager' => $orderModel->pager,
        'filter' => $payment,
        'totalIncome' => $totalIncome,
        'successCount' => $successCount,
        'failedCount' => $failedCount
    ]);
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    public function exportExcel()
{
    if (session()->get('admin_role') !== 'superadmin') {
        return redirect()->back()->with('error', 'Akses ditolak');
    }

    // lanjut export
        $orders = (new OrderModel())->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Order ID');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Menu');
        $sheet->setCellValue('D1', 'Jumlah');
        $sheet->setCellValue('E1', 'Total Harga');
        $sheet->setCellValue('F1', 'Payment');
        $sheet->setCellValue('G1', 'Status');
        $sheet->setCellValue('H1', 'Tanggal');

        $row = 2;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $row, $order['order_id']);
            $sheet->setCellValue('B' . $row, $order['email']);
            $sheet->setCellValue('C' . $row, $order['menu']);
            $sheet->setCellValue('D' . $row, $order['jumlah']);
            $sheet->setCellValue('E' . $row, $order['total_harga']);
            $sheet->setCellValue('F' . $row, $order['payment']);
            $sheet->setCellValue('G' . $row, $order['status']);
            $sheet->setCellValue('H' . $row, $order['created_at']);
            $row++;
        }

        $filename = 'pesanan_' . date('YmdHis') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function process()
{
    $file = $this->request->getFile('bukti_bayar');
    $namaFile = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/bukti_bayar', $namaFile); // Pastikan folder ini ada
    }

    $orderData = [
        'email' => $this->request->getPost('email'),
        'menu' => $this->request->getPost('menu'),
        'jumlah' => $this->request->getPost('jumlah'),
        'total_harga' => $this->request->getPost('total_harga'),
        'payment' => $this->request->getPost('payment'),
        'status' => 'pending',
        'bukti_bayar' => $namaFile,
        'created_at' => date('Y-m-d H:i:s'),
    ];

    $model = new \App\Models\OrderModel();
    $model->insert($orderData);

    return redirect()->to('/')->with('success', 'Pesanan berhasil dikirim.');
}

public function cetakInvoice($id)
{
    $orderModel = new \App\Models\OrderModel();
    $order = $orderModel->find($id);

    if (!$order) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Order tidak ditemukan.');
    }

    return view('admin/invoice', ['order' => $order]);
}
}
