<!-- Dashboard Navbar -->
<nav class="dash-navbar">
    <div class="dash-nav-container">
        <a href="/" class="dash-nav-logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
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
            <div class="dash-avatar">
                <?= strtoupper(substr($_SESSION['user']['nama'], 0, 1)) ?>
            </div>
            <div class="dash-user-info">
                <span class="dash-nav-name"><?= htmlspecialchars($_SESSION['user']['nama']) ?></span>
                <span class="dash-nav-role badge-role-<?= $_SESSION['user']['role'] ?>"><?= ucfirst($_SESSION['user']['role']) ?></span>
            </div>
            <div class="dash-user-dropdown">
                <a href="/<?= $_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'teknisi' ? 'admin' : 'user' ?>/sandi" class="dropdown-item">Ubah Password</a>
                <a href="/logout" class="dropdown-item dropdown-danger" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
            </div>
        </div>
        <button class="dash-nav-toggle" onclick="document.querySelector('.dash-nav-links').classList.toggle('show'); document.querySelector('.dash-nav-user').classList.toggle('show');">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
    </div>
</nav>

<style>
.dash-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
    flex-shrink: 0;
}
.dash-user-info {
    display: none;
}
.dash-user-dropdown {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    min-width: 160px;
    z-index: 200;
}
.dash-nav-user:hover .dash-user-dropdown {
    display: block;
}
.dropdown-item {
    display: block;
    padding: 0.625rem 1rem;
    font-size: 0.85rem;
    color: var(--text);
    text-decoration: none;
    transition: background 0.2s;
}
.dropdown-item:hover {
    background: var(--bg-alt);
}
.dropdown-danger {
    color: var(--danger);
    border-top: 1px solid var(--border);
}
@media (min-width: 768px) {
    .dash-user-info {
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .dash-nav-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text);
    }
    .dash-nav-role {
        font-size: 0.7rem;
        padding: 0.125rem 0.5rem;
        border-radius: 9999px;
    }
}
</style>