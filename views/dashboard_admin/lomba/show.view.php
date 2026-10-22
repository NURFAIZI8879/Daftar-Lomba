<?php require base_path('views/partials/head.php') ?>
<div class="container">
    <?php require base_path('views/partials/sidebar.php') ?>

    <!-- Dashboard -->
    <div class="dashboard active">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>

        <div class="container_form">
            <a href="/admin/kegiatan" class="back-link"></ion-icon>Kembali</a>
            <div class="header_form">
                <h1>Lomba <?= ucwords($lomba['nama']) ?></h1>
            </div>
        </div>

        <div class="detail-container">
            <div class="section-detail">
                <div class="section-header">Deskripsi Lomba</div>
                <div class="section-content">
                    <p><?= $lomba['deskripsi'] ?></p>
                </div>
            </div>
        </div>

        <div class="header_form">
            <h1><?= isset($peserta_lomba) ? 'Data Peserta' : 'Belum ada peserta yang mengumpul' ?></h1>
        </div>

        <?php if (isset($peserta_lomba)): ?>
            <div class="tabel">
                <?php require base_path('views/dashboard_admin/table/' . $lomba['nama'] . '.table.php') ?>
            </div>
        <?php endif ?>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="../../../js/script.js"></script>
<?php require base_path('views/partials/foot.php') ?>