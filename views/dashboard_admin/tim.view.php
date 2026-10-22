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
            <a href="/admin" class="back-link"></ion-icon>Kembali</a>
            <div class="header_form">
                <h1><?= isset($list_tim) ? 'Daftar Tim' : 'Belum Ada Tim' ?></h1>
            </div>
        </div>

        <?php if (isset($list_tim)): ?>
            <div class="tabel">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama Tim</th>
                        <th>NIK Ketua</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Asal Instansi</th>
                        <th>Lomba yang diikuti</th>
                    </tr>

                    <?php for ($i = 0; $i < count($list_tim); $i++): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($list_tim[$i]['nama']) ?></td>
                        <td><?= htmlspecialchars($list_tim[$i]['nik']) ?></td>
                        <td><?= htmlspecialchars($email_peserta[$i]) ?></td>
                        <td><?= htmlspecialchars($list_tim[$i]['no_telp']) ?></td>
                        <td><?= $list_tim[$i]['kalangan'] ?></td>
                        <td><?= ucwords($lomba_diikuti[$i]) ?></td>
                    </tr>
                    <?php endfor ?>
                </table>
            </div>
        <?php endif ?>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="../../js/script.js"></script>

<?php require base_path('views/partials/foot.php') ?>