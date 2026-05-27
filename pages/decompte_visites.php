<?php

require_once '../configuration/mongodb.php';

function incrementationCompteurVisite($animalId)
{
    $collection = getMongoCollection('ANIMAUX');

    if ($collection === null) {
        return;
    }

    $collection->updateOne(
        ['animal_id' => $animalId],
        ['$inc' => ['decompte' => 1]]
    );
}
