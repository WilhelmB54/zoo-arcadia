<?php
// Informations de connexion à la base de données PostgreSQL
$host = 'localhost'; // Adresse du serveur PostgreSQL
$dbname = 'zoo_arcadia'; // Nom de votre base de données PostgreSQL
$user = 'postgres'; // Utilisateur PostgreSQL
$password = 'Rotarex140714!'; // Mot de passe PostgreSQL

// Connexion à la base de données PostgreSQL
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données PostgreSQL : " . $e->getMessage());
}