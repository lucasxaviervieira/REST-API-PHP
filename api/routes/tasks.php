<?php

include "/xampp/htdocs/api/db/config.php";

include "/xampp/htdocs/api/functions/token/validate_token.php";

include "/xampp/htdocs/api/functions/tasks/tasks.php";


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $result = getTaskById($taskId);
  } else {
    $result = getAllTasks();
  }
  echo json_encode($result);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);
  $result = createTask($data);
  echo json_encode($result);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'PATCH') {
  $data = json_decode(file_get_contents("php://input"), true);
  if (isset($data['id'])) {
    $taskId = $data['id'];
    $result = updateTask($taskId, $data);
    echo json_encode($result);
  } else {
    echo json_encode(['error' => 'Missing task ID']);
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $taskId = $_GET['id'];
  if (isset($taskId)) {
    $result = deleteTask($taskId);
    echo json_encode($result);
  } else {
    echo json_encode(['error' => 'Missing task ID']);
  }
}


$pdo = null;