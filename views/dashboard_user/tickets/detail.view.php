<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Detail Tiket #<?= $ticket['id'] ?></h1>
        <a href="/user/tickets" class="btn-secondary">← Kembali</a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="ticket-detail-grid">
        <!-- Ticket Info -->
        <div class="ticket-info-card">
            <div class="ticket-detail-header">
                <h2><?= htmlspecialchars($ticket['judul']) ?></h2>
                <div class="ticket-badges">
                    <span class="badge badge-<?= $ticket['status'] ?>"><?= ucfirst(str_replace('_', ' ', $ticket['status'])) ?></span>
                    <span class="badge badge-priority-<?= $ticket['prioritas'] ?>"><?= ucfirst($ticket['prioritas']) ?></span>
                </div>
            </div>

            <div class="ticket-meta-grid">
                <div class="meta-item">
                    <span class="meta-label">Kategori</span>
                    <span><?= $ticket['kategori_icon'] ?> <?= htmlspecialchars($ticket['kategori_nama']) ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Prioritas</span>
                    <span class="badge badge-priority-<?= $ticket['prioritas'] ?>"><?= ucfirst($ticket['prioritas']) ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Status</span>
                    <span class="badge badge-<?= $ticket['status'] ?>"><?= ucfirst(str_replace('_', ' ', $ticket['status'])) ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">SLA</span>
                    <span><?= $ticket['sla_jam'] ?> jam</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Dibuat</span>
                    <span><?= date('d M Y H:i', strtotime($ticket['created_at'])) ?></span>
                </div>
                <?php if ($ticket['teknisi_nama']): ?>
                <div class="meta-item">
                    <span class="meta-label">Teknisi</span>
                    <span><?= htmlspecialchars($ticket['teknisi_nama']) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($ticket['resolved_at']): ?>
                <div class="meta-item">
                    <span class="meta-label">Selesai</span>
                    <span><?= date('d M Y H:i', strtotime($ticket['resolved_at'])) ?></span>
                </div>
                <?php endif; ?>
            </div>

            <div class="ticket-description">
                <h4>Deskripsi Masalah</h4>
                <p><?= nl2br(htmlspecialchars($ticket['deskripsi'])) ?></p>
            </div>

            <?php if ($ticket['lampiran']): ?>
            <div class="ticket-attachment">
                <h4>Lampiran</h4>
                <a href="/uploads/tickets/<?= htmlspecialchars($ticket['lampiran']) ?>" target="_blank" class="attachment-link">
                    📎 <?= htmlspecialchars($ticket['lampiran']) ?>
                </a>
            </div>
            <?php endif; ?>

            <?php if ($asset): ?>
            <div class="ticket-asset">
                <h4>Perangkat Terkait</h4>
                <p><?= htmlspecialchars($asset['nama_perangkat']) ?> — <?= htmlspecialchars($asset['spesifikasi']) ?> (<?= htmlspecialchars($asset['lokasi']) ?>)</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Comments / Timeline -->
        <div class="ticket-comments-card">
            <h3>Riwayat Penanganan</h3>
            <div class="comments-timeline">
                <?php foreach ($comments as $comment): ?>
                    <div class="comment-item">
                        <div class="comment-header">
                            <span class="comment-author"><?= htmlspecialchars($comment['nama']) ?></span>
                            <span class="comment-role badge-role-<?= $comment['role'] ?>"><?= ucfirst($comment['role']) ?></span>
                            <span class="comment-time"><?= date('d M Y H:i', strtotime($comment['created_at'])) ?></span>
                        </div>
                        <div class="comment-body">
                            <?= nl2br(htmlspecialchars($comment['komentar'])) ?>
                        </div>
                        <?php if ($comment['lampiran']): ?>
                            <div class="comment-attachment">
                                <a href="/uploads/tickets/<?= htmlspecialchars($comment['lampiran']) ?>" target="_blank">📎 <?= htmlspecialchars($comment['lampiran']) ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Add comment -->
            <form action="/user/tickets/comment" method="POST" class="comment-form">
                <input type="hidden" name="id_ticket" value="<?= $ticket['id'] ?>">
                <div class="form-group">
                    <textarea name="komentar" rows="3" placeholder="Tambahkan komentar..." required></textarea>
                </div>
                <button type="submit" class="btn-primary">Kirim Komentar</button>
            </form>
        </div>
    </div>
</div>
<?php require base_path('views/partials/foot.php') ?>