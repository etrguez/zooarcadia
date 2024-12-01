<?php
session_start();

try {
    $base_de_donnees = new PDO('mysql:host=localhost;port=3306;dbname=arcadia', 'root', '');
    $base_de_donnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];

    $sql = "SELECT animaux.*, races.label AS race_label, habitats.nom AS habitat_nom 
            FROM animaux 
            LEFT JOIN races ON animaux.race_id = races.race_id 
            LEFT JOIN habitats ON animaux.habitat_id = habitats.habitat_id 
            WHERE animaux.animal_id = :animal_id";
    $statement = $base_de_donnees->prepare($sql);
    $statement->execute([':animal_id' => $animal_id]);
    $animal = $statement->fetch(PDO::FETCH_ASSOC);

    if ($animal) {
        $sql_images = "SELECT image_data FROM images WHERE animal_id = :animal_id";
        $statement_images = $base_de_donnees->prepare($sql_images);
        $statement_images->execute([':animal_id' => $animal_id]);
        $images = $statement_images->fetchAll(PDO::FETCH_ASSOC);

        $sql_rapports = "SELECT etat_animal, nourriture_proposee, grammage_nourriture, date_passage, detail_etat_animal 
                         FROM rapports_veterinaires 
                         WHERE animal_id = :animal_id";
        $statement_rapports = $base_de_donnees->prepare($sql_rapports);
        $statement_rapports->execute([':animal_id' => $animal_id]);
        $rapports = $statement_rapports->fetchAll(PDO::FETCH_ASSOC);
    }
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'Animal</title>
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
    <h2 class="text-center text-success mb-4">Détail de l'Animal</h2>
    <?php if ($animal): ?>
        <div class="card mb-4 text-center">
            <div class="card-body">
                <h5 class="card-title"><?php echo ($animal['prenom']); ?></h5>
                <p class="card-text"><strong>Race:</strong> <?php echo htmlspecialchars($animal['race_label']); ?></p>
                <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($animal['description']); ?></p>
                <p class="card-text"><strong>État:</strong> <?php echo htmlspecialchars($animal['etat']); ?></p>
                <p class="card-text"><strong>Habitat:</strong> <?php echo htmlspecialchars($animal['habitat_nom']); ?></p>
                <?php if ($images): ?>
                    <h3 class="text-success">Photo de l'animal</h3>
                    <div class="d-flex flex-wrap justify-content-center">
                        <?php foreach ($images as $image): ?>
                            <?php if (!empty($image['image_data'])): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($image['image_data']); ?>" alt="Photo de l'animal" class="img-thumbnail m-2 border border-success rounded-pill" style="max-width: 400px;">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($rapports): ?>
                    <h3>Rapports Vétérinaires</h3>
                    <?php foreach ($rapports as $rapport): ?>
                        <div class="mb-3">
                            <p><strong>État de l'animal:</strong> <?php echo htmlspecialchars($rapport['etat_animal']); ?></p>
                            <p><strong>Nourriture proposée:</strong> <?php echo htmlspecialchars($rapport['nourriture_proposee']); ?></p>
                            <p><strong>Grammage de la nourriture:</strong> <?php echo htmlspecialchars($rapport['grammage_nourriture']); ?></p>
                            <p><strong>Date de passage:</strong> <?php echo htmlspecialchars($rapport['date_passage']); ?></p>
                            <?php if (!empty($rapport['detail_etat_animal'])): ?>
                                <p><strong>Détails de l'état de l'animal:</strong> <?php echo htmlspecialchars($rapport['detail_etat_animal']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center">Animal non trouvé.</p>
    <?php endif; ?>
</main>

<?php
require 'decompte_visites.php'; 
$animal_id = (int)$_GET['animal_id'];
incrementationCompteurVisite($animal_id);
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
<script src="script.js"></script>
</body>
</html>