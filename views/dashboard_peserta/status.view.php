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

        <div class="status-karya">
            <a href="/peserta" class="back-link"></ion-icon>Kembali</a>
            <h1><?= $heading ?></h1>
            <div class="upload-icon">
                <img src="/img/icon_<?= $status ?>.png">
            </div>
            <p class="description"><?= $deskripsi ?></p>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="/js/script.js"></script>

<?php require base_path('views/partials/foot.php') ?>