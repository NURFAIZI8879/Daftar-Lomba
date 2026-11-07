<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Knowledge Base</h1>
    
    <a href="/user" class="btn-secondary btn-sm">Kembali</a></div>

    <!-- Search -->
    <form method="GET" action="/user/knowledge" class="search-bar">
        <input type="text" name="search" placeholder="Cari solusi..." value="<?= htmlspecialchars($search) ?>">
        <select name="kategori">
            <option value="">Semua Kategori</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $categoryId == $cat['id'] ? 'selected' : '' ?>>
                    <?= $cat['icon'] ?> <?= htmlspecialchars($cat['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-primary">Cari</button>
    </form>

    <?php if (empty($articles)): ?>
        <div class="empty-state">
            <div class="empty-icon"></div>
            <p>Tidak ada artikel ditemukan.</p>
        </div>
    <?php else: ?>
        <div class="kb-grid">
            <?php foreach ($articles as $article): ?>
            <div class="kb-card">
                <div class="kb-header">
                    <span class="kb-category"><?= $article['kategori_icon'] ?? '' ?> <?= htmlspecialchars($article['kategori_nama'] ?? 'Umum') ?></span>
                    <h3><?= htmlspecialchars($article['judul']) ?></h3>
                </div>
                <div class="kb-body">
                    <div class="kb-section">
                        <h4>Masalah</h4>
                        <p><?= nl2br(htmlspecialchars($article['masalah'])) ?></p>
                    </div>
                    <div class="kb-section">
                        <h4>Solusi</h4>
                        <p><?= nl2br(htmlspecialchars($article['solusi'])) ?></p>
                    </div>
                    <?php if ($article['tags']): ?>
                    <div class="kb-tags">
                        <?php foreach (explode(',', $article['tags']) as $tag): ?>
                            <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php require base_path('views/partials/foot.php') ?>