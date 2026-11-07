<!-- Dashboard Navbar -->
<nav class="dash-navbar">
    <div class="dash-nav-container">
        <a href="/" class="dash-nav-logo">
            <span class="logo-icon">T</span>
            <span>TiketIT</span>
        </a>
        <div class="dash-nav-links">
            <?php if ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'teknisi'): ?>
                <a href="/admin" class="dash-nav-link">Dashboard</a>
                <a href="/admin/tickets" class="dash-nav-link">Tiket<?php
                if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin', 'teknisi'])) {
                    if (!isset($_SESSION['open_tickets_count']) || (time() - ($_SESSION['open_tickets_ts'] ?? 0)) > 60) {
                        try {
                            $db = \Core\App::resolve(\Core\Database::class);
                            $_SESSION['open_tickets_count'] = $db->query("SELECT COUNT(*) as c FROM tickets WHERE status = 'open'")->get()['c'];
                            $_SESSION['open_tickets_ts'] = time();
                        } catch (Exception $e) {
                            $_SESSION['open_tickets_count'] = 0;
                        }
                    }
                    if ($_SESSION['open_tickets_count'] > 0) {
                        echo '<span class="nav-badge">' . $_SESSION['open_tickets_count'] . '</span>';
                    }
                }
                ?></a>
                <a href="/admin/categories" class="dash-nav-link">Kategori</a>
                <a href="/admin/announcements" class="dash-nav-link">Pengumuman</a>
                <a href="/admin/knowledge" class="dash-nav-link">Knowledge</a>
            <?php else: ?>
                <a href="/user" class="dash-nav-link">Dashboard</a>
                <a href="/user/tickets" class="dash-nav-link">Tiket Saya</a>
                <a href="/user/assets" class="dash-nav-link">Aset</a>
                <a href="/user/knowledge" class="dash-nav-link">Knowledge</a>
            <?php endif; ?>
        </div>
        <div class="dash-nav-user">
            <span class="dash-nav-name"><?= htmlspecialchars($_SESSION['user']['nama']) ?></span>
            <span class="dash-nav-role badge-role-<?= $_SESSION['user']['role'] ?>"><?= ucfirst($_SESSION['user']['role']) ?></span>
            <a href="/<?= $_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'teknisi' ? 'admin' : 'user' ?>/sandi" class="dash-nav-link">Password</a>
            <a href="/logout" class="dash-nav-link dash-nav-logout" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
        </div>
        <button class="dash-nav-toggle" onclick="document.querySelector('.dash-nav-links').classList.toggle('show'); document.querySelector('.dash-nav-user').classList.toggle('show');">Menu</button>
    </div>
</nav>
