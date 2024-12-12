<?php
include_once 'config/init.php';

header('Content-Type: application/json');

// Check if the user is logged in
if (!$login->isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$db = Database::getInstance();

// Decode JSON request body
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['id']) || !isset($data['status'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request data']);
    exit();
}

$requestId = $data['id'];
$status = $data['status'] == 'accept' ? 'for pick-up' : 'rejected';

try {
    // Prepare and execute the SQL update statement
    $stmt = $db->prepare("UPDATE document_requests SET status = :status WHERE id = :id");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $requestId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Status updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()]);
}
?>
