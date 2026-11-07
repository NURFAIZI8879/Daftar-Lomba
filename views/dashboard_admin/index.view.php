<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Dashboard Admin</h1>
        <p class="dashboard-welcome">Selamat datang, <?= htmlspecialchars($_SESSION['user']['nama']) ?>!</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-number"><?= $stats['total_tickets'] ?></div>
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
        <div class="stat-card stat-users">
            <div class="stat-number"><?= $stats['total_users'] ?></div>
            <div class="stat-label">Pengguna</div>
        </div>
        <div class="stat-card stat-teknisi">
            <div class="stat-number"><?= $stats['total_teknisi'] ?></div>
            <div class="stat-label">Teknisi</div>
        </div>
    </div>

    <!-- Charts -->
    <div class="charts-grid">
        <div class="chart-card">
            <h3>Tiket per Status</h3>
            <canvas id="statusChart" width="300" height="200"></canvas>
        </div>
        <div class="chart-card">
            <h3>Tiket per Kategori</h3>
            <canvas id="categoryChart" width="300" height="200"></canvas>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="dashboard-cards">
        <a href="/admin/tickets" class="dash-card">
            <div class="dash-card-icon"></div>
            <h3>Kelola Tiket</h3>
            <p>Lihat, assign, dan update status tiket</p>
        </a>
        <a href="/admin/categories" class="dash-card">
            <div class="dash-card-icon"></div>
            <h3>Kategori</h3>
            <p>Kelola kategori layanan IT</p>
        </a>
        <a href="/admin/announcements" class="dash-card">
            <div class="dash-card-icon"></div>
            <h3>Pengumuman</h3>
            <p>Kelola pengumuman maintenance/gangguan</p>
        </a>
        <a href="/admin/knowledge" class="dash-card">
            <div class="dash-card-icon"></div>
            <h3>Knowledge Base</h3>
            <p>Kelola FAQ dan solusi masalah umum</p>
        </a>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Status Chart
        const statusCtx = document.getElementById('statusChart');
        if (statusCtx) {
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Open', 'In Progress', 'Waiting', 'Resolved', 'Closed'],
                    datasets: [{
                        data: [<?= $stats['open'] ?>, <?= $stats['in_progress'] ?>, <?= $stats['waiting'] ?>, <?= $stats['resolved'] ?>, <?= $stats['closed'] ?>],
                        backgroundColor: ['#3b82f6', '#f59e0b', '#8b5cf6', '#22c55e', '#6b7280'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { size: 11 } } }
                    }
                }
            });
        }

        // Category Chart
        (function() {
            const catLabels = [<?php foreach ($catStats as $cs): ?>'<?= htmlspecialchars($cs['nama']) ?>',<?php endforeach; ?>];
            const catValues = [<?php foreach ($catStats as $cs): ?><?= $cs['jumlah'] ?>,<?php endforeach; ?>];
            const catCtx = document.getElementById('categoryChart');
            if (catCtx) {
                new Chart(catCtx, {
                    type: 'bar',
                    data: {
                        labels: catLabels,
                        datasets: [{
                            label: 'Jumlah Tiket',
                            data: catValues,
                            backgroundColor: '#0d9488',
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                    }
                });
            }
        })();
    </script>
</div>
<?php require base_path('views/partials/foot.php') ?>