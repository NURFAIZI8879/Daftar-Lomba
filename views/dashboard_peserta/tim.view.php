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

        <div class="submission-data-tim" id="submission-data-tim">
            <div class="container_form">
                <a href="/peserta" class="back-link"></ion-icon>Kembali</a>
                <div class="header_form">
                    <h1>Data Tim</h1>
                </div>
                <div class="content">
                    <?php if (isset($data_tim)): ?>
                        <table>
                            <tr>
                                <th>Nama Tim</th>
                                <th>NIK Ketua</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>Asal Instansi</th>
                                <th>Lomba yang diikuti</th>
                            </tr>

                            <tr>
                                <td><?= $data_tim['nama'] ?></td>
                                <td><?= $data_tim['nik'] ?></td>
                                <td><?= $_SESSION['user']['email'] ?></td>
                                <td><?= $data_tim['no_telp'] ?></td>
                                <td><?= $data_tim['kalangan'] ?></td>
                                <td><?= ucwords($nama_lomba) ?></td>
                            </tr>
                        </table>
                    <?php else: ?>
                        <form action="/peserta/tim" method="post" enctype="multipart/form-data">
                            <label for="nama">Nama Tim</label>
                            <input type="text" id="nama" name="nama" placeholder="Nama Tim" required>

                            <label for="nik">NIK Ketua Tim</label>
                            <input type="text" id="nik" name="nik" placeholder="Nik Ketua Tim" required>

                            <label for="no_telp">No.Telp</label>
                            <input type="tel" id="no_telp" name="no_telp" placeholder="No.Telp" required>

                            <div class="dropdown">
                                <label for="kalangan">Kalangan</label>
                                <select id="kalangan" name="kalangan" required>
                                    <option value="siswa">Siswa</option>
                                    <option value="mahasiswa">Mahasiswa</option>
                                    <option value="umum">Umum</option>
                                </select>
                            </div>

                            <div class="dropdown">
                                <label for="id_lomba">Lomba Yang Diikuti</label>
                                <select id="id_lomba" name="id_lomba" required>
                                    <?php foreach ($list_lomba as $lomba): ?>
                                        <option value="<?= $lomba['id'] ?>"><?= ucwords($lomba['nama']) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <button type="submit"
                                onclick="return confirm('Setelah disimpan, data tidak bisa diubah. Silahkan dicek kembali.')">SIMPAN</button>
                        </form>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="/js/script.js"></script>

<?php require base_path('views/partials/foot.php') ?>