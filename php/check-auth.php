<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;   
}
?>