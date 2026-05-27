<?php

function isMongoEnabled(): bool
{
    return !empty(getenv('MONGODB_URI'));
}

function getMongoCollection(string $collectionName): ?MongoDB\Collection
{
    if (!isMongoEnabled()) {
        return null;
    }

    require_once __DIR__ . '/../vendor/autoload.php';

    $client = new MongoDB\Client(getenv('MONGODB_URI'));

    return $client->selectDatabase('ARCADIA_ZOO')->selectCollection($collectionName);
}
