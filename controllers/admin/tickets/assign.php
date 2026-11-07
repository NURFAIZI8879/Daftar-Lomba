<?php

use Core\App;
use Core\Database;
use Core\Auth;

// CSRF validation
if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
    $_SESSION['error'] = 'Token tidak valid.';
    header('location: /admin/tickets');
    exit();
}


$db = App::resolve(Database::class);

$ticketId = (int) ($_POST['id_ticket'] ?? 0);
$teknisiId = (int) ($_POST['id_teknisi'] ?? 0);

$ticket = $db->query('SELECT * FROM tickets WHERE id = :id', ['id' => $ticketId])->get();
if (!$ticket) {
    abort(404);
}

// Verify teknisi exists
$teknisi = $db->query("SELECT * FROM users WHERE id = :id AND role = 'teknisi'", ['id' => $teknisiId])->get();
if (!$teknisi) {
    $_SESSION['error'] = 'Teknisi tidak ditemukan.';
    header('location: /admin/tickets/detail?id=' . $ticketId);
    exit();
}

// Update ticket
$db->query(
    "UPDATE tickets SET id_teknisi = :id_teknisi, status = 'in_progress', updated_at = NOW() WHERE id = :id",
    ['id_teknisi' => $teknisiId, 'id' => $ticketId]
);

// Add comment
$db->query(
    'INSERT INTO ticket_comments (id_ticket, id_user, komentar) VALUES (:id_ticket, :id_user, :komentar)',
    [
        'id_ticket' => $ticketId,
        'id_user' => $_SESSION['user']['id'],
        'komentar' => 'Tiket ditugaskan ke ' . $teknisi['nama'] . '.',
    ]
);

$_SESSION['success'] = 'Tiket berhasil ditugaskan ke ' . $teknisi['nama'] . '.';
header('location: /admin/tickets/detail?id=' . $ticketId);
exit();
