<?php
session_start();
require_once '../configuration/config.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != '1') {
    echo 'Accès refusé. Seuls les administrateurs peuvent accéder à cette page.';
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['type_jour']) && !empty($_POST['heure_ouverture']) && !empty($_POST['heure_fermeture'])) {
        $type_jour = ($_POST['type_jour']);
        $heure_ouverture = ($_POST['heure_ouverture']);
        $heure_fermeture = ($_POST['heure_fermeture']);

        $stmt = $bdd->prepare('UPDATE horaires_ouverture SET heure_ouverture = :heure_ouverture, heure_fermeture = :heure_fermeture WHERE type_jour = :type_jour');
        $stmt->execute([
            ':type_jour' => $type_jour,
            ':heure_ouverture' => $heure_ouverture,
            ':heure_fermeture' => $heure_fermeture
        ]);

        $_SESSION['message'] = "Horaire modifié avec succès.";
    } else {
        $_SESSION['message'] = "Erreur : Tous les champs sont obligatoires.";
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$query = 'SELECT type_jour, heure_ouverture, heure_fermeture FROM horaires_ouverture';
$horaires_ouverture = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des horaires_ouverture</title>
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
    <h2 class="text-center text-success mb-4">Modification des horaires_ouverture</h2>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?php echo htmlspecialchars($_SESSION['message']); ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <form action="" method="post" class="mx-auto" style="max-width: 600px;">
        <div class="mb-3">
            <label for="type_jour" class="form-label">Type de jour:</label>
            <select class="form-select" id="type_jour" name="type_jour" required>
                <option value="">-- Veuillez choisir un type de jour --</option>
                <?php foreach ($horaires_ouverture as $horaire): ?>
                    <option value="<?php echo $horaire['type_jour']; ?>"><?php echo htmlspecialchars($horaire['type_jour']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="heure_ouverture" class="form-label">Heure d'ouverture:</label>
            <input type="time" class="form-control" id="heure_ouverture" name="heure_ouverture" required>
        </div>
        <div class="mb-3">
            <label for="heure_fermeture" class="form-label">Heure de fermeture:</label>
            <input type="time" class="form-control" id="heure_fermeture" name="heure_fermeture" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Modifier</button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
<script src="script.js"></script>
</body>
</html>