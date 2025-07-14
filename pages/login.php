<?php
require('../inc/function.php');

session_start();
if (isset($_GET['erreur'])){
    $erreur = $_GET ['erreur'];
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
     <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    
</head>

<body>
    <h1>Login</h1>

    <form action="../traitement/tlogin.php" method="post">
        
        <p>Email: <input type="email" name="mail" required placeholder="Email"> 
        <p>Mot de passe: <input type="password" name="mdp" required placeholder="Motdepasse"> 

        <?php if (isset($_GET['erreur'])) echo "<p style='color:red;'>$erreur</p>"; ?>
        
        <div class="bouton">
            <button type="submit">Connexion</button>
        </div>
       
    </form>

    
    <div class="bouton">
        <button type="submit"><a href="inscription.php">S'inscrire</a></button>
    </div> 

    
</body>
</html>

