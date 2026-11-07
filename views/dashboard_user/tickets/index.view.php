<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Tiket Saya</h1>
        <a href="/user/tickets/create" class="btn-primary">+ Buat Tiket Baru</a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (empty($tickets)): ?>
        <div class="empty-state">
            <div class="empty-icon"></div>
            <p>Belum ada tiket. Buat tiket pertama Anda!</p>
            <a href="/user/tickets/create" class="btn-primary">Buat Tiket</a>
        </div>
    <?php else: ?>
        <div class="ticket-list">
            <?php foreach ($tickets as $ticket): ?>
                <a href="/user/tickets/detail?id=<?= $ticket['id'] ?>" class="ticket-card">
                    <div class="ticket-header">
                        <span class="ticket-id">#<?= $ticket['id'] ?></span>
                        <span class="badge badge-<?= $ticket['status'] ?>"><?= ucfirst(str_replace('_', ' ', $ticket['status'])) ?></span>
                        <span class="badge badge-priority-<?= $ticket['prioritas'] ?>"><?= ucfirst($ticket['prioritas']) ?></span>
                    </div>
                    <h3 class="ticket-title"><?= htmlspecialchars($ticket['judul']) ?></h3>
                    <div class="ticket-meta">
                        <span><?= $ticket['kategori_icon'] ?> <?= htmlspecialchars($ticket['kategori_nama']) ?></span>
                        <span> <?= date('d M Y', strtotime($ticket['created_at'])) ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php require base_path('views/partials/foot.php') ?>
