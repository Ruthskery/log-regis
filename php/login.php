<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Find user by email
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];

    // Redirect based on role
    if ($user['role'] == 'admin') {
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        header("Location: ../client/dashboard.php");
        exit;
    }
} else {
    echo "Invalid credentials";
}
?>
