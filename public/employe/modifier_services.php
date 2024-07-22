<?php
// Inclusion du fichier de connexion à la base de données
require_once 'connexion_bdd.php';

// Vérification de la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $service_id = $_POST['service_id'];
    $service_nom = $_POST['service_nom'];
    $service_description = $_POST['service_description'];

    // Préparation de la requête SQL
    $sql = "UPDATE service SET nom = :nom, description = :description WHERE service_id = :service_id";

    // Préparation et exécution de la requête SQL
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $service_nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $service_description, PDO::PARAM_STR);
        $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Redirection avec message de succès
        header('Location: employe_dashboard.php?message=success&action=Mettre%20à%20jour');
        exit;
    } catch (PDOException $e) {
        // En cas d'erreur, affichage d'un message d'erreur
        echo "Erreur : " . $e->getMessage();
    }
}