<?php
require('../inc/connexion.php');
$id = intval($_GET['id']);

$objet = $connex->query("SELECT o.*, c.nom_categorie, m.nom AS proprietaire
                         FROM ExamS2_objet o
                         JOIN ExamS2_categorie_objet c ON o.id_categorie = c.id_categorie
                         JOIN ExamS2_membre m ON o.id_membre = m.id_membre
                         WHERE id_objet = $id")->fetch_assoc();

$images = $connex->query("SELECT * FROM ExamS2_image_objet WHERE id_objet = $id");
$historique = $connex->query("SELECT e.*, m.nom FROM ExamS2_emprunt e JOIN ExamS2_membre m ON m.id_membre = e.id_membre WHERE id_objet = $id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fiche objet</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="p-4">
<div class="container">
    <h2 class="text-violet"><?= htmlspecialchars($objet['nom_objet']) ?></h2>
    <p><strong>Catégorie :</strong> <?= $objet['nom_categorie'] ?></p>
    <p><strong>Propriétaire :</strong> <?= $objet['proprietaire'] ?></p>
    <p><?= nl2br(htmlspecialchars($objet['description'])) ?></p>

    <div class="row mb-4">
        <?php while ($img = $images->fetch_assoc()): ?>
            <div class="col-md-3">
                <img src="../uploads/<?= $img['chemin'] ?>" class="img-fluid rounded mb-2">
                <a href="supprimer_image.php?id=<?= $img['id_image'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
            </div>
        <?php endwhile; ?>
    </div>

    <h4>Historique des emprunts</h4>
    <table class="table table-bordered">
        <thead><tr><th>Emprunteur</th><th>Début</th><th>Retour</th></tr></thead>
        <tbody>
            <?php while ($h = $historique->fetch_assoc()): ?>
                <tr>
                    <td><?= $h['nom'] ?></td>
                    <td><?= $h['date_emprunt'] ?></td>
                    <td><?= $h['date_retour'] ?? 'En cours' ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
