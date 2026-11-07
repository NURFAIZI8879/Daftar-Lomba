<?php require base_path('views/partials/head.php') ?>
<div class="landing-container">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-logo">
                <span class="logo-icon">&#127903;</span>
                <h1>TiketIT</h1>
            </div>
            <p class="hero-tagline">Sistem Helpdesk & Ticketing IT</p>
            <p class="hero-desc">
                Laporkan keluhan IT Anda dengan mudah. TiketIT membantu tim IT mengelola
                dan menyelesaikan masalah teknis secara cepat dan terstruktur.
            </p>
            <div class="hero-buttons">
                <a href="/login" class="btn-primary">Login</a>
                <a href="/register" class="btn-secondary">Register</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">Fitur Utama</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">&#127903;</div>
                    <h3>Buat Tiket</h3>
                    <p>Laporkan keluhan IT dengan mudah: pilih kategori, isi deskripsi, tambahkan lampiran.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">&#128202;</div>
                    <h3>Dashboard Statistik</h3>
                    <p>Pantau jumlah tiket per status, per kategori, dan rata-rata waktu penyelesaian.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">&#128172;</div>
                    <h3>Riwayat Penanganan</h3>
                    <p>Setiap tiket memiliki timeline komentar dari teknisi dan pengguna.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">&#128226;</div>
                    <h3>Pengumuman</h3>
                    <p>Info maintenance, gangguan, dan pengumuman penting dari tim IT.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">&#128218;</div>
                    <h3>Knowledge Base</h3>
                    <p>FAQ dan solusi masalah umum untuk self-service.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">&#9889;</div>
                    <h3>SLA & Prioritas</h3>
                    <p>Tiket diprioritaskan (Low/Medium/High/Critical) dengan target waktu penyelesaian.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="how-section">
        <div class="container">
            <h2 class="section-title">Cara Kerja</h2>
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Buat Tiket</h3>
                    <p>Pengguna melaporkan keluhan IT melalui form tiket.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Admin Assign</h3>
                    <p>Admin menerima tiket dan menugaskan ke teknisi.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Teknisi Menangani</h3>
                    <p>Teknisi menangani dan memberikan update via komentar.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3>Selesai</h3>
                    <p>Tiket resolved, pengguna memberikan konfirmasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <h2>Siap menggunakan TiketIT?</h2>
            <p>Gunakan akun demo untuk mencoba: admin@tiketit.com / password</p>
        </div>
    </section>
</div>

<?php require base_path('views/partials/foot.php') ?>