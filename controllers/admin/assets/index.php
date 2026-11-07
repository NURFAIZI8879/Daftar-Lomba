<?php

use Core\App;
use Core\Database;
use Core\Auth;


$db = App::resolve(Database::class);

$assets = $db->query(
    'SELECT a.*, u.nama AS user_nama, u.departemen
     FROM assets a
     JOIN users u ON a.id_user = u.id
     ORDER BY a.created_at DESC'
)->getAll();

view('dashboard_admin/assets/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Aset Perangkat - TiketIT',
    'assets' => $assets,
]);