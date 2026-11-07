<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Aset Saya</h1>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="form-card mb-6">
        <h3>Tambah Aset Baru</h3>
        <form action="/user/assets/store" method="POST">
            <?= csrf_field() ?>
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_perangkat">Nama Perangkat *</label>
                    <input type="text" id="nama_perangkat" name="nama_perangkat" required placeholder="Contoh: Laptop Dell Inspiron 15">
                </div>
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Ruang IT">
                </div>
            </div>
            <div class="form-group">
                <label for="spesifikasi">Spesifikasi</label>
                <textarea id="spesifikasi" name="spesifikasi" rows="2" placeholder="Contoh: Intel Core i5, RAM 8GB, SSD 256GB"></textarea>
            </div>
            <button type="submit" class="btn-primary">Tambah Aset</button>
        </form>
    </div>

    <?php if (empty($assets)): ?>
        <div class="empty-state">
            <div class="empty-icon"></div>
            <p>Belum ada aset terdaftar.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Perangkat</th>
                        <th>Spesifikasi</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assets as $asset): ?>
                    <tr>
                        <td><?= htmlspecialchars($asset['nama_perangkat']) ?></td>
                        <td><?= htmlspecialchars($asset['spesifikasi'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($asset['lokasi'] ?? '-') ?></td>
                        <td><?= date('d/m/Y', strtotime($asset['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php require base_path('views/partials/foot.php') ?>