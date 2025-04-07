<?php
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
$etudiants = $db->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des Étudiants</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 40px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f9f9f9;
        }
        .details-icon {
            text-decoration: none;
            font-size: 18px;
            color: #007bff;
        }
        a {
            position: relative; /*revoir pour mettre lecriture au centre! */
        }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Liste des Étudiants</h2>
    <table>
        <tr>
            <th>id</th>
            <th>nom</th>
            <th>birthday</th>
            <th>détails</th>
        </tr>
        <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?= $etudiant['id'] ?></td>
            <td><?= htmlspecialchars($etudiant['nom']) ?></td>
            <td><?= $etudiant['birthday'] ?></td>
            <td>
                <!--detail Etudiant (page9) -->
                <!-- <a class="details-icon" href="detailEtudiant.php?id=<?= $etudiant['id'] ?>" title="Voir les détails">
                    🔵
                </a> -->
                <!--detail Etudiant avec prepared statements(page10) -->
                <a class="details-icon" href="detailEtudiantPrepStat.php?id=<?= $etudiant['id'] ?>" title="Voir les détails">
                    🔵
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="index.php">Retour a la page initiale</a><br>
</body>
</html>