<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$account = $db->query('SELECT * FROM akun WHERE email = :email', [
    'email' => $email
])->get();

if ($account) {
    // Akun ditemukan
    if (password_verify($password, $account['password'])) {
        $_SESSION['user'] = [
            'id' => $account['id'],
            'email' => $account['email'],
            'nama' => $account['nama'],
            'hak_akses' => $account['tipe'],
        ];

        if ($account['tipe'] === 'admin') {
            header('location: /admin');
        } else {
            header('location: /peserta');
        }

        exit();
    } else {
        $_SESSION['pesan'] = 'Password salah';
        header('location: /login?error=salahpw');
        exit();
    }
} else {
    // Akun tidak ditemukan
    view('login.view.php', [
        'css' => 'login.css',
        'title' => 'Login'
    ]);
}