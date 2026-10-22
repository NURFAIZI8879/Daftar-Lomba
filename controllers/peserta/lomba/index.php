<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'peserta' : false, 403);

$id_lomba = (int) $_POST['id_lomba'];

switch ($id_lomba) {
    case 1:
        require base_path('controllers/peserta/lomba/website.store.php');
        exit(); 
    
    default:
        abort(404);
}