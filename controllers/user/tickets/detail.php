<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];
$ticketId = (int) ($_GET['id'] ?? 0);

$ticket = $db->query(
    'SELECT t.*, c.nama AS kategori_nama, c.icon AS kategori_icon,
            u.nama AS user_nama, u.email AS user_email, u.departemen AS user_departemen,
            tek.nama AS teknisi_nama
     FROM tickets t
     JOIN categories c ON t.id_category = c.id
     JOIN users u ON t.id_user = u.id
     LEFT JOIN users tek ON t.id_teknisi = tek.id
     WHERE t.id = :id AND t.id_user = :id_user',
    ['id' => $ticketId, 'id_user' => $userId]
)->get();

if (!$ticket) {
    abort(404);
}

$comments = $db->query(
    'SELECT tc.*, u.nama, u.role
     FROM ticket_comments tc
     JOIN users u ON tc.id_user = u.id
     WHERE tc.id_ticket = :id_ticket
     ORDER BY tc.created_at ASC',
    ['id_ticket' => $ticketId]
)->getAll();

$asset = null;
if ($ticket['id_asset']) {
    $asset = $db->query('SELECT * FROM assets WHERE id = :id', ['id' => $ticket['id_asset']])->get();
}

view('dashboard_user/tickets/detail.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Detail Tiket - TiketIT',
    'ticket' => $ticket,
    'comments' => $comments,
    'asset' => $asset,
]);
