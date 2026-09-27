<?php
require_once __DIR__ . '/../data/db.php';
$links = get_all_links($pdo);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Pengelola | DevLink Hub</title>
    <link rel="stylesheet" href="dist/style.css">
</head>
<body style="align-items: flex-start; padding-top: 40px;">

    <div class="admin-container">
        <!-- Kolom Kiri: Form & Daftar Link -->
        <div class="admin-panel-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="font-size: 19px; font-weight: 700;">Studio DevLink</h2>
                <a href="index.php" style="color: var(--accent); text-decoration: none; font-size: 13px;">← Kembali ke Profil</a>
            </div>

            <form id="add-link-form" class="admin-form">
                <input type="text" id="in-title" placeholder="Nama Label Tautan (Ketik untuk live-preview)" required>
                <input type="url" id="in-url" placeholder="https://domain-tujuan.com" required>
                <input type="text" id="in-desc" placeholder="Keterangan singkat / deskripsi">
                <button type="submit">+ Tambahkan Tautan Sekarang</button>
            </form>

            <table style="width: 100%; margin-top: 30px; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border-color); color: var(--text-muted); text-align: left;">
                        <th style="padding: 8px;">Tautan</th>
                        <th style="padding: 8px;">Total Klik</th>
                        <th style="padding: 8px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($links as $l): ?>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="padding: 10px 8px;">
                                <div style="font-weight: 600;"><?= htmlspecialchars($l['title']) ?></div>
                                <div style="font-size: 11px; color: var(--text-muted);"><?= htmlspecialchars($l['url']) ?></div>
                            </td>
                            <td style="padding: 10px 8px; font-family: monospace; color: var(--accent);"><?= $l['clicks'] ?></td>
                            <td style="padding: 10px 8px; text-align: right;">
                                <button class="btn-del" data-id="<?= $l['id'] ?>" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444; padding: 4px 8px; border-radius: 4px; font-size: 11px; cursor: pointer;">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Kolom Kanan: Live Mobile Mockup Preview -->
        <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
            <span style="font-size: 12px; font-family: monospace; color: var(--text-muted);">LIVE PHONE PREVIEW</span>
            <div class="phone-mockup-frame" style="width: 100%; max-width: 320px;">
                <div style="width: 60px; height: 4px; background: #334155; border-radius: 4px; margin-bottom: 20px;"></div>
                
                <!-- Mockup Content -->
                <div style="width: 100%; display: flex; flex-direction: column; gap: 10px;">
                    <div id="mockup-live-card" class="link-item" style="border-style: dashed; border-color: var(--accent);">
                        <div class="link-info">
                            <span class="title">Tautan Baru</span>
                            <span class="desc">Ketik di form kiri untuk preview</span>
                        </div>
                        <span class="link-arrow">→</span>
                    </div>

                    <?php foreach ($links as $link): ?>
                        <div class="link-item" style="pointer-events: none; padding: 10px 14px;">
                            <div class="link-info">
                                <span class="title" style="font-size: 13px;"><?= htmlspecialchars($link['title']) ?></span>
                            </div>
                            <span class="link-arrow" style="font-size: 13px;">→</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="dist/main.bundle.js"></script>
</body>
</html>
