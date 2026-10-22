<?php require base_path('views/partials/head.php') ?>
<div class="register-container">
    <div class="logo"></div>
    <h2>Register</h2>
    <form action="/register" method="POST">
        <input type="text" name="name" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Buat Akun</button>
    </form>

    <a href="/login" class="home-link"><i class="ri-arrow-left-line"></i>Kembali</a>
</div>
<?php require base_path('views/partials/foot.php') ?>