<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /auth/login');
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user['nom']); ?>!</h1>
    <p>Email: <?= htmlspecialchars($user['email']); ?></p>
    <p>Phone: <?= htmlspecialchars($user['phone']); ?></p>
    <a href="/auth/logout">Logout</a>
</body>
</html>
