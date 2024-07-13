<?php
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// Récupérer les données du formulaire
$pseudo = htmlspecialchars($_POST['pseudo']);
$commentaire = htmlspecialchars($_POST['commentaire']);

// Validation des données
if (empty($pseudo) || empty($commentaire)) {
    die("Veuillez remplir tous les champs.");
}

// Préparer la requête SQL d'insertion
$stmt = $pdo->prepare("INSERT INTO avis (pseudo, commentaire, isVisible) VALUES (?, ?, FALSE)");

// Exécuter la requête en liant les paramètres
try {
    $stmt->execute([$pseudo, $commentaire]);
    echo "Votre avis a été soumis avec succès.";
} catch (PDOException $e) {
    die("Erreur lors de l'insertion de l'avis : " . $e->getMessage());
}

// Fermer la connexion à la base de données
$pdo = null;