<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Buat Tiket Baru</h1>
        <a href="/user/tickets" class="btn-secondary"> Kembali</a>
    </div>

    <?php if (isset($_SESSION['errors'])): ?>
        <div class="alert alert-error">
            <?php foreach ($_SESSION['errors'] as $err): ?>
                <p><?= htmlspecialchars($err) ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['errors']); ?>
        </div>
    <?php endif; ?>

    <div class="form-card">
        <form action="/user/tickets/store" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="judul">Judul Tiket *</label>
                <input type="text" id="judul" name="judul" required placeholder="Contoh: Laptop lambat saat booting" value="<?= htmlspecialchars($_SESSION['old']['judul'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="id_category">Kategori *</label>
                <select id="id_category" name="id_category" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= ($_SESSION['old']['id_category'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                            <?= $cat['icon'] ?> <?= htmlspecialchars($cat['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="prioritas">Prioritas *</label>
                <select id="prioritas" name="prioritas" required>
                    <option value="low" <?= ($_SESSION['old']['prioritas'] ?? '') === 'low' ? 'selected' : '' ?>>Low (72 jam)</option>
                    <option value="medium" <?= ($_SESSION['old']['prioritas'] ?? 'medium') === 'medium' ? 'selected' : '' ?>>Medium (48 jam)</option>
                    <option value="high" <?= ($_SESSION['old']['prioritas'] ?? '') === 'high' ? 'selected' : '' ?>>High (24 jam)</option>
                    <option value="critical" <?= ($_SESSION['old']['prioritas'] ?? '') === 'critical' ? 'selected' : '' ?>>Critical (4 jam)</option>
                </select>
            </div>

            <?php if (!empty($assets)): ?>
            <div class="form-group">
                <label for="id_asset">Perangkat Terkait (opsional)</label>
                <select id="id_asset" name="id_asset">
                    <option value="">-- Tidak ada --</option>
                    <?php foreach ($assets as $asset): ?>
                        <option value="<?= $asset['id'] ?>"><?= htmlspecialchars($asset['nama_perangkat']) ?> (<?= htmlspecialchars($asset['lokasi']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Masalah *</label>
                <textarea id="deskripsi" name="deskripsi" rows="5" required placeholder="Jelaskan masalah yang Anda alami secara detail..."><?= htmlspecialchars($_SESSION['old']['deskripsi'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="lampiran">Lampiran (screenshot, max 5MB)</label>
                <input type="file" id="lampiran" name="lampiran" accept="image/*,.pdf">
                <small class="form-hint">Format: JPG, PNG, GIF, PDF. Maksimal 5MB.</small>
            </div>

            <button type="submit" class="btn-primary btn-full">Buat Tiket</button>
        </form>
    </div>
</div>
<?php unset($_SESSION['old']); ?>
<?php require base_path('views/partials/foot.php') ?>
