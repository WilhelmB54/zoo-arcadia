<?php
// Inclure la connexion à la base de données
include 'connexion_bdd.php';

// Initialiser les variables de filtrage
$animal_filter = isset($_POST['animal_filter']) ? $_POST['animal_filter'] : '';
$date_filter = isset($_POST['date_filter']) ? $_POST['date_filter'] : '';

try {
    // Préparer la requête SQL
    $query = "SELECT rv.date, a.prenom, rv.detail
              FROM rapport_veterinaire rv
              JOIN obtient o ON rv.rapport_veterinaire_id = o.rapport_veterinaire_id
              JOIN animal a ON o.animal_id = a.animal_id
              WHERE 1 = 1";

    // Ajouter des conditions en fonction des filtres
    if (!empty($animal_filter)) {
        $query .= " AND a.prenom = :animal";
    }

    if (!empty($date_filter)) {
        $query .= " AND rv.date = :date";
    }

    $stmt = $pdo->prepare($query);

    // Lier les paramètres si nécessaire
    if (!empty($animal_filter)) {
        $stmt->bindParam(':animal', $animal_filter);
    }

    if (!empty($date_filter)) {
        $stmt->bindParam(':date', $date_filter);
    }

    $stmt->execute();
    $rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats
    foreach ($rapports as $rapport) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($rapport['date']) . "</td>";
        echo "<td>" . htmlspecialchars($rapport['prenom']) . "</td>";
        echo "<td>" . htmlspecialchars($rapport['detail']) . "</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="3">Erreur : ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
}