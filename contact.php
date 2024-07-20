<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page contact - Zoo Arcadia</title>
    <!-- Lien vers le fichier CSS externe -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <!-- En-tête de la page avec la barre de navigation -->
    <header class="banner-header">
      <nav>
        <ul class="nav-links">
          <li><a href="index.php" class="nav-item active">Accueil</a></li>
          <li><a href="services.php" class="nav-item">Services</a></li>
          <li><a href="habitats.php" class="nav-item">Habitats</a></li>
          <li><a href="connexion.php" class="nav-item">Connexion</a></li>
          <li><a href="contact.php" class="nav-item active">Contact</a></li>
        </ul>
      </nav>
      <div class="banner-content">
        <h1><a href="index.php">Bienvenue au Zoo Arcadia</a></h1>
        <p>
          Explorez notre zoo, découvrez nos habitats et nos merveilleux animaux.
        </p>
      </div>
    </header>

    <!-- Pied de page -->
    <footer>
    <p class="horaires">
        Horaires d'ouverture :
        <br />
        <?php
        // Code PHP pour récupérer et afficher les horaires
        include 'connexion_bdd.php';

        // Requête pour récupérer tous les horaires avec un ordre personnalisé des jours de la semaine
        $stmt = $pdo->query("
            SELECT 
                jour_semaine, 
                TO_CHAR(heure_debut, 'HH24:MI') AS heure_debut, -- Formatage de l'heure et des minutes (hh:mm)
                TO_CHAR(heure_fin, 'HH24:MI') AS heure_fin     -- Formatage de l'heure et des minutes (hh:mm)
            FROM horaires 
            ORDER BY 
                CASE 
                    WHEN jour_semaine = 'Lundi - Vendredi' THEN 1 
                    WHEN jour_semaine = 'Samedi - Dimanche' THEN 2 
                    ELSE 3 -- Pour gérer d'autres jours si nécessaire
                END
        ");

        // Affichage des horaires
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<p>' . $row['jour_semaine'] . ' : ' . $row['heure_debut'] . ' - ' . $row['heure_fin'] . '</p>';
        }
        ?>
    </p>
    <p class="copyright">&copy; <?php echo date('Y'); ?> Zoo Arcadia. Tous droits réservés.</p>
    </footer>
  </body>
</html>
