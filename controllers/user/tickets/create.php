<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$categories = $db->query('SELECT * FROM categories ORDER BY nama')->getAll();
$assets = $db->query('SELECT * FROM assets WHERE id_user = :id_user', [
    'id_user' => $_SESSION['user']['id']
])->getAll();

view('dashboard_user/tickets/create.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Buat Tiket Baru - TiketIT',
    'categories' => $categories,
    'assets' => $assets,
]);
