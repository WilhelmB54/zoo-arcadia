<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Employé - Zoo Arcadia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/connexion.css">
</head>

<body>
    <div class="container">
        <h2>Espace Employé</h2>
        
        <!-- Formulaire pour valider/invalider les avis -->
        <div class="section">
            <h3>Validation des avis</h3>
            <form action="valider_avis.php" method="post">
                <label for="avis_id">ID de l'avis :</label>
                <input type="number" id="avis_id" name="avis_id" required>
                <input type="submit" name="action" value="Valider">
                <input type="submit" name="action" value="Invalider">
            </form>
        </div>

        <?php
        // Vérifier si un message de succès est présent dans l'URL
        if (isset($_GET['message']) && $_GET['message'] === 'success') {
            // Vérifier l'action effectuée (Valider ou Invalider)
            $action = isset($_GET['action']) ? $_GET['action'] : '';
            if ($action === 'Valider') {
                $confirmation_message = 'L\'avis a été validé avec succès.';
            } elseif ($action === 'Invalider') {
                $confirmation_message = 'L\'avis a été invalidé avec succès.';
            }

            // Afficher le message de confirmation
            if (isset($confirmation_message)) {
                echo '<div class="success-message">' . htmlspecialchars($confirmation_message) . '</div>';
            }
        }
        ?>

        <!-- Formulaire pour modifier les services -->
        <div class="section">
            <h3>Modifier un service</h3>
            <form action="modifier_services.php" method="post">
                <label for="service_id">ID du service :</label>
                <input type="number" id="service_id" name="service_id" required>
                <label for="service_nom">Nom du service :</label>
                <input type="text" id="service_nom" name="service_nom" required>
                <label for="service_description">Description :</label>
                <input type="text" id="service_description" name="service_description" required>
                <input type="submit" value="Mettre à jour">
            </form>
        </div>

        <?php
        // Vérifier si un message de succès est présent dans l'URL
        if (isset($_GET['message']) && $_GET['message'] === 'success') {
            // Vérifier l'action effectuée
            $action = isset($_GET['action']) ? $_GET['action'] : '';

            // Message de confirmation par défaut
            $confirmation_message = '';

            // Déterminer le message en fonction de l'action
            switch ($action) {
                case 'Mettre à jour':
                    $confirmation_message = 'La mise à jour a été prise en compte.';
                    break;
            }

            // Afficher le message de confirmation
            if (!empty($confirmation_message)) {
                echo '<div class="success-message">' . htmlspecialchars($confirmation_message) . '</div>';
            }
        }
        ?>

        <!-- Formulaire pour ajouter une consommation de nourriture -->
        <div class="section">
            <h3>Ajouter une consommation</h3>
            <form action="ajouter_consommation.php" method="post">
                <label for="animal_id">ID de l'animal :</label>
                <input type="number" id="animal_id" name="animal_id" required>
                <label for="nourriture_id">ID de la nourriture :</label>
                <input type="number" id="nourriture_id" name="nourriture_id" required>
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" required>
                <label for="heure">Heure :</label>
                <input type="time" id="heure" name="heure" required>
                <label for="quantite">Quantité :</label>
                <input type="number" step="0.01" id="quantite" name="quantite" required>
                <input type="submit" value="Ajouter">
            </form>
        </div>

        <?php
        // Vérifier si un message de succès est présent dans l'URL
        if (isset($_GET['message']) && $_GET['message'] === 'success') {
            // Vérifier l'action effectuée
            $action = isset($_GET['action']) ? $_GET['action'] : '';

            // Message de confirmation par défaut
            $confirmation_message = '';

            // Déterminer le message en fonction de l'action
            if ($action === 'Ajouter') {
                $confirmation_message = 'L\'ajout a été pris en compte.';
            }

            // Afficher le message de confirmation
            if (!empty($confirmation_message)) {
                echo '<div class="success-message">' . htmlspecialchars($confirmation_message) . '</div>';
            }
        }
        ?>

    </div>
</body>
</html>
