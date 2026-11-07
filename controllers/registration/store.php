<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Auth;

// CSRF validation
if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
    $_SESSION['error'] = 'Token tidak valid.';
    header('location: /register');
    exit();
}

$db = App::resolve(Database::class);

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$departemen = trim($_POST['departemen'] ?? '');
$noTelp = trim($_POST['no_telp'] ?? '');

// Validasi input
$errors = [];

if (!Validator::string($name, 2)) {
    $errors[] = 'Nama minimal 2 karakter.';
}

if (!Validator::email($email)) {
    $errors[] = 'Format email tidak valid.';
}

if (!Validator::string($password, 6)) {
    $errors[] = 'Password minimal 6 karakter.';
}

if ($password !== $confirmPassword) {
    $errors[] = 'Konfirmasi password tidak cocok.';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = ['name' => $name, 'email' => $email, 'departemen' => $departemen, 'no_telp' => $noTelp];
    header('location: /register');
    exit();
}

// Cek apakah email sudah terdaftar
$existing = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->get();

if ($existing) {
    $_SESSION['error'] = 'Email sudah terdaftar.';
    $_SESSION['old'] = ['name' => $name, 'email' => $email, 'departemen' => $departemen, 'no_telp' => $noTelp];
    header('location: /register');
    exit();
}

// Hash password dan insert
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$db->query('INSERT INTO users (email, password, nama, role, departemen, no_telp) VALUES (:email, :password, :nama, :role, :departemen, :no_telp)', [
    'email' => $email,
    'password' => $hashedPassword,
    'nama' => $name,
    'role' => 'user',
    'departemen' => $departemen,
    'no_telp' => $noTelp,
]);

$id = $db->getLastId();

// Auto login setelah register
session_regenerate_id(true);
$_SESSION['user'] = [
    'id' => $id,
    'email' => $email,
    'nama' => $name,
    'role' => 'user',
    'departemen' => $departemen,
];

header('location: /user');
exit();