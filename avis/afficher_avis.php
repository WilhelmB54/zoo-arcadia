<?php
// Inclure le fichier de connexion à la base de données
require_once('connexion.php');

try {
    // Préparer la requête SQL pour récupérer les avis
    $stmt = $pdo->prepare('SELECT pseudo, commentaire FROM avis WHERE isVisible = true');
    $stmt->execute();

    // Récupérer tous les résultats de la requête
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Gérer les erreurs de connexion ou de requête SQL
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    exit();
}
?>

<!-- Intégration dans votre page HTML -->
<section id="avis">
    <h2>Avis du Zoo</h2>
    <div class="grid-container">
        <?php foreach ($avis as $a) : ?>
        <div class="avis">
            <p><?= htmlspecialchars($a['commentaire']) ?></p>
            <p class="auteur">- <?= htmlspecialchars($a['pseudo']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>
