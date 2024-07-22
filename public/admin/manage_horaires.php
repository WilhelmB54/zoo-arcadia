<?php
session_start();
require_once 'connexion_bdd.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie quelle action a été sélectionnée (Créer, Mettre à jour, Supprimer)
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Récupère l'ID de l'horaire depuis le formulaire
        $horaire_id = isset($_POST['horaire_id']) ? $_POST['horaire_id'] : null;

        // Récupère les autres valeurs du formulaire
        $jour_semaine = $_POST['jour_semaine'];
        $heure_debut = $_POST['heure_debut'];
        $heure_fin = $_POST['heure_fin'];

        try {
            // Utilisation d'une switch pour traiter chaque action
            switch ($action) {
                case 'Créer':
                    $stmt = $pdo->prepare("INSERT INTO horaires (jour_semaine, heure_debut, heure_fin) VALUES (?, ?, ?)");
                    $stmt->execute([$jour_semaine, $heure_debut, $heure_fin]);
                    $_SESSION['message'] = "L'horaire a été créé avec succès.";
                    break;

                case 'Mettre à jour':
                    if ($horaire_id) {
                        $stmt = $pdo->prepare("UPDATE horaires SET jour_semaine = ?, heure_debut = ?, heure_fin = ? WHERE id = ?");
                        $stmt->execute([$jour_semaine, $heure_debut, $heure_fin, $horaire_id]);
                        $_SESSION['message'] = "L'horaire a été mis à jour avec succès.";
                    } else {
                        $_SESSION['message'] = "Identifiant de l'horaire non spécifié.";
                    }
                    break;

                case 'Supprimer':
                    if ($horaire_id) {
                        $stmt = $pdo->prepare("DELETE FROM horaires WHERE id = ?");
                        $stmt->execute([$horaire_id]);
                        $_SESSION['message'] = "L'horaire a été supprimé avec succès.";
                    } else {
                        $_SESSION['message'] = "Identifiant de l'horaire non spécifié.";
                    }
                    break;

                default:
                    $_SESSION['message'] = "Action non reconnue.";
                    break;
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "Erreur : " . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = "Action non spécifiée.";
    }

    // Redirection vers la page d'administration ou une autre page appropriée
    header('Location: admin_dashboard.php');
    exit;
}