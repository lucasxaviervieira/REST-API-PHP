<?php

$host = 'localhost';
$dbname = 'crud-php';
$username = 'postgres';
$password = '123';
$desiredDatabaseName = 'crud-php';

try {
  $pdo = new PDO("pgsql:host=$host", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT 1 FROM pg_database WHERE datname = :dbname";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':dbname' => $desiredDatabaseName]);
  $databaseExists = $stmt->fetchColumn();

  if ($databaseExists) {
    $pdo = new PDO("pgsql:host=$host;dbname=$desiredDatabaseName", $username, $password);
    echo "Connected to database '$desiredDatabaseName'";
  } else {
    $sql = "CREATE DATABASE $desiredDatabaseName";
    $pdo->exec($sql);
    echo "Database '$desiredDatabaseName' created successfully";

    $pdo = new PDO("pgsql:host=$host;dbname=$desiredDatabaseName", $username, $password);
    echo "Connected to database '$desiredDatabaseName'";
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}