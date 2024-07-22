<?php
// Inclusion du fichier de connexion à la base de données
require_once 'connexion_bdd.php';

// Initialisation des variables
$success = 0;
$action = '';

// Vérifier si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $animal_id_rapport = isset($_POST['animal_id_rapport']) ? trim($_POST['animal_id_rapport']) : '';
    $date_rapport = isset($_POST['date_rapport']) ? trim($_POST['date_rapport']) : '';
    $detail_rapport = isset($_POST['detail_rapport']) ? trim($_POST['detail_rapport']) : '';

    // Validation des données
    if (empty($animal_id_rapport) || empty($date_rapport) || empty($detail_rapport)) {
        $message = 'Tous les champs sont requis.';
    } elseif (!is_numeric($animal_id_rapport)) {
        $message = 'L\'ID de l\'animal doit être un nombre.';
    } else {
        // Préparation de la requête SQL pour insérer le rapport dans la base de données
        $sql = "INSERT INTO rapport_veterinaire (date, detail) VALUES (:date_rapport, :detail_rapport)";

        try {
            // Préparation de la requête
            $stmt = $pdo->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':date_rapport', $date_rapport);
            $stmt->bindParam(':detail_rapport', $detail_rapport);

            // Exécution de la requête
            $stmt->execute();

            // Récupération de l'ID du rapport inséré
            $rapport_veterinaire_id = $pdo->lastInsertId();

            // Insertion dans la table obtient pour associer le rapport à l'animal
            $sql_obtient = "INSERT INTO obtient (rapport_veterinaire_id, animal_id) VALUES (:rapport_veterinaire_id, :animal_id)";

            // Préparation de la requête
            $stmt_obtient = $pdo->prepare($sql_obtient);

            // Liaison des paramètres
            $stmt_obtient->bindParam(':rapport_veterinaire_id', $rapport_veterinaire_id, PDO::PARAM_INT);
            $stmt_obtient->bindParam(':animal_id', $animal_id_rapport, PDO::PARAM_INT);

            // Exécution de la requête
            $stmt_obtient->execute();

            // Message de succès
            $success = 1;
            $action = 'Ajouter';
        } catch (PDOException $e) {
            $message = 'Erreur lors de l\'insertion du rapport : ' . $e->getMessage();
        }
    }

    // Redirection vers la page de tableau de bord avec les paramètres appropriés
    header('Location: veterinaire_dashboard.php?success=' . $success . '&action=' . $action . (isset($message) ? '&message=' . urlencode($message) : ''));
    exit();
}