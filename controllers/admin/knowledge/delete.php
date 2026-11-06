<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$id = (int) ($_POST['id'] ?? 0);

if ($id > 0) {
    $db->query('DELETE FROM knowledge_base WHERE id = :id', ['id' => $id]);
    $_SESSION['success'] = 'Artikel berhasil dihapus.';
}

header('location: /admin/knowledge');
exit();