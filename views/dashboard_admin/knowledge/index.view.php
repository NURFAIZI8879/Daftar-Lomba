<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Knowledge Base</h1>
    
    <a href="/admin" class="btn-secondary btn-sm">Kembali</a></div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="form-card mb-6">
        <h3>Tambah Artikel Baru</h3>
        <form action="/admin/knowledge/store" method="POST">
        <?= csrf_field() ?>
            <div class="form-row">
                <div class="form-group">
                    <label for="judul">Judul *</label>
                    <input type="text" id="judul" name="judul" required placeholder="Judul artikel">
                </div>
                <div class="form-group">
                    <label for="id_category">Kategori</label>
                    <select id="id_category" name="id_category">
                        <option value="">-- Pilih --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= $cat['icon'] ?> <?= htmlspecialchars($cat['nama']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="masalah">Masalah *</label>
                <textarea id="masalah" name="masalah" rows="3" required placeholder="Deskripsi masalah..."></textarea>
            </div>
            <div class="form-group">
                <label for="solusi">Solusi *</label>
                <textarea id="solusi" name="solusi" rows="4" required placeholder="Langkah-langkah solusi..."></textarea>
            </div>
            <div class="form-group">
                <label for="tags">Tags (pisahkan dengan koma)</label>
                <input type="text" id="tags" name="tags" placeholder="laptop,lambat,booting">
            </div>
            <button type="submit" class="btn-primary">Tambah Artikel</button>
        </form>
    </div>

    <?php if (empty($articles)): ?>
        <div class="empty-state">
            <div class="empty-icon">&#128203;</div>
            <p>Belum ada artikel.</p>
        </div>
    <?php else: ?>
        <div class="kb-admin-list">
            <?php foreach ($articles as $article): ?>
            <div class="kb-admin-card">
                <div class="kb-admin-header">
                    <h3><?= htmlspecialchars($article['judul']) ?></h3>
                    <form action="/admin/knowledge/delete" method="POST" style="display:inline;" onsubmit="return confirm('Hapus artikel ini?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $article['id'] ?>">
                        <button type="submit" class="btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
                <p class="kb-cat"><?= $article['kategori_icon'] ?? '' ?> <?= htmlspecialchars($article['kategori_nama'] ?? 'Umum') ?></p>
                <p class="kb-masalah"><strong>Masalah:</strong> <?= nl2br(htmlspecialchars($article['masalah'])) ?></p>
                <p class="kb-solusi"><strong>Solusi:</strong> <?= nl2br(htmlspecialchars($article['solusi'])) ?></p>
                <?php if ($article['tags']): ?>
                <div class="kb-tags">
                    <?php foreach (explode(',', $article['tags']) as $tag): ?>
                        <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php require base_path('views/partials/foot.php') ?>