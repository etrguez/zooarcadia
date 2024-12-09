<?php
session_start();
require_once '../configuration/config.php';
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 1 && $_SESSION['role'] != 3)) {
    header('Location: connexion_utilisateur.php');
    exit();
}



$role_utilisateur = $_SESSION['role'];
$role_label = $role_utilisateur == 1 ? 'Administrateur' : ($role_utilisateur == 3 ? 'Vétérinaire' : 'Employé');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['creer_habitat']) && $role_utilisateur == 1) {
        $nom = htmlspecialchars($_POST['nom']);
        $description = htmlspecialchars($_POST['description']);
        $commentaire_habitat = htmlspecialchars($_POST['commentaire_habitat']);

        $sql = "INSERT INTO habitats (nom, description, commentaire_habitat) VALUES (:nom, :description, :commentaire_habitat)";
        $statement = $bdd->prepare($sql);
        $statement->execute([
            ':nom' => $nom,
            ':description' => $description,
            ':commentaire_habitat' => $commentaire_habitat
        ]);

        $habitat_id = $bdd->lastInsertId();

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_data = file_get_contents($_FILES['image']['tmp_name']);
            $sql = "INSERT INTO images (habitat_id, image_data) VALUES (:habitat_id, :image_data)";
            $statement = $bdd->prepare($sql);
            $statement->execute([
                ':habitat_id' => $habitat_id,
                ':image_data' => $image_data
            ]);
        }

        echo "Habitat créé avec succès.";
    } elseif (isset($_POST['modifier_habitat'])) {
        $habitat_id = htmlspecialchars($_POST['habitat_id']);
        $commentaire_habitat = htmlspecialchars($_POST['commentaire_habitat']);


        $sql = "UPDATE habitats SET commentaire_habitat = :commentaire_habitat WHERE habitat_id = :habitat_id";
        $statement = $bdd->prepare($sql);
        $statement->execute([
            ':commentaire_habitat' => $commentaire_habitat,
            ':habitat_id' => $habitat_id
        ]);

        if ($role_utilisateur == 1) {
            $nom = $_POST['nom'];
            $description = $_POST['description'];

            $sql = "UPDATE habitats SET nom = :nom, description = :description WHERE habitat_id = :habitat_id";
            $statement = $bdd->prepare($sql);
            $statement->execute([
                ':nom' => $nom,
                ':description' => $description,
                ':habitat_id' => $habitat_id
            ]);

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_data = file_get_contents($_FILES['image']['tmp_name']);
                $sql = "SELECT * FROM images WHERE habitat_id = :habitat_id";
                $statement = $bdd->prepare($sql);
                $statement->execute([':habitat_id' => $habitat_id]);
                $image = $statement->fetch(PDO::FETCH_ASSOC);

                if ($image) {
                    $sql = "UPDATE images SET image_data = :image_data WHERE habitat_id = :habitat_id";
                    $statement = $bdd->prepare($sql);
                    $statement->execute([
                        ':image_data' => $image_data,
                        ':habitat_id' => $habitat_id
                    ]);
                } else {
                    $sql = "INSERT INTO images (habitat_id, image_data) VALUES (:habitat_id, :image_data)";
                    $statement = $bdd->prepare($sql);
                    $statement->execute([
                        ':habitat_id' => $habitat_id,
                        ':image_data' => $image_data
                    ]);
                }
            }
        }

        echo "Habitat modifié avec succès.";
    } elseif (isset($_POST['supprimer_habitat']) && $role_utilisateur == 1) {
        $habitat_id = htmlspecialchars($_POST['habitat_id']);
        
        $sql = "DELETE FROM images WHERE habitat_id = :habitat_id";
        $statement = $bdd->prepare($sql);
        $statement->execute([':habitat_id' => $habitat_id]);

        $sql = "DELETE FROM habitats WHERE habitat_id = :habitat_id";
        $statement = $bdd->prepare($sql);
        $statement->execute([':habitat_id' => $habitat_id]);

        echo "Habitat supprimé avec succès.";
    }
}

$sql = "SELECT habitats.*, images.image_data FROM habitats LEFT JOIN images ON habitats.habitat_id = images.habitat_id";
$habitats = $bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Habitats</title>
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
    <h2 class="text-center text-success mb-4">Gestion des Habitats</h2>
    <p class="text-center text-muted">Connecté en tant que : <?php echo ($role_label); ?></p>

    <?php if ($role_utilisateur == 1): ?>
        <h3>Créer un nouvel habitat</h3>
        <form action="" method="post" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
            <input type="hidden" name="creer_habitat" value="1">
            <div class="mb-3">
                <label for="nom_nouveau" class="form-label">Nom:</label>
                <input type="text" class="form-control" id="nom_nouveau" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="description_nouveau" class="form-label">Description:</label>
                <textarea class="form-control" id="description_nouveau" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="commentaire_habitat_nouveau" class="form-label">Commentaire:</label>
                <textarea class="form-control" id="commentaire_habitat_nouveau" name="commentaire_habitat" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image_nouveau" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image_nouveau" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-success w-100">Créer Habitat</button>
        </form>
    <?php endif; ?>
    <hr>

    <h3>Liste des habitats existants</h3>
    <?php if (count($habitats) > 0): ?>
        <?php foreach ($habitats as $habitat): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo ($habitat['nom']); ?></h5>
                    <p class="card-text"><strong>Description:</strong> <?php echo ($habitat['description']); ?></p>
                    <p class="card-text"><strong>Commentaire:</strong> <?php echo ($habitat['commentaire_habitat']); ?></p>
                    <?php if ($habitat['image_data']): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($habitat['image_data']); ?>" class="img-fluid mb-3" alt="Image de l'habitat">
                    <?php endif; ?>
                    <?php if ($role_utilisateur == 1 || $role_utilisateur == 3): ?>
                        <h4>Modifier l'habitat</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="modifier_habitat" value="1">
                            <input type="hidden" name="habitat_id" value="<?php echo $habitat['habitat_id']; ?>">
                            <?php if ($role_utilisateur == 1): ?>
                                <div class="mb-3">
                                    <label for="nom_<?php echo $habitat['habitat_id']; ?>" class="form-label">Nom:</label>
                                    <input type="text" class="form-control" id="nom_<?php echo $habitat['habitat_id']; ?>" name="nom" value="<?php echo ($habitat['nom']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description_<?php echo $habitat['habitat_id']; ?>" class="form-label">Description:</label>
                                    <textarea class="form-control" id="description_<?php echo $habitat['habitat_id']; ?>" name="description" rows="4" required><?php echo ($habitat['description']); ?></textarea>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="commentaire_habitat_<?php echo $habitat['habitat_id']; ?>" class="form-label">Commentaire:</label>
                                <textarea class="form-control" id="commentaire_habitat_<?php echo $habitat['habitat_id']; ?>" name="commentaire_habitat" rows="4" required><?php echo ($habitat['commentaire_habitat']); ?></textarea>
                            </div>
                            <?php if ($role_utilisateur == 1): ?>
                                <div class="mb-3">
                                    <label for="image_<?php echo $habitat['habitat_id']; ?>" class="form-label">Image:</label>
                                    <input type="file" class="form-control" id="image_<?php echo $habitat['habitat_id']; ?>" name="image" accept="image/*">
                                </div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-success">Modifier Habitat</button>
                        </form>
                    <?php endif; ?>
                    <?php if ($role_utilisateur == 1): ?>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="habitat_id" value="<?php echo $habitat['habitat_id']; ?>">
                            <input type="hidden" name="supprimer_habitat">
                            <button type="submit" class="btn btn-danger mt-2">Supprimer</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">Aucun habitat disponible.</p>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
<script src="script.js"></script>
</body>
</html>
