<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!Validator::email($email)) {
    // TODO Email tidak sesuai
}

if (!Validator::string($password, 7)) {
    // TODO Password tidak sesuai
}

$user = $db->query('SELECT * FROM akun WHERE email = ?', [
    $email
])->get();


if ($user) {
    // TODO Kasih tau Akun sudah ada
    view('login/login.view.php');
} else {
    // Akun belum ada
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $db->query('INSERT INTO akun(email, password, nama, tipe) VALUES (:email, :password, :nama, :tipe)', [
        'email' => $email,
        'password' => $hashed_password,
        'nama' => $name,
        'tipe' => 'peserta'
    ]);

    $id = $db->getLastId();

    mkdir(base_path("public/img/users/$id"));

    $_SESSION['user'] = [
        'id' => $id,
        'nama' => $name,
        'email' => $email,
        'hak_akses' => 'peserta'
    ];

    header('location: /peserta');
    exit();
    // TODO kasih tau akun berhasil dibuat
}