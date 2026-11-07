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
$komentar = trim($_POST['komentar'] ?? '');

$ticket = $db->query('SELECT * FROM tickets WHERE id = :id', ['id' => $ticketId])->get();
if (!$ticket) {
    abort(404);
}

if (!empty($komentar)) {
    $db->query(
        'INSERT INTO ticket_comments (id_ticket, id_user, komentar) VALUES (:id_ticket, :id_user, :komentar)',
        [
            'id_ticket' => $ticketId,
            'id_user' => $_SESSION['user']['id'],
            'komentar' => $komentar,
        ]
    );
}

header('location: /admin/tickets/detail?id=' . $ticketId);
exit();
