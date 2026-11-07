<?php

use Core\App;
use Core\Database;
use Core\Auth;

// CSRF validation
if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
    $_SESSION['error'] = 'Token tidak valid.';
    header('location: /admin/announcements');
    exit();
}


$db = App::resolve(Database::class);

$judul = trim($_POST['judul'] ?? '');
$isi = trim($_POST['isi'] ?? '');
$tipe = $_POST['tipe'] ?? 'info';
$expiredAt = !empty($_POST['expired_at']) ? $_POST['expired_at'] : null;

if (!empty($judul) && !empty($isi)) {
    $db->query(
        'INSERT INTO announcements (judul, isi, tipe, id_author, expired_at) VALUES (:judul, :isi, :tipe, :id_author, :expired_at)',
        [
            'judul' => $judul,
            'isi' => $isi,
            'tipe' => $tipe,
            'id_author' => $_SESSION['user']['id'],
            'expired_at' => $expiredAt,
        ]
    );
    $_SESSION['success'] = 'Pengumuman berhasil ditambahkan.';
}

header('location: /admin/announcements');
exit();