<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

require 'config.php';

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch();

$username = $user['username'];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CloudSyncPro Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<header>
    <h1>Willkommen, <?= htmlspecialchars($username); ?>!</h1>
</header>

<section id="connected-services">
    <h2>Verbundene Dienste</h2>
    <div class="service-list">
        <div class="service">
            <img src="assets/github-logo.png" alt="GitHub">
        </div>
        <div class="service">
            <img src="assets/google-drive-logo.png" alt="Google Drive">
        </div>
        <div class="service">
            <img src="assets/onedrive-logo.png" alt="OneDrive">
        </div>
    </div>
</section>

<section id="add-service">
    <button class="add-btn">+</button>
    <p>Neue Verbindung hinzufügen</p>
</section>

<a href="logout.php">Logout</a>

<footer>
    <p>&copy; 2024 CloudSyncPro. Alle Rechte vorbehalten.</p>
</footer>
</body>
</html>
