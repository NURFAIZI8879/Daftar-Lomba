<?php

use Core\App;
use Core\Database;
use Core\Auth;

Auth::requireRole(['admin', 'teknisi']);

$db = App::resolve(Database::class);

// Get all tickets (with same filters as index)
$status = $_GET['status'] ?? '';
$priority = $_GET['prioritas'] ?? '';
$category = $_GET['kategori'] ?? '';
$search = trim($_GET['search'] ?? '');

$sql = 'SELECT t.*, c.nama AS kategori_nama,
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

// Generate CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="tiketit_export_' . date('Y-m-d_His') . '.csv"');

$output = fopen('php://output', 'w');

// BOM for Excel UTF-8
fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

// Header row
fputcsv($output, ['ID', 'Judul', 'Pengguna', 'Departemen', 'Kategori', 'Prioritas', 'Status', 'Teknisi', 'SLA (jam)', 'Dibuat', 'Selesai']);

// Data rows
foreach ($tickets as $t) {
    fputcsv($output, [
        $t['id'],
        $t['judul'],
        $t['user_nama'],
        $t['user_departemen'] ?? '',
        $t['kategori_nama'],
        $t['prioritas'],
        $t['status'],
        $t['teknisi_nama'] ?? '-',
        $t['sla_jam'],
        $t['created_at'],
        $t['resolved_at'] ?? '-',
    ]);
}

fclose($output);
exit();