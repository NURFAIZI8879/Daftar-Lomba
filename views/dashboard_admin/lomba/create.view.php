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

        <div class="submission-tambahlomba" id="submission-tambahlomba">
            <div class="container_form">
                <a href="/admin/kegiatan" class="back-link"></ion-icon>Kembali</a>
                <div class="header_form">
                    <h1>Tambah Lomba Baru</h1>
                </div>
                <div class="content">
                    <form action="/admin/lomba" method="post">
                        <label for="nama">Nama Lomba</label>
                        <input type="text" id="nama" name="nama" required>

                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" required>

                        <label for="tanggal_berakhir">Tanggal Akhir</label>
                        <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" required>

                        <label for="deskripsi">Deskripsi Lomba</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>

                        <button type="submit" class="submit-btn">TAMBAH</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="/js/script.js"></script>
<?php require base_path('views/partials/foot.php') ?>