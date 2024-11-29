<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Überprüfen, ob der Benutzername bereits existiert
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $existingUser = $stmt->fetchColumn();

    if ($existingUser) {
        $error = "Benutzername ist bereits vergeben.";
    } else {
        // Neuen Benutzer in die Datenbank einfügen
        $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->execute(['username' => $username, 'password' => $passwordHash]);

        $_SESSION['user_id'] = $pdo->lastInsertId();
        header('Location: dashboard.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CloudSyncPro - Registrierung</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Registrieren</h1>
</header>

<section>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Benutzername" required>
        <input type="password" name="password" placeholder="Passwort" required>
        <button type="submit">Registrieren</button>
    </form>

    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <p>Bereits ein Konto? <a href="index.php">Anmelden</a></p>
</section>
</body>
</html>
