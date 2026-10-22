<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'peserta' : false, 403);

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$id_tim = $db->query('SELECT id FROM tim WHERE id_akun = ?', [$_SESSION['user']['id']])->get()['id'];

$judul = $_POST['judul'];
$storyboard = $_POST['storyboard'];
$script = $_POST['script'];
$hasil_render = $_POST['hasil_render'];
$deskripsi = $_POST['deskripsi'];

$db->query('INSERT INTO peserta_animasi(id_tim, judul, storyboard, script, hasil_render, deskripsi) VALUES (?, ?, ?, ?, ?, ?)', [
    $id_tim,
    $judul,
    $storyboard,
    $script,
    $hasil_render,
    $deskripsi
]);

header('location: /peserta/kegiatan');
exit();