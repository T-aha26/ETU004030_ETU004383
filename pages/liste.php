<?php
require('../inc/connexion.php');

$categories = $connex->query("SELECT * FROM ExamS2_categorie_objet");

$where = "";
if (isset($_GET['categorie']) && $_GET['categorie'] != '') {
    $id_categorie = intval($_GET['categorie']);
    $where = "WHERE o.id_categorie = $id_categorie";
}if (!empty($_GET['nom_objet'])) {
    $nom = $connex->real_escape_string($_GET['nom_objet']);
    $where .= " AND o.nom_objet LIKE '%$nom%'";
}
if (!empty($_GET['disponible'])) {
    $where .= " AND e.date_retour IS NULL";
}


$query = "
    SELECT o.id_objet, o.nom_objet, c.nom_categorie, m.nom AS nom_proprietaire, e.date_retour
    FROM ExamS2_objet o
    JOIN ExamS2_categorie_objet c ON o.id_categorie = c.id_categorie
    JOIN ExamS2_membre m ON o.id_membre = m.id_membre
    LEFT JOIN ExamS2_emprunt e ON o.id_objet = e.id_objet AND e.date_retour >= CURDATE()
    $where
    ORDER BY o.id_objet
";

$result = $connex->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            color: white;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            color: #333;
        }
        .btn-violet {
            background-color: #6a11cb;
            border: none;
            color: white;
        }
        .btn-violet:hover {
            background-color: #5c0eb4;
        }
        h2 {
            color: #6a11cb;
        }
        .table-dark-violet thead {
            background-color: #6a11cb;
            color: white;
        }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center">Liste des objets</h2>

       
        <form method="get" class="row g-3 align-items-end mb-4">
            <div class="col-md-6">
                <label class="form-label">Catégorie</label>
                <select name="categorie" class="form-select">
                    <option value="">Toutes les catégories</option>
                    <?php while ($cat = $categories->fetch_assoc()): ?>
                        <option value="<?= $cat['id_categorie'] ?>" <?= (isset($id_categorie) && $id_categorie == $cat['id_categorie']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nom_categorie']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-violet w-100" type="submit">Filtrer</button>
            </div>
            <div class="col-md-3">
                <a href="liste.php" class="btn btn-outline-secondary w-100">Réinitialiser</a>
            </div>
                        <input type="text" name="nom_objet" class="form-control" placeholder="Rechercher par nom..." value="<?= $_GET['nom_objet'] ?? '' ?>">


        <div class="form-check">
        <input class="form-check-input" type="checkbox" name="disponible" <?= isset($_GET['disponible']) ? 'checked' : '' ?>>
        <label class="form-check-label">Disponible uniquement</label>
        </div>
        </form>
     
        <a href="ajout_objet.php"><button type="submit" class="btn btn-primary w-100">Ajouter objet</button></a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark-violet">
                    <tr>
                        <th>#</th>
                        <th>Objet</th>
                        <th>Catégorie</th>
                        <th>Propriétaire</th>
                        <th>Date de retour (si emprunté)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id_objet'] ?></td>
                                <td><?= htmlspecialchars($row['nom_objet']) ?></td>
                                <td><?= htmlspecialchars($row['nom_categorie']) ?></td>
                                <td><?= htmlspecialchars($row['nom_proprietaire']) ?></td>
                                <td>
                                    <?= $row['date_retour'] ? date('d/m/Y', strtotime($row['date_retour'])) : '<span class="text-success fw-bold">Disponible</span>' ?>
                                    <?php if (!$row['date_retour']): ?>
                                         <a href="emprunter.php?nom=<?= $row['nom_objet'] ?>" class="btn btn-success btn-sm">Emprunter</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Aucun objet trouvé.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
