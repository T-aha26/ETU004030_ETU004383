<?php
require('../inc/function.php');
session_start();

$conn = connex();
if (!$conn) {
    die('Erreur de connexion (liste.php) : ' . mysqli_connect_error());
}

$objets = get_all_objects();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-4"> Liste des objets</h1>

    <table class="table table-bordered table-hover shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom de l'objet</th>
                <th>ID Catégorie</th>
                <th>Propriétaire (ID)</th>
                <th> Emprunt en cours jusqu'au</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($objets as $index => $objet): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($objet['nom_objet']) ?></td>
                    <td><?= $objet['id_categorie'] ?></td>
                    <td><?= $objet['id_membre'] ?></td>
                    <td>
                        <?= $objet['date_retour'] ? date('d/m/Y', strtotime($objet['date_retour'])) : '—' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="login.php" class="btn btn-secondary"> Retour</a>
    </div>
</div>

</body>
</html>
