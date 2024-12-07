<?php

require '../vendor/autoload.php'; 
require_once '../configuration/config.php';

use MongoDB\Client;

$client = new Client('mongodb+srv://elisabethtalavera:Toyotaf.5355@cluster0.4i1mc.mongodb.net/ARCADIA_ZOO?retryWrites=true');
$database = $client->selectDatabase('ARCADIA_ZOO');

function incrementationCompteurVisite($animalId)
{
    global $database;

    $collection = $database->selectCollection('ANIMAUX');

    $result = $collection->updateOne(
        ['animal_id' => $animalId],
        ['$inc' => ['decompte' => 1]]
    );

}
?>