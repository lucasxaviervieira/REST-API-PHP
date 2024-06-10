<?php
date_default_timezone_set('America/Sao_Paulo');

include "/xampp/htdocs/api/functions/token/header.php";
include "/xampp/htdocs/api/functions/secret_key.php";

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  header("Content-Type: text/plain");
  header("Content-Length: 0");
  http_response_code(204);
  exit();
}

$headers = apache_request_headers();
$authorizationHeader = $headers['Authorization'] ?? '';
$token = str_replace('Bearer ', '', $authorizationHeader);


$secretKey = getSecretKey();
$decodedToken = validateToken($token, $secretKey);

$isExp = tokenIsExp($decodedToken['exp']);


if (!$decodedToken || !isset($decodedToken['user_id'])) {

  header('HTTP/1.1 401 Unauthorized');
  header("Content-Type: application/json; charset=UTF-8");
  echo json_encode(['error' => 'Unauthorized']);
  exit;
} elseif (isset($isExp)) {
  header('HTTP/1.1 401 Token Expired');
  header("Content-Type: application/json; charset=UTF-8");
  echo json_encode(['error' => 'Unauthorized, token is expired']);
  exit;
}


function validateToken($token, $key)
{
  try {
    list($header, $payload, $signature) = explode('.', $token);

    $decodedSignature = base64_decode($signature);

    $expectedSignature = hash_hmac('sha256', "$header.$payload", $key, true);

    if (hash_equals($expectedSignature, $decodedSignature)) {
      return json_decode(base64_decode($payload), true);
    }
    return null;
  } catch (Exception $e) {
    return null;
  }
}


function tokenIsExp($expireTime)
{
  $currentTime = time();
  if ($expireTime < $currentTime) {
    return True;
  }
}