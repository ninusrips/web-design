<?php
session_start();
require_once 'db_connect.php';

if (isset($_POST['submit_feedback'])) {
    $message = trim($_POST['message']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;

    if (empty($message)) {
        header("Location: index.php?status=error&message=Message cannot be empty");
        exit();
    }

    $sql = "INSERT INTO feedback (user_id, name, email, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    try {
        if ($stmt->execute([$user_id, $name, $email, $message])) {
            header("Location: index.php?status=success&message=Thank you for your feedback!");
        } else {
            header("Location: index.php?status=error&message=Failed to send feedback");
        }
    } catch (PDOException $e) {
        header("Location: index.php?status=error&message=Database error");
    }
    exit();
}
?>
