<?php
require('../inc/connexion.php');
session_start();
$id_membre = $_SESSION['id_membre'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom_objet'];

    $connex->query("INSERT INTO ExamS2_objet (nom_objet, id_membre) 
                    VALUES ('$nom', $id_membre)");
    $id_objet = $connex->insert_id;

    }
?>