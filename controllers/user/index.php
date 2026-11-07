<?php

use Core\App;
use Core\Database;
use Core\Auth;


$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];

$stats = [
    'total' => $db->query('SELECT COUNT(*) as c FROM tickets WHERE id_user = ?', [$userId])->get()['c'],
    'open' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE id_user = ? AND status = 'open'", [$userId])->get()['c'],
    'in_progress' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE id_user = ? AND status = 'in_progress'", [$userId])->get()['c'],
    'resolved' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE id_user = ? AND status = 'resolved'", [$userId])->get()['c'],
];

view('dashboard_user/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Dashboard - TiketIT',
    'stats' => $stats,
]);