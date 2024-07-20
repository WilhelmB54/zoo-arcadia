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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page d'accueil - Zoo Arcadia</title>
    <!-- Lien vers le fichier CSS externe -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/index.css" />
</head>

<body>
    <!-- En-tête de la page avec la barre de navigation -->
    <header class="banner-header">
        <nav>
            <ul class="nav-links">
                <li><a href="index.php" class="nav-item active">Accueil</a></li>
                <li><a href="services.php" class="nav-item">Services</a></li>
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

    <!-- Section des habitats -->
    <section id="habitats">
        <h2><a href="habitats.html">Nos Habitats</a></h2>
        <div class="habitats-container">
            <div class="habitat">
                <img src="images/habitats/savane.jpg" alt="Habitat Savane" />
                <h3><a href="habitats.html#savane" class="habitat-link">Savane</a></h3>
                <p>La savane du Zoo Arcadia abrite une variété d'animaux africains, tels que les lions, les girafes et les éléphants.</p>
            </div>
            <div class="habitat">
                <img src="images/habitats/jungle.jpg" alt="Habitat Jungle" />
                <h3><a href="habitats.html#jungle" class="habitat-link">Jungle</a></h3>
                <p>La jungle est une zone dense et luxuriante où vivent des animaux tropicaux comme les singes, les perroquets et les reptiles.</p>
            </div>
            <div class="habitat">
                <img src="images/habitats/marais.jpg" alt="Habitat Marais" />
                <h3><a href="habitats.html#marais" class="habitat-link">Marais</a></h3>
                <p>Le marais est un écosystème humide qui accueille des espèces adaptées à l'eau, comme les crocodiles, les hérons et les tortues.</p>
            </div>
        </div>
    </section>

    <!-- Section des animaux -->
    <section id="animaux">
        <h2>Nos Animaux</h2>
        <div class="card">
            <img src="images/animals/Lion.jpg" alt="Lion" />
            <h3>Lion</h3>
            <p>Les lions sont les rois de la savane. Ils vivent en groupes appelés "fiertés" et sont connus pour leur puissance et leur majesté.</p>
        </div>
        <div class="card">
            <img src="images/animals/Perroquet.jpg" alt="Perroquet" />
            <h3>Perroquet</h3>
            <p>Les perroquets sont des oiseaux colorés et sociaux que l'on trouve principalement dans les forêts tropicales.</p>
        </div>
        <div class="card">
            <img src="images/animals/Crocodile.jpg" alt="Crocodile" />
            <h3>Crocodile</h3>
            <p>Les crocodiles sont des reptiles semi-aquatiques connus pour leur apparence préhistorique et leur redoutable puissance.</p>
        </div>
        <div class="card">
            <img src="images/animals/tigre.jpg" alt="Tigre" />
            <h3>Tigre</h3>
            <p>Les tigres sont des prédateurs majestueux qui vivent principalement dans les forêts d'Asie.</p>
        </div>
        <div class="card">
            <img src="images/animals/panda.jpg" alt="Panda" />
            <h3>Panda</h3>
            <p>Les pandas géants sont des symboles emblématiques de la conservation de la faune.</p>
        </div>
    </section>

    <!-- Section des services -->
    <section id="services">
        <h2><a href="services.php">Nos Services</a></h2>
        <?php foreach ($services as $service): ?>
            <div class="card">
                <h3><a href="services.php#<?php echo htmlspecialchars($service['service_id']); ?>">
                    <?php echo htmlspecialchars($service['nom']); ?>
                </a></h3>
                <p><?php echo htmlspecialchars($service['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Section des avis -->
    <?php include 'avis/afficher_avis.php'; ?>

    <section id="laissez-un-avis">
        <h2>Laissez un avis</h2>
        <form id="avisForm" action="avis/submit_avis.php" method="POST">
            <div class="form-group">
                <label for="pseudo">Pseudo :</label>
                <input type="text" id="pseudo" name="pseudo" required />
            </div>
            <div class="form-group">
                <label for="commentaire">Votre avis :</label>
                <textarea id="commentaire" name="commentaire" rows="4" required></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </section>

    <!-- Pied de page -->
    <footer>
        <p class="horaires">
            Horaires d'ouverture :
            <br />
            Lundi - Vendredi : 9h00 - 17h00 | Samedi - Dimanche : 10h00 - 18h00
        </p>
        <p class="copyright">&copy; 2024 Zoo Arcadia. Tous droits réservés.</p>
    </footer>
</body>
</html>
