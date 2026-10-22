<?php require base_path('views/partials/head.php') ?>
<div class="login-container">
    <div class="logo"></div>
    <h2>LOGIN</h2>
    <form action="/login" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <div class="options">
            <div class="register">
                Belum Punya Akun? <a href="/register">Register</a>
            </div>
        </div>
    </form>

    <a href="/" class="home-link"><i class="ri-arrow-left-line"></i>Home</a>
</div>

<?php require base_path('views/partials/foot.php') ?>