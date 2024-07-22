<?php
session_start(); // Démarrer la session pour gérer les messages

// Inclure le fichier de connexion à la base de données
include 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $service_id = $_POST['service_id'];
    $service_nom = $_POST['service_nom'];
    $service_description = $_POST['service_description'];
    $action = $_POST['action'];

    try {
        if ($action == 'Créer') {
            // Vérifier si le service existe déjà (en fonction du nom ici)
            $stmt_check = $pdo->prepare("SELECT COUNT(*) AS count FROM service WHERE nom = ?");
            $stmt_check->execute([$service_nom]);
            $row = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($row['count'] > 0) {
                $_SESSION['message'] = 'Erreur : Un service avec ce nom existe déjà.';
            } else {
                // Insérer le nouveau service
                $stmt = $pdo->prepare("INSERT INTO service (nom, description) VALUES (?, ?)");
                $stmt->execute([$service_nom, $service_description]);
                $_SESSION['message'] = 'Service créé avec succès.';
            }
        } elseif ($action == 'Mettre à jour') {
            // Mettre à jour le service en fonction de l'ID
            $stmt = $pdo->prepare("UPDATE service SET nom = ?, description = ? WHERE service_id = ?");
            $stmt->execute([$service_nom, $service_description, $service_id]);
            $_SESSION['message'] = 'Service mis à jour avec succès.';
        } elseif ($action == 'Supprimer') {
            // Supprimer le service en fonction de l'ID
            $stmt = $pdo->prepare("DELETE FROM service WHERE service_id = ?");
            $stmt->execute([$service_id]);
            $_SESSION['message'] = 'Service supprimé avec succès.';
        }

        // Redirection vers la page d'origine ou une autre page après l'action
        header("Location: admin_dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}