<?php
$host = 'testdb.cpeigg0me2nx.us-east-2.rds.amazonaws.com';
$dbname = 'testdb';
$username = 'admin';
$password = 'Pesopluma-es-basura';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
