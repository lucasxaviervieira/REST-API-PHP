<?php

include "/xampp/htdocs/db/schemas/tasks.php";
try {

  $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $checkTableSql = "SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_name = 'tarefa_projeto'
    )";
  $stmt = $pdo->query($checkTableSql);
  $tableExists = $stmt->fetchColumn();

  if (!$tableExists) {
    $createTableSql = "CREATE TABLE tarefa_projeto (
            id SERIAL PRIMARY KEY,
            nome_projeto VARCHAR(100),
            nome_tarefa VARCHAR(100),
            assinado_por VARCHAR(100),
            data_inicio DATE,
            dias_requerido INTEGER,
            data_final DATE,
            progresso INTEGER
        )";
    $pdo->exec($createTableSql);
    echo "Table 'tarefa_projeto' created successfully";
  } else {
    echo "Table 'tarefa_projeto' already exists";
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}