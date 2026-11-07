<?php

use Core\App;
use Core\Database;
use Core\Auth;

// CSRF validation
if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
    $_SESSION['error'] = 'Token tidak valid.';
    header('location: /' . $_SESSION['user']['role'] . '/sandi');
    exit();
}


$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];
$oldPassword = $_POST['old_password'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

$user = $db->query('SELECT * FROM users WHERE id = :id', ['id' => $userId])->get();

if (!$user || !password_verify($oldPassword, $user['password'])) {
    $_SESSION['error'] = 'Password lama salah.';
    header('location: /' . $_SESSION['user']['role'] . '/sandi');
    exit();
}

if (strlen($newPassword) < 6) {
    $_SESSION['error'] = 'Password baru minimal 6 karakter.';
    header('location: /' . $_SESSION['user']['role'] . '/sandi');
    exit();
}

if ($newPassword !== $confirmPassword) {
    $_SESSION['error'] = 'Konfirmasi password tidak cocok.';
    header('location: /' . $_SESSION['user']['role'] . '/sandi');
    exit();
}

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$db->query('UPDATE users SET password = :password WHERE id = :id', [
    'password' => $hashedPassword,
    'id' => $userId,
]);

$_SESSION['success'] = 'Password berhasil diubah.';
header('location: /' . $_SESSION['user']['role'] . '/sandi');
exit();