<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'peserta' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$data_tim = $db->query('SELECT * FROM tim WHERE id_akun = ?', [
    $_SESSION['user']['id']
])->get();

if ($data_tim) {
    // ada data tim
    return view('dashboard_peserta/tim.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard',
        'data_tim' => $data_tim,
        'nama_lomba' => $db->query('SELECT nama FROM lomba WHERE id  = ?', [$data_tim['id_lomba']])->get()['nama']
    ]);
} else {
    // tidak ada data tim
    return view('dashboard_peserta/tim.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard',
        'list_lomba' => $db->query('SELECT * FROM lomba')->getAll()
    ]);
}