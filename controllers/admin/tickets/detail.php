<?php

use Core\App;
use Core\Database;
use Core\Auth;


$db = App::resolve(Database::class);

$ticketId = (int) ($_GET['id'] ?? 0);

$ticket = $db->query(
    'SELECT t.*, c.nama AS kategori_nama, c.icon AS kategori_icon,
            u.nama AS user_nama, u.email AS user_email, u.departemen AS user_departemen, u.no_telp AS user_no_telp,
            tek.nama AS teknisi_nama
     FROM tickets t
     JOIN categories c ON t.id_category = c.id
     JOIN users u ON t.id_user = u.id
     LEFT JOIN users tek ON t.id_teknisi = tek.id
     WHERE t.id = :id',
    ['id' => $ticketId]
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

$technicians = $db->query("SELECT id, nama FROM users WHERE role = 'teknisi' ORDER BY nama")->getAll();

$asset = null;
if ($ticket['id_asset']) {
    $asset = $db->query('SELECT * FROM assets WHERE id = :id', ['id' => $ticket['id_asset']])->get();
}

view('dashboard_admin/tickets/detail.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Detail Tiket #' . $ticketId . ' - TiketIT',
    'ticket' => $ticket,
    'comments' => $comments,
    'technicians' => $technicians,
    'asset' => $asset,
]);
