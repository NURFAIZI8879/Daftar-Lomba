<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'admin' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$list_lomba = $db->query('SELECT * FROM lomba')->getAll();

if ($list_lomba) {
    return view('dashboard_admin/kegiatan.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard',
        'list_lomba' => $list_lomba
    ]);
} else {
    return view('dashboard_admin/kegiatan.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard'
    ]);
}