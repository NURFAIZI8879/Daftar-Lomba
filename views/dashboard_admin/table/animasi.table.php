<table>
    <tr>
        <th>No</th>
        <th>Nama Tim</th>
        <th>Judul Animasi</th>
        <th>Storyboard</th>
        <th>Script</th>
        <th>Hasil Render</th>
        <th>Deskripsi</th>
    </tr>

    <?php for ($i = 0; $i < count($peserta_lomba); $i++): ?>
        <tr>
            <td><?= $i + 1?></td>
            <td><?= htmlspecialchars($list_tim[$i]) ?></td>
            <td><?= htmlspecialchars($peserta_lomba[$i]['judul']) ?></td>
            <td><a href="<?= $peserta_lomba[$i]['storyboard'] ?>">Buka</a></td>
            <td><a href="<?= $peserta_lomba[$i]['script'] ?>">Buka</a></td>
            <td><a href="<?= $peserta_lomba[$i]['hasil_render'] ?>">Buka</a></td>
            <td><?= htmlspecialchars($peserta_lomba[$i]['deskripsi']) ?></td>
        </tr>
    <?php endfor ?>
</table>