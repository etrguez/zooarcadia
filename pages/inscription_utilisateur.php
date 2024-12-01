<?php
session_start();
require_once '../classes/admin.php';
require_once '../classes/employe.php';
require_once '../classes/veterinaire.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    echo 'Vous ne pouvez pas accéder à cette page';
    exit();
}

if (isset($_POST['Creer'])) {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['role'])) {
        $username = ($_POST['username']);
        $password = $_POST['password'];
        $nom = ($_POST['nom']);
        $prenom = ($_POST['prenom']);
        $role_id = ($_POST['role']);
        $label = 'Label par défaut';

        try {
            $bdd = new PDO('mysql:host=localhost;port=3306;dbname=arcadia', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
            exit();
        }

        $sql = "INSERT INTO utilisateurs (username, password, nom, prenom, role_id, label) VALUES (:username, :password, :nom, :prenom, :role_id, :label)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':role_id' => $role_id,
            ':label' => $label
        ]);

        echo "Utilisateur créé avec succès.";
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>


<!-- START NAV -->
<nav class="navbar navbar-expand-lg bg-body-tertiary p-3" id="menu">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <span class="text-success fs-5 fw-bold">Arcadia</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="animaux.php">Nos Animaux</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="habitats_page.php">Nos Habitats</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="page_services.php">Nos Services</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
                <button class="btn btn-outline-success" type="submit" ><a href="connexion.php" >connexion</a></button>
            </form>
          </div>
        </div>
      </nav>
<main class="container my-5">
    <h2 class="text-center text-success mb-4">Inscription Utilisateur</h2>
    <form action="" method="post" class="mx-auto" style="max-width: 600px;">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom:</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rôle:</label>
            <select class="form-select" id="role" name="role" required>
                <option value="2">Employé</option>
                <option value="3">Vétérinaire</option>
            </select>
        </div>
        <button type="submit" name="Creer" class="btn btn-success w-100">Créer Utilisateur</button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
<script src="script.js"></script>
</body>
</html>