<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'admin' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$nama_lomba = $_POST['nama'];
$tanggal_mulai = $_POST['tanggal_mulai'];
$tanggal_berakhir = $_POST['tanggal_berakhir'];
$deskripsi = $_POST['deskripsi'];

if (empty($nama_lomba) || empty($tanggal_mulai) || empty($tanggal_berakhir) || empty($deskripsi)) {
    // TODO kasih pesan harus diisi
    return header('location: /admin/lomba');
}

try {
    $db->query('INSERT INTO lomba(nama, tanggal_mulai, tanggal_berakhir, deskripsi) VALUES(?, ?, ?, ?)', [
        $nama_lomba,
        $tanggal_mulai,
        $tanggal_berakhir,
        $deskripsi
    ]);

    header('location: /admin/kegiatan');
    exit();
} catch (\Throwable $th) {
    abort(404);
}
// TODO PESANNN