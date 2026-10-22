<table>
    <tr>
        <th>No</th>
        <th>Nama Tim</th>
        <th>Judul Website</th>
        <th>Wireframe</th>
        <th>UI/UX</th>
        <th>File Project</th>
        <th>Deskripsi</th>
    </tr>

    <?php for ($i = 0; $i < count($peserta_lomba); $i++): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($list_tim[$i]) ?></td>
            <td><?= htmlspecialchars($peserta_lomba[$i]['judul']) ?></td>
            <td><a href="<?= $peserta_lomba[$i]['wireframe'] ?>">Buka</a></td>
            <td><a href="<?= $peserta_lomba[$i]['ui_ux'] ?>">Buka</a></td>
            <td><a href="<?= $peserta_lomba[$i]['file_project'] ?>">Buka</a></td>
            <td><?= htmlspecialchars($peserta_lomba[$i]['deskripsi']) ?></td>
        </tr>
    <?php endfor ?>
</table>