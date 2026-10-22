<?php

$router->get('/', 'controllers/index.php');

$router->get('/login', 'controllers/login/login.php');
$router->post('/login', 'controllers/login/check.php');

$router->get('/logout', 'controllers/logout.php');

$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');

$router->get('/peserta', 'controllers/peserta/index.php');

$router->get('/peserta/tim', 'controllers/peserta/tim.php');
$router->post('/peserta/tim', 'controllers/peserta/tim.store.php');

$router->get('/peserta/kegiatan', 'controllers/peserta/kegiatan.php');
$router->post('/peserta/kegiatan', 'controllers/peserta/lomba/index.php');

$router->get('/peserta/status', 'controllers/peserta/status.php');

$router->get('/peserta/sandi', 'controllers/peserta/sandi.php');

$router->get('/admin', 'controllers/admin/index.php');

$router->get('/admin/tim', 'controllers/admin/tim.php');

$router->get('/admin/kegiatan', 'controllers/admin/kegiatan.php');

$router->get('/admin/lomba', 'controllers/admin/lomba/create.php');
$router->post('/admin/lomba', 'controllers/admin/lomba/store.php');

$router->get('/admin/lomba/detail', 'controllers/admin/lomba/show.php');

$router->get('/admin/sandi', 'controllers/admin/sandi.php');

$router->post('/sandi', 'controllers/sandi.update.php');