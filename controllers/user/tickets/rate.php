<?php

use Core\App;
use Core\Database;
use Core\Auth;

Auth::requireLogin();

// CSRF validation
if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
    $_SESSION['error'] = 'Token tidak valid.';
    header('location: /user/tickets');
    exit();
}

$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];
$ticketId = (int) ($_POST['id_ticket'] ?? 0);
$rating = (int) ($_POST['rating'] ?? 0);
$komentar = trim($_POST['komentar'] ?? '');

// Verify ticket belongs to user and is resolved/closed
$ticket = $db->query(
    'SELECT * FROM tickets WHERE id = :id AND id_user = :id_user',
    ['id' => $ticketId, 'id_user' => $userId]
)->get();

if (!$ticket) {
    abort(403);
}

if (!in_array($ticket['status'], ['resolved', 'closed'])) {
    $_SESSION['error'] = 'Tiket belum selesai.';
    header('location: /user/tickets/detail?id=' . $ticketId);
    exit();
}

if ($rating < 1 || $rating > 5) {
    $_SESSION['error'] = 'Rating harus antara 1-5.';
    header('location: /user/tickets/detail?id=' . $ticketId);
    exit();
}

// Check if already rated
$existing = $db->query('SELECT * FROM ticket_ratings WHERE id_ticket = :id_ticket', ['id_ticket' => $ticketId])->get();
if ($existing) {
    // Update rating
    $db->query(
        'UPDATE ticket_ratings SET rating = :rating, komentar = :komentar WHERE id_ticket = :id_ticket',
        ['rating' => $rating, 'komentar' => $komentar, 'id_ticket' => $ticketId]
    );
    $_SESSION['success'] = 'Rating berhasil diperbarui.';
} else {
    // Insert new rating
    $db->query(
        'INSERT INTO ticket_ratings (id_ticket, id_user, rating, komentar) VALUES (:id_ticket, :id_user, :rating, :komentar)',
        ['id_ticket' => $ticketId, 'id_user' => $userId, 'rating' => $rating, 'komentar' => $komentar]
    );
    $_SESSION['success'] = 'Terima kasih atas rating Anda!';
}

header('location: /user/tickets/detail?id=' . $ticketId);
exit();