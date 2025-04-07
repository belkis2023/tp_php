<?php
if (!isset($_GET['id'])) {
    echo "ID manquant.";
    exit;
}

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
$stmt = $db->prepare("SELECT * FROM student WHERE id = ?");
$stmt->execute([$_GET['id']]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    echo "Étudiant non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détails Étudiant</title>
    <style>
        .card {
            width: 300px;
            margin: 100px auto;
            border-left: 4px solid #007bff;
            padding: 20px;
            font-family: Arial, sans-serif;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .card h2 {
            margin: 0 0 10px;
        }
        .card p {
            margin: 5px 0;
        }
        .breadcrumb {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Détail Etudiant</h2>
    <div class="card">
        <div class="breadcrumb"><?= htmlspecialchars($etudiant['nom']) ?> &gt;</div>
        <p><strong>Nom :</strong> <?= htmlspecialchars($etudiant['nom']) ?></p>
        <p><strong>Date de naissance :</strong> <?= $etudiant['birthday'] ?></p>
    </div>

    <a href="ListeEtudiants.php">Retour a la page précédente</a><br>
</body>
</html>