<?php
$dbPath = __DIR__ . '/devlink.db';
$pdo = new PDO("sqlite:" . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Buat tabel links jika belum ada
$pdo->exec("
    CREATE TABLE IF NOT EXISTS links (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT DEFAULT '',
        url TEXT NOT NULL,
        sort_order INTEGER DEFAULT 0,
        clicks INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

// Inisialisasi seed data jika tabel masih kosong
$count = $pdo->query("SELECT COUNT(*) FROM links")->fetchColumn();
if ($count == 0) {
    $stmt = $pdo->prepare("INSERT INTO links (title, description, url, sort_order) VALUES (?, ?, ?, ?)");
    $stmt->execute(["SentinelCore Observability", "Live real-time system & endpoint monitoring dashboard", "https://monitoring-server.streamlit.app/?view=status", 1]);
    $stmt->execute(["GitHub Repositories", "Koleksi proyek open-source, script, dan riset teknis", "https://github.com", 2]);
    $stmt->execute(["Curriculum Vitae", "Resume profesional, riwayat proyek & keahlian teknis", "https://linkedin.com", 3]);
}

function get_all_links($pdo) {
    $stmt = $pdo->query("SELECT * FROM links ORDER BY sort_order ASC, id ASC");
    return $stmt->fetchAll();
}
