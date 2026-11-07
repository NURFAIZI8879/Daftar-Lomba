<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Aset Perangkat</h1>
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
                        <th>Pengguna</th>
                        <th>Departemen</th>
                        <th>Perangkat</th>
                        <th>Spesifikasi</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assets as $asset): ?>
                    <tr>
                        <td><?= htmlspecialchars($asset['user_nama']) ?></td>
                        <td><?= htmlspecialchars($asset['departemen'] ?? '-') ?></td>
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