<?php require base_path('views/partials/head.php') ?>
<div class="dashboard-container">
    <div class="page-header">
        <h1>Ganti Password</h1>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="form-card" style="max-width: 500px;">
        <form action="/sandi" method="POST">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="old_password">Password Lama *</label>
                <input type="password" id="old_password" name="old_password" required placeholder="Password lama">
            </div>
            <div class="form-group">
                <label for="new_password">Password Baru *</label>
                <input type="password" id="new_password" name="new_password" required placeholder="Minimal 6 karakter">
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password Baru *</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Ulangi password baru">
            </div>
            <button type="submit" class="btn-primary btn-full">Ganti Password</button>
        </form>
    </div>
</div>
<?php require base_path('views/partials/foot.php') ?>