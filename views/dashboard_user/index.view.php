<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/dash-navbar.php') ?>
<div class="dashboard-container">

    <!-- Header: Sapaan + CTA -->
    <div class="dash-header">
        <div class="dash-header-left">
            <h1>Dashboard</h1>
            <p class="dash-welcome">Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong>!</p>
            <p class="dash-date" id="current-date"></p>
        </div>
        <div class="dash-header-right">
            <a href="/user/tickets/create" class="btn-primary btn-lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Buat Tiket Baru
            </a>
        </div>
    </div>

    <!-- Banner Pengumuman -->
    <?php if (!empty($announcements)): ?>
    <div class="announcement-banner" id="announcement-banner">
        <?php foreach ($announcements as $ann): ?>
        <div class="ann-banner-item ann-<?= $ann['tipe'] ?>">
            <div class="ann-banner-content">
                <span class="ann-banner-icon">
                    <?php if ($ann['tipe'] === 'gangguan'): ?>&#9888;
                    <?php elseif ($ann['tipe'] === 'maintenance'): ?>&#128295;
                    <?php else: ?>&#8505;
                    <?php endif; ?>
                </span>
                <div>
                    <strong><?= htmlspecialchars($ann['judul']) ?></strong>
                    <p><?= htmlspecialchars($ann['isi']) ?></p>
                </div>
            </div>
            <button class="ann-banner-close" onclick="this.parentElement.style.display='none'" aria-label="Tutup">&times;</button>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Statistik Cards -->
    <div class="stats-row">
        <a href="/user/tickets" class="stat-card stat-total">
            <div class="stat-icon">&#127903;</div>
            <div class="stat-info">
                <div class="stat-number"><?= $stats['total'] ?></div>
                <div class="stat-label">Total Tiket</div>
            </div>
        </a>
        <a href="/user/tickets?status=open" class="stat-card stat-open">
            <div class="stat-icon">&#128309;</div>
            <div class="stat-info">
                <div class="stat-number"><?= $stats['open'] ?></div>
                <div class="stat-label">Open</div>
            </div>
        </a>
        <a href="/user/tickets?status=in_progress" class="stat-card stat-progress">
            <div class="stat-icon">&#9881;</div>
            <div class="stat-info">
                <div class="stat-number"><?= $stats['in_progress'] ?></div>
                <div class="stat-label">In Progress</div>
            </div>
        </a>
        <a href="/user/tickets?status=resolved" class="stat-card stat-resolved">
            <div class="stat-icon">&#9989;</div>
            <div class="stat-info">
                <div class="stat-number"><?= $stats['resolved'] ?></div>
                <div class="stat-label">Resolved</div>
            </div>
        </a>
    </div>

    <!-- Main Grid: Tickets + Sidebar -->
    <div class="dash-grid">
        <!-- Kolom Utama: Tiket Terbaru -->
        <div class="dash-main">
            <div class="section-card">
                <div class="section-header">
                    <h2>Tiket Terbaru</h2>
                    <a href="/user/tickets" class="link-view-all">Lihat semua </a>
                </div>
                <?php if (empty($recentTickets)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">&#127903;</div>
                        <p>Belum ada tiket. Buat tiket pertama Anda!</p>
                        <a href="/user/tickets/create" class="btn-primary btn-sm">Buat Tiket Pertama</a>
                    </div>
                <?php else: ?>
                    <div class="ticket-list-compact">
                        <?php foreach ($recentTickets as $ticket): ?>
                        <a href="/user/tickets/detail?id=<?= $ticket['id'] ?>" class="ticket-row">
                            <div class="ticket-row-left">
                                <span class="ticket-id">#<?= $ticket['id'] ?></span>
                                <span class="ticket-title-compact"><?= htmlspecialchars($ticket['judul']) ?></span>
                            </div>
                            <div class="ticket-row-right">
                                <span class="badge badge-<?= $ticket['status'] ?>"><?= ucfirst(str_replace('_', ' ', $ticket['status'])) ?></span>
                                <span class="badge badge-priority-<?= $ticket['prioritas'] ?>"><?= ucfirst($ticket['prioritas']) ?></span>
                                <span class="ticket-time"><?= date('d M', strtotime($ticket['updated_at'])) ?></span>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Knowledge Base Search -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Cari Solusi Cepat</h2>
                    <a href="/user/knowledge" class="link-view-all">Lihat semua </a>
                </div>
                <p class="kb-hint">Cari solusi sebelum membuat tiket baru.</p>
                <form method="GET" action="/user/knowledge" class="kb-search-form">
                    <input type="text" name="search" placeholder="Cari solusi masalah IT..." class="kb-search-input">
                    <button type="submit" class="btn-primary">Cari</button>
                </form>
                <?php if (!empty($kbArticles)): ?>
                <div class="kb-popular">
                    <p class="kb-popular-title">Artikel terbaru:</p>
                    <ul class="kb-popular-list">
                        <?php foreach ($kbArticles as $article): ?>
                        <li>
                            <a href="/user/knowledge?search=<?= urlencode($article['judul']) ?>">
                                <?= htmlspecialchars($article['judul']) ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Panel Samping -->
        <div class="dash-sidebar">
            <!-- Ringkasan Aset -->
            <div class="section-card">
                <div class="section-header">
                    <h3>Aset Saya</h3>
                    <a href="/user/assets" class="link-view-all">Lihat semua </a>
                </div>
                <div class="asset-summary">
                    <div class="asset-count">
                        <span class="asset-count-number"><?= $assetCount ?></span>
                        <span class="asset-count-label">Perangkat terdaftar</span>
                    </div>
                    <?php if (!empty($topAssets)): ?>
                    <ul class="asset-list">
                        <?php foreach ($topAssets as $asset): ?>
                        <li class="asset-item">
                            <span class="asset-name"><?= htmlspecialchars($asset['nama_perangkat']) ?></span>
                            <span class="asset-loc"><?= htmlspecialchars($asset['lokasi'] ?? '-') ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else: ?>
                    <p class="text-muted" style="font-size:0.85rem;">Belum ada aset terdaftar.</p>
                    <a href="/user/assets" class="btn-secondary btn-sm">Tambah Aset</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Butuh Bantuan? -->
            <div class="section-card help-card">
                <h3>Butuh Bantuan?</h3>
                <div class="help-info">
                    <div class="help-item">
                        <span class="help-icon">&#128337;</span>
                        <div>
                            <strong>Jam Layanan IT</strong>
                            <p>Senin - Jumat, 08:00 - 17:00 WIB</p>
                        </div>
                    </div>
                    <div class="help-item">
                        <span class="help-icon">&#128222;</span>
                        <div>
                            <strong>Kontak</strong>
                            <p>WhatsApp: +62 852-6804-2056</p>
                            <p>Email: faiziasyi140406@gmail.com</p>
                        </div>
                    </div>
                </div>
                <a href="/user/tickets/create" class="btn-primary btn-full" style="margin-top:1rem;">
                    Buat Tiket Baru
                </a>
            </div>
        </div>
    </div>
</div>
<?php require base_path('views/partials/foot.php') ?>