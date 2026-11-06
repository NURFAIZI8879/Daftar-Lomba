<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi input
if (empty($email) || empty($password)) {
    $_SESSION['error'] = 'Email dan password wajib diisi.';
    header('location: /login?error=empty');
    exit();
}

$account = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->get();

if ($account) {
    if (password_verify($password, $account['password'])) {
        // Regenerate session ID untuk keamanan (session fixation protection)
        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $account['id'],
            'email' => $account['email'],
            'nama' => $account['nama'],
            'role' => $account['role'],
            'departemen' => $account['departemen'],
        ];

        // Redirect berdasarkan role
        if ($account['role'] === 'admin') {
            header('location: /admin');
        } elseif ($account['role'] === 'teknisi') {
            header('location: /admin/tickets');
        } else {
            header('location: /user');
        }
        exit();
    } else {
        $_SESSION['error'] = 'Password salah.';
        header('location: /login?error=salahpw');
        exit();
    }
} else {
    $_SESSION['error'] = 'Akun tidak ditemukan.';
    view('login.view.php', [
        'css' => 'login.css',
        'title' => 'Login - TiketIT'
    ]);
}