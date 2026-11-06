<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$categoryId = !empty($_POST['id_category']) ? (int) $_POST['id_category'] : null;
$judul = trim($_POST['judul'] ?? '');
$masalah = trim($_POST['masalah'] ?? '');
$solusi = trim($_POST['solusi'] ?? '');
$tags = trim($_POST['tags'] ?? '');

if (!empty($judul) && !empty($masalah) && !empty($solusi)) {
    $db->query(
        'INSERT INTO knowledge_base (id_category, judul, masalah, solusi, tags) VALUES (:id_category, :judul, :masalah, :solusi, :tags)',
        ['id_category' => $categoryId, 'judul' => $judul, 'masalah' => $masalah, 'solusi' => $solusi, 'tags' => $tags]
    );
    $_SESSION['success'] = 'Artikel berhasil ditambahkan.';
}

header('location: /admin/knowledge');
exit();