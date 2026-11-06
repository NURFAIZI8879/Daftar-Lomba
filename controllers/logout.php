<?php

// Hapus session
unset($_SESSION['user']);
session_destroy();

// Hapus cookie session
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

header('location: /');
exit();