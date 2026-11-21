<?php
include '../../model/db.php';

header('Content-Type: application/json');

$data = [];

// Fetch latest items
$query = "
(SELECT 'New Expert Added' as msg, created_at FROM experts ORDER BY created_at DESC LIMIT 2)
UNION
(SELECT 'New Institute Added' as msg, created_at FROM institutes ORDER BY created_at DESC LIMIT 2)
UNION
(SELECT 'New Program Available' as msg, created_at FROM programs ORDER BY created_at DESC LIMIT 2)
ORDER BY created_at DESC LIMIT 5
";

$result = $conn->query($query);

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode([
    "count" => count($data),
    "data" => $data
]);