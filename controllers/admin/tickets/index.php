<?php

use Core\App;
use Core\Database;
use Core\Auth;


$db = App::resolve(Database::class);

// Filters
$status = $_GET['status'] ?? '';
$priority = $_GET['prioritas'] ?? '';
$category = $_GET['kategori'] ?? '';
$search = trim($_GET['search'] ?? '');

// Build query
$sql = 'SELECT t.*, c.nama AS kategori_nama, c.icon AS kategori_icon,
               u.nama AS user_nama, u.departemen AS user_departemen,
               tek.nama AS teknisi_nama
        FROM tickets t
        JOIN categories c ON t.id_category = c.id
        JOIN users u ON t.id_user = u.id
        LEFT JOIN users tek ON t.id_teknisi = tek.id
        WHERE 1=1';
$params = [];

if ($status) {
    $sql .= ' AND t.status = :status';
    $params['status'] = $status;
}
if ($priority) {
    $sql .= ' AND t.prioritas = :prioritas';
    $params['prioritas'] = $priority;
}
if ($category) {
    $sql .= ' AND t.id_category = :category';
    $params['category'] = (int) $category;
}
if ($search) {
    $sql .= ' AND (t.judul LIKE :search OR u.nama LIKE :search2)';
    $params['search'] = '%' . $search . '%';
    $params['search2'] = '%' . $search . '%';
}

$sql .= ' ORDER BY t.created_at DESC';

$tickets = $db->query($sql, $params)->getAll();
$categories = $db->query('SELECT * FROM categories ORDER BY nama')->getAll();

// Stats
$stats = [
    'total' => $db->query('SELECT COUNT(*) as c FROM tickets')->get()['c'],
    'open' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'open'")->get()['c'],
    'in_progress' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'in_progress'")->get()['c'],
    'waiting' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'waiting'")->get()['c'],
    'resolved' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'resolved'")->get()['c'],
    'closed' => $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'closed'")->get()['c'],
];

view('dashboard_admin/tickets/index.view.php', [
    'css' => 'dashboard.css',
    'title' => 'Kelola Tiket - TiketIT',
    'tickets' => $tickets,
    'categories' => $categories,
    'stats' => $stats,
    'filters' => ['status' => $status, 'prioritas' => $priority, 'kategori' => $category, 'search' => $search],
]);
