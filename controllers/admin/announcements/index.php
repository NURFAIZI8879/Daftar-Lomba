<?php

use Core\App;
use Core\Database;
use Core\Auth;


$db = App::resolve(Database::class);

$announcements = $db->query(
    'SELECT a.*, u.nama AS author_nama
     FROM announcements a
     JOIN users u ON a.id_author = u.id
     ORDER BY a.created_at DESC'
)->getAll();

view('dashboard_admin/announcements/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Pengumuman - TiketIT',
    'announcements' => $announcements,
]);