<?php
// Charger la configuration de la base de données
$config = include '../../config/config.php';

// Récupérer les informations de connexion
$dbConfig = $config['db'];
$dsn = "{$dbConfig['driver']}:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']}";

// Connexion à la base de données PostgreSQL
try {
    $pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données PostgreSQL : " . $e->getMessage());
}
