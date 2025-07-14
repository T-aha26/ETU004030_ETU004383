<?php
require('../inc/connexion.php');
$id = intval($_GET['id']);

$image = $connex->query("SELECT * FROM ExamS2_image_objet WHERE id_image = $id")->fetch_assoc();
if ($image) {
    unlink("../uploads/" . $image['chemin']);
    $connex->query("DELETE FROM ExamS2_image_objet WHERE id_image = $id");
}
header("Location: fiche_objet.php?id=" . $image['id_objet']);
exit;
