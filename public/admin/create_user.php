<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement du formulaire de création de compte

    // Inclure le fichier de connexion à la base de données
    require_once 'connexion_bdd.php';

    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Préparation de la requête SQL pour insérer l'utilisateur
    $sql = "INSERT INTO utilisateur (username, password, nom, prenom) VALUES (:username, :password, :nom, :prenom)";

    try {
        // Préparation de la requête
        $stmt = $pdo->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);

        // Exécution de la requête
        $stmt->execute();

        // Message de succès
        $_SESSION['message'] = "Le compte a bien été créé.<br> Un e-mail a été envoyé à l'adresse $username";

        // Envoi de l'e-mail
        $to = $username;
        $subject = "Confirmation de création de compte";
        $message = "Bonjour $prenom,\n\nVotre compte sur Zoo Arcadia a bien été créé.\n\nVotre username est : $username.\n\nPour obtenir votre mot de passe, veuillez contacter l'administrateur.\n\nCordialement,\nL'équipe Zoo Arcadia";

        // En-têtes
        $headers = 'From: josedubois842@gmail.com' . "\r\n" .
                   'Reply-To: josedubois842@gmail.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        // Envoi de l'e-mail
        mail($to, $subject, $message, $headers);

        // Redirection vers la même page
        header("Location: create_user.php");
        exit;
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
    }
}

// Inclure le formulaire HTML pour créer un utilisateur
include 'admin_dashboard.php';