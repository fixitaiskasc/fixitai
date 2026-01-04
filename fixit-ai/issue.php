<?php
require "db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"] ?? "";

/* SAVE ISSUE (USER) */
if ($action === "save") {
    $stmt = $db->prepare("
        INSERT INTO issues (user_id, type, description, severity, location)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $data["user_id"],
        $data["type"],
        $data["description"],
        $data["severity"],
        $data["location"]
    ]);

    echo json_encode(["success" => true]);
    exit;
}

/* LIST ALL ISSUES */
if ($action === "list") {
    $stmt = $db->query("
        SELECT issues.*, users.email, users.role
        FROM issues
        JOIN users ON users.id = issues.user_id
        ORDER BY issues.created_at DESC
    ");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

/* ADMIN: UPDATE STATUS */
if ($action === "update-status") {
    $stmt = $db->prepare("
        UPDATE issues
        SET status = ?
        WHERE id = ?
    ");
    $stmt->execute([
        $data["status"],
        $data["issue_id"]
    ]);

    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["success" => false, "error" => "Invalid action"]);
