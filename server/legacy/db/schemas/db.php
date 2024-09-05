<?php

require '\xampp\htdocs\db\utils\read_env.php';

$envVariables = readEnv();

$host = $envVariables['DB_HOST'];
$port = $envVariables['DB_PORT'];
$dbname = $envVariables['DB_NAME'];
$username = $envVariables['DB_USERNAME'];
$password = $envVariables['DB_PASSWORD'];

try {
  $pdo = new PDO("pgsql:host=$host;port=$port", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare("SELECT 1 FROM pg_catalog.pg_database WHERE datname = :dbname");
  $stmt->execute(array(':dbname' => $dbname));

  if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdo->exec("CREATE DATABASE $dbname");
    echo "Database '$dbname' created successfully.\n";
  } else {
    echo "Database '$dbname' already exists.\n";
  }
} catch (PDOException $e) {
  die("Error: " . $e->getMessage());
}