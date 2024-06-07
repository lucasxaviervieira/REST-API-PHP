<?php
date_default_timezone_set('America/Sao_Paulo');

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
  $expiryTime = time() + (60 * 60);
  $payload = [
    'user_id' => $userId,
    'exp' => $expiryTime,
  ];
  $jwt = encodeJWT($payload, '2e8fbf2d16cac5c0424adad5190172af9ddf82ca2d8d522db34a39e8ecea23cbf71dddcbd539ea630eebd147f5021819e171d9e713618a585a100c7f604faeece59f891980cf42a6fdb5dd06dd49905eb461d73e86565f82ed30c7e79c14227eb3369251dc6e035c7d50e24ea8d218a76b93f76d988fad90d6ea38469bdf24a70d3ccba8bcec45669e30f7fdd87f87e527f7d84c868c41952e489a2fcbbfc28ecb14b01bca438f31567375341b22c8f13ebeb6562ee9689c01fb194e85073e7dc50559746e4e12f744d3348de1f58c75e905c1f46bcfabbc8a8c2aa9652ec5dfcf05f3103d70deea16252365691b4cbe0f154b7ebedd1217702ddca000ddcbe0');
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
