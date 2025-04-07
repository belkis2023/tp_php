<?php
// Vérification de la présence de l'ID dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Identifiant invalide.";
    exit;
}

// Connexion PDO avec gestion d'erreurs
$host = "sql7.freesqldatabase.com";
$dbname = "sql7771682";
$username = "sql7771682";
$password = "xLXUvGjaRB";
$port = "3306";
try {
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
$db = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
} catch (PDOException $e) {
die("Erreur de connexion : " . $e->getMessage());
}

// Utilisation d'un prepared statement securise
$id = intval($_GET['id']);
$stmt = $db->prepare("SELECT * FROM student WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

// Gestion du cas où l'étudiant n'existe pas
if (!$etudiant) {
    echo "Étudiant non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail Étudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .card {
            width: 300px;
            margin: 100px auto;
            border-left: 4px solid #007bff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .breadcrumb {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }
        .card p {
            margin: 5px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Détail Etudiant avec  prepared statements
    </h2>
    <div class="card">
        <div class="breadcrumb"><?= htmlspecialchars($etudiant['nom']) ?> &gt;</div>
        <p><strong>Nom :</strong> <?= htmlspecialchars($etudiant['nom']) ?></p>
        <p><strong>Date de naissance :</strong> <?= $etudiant['birthday'] ?></p>
    </div>
    <a href="ListeEtudiants.php">Retour a la page précédente</a><br>

</body>
</html>