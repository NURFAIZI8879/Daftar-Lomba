<?php require base_path('views/partials/head.php') ?>
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <span class="logo-icon">🎫</span>
            <h1>TiketIT</h1>
            <p>Daftar Akun Baru</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['errors'])): ?>
            <div class="alert alert-error">
                <?php foreach ($_SESSION['errors'] as $err): ?>
                    <p><?= htmlspecialchars($err) ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>

        <?php $old = $_SESSION['old'] ?? []; unset($_SESSION['old']); ?>

        <form action="/register" method="POST" class="auth-form">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Nama lengkap" required value="<?= htmlspecialchars($old['name'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="email@contoh.com" required value="<?= htmlspecialchars($old['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="departemen">Departemen</label>
                <input type="text" id="departemen" name="departemen" placeholder="Contoh: Keuangan, HRD, IT" value="<?= htmlspecialchars($old['departemen'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telepon</label>
                <input type="text" id="no_telp" name="no_telp" placeholder="08xxxxxxxxxx" value="<?= htmlspecialchars($old['no_telp'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Ulangi password" required>
            </div>
            <button type="submit" class="btn-primary btn-full">Buat Akun</button>
        </form>

        <div class="auth-links">
            <p>Sudah punya akun? <a href="/login">Login</a></p>
            <a href="/" class="home-link">← Kembali ke Beranda</a>
        </div>
    </div>
</div>

<?php require base_path('views/partials/foot.php') ?>