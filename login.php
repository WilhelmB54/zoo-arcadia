<?php
// Informations de connexion à la base de données PostgreSQL
$host = 'localhost'; // Adresse du serveur PostgreSQL
$dbname = 'zoo_arcadia'; // Nom de votre base de données PostgreSQL
$user = 'postgres'; // Utilisateur PostgreSQL
$password = 'Rotarex140714!'; // Mot de passe PostgreSQL

// Connexion à la base de données PostgreSQL
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données PostgreSQL. ";
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données PostgreSQL : " . $e->getMessage());
}

// Validation des informations de connexion (username et password) reçues depuis un formulaire par exemple
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des informations d'identification dans la table utilisateur
    $query = "SELECT * FROM utilisateur WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérification du mot de passe hashé
        if (password_verify($password, $user['password'])) {
            echo "Connexion réussie pour l'utilisateur : " . $user['nom'] . " " . $user['prenom'];
            
            // Récupérer le rôle de l'utilisateur
            $roleQuery = "SELECT r.label FROM role r 
                          INNER JOIN possede p ON r.role_id = p.role_id 
                          WHERE p.username = :username";
            $roleStmt = $pdo->prepare($roleQuery);
            $roleStmt->bindParam(':username', $username, PDO::PARAM_STR);
            $roleStmt->execute();
            $role = $roleStmt->fetch(PDO::FETCH_ASSOC)['label'];
            
            // Rediriger l'utilisateur vers la page appropriée
            switch ($role) {
                case 'admin':
                    header("Location: dashboards/admin_dashboard.php");
                    break;
                case 'veterinaire':
                    header("Location: dashboards/veterinaire_dashboard.php");
                    break;
                case 'employe':
                    header("Location: dashboards/employe_dashboard.php");
                    break;
                default:
                    echo "Rôle utilisateur non reconnu.";
                    break;
            }
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }
}

// Fermeture de la connexion à la base de données
$pdo = null;
