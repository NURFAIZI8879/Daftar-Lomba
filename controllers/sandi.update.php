<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$id_akun = $_SESSION['user']['id'];
$password_lama = $_POST['password_lama'];
$password_baru = $_POST['password_baru'];

$akun = $db->query('SELECT * FROM akun WHERE id = ?', [
    $id_akun
])->get();

// cek apakah akun terdaftar
if ($akun) {

    authorize($id_akun === $akun['id'], 403);

    // akun terdaftar
    $hash_password_lama = $akun['password'];

    // cek apakah password lama yang dimasukkan benar
    if (password_verify($password_lama, $hash_password_lama)) {
        // password lama yang dimasukkan benar
        $hash_password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

        $db->query('UPDATE akun SET password = ? WHERE id = ?', [
            $hash_password_baru,
            $id_akun
        ]);

        unset($_SESSION['user']);
        header('location: /login');
        exit();
        // TODO kasih pesan berhasil ubah password
    } else {
        // password lama yang dimasukkan salah
        header('location: /' . $_SESSION['user']['hak_akses'] . '/sandi?error=salahpw');
        exit();
        // TODO kasih pesan gagal ubah password
    }
} else {
    abort(404);
}