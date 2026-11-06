<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];
$categoryId = (int) ($_POST['id_category'] ?? 0);
$assetId = !empty($_POST['id_asset']) ? (int) $_POST['id_asset'] : null;
$judul = trim($_POST['judul'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$prioritas = $_POST['prioritas'] ?? 'medium';

// Validasi
$errors = [];
if (empty($judul)) $errors[] = 'Judul tiket wajib diisi.';
if (empty($deskripsi)) $errors[] = 'Deskripsi wajib diisi.';
if (!in_array($prioritas, ['low', 'medium', 'high', 'critical'])) $prioritas = 'medium';

// SLA mapping
$slaMap = ['low' => 72, 'medium' => 48, 'high' => 24, 'critical' => 4];
$slaJam = $slaMap[$prioritas];

// Handle file upload
$lampiran = null;
if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['lampiran'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if (!in_array($file['type'], $allowedTypes)) {
        $errors[] = 'Tipe file tidak diizinkan. Gunakan JPG, PNG, GIF, atau PDF.';
    }
    if ($file['size'] > $maxSize) {
        $errors[] = 'Ukuran file maksimal 5MB.';
    }

    if (empty($errors)) {
        $uploadDir = base_path('public/uploads/tickets/');
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'ticket_' . time() . '_' . uniqid() . '.' . $ext;
        $destPath = $uploadDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $destPath)) {
            $lampiran = $filename;
        } else {
            $errors[] = 'Gagal mengupload file.';
        }
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = ['judul' => $judul, 'deskripsi' => $deskripsi, 'prioritas' => $prioritas, 'id_category' => $categoryId];
    header('location: /user/tickets/create');
    exit();
}

// Insert ticket
$db->query(
    'INSERT INTO tickets (id_user, id_category, id_asset, judul, deskripsi, prioritas, status, lampiran, sla_jam) 
     VALUES (:id_user, :id_category, :id_asset, :judul, :deskripsi, :prioritas, :status, :lampiran, :sla_jam)',
    [
        'id_user' => $userId,
        'id_category' => $categoryId,
        'id_asset' => $assetId,
        'judul' => $judul,
        'deskripsi' => $deskripsi,
        'prioritas' => $prioritas,
        'status' => 'open',
        'lampiran' => $lampiran,
        'sla_jam' => $slaJam,
    ]
);

$ticketId = $db->getLastId();

// Add initial comment
$db->query(
    'INSERT INTO ticket_comments (id_ticket, id_user, komentar) VALUES (:id_ticket, :id_user, :komentar)',
    [
        'id_ticket' => $ticketId,
        'id_user' => $userId,
        'komentar' => 'Tiket dibuat.',
    ]
);

header('location: /user/tickets/detail?id=' . $ticketId);
exit();
