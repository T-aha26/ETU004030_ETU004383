<?php
require('../inc/connexion.php');

// Sécurisation de l'ID dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide ou non fourni.");
}

$id = intval($_GET['id']); 

$membre_stmt = $connex->prepare("SELECT * FROM ExamS2_membre WHERE id_membre = ?");
$membre_stmt->bind_param("i", $id);
$membre_stmt->execute();
$result_membre = $membre_stmt->get_result();
$membre = $result_membre->fetch_assoc();

if (!$membre) {
    die("Membre non trouvé.");
}

$objets_stmt = $connex->prepare("
    SELECT o.*, c.nom_categorie 
    FROM ExamS2_objet o 
    JOIN ExamS2_categorie_objet c ON o.id_categorie = c.id_categorie 
    WHERE id_membre = ? 
    ORDER BY c.nom_categorie
");
$objets_stmt->bind_param("i", $id);
$objets_stmt->execute();
$objets = $objets_stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fiche membre</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .text-violet {
            color: #6a11cb;
        }
        .btn-violet {
            background-color: #6a11cb;
            border: none;
            color: white;
        }
        .btn-violet:hover {
            background-color: #5c0eb4;
        }
    </style>
</head>
<body class="p-4">
<div class="container">
    <h2 class="text-violet"><?= htmlspecialchars($membre['nom']) ?> (<?= htmlspecialchars($membre['ville']) ?>)</h2>
    <p>Email : <?= htmlspecialchars($membre['email']) ?></p>

    <a href="emprun.php?id=<?= $id ?>" class="btn btn-primary w-100 mb-3">Voir les objets empruntés</a>

   
    <a href="retour.php?id=<?= $id ?>" class="btn btn-violet w-100 mb-4">Retourner un objet</a>

    <h4>Objets</h4>
    <?php
    $current_cat = '';
    while ($o = $objets->fetch_assoc()):
        if ($current_cat != $o['nom_categorie']):
            if ($current_cat) echo "</ul>";
            echo "<h5 class='mt-3'>" . htmlspecialchars($o['nom_categorie']) . "</h5><ul>";
            $current_cat = $o['nom_categorie'];
        endif;
        echo "<li>" . htmlspecialchars($o['nom_objet']) . "</li>";
    endwhile;
    echo "</ul>";
    ?>
</div>
</body>
</html>
