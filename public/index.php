<?php
// Data Profile & Links (Bisa dipindah ke SQLite)
$profile = [
    "name" => "Alif Fiansyah",
    "role" => "Software Engineer & DevOps Explorer",
    "avatar" => "https://avatars.githubusercontent.com/u/583231?v=4", // Ganti dengan avatar/github kamu
    "badge" => "AVAILABLE FOR COLLAB"
];

$links = [
    [
        "title" => "SentinelCore Observability",
        "desc" => "Live real-time system & endpoint monitoring dashboard",
        "url" => "https://monitoring-server.streamlit.app/?view=status"
    ],
    [
        "title" => "GitHub Repositories",
        "desc" => "Koleksi proyek open-source, script, dan riset teknis",
        "url" => "https://github.com"
    ],
    [
        "title" => "Curriculum Vitae",
        "desc" => "Resume profesional, riwayat proyek & keahlian teknis",
        "url" => "#"
    ],
    [
        "title" => "Direct Contact (Discord / WhatsApp)",
        "desc" => "Terhubung langsung untuk diskusi proyek atau konsultasi",
        "url" => "#"
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($profile['name']) ?> | DevLink Hub</title>
    <!-- Hasil Compile SCSS -->
    <link rel="stylesheet" href="dist/style.css">
</head>
<body>

    <div class="hub-container">
        <!-- Profile Header -->
        <header class="profile-card">
            <img class="avatar" src="<?= htmlspecialchars($profile['avatar']) ?>" alt="Avatar">
            <h1 class="name"><?= htmlspecialchars($profile['name']) ?></h1>
            <p class="bio"><?= htmlspecialchars($profile['role']) ?></p>
            <span class="badge-dev"><?= htmlspecialchars($profile['badge']) ?></span>
        </header>

        <!-- Links Group -->
        <main class="links-group">
            <?php foreach ($links as $link): ?>
                <a href="<?= htmlspecialchars($link['url']) ?>" class="link-item" target="_blank" rel="noopener noreferrer">
                    <div class="link-info">
                        <span class="title"><?= htmlspecialchars($link['title']) ?></span>
                        <span class="desc"><?= htmlspecialchars($link['desc']) ?></span>
                    </div>
                    <span class="link-arrow">→</span>
                </a>
            <?php endforeach; ?>
        </main>

        <!-- Action / Footer -->
        <button id="share-btn" style="background:none; border:none; color:#64748b; font-size:12px; cursor:pointer; font-family:monospace;">
            Salin Tautan Profil
        </button>
        <footer class="footer-text">
            DevLink Engine • PHP + SCSS + TypeScript
        </footer>
    </div>

    <!-- Hasil Compile TypeScript -->
    <script type="module" src="dist/main.bundle.js"></script>
</body>
</html>
