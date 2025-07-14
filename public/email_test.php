<?php

require '../vendor/autoload.php';

use Config\Email as EmailConfig;
use CodeIgniter\Email\Email;

$config = new EmailConfig();
$email = new Email($config);

$email->setFrom('seteguksenja@gmail.com', 'Seteguk Senja');
$email->setTo('valina.tester@gmail.com'); // ganti ke email kamu
$email->setSubject('Tes Email dari Seteguk Senja');
$email->setMessage('<h3>Halo! Ini adalah email test dari Seteguk Senja 🌇</h3>');

if ($email->send()) {
    echo '✅ Email test berhasil dikirim!';
} else {
    echo '❌ Gagal mengirim email!';
    print_r($email->printDebugger(['headers', 'subject', 'body']));
}
