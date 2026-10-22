<div class="content-animasi">
    <form action="/peserta/kegiatan" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_lomba" value="<?= $lomba['id'] ?>">
        <label for="judul">Judul/Nama Karya</label>
        <input type="text" id="judul" name="judul" placeholder="Judul/Nama Karya" required>
        <label for="storyboard">Link Storyboard (pdf)</label>
        <input type="url" id="storyboard" name="storyboard" placeholder="Link Storyboard (pdf)" required>
        <label for="script">Link Script (pdf)</label>
        <input type="url" id="script" name="script" placeholder="Link Script (pdf)" required>
        <label for="hasil_render">Link Hasil Render (mp4)</label>
        <input type="url" id="hasil_render" name="hasil_render" placeholder="Masukkan Link Video Hasil Render" required>
        <label for="deskripsi">Deskripsi Project</label>
        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Project" rows="4" required></textarea>
        <button type="submit">KIRIM</button>
    </form>
</div>