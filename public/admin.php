<?php
require_once __DIR__ . '/../data/db.php';
$links = get_all_links($pdo);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tautan | DevLink Admin</title>
    <link rel="stylesheet" href="dist/style.css">
</head>
<body>

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: baseline;">
            <h2 style="font-size: 18px; font-weight: 700;">Kelola Tautan DevLink</h2>
            <a href="index.php" style="color: #38bdf8; text-decoration: none; font-size: 13px;">← Halaman Utama</a>
        </div>

        <form id="add-link-form" class="admin-form">
            <input type="text" id="in-title" placeholder="Nama Label Tautan (contoh: Portofolio Web)" required>
            <input type="url" id="in-url" placeholder="https://domain-kamu.com" required>
            <input type="text" id="in-desc" placeholder="Keterangan singkat / deskripsi">
            <button type="submit">+ Tambahkan Tautan</button>
        </form>

        <table class="table-links">
            <thead>
                <tr>
                    <th>Tautan</th>
                    <th>Klik</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($links as $l): ?>
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: #f8fafc;"><?= htmlspecialchars($l['title']) ?></div>
                            <div style="font-size: 11px; color: #64748b; word-break: break-all;"><?= htmlspecialchars($l['url']) ?></div>
                        </td>
                        <td style="font-family: monospace; color: #38bdf8;"><?= $l['clicks'] ?></td>
                        <td style="text-align: right;">
                            <button class="btn-del" data-id="<?= $l['id'] ?>">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script type="module" src="dist/main.bundle.js"></script>
</body>
</html>
