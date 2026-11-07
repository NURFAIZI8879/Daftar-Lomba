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
$status = $_POST['status'] ?? '';

$validStatuses = ['open', 'in_progress', 'waiting', 'resolved', 'closed'];
if (!in_array($status, $validStatuses)) {
    $_SESSION['error'] = 'Status tidak valid.';
    header('location: /admin/tickets/detail?id=' . $ticketId);
    exit();
}

$ticket = $db->query('SELECT * FROM tickets WHERE id = :id', ['id' => $ticketId])->get();
if (!$ticket) {
    abort(404);
}

// Update status
$params = ['status' => $status, 'id' => $ticketId];
$sql = 'UPDATE tickets SET status = :status, updated_at = NOW()';

if ($status === 'resolved' || $status === 'closed') {
    $sql .= ', resolved_at = NOW()';
}

$sql .= ' WHERE id = :id';
$db->query($sql, $params);

// Add comment
$statusLabels = [
    'open' => 'Dibuka',
    'in_progress' => 'Sedang Ditangani',
    'waiting' => 'Menunggu',
    'resolved' => 'Selesai',
    'closed' => 'Ditutup',
];

$db->query(
    'INSERT INTO ticket_comments (id_ticket, id_user, komentar) VALUES (:id_ticket, :id_user, :komentar)',
    [
        'id_ticket' => $ticketId,
        'id_user' => $_SESSION['user']['id'],
        'komentar' => 'Status diubah menjadi: ' . $statusLabels[$status] . '.',
    ]
);

// Send email notification (best-effort)
notifyTicketStatusChange($db, $ticketId, $status);

$_SESSION['success'] = 'Status tiket berhasil diubah.';
header('location: /admin/tickets/detail?id=' . $ticketId);
exit();
