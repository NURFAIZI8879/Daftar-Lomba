<div class="content-website">
    <form action="/peserta/kegiatan" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_lomba" value="<?= $lomba['id'] ?>">
        <label for="judul">Judul/Nama Karya</label>
        <input type="text" id="judul" name="judul" placeholder="Judul/Nama Karya" required>
        <label for="wireframe">Wireframe (link)</label>
        <input type="url" id="wireframe" name="wireframe" placeholder="Wireframe (link)" required>
        <label for="ui_ux">UI/UX (link)</label>
        <input type="url" id="ui_ux" name="ui_ux" placeholder="UI/UX (link)" required>
        <label for="file_project">Link File Project (dalam format rar/zip)</label>
        <input type="url" id="file_project" name="file_project" placeholder="Masukkan Link File Project (GDrive)"
            required>
        <label for="deskripsi">Deskripsi Project</label>
        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Project" rows="4" required></textarea>
        <button type="submit">KIRIM</button>
    </form>
</div>