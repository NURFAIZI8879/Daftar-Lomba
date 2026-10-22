<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'admin' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$list_tim = $db->query('SELECT * FROM tim')->getAll();

if ($list_tim) {
    // ada data tim

    $email_peserta = [];
    $lomba_diikuti = [];

    foreach($list_tim as $tim) {
        $email_peserta[] = $db->query('SELECT email FROM akun WHERE id = ?', [$tim['id_akun']])->get()['email'];
        $lomba_diikuti[] = $db->query('SELECT nama FROM lomba WHERE id = ?', [$tim['id_lomba']])->get()['nama'];
    }

    return view('dashboard_admin/tim.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard',
        'list_tim' => $list_tim,
        'email_peserta' => $email_peserta,
        'lomba_diikuti' => $lomba_diikuti
    ]);
} else {
    // belum ada data tim
    return view('dashboard_admin/tim.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard'
    ]);
}