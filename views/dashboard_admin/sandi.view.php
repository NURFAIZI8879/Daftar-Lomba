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

        <div class="submission-sandi" id="submission-sandi">
            <div class="container_form">
                <a href="/admin" class="back-link"></ion-icon>Kembali</a>
                <div class="header_form">
                    <h1>Ganti Kata Sandi</h1>
                </div>
                <div class="content">
                    <form action="/sandi" method="post" enctype="multipart/form-data">
                        <label for="password_lama" class="label-sandi">Password Lama:</label>
                        <input type="password" id="password_lama" name="password_lama"
                            placeholder="Masukkan Password Lama" required>

                        <label for="password_baru" class="label-sandi">Password Baru:</label>
                        <input type="password" id="password_baru" name="password_baru"
                            placeholder="Masukkan Password Baru" required>
                            
                        <button type="submit">GANTI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="../../js/script.js"></script>

<?php require base_path('views/partials/foot.php') ?>