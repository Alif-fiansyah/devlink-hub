<?php
$profile = [
    "name" => "LIFIANZHI",
    "headline" => "Undergrad CS Student & Backend Explorer",
    "avatar" => "https://avatars.githubusercontent.com/u/583231?v=4",
    "tags" => ["PYTHON", "PHP", "TYPESCRIPT", "ARCH LINUX"]
];

$socials = [
    [
        "name" => "GitHub",
        "url" => "https://github.com/Alif-fiansyah",
        "icon" => '<svg viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>'
    ],
    [
        "name" => "LinkedIn",
        "url" => "https://linkedin.com",
        "icon" => '<svg viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>'
    ],
    [
        "name" => "Instagram",
        "url" => "https://instagram.com",
        "icon" => '<svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>'
    ],
    [
        "name" => "Email",
        "url" => "mailto:aliffiansyah@example.com",
        "icon" => '<svg viewBox="0 0 24 24"><path d="M0 3v18h24v-18h-24zm21.518 2l-9.518 7.713-9.518-7.713h19.036zm-19.518 14v-11.817l10 8.104 10-8.104v11.817h-20z"/></svg>'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($profile['name']) ?> • Hub</title>
    <link rel="stylesheet" href="dist/style.css">
</head>
<body>

    <main class="hub-wrapper">
        <!-- Header -->
        <header class="profile-card">
            <div class="avatar-container">
                <img src="<?= htmlspecialchars($profile['avatar']) ?>" alt="Avatar">
                <span class="sticker-tag">2026 ACTIVE</span>
            </div>
            <h1 class="author-name"><?= htmlspecialchars($profile['name']) ?></h1>
            <p class="author-role"><?= htmlspecialchars($profile['headline']) ?></p>

            <div class="badge-strip">
                <?php foreach ($profile['tags'] as $tag): ?>
                    <span class="tag-item"><?= htmlspecialchars($tag) ?></span>
                <?php endforeach; ?>
            </div>
        </header>

        <!-- Social Dock -->
        <nav class="social-dock">
            <?php foreach ($socials as $s): ?>
                <a href="<?= htmlspecialchars($s['url']) ?>" class="dock-item" target="_blank" rel="noopener noreferrer">
                    <?= $s['icon'] ?>
                    <span><?= htmlspecialchars($s['name']) ?></span>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- Interactive Terminal CLI Box -->
        <div class="cli-box" id="cli-toggle">
            <div class="cli-bar">
                <div class="cli-dots">
                    <span></span><span></span><span></span>
                </div>
                <span>$ lifianzhi --status</span>
                <span style="font-size:10px;">[CLICK TO EXPAND]</span>
            </div>
            <div class="cli-content" id="cli-details">
                <div><span class="cmd">> student:</span> Computer Science Undergrad</div>
                <div><span class="cmd">> system:</span> Arch Linux (rolling)</div>
                <div><span class="cmd">> focus:</span> Backend web apps & software engineering</div>
            </div>
        </div>

        <!-- Bento Grid -->
        <div class="bento-grid">
            <!-- REAL-TIME SPOTIFY CARD -->
            <a href="https://open.spotify.com" id="spotify-link" class="spotify-card" target="_blank" rel="noopener noreferrer">
                <div class="sp-left">
                    <img id="sp-album-art" style="display:none; width:44px; height:44px; border-radius:8px; border:2px solid #121212; object-fit:cover;" alt="Album">
                    <div class="sp-icon-box" id="sp-icon-default">
                        <svg viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.496 17.306c-.216.353-.674.464-1.027.248-2.814-1.72-6.356-2.109-10.528-1.156-.403.092-.806-.16-.898-.563-.092-.403.16-.806.563-.898 4.567-1.043 8.487-.597 11.642 1.342.353.216.464.674.248 1.027zm1.468-3.262c-.272.441-.85.58-1.291.308-3.221-1.98-8.13-2.553-11.94-1.396-.499.151-1.03-.134-1.181-.633-.151-.499.134-1.03.633-1.181 4.359-1.322 9.774-.683 13.471 1.589.441.272.58.85.308 1.291zm.126-3.41c-3.863-2.294-10.237-2.506-13.924-1.387-.591.179-1.22-.162-1.399-.753-.179-.591.162-1.22.753-1.399 4.238-1.287 11.277-1.039 15.719 1.597.531.315.705 1.002.39 1.533-.315.531-1.002.705-1.533.39z"/></svg>
                    </div>
                    <div class="sp-track-info">
                        <span class="sp-label" id="sp-status">ON REPEAT / CODING VIBE</span>
                        <span class="sp-title" id="sp-title">Cincin</span>
                        <span class="sp-artist" id="sp-artist">Hindia</span>
                    </div>
                </div>
                <!-- Animated Bars -->
                <div class="equalizer" id="sp-eq">
                    <span></span><span></span><span></span><span></span>
                </div>
            </a>

            <!-- Dual Mini Bento Cards -->
            <div class="bento-row">
                <a href="#" class="mini-card card-cyan">
                    <span class="mini-label">PORTFOLIO</span>
                    <div>
                        <div class="mini-title">Personal Labs</div>
                        <div class="mini-sub">Eksplorasi kode & apps</div>
                    </div>
                </a>

                <a href="https://github.com/Alif-fiansyah" class="mini-card card-orange" target="_blank" rel="noopener noreferrer">
                    <span class="mini-label">GITHUB</span>
                    <div>
                        <div class="mini-title">Open Repos</div>
                        <div class="mini-sub">Koleksi script & riset</div>
                    </div>
                </a>
            </div>

            <!-- Direct Contact WhatsApp -->
            <a href="https://wa.me/628xxxxxxxxxx" class="simple-card" target="_blank" rel="noopener noreferrer">
                <div>
                    <div class="title">Direct WhatsApp Message</div>
                    <div class="desc">Tanya jawab santai atau ajakan diskusi proyek</div>
                </div>
                <span class="arrow">→</span>
            </a>
        </div>

        <!-- Footer -->
        <footer class="hub-footer">
            <div class="clock-pill">
                <span id="live-clock">Semarang • --:--:-- WIB</span>
            </div>
            <button id="btn-copy-url" class="btn-copy">copy profile url</button>
        </footer>
    </main>

    <script type="module" src="dist/main.bundle.js"></script>
</body>
</html>
