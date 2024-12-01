<?php
require '../vendor/autoload.php'; 

use MongoDB\Client;

$client = new Client('mongodb+srv://elisabethtalavera:Toyotaf.5355@cluster0.4i1mc.mongodb.net/ARCADIA_ZOO?retryWrites=true');
$database = $client->selectDatabase('ARCADIA_ZOO');
$collection = $database->selectCollection('ANIMAUX');

$animals = $collection->find()->toArray();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class=>Compteur de visites des animaux</title>
     
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
    <div class="container mt-5">
        <h1 class="titre d-flex justify-content-center">Compteur de visites des animaux</h1>
        <div class="row mt-3">
            <?php foreach ($animals as $animal): ?>
                <div class="col-md-4">
                    <div class="card mb-3  ">
                        <div class="card-body ">
                            <h5 class="card-title"><?php echo htmlspecialchars($animal['prenom']); ?></h5>
                            <p class="card-text">Nombre de visites : <?php echo htmlspecialchars($animal['decompte']); ?></p>
                            <a href="detail_animal.php?animal_id=<?php echo htmlspecialchars($animal['animal_id']); ?>" class="btn btn-success">Voir la fiche</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>