<?php
// Inclusion du fichier de connexion à la base de données
require_once 'connexion_bdd.php';

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $habitat_id = $_POST['habitat_id_commentaire'];
    $commentaire_habitat = $_POST['commentaire_habitat'];

    // Préparation de la requête SQL pour mettre à jour le commentaire de l'habitat
    $sql = "UPDATE habitat SET commentaire_habitat = :commentaire_habitat WHERE habitat_id = :habitat_id";
    
    // Préparation de la requête
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
    $stmt->bindParam(':commentaire_habitat', $commentaire_habitat, PDO::PARAM_STR);

    // Exécution de la requête
    try {
        $stmt->execute();
        // Redirection avec un message de succès
        header("Location: veterinaire_dashboard.php?message=success&action=Modifier");
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs SQL
        die("Erreur lors de la modification du commentaire sur l'habitat : " . $e->getMessage());
    }
} else {
    // Redirection si le formulaire n'est pas soumis correctement
    header("Location: veterinaire_dashboard.php");
    exit();
}