<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];

// Get user's tickets with category info
$tickets = $db->query(
    'SELECT t.*, c.nama AS kategori_nama, c.icon AS kategori_icon,
            u.nama AS teknisi_nama
     FROM tickets t
     JOIN categories c ON t.id_category = c.id
     LEFT JOIN users u ON t.id_teknisi = u.id
     WHERE t.id_user = :id_user
     ORDER BY t.created_at DESC',
    ['id_user' => $userId]
)->getAll();

view('dashboard_user/tickets/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Tiket Saya - TiketIT',
    'tickets' => $tickets,
]);
