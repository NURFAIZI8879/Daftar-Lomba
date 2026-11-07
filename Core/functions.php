<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}
function csrf_field()
{
    $token = \Core\Auth::generateCsrfToken();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

function csrf_token()
{
    return \Core\Auth::generateCsrfToken();
}

function isOverdue($ticket) {
    if (in_array($ticket['status'], ['resolved', 'closed'])) {
        return false;
    }
    $created = strtotime($ticket['created_at']);
    $slaSeconds = $ticket['sla_jam'] * 3600;
    $deadline = $created + $slaSeconds;
    return time() > $deadline;
}

function slaRemaining($ticket) {
    if (in_array($ticket['status'], ['resolved', 'closed'])) {
        return null;
    }
    $created = strtotime($ticket['created_at']);
    $slaSeconds = $ticket['sla_jam'] * 3600;
    $deadline = $created + $slaSeconds;
    $remaining = $deadline - time();
    if ($remaining < 0) {
        return 'Overdue';
    }
    $hours = floor($remaining / 3600);
    if ($hours < 24) {
        return $hours . ' jam lagi';
    }
    $days = floor($hours / 24);
    return $days . ' hari lagi';
}
function sendTicketNotification($to, $subject, $body) {
    // Best-effort email notification
    // Uses PHP mail() - may not work on all hosting
    $headers = "From: noreply@tiketit.com\r
";
    $headers .= "Reply-To: noreply@tiketit.com\r
";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r
";
    $headers .= "X-Mailer: TiketIT\r
";
    
    try {
        @mail($to, $subject, $body, $headers);
        return true;
    } catch (Exception $e) {
        error_log("Email notification failed: " . $e->getMessage());
        return false;
    }
}

function notifyTicketStatusChange($db, $ticketId, $newStatus) {
    $ticket = $db->query(
        'SELECT t.*, u.email AS user_email, u.nama AS user_nama, tek.nama AS teknisi_nama
         FROM tickets t
         JOIN users u ON t.id_user = u.id
         LEFT JOIN users tek ON t.id_teknisi = tek.id
         WHERE t.id = :id',
        ['id' => $ticketId]
    )->get();
    
    if (!$ticket) return;
    
    $statusLabels = [
        'open' => 'Dibuka',
        'in_progress' => 'Sedang Ditangani',
        'waiting' => 'Menunggu',
        'resolved' => 'Selesai',
        'closed' => 'Ditutup',
    ];
    
    $subject = "TiketIT - Status Tiket #" . $ticketId . " Diperbarui";
    $body = "Halo " . $ticket['user_nama'] . ",

";
    $body .= "Status tiket Anda telah diperbarui:

";
    $body .= "Judul: " . $ticket['judul'] . "
";
    $body .= "Status Baru: " . ($statusLabels[$newStatus] ?? $newStatus) . "
";
    if ($ticket['teknisi_nama']) {
        $body .= "Teknisi: " . $ticket['teknisi_nama'] . "
";
    }
    $body .= "
Silakan login ke TiketIT untuk melihat detail.

";
    $body .= "Terima kasih,
Tim IT";
    
    sendTicketNotification($ticket['user_email'], $subject, $body);
}