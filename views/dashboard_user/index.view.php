<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <p class="dashboard-welcome">Selamat datang, <?= htmlspecialchars($_SESSION['user']['nama']) ?>!</p>
    </div>

    <div class="dashboard-cards">
        <a href="/user/tickets" class="dash-card">
            <div class="dash-card-icon" style="font-size:1.5rem;">&#128203;</div>
            <h3>Tiket Saya</h3>
            <p>Lihat dan kelola tiket keluhan IT Anda</p>
        </a>
        <a href="/user/tickets/create" class="dash-card">
            <div class="dash-card-icon" style="font-size:1.5rem;">&#128203;</div>
            <h3>Buat Tiket Baru</h3>
            <p>Laporkan masalah IT baru</p>
        </a>
        <a href="/user/assets" class="dash-card">
            <div class="dash-card-icon" style="font-size:1.5rem;">&#128203;</div>
            <h3>Aset Saya</h3>
            <p>Lihat perangkat/aset yang terdaftar</p>
        </a>
        <a href="/user/knowledge" class="dash-card">
            <div class="dash-card-icon" style="font-size:1.5rem;">&#128203;</div>
            <h3>Knowledge Base</h3>
            <p>Solusi masalah umum IT</p>
        </a>
    </div>
</div>
<?php require base_path('views/partials/foot.php') ?>