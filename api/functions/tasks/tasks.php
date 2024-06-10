<?php

function getAllTasks()
{
  global $pdo;
  $sql = "SELECT * FROM tarefa_projeto";
  $stmt = $pdo->query($sql);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getTaskById($id)
{
  global $pdo;
  $sql = "SELECT * FROM tarefa_projeto WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}


function createTask($data)
{
  global $pdo;

  $data['dias_requerido'] = date_diff(new DateTime($data['data_inicio']), new DateTime($data['data_final']))->days;

  $sql = "INSERT INTO tarefa_projeto (nome_projeto, nome_tarefa, assinado_por, data_inicio, dias_requerido, data_final,
progresso)
VALUES (:nome_projeto, :nome_tarefa, :assinado_por, :data_inicio, :dias_requerido, :data_final, :progresso)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($data);
  return ['message' => 'Task created successfully'];
}

function updateTask($id, $data)
{
  $data['dias_requerido'] = date_diff(new DateTime($data['data_inicio']), new DateTime($data['data_final']))->days;

  global $pdo;
  $sql = "UPDATE tarefa_projeto
            SET nome_projeto = :nome_projeto, nome_tarefa = :nome_tarefa, assinado_por = :assinado_por,
                data_inicio = :data_inicio, dias_requerido = :dias_requerido, data_final = :data_final,
                progresso = :progresso
            WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':nome_projeto', $data['nome_projeto']);
  $stmt->bindParam(':nome_tarefa', $data['nome_tarefa']);
  $stmt->bindParam(':assinado_por', $data['assinado_por']);
  $stmt->bindParam(':data_inicio', $data['data_inicio']);
  $stmt->bindParam(':dias_requerido', $data['dias_requerido']);
  $stmt->bindParam(':data_final', $data['data_final']);
  $stmt->bindParam(':progresso', $data['progresso']);
  $stmt->execute();
  return ['message' => 'Task updated successfully'];
}


function deleteTask($id)
{
  global $pdo;
  $sql = "DELETE FROM tarefa_projeto WHERE id = :id";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return ['message' => 'Task deleted successfully'];
  } catch (PDOException $e) {
    return ['error' => 'Error deleting task: ' . $e->getMessage()];
  }
}
