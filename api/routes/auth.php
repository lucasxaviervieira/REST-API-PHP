<?php

include "/xampp/htdocs/db/config.php";

include "/xampp/htdocs/api/functions/auth/auth.php";

include "/xampp/htdocs/api/functions/auth/secret_key.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);
  if (isset($data['username']) && isset($data['password'])) {
    $username = $data['username'];
    $encpassword = $data['password'];
    $password = decryptPassword($encpassword);
    $result = loginUser($username, $password);
    echo json_encode($result);
  } else {
    echo json_encode(['error' => 'Missing username or password']);
  }
}