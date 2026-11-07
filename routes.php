<?php

// ===== Public Routes =====
$router->get('/', 'controllers/index.php');

// ===== Auth Routes =====
$router->get('/login', 'controllers/login/login.php');
$router->post('/login', 'controllers/login/check.php');
$router->get('/logout', 'controllers/logout.php');
$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');

// ===== User Dashboard =====
$router->get('/user', 'controllers/user/index.php');
$router->get('/user/tickets', 'controllers/user/tickets/index.php');
$router->get('/user/tickets/create', 'controllers/user/tickets/create.php');
$router->post('/user/tickets/store', 'controllers/user/tickets/store.php');
$router->get('/user/tickets/detail', 'controllers/user/tickets/detail.php');
$router->post('/user/tickets/comment', 'controllers/user/tickets/comment.php');
$router->post('/user/tickets/rate', 'controllers/user/tickets/rate.php');
$router->get('/user/assets', 'controllers/user/assets/index.php');
$router->post('/user/assets/store', 'controllers/user/assets/store.php');
$router->get('/user/knowledge', 'controllers/user/knowledge/index.php');
$router->get('/user/sandi', 'controllers/user/sandi.php');
$router->post('/sandi', 'controllers/sandi.update.php');

// ===== Admin Dashboard =====
$router->get('/admin', 'controllers/admin/index.php');
$router->get('/admin/tickets', 'controllers/admin/tickets/index.php');
$router->get('/admin/tickets/export', 'controllers/admin/tickets/export.php');
$router->get('/admin/tickets/detail', 'controllers/admin/tickets/detail.php');
$router->post('/admin/tickets/assign', 'controllers/admin/tickets/assign.php');
$router->post('/admin/tickets/status', 'controllers/admin/tickets/status.php');
$router->post('/admin/tickets/comment', 'controllers/admin/tickets/comment.php');
$router->get('/admin/categories', 'controllers/admin/categories/index.php');
$router->post('/admin/categories/store', 'controllers/admin/categories/store.php');
$router->post('/admin/categories/delete', 'controllers/admin/categories/delete.php');
$router->get('/admin/assets', 'controllers/admin/assets/index.php');
$router->get('/admin/announcements', 'controllers/admin/announcements/index.php');
$router->post('/admin/announcements/store', 'controllers/admin/announcements/store.php');
$router->post('/admin/announcements/delete', 'controllers/admin/announcements/delete.php');
$router->get('/admin/knowledge', 'controllers/admin/knowledge/index.php');
$router->post('/admin/knowledge/store', 'controllers/admin/knowledge/store.php');
$router->post('/admin/knowledge/delete', 'controllers/admin/knowledge/delete.php');
$router->get('/admin/sandi', 'controllers/admin/sandi.php');
