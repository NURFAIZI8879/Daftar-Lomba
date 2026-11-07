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