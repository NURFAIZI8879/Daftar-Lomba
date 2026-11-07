<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Kelola Kategori</h1>
    
    <a href="/admin" class="btn-secondary btn-sm">Kembali</a></div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="form-card mb-6">
        <h3>Tambah Kategori Baru</h3>
        <form action="/admin/categories/store" method="POST">
        <?= csrf_field() ?>
            <div class="form-row">
                <div class="form-group">
                    <label for="nama">Nama Kategori *</label>
                    <input type="text" id="nama" name="nama" required placeholder="Contoh: Hardware">
                </div>
                <div class="form-group">
                    <label for="icon">Icon (emoji)</label>
                    <input type="text" id="icon" name="icon" placeholder="" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="2" placeholder="Deskripsi kategori..."></textarea>
            </div>
            <button type="submit" class="btn-primary">Tambah Kategori</button>
        </form>
    </div>

    <?php if (empty($categories)): ?>
        <div class="empty-state">
            <div class="empty-icon"></div>
            <p>Belum ada kategori.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td style="font-size:1.5rem;"><?= $cat['icon'] ?></td>
                        <td><?= htmlspecialchars($cat['nama']) ?></td>
                        <td><?= htmlspecialchars($cat['deskripsi'] ?? '-') ?></td>
                        <td>
                            <form action="/admin/categories/delete" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kategori ini?')">\n                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                                <button type="submit" class="btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php require base_path('views/partials/foot.php') ?>