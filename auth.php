<?php
session_start();
require_once 'db_connect.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Basic validation
    if (empty($username) || empty($email) || empty($password)) {
        header("Location: index.php?status=error&message=All fields are required");
        exit();
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);
    if ($stmt->rowCount() > 0) {
        header("Location: index.php?status=error&message=User already exists");
        exit();
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    try {
        if ($stmt->execute([$username, $email, $password_hash])) {
            header("Location: index.php?status=success&message=Registration successful! Please login.");
        } else {
            header("Location: index.php?status=error&message=Registration failed");
        }
    } catch (PDOException $e) {
        header("Location: index.php?status=error&message=Database error");
    }
    exit();
}

if (isset($_POST['login'])) {
    $username_email = trim($_POST['username_email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$username_email, $username_email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php?status=success&message=Login successful!");
    } else {
        header("Location: index.php?status=error&message=Invalid credentials");
    }
    exit();
}
?>
