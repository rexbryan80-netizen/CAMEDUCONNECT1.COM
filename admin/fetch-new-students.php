<?php
include("../../model/db.php");

$result = $conn->query("SELECT name FROM students ORDER BY id DESC LIMIT 5");

$data = [];
while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode([
    "count" => count($data),
    "data" => $data
]);