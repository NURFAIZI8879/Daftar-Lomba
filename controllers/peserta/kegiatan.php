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

    // Cek apakah sudah mengumpul project pada salah satu lomba
    $participant = $db->isParticipant($data_tim['id']);

    if ($participant) {
        // Sudah mengumpul project
        return view('dashboard_peserta/kegiatan.view.php', [
            'css' => 'dashboard.css',
            'title' => 'Dashboard',
            'status' => 'submitted'
        ]);
    } else {
        // Belum mengumpul project
        // KASIH FORM
        return view('dashboard_peserta/kegiatan.view.php', [
            'css' => 'dashboard.css',
            'title' => 'Dashboard',
            'status' => 'not_submitted',
            'lomba' => $db->query('SELECT * FROM lomba WHERE id = ?', [$data_tim['id_lomba']])->get()
        ]);
    }

} else {
    // tidak ada data tim
    return view('dashboard_peserta/kegiatan.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard',
        'status' => 'no_data'
    ]);
}