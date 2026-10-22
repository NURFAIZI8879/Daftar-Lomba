<div class="content-game">
    <form action="/peserta/kegiatan" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_lomba" value="<?= $lomba['id'] ?>">
        <label for="judul">Judul/Nama Karya</label>
        <input type="text" id="judul" name="judul" placeholder="Judul/Nama Karya" required>
        <label for="gdd">Link Game Design Document (pdf)</label>
        <input type="url" id="gdd" name="gdd" placeholder="Game Design Document (pdf)" required>
        <label for="file_eksekusi">File Eksekusi (rar/zip)</label>
        <input type="url" id="file_eksekusi" name="file_eksekusi" placeholder="Masukkan Link File Executable (GDrive)"
            required>
        <label for="trailer">Trailer Gameplay</label>
        <input type="url" id="trailer" name="trailer" placeholder="Masukkan Link Trailer Gameplay"
            required>
        <label for="kode_sumber">Kode Sumber (rar/zip)</label>
        <input type="url" id="kode_sumber" name="kode_sumber" placeholder="Masukkan Link Source Code (GDrive)" required>
        <label for="deskripsi">Deskripsi Project</label>
        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Project" rows="4" required></textarea>
        <button type="submit">KIRIM</button>
    </form>
</div>