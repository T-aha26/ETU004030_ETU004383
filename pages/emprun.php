<?php
require('../inc/connexion.php');
$id = $_GET['id'];

$emprunts = $connex->query("
    SELECT e.id_emprunt, o.nom_objet, e.date_emprunt 
    FROM ExamS2_emprunt e
    JOIN ExamS2_objet o ON e.id_objet = o.id_objet
    WHERE e.id_membre = $id AND e.date_retour IS NULL
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Objets empruntés</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h3>Objets empruntés</h3>
    <ul class="list-group">
    <?php while ($e = $emprunts->fetch_assoc()): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= $e['nom_objet'] ?> (<?= $e['date_emprunt'] ?>)
            <a href="retour.php?id_emprunt=<?= $e['id_emprunt'] ?>" class="btn btn-success btn-sm">Retourner</a>
        </li>
    <?php endwhile; ?>
    </ul>
</div>
</body>
</html>
