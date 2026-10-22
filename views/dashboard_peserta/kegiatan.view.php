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

        <div class="submission-lomba" id="submission-lomba">
            <div class="container_form">
                <a href="/peserta" class="back-link"></ion-icon>Kembali</a>
                <div class="header_form">
                    <h1>Kegiatan Lomba</h1>
                </div>
                <?php if ($status === 'no_data'): ?>
                    <div class="deskripsi">
                        <h2>Data Tim anda masih kosong. Silahkan isi terlebih dahulu.</h2>
                    </div>
                <?php elseif ($status === 'not_submitted'): ?>
                    <?php include base_path('views/dashboard_peserta/form/' . $lomba['nama'] . '.form.php')  ?>
                <?php else: ?>
                    <div class="deskripsi">
                        <h2>Anda sudah mengumpulkan karya anda!</h2>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="/js/script.js"></script>

<?php require base_path('views/partials/foot.php') ?>