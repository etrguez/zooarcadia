<?php
if (getenv('JAWSDB_URL') !== false) {
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'], '/');
    $port = isset($dbparts['port']) ? $dbparts['port'] : 3306; 
} else {
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'arcadia';
    $port = 3306; 
}

try {
    $bdd = new PDO("mysql:host=$hostname;port=$port;dbname=$database;charset=utf8mb4", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
