<?php
session_start();
require_once '../configuration/config.php';
require '../vendor/autoload.php';

use MongoDB\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'creer') {
        try {
            if (!empty($_POST['prenom']) && !empty($_POST['race']) && !empty($_POST['description']) && !empty($_POST['etat']) && !empty($_POST['habitat_id'])) {
                $prenom = ($_POST['prenom']);
                $race = ($_POST['race']);
                $description = ($_POST['description']);
                $etat = ($_POST['etat']);
                $habitat_id = (int)$_POST['habitat_id'];
                $image_data = null;
                $image_type = null;

                if (!empty($_FILES['image_data']['tmp_name'])) {
                    $image_data = file_get_contents($_FILES['image_data']['tmp_name']);
                    $image_type = $_FILES['image_data']['type'];
                }

                $stmt = $bdd->prepare('SELECT race_id FROM races WHERE label = :race');
                $stmt->execute([':race' => $race]);
                $race_id = $stmt->fetchColumn();

                if ($race_id === false) {
                    $stmt = $bdd->prepare('INSERT INTO races (label) VALUES (:race)');
                    $stmt->execute([':race' => $race]);
                    $race_id = $bdd->lastInsertId();
                }

                $stmt = $bdd->prepare('INSERT INTO animaux (prenom, race_id, description, etat, habitat_id) VALUES (:prenom, :race_id, :description, :etat, :habitat_id)');
                $stmt->execute([
                    ':prenom' => $prenom,
                    ':race_id' => $race_id,
                    ':description' => $description,
                    ':etat' => $etat,
                    ':habitat_id' => $habitat_id
                ]);

                $animal_id = $bdd->lastInsertId();

                if ($image_data !== null) {
                    $stmt = $bdd->prepare('INSERT INTO images (animal_id, image_data, image_type) VALUES (:animal_id, :image_data, :image_type)');
                    $stmt->execute([
                        ':animal_id' => $animal_id,
                        ':image_data' => $image_data,
                        ':image_type' => $image_type
                    ]);
                }

                echo "Animal créé avec succès.";
            } else {
                echo "Veuillez remplir tous les champs.";
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}

// Récupérer les habitats pour le formulaire
$stmt = $bdd->query('SELECT habitat_id, nom FROM habitats');
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un Animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Création d'un Animal</h1>
        <form action="creation_animal.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="creer">
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="mb-3">
                <label for="race" class="form-label">Race:</label>
                <input type="text" class="form-control" id="race" name="race" placeholder="Race" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="etat" class="form-label">État:</label>
                <input type="text" class="form-control" id="etat" name="etat" placeholder="État" required>
            </div>
            <div class="mb-3">
                <label for="habitat_id" class="form-label">Habitat:</label>
                <select class="form-select" id="habitat_id" name="habitat_id" required>
                    <option value="">-- Veuillez choisir un habitat --</option>
                    <?php foreach ($habitats as $habitat): ?>
                        <option value="<?php echo htmlspecialchars($habitat['habitat_id']); ?>"><?php echo htmlspecialchars($habitat['nom']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image_data" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image_data" name="image_data">
            </div>
            <button type="submit" class="btn btn-success w-100">Créer</button>
        </form>
        <hr>
        <h3>Liste des animaux</h3>
        <?php
        // Récupérer la liste des animaux avec leurs images
        $stmt = $bdd->query('
            SELECT animaux.animal_id, animaux.prenom, animaux.description, animaux.etat, habitats.nom AS habitat_nom, images.image_data, images.image_type
            FROM animaux
            INNER JOIN habitats ON animaux.habitat_id = habitats.habitat_id
            LEFT JOIN images ON animaux.animal_id = images.animal_id
        ');
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($animaux as $animal) {
            echo '<div class="card mb-3" style="width: 18rem;">';
            if ($animal['image_data']) {
                $imageData = base64_encode($animal['image_data']);
                echo '<img src="data:' . $animal['image_type'] . ';base64,' . $imageData . '" class="card-img-top" alt="Image de ' . htmlspecialchars($animal['prenom']) . '">';
            }
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($animal['prenom']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars($animal['description']) . '</p>';
            echo '<p class="card-text"><small class="text-muted">État: ' . htmlspecialchars($animal['etat']) . '</small></p>';
            echo '<p class="card-text"><small class="text-muted">Habitat: ' . htmlspecialchars($animal['habitat_nom']) . '</small></p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
