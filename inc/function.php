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
function get_membre_by_id($id) {
    $sql = sprintf("SELECT * FROM ExamS2_membre WHERE idMembre = '%s'", $id);
    $res = mysqli_query(connex(), $sql);
    return mysqli_fetch_assoc($res);
}


?>
