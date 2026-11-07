<?php

use Core\App;
use Core\Database;
use Core\Auth;

// CSRF validation
if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
    $_SESSION['error'] = 'Token tidak valid.';
    header('location: /admin/categories');
    exit();
}

$db = App::resolve(Database::class);

$nama = trim($_POST['nama'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$icon = trim($_POST['icon'] ?? '');

if (empty($icon)) {
    $icon = '[HW]';
}

if (!empty($nama)) {
    $db->query(
        'INSERT INTO categories (nama, deskripsi, icon) VALUES (:nama, :deskripsi, :icon)',
        ['nama' => $nama, 'deskripsi' => $deskripsi, 'icon' => $icon]
    );
    $_SESSION['success'] = 'Kategori berhasil ditambahkan.';
}

header('location: /admin/categories');
exit();