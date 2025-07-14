<?php
require('../inc/connexion.php');


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID membre invalide.");
}

$id_membre = intval($_GET['id']);


$query = "
    SELECT etat_retour, COUNT(*) as total
    FROM ExamS2_emprunt e
    JOIN ExamS2_objet o ON e.id_objet = o.id_objet
    WHERE o.id_membre = ?
    AND e.date_retour IS NOT NULL
    GROUP BY etat_retour
";

$stmt = $connex->prepare($query);
$stmt->bind_param("i", $id_membre);
$stmt->execute();
$result = $stmt->get_result();

$ok = 0;
$abimes = 0;

while ($row = $result->fetch_assoc()) {
    if (strtolower($row['etat_retour']) === 'ok') {
        $ok = $row['total'];
    } elseif (strtolower($row['etat_retour']) === 'abime' || strtolower($row['etat_retour']) === 'abîmé') {
        $abimes = $row['total'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Statut des retours</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            min-height: 100vh;
        }
        .container {
            background: white;
            color: #333;
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }
        h2 {
            color: #6a11cb;
        }
        .btn-violet {
            background-color: #6a11cb;
            color: white;
            border: none;
        }
        .btn-violet:hover {
            background-color: #5c0eb4;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h2 class="mb-4">Statut des objets retournés</h2>
        <p class="fs-5">Nombre d'objets retournés :</p>
        <ul class="list-group mb-4">
            <li class="list-group-item"> En bon état : <strong><?= $ok ?></strong></li>
            <li class="list-group-item"> Abîmés : <strong><?= $abimes ?></strong></li>
        </ul>
        <a href="fiche_membre.php?id=<?= $id_membre ?>" class="btn btn-violet">← Retour à la fiche membre</a>
    </div>
</body>
</html>
