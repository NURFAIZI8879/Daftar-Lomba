<?php

use Core\App;
use Core\Database;
use Core\Auth;

// CSRF validation
if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
    $_SESSION['error'] = 'Token tidak valid.';
    header('location: /user/assets');
    exit();
}


$db = App::resolve(Database::class);
$userId = $_SESSION['user']['id'];

$nama = trim($_POST['nama_perangkat'] ?? '');
$spesifikasi = trim($_POST['spesifikasi'] ?? '');
$lokasi = trim($_POST['lokasi'] ?? '');

if (!empty($nama)) {
    $db->query(
        'INSERT INTO assets (id_user, nama_perangkat, spesifikasi, lokasi) VALUES (:id_user, :nama, :spesifikasi, :lokasi)',
        ['id_user' => $userId, 'nama' => $nama, 'spesifikasi' => $spesifikasi, 'lokasi' => $lokasi]
    );
    $_SESSION['success'] = 'Aset berhasil ditambahkan.';
}

header('location: /user/assets');
exit();