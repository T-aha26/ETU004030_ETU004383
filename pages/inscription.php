<?php
require('../inc/function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $membre['mail']=$_POST['mail'];
    $membre['mdp']=$_POST['mdp'];
    $membre['name']=$_POST['name'];
    $membre['ddn']=$_POST['ddn'];
     
    insert_membre($membre);

} else{

}
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
   <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
    <h1>Inscription</h1>

    <form action="login.php" method="post">
        
        <p>Mail: <input type="email" name="mail" required placeholder="Email"> 
        <p>Mot de passe: <input type="password" name="mdp" required placeholder="Motdepasse"> 
        <p>Nom: <input type="text" name="name" required placeholder="Nom"> 
        <p>Date de naissance: <input type="date" name="ddn"> 

        <div class="bouton">
            <button type="submit">Valider</button>
        </div>
    </form>
    
</body>
</html>