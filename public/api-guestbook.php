<?php
header('Content-Type: application/json');
$dbPath = __DIR__ . '/../data/devlink.db';

// Pastikan direktori data ada
if (!file_exists(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buat tabel guestbook jika belum ada
    $pdo->exec("CREATE TABLE IF NOT EXISTS guestbook (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
        $stmt = $pdo->query("SELECT name, message, created_at FROM guestbook ORDER BY id DESC LIMIT 5");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
    }

    if ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $name = trim($input['name'] ?? '');
        $message = trim($input['message'] ?? '');

        if (empty($name) || empty($message)) {
            http_response_code(400);
            echo json_encode(['error' => 'Nama dan pesan wajib diisi!']);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO guestbook (name, message) VALUES (?, ?)");
        $stmt->execute([htmlspecialchars($name), htmlspecialchars($message)]);

        echo json_encode(['success' => true, 'message' => 'Pesan berhasil dikirim!']);
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
