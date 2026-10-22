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
        return view('dashboard_peserta/status.view.php', [
            'css' => 'dashboard.css',
            'title' => 'Dashboard',
            'heading' => 'Bagus!',
            'status' => 'uploaded',
            'deskripsi' => 'Anda telah mengirim karya tim Anda! Karya Anda sedang dinilai oleh assesor, tunggu dan terus cek status karya Anda!'
        ]);
    } else {
        // Belum mengumpul project
        return view('dashboard_peserta/status.view.php', [
            'css' => 'dashboard.css',
            'title' => 'Dashboard',
            'heading' => 'Upload Karya Mu Sekarang Juga!',
            'status' => 'not_uploaded',
            'deskripsi' => 'Karya Tim Anda akan dinilai dengan assessor yang mempunyai pengalaman dibidangnya. Penilaian ini tidak mendiskriminasi ras dan agama atau mementingkan golongan tertentu!'
        ]);
    }

} else {
    // tidak ada data tim
    return view('dashboard_peserta/status.view.php', [
        'css' => 'dashboard.css',
        'title' => 'Dashboard',
        'heading' => 'Belum Mengikuti Lomba',
        'status' => 'no_data',
        'deskripsi' => 'Anda belum mengikuti lomba apapun. Silahkan isi data tim terlebih dahulu.'
    ]);
}