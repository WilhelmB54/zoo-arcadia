<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur - Zoo Arcadia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/connexion.css">
</head>
<body>
    <div class="container">
        <h2>Espace Administrateur</h2>
        
        <!-- Formulaire de création de compte utilisateur -->
        <div class="section">
            <h3>Créer un compte utilisateur</h3>

        <?php
        if (isset($_SESSION['message'])) {
            $messageClass = strpos($_SESSION['message'], 'Erreur') === 0 ? 'error-message' : 'success-message';
            echo '<p class="' . $messageClass . '">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
        }
        ?>

            <form action="create_user.php" method="post">
                <label for="username">Adresse e-mail (username) :</label>
                <input type="email" id="username" name="username" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>

                <label for="role">Type de compte :</label>
                <select id="role" name="role" required>
                    <option value="veterinaire">Vétérinaire</option>
                    <option value="employe">Employé</option>
                </select>

                <input type="submit" value="Créer le compte">
            </form>
        </div>

        <!-- Formulaire de gestion des services -->
        <div class="section">
            <h3>Gestion des services</h3>
            <form action="manage_services.php" method="post">
                <label for="service_id">ID du service :</label>
                <input type="number" id="service_id" name="service_id">

                <label for="service_nom">Nom du service :</label>
                <input type="text" id="service_nom" name="service_nom">

                <label for="service_description">Description :</label>
                <input type="text" id="service_description" name="service_description">

                <input type="submit" name="action" value="Créer">
                <input type="submit" name="action" value="Mettre à jour">
                <input type="submit" name="action" value="Supprimer">
            </form>
        </div>

        <!-- Formulaire de gestion des horaires -->
        <div class="section">
            <h3>Gestion des horaires</h3>
            <form action="manage_horaires.php" method="post">
                <label for="horaire_id">ID de l'horaire :</label>
                <input type="number" id="horaire_id" name="horaire_id">

                <label for="jour_semaine">Jour de la semaine :</label>
                <select id="jour_semaine" name="jour_semaine">
                    <option value="Lundi">Lundi</option>
                    <option value="Mardi">Mardi</option>
                    <option value="Mercredi">Mercredi</option>
                    <option value="Jeudi">Jeudi</option>
                    <option value="Vendredi">Vendredi</option>
                    <option value="Samedi">Samedi</option>
                    <option value="Dimanche">Dimanche</option>
                </select>

                <label for="heure_debut">Heure de début :</label>
                <input type="time" id="heure_debut" name="heure_debut">

                <label for="heure_fin">Heure de fin :</label>
                <input type="time" id="heure_fin" name="heure_fin">

                <!-- Boutons d'action -->
                <input type="submit" name="action" value="Créer">
                <input type="submit" name="action" value="Mettre à jour">
                <input type="submit" name="action" value="Supprimer">
            </form>
        </div>

        <!-- Formulaire de gestion des habitats -->
        <div class="section">
            <h3>Gestion des habitats</h3>
            <form action="manage_habitats.php" method="post">
                <label for="habitat_id">ID de l'habitat :</label>
                <input type="number" id="habitat_id" name="habitat_id">

                <label for="habitat_nom">Nom de l'habitat :</label>
                <input type="text" id="habitat_nom" name="habitat_nom">

                <label for="habitat_description">Description :</label>
                <input type="text" id="habitat_description" name="habitat_description">

                <input type="submit" name="action" value="Créer">
                <input type="submit" name="action" value="Mettre à jour">
                <input type="submit" name="action" value="Supprimer">
            </form>
        </div>

        <!-- Formulaire de gestion des animaux -->
        <div class="section">
            <h3>Gestion des animaux</h3>
            <form action="manage_animaux.php" method="post">
                <label for="animal_id">ID de l'animal :</label>
                <input type="number" id="animal_id" name="animal_id">

                <label for="animal_prenom">Prénom de l'animal :</label>
                <input type="text" id="animal_prenom" name="animal_prenom">

                <label for="animal_etat">État :</label>
                <input type="text" id="animal_etat" name="animal_etat">

                <!-- Boutons d'action -->
                <input type="submit" name="action" value="Créer">
                <input type="submit" name="action" value="Mettre à jour">
                <input type="submit" name="action" value="Supprimer">
            </form>
        </div>

        <!-- Formulaire de gestion des comptes rendus vétérinaires -->
        <div class="section">
            <h3>Gestion des comptes rendus vétérinaires</h3>
            <form action="" method="post">
                <label for="animal_filter">Filtrer par animal :</label>
                <select id="animal_filter" name="animal_filter">
                    <option value="">Tous les animaux</option>
                    <?php
                    // Connexion à la base de données et récupération des animaux
                    include 'connexion_bdd.php';
                    $stmt = $pdo->query("SELECT prenom FROM animal");
                    $animaux = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    foreach ($animaux as $animal) {
                        echo '<option value="' . htmlspecialchars($animal) . '"' .
                             (isset($_POST['animal_filter']) && $_POST['animal_filter'] == $animal ? ' selected' : '') .
                             '>' . htmlspecialchars($animal) . '</option>';
                    }
                    ?>
                </select>

                <label for="date_filter">Filtrer par date :</label>
                <input type="date" id="date_filter" name="date_filter" 
                    value="<?php echo isset($_POST['date_filter']) ? htmlspecialchars($_POST['date_filter']) : ''; ?>">

                <input type="submit" value="Filtrer">
            </form>

            <!-- Tableau des comptes rendus vétérinaires -->
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Animal</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody id="rapports-tbody">
                    <?php
                    // Affichage des comptes rendus vétérinaires filtrés
                    include 'manage_rapports.php';
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
