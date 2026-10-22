<?php

authorize(isset($_SESSION['user']['hak_akses']) ? $_SESSION['user']['hak_akses'] === 'peserta' : false, 403);

view('dashboard_peserta/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Dashboard'
]);