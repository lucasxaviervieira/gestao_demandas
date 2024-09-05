<?php

function readEnv()
{
    $envFile = '\xampp\htdocs\.env';
    $envData = file_get_contents($envFile);

    $envVariables = [];
    $lines = explode("\n", $envData);
    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $envVariables[$key] = $value;
        }
    }
    return $envVariables;
}