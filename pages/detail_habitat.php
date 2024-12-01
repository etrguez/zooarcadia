<?php
session_start();

try {
    $base_de_donnees = new PDO('mysql:host=localhost;port=3306;dbname=arcadia', 'root', '');
    $base_de_donnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

if (isset($_GET['habitat_id'])) {
    $habitat_id = $_GET['habitat_id'];

    $sql = "SELECT habitats.*, images.image_data FROM habitats LEFT JOIN images ON habitats.habitat_id = images.habitat_id WHERE habitats.habitat_id = :habitat_id";
    $statement = $base_de_donnees->prepare($sql);
    $statement->execute([':habitat_id' => $habitat_id]);
    $habitat = $statement->fetch(PDO::FETCH_ASSOC);

    if ($habitat) {
        $sql_animaux = "SELECT animaux.animal_id, animaux.prenom, races.label AS race_label 
                        FROM animaux 
                        LEFT JOIN races ON animaux.race_id = races.race_id 
                        WHERE animaux.habitat_id = :habitat_id";
        $statement_animaux = $base_de_donnees->prepare($sql_animaux);
        $statement_animaux->execute([':habitat_id' => $habitat_id]);
        $animaux = $statement_animaux->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'Habitat</title>
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
    <h2 class="text-center text-success mb-4">Détail de l'Habitat</h2>
    <?php if ($habitat): ?>
        <div class="card mb-4 text-center">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($habitat['nom']); ?></h5>
                <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($habitat['description']); ?></p>
                <p class="card-text"><strong>Commentaire:</strong> <?php echo htmlspecialchars($habitat['commentaire_habitat']); ?></p>
                <?php if ($habitat['image_data']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($habitat['image_data']); ?>" class="img-fluid mb-3 border border-success rounded-pill" alt="Image de l'habitat" style="max-width: 400px;">
                <?php endif; ?>
                <h4>Animaux dans cet habitat</h4>
                <?php if (count($animaux) > 0): ?>
                    <ul class="list-group">
                        <?php foreach ($animaux as $animal): ?>
                            <li class="list-group-item">
                                <a class="text-success" href="detail_animal.php?animal_id=<?php echo htmlspecialchars($animal['animal_id']); ?>">
                                    <strong><?php echo htmlspecialchars($animal['prenom']); ?></strong> (<?php echo htmlspecialchars($animal['race_label']); ?>)
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucun animal dans cet habitat.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center">Habitat non trouvé.</p>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
<script src="script.js"></script>
</body>
</html>