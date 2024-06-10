<?php
date_default_timezone_set('America/Sao_Paulo');

include "/xampp/htdocs/api/functions/secret_key.php";

function loginUser($username, $password)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username AND password = :password");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user) {
    $token = generateToken($user['id']);
    return ['token' => $token];
  } else {
    return ['error' => 'Invalid username or password'];
  }
}


function generateToken($userId)
{
  $secretKey = getSecretKey();
  $expiryTime = time() + (5 * 24 * 60 * 60);
  $payload = [
    'user_id' => $userId,
    'exp' => $expiryTime,
  ];
  $jwt = encodeJWT($payload, $secretKey);
  return $jwt;
}

function encodeJWT($payload, $key)
{
  $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
  $payload = base64_encode(json_encode($payload));
  $signature = hash_hmac('sha256', "$header.$payload", $key, true);
  $signature = base64_encode($signature);
  return "$header.$payload.$signature";
}