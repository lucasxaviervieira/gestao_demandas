<?php

require 'utils/read_env.php';

$envVariables = readEnv();

$host = $envVariables['DB_HOST'];
$port = $envVariables['DB_PORT'];
$dbname = $envVariables['DB_NAME'];
$username = $envVariables['DB_USERNAME'];
$password = $envVariables['DB_PASSWORD'];

try {

  $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error: " . $e->getMessage());
}