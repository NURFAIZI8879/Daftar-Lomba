<?php

use Core\App;
use Core\Database;
use Core\Auth;

Auth::requireLogin();

$db = App::resolve(Database::class);

$userId = $_SESSION['user']['id'];

// Stats
$stats = [
    'total' => $db->query('SELECT COUNT(*) as c FROM tickets WHERE id_user = ?', [$userId])->get()['c'],
    'open' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE id_user = ? AND status = 'open'", [$userId])->get()['c'],
    'in_progress' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE id_user = ? AND status = 'in_progress'", [$userId])->get()['c'],
    'resolved' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE id_user = ? AND status = 'resolved'", [$userId])->get()['c'],
];

// Recent tickets (5 latest)
$recentTickets = $db->query(
    'SELECT t.*, c.nama AS kategori_nama, c.icon AS kategori_icon
     FROM tickets t
     JOIN categories c ON t.id_category = c.id
     WHERE t.id_user = :id_user
     ORDER BY t.updated_at DESC
     LIMIT 5',
    ['id_user' => $userId]
)->getAll();

// Active announcements (not expired)
$announcements = $db->query(
    'SELECT * FROM announcements
     WHERE expired_at IS NULL OR expired_at > NOW()
     ORDER BY created_at DESC
     LIMIT 3'
)->getAll();

// Asset summary
$assetCount = $db->query('SELECT COUNT(*) as c FROM assets WHERE id_user = ?', [$userId])->get()['c'];
$topAssets = $db->query(
    'SELECT * FROM assets WHERE id_user = :id_user ORDER BY created_at DESC LIMIT 3',
    ['id_user' => $userId]
)->getAll();

// Knowledge base (latest 4)
$kbArticles = $db->query(
    'SELECT kb.*, c.nama AS kategori_nama, c.icon AS kategori_icon
     FROM knowledge_base kb
     LEFT JOIN categories c ON kb.id_category = c.id
     ORDER BY kb.created_at DESC
     LIMIT 4'
)->getAll();

view('dashboard_user/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Dashboard - TiketIT',
    'stats' => $stats,
    'recentTickets' => $recentTickets,
    'announcements' => $announcements,
    'assetCount' => $assetCount,
    'topAssets' => $topAssets,
    'kbArticles' => $kbArticles,
]);
