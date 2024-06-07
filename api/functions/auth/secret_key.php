<?php

function decryptPassword($encrypted)
{
  $privKey = "-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQCDVPubv28nnbsetjilPQ0IT/GRiV0U7KtadBlFO03BXLC8Bt+J
tuqwMT6OZ5y0lUVS36PxxwzFW/nDKI0B1bI5o3UBLwQbrpq+KC2uovwmZm6xZVAW
BI5f0KXrayrbTouPnm9CCjlStmeasX32JaFzjqnI8mHojundTn/PfSOS+wIDAQAB
AoGAc1g1L2IfpuSiTmPuNjn7czx7Rr4lEVaXXHcxJpviO5xD4LAMrjAHyT1G2t1n
RTcAzrt6isOulLumDeBUj7L2tuSiQNPuAO34LyNT81Z3TiL10V/slPTPEWSJMwdV
Afx+kZGWv/iF0IY2pzDwwA/kc7RbZIWA8i5XPIo6x1hD1cECQQC3r2nEn7nTBMZh
5UKPF8fIb++2iddYU4hkhzUjyWgLu0snkDqsQEO/6MukpdaAqRqB3Nh73mxLoPyC
/ZFCmSihAkEAtwkvJ2YFBLnHkIrCgHbaeRkUmug4fAI9hN0kkXyQ3vZUbjlAIXbP
Wl/h/Eby+6yKRcYk1qWJpz9P09VRQ6YKGwJARTV1n50jEewppzcPhgTKxK3QXzG+
jswihuYe0pYPeuQd5BFG2iH4pPVczXOix6VvlGCWvM1IdpJ4sg5CThqRIQJAVVVI
0Jt1l4Btk+u9Rlsi+/Y/bwD45Ie+2qSnGdTzTZ+WOVUjmvZjMYUmPJFvUvpb9K+u
GQxQItMXinEXU+yjJQJAbnntjsUbXZHZoc5ye5f2VvN+H1ck+4Ilr4hyoXSDjbPb
qdz8C01+WYYyDzTGgO9qjaQfq+3Cv1ube4caMLGeeQ==
-----END RSA PRIVATE KEY-----";
  $privKey = openssl_pkey_get_private($privKey);
  openssl_private_decrypt(base64_decode($encrypted), $decrypted, $privKey);

  return $decrypted;
}
