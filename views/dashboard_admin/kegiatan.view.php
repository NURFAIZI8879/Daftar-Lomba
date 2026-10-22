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

        <p class="tabel">
            <a href="/admin" class="back-link"></ion-icon>Kembali</a>
            <a href="/admin/lomba" class="tambah-link"></ion-icon>Tambah</a>
        <div class="header_form">
            <h1>Kegiatan Lomba</h1>
        </div>
        <?php if (isset($list_lomba)): ?>
            <table>
                <tr>
                    <th>Nama Lomba</th>
                    <th>Periode Lomba</th>
                    <th></th>
                </tr>
                <?php foreach ($list_lomba as $lomba): ?>
                    <tr>
                        <td><?= ucwords($lomba['nama']) ?></td>
                        <td><?= $lomba['tanggal_mulai'] ?> <span style="font-size: 12px; font-weight: bold;">sampai</span>
                            <?= $lomba['tanggal_berakhir'] ?></td>
                        <td><a href="/admin/lomba/detail?id=<?= $lomba['id'] ?>"><button
                                    class="btn-selengkapnya">Selengkapnya</button></a></td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php else: ?>
            <p style="text-align: center; margin-top: 3rem;">Belum ada lomba.</p>
        <?php endif ?>
    </div>
</div>
</div>

<!-- =========== Scripts =========  -->
<script src="../../js/script.js"></script>
<?php require base_path('views/partials/foot.php') ?>