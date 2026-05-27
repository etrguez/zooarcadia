<?php
// =============================================
// ENVIRONMENT LOADER - ZOO ARCADIA
// Chargement des variables d'environnement
// =============================================

/**
 * Charge les variables d'environnement depuis le fichier .env
 */
function loadEnvironment(): void
{
    $envFile = __DIR__ . '/../.env';

    if (!file_exists($envFile)) {
        return;
    }

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, " \t\n\r\0\x0B\"'");

            // On ne définit la variable que si elle n'existe pas déjà (Coolify gagne)
            if (getenv($key) === false) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            } elseif (!isset($_ENV[$key])) {
                $_ENV[$key] = getenv($key);
            }
        }
    }
}

loadEnvironment();
