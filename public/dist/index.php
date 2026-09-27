<?php
require_once __DIR__ . '/../data/db.php';
$links = get_all_links($pdo);

$profile = [
    "name" => "Alif Fiansyah",
    "role" => "Software Engineer & DevOps Explorer",
    "avatar" => "https://avatars.githubusercontent.com/u/583231?v=4",
    "badge" => "AVAILABLE FOR COLLAB"
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($profile['name']) ?> | DevLink Hub</title>
    <link rel="stylesheet" href="dist/style.css">
</head>
<body>

    <div class="hub-container">
        <!-- SentinelCore Live Telemetry Widget -->
        <div class="telemetry-widget">
            <div class="widget-left">
                <div class="pulse-dot"></div>
                <span>SentinelCore Observability</span>
            </div>
            <div class="widget-status">OPERATIONAL (100%)</div>
        </div>

        <!-- Profile Header -->
        <header class="profile-card">
            <img class="avatar" src="<?= htmlspecialchars($profile['avatar']) ?>" alt="Avatar">
            <h1 class="name"><?= htmlspecialchars($profile['name']) ?></h1>
            <p class="bio"><?= htmlspecialchars($profile['role']) ?></p>
            <span class="badge-dev"><?= htmlspecialchars($profile['badge']) ?></span>
        </header>

        <!-- Links List -->
        <main class="links-group">
            <?php foreach ($links as $link): ?>
                <a href="<?= htmlspecialchars($link['url']) ?>" 
                   class="link-item" 
                   data-id="<?= $link['id'] ?>"
                   target="_blank" 
                   rel="noopener noreferrer">
                    <div class="link-info">
                        <span class="title"><?= htmlspecialchars($link['title']) ?></span>
                        <span class="desc"><?= htmlspecialchars($link['description']) ?></span>
                    </div>
                    <span class="link-arrow">→</span>
                </a>
            <?php endforeach; ?>
        </main>

        <!-- Theme Switcher Pills -->
        <div class="theme-bar">
            <button data-set-theme="slate">Slate</button>
            <button data-set-theme="cyberpunk">Cyberpunk</button>
            <button data-set-theme="emerald">Emerald</button>
        </div>

        <div style="display: flex; gap: 14px; align-items: center;">
            <button id="share-btn" style="background:none; border:none; color:var(--text-muted); font-size:12px; cursor:pointer; font-family:monospace;">
                Salin Tautan Profil
            </button>
            <span style="color:var(--border-color);">•</span>
            <a href="admin.php" style="color:var(--accent); font-size:12px; text-decoration:none; font-family:monospace;">
                Panel Pengelola
            </a>
        </div>

        <footer class="footer-text">
            DevLink Engine • PHP + SCSS + TypeScript
        </footer>
    </div>

    <script type="module" src="dist/main.bundle.js"></script>
</body>
</html>
