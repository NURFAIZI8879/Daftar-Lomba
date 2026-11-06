<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];

$assets = $db->query('SELECT * FROM assets WHERE id_user = :id_user ORDER BY created_at DESC', [
    'id_user' => $userId
])->getAll();

view('dashboard_user/assets/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Aset Saya - TiketIT',
    'assets' => $assets,
]);