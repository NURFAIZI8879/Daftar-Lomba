<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$categories = $db->query('SELECT * FROM categories ORDER BY nama')->getAll();

view('dashboard_admin/categories/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Kategori - TiketIT',
    'categories' => $categories,
]);