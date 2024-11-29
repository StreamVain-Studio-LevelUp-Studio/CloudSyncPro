<?php
$host = 'localhost'; // Dein Hostname, z.B. 'localhost'
$dbname = 'cloudsync'; // Der Name der Datenbank
$username = 'root'; // Dein Datenbank-Benutzername
$password = ''; // Dein Datenbank-Passwort

// PDO-Verbindung zur Datenbank
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}
?>

