<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page habitats - Zoo Arcadia</title>
    <!-- Lien vers le fichier CSS externe -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/habitats.css" />
  </head>

  <body>
    <!-- En-tête de la page avec la barre de navigation -->
    <header class="banner-header">
      <nav>
        <ul class="nav-links">
          <li><a href="index.php" class="nav-item">Accueil</a></li>
          <li><a href="services.php" class="nav-item">Services</a></li>
          <li><a href="habitats.php" class="nav-item active">Habitats</a></li>
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

    <main>
      <section id="habitats">
        <h2>Nos Habitats</h2>
        <div id="habitatsContainer" class="habitats-container">
          <!-- Les cartes des habitats seront ajoutées ici dynamiquement -->
        </div>
      </section>

      <section id="habitatDetails" class="hidden">
        <!-- Les détails de l'habitat sélectionné et les informations sur les animaux seront affichés ici -->
      </section>
    </main>

    <!-- Pied de page -->
    <footer>
      <p class="horaires">
        Horaires d'ouverture :
        <br />
        Lundi - Vendredi : 9h00 - 17h00 | Samedi - Dimanche : 10h00 - 18h00
      </p>
      <p class="copyright">&copy; 2024 Zoo Arcadia. Tous droits réservés.</p>
    </footer>
    <script src="js/habitats.js"></script>
  </body>
</html>
