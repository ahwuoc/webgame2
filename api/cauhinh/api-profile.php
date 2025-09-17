<?php
// Simple API profile endpoint
header('Content-Type: application/json');

// Basic response
echo json_encode([
    'status' => 'success',
    'message' => 'Profile API endpoint',
    'data' => []
]);
?>
