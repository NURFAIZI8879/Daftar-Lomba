<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'peserta' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$id_tim = $db->query('SELECT id FROM tim WHERE id_akun = ?', [$_SESSION['user']['id']])->get()['id'];

$judul = $_POST['judul'];
$gdd = $_POST['gdd'];
$file_eksekusi = $_POST['file_eksekusi'];
$trailer = $_POST['trailer'];
$kode_sumber = $_POST['kode_sumber'];
$deskripsi = $_POST['deskripsi'];

$db->query('INSERT INTO peserta_game(id_tim, judul, gdd, file_eksekusi, trailer, kode_sumber, deskripsi) VALUES (?, ?, ?, ?, ?, ?, ?)', [
    $id_tim,
    $gdd,
    $file_eksekusi,
    $trailer,
    $kode_sumber,
    $deskripsi
]);

header('location: /peserta/kegiatan');
exit();