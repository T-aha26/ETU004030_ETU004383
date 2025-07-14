<?php
require('../inc/connexion.php');
$id = $_GET['id'];

$membre = $connex->query("SELECT * FROM ExamS2_membre WHERE id_membre = $id")->fetch_assoc();
$objets = $connex->query("SELECT o.*, c.nom_categorie 
                          FROM ExamS2_objet o 
                          JOIN ExamS2_categorie_objet c ON o.id_categorie = c.id_categorie 
                          WHERE id_membre = $id 
                          ORDER BY c.nom_categorie");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fiche membre</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="p-4">
<div class="container">
    <h2 class="text-violet"><?= $membre['nom'] ?> (<?= $membre['ville'] ?>)</h2>
    <p>Email : <?= $membre['email'] ?></p>

    <h4>Objets</h4>
    <?php
    $current_cat = '';
    while ($o = $objets->fetch_assoc()):
        if ($current_cat != $o['nom_categorie']):
            if ($current_cat) echo "</ul>";
            echo "<h5 class='mt-3'>" . $o['nom_categorie'] . "</h5><ul>";
            $current_cat = $o['nom_categorie'];
        endif;
        echo "<li>" . $o['nom_objet'] . "</li>";
    endwhile;
    echo "</ul>";
    ?>
</div>
</body>
</html>
