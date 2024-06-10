<?php

$host = 'localhost';
$port = '5432';
$dbname = 'crud_php';
$username = 'postgres';
$password = '123';

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
