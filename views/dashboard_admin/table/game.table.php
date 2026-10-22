<table>
    <tr>
        <th>No</th>
        <th>Nama Tim</th>
        <th>Judul Game</th>
        <th>File Eksekusi</th>
        <th>Trailer</th>
        <th>Kode Sumber</th>
        <th>Deskripsi</th>
    </tr>

    <?php for ($i = 0; $i < count($peserta_lomba); $i++): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($list_tim[$i]) ?></td>
            <td><?= htmlspecialchars($peserta_lomba[$i]['judul']) ?></td>
            <td><a href="<?= $peserta_lomba[$i]['judul'] ?>">Buka</a></td>
            <td><a href="<?= $peserta_lomba[$i]['file_eksekusi'] ?>">Buka</a></td>
            <td><a href="<?= $peserta_lomba[$i]['kode_sumber'] ?>">Buka</a></td>
            <td><?= htmlspecialchars($peserta_lomba[$i]['deskripsi']) ?></td>
        </tr>
    <?php endfor ?>
</table>