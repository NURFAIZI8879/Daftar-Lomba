<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Pengumuman</h1>
    
    <a href="/admin" class="btn-secondary btn-sm">Kembali</a></div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="form-card mb-6">
        <h3>Buat Pengumuman Baru</h3>
        <form action="/admin/announcements/store" method="POST">
        <?= csrf_field() ?>
            <div class="form-group">
                <label for="judul">Judul *</label>
                <input type="text" id="judul" name="judul" required placeholder="Judul pengumuman">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select id="tipe" name="tipe">
                        <option value="info">Info</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="gangguan">Gangguan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="expired_at">Expired (opsional)</label>
                    <input type="datetime-local" id="expired_at" name="expired_at">
                </div>
            </div>
            <div class="form-group">
                <label for="isi">Isi Pengumuman *</label>
                <textarea id="isi" name="isi" rows="4" required placeholder="Isi pengumuman..."></textarea>
            </div>
            <button type="submit" class="btn-primary">Buat Pengumuman</button>
        </form>
    </div>

    <?php if (empty($announcements)): ?>
        <div class="empty-state">
            <div class="empty-icon">&#128203;</div>
            <p>Belum ada pengumuman.</p>
        </div>
    <?php else: ?>
        <div class="announcement-list">
            <?php foreach ($announcements as $ann): ?>
            <div class="announcement-card">
                <div class="ann-header">
                    <span class="badge badge-<?= $ann['tipe'] ?>"><?= ucfirst($ann['tipe']) ?></span>
                    <h3><?= htmlspecialchars($ann['judul']) ?></h3>
                    <span class="ann-date"><?= date('d M Y H:i', strtotime($ann['created_at'])) ?></span>
                </div>
                <p class="ann-body"><?= nl2br(htmlspecialchars($ann['isi'])) ?></p>
                <div class="ann-footer">
                    <small>Oleh: <?= htmlspecialchars($ann['author_nama']) ?></small>
                    <form action="/admin/announcements/delete" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pengumuman ini?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $ann['id'] ?>">
                        <button type="submit" class="btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php require base_path('views/partials/foot.php') ?>