<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'admin' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$daftar_id = $db->query('SELECT id FROM LOMBA')->getAll();

$id_lomba = $_GET['id'];

foreach ($daftar_id as $id) {
    if (in_array($id_lomba, $id)) {
        break;
    }
    abort(404);
}

$nama_lomba = $db->query('SELECT nama FROM lomba WHERE id = ?', [$id_lomba])->get()['nama'];

if (!$nama_lomba) {
    abort(404);
}

$lomba = $db->query('SELECT * FROM lomba WHERE id = ?', [$id_lomba])->get();

$peserta_lomba = $db->query("SELECT * FROM peserta_$nama_lomba")->getAll();

if ($peserta_lomba) {
    $list_tim = [];

    foreach ($peserta_lomba as $peserta) {
        $list_tim[] = $db->query('SELECT nama FROM tim WHERE id = ?', [$peserta['id_tim']])->get()['nama'];
    }

    return view('dashboard_admin/lomba/show.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard',
        'lomba' => $lomba,
        'peserta_lomba' => $peserta_lomba,
        'list_tim' => $list_tim
    ]);
} else {
    return view('dashboard_admin/lomba/show.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard',
        'lomba' => $lomba
    ]);
}
