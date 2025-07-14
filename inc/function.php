<?php
require("connexion.php");

function insert_membre($membre)
{
    
    $sqlInsert="INSERT INTO ExamS2_membre SET email='%s', 
    mdp='%s', nom='%s', date_de_naissance='%s'";

    $sql=sprintf($sqlInsert, $membre['mail'],$membre['mdp'], 
    $membre['name'], $membre['ddn']);

    if (mysqli_query(connex(), $sql)){
        header("Location: login.php");
    }

}

function get_all_objects()
{
    $sql = "SELECT 
                o.id_objet,
                o.nom_objet,
                o.id_categorie,
                o.id_membre,
                e.date_retour
            FROM ExamS2_objet o
            LEFT JOIN ExamS2_emprunt e 
                ON o.id_objet = e.id_objet
                AND (e.date_retour IS NULL OR e.date_retour > CURRENT_DATE)
            ORDER BY o.nom_objet ASC";
    
    $req = mysqli_query(connex(), $sql);
    $result = array();
    
    while ($row = mysqli_fetch_assoc($req)) {
        $result[] = $row;
    }
    
    mysqli_free_result($req);
    return $result;
}


function get_membre_by_id($id) {
    $sql = sprintf("SELECT * FROM ExamS2_membre WHERE idMembre = '%s'", $id);
    $res = mysqli_query(connex(), $sql);
    return mysqli_fetch_assoc($res);
}


?>
