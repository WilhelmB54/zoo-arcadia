<?php
// Inclusion du fichier de connexion à la base de données
require_once 'connexion_bdd.php';

// Vérification de la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $animal_id = $_POST['animal_id'];
    $nourriture_id = $_POST['nourriture_id'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $quantite = $_POST['quantite'];

    // Préparation de la requête SQL
    $sql = "INSERT INTO consommation (animal_id, nourriture_id, date, heure, quantite) 
            VALUES (:animal_id, :nourriture_id, :date, :heure, :quantite)";

    // Préparation et exécution de la requête SQL
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
        $stmt->bindParam(':nourriture_id', $nourriture_id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':heure', $heure, PDO::PARAM_STR);
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_STR);
        $stmt->execute();
        
        // Redirection vers une page de succès ou retour à la page précédente
        header('Location: employe_dashboard.php?message=success&action=Ajouter');
        exit;
    } catch (PDOException $e) {
        // En cas d'erreur, affichage d'un message d'erreur
        echo "Erreur : " . $e->getMessage();
    }
}