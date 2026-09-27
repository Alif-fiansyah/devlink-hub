<?php
header('Content-Type: application/json');
$dbPath = __DIR__ . '/../data/devlink.db';

if (!file_exists(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inisialisasi tabel reaksi global
    $pdo->exec("CREATE TABLE IF NOT EXISTS reactions (
        id TEXT PRIMARY KEY,
        count INTEGER DEFAULT 0
    )");

    $types = ['coffee', 'arch', 'fire'];
    foreach ($types as $t) {
        $stmt = $pdo->prepare("INSERT OR IGNORE INTO reactions (id, count) VALUES (?, 0)");
        $stmt->execute([$t]);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $pdo->query("SELECT id, count FROM reactions");
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[$row['id']] = (int)$row['count'];
        }
        echo json_encode($data);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $type = $input['type'] ?? '';

        if (!in_array($type, $types)) {
            http_response_code(400);
            echo json_encode(['error' => 'Tipe tidak valid']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE reactions SET count = count + 1 WHERE id = ?");
        $stmt->execute([$type]);

        $stmt = $pdo->prepare("SELECT count FROM reactions WHERE id = ?");
        $stmt->execute([$type]);
        echo json_encode(['success' => true, 'count' => (int)$stmt->fetchColumn()]);
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
