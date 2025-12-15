<?php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Vui lòng nhập đầy đủ thông tin hợp lệ."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Phương thức không hợp lệ."]);
}