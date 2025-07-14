<?php
require('../inc/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $date_naiss = $_POST['date_de_naissance'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $mdp = $_POST['mdp'];
    $image = $_FILES['image_profil']['name'];

    $id_result = $conn->query("SELECT MAX(id_membre)+1 AS next_id FROM ExamS2_membre");
    $row = $id_result->fetch_assoc();
    $id_membre = $row['next_id'] ?? 1;

    move_uploaded_file($_FILES['image_profil']['tmp_name'], "../uploads/" . $image);

    $stmt = $conn->prepare("INSERT INTO ExamS2_membre (id_membre, nom, date_de_naissance, genre, email, ville, mdp, image_profil)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $id_membre, $nom, $date_naiss, $genre, $email, $ville, $mdp, $image);
    $stmt->execute();

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
            <h3 class="text-center mb-4">Créer un compte</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de naissance</label>
                    <input type="date" name="date_de_naissance" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <select name="genre" class="form-select" required>
                        <option value="M">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ville</label>
                    <input type="text" name="ville" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="mdp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Photo de profil</label>
                    <input type="file" name="image_profil" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                <p class="mt-3 text-center">
                    Déjà inscrit ? <a href="login.php">Se connecter</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
