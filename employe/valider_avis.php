<?php
// Inclusion du fichier de connexion à la base de données
require_once 'connexion_bdd.php'; 

// Vérification de la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $avis_id = $_POST['avis_id'];
    $action = $_POST['action']; // 'Valider' ou 'Invalider'

    // Initialisation de $sql pour éviter les erreurs de variable non définie
    $sql = "";

    // Préparation de la requête SQL en fonction de l'action
    if ($action == 'Valider') {
        $sql = "UPDATE avis SET isvisible = true WHERE avis_id = :avis_id";
    } elseif ($action == 'Invalider') {
        $sql = "UPDATE avis SET isvisible = false WHERE avis_id = :avis_id";
    } else {
        // Gestion d'un cas où l'action n'est pas valide
        echo "Action non valide.";
        exit; // Arrête le script si l'action n'est pas valide
    }

    // Vérifiez si $sql est vide pour éviter l'erreur de préparation de PDO
    if (!empty($sql)) {
        // Préparation et exécution de la requête SQL
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':avis_id', $avis_id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Définir l'action pour la redirection
            $action_param = ($action == 'Valider') ? 'Valider' : 'Invalider';
            
            // Redirection vers une page de succès avec le bon message d'action
            header('Location: employe_dashboard.php?message=success&action=' . $action_param);
            exit;
        } catch (PDOException $e) {
            // En cas d'erreur, affichage d'un message d'erreur
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        // Cas où $sql est vide
        echo "Erreur : Action non définie correctement.";
    }
}