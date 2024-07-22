<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Vétérinaire - Zoo Arcadia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/connexion.css">
</head>
<body>
    <div class="container">
        <h2>Espace Vétérinaire</h2>
        
        <!-- Formulaire pour remplir le rapport vétérinaire -->
        <div class="section">
            <h3>Rapport Vétérinaire</h3>
            <form action="traiter_rapport.php" method="post">
                <label for="animal_id_rapport">ID de l'animal :</label>
                <input type="number" id="animal_id_rapport" name="animal_id_rapport" required>
                
                <label for="date_rapport">Date du rapport :</label>
                <input type="date" id="date_rapport" name="date_rapport" required>
                
                <label for="detail_rapport">Détails du rapport :</label>
                <textarea id="detail_rapport" name="detail_rapport" rows="4" required></textarea>
                
                <input type="submit" value="Soumettre rapport">
            </form>
        </div>

        <?php
        // Vérifier si un message de succès est présent dans l'URL
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            // Vérifier l'action effectuée
            $action = isset($_GET['action']) ? $_GET['action'] : '';

            // Message de confirmation par défaut
            $confirmation_message = '';

            // Déterminer le message en fonction de l'action
            if ($action === 'Ajouter') {
                $confirmation_message = 'Le rapport a bien été soumis.';
            }

            // Afficher le message de confirmation
            if (!empty($confirmation_message)) {
                echo '<div class="success-message">' . htmlspecialchars($confirmation_message) . '</div>';
            }
        }
        ?>

        <!-- Formulaire pour remplir le commentaire sur l'habitat -->
        <div class="section">
            <h3>Commentaire sur l'habitat</h3>
            <form action="traiter_commentaire_habitat.php" method="post">
                <label for="habitat_id_commentaire">ID de l'habitat :</label>
                <input type="number" id="habitat_id_commentaire" name="habitat_id_commentaire" required>
                
                <label for="commentaire_habitat">Commentaire sur l'habitat :</label>
                <textarea id="commentaire_habitat" name="commentaire_habitat" rows="4" required></textarea>
                
                <input type="submit" value="Soumettre commentaire">
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
            if ($action === 'Modifier') {
                $confirmation_message = 'Le commentaire sur l\'habitat a été modifié.';
            }

            // Afficher le message de confirmation
            if (!empty($confirmation_message)) {
                echo '<div class="success-message">' . htmlspecialchars($confirmation_message) . '</div>';
            }
        }
        ?>

        <!-- Affichage des consommations par Animal -->
        <div class="section">
            <h3>Consommation de nourriture par animal</h3>
            <table>
                <thead>
                    <tr>
                        <th>Animal</th>
                        <th>Nourriture</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Quantité (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Inclusion du fichier de connexion à la base de données
                    require_once 'connexion_bdd.php';

                    // Requête SQL pour récupérer les consommations par animal
                    $sql = "SELECT a.prenom AS animal, n.label AS nourriture, c.date, c.heure, c.quantite
                            FROM consommation c
                            INNER JOIN animal a ON c.animal_id = a.animal_id
                            INNER JOIN nourriture n ON c.nourriture_id = n.nourriture_id
                            ORDER BY c.date DESC, c.heure DESC";

                    try {
                        // Exécution de la requête SQL
                        $stmt = $pdo->query($sql);

                        // Affichage des résultats
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['animal']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nourriture']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['heure']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['quantite']) . "</td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
