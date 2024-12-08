<?php

require_once './configuration/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];


    $password_hache = password_hash($password, PASSWORD_BCRYPT);

   
    $sql = "INSERT INTO utilisateurs (username, role_id, password, nom, prenom) VALUES (:username, :role_id, :password, :nom, :prenom)";
    $statement = $bdd->prepare($sql);
    $statement->execute([
        ':username' => $username,
        ':role_id' => 1, 
        ':password' => $password_hache,
        ':nom' => $nom,
        ':prenom' => $prenom
    ]);

    echo "Utilisateur administrateur créé avec succès.";
}
?>
