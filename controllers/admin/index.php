<?php

use Core\App;
use Core\Database;
use Core\Auth;


$db = App::resolve(Database::class);

$stats = [
    'total_tickets' => $db->query('SELECT COUNT(*) as c FROM tickets')->get()['c'],
    'open' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'open'")->get()['c'],
    'in_progress' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'in_progress'")->get()['c'],
    'waiting' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'waiting'")->get()['c'],
    'resolved' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'resolved'")->get()['c'],
    'closed' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'closed'")->get()['c'],
    'total_users' => $db->query("SELECT COUNT(*) as c FROM users WHERE role = 'user'")->get()['c'],
    'total_teknisi' => $db->query("SELECT COUNT(*) as c FROM users WHERE role = 'teknisi'")->get()['c'],
];

// Category stats for chart
$catStats = $db->query(
    'SELECT c.nama, c.icon, COUNT(t.id) as jumlah
     FROM categories c
     LEFT JOIN tickets t ON c.id = t.id_category
     GROUP BY c.id, c.nama, c.icon
     ORDER BY c.nama'
)->getAll();

view('dashboard_admin/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Dashboard Admin - TiketIT',
    'stats' => $stats,
    'catStats' => $catStats,
]);
