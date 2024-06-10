<?php


try {
  $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $checkTableSql = "SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_name = 'users'
    )";
  $stmt = $pdo->query($checkTableSql);
  $tableExists = $stmt->fetchColumn();

  if (!$tableExists) {
    $createTableSql = "CREATE TABLE users (
            id SERIAL PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
    $pdo->exec($createTableSql);
    echo "Table 'users' created successfully\n";
  } else {
    echo "Table 'users' already exists\n";
  }

  $checkUserSql = "SELECT EXISTS (
        SELECT FROM users
        WHERE username = 'admin'
    )";
  $stmt = $pdo->query($checkUserSql);
  $userExists = $stmt->fetchColumn();

  if (!$userExists) {
    $insertUserSql = "INSERT INTO users (username, password) 
                          VALUES ('admin', '123')";
    $pdo->exec($insertUserSql);
    echo "User 'admin' inserted successfully\n";
  } else {
    echo "User 'admin' already exists\n";
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
