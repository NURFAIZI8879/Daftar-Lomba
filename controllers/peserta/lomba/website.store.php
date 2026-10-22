<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'peserta' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$id_tim = $db->query('SELECT id FROM tim WHERE id_akun = ?', [$_SESSION['user']['id']])->get()['id'];

$judul = $_POST['judul'];
$wireframe = $_POST['wireframe'];
$ui_ux = $_POST['ui_ux'];
$file_project = $_POST['file_project'];
$deskripsi = $_POST['deskripsi'];

$db->query('INSERT INTO peserta_website(id_tim, judul, wireframe, ui_ux, file_project, deskripsi) VALUES (?, ?, ?, ?, ?, ?)', [
    $id_tim,
    $judul,
    $wireframe,
    $ui_ux,
    $file_project,
    $deskripsi
]);

header('location: /peserta/kegiatan');
exit();