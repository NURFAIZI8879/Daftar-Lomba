<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];
$ticketId = (int) ($_POST['id_ticket'] ?? 0);
$komentar = trim($_POST['komentar'] ?? '');

// Verify ticket belongs to user
$ticket = $db->query(
    'SELECT * FROM tickets WHERE id = :id AND id_user = :id_user',
    ['id' => $ticketId, 'id_user' => $userId]
)->get();

if (!$ticket) {
    abort(403);
}

if (!empty($komentar)) {
    $db->query(
        'INSERT INTO ticket_comments (id_ticket, id_user, komentar) VALUES (:id_ticket, :id_user, :komentar)',
        [
            'id_ticket' => $ticketId,
            'id_user' => $userId,
            'komentar' => $komentar,
        ]
    );
}

header('location: /user/tickets/detail?id=' . $ticketId);
exit();
