<?php
require "db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"] ?? "";

if ($action === "register") {
    $stmt = $db->prepare("
        INSERT OR IGNORE INTO users (email, firebase_uid, role)
        VALUES (?, ?, ?)
    ");
    $stmt->execute([
        $data["email"],
        $data["firebase_uid"],
        $data["role"] ?? "user"
    ]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "firebase-login") {
    $stmt = $db->prepare("SELECT * FROM users WHERE firebase_uid = ?");
    $stmt->execute([$data["firebase_uid"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(["success" => false, "error" => "User not found"]);
        exit;
    }

    echo json_encode(["success" => true, "user" => $user]);
    exit;
}

echo json_encode(["success" => false, "error" => "Invalid action"]);
