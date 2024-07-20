<?php
// manage_habitats.php
require_once 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $habitat_id = isset($_POST['habitat_id']) ? $_POST['habitat_id'] : null;
    $habitat_nom = $_POST['habitat_nom'];
    $habitat_description = $_POST['habitat_description'];
    $action = $_POST['action'];

    try {
        switch ($action) {
            case 'Créer':
                $stmt = $pdo->prepare("INSERT INTO habitat (nom, description) VALUES (?, ?)");
                $stmt->execute([$habitat_nom, $habitat_description]);
                $_SESSION['message'] = "Habitat créé avec succès.";
                break;

            case 'Mettre à jour':
                if ($habitat_id) {
                    $stmt = $pdo->prepare("UPDATE habitat SET nom = ?, description = ? WHERE habitat_id = ?");
                    $stmt->execute([$habitat_nom, $habitat_description, $habitat_id]);
                    $_SESSION['message'] = "Habitat mis à jour avec succès.";
                } else {
                    $_SESSION['message'] = "ID de l'habitat non spécifié pour la mise à jour.";
                }
                break;

            case 'Supprimer':
                if ($habitat_id) {
                    $stmt = $pdo->prepare("DELETE FROM habitat WHERE habitat_id = ?");
                    $stmt->execute([$habitat_id]);
                    $_SESSION['message'] = "Habitat supprimé avec succès.";
                } else {
                    $_SESSION['message'] = "ID de l'habitat non spécifié pour la suppression.";
                }
                break;

            default:
                $_SESSION['message'] = "Action non reconnue.";
                break;
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erreur : ' . $e->getMessage();
    }

    // Redirection vers une autre page après traitement
    header('Location: admin_dashboard.php');
    exit;
}