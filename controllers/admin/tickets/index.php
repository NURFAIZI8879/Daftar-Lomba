<?php

use Core\App;
use Core\Database;
use Core\Auth;

Auth::requireRole(['admin', 'teknisi']);

// CSRF validation (for POST actions only)
// GET requests don't need CSRF

$db = App::resolve(Database::class);

// Filters
$status = $_GET['status'] ?? '';
$priority = $_GET['prioritas'] ?? '';
$category = $_GET['kategori'] ?? '';
$search = trim($_GET['search'] ?? '');

// Pagination
$perPage = 10;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;

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

// Count total
$countSql = str_replace('SELECT t.*, c.nama AS kategori_nama, c.icon AS kategori_icon,
               u.nama AS user_nama, u.departemen AS user_departemen,
               tek.nama AS teknisi_nama', 'SELECT COUNT(*) as total', $sql);
// Simpler: just count
$countSql = 'SELECT COUNT(*) as total FROM tickets t JOIN users u ON t.id_user = u.id WHERE 1=1';
$countParams = [];
if ($status) { $countSql .= ' AND t.status = :status'; $countParams['status'] = $status; }
if ($priority) { $countSql .= ' AND t.prioritas = :prioritas'; $countParams['prioritas'] = $priority; }
if ($category) { $countSql .= ' AND t.id_category = :category'; $countParams['category'] = (int) $category; }
if ($search) { $countSql .= ' AND (t.judul LIKE :search OR u.nama LIKE :search2)'; $countParams['search'] = '%' . $search . '%'; $countParams['search2'] = '%' . $search . '%'; }

$totalTickets = $db->query($countSql, $countParams)->get()['total'];
$totalPages = max(1, ceil($totalTickets / $perPage));

$sql .= ' ORDER BY t.created_at DESC LIMIT :limit OFFSET :offset';
$params['limit'] = $perPage;
$params['offset'] = $offset;

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
    'pagination' => ['page' => $page, 'totalPages' => $totalPages, 'total' => $totalTickets, 'perPage' => $perPage],
]);
