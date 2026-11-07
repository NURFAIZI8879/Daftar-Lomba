<?php

use Core\App;
use Core\Database;
use Core\Auth;


$db = App::resolve(Database::class);

$search = trim($_GET['search'] ?? '');
$categoryId = $_GET['kategori'] ?? '';

$sql = 'SELECT kb.*, c.nama AS kategori_nama, c.icon AS kategori_icon FROM knowledge_base kb LEFT JOIN categories c ON kb.id_category = c.id WHERE 1=1';
$params = [];

if ($search) {
    $sql .= ' AND (kb.judul LIKE :search OR kb.masalah LIKE :search2 OR kb.solusi LIKE :search3)';
    $params['search'] = '%' . $search . '%';
    $params['search2'] = '%' . $search . '%';
    $params['search3'] = '%' . $search . '%';
}
if ($categoryId) {
    $sql .= ' AND kb.id_category = :category';
    $params['category'] = (int) $categoryId;
}
$sql .= ' ORDER BY kb.created_at DESC';

$articles = $db->query($sql, $params)->getAll();
$categories = $db->query('SELECT * FROM categories ORDER BY nama')->getAll();

view('dashboard_user/knowledge/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Knowledge Base - TiketIT',
    'articles' => $articles,
    'categories' => $categories,
    'search' => $search,
    'categoryId' => $categoryId,
]);