<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'peserta' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$id_akun = $_SESSION['user']['id'];
$nama_tim = $_POST['nama'];
$nik_ketua = $_POST['nik'];
$no_telp = $_POST['no_telp'];
$kalangan = $_POST['kalangan'];
$id_lomba = $_POST['id_lomba'];

$db->query('INSERT INTO tim(id_akun, nama, nik, no_telp, kalangan, id_lomba) VALUES (?, ?, ?, ?, ?, ?)', [
    $id_akun,
    $nama_tim,
    $nik_ketua,
    $no_telp,
    $kalangan,
    $id_lomba
]);

header('location: /peserta/tim');
exit();