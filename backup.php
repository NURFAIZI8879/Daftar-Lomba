<?php
// backup.php - Database backup script
// Run via cron: 0 2 * * * php /path/to/backup.php

use Core\App;
use Core\Database;

require __DIR__ . '/bootstrap.php';

$db = App::resolve(Database::class);

$backupDir = __DIR__ . '/backups/';
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$filename = 'backup_' . date('Y-m-d_His') . '.sql';
$filepath = $backupDir . $filename;

// Get all tables
$tables = $db->query('SHOW TABLES')->getAll();
$tableNames = array_values($tables[0] ?? []);

// Actually get table names properly
$tablesResult = $db->query('SHOW TABLES')->getAll();
$tableNames = [];
foreach ($tablesResult as $row) {
    $tableNames[] = array_values($row)[0];
}

$sql = "-- TiketIT Database Backup
";
$sql .= "-- Date: " . date('Y-m-d H:i:s') . "

";

foreach ($tableName as $table) {
    // Get CREATE TABLE
    $create = $db->query("SHOW CREATE TABLE `$table`")->get();
    $sql .= "DROP TABLE IF EXISTS `$table`;
";
    $sql .= $create['Create Table'] . ";

";

    // Get data
    $rows = $db->query("SELECT * FROM `$table`")->getAll();
    if (!empty($rows)) {
        $columns = array_keys($rows[0]);
        $sql .= "INSERT INTO `$table` (`" . implode('`, `', $columns) . "`) VALUES
";
        $values = [];
        foreach ($rows as $row) {
            $vals = [];
            foreach ($row as $val) {
                if ($val === null) {
                    $vals[] = 'NULL';
                } else {
                    $vals[] = "'" . addslashes($val) . "'";
                }
            }
            $values[] = "(" . implode(', ', $vals) . ")";
        }
        $sql .= implode(",
", $values) . ";

";
    }
}

file_put_contents($filepath, $sql);
echo "Backup created: $filename
";

// Keep only last 7 backups
$backups = glob($backupDir . 'backup_*.sql');
if (count($backups) > 7) {
    sort($backups);
    $toDelete = array_slice($backups, 0, count($backups) - 7);
    foreach ($toDelete as $old) {
        unlink($old);
        echo "Deleted old backup: " . basename($old) . "
";
    }
}
?>