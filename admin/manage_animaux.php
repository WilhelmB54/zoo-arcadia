<?php
// manage_animaux.php
include 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $animal_id = isset($_POST['animal_id']) ? $_POST['animal_id'] : null;
    $animal_prenom = isset($_POST['animal_prenom']) ? $_POST['animal_prenom'] : null;
    $animal_etat = isset($_POST['animal_etat']) ? $_POST['animal_etat'] : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    try {
        if ($action == 'Créer') {
            if ($animal_id) {
                // ID ne doit pas être spécifié lors de la création
                echo "Erreur : L'ID ne doit pas être spécifié lors de la création.";
                exit;
            } else {
                $stmt = $pdo->prepare("INSERT INTO animal (prenom, etat) VALUES (?, ?)");
                $stmt->execute([$animal_prenom, $animal_etat]);
            }
        } elseif ($action == 'Mettre à jour') {
            if ($animal_id && $animal_prenom) {
                $stmt = $pdo->prepare("UPDATE animal SET prenom = ?, etat = ? WHERE animal_id = ?");
                $stmt->execute([$animal_prenom, $animal_etat, $animal_id]);
            } else {
                echo "Erreur : ID et prénom sont requis pour la mise à jour.";
                exit;
            }
        } elseif ($action == 'Supprimer') {
            if ($animal_id) {
                $stmt = $pdo->prepare("DELETE FROM animal WHERE animal_id = ?");
                $stmt->execute([$animal_id]);
            } else {
                echo "Erreur : ID requis pour la suppression.";
                exit;
            }
        } else {
            echo "Erreur : Action non reconnue.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
        exit;
    }
    
    // Redirection vers le formulaire après l'action
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
