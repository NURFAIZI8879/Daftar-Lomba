<?php require base_path('views/partials/head.php') ?>
<div class="container">
    <?php require base_path('views/partials/sidebar.php') ?>
    
    <!-- Konten -->
    <div class="dashboard active">
        <div class="topbar">
            <div class="toggle home-toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>

        <div class="home" id="home">
            <!-- <img src="/img/banner_kenten.png"> -->
            <h2 style="margin-top: 1rem; text-align: center;">Selamat datang, <?= $_SESSION['user']['nama'] ?></h2>
            <div class="card-container">
                <div class="card-box">
                    <div class="card-item">
                        <a href="/peserta/tim" class="card-item-link">
                            <div class="card-item-bg">
                            </div>
                            <div class="card-item-title">
                                Data Tim
                            </div>
                        </a>
                    </div>
                    <div class="card-item">
                        <a href="/peserta/kegiatan" class="card-item-link">
                            <div class="card-item-bg">
                            </div>
                            <div class="card-item-title">
                                Kegiatan Lomba
                            </div>
                        </a>
                    </div>
                    <div class="card-item">
                        <a href="/peserta/status" class="card-item-link">
                            <div class="card-item-bg">
                            </div>
                            <div class="card-item-title">
                                Status Karya
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="/js/script.js"></script>
<?php require base_path('views/partials/foot.php') ?>