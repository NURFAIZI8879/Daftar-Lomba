<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Kelola Tiket</h1>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-number"><?= $stats['total'] ?></div>
            <div class="stat-label">Total Tiket</div>
        </div>
        <div class="stat-card stat-open">
            <div class="stat-number"><?= $stats['open'] ?></div>
            <div class="stat-label">Open</div>
        </div>
        <div class="stat-card stat-progress">
            <div class="stat-number"><?= $stats['in_progress'] ?></div>
            <div class="stat-label">In Progress</div>
        </div>
        <div class="stat-card stat-waiting">
            <div class="stat-number"><?= $stats['waiting'] ?></div>
            <div class="stat-label">Waiting</div>
        </div>
        <div class="stat-card stat-resolved">
            <div class="stat-number"><?= $stats['resolved'] ?></div>
            <div class="stat-label">Resolved</div>
        </div>
        <div class="stat-card stat-closed">
            <div class="stat-number"><?= $stats['closed'] ?></div>
            <div class="stat-label">Closed</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filter-bar">
        <form method="GET" action="/admin/tickets" class="filter-form">
            <input type="text" name="search" placeholder="Cari judul / nama..." value="<?= htmlspecialchars($filters['search']) ?>">
            <select name="status">
                <option value="">Semua Status</option>
                <option value="open" <?= $filters['status'] === 'open' ? 'selected' : '' ?>>Open</option>
                <option value="in_progress" <?= $filters['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="waiting" <?= $filters['status'] === 'waiting' ? 'selected' : '' ?>>Waiting</option>
                <option value="resolved" <?= $filters['status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
                <option value="closed" <?= $filters['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
            </select>
            <select name="prioritas">
                <option value="">Semua Prioritas</option>
                <option value="low" <?= $filters['prioritas'] === 'low' ? 'selected' : '' ?>>Low</option>
                <option value="medium" <?= $filters['prioritas'] === 'medium' ? 'selected' : '' ?>>Medium</option>
                <option value="high" <?= $filters['prioritas'] === 'high' ? 'selected' : '' ?>>High</option>
                <option value="critical" <?= $filters['prioritas'] === 'critical' ? 'selected' : '' ?>>Critical</option>
            </select>
            <select name="kategori">
                <option value="">Semua Kategori</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $filters['kategori'] == $cat['id'] ? 'selected' : '' ?>>
                        <?= $cat['icon'] ?> <?= htmlspecialchars($cat['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-primary">Filter</button>
            <a href="/admin/tickets" class="btn-secondary">Reset</a>
        </form>
    </div>

    <!-- Ticket Table -->
    <?php if (empty($tickets)): ?>
        <div class="empty-state">
            <div class="empty-icon">🎫</div>
            <p>Tidak ada tiket ditemukan.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Pengguna</th>
                        <th>Kategori</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Teknisi</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td>#<?= $ticket['id'] ?></td>
                        <td class="td-title"><?= htmlspecialchars($ticket['judul']) ?></td>
                        <td><?= htmlspecialchars($ticket['user_nama']) ?><br><small><?= htmlspecialchars($ticket['user_departemen'] ?? '') ?></small></td>
                        <td><?= $ticket['kategori_icon'] ?> <?= htmlspecialchars($ticket['kategori_nama']) ?></td>
                        <td><span class="badge badge-priority-<?= $ticket['prioritas'] ?>"><?= ucfirst($ticket['prioritas']) ?></span></td>
                        <td><span class="badge badge-<?= $ticket['status'] ?>"><?= ucfirst(str_replace('_', ' ', $ticket['status'])) ?></span></td>
                        <td><?= $ticket['teknisi_nama'] ? htmlspecialchars($ticket['teknisi_nama']) : '<span class="text-muted">-</span>' ?></td>
                        <td><?= date('d/m/Y', strtotime($ticket['created_at'])) ?></td>
                        <td><a href="/admin/tickets/detail?id=<?= $ticket['id'] ?>" class="btn-sm">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php require base_path('views/partials/foot.php') ?>