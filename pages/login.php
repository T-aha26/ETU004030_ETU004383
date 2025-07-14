<?php
session_start();
require('../inc/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $stmt = $connex->prepare("SELECT * FROM ExamS2_membre WHERE email = ? AND mdp = ?");
    $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $_SESSION['id_membre'] = $user['id_membre'];
        $_SESSION['nom'] = $user['nom'];
        header("Location: liste.php");
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
        }
        .btn-purple {
            background-color: #6a11cb;
            border: none;
            color: white;
        }
        .btn-purple:hover {
            background-color: #5c0eb4;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card p-4 shadow-lg">
                    <h3 class="text-center mb-4">Connexion</h3>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="mdp" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-purple w-100">Se connecter</button>
                    </form>
                    <p class="mt-3 text-center">
                        Pas encore de compte ?
                        <a href="inscription.php" class="text-decoration-none">Inscription</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
