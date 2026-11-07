<?php require base_path('views/partials/head.php') ?>
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <span class="logo-icon"></span>
            <h1>TiketIT</h1>
            <p>Sistem Helpdesk & Ticketing IT</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'empty'): ?>
            <div class="alert alert-error">Email dan password wajib diisi.</div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'salahpw'): ?>
            <div class="alert alert-error">Password salah.</div>
        <?php endif; ?>

        <form action="/login" method="POST" class="auth-form">
        <?= csrf_field() ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-primary btn-full">Login</button>
        </form>

        <div class="auth-links">
            <p>Belum punya akun? <a href="/register">Register</a></p>
            <a href="/" class="home-link"> Kembali ke Beranda</a>
        </div>
    </div>
</div>

<?php require base_path('views/partials/foot.php') ?>