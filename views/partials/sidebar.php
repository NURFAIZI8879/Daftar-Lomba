<!-- Sidebar -->
<div class="navigation active">
    <ul>
        <li id="home-peserta" <?php if ($_SERVER['REQUEST_URI'] === '/peserta' || $_SERVER['REQUEST_URI'] === '/admin')
            echo "class='active'" ?>>
                <a href="/<?= $_SESSION['user']['hak_akses'] ?>">
                    <span class="icon">
                        <div
                            class="<?= $_SERVER['REQUEST_URI'] === '/peserta' || $_SERVER['REQUEST_URI'] === '/admin' ? 'logo' : 'logo-white' ?>">
                    </div>
                </span>
                <span class="title">SINOPAL</span>
            </a>
        </li>

        <li id="data-tim" <?php if ($_SERVER['REQUEST_URI'] === '/peserta/tim' || $_SERVER['REQUEST_URI'] === '/admin/tim')
            echo "class='active'" ?>>
                <a href="/<?= $_SESSION['user']['hak_akses'] ?>/tim">
                <span class="icon">
                    <ion-icon name="people-outline"></ion-icon>
                </span>
                <span class="title">Data Tim</span>
            </a>
        </li>

        <li id="kegiatan-lomba" <?php if ($_SERVER['REQUEST_URI'] === '/peserta/kegiatan' || $_SERVER['REQUEST_URI'] === '/admin/kegiatan')
            echo "class='active'" ?>>
                <a href="/<?= $_SESSION['user']['hak_akses'] ?>/kegiatan">
                <span class="icon">
                    <ion-icon name="medal-outline"></ion-icon>
                </span>
                <span class="title">Kegiatan Lomba</span>
            </a>
        </li>

        <?php if ($_SESSION['user']['hak_akses'] === 'peserta'): ?>
            <li id="status-karya" <?php if ($_SERVER['REQUEST_URI'] === '/peserta/status' || $_SERVER['REQUEST_URI'] === '/admin/status')
                echo "class='active'" ?>>
                    <a href="/<?= $_SESSION['user']['hak_akses'] ?>/status">
                    <span class="icon">
                        <ion-icon name="checkmark-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Status Karya</span>
                </a>
            </li>
        <?php endif ?>

        <li id="ganti-sandi" <?php if ($_SERVER['REQUEST_URI'] === '/peserta/sandi' || $_SERVER['REQUEST_URI'] === '/admin/sandi')
            echo "class='active'" ?>>
                <a href="/<?= $_SESSION['user']['hak_akses'] ?>/sandi">
                <span class="icon">
                    <ion-icon name="key-outline"></ion-icon>
                </span>
                <span class="title">Ganti Kata Sandi</span>
            </a>
        </li>

        <li>
            <a href="/logout" onclick="return confirm('Apakah kamu yakin ingin keluar?')">
                <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span class="title">Keluar</span>
            </a>
        </li>
    </ul>
</div>