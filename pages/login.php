<?php
require('../inc/function.php');
session_start();

$erreur = $_GET['erreur'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h2 class="text-center mb-4"> Connexion</h2>

                    <?php if ($erreur): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($erreur) ?>
                        </div>
                    <?php endif; ?>

                    <form action="../traitement/tlogin.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="mail" placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <label for="mdp" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p>Pas encore de compte ? 
                            <a href="inscription.php" class="text-decoration-none">S'inscrire</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
