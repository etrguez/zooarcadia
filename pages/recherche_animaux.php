<?php
require_once '../configuration/config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];
    
    if (empty($query)) {
        $sql = "SELECT animaux.animal_id, animaux.prenom, races.label, images.image_data
                FROM animaux 
                INNER JOIN images ON animaux.animal_id = images.animal_id 
                INNER JOIN races ON races.race_id = animaux.race_id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    } else {
        $sql = "SELECT animaux.animal_id, animaux.prenom, races.label, images.image_data 
                FROM animaux 
                INNER JOIN images ON animaux.animal_id = images.animal_id 
                INNER JOIN races ON races.race_id = animaux.race_id
                WHERE races.label LIKE :query";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':query' => '%' . $query . '%']);
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
   
    foreach ($results as &$result) {
        $result['image_data'] = base64_encode($result['image_data']);
    }
    
    echo json_encode($results);
}
?><?php
require_once '../configuration/config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];
    
    if (empty($query)) {
        $sql = "SELECT animaux.animal_id, animaux.prenom, races.label, images.image_data
                FROM animaux 
                INNER JOIN images ON animaux.animal_id = images.animal_id 
                INNER JOIN races ON races.race_id = animaux.race_id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    } else {
        $sql = "SELECT animaux.animal_id, animaux.prenom, races.label, images.image_data 
                FROM animaux 
                INNER JOIN images ON animaux.animal_id = images.animal_id 
                INNER JOIN races ON races.race_id = animaux.race_id
                WHERE races.label LIKE :query";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':query' => '%' . $query . '%']);
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
   
    foreach ($results as &$result) {
        $result['image_data'] = base64_encode($result['image_data']);
    }
    
    echo json_encode($results);
}
?><?php
require_once '../configuration/config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];
    
    if (empty($query)) {
        $sql = "SELECT animaux.animal_id, animaux.prenom, races.label, images.image_data
                FROM animaux 
                INNER JOIN images ON animaux.animal_id = images.animal_id 
                INNER JOIN races ON races.race_id = animaux.race_id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    } else {
        $sql = "SELECT animaux.animal_id, animaux.prenom, races.label, images.image_data 
                FROM animaux 
                INNER JOIN images ON animaux.animal_id = images.animal_id 
                INNER JOIN races ON races.race_id = animaux.race_id
                WHERE races.label LIKE :query";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':query' => '%' . $query . '%']);
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
   
    foreach ($results as &$result) {
        $result['image_data'] = base64_encode($result['image_data']);
    }
    
    echo json_encode($results);
}
?><?php
require_once '../configuration/config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];
    
    if (empty($query)) {
        $sql = "SELECT animaux.animal_id, animaux.prenom, races.label, images.image_data
                FROM animaux 
                INNER JOIN images ON animaux.animal_id = images.animal_id 
                INNER JOIN races ON races.race_id = animaux.race_id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    } else {
        $sql = "SELECT animaux.animal_id, animaux.prenom, races.label, images.image_data 
                FROM animaux 
                INNER JOIN images ON animaux.animal_id = images.animal_id 
                INNER JOIN races ON races.race_id = animaux.race_id
                WHERE races.label LIKE :query";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':query' => '%' . $query . '%']);
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
   
    foreach ($results as &$result) {
        $result['image_data'] = base64_encode($result['image_data']);
    }
    
    echo json_encode($results);
}
?>
