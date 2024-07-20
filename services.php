<?php
// Inclusion du fichier de connexion à la base de données
require_once 'connexion_bdd.php';

// Préparation de la requête SQL pour récupérer les services
$sql = "SELECT service_id, nom, description FROM service";
try {
    $stmt = $pdo->query($sql);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Zoo Arcadia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/services.css">
</head>
<body>
    <!-- En-tête de la page avec la barre de navigation -->
    <header class="banner-header">
        <nav>
            <ul class="nav-links">
                <li><a href="index.php" class="nav-item">Accueil</a></li>
                <li><a href="services.php" class="nav-item active">Services</a></li>
                <li><a href="habitats.php" class="nav-item">Habitats</a></li>
                <li><a href="connexion.html" class="nav-item">Connexion</a></li>
                <li><a href="contact.html" class="nav-item">Contact</a></li>
            </ul>
        </nav>
        <div class="banner-content">
            <h1><a href="index.php">Bienvenue au Zoo Arcadia</a></h1>
            <p>
                Explorez notre zoo, découvrez nos habitats et nos merveilleux animaux.
            </p>
        </div>
    </header>

    <!-- Section des services -->
    <section id="services">
        <div class="container">
            <h2>Nos Services</h2>
            <!-- Cartes pour chaque service -->
            <?php foreach ($services as $service): ?>
                <div class="service-item">
                    <div class="card">
                        <h3 class="service-title" id="<?php echo htmlspecialchars($service['service_id']); ?>">
                            <?php echo htmlspecialchars($service['nom']); ?>
                        </h3>
                        <div class="card-body">
                            <p class="service-description">
                                <?php echo htmlspecialchars($service['description']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Pied de page -->
    <footer>
        <p class="horaires">
            Horaires d'ouverture :<br />
            Lundi - Vendredi : 9h00 - 17h00 | Samedi - Dimanche : 10h00 - 18h00
        </p>
        <p class="copyright">&copy; 2024 Zoo Arcadia. Tous droits réservés.</p>
    </footer>
</body>
</html>