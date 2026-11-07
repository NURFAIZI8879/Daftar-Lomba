<?php

use Core\App;
use Core\Database;
use Core\Auth;


$db = App::resolve(Database::class);

$articles = $db->query(
    'SELECT kb.*, c.nama AS kategori_nama, c.icon AS kategori_icon
     FROM knowledge_base kb
     LEFT JOIN categories c ON kb.id_category = c.id
     ORDER BY kb.created_at DESC'
)->getAll();

$categories = $db->query('SELECT * FROM categories ORDER BY nama')->getAll();

view('dashboard_admin/knowledge/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Knowledge Base - TiketIT',
    'articles' => $articles,
    'categories' => $categories,
]);