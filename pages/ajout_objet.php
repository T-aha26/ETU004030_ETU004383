<?php
session_start();
require('../inc/connexion.php');

$id_membre = $_SESSION['id_membre'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom_objet'];
    $id_categorie = $_POST['id_categorie'];

    $connex->query("INSERT INTO ExamS2_objet (nom_objet, id_categorie, id_membre) 
                    VALUES ('$nom', $id_categorie, $id_membre)");
    $id_objet = $connex->insert_id;

    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $imageName = time() . '_' . basename($_FILES['images']['name'][$key]);
            move_uploaded_file($tmp_name, "../uploads/$imageName");

            $is_principale = ($key === 0) ? 1 : 0;
            $connex->query("INSERT INTO ExamS2_image_objet (id_objet, chemin, is_principale)
                            VALUES ($id_objet, '$imageName', $is_principale)");
        }
    } else {
        
        $connex->query("INSERT INTO ExamS2_image_objet (id_objet, chemin, is_principale) 
                        VALUES ($id_objet, 'makeup.jpg', 1)");
    }

    header("Location: liste.php");
    exit;
}
$categories = $connex->query("SELECT * FROM ExamS2_categorie_objet");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajout objet</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light-purple p-4">
<div class="container">
    <h2 class="text-center text-violet mb-4">Ajouter un objet</h2>
    <form method="post" enctype="multipart/form-data" class="card p-4 shadow">
        <div class="mb-3">
            <label class="form-label">Nom de l’objet</label>
            <input type="text" class="form-control" name="nom_objet" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <select name="id_categorie" class="form-select" required>
                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <option value="<?= $cat['id_categorie'] ?>"><?= htmlspecialchars($cat['nom_categorie']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Images (la première = principale)</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-violet">Ajouter</button>
    </form>
</div>
</body>
</html>
