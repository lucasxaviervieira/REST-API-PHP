<?php

$dbhost = 'localhost';
$dbname = 'crud_php';
$dbuser = 'postgres';
$dbpass = '123';

try {

  $pdo = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error: " . $e->getMessage());
}